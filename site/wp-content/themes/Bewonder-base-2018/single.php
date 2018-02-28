<?php get_header(); ?>
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
    <?php if( have_posts() ) : while( have_posts() ) : the_post();
      $post_type = get_post_type();
      if( $post_type ) {
        $post_type_data = get_post_type_object( $post_type );
        $post_type_slug = $post_type_data->rewrite['slug'];
        get_template_part( 'template-parts/content', $post_type_slug );
      }
      else {
        get_template_part( 'template-parts/content', get_post_format() );
      }
    endwhile; endif; ?>
  </div>
</section>
<?php get_footer(); ?>
