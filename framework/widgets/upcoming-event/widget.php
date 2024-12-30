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

        ?>
			<div class="bt-elwg-upcoming-event <?php echo 'bt-layout-' . esc_attr($settings['layout']); ?>">
				<?php 
					if( !empty($events) ) {
						foreach ( $events as $event ) {
							get_template_part( 'framework/templates/upcoming', 'event', array('event' => $event));
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
