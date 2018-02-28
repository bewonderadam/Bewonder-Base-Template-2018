<?php get_header(); ?>
<?php global $query_string;
query_posts( $query_string . '&paged=' . $paged  ); ?>
<section id="page-header-container">
  <div class="page-header-inner">
    <div class="page-featured-image">
      <img src="<?php echo archive_page_header_image(); ?>" alt="<?php echo archive_page_title(); ?>" />
    </div>
    <div class="title-container">
      <div class="title-inner">
        <h1><?php echo archive_page_title(); ?></h1>
      </div>
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <?php
    if( is_post_type_archive( 'stores' ) ) :
      $postType = 'stores';
    elseif ( is_post_type_archive( 'offers' ) ) :
      $postType = 'offers';
    elseif ( is_post_type_archive( 'events' ) ) :
      $postType = 'events';
    elseif ( is_post_type_archive( 'jobs' ) ) :
      $postType = 'jobs';
    elseif ( is_post_type_archive( 'news' ) ) :
      $postType = 'news';
    endif;
    $args = array(
  		'post_type' => $postType,
  		'post_status' => 'publish',
      'posts_per_page' => '20',
  	);
  	$loop = new WP_Query($args);
    if( $loop->have_posts() ) :
      while( $loop->have_posts() ) : $loop->the_post();
        $post_type = get_post_type();
        if( $post_type ) {
          $post_type_data = get_post_type_object( $post_type );
          $post_type_slug = $post_type_data->rewrite['slug'];
          get_template_part( 'template-parts/content', $post_type_slug );
        }
        else {
          get_template_part( 'template-parts/content', get_post_format() );
        }
      endwhile;
    else :
       get_template_part( 'template-parts/content', 'none' );
    endif; ?>
  </div>
</section>
<?php get_footer(); ?>
