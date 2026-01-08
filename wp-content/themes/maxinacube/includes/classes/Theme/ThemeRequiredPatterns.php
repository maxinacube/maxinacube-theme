<?php
/**
 * This file controls the Theme patterns.
 *
 * @package MaxinacubeTheme
 */

namespace MaxinacubeTheme\Theme;

use MaxinacubeTheme\PostTypes\WpBlock;

/**
 * ThemeRequiredPatterns class.
 */
class ThemeRequiredPatterns {

	private const THEME_REQUIRED_BADGE = ' (Theme Required)';

	/**
	 * ThemeRequiredPatterns constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'rv_add_patterns_from_folder' ] );
		add_filter( 'map_meta_cap', [ $this, 'rv_prevent_required_patterns_deletion' ], 10, 4 );
	}

	/**
	 * Creates theme-required patterns from the patterns folder.
	 *
	 * @return void
	 */
	public static function rv_add_patterns_from_folder(): void {
		$pattern_folder = get_template_directory() . '/patterns/theme-required/';
		$pattern_files  = glob( $pattern_folder . '*.php' );

		foreach ( $pattern_files as $pattern_file ) {
			$file_contents = file_get_contents( $pattern_file ); // phpcs:ignore

			$title      = self::extract_pattern_comment_field( $file_contents, 'Title' );
			$slug       = self::extract_pattern_comment_field( $file_contents, 'Slug' );
			$categories = self::extract_pattern_comment_field( $file_contents, 'Categories' );

			if ( ! $title || ! $slug ) {
				continue;
			}

			$found_post = post_exists( $title . self::THEME_REQUIRED_BADGE, '', '', WpBlock::NAME );

			if ( ! $found_post ) :
				ob_start();
				include $pattern_file;
				$pattern_content = ob_get_clean();

				$block_pattern_id = wp_insert_post(
					array(
						'post_title'   => $title . self::THEME_REQUIRED_BADGE,
						'post_content' => $pattern_content,
						'post_name'    => $slug,
						'post_status'  => 'publish',
						'post_type'    => WpBlock::NAME,
					)
				);

				if ( ! is_wp_error( $block_pattern_id ) ) {
					add_post_meta( $block_pattern_id, 'wp_pattern_sync_status', 'synced' );
					add_post_meta( $block_pattern_id, WpBlock::THEME_REQUIRED_PATTERN_META_KEY, true );

					if ( $categories ) {
						$category_terms = array_map( 'trim', explode( ',', $categories ) );
						wp_set_post_terms( $block_pattern_id, $category_terms, 'wp_pattern_category' );
					}
				}
			endif;
		}
	}

	/**
	 * Extracts a specific field from the pattern comment block.
	 *
	 * @param string $file_contents The contents of the file.
	 * @param string $field The field to extract (Title, Slug, Categories).
	 *
	 * @return string|null The extracted field value or null if not found.
	 */
	private static function extract_pattern_comment_field( string $file_contents, string $field ): string|null {
		preg_match( '/^\s*\*\s*' . preg_quote( $field, '/' ) . ':\s*(.+)$/m', $file_contents, $matches );
		return isset( $matches[1] ) ? trim( $matches[1] ) : null;
	}

	/**
	 * Disable delete for theme-required patterns.
	 *
	 * @param array  $caps  An array of the user's capabilities.
	 * @param string $cap   Capability name.
	 * @param int    $user_id The user ID.
	 * @param array  $args  Optional further parameters, typically starting with an object ID.
	 *
	 * @return array Modified array of the user's capabilities.
	 */
	public static function rv_prevent_required_patterns_deletion( array $caps, string $cap, int $user_id, array $args ): array {
		if ( 'delete_post' !== $cap || empty( $args[0] ) ) {
			return $caps;
		}

		$pattern_required = get_post_meta( $args[0], WpBlock::THEME_REQUIRED_PATTERN_META_KEY, true );

		if ( WpBlock::NAME === get_post_type( $args[0] ) && true === (bool) $pattern_required ) {
			$caps[] = 'do_not_allow';
		}

		return $caps;
	}
}
