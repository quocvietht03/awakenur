<?php

namespace AwakenurElementorWidgets\Widgets\EventGrid;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_EventGrid extends Widget_Base
{

	public function get_name()
	{
		return 'bt-event-grid';
	}

	public function get_title()
	{
		return __('Event Grid', 'awakenur');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['awakenur'];
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __('Layout', 'awakenur'),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __('Posts Per Page', 'awakenur'),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);
		$this->add_responsive_control(
			'column',
			[
				'label' => __('Column', 'awakenur'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
				'min' => 1,
				'max' => 6,
			]
		);
		$this->add_responsive_control(
			'gap',
			[
				'label' => __('Gap', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'label' => __('Image Size', 'awakenur'),
				'show_label' => true,
				'default' => 'medium',
				'exclude' => ['custom'],
			]
		);

		$this->add_responsive_control(
			'image_ratio',
			[
				'label' => __('Image Ratio', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.66,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-cover-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);


		$this->end_controls_section();
	}


	protected function register_style_section_controls()
	{
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __('Border Radius', 'awakenur'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-cover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('thumbnail_effects_tabs');

		$this->start_controls_tab(
			'thumbnail_tab_normal',
			[
				'label' => __('Normal', 'awakenur'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .bt-post--thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumbnail_tab_hover',
			[
				'label' => __('Hover', 'awakenur'),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .bt-post:hover .bt-post--thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'background_content',
			[
				'label' => __('Background Content', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--content' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'date_style',
			[
				'label' => __('Date', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--start-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'date_background',
			[
				'label' => __('Background', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--start-date' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => __('Title', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--title',
			]
		);

		$this->add_control(
			'meta_style',
			[
				'label' => __('Meta', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--time' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-post--address' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __('Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--meta',
			]
		);
		$this->add_control(
			'button_style',
			[
				'label' => __('button', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-post--thumbnail .bt-register-now',
			]
		);
		$this->start_controls_tabs('button_style_tabs');

		$this->start_controls_tab(
			'style_normal',
			[
				'label' => __('Normal', 'awakenur'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Text Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-register-now' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __('Background Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-register-now' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover',
			[
				'label' => __('Hover', 'awakenur'),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __('Text Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-register-now:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => __('Background Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-register-now:before' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .bt-post--thumbnail .bt-register-now:after' => 'border-top-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function register_controls()
	{

		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$grid_styles = [
			'grid-columns' => isset($settings['column']) ? $settings['column'] : 3,
			'grid-gap' => isset($settings['gap']['size']) ? $settings['gap']['size'] . (isset($settings['gap']['unit']) ? $settings['gap']['unit'] : 'px') : '30px',
			'grid-columns-tablet' => isset($settings['column_tablet']) ? $settings['column_tablet'] : '',
			'grid-gap-tablet' => !empty($settings['gap_tablet']['size']) ? $settings['gap_tablet']['size'] . (!empty($settings['gap_tablet']['unit']) ? $settings['gap_tablet']['unit'] : '') : '',
			'grid-columns-mobile' => isset($settings['column_mobile']) ? $settings['column_mobile'] : '',
			'grid-gap-mobile' => !empty($settings['gap_mobile']['size']) ? $settings['gap_mobile']['size'] . (!empty($settings['gap_mobile']['unit']) ? $settings['gap_mobile']['unit'] : '') : ''
		];

		$style_properties = array_filter($grid_styles, function ($value) {
			return !empty($value);
		});
		$style = implode(' ', array_map(function ($property, $value) {
			return "--$property: " . esc_attr($value) . ";";
		}, array_keys($style_properties), $style_properties));

		$args = [
			'posts_per_page' => $settings['posts_per_page'],
			'eventDisplay'   => 'upcoming',
		];

		$events = tribe_get_events($args);


		echo '<div class="bt-elwg-event-grid" style="' . $style . '">';

		if (!empty($events)) {
			foreach ($events as $event) {
				get_template_part('framework/templates/event', 'style', array('event' => $event, 'image-size' => $settings['thumbnail_size']));
			}
		} else {
			get_template_part('framework/templates/post', 'none');
		}
		echo '</div>';
?>
	
<?php
	}


	protected function content_template() {}
}
