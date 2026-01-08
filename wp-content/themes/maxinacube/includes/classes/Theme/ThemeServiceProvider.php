<?php
/**
 * Theme provider.
 *
 * @package MaxinacubeTheme
 */

namespace MaxinacubeTheme\Theme;

/**
 *
 * Theme service provider.
 */
class ThemeServiceProvider {

	/**
	 * The user features that should be bootstrapped.
	 *
	 * @var array
	 */
	public static array $services = [
		ThemeFilters::class,
		ThemeOptions::class,
		ThemeRequiredPatterns::class,
	];

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function __construct() {
		foreach ( self::$services as $service ) {
			new $service();
		}
	}
}
