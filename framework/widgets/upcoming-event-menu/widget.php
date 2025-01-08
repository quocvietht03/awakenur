<?php

namespace AwakenurElementorWidgets\Widgets\UpcomingEventMenu;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_UpcomingEventMenu extends Widget_Base
{

	public function get_name()
	{
		return 'bt-upcoming-event-menu';
	}

	public function get_title()
	{
		return __('Upcoming Event Menu', 'awakenur');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['awakenur'];
	}

	public function get_script_depends()
	{
		return ['elementor-widgets'];
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'awakenur'),
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$args = [
			'posts_per_page' => 1,
			'eventDisplay'   => 'upcoming',
		];

		$events = tribe_get_events($args);

?>
		<div class="bt-elwg-upcoming-event-menu">
			<?php
			if (!empty($events)) {
				foreach ($events as $event) {
					$event_id = $event->ID;
			?>
					<article <?php post_class('bt-tribe-event'); ?>>
						<div class="bt-tribe-event--inner">
							<div class="bt-cover-image">
								<?php
								echo get_the_post_thumbnail($event_id, 'large');
								?>
							</div>
							<div class="bt-tribe-event--content">
								<div class="bt-tribe-event--infor">
									<?php
									echo '<div class="bt-tribe-event--subtext">' . esc_html('Upcoming Event', 'awakenur') . '</div>';

									echo '<h3 class="bt-tribe-event--title">
										<a href="' . get_the_permalink($event->ID) . '">' . $event->post_title . '</a>
										</h3>';
									?>
								</div>
								<div class="bt-tribe-event--countdown">
									<div class="bt-countdown bt-countdown-js" data-time="<?php echo tribe_get_start_date($event->ID, true, 'Y-m-d H:m:s'); ?>">
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
								<div class="bt-tribe-event--button bt-button-hover-style2">
									<a href="<?php echo esc_url(get_the_permalink($event->ID)); ?>">
										<?php echo '<span>' . __('Register Now', 'awakenur') . '</span>'; ?>
										<svg width="32" height="20" viewBox="0 0 32 20" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M27.5344 10.6689L21.9094 16.2939C21.7333 16.47 21.4944 16.569 21.2453 16.569C20.9962 16.569 20.7574 16.47 20.5813 16.2939C20.4051 16.1178 20.3062 15.8789 20.3062 15.6298C20.3062 15.3808 20.4051 15.1419 20.5813 14.9658L24.6055 10.9431H5.12109C4.87245 10.9431 4.634 10.8444 4.45818 10.6685C4.28237 10.4927 4.18359 10.2543 4.18359 10.0056C4.18359 9.75699 4.28237 9.51853 4.45818 9.34272C4.634 9.1669 4.87245 9.06813 5.12109 9.06813H24.6055L20.5828 5.04313C20.4067 4.86701 20.3078 4.62814 20.3078 4.37907C20.3078 4.13 20.4067 3.89113 20.5828 3.715C20.7589 3.53888 20.9978 3.43994 21.2469 3.43994C21.4959 3.43994 21.7348 3.53888 21.9109 3.715L27.5359 9.34C27.6234 9.42722 27.6927 9.53084 27.7399 9.64493C27.7872 9.75901 27.8114 9.8813 27.8113 10.0048C27.8111 10.1283 27.7866 10.2505 27.7391 10.3645C27.6916 10.4784 27.622 10.5819 27.5344 10.6689Z" fill="currentColor" />
										</svg>
									</a>
								</div>
							</div>

						</div>
					</article>

			<?php
				}
			} else {
				get_template_part('framework/templates/post', 'none');
			}
			?>
		</div>
<?php
	}

	protected function content_template() {}
}
