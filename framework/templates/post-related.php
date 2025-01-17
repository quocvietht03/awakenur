<?php
$post_id = get_the_ID();
if (function_exists('get_field')) {
	$video_type = get_field('video_type', $post_id);
	$video_mp4 = get_field('video_mp4', $post_id);
	$youtube = get_field('youtube', $post_id);
	$vimeo = get_field('vimeo', $post_id);
} else {
	$video_type = '';
	$video_mp4 = '';
	$youtube = '';
	$vimeo = '';
}

if ($video_type == 'youtube') {
  $video_source = $youtube;
} elseif ($video_type == 'vimeo') {
  $video_source = $vimeo;
} else {
  $video_source = $video_mp4;
}

$post_excerpt = get_the_excerpt($post_id);

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <div class="bt-post--wrap-image">
      <?php echo awakenur_post_cover_featured_render('medium_large'); ?>
      <?php if (!empty($video_source)) { ?>
        <a class="bt-play-video bt-magnific-popup-js" href="<?php echo esc_url('#bt_play_video_' . $post_id); ?>"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.75 3.78441V20.3069C6.75245 20.4388 6.78962 20.5676 6.85776 20.6805C6.9259 20.7934 7.0226 20.8864 7.13812 20.95C7.25364 21.0136 7.38388 21.0456 7.51572 21.0428C7.64756 21.04 7.77634 21.0025 7.88906 20.9341L21.3966 12.6728C21.5045 12.6075 21.5937 12.5155 21.6556 12.4056C21.7175 12.2958 21.7501 12.1718 21.7501 12.0457C21.7501 11.9195 21.7175 11.7956 21.6556 11.6857C21.5937 11.5758 21.5045 11.4838 21.3966 11.4185L7.88906 3.15722C7.77634 3.08879 7.64756 3.05129 7.51572 3.04851C7.38388 3.04572 7.25364 3.07774 7.13812 3.14135C7.0226 3.20495 6.9259 3.29789 6.85776 3.41079C6.78962 3.52369 6.75245 3.65256 6.75 3.78441Z" fill="currentColor" />
          </svg></a>
      <?php } ?>
      <div class="bt-post--publish">
        <span><?php echo get_the_date('d'); ?></span>
        <?php echo get_the_date('M'); ?>
      </div>
    </div>
    <div class="bt-post--content">
      <?php echo awakenur_post_title_render(); ?>
      <?php
				if (!empty($post_excerpt)) { 
					echo '<div class="bt-post--excerpt">' . wp_trim_words( $post_excerpt , 22, '...' ) . '</div>';
				} 
			?>
    </div>
  </div>
</article>
<?php if (!empty($video_source)) { ?>
  <div id="<?php echo esc_attr('bt_play_video_' . $post_id); ?>" class="bt-post-popup mfp-hide">
    <div class="bt-post-popup--inner bt-video-wrap">
      <?php if ($video_type == 'youtube' || $video_type == 'vimeo') { ?>
        <?php
        if ($video_type == 'youtube') {
          echo '<div class="bt-cover-iframe">' . $youtube . '</div>';
        } else {
          echo '<div class="bt-cover-iframe">' . $vimeo . '</div>';
        }
        ?>
      <?php } else { ?>
        <div class="bt-cover-video">
          <video class="video" width="600" height="360" controls>
            <source src="<?php echo esc_url($video_mp4); ?>" type="video/mp4">
          </video>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } ?>