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

    <!-- <link href="https://fonts.cdnfonts.com/css/helvetica-2" rel="stylesheet"> -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- <script src="assets/script.js"></script> -->
    <?php $baseUrl = get_template_directory_uri(); ?>
    

    <style>
        @font-face {
            font-family: helvetica;
            font-style: normal;
            font-weight: 400;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA55ROMAN.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: italic;
            font-weight: 400;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA56ITALIC.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: normal;
            font-weight: 300;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA45LIGHT.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: italic;
            font-weight: 300;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA46LIGHTITALIC.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: normal;
            font-weight: 700;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA75BOLD.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: italic;
            font-weight: 700;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA76BOLDITALIC.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: normal;
            font-weight: 900;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA95BLACK.woff) format('woff')
        }

        @font-face {
            font-family: helvetica;
            font-style: italic;
            font-weight: 900;
            src: local('Helvetica'), url(<?php echo $baseUrl;?>/assets/fonts/HELVETICA96BLACKITALIC.woff) format('woff')
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- top header -->
    <div class="bg-white text-dark
        
        <?php if (!is_front_page() && !is_home()) {
            // shadow bottom
            echo ' shadow-sm bg-white';
        } ?>">

        <div class="container top-header">
            <div class="row align-items-center">

                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="<?php echo get_site_url(); ?>">
                            <img src="<?php echo get_custom_logo_url(); ?>" alt="<?php
                            // get the name of the site
                            echo get_bloginfo('name');
                            ?>">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                                                        
                            <?php dynamic_sidebar('header-langs'); ?>

                        </div>
                    </div>
                </nav>



            </div>
        </div>
    </div>
    <!-- /top header -->

    <!-- feutured -->
    <!-- if home page -->
    <?php
    if (is_front_page() && is_home()) {
        dynamic_sidebar('home-feutured');
    } ?>
    <!-- /feutured -->