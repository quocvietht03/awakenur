<?php

/**
 * Block Name: Widget - Recent Posts
 **/

$number_posts = get_field('number_posts');

$recent_posts = wp_get_recent_posts(array(
	'numberposts' => $number_posts,
	'post_status' => 'publish'
));

?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-recent-posts">
	<?php foreach ($recent_posts as $post_item) { ?>
		<div class="bt-post">
			<a href="<?php echo get_permalink($post_item['ID']) ?>">
				<div class="bt-post--thumbnail">
					<div class="bt-cover-image">
						<?php echo get_the_post_thumbnail($post_item['ID'], 'thumbnail'); ?>
					</div>
				</div>
				<div class="bt-post--infor">
					<div class="bt-post--date">
						<?php echo get_the_date(get_option('date_format'), $post_item['ID']); ?>
					</div>
					<?php echo '<h3 class="bt-post--title">' . $post_item['post_title'] . '</h3>'; ?>
				</div>
			</a>
		</div>
	<?php } ?>
</div>