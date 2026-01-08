<?php
/**
 * Filter core code and blocks.
 *
 * @package MaxinacubeTheme
 */

namespace MaxinacubeTheme\Theme;

class ThemeFilters {
	/**
	 * ThemeFilters.
	 *
	 * @return void
	 */
	public function __construct() {
		add_filter( 'mime_types', [ $this, 'mime_types_svg' ] );
	}

	/**
	 * Allow SVG upload.
	 *
	 * @param array $mimes Existing mime types.
	 *
	 * @return array Modified mime types.
	 */
	public function mime_types_svg( array $mimes ): array {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
}
