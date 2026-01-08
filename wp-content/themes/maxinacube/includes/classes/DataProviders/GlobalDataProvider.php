<?php
/**
 * Data provider for Global elements.
 *
 * @package MaxinacubeTheme
 */

namespace MaxinacubeTheme\DataProviders;

use MaxinacubeTheme\PostTypes\WpBlock;
use WP_Post;
use WP_Query;

/**
 * GlobalDataProvider class.
 */
class GlobalDataProvider extends DataProviderBase {

	/**
	 * Helper function to sanitize the programmatically rendered pattern.
	 *
	 * @param string $pattern The footer block pattern.
	 * @return string Sanitized footer block pattern.
	 */
	public static function sanitize_pattern( string $pattern ): string {
		// Extract CDATA sections.
		$cdata_matches = [];
		preg_match_all( '/<!\[CDATA\[(.*?)\]\]>/s', $pattern, $cdata_matches );

		// Replace CDATA sections with placeholders.
		$placeholder = [];

		foreach ( $cdata_matches[0] as $index => $cdata ) {
			$placeholder[] = '__CDATA_PLACEHOLDER_' . $index . '__';
			$pattern       = str_replace( $cdata, '__CDATA_PLACEHOLDER_' . $index . '__', $pattern );
		}

		$allowed_html = wp_kses_allowed_html( 'post' );

		$allowed_html['script'] = [
			'type' => true,
		];

		$allowed_html['style'] = true;

		$allowed_html['form'] = [
			'method'      => true,
			'enctype'     => true,
			'id'          => true,
			'class'       => true,
			'action'      => true,
			'data-formid' => true,
			'novalidate'  => true,
		];

		$allowed_html['input'] = [
			'name'         => true,
			'id'           => true,
			'type'         => true,
			'value'        => true,
			'class'        => true,
			'placeholder'  => true,
			'checked'      => true,
			'selected'     => true,
			'disabled'     => true,
			'readonly'     => true,
			'required'     => true,
			'maxlength'    => true,
			'min'          => true,
			'max'          => true,
			'step'         => true,
			'size'         => true,
			'pattern'      => true,
			'autocomplete' => true,
			'aria-*'       => true,
			'data-*'       => true,
			'onclick'      => true,
			'onchange'     => true,
			'onkeypress'   => true,
		];

		$allowed_html['select'] = [
			'name'     => true,
			'id'       => true,
			'class'    => true,
			'disabled' => true,
			'multiple' => true,
			'data-*'   => true,
			'aria-*'   => true,
			'onchange' => true,
			'size'     => true,
		];

		$allowed_html['option'] = [
			'value'    => true,
			'selected' => true,
			'disabled' => true,
			'class'    => true,
			'data-*'   => true,
		];

		$allowed_html['optgroup'] = [
			'label'    => true,
			'disabled' => true,
		];

		$allowed_html['script'] = [
			'type' => true,
		];

		$allowed_html['textarea'] = [
			'name'         => true,
			'id'           => true,
			'class'        => true,
			'rows'         => true,
			'cols'         => true,
			'maxlength'    => true,
			'placeholder'  => true,
			'aria-*'       => true,
			'data-*'       => true,
			'required'     => true,
			'disabled'     => true,
			'readonly'     => true,
			'autocomplete' => true,
		];

		$allowed_html['label'] = [
			'for'    => true,
			'class'  => true,
			'data-*' => true,
			'aria-*' => true,
		];

		$allowed_html['button'] = [
			'id'       => true,
			'class'    => true,
			'type'     => true,
			'name'     => true,
			'value'    => true,
			'disabled' => true,
			'data-*'   => true,
			'aria-*'   => true,
			'onclick'  => true,
		];

		$allowed_html['fieldset'] = [
			'class'    => true,
			'disabled' => true,
			'data-*'   => true,
		];

		$allowed_html['legend'] = [
			'class'  => true,
			'data-*' => true,
		];

		$allowed_html['div']['data-modal-id'] = true;

		$allowed_html['div']['style'] = true;

		$allowed_html['p']['style'] = true;

		$allowed_html['a']['target'] = true;

		$allowed_html['mask'] = [
			'id'        => true,
			'style'     => true,
			'maskUnits' => true,
			'x'         => true,
			'y'         => true,
			'width'     => true,
			'height'    => true,
		];

		$allowed_html['svg'] = [
			'xmlns'       => true,
			'width'       => true,
			'height'      => true,
			'class'       => true,
			'aria-hidden' => true,
			'role'        => true,
			'fill'        => true,
			'viewbox'     => true,
		];

		$allowed_html['path'] = [
			'd'            => true,
			'fill'         => true,
			'fill-rule'    => true,
			'clip-rule'    => true,
			'stroke'       => true,
			'stroke-width' => true,
			'class'        => true,
		];

		// Sanitize the pattern.
		$sanitized_pattern = wp_kses( $pattern, $allowed_html );

		// Replace placeholders with the original CDATA sections.
		foreach ( $placeholder as $index => $place ) {
			$sanitized_pattern = str_replace( $place, $cdata_matches[0][ $index ], $sanitized_pattern );
		}

		return $sanitized_pattern;
	}

	/**
	 * Get a post by title.
	 *
	 * @param string       $post_title The title of the post.
	 * @param string|array $post_type  The post type(s) to query.
	 * @return WP_Post|null The post object if found, null otherwise.
	 */
	public static function get_post_by_title( string $post_title, string|array $post_type = 'page' ): ?WP_Post {
		$query = new WP_Query(
			[
				'title'          => $post_title,
				'post_type'      => $post_type,
				'post_status'    => 'publish',
				'posts_per_page' => 1,
			]
		);

		if ( $query->have_posts() ) {
			return $query->posts[0];
		}

		return null;
	}

	/**
	 * Function to programmatically load block patterns.
	 *
	 * @param string $pattern_title The title of the pattern.
	 * @return string Pattern HTML
	 */
	public static function load_pattern( string $pattern_title ): string {
		$pattern = '';

		$pattern_post = self::get_post_by_title(
			$pattern_title,
			WpBlock::NAME
		);

		if ( $pattern_post ) {
			$pattern = $pattern_post->post_content;
		}

		$pattern_content = apply_filters( 'the_content', $pattern );

		return $pattern_content;
	}
}
