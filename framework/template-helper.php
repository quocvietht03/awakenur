<?php
if (! isset($content_width)) $content_width = 900;
if (is_singular()) wp_enqueue_script("comment-reply");

if (! function_exists('awakenur_setup')) {
	function awakenur_setup()
	{
		/* Load textdomain */
		load_theme_textdomain('awakenur', get_template_directory() . '/languages');

		/* Add custom logo */
		add_theme_support('custom-logo');

		/* Add RSS feed links to <head> for posts and comments. */
		add_theme_support('automatic-feed-links');

		/* Enable support for Post Thumbnails, and declare sizes. */
		add_theme_support('post-thumbnails');

		/* Enable support for Title Tag */
		add_theme_support("title-tag");

		/* This theme uses wp_nav_menu() in locations. */
		register_nav_menus(array(
			'primary_menu'   => esc_html__('Primary Menu', 'awakenur'),

		));

		/* This theme styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width. */
		add_editor_style('editor-style.css');

		/* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		));

		/* This theme allows users to set a custom background. */
		add_theme_support('custom-background', apply_filters('awakenur_custom_background_args', array(
			'default-color' => 'f5f5f5',
		)));

		/* Add support for featured content. */
		add_theme_support('featured-content', array(
			'featured_content_filter' => 'awakenur_get_featured_posts',
			'max_posts' => 6,
		));

		/* This theme uses its own gallery styles. */
		add_filter('use_default_gallery_style', '__return_false');
	}
}
add_action('after_setup_theme', 'awakenur_setup');

/* Custom Site Title */
if (! function_exists('awakenur_wp_title')) {
	function awakenur_wp_title($title, $sep)
	{
		global $paged, $page;
		if (is_feed()) {
			return $title;
		}
		// Add the site name.
		$title .= get_bloginfo('name');
		// Add the site description for the home/front page.
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page())) {
			$title = "$title $sep $site_description";
		}
		// Add a page number if necessary.
		if ($paged >= 2 || $page >= 2) {
			$title = sprintf(esc_html__('Page %s', 'awakenur'), max($paged, $page)) . " $sep $title";
		}
		return $title;
	}
	add_filter('wp_title', 'awakenur_wp_title', 10, 2);
}

/* Logo */
if (!function_exists('awakenur_logo')) {
	function awakenur_logo($url = '', $height = 30)
	{
		if (!$url) {
			$url = get_template_directory_uri() . '/assets/images/site-logo.png';
		}
		echo '<a href="' . home_url('/') . '"><img class="logo" style="height: ' . esc_attr($height) . 'px; width: auto;" src="' . esc_url($url) . '" alt="' . esc_attr__('Logo', 'awakenur') . '"/></a>';
	}
}

/* Nav Menu */
if (!function_exists('awakenur_nav_menu')) {
	function awakenur_nav_menu($menu_slug = '', $theme_location = '', $container_class = '')
	{
		if (has_nav_menu($theme_location) || $menu_slug) {
			wp_nav_menu(array(
				'menu'				=> $menu_slug,
				'container_class' 	=> $container_class,
				'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'theme_location'  	=> $theme_location
			));
		} else {
			wp_page_menu(array(
				'menu_class'  => $container_class
			));
		}
	}
}
/* Page title */
if (!function_exists('awakenur_page_title')) {
	function awakenur_page_title()
	{
		ob_start();
		if (is_front_page()) {
			esc_html_e('Home', 'awakenur');
		} elseif (is_home()) {
			esc_html_e('Blog', 'awakenur');
		} elseif (is_search()) {
			esc_html_e('Search', 'awakenur');
		} elseif (is_404()) {
			esc_html_e('404', 'awakenur');
		} elseif (is_page()) {
			echo get_the_title();
		} elseif (is_archive()) {
			if (is_category()) {
				single_cat_title();
			} elseif (get_post_type() == 'sermon' || get_post_type() == 'pastor') {
				if (is_post_type_archive('sermon')) {
					esc_html_e('Sermons', 'awakenur');
				} elseif (is_post_type_archive('pastor')) {
					esc_html_e('Pastors', 'awakenur');
				} else {
					single_term_title();
				}
			} elseif (is_tag()) {
				single_tag_title();
			} elseif (is_author()) {
				printf(__('Author: %s', 'awakenur'), '<span class="vcard">' . get_the_author() . '</span>');
			} elseif (is_day()) {
				printf(__('Day: %s', 'awakenur'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_month()) {
				printf(__('Month: %s', 'awakenur'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_year()) {
				printf(__('Year: %s', 'awakenur'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_tax('post_format', 'post-format-aside')) {
				esc_html_e('Aside', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-gallery')) {
				esc_html_e('Gallery', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-image')) {
				esc_html_e('Image', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-video')) {
				esc_html_e('Video', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-quote')) {
				esc_html_e('Quote', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-link')) {
				esc_html_e('Link', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-status')) {
				esc_html_e('Status', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-audio')) {
				esc_html_e('Audio', 'awakenur');
			} elseif (is_tax('post_format', 'post-format-chat')) {
				esc_html_e('Chat', 'awakenur');
			} else {
				esc_html_e('Archive', 'awakenur');
			}
		} else {
			echo get_the_title();
		}

		return ob_get_clean();
	}
}

/* Page breadcrumb */
if (!function_exists('awakenur_page_breadcrumb')) {
	function awakenur_page_breadcrumb($home_text = 'Home', $delimiter = '-')
	{
		global $post;

		if (is_front_page()) {
			echo '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ' . esc_html('Front Page', 'awakenur');
		} elseif (is_home()) {
			echo  '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ' . esc_html('Blog', 'awakenur');
		} else {
			echo '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ';
		}

		if (is_category()) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' <span class="bt-deli">' . $delimiter . '</span> ');
			echo '<span class="current">' . single_cat_title(esc_html__('Archive by category: ', 'awakenur'), false) . '</span>';
		} elseif (is_tag()) {
			echo '<span class="current">' . single_tag_title(esc_html__('Posts tagged: ', 'awakenur'), false) . '</span>';
		} elseif (is_post_type_archive()) {
			echo '<span class="current">' . post_type_archive_title(esc_html__('Archive: ', 'awakenur'), false) . '</span>';
		} elseif (is_tax()) {
			echo '<span class="current">' . single_term_title(esc_html__('Archive by taxonomy: ', 'awakenur'), false) . '</span>';
		} elseif (is_search()) {
			echo '<span class="current">' . esc_html__('Search results for: ', 'awakenur') . get_search_query() . '</span>';
		} elseif (is_day()) {
			echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . ' ' . get_the_time('Y') . '</a> <span class="bt-deli">' . $delimiter . '</span> ';
			echo '<span class="current">' . get_the_time('d') . '</span>';
		} elseif (is_month()) {
			echo '<span class="current">' . get_the_time('F') . ' ' . get_the_time('Y') . '</span>';
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				if (get_post_type() == 'product') {
					$terms = get_the_terms(get_the_ID(), 'product_cat', '', '');
					if (!empty($terms) && !is_wp_error($terms)) {
						the_terms(get_the_ID(), 'product_cat', '', ', ');
						echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
					} else {
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				} else {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					if ($post_type->rewrite) {
						echo '<a href="' . esc_url(home_url('/')) . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
						echo ' <span class="bt-deli">' . $delimiter . '</span> ';
					}
					echo '<span class="current">' . get_the_title() . '</span>';
				}
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' <span class="bt-deli">' . $delimiter . '</span> ');
				echo '' . $cats;
				echo '<span class="current">' . get_the_title() . '</span>';
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			if ($post_type) echo '<span class="current">' . $post_type->labels->name . '</span>';
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_page() && !is_front_page() && !$post->post_parent) {
			echo '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_page() && !is_front_page() && $post->post_parent) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo '' . $breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' <span class="bt-deli">' . $delimiter . '</span> ';
			}
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . esc_html__('Articles posted by ', 'awakenur') . $userdata->display_name . '</span>';
		} elseif (is_404()) {
			echo '<span class="current">' . esc_html__('Error 404', 'awakenur') . '</span>';
		}

		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . esc_html__('Page', 'awakenur') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
		}
	}
}

/* Display navigation to next/previous post */
if (! function_exists('awakenur_post_nav')) {
	function awakenur_post_nav()
	{
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next     = get_adjacent_post(false, '', false);
		if (! $next && ! $previous) {
			return;
		}
?>
		<nav class="bt-post-nav clearfix">
			<?php
			previous_post_link('<div class="bt-post-nav--item bt-prev"><span>' . esc_html__('Previous Post', 'awakenur') . '</span><h3>%link</h3></div>');
			next_post_link('<div class="bt-post-nav--item bt-next"><span>' . esc_html__('Next Post', 'awakenur') . '</span><h3>%link</h3></div>');
			?>
		</nav>
	<?php
	}
}

/* Display paginate links */
if (! function_exists('awakenur_paginate_links')) {
	function awakenur_paginate_links($wp_query)
	{
		if ($wp_query->max_num_pages <= 1) {
			return;
		}
	?>
		<nav class="bt-pagination" role="navigation">
			<?php
			$big = 999999999; // need an unlikely integer
			echo paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages,
				'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M13.9511 3.4186C14.2122 3.67631 14.2359 4.07953 14.0223 4.36367L13.9511 4.44509L7.6087 10.7061L13.9511 16.967C14.2122 17.2247 14.2359 17.6279 14.0223 17.9121L13.9511 17.9935C13.6901 18.2512 13.2816 18.2746 12.9938 18.0638L12.9113 17.9935L6.04851 11.2193C5.78747 10.9616 5.76374 10.5584 5.97732 10.2743L6.04851 10.1929L12.9113 3.4186C13.1984 3.13512 13.664 3.13512 13.9511 3.4186Z" fill="#4F320E"/>
</svg> ' . esc_html__('Prev', 'awakenur'),
				'next_text' => esc_html__('Next', 'awakenur') . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M6.04886 17.5828C5.78781 17.3251 5.76408 16.9219 5.97766 16.6378L6.04886 16.5564L12.3913 10.2954L6.04886 4.03444C5.78781 3.77676 5.76408 3.37354 5.97766 3.0894L6.04886 3.00799C6.3099 2.75032 6.7184 2.72689 7.00625 2.93772L7.08872 3.00799L13.9515 9.78219C14.2125 10.0399 14.2362 10.4431 14.0227 10.7272L13.9515 10.8086L7.08872 17.5828C6.80157 17.8663 6.33601 17.8663 6.04886 17.5828Z" fill="#4F320E"/>
</svg>',
			));
			?>
		</nav>
	<?php
	}
}

/* Display navigation to next/previous set of posts */
if (! function_exists('awakenur_paging_nav')) {
	function awakenur_paging_nav()
	{
		if ($GLOBALS['wp_query']->max_num_pages < 2) {
			return;
		}

		$paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		$pagenum_link = html_entity_decode(get_pagenum_link());
		$query_args   = array();
		$url_parts    = explode('?', $pagenum_link);

		if (isset($url_parts[1])) {
			wp_parse_str($url_parts[1], $query_args);
		}

		$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
		$pagenum_link = trailingslashit($pagenum_link) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	?>
		<nav class="bt-pagination" role="navigation">
			<?php
			echo paginate_links(array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map('urlencode', $query_args),
				'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M13.9511 3.4186C14.2122 3.67631 14.2359 4.07953 14.0223 4.36367L13.9511 4.44509L7.6087 10.7061L13.9511 16.967C14.2122 17.2247 14.2359 17.6279 14.0223 17.9121L13.9511 17.9935C13.6901 18.2512 13.2816 18.2746 12.9938 18.0638L12.9113 17.9935L6.04851 11.2193C5.78747 10.9616 5.76374 10.5584 5.97732 10.2743L6.04851 10.1929L12.9113 3.4186C13.1984 3.13512 13.664 3.13512 13.9511 3.4186Z" fill="#4F320E"/>
</svg>' . esc_html__('Prev', 'awakenur'),
				'next_text' => esc_html__('Next', 'awakenur') . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M6.04886 17.5828C5.78781 17.3251 5.76408 16.9219 5.97766 16.6378L6.04886 16.5564L12.3913 10.2954L6.04886 4.03444C5.78781 3.77676 5.76408 3.37354 5.97766 3.0894L6.04886 3.00799C6.3099 2.75032 6.7184 2.72689 7.00625 2.93772L7.08872 3.00799L13.9515 9.78219C14.2125 10.0399 14.2362 10.4431 14.0227 10.7272L13.9515 10.8086L7.08872 17.5828C6.80157 17.8663 6.33601 17.8663 6.04886 17.5828Z" fill="#4F320E"/>
</svg>',
			));
			?>
		</nav>
<?php
	}
}

/* Socials */
if (!function_exists('awakenur_socials_render')) {
	function awakenur_socials_render($socials)
	{
		if (empty($socials)) {
			return;
		}
		ob_start();

		foreach ($socials as $item) {
			if ($item['social'] == 'facebook') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
				<svg width="10" height="18" viewBox="0 0 10 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M9.37955 0.428292V3.08008H7.80255C6.56706 3.08008 6.33603 3.67271 6.33603 4.52651V6.42494H9.27911L8.88737 9.39816H6.33603V17.022H3.26237V9.39816H0.700983V6.42494H3.26237V4.23521C3.26237 1.69392 4.81929 0.307755 7.08938 0.307755C8.1742 0.307755 9.10835 0.388113 9.37955 0.428292Z"/></svg>
			  </a>';
			}
			if ($item['social'] == 'linkedin') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
				<svg width="17" height="15" viewBox="0 0 17 15" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M4.27079 4.91476V14.869H0.956061V4.91476H4.27079ZM4.48173 1.8411C4.49178 2.79534 3.76856 3.55873 2.61343 3.55873H2.59334C1.47838 3.55873 0.765213 2.79534 0.765213 1.8411C0.765213 0.866768 1.50852 0.123465 2.63352 0.123465C3.76856 0.123465 4.47169 0.866768 4.48173 1.8411ZM16.1938 9.16364V14.869H12.8891V9.54534C12.8891 8.2094 12.407 7.29534 11.2116 7.29534C10.2976 7.29534 9.75517 7.90806 9.5141 8.5007C9.43374 8.72168 9.40361 9.01297 9.40361 9.31431V14.869H6.09892C6.1391 5.84891 6.09892 4.91476 6.09892 4.91476H9.40361V6.36119H9.38352C9.81544 5.67815 10.5989 4.68373 12.3869 4.68373C14.5666 4.68373 16.1938 6.11007 16.1938 9.16364Z"/></svg>
			  </a>';
			}

			if ($item['social'] == 'twitter') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
				<svg width="16" height="14" viewBox="0 0 16 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M15.8842 2.40597C15.4423 3.04883 14.8898 3.62137 14.257 4.08343C14.267 4.22405 14.267 4.36468 14.267 4.5053C14.267 8.79436 11.0025 13.7363 5.036 13.7363C3.19783 13.7363 1.49024 13.204 0.053857 12.2799C0.315018 12.31 0.566134 12.32 0.837339 12.32C2.35408 12.32 3.75029 11.8078 4.86524 10.9339C3.4389 10.9037 2.24359 9.96959 1.83176 8.68387C2.03265 8.71401 2.23354 8.7341 2.44448 8.7341C2.73578 8.7341 3.02707 8.69392 3.29828 8.6236C1.81167 8.32227 0.696714 7.01646 0.696714 5.43945C0.696714 5.42941 0.696714 5.40932 0.696714 5.39927C1.12863 5.64035 1.63087 5.79102 2.16323 5.8111C1.28935 5.22852 0.716803 4.2341 0.716803 3.1091C0.716803 2.50642 0.877518 1.95396 1.15877 1.47182C2.75587 3.44057 5.15654 4.72628 7.8485 4.86691C7.79828 4.62584 7.76814 4.37472 7.76814 4.1236C7.76814 2.33566 9.21457 0.879185 11.0126 0.879185C11.9467 0.879185 12.7905 1.27093 13.3831 1.90374C14.1164 1.76311 14.8195 1.49191 15.4423 1.12026C15.2012 1.8736 14.6889 2.50642 14.0159 2.9082C14.6688 2.83789 15.3016 2.65709 15.8842 2.40597Z"/></svg>
			  </a>';
			}

			if ($item['social'] == 'google') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
				<svg width="23" height="15" viewBox="0 0 23 15" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M14.2508 7.87891C14.2508 11.8538 11.5851 14.6713 7.57227 14.6713C3.7302 14.6713 0.618591 11.5597 0.618591 7.71763C0.618591 3.87556 3.7302 0.76395 7.57227 0.76395C9.45062 0.76395 11.0159 1.44699 12.2302 2.58538L10.3424 4.39732C9.83009 3.90402 8.92886 3.32533 7.57227 3.32533C5.20062 3.32533 3.26535 5.28906 3.26535 7.71763C3.26535 10.1462 5.20062 12.1099 7.57227 12.1099C10.3234 12.1099 11.3574 10.1272 11.5187 9.11217H7.57227V6.72154H14.137C14.2034 7.07254 14.2508 7.42355 14.2508 7.87891ZM22.4757 6.72154V8.71373H20.493V10.6964H18.5008V8.71373H16.5181V6.72154H18.5008V4.73884H20.493V6.72154H22.4757Z"/></svg>
			  </a>';
			}
		}

		return ob_get_clean();
	}
}
function awakenur_check_post_types($post_type)
{

  if (is_singular()) {
    return get_post_type() === $post_type;
  }

  if (is_post_type_archive()) {
    return get_query_var('post_type') === $post_type;
  }

  if (is_category() || is_tag() || is_tax()) {
    $taxonomy = is_category() ? 'category' : (is_tag() ? 'post_tag' : get_queried_object()->taxonomy);
    $related_post_types = array_filter(get_post_types(['public' => true]), function ($type) use ($taxonomy) {
      return in_array($taxonomy, get_object_taxonomies($type));
    });
    return in_array($post_type, $related_post_types, true);
  }

  if (is_home()) {
    return $post_type === 'post';
  }

  return false;
}