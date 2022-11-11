<?php
/**
 * Maxinacube
 *
 * @author  maxinacube
 * @package Maxinacube
 */

class Maxinacube {
	/**
	 * Set up theme defaults and register supported WordPress features.
	 *
	 * @return void
	 */
	
	public function __construct() {
		add_filter( 'upload_mimes',       [ $this, 'upload_mimes' ] );
		add_action( 'after_setup_theme',  [ $this, 'theme_setup' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'styles' ] );
		add_action( 'admin_init',         [ $this, 'admin_styles' ] );
	}

	function upload_mimes( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	  }

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function theme_setup() {
		add_theme_support('post-thumbnails');
		add_theme_support('editor-styles');
		add_theme_support('title-tag');
		
		register_nav_menus(
			[
				'primary_menu'  => esc_html__( 'Primary Menu', 'maxinacube' ),
				'social_menu'   => esc_html__( 'Social Menu', 'maxinacube' )
			]
		);
	}
	
	/**
	 * Enqueue scripts for front-end.
	 *
	 * @return void
	 */
	function scripts() {
		wp_enqueue_script( 'maxinacube-js', get_stylesheet_directory_uri() . '/js/maxinacube.js', [ 'jquery' ], MAXINACUBE_VERSION, true );
	}
	
	/**
	 * Enqueue styles for front-end.
	 *
	 * @return void
	 */
	function styles() {
		wp_enqueue_style( 'font-open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap' );
		wp_enqueue_style( 'maxinacube-css', get_stylesheet_directory_uri() . '/css/maxinacube.css', [ 'font-open-sans' ], MAXINACUBE_VERSION );
	}
	
	/**
	 * Enqueue styles for the admin
	 * 
	 * @return void
	 */
	function admin_styles() {
		add_editor_style( 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap' );
		add_editor_style( 'css/maxinacube.css' );
	}
}