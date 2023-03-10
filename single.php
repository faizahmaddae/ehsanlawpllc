<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ehsanlawpllc
 */

get_header();
?>

<main id="primary" class="site-main container py-4">

	<div class="row">
		<div class="col-md-8">
			<?php
			while (have_posts()) :
				the_post();

				get_template_part('template-parts/content-single', get_post_type());

			endwhile; // End of the loop.
			?>


		<?php  get_template_part('template', 'sharing-box'); ?>

		</div>

		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>

	</div>

</main><!-- #main -->

<?php
get_footer();
