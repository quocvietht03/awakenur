<?php
$event = $args['event'];

?>
<article <?php post_class('bt-tribe-event'); ?>>
  <div class="bt-tribe-event--inner">
    <div class="bt-tribe-event--content">
      <div class="bt-tribe-event--start-date">
        <?php 
          echo '<span class="bt-day">' . tribe_get_start_date( $event->ID, true, 'd' ) . '</span>';
          echo '<span class="bt-month">' . tribe_get_start_date( $event->ID, true, 'M' ) . '</span>'; 
        ?>
      </div>
      <div class="bt-tribe-event--infor">
        <?php 
          echo '<div class="bt-tribe-event--subtext">'. esc_html('Upcoming Event', 'awakenur') .'</div>';

          echo '<h3 class="bt-tribe-event--title">
                  <a href="' . get_the_permalink($event->ID) . '">' . $event->post_title . '</a>
                </h3>';
          
          echo '<div class="bt-tribe-event--time">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 17.5C13.797 17.5 16.875 14.422 16.875 10.625C16.875 6.82804 13.797 3.75 10 3.75C6.20304 3.75 3.125 6.82804 3.125 10.625C3.125 14.422 6.20304 17.5 10 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.375 2.5L1.875 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.625 2.5L18.125 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 6.25V10.625H14.375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span>'. __('Start Time: ', 'awakenur') . tribe_get_start_date( $event->ID, true, 'h:i a' ) . '</span>
                </div>';

          $venue_id = tribe_get_venue_id($event->ID);
          $event_address =  tribe_get_address( $venue_id );
          if(tribe_get_city( $venue_id )) {
            $event_address .= ', ' . tribe_get_city( $venue_id );
          }
          if(tribe_get_country( $venue_id )) {
            $event_address .= ', ' . tribe_get_country( $venue_id );
          }
          echo '<div class="bt-tribe-event--address">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 5C9.38193 5 8.77775 5.18328 8.26384 5.52666C7.74994 5.87004 7.3494 6.3581 7.11288 6.92912C6.87635 7.50013 6.81447 8.12847 6.93505 8.73466C7.05562 9.34085 7.35325 9.89767 7.79029 10.3347C8.22733 10.7717 8.78415 11.0694 9.39034 11.19C9.99653 11.3105 10.6249 11.2486 11.1959 11.0121C11.7669 10.7756 12.255 10.3751 12.5983 9.86116C12.9417 9.34725 13.125 8.74307 13.125 8.125C13.125 7.2962 12.7958 6.50134 12.2097 5.91529C11.6237 5.32924 10.8288 5 10 5ZM10 10C9.62916 10 9.26665 9.89003 8.95831 9.68401C8.64996 9.47798 8.40964 9.18514 8.26773 8.84253C8.12581 8.49992 8.08868 8.12292 8.16103 7.75921C8.23337 7.39549 8.41195 7.0614 8.67417 6.79918C8.9364 6.53695 9.27049 6.35838 9.63421 6.28603C9.99792 6.21368 10.3749 6.25081 10.7175 6.39273C11.0601 6.53464 11.353 6.77496 11.559 7.08331C11.765 7.39165 11.875 7.75416 11.875 8.125C11.875 8.62228 11.6775 9.0992 11.3258 9.45083C10.9742 9.80246 10.4973 10 10 10ZM10 1.25C8.17727 1.25207 6.42979 1.97706 5.14092 3.26593C3.85206 4.55479 3.12707 6.30227 3.125 8.125C3.125 10.5781 4.25859 13.1781 6.40625 15.6445C7.37127 16.759 8.45739 17.7626 9.64453 18.6367C9.74962 18.7103 9.87482 18.7498 10.0031 18.7498C10.1314 18.7498 10.2566 18.7103 10.3617 18.6367C11.5467 17.7623 12.6307 16.7587 13.5938 15.6445C15.7383 13.1781 16.875 10.5781 16.875 8.125C16.8729 6.30227 16.1479 4.55479 14.8591 3.26593C13.5702 1.97706 11.8227 1.25207 10 1.25ZM10 17.3438C8.70859 16.3281 4.375 12.5977 4.375 8.125C4.375 6.63316 4.96763 5.20242 6.02252 4.14752C7.07742 3.09263 8.50816 2.5 10 2.5C11.4918 2.5 12.9226 3.09263 13.9775 4.14752C15.0324 5.20242 15.625 6.63316 15.625 8.125C15.625 12.5961 11.2914 16.3281 10 17.3438Z" fill="currentColor"/>
                </svg>
                <span>' . $event_address . '</span>
              </div>';
        ?>
      </div>
    </div>
    <div class="bt-tribe-event--countdown">
      <div class="bt-countdown bt-countdown-js" data-time="<?php echo tribe_get_start_date( $event->ID, true, 'Y-m-d H:m:s' ); ?>">
        <div class="bt-countdown--item">
          <?php
            echo '<span class="bt-countdown--digits bt-countdown-days">--</span>'; 
            echo '<span class="bt-countdown--label">' . __('Days', 'awakenur') . '</span>';
          ?>
        </div>
        <div class="bt-countdown--item">
          <?php
            echo '<span class="bt-countdown--digits bt-countdown-hours">--</span>';
            echo '<span class="bt-countdown--label">' . __('Hours', 'awakenur') . '</span>';
          ?>
        </div>
        <div class="bt-countdown--item">
          <?php
            echo '<span class="bt-countdown--digits bt-countdown-mins">--</span>';
            echo '<span class="bt-countdown--label">' . __('Mins', 'awakenur') . '</span>';
          ?>
        </div>
        <div class="bt-countdown--item">
          <?php
            echo '<span class="bt-countdown--digits bt-countdown-secs">--</span>';
            echo '<span class="bt-countdown--label">' . __('Secs', 'awakenur') . '</span>';
          ?>
        </div>
      </div>
    </div>
    <div class="bt-tribe-event--button bt-button-hover">
      <a href="/events">
        <?php echo '<span>' . __('All Event', 'awakenur') . '</span>'; ?>
        <svg width="32" height="20" viewBox="0 0 32 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.5344 10.6689L21.9094 16.2939C21.7333 16.47 21.4944 16.569 21.2453 16.569C20.9962 16.569 20.7574 16.47 20.5813 16.2939C20.4051 16.1178 20.3062 15.8789 20.3062 15.6298C20.3062 15.3808 20.4051 15.1419 20.5813 14.9658L24.6055 10.9431H5.12109C4.87245 10.9431 4.634 10.8444 4.45818 10.6685C4.28237 10.4927 4.18359 10.2543 4.18359 10.0056C4.18359 9.75699 4.28237 9.51853 4.45818 9.34272C4.634 9.1669 4.87245 9.06813 5.12109 9.06813H24.6055L20.5828 5.04313C20.4067 4.86701 20.3078 4.62814 20.3078 4.37907C20.3078 4.13 20.4067 3.89113 20.5828 3.715C20.7589 3.53888 20.9978 3.43994 21.2469 3.43994C21.4959 3.43994 21.7348 3.53888 21.9109 3.715L27.5359 9.34C27.6234 9.42722 27.6927 9.53084 27.7399 9.64493C27.7872 9.75901 27.8114 9.8813 27.8113 10.0048C27.8111 10.1283 27.7866 10.2505 27.7391 10.3645C27.6916 10.4784 27.622 10.5819 27.5344 10.6689Z" fill="currentColor"/>
        </svg>
      </a>
    </div>
  </div>
</article>
