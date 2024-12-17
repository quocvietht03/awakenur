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
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls()
	{
		$this->register_layout_section_controls();
	}

	public function give_goal_progress($form_id, $args)
	{
		$form        = new \Give_Donate_Form($form_id);
		$goal_option = give_get_meta($form->ID, '_give_goal_option', true);

		// Sanity check - ensure form has pass all condition to show goal.
		if ((isset($args['show_goal']) && ! filter_var($args['show_goal'], FILTER_VALIDATE_BOOLEAN))
			|| empty($form->ID)
			|| (is_singular('give_forms') && ! give_is_setting_enabled($goal_option))
			|| ! give_is_setting_enabled($goal_option) || 0 === $form->goal
		) {
			return false;
		}

		$goal_format         = give_get_form_goal_format($form_id);
		$price               = give_get_meta($form_id, '_give_set_price', true);
		$color               = give_get_meta($form_id, '_give_goal_color', true);
		$show_text           = isset($args['show_text']) ? filter_var($args['show_text'], FILTER_VALIDATE_BOOLEAN) : true;
		$show_bar            = isset($args['show_bar']) ? filter_var($args['show_bar'], FILTER_VALIDATE_BOOLEAN) : true;
		$goal_progress_stats = give_goal_progress_stats($form);

		$income = $goal_progress_stats['raw_actual'];
		$goal   = $goal_progress_stats['raw_goal'];

		switch ($goal_format) {

			case 'donation':
				$progress           = $goal ? round(($income / $goal) * 100, 2) : 0;
				$progress_bar_value = $income >= $goal ? 100 : $progress;
				break;

			case 'donors':
				$progress_bar_value = $goal ? round(($income / $goal) * 100, 2) : 0;
				$progress           = $progress_bar_value;
				break;

			case 'percentage':
				$progress           = $goal ? round(($income / $goal) * 100, 2) : 0;
				$progress_bar_value = $income >= $goal ? 100 : $progress;
				break;

			default:
				$progress           = $goal ? round(($income / $goal) * 100, 2) : 0;
				$progress_bar_value = $income >= $goal ? 100 : $progress;
				break;
		}

		/**
		 * Filter the goal progress output
		 *
		 * @since 1.8.8
		 */
		$progress = apply_filters('give_goal_amount_funded_percentage_output', $progress, $form_id, $form);

?>
		<div class="give-goal-progress">
			<?php if (! empty($show_text)) : ?>
				<div class="raised">
					<?php
					if ('amount' === $goal_format) :

						/**
						 * Filter the give currency.
						 *
						 * @since 1.8.17
						 */
						$form_currency = apply_filters('give_goal_form_currency', give_get_currency($form_id), $form_id);

						/**
						 * Filter the income formatting arguments.
						 *
						 * @since 1.8.17
						 */
						$income_format_args = apply_filters(
							'give_goal_income_format_args',
							array(
								'sanitize' => false,
								'currency' => $form_currency,
								'decimal'  => false,
							),
							$form_id
						);

						/**
						 * Filter the goal formatting arguments.
						 *
						 * @since 1.8.17
						 */
						$goal_format_args = apply_filters(
							'give_goal_amount_format_args',
							array(
								'sanitize' => false,
								'currency' => $form_currency,
								'decimal'  => false,
							),
							$form_id
						);

						/**
						 * This filter will be used to convert the goal amounts to different currencies.
						 *
						 * @since 2.5.4
						 *
						 * @param array $amounts List of goal amounts.
						 * @param int   $form_id Donation Form ID.
						 */
						$goal_amounts = apply_filters(
							'give_goal_amounts',
							array(
								$form_currency => $goal,
							),
							$form_id
						);

						/**
						 * This filter will be used to convert the income amounts to different currencies.
						 *
						 * @since 2.5.4
						 *
						 * @param array $amounts List of goal amounts.
						 * @param int   $form_id Donation Form ID.
						 */
						$income_amounts = apply_filters(
							'give_goal_raised_amounts',
							array(
								$form_currency => $income,
							),
							$form_id
						);

						// Get human readable donation amount.
						$income = give_human_format_large_amount(give_format_amount($income, $income_format_args), array('currency' => $form_currency));
						$goal   = give_human_format_large_amount(give_format_amount($goal, $goal_format_args), array('currency' => $form_currency));

						// Format the human readable donation amount.
						$formatted_income = give_currency_filter(
							$income,
							array(
								'form_id' => $form_id,
							)
						);

						$formatted_goal = give_currency_filter(
							$goal,
							array(
								'form_id' => $form_id,
							)
						);

						echo sprintf(
							/* translators: 1: amount of income raised 2: goal target amount. */
							__('<span class="raised-income"><span class="income" data-amounts="%1$s">%2$s</span> %5$s</span> <span class="raised-goal"><span class="goal-text" data-amounts="%3$s">%4$s</span> %6$s</span>', 'awakenur'),
							esc_attr(wp_json_encode($income_amounts, JSON_PRETTY_PRINT)),
							esc_attr($formatted_income),
							esc_attr(wp_json_encode($goal_amounts, JSON_PRETTY_PRINT)),
							esc_attr($formatted_goal),
							esc_html($args['income_text']),
							esc_html($args['goal_text'])
						);

					elseif ('percentage' === $goal_format) :

						echo sprintf( /* translators: %s: percentage of the amount raised compared to the goal target */
							__('<span class="give-percentage">%s%%</span> funded', 'awakenur'),
							round($progress)
						);

					elseif ('donation' === $goal_format) :

						echo sprintf( /* translators: 1: total number of donations completed 2: total number of donations set as goal */
							_n(
								'<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donation',
								'<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donations',
								$goal,
								'awakenur'
							),
							give_format_amount($income, array('decimal' => false)),
							give_format_amount($goal, array('decimal' => false))
						);

					elseif ('donors' === $goal_format) :

						echo sprintf( /* translators: 1: total number of donors completed 2: total number of donors set as goal */
							_n(
								'<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donor',
								'<span class="income">%1$s</span> of <span class="goal-text">%2$s</span> donors',
								$goal,
								'awakenur'
							),
							give_format_amount($income, array('decimal' => false)),
							give_format_amount($goal, array('decimal' => false))
						);

					endif;
					?>
				</div>
			<?php endif; ?>

			<?php if (! empty($show_bar)) : ?>
				<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo esc_attr($progress_bar_value); ?>">
					<span style="width: <?php echo esc_attr($progress_bar_value); ?>%; <?php if (! empty($color)) {
																							echo 'background-color:' . $color;
																						} ?>"><?php echo esc_html($progress_bar_value) . '%' ?></span>
				</div><!-- /.give-progress-bar -->
			<?php endif; ?>

		</div><!-- /.goal-progress -->

		<?php
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$form_id = $settings['form_id'];
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

							$this->give_goal_progress($form_id, $args);
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
