<?php get_header(); ?>
<section id="page-header-container">
  <div class="page-header-inner">
    <div class="title-container">
      <div class="title-inner">
        <h1><?php echo the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <?php if( have_posts() ) :
      while( have_posts() ) : the_post();
        the_post_thumbnail();
        the_content();
      endwhile;
    else :
       get_template_part( 'template-parts/content', 'none' );
    endif; ?>
  </div>
</section>
<?php get_footer(); ?>
