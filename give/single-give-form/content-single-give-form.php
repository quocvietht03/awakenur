<?php
/**
 * The template for displaying form content in the single-give-form.php template
 *
 * Override this template by copying it to yourtheme/give/single-give-form/content-single-give-form.php
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Fires in single form template, before the form.
 *
 * Allows you to add elements before the form.
 *
 * @since 1.0
 */
do_action( 'give_before_single_form' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$form_id = get_the_ID();
?>

	<div id="give-form-<?php the_ID(); ?>-content" <?php post_class(); ?>>

		<?php
		/**
		 * Fires in single form template, before the form summary.
		 *
		 * Allows you to add elements before the form summary.
		 *
		 * @since 1.0
		 */
		do_action( 'give_before_single_form_summary' );
		?>

		<div class="<?php echo apply_filters( 'give_forms_single_summary_classes', 'summary entry-summary' ); ?>">
			<?php if ( give_is_setting_enabled( get_post_meta( $form_id, '_give_goal_option', true ) ) ) { ?>
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
            <?php } ?>

			<?php
			/**
			 * Fires in single form template, to the form summary.
			 *
			 * Allows you to add elements to the form summary.
			 *
			 * @since 1.0
			 */
			// do_action( 'give_single_form_summary' );
			$atts = array(
				'id' => $form_id,  // integer.
				'show_title' => false, // boolean.
				'show_goal' => false, // boolean.
			);

			give_get_donation_form($atts);
			?>

		</div>
		<!-- .summary -->

		<?php
		/**
		 * Fires in single form template, after the form summary.
		 *
		 * Allows you to add elements after the form summary.
		 *
		 * @since 1.0
		 */
		do_action( 'give_after_single_form_summary' );
		?>

	</div><!-- #give-form-<?php the_ID(); ?> -->

<?php
/**
 * Fires in single form template, after the form.
 *
 * Allows you to add elements after the form.
 *
 * @since 1.0
 */
do_action( 'give_after_single_form' );
?>
