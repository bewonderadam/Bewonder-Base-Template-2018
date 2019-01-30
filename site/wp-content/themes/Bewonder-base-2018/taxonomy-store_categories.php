<?php get_header(); ?>
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
<section id="store-filters-container">
  <div class="store-filters-inner">
    <h2>Filter shops by:</h2>
    <div class="category-filter">
      <label for="filter">Category</label>
      <?php
      $args = array(
        'show_option_all' => 'All',
        'name' => 'filter',
        'taxonomy' => 'store_categories',
        'orderby' => 'name',
      );
      wp_dropdown_categories( $args ); ?>
    </div>
    <div class="store-search">
      <label for="store-search">Name</label>
      <input name="store-search" type="text" />
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
  	<?php if( have_posts() ) :
      while( have_posts() ) : the_post();
        get_template_part( 'template-parts/content', 'stores' );
    	endwhile;
    else :
      get_template_part( 'template-parts/content', 'none' );
    endif; ?>
  </div>
</section>
<?php get_footer(); ?>
