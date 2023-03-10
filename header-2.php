<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ehsanlawpllc https://github.com/aristath/kirki
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- link assets/style.css -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&display=swap" rel="stylesheet"> -->

    <link href="https://fonts.cdnfonts.com/css/helvetica-2" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- <script src="assets/script.js"></script> -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- cover background -->
    <div class="cover-bg" style="background: linear-gradient(rgba(19, 34, 66, 0.85), rgba(19, 34, 66, 0.85)),
		<? if (is_front_page() && is_home()) {
            echo 'url(' . get_header_image() . ');';
        } ?>">
        <!-- top header -->
        <div class="container top-header">
            <div class="row">
                <div class="col-3 col-md-6">
                    <!-- logo -->
                    <?php echo get_custom_logo(); ?>

                </div>
                <div class="col-9 col-md-6 d-flex align-items-center header-social">

                    <div class="ms-auto">
                        <?php dynamic_sidebar('header-social-media-icons');; ?>
                    </div>

                </div>

            </div>
        </div>
        <!-- /top header -->

        <!-- menu -->
        <nav id="menu" class="navbar navbar-expand-lg bg-dark p-0 sticky-top">
            <div class="container-fluid">

                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse text-center collapse" id="navbarSupportedContent" style="">

                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav m-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                        'depth' => 2,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    ));
                    ?>

                </div>
            </div>
        </nav>
        <!-- /menu -->

        <!-- feutured -->
        <!-- if home page -->
        <?php
        if (is_front_page() && is_home()) {
            dynamic_sidebar('home-feutured');
        } ?>
        <!-- /feutured -->

    </div>
    <!-- /cover background -->