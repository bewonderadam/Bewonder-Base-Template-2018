<?php
/** Page Template - Find Us **/
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
    <section class="page-content">
      <?php the_content(); ?>
    </section>
    <?php the_post_thumbnail(); ?>
    <?php echo do_shortcode( '[acf-map]' ); ?>
  </div>
</section>
<?php get_footer(); ?>
