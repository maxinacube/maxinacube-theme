<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package MaxinacubeTheme
 *
 * @author Rareview <hello@rareview.com>
 */

get_header(); ?>

	<main class="rv-page-404">
		<h1 class="rv-404__heading">
			<?php echo esc_html__( '404', 'maxinacube-theme' ); ?>
		</h1>

		<div class="rv-404__content">
			<p>
			<?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'maxinacube-theme' ); ?>
			</p>

			<div class="rv-404__back">
				<a href="<?php echo esc_url( get_home_url() ); ?>" class="rv-button">
					<?php echo esc_html__( 'Back to home', 'maxinacube-theme' ); ?>
				</a>
			</div>
		</div>
	</main>

<?php
get_footer();
