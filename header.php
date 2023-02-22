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
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- link assets/style.css -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- <script src="assets/script.js"></script> -->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- cover background -->
    <div class="cover-bg"
        style="background: linear-gradient(rgba(19, 34, 66, 0.85), rgba(19, 34, 66, 0.85)),
		<?if ( is_front_page() && is_home() ) {
			echo 'url('.get_header_image().');';
			}?>">
        <!-- top header -->
        <div class="container top-header">
            <div class="row">
                <div class="col">
                    <!-- logo -->
                    <?php
						echo get_custom_logo();
						
						$ehsanlawpllc_description = get_bloginfo( 'description', 'display' );
						if ( $ehsanlawpllc_description || is_customize_preview() ) : ?>
                    <p class="site-description">
                        <?php echo $ehsanlawpllc_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </p>
                    <?php endif; ?>

                </div>
                <div class="col d-flex align-items-center">

                    <div class="ms-auto">
						<?php dynamic_sidebar( 'header-social-media-icons' ); ; ?>
						
                        <!-- <ul class="social-top">
                            <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M15.12,5.32H17V2.14A26.11,26.11,0,0,0,14.26,2C11.54,2,9.68,3.66,9.68,6.7V9.32H6.61v3.56H9.68V22h3.68V12.88h3.06l.46-3.56H13.36V7.05C13.36,6,13.64,5.32,15.12,5.32Z" />
                                    </svg></a></li>
                            <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M17.34,5.46h0a1.2,1.2,0,1,0,1.2,1.2A1.2,1.2,0,0,0,17.34,5.46Zm4.6,2.42a7.59,7.59,0,0,0-.46-2.43,4.94,4.94,0,0,0-1.16-1.77,4.7,4.7,0,0,0-1.77-1.15,7.3,7.3,0,0,0-2.43-.47C15.06,2,14.72,2,12,2s-3.06,0-4.12.06a7.3,7.3,0,0,0-2.43.47A4.78,4.78,0,0,0,3.68,3.68,4.7,4.7,0,0,0,2.53,5.45a7.3,7.3,0,0,0-.47,2.43C2,8.94,2,9.28,2,12s0,3.06.06,4.12a7.3,7.3,0,0,0,.47,2.43,4.7,4.7,0,0,0,1.15,1.77,4.78,4.78,0,0,0,1.77,1.15,7.3,7.3,0,0,0,2.43.47C8.94,22,9.28,22,12,22s3.06,0,4.12-.06a7.3,7.3,0,0,0,2.43-.47,4.7,4.7,0,0,0,1.77-1.15,4.85,4.85,0,0,0,1.16-1.77,7.59,7.59,0,0,0,.46-2.43c0-1.06.06-1.4.06-4.12S22,8.94,21.94,7.88ZM20.14,16a5.61,5.61,0,0,1-.34,1.86,3.06,3.06,0,0,1-.75,1.15,3.19,3.19,0,0,1-1.15.75,5.61,5.61,0,0,1-1.86.34c-1,.05-1.37.06-4,.06s-3,0-4-.06A5.73,5.73,0,0,1,6.1,19.8,3.27,3.27,0,0,1,5,19.05a3,3,0,0,1-.74-1.15A5.54,5.54,0,0,1,3.86,16c0-1-.06-1.37-.06-4s0-3,.06-4A5.54,5.54,0,0,1,4.21,6.1,3,3,0,0,1,5,5,3.14,3.14,0,0,1,6.1,4.2,5.73,5.73,0,0,1,8,3.86c1,0,1.37-.06,4-.06s3,0,4,.06a5.61,5.61,0,0,1,1.86.34A3.06,3.06,0,0,1,19.05,5,3.06,3.06,0,0,1,19.8,6.1,5.61,5.61,0,0,1,20.14,8c.05,1,.06,1.37.06,4S20.19,15,20.14,16ZM12,6.87A5.13,5.13,0,1,0,17.14,12,5.12,5.12,0,0,0,12,6.87Zm0,8.46A3.33,3.33,0,1,1,15.33,12,3.33,3.33,0,0,1,12,15.33Z" />
                                    </svg></a></li>
                            <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M16.6 14c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.6.8-.8 1-.1.2-.3.2-.5.1-.7-.3-1.4-.7-2-1.2-.5-.5-1-1.1-1.4-1.7-.1-.2 0-.4.1-.5.1-.1.2-.3.4-.4.1-.1.2-.3.2-.4.1-.1.1-.3 0-.4-.1-.1-.6-1.3-.8-1.8-.1-.7-.3-.7-.5-.7h-.5c-.2 0-.5.2-.6.3-.6.6-.9 1.3-.9 2.1.1.9.4 1.8 1 2.6 1.1 1.6 2.5 2.9 4.2 3.7.5.2.9.4 1.4.5.5.2 1 .2 1.6.1.7-.1 1.3-.6 1.7-1.2.2-.4.2-.8.1-1.2l-.4-.2m2.5-9.1C15.2 1 8.9 1 5 4.9c-3.2 3.2-3.8 8.1-1.6 12L2 22l5.3-1.4c1.5.8 3.1 1.2 4.7 1.2 5.5 0 9.9-4.4 9.9-9.9.1-2.6-1-5.1-2.8-7m-2.7 14c-1.3.8-2.8 1.3-4.4 1.3-1.5 0-2.9-.4-4.2-1.1l-.3-.2-3.1.8.8-3-.2-.3c-2.4-4-1.2-9 2.7-11.5S16.6 3.7 19 7.5c2.4 3.9 1.3 9-2.6 11.4" />
                                    </svg></a></li>
                            <li><a href=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
                                        <path
                                            d="M21.06 18.59zm0 0zm-.06.04zM31.93 6H8.07A2 2 0 0 0 6 8v24a2 2 0 0 0 2.07 2h23.86A2 2 0 0 0 34 32V8a2 2 0 0 0-2.07-2zM14.49 29.44h-4.23V16.79h4.23zm-2.12-14.37A2.18 2.18 0 0 1 10 12.89a2.21 2.21 0 0 1 2.4-2.19 2.19 2.19 0 1 1 0 4.37zm17.37 14.37h-4.23v-6.77c0-1.7-.61-2.85-2.14-2.85a2.31 2.31 0 0 0-2.17 1.53 2.92 2.92 0 0 0-.14 1v7.06h-4.23s.05-11.46 0-12.65h4.23v1.8a4.19 4.19 0 0 1 3.81-2.09c2.78 0 4.87 1.81 4.87 5.69zm-8.68-10.85zm0 0zm0 0zm0 0z" />
                                    </svg></a></li>
                        </ul> -->
                    </div>

                </div>

            </div>
        </div>
        <!-- /top header -->

        <!-- menu -->
        <nav id="menu" class="navbar navbar-expand-lg bg-dark p-0 sticky-top">
            <div class="container-fluid">

                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
		if ( is_front_page() && is_home() ) {
			dynamic_sidebar( 'home-feutured' );
			
			}?>
		<!-- /feutured -->

    </div>
    <!-- /cover background -->