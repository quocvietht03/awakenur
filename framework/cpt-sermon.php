<?php
/*
 * Sermon CPT
 */

function awakenur_sermon_register() {

	$cpt_slug = get_theme_mod('awakenur_sermon_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'sermons';
	}
	
	$labels = array(
		'name'               => esc_html__( 'Sermons', 'awakenur' ),
		'singular_name'      => esc_html__( 'Sermon', 'awakenur' ),
		'add_new'            => esc_html__( 'Add New', 'awakenur' ),
		'add_new_item'       => esc_html__( 'Add New Sermon', 'awakenur' ),
		'all_items'          => esc_html__( 'All Sermons', 'awakenur' ),
		'edit_item'          => esc_html__( 'Edit Sermon', 'awakenur' ),
		'new_item'           => esc_html__( 'Add New Sermon', 'awakenur' ),
		'view_item'          => esc_html__( 'View Item', 'awakenur' ),
		'search_items'       => esc_html__( 'Search Sermons', 'awakenur' ),
		'not_found'          => esc_html__( 'No sermon(s) found', 'awakenur' ),
		'not_found_in_trash' => esc_html__( 'No sermon(s) found in trash', 'awakenur' )
	);

  $args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => true,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'show_in_rest' 		=> true,
		'supports'        => array('title', 'editor', 'excerpt', 'thumbnail', 'comments')
  );

  add_filter( 'enter_title_here',  'awakenur_sermon_change_default_title');

  register_post_type( 'sermon' , $args );
}
add_action('init', 'awakenur_sermon_register', 1);


function awakenur_sermon_taxonomy() {

	register_taxonomy(
		"sermon_categories",
		array("sermon"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'sermon_tag',
        'sermon',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'awakenur' ),
            'singular_name' => __( 'Tag', 'awakenur' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'awakenur_sermon_taxonomy', 1);


function awakenur_sermon_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'sermon' == $screen->post_type )
		$title = esc_html__( "Enter the sermon's name here", 'awakenur' );

	return $title;
}


function awakenur_sermon_edit_columns( $sermon_columns ) {
	$sermon_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'awakenur'),
		"thumbnail"              => esc_html__('Thumbnail', 'awakenur'),
		"sermon_categories" 			 => esc_html__('Categories', 'awakenur'),
		"date"                   => esc_html__('Date', 'awakenur'),
	);
	return $sermon_columns;
}
add_filter( 'manage_edit-sermon_columns', 'awakenur_sermon_edit_columns' );

function awakenur_sermon_column_display( $sermon_columns, $post_id ) {

	switch ( $sermon_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo wp_kses_post( $thumb ); 
			} else {
				echo esc_html__('None', 'awakenur');
			}
			break;

		// Display the sermon tags in the column view
		case "sermon_categories":

		if ( $category_list = get_the_term_list( $post_id, 'sermon_categories', '', ', ', '' ) ) {
			echo wp_kses_post( $category_list );
		} else {
			echo esc_html__('None', 'awakenur');
		}
		break;
	}
}
add_action( 'manage_sermon_posts_custom_column', 'awakenur_sermon_column_display', 10, 2 );


function awakenur_sermon_query_args($params = array(), $limit = 12) {
	$query_args = array(
		'post_type' => 'sermon',
		'post_status' => 'publish',
		'posts_per_page' => $limit
	);

	if (isset($params['current_page']) && $params['current_page'] != '') {
		$query_args['paged'] = absint($params['current_page']);
	}

	if (isset($params['search_keyword']) && $params['search_keyword'] != '') {
		$query_args['s'] = $params['search_keyword'];
	}

	$query_tax = array();

	if (isset($params['sm_topic']) && $params['sm_topic'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'sermon_categories',
			'field' => 'slug',
			'terms' => explode(',', $params['sm_topic'])
		);
	}

	if (!empty($query_tax)) {
		$query_args['tax_query'] = $query_tax;
	}

	$query_meta = array();

	if (isset($params['sm_pastor']) && $params['sm_pastor'] != '') {
		$query_meta['pastor_clause'] = array(
			array(
				'key'     => 'pastor',
				'value'   => absint($params['sm_pastor']),
				'compare' => '=',
				'type'    => 'numeric'
			)
		);
	}

	if (!empty($query_meta)) {
		$query_args['meta_query'] = $query_meta;
		// $query_args['relation'] = 'AND';
	}

	return $query_args;
}

function awakenur_sermon_filter() {
	$archive_page = get_field('sermon_archive_page', 'options');
	$limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 9;
	$query_args = awakenur_sermon_query_args($_POST, $limit);
	$wp_query = new \WP_Query($query_args);
	$current_page = isset($_POST['current_page']) && $_POST['current_page'] != '' ? $_POST['current_page'] : 1;
	$total_page = $wp_query->max_num_pages;

	$paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;
	$prev_posts = ($paged - 1) * $wp_query->query_vars['posts_per_page'];
	$from = 1 + $prev_posts;
	$to = count($wp_query->posts) + $prev_posts;
	$of = $wp_query->found_posts;

	// Update Loop Post
	if ($wp_query->have_posts()) {
		ob_start();
		while ($wp_query->have_posts()) { 
			$wp_query->the_post();

			get_template_part( 'framework/templates/sermon', 'style', array('image-size' => 'medium_large') );
		}

		$output['items'] = ob_get_clean();
		$output['pagination'] = awakenur_sermon_pagination($current_page, $total_page);
	} else {
		$output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
		$output['pagination'] = '';
	}

	wp_reset_postdata();

	wp_send_json_success($output);

	die();
}
add_action('wp_ajax_awakenur_sermon_filter', 'awakenur_sermon_filter');
add_action('wp_ajax_nopriv_awakenur_sermon_filter', 'awakenur_sermon_filter');

function awakenur_sermon_pagination($current_page, $total_page) {
	if (1 >= $total_page) {
		return;
	}

	ob_start();
	?>
	<nav class="bt-pagination bt-sermon-pagination" role="navigation">
		<?php if (1 != $current_page) { ?>
			<a class="prev page-numbers" href="#" data-page="<?php echo esc_attr($current_page - 1); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M13.9511 3.4186C14.2122 3.67631 14.2359 4.07953 14.0223 4.36367L13.9511 4.44509L7.6087 10.7061L13.9511 16.967C14.2122 17.2247 14.2359 17.6279 14.0223 17.9121L13.9511 17.9935C13.6901 18.2512 13.2816 18.2746 12.9938 18.0638L12.9113 17.9935L6.04851 11.2193C5.78747 10.9616 5.76374 10.5584 5.97732 10.2743L6.04851 10.1929L12.9113 3.4186C13.1984 3.13512 13.664 3.13512 13.9511 3.4186Z" fill="currentColor"/>
</svg> <?php echo esc_html__('Prev', 'autoart'); ?></a>
		<?php } ?>

		<?php
		for ($i = 1; $i <= $total_page; $i++) {
			if (7 > $total_page) {
				if ($i == $current_page) {
					echo '<span class="page-numbers current">' . $i . '</span>';
				} else {
					echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
				}
			} else {
				if ($i == $current_page) {
					echo '<span class="page-numbers current">' . $i . '</span>';
				}

				if (5 > $current_page) {
					if ($i != $current_page && $i < $current_page + 3) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $current_page + 3) {
						echo '<span class="page-numbers dots">...</span>';
					}

					if ($i == $total_page) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}
				}

				if ($total_page - 4 < $current_page) {
					if ($i != $current_page && $i > $current_page - 3) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $current_page - 3) {
						echo '<span class="page-numbers dots">...</span>';
					}

					if ($i == 1) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}
				}

				if ($total_page - 4 >= $current_page && 5 <= $current_page) {
					if ($i != $current_page && $i > $current_page - 3 && $i < $current_page + 3) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $current_page - 3 || $i == $current_page + 3) {
						echo '<span class="page-numbers dots">...</span>';
					}

					if ($i == 1) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $total_page) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}
				}
			}
		}
		?>

		<?php if ($total_page != $current_page) { ?>
			<a class="next page-numbers" href="#" data-page="<?php echo esc_attr($current_page + 1); ?>"><?php echo esc_html__('Next', 'autoart'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M6.04886 17.5828C5.78781 17.3251 5.76408 16.9219 5.97766 16.6378L6.04886 16.5564L12.3913 10.2954L6.04886 4.03444C5.78781 3.77676 5.76408 3.37354 5.97766 3.0894L6.04886 3.00799C6.3099 2.75032 6.7184 2.72689 7.00625 2.93772L7.08872 3.00799L13.9515 9.78219C14.2125 10.0399 14.2362 10.4431 14.0227 10.7272L13.9515 10.8086L7.08872 17.5828C6.80157 17.8663 6.33601 17.8663 6.04886 17.5828Z" fill="currentColor"/>
</svg></a>
		<?php } ?>
	</nav>
	<?php
	return ob_get_clean();
}
