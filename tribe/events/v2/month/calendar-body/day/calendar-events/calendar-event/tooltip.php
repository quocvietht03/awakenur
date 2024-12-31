<?php
/**
 * View: Month View - Calendar Event Tooltip
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/calendar-body/day/calendar-events/calendar-event/tooltip.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.9.13
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

?>
<div class="tribe-events-calendar-month__calendar-event-tooltip-template tribe-common-a11y-hidden">
	<div
		class="tribe-events-calendar-month__calendar-event-tooltip"
		id="tribe-events-tooltip-content-<?php echo esc_attr( $event->ID ); ?>"
		role="tooltip"
	>
		<?php   get_template_part('framework/templates/event', 'style', array('event' => $event, 'image-size' => 'medium_large')); ?>
	</div>
</div>
