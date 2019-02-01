<?php
if ( ! function_exists( 'bewonder_base_2018_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bewonder_base_2018_theme_setup() {
  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	*/
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary' ),
		'menu-2' => esc_html__( 'Footer Menu' )
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
  */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'bewonder_base_2018_theme_setup' );

// Enqueue theme styling and scripts
function bewonder_base_2018_theme_styles_and_scripts() {
  wp_enqueue_style( 'normalize-css', get_template_directory_uri() . '/styles/normalize.css' );
  wp_enqueue_style( 'bewonder-base-2018-theme-style', get_stylesheet_uri() );
  wp_deregister_script('jquery');
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.min.js' );
  wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js' );
  if( is_front_page() || is_page( '260' ) ) {
    wp_enqueue_script( 'owl-carousel-min-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js' );
    wp_enqueue_style( 'owl-carousel-min-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css' );
  }
  if( is_page( '149' ) ) {
    wp_enqueue_script( 'acf-map-js', get_template_directory_uri() . '/js/acf-map.js' );
  }
  wp_enqueue_script( 'stores-ajax', get_template_directory_uri(). '/js/stores-ajax.js' );
  wp_localize_script( 'stores-ajax', 'storesAjax',	array(
  	'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
}
add_action( 'wp_enqueue_scripts', 'bewonder_base_2018_theme_styles_and_scripts' );

// Enable Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
	acf_add_options_sub_page('General');
	acf_add_options_sub_page('Opening Hours');
}
/**
 * Remove archive title prefixes.
 *
 * @param  string  $title  The archive title from get_the_archive_title();
 * @return string          The cleaned title.
*/
function grd_custom_archive_title( $title ) {
  // Remove any HTML, words, digits, and spaces before the title.
  return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
}
add_filter( 'get_the_archive_title', 'grd_custom_archive_title' );
// Add Google API key to ACF
function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyAObXNwRkMS_Vdb7e0YyIhqKJsGorN5apU');
}
add_action('acf/init', 'my_acf_init');
// Today's Centre opening times
function get_todays_centre_opening_times() {
  reset_rows();
  $currentday = strtolower(date('l'));
	if( have_rows('centre_opening_hours','option') ) :
  	while( have_rows('centre_opening_hours','option') ) : the_row();
    	if( get_sub_field('day') == $currentday ) :
  			$html = get_sub_field('hours');
				return $html;
  		endif;
  	endwhile;
  endif;
}
// Get the Centres Social Media links
function get_social_links() {
	$html = "";
	$social_links = array(
  	"facebook" => get_field('facebook_url','option'),
  	"twitter" => get_field('twitter_url','option'),
  	"instagram" => get_field('instagram_url', 'option')
	);
	foreach($social_links as $key => $value) {
  	if($value):
  		$html .= '<a target="_blank" class="'.$key.'-link" href="'.$value.'">'.ucfirst($key).' Link </a>';
  	endif;
  }
	return $html;
}
// Get the page title for each Archive from Centre Info > Archives
function archive_page_title() {
  $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  reset_rows();
  if( have_rows( 'archive_pages', 'option' ) ) :
    while( have_rows( 'archive_pages', 'option' ) ) : the_row();
      if( get_sub_field( 'archive_name' ) == $url ) :
        return get_sub_field( 'archive_title' );
      endif;
    endwhile;
  else :
    return get_the_archive_title();
  endif;
}
// Get the header image for each Archive from Centre Info > Archives
function archive_page_header_image() {
  $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  reset_rows();
  if( have_rows( 'archive_pages', 'option' ) ) :
    while( have_rows( 'archive_pages', 'option' ) ) : the_row();
      if( get_sub_field( 'archive_name' ) == $url ) :
        return get_sub_field( 'archive_image' )[url];
      endif;
    endwhile;
  else :
    return get_field( 'page_header_image', 'option' )[url];
  endif;
}
// RUBIX FORM (NEWSLETTER) - UPDATE TO CORRECT DETAILS!
function rubiks_form() {
	$acc_name = 'TestArea';
	$list_name = "Adam's Test Contact List";
  $old_date = date('Y-m-d');
  $new_date = date('Y-m-d', strtotime('+1095 days'));
	echo '
	<form id="rubiksForm" action="https://response.pure360.com/interface/list.php" METHOD="post">
  	<input type="hidden" name="accName" VALUE="'.$acc_name.'"/>
  	<input type="hidden" name="listName" VALUE="'.$list_name.'"/>
  	<input type="hidden" name="fullEmailValidationInd" VALUE="Y"/>
  	<input type="hidden" name="doubleOptin" VALUE="false"/>
  	<input type="hidden" name="successUrl" VALUE="'.get_bloginfo( "url" ).'/form-submission-success"/>
  	<input type="hidden" name="errorUrl" VALUE=""/>
    <input type="hidden" name="sign_up_date" value="'.$old_date.'" />
  	<input type="hidden" name="signUpSource" value="Newsletter"/>
    <input type="hidden" name="sign_up_campaign" value="Opted In"/>
    <input type="hidden" name="expiry_date" value="'.$new_date.'"/>
    <div class="field">
      <label>Title</label>
      <select name="title">
        <option name="title" value="Mr">Mr</option>
        <option name="title" value="Mrs">Mrs</option>
        <option name="title" value="Miss" />Miss</option>
        <option name="title" value="Ms.">Ms.</option>
        <option name="title" value="Other"/>Other</option>
      </select>
    </div>
  	<div class="field">
      <label>First Name:</label>
      <input placeholder ="First Name" name="firstName"/>
    </div>
  	<div class="field">
      <label>Last Name:</label>
      <input placeholder="Last Name" name="lastName"/>
    </div>
  	<div class="field">
      <label>Email: </label>
      <input type="email" placeholder="Email" name="email" required />
    </div>
  	<div class="field interests">
    	<label class="title">I AM INTERESTED IN...</label>
    	<input type="checkbox" value="Offers" name="interests[]"/> Offers <br />
    	<input type="checkbox" value="Events" name="interests[]"/> Events <br />
      <input type="checkbox" value="Food and Drink" name="interests[]"/> Food & Drink <br />
      <input type="checkbox" value="Fashion" name="interests[]"/> Fashion <br />
    	<input type="checkbox" value="Kids" name="interests[]"/> Kids <br />
      <input type="checkbox" value="Competitions" name="interests[]"/> Competitions <br />
  	</div>
    <p>Just so you know, we take data protection seriously! We never share your data with third parties and we promise to only send you information on offers, competitions and news relating to [insert centre name].</p>
		<script src="https://www.google.com/recaptcha/api.js"> </script>
		<div class="g-recaptcha" data-sitekey="6Lda1BAUAAAAABeemGvQod8rVNQQUSM2y9pFK_gS"> </div>
  	<input class="button" type="submit" value="Sign up" />
	</form>
	';
}
// Create shortcode for ACF map
function the_map() {
  $html = '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAObXNwRkMS_Vdb7e0YyIhqKJsGorN5apU"></script>';
	$location = get_field( 'centre_location', 'option' );
	if( !empty($location) ):
		$html .= '<section class="acf-map">
		<div class="marker" data-lat="'.$location["lat"].'" data-lng="'.$location['lng'].'"></div>
		</section>';
	endif;
	echo $html;
}
add_shortcode( 'acf-map', 'the_map' );
// Shortcode for Centre Opening Hours */
function centre_opening_hours() {
	$rows = get_field( 'centre_opening_hours', 'option' );
	if( $rows ) :
		$html .= '<table>';
		$html .= '<tbody>';
		foreach( $rows as $row ) {
			$day = ucfirst( $row['day'] );
			$hours = ucfirst( $row['hours'] );
			$html .= '<tr>';
			$html .= '<td class="day">'. $day .'</td><td class="hours">'. $hours .'</td>';
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		if ( get_field( 'center_bank_holiday_opening_hours', 'option' ) ) :
			$html .= '<h3>Bank Holidays:</h3>';
			$html .= '<span>'. get_field( 'center_bank_holiday_opening_hours', 'option' ) .'</span>';
		endif;
	endif;
	return $html;
}
add_shortcode( 'centre-opening-hours', 'centre_opening_hours' );

// Search Stores stores AJAX function
function stores_search() {
	/* get the search terms entered into the search box */
	$search = sanitize_text_field( $_POST[ 'search' ] );
  $ppp = $_POST[ 'ppp' ];
	/* run a new query including the search string */
	$q = new WP_Query(
		array(
			'post_type'  =>  'stores',
			'posts_per_page' =>  $ppp,
			's'  =>  $search
		)
	);
	/* store all returned output in here */
	$output = '';
	/* check whether any search results are found */
	if( $q->have_posts() ) {
  	/* loop through each result */
  	while( $q->have_posts() ) : $q->the_post();
  		/* add result and link to post to output */
      get_template_part( 'template-parts/content', 'stores' );
  	/* end loop */
  	endwhile;
  /* no search results found */
	} else {
  	/* add no results message to output */
  	echo 'There are no stores matching your search.';
	} // end if have posts
	/* reset query */
	wp_reset_query();
	die();
}
add_action( 'wp_ajax_stores_search', 'stores_search' );
add_action( 'wp_ajax_nopriv_stores_search', 'stores_search' );

// Filter stores AJAX function
function filter_stores() {
  $ppp = $_POST[ 'ppp' ];
  $taxonomy = sanitize_text_field( $_POST[ 'taxonomy' ] );
  if( $taxonomy == '0' ) :
    $q = new WP_Query(
  		array(
      	'post_type' => 'stores',
    		'post_status' => 'publish',
    		'orderby' => 'title',
    		'order' => 'ASC',
        'posts_per_page' => $ppp,
  		)
  	);
  else :
    $q = new WP_Query(
  		array(
      	'post_type' => 'stores',
    		'post_status' => 'publish',
    		'orderby' => 'title',
    		'order' => 'ASC',
        'posts_per_page' => '20',
        'tax_query' => array(
          array(
      			'taxonomy' => 'store_categories',
      			'field'    => 'term_id',
      			'terms'    => array( $taxonomy ),
      		),
        ),
  		)
  	);
  endif;
	/* store all returned output in here */
	$output = '';
	/* check whether any search results are found */
	if( $q->have_posts() ) {
  	/* loop through each result */
  	while( $q->have_posts() ) : $q->the_post();
  		/* add result and link to post to output */
      get_template_part( 'template-parts/content', 'stores' );
  	/* end loop */
  	endwhile;
  /* no search results found */
	} else {
  	/* add no results message to output */
  	echo 'There are no stores in this category.';
	} // end if have posts
	/* reset query */
	wp_reset_query();
	die();

}
add_action( 'wp_ajax_filter_stores', 'filter_stores' );
add_action( 'wp_ajax_nopriv_filter_stores', 'filter_stores' );
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5b100d8ea06fb',
	'title' => 'Rubix Event Form',
	'fields' => array(
		array(
			'key' => 'field_5b100d970275e',
			'label' => 'Account Name',
			'name' => 'account_name',
			'type' => 'text',
			'instructions' => 'This must be identical to the Account Name in Rubix.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b100d9e0275f',
			'label' => 'List Name',
			'name' => 'list_name',
			'type' => 'text',
			'instructions' => 'This must be identical to the List Name in Rubix.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b100dd802760',
			'label' => 'Opt In Text',
			'name' => 'opt_in_text',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Please tick this box if you wish to receive information on offers, competitions and news relating to [INSERT CENTRE NAME]. We do not share your information with third parties.',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_5b111ad0c47c6',
			'label' => 'Form Submission Success Page',
			'name' => 'form_submission_success_page',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5b100f5f6c8ee',
			'label' => 'Additional Fields',
			'name' => 'additional_fields',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 4,
			'layout' => 'block',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_5b100f8e6c8ef',
					'label' => 'Type of Field',
					'name' => 'type_of_field',
					'type' => 'radio',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'Text' => 'Text',
						'Textarea' => 'Textarea',
						'Checkbox' => 'Checkbox',
						'Radio Button' => 'Radio Button',
					),
					'allow_null' => 0,
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'vertical',
					'return_format' => 'value',
				),
				array(
					'key' => 'field_5b1010066c8f0',
					'label' => 'Field Label',
					'name' => 'field_label',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5b10151b62fa2',
					'label' => 'Options',
					'name' => 'options',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5b100f8e6c8ef',
								'operator' => '==',
								'value' => 'Checkbox',
							),
						),
						array(
							array(
								'field' => 'field_5b100f8e6c8ef',
								'operator' => '==',
								'value' => 'Radio Button',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'table',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5b10155d62fa5',
							'label' => 'Option Label',
							'name' => 'option_label',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
					),
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-rubix-event-form.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
endif;
