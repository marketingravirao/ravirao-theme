<?php
/**
 * One-time DOCX article migration. Run from the WordPress root:
 *
 *   wp eval-file wp-content/themes/rr-theme/migrate-articles-to-journal.php
 *
 * Keep the articles/ folder next to this script. This defaults to a dry run.
 * Apply as drafts with:
 *
 *   RR_JOURNAL_MIGRATION_APPLY=1 wp --user=1 eval-file wp-content/themes/rr-theme/migrate-articles-to-journal.php
 *
 * To publish new entries instead, also set RR_JOURNAL_MIGRATION_STATUS=publish.
 * The matching Bhoomi Poojan design entry is updated in place to preserve its URL.
 * Delete this temporary script after the migration.
 */

if (!defined('WP_CLI') || !WP_CLI) {
    exit("Run this temporary migration through WP-CLI eval-file.\n");
}

if (!class_exists('ZipArchive') || !class_exists('DOMDocument') || !class_exists('DOMXPath')) {
    WP_CLI::error('This migration requires the PHP ZipArchive and DOM extensions.');
}

if (!post_type_exists('journal') || !taxonomy_exists('journal_type') || !taxonomy_exists('journal_topic')) {
    WP_CLI::error('The Journal post type and taxonomies must be registered before running this migration.');
}

if (get_option('rr_journal_docx_articles_migrated_v1')) {
    WP_CLI::error('This one-time DOCX migration has already completed.');
}

$rr_migration_apply = getenv('RR_JOURNAL_MIGRATION_APPLY') === '1';
$rr_migration_status = getenv('RR_JOURNAL_MIGRATION_STATUS');
$rr_migration_status = $rr_migration_status ? $rr_migration_status : 'draft';

if (!in_array($rr_migration_status, ['draft', 'publish'], true)) {
    WP_CLI::error('RR_JOURNAL_MIGRATION_STATUS must be either "draft" or "publish".');
}

define('RR_JOURNAL_DOCX_NS', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
define('RR_JOURNAL_DOCX_REL_NS', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');

function rr_journal_docx_attribute($node, $name) {
    return $node instanceof DOMElement ? $node->getAttributeNS(RR_JOURNAL_DOCX_NS, $name) : '';
}

function rr_journal_docx_enabled_property($xpath, $run, $property) {
    $nodes = $xpath->query('./w:rPr/w:' . $property, $run);
    if (!$nodes || !$nodes->length) {
        return false;
    }

    $value = strtolower(rr_journal_docx_attribute($nodes->item(0), 'val'));
    return !in_array($value, ['0', 'false', 'off'], true);
}

function rr_journal_docx_plain_text($paragraph, $xpath) {
    $text = '';
    $nodes = $xpath->query('.//w:t | .//w:tab | .//w:br | .//w:cr', $paragraph);
    foreach ($nodes as $node) {
        if ($node->localName === 't') {
            $text .= $node->textContent;
        } elseif ($node->localName === 'tab') {
            $text .= "\t";
        } else {
            $text .= "\n";
        }
    }

    return trim($text);
}

function rr_journal_docx_run_html($run, $xpath) {
    $html = '';
    foreach ($run->childNodes as $child) {
        if (!$child instanceof DOMElement || $child->namespaceURI !== RR_JOURNAL_DOCX_NS) {
            continue;
        }

        if ($child->localName === 't') {
            $html .= esc_html($child->textContent);
        } elseif ($child->localName === 'tab') {
            $html .= ' ';
        } elseif ($child->localName === 'br' || $child->localName === 'cr') {
            $html .= '<br>';
        }
    }

    if (rr_journal_docx_enabled_property($xpath, $run, 'b')) {
        $html = '<strong>' . $html . '</strong>';
    }
    if (rr_journal_docx_enabled_property($xpath, $run, 'i')) {
        $html = '<em>' . $html . '</em>';
    }

    $vertical = $xpath->query('./w:rPr/w:vertAlign', $run)->item(0);
    if ($vertical) {
        $alignment = rr_journal_docx_attribute($vertical, 'val');
        if ($alignment === 'superscript') {
            $html = '<sup>' . $html . '</sup>';
        } elseif ($alignment === 'subscript') {
            $html = '<sub>' . $html . '</sub>';
        }
    }

    return $html;
}

function rr_journal_docx_paragraph_html($paragraph, $xpath, $relationships) {
    $html = '';
    foreach ($paragraph->childNodes as $child) {
        if (!$child instanceof DOMElement || $child->namespaceURI !== RR_JOURNAL_DOCX_NS) {
            continue;
        }

        if ($child->localName === 'r') {
            $html .= rr_journal_docx_run_html($child, $xpath);
            continue;
        }

        if ($child->localName !== 'hyperlink') {
            continue;
        }

        $relationship_id = $child->getAttributeNS(RR_JOURNAL_DOCX_REL_NS, 'id');
        $link_text = '';
        foreach ($child->childNodes as $link_child) {
            if ($link_child instanceof DOMElement && $link_child->localName === 'r') {
                $link_text .= rr_journal_docx_run_html($link_child, $xpath);
            }
        }

        if (!empty($relationships[$relationship_id])) {
            $url = esc_url($relationships[$relationship_id]);
            $html .= $url ? '<a href="' . $url . '" rel="noopener noreferrer">' . $link_text . '</a>' : $link_text;
        } else {
            $html .= $link_text;
        }
    }

    return $html;
}

function rr_journal_docx_relationships($zip) {
    $relationships_xml = $zip->getFromName('word/_rels/document.xml.rels');
    if (!$relationships_xml) {
        return [];
    }

    $document = new DOMDocument();
    if (!$document->loadXML($relationships_xml, LIBXML_NONET | LIBXML_NOBLANKS)) {
        return [];
    }

    $relationships = [];
    foreach ($document->getElementsByTagNameNS('http://schemas.openxmlformats.org/package/2006/relationships', 'Relationship') as $relationship) {
        if ($relationship->getAttribute('TargetMode') === 'External') {
            $relationships[$relationship->getAttribute('Id')] = $relationship->getAttribute('Target');
        }
    }

    return $relationships;
}

function rr_journal_docx_list_formats($zip) {
    $numbering_xml = $zip->getFromName('word/numbering.xml');
    if (!$numbering_xml) {
        return [];
    }

    $document = new DOMDocument();
    if (!$document->loadXML($numbering_xml, LIBXML_NONET | LIBXML_NOBLANKS)) {
        return [];
    }

    $xpath = new DOMXPath($document);
    $xpath->registerNamespace('w', RR_JOURNAL_DOCX_NS);
    $abstract_formats = [];

    foreach ($xpath->query('/w:numbering/w:abstractNum') as $abstract) {
        $abstract_id = rr_journal_docx_attribute($abstract, 'abstractNumId');
        $format = $xpath->query('./w:lvl[1]/w:numFmt', $abstract)->item(0);
        if ($format) {
            $abstract_formats[$abstract_id] = rr_journal_docx_attribute($format, 'val');
        }
    }

    $formats = [];
    foreach ($xpath->query('/w:numbering/w:num') as $number) {
        $number_id = rr_journal_docx_attribute($number, 'numId');
        $abstract_id = $xpath->query('./w:abstractNumId', $number)->item(0);
        if ($abstract_id) {
            $abstract_id = rr_journal_docx_attribute($abstract_id, 'val');
            $formats[$number_id] = isset($abstract_formats[$abstract_id]) ? $abstract_formats[$abstract_id] : 'bullet';
        }
    }

    return $formats;
}

function rr_journal_docx_read_article($file, $slug, $topics) {
    $path = __DIR__ . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $file;
    if (!is_readable($path)) {
        return new WP_Error('missing_docx', 'Cannot read source article: ' . $path);
    }

    $zip = new ZipArchive();
    if ($zip->open($path) !== true) {
        return new WP_Error('invalid_docx', 'Could not open DOCX file: ' . $file);
    }

    try {
        $document_xml = $zip->getFromName('word/document.xml');
        if (!$document_xml) {
            return new WP_Error('missing_docx_content', 'DOCX has no word/document.xml: ' . $file);
        }

        $document = new DOMDocument();
        if (!$document->loadXML($document_xml, LIBXML_NONET | LIBXML_NOBLANKS)) {
            return new WP_Error('invalid_docx_xml', 'Could not parse DOCX XML: ' . $file);
        }

        $xpath = new DOMXPath($document);
        $xpath->registerNamespace('w', RR_JOURNAL_DOCX_NS);
        $relationships = rr_journal_docx_relationships($zip);
        $list_formats = rr_journal_docx_list_formats($zip);
        $paragraphs = $xpath->query('//w:body//w:p');
        $title = '';
        $byline = '';
        $content = [];
        $excerpt_text = '';
        $open_list = '';

        foreach ($paragraphs as $paragraph) {
            $text = rr_journal_docx_plain_text($paragraph, $xpath);
            if ($text === '') {
                continue;
            }
            if (preg_match('/^(SEO Settings|Tags:)/i', $text)) {
                break;
            }
            if ($title === '') {
                $title = $text;
                continue;
            }

            if ($byline === '' && preg_match('/^(?:By\\s+)?(?:Dr\\.?\\s+Ravi\\s+Rao|Astro-Vaastu Research Centre)$/i', $text)) {
                $byline = preg_replace('/^By\\s+/i', '', $text);
                continue;
            }

            $style_node = $xpath->query('./w:pPr/w:pStyle', $paragraph)->item(0);
            $style = $style_node ? rr_journal_docx_attribute($style_node, 'val') : '';
            $number_node = $xpath->query('./w:pPr/w:numPr/w:numId', $paragraph)->item(0);
            $number_id = $number_node ? rr_journal_docx_attribute($number_node, 'val') : '';
            $is_list = $style === 'ListParagraph' || $number_id !== '';
            $list_tag = 'ul';
            if ($number_id !== '' && isset($list_formats[$number_id]) && $list_formats[$number_id] !== 'bullet') {
                $list_tag = 'ol';
            }
            $paragraph_html = rr_journal_docx_paragraph_html($paragraph, $xpath, $relationships);
            $runs = $xpath->query('./w:r[w:t]', $paragraph);
            $all_runs_bold = $runs && $runs->length > 0;
            if ($all_runs_bold) {
                foreach ($runs as $run) {
                    if (!rr_journal_docx_enabled_property($xpath, $run, 'b')) {
                        $all_runs_bold = false;
                        break;
                    }
                }
            }

            if ($is_list) {
                if ($open_list !== $list_tag) {
                    if ($open_list !== '') {
                        $content[] = '</' . $open_list . '>';
                    }
                    $content[] = '<' . $list_tag . '>';
                    $open_list = $list_tag;
                }
                $content[] = '<li>' . $paragraph_html . '</li>';
                continue;
            }

            if ($open_list !== '') {
                $content[] = '</' . $open_list . '>';
                $open_list = '';
            }

            $tag = 'p';
            if ($style === 'Quote') {
                $tag = 'blockquote';
            } elseif (preg_match('/^Heading([2-6])$/', $style, $matches)) {
                $tag = 'h' . min(4, (int) $matches[1]);
            } elseif ($style === 'Heading1') {
                $tag = 'h2';
            } elseif ($style === '' && $all_runs_bold && strpos($file, 'Bhoomi Poojan') !== 0 && strlen($text) <= 120) {
                $tag = 'h2';
            }

            if ($excerpt_text === '' && $tag === 'p' && !$all_runs_bold) {
                $excerpt_text = $text;
            }

            $content[] = '<' . $tag . '>' . $paragraph_html . '</' . $tag . '>';
        }

        if ($open_list !== '') {
            $content[] = '</' . $open_list . '>';
        }
    } finally {
        $zip->close();
    }

    if ($title === '' || !$content) {
        return new WP_Error('empty_docx_article', 'The DOCX has no title or publishable body content: ' . $file);
    }

    $content_html = wp_kses_post(implode("\n", $content));
    if ($excerpt_text === '') {
        $excerpt_text = wp_strip_all_tags($content_html);
    }

    return [
        'file' => $file,
        'slug' => $slug,
        'title' => $title,
        'byline' => $byline,
        'content' => $content_html,
        'excerpt' => wp_trim_words($excerpt_text, 35, '…'),
        'topics' => $topics,
        'hash' => hash_file('sha256', $path),
    ];
}

function rr_journal_docx_find_post_by_slug($slug) {
    $posts = get_posts([
        'post_type' => 'journal',
        'post_status' => 'any',
        'name' => $slug,
        'numberposts' => 1,
        'suppress_filters' => true,
    ]);

    return $posts ? $posts[0] : null;
}

function rr_journal_docx_find_post_by_hash($hash) {
    $posts = get_posts([
        'post_type' => 'journal',
        'post_status' => 'any',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'meta_key' => '_rr_journal_docx_sha256',
        'meta_value' => $hash,
        'suppress_filters' => true,
    ]);

    return $posts ? (int) $posts[0] : 0;
}

$rr_migration_sources = [
    [
        'file' => 'Bhoomi Poojan in Vastu Shastra From Soil to Soul+++.docx',
        'slug' => 'bhoomi-poojan-in-vastu-shastra-from-soil-to-soul',
        'topics' => ['vaastu'],
    ],
    [
        'file' => 'Jyotish Light in the Darkness+++.docx',
        'slug' => 'jyotish-light-in-the-darkness',
        'topics' => ['jyotish'],
    ],
    [
        'file' => 'Prana Pratishtha+SEO and keys.docx',
        'slug' => 'prana-pratishtha-temple-consecration',
        'topics' => ['temple-vaastu', 'vaastu'],
    ],
    [
        'file' => 'Time and Space How Astrology and Vastu Work Together+++.docx',
        'slug' => 'time-and-space-how-astrology-and-vastu-work-together',
        'topics' => ['jyotish', 'vaastu'],
    ],
    [
        'file' => 'Topic  3 Signature+++.docx',
        'slug' => 'what-a-signature-reveals-about-a-person',
        'topics' => ['jyotish'],
    ],
];

$rr_migration_articles = [];
$rr_migration_conflicts = [];
foreach ($rr_migration_sources as $source) {
    $article = rr_journal_docx_read_article(
        $source['file'],
        $source['slug'],
        $source['topics']
    );
    if (is_wp_error($article)) {
        WP_CLI::error($article->get_error_message());
    }

    foreach (['article' => 'journal_type'] as $term_slug => $taxonomy) {
        if (!term_exists($term_slug, $taxonomy)) {
            WP_CLI::error(sprintf('Required %s term "%s" does not exist.', $taxonomy, $term_slug));
        }
    }
    foreach ($article['topics'] as $topic) {
        if (!term_exists($topic, 'journal_topic')) {
            WP_CLI::error(sprintf('Required journal_topic term "%s" does not exist.', $topic));
        }
    }

    $article['existing_by_hash'] = rr_journal_docx_find_post_by_hash($article['hash']);
    $article['existing_by_slug'] = rr_journal_docx_find_post_by_slug($article['slug']);
    $article['action'] = 'create';

    if ($article['existing_by_hash']) {
        $article['action'] = 'skip';
    } elseif ($article['existing_by_slug']) {
        $post_id = (int) $article['existing_by_slug']->ID;
        $same_incomplete_import = get_post_meta($post_id, '_rr_journal_docx_source_file', true) === $article['file']
            && !get_post_meta($post_id, '_rr_journal_docx_complete', true);
        if ($same_incomplete_import) {
            $article['action'] = 'update';
        } else {
            $rr_migration_conflicts[] = $article['slug'];
        }
    }

    $rr_migration_articles[] = $article;
}

if ($rr_migration_conflicts) {
    WP_CLI::error('Existing Journal entries conflict with these migration slugs: ' . implode(', ', $rr_migration_conflicts) . '. No posts were changed.');
}

if (!$rr_migration_apply) {
    WP_CLI::log('DRY RUN — no posts or options were changed. Set RR_JOURNAL_MIGRATION_APPLY=1 to apply.');
}

$rr_created = 0;
$rr_updated = 0;
$rr_skipped = 0;

foreach ($rr_migration_articles as $article) {
    if ($article['action'] === 'skip') {
        WP_CLI::log('Already migrated: ' . $article['title']);
        $rr_skipped++;
        continue;
    }

    $post_id = $article['existing_by_slug'] ? (int) $article['existing_by_slug']->ID : 0;
    $action = $article['action'] === 'update' ? 'Update' : 'Create';
    WP_CLI::log($action . ' [' . $rr_migration_status . ']: ' . $article['title'] . ' (' . $article['slug'] . ')');

    if (!$rr_migration_apply) {
        continue;
    }

    if (!$post_id) {
        $post_author = get_current_user_id();
        if (!$post_author) {
            WP_CLI::error('Run with --user=<WordPress user ID> so migrated articles have a valid author.');
        }

        $post_id = wp_insert_post([
            'post_type' => 'journal',
            'post_status' => $rr_migration_status,
            'post_name' => $article['slug'],
            'post_title' => $article['title'],
            'post_excerpt' => $article['excerpt'],
            'post_content' => $article['content'],
            'post_author' => $post_author,
        ], true);
    } else {
        $post_id = wp_update_post([
            'ID' => $post_id,
            'post_content' => $article['content'],
        ], true);
    }

    if (is_wp_error($post_id) || !$post_id) {
        WP_CLI::error(is_wp_error($post_id) ? $post_id->get_error_message() : 'WordPress failed to save an article.');
    }

    update_post_meta($post_id, '_rr_journal_docx_source_file', $article['file']);
    update_post_meta($post_id, '_rr_journal_docx_byline', $article['byline']);

    $type_result = wp_set_object_terms($post_id, ['article'], 'journal_type');
    if (is_wp_error($type_result)) {
        WP_CLI::error($type_result->get_error_message());
    }
    $topic_result = wp_set_object_terms($post_id, $article['topics'], 'journal_topic');
    if (is_wp_error($topic_result)) {
        WP_CLI::error($topic_result->get_error_message());
    }

    update_post_meta($post_id, '_rr_journal_docx_sha256', $article['hash']);
    update_post_meta($post_id, '_rr_journal_docx_complete', '1');

    if ($article['action'] === 'update') {
        $rr_updated++;
    } else {
        $rr_created++;
    }
}

if ($rr_migration_apply) {
    update_option('rr_journal_docx_articles_migrated_v1', [
        'completed_at' => current_time('mysql'),
        'created' => $rr_created,
        'updated' => $rr_updated,
        'skipped' => $rr_skipped,
    ], false);
    WP_CLI::success(sprintf(
        'DOCX migration complete. Created: %d; updated: %d; already migrated: %d. New entries are %s.',
        $rr_created,
        $rr_updated,
        $rr_skipped,
        $rr_migration_status
    ));
} else {
    WP_CLI::log(sprintf(
        'Dry run complete. Would create: %d; update: %d; already migrated: %d.',
        count(array_filter($rr_migration_articles, function ($article) { return $article['action'] === 'create'; })),
        count(array_filter($rr_migration_articles, function ($article) { return $article['action'] === 'update'; })),
        $rr_skipped
    ));
}
