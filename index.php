<?php
/*
Plugin Name: Rentit
Plugin URI: 
Description:
Version: 1.8
Author: Victor Lerner
Author URI:
Text Domain: rentit
Domain Path: /languages
License: 
*/



$locale = apply_filters( 'plugin_locale', get_locale(), 'rentit' );
load_textdomain( 'rentit', WP_LANG_DIR . '/rentit/rentit-' . $locale . '.mo' );
load_plugin_textdomain( 'rentit', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );


register_activation_hook( __FILE__, 'rentit_rentit_inslall' );

if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	require plugin_dir_path( __FILE__ ) . '/shortcodes/shortcodes.php';
	require plugin_dir_path( __FILE__ ) . '/VC_custum-data.php';
}

require plugin_dir_path( __FILE__ ) . '/import_demo.php';
require plugin_dir_path( __FILE__ ) . '/auth.php';
require plugin_dir_path( __FILE__ ) . '/register_auth.php';
require plugin_dir_path( __FILE__ ) . '/wc_CustomData.php';


/**
 *Create the desired tables for theme
 */
function rentit_rentit_inslall() {
	global $wpdb;


	$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}rentit_booking`  (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `product_id` int(11) NOT NULL,
              `order_id` int(11) NOT NULL,
              `dropin_date` int(11) NOT NULL,
              `dropoff_date` int(11) NOT NULL,
			  `status` int(11) NOT NULL,
			  `user_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$q = rentit_q( $sql );


	$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}follow` (
              `user1` int(11) NOT NULL,
              `user2` int(11) NOT NULL,
              `dataadd` int(11) NOT NULL,
              KEY `user1` (`user1`),
              KEY `user2` (`user2`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	$q = rentit_q( $sql );

}

function rentit_q( $sql ) {
	global $wpdb;
	$wpdb->hide_errors();
	return $wpdb->query( $sql );
}


add_action( 'init', 'rentit_portfolio_init' );
/**
 * great portfolio custom type post
 */
function rentit_portfolio_init() {
	$args = array(
		'label' => esc_html__( 'Events', 'rentit' ),
		'labels' => array(
			'edit_item' => esc_html__( 'Edit', 'rentit' ),
			'add_new_item' => esc_html__( 'Add', 'rentit' ),
			'view_item' => esc_html__( 'View', 'rentit' ),
		),
		'singular_label' => esc_html__( 'Event', 'rentit' ),
		'has_archive' => true,
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon' => 'dashicons-groups'
	);

	$args['label'] = esc_html__( 'portfolio', 'rentit' );
	$args['singular_label'] = esc_html__( 'Item', 'rentit' );
	register_post_type( 'portfolio', $args );
	register_taxonomy(
		'portfolio_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'portfolio',         //post type name
		array(
			'hierarchical' => true,
			'label' => esc_html__( 'Category', 'rentit' ),  //Display name
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio' )

		)
	);

}


/**
 * Post type definition
 * @package Rent It
 * @since Rent It 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'rentit_Register_Post_Type' ) ) :

	class rentit_Register_Post_Type {


		function __construct() {
			add_action( 'init', array( $this, 'rentit_register_post_type' ), 7 );
		}


		public function rentit_register_post_type() {

			/*register_post_type( 'rental_resource',
				apply_filters( 'rentit_register_post_type_rental_resource',
					array(
						'labels' => array(
							'name' => esc_html__( 'Resources', 'rentit' ),
							'singular_name' => esc_html__( 'Resource', 'rentit' ),
							'menu_name' => esc_html_x( 'Resources', 'Admin menu name', 'rentit' ),
							'add_new' => esc_html__( 'Add Resource', 'rentit' ),
							'add_new_item' => esc_html__( 'Add New Resource', 'rentit' ),
							'edit' => esc_html__( 'Edit', 'rentit' ),
							'edit_item' => esc_html__( 'Edit Resource', 'rentit' ),
							'new_item' => esc_html__( 'New Resource', 'rentit' ),
							'view' => esc_html__( 'View Resource', 'rentit' ),
							'view_item' => esc_html__( 'View Resource', 'rentit' ),
							'search_items' => esc_html__( 'Search Resources', 'rentit' ),
							'not_found' => esc_html__( 'No Resources found', 'rentit' ),
							'not_found_in_trash' => esc_html__( 'No Resources found in trash', 'rentit' ),
							'parent' => esc_html__( 'Parent Resource', 'rentit' ),
							'featured_image' => esc_html__( 'Resource Image', 'rentit' ),
							'set_featured_image' => esc_html__( 'Set product image', 'rentit' ),
							'remove_featured_image' => esc_html__( 'Remove product image', 'rentit' ),
							'use_featured_image' => esc_html__( 'Use as product image', 'rentit' ),
						),
						'description' => esc_html__( 'This is where you can add new resources to your car rental.', 'rentit' ),
						'public' => true,
						'show_ui' => true,
						'map_meta_cap' => true,
						'publicly_queryable' => true,
						'exclude_from_search' => false,
						'hierarchical' => false, // Hierarchical causes memory issues - WP loads all records!
						'query_var' => true,
						'supports' => array(
							'title'
						),
						'show_in_nav_menus' => true
					)
				)
			);
*/
			register_post_type( 'rental_location',
				apply_filters( 'rentit_register_post_type_rental_location',
					array(
						'labels' => array(
							'name' => esc_html__( 'Locations', 'rentit' ),
							'singular_name' => esc_html__( 'Location', 'rentit' ),
							'menu_name' => esc_html_x( 'Locations', 'Admin menu name', 'rentit' ),
							'add_new' => esc_html__( 'Add Location', 'rentit' ),
							'add_new_item' => esc_html__( 'Add New Location', 'rentit' ),
							'edit' => esc_html__( 'Edit', 'rentit' ),
							'edit_item' => esc_html__( 'Edit Location', 'rentit' ),
							'new_item' => esc_html__( 'New Location', 'rentit' ),
							'view' => esc_html__( 'View Location', 'rentit' ),
							'view_item' => esc_html__( 'View Location', 'rentit' ),
							'search_items' => esc_html__( 'Search Locations', 'rentit' ),
							'not_found' => esc_html__( 'No Locations found', 'rentit' ),
							'not_found_in_trash' => esc_html__( 'No Locations found in trash', 'rentit' ),
							'parent' => esc_html__( 'Parent Location', 'rentit' ),
							'featured_image' => esc_html__( 'Location Image', 'rentit' ),
							'set_featured_image' => esc_html__( 'Set product image', 'rentit' ),
							'remove_featured_image' => esc_html__( 'Remove product image', 'rentit' ),
							'use_featured_image' => esc_html__( 'Use as product image', 'rentit' ),
						),
						'description' => esc_html__( 'This is where you can add new locations to your car rental coverage.', 'rentit' ),
						'public' => true,
						'show_ui' => true,
						'map_meta_cap' => true,
						'publicly_queryable' => true,
						'exclude_from_search' => false,
						'hierarchical' => false, // Hierarchical causes memory issues - WP loads all records!
						'query_var' => true,
						'supports' => array(
							'title'
						),
						'show_in_nav_menus' => true
					)
				)
			);


		}


	}

endif;

new rentit_Register_Post_Type();


function rentit_car_group_taxonomy() {

	register_taxonomy( 'product_group',
		apply_filters( 'rentit_rentit_taxonomy_objects_product_group', array( 'product' ) ),
		apply_filters( 'rentit_rentit_taxonomy_args_product_group', array(
			'hierarchical' => true,
			'update_count_callback' => '_wc_term_recount',
			'label' => esc_html__( 'Product Group', 'rentit' ),
			'labels' => array(
				'name' => esc_html__( 'Product Groups', 'rentit' ),
				'singular_name' => esc_html__( 'Product Group', 'rentit' ),
				'menu_name' => esc_html_x( 'Groups', 'Admin menu name', 'rentit' ),
				'search_items' => esc_html__( 'Search Product Groups', 'rentit' ),
				'all_items' => esc_html__( 'All Product Groups', 'rentit' ),
				'parent_item' => esc_html__( 'Parent Product Group', 'rentit' ),
				'parent_item_colon' => esc_html__( 'Parent Product Category:', 'rentit' ),
				'edit_item' => esc_html__( 'Edit Product Group', 'rentit' ),
				'update_item' => esc_html__( 'Update Product Group', 'rentit' ),
				'add_new_item' => esc_html__( 'Add New Product Group', 'rentit' ),
				'new_item_name' => esc_html__( 'New Product Category Name', 'rentit' )
			),
			'show_ui' => true,
			'query_var' => true,
			'capabilities' => array(
				'manage_terms' => 'manage_product_terms',
				'edit_terms' => 'edit_product_terms',
				'delete_terms' => 'delete_product_terms',
				'assign_terms' => 'assign_product_terms',
			),
			'rewrite' => array(
				'slug' => empty( $permalinks['product_group_base'] ) ? esc_html_x( 'product-group', 'slug', 'rentit' ) : $permalinks['product_group_base'],
				'with_front' => false,
				'hierarchical' => true,
			),
		) )
	);
	register_taxonomy_for_object_type( 'product_group', 'product' );

}


add_action( 'init', 'rentit_car_group_taxonomy' );


function rentit_base_encode( $str ) {
	return base64_encode( $str );
}



add_filter( 'wc_add_to_cart_message_html', 'rentit_wc_add_to_cart_message', 2, 10 );

/**
 * new message to add order
 * @param $message
 * @param $product_id
 * @return string
 */
function rentit_wc_add_to_cart_message( $message, $product_id ) {
	$id = 0;
	if ( is_array( $product_id ) ) {
		foreach ( $product_id as $k => $v ) {
			$id = $k;

		}
	} else {
		$id  = $product_id;
	}
	$titles = get_the_title( $id );
	$added_text = esc_html__( 'You have chosen ', 'rentit' );
	$added_text .= $titles;
	$added_text .= esc_html__( ', Please proceed to, ', 'rentit' );
	$added_text .= '<a href="' . esc_url( wc_get_page_permalink( 'checkout' ) ) . '" class="button wc-forward">' . esc_html__( 'checkout', 'rentit' ) . '</a>';
	$added_text .= esc_html__( ' to confirm your booking', 'rentit' );
	return $added_text;
}

/*
 * Redirect to checkout after add to cart
 */

function rentit_custom_add_to_cart_redirect( $url ) {
	$url = WC()->cart->get_checkout_url();
	// $url = wc_get_checkout_url(); // since WC 2.5.0
	return $url;
}

add_filter( 'rentit_add_to_cart_redirect', 'rentit_custom_add_to_cart_redirect' );


add_filter( 'rentit_add_cart_item_data', 'rentit_wdm_empty_cart', 10, 3 );
/**
 * @param $cart_item_data
 * @param $product_id
 * @param $variation_id
 * @return mixed
 */
function rentit_wdm_empty_cart( $cart_item_data, $product_id, $variation_id ) {
	global $rentit;
	$rentit->cart->empty_cart();
// Do nothing with the data and return
	return $cart_item_data;
}

/*
add_action( 'save_post', 'kons_save_metabox', 9999 );


function kons_save_metabox( $post_id ) {


	ob_start();


	//var_dump( media_handle_upload( $_FILES['fa_icon_image'], 1 ) );
	echo '====================22222= ';

	var_dump( $_POST );
	//var_dump( $_FILES );
	error_log( ob_get_clean(), 3, plugin_dir_path( __FILE__ ) . 'log.log' );

}
*/