<?php
/**
 * Catch All Template
 *
 * @since 1.0.0
 */

use Maxinacube\Blocks;
?>

<?php get_header(); ?>

<div class="grid">
	<div class="cell fill">
		<h1><?php echo esc_html__( 'Projects', 'maxinacube' ); ?></h1>
	</div>
</div>

<div class="grid">
	<div class="cell fill">
		<div class="<?php echo esc_attr( 'projects-block projects-grid' ); ?>">
			<?php while ( have_posts() ) : the_post(); $project_data = Blocks::get_loop_project_data( get_the_ID() ); ?>
				<?php get_template_part( 'blocks/project/parts/loop', null, [ 'data' => $project_data ] ); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_footer();
