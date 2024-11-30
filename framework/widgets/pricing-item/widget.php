<?php

namespace AwakenurElementorWidgets\Widgets\PricingItem;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_PricingItem extends Widget_Base
{

	public function get_name()
	{
		return 'bt-pricing-item';
	}

	public function get_title()
	{
		return __('Pricing Item', 'awakenur');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['awakenur'];
	}

	protected function register_content_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'awakenur'),
			]
		);
		$this->add_control(
			'pricing_image',
			[
				'label' => esc_html__('Images', 'awakenur'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'pricing_image',
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
					'size' => 0.832,
				],
				'range' => [
					'px' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--featured .bt-cover-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
				],
			]
		);
		$this->add_control(
			'pricing_svg',
			[
				'label' => esc_html__('Icon Pricing', 'awakenur'),
				'type' => Controls_Manager::MEDIA,
				'media_types' => ['svg'],
			]
		);
		$this->add_control(
			'heading',
			[
				'label' => esc_html__('Heading', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the heading', 'awakenur'),
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('$200', 'awakenur'),
			]
		);
		$this->add_control(
			'price_after',
			[
				'label' => esc_html__('Price After', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__(' / Monthly', 'awakenur'),
			]
		);
		$this->add_control(
			'time',
			[
				'label' => esc_html__('Time', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('60 Mins', 'awakenur'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'list_content',
			[
				'label' => __('Content', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the info', 'awakenur'),
			]
		);

		$this->add_control(
			'list_info',
			[
				'label' => __('List Info', 'awakenur'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_content' => esc_html__('90-Minute Swedish Massage', 'awakenur')
					],
					[
						'list_content' => esc_html__('60-Minute Classic Facial', 'awakenur')
					],
					[
						'list_content' => esc_html__('45-Minute Full Body Scrub', 'awakenur')
					],
					[
						'list_content' => esc_html__('Aromatherapy Session', 'awakenur')
					],
				],
				'title_field' => '{{{ list_content }}}',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Subscribe Now', 'awakenur'),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => esc_html__('Button Url', 'awakenur'),
				'type' => Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_more',
			[
				'label' => esc_html__('Button More', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('pay per session.', 'awakenur'),
			]
		);

		$this->add_control(
			'button_more_url',
			[
				'label' => esc_html__('Button More Url', 'awakenur'),
				'type' => Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}

	protected function register_style_box_section_controls()
	{


		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__('Box', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Border Radius', 'awakenur'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--featured .bt-cover-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .bt-pricing--wrap-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .bt-pricing--infor' => 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .bt-pricing-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-pricing-item',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls()
	{

		$this->start_controls_section(
			'section_style_content_image',
			[
				'label' => esc_html__('Content Image', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background_content_image',
			[
				'label' => __('Background Content Image', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--wrap-image' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_image_pricing',
			[
				'label' => __('Icon', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_image_ratio',
			[
				'label' => __('Icon Width', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--wrap-image svg ' => 'width: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'icon_image_color',
			[
				'label' => __('Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--wrap-image svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_pricing',
			[
				'label' => __('Heading', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => __('Heading Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--heading' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_color_hover',
			[
				'label' => __('Heading Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--heading:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Heading Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--heading',
			]
		);
		$this->add_control(
			'price_pricing',
			[
				'label' => __('Price', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => __('Price Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __('Price Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--price',
			]
		);
		$this->add_control(
			'price_after_pricing',
			[
				'label' => __('Price After', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_after_color',
			[
				'label' => __('Price After Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--price-after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_after_typography',
				'label' => __('Price After Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--price-after',
			]
		);
		$this->add_control(
			'time_pricing',
			[
				'label' => __('Time', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'time_color',
			[
				'label' => __('Time Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--time' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'time_background',
			[
				'label' => __('Time Background', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--time' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'time_typography',
				'label' => __('Heading Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--time',
			]
		);
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
					'{{WRAPPER}} .bt-pricing--infor' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'border_width_content_ratio',
			[
				'label' => __('Border Content Width', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--infor' => 'border-width: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'border_color_content',
			[
				'label' => __('Border Content Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--infor' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'list_info_pricing',
			[
				'label' => __('List Info', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'info_color',
			[
				'label' => __('Info Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--info li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_typography',
				'label' => __('Info Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--info li',
			]
		);
		$this->add_responsive_control(
			'info_ratio',
			[
				'label' => __('Margin Bottom', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 32,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--info ' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'button_pricing',
			[
				'label' => __('Button', 'awakenur'),
				'type' => Controls_Manager::HEADING,
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
					'{{WRAPPER}} .bt-pricing--button' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-pricing--button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_border_width_ratio',
			[
				'label' => __('Border Width', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button' => 'border-width: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'button_border_color',
			[
				'label' => __('Border Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-pricing--button:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-pricing--button:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_border_width_ratio_hover',
			[
				'label' => __('Border Width Hover', 'awakenur'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button:hover' => 'border-width: {{SIZE}}px;',
				],
			]
		);
		$this->add_control(
			'button_border_color_hover',
			[
				'label' => __('Border Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Button Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--button',
			]
		);
		$this->add_control(
			'button_more_pricing',
			[
				'label' => __('Button More', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'button_more_color',
			[
				'label' => __('Button More Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--button-more a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_more_typography',
				'label' => __('Button More Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--button-more',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_content_section_controls();
		$this->register_style_content_section_controls();
		$this->register_style_box_section_controls();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$svg_url = $settings['pricing_svg']['url'];


?>
		<div class="bt-elwg-pricing-item--default">
			<div class="bt-pricing-item ">
				<div class="bt-pricing--featured">
					<?php if (!empty($settings['pricing_image'])) {
						$image = $settings['pricing_image'];
						$image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'pricing_image', $settings);
						if (!$image_url) {
							$image_url = $image['url'];
						}
					?>
						<div class="bt-cover-image">
							<img src="<?php echo esc_url($image_url) ?>" alt="" />
						</div>

					<?php } ?>
					<div class="bt-pricing--wrap-image">
						<?php
						if (!empty($svg_url) && 'svg' === pathinfo($svg_url, PATHINFO_EXTENSION)) {
							echo file_get_contents($svg_url);
						}
						if (!empty($settings['heading'])) {
							echo '<h3 class="bt-pricing--heading">' . esc_html($settings['heading']) . '</h3>';
						}
						?>
						<div class="bt-pricing--price-time">
							<div class="bt-pricing--price">
								<?php
								if (!empty($settings['price'])) {
									echo esc_html($settings['price']);
								}
								if (!empty($settings['price_after'])) {
									echo '<span class="bt-pricing--price-after">' . esc_html($settings['price_after']) . '</span>';
								}
								?>
							</div>
							<div class="bt-pricing--time">
								<?php
								if (!empty($settings['time'])) {
									echo esc_html($settings['time']);
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="bt-pricing--infor">
					<?php if (!empty($settings['list_info'])) { ?>
						<ul class="bt-pricing--info">
							<?php foreach ($settings['list_info'] as $item) { ?>
								<li>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
										<path d="M2.75 8.33383C2.43934 8.3347 2.13528 8.42351 1.87299 8.58997C1.6107 8.75644 1.4009 8.99377 1.26787 9.2745C1.13483 9.55523 1.084 9.86789 1.12124 10.1763C1.15849 10.4847 1.28229 10.7763 1.47833 11.0173L5.65745 16.1367C5.80645 16.3217 5.99746 16.4685 6.21459 16.5649C6.43172 16.6613 6.66872 16.7045 6.90589 16.6908C7.41314 16.6636 7.8711 16.3923 8.16308 15.9461L16.8442 1.96522C16.8456 1.9629 16.8471 1.96058 16.8486 1.9583C16.9301 1.83323 16.9036 1.58538 16.7355 1.42968C16.6893 1.38693 16.6349 1.35408 16.5755 1.33316C16.5162 1.31224 16.4531 1.3037 16.3904 1.30805C16.3276 1.31241 16.2663 1.32957 16.2104 1.35848C16.1545 1.3874 16.1051 1.42745 16.0653 1.47617C16.0622 1.48 16.059 1.48378 16.0557 1.48749L7.30068 11.3793C7.26736 11.417 7.2269 11.4476 7.18164 11.4695C7.13638 11.4914 7.08723 11.504 7.03704 11.5067C6.98685 11.5095 6.93661 11.5022 6.88926 11.4853C6.84191 11.4684 6.79837 11.4423 6.7612 11.4085L3.85558 8.76437C3.55381 8.48774 3.15938 8.33414 2.75 8.33383Z" fill="#C2A74E" />
									</svg><?php echo esc_html($item['list_content']); ?>
								</li>
							<?php } ?>
						</ul>
					<?php
					}
					echo '<div class="bt-pricing--box-button">';
					if (!empty($settings['button_url']['url'])) {
						$this->add_link_attributes('button_url', $settings['button_url']);
					}

					if (!empty($settings['button_text'])) {
						echo '<a class="bt-pricing--button bt-button-effect" ' . $this->get_render_attribute_string('button_url') . '>' . esc_html($settings['button_text']) . '</a>';
					}
					if (!empty($settings['button_more_url']['url'])) {
						$this->add_link_attributes('button_more_url', $settings['button_more_url']);
					}

					if (!empty($settings['button_more'])) {
						echo '<div class="bt-pricing--button-more">or <a ' . $this->get_render_attribute_string('button_more_url') . ' >' . esc_html($settings['button_more']) . '</a></div>';
					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
<?php
	}

	protected function content_template()
	{
	}
}
