<?php
/**
 * Catch All Template
 *
 * @since 1.0.0
 */
?>

<?php get_header(); ?>
	<section class="site-panel splash"></section>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php get_footer();