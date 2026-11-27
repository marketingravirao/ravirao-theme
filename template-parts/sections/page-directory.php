<?php
if (!defined('ABSPATH')) {
  exit;
}

$directory_args = wp_parse_args($args ?? [], [
    'page_id' => get_queried_object_id(),
    'eyebrow' => '',
    'description' => '',
    'hero_image' => '',
    'section_eyebrow' => '',
    'section_title' => '',
    'section_description' => '',
]);
$directory_page_id = absint($directory_args['page_id']);
$directory_title = get_the_title($directory_page_id);
$directory_excerpt = trim((string) get_post_field('post_excerpt', $directory_page_id));
$directory_description = $directory_excerpt !== '' ? $directory_excerpt : $directory_args['description'];
$directory_content = trim((string) get_post_field('post_content', $directory_page_id));
$directory_children = get_pages([
    'parent' => $directory_page_id,
    'sort_column' => 'menu_order,post_title',
    'sort_order' => 'ASC',
    'post_status' => 'publish',
]);
$directory_image = $directory_args['hero_image']
    ? get_theme_file_uri($directory_args['hero_image'])
    : '';
?>
<div class="rr-page-directory">
  <section class="rr-page-directory__hero" aria-labelledby="rr-page-directory-title">
    <?php if ($directory_image) : ?>
      <img class="rr-page-directory__hero-image" src="<?php echo esc_url($directory_image); ?>" alt="" fetchpriority="high">
    <?php endif; ?>
    <div class="rr-page-directory__container rr-page-directory__hero-content">
      <?php if ($directory_args['eyebrow'] !== '') : ?>
        <p class="rr-page-directory__eyebrow rr-page-directory__eyebrow--light"><?php echo esc_html($directory_args['eyebrow']); ?></p>
      <?php endif; ?>
      <h1 class="rr-page-directory__title" id="rr-page-directory-title"><?php echo esc_html($directory_title); ?></h1>
      <?php if ($directory_description !== '') : ?>
        <p class="rr-page-directory__lead"><?php echo esc_html($directory_description); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="rr-page-directory__section" aria-labelledby="rr-page-directory-subpages-title">
    <div class="rr-page-directory__container">
      <div class="rr-page-directory__heading">
        <?php if ($directory_args['section_eyebrow'] !== '') : ?>
          <p class="rr-page-directory__eyebrow"><?php echo esc_html($directory_args['section_eyebrow']); ?></p>
        <?php endif; ?>
        <h2 class="rr-page-directory__section-title" id="rr-page-directory-subpages-title">
          <?php echo esc_html($directory_args['section_title']); ?>
        </h2>
        <?php if ($directory_args['section_description'] !== '') : ?>
          <p class="rr-page-directory__section-description"><?php echo esc_html($directory_args['section_description']); ?></p>
        <?php endif; ?>
      </div>

      <?php if ($directory_content !== '') : ?>
        <div class="rr-page-directory__content">
          <?php echo apply_filters('the_content', $directory_content); ?>
        </div>
      <?php endif; ?>

      <?php if ($directory_children) : ?>
        <div class="rr-page-directory__grid">
          <?php foreach ($directory_children as $index => $directory_child) :
            $child_id = (int) $directory_child->ID;
            $child_title = get_the_title($child_id);
            $child_excerpt = trim((string) get_the_excerpt($directory_child));
            $child_image_id = get_post_thumbnail_id($child_id);
            $child_visual_class = 'rr-page-directory__card-visual';
            if (!$child_image_id) {
                $child_visual_class .= ' rr-page-directory__card-visual--fallback';
            }
            ?>
            <a class="rr-page-directory__card" href="<?php echo esc_url(get_permalink($child_id)); ?>">
              <span class="<?php echo esc_attr($child_visual_class); ?>">
                <?php if ($child_image_id) : ?>
                  <?php echo wp_get_attachment_image($child_image_id, 'large', false, [
                      'class' => 'rr-page-directory__card-image',
                      'alt' => '',
                      'loading' => 'lazy',
                  ]); ?>
                <?php else : ?>
                  <span class="rr-page-directory__card-index" aria-hidden="true"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                  <span class="rr-page-directory__card-mark" aria-hidden="true"></span>
                <?php endif; ?>
              </span>
              <span class="rr-page-directory__card-copy">
                <span class="rr-page-directory__card-title"><?php echo esc_html($child_title); ?></span>
                <?php if ($child_excerpt !== '') : ?>
                  <span class="rr-page-directory__card-description"><?php echo esc_html($child_excerpt); ?></span>
                <?php endif; ?>
                <span class="rr-page-directory__card-link"><?php esc_html_e('Explore', 'ravirao-theme'); ?><span aria-hidden="true">→</span></span>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      <?php elseif (current_user_can('edit_pages')) : ?>
        <p class="rr-page-directory__empty"><?php esc_html_e('No published subpages yet. Set this page as the parent of the pages you want to list here.', 'ravirao-theme'); ?></p>
      <?php endif; ?>
    </div>
  </section>
</div>
