<?php

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function rb_services_register_post_types() {

	$labels = array(
		'name'                => __( 'Services', 'redblue-services' ),
		'singular_name'       => __( 'Service', 'redblue-services' ),
		'add_new'             => _x( 'Add New Service', 'redblue-services', 'redblue-services' ),
		'add_new_item'        => __( 'Add New Service', 'redblue-services' ),
		'edit_item'           => __( 'Edit Service', 'redblue-services' ),
		'new_item'            => __( 'New Service', 'redblue-services' ),
		'view_item'           => __( 'View Service', 'redblue-services' ),
		'search_items'        => __( 'Search Services', 'redblue-services' ),
		'not_found'           => __( 'No Services found', 'redblue-services' ),
		'not_found_in_trash'  => __( 'No Services found in Trash', 'redblue-services' ),
		'parent_item_colon'   => __( 'Parent Service:', 'redblue-services' ),
		'menu_name'           => __( 'Services', 'redblue-services' ),
	);

	$args = array(
		'labels'                   => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'   => 'dashicons-clipboard',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title', 'editor', 'thumbnail', 'excerpt', 'genesis-cpt-archives-settings',
		)
	);

	register_post_type( 'services', $args );

}

add_action( 'init', 'rb_services_register_post_types' );
