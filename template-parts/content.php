<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FeatherLite
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

	<div class="entry-summary">
		<?php do_action( 'featherlite_posts' ); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php 
		$showPost = get_theme_mod('featherlite_theme_options_postshow', 'excerpt');
		if( $showPost == 'excerpt' ) { ?>
			<span class="read-more"><a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'Continue Reading', 'featherlite' ) ?></a></span>
		<?php }
		
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