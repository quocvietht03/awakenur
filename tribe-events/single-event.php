<?php

/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

if (! defined('ABSPATH')) {
	die('-1');
}
get_template_part('framework/templates/site', 'titlebar');
$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = Tribe__Events__Main::postIdHelper(get_the_ID());

/**
 * Allows filtering of the event ID.
 *
 * @since 6.0.1
 *
 * @param numeric $event_id
 */
$event_id = apply_filters('tec_events_single_event_id', $event_id);

/**
 * Allows filtering of the single event template title classes.
 *
 * @since 5.8.0
 *
 * @param array   $title_classes List of classes to create the class string from.
 * @param numeric $event_id      The ID of the displayed event.
 */
$title_classes = apply_filters('tribe_events_single_event_title_classes', ['tribe-events-single-event-title'], $event_id);
$title_classes = implode(' ', tribe_get_classes($title_classes));

/**
 * Allows filtering of the single event template title before HTML.
 *
 * @since 5.8.0
 *
 * @param string  $before   HTML string to display before the title text.
 * @param numeric $event_id The ID of the displayed event.
 */
$before = apply_filters('tribe_events_single_event_title_html_before', '<h2 class="' . $title_classes . '">', $event_id);

/**
 * Allows filtering of the single event template title after HTML.
 *
 * @since 5.8.0
 *
 * @param string  $after    HTML string to display after the title text.
 * @param numeric $event_id The ID of the displayed event.
 */
$after = apply_filters('tribe_events_single_event_title_html_after', '</h2>', $event_id);

/**
 * Allows filtering of the single event template title HTML.
 *
 * @since 5.8.0
 *
 * @param string  $after    HTML string to display. Return an empty string to not display the title.
 * @param numeric $event_id The ID of the displayed event.
 */
$title = apply_filters('tribe_events_single_event_title_html', the_title($before, $after, false), $event_id);
$cost  = tribe_get_formatted_cost($event_id);

?>

<div id="tribe-events-content" class="tribe-events-single">

	<!-- Notices -->
	<?php tribe_the_notices() ?>


	<?php while (have_posts()) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('bt-event'); ?>>
			<!-- Event featured image, but exclude link -->
			<div class="bt-event--thumbnail">
				<div class="bt-cover-image">
					<?php echo tribe_event_featured_image($event_id, 'full', false); ?>
				</div>
				<div class="bt-event--infor">
					<?php if (! empty($cost) && $cost != 'Free') { ?>
						<div class="bt-event--cost"><?php echo esc_html($cost) ?><span><?php echo esc_html__('/ticket', 'awakenur') ?></span></div>
					<?php }elseif ($cost == 'Free') {
					?>
						<div class="bt-event--cost-free"><?php echo esc_html__('Free Ticket', 'awakenur') ?></div>
					<?php } ?>
					<?php echo '<div class="bt-event--title">' . $title . '</div>'; ?>
				</div>
			</div>


			<!-- Event content -->
			<?php do_action('tribe_events_single_event_before_the_content') ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<h2 class="bt-title"><?php esc_html_e('About Event', 'awakenur') ?></h2>
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action('tribe_events_single_event_after_the_content') ?>

			<!-- Event meta -->
			<div class="bt-event--meta">
				<?php do_action('tribe_events_single_event_before_the_meta') ?>
				<?php tribe_get_template_part('modules/meta'); ?>
				<?php do_action('tribe_events_single_event_after_the_meta') ?>
			</div>
		</div> <!-- #post-x -->
		<?php if (get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option('showComments', false)) comments_template() ?>
	<?php endwhile; ?>


</div><!-- #tribe-events-content -->
<?php get_template_part('framework/templates/event', 'related-posts'); ?>