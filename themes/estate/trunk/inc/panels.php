<?php
/**
 * Integrates this theme with SiteOrigin panels page builder.
 * 
 * @package estate
 * @since 1.0
 * @license GPL 2.0
 */

/**
 * Adds default page layouts
 *
 * @param $layouts
 */
function estate_prebuilt_page_layouts($layouts){
	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'estate_prebuilt_page_layouts');