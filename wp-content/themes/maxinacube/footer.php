<?php
/**
 * The template for displaying the footer.
 *
 * @package MaxinacubeTheme
 */

use MaxinacubeTheme\DataProviders\GlobalDataProvider;

$site_footer = GlobalDataProvider::load_pattern( 'Site Footer (Theme Required)' );

?>
		<footer class="rv-footer">
		<?php
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo GlobalDataProvider::sanitize_pattern( $site_footer );
		?>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
