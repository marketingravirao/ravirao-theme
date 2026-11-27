<?php
if (!defined('ABSPATH')) { exit; }

if (post_password_required()) {
    return;
}
?>
<section id="comments" class="comments-area">
  <?php if (have_comments()) : ?>
    <h2 class="comments-title">
      <?php
      $comment_count = (int) get_comments_number();
      printf(
          /* translators: %s: number of comments */
          esc_html(_n('%s comment', '%s comments', $comment_count, 'ravirao-theme')),
          esc_html(number_format_i18n($comment_count))
      );
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments([
          'style' => 'ol',
          'short_ping' => true,
          'avatar_size' => 48,
      ]);
      ?>
    </ol>

    <?php the_comments_navigation(); ?>

    <?php if (!comments_open()) : ?>
      <p class="no-comments"><?php esc_html_e('Comments are closed.', 'ravirao-theme'); ?></p>
    <?php endif; ?>
  <?php endif; ?>

  <?php comment_form(); ?>
</section>
