<?php if( is_archive() || ! is_single() ) : ?>
  <article <?php post_class(); ?>>
    <h2><?php the_title(); ?></h2>
    <?php the_excerpt(); ?>
    <a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
  </article>
<?php endif; ?>
<?php if( is_single() ) : ?>
  <article <?php post_class(); ?>>
    <?php the_post_thumbnail(); ?>
    <?php the_content(); ?>
  </article>
<?php endif; ?>
