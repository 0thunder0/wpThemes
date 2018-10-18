<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blogeasy
 */

get_header();
?>

<div class="row larger-gutter align-items-center be-single-header">
	<div class="col-md-8">
		<header class="page-header">
			<h1 class="page-title h4"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blogeasy' ); ?></h1>
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

			<section class="error-404 not-found">

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'blogeasy' ); ?></p>

					<?php
					get_search_form();

					the_widget( 'WP_Widget_Recent_Posts', array(), array(
						'before_title' => '<h5 class="widget-title mt-4">',
						'after_title'  => '</h5>',
					) );
					?>

					<div class="widget widget_categories">
						<h5 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'blogeasy' ); ?></h5>
						<ul>
							<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
							?>
						</ul>
					</div><!-- .widget -->

					<?php
						the_widget( 'WP_Widget_Tag_Cloud',array(), array(
							'before_title' => '<h5 class="widget-title mt-4">',
							'after_title'  => '</h5>',
						) );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<div class="col-md-3 be-sidebar-width">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
