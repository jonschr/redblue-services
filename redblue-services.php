<?php
/*
	Plugin Name: Red Blue Services
	Plugin URI: http://redblue.us
	Description: Just another services plugin.
	Version: 1.1
    Author: Jon Schroeder
    Author URI: http://redblue.us

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/

// Plugin directory 
define( 'RB_SERVICES_DIR', dirname( __FILE__ ) );

//* Register the post type
include_once( 'lib/post_type.php' );

/**
 * Adds new partner image size if not already set in child theme
 */
add_action( 'after_setup_theme', 'redblue_services_after_setup_theme' );
function redblue_services_after_setup_theme(){

    global $_wp_additional_image_sizes;

    if ( ! isset( $_wp_additional_image_sizes[ 'service-image' ] ) ) {
        add_image_size( 'service-small', 300, 150, true );
    }

}

//* Register the sidebars
add_action( 'widgets_init', 'redblue_services_register_sidebars' );
function redblue_services_register_sidebars() {
    genesis_register_sidebar( array(
        'id'            => 'services-single',
        'name'          => 'Services',
        'description'   => 'A sidebar for individual services',
    ) );
}

/**
 * Assign the sidebars
 */
add_action( 'genesis_header','redblue_services_change_genesis_sidebar' );
function redblue_services_change_genesis_sidebar() {
    
    global $post; 
    if ( is_singular( 'services' ) ) {
        remove_action( 'genesis_sidebar', 'genesis_do_sidebar');
        remove_action( 'genesis_sidebar', 'gencwooc_ss_do_sidebar' );
        remove_action( 'genesis_sidebar', 'ss_do_sidebar' );
        add_action( 'genesis_sidebar', 'redblue_services_do_single_sidebar' );
    }
}

//* Output the single sidebar
function redblue_services_do_single_sidebar() {
    dynamic_sidebar( 'services-single' );
}

//* Add subtitles (requires the WP Subtitle plugin)
function redblue_services_add_subtitles() {
    add_post_type_support( 'services', 'wps_subtitle' );
}
add_action( 'init', 'redblue_services_add_subtitles' );

//* Add a custom taxonomy
// include_once( 'lib/taxonomy.php' );