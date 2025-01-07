<?php
namespace AwakenurElementorWidgets\Widgets\SiteInformationStyle1;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_SiteInformationStyle1 extends Widget_Base {

	public function get_name() {
		return 'bt-site-information-style-1';
	}

	public function get_title() {
		return __( 'Site Information Style 1', 'awakenur' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'awakenur' ];
	}

	protected function register_content_section_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'awakenur' ),
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
					'email' => esc_html__( 'Email', 'awakenur' ),
					'address' => esc_html__( 'Address', 'awakenur' ),
					'phone'  => esc_html__( 'Phone', 'awakenur' ),
				],
				'default' => [ 'phone' ],
			]
		);
		$this->add_control(
			'title_phone',
			[
				'label' => esc_html__('Title Phone', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Contact Us', 'awakenur'),
			]
		);
		$this->add_control(
			'title_email',
			[
				'label' => esc_html__('Title Email', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Email Address', 'awakenur'),
			]
		);
		$this->add_control(
			'title_address',
			[
				'label' => esc_html__('Title Address', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Address Business', 'awakenur'),
			]
		);
		$this->end_controls_section();
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'awakenur' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Layout Style', 'awakenur' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'column' => [
						'title' => esc_html__( 'Block', 'awakenur' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'row' => [
						'title' => esc_html__( 'Inline', 'awakenur' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'flex-direction: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => __( 'Space Between', 'awakenur' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'column-gap: {{SIZE}}{{UNIT}}',
				],

				'condition' => [
					'style' => 'row',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Space Between', 'awakenur' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor' => 'row-gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style' => 'column',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls() {

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'awakenur' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => __('Icon', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'awakenur' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Icon Border Color', 'awakenur' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}  .bt-elwg-site-infor--item-icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_background',
			[
				'label' => __( 'Icon Background', 'awakenur' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item-icon' => 'background: {{VALUE}};',
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
				'label' => __( 'Title Color', 'awakenur' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item-content h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'awakenur' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-infor--item-content h4',
			]
		);
		$this->add_control(
			'text_style',
			[
				'label' => __('Info', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Info Color', 'awakenur' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item-content span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'Color Hover', 'awakenur' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-elwg-site-infor--item a:hover span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Typography', 'awakenur' ),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-elwg-site-infor--item-content span',
			]
		);

		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_content_section_controls();
		$this->register_layout_section_controls();
		$this->register_style_content_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if(empty($settings['list'])) {
			return;
		}
	?>
			<div class="bt-elwg-site-infor bt-elwg-site-infor--style-1">  
				<?php get_template_part( 'framework/templates/site-information', 'style', array('layout' => 'style-1', 'data' => $settings['list'],'title_phone' => $settings['title_phone'],'title_email' => $settings['title_email'],'title_address' => $settings['title_address'])); ?>
			</div>
		<?php
	}

	protected function content_template() {

	}
}
