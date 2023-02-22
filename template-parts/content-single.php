<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ehsanlawpllc
 */

?>

<?php

$format = get_post_format() ?? 'standard';

// if (false === $format) {
//     $format = 'standard';
// }
// echo $format;

?>


<?php if ($format == 'aside') : ?>
    <?php 
       // display featured image
         if (has_post_thumbnail()) {
              the_post_thumbnail(
                'full',
                array(
                     'class' => 'img-fluid w-100 mb-3',
                )
              );
         } else {
              echo 'https://via.placeholder.com/200x120?text=No+Image';
         }
        
     ?>
    

<?php endif; ?>
<br>
<h1><?php the_title(); ?></h1>
<br>

<?php the_content(); ?>