<?php
/**
 * Single Project Template
 *
 * @since 1.0.0
 */

$post_id = get_the_ID();
?>

<?php get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="grid single-title-container">
			<div class="cell">
				<?php the_title( '<h1>', '</h1>' ); ?>
			</div>
		</div>

		<div class="grid single-content-container">
			<div class="cell auto mobile-order-2">
				<?php the_content(); ?>
			</div>
			
			<?php get_template_part( 'partials/project/sidebar', null, [ 'id' => $post_id ] ); ?>
		</div>
	<?php endwhile; ?>
<?php get_footer();