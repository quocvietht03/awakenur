<?php

namespace AwakenurElementorWidgets\Widgets\SiteOpening;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteOpening extends Widget_Base
{

	public function get_name()
	{
		return 'bt-site-opening';
	}

	public function get_title()
	{
		return __('Site Opening', 'awakenur');
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

	protected function register_style_section_controls()
	{
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => esc_html__('Layout', 'awakenur'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'awakenur'),
					'style1' => esc_html__('Style 1', 'awakenur'),
				],
			]
		);
		$this->add_control(
			'titmetitle_style',
			[
				'label' => __('Title', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'timetitle_color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-item--title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timetitle_typography',
				'label' => __('Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-item--title',
			]
		);

		$this->add_control(
			'timehours_style',
			[
				'label' => __('Hours', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'timehours_color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-item--hours' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'timehours_typography',
				'label' => __('Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-item--hours',
			]
		);
		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_style_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$site_information = get_field('site_information', 'options');

?>
		<div class="bt-elwg-site-opening <?php echo 'bt-layout-' . esc_attr($settings['layout']); ?>">
			<ul class="bt-list">
				<?php
				if (!empty($site_information['opening_hours'])) {
					foreach ($site_information['opening_hours'] as $item) {
				?>
						<div class="bt-item">
							<div class="bt-item--title">
								<?php
								if ($settings['layout'] == 'default') {
									echo esc_html($item['short_heading']);
								} else {
									echo esc_html($item['heading']);
								}

								?>
							</div>
							<div class="bt-item--hours">
								<?php echo esc_html($item['hours']); ?>
							</div>
						</div>
						</li>
				<?php
					}
				}
				?>
			</ul>
		</div>
<?php
	}

	protected function content_template() {}
}
