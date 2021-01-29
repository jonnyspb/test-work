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
	wp_enqueue_script( 'table-users-script', plugins_url('assets/js/script.js',__FILE__ ) , array(), '1.0', true );
}

add_action('wp_ajax_users_table_ajax', 'users_table_ajax_callback');
add_action('wp_ajax_nopriv_users_table_ajax', 'users_table_ajax_callback');
function users_table_ajax_callback()
{
	set_query_var('page', $_POST['page'] );
	set_query_var('order', $_POST['order'] );
	set_query_var('orderby', $_POST['orderby'] );
	load_template( dirname( __FILE__ ) . '/templates/table-users-template.php' );
	wp_die();
}

function br_shortcode_table_users() {
	if ( ! current_user_can('manage_options') ) return;
	$users = count_users();
	$active_role = $users['avail_roles'];
	?>
    <section class="content--section">
        <div class="section--header">
            <div class="section--title">
                <h2>Table of Users</h2>
            </div>
            <div class="section--controls">
                <div class="section--controls_name">
                    Filter by Role
                </div>
                <select name="select" id="table_filter_role">
                    <option value="">All</option>
			        <?php
			        foreach ( $active_role as $role => $value) {
				        if ( $role == 'none' ) continue;
				        echo '<option value="' . $role . '">'. $role.'</option>';
			        }
			        ?>
                </select>
            </div>
        </div>
        <div class="section--body">
            <div class="section--table" id="users_table" data-sortby="display_name">
                <div class="section--table_header">
                    <div class="section--table_row">
                        <div class="section--table_col icon--sort active" data-orderby="display_name" data-order="ASC" >
                            <div class="section--col_title">Display Name</div>
                            <div class="section--col_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="section--table_col icon--sort" data-orderby="email" data-order="ASC">
                            <div class="section--col_title">Email</div>
                            <div class="section--col_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="section--table_col">
                            <div class="section--col_title">Role</div>
                        </div>
                    </div>
                </div>
                <div class="section--table_body">
                    <?php load_template( dirname( __FILE__ ) . '/templates/table-users-template.php' ); ?>
                </div>
            </div>
        </div>
        <div class="section--footer">
            <span>*Information reference to go here</span>
        </div>
    </section>
    <?php
}
add_shortcode('table_users', 'br_shortcode_table_users' );

add_action( 'wp_enqueue_scripts', 'br_add_ajax_data', 99 );
function br_add_ajax_data(){
	$vars = array(
		'url' => admin_url('admin-ajax.php'),
	);
	wp_localize_script('table-users-script', 'ajax_front', $vars);
}