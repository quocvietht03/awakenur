<?php

/**
 * Site Titlebar
 *
 */

if (function_exists('get_field')) {
  $bg_image = get_field('background_image', 'options');
  $ovl_color = get_field('overlay_color', 'options');
  $ovl_opacity = get_field('overlay_opacity', 'options');
  $custom_background = get_field('custom_background', 'options');
} else {
  $bg_image = '';
  $ovl_color = '';
  $ovl_opacity = '';
}

$style_parts = [];
$background_image = $bg_image;

if (awakenur_check_post_types('tribe_events') || is_page_template('tribe/template-event.php')) {
  if (!empty($custom_background['enable_background_event']) && !empty($custom_background['background_image_event'])) {
    $background_image = $custom_background['background_image_event'];
  }
} elseif (awakenur_check_post_types('pastor')) {
  if (!empty($custom_background['enable_background_pastor']) && !empty($custom_background['background_image_pastor'])) {
    $background_image = $custom_background['background_image_pastor'];
  }
} elseif (awakenur_check_post_types('sermon')) {
  if (!empty($custom_background['enable_background_sermon']) && !empty($custom_background['background_image_sermon'])) {
    $background_image = $custom_background['background_image_sermon'];
  }
}
$style_parts[] = 'background-image: url(' . esc_url($background_image) . ');';
$style_attributes = implode(' ', $style_parts);

?>
<section class="bt-site-titlebar" <?php echo 'style="' . $style_attributes . '"'; ?>>

  <?php
  if (!empty($ovl_color)) {
    echo '<div class="bt-site-titlebar--overlay" style="background: ' . $ovl_color . '; opacity: ' . $ovl_opacity . '%;"></div>';
  }
  ?>

  <div class="bt-container">
    <div class="bt-page-titlebar">
      <div class="bt-page-titlebar--infor">
        <h1 class="bt-page-titlebar--title"><?php echo awakenur_page_title(); ?></h1>
        <div class="bt-page-titlebar--breadcrumb">
          <?php
          $home_text = 'Home';
          $delimiter = ' / ';
          echo awakenur_page_breadcrumb($home_text, $delimiter);
          ?>
        </div>
      </div>
    </div>
  </div>
</section>