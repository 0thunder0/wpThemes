<?php
/**
 * The main template file
 */

get_header();
?>

<?php if ( is_home() && ! is_front_page() ) : ?>
	<div class="row larger-gutter align-items-center be-single-header">
		<div class="col-md-8">
			<header>
				<h1 class="page-title h4"><?php single_post_title(); ?></h1>
			</header>
		</div>
		<div class="col-md-4 text-right">
			<div class="entry-meta">
				<?php blogeasy_breadcrumb_trail(); ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<div class="row larger-gutter">

	<div id="primary" class="col-md-9 content-area be-content-width">
		<main id="main" class="site-main">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

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
</div>

<?php
get_footer();
