<?php $data = $args['data']; ?>

<div class="project">
	<div class="project__inner">
		<div class="project__summary">
			<h3><?php echo esc_html__( $data['title'], 'maxinacube' ); ?></h3>
			<p><?php echo esc_html__( $data['excerpt'], 'maxinacube' ); ?>
		</div>

		<div class="project__links">
			<p>
				<a href="<?php echo esc_url( $data['permalink'] ); ?>">
					<?php echo esc_html__( 'More Details', 'maxinacube' ); ?>
				</a>
				
				<?php if ( $project_url = $data['project_meta']['project_url'] ) : ?>
				<a href="<?php echo esc_url( $project_url ); ?>" target="_blank">View Project</a>
				<?php endif; ?>
			</p>
		</div>
	</div>
</div>