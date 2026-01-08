<?php
/**
 * Rest service provider.
 *
 * @package MaxinacubeTheme
 */

namespace MaxinacubeTheme\Rest;

/**
 *
 * Rest service provider.
 */
class RestServiceProvider {

	/**
	 * The user features that should be bootstrapped.
	 *
	 * @var array
	 */
	public static array $services = [
		SocialNetworksRestEndpoint::class,
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
