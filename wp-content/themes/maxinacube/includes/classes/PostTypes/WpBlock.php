<?php
/**
 * WpBlock post type.
 *
 * @package MaxinacubeTheme
 */

namespace MaxinacubeTheme\PostTypes;

use MaxinacubeTheme\App;

/**
 * WpBlock default post type class.
 */
class WpBlock extends PostType {

	/**
	 * The name of the post type.
	 *
	 * @var string
	 */
	public const NAME = 'wp_block';

	/**
	 * Theme-required pattern meta key.
	 *
	 * @var string
	 */
	public const THEME_REQUIRED_PATTERN_META_KEY = App::META_KEY_PREFIX . self::NAME . '_theme_required';

	/**
	 * The post meta fields of the post type.
	 *
	 * @var array
	 */
	protected array $post_meta = [
		self::THEME_REQUIRED_PATTERN_META_KEY => [
			'show_in_rest'      => true,
			'single'            => true,
			'description'       => 'Marker for the programatically added, theme-required pattern',
			'type'              => 'boolean',
			'sanitize_callback' => 'rest_sanitize_boolean',
		],
	];
}
