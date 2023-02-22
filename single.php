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

				// the_post_navigation(
				// 	array(
				// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'ehsanlawpllc') . '</span> <span class="nav-title">%title</span>',
				// 		'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'ehsanlawpllc') . '</span> <span class="nav-title">%title</span>',
				// 	)
				// );

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
