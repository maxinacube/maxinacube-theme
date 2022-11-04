<?php
use Maxinacube\Utils;

$project_data = Utils::get_project_data( $args['id'], 'single' );

$data_sections = [ 'project_url', 'tools', 'collaborators' ];
?>

<?php if ( ! empty( $project_data ) ) : ?>
	<div class="cell third">
		<?php foreach ( $data_sections as $data_section ) : ?>
			<?php if ( $section = $project_data[$data_section] ) : ?>
				<div class="project-data__section">
					<?php if ( 'project_url' === $data_section ) : ?>
						<p><a class="button" href="<?php echo esc_url( $section ); ?>"><?php echo esc_html__( 'View Project', 'maxinacube' ); ?></a></p>
						
					<?php else :?>
						<h4>
							<?php if ( 'collaborators' === $data_section ) : ?>
								<?php echo esc_html__( 'In Collaboration With...', 'maxinacube' ); ?>
							<?php else: ?>
								<?php echo esc_html__( ucfirst( $data_section ), 'maxinacube' ); ?>
							<?php endif; ?>
						</h4>

						<ul class="project-data__list <?php echo esc_attr( $data_section ); ?>">
							<?php foreach ( $section as $term ) : ?>
								<li><?php Utils::term_list_item( $term, $data_section ); ?></li>
							<?php endforeach; ?>
						</ul>

					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif;