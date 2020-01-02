<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FeatherLite
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One feedback on &ldquo;%s&rdquo;', 'comments title', 'featherlite' ), esc_html( get_the_title() ) );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s feedback on &ldquo;%2$s&rdquo;',
							'%1$s feedbacks on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'featherlite'
						),
						number_format_i18n( $comments_number ),
						esc_html( get_the_title() )
					);
				}
			?>
		</h2>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size' => 0,
					'reply_text'        =>  '<span>' .esc_html__( 'Respond'  , 'featherlite' ) . '</span>',
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Feedback navigation', 'featherlite' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Feedbacks', 'featherlite' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Feedbacks', 'featherlite' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Feedbacks are closed.', 'featherlite' ); ?></p>
	<?php
	endif;

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		
		$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$consent_content = __( 'Cookies Consent: Save my name, email, and website in this browser for the next time I leave feedback.', 'featherlite' );

		$fields =  array(
			'author' => '<p class="comment-form-author"><label for="author"><span class="screen-reader-text">' . esc_html__( 'Your Name *'  , 'featherlite' ) . '</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Your Name *'  , 'featherlite' ) . '"/></p>',
			'email'  => '<p class="comment-form-email"><label for="email"><span class="screen-reader-text">' . esc_html__( 'Your Email *'  , 'featherlite' ) . '</span></label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' placeholder="' . esc_attr__( 'Your Email *'  , 'featherlite' ) . '"/></p>',
			'url'    => '<p class="comment-form-url"><label for="url"><span class="screen-reader-text">' . esc_html__( 'Your Website'  , 'featherlite' ) . '</span></label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Your Website'  , 'featherlite' ) . '"/></p>',
		);
		$fields['cookies'] =  '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . wp_kses_post( apply_filters( 'featherlite_consent_content', $consent_content ) ) . '</label></p>';
		$required_text = esc_html__('Required fields are marked ', 'featherlite').' <span class="required">*</span>';
			
		do_action( 'featherlite_comment_before' );
		
		$args = array(
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			/* translators: %s: wordpress login url */
			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'featherlite' ), wp_login_url( apply_filters( 'the_permalink', esc_url(get_permalink( ) ) ) ) ) . '</p>',
			/* translators: 1: profile user link, 2: username, 3: logout link */
			'logged_in_as' => '<p class="logged-in-as smallPart">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'  , 'featherlite' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url(get_permalink( ) ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes smallPart">' . esc_html__( 'Your email address will not be published.'  , 'featherlite' ) . ( $req ? $required_text : '' ) . '</p>',
			'title_reply' => esc_html__( 'Leave your Feedback'  , 'featherlite' ),
			/* translators: %s: name of person to reply */
			'title_reply_to' => esc_html__( 'Leave your Feedback to %s'  , 'featherlite' ),
			'cancel_reply_link' => esc_html__( 'Cancel feedback'  , 'featherlite' ) . '<i class="fa fa-times spaceLeft"></i>',
			'label_submit' => esc_html__( 'Submit Feedback'  , 'featherlite' ),
			'comment_field' => '<p class="comment-form-comment"><label for="comment"><span class="screen-reader-text">' . esc_html__( 'Your Feedback *'  , 'featherlite' ) . '</span></label><textarea id="comment" name="comment" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Your Feedback *'  , 'featherlite' ) . '"></textarea></p>',
		);
		comment_form( $args );
		do_action( 'featherlite_comment_after' );
	?>

</div><!-- #comments -->
