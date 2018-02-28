<footer id="site-footer">
  <?php if( ! is_page( '136' ) ) : ?>
    <section id="footer-newsletter-container">
      <div class="footer-newsletter-inner">
        <h2><?php the_field( 'newsletter_footer_title', 'option' ); ?></h2>
        <p><?php the_field( 'newsletter_footer_text', 'option', false ); ?></p>
        <a class="sign-up" href="<?php the_field( 'newsletter_footer_button_url', 'option' ); ?>"><?php the_field( 'newsletter_footer_button_text', 'option' ); ?></a>
      </div>
    </section>
  <?php endif; ?>
  <section id="footer-buttons-container">
    <div class="footer-buttons-inner">
      <?php if( have_rows( 'footer_buttons', 'option' ) ) : while( have_rows( 'footer_buttons', 'option' ) ) : the_row(); ?>
        <div class="footer-button">
          <a class="footer-button-link" href="<?php the_sub_field( 'button_link' ); ?>">
            <h2><?php the_sub_field( 'button_text' ); ?></h2>
          </a>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </section>
  <section id="footer-menu-container">
    <div class="footer-menu-inner">
      <?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'footer-menu', 'container' => false ) ); ?>
    </div>
  </section>
  <section id="footer-logo-container">
    <div class="footer-logo-inner">
      <a id="footer-logo" href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a>
    </div>
  </section>
</footer>
<?php wp_footer(); ?>
</body>
</html>
