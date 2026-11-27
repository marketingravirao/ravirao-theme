<?php
if (!defined('ABSPATH')) {
    exit;
}

$rrj_variant = isset($args['variant']) ? sanitize_key($args['variant']) : 'result';
$rrj_type_slug = ravirao_journal_type_slug(get_the_ID());
$rrj_type_label = ravirao_journal_type_label(get_the_ID());
$rrj_topics = ravirao_journal_topics(get_the_ID());
$rrj_external_url = ravirao_journal_get_field_value('journal_external_url', get_the_ID(), '_ravirao_journal_external_url');
$rrj_video_url = ravirao_journal_get_field_value('gallery_video_url', get_the_ID(), '_ravirao_gallery_video_url');
$rrj_video_url = is_string($rrj_video_url) ? trim($rrj_video_url) : '';
$rrj_is_gallery_item = get_post_type() === 'gallery';
$rrj_video_embed_url = $rrj_type_slug === 'video' ? ravirao_journal_get_video_embed($rrj_video_url) : '';
$rrj_is_video_file = $rrj_type_slug === 'video' && (bool) preg_match('~\.(mp4|webm)(?:[?#].*)?$~i', $rrj_video_url);
$rrj_href = $rrj_external_url && $rrj_type_slug === 'press' ? $rrj_external_url : get_permalink();
$rrj_target = $rrj_href === $rrj_external_url && $rrj_external_url ? ' target="_blank" rel="noopener noreferrer"' : '';
?>
<?php if ($rrj_variant === 'row') : ?>
  <a class="rrj-article-row" href="<?php echo esc_url($rrj_href); ?>"<?php echo $rrj_target; ?>>
    <span class="rrj-article-row__date"><b><?php echo esc_html(get_the_date('d')); ?></b><span><?php echo esc_html(get_the_date('M Y')); ?></span></span>
    <span class="rrj-article-row__content">
      <span class="rrj-meta"><span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span><?php if ($rrj_topics) : ?><span><?php echo esc_html($rrj_topics); ?></span><?php endif; ?></span>
      <strong><?php the_title(); ?></strong>
      <span class="rrj-article-row__excerpt"><?php echo esc_html(get_the_excerpt()); ?></span>
    </span>
    <span class="rrj-article-row__arrow" aria-hidden="true">→</span>
  </a>
<?php elseif ($rrj_variant === 'gallery') : ?>
  <?php if ($rrj_type_slug === 'video') : ?>
    <article class="rrj-gallery-card rrj-gallery-card--video">
      <div class="rrj-gallery-card__image rrj-video-card">
        <?php if ($rrj_video_embed_url) : ?>
          <button class="rrj-video-card__poster" type="button" data-rrj-video-embed="<?php echo esc_url($rrj_video_embed_url); ?>" data-rrj-video-title="<?php echo esc_attr(get_the_title()); ?>" aria-label="<?php echo esc_attr(sprintf(__('Play video: %s', 'ravirao-theme'), get_the_title())); ?>">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['loading' => 'lazy']); endif; ?>
            <span class="rrj-play" aria-hidden="true">▶</span>
          </button>
        <?php elseif ($rrj_is_video_file) : ?>
          <button class="rrj-video-card__poster" type="button" data-rrj-video-file="<?php echo esc_url($rrj_video_url); ?>" data-rrj-video-title="<?php echo esc_attr(get_the_title()); ?>"<?php if (has_post_thumbnail()) : ?> data-rrj-video-poster="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"<?php endif; ?> aria-label="<?php echo esc_attr(sprintf(__('Play video: %s', 'ravirao-theme'), get_the_title())); ?>">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['loading' => 'lazy']); endif; ?>
            <span class="rrj-play" aria-hidden="true">▶</span>
          </button>
        <?php else : ?>
          <span class="rrj-video-unavailable"><?php esc_html_e('Video link coming soon', 'ravirao-theme'); ?></span>
        <?php endif; ?>
        <span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span>
      </div>
      <span class="rrj-gallery-card__title"><?php the_title(); ?></span>
    </article>
  <?php else : ?>
    <article class="rrj-gallery-card">
      <?php if (has_post_thumbnail()) : ?>
        <button class="rrj-gallery-card__image rrj-gallery-card__image--popup" type="button" data-rrj-image-popup="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" data-rrj-image-alt="<?php echo esc_attr(get_the_title()); ?>" aria-label="<?php echo esc_attr(sprintf(__('View image: %s', 'ravirao-theme'), get_the_title())); ?>">
          <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
          <span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span>
        </button>
      <?php else : ?>
        <span class="rrj-gallery-card__image"><span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span></span>
      <?php endif; ?>
      <span class="rrj-gallery-card__title"><?php the_title(); ?></span>
    </article>
  <?php endif; ?>
<?php elseif ($rrj_variant === 'press') : ?>
  <a class="rrj-press-card" href="<?php echo esc_url($rrj_href); ?>"<?php echo $rrj_target; ?>>
    <span class="rrj-press-card__image"><?php if (has_post_thumbnail()) : the_post_thumbnail('large', ['loading' => 'lazy']); endif; ?></span>
    <span class="rrj-meta"><?php if ($rrj_type_label) : ?><span><?php echo esc_html($rrj_type_label); ?></span><?php endif; ?><?php if ($rrj_topics) : ?><span> · <?php echo esc_html($rrj_topics); ?></span><?php endif; ?></span>
    <strong><?php the_title(); ?></strong>
    <span class="rrj-press-card__excerpt"><?php echo esc_html(get_the_excerpt()); ?></span>
    <span class="rrj-text-link"><?php esc_html_e('Read the feature', 'ravirao-theme'); ?> →</span>
  </a>
<?php else : ?>
  <article class="rrj-result-card">
    <?php if ($rrj_type_slug === 'video') : ?>
      <div class="rrj-result-card__image rrj-video-card">
        <?php if ($rrj_video_embed_url) : ?>
          <button class="rrj-video-card__poster" type="button" data-rrj-video-embed="<?php echo esc_url($rrj_video_embed_url); ?>" data-rrj-video-title="<?php echo esc_attr(get_the_title()); ?>" aria-label="<?php echo esc_attr(sprintf(__('Play video: %s', 'ravirao-theme'), get_the_title())); ?>">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('medium_large', ['loading' => 'lazy']); endif; ?>
            <span class="rrj-play" aria-hidden="true">▶</span>
          </button>
        <?php elseif ($rrj_is_video_file) : ?>
          <button class="rrj-video-card__poster" type="button" data-rrj-video-file="<?php echo esc_url($rrj_video_url); ?>" data-rrj-video-title="<?php echo esc_attr(get_the_title()); ?>"<?php if (has_post_thumbnail()) : ?> data-rrj-video-poster="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>"<?php endif; ?> aria-label="<?php echo esc_attr(sprintf(__('Play video: %s', 'ravirao-theme'), get_the_title())); ?>">
            <?php if (has_post_thumbnail()) : the_post_thumbnail('medium_large', ['loading' => 'lazy']); endif; ?>
            <span class="rrj-play" aria-hidden="true">▶</span>
          </button>
        <?php else : ?>
          <span class="rrj-video-unavailable"><?php esc_html_e('Video link coming soon', 'ravirao-theme'); ?></span>
        <?php endif; ?>
        <?php if ($rrj_type_label) : ?><span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span><?php endif; ?>
      </div>
    <?php elseif ($rrj_is_gallery_item) : ?>
      <?php if (has_post_thumbnail()) : ?>
        <button class="rrj-result-card__image rrj-result-card__image--popup" type="button" data-rrj-image-popup="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" data-rrj-image-alt="<?php echo esc_attr(get_the_title()); ?>" aria-label="<?php echo esc_attr(sprintf(__('View image: %s', 'ravirao-theme'), get_the_title())); ?>">
          <?php the_post_thumbnail('medium_large', ['loading' => 'lazy']); ?>
          <?php if ($rrj_type_label) : ?><span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span><?php endif; ?>
        </button>
      <?php else : ?>
        <div class="rrj-result-card__image">
          <?php if ($rrj_type_label) : ?><span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span><?php endif; ?>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <a class="rrj-result-card__image" href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : the_post_thumbnail('medium_large', ['loading' => 'lazy']); endif; ?>
        <?php if ($rrj_type_label) : ?><span class="rrj-tag"><?php echo esc_html($rrj_type_label); ?></span><?php endif; ?>
      </a>
    <?php endif; ?>
    <div class="rrj-result-card__body">
      <p class="rrj-meta"><?php echo esc_html($rrj_topics); ?><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date()); ?></time></p>
      <h3><?php if ($rrj_is_gallery_item) : the_title(); else : ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php endif; ?></h3>
      <p><?php echo esc_html(get_the_excerpt()); ?></p>
      <?php if (!$rrj_is_gallery_item) : ?><a class="rrj-text-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'ravirao-theme'); ?> →</a><?php endif; ?>
    </div>
  </article>
<?php endif; ?>
