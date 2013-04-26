<?php

define('SITEORIGIN_IS_PREMIUM', true);

// Include all the premium extras
include get_template_directory() . '/premium/extras/ajax-comments/ajax-comments.php';
include get_template_directory() . '/premium/extras/mobilenav/mobilenav.php';
include get_template_directory() . '/premium/extras/css/css.php';
include get_template_directory() . '/premium/extras/widgets/widgets.php';
include get_template_directory() . '/premium/extras/customizer/customizer.php';

// Theme specific files
include get_template_directory() . '/premium/inc/settings.php';
include get_template_directory() . '/premium/inc/customizer.php';

function estate_premium_setup(){
	if(siteorigin_setting('general_ajax_comments')) siteorigin_ajax_comments_activate();
	if(siteorigin_setting('layout_responsive_menu')) add_theme_support('siteorigin-mobilenav');
	
	// We'll support all the premium widgets
	add_action('widgets_init', 'siteorigin_widgets_premium_register');
}
add_action('after_setup_theme', 'estate_premium_setup', 15);

function estate_premium_remove_credits(){
	return '';
}
add_filter('estate_credits_siteorigin', 'estate_premium_remove_credits');

/**
 * This overwrites the show on front setting when we're displaying the blog archive page.
 *
 * @param $r
 * @return bool
 */
function estate_filter_show_on_front($r){
	/**
	 * @var WP_Query
	 */
	global $estate_is_blog_archive;
	if(!empty($estate_is_blog_archive)) {
		return false;
	}
	else return $r;
}
add_filter('option_show_on_front', 'estate_filter_show_on_front');

/**
 * Sets when we're displaying the blog archive page.
 *
 * @param $new
 */
function estate_set_is_blog_archive($new) {
	global $estate_is_blog_archive;
	$estate_is_blog_archive = $new;
}