<?php

namespace AwakenurElementorWidgets\Widgets\GiveButton;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_GiveButton extends Widget_Base
{

	public function get_name()
	{
		return 'bt-give-button';
	}

	public function get_title()
	{
		return __('Give Button', 'awakenur');
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

		?>
		<div class="bt-elwg-give-button">
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
		<?php
	}

	protected function content_template() {}
}
