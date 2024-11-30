<?php
/*
 * Pastor CPT
 */

function awakenur_pastor_register() {

	$cpt_slug = get_theme_mod('awakenur_pastor_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'pastors';
	}

	$labels = array(
		'name'               => esc_html__( 'Pastors', 'awakenur' ),
		'singular_name'      => esc_html__( 'Pastor', 'awakenur' ),
		'add_new'            => esc_html__( 'Add New', 'awakenur' ),
		'add_new_item'       => esc_html__( 'Add New Pastor', 'awakenur' ),
		'all_items'          => esc_html__( 'All Pastor', 'awakenur' ),
		'edit_item'          => esc_html__( 'Edit Pastor', 'awakenur' ),
		'new_item'           => esc_html__( 'Add New Pastor', 'awakenur' ),
		'view_item'          => esc_html__( 'View Item', 'awakenur' ),
		'search_items'       => esc_html__( 'Search Pastor', 'awakenur' ),
		'not_found'          => esc_html__( 'No pastor(s) found', 'awakenur' ),
		'not_found_in_trash' => esc_html__( 'No pastor(s) found in trash', 'awakenur' )
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
		'supports'        => array('title', 'editor', 'thumbnail', 'comments')
  );

  add_filter( 'enter_title_here',  'awakenur_pastor_change_default_title');

  register_post_type( 'pastor' , $args );
}
add_action('init', 'awakenur_pastor_register', 1);


function awakenur_pastor_taxonomy() {

	register_taxonomy(
		"pastor_categories",
		array("pastor"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'pastor_tag',
        'pastor',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'awakenur' ),
            'singular_name' => __( 'Tag', 'awakenur' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'awakenur_pastor_taxonomy', 1);


function awakenur_pastor_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'pastor' == $screen->post_type )
		$title = esc_html__( "Enter the pastor's name here", 'awakenur' );

	return $title;
}


function awakenur_pastor_edit_columns( $pastor_columns ) {
	$pastor_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'awakenur'),
		"thumbnail"              => esc_html__('Thumbnail', 'awakenur'),
		"pastor_categories" 			 => esc_html__('Categories', 'awakenur'),
		"date"                   => esc_html__('Date', 'awakenur'),
	);
	return $pastor_columns;
}
add_filter( 'manage_edit-pastor_columns', 'awakenur_pastor_edit_columns' );

function awakenur_pastor_column_display( $pastor_columns, $post_id ) {

	switch ( $pastor_columns ) {

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

		// Display the pastor tags in the column view
		case "pastor_categories":

		if ( $category_list = get_the_term_list( $post_id, 'pastor_categories', '', ', ', '' ) ) {
			echo wp_kses_post( $category_list );
		} else {
			echo esc_html__('None', 'awakenur');
		}
		break;
	}
}
add_action( 'manage_pastor_posts_custom_column', 'awakenur_pastor_column_display', 10, 2 );
