<?php
/*
 * Single Therapist
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');
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
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-detail-ss">
		<div class="bt-container">
			<?php
			while (have_posts()) : the_post();
			?>
				<div class="bt-post">
					<div class="bt-post--thumbnail">
						<div class="bt-cover-image">
							<?php the_post_thumbnail('full'); ?>
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
			<?php

			endwhile;
			?>
		</div>
	</div>
	<?php get_template_part('framework/templates/pastor', 'related-posts'); ?>
</main><!-- #main -->

<?php get_footer(); ?>