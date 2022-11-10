<?php
/**
 * Utility functions
 *
 * @author  maxinacube
 * @package Maxinacube
 */

namespace Maxinacube;

class Utils {
	public static function get_project_data( $post_id = 0, $data = 'loop' ) {
		if ( ! $post_id ) {
			global $post;

			$post_id = $post->ID;
		}

		if ( 'project' !== get_post_type( $post_id ) ) {
			return;
		}

		if ( 'loop' === $data ) {
			$project_data = [
				'id'            => (int) $post_id,
				'project_meta'  => get_fields( $post_id ),
				'title'         => get_the_title( $post_id ),
				'excerpt'       => get_the_excerpt( $post_id ),
				'permalink'     => get_the_permalink( $post_id ),
			];
		} else {
			$project_data = [
				'project_url'   => get_field( 'project_url', $post_id ),
				'project_date'  => get_field( 'project_date', $post_id ),
				'tools'         => get_the_terms( $post_id, 'tools' ),
				'collaborators' => get_the_terms( $post_id, 'collaborators' ),
			];
		}

		return $project_data;
	}

	public static function term_list_item( $term = 0, $term_slug = '' ) {
		if ( ! $term || empty( $term_slug ) ) {
			return;
		}

		$output = '';

		if ( 'tools' === $term_slug ) {
			$icon = get_field( 'tool_icon', $term );

			if ( $icon ) {
				$output .= '<img alt="' . $term->name . ' Logo" src="' . $icon['url'] . '" />';
			}
		}
		
		if ( 'collaborators' === $term_slug ) {
			$icon = get_field( 'collaborator_icon', $term );
			$link = get_field( 'collaborator_link', $term );

			$output .= '<a href="' . $link . '" target="_blank" rel="nofollow"><img alt="' . $term->name . ' Logo" src="' . $icon['url'] . '" /></a>';
		}

		echo $output;
	}
}