<?php

namespace AwakenurElementorWidgets\Widgets\GiveForm;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_GiveForm extends Widget_Base
{

	public function get_name()
	{
		return 'bt-give-form';
	}

	public function get_title()
	{
		return __('Give Form', 'awakenur');
	}

	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	public function get_categories()
	{
		return ['awakenur'];
	}

	protected function get_supported_post_ids()
	{
		$options = [];
		$options['0'] = __('-- Select Donation Form --', 'awakenur');

		$args = array(
			'post_type' => 'give_forms',
			'post_status'    => 'publish',
		);

		$query = new \WP_Query($args);
		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post();
				$options[get_the_ID()] = get_the_title();
			endwhile;
			wp_reset_postdata();
		endif;

		return $options;
	}

	protected function register_layout_section_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'awakenur'),
			]
		);

		$this->add_control(
			'form_id',
			[
				'label' => __('Form Id', 'awakenur'),
				'type' => Controls_Manager::SELECT,
				'options' => $this->get_supported_post_ids(),
				'default' => '0'
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$form_id = $settings['form_id'];

		if($form_id == '0') {
			return;
		}

		$meta_data = get_post_meta($form_id);
		if (isset($meta_data['formBuilderSettings']) && !empty($meta_data['formBuilderSettings'][0])) {
			echo do_shortcode('[give_form id="' . $form_id . '"]');
		} else {
		?>
			<div class="bt-elwg-give-form">
				<div class="bt-give-form">
					<div class="bt-give-form--thumbnail">
						<div class="bt-cover-image">
							<?php echo get_the_post_thumbnail($form_id, 'medium-large'); ?>
						</div>
					</div>
					<div class="bt-give-form--content">
						<h3 class="bt-give-form--title">
							<a href="<?php echo get_the_permalink($form_id); ?>">
								<?php echo get_the_title($form_id); ?>
							</a>
						</h3>
						<?php if (get_the_excerpt($form_id)) { ?>
							<div class="bt-give-form--excerpt">
								<?php echo get_the_excerpt($form_id); ?>
							</div>
						<?php } ?>
						<div class="bt-give-form--progress animation">
							<?php
							$args = array(
								'show_text' => true,
								'show_bar' => true,
								'income_text' => __('of', 'awakenur'),
								'goal_text' => __('raised', 'awakenur')

							);

							awakenur_give_goal_progress($form_id, $args);
							?>
						</div>
						<div class="bt-give-form--button">
							<?php
							$atts = array(
								'id' => $form_id,  // integer.
								'show_title' => false, // boolean.
								'show_goal' => false, // boolean.
								'show_content' => 'none', //above, below, or none
								'display_style' => 'button', //modal, button, and reveal
								'continue_button_title' => '' //string
							);
							echo give_get_donation_form($atts);
							?>
						</div>
					</div>
				</div>
			</div>
<?php
		}
	}

	protected function content_template() {}
}
