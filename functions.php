<?php

define( 'MAXINACUBE_VERSION', '1.0.0' );
define( 'MAXINACUBE_FILE', get_stylesheet() );
define( 'MAXINACUBE_NAME', esc_html__( 'Maxinacube', 'maxinacube' ) );
define( 'MAXINACUBE_URL', get_stylesheet_directory_uri() );
define( 'MAXINACUBE_PATH', get_stylesheet_directory() );

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
    define( 'SCRIPT_DEBUG', true ); // enable script debug by default
}

require_once 'includes/maxinacube.php';

// Kick everything off when plugins are loaded.
try {
    Maxinacube\Core\setup();
} catch ( Exception $e ) {
	wp_die( esc_html( $e->getMessage() ) );
}
