<?php get_header(); ?>
<section id="page-container">
  <div class="page-container-inner">
    <section id="homepage-slider" class="owl-carousel">
      <?php $args = array(
        'post_type' => 'slider',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        // 'tax_query' => array(
        //   array(
        //    'taxonomy' => 'slider_name',
        //    'terms' => 'homepage-slider',
        //    'field' => 'slug',
        //    'operator' => 'IN'
        //  )
        // ),
      );
      $posts = get_posts( $args );
      foreach( $posts as $post ) : setup_postdata( $post );  ?>
        <div class="slide">
          <a href="<?php the_field( 'slide_link' ); ?>" target="_blank">
            <img src="<?php the_post_thumbnail_url(); ?>" />
          </a>
        </div>
      <?php endforeach; wp_reset_postdata(); ?>
    </section>
    <section id="homepage-boxes">
      <?php if( have_rows( 'homepage_boxes' ) ) : while( have_rows( 'homepage_boxes' ) ) : the_row(); ?>
        <div class="homepage-box" style="background-image: url( <?php echo get_sub_field( 'background_image')[url]; ?> );">
          <a class="homepage-box-link" href="<?php the_sub_field( 'box_link' ); ?>">
            <h2><?php the_sub_field( 'box_title' ); ?></h2>
          </a>
        </div>
      <?php endwhile; endif; ?>
    </section>
  </div><!-- Page Container Inner -->
</section><!-- Page Container -->
<?php get_footer(); ?>
