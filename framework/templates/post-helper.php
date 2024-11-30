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
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_1_1660)">
          <path d="M18.3333 1.87502H15.625V0.62502C15.6133 0.288353 15.3383 0.0200195 15 0.0200195C14.6617 0.0200195 14.3867 0.288353 14.375 0.624186V1.87502H10.625V0.62502C10.6133 0.288353 10.3383 0.0200195 10 0.0200195C9.66167 0.0200195 9.38667 0.288353 9.375 0.624186V1.87502H5.625V0.62502C5.61333 0.288353 5.33833 0.0200195 5 0.0200195C4.66167 0.0200195 4.38667 0.288353 4.375 0.624186V1.87502H1.66667C0.746667 1.87502 0 2.62085 0 3.54085V18.3325C0 19.2534 0.745833 19.9992 1.66667 19.9992H18.3333C19.2542 19.9992 20 19.2534 20 18.3325V3.54085C20 2.62085 19.2533 1.87502 18.3333 1.87502ZM18.75 18.3334C18.75 18.5634 18.5633 18.7492 18.3342 18.75H1.66667C1.43667 18.75 1.25 18.5634 1.25 18.3334V3.54169C1.25083 3.31169 1.43667 3.12585 1.66667 3.12585H4.375V4.37585C4.38667 4.71252 4.66167 4.98085 5 4.98085C5.33833 4.98085 5.61333 4.71252 5.625 4.37669V3.12585H9.375V4.37585C9.38667 4.71252 9.66167 4.98085 10 4.98085C10.3383 4.98085 10.6133 4.71252 10.625 4.37669V3.12585H14.375V4.37585C14.3867 4.71252 14.6617 4.98085 15 4.98085C15.3383 4.98085 15.6133 4.71252 15.625 4.37669V3.12585H18.3333C18.5633 3.12585 18.7492 3.31252 18.7492 3.54169L18.75 18.3334Z" fill="#C2A74E" />
          <path d="M4.375 7.5H6.875V9.375H4.375V7.5Z" fill="#C2A74E" />
          <path d="M4.375 10.625H6.875V12.5H4.375V10.625Z" fill="#C2A74E" />
          <path d="M4.375 13.75H6.875V15.625H4.375V13.75Z" fill="#C2A74E" />
          <path d="M8.75 13.75H11.25V15.625H8.75V13.75Z" fill="#C2A74E" />
          <path d="M8.75 10.625H11.25V12.5H8.75V10.625Z" fill="#C2A74E" />
          <path d="M8.75 7.5H11.25V9.375H8.75V7.5Z" fill="#C2A74E" />
          <path d="M13.125 13.75H15.625V15.625H13.125V13.75Z" fill="#C2A74E" />
          <path d="M13.125 10.625H15.625V12.5H13.125V10.625Z" fill="#C2A74E" />
          <path d="M13.125 7.5H15.625V9.375H13.125V7.5Z" fill="#C2A74E" />
        </g>
        <defs>
          <clipPath id="clip0_1_1660">
            <rect width="20" height="20" fill="white" />
          </clipPath>
        </defs>
      </svg>
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
    <div class="bt-post--meta-wrap">
      <ul class="bt-post--meta">
        <li class="bt-meta bt-meta--author">
          <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
              <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
            </svg>
            <?php echo esc_html__('By', 'awakenur') . ' ' . get_the_author(); ?>
          </a>
        </li>
        <li class="bt-meta bt-meta--view">
          <a href="<?php echo get_the_permalink(); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
              <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z" />
            </svg>
            <?php echo awakenur_get_count_view(); ?>
          </a>
        </li>

        <li class="bt-meta bt-meta--comment">
          <a href="<?php comments_link(); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
              <path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z" />
            </svg>
            <?php comments_number(esc_html__('0 Comments', 'awakenur'), esc_html__('1 Comment', 'awakenur'), esc_html__('% Comments', 'awakenur')); ?>
          </a>
        </li>
      </ul>
      <?php
      echo awakenur_share_render();
      ?>
    </div>
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
      <div class="bt-post--category">
        <?php
        foreach ($categorys as $category) {
          echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
        }
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
        <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.65527 3.85714C5.65527 3.06473 5.01911 2.42857 4.2267 2.42857C3.43429 2.42857 2.79813 3.06473 2.79813 3.85714C2.79813 4.64955 3.43429 5.28571 4.2267 5.28571C5.01911 5.28571 5.65527 4.64955 5.65527 3.85714ZM17.5638 10.2857C17.5638 10.6652 17.4075 11.0335 17.1508 11.2902L11.6709 16.7812C11.403 17.0379 11.0347 17.1942 10.6553 17.1942C10.2758 17.1942 9.90751 17.0379 9.65081 16.7812L1.6709 8.79018C1.1017 8.23214 0.655273 7.14955 0.655273 6.35714V1.71429C0.655273 0.933035 1.30259 0.285713 2.08384 0.285713H6.7267C7.51911 0.285713 8.6017 0.732143 9.1709 1.30134L17.1508 9.27009C17.4075 9.53795 17.5638 9.90625 17.5638 10.2857ZM21.8495 10.2857C21.8495 10.6652 21.6932 11.0335 21.4365 11.2902L15.9566 16.7812C15.6888 17.0379 15.3205 17.1942 14.941 17.1942C14.3606 17.1942 14.0705 16.9263 13.691 16.5357L18.9365 11.2902C19.1932 11.0335 19.3495 10.6652 19.3495 10.2857C19.3495 9.90625 19.1932 9.53795 18.9365 9.27009L10.9566 1.30134C10.3874 0.732143 9.30483 0.285713 8.51242 0.285713H11.0124C11.8048 0.285713 12.8874 0.732143 13.4566 1.30134L21.4365 9.27009C21.6932 9.53795 21.8495 9.90625 21.8495 10.2857Z" fill="#C2A74E" />
        </svg>

        <?php
        if (has_tag()) {
          the_tags('', '|', '');
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


    ob_start();
    if (is_singular('post') && has_tag()) { ?>
      <div class="bt-post-share">
        <?php if (!empty($social_item)) {
          echo '<span>' . esc_html__('Share: ', 'awakenur') . '</span><ul>' . implode(' ', $social_item) . '</ul>';
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
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#1FBECD" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
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
      'posts_per_page'  => 2,
    );

    $list_posts = new WP_Query($query_args);

    ob_start();

    if ($list_posts->have_posts()) {
    ?>
      <div class="bt-related-posts">
        <div class="bt-related-posts--heading">
          <h4 class="bt-sub"><?php esc_html_e('From The Blog', 'awakenur'); ?></h4>
          <h2 class="bt-head"><?php esc_html_e('Related News ', 'awakenur'); ?><span><?php esc_html_e('& Articles', 'awakenur'); ?></span></h2>
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
