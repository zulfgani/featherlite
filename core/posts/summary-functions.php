<?php

function featherlite_summary_thumbnails() {
	if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><?php esc_html_e( 'Featured', 'featherlite' ); ?></span>
	<?php endif;
	
	if ( '' != get_the_post_thumbnail() ) {
		echo '<div class="entry-thumbnail"><a href="' . esc_url( get_permalink() ) . '">';
			the_post_thumbnail( 'featherlite-post-thumbnail' );
		echo '</a></div>';
	}
}
add_action( 'featherlite_posts', 'featherlite_summary_thumbnails', 10 );

function featherlite_summary_header() {
	echo '<header class="entry-header">';
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );		
	echo '</header><!-- .entry-header -->';
}
add_action( 'featherlite_posts', 'featherlite_summary_header', 20 );

function featherlite_summary_meta() {
	if ( 'post' === get_post_type() ) {
		echo '<div class="entry-meta">';
			featherlite_posted_on();
		echo '</div><!-- .entry-meta -->';
	
	}
}
add_action( 'featherlite_posts', 'featherlite_summary_meta', 30 );

function featherlite_summary_content() {
	$showPost = get_theme_mod('featherlite_theme_options_postshow', 'excerpt');
	if( $showPost == 'excerpt' ) {
		the_excerpt();
	} else {
	
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'featherlite' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'featherlite' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="page-links-number">',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'featherlite' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		
	}
}
add_action( 'featherlite_posts', 'featherlite_summary_content',  40 );