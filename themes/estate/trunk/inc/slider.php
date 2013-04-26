<?php

/**
 * Integration with SiteOrigin slider plugin
 */

function estate_slider_fields(){
	?>
	<tr>
		<td>
			<strong><?php _e('Home Slider Settings', 'estate') ?></strong>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label><?php _e('Information Text', 'estate') ?></label></th>
		<td>
			<textarea rows="2" name="siteorigin_slider[info][]" class="large-text"></textarea>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row"><label><?php _e('Background Image', 'estate') ?></label></th>
		<td>
			<div class="thumbnail-wrapper">
				<img src="#" width="75" height="75" class="thumbnail" />
			</div>
			<select class="siteorigin-media" name="siteorigin_slider[background_image][]">
				<option value="-1"><?php _e('None', 'estate') ?></option>
			</select>

			<div class="loading"></div>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label><?php _e('Slide Layout', 'estate') ?></label></th>
		<td>
			<select name="siteorigin_slider[layout][]">
				<option value="left"><?php _e('Left', 'estate') ?></option>
				<option value="right"><?php _e('Right', 'estate') ?></option>
			</select>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label><?php _e('Button Text', 'estate') ?></label></th>
		<td>
			<input type="text" name="siteorigin_slider[button][]">
		</td>
	</tr>
	<?php
}
add_action('siteorigin_slider_after_builder_form', 'estate_slider_fields');

function estate_display_top_slider(){
	if( is_front_page() && $GLOBALS['wp_query']->get('paged') == 0 && siteorigin_setting('home_slider') == 'demo' ) {
		?>
		<div id="top-slider">
			<div class="decoration"></div>
			<?php estate_home_slider_demo_render() ?>
		</div>
	<?php
	}
	elseif( is_home() && $GLOBALS['wp_query']->get('paged') == 0 && siteorigin_setting('home_slider') && class_exists('SiteOrigin_Slider_Widget') ) {
		the_widget(
			'SiteOrigin_Slider_Widget',
			array(
				'slider_id' => siteorigin_setting('home_slider'),
				'render_callback' => 'estate_home_slider_custom_render',
			),
			array(
				'before_widget' => '<div id="top-slider"><div class="decoration"></div>',
				'after_widget' => '</div>',
			)
		);
	}
	elseif(is_single() && get_post_meta(get_the_ID(), 'estate_slider_display', true)) {
		// Display this page's slider
		the_widget(
			'SiteOrigin_Slider_Widget',
			array(
				'slider_id' => siteorigin_setting('home_slider'),
				'render_callback' => 'estate_home_slider_custom_render',
			),
			array(
				'before_widget' => '<div id="top-slider"><div class="decoration"></div>',
				'after_widget' => '</div>',
			)
		);
	}
}

/**
 * Custom render function for the home page slider.
 */
function estate_home_slider_custom_render(){

}

/**
 *
 */
function estate_home_slider_demo_render(){
	get_template_part('demo/slider');
}