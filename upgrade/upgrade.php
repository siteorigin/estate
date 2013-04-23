<?php

function sostarter_premium_upgrade_content($content){
	$themename = ucfirst( get_option('stylesheet') ); 
	
	$content['premium_title'] = sprintf( __('Upgrade To %s Premium', 'sostarter'), $themename );
	$content['premium_summary'] = sprintf(__('If you\'ve enjoyed using %1$s, you\'re going to love %1$s Premium. It\'s a robust upgrade to sostarter that gives you loads of cool features. For just a few dollars. A cost effective way to give your site a professional edge.', 'sostarter'), $themename);

	$content['buy_url'] = 'http://siteorigin.com/theme/'.get_option('stylesheet').'/?redirect=premium_upgrade';
	$content['buy_price'] = '$9';
	$content['buy_button'] = get_template_directory_uri().'/upgrade/images/button.png';
	$content['buy_message_1'] = sprintf(__("If you're not delighted with %s Premium, I'll give you a full refund", 'sostarter'), $themename);
	$content['buy_message_2'] = __("Buy now and enjoy continued updates", 'sostarter');

	// $content['featured'] = array(get_template_directory_uri().'/upgrade/promo.jpg', 1259, 1073);

	$content['features'] = array();

	$content['features'][] = array(
		'heading' => __("Customizer Integration", 'sostarter'),
		'content' => __("Give your site a unique look with more advanced customizer integration. Change colors, fonts and other visual aspects of your theme.", 'sostarter'),
	);
	
	$content['features'][] = array(
		'heading' => __("CSS Editor", 'sostarter'),
		'content' => __("A simple CSS editor that lets you easily add code that changes the look of your site. You can count on our support staff to help you with CSS snippets to get the look you're after. Best of all, your changes will persist across updates.", 'sostarter'),
	);

	$content['features'][] = array(
		'heading' => __("Contact Form 7 Support", 'sostarter'),
		'content' => __("Upgrading to Premium gives you a Contact Form 7 widget that you can use in your sidebars, footer and in the page builder.", 'sostarter'),
	);

	$content['features'][] = array(
		'heading' => __('Additional Page Templates', 'sostarter'),
		'content' => __("Premium gives you additional page templates for building your site. This includes a blog archive template.", 'sostarter'),
	);
	
	$content['features'][] = array(
		'heading' => __('Prioritized Support', 'sostarter'),
		'content' => __("Need help setting up your site? Upgrading gives you prioritized support on our support forums.", 'sostarter'),
	);

	$content['features'][] = array(
		'heading' => __("Continued Updates", 'sostarter'),
		'content' => __("You'll get continued updates, ensuring that your site keeps on working with the latest version of WordPress for years to come.", 'sostarter'),
	);
	
	/*
	$content['testimonials'] = array(
		array(
			'gravatar' => '0dacd16ef5a3d669700d4ec9fffd9e0d',
			'name' => 'Elii',
			'content' => __('I love this theme very much.', 'sostarter'),
		),
	);
	*/

	return $content;
}
add_filter('siteorigin_premium_content', 'sostarter_premium_upgrade_content');

function sostarter_premium_upgrade_teasers(){
	add_theme_support('siteorigin-teaser-customizer');
}
add_action('after_setup_theme', 'sostarter_premium_upgrade_teasers');