<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ehsanlawpllc
 */

get_header();
?>

<main id="primary" class="site-main container py-4">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<h1 class="h3 my-3"><?php echo single_cat_title(); ?> </h1>
			<?php the_archive_description('<div class="archive-description">', '</div>'); ?>
		</header><!-- .page-header -->

		<div class="row">
			<?php 
			$GLOBALS['counter'] = 0;

			while (have_posts()) :
				the_post();
				
				get_template_part('template-parts/content', get_post_type());

				$GLOBALS['counter'] ++; endwhile;

			?>
		</div>
	<?php
	echo bootstrap_pagination();
	else:
		get_template_part('template-parts/content', 'none');
	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
