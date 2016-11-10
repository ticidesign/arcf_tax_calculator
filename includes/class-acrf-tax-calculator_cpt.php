<?php

// Creating and register a WordPress custom post type.
function register_acrf_tax_calculator() {
	
	$singular = 'Tax Calculator';
	$plural = 'Taxes Calculator';
	$slug = str_replace( ' ', '-', strtolower( $singular ) );	
	$labels = array(
		'name' 						=> $plural,
		'singular_name' 			=> $singular,
		'add_new' 					=> 'Add New',
		'add_new_item'  			=> 'Add New ' . $singular,
		'edit'		       		 	=> 'Edit',
		'edit_item'	     		 	=> 'Edit ' . $singular,
		'new_item'	     		 	=> 'New ' . $singular,
		'view' 						=> 'View ' . $singular,
		'view_item' 				=> 'View ' . $singular,
		'search_term'   			=> 'Search ' . $plural,
		'parent' 					=> 'Parent ' . $singular,
		'not_found' 				=> 'No ' . $plural .' found',
		'not_found_in_trash' 		=> 'No ' . $plural .' in Trash'
		);	
	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'delete_with_user'    => false,
		'hierarchical'        => false,
		'has_archive'         => true,
		'query_var'           => true,
		'capability_type'     => 'page',
		'map_meta_cap'        => true,
		// 'capabilities' => array(),
		'rewrite'       	=> array( 
			'slug' 			=> $slug,
			'with_front' 	=> true,
			'pages' 		=> true,
			'feeds' 		=> false,
		),
		'supports'			=> array( 
			'title', 
			'editor'
		)
	);
	register_post_type( $slug, $args );
}
add_action( 'init', 'register_acrf_tax_calculator' );

// Creating Annual Income taxonomy for Tax Calculator.
function acrf_tax_calculator_income() {

	$singular = 'Annual Income';
	$plural = 'Annual Income';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );
	$labels = array(
		'name'                       	=> $plural,
		'singular_name'             	=> $singular,
		'search_items'              	=> 'Search ' . $plural,
		'popular_items'             	=> 'Popular ' . $plural,
		'all_items'                 	=> 'All ' . $plural,
		'parent_item'               	=> null,
		'parent_item_colon'         	=> null,
		'edit_item'                 	=> 'Edit ' . $singular,
		'update_item'               	=> 'Update ' . $singular,
		'add_new_item'              	=> 'Add New ' . $singular,
		'new_item_name'             	=> 'New ' . $singular . ' Name',
		'separate_items_with_commas'	=> 'Separate ' . $plural . ' with commas',
		'add_or_remove_items'       	=> 'Add or remove ' . $plural,
		'choose_from_most_used'     	=> 'Choose from the most used ' . $plural,
		'not_found'                 	=> 'No ' . $plural . ' found.',
		'menu_name'                 	=> $plural,
	);
	$args = array(
	  'hierarchical'          => true,
	  'labels'                => $labels,
	  'show_ui'               => true,
	  'show_admin_column'     => true,
	  'update_count_callback' => '_update_post_term_count',
	  'query_var'             => true,
	  'rewrite'               => array( 'slug' => $slug ),
	);
	register_taxonomy( $slug, 'tax_calculator', $args );
}
add_action( 'init', 'acrf_tax_calculator_income' );

// Creating Your Donation taxonomy for Tax Calculator.
function acrf_tax_calculator_donation() {

	$singular = 'Your Donation';
	$plural = 'Your Donation';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );
	$labels = array(
	'name'                       	=> $plural,
    'singular_name'             	=> $singular,
    'search_items'              	=> 'Search ' . $plural,
    'popular_items'             	=> 'Popular ' . $plural,
    'all_items'                 	=> 'All ' . $plural,
    'parent_item'               	=> null,
    'parent_item_colon'         	=> null,
    'edit_item'                 	=> 'Edit ' . $singular,
    'update_item'               	=> 'Update ' . $singular,
    'add_new_item'              	=> 'Add New ' . $singular,
    'new_item_name'             	=> 'New ' . $singular . ' Name',
    'separate_items_with_commas'	=> 'Separate ' . $plural . ' with commas',
    'add_or_remove_items'       	=> 'Add or remove ' . $plural,
    'choose_from_most_used'     	=> 'Choose from the most used ' . $plural,
    'not_found'                 	=> 'No ' . $plural . ' found.',
    'menu_name'                 	=> $plural,
	);
	$args = array(
	  'hierarchical'          => true,
	  'labels'                => $labels,
	  'show_ui'               => true,
	  'show_admin_column'     => true,
	  'update_count_callback' => '_update_post_term_count',
	  'query_var'             => true,
	  'rewrite'               => array( 'slug' => $slug ),
	);
	register_taxonomy( $slug, 'tax_calculator', $args );
}
add_action( 'init', 'acrf_tax_calculator_donation' );


// Creating Shortcode to add Tax Calculator in any page.
function acrf_tax_calculator_shortcode( $atts, $content = null ) {
	
	global $tax_data;
	$tax_data = shortcode_atts( array(

		'title' => 'This end of financial year discover the true value of your donation.',
		'subtitle' => 'Calculate the true value of your tax deductible donation and be the one to end cancer. Select from below:',

	), $atts );

	ob_start(); // begin output buffering
    $html = require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/acrf-tax-calculator-public-display.php';
    printf( $html);
    $output = ob_get_contents(); // end output buffering
    ob_end_clean(); // grab the buffer contents and empty the buffer
    return $output;

}
add_shortcode( 'tax_calculator_shortcode', 'acrf_tax_calculator_shortcode' );
