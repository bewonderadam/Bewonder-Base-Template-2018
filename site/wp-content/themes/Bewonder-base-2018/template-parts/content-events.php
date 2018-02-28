<?php if( is_archive() || ! is_single() ) : ?>
  <article <?php post_class(); ?>>
    <?php the_post_thumbnail(); ?>
    <div class="event-content">
      <h2><?php the_title(); ?></h2>
      <?php the_content(); ?>
    </div>
  </article>
<?php endif; ?>
<?php if( is_single() ) : ?>
  <article <?php post_class(); ?>>
    <?php the_post_thumbnail(); ?>
    <div class="event-content">
      <h2><?php the_title(); ?></h2>
      <?php the_content(); ?>
    </div>
  </article>
<?php endif; ?>
