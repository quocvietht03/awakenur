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
	$limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 12;
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
			<a class="prev page-numbers" href="#" data-page="<?php echo esc_attr($current_page - 1); ?>"><svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"></path>
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
			<a class="next page-numbers" href="#" data-page="<?php echo esc_attr($current_page + 1); ?>"><?php echo esc_html__('Next', 'autoart'); ?> <svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"></path>
				</svg></a>
		<?php } ?>
	</nav>
	<?php
	return ob_get_clean();
}
