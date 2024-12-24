<?php
/* Register Sidebar */
if (!function_exists('awakenur_register_sidebar')) {
	function awakenur_register_sidebar()
	{
		register_sidebar(array(
			'name' => esc_html__('Main Sidebar', 'awakenur'),
			'id' => 'main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
	}
	add_action('widgets_init', 'awakenur_register_sidebar');
}

/* Add Support Upload Image Type SVG */
function awakenur_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'awakenur_mime_types');

/* Register Default Fonts */
if (!function_exists('awakenur_fonts_url')) {
	function awakenur_fonts_url()
	{
		global $awakenur_options;
		$base_font = 'Cormorant';
		$head_font = 'DM Sans';

		$font_url = '';
		if ('off' !== _x('on', 'Google font: on or off', 'awakenur')) {
			$font_url = add_query_arg('family', urlencode($base_font . ':400,400i,600,700|' . $head_font . ':400,400i,500,600,700'), "//fonts.googleapis.com/css");
		}
		return $font_url;
	}
}
/* Enqueue Script */
if (!function_exists('awakenur_enqueue_scripts')) {
	function awakenur_enqueue_scripts()
	{
		global $awakenur_options;

		wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/libs/magnific-popup/jquery.magnific-popup.js', array('jquery'), '', true);
		wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/libs/magnific-popup/magnific-popup.css', array(), false);

		wp_enqueue_script('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.js', array('jquery'), '', true);
		wp_enqueue_style('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.css', array(), false);
		if (is_singular('post') && comments_open()) {
			wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/libs/jquery-validate/jquery.validate.min.js', array('jquery'), '', true);
		}
		/* Fonts */
		wp_enqueue_style('awakenur-fonts', awakenur_fonts_url(), false);
		wp_enqueue_style('awakenur-main', get_template_directory_uri() . '/assets/css/main.css',  array(), false);
		wp_enqueue_style('awakenur-style', get_template_directory_uri() . '/style.css',  array(), false);
		wp_enqueue_script('awakenur-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '', true);
		
		if (function_exists('get_field')) {
			$dev_mode = get_field('dev_mode', 'options');
			/* Load custom style */
			$custom_style = '';

			$custom_style = get_field('custom_css_code', 'options');
			if ($dev_mode && !empty($custom_style)) {
				wp_add_inline_style('awakenur-style', $custom_style);
			}

			/* Custom script */
			$custom_script = '';
			$custom_script = get_field('custom_js_code', 'options');
			if ($dev_mode && !empty($custom_script)) {
				wp_add_inline_script('awakenur-main', $custom_script);
			}
		}
		/* Options to script */
		$js_options = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'user_info' => wp_get_current_user(),
		);
		wp_localize_script('awakenur-main', 'AJ_Options', $js_options);
		wp_enqueue_script('awakenur-main');
	}
	add_action('wp_enqueue_scripts', 'awakenur_enqueue_scripts');
}

/* Add Stylesheet And Script Backend */
if (!function_exists('awakenur_enqueue_admin_scripts')) {
	function awakenur_enqueue_admin_scripts()
	{
		wp_enqueue_script('awakenur-admin-main', get_template_directory_uri() . '/assets/js/admin-main.js', array('jquery'), '', true);
		wp_enqueue_style('awakenur-admin-main', get_template_directory_uri() . '/assets/css/admin-main.css', array(), false);
	}
	add_action('admin_enqueue_scripts', 'awakenur_enqueue_admin_scripts');
}

/**
 * Theme install
 */
require_once get_template_directory() . '/install/plugin-required.php';
require_once get_template_directory() . '/install/import-pack/import-functions.php';

/* CPT Load */
require_once get_template_directory() . '/framework/cpt-pastor.php';
require_once get_template_directory() . '/framework/cpt-sermon.php';
/* ACF Options */
require_once get_template_directory() . '/framework/acf-options.php';

/* Template functions */
require_once get_template_directory() . '/framework/template-helper.php';

/* Post Functions */
require_once get_template_directory() . '/framework/templates/post-helper.php';

/* Block Load */
require_once get_template_directory() . '/framework/block-load.php';

/* Widgets Load */
require_once get_template_directory() . '/framework/widget-load.php';

if (function_exists('get_field')) {
	/* Orbit circle effect */
	function awakenur_body_class($classes)
	{
		$orbit_circle = get_field('effect_orbit_circle', 'options');
		$bg_pattern = get_field('effect_bg_pattern', 'options');
		$bg_buble = get_field('effect_bg_buble', 'options');
		$bg_scroll = get_field('effect_bg_scroll', 'options');
		$img_zoom = get_field('effect_img_zoom', 'options');
		$button_hover = get_field('effect_button_hover', 'options');
		$effect_load_heading = get_field('effect_load_heading', 'options');
		if ($orbit_circle) {
			$classes[] = 'bt-orbit-enable';
		}

		if ($bg_pattern) {
			$classes[] = 'bt-bg-pattern-enable';
		}

		if ($bg_buble) {
			$classes[] = 'bt-bg-buble-enable';
		}

		if ($bg_scroll) {
			$classes[] = 'bt-bg-scroll-enable';
		}

		if ($img_zoom) {
			$classes[] = 'bt-img-zoom-enable';
		}
		if ($button_hover) {
			$classes[] = 'bt-button-hover-enable';
		}
		if ($effect_load_heading) {
			$classes[] = 'bt-effect-heading-enable';
		}
		return $classes;
	}
	add_filter('body_class', 'awakenur_body_class');
}

/* Custom number posts per page */
add_action('pre_get_posts', 'bt_custom_posts_per_page');
function bt_custom_posts_per_page($query) {
	if ( $query->is_post_type_archive( 'service' ) && $query->is_main_query() && ! is_admin() ) {
		$query->set( 'posts_per_page', 12 );
	}

	if ( $query->is_post_type_archive( 'therapist' ) && $query->is_main_query() && ! is_admin() ) {
		$query->set( 'posts_per_page', 12 );
	}
};