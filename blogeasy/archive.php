<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogeasy
 */

get_header();
?>

<div class="row larger-gutter align-items-center be-single-header">
	<div class="col-md-8">
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title h4">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	</div>
	<div class="col-md-4 text-right">
		<div class="entry-meta">
			<?php blogeasy_breadcrumb_trail(); ?>
		</div>
	</div>
</div>

<div class="row larger-gutter">
	<div id="primary" class="col-md-9 content-area be-content-width">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="col-md-3 be-sidebar-width">
		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();
