<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FeatherLite
 */

if ( ! function_exists( 'featherlite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function featherlite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
	
	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline spaceLeftRight">' . $byline . '</span>'; // WPCS: XSS OK.
	
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave Feedback<span class="screen-reader-text"> on %s</span>', 'featherlite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'featherlite_entry_category' ) ) :
/**
 * Prints HTML with meta information for the categories.
 */
function featherlite_entry_category() {
	if ( 'post' === get_post_type() ) {
		$categories_list 	= get_the_category_list( ' ' );
		$featherlite_cat_links 	= esc_html__( 'Filed under:', 'featherlite' );
		if ( $categories_list && featherlite_categorized_blog() ) {
			echo '<span class="cat-links"><span class="spaceRight">' . apply_filters( 'featherlite_posted_in', $featherlite_cat_links ) . '</span>' . $categories_list . '</span>';
		}
	}
}
endif;

if ( ! function_exists( 'featherlite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function featherlite_post_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		featherlite_entry_category();
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			echo '<span class="tags-links spaceRight">' . $tags_list . '</span>';
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'featherlite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link spaceRight">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function featherlite_categorized_blog() {
	$all_the_cool_cats = get_transient( 'featherlite_categories' );
	
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $categories );

		set_transient( 'featherlite_categories', $all_the_cool_cats );
	}
	
	return $all_the_cool_cats > 1;
}

/**
 * Flush out the transients used in featherlite_categorized_blog.
 */
function featherlite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'featherlite_categories' );
}
add_action( 'edit_category', 'featherlite_category_transient_flusher' );
add_action( 'save_post',     'featherlite_category_transient_flusher' );

function featherlite_comments_field_shift( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'featherlite_comments_field_shift' );
