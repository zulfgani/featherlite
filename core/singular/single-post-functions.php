<?php

function featherlite_post_thumbnail() {
	if ( '' != get_the_post_thumbnail() ) {
		echo '<div class="entry-thumbnail">';
			the_post_thumbnail( 'featherlite-default' );
		echo '</div>';
	}
}
add_action( 'single_post_render', 'featherlite_post_thumbnail', 10 );

function featherlite_post_header() {
	echo '<header class="entry-header">';		
		the_title( '<h1 class="entry-title">', '</h1>' );
	echo '</header><!-- .entry-header -->';
}
add_action( 'single_post_render', 'featherlite_post_header', 20 );

function featherlite_entry_meta() {
	if ( 'post' === get_post_type() ) {
		echo '<div class="entry-meta">';
			featherlite_posted_on();
		echo '</div><!-- .entry-meta -->';
	}
}
add_action( 'single_post_render', 'featherlite_entry_meta', 30 );

function featherlite_entry_content() {
	the_content();
}
add_action( 'single_post_render', 'featherlite_entry_content', 40 );

function featherlite_link_pages() {
	wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'featherlite' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span class="page-links-number">',
		'link_after'  => '</span>',
		'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'featherlite' ) . ' </span>%',
		'separator'   => '<span class="screen-reader-text">, </span>',
	) );
}
add_action( 'single_post_render', 'featherlite_link_pages', 50 );