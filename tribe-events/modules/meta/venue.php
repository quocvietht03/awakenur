<?php

/**
 * Single Event Meta (Venue) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/venue.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if (! tribe_get_venue_id()) {
	return;
}

$phone   = tribe_get_phone();
$website = tribe_get_venue_website_link();
$website_title = tribe_events_get_venue_website_title();

?>

<div class="tribe-events-meta-group tribe-events-meta-group-venue">
	<h2 class="tribe-events-single-section-title"> <?php echo esc_html(tribe_get_venue_label_singular()) ?> </h2>
	<dl>
		<?php do_action('tribe_events_single_meta_venue_section_start') ?>

		<?php if (tribe_address_exists()) : ?>
			<dt
				class="tribe-venue-location-label">
				<?php esc_html_e('location', 'awakenur') ?>
			</dt>
			<dd class="tribe-venue-location">
				<address class="tribe-events-address">
					<?php echo tribe_get_full_address(); ?>

					<?php if (tribe_show_google_map_link()) : ?>
						<?php echo tribe_get_map_link_html(); ?>
					<?php endif; ?>
				</address>
			</dd>
		<?php endif; ?>

		<?php if (! empty($phone)): ?>
			<dt class="tribe-venue-tel-label"> <?php esc_html_e('Phone', 'awakenur') ?> </dt>
			<dd class="tribe-venue-tel"> <?php echo esc_html($phone) ?> </dd>
		<?php endif ?>

		<?php if (! empty($website)): ?>
			<?php if (! empty($website_title)): ?>
				<dt class="tribe-venue-url-label"> <?php echo esc_html($website_title) ?> </dt>
			<?php else: ?>
				<dt
					class="tribe-common-a11y-visual-hide"
					aria-label="<?php echo sprintf(
									/* Translators: %1$s is the customizable venue term, e.g. "Venue". %2$s is the customizable event term in lowercase, e.g. "event". %3$s is the customizable venue term in lowercase, e.g. "venue". */
									esc_html_x('%1$s website title: This represents the website title of the %2$s %3$s.', 'context', 'awakenur'),
									esc_html(tribe_get_venue_label_singular()),
									esc_html(tribe_get_event_label_singular_lowercase()),
									esc_html(tribe_get_venue_label_singular_lowercase())
								); ?>">
					<?php // This element is only present to ensure we have valid HTML. It'll be hidden from browsers but visible to screen readers for accessibility. 
					?>
				</dt>
			<?php endif ?>
		 <?php echo '<dd class="tribe-venue-url">' . $website . '</dd>';?> 
		<?php endif ?>

		<?php do_action('tribe_events_single_meta_venue_section_end') ?>
	</dl>
</div>