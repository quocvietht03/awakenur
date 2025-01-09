<?php
namespace AwakenurElementorWidgets\Widgets\UpcomingEvent;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_UpcomingEvent extends Widget_Base {

	public function get_name() {
		return 'bt-upcoming-event';
	}

	public function get_title() {
		return __( 'Upcoming Event', 'awakenur' );
	}

  public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'awakenur' ];
	}

	public function get_script_depends() {
        return ['elementor-widgets'];
    }

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'awakenur' ),
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'awakenur' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'awakenur' ),
					'boxed' => esc_html__( 'Boxed', 'awakenur' ),
				],
			]
		);
		$this->add_control(
			'events_all_url',
			[
				'label' => esc_html__('All Events Url', 'awakenur'),
				'type' => Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '/upcoming-events',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_layout_section_controls();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		$args = [
			'posts_per_page' => 1,
			'eventDisplay'   => 'upcoming',
		];
		
        $events = tribe_get_events($args);
		$events_all_url = '';
		if (!empty($settings['events_all_url']['url'])) {
		  $this->add_link_attributes('event_url', $settings['events_all_url']);
		  $events_all_url = $this->get_render_attribute_string('event_url');
		}
        ?>
			<div class="bt-elwg-upcoming-event <?php echo 'bt-layout-' . esc_attr($settings['layout']); ?>">
				<?php 
					if( !empty($events) ) {
						foreach ( $events as $event ) {
							get_template_part( 'framework/templates/upcoming', 'event', array('event' => $event,'events_all_url' => $events_all_url));
						}
					} else {
						get_template_part( 'framework/templates/post', 'none');
					} 
				?>
			</div>
        <?php
	}

	protected function content_template() {

	}

}
