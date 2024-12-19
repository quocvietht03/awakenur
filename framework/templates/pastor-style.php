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
      <a class="bt-quickview bt-magnific-popup-js" href="<?php echo esc_url('#bt_quickview_' . $post_id); ?>"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M21.3973 20.8979L16.5804 16.081C17.954 14.5014 18.6606 12.4501 18.5513 10.3596C18.442 8.26915 17.5253 6.30277 15.9944 4.875C14.4635 3.44723 12.4381 2.66961 10.3451 2.70606C8.25208 2.74251 6.25497 3.59019 4.77475 5.07041C3.29454 6.55062 2.44686 8.54773 2.41041 10.6408C2.37395 12.7338 3.15157 14.7592 4.57934 16.2901C6.00712 17.8209 7.9735 18.7376 10.064 18.8469C12.1545 18.9563 14.2057 18.2496 15.7854 16.876L20.6023 21.6929C20.7089 21.7923 20.8499 21.8464 20.9957 21.8438C21.1414 21.8412 21.2804 21.7822 21.3835 21.6791C21.4865 21.5761 21.5456 21.437 21.5481 21.2913C21.5507 21.1456 21.4966 21.0045 21.3973 20.8979ZM3.56226 10.7954C3.56226 9.42331 3.96914 8.08201 4.73144 6.94115C5.49374 5.80028 6.57723 4.91108 7.84489 4.386C9.11256 3.86092 10.5075 3.72353 11.8532 3.99122C13.1989 4.2589 14.4351 4.91963 15.4053 5.88986C16.3755 6.86009 17.0363 8.09623 17.304 9.44198C17.5716 10.7877 17.4343 12.1826 16.9092 13.4503C16.3841 14.7179 15.4949 15.8014 14.354 16.5637C13.2132 17.326 11.8719 17.7329 10.4998 17.7329C8.66051 17.7307 6.89722 16.9991 5.59667 15.6985C4.29612 14.398 3.56449 12.6347 3.56226 10.7954Z" fill="currentColor" />
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
        <?php echo awakenur_socials_render($socials); ?>
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