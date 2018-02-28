<?php
/** Page Template - Opening Times **/
get_header(); ?>
<section id="page-header-container">
  <div class="page-header-inner">
    <div class="title-container">
      <div class="title-inner">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <div class="opening-times">
      <div class="opening-times-inner">
        <?php echo do_shortcode( '[centre-opening-hours]'); ?>
      </div>
    </div>
    <?php the_post_thumbnail(); ?>
    <div class="content">
      <?php the_content(); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
