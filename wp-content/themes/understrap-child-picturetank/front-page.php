<?php
/**
 * The template for displaying the front-page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">



<div id="homesearchfield" class="container" style="">
	<div class="row thin-gutter">
		<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3">
			<form action="/fr/search" method="get">
				<div class="input-group">
					<input class="form-control input-lg" style="height:45px;" type="text" placeholder="Recherche d&#039;images: Saisissez des mots clés" id="q" name="q" value="">
					<span class="input-group-btn">
						<button type="submit" class="btn  btn-primary" type="button"><span class="ti-search"></span></button>
					</span>


				</div>
			</form>
		</div>
	</div>
</div>

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'frontpage' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
