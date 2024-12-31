<?php
$form_id          = get_the_ID(); // Form ID.
$raw_content      = ''; // Raw form content.
$stripped_content = ''; // Form content stripped of HTML tags and shortcodes.
$excerpt          = ''; // Trimmed form excerpt ready for display.
$excerpt_length   = -1;

echo get_post_meta('start_date');

?>

<article <?php post_class('bt-post'); ?>>
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

</article>
