<?php

/**
 * Westcozy Cabins functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Westcozy_Cabins
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('westcozy_cabins_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function westcozy_cabins_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Westcozy Cabins, use a find and replace
		 * to change 'westcozy-cabins' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('westcozy-cabins', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		// Image size support
		add_image_size('portrait-blog', 200, 250, true);
		add_image_size('landscape-blog', 400, 200, true);
		add_image_size('portrait-cabin', 700, 700, true);
		add_image_size('gallery', 300, 200, true);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'westcozy-cabins'),
				'footer' => esc_html__('Footer ', 'westcozy-cabins'),
			)
		);

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
				'westcozy_cabins_custom_background_args',
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
endif;
add_action('after_setup_theme', 'westcozy_cabins_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function westcozy_cabins_content_width()
{
	$GLOBALS['content_width'] = apply_filters('westcozy_cabins_content_width', 640);
}
add_action('after_setup_theme', 'westcozy_cabins_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function westcozy_cabins_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'westcozy-cabins'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'westcozy-cabins'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'westcozy_cabins_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function westcozy_cabins_scripts()
{
	wp_enqueue_style('westcozy-cabins-google-fonts', "https://fonts.googleapis.com/css2?family=Inter&family=Zen+Old+Mincho:wght@400;700&display=swap", array(), null);
	wp_enqueue_style('westcozy-cabins-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('westcozy-cabins-style', 'rtl', 'replace');

	// Enqueue Login Stylesheet


	wp_enqueue_script('westcozy-cabins-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);


	// Enqueue Google Maps on Homepage and Contact page
	$id = get_the_ID();
	if ($id == 22 || $id == 30) {
		wp_enqueue_script('google-map-ACF', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ39Aq345z9yhv09fyY-fAVB7mFQxD3K0');
		wp_enqueue_script('google-map-ACF-init', get_template_directory_uri() . '/js/google-map-ACF.js', array('jquery', 'google-map-ACF'), _S_VERSION, true);
	}

	// Enqueue Isotope Js

	wp_enqueue_script('westcozy-isotope', get_template_directory_uri() . '/js/isotope.js', array('jquery'), _S_VERSION, true);
	// wp_enqueue_script('isotope', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js');

	//Enqueue Isotope Js 2 
	wp_enqueue_script('westcozy-isotope-2', get_template_directory_uri() . '/js/isotope-2.js', array('jquery', 'westcozy-isotope'), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	//gallery lightbox styles and scrpts
	wp_enqueue_style('gallery-lightbox', "https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css");
	wp_enqueue_script('gallery-lightbox', "https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js");
}
add_action('wp_enqueue_scripts', 'westcozy_cabins_scripts');

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

// Custom Post Type Registration
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}


// Google Map API
function wcc_acf_init()
{
	acf_update_setting('google_api_key', 'AIzaSyAqK_12Oy69LPP4jZnb9gzGzr6pNIpI1sw');
}
add_action('acf/init', 'wcc_acf_init');


// Enqueue Login stylesheet

function wcc_login_stylesheet()
{
	wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/login-styles.css');
}
add_action('login_enqueue_scripts', 'wcc_login_stylesheet');


// Login Logo
function wcc_login_logo()
{ ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/westcozy-favicon-final.png);
			height: 100%;
			width: 100%;
			background-size: 150px 150px;
			background-repeat: no-repeat;
			padding-bottom: 130px;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'wcc_login_logo');

function wcc_login_logo_url()
{
	return home_url();
}
add_filter('login_headerurl', 'wcc_login_logo_url');

function wcc_login_logo_url_title()
{
	return 'WestCozy Cabins';
}
add_filter('login_headertext', 'wcc_login_logo_url_title');


// Block Editor Remove
// Enables Classic Editor
function wcc_post_filter($use_block_editor, $post)
{
	// add your page ids
	$page_ids = array(22, 24,28,30,32);
	if (in_array($post->ID, $page_ids)) {
		return false;
	} else {
		return $use_block_editor;
	}
}
add_filter('use_block_editor_for_post', 'wcc_post_filter', 10, 2);



// Eliminate the default widgets on Dashboard

// Create the function to use in the action hook
function wcc_remove_dashboard_widget()
{
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
}
// Hook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'wcc_remove_dashboard_widget');



// Add a widget to the dashboard.
function wcc_add_dashboard_widgets()
{
	wp_add_dashboard_widget(
		'wporg_dashboard_widget',
		esc_html__('Welcome to WestCozy Cabins admin side ', 'wporg'),
		'wcc_dashboard_widget_render'
	);
}
add_action('wp_dashboard_setup', 'wcc_add_dashboard_widgets');

function wcc_dashboard_widget_render()
{
	// Display whatever you want to show.
	esc_html_e("Howdy! Have fun editing the website :)", "wporg");
}


// Remove admin menu links for non-Administrator accounts
function twd_remove_admin_links()
{
	if (!current_user_can('manage_options')) {
		remove_menu_page('edit.php');           // Remove Posts link
		remove_menu_page('edit-comments.php');   // Remove Comments link
	}
}
add_action('admin_menu', 'twd_remove_admin_links');

//Add dashboard widget
function wpdocs_add_dashboard_widgets()
{
	wp_add_dashboard_widget('dashboard_widget', 'Tutorial', 'dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpdocs_add_dashboard_widgets');

//Output that widget
function dashboard_widget_function($post, $callback_args)
{
	esc_html_e("Please review this PDF for help managing your company's website.", "textdomain"); ?>
	<a href="http://westcozycabins.bcitwebdeveloper.ca/wp-content/uploads/2021/11/Client-Tutorial.pdf" target='_blank'>Read More</a>
<?php
}

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	// Uncomment to view format of $toolbars
	/*
	echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die;
	*/

	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Very Simple' ] = array();
	$toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline' );

	// Edit the "Full" toolbar and remove 'code'
	// - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}

	// return $toolbars - IMPORTANT!
	return $toolbars;
}

add_filter( 'acf/fields/wysiwyg/toolbars', function ( $toolbars ) {
	$toolbars['Custom'][1] = [ 'bold', 'italic', 'underline', 'link', 'unlink'];

	return $toolbars;
} );   