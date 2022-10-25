<?php
/**
 * Header Template
 *
 * @since 1.0.0
 */
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<header id="header">
	<a href="<?php echo trailingslashit( site_url() ); ?>">
    	<svg xmlns="http://www.w3.org/2000/svg" viewBox="968.5 98.5 163 163" id="maxinacube-logo">
		<title>Maxinacube</title>

			<g><path d=" M 1010 220 L 990 230 L 990 190 L 1010 200 L 1010 220 Z " fill="rgb(232,232,232)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1010 230 L 1030 220 L 1030 200 L 1010 200 L 1010 230 Z " fill="rgb(232,232,232)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1090 220 L 1110 230 L 1110 190 L 1090 200 L 1090 220 Z " fill="rgb(232,232,232)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1070 220 L 1090 230 L 1090 200 L 1060 200 L 1070 220 Z " fill="rgb(232,232,232)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1050 120 L 1050 160 L 1010 200 L 990 150 L 1050 120 Z " fill="rgb(232,232,232)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1050 160 L 1050 120 L 1110 150 L 1090 200 L 1050 160 Z " fill="rgb(232,232,232)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 970 140 L 1050 100 L 1130 140 L 1110 150 L 1090 190 L 1070 180 L 1090 140 L 1050 120 L 1010 140 L 1030 180 L 1010 190 L 990 150 L 970 140 Z " fill="rgb(209,209,209)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 970 220 L 970 140 L 990 150 L 1010 190 L 1030 170 L 1050 180 L 1050 260 L 1030 250 L 1030 200 L 1010 230 L 990 190 L 990 230 L 970 220 Z " fill="rgb(46,46,46)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1070 250 L 1050 260 L 1050 180 L 1070 170 L 1090 190 L 1110 150 L 1130 140 L 1130 220 L 1110 230 L 1110 190 L 1090 230 L 1070 200 L 1070 250 Z " fill="rgb(139,139,139)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/><path d=" M 1050 160 L 1030 170 L 1050 180 L 1070 170 L 1050 160 Z " fill="rgb(162,162,162)" vector-effect="non-scaling-stroke" stroke-width="1" stroke="rgb(0,0,0)" stroke-linejoin="miter" stroke-linecap="square" stroke-miterlimit="3"/></g>
		</svg>
	</a>
        
    <?php wp_nav_menu( [
        'theme_location' => 'primary_menu',
        'container_id'   => 'menu-container'
    ] ); ?>

    <?php get_template_part( 'partials/menu/hamburger' ); ?>
</header>

<div id="site"><?php // open: #site ?>