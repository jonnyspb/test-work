<?php
/**
 * Plugin Name: Table of Users
 * Description: The test work.
 * Version: 1.0.
 * Author: Evgenii Pankov
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'br_add_scripts' );
function br_add_scripts() {
	wp_enqueue_style( 'style', plugins_url('assets/css/style.css',__FILE__ ) );
	wp_enqueue_script( 'table-users-script', plugins_url('assets/js/script.js',__FILE__ ) , array('jquery'), '1.0', true );
}

add_action('wp_ajax_users_table_ajax', 'users_table_ajax_callback');
function users_table_ajax_callback()
{
	check_ajax_referer( 'myajax-nonce', 'nonce_code' );
	load_template( dirname( __FILE__ ) . '/templates/table-content-template.php' );
	wp_die();
}

function br_shortcode_table_users() {
	if ( ! current_user_can('manage_options') ) return;
	ob_start();
	load_template( dirname( __FILE__ ) . '/templates/table-header-template.php' );
	return ob_get_clean();
}
add_shortcode('table_users', 'br_shortcode_table_users' );

add_action( 'wp_enqueue_scripts', 'br_add_ajax_data', 99 );
function br_add_ajax_data(){
	$vars = array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('myajax-nonce')
	);
	wp_localize_script('table-users-script', 'ajax_front', $vars);
}