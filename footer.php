</main>
<?php if (!is_front_page() && !is_page_template('front-page.php')) : ?>
<footer class="site-footer">
  <div class="container footer-inner">
    <p>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?></p>
    <?php if (has_nav_menu('footer')) : ?>
      <nav aria-label="<?php esc_attr_e('Footer navigation', 'ravirao-theme'); ?>">
        <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'fallback_cb' => false]); ?>
      </nav>
    <?php endif; ?>
  </div>
</footer>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
