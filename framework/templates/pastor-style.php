<?php
$post_id = get_the_ID();
$thumbnail_image = get_field('thumbnail_image', $post_id);
$job = get_field('job', $post_id);
$age = get_field('age', $post_id);
$email = get_field('email', $post_id);
$phone = get_field('phone', $post_id);
$address = get_field('address', $post_id);
$education = get_field('education', $post_id);
$experience = get_field('experience', $post_id);
$awards = get_field('awards', $post_id);
$years_of_experience = get_field('years_of_experience', $post_id);
$socials = get_field('socials', $post_id);

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--thumbnail">
    <div class="bt-cover-image">
      <?php
      if ($thumbnail_image) {
        echo wp_get_attachment_image($thumbnail_image['ID'], $args['image-size']);
      } else {
        the_post_thumbnail($args['image-size']);
      }
      ?>
      <a class="bt-quickview bt-magnific-popup-js" href="<?php echo esc_url('#bt_quickview_' . $post_id); ?>"><svg xmlns="http://www.w3.org/2000/svg" width="64" height="119" viewBox="0 0 64 119" fill="none">
  <path d="M40.3784 118.992H23.6079C22.6573 118.992 21.8765 118.211 21.8765 117.261V47.2322H2.25437C1.30381 47.2322 0.52301 46.4514 0.52301 45.5009V28.7321C0.52301 27.7817 1.30381 27.0009 2.25437 27.0009H21.8765V2.59451C21.8765 1.64405 22.6573 0.863281 23.6079 0.863281H40.3784C41.3289 0.863281 42.1097 1.64405 42.1097 2.59451V27.0009H61.7318C62.6824 27.0009 63.4632 27.7817 63.4632 28.7321V45.5009C63.4632 46.4514 62.6824 47.2322 61.7318 47.2322H42.1097V117.295C42.1097 118.245 41.3289 118.992 40.3784 118.992ZM25.3392 115.563H38.6809V45.5349C38.6809 44.5844 39.4617 43.8037 40.4123 43.8037H60.0344V30.4633H40.4123C39.4617 30.4633 38.6809 29.6826 38.6809 28.7321V4.32565H25.3392V28.7321C25.3392 29.6826 24.5584 30.4633 23.6079 30.4633H3.98572V43.8037H23.6079C24.5584 43.8037 25.3392 44.5844 25.3392 45.5349V115.563Z" fill="currentColor"/>
</svg></a>
    </div>
  </div>
  <div class="bt-post--content">
    <div class="bt-post--infor">
      <?php echo awakenur_post_title_render(); ?>

      <?php
      if (!empty($job)) {
        echo '<div class="bt-post--job">' . $job . '</div>';
      }
      ?>
    </div>
    <?php if (!empty($socials)) { ?>
      <div class="bt-post--social">
        <?php 
   //    var_dump($socials);
        echo awakenur_socials_render($socials); ?>
      </div>
    <?php } ?>
  </div>

  <div id="<?php echo esc_attr('bt_quickview_' . $post_id); ?>" class="bt-pastor-popup mfp-hide">
    <div class="bt-pastor-popup--inner">
      <div class="bt-post">
        <div class="bt-post--thumbnail">
          <div class="bt-cover-image">
            <?php the_post_thumbnail($args['image-size']); ?>
          </div>
        </div>
        <div class="bt-post--content">
          <?php
          if (!empty($job)) {
            echo '<div class="bt-post--job">' . $job . '</div>';
          }
          ?>

          <?php echo awakenur_post_title_render(); ?>

          <?php if (!empty($socials)) { ?>
            <div class="bt-post--social">
              <?php echo awakenur_socials_render($socials); ?>
            </div>
          <?php } ?>

          <?php if (get_the_content()) { ?>
            <div class="bt-post--desc">
              <?php echo get_the_content(); ?>
            </div>
          <?php } ?>

          <div class="bt-post--infor">
            <h4 class="bt-ittle">
              <?php echo __('Infomation', 'awakenur'); ?>
            </h4>
            <ul class="bt-list">
              <?php if (!empty($age)) { ?>
                <li class="bt-item">
                  <?php echo '<span>' . __('Age: ', 'awakenur') . '</span>' .  $age; ?>
                </li>
              <?php } ?>
              <?php if (!empty($email)) { ?>
                <li class="bt-item">
                  <?php echo '<span>' . __('Email: ', 'awakenur') . '</span>' .  $email; ?>
                </li>
              <?php } ?>
              <?php if (!empty($phone)) { ?>
                <li class="bt-item">
                  <?php echo '<span>' . __('Phone: ', 'awakenur') . '</span>' .  $phone; ?>
                </li>
              <?php } ?>
              <?php if (!empty($address)) { ?>
                <li class="bt-item">
                  <?php echo '<span>' . __('Address: ', 'awakenur') . '</span>' .  $address; ?>
                </li>
              <?php } ?>
            </ul>
          </div>

          <div class="bt-post--exp">
            <h4 class="bt-ittle">
              <?php echo __('Experience', 'awakenur'); ?>
            </h4>
            <ul class="bt-list">
              <?php if (!empty($education)) { ?>
                <li class="bt-item">
                  <?php echo '<span class="bt-label">' . __('Education: ', 'awakenur') . '</span>' .  '<span class="bt-text">' . $education . '</span>'; ?>
                </li>
              <?php } ?>
              <?php if (!empty($experience)) { ?>
                <li class="bt-item">
                  <?php echo '<span class="bt-label">' . __('Experience: ', 'awakenur') . '</span>' .  '<span class="bt-text">' . $experience . '</span>'; ?>
                </li>
              <?php } ?>
              <?php if (!empty($awards)) { ?>
                <li class="bt-item">
                  <?php echo '<span class="bt-label">' . __('Awards: ', 'awakenur') . '</span>' .  '<span class="bt-text">' . $awards . '</span>'; ?>
                </li>
              <?php } ?>
              <?php if (!empty($years_of_experience)) { ?>
                <li class="bt-item">
                  <?php echo '<span class="bt-label">' . __('Years Of Experience: ', 'awakenur') . '</span>' .  '<span class="bt-text">' . $years_of_experience . '</span>'; ?>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>