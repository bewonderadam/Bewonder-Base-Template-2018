<?php
/** Page Template - Your Visit **/
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
    <div class="your-visit-options-container">
      <?php if( have_rows( 'content_sections' ) ) : ?>
        <select class="your-visit-options">
          <?php while( have_rows( 'content_sections' ) ) : the_row();
            $title = get_sub_field( 'title' );
            $id = str_replace( ' ', '-', strtolower( $title ) ); ?>
            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
          <?php endwhile; ?>
        </select>
      <?php endif; reset_rows(); ?>
      <?php if( have_rows( 'content_sections' ) ) : ?>
        <div class="your-visit-options-navigation">
          <?php while( have_rows( 'content_sections' ) ) : the_row();
            $title = get_sub_field( 'title' );
            $id = str_replace( ' ', '-', strtolower( $title ) ); ?>
            <a href="#<?php echo $id; ?>" id="<?php echo $id; ?>"><?php echo $title; ?></a>
          <?php endwhile; ?>
        </div>
      <?php endif; reset_rows(); ?>
    </div>
    <div class="your-visit-content-container">
      <?php if( have_rows( 'content_sections' ) ) :
        while( have_rows( 'content_sections' ) ) : the_row();
          $title = get_sub_field( 'title' );
          $id = str_replace( ' ', '-', strtolower( $title ) ); ?>
          <article id="<?php echo $id; ?>">
            <h2><?php echo $title; ?></h2>
            <?php echo '<img src="'. get_sub_field( 'image' )[url] . '" />'; ?>
            <?php echo get_sub_field( 'content' ); ?>
          </article>
        <?php endwhile;
      endif; reset_rows(); ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
