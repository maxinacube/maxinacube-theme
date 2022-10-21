<?php
/**
 * Maxinacube Custom Post Types
 *
 * @author  maxinacube
 * @package Maxinacube
 */

namespace Maxinacube;

class CPT {
	/**
	 * Set up custom post types
	 *
	 * @return void
	 */
	
	public function __construct() {
		add_action( 'init',  [ $this, 'register_project_cpt' ] );
	}
	
	/**
	 * Register custom post type for project
	 */
	function register_project_cpt() {
		$labels = [
			'name'                  => _x( 'Projects', 'Post type general name', 'maxinacube' ),
			'singular_name'         => _x( 'Project', 'Post type singular name', 'maxinacube' ),
			'menu_name'             => _x( 'Projects', 'Admin Menu text', 'maxinacube' ),
			'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'maxinacube' ),
			'add_new'               => __( 'Add New', 'maxinacube' ),
			'add_new_item'          => __( 'Add New Project', 'maxinacube' ),
			'new_item'              => __( 'New Project', 'maxinacube' ),
			'edit_item'             => __( 'Edit Project', 'maxinacube' ),
			'view_item'             => __( 'View Project', 'maxinacube' ),
			'all_items'             => __( 'All Projects', 'maxinacube' ),
			'search_items'          => __( 'Search Projects', 'maxinacube' ),
			'parent_item_colon'     => __( 'Parent Projects:', 'maxinacube' ),
			'not_found'             => __( 'No projects found.', 'maxinacube' ),
			'not_found_in_trash'    => __( 'No projects found in Trash.', 'maxinacube' ),
			'archives'              => _x( 'Project archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'maxinacube' ),
			'filter_items_list'     => _x( 'Filter projects list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'maxinacube' ),
			'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'maxinacube' ),
			'items_list'            => _x( 'Projects list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'maxinacube' ),
		];
	
		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'project' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
			'show_in_rest'       => true,
		];
	
		register_post_type( 'project', $args );
	}
}