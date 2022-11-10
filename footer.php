</div><?php close: #site ?>

<footer id="footer">
	<?php /* @todo: maybe put a blurb/contact callout in interior footers */ ?>
	<?php if ( ! is_front_page() && ! is_404() && false === true ) : ?>
		<div class="grid">
			<div class="cell is-half">
				
			</div>

			<div class="cell is-half">
				<h3><?php echo esc_html__( 'Get In Touch', 'maxinacube' ); ?></h3>
			</div>
		</div>
	<?php endif; ?>

	<div class="grid">
		<div class="cell shrink">
			&copy; <?php echo date( 'Y' ); ?> maxinacube
		</div>

		<div class="cell fill">
			<?php wp_nav_menu( [
				'theme_location' => 'social_menu',
				'container_id'   => 'social-menu'
			] ); ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
