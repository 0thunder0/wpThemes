<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogeasy
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<div class="row larger-gutter align-items-center be-single-header">
		<div class="col-md-8">
			<?php the_title( '<h1 class="entry-title h4">', '</h1>' ); ?>
		</div>
		<div class="col-md-4 text-right">
			<div class="entry-meta">
				<?php blogeasy_breadcrumb_trail(); ?>
			</div>
		</div>
	</div>
<?php endwhile; ?>

<div class="row larger-gutter be-single-page">
	<div id="primary" class="col-md-9 content-area be-content-width">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="col-md-3 be-sidebar-width">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
