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
  <section class="store-logo">
    <?php $related_store = get_field( 'related_store' );
    $store_logo = get_the_post_thumbnail($related_store, 'full'); ?>
    <?php echo $store_logo; ?>
    <a class="view-store" href="<?php echo get_the_permalink( $related_store ); ?>">View Store</a>
  </section>
  <section class="job-content">
    <?php the_post_thumbnail(); ?>
    <?php the_content(); ?>
  </section>
<?php endif; ?>
