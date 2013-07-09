<?php

define('SITEORIGIN_IS_PREMIUM', true);

include get_template_directory().'/premium/extras/ajax-comments/ajax-comments.php';
include get_template_directory().'/premium/settings.php';

/**
 *
 */
function estate_premium_init() {
	if( siteorigin_setting('general_ajax_comments') ) siteorigin_ajax_comments_activate();
	if( siteorigin_setting('layout_responsive_menu') ){
		include get_template_directory().'/premium/extras/mobilenav/mobilenav.php';
	}
}
add_action('after_setup_theme', 'estate_premium_init', 11);

/**
 * @param $text
 * @return string
 */
function estate_premium_filter_attribution($text){
	if(!siteorigin_setting('general_footer_attribution')) return '';
	else return $text;
}
add_filter('siteorigin_attribution_footer', 'estate_premium_filter_attribution');

/**
 *
 */
function estate_premium_responsive_header(){
	if(siteorigin_setting('layout_responsive')) {
		?><meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" /><?php
	}
}
add_action('wp_head', 'estate_premium_responsive_header');

/**
 * Enqueue the CSS required for the responsive layout
 */
function estate_premium_responsive_css(){
	if(siteorigin_setting('layout_responsive')) {
		wp_enqueue_style('estate-responsive', get_template_directory_uri().'/premium/responsive.css', array(), SITEORIGIN_THEME_VERSION);
	}
}
add_action('wp_enqueue_scripts', 'estate_premium_responsive_css', 11);

/**
 * Add custom body classes.
 *
 * @param $classes
 * @return array
 * @package clearly
 * @since 1.0
 */
function estate_premium_body_class($classes){
	if(siteorigin_setting('layout_responsive')) $classes[] = 'responsive';
	return $classes;
}
add_filter('body_class', 'estate_premium_body_class');

function estate_premium_mobilenav_res(){
	return 720;
}
add_filter('siteorigin_mobilenav_resolution', 'estate_premium_mobilenav_res');