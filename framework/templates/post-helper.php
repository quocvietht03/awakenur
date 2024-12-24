<?php
/* Count post view. */
if (!function_exists('awakenur_set_count_view')) {
  function awakenur_set_count_view()
  {
    $post_id = get_the_ID();

    if (is_single() && !empty($post_id) && !isset($_COOKIE['awakenur_post_view_' . $post_id])) {
      $views = get_post_meta($post_id, '_post_count_views', true);
      $views = $views ? $views : 0;
      $views++;

      update_post_meta($post_id, '_post_count_views', $views);

      /* set cookie. */
      setcookie('awakenur_post_view_' . $post_id, $post_id, time() * 20, '/');
    }
  }
}
add_action('wp', 'awakenur_set_count_view');

/* Post count view */
if (!function_exists('awakenur_get_count_view')) {
  function awakenur_get_count_view()
  {
    $post_id = get_the_ID();
    $views = get_post_meta($post_id, '_post_count_views', true);

    $views = $views ? $views : 0;
    $label = $views > 1 ? esc_html__('Views', 'awakenur') : esc_html__('View', 'awakenur');
    return $views . ' ' . $label;
  }
}

/* Post Reading */
if (!function_exists('awakenur_reading_time_render')) {
  function awakenur_reading_time_render()
  {
    $content = get_the_content();
    $word_count = str_word_count(strip_tags($content));
    $readingtime = ceil($word_count / 200);

    return '<div class="bt-reading-time">' . $readingtime . ' min read' . '</div>';
  }
}

/* Single Post Title */
if (!function_exists('awakenur_single_post_title_render')) {
  function awakenur_single_post_title_render()
  {
    ob_start();
?>
    <h3 class="bt-post--title">
      <?php the_title(); ?>
    </h3>
  <?php

    return ob_get_clean();
  }
}

/* Post Title */
if (!function_exists('awakenur_post_title_render')) {
  function awakenur_post_title_render()
  {
    ob_start();
  ?>
    <h3 class="bt-post--title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>
    <?php

    return ob_get_clean();
  }
}

/* Post Featured */
if (!function_exists('awakenur_post_featured_render')) {
  function awakenur_post_featured_render($image_size = 'full')
  {
    ob_start();

    if (is_single()) {
    ?>
      <div class="bt-post--featured">
        <div class="bt-cover-image">
          <?php if (has_post_thumbnail()) {
            the_post_thumbnail($image_size);
          } ?>
        </div>
      </div>
    <?php
    } else {
    ?>
      <div class="bt-post--featured">
        <a href="<?php the_permalink(); ?>">
          <div class="bt-cover-image">
            <?php if (has_post_thumbnail()) {
              the_post_thumbnail($image_size);
            } ?>
          </div>
        </a>
      </div>
    <?php

    }

    return ob_get_clean();
  }
}

/* Post Cover Featured */
if (!function_exists('awakenur_post_cover_featured_render')) {
  function awakenur_post_cover_featured_render($image_size = 'full')
  {
    ob_start();
    ?>
    <div class="bt-post--featured">
      <a href="<?php the_permalink(); ?>">
        <div class="bt-cover-image">
          <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail($image_size);
          }
          ?>
        </div>
      </a>
    </div>
  <?php

    return ob_get_clean();
  }
}

/* Post Publish */
if (!function_exists('awakenur_post_publish_render')) {
  function awakenur_post_publish_render()
  {
    ob_start();

  ?>
    <div class="bt-post--publish">
      <span> <?php echo get_the_date(get_option('date_format')); ?> </span>
    </div>
  <?php

    return ob_get_clean();
  }
}

/* Post Short Meta */
if (!function_exists('awakenur_post_short_meta_render')) {
  function awakenur_post_short_meta_render()
  {
    ob_start();

  ?>
    <div class="bt-post--meta">
      <?php
      the_terms(get_the_ID(), 'category', '<div class="bt-post-cat">', ', ', '</div>');
      echo awakenur_reading_time_render();
      ?>
    </div>
  <?php

    return ob_get_clean();
  }
}

/* Post Meta */
if (!function_exists('awakenur_post_meta_render')) {
  function awakenur_post_meta_render()
  {
    ob_start();

  ?>
    <ul class="bt-post--meta">
      <li class="bt-meta bt-meta--publish">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
          <path d="M16.75 2.79541H14.875V2.17041C14.875 2.00465 14.8092 1.84568 14.6919 1.72847C14.5747 1.61126 14.4158 1.54541 14.25 1.54541C14.0842 1.54541 13.9253 1.61126 13.8081 1.72847C13.6908 1.84568 13.625 2.00465 13.625 2.17041V2.79541H7.375V2.17041C7.375 2.00465 7.30915 1.84568 7.19194 1.72847C7.07473 1.61126 6.91576 1.54541 6.75 1.54541C6.58424 1.54541 6.42527 1.61126 6.30806 1.72847C6.19085 1.84568 6.125 2.00465 6.125 2.17041V2.79541H4.25C3.91848 2.79541 3.60054 2.92711 3.36612 3.16153C3.1317 3.39595 3 3.71389 3 4.04541V16.5454C3 16.8769 3.1317 17.1949 3.36612 17.4293C3.60054 17.6637 3.91848 17.7954 4.25 17.7954H16.75C17.0815 17.7954 17.3995 17.6637 17.6339 17.4293C17.8683 17.1949 18 16.8769 18 16.5454V4.04541C18 3.71389 17.8683 3.39595 17.6339 3.16153C17.3995 2.92711 17.0815 2.79541 16.75 2.79541ZM6.125 4.04541V4.67041C6.125 4.83617 6.19085 4.99514 6.30806 5.11235C6.42527 5.22956 6.58424 5.29541 6.75 5.29541C6.91576 5.29541 7.07473 5.22956 7.19194 5.11235C7.30915 4.99514 7.375 4.83617 7.375 4.67041V4.04541H13.625V4.67041C13.625 4.83617 13.6908 4.99514 13.8081 5.11235C13.9253 5.22956 14.0842 5.29541 14.25 5.29541C14.4158 5.29541 14.5747 5.22956 14.6919 5.11235C14.8092 4.99514 14.875 4.83617 14.875 4.67041V4.04541H16.75V6.54541H4.25V4.04541H6.125ZM16.75 16.5454H4.25V7.79541H16.75V16.5454Z" fill="#4F320E" />
        </svg>
        <?php echo get_the_date(get_option('date_format')); ?>
      </li>
      <li class="bt-meta bt-meta--author">
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
            <path d="M18.5407 16.858C17.3508 14.8009 15.5172 13.3259 13.3774 12.6267C14.4358 11.9966 15.2582 11.0365 15.7182 9.89374C16.1781 8.75102 16.2503 7.4889 15.9235 6.30121C15.5968 5.11352 14.8892 4.06592 13.9094 3.31931C12.9296 2.57269 11.7318 2.16833 10.5 2.16833C9.26821 2.16833 8.07044 2.57269 7.09067 3.31931C6.1109 4.06592 5.40331 5.11352 5.07654 6.30121C4.74978 7.4889 4.82193 8.75102 5.28189 9.89374C5.74186 11.0365 6.56422 11.9966 7.62268 12.6267C5.48284 13.3251 3.64925 14.8001 2.4594 16.858C2.41577 16.9291 2.38683 17.0083 2.37429 17.0908C2.36174 17.1733 2.36585 17.2575 2.38638 17.3384C2.4069 17.4193 2.44341 17.4953 2.49377 17.5618C2.54413 17.6284 2.60731 17.6842 2.67958 17.7259C2.75185 17.7677 2.83175 17.7945 2.91457 17.8049C2.99738 17.8152 3.08143 17.8089 3.16176 17.7863C3.24209 17.7636 3.31708 17.7251 3.38228 17.673C3.44749 17.6209 3.50161 17.5563 3.54143 17.483C5.01331 14.9392 7.61487 13.4205 10.5 13.4205C13.3852 13.4205 15.9867 14.9392 17.4586 17.483C17.4985 17.5563 17.5526 17.6209 17.6178 17.673C17.683 17.7251 17.758 17.7636 17.8383 17.7863C17.9186 17.8089 18.0027 17.8152 18.0855 17.8049C18.1683 17.7945 18.2482 17.7677 18.3205 17.7259C18.3927 17.6842 18.4559 17.6284 18.5063 17.5618C18.5566 17.4953 18.5932 17.4193 18.6137 17.3384C18.6342 17.2575 18.6383 17.1733 18.6258 17.0908C18.6132 17.0083 18.5843 16.9291 18.5407 16.858ZM6.12503 7.79546C6.12503 6.93017 6.38162 6.08431 6.86235 5.36484C7.34308 4.64538 8.02636 4.08462 8.82579 3.75349C9.62522 3.42235 10.5049 3.33571 11.3535 3.50452C12.2022 3.67334 12.9818 4.09001 13.5936 4.70187C14.2055 5.31372 14.6222 6.09327 14.791 6.94194C14.9598 7.79061 14.8731 8.67027 14.542 9.4697C14.2109 10.2691 13.6501 10.9524 12.9306 11.4331C12.2112 11.9139 11.3653 12.1705 10.5 12.1705C9.34009 12.1692 8.22801 11.7079 7.40781 10.8877C6.5876 10.0675 6.12627 8.9554 6.12503 7.79546Z" fill="#4F320E" />
          </svg>
          <?php echo esc_html__('By', 'cleanira') . ' ' . get_the_author(); ?>
        </a>
      </li>
    </ul>
    <?php
    return ob_get_clean();
  }
}

/* Post Category */
if (!function_exists('awakenur_post_category_render')) {
  function awakenur_post_category_render()
  {
    $post_id = get_the_ID();
    $categorys = get_the_terms($post_id, 'category');
    if ($categorys && !is_wp_error($categorys)) {
    ?>
      <div class="bt-post--category"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
          <path d="M15.2069 8.79541L9 2.58854C8.90748 2.49528 8.79734 2.42134 8.67599 2.37101C8.55464 2.32069 8.4245 2.295 8.29313 2.29542H2.50001C2.3674 2.29542 2.24022 2.34809 2.14645 2.44186C2.05268 2.53563 2.00001 2.66281 2.00001 2.79542V8.58854C1.99959 8.71991 2.02528 8.85005 2.0756 8.9714C2.12593 9.09275 2.19987 9.20289 2.29313 9.29541L8.5 15.5023C8.59287 15.5952 8.70312 15.6689 8.82446 15.7191C8.9458 15.7694 9.07585 15.7953 9.20719 15.7953C9.33853 15.7953 9.46859 15.7694 9.58993 15.7191C9.71127 15.6689 9.82152 15.5952 9.91438 15.5023L15.2069 10.2098C15.2998 10.1169 15.3734 10.0067 15.4237 9.88534C15.474 9.764 15.4999 9.63394 15.4999 9.5026C15.4999 9.37126 15.474 9.24121 15.4237 9.11987C15.3734 8.99853 15.2998 8.88828 15.2069 8.79541ZM9.20688 14.7954L3 8.58854V3.29542H8.29313L14.5 9.50229L9.20688 14.7954ZM6 5.54541C6 5.69375 5.95602 5.83876 5.87361 5.96209C5.7912 6.08543 5.67406 6.18156 5.53702 6.23832C5.39997 6.29509 5.24917 6.30994 5.10369 6.281C4.9582 6.25206 4.82456 6.18063 4.71967 6.07575C4.61479 5.97086 4.54335 5.83722 4.51442 5.69173C4.48548 5.54625 4.50033 5.39545 4.5571 5.2584C4.61386 5.12136 4.70999 5.00422 4.83333 4.92181C4.95666 4.8394 5.10167 4.79541 5.25 4.79541C5.44892 4.79541 5.63968 4.87443 5.78033 5.01508C5.92099 5.15574 6 5.3465 6 5.54541Z" fill="currentColor" />
        </svg>
        <?php
        $output = [];
        foreach ($categorys as $category) {
          $output[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
        }
        echo implode(', ', $output);
        ?>
      </div>
    <?php
    }
  }
}

/* Post Content */
if (!function_exists('awakenur_post_content_render')) {
  function awakenur_post_content_render()
  {

    ob_start();

    if (is_single()) {
    ?>
      <div class="bt-post--content">
        <?php
        the_content();
        wp_link_pages(array(
          'before' => '<div class="page-links">' . esc_html__('Pages:', 'awakenur'),
          'after' => '</div>',
        ));
        ?>
      </div>
    <?php
    } else {
    ?>
      <div class="bt-post--excerpt">
        <?php echo get_the_excerpt(); ?>
      </div>
    <?php
    }

    return ob_get_clean();
  }
}

/* Post tag */
if (!function_exists('awakenur_tags_render')) {
  function awakenur_tags_render()
  {
    ob_start();
    if (has_tag()) {
    ?>
      <div class="bt-post-tags">
        <span><?php esc_html_e('Tag:', 'cleanira') ?></span>
        <?php
        if (has_tag()) {
          the_tags('', '', '');
        }
        ?>
      </div>
    <?php
    }
    return ob_get_clean();
  }
}

/* Post share */
if (!function_exists('awakenur_share_render')) {
  function awakenur_share_render()
  {

    $social_item = array();
    $social_item[] = '<li>
                        <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="' . esc_attr__('Facebook', 'awakenur') . '" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">
                          <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
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
    $social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="' . esc_attr__('Linkedin', 'awakenur') . '" href="https://www.linkedin.com/shareArticle?url=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                      </svg>
                    </a>
                  </li>';

    ob_start();
    if (is_singular('post') && has_tag()) { ?>
      <div class="bt-post-share">
        <?php if (!empty($social_item)) {
          echo '<span>' . esc_html__('Share this post: ', 'awakenur') . '</span><ul>' . implode(' ', $social_item) . '</ul>';
        } ?>
      </div>

    <?php } elseif (!empty($social_item)) { ?>

      <div class="bt-post-share">
        <span><?php echo esc_html__('Share this post: ', 'awakenur'); ?></span>
        <ul><?php echo implode(' ', $social_item); ?></ul>
      </div>
    <?php }

    return ob_get_clean();
  }
}

/* Post Button */
if (!function_exists('awakenur_post_button_render')) {
  function awakenur_post_button_render($text)
  { ?>
    <div class="bt-post--button">
      <a href="<?php echo esc_url(get_permalink()) ?>">
        <span> <?php echo esc_html($text) ?> </span>
      </a>
    </div>
  <?php }
}

/* Author Icon */
if (!function_exists('awakenur_author_icon_render')) {
  function awakenur_author_icon_render()
  { ?>
    <div class="bt-post-author-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M6.66634 5.83333C6.66634 7.67428 8.15876 9.16667 9.99967 9.16667C11.8406 9.16667 13.333 7.67428 13.333 5.83333C13.333 3.99238 11.8406 2.5 9.99967 2.5C8.15876 2.5 6.66634 3.99238 6.66634 5.83333Z" stroke="#C2A74E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M9.99967 11.6667C13.2213 11.6667 15.833 14.2784 15.833 17.5001H4.16634C4.16634 14.2784 6.77801 11.6667 9.99967 11.6667Z" stroke="#C2A74E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <h4 class="bt-post-author-icon--name"> <?php echo esc_html__('By', 'awakenur') . ' ' . get_the_author(); ?> </h4>
    </div>
  <?php }
}

/* Author */
if (!function_exists('awakenur_author_render')) {
  function awakenur_author_render()
  {
    $author_id = get_the_author_meta('ID');
    $desc = get_the_author_meta('description');

    if (function_exists('get_field')) {
      $avatar = get_field('avatar', 'user_' . $author_id);
      $job = get_field('job', 'user_' . $author_id);
      $socials = get_field('socials', 'user_' . $author_id);
    } else {
      $avatar = array();
      $job = '';
      $socials = array();
    }

    ob_start();
  ?>
    <div class="bt-post-author">
      <div class="bt-post-author--avatar">
        <?php
        if (!empty($avatar)) {
          echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
        } else {
          echo get_avatar($author_id, 150);
        }
        ?>
      </div>
      <div class="bt-post-author--info">
        <h4 class="bt-post-author--name">
          <span class="bt-name">
            <?php the_author(); ?>
          </span>
          <?php
          if (!empty($job)) {
            echo '<span class="bt-label">' . $job . '</span>';
          }
          ?>
        </h4>
        <?php
        if (!empty($desc)) {
          echo '<div class="bt-post-author--desc">' . $desc . '</div>';
        }

        if (!empty($socials)) {
        ?>
          <div class="bt-post-author--socials">
            <?php
            foreach ($socials as $item) {
              if ($item['social'] == 'facebook') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                          <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                        </svg>
                      </a>';
              }

              if ($item['social'] == 'linkedin') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                          <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                      </a>';
              }

              if ($item['social'] == 'twitter') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                        </svg>
                      </a>';
              }

              if ($item['social'] == 'google') {
                echo '<a class="bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                          <path d="M386.061 228.496c1.834 9.692 3.143 19.384 3.143 31.956C389.204 370.205 315.599 448 204.8 448c-106.084 0-192-85.915-192-192s85.916-192 192-192c51.864 0 95.083 18.859 128.611 50.292l-52.126 50.03c-14.145-13.621-39.028-29.599-76.485-29.599-65.484 0-118.92 54.221-118.92 121.277 0 67.056 53.436 121.277 118.92 121.277 75.961 0 104.513-54.745 108.965-82.773H204.8v-66.009h181.261zm185.406 6.437V179.2h-56.001v55.733h-55.733v56.001h55.733v55.733h56.001v-55.733H627.2v-56.001h-55.733z"/>
                        </svg>
                      </a>';
              }
            }
            ?>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <?php
    return ob_get_clean();
  }
}


/* Related posts */
if (!function_exists('awakenur_related_posts')) {
  function awakenur_related_posts()
  {
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category($post_id);

    if (!empty($categories) && !is_wp_error($categories)) {
      foreach ($categories as $category) {
        array_push($cat_ids, $category->term_id);
      }
    }

    $current_post_type = get_post_type($post_id);

    $query_args = array(
      'category__in'   => $cat_ids,
      'post_type'      => $current_post_type,
      'post__not_in'    => array($post_id),
      'posts_per_page'  => 3,
    );

    $list_posts = new WP_Query($query_args);

    ob_start();

    if ($list_posts->have_posts()) {
    ?>
      <div class="bt-related-posts">
        <div class="bt-container">
          <div class="bt-related-posts--heading">
            <h2 class="bt-head"><?php esc_html_e('Related Articles ', 'awakenur'); ?></h2>
            <p class="bt-sub"><?php esc_html_e('Subscribe to our blog for the latest posts and insights!', 'awakenur'); ?></p>
          </div>
          <div class="bt-related-posts--list bt-image-effect">
            <?php
            while ($list_posts->have_posts()) : $list_posts->the_post();
              get_template_part('framework/templates/post', 'related');
            endwhile;
            wp_reset_postdata();
            ?>
          </div>
        </div>
      </div>
    <?php
    }
    return ob_get_clean();
  }
}

//Comment Field Order
function awakenur_comment_fields_custom_order($fields)
{
  $comment_field = $fields['comment'];
  $author_field = $fields['author'];
  $email_field = $fields['email'];
  $cookies_field = $fields['cookies'];
  unset($fields['comment']);
  unset($fields['author']);
  unset($fields['email']);
  unset($fields['url']);
  unset($fields['cookies']);
  // the order of fields is the order below, change it as needed:
  $fields['author'] = $author_field;
  $fields['email'] = $email_field;
  $fields['comment'] = $comment_field;
  $fields['cookies'] = $cookies_field;
  // done ordering, now return the fields:
  return $fields;
}
add_filter('comment_form_fields', 'awakenur_comment_fields_custom_order');

/* Custom comment list */
if (!function_exists('awakenur_custom_comment')) {
  function awakenur_custom_comment($comment, $args, $depth)
  {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_html($tag); ?> <?php comment_class(empty($args['has_children']) ? 'bt-comment-item clearfix' : 'bt-comment-item parent clearfix') ?> id="comment-<?php comment_ID() ?>">
      <div class="bt-comment">
        <div class="bt-avatar">
          <?php
          if (function_exists('get_field')) {
            $avatar = get_field('avatar', 'user_' . $comment->user_id);
          } else {
            $avatar = array();
          }
          if (!empty($avatar)) {
            echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
          } else {
            if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']);
          }


          ?>
        </div>
        <div class="bt-content">
          <h5 class="bt-name">
            <?php echo get_comment_author(get_comment_ID()); ?>
          </h5>
          <div class="bt-date">
            <?php echo get_comment_date(); ?>
          </div>
          <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'awakenur'); ?></em>
          <?php endif; ?>
          <div class="bt-text">
            <?php comment_text(); ?>
          </div>
          <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
      </div>
  <?php
  }
}
