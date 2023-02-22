<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ehsanlawpllc
 */

get_header();
?>

<main id="primary" class="site-main container py-4">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Search Results for: %s', 'ehsanlawpllc'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</header><!-- .page-header -->

		<div class="row">
			<?php
			/* Start the Loop */
			$GLOBALS['counter'] = 0;
			while (have_posts()) :
				the_post();

				get_template_part('template-parts/content', 'post');

				$GLOBALS['counter']++; endwhile;
			?>
		</div>

	<?php the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
