<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package estate
 * @since estate 1.0
 * @license GPL 2.0
 */

/**
 * Setup theme settings.
 * 
 * @since estate 1.0
 */
function estate_theme_settings(){
	siteorigin_settings_add_section('general', __('General', 'estate'));
	siteorigin_settings_add_section('banner', __('Home Banner', 'estate'));

	/**
	 * General Settings
	 */
	
	siteorigin_settings_add_field('general', 'logo', 'media', __('Logo', 'estate'), array(
		'choose' => __('Choose Image', 'estate'),
		'update' => __('Set Logo', 'estate'),
	));

	siteorigin_settings_add_field('general', 'site_description', 'checkbox', __('Site Description', 'estate'), array(
		'description' => __('Display your site description under your logo.', 'estate')
	));
	
	siteorigin_settings_add_field('general', 'menu_search', 'checkbox', __('Menu Search', 'estate'), array(
		'description' => __('Display a search input in the main menu.', 'estate')
	));

	/**
	 * Home Page
	 */

	siteorigin_settings_add_field('banner', 'type', 'select', __('Home Page Banner', 'estate'), array(
		'options' => array(
			'' => __('None', 'estate'),
			'title_banner' => __('Title Banner with Image', 'estate'),
			'title_banner_noimage' => __('Title Banner without Image', 'estate'),
		)
	));

	siteorigin_settings_add_field('banner', 'image', 'media', __('Background Image', 'estate'));
	siteorigin_settings_add_field('banner', 'color', 'color', __('Background Color', 'estate'));
	siteorigin_settings_add_field('banner', 'title', 'text', __('Banner Title', 'estate'));
	siteorigin_settings_add_field('banner', 'subtitle', 'text', __('Banner Subtitle', 'estate'));
	siteorigin_settings_add_field('banner', 'button', 'text', __('Banner Button', 'estate'));
	siteorigin_settings_add_field('banner', 'button_url', 'text', __('Banner Button URL', 'estate'));

}
add_action('admin_init', 'estate_theme_settings');

/**
 * Setup theme default settings.
 * 
 * @param $defaults
 * @return mixed
 * @since estate 1.0
 */
function estate_theme_setting_defaults($defaults){
	$defaults['general_logo'] = '';
	$defaults['general_site_description'] = true;
	$defaults['general_menu_search'] = false;

	$defaults['banner_type'] = 'title_banner';
	$defaults['banner_color'] = '#1c1c1c';
	$defaults['banner_title'] = __('Your Banner Title Goes Here', 'estate');
	$defaults['banner_subtitle'] = __('And a Subtitle, Maybe To Describe What You Do', 'estate');
	$defaults['banner_button'] = __('Action Button', 'estate');
	$defaults['banner_button_url'] = '#';

	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'estate_theme_setting_defaults');