<?php if( is_archive() || ! is_single() ) : ?>
  <article <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
      <?php $related_store = get_field( 'related_store' );
  		$store_logo = get_the_post_thumbnail($related_store, 'full'); ?>
      <?php echo $store_logo; ?>
    </a>
  </article>
<?php endif; ?>
<?php if( is_single() ) : ?>
  <section class="offer-content">
    <?php the_post_thumbnail(); ?>
    <?php the_content(); ?>
  </section>
  <section class="store-logo">
    <?php $related_store = get_field( 'related_store' );
    $store_logo = get_the_post_thumbnail($related_store, 'full'); ?>
    <?php echo $store_logo; ?>
    <a class="view-store" href="<?php echo get_the_permalink( $related_store ); ?>">View Store</a>
  </section>
  <section class="related-information">
    <?php if( get_field( 'related_offers', 'option' ) ) : ?>
      <div class="related-offers">
        <h2>Related Offers</h2>
        <?php $id = get_the_ID();
        $args = array(
          'post_type' => 'offers',
          'posts_per_page' => '4',
          'post_status' => 'publish',
          'orderby' => 'rand',
          'meta_key' => 'related_store',
          'meta_value' => $related_store->ID,
          'post__not_in' => array( $id ),
        );
        $relatedOffers = get_posts( $args );
        if ( $relatedOffers ) {
          foreach ( $relatedOffers as $post ) :
              setup_postdata( $post ); ?>
              <article <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>">
                  <h3><?php the_title(); ?></h3>
                </a>
              </article>
          <?php endforeach;
          wp_reset_postdata();
        } ?>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>
