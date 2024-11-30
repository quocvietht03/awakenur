<?php
$post_id = get_the_ID();
$category = get_the_terms($post_id, 'category');
?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
  <?php echo awakenur_post_cover_featured_render('medium_large'); ?>
    <div class="bt-post--content">
      <div class="bt-post--category">
        <?php
        if (!empty($category)) {
          echo  '<a href="'.get_category_link($category[0]->term_id).'">'.$category[0]->name.'</a>';
        }
        ?>
      </div>

      <?php echo awakenur_post_title_render(); ?>
    </div>
    <div class="bt-post--info">
        <?php
        echo awakenur_post_publish_render();
        echo awakenur_author_icon_render();
        ?>
      </div>
  </div>
</article>