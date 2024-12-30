<?php
$related_posts = get_field('sermon_related_posts', 'options');

$post_id = get_the_ID();
$cat_ids = array();
$categories = wp_get_post_terms($post_id, 'sermon_categories');

if (!empty($categories) && !is_wp_error($categories)) {
  foreach ($categories as $category) {
    array_push($cat_ids, $category->term_id);
  }
}
$current_post_type = get_post_type($post_id);
$query_args = array(
  'post_type'      => $current_post_type,
  'post__not_in'    => array($post_id),
  'posts_per_page'  => !empty($related_posts['number_posts']) ? $related_posts['number_posts'] : 3,
  'tax_query'      => array(
    array(
      'taxonomy' => 'sermon_categories', 
      'field'    => 'term_id',
      'terms'    => $cat_ids,  
      'operator' => 'IN', 
    ),
  ),
);

$list_posts = new WP_Query($query_args);
$column = !empty($related_posts['column']) ? $related_posts['column'] : 3;
if ($list_posts->have_posts()) {
?>
  <div class="bt-related-sermon-ss">
    <div class="bt-container">
      <?php if (!($related_posts['sub_heading']) || !empty($related_posts['heading'])) {  ?>
        <div class="bt-related-sermon-ss--heading">
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
      <div class="bt-related-sermon-ss--list bt-image-effect" style="--column:<?php echo esc_attr($column) ?>">
        <?php
        while ($list_posts->have_posts()): $list_posts->the_post();
          get_template_part('framework/templates/sermon', 'style', array('image-size' => 'medium_large'));
        endwhile;
        wp_reset_postdata();
        ?>
      </div>

    </div>
  </div>
<?php
}
