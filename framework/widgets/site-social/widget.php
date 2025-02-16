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
			'list',
			[
				'label' => esc_html__( 'Show Elements', 'awakenur' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'facebook' => esc_html__( 'Facebook', 'awakenur' ),
					'twitter' => esc_html__( 'Twitter', 'awakenur' ),
					'instagram'  => esc_html__( 'Instagram', 'awakenur' ),
					'telegram' => esc_html__('telegram', 'awakenur'),
				],
				'default' => [ 'facebook', 'twitter','instagram' ],
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
		$this->add_responsive_control(
			'size_item',
			[
				'label' => __('Size Item', 'awakenur'),
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
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);
		$this->add_responsive_control(
			'size_icon',
			[
				'label' => __('Size Icon', 'awakenur'),
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
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social a.bt-item svg' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style!' => 'default',
				],
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
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-social' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);
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
		if(empty($settings['list'])) {
			return;
		}
		?>
			<div class="bt-elwg-site-social">
				<?php echo awakenur_socials_elm_render($site_infor['site_socials'],$settings['list']); ?>
			</div>
		<?php
	}

	protected function content_template()
	{
	}
}
