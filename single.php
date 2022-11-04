<?php
/**
 * Catch All Template
 *
 * @since 1.0.0
 */
?>

<?php get_header(); ?>
	<div class="grid">
		<div class="cell fill">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_title( '<h1>', '</h1>' ); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
<?php get_footer();