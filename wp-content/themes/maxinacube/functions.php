<?php
/**
 * WP Theme constants and setup functions
 *
 * @package MaxinacubeTheme
 */

use MaxinacubeTheme\App;

// Useful global constants.
define( 'MAXINCUBE_THEME_VERSION', '0.1.0' );
define( 'MAXINCUBE_THEME_TEMPLATE_URL', get_template_directory_uri() );
define( 'MAXINCUBE_THEME_PATH', get_template_directory() . '/' );
define( 'MAXINCUBE_THEME_DIST_PATH', MAXINCUBE_THEME_PATH . 'dist/' );
define( 'MAXINCUBE_THEME_DIST_URL', MAXINCUBE_THEME_TEMPLATE_URL . '/dist/' );
define( 'MAXINCUBE_THEME_INC', MAXINCUBE_THEME_PATH . 'includes/' );
define( 'MAXINCUBE_THEME_BLOCK_DIR', MAXINCUBE_THEME_INC . 'blocks/' );
define( 'MAXINCUBE_THEME_BLOCK_DIST_DIR', MAXINCUBE_THEME_PATH . 'dist/blocks/' );

$is_local_env = in_array( wp_get_environment_type(), [ 'local', 'development' ], true );
$is_local_url = strpos( home_url(), '.test' ) || strpos( home_url(), '.local' );
$is_local     = $is_local_env || $is_local_url;

if ( $is_local && file_exists( __DIR__ . '/dist/fast-refresh.php' ) ) {
	require_once __DIR__ . '/dist/fast-refresh.php';
	TenUpToolkit\set_dist_url_path( basename( __DIR__ ), MAXINCUBE_THEME_DIST_URL, MAXINCUBE_THEME_DIST_PATH );
}

require_once MAXINCUBE_THEME_INC . 'core.php';
require_once MAXINCUBE_THEME_INC . 'overrides.php';
require_once MAXINCUBE_THEME_INC . 'template-tags.php';
require_once MAXINCUBE_THEME_INC . 'utility.php';
require_once MAXINCUBE_THEME_INC . 'blocks.php';
require_once MAXINCUBE_THEME_INC . 'helpers.php';

// Run the setup functions.
MaxinacubeTheme\Core\setup();
MaxinacubeTheme\Blocks\setup();

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
	new App();
} else {
	/** @noinspection ForgottenDebugOutputInspection */ // phpcs:ignore
	wp_die( 'You must install Composer packages before running this theme.' );
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for the new wp_body_open() function that was added in 5.2
	 */
	function wp_body_open(): void {
		do_action( 'wp_body_open' );
	}
}
