<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ehsanlawpllc
 */

?>
<!-- footer -->
<div class="footer">
    <div class="container py-5">
        <footer class="row">

            <div class="col text-center">
                <a href="index.html" class="d-flex align-items-center link-dark text-decoration-none">
                    <!-- <img src="./assets/images/footer-logo.png" alt="" class="m-auto"> -->
                    <?php echo get_custom_logo(); ?>

                </a>
            </div>

            <div class="col text-center">
                <h6 class="text-capitalize fw-bold text-white"><?php echo get_nav_menu_items_by_location('footer-menu-1'); ?></h6>
                <ul class="nav flex-column">
                    <?php
                    wp_nav_menu(array(
                        'items_wrap' => '%3$s',
                        'theme_location'  => 'footer-menu-1',
                        'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
                        'container'       => false,
                        'menu_class'      => 'nav-item mb-2',
                        'add_a_class'     => 'nav-item mb-2 text-white',

                    ));
                    ?>
                    <!-- <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li> -->

                </ul>
            </div>

            <div class="col text-center">
                <h6 class="text-capitalize fw-bold text-white"><?php echo get_nav_menu_items_by_location('footer-menu-2'); ?></h6>

                <ul class="nav flex-column">
                    <?php
                    wp_nav_menu(array(
                        'items_wrap' => '%3$s',
                        'theme_location'  => 'footer-menu-2',
                        'depth'           => 1, // 1 = no dropdowns, 2 = with dropdowns.
                        'container'       => false,
                        'menu_class'      => 'nav-item mb-2',
                        'add_a_class'     => 'nav-item mb-2 text-white',
                    ));
                    ?>
                </ul>
            </div>
            <div class="col">
                <h6 class="text-capitalize fw-bold text-white text-center">Social Media</h6>
                <br>
                <div class="d-flex align-items-center">
                    <div class="m-auto">
                        <?php dynamic_sidebar('header-social-media-icons');; ?>
                    </div>

                </div>
            </div>


        </footer>
    </div>
</div>
<!-- /footer -->

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?php wp_footer(); ?>
</body>

</html>