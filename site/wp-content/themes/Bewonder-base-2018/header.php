<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php wp_head(); ?>
  </head>
  <body <?php echo body_class(); ?>>
    <header class="site-header">
      <section id="top-header-container">
        <div class="top-header-inner">
          <div class="todays-opening-times">
            <p>Today we are open <span><?php echo get_todays_centre_opening_times(); ?></span></p>
          </div>
          <div class="centre-social-media-links">
            <?php echo get_social_links(); ?>
          </div>
        </div>
      </section>
      <section id="bottom-header-container">
        <div class="bottom-header-inner">
          <a id="site-logo" href="<?php echo get_bloginfo( 'url' ); ?>/"><?php echo get_bloginfo( 'name' ); ?></a>
          <nav id="site-navigation" class="main-navigation" role="navigation">
            <a class="menu-toggle">Primary Menu</a>
            <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
          </nav>
        </div>
      </section>
    </header>
