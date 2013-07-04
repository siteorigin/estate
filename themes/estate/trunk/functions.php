<?php
/**
 * estate functions and definitions
 *
 * @package estate
 * @since estate 1.0
 * @license GPL 2.0
 */

define('SITEORIGIN_THEME_VERSION', 'trunk');
define('SITEORIGIN_THEME_UPDATE_ID', 279);
define('SITEORIGIN_THEME_ENDPOINT', 'http://siteorigin.localhost');

include get_template_directory() . '/extras/settings/settings.php';
include get_template_directory() . '/extras/adminbar/adminbar.php';
include get_template_directory() . '/extras/plugin-activation/plugin-activation.php';
include get_template_directory() . '/extras/updater/updater.php';

// Load the theme specific files
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/settings.php';
include get_template_directory() . '/inc/extras.php';
include get_template_directory() . '/inc/template-tags.php';
include get_template_directory() . '/inc/gallery.php';
include get_template_directory() . '/inc/slider.php';

if( file_exists(get_template_directory().'/premium/functions.php') ) {
	// Include the premium file if it exists.
	include get_template_directory().'/premium/functions.php';
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since estate 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 632; /* pixels */

if ( ! function_exists( 'estate_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since estate 1.0
 */
function estate_setup() {
	// Initialize SiteOrigin settings
	siteorigin_settings_init();
	
	// Make the theme translatable
	load_theme_textdomain( 'estate', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add support for custom backgrounds.
	add_theme_support( 'custom-background' , array(
		'default-color' => 'f1f1f1',
	));
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'estate' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Support SiteOrigin Page Builder
	 */
	add_theme_support( 'siteorigin-panels', array(
		'margin-bottom' => 30,
		'responsive' => false,
		'home-page' => true,
		'home-page-default' => false,
	) );
	
	set_post_thumbnail_size(632, 216, true);
	add_image_size('estate-slide', 960, 480, true);

	if( !defined('SITEORIGIN_PANELS_VERSION') ){
		// Only include panels lite if the panels plugin doesn't exist
		include get_template_directory() . '/extras/panels-lite/panels-lite.php';
	}
}
endif; // estate_setup
add_action( 'after_setup_theme', 'estate_setup' );

/**
 * Setup the WordPress core custom background feature.
 * 
 * @since estate 1.0
 */
function estate_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'estate_custom_background_args', $args );
	add_theme_support( 'custom-background', $args );
}
add_action( 'after_setup_theme', 'estate_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since estate 1.0
 */
function estate_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'estate' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'estate' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'estate_widgets_init' );

/**
 * Register all the bundled scripts
 */
function estate_register_scripts(){
	wp_register_script( 'flexslider' , get_template_directory_uri().'/js/jquery.flexslider.js' , array('jquery'), '2.1' );
	wp_register_script( 'fitvids' , get_template_directory_uri().'/js/jquery.fitvids.js' , array('jquery'), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'estate_register_scripts' , 5);

/**
 * Enqueue scripts and styles
 */
function estate_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'estate-main' , get_template_directory_uri().'/js/jquery.theme-main.js' , array('jquery', 'flexslider', 'fitvids'), SITEORIGIN_THEME_VERSION );
	wp_enqueue_script( 'estate-top-slider' , get_template_directory_uri().'/js/top-slider.js' , array('jquery'), SITEORIGIN_THEME_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'estate_scripts' );

/**
 * Add custom body classes.
 * 
 * @param $classes
 * @package estate
 * @since 1.0
 */
function estate_premium_body_class($classes){
	// We'll add responsive layout in a future release.
	//if(siteorigin_setting('layout_responsive')) $classes[] = 'responsive';
	return $classes;
}
add_filter('body_class', 'estate_premium_body_class');

/**
 * Add fixes for older version of Internet Explorer
 */
function estate_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'estate_wp_head');

function estate_post_class($classes) {
	$classes[] = 'entry';
	return $classes;
}
add_filter('post_class', 'estate_post_class');