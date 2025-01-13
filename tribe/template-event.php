<?php
/*
Template Name: Events
*/
?>
<?php get_header();
get_template_part('framework/templates/site', 'titlebar');
$archive_page = get_field('event_archive_page', 'options');
$limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 6;
$query_args = awakenur_event_query_args($_GET, $limit);
$events = tribe_get_events($query_args);

$total_query_args = awakenur_event_query_args($_GET, '-1');
$all_events = tribe_get_events($total_query_args);
$total_events = count($all_events);
$total_pages = ceil($total_events / $limit);
$next_page = 2;
?>
<main id="bt_main" class="bt-site-main template-events">
    <div class="bt-main-content-ss">
        <div class="bt-container">
            <?php get_template_part('framework/templates/event', 'filter');
            ?>
            <div class="bt-filter-results">
                <span class="bt-loading-wave"></span>
                <?php if (!empty($events)) { ?>
                    <div class="bt-event-layout" data-view="<?php echo isset($_GET['view_type']) && $_GET['view_type'] != '' ? $_GET['view_type'] : 'list' ?>">
                        <?php
                        foreach ($events as $event) {
                            get_template_part('framework/templates/event', 'style', array('event' => $event, 'image-size' => 'large'));
                        }
                        ?>

                    </div>

                    <?php if ($total_pages > 1) {
                    ?>
                        <div class="bt-loadmore-wrap bt-button-hover-style2">
                            <?php echo awakenur_button_loadmore($next_page, $total_pages); ?>
                        </div>
                    <?php } ?>
                <?php
                } else {
                    echo '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'awakenur') . '</h3>';
                }
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</main><!-- #main -->
<?php get_footer(); ?>