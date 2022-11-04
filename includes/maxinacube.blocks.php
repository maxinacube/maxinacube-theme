<?php
/**
 * Maxinacube Blocks
 *
 * @author  maxinacube
 * @package Maxinacube
 */

namespace Maxinacube;

class Blocks {
	/**
	 * Set up custom blocks
	 *
	 * @return void
	 */

	public function __construct() {
		add_action( 'init', [ $this, 'register_acf_blocks' ] );
	}
	
	/**
	 * Register custom blocks
	 */
	function register_acf_blocks() {
		register_block_type( MAXINACUBE_PATH . '/blocks/project' );
	}

	public static function get_loop_project_data( $post_id = 0 ) {
		if ( ! $post_id ) {
			return;
		}

		$project_data = [
			'id'           => (int) $post_id,
			'project_meta' => get_fields( $post_id ),
			'title'        => get_the_title( $post_id ),
			'excerpt'      => get_the_excerpt( $post_id ),
			'permalink'    => get_the_permalink( $post_id )
		];

		return $project_data;
	}
}
