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
      <?php if( $terms = get_terms( 'store_categories', 'orderby=name' ) ) : ?>
        <label for="filter">Category</label>
      	<select name="filter">
          <option value="all-shops">All Shops</option>
      	  <?php foreach ( $terms as $term ) :
        		echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
        	endforeach; ?>
        </select>
      <?php endif; ?>
    </div>
    <div class="store-search">
      <label for="store-search">Name</label>
      <input name="store-search" type="text" />
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <?php $args = array(
  		'post_type' => 'stores',
  		'post_status' => 'publish',
  		'orderby' => 'title',
  		'order' => 'ASC',
      'posts_per_page' => '20',
  	);
  	$loop = new WP_Query($args);
  	if( $loop->have_posts() ) :
      while( $loop->have_posts() ) : $loop->the_post();
        get_template_part( 'template-parts/content', 'stores' );
    	endwhile;
    else :
      get_template_part( 'template-parts/content', 'none' );
    endif; ?>
  </div>
</section>
<?php get_footer(); ?>
