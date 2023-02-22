<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ehsanlawpllc
 */

?>

<div class="col-md-3 my-2" data-aos="fade-up" data-aos-delay="<?php echo $GLOBALS['counter']*100;?>">


    <div class="card">
        <?php
        $icon = get_field('svg_icon', get_the_ID());

        if ($icon) {
            echo '<span class="card-svg text-center p-4">' . $icon . '</span>';
        } else {
        ?>

            <img class="card-img-top" src=" <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail_url(
                                                    'medium',
                                                    array(
                                                        'class' => 'img-fluid',
                                                    )
                                                );
                                            } else {
                                                echo 'https://via.placeholder.com/200x120?text=No+Image';
                                            }

                                            ?> " alt="Card image cap">

        <?php } ?>


        <div class="card-body">
            <h5 class="card-title">
                <?php the_title(); ?>
            </h5>
            <p class="card-text max-lines">
                <?php

                // if has excerpt
                if (has_excerpt()) {
                    the_excerpt();
                } else {
                    echo wp_trim_words(get_the_content(sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'ehsanlawpllc'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        wp_kses_post(get_the_title())
                    )), 10);
                }

                ?>

            </p>
            <a href="<?php the_permalink(); ?>" class="btn btn-warning">Read More...</a>
        </div>
    </div>

</div>