<?php

namespace AwakenurElementorWidgets\Widgets\SiteSocial;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteSocial extends Widget_Base
{

	public function get_name()
	{
		return 'bt-site-social';
	}

	public function get_title()
	{
		return __('Site Social', 'awakenur');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['awakenur'];
	}

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
			'style',
			[
				'label' => __('Style', 'awakenur'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', 'awakenur'),
					'Custom' => __('Custom', 'awakenur'),
				],
			]
		);

		$this->start_controls_tabs( 'style_effects_tabs' );

		$this->start_controls_tab( 'style_tab_normal',
			[
				'label' => __( 'Normal', 'awakenur' ),
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __('Border Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'style_tab_hover',[
				'label' => __( 'Hover', 'awakenur' ),
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->add_control(
			'color_hover',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label' => __('Background Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->add_control(
			'border_color_hover',
			[
				'label' => __('Border Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_style_content_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if (function_exists('get_field')) {
			$site_infor = get_field('site_information', 'options');
		} else {
			return;
		}

		if (empty($site_infor['site_socials'])) {
			return;
		}

		?>
			<div class="bt-elwg-site-social">
				<?php echo awakenur_socials_render($site_infor['site_socials']); ?>
			</div>
		<?php
	}

	protected function content_template()
	{
	}
}
