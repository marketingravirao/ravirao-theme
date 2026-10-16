<?php get_header(); ?>
<div class="container content-wrap">
  <h1><?php esc_html_e('Page not found', 'ravirao-theme'); ?></h1>
  <p><?php esc_html_e('The page you requested could not be found.', 'ravirao-theme'); ?></p>
  <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return home', 'ravirao-theme'); ?></a>
</div>
<?php get_footer(); ?>
