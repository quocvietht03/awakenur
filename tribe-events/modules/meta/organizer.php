<?php

/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count($organizer_ids) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
$website_title = tribe_events_get_organizer_website_title();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h2 class="tribe-events-single-section-title"><?php echo tribe_get_organizer_label(! $multiple); ?></h2>
	<dl>
		<?php
		do_action('tribe_events_single_meta_organizer_section_start');

		foreach ($organizer_ids as $organizer) {
			if (! $organizer) {
				continue;
			}

		?>
			<dt class="tribe-organizer-label">
				<?php esc_html_e('Organizer:', 'awakenur') ?>
			</dt>
			<dd class="tribe-organizer">
				<?php echo tribe_get_organizer_link($organizer) ?>
			</dd>
			<?php
		}

		if (! $multiple) { // only show organizer details if there is one
			if (! empty($phone)) {
			?>
				<dt class="tribe-organizer-tel-label">
					<?php esc_html_e('Phone', 'awakenur') ?>
				</dt>
				<dd class="tribe-organizer-tel">
					<?php echo esc_html($phone); ?>
				</dd>
			<?php
			} //end if

			if (! empty($email)) {
			?>
				<dt class="tribe-organizer-email-label">
					<?php esc_html_e('Email', 'awakenur') ?>
				</dt>
				<dd class="tribe-organizer-email">
					<?php echo esc_html($email); ?>
				</dd>
			<?php
			} //end if

			if (! empty($website)) {
			?>
				<?php if (! empty($website_title)): ?>
					<dt class="tribe-organizer-url-label">
						<?php echo esc_html($website_title) ?>
					</dt>
				<?php else: ?>
					<dt
						class="tribe-common-a11y-visual-hide"
						aria-label="<?php echo sprintf(
										/* Translators: %1$s is the customizable organizer term, e.g. "Organizer". %2$s is the customizable event term in lowercase, e.g. "event". %3$s is the customizable organizer term in lowercase, e.g. "organizer". */
										esc_html_x('%1$s website title: This represents the website title of the %2$s %3$s.', 'context', 'awakenur'),
										esc_html(tribe_get_organizer_label_singular()),
										esc_html(tribe_get_event_label_singular_lowercase()),
										esc_html(tribe_get_organizer_label_singular_lowercase())
									); ?>">
						<?php // This element is only present to ensure we have valid HTML. It'll be hidden from browsers but visible to screen readers for accessibility. 
						?>
					</dt>
				<?php endif; ?>
				<?php echo '<dd class="tribe-organizer-url">' . $website . '</dd>'; ?>

		<?php
			} //end if
		} //end if

		do_action('tribe_events_single_meta_organizer_section_end');
		?>
	</dl>
</div>