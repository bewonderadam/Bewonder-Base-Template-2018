<?php
/** Page Template - Newsletter **/
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
    <div class="newsletter-content">
      <?php the_content(); ?>
      <?php rubiks_form(); ?>
      <?php the_post_thumbnail(); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
