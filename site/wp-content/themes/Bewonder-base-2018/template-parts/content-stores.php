<?php if( is_archive() || ! is_single() ) : ?>
  <article <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
      <?php if( has_post_thumbnail() ) :
        the_post_thumbnail();
      else : ?>
        <img src="<?php echo get_field( 'default_store_logo', 'option' )[url]; ?>" />
      <?php endif; ?>
    </a>
  </article>
<?php endif;
if( is_single() ) : ?>
  <section class="store-information">
    <?php if( has_post_thumbnail() ) :
      the_post_thumbnail();
    else : ?>
      <img src="<?php echo get_field( 'default_store_logo', 'option' )[url]; ?>" />
    <?php endif; ?>
    <?php the_content(); ?>
    <div class="store-links">
      <?php if( get_field( 'store_website' ) ) { ?>
        <a class="website" href="<?php the_field( 'store_website' ); ?>" target="_blank"><span><?php the_title(); ?> Website</span></a>
      <?php }
      if( get_field( 'store_telephone_number' ) ) { ?>
        <a class="telephone-number" href="tel:<?php the_field( 'store_telephone_number' ); ?>"><span><?php the_field( 'store_telephone_number' ); ?></span></a>
      <?php } ?>
    </div>
  </section>
  <section class="store-content">
    <?php if( get_field( 'store_image' ) ) : ?>
      <img src="<?php echo get_field( 'store_image' )[url]; ?>" alt="<?php the_title(); ?>" />
    <?php else : ?>
      <img src="<?php echo get_field( 'page_header_image', 'option' )[url]; ?>" alt="<?php the_title(); ?>" />
    <?php endif; ?>
    <?php if( get_field( 'enable_store_opening_hours' ) && have_rows( 'store_opening_hours' ) ) : ?>
      <div class="store-opening-hours">
        <table>
          <tbody>
            <?php while( have_rows( 'store_opening_hours' ) ) : the_row(); ?>
              <tr>
                <td><?php the_sub_field( 'day' ); ?></td>
                <td><?php the_sub_field( 'hours' ); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>
  <?php if( get_field( 'related_stores', 'option' ) || get_field( 'related_offers', 'option' ) || get_field( 'related_news', 'option' ) ) : ?>
    <section class="related-information">
      <?php $id = get_the_ID();
      $terms = wp_get_post_terms( $id, 'store_categories', array( 'fields' => 'ids' ) ); ?>
      <?php if( get_field( 'related_stores', 'option' ) ) : ?>
        <div class="related-stores">
          <h2>Related Stores</h2>
          <?php $args = array(
            'post_type' => 'stores',
            'posts_per_page' => '4',
            'post_status' => 'publish',
            'orderby' => 'rand',
            'tax_query' => array(
              array(
                'taxonomy' => 'store_categories',
          			'field'    => 'term_id',
          			'terms'    => $terms,
          			'operator' => 'IN',
              ),
            ),
            'post__not_in' => array( $id ),
          );
          $relatedStores = get_posts( $args );
          if ( $relatedStores ) {
            foreach ( $relatedStores as $post ) :
                setup_postdata( $post ); ?>
                <article <?php post_class(); ?>>
                  <a href="<?php the_permalink(); ?>">
                    <?php if( has_post_thumbnail() ) :
                      the_post_thumbnail();
                    else : ?>
                      <img src="<?php echo get_field( 'default_store_logo', 'option' )[url]; ?>" />
                    <?php endif; ?>
                  </a>
                </article>
            <?php endforeach;
            wp_reset_postdata();
          } ?>
        </div>
      <?php endif; ?>
      <?php if( get_field( 'related_offers', 'option' ) ) : ?>
        <div class="related-offers">
          <h2>Related Offers</h2>
          <?php $args = array(
            'post_type' => 'offers',
            'posts_per_page' => '4',
            'post_status' => 'publish',
            'orderby' => 'rand',
            'meta_key' => 'related_store',
            'meta_value' => $id,
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
      <?php if( get_field( 'related_news', 'option' ) ) : ?>
        <div class="related-news">
          <h2>Related News</h2>
          <?php $args = array(
            'post_type' => 'news',
            'posts_per_page' => '4',
            'post_status' => 'publish',
            'orderby' => 'rand',
            'meta_key' => 'related_store',
            'meta_value' => $id,
          );
          $relatedNews = get_posts( $args );
          if ( $relatedNews ) {
            foreach ( $relatedNews as $post ) :
                setup_postdata( $post ); ?>
                <article <?php post_class(); ?>>
                  <h3><?php the_title(); ?></h3>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                </article>
            <?php endforeach;
            wp_reset_postdata();
          } ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endif; ?>
<?php endif; ?>
