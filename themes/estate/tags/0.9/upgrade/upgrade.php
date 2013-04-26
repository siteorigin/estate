<?php

function estate_premium_upgrade_content($content){
	$themename = ucfirst( get_option('stylesheet') ); 
	
	$content['premium_title'] = sprintf( __('Upgrade To %s Premium', 'estate'), $themename );
	$content['premium_summary'] = sprintf(__('If you\'ve enjoyed using %1$s, you\'re going to love %1$s Premium. It\'s a robust upgrade to estate that gives you loads of cool features. For just a few dollars. A cost effective way to give your site a professional edge.', 'estate'), $themename);

	$content['buy_url'] = '';
	$content['buy_price'] = '$9';
	$content['buy_button'] = get_template_directory_uri().'/upgrade/images/button.png';
	$content['buy_message_1'] = sprintf(__("If you're not delighted with %s Premium, I'll give you a full refund", 'estate'), $themename);
	$content['buy_message_2'] = __("Buy now and enjoy continued updates", 'estate');

	// $content['featured'] = array(get_template_directory_uri().'/upgrade/promo.jpg', 1259, 1073);

	$content['features'] = array();

	$content['features'][] = array(
		'heading' => __("Customizer Integration", 'estate'),
		'content' => __("Give your site a unique look with more advanced customizer integration. Change colors, fonts and other visual aspects of your theme.", 'estate'),
	);
	
	$content['features'][] = array(
		'heading' => __("CSS Editor", 'estate'),
		'content' => __("A simple CSS editor that lets you easily add code that changes the look of your site. You can count on our support staff to help you with CSS snippets to get the look you're after. Best of all, your changes will persist across updates.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __("Contact Form 7 Support", 'estate'),
		'content' => __("Upgrading to Premium gives you a Contact Form 7 widget that you can use in your sidebars, footer and in the page builder.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __('Additional Page Templates', 'estate'),
		'content' => __("Premium gives you additional page templates for building your site. This includes a blog archive template.", 'estate'),
	);
	
	$content['features'][] = array(
		'heading' => __('Prioritized Support', 'estate'),
		'content' => __("Need help setting up your site? Upgrading gives you prioritized support on our support forums.", 'estate'),
	);

	$content['features'][] = array(
		'heading' => __("Continued Updates", 'estate'),
		'content' => __("You'll get continued updates, ensuring that your site keeps on working with the latest version of WordPress for years to come.", 'estate'),
	);
	
	/*
	$content['testimonials'] = array(
		array(
			'gravatar' => '0dacd16ef5a3d669700d4ec9fffd9e0d',
			'name' => 'Elii',
			'content' => __('I love this theme very much.', 'estate'),
		),
	);
	*/

	return $content;
}
add_filter('siteorigin_premium_content', 'estate_premium_upgrade_content');

function estate_premium_upgrade_teasers(){
	add_theme_support('siteorigin-teaser-customizer');
}
add_action('after_setup_theme', 'estate_premium_upgrade_teasers');