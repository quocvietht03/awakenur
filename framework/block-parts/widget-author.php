<?php

/**
 * Block Name: Widget - Author
 **/
$author_id = get_field('select_author');
$avatar = get_field('avatar', 'user_' . $author_id);
$job = get_field('job', 'user_' . $author_id);
$socials = get_field('socials', 'user_' . $author_id);
$desc = get_the_author_meta('description');
?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-author-widget">
  <?php if ($author_id) { ?>
    <div class="bt-block-author">
      <div class="bt-block-author--avatar">
        <?php
        if (!empty($avatar)) {
          echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
        } else {
          echo get_avatar($author_id, 150);
        }
        ?>
        <h4 class="bt-block-author--name">
          <span class="bt-name">
            <?php echo get_the_author_meta('display_name', $author_id); ?>
          </span>
          <?php
          if (!empty($job)) {
            echo '<span class="bt-label">' . $job . '</span>';
          }
          ?>
        </h4>
      </div>
      <div class="bt-block-author--info">
        <?php
        if (!empty($desc)) {
          echo '<div class="bt-block-author--desc">' . $desc . '</div>';
        }

        if (!empty($socials)) {
        ?>
          <div class="bt-block-author--socials">
            <?php
          	foreach ($socials as $item) {
              if ($item['social'] == 'facebook') {
                echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <g clip-path="url(#clip0_16960_2640)">
            <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15.75 8.25H14.25C13.6533 8.25 13.081 8.48705 12.659 8.90901C12.2371 9.33097 12 9.90326 12 10.5V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 13.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <defs>
            <clipPath id="clip0_16960_2640">
              <rect width="24" height="24" fill="currentColor"/>
            </clipPath>
          </defs>
        </svg>
                </a>';
              }
              if ($item['social'] == 'twitter') {
                echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
          <g clip-path="url(#clip0_16960_2646)">
            <path d="M3.75 3.125H7.5L16.25 16.875H12.5L3.75 3.125Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.89687 11.2129L3.75 16.8746" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16.2504 3.125L11.1035 8.78672" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <defs>
            <clipPath id="clip0_16960_2646">
              <rect width="20" height="20" fill="currentColor"/>
            </clipPath>
          </defs>
        </svg>
                </a>';
              }
              if ($item['social'] == 'instagram') {
                echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
          <g clip-path="url(#clip0_16978_6899)">
            <path d="M10 13.4204C11.7259 13.4204 13.125 12.0213 13.125 10.2954C13.125 8.56952 11.7259 7.17041 10 7.17041C8.27411 7.17041 6.875 8.56952 6.875 10.2954C6.875 12.0213 8.27411 13.4204 10 13.4204Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M13.75 2.79541H6.25C4.17893 2.79541 2.5 4.47434 2.5 6.54541V14.0454C2.5 16.1165 4.17893 17.7954 6.25 17.7954H13.75C15.8211 17.7954 17.5 16.1165 17.5 14.0454V6.54541C17.5 4.47434 15.8211 2.79541 13.75 2.79541Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.0625 7.01416C14.494 7.01416 14.8438 6.66438 14.8438 6.23291C14.8438 5.80144 14.494 5.45166 14.0625 5.45166C13.631 5.45166 13.2812 5.80144 13.2812 6.23291C13.2812 6.66438 13.631 7.01416 14.0625 7.01416Z" fill="currentColor"/>
          </g>
          <defs>
            <clipPath id="clip0_16978_6899">
              <rect width="20" height="20" fill="currentColor" transform="translate(0 0.29541)"/>
            </clipPath>
          </defs>
        </svg>
                </a>';
              }
              if ($item['social'] == 'skype') {
                echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <g clip-path="url(#clip0_16967_5620)">
    <path d="M7.5 12.1704C7.5 13.2056 8.61953 14.0454 10 14.0454C11.3805 14.0454 12.5 13.2056 12.5 12.1704C12.5 9.67041 7.63906 10.6079 7.63906 8.42041C7.63906 7.38525 8.61953 6.54541 10 6.54541C11.0352 6.54541 11.8461 7.01416 12.1875 7.69072" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M16.7185 11.7556C17.2734 12.4773 17.5469 13.3763 17.4877 14.2848C17.4286 15.1933 17.0411 16.0492 16.3973 16.693C15.7536 17.3367 14.8976 17.7243 13.9891 17.7834C13.0806 17.8425 12.1817 17.5691 11.4599 17.0142C10.3352 17.2573 9.16735 17.2145 8.06341 16.8896C6.95947 16.5646 5.95465 15.968 5.14094 15.1543C4.32722 14.3406 3.7306 13.3358 3.40567 12.2318C3.08074 11.1279 3.03789 9.96007 3.28103 8.83528C2.72612 8.11354 2.45272 7.21458 2.51182 6.3061C2.57093 5.39762 2.95851 4.54167 3.60226 3.89791C4.24601 3.25416 5.10197 2.86658 6.01045 2.80748C6.91893 2.74837 7.81789 3.02178 8.53963 3.57669C9.66441 3.33354 10.8322 3.37639 11.9362 3.70132C13.0401 4.02625 14.0449 4.62288 14.8586 5.43659C15.6723 6.25031 16.269 7.25512 16.5939 8.35906C16.9188 9.463 16.9617 10.6308 16.7185 11.7556Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </g>
  <defs>
    <clipPath id="clip0_16967_5620">
      <rect width="20" height="20" fill="white" transform="translate(0 0.29541)"/>
    </clipPath>
  </defs>
</svg>
                </a>';
              }
              if ($item['social'] == 'telegram') {
                echo '<a class="bt-item bt-' . esc_attr($item['social']) . '" href="' . esc_url($item['link']) . '" target="_blank">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
          <g clip-path="url(#clip0_16967_5625)">
            <path d="M6.24939 10.832L13.301 17.0141C13.3822 17.0857 13.4806 17.135 13.5867 17.1572C13.6927 17.1793 13.8027 17.1735 13.9058 17.1404C14.0089 17.1072 14.1016 17.0478 14.1749 16.968C14.2481 16.8882 14.2994 16.7907 14.3236 16.6852L17.4994 2.89062C17.5025 2.87679 17.5018 2.86237 17.4973 2.84892C17.4928 2.83547 17.4848 2.82348 17.474 2.81425C17.4633 2.80502 17.4502 2.79889 17.4362 2.79651C17.4223 2.79414 17.4079 2.79561 17.3947 2.80078L1.56189 8.99687C1.4636 9.0347 1.38023 9.10339 1.3243 9.19263C1.26837 9.28187 1.2429 9.38684 1.2517 9.49179C1.26051 9.59674 1.30312 9.69601 1.37313 9.77468C1.44315 9.85335 1.5368 9.9072 1.64001 9.92812L6.24939 10.832Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.25 10.8329L17.4539 2.80322" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9.71641 13.8743L7.325 16.3556C7.23859 16.4452 7.12737 16.507 7.00561 16.533C6.88384 16.5591 6.75708 16.5481 6.64157 16.5016C6.52607 16.4551 6.42709 16.3752 6.35732 16.272C6.28755 16.1689 6.25018 16.0473 6.25 15.9228V10.8345" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </g>
          <defs>
            <clipPath id="clip0_16967_5625">
              <rect width="20" height="20" fill="white" transform="translate(0 0.29541)"/>
            </clipPath>
          </defs>
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
  <?php } else {
    esc_html_e('Please select the author to display', 'awakenur');
  } ?>
</div>