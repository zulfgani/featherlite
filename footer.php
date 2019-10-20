<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package centrik
 */

	echo '</div><!-- #content -->';
	 
		do_action( 'featherlite_footer_before' );
			/*
			 * Content hooked to featherlite_footer();
			 *
			 * featherlite_footer_widgets(); @priority 10
			 * featherlite_footer_content(); @priority 20
			 */
			do_action( 'featherlite_footer' );
			
		do_action( 'featherlite_footer_after' );
	
	
	echo '</div><!-- #page -->';

	do_action( 'featherlite_site_end' );
	
wp_footer(); 
?>
</body>
</html>