<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogeasy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'be-one-post' ); ?>>

	<?php if ( ! is_singular() ) : ?>
		<header class="entry-header">
			<?php
				the_title( '<h2 class="entry-title h4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php
						blogeasy_posted_on();
						blogeasy_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php
				endif;
			?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php blogeasy_post_thumbnail(); ?>

	<?php if( is_singular() || ( get_theme_mod( 'blog_home_full_post', 'no' ) === 'yes' ) ) : ?>
		<div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogeasy' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogeasy' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<div class="mt-4 mb-4">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Continue Reading', 'blogeasy' ); ?> <small class="fas fa-arrow-right ml-1"></small></a>
			</div>
		</div><!-- .entry-summary -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php blogeasy_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
