<?php

/* Add Theme Options Page */
function awakenur_add_theme_options_page() {
    if( function_exists('acf_add_options_page') ) {
        $option_page = acf_add_options_page(array(
            'page_title'    => esc_html__('Theme Options', 'awakenur'),
            'menu_title'    => esc_html__('Theme Options', 'awakenur'),
            'menu_slug'     => 'theme-options-page',
            'capability'    => 'edit_posts',
            'redirect'      => false
      ));
    }
}
add_action('acf/init', 'awakenur_add_theme_options_page');

function awakenur_acf_json_save_point( $path ) {
	// update path
	$path = get_template_directory() . '/framework/acf-options';

	// return
	return $path;
}
add_filter( 'acf/settings/save_json', 'awakenur_acf_json_save_point' );

function awakenur_acf_json_load_point( $paths ) {
	// reawakenurve original path (optional)
	unset( $paths[0] );
	// append path
	$paths[] = get_template_directory() . '/framework/acf-options';

	// return
	return $paths;
}
add_filter( 'acf/settings/load_json', 'awakenur_acf_json_load_point' );
