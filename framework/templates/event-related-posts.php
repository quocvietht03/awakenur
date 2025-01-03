<?php
$related_posts = get_field('event_related_posts', 'options');

$post_id = get_the_ID();
$query_args = array(
  'eventDisplay'   => 'upcoming',
  'post__not_in'    => array($post_id),
  'posts_per_page'  => !empty($related_posts['number_posts']) ? $related_posts['number_posts'] : 3,
);
$events = tribe_get_events($query_args);
$column = !empty($related_posts['column']) ? $related_posts['column'] : 3;
if (!empty($events)) {
?>
  <div class="bt-related-event-ss">
    <div class="bt-container">
      <?php if (!($related_posts['sub_heading']) || !empty($related_posts['heading'])) {  ?>
        <div class="bt-related-event-ss--heading">
          <?php
          if (!empty($related_posts['heading'])) {
            echo '<h2 class="bt-main-text">' . $related_posts['heading'] . '</h2>';
          }
          if (!empty($related_posts['sub_heading'])) {
            echo '<div class="bt-sub-text">' . $related_posts['sub_heading'] . '</div>';
          }
          ?>
        </div>
      <?php } ?>
      <div class="bt-related-event-ss--list bt-image-effect" style="--column:<?php echo esc_attr($column) ?>">
        <?php
        foreach ($events as $event) {
          get_template_part('framework/templates/event', 'style', array('event' => $event, 'image-size' => 'medium_large'));
        }
        ?>
      </div>

    </div>
  </div>
<?php
}
