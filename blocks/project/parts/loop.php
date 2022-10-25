<?php $data = $args['data']; ?>

<div class="project">
	<div class="project__inner">
		<?php if ( $thumb_id = get_post_thumbnail_id( $data['id'] ) ) : ?>
			<div class="project__image-container">
				<?php echo wp_get_attachment_image( $thumb_id, 'full', null, [ 'class' => 'project__image' ] ); ?>
			</div>
		<?php endif; ?>

		<div class="project__summary">
			<h3><?php echo esc_html__( $data['title'], 'maxinacube' ); ?></h3>
			<p><?php echo esc_html__( $data['excerpt'], 'maxinacube' ); ?>
		</div>

		<div class="project__links">
			<p>
				<a class="button" href="<?php echo esc_url( $data['permalink'] ); ?>">
					<?php echo esc_html__( 'More Details', 'maxinacube' ); ?>
				</a>
				
				<?php if ( $project_url = $data['project_meta']['project_url'] ) : ?>
				<a class="button" href="<?php echo esc_url( $project_url ); ?>" target="_blank">View Project</a>
				<?php endif; ?>
			</p>
		</div>
	</div>
</div>