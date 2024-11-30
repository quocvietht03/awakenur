<?php
$post_id = get_the_ID();
$terms = get_the_terms($post_id, 'sermon_categories');
$video_type = get_field('video_type', $post_id);
$video_mp4 = get_field('video_mp4', $post_id);
$youtube = get_field('youtube', $post_id);
$vimeo = get_field('vimeo', $post_id);
$audio_type = get_field('audio_type', $post_id);
$audio_mp3 = get_field('audio_mp3', $post_id);
$soundcloud = get_field('soundcloud', $post_id);
$pdf_file = get_field('pdf_file', $post_id);
$pastor = get_field('pastor', $post_id);
$date = get_field('date', $post_id);
$start_time = get_field('start_time', $post_id);
$end_time = get_field('end_time', $post_id);
$date_time = '';
if(!empty($date)) { $date_time .= $date; }
if(!empty($start_time)) { $date_time .= ': ' . $start_time; }
if(!empty($end_time)) { $date_time .= ': ' . $end_time; }

if($video_type == 'youtube') {
  $video_source = $youtube;
} elseif($video_type == 'vimeo') {
  $video_source = $vimeo;
} else {
  $video_source = $video_mp4;
}

if($audio_type == 'soundcloud') {
  $audio_source = $soundcloud;
} else {
  $audio_source = $audio_mp3;
}

$social_item = array();
$social_item[] = '<li>
                    <span>' . __('Share: ', 'awakenur') . '</span>
                  </li>';
$social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="' . esc_attr__('Linkedin', 'awakenur') . '" href="https://www.linkedin.com/shareArticle?url=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                      </svg>
                    </a>
                  </li>';
$social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="' . esc_attr__('Facebook', 'awakenur') . '" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                      </svg>
                    </a>
                  </li>';

$social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-google-plus" data-toggle="tooltip" title="' . esc_attr__('Google Plus', 'awakenur') . '" href="https://plus.google.com/share?url=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
                        <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                      </svg>
                    </a>
                  </li>';
$social_item[] = '<li>
                  <a target="_blank" data-btIcon="fa fa-twitter" data-toggle="tooltip" title="' . esc_attr__('Twitter', 'awakenur') . '" href="https://twitter.com/share?url=' . get_the_permalink() . '">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                      <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                    </svg>
                  </a>
                </li>';

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--thumbnail">
    <div class="bt-cover-image">
      <?php the_post_thumbnail($args['image-size']); ?>
    </div>
    <?php if(!empty($video_source)) { ?>
      <a class="bt-play-video bt-magnific-popup-js" href="<?php echo esc_url('#bt_play_video_' . $post_id); ?>"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.75 3.78441V20.3069C6.75245 20.4388 6.78962 20.5676 6.85776 20.6805C6.9259 20.7934 7.0226 20.8864 7.13812 20.95C7.25364 21.0136 7.38388 21.0456 7.51572 21.0428C7.64756 21.04 7.77634 21.0025 7.88906 20.9341L21.3966 12.6728C21.5045 12.6075 21.5937 12.5155 21.6556 12.4056C21.7175 12.2958 21.7501 12.1718 21.7501 12.0457C21.7501 11.9195 21.7175 11.7956 21.6556 11.6857C21.5937 11.5758 21.5045 11.4838 21.3966 11.4185L7.88906 3.15722C7.77634 3.08879 7.64756 3.05129 7.51572 3.04851C7.38388 3.04572 7.25364 3.07774 7.13812 3.14135C7.0226 3.20495 6.9259 3.29789 6.85776 3.41079C6.78962 3.52369 6.75245 3.65256 6.75 3.78441Z" fill="currentColor"/>
      </svg></a>
    <?php } ?>
  </div>
  <div class="bt-post--content">
    <?php
      if (!empty($terms)) {
        $term = array_pop($terms);
        echo '<div class="bt-post--term"><a href="'.get_term_link($term->slug, 'sermon_categories').'"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.9445 16.5454H3.07656C2.92378 16.545 2.77736 16.4841 2.66933 16.3761C2.56129 16.268 2.50041 16.1216 2.5 15.9688V6.54541H16.875C17.0408 6.54541 17.1997 6.61126 17.3169 6.72847C17.4342 6.84568 17.5 7.00465 17.5 7.17041V15.9899C17.5 16.1373 17.4415 16.2785 17.3373 16.3827C17.2331 16.4869 17.0919 16.5454 16.9445 16.5454Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.5 6.54541V4.67041C2.5 4.50465 2.56585 4.34568 2.68306 4.22847C2.80027 4.11126 2.95924 4.04541 3.125 4.04541H7.24141C7.40695 4.04549 7.56569 4.11123 7.68281 4.22822L10 6.54541" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>' . $term->name . '</a></div>';
      }
    ?>
    <?php echo awakenur_post_title_render();  ?>

    <?php if(!empty($date_time) || $pastor) { ?>
      <ul class="bt-post--meta">
        <?php
          if(!empty($date_time)) {
            echo '<li class="bt-date-time"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.25 3.42041H3.75C3.40482 3.42041 3.125 3.70023 3.125 4.04541V16.5454C3.125 16.8906 3.40482 17.1704 3.75 17.1704H16.25C16.5952 17.1704 16.875 16.8906 16.875 16.5454V4.04541C16.875 3.70023 16.5952 3.42041 16.25 3.42041Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.75 2.17041V4.67041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.25 2.17041V4.67041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.125 7.17041H16.875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>' . $date_time . '</li>';
          }
          if(!empty($pastor)) {
            echo '<li class="bt-pastor"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12.7954C12.7614 12.7954 15 10.5568 15 7.79541C15 5.03399 12.7614 2.79541 10 2.79541C7.23858 2.79541 5 5.03399 5 7.79541C5 10.5568 7.23858 12.7954 10 12.7954Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2.5 17.1704C4.01328 14.5556 6.76172 12.7954 10 12.7954C13.2383 12.7954 15.9867 14.5556 17.5 17.1704" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>' . __('Pastor: ', 'awakenur') . $pastor->post_title . '</li>';
          }
        ?>
      </ul>
    <?php } ?>
    
    <div class="bt-post--action">
      <?php if(!empty($audio_source)) { ?>
        <a class="bt-play-audio bt-magnific-popup-js" href="<?php echo esc_url('#bt_play_audio_' . $post_id); ?>"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M13.125 5.29541C13.125 3.56952 11.7259 2.17041 10 2.17041C8.27411 2.17041 6.875 3.56952 6.875 5.29541V10.2954C6.875 12.0213 8.27411 13.4204 10 13.4204C11.7259 13.4204 13.125 12.0213 13.125 10.2954V5.29541Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M10 15.9204V19.0454" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M15.625 10.2954C15.625 11.7873 15.0324 13.218 13.9775 14.2729C12.9226 15.3278 11.4918 15.9204 10 15.9204C8.50816 15.9204 7.07742 15.3278 6.02252 14.2729C4.96763 13.218 4.375 11.7873 4.375 10.2954" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg><span class="bt-text-infor"><?php echo __('Listening', 'awakenur'); ?></span></a>
      <?php } ?>
      <a class="bt-readmore" href="<?php the_permalink(); ?>"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11.0449 5.34888L11.9043 4.4895C12.2425 4.15118 12.6441 3.88281 13.086 3.69971C13.528 3.51661 14.0017 3.42236 14.4801 3.42236C14.9585 3.42236 15.4322 3.51661 15.8741 3.69971C16.3161 3.88281 16.7176 4.15118 17.0558 4.4895C17.3942 4.82772 17.6625 5.22928 17.8456 5.67124C18.0287 6.1132 18.123 6.5869 18.123 7.06528C18.123 7.54367 18.0287 8.01737 17.8456 8.45933C17.6625 8.90128 17.3942 9.30284 17.0558 9.64106L15.1512 11.5458L14.3433 12.3536C14.0047 12.6922 13.6027 12.9608 13.1601 13.1439C12.7176 13.3271 12.2433 13.4211 11.7644 13.4208C11.2855 13.4204 10.8114 13.3256 10.3691 13.1418C9.92686 12.958 9.5252 12.6888 9.1871 12.3497C8.83713 11.9998 8.56236 11.5822 8.37965 11.1223C8.19694 10.6624 8.11014 10.1701 8.1246 9.67544" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M8.9551 15.2423L8.09572 16.1017C7.75711 16.4403 7.35504 16.7089 6.91251 16.892C6.46999 17.0752 5.9957 17.1692 5.51679 17.1689C5.03787 17.1685 4.56373 17.0737 4.12149 16.8899C3.67924 16.7061 3.27758 16.4369 2.93947 16.0978C2.25821 15.4141 1.87608 14.4881 1.87695 13.523C1.87783 12.5578 2.26166 11.6325 2.94416 10.9501L5.65666 8.23761C5.99488 7.89929 6.39644 7.63092 6.8384 7.44782C7.28036 7.26471 7.75406 7.17047 8.23244 7.17047C8.71083 7.17047 9.18453 7.26471 9.62649 7.44782C10.0684 7.63092 10.47 7.89929 10.8082 8.23761C11.1596 8.58742 11.4356 9.00553 11.6192 9.46615C11.8027 9.92676 11.8899 10.4201 11.8754 10.9157" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg><span class="bt-text-infor"><?php echo __('Read More', 'awakenur'); ?></span></a>
      <div class="bt-social-share">
        <a class="bt-share-link" href="#!"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.6469 6.02197L7.10156 8.94385" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.10156 11.647L11.6469 14.5688" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12.7954C6.38071 12.7954 7.5 11.6761 7.5 10.2954C7.5 8.9147 6.38071 7.79541 5 7.79541C3.61929 7.79541 2.5 8.9147 2.5 10.2954C2.5 11.6761 3.61929 12.7954 5 12.7954Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M13.75 18.4204C15.1307 18.4204 16.25 17.3011 16.25 15.9204C16.25 14.5397 15.1307 13.4204 13.75 13.4204C12.3693 13.4204 11.25 14.5397 11.25 15.9204C11.25 17.3011 12.3693 18.4204 13.75 18.4204Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M13.75 7.17041C15.1307 7.17041 16.25 6.05112 16.25 4.67041C16.25 3.2897 15.1307 2.17041 13.75 2.17041C12.3693 2.17041 11.25 3.2897 11.25 4.67041C11.25 6.05112 12.3693 7.17041 13.75 7.17041Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg></a>
        <ul class="bt-share-list"><?php echo implode(' ', $social_item); ?></ul>
      </div>
      <?php if(!empty($pdf_file)) { ?>
        <a class="bt-pdf-file" href="<?php echo esc_url($pdf_file); ?>" target="_blank"><svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 11.5454V2.79541" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M16.875 11.5454V16.5454H3.125V11.5454" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M13.125 8.42041L10 11.5454L6.875 8.42041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg><span class="bt-text-infor"><?php echo __('Download', 'awakenur'); ?></span></a>
      <?php } ?>
    </div>
  </div>
  
  <?php if(!empty($video_source)) { ?>
    <div id="<?php echo esc_attr('bt_play_video_' . $post_id); ?>" class="bt-sermon-popup mfp-hide">
      <div class="bt-sermon-popup--inner bt-video-wrap">
        <?php if($video_type == 'youtube' || $video_type == 'vimeo') { ?>
          <?php 
            if($video_type == 'youtube') {
              echo '<div class="bt-cover-iframe">' . $youtube . '</div>'; 
            } else {
              echo '<div class="bt-cover-iframe">' . $vimeo . '</div>'; 
            }
          ?>
        <?php } else { ?>
          <div class="bt-cover-video">
            <video width="600" height="360" controls>
              <source src="<?php echo esc_url($video_mp4); ?>" type="video/mp4">
            </video>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
  
  <?php if(!empty($audio_source)) { ?>
    <div id="<?php echo esc_attr('bt_play_audio_' . $post_id); ?>" class="bt-sermon-popup mfp-hide">
      <div class="bt-sermon-popup--inner bt-audio-wrap">
        <?php if($audio_type == 'soundcloud') { ?>
          <?php echo '<div class="bt-cover-iframe bt-soundcloud">' . $soundcloud . '</div>';  ?>
        <?php } else { ?>
          <div class="bt-fullwidth-audio">
            <audio controls>
              <source src="<?php echo esc_url($audio_mp3); ?>" type="audio/mpeg">
            </audio>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</article>