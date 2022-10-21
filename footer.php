</div><?php close: #site ?>

<footer id="footer">
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
