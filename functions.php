<?php

/**
 * ehsanlawpllc functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ehsanlawpllc
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

// https://wp-skills.com/tools/wordpress-widget-generator
require_once('navbar-walker.php');
// require_once('widgets/feutured.php');

// if theme is parent theme

// require get_template_directory() . '/widgets/feutured.php';
// require get_template_directory() . '/widgets/about.php';
// require get_template_directory() . '/widgets/social_ media_icons.php';
// require get_template_directory() . '/widgets/practice_areas.php';
// require get_template_directory() . '/widgets/news_posts.php';
// require get_template_directory() . '/widgets/services.php';
// require get_template_directory() . '/widgets/get_in_touch.php';
// require get_template_directory() . '/widgets/recent_news.php';
// require get_template_directory() . '/widgets/header_langs.php';

if (!is_child_theme() ) {
	// The active theme is a child theme
	require get_template_directory() . '/widgets/feutured.php';
	require get_template_directory() . '/widgets/about.php';
	require get_template_directory() . '/widgets/social_ media_icons.php';
	require get_template_directory() . '/widgets/practice_areas.php';
	require get_template_directory() . '/widgets/news_posts.php';
	require get_template_directory() . '/widgets/services.php';
	require get_template_directory() . '/widgets/get_in_touch.php';
	require get_template_directory() . '/widgets/recent_news.php';
	require get_template_directory() . '/widgets/header_langs.php';
	require get_template_directory() . '/pagination.php';
	
  } else {
	// The active theme is a parent theme
	// require get_stylesheet_directory() . '/widgets/feutured.php';
	// require get_stylesheet_directory() . '/widgets/about.php';
	// require get_stylesheet_directory() . '/widgets/social_ media_icons.php';
	// require get_stylesheet_directory() . '/widgets/practice_areas.php';
	// require get_stylesheet_directory() . '/widgets/news_posts.php';
	// require get_stylesheet_directory() . '/widgets/services.php';
	// require get_stylesheet_directory() . '/widgets/get_in_touch.php';
	// require get_stylesheet_directory() . '/widgets/recent_news.php';
	// require get_stylesheet_directory() . '/widgets/header_langs.php';
  }



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ehsanlawpllc_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ehsanlawpllc, use a find and replace
		* to change 'ehsanlawpllc' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('ehsanlawpllc', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'ehsanlawpllc'),
		),
	);

	// register location for footer menu
	register_nav_menus(
		array(
			'footer-menu-1' => esc_html__('Footer Menu 1', 'ehsanlawpllc'),
		),
	);

	register_nav_menus(
		array(
			'footer-menu-2' => esc_html__('Footer Menu 2', 'ehsanlawpllc'),
		),
	);

	add_theme_support('post-thumbnails');
	add_image_size('medium', 400, 250, true);
	add_image_size('squre', 620, 480, true);
	// add_image_size( 'news_horizantal', 620, 230, true );
	// crop center top
	add_image_size('news_vertical', 620, 230, array('center', 'top'));

	add_image_size('sidebar_news', 140, 90, true);
	add_image_size('practice_areas', 294, 156, true);

	// add_image_size( 'thumbnail', 200, 130, true );
	// add_image_size( 'profile', 200, 200, true );

	show_admin_bar(false);

	// show post format
	add_theme_support('post-formats', array('aside'));
	//  'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'


	function add_footer_logo_customizer($wp_customize)
	{

		// Add the setting for the footer logo
		$wp_customize->add_setting('footer_logo');

		// Add a control for the footer logo
		$wp_customize->add_control(new WP_Customize_Image_Control(
			$wp_customize,
			'footer_logo',
			array(
				'label' => __('Footer Logo', 'textdomain'),
				'section' => 'title_tagline',
				'settings' => 'footer_logo',
				'priority' => 8,
			)
		));
	}
	add_action('customize_register', 'add_footer_logo_customizer');


	function get_nav_menu_items_by_location($menu_location, $args = [])
	{


		$menu_locations = get_nav_menu_locations();

		$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);

		$menu_name = (isset($menu_object->name) ? $menu_object->name : '');

		return $menu_name;
	}

	// rename video post format to Full width
	function my_post_formats_video($safe_text)
	{
		if ($safe_text == 'Aside')
			return 'Show Featured';
		return $safe_text;
	}
	add_filter('esc_html', 'my_post_formats_video');


	function add_additional_class_on_a($classes, $item, $args)
	{
		if (isset($args->add_a_class)) {
			$classes['class'] = $args->add_a_class;
		}
		return $classes;
	}

	add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);


	function get_custom_logo_url()
	{
		$custom_logo_id = get_theme_mod('custom_logo');
		$image = wp_get_attachment_image_src($custom_logo_id, 'full');
		return $image[0];
	}


	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ehsanlawpllc_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'ehsanlawpllc_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ehsanlawpllc_content_width()
{
	$GLOBALS['content_width'] = apply_filters('ehsanlawpllc_content_width', 640);
}
add_action('after_setup_theme', 'ehsanlawpllc_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ehsanlawpllc_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'ehsanlawpllc'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'ehsanlawpllc'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Home', 'ehsanlawpllc'),
			'id'            => 'home-1',
			'description'   => esc_html__('Add widgets here.', 'ehsanlawpllc'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Home Feutured', 'ehsanlawpllc'),
			'id'            => 'home-feutured',
			'description'   => esc_html__('Add widgets here.', 'ehsanlawpllc'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);


	register_sidebar(
		array(
			'name'          => esc_html__('Header Social Icons', 'ehsanlawpllc'),
			'id'            => 'header-social-media-icons',
			'description'   => esc_html__('Add widgets here.', 'ehsanlawpllc'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Header Langs', 'ehsanlawpllc'),
			'id'            => 'header-langs',
			'description'   => esc_html__('Add widgets here.', 'ehsanlawpllc'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'ehsanlawpllc_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function ehsanlawpllc_scripts()
{
	wp_enqueue_style('ehsanlawpllc-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('ehsanlawpllc-style', 'rtl', 'replace');

	wp_enqueue_script('ehsanlawpllc-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'ehsanlawpllc_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Settings Page: SocialIcons
// Retrieving values: get_option( 'your_field_id' )
class SocialIcons_Settings_Page
{

	public function __construct()
	{
		add_action('admin_menu', array($this, 'wph_create_settings'));
		add_action('admin_init', array($this, 'wph_setup_sections'));
		add_action('admin_init', array($this, 'wph_setup_fields'));
	}

	public function wph_create_settings()
	{
		$page_title = 'Social Icons';
		$menu_title = 'Social Icons';
		$capability = 'manage_options';
		$slug = 'SocialIcons';
		$callback = array($this, 'wph_settings_content');
		add_theme_page($page_title, $menu_title, $capability, $slug, $callback);
	}

	public function wph_settings_content()
	{ ?>
		<div class="wrap">
			<h1>Social Icons</h1>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
				settings_fields('SocialIcons');
				do_settings_sections('SocialIcons');
				submit_button();
				?>
			</form>
		</div> <?php
			}

			public function wph_setup_sections()
			{
				add_settings_section('SocialIcons_section', 'all social media icons and links are here', array(), 'SocialIcons');
			}

			public function wph_setup_fields()
			{
				$fields = array(
					array(
						'section' => 'SocialIcons_section',
						'label' => 'Icon 1',
						'id' => 'icon_1',
						'type' => 'textarea',
					),

					array(
						'section' => 'SocialIcons_section',
						'label' => 'Link 1',
						'id' => 'link_1',
						'type' => 'text',
					)
				);
				foreach ($fields as $field) {
					add_settings_field($field['id'], $field['label'], array($this, 'wph_field_callback'), 'SocialIcons', $field['section'], $field);
					register_setting('SocialIcons', $field['id']);
				}
			}
			public function wph_field_callback($field)
			{
				$value = get_option($field['id']);
				$placeholder = '';
				if (isset($field['placeholder'])) {
					$placeholder = $field['placeholder'];
				}
				switch ($field['type']) {


					case 'textarea':
						printf(
							'<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>',
							$field['id'],
							$placeholder,
							$value
						);
						break;

					default:
						printf(
							'<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
							$field['id'],
							$field['type'],
							$placeholder,
							$value
						);
				}
				if (isset($field['desc'])) {
					if ($desc = $field['desc']) {
						printf('<p class="description">%s </p>', $desc);
					}
				}
			}
		}
		new SocialIcons_Settings_Page();
