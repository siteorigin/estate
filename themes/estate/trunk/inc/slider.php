<?php

/**
 * Integration with SiteOrigin slider plugin
 */

function estate_slider_fields(){
	?>
	<tr>
		<td>
			<strong>Home Slider Settings</strong>
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