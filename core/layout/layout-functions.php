<?php

function featherlite_sidebar_render() {
	get_sidebar();
}

function featherlite_single_seo_breadcrumbs() {
	if ( function_exists( 'cpseo_the_breadcrumbs' ) && ! is_home() && ! is_front_page() ) {
		cpseo_the_breadcrumbs();
	}
}
add_action( 'featherlite_cpseo_do_breadcrumbs', 'featherlite_single_seo_breadcrumbs', 10 );

function featherlite_index_render() {
	do_action( 'featherlite_index_primary_before' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) { ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			}

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination( array(
				'prev_text'          => '<i class="fa fa-angle-double-left spaceRight"></i>' . esc_html__( 'Previous', 'featherlite' ),
				'next_text'          => esc_html__( 'Next', 'featherlite' ) . '<i class="fa fa-angle-double-right spaceLeft"></i>',
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'featherlite_index_primary_after' );
}

function featherlite_archive_render() {
	do_action( 'featherlite_archive_primary_before' );
	do_action( 'featherlite_cpseo_do_breadcrumbs' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination( array(
				'prev_text'          => '<i class="fa fa-angle-double-left spaceRight"></i>' . esc_html__( 'Previous', 'featherlite' ),
				'next_text'          => esc_html__( 'Next', 'featherlite' ) . '<i class="fa fa-angle-double-right spaceLeft"></i>',
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'featherlite_archive_primary_after' );
}

function featherlite_search_render() {
	do_action( 'featherlite_search_primary_before' );
	do_action( 'featherlite_cpseo_do_breadcrumbs' );
	?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
				<?php
				/* translators: %s: search query */
				printf( esc_html__( 'Search Results for: %s', 'featherlite' ), '<span>' . get_search_query() . '</span>' );
				?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination( array(
				'prev_text'          => '<i class="fa fa-angle-double-left spaceRight"></i>' . esc_html__( 'Previous', 'featherlite' ),
				'next_text'          => esc_html__( 'Next', 'featherlite' ) . '<i class="fa fa-angle-double-right spaceLeft"></i>',
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php do_action( 'featherlite_search_primary_after' );
}

function featherlite_single_render() {
	do_action( 'featherlite_single_primary_before' );
	do_action( 'featherlite_cpseo_do_breadcrumbs' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'featherlite' ) . '<i class="fa fa-lg fa-angle-double-right spaceLeft"></i></span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'featherlite' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="fa fa-lg fa-angle-double-left spaceRight"></i>' . __( 'Previous Post', 'featherlite' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'featherlite' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		endwhile; // End of the loop.
		do_action( 'featherlite_after_main_content' );
		?>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'featherlite_single_primary_after' );
}

function featherlite_page_render() {
	do_action( 'featherlite_page_primary_before' );
	do_action( 'featherlite_cpseo_do_breadcrumbs' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'featherlite_page_primary_after' );
}

function featherlite_fourofour_render() {
	do_action( 'featherlite_404_primary_before' );
	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="site-fourofour error-404 not-found">
				<?php do_action( 'featherlite_fourofour_content' ); ?>
			</section><!-- .site-fourofour -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php do_action( 'featherlite_404_primary_after' );
}

function featherlite_render_layout() {	
	$default = featherlite_generate_defaults();	
	$layout = get_theme_mod( 'featherlite_site_layout_setting', $default['featherlite_site_layout_default'] );
	
	if ( $layout == 'sidebarleft' ) {
		add_action( 'featherlite_index', 'featherlite_sidebar_render', 10 );
		add_action( 'featherlite_index', 'featherlite_index_render', 20 );
		add_action( 'featherlite_archive', 'featherlite_sidebar_render', 10 );
		add_action( 'featherlite_archive', 'featherlite_archive_render', 20 );
		add_action( 'featherlite_search', 'featherlite_sidebar_render', 10 );
		add_action( 'featherlite_search', 'featherlite_search_render', 20 );		
		add_action( 'featherlite_page', 'featherlite_sidebar_render', 10 );
		add_action( 'featherlite_page', 'featherlite_page_render', 20 );
		add_action( 'featherlite_single', 'featherlite_sidebar_render', 10 );
		add_action( 'featherlite_single', 'featherlite_single_render', 20 );
		add_action( 'featherlite_fourofour', 'featherlite_fourofour_render', 20 );
		
	} elseif ( $layout == 'sidebarright' ) {
		add_action( 'featherlite_index', 'featherlite_index_render', 10 );
		add_action( 'featherlite_index', 'featherlite_sidebar_render', 20 );
		add_action( 'featherlite_archive', 'featherlite_archive_render', 10 );
		add_action( 'featherlite_archive', 'featherlite_sidebar_render', 20 );
		add_action( 'featherlite_search', 'featherlite_search_render', 10 );
		add_action( 'featherlite_search', 'featherlite_sidebar_render', 20 );
		add_action( 'featherlite_page', 'featherlite_page_render', 10 );
		add_action( 'featherlite_page', 'featherlite_sidebar_render', 20 );
		add_action( 'featherlite_single', 'featherlite_single_render', 10 );
		add_action( 'featherlite_single', 'featherlite_sidebar_render', 20 );		
		add_action( 'featherlite_fourofour', 'featherlite_fourofour_render', 10 );
	}
}
add_action( 'template_redirect', 'featherlite_render_layout' );

function featherlite_layout_body_class( $layout_class ) {
	$default	= featherlite_generate_defaults();
	$layout 	= get_theme_mod( 'featherlite_site_layout_setting', $default['featherlite_site_layout_default'] );
	
	if ( $layout == 'sidebarleft' && ! is_404() ) {
		$layout_class[] = 'sidebarleft';
	} elseif ( $layout == 'sidebarright' && ! is_404() ) {
		$layout_class[] = 'sidebarright';
	}
	
	return $layout_class;
}
add_filter( 'body_class', 'featherlite_layout_body_class' );
