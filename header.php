<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FeatherLite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php $viewport_content = apply_filters( 'featherlite_viewport_content', 'width=device-width, initial-scale=1' ); ?>
<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	
	<?php 
	/*
	 * Content hooked to featherlite_header();
	 *
	 * featherlite_primary_navigation(); @priority 10
	 * featherlite_masthead_render(); @priority 20
	 * featherlite_secondary_navigation(); @priority 30
	 */
	do_action( 'featherlite_header' ); 
	
	
	?>	
	<div id="content" class="site-content">	