<?php
/**
 * Block Name: Widget - Make Appointment
**/
$background = get_field('background_widget');
$subheading = get_field('sub_heading');
$heading = get_field('heading');
$description = get_field('description');
$button = get_field('button');

?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-make-appointment" <?php if(!empty($background)) { ?>style="background-image:url(<?php echo esc_url($background['url']) ?>)"<?php } ?>>
  <div class="bt-make-appointment">
    <?php
      if(!empty($subheading)) {
          echo '<span class="bt-make-appointment--sub-head">' . esc_html($subheading) . '</span>';
      }
      if(!empty($heading)) {
        echo '<h3 class="bt-make-appointment--head">' . esc_html($heading) . '</h3>';
      }

      if(!empty($description)) {
        echo '<div class="bt-make-appointment--desc">' . esc_html($description) . '</div>';
      }

      if(!empty($button)) {
        echo '<a class="bt-make-appointment--button bt-button-effect" href="' . esc_url($button['url']) . '" target="' . esc_attr($button['target']) . '">' . esc_html($button['title']) . '</a>';
      }
    ?>
  </div>
</div>
