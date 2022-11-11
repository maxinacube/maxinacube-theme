<?php

define( 'MAXINACUBE_VERSION', '1.0.1' );
define( 'MAXINACUBE_FILE', get_stylesheet() );
define( 'MAXINACUBE_NAME', esc_html__( 'Maxinacube', 'maxinacube' ) );
define( 'MAXINACUBE_URL', get_stylesheet_directory_uri() );
define( 'MAXINACUBE_PATH', get_stylesheet_directory() );

if ( ! defined( 'SCRIPT_DEBUG' ) ) {
    define( 'SCRIPT_DEBUG', true ); // enable script debug by default
}

require_once 'includes/maxinacube.php';
require_once 'includes/maxinacube.cpt.php';
require_once 'includes/maxinacube.blocks.php';
require_once 'includes/maxinacube.utils.php';

$core = new Maxinacube();
$cpt = new \Maxinacube\CPT();
$blocks = new \Maxinacube\Blocks();