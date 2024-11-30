<article <?php post_class('bt-post'); ?>>
	<div class="bt-post--featured-wrap">
		<?php echo awakenur_post_featured_render('full'); 
			echo awakenur_post_category_render();
		?>
	</div>
	<div class="bt-post--infor">
	<?php
	echo awakenur_post_publish_render();
	if (is_single()) {
		echo awakenur_single_post_title_render();
	} else {
		echo awakenur_post_title_render();
	}
	echo awakenur_post_meta_render();
	?>
	</div>
	<?php
	echo awakenur_post_content_render();
	?>
</article>