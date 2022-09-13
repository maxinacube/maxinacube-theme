<?php
/**
 * Maxinacube
 *
 * @author  maxinacube
 * @package Maxinacube
 */

namespace Maxinacube\Core;

/**
 * Set up theme defaults and register supported WordPress features.
 *
 * @return void
 */

function setup() {
    $n = function ($function) {
        return __NAMESPACE__ . "\\$function";
    };

	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_action( 'wp_enqueue_scripts', $n( 'scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'styles' ) );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function theme_setup() {
    add_theme_support('post-thumbnails');
    
    register_nav_menus(
        [
            'primary_menu'  => esc_html__('Primary Menu', 'fluval'),
        ]
    );

    //add_image_size('menu-image', 600, 220);
    //add_image_size('slider-image', 600, 300, true);
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
    wp_enqueue_style( 'maxinacube-css', get_stylesheet_directory_uri() . '/css/maxinacube.css', [], MAXINACUBE_VERSION );
}