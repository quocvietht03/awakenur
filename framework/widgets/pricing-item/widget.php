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
	public function get_script_depends()
	{
		return ['elementor-widgets'];
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
			'switch_pricing',
			[
				'label'    => __('Switch', 'awakenur'),
				'type'     => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'awakenur'),
				'label_off' => __('Off', 'awakenur'),
				'default'  => 'yes',
			]
		);
		$this->add_control(
			'discount',
			[
				'label' => esc_html__('Discount', 'awakenur'),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'default' => 10,
				'min' => 1,
				'max' => 100,
				'description' => esc_html__('Enter the discount percentage. The default value is 10%.', 'awakenur'),
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'best_value',
			[
				'label'    => __('Best Value', 'awakenur'),
				'type'     => Controls_Manager::SWITCHER,
				'label_on' => __('On', 'awakenur'),
				'label_off' => __('Off', 'awakenur'),
				'default'  => '',
			]
		);
		$repeater->add_control(
			'heading',
			[
				'label' => esc_html__('Heading', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('This is the heading', 'awakenur'),
			]
		);
		$repeater->add_control(
			'currency',
			[
				'label' => esc_html__('Currency', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('$', 'awakenur'),
			]
		);
		$repeater->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'awakenur'),
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
				'default' => 100,
			]
		);

		$repeater->add_control(
			'price_after',
			[
				'label' => esc_html__('Price After', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__(' /per month', 'awakenur'),
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => __('Description', 'awakenur'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('This is the description', 'awakenur'),
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'awakenur'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Choose Your Plan', 'awakenur'),
			]
		);

		$repeater->add_control(
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
			'list_pricing',
			[
				'label' => __('List Info', 'awakenur'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'heading' => esc_html__('Basic Membership', 'awakenur'),
					],
					[
						'heading' => esc_html__('Standard Membership', 'awakenur'),
					],
					[
						'heading' => esc_html__('Premium Membership', 'awakenur'),
					],
				],
				'title_field' => '{{{ heading }}}',
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
					'{{WRAPPER}} .bt-pricing li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .bt-pricing li',
			]
		);

		$this->end_controls_section();
	}

	protected function register_style_content_section_controls()
	{
		$this->start_controls_section(
			'section_style_switch',
			[
				'label' => esc_html__('Switch', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'switch_color',
			[
				'label' => __('Switch Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-switch .bt-switch::before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'heading_switch_pricing',
			[
				'label' => __('Heading', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'heading_switch_color',
			[
				'label' => __('Heading Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-select-pricing' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_switch_typography',
				'label' => __('Heading Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-select-pricing',
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
					'{{WRAPPER}} .bt-pricing li' => 'background: {{VALUE}};',
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
					'{{WRAPPER}} .bt-pricing--title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Heading Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--title h2',
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
			'description_pricing',
			[
				'label' => __('Description', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' => __('Description Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing--description' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __('Description Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-pricing--description',
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
					'{{WRAPPER}} .bt-pricing--button:before' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .bt-pricing--button:after' => 'border-top-color: {{VALUE}};',
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
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_content_best_value',
			[
				'label' => esc_html__('Content Best Value', 'awakenur'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'background_content_best_value',
			[
				'label' => __('Background Content', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-pricing li.bt-box-best-value' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_best_value',
			[
				'label' => __('Best Value', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'button_best_value_color',
			[
				'label' => __('Best Value Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-best-value' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_best_value_background',
			[
				'label' => __('Best Value Background', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-best-value' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_best_value_typography',
				'label' => __('Best Value Typography', 'awakenur'),
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-best-value',
			]
		);
		$this->add_control(
			'heading_pricing_best_value',
			[
				'label' => __('Heading', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'heading_color_best_value',
			[
				'label' => __('Heading Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_pricing_best_value',
			[
				'label' => __('Price', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_color_best_value',
			[
				'label' => __('Price Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_after_pricing_best_value',
			[
				'label' => __('Price After', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_after_color_best_value',
			[
				'label' => __('Price After Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--price-after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'description_pricing_best_value',
			[
				'label' => __('Description', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'description_color_best_value',
			[
				'label' => __('Description Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--description' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_pricing_best_value',
			[
				'label' => __('Button', 'awakenur'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'button_text_color_best_value',
			[
				'label' => __('Text Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color_best_value',
			[
				'label' => __('Background Color', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_text_color_hover_best_value',
			[
				'label' => __('Text Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover_best_value',
			[
				'label' => __('Background Color Hover', 'awakenur'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--button:before' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .bt-box-best-value .bt-pricing--button:after' => 'border-top-color: {{VALUE}};',
				],
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
		$discount = (isset($settings['discount'])) ? $settings['discount'] : 10;
?>
		<div class="bt-elwg-pricing-item--default">
			<?php if(isset($settings['switch_pricing']) && $settings['switch_pricing'] == 'yes'){ ?>
			<div class="bt-select-pricing">
				<div class="bt-monthly"><?php esc_html_e('Monthly', 'awakenur') ?></div>
				<div class="bt-box-switch">
					<input type="checkbox">
					<label class="bt-switch"></label>
				</div>
				<div class="bt-monthly"><?php esc_html_e('Years', 'awakenur') ?>
					<?php if($discount > 0){ ?>
					<span><?php printf(__('(Save %d%%)', 'awakenur'), $discount); ?></span>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<?php if (!empty($settings['list_pricing'])) { ?>
				<ul class="bt-pricing" data-discount="<?php echo esc_attr($discount) ?>">
					<?php foreach ($settings['list_pricing'] as $item) {
						$best_value   = (isset($item['best_value']) && $item['best_value'] == 'yes') ? 'bt-box-best-value' : '';
					?>
						<li class="<?php echo esc_attr($best_value) ?>" data-price="<?php echo esc_attr($item['price']) ?>">
							<div class="bt-pricing--title">
								<h2><?php echo esc_html($item['heading']); ?></h2>
								<?php if (isset($item['best_value']) && $item['best_value'] == 'yes') { ?>
									<div class="bt-best-value">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
											<g clip-path="url(#clip0_16971_1726)">
												<path d="M10.1154 5.83458C10.1012 5.77448 10.0724 5.71881 10.0315 5.67253C9.99062 5.62624 9.93893 5.59077 9.88104 5.56927L7.18057 4.5563L7.86776 1.11896C7.88332 1.03909 7.87248 0.956332 7.83688 0.883167C7.80128 0.810001 7.74285 0.7504 7.6704 0.713357C7.59796 0.676314 7.51543 0.663839 7.43527 0.677814C7.35511 0.69179 7.28168 0.731458 7.22604 0.790831L1.97604 6.41583C1.9334 6.46076 1.90255 6.51555 1.88626 6.57531C1.86996 6.63507 1.86872 6.69794 1.88265 6.7583C1.89658 6.81865 1.92524 6.87462 1.96608 6.92119C2.00691 6.96777 2.05865 7.00351 2.11667 7.02521L4.81807 8.03817L4.13276 11.4718C4.1172 11.5516 4.12804 11.6344 4.16364 11.7076C4.19924 11.7807 4.25767 11.8403 4.33012 11.8774C4.40256 11.9144 4.48509 11.9269 4.56525 11.9129C4.64541 11.8989 4.71884 11.8593 4.77448 11.7999L10.0245 6.17489C10.0663 6.12995 10.0965 6.07542 10.1124 6.01608C10.1282 5.95674 10.1293 5.89442 10.1154 5.83458ZM5.12698 10.3266L5.61776 7.8713C5.63532 7.78422 5.62141 7.69373 5.57848 7.61596C5.53556 7.53818 5.46642 7.47817 5.38338 7.44661L2.90651 6.51614L6.87307 2.26646L6.38276 4.72177C6.36519 4.80885 6.37911 4.89933 6.42203 4.97711C6.46496 5.05489 6.5341 5.1149 6.61713 5.14646L9.09213 6.07458L5.12698 10.3266Z" fill="currentColor" />
											</g>
											<defs>
												<clipPath id="clip0_16971_1726">
													<rect width="12" height="12" fill="white" transform="translate(0 0.29541)" />
												</clipPath>
											</defs>
										</svg><?php esc_html_e('Best Value', 'awakenur'); ?>
									</div>
								<?php } ?>
							</div>
							<div class="bt-pricing--price">
								<?php
								if (!empty($item['price']) && !empty($item['currency'])) {
									echo '<span class="bt-currency">' . esc_html($item['currency']) . '</span><span class="bt-price">' . esc_html($item['price']) . '</span>';
								}
								if (!empty($item['price_after'])) {
									echo '<span class="bt-pricing--price-after">' . esc_html($item['price_after']) . '</span>';
								}
								?>
							</div>
							<div class="bt-pricing--description">
								<?php echo esc_html($item['description']); ?>
							</div>
							<?php
							echo '<div class="bt-pricing--box-button bt-button-hover">';
							if (!empty($item['button_url']['url'])) {
								$this->add_link_attributes('button_url', $item['button_url']);
							}

							if (!empty($item['button_text'])) {
								echo '<a class="bt-pricing--button bt-button-effect" ' . $this->get_render_attribute_string('button_url') . '>' . esc_html($item['button_text']) . '</a>';
							}
							echo '</div>';
							?>
						</li>
					<?php } ?>
				</ul>
			<?php
			}
			?>
		</div>
<?php
	}

	protected function content_template() {}
}
