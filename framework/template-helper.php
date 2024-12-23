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
  <path d="M13.9511 3.4186C14.2122 3.67631 14.2359 4.07953 14.0223 4.36367L13.9511 4.44509L7.6087 10.7061L13.9511 16.967C14.2122 17.2247 14.2359 17.6279 14.0223 17.9121L13.9511 17.9935C13.6901 18.2512 13.2816 18.2746 12.9938 18.0638L12.9113 17.9935L6.04851 11.2193C5.78747 10.9616 5.76374 10.5584 5.97732 10.2743L6.04851 10.1929L12.9113 3.4186C13.1984 3.13512 13.664 3.13512 13.9511 3.4186Z" fill="currentColor"/>
</svg> ' . esc_html__('Prev', 'awakenur'),
				'next_text' => esc_html__('Next', 'awakenur') . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M6.04886 17.5828C5.78781 17.3251 5.76408 16.9219 5.97766 16.6378L6.04886 16.5564L12.3913 10.2954L6.04886 4.03444C5.78781 3.77676 5.76408 3.37354 5.97766 3.0894L6.04886 3.00799C6.3099 2.75032 6.7184 2.72689 7.00625 2.93772L7.08872 3.00799L13.9515 9.78219C14.2125 10.0399 14.2362 10.4431 14.0227 10.7272L13.9515 10.8086L7.08872 17.5828C6.80157 17.8663 6.33601 17.8663 6.04886 17.5828Z" fill="currentColor"/>
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
  <path d="M13.9511 3.4186C14.2122 3.67631 14.2359 4.07953 14.0223 4.36367L13.9511 4.44509L7.6087 10.7061L13.9511 16.967C14.2122 17.2247 14.2359 17.6279 14.0223 17.9121L13.9511 17.9935C13.6901 18.2512 13.2816 18.2746 12.9938 18.0638L12.9113 17.9935L6.04851 11.2193C5.78747 10.9616 5.76374 10.5584 5.97732 10.2743L6.04851 10.1929L12.9113 3.4186C13.1984 3.13512 13.664 3.13512 13.9511 3.4186Z" fill="currentColor"/>
</svg>' . esc_html__('Prev', 'awakenur'),
				'next_text' => esc_html__('Next', 'awakenur') . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M6.04886 17.5828C5.78781 17.3251 5.76408 16.9219 5.97766 16.6378L6.04886 16.5564L12.3913 10.2954L6.04886 4.03444C5.78781 3.77676 5.76408 3.37354 5.97766 3.0894L6.04886 3.00799C6.3099 2.75032 6.7184 2.72689 7.00625 2.93772L7.08872 3.00799L13.9515 9.78219C14.2125 10.0399 14.2362 10.4431 14.0227 10.7272L13.9515 10.8086L7.08872 17.5828C6.80157 17.8663 6.33601 17.8663 6.04886 17.5828Z" fill="currentColor"/>
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
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <g clip-path="url(#clip0_16960_2640)">
    <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15.75 8.25H14.25C13.6533 8.25 13.081 8.48705 12.659 8.90901C12.2371 9.33097 12 9.90326 12 10.5V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9 13.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_16960_2640">
      <rect width="24" height="24" fill="currentColor"/>
    </clipPath>
  </defs>
</svg>
			  </a>';
			}
			if ($item['social'] == 'twitter') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <g clip-path="url(#clip0_16960_2646)">
    <path d="M3.75 3.125H7.5L16.25 16.875H12.5L3.75 3.125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M8.89687 11.2129L3.75 16.8746" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M16.2504 3.125L11.1035 8.78672" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_16960_2646">
      <rect width="20" height="20" fill="currentColor"/>
    </clipPath>
  </defs>
</svg>
			  </a>';
			}
			if ($item['social'] == 'instagram') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <g clip-path="url(#clip0_16978_6899)">
    <path d="M10 13.4204C11.7259 13.4204 13.125 12.0213 13.125 10.2954C13.125 8.56952 11.7259 7.17041 10 7.17041C8.27411 7.17041 6.875 8.56952 6.875 10.2954C6.875 12.0213 8.27411 13.4204 10 13.4204Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M13.75 2.79541H6.25C4.17893 2.79541 2.5 4.47434 2.5 6.54541V14.0454C2.5 16.1165 4.17893 17.7954 6.25 17.7954H13.75C15.8211 17.7954 17.5 16.1165 17.5 14.0454V6.54541C17.5 4.47434 15.8211 2.79541 13.75 2.79541Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.0625 7.01416C14.494 7.01416 14.8438 6.66438 14.8438 6.23291C14.8438 5.80144 14.494 5.45166 14.0625 5.45166C13.631 5.45166 13.2812 5.80144 13.2812 6.23291C13.2812 6.66438 13.631 7.01416 14.0625 7.01416Z" fill="currentColor"/>
  </g>
  <defs>
    <clipPath id="clip0_16978_6899">
      <rect width="20" height="20" fill="currentColor" transform="translate(0 0.29541)"/>
    </clipPath>
  </defs>
</svg>
			  </a>';
			}
			if ($item['social'] == 'telegram') {
				echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <g clip-path="url(#clip0_16967_5625)">
    <path d="M6.24939 10.832L13.301 17.0141C13.3822 17.0857 13.4806 17.135 13.5867 17.1572C13.6927 17.1793 13.8027 17.1735 13.9058 17.1404C14.0089 17.1072 14.1016 17.0478 14.1749 16.968C14.2481 16.8882 14.2994 16.7907 14.3236 16.6852L17.4994 2.89062C17.5025 2.87679 17.5018 2.86237 17.4973 2.84892C17.4928 2.83547 17.4848 2.82348 17.474 2.81425C17.4633 2.80502 17.4502 2.79889 17.4362 2.79651C17.4223 2.79414 17.4079 2.79561 17.3947 2.80078L1.56189 8.99687C1.4636 9.0347 1.38023 9.10339 1.3243 9.19263C1.26837 9.28187 1.2429 9.38684 1.2517 9.49179C1.26051 9.59674 1.30312 9.69601 1.37313 9.77468C1.44315 9.85335 1.5368 9.9072 1.64001 9.92812L6.24939 10.832Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6.25 10.8329L17.4539 2.80322" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.71641 13.8743L7.325 16.3556C7.23859 16.4452 7.12737 16.507 7.00561 16.533C6.88384 16.5591 6.75708 16.5481 6.64157 16.5016C6.52607 16.4551 6.42709 16.3752 6.35732 16.272C6.28755 16.1689 6.25018 16.0473 6.25 15.9228V10.8345" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_16967_5625">
      <rect width="20" height="20" fill="white" transform="translate(0 0.29541)"/>
    </clipPath>
  </defs>
</svg>
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
