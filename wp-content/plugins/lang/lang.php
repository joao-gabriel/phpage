<?php
/*
Plugin Name: Lang
Plugin URI: http://www.phpage.com.br/
Description: A very simple multi-language support plugin. Even the name is lazy.
Version: 0.0.1
Author: João Gabriel N. Vieira
Author URI: http://www.phpage.com.br/sobre-o-autor
*/

// Register Custom Taxonomy
function setup_plugin() {

	$labels = array(
		'name'                       => _x( 'Languages ', 'Taxonomy General Name', 'phpage' ),
		'singular_name'              => _x( 'Language', 'Taxonomy Singular Name', 'phpage' ),
		'menu_name'                  => __( 'Language', 'phpage' ),
		'all_items'                  => __( 'All Languages', 'phpage' ),
		'parent_item'                => __( 'Parent Language', 'phpage' ),
		'parent_item_colon'          => __( 'Parent Language:', 'phpage' ),
		'new_item_name'              => __( 'New Language Name', 'phpage' ),
		'add_new_item'               => __( 'Add New Language', 'phpage' ),
		'edit_item'                  => __( 'Edit Language', 'phpage' ),
		'update_item'                => __( 'Update Language', 'phpage' ),
		'view_item'                  => __( 'View Language', 'phpage' ),
		'separate_items_with_commas' => __( 'Separate Languages with commas', 'phpage' ),
		'add_or_remove_items'        => __( 'Add or remove Languages', 'phpage' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'phpage' ),
		'popular_items'              => __( 'Popular Languages', 'phpage' ),
		'search_items'               => __( 'Search Languages', 'phpage' ),
		'not_found'                  => __( 'Not Found', 'phpage' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'language', array( 'post', ' page' ), $args );

  register_nav_menu( 'languages', __('Languages') );

  wp_register_script('lang_script', plugins_url() . '/lang/js/lang.js', array('jquery'), '2323', TRUE);
	wp_enqueue_script('lang_script');


}
add_action( 'init', 'setup_plugin', 0 );
