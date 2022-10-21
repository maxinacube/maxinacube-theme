<?php
/**
 * Project Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

use Maxinacube\Blocks;

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'projects-block projects-grid';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}

// Load values and assign defaults.
$projects = get_field( 'projects' ) ?: 'Your testimonial here...';

?>
<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?>">
	<?php
	foreach ( $projects as $project ) {
		$project_data = Blocks::get_loop_project_data( $project );

		get_template_part( 'blocks/project/parts/loop', null, [ 'data' => $project_data ] );
	}
	?>
</div>