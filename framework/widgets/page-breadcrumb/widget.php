<?php

namespace AwakenurElementorWidgets\Widgets\PageBreadcrumb;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_PageBreadcrumb extends Widget_Base
{

	public function get_name()
	{
		return 'bt-page-breadcrumb';
	}

	public function get_title()
	{
		return __('Page Breadcrumb', 'awakenur');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['awakenur'];
	}

	protected function register_content_section_controls() {}

	protected function register_style_content_section_controls()
	{

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb > *' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => __('link Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'link_color_hover',
			[
				'label' => __('link Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-page-breadcrumb a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __('Text Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-page-breadcrumb',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

?>
		<div class="bt-elwg-page-breadcrumb">
			<div class="bt-page-breadcrumb">
				<?php
				$home_text = esc_html__('Home', 'awakenur');
				$delimiter = '/';
				echo awakenur_page_breadcrumb($home_text, $delimiter);
				?>
			</div>
		</div>
<?php
	}

	protected function content_template() {}
}
