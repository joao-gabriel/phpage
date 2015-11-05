<?php

add_theme_support('post-thumbnails');

function register_my_menu() {
  register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');

function my_script_enqueuer() {
  wp_register_script('my_script', get_stylesheet_directory_uri() . '/js/custom.scripts.js', array('jquery'), '2323', TRUE);
  wp_register_script('bootstrap.min', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), NULL, TRUE);
  wp_register_script('ie10-workaround', get_stylesheet_directory_uri() . '/js/ie10-viewport-bug-workaround.js', array('jquery'), NULL, TRUE);

  wp_localize_script('my_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap.min');
  wp_enqueue_script('ie10-workaround');
  wp_enqueue_script('my_script');

	wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', false, false, 'all' );
	wp_register_style( 'blog', get_stylesheet_directory_uri() . '/css/blog.css', false, false, 'all' );
	wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css', false, false, 'all' );

	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'blog' );
	wp_enqueue_style( 'style' );

}

add_action('init', 'my_script_enqueuer');


load_theme_textdomain('phpage', get_template_directory() . '/languages');
