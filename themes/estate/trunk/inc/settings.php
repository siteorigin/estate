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
	siteorigin_settings_add_section('home', __('Home Page', 'estate'));
	siteorigin_settings_add_section('layout', __('Layout', 'estate'));

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
	
	siteorigin_settings_add_teaser('general', 'ajax_comments', __('Ajax Comments', 'estate'), array(
		'description' => __('Keep your conversations flowing with ajax comments.', 'estate')
	));

	/**
	 * Home Page
	 */

	$slider_options = array('' => __('None', 'estate'), 'demo' => __('Demo', 'estate'));
	if(function_exists('siteorigin_slider_get_sliders')){
		$sliders = siteorigin_slider_get_sliders();
		foreach($sliders as $slider){
			$slider_options[$slider->ID] = $slider->post_title;
		}
		$description = null;
	}
	else{
		$description = sprintf(
			__('Display a slider on your home page. Requires <a href="%s">SiteOrigin Slider</a> plugin', 'estate'),
			siteorigin_plugin_activation_install_url('siteorigin-slider', __('SiteOrigin Slider', 'estate'), 'http://gpriday.s3.amazonaws.com/plugins/siteorigin-slider.zip')
		);
	}

	siteorigin_settings_add_field('home', 'slider', 'select', __('Home Page Slider', 'estate'), array(
		'description' =>$description,
		'options' => $slider_options
	));

	/**
	 * Layout Settings
	 */

	siteorigin_settings_add_field('layout', 'responsive', 'checkbox', __('Responsive Layout', 'estate'), array(
		'description' => __('Scale your layout for small screen devices.', 'estate')
	));
	
	siteorigin_settings_add_teaser('layout', 'responsive_menu', __('Responsive Menu', 'estate'), array(
		'description' => __('Use a special responsive menu for small screen devices.', 'estate')
	));
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
	$defaults['general_ajax_comments'] = false;
	$defaults['general_site_description'] = true;
	
	$defaults['home_slider'] = 'demo';

	$defaults['layout_responsive'] = true;
	$defaults['layout_responsive_menu'] = true;

	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'estate_theme_setting_defaults');