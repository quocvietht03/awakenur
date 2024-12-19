<?php
$post_id = get_the_ID();

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php echo awakenur_post_cover_featured_render($args['image-size']); ?>
    <div class="bt-post--content">
      <div class="bt-post--start-date">
        <?php
        echo '<span class="bt-day">' . get_the_date('d') . '</span>';
        echo '<span class="bt-month">' . get_the_date('M') . '</span>';
        ?>
      </div>
      <div class="bt-post--infor">
        <?php
        echo awakenur_post_title_render();
        echo awakenur_post_publish_render();
        ?>
      </div>
    </div>

  </div>
</article>