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

	<div class="entry-content">
		<?php do_action( 'single_post_render' ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php featherlite_post_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-## -->
