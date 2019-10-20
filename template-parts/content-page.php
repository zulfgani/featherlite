<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FeatherLite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( '' != get_the_post_thumbnail() ) {
				echo '<div class="entry-thumbnail">';
					the_post_thumbnail( 'featherlite-default' );
				echo '</div>';
			}
		
		the_content();
		
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'featherlite' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links-number">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'featherlite' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'featherlite' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->