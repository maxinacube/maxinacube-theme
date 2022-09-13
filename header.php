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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<header id="header">
    <?php echo file_get_contents( MAXINACUBE_URL . '/assets/images/logo.svg' ); ?>
        
    <?php wp_nav_menu( [
        'theme_location' => 'primary_menu',
        'container_id'   => 'menu-container'
    ] ); ?>

    <?php get_template_part( 'partials/menu/hamburger' ); ?>
</header>

<div id="site"><?php // open: #site ?>