<?php
namespace AwakenurElementorWidgets\Widgets\SermonLoopItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_SermonLoopItem extends Widget_Base {


	public function get_name() {
		return 'bt-sermon-loop-item';
	}

	public function get_title() {
		return __( 'Sermon Loop Item', 'awakenur' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'awakenur' ];
	}

	protected function register_layout_section_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'awakenur' ),
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'label' => __( 'Image Size', 'awakenur' ),
				'show_label' => true,
				'default' => 'medium',
				'exclude' => [ 'custom' ],
			]
		);

		$this->add_responsive_control(
			'image_ratio',[
				'label' => __( 'Image Ratio', 'awakenur' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.64,
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

	protected function register_style_section_controls() {

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'awakenur' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'Border Radius', 'awakenur' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bt-post--thumbnail .bt-cover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab( 'thumbnail_tab_normal',
			[
				'label' => __( 'Normal', 'awakenur' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),[
				'name' => 'thumbnail_filters',
				'selector' => '{{WRAPPER}} .bt-post--thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'thumbnail_tab_hover',[
				'label' => __( 'Hover', 'awakenur' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),[
				'name'     => 'thumbnail_hover_filters',
				'selector' => '{{WRAPPER}} .bt-post:hover .bt-post--thumbnail img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',[
				'label' => esc_html__( 'Content', 'awakenur' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'background_content',[
				'label'     => esc_html__( 'Background Content', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--content' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_style',[
				'label' => esc_html__( 'Title', 'awakenur' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',[
				'label'     => esc_html__( 'Color', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover',[
				'label'     => esc_html__( 'Color Hover', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'awakenur' ),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-post--title a',
			]
		);

		$this->add_control(
			'category_style',[
				'label' => esc_html__( 'Category', 'awakenur' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'category_color',[
				'label'     => esc_html__( 'Color', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--term > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'category_background',[
				'label'     => esc_html__( 'Background', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--term > a' => 'Background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Typography', 'awakenur' ),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-post--term > a',
			]
		);
		$this->add_control(
			'meta_style',[
				'label' => esc_html__( 'Meta', 'awakenur' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'meta_color',[
				'label'     => esc_html__( 'Color', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--meta li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Typography', 'awakenur' ),
				'default'  => '',
				'selector' => '{{WRAPPER}} .bt-post--meta li',
			]
		);
		$this->add_control(
			'button_style',[
				'label' => esc_html__( 'Button', 'awakenur' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'button_color',[
				'label'     => esc_html__( 'Color', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--action > a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bt-post--action a.bt-share-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_icon_hover',[
				'label'     => esc_html__( 'Icon hover', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--action > a:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
					'{{WRAPPER}} .bt-post--action a.bt-share-link:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_border_color',[
				'label'     => esc_html__( 'Border Color', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--action > a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .bt-post--action a.bt-share-link' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background',[
				'label'     => esc_html__( 'Background', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--action > a' => 'Background: {{VALUE}};',
					'{{WRAPPER}} .bt-post--action a.bt-share-link' => 'Background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover',[
				'label'     => esc_html__( 'Background hover', 'awakenur' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bt-post--action > a:hover' => 'Background: {{VALUE}};border-color: {{VALUE}};',
					'{{WRAPPER}} .bt-post--action a.bt-share-link:hover' => 'Background: {{VALUE}};border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function register_controls() {
		$this->register_layout_section_controls();
		$this->register_style_section_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<div class="bt-elwg-sermon-loop-item--default">
				<?php get_template_part( 'framework/templates/sermon', 'style', array('image-size' => $settings['thumbnail_size'])); ?>
	    	</div>
		<?php
	}

	protected function content_template() {

	}
}
