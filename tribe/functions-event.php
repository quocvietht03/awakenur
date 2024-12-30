<?php
function awakenur_event_query_args($params = array(), $limit = 6)
{
    $query_args = array(
        'eventDisplay'   => 'upcoming',
        'posts_per_page' => $limit
    );

    if (isset($params['search_keyword']) && $params['search_keyword'] != '') {
        $query_args['s'] = $params['search_keyword'];
    }

    if (isset($params['date_filter']) && $params['date_filter'] != '') {
        $date_filter = $params['date_filter'];
        $date = DateTime::createFromFormat('j M Y', $date_filter);
        $formatted_date = $date->format('Y-m-d H:i:s');
        $query_args['start_date'] = $formatted_date;
    }

    if (isset($params['next_page']) && $params['next_page'] != '') {
        $query_args['paged'] = $params['next_page'];
    }

    $query_tax = array();

    if (!empty($query_tax)) {
        $query_args['tax_query'] = $query_tax;
    }

    $query_meta = array();

    if (!empty($query_meta)) {
        $query_args['meta_query'] = $query_meta;
    }

    return $query_args;
}

function awakenur_event_filter()
{
    $archive_page = get_field('event_archive_page', 'options');
    $limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 2;

    $query_args = awakenur_event_query_args($_POST, $limit);
    $events = tribe_get_events($query_args);

    $total_query_args = awakenur_event_query_args($_POST, '-1');
    $all_events = tribe_get_events($total_query_args);
    $total_events = count($all_events);
    $total_pages = ceil($total_events / $limit);
    $next_page = 2;

    // Update Loop Post
    if (!empty($events)) {
        ob_start();
        foreach ($events as $event) {
            get_template_part('framework/templates/event', 'style', array('event' => $event, 'image-size' => 'medium_large'));
        }
        $output['items'] = ob_get_clean();
        if ($next_page <= $total_pages) {
            $output['loadmore'] = awakenur_button_loadmore($next_page, $total_pages);
        } else {
            $output['loadmore'] = '';
        }
    } else {
        $output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
        $output['loadmore'] = '';
    }

    wp_reset_postdata();

    wp_send_json_success($output);

    die();
}
add_action('wp_ajax_awakenur_event_filter', 'awakenur_event_filter');
add_action('wp_ajax_nopriv_awakenur_event_filter', 'awakenur_event_filter');

function awakenur_event_loadmore()
{
    $archive_page = get_field('event_archive_page', 'options');
    $limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 2;

    $query_args = awakenur_event_query_args($_POST, $limit);
    $events = tribe_get_events($query_args);
    $next_page = isset($_POST['next_page']) ? intval($_POST['next_page']) : 1;
    $total_pages = isset($_POST['total_pages']) ? intval($_POST['total_pages']) : 1;
    $next_page = $next_page + 1;


    // Update Loop Post
    if (!empty($events)) {
        ob_start();
        echo $date_filter;
        foreach ($events as $event) {
            get_template_part('framework/templates/event', 'style', array('event' => $event, 'image-size' => 'medium_large'));
        }
        $output['items'] = ob_get_clean();
        if ($next_page <= $total_pages) {
            $output['loadmore'] = awakenur_button_loadmore($next_page, $total_pages);
        } else {
            $output['loadmore'] = '';
        }
    } else {
        $output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
        $output['loadmore'] = '';
    }

    wp_reset_postdata();

    wp_send_json_success($output);

    die();
}
add_action('wp_ajax_awakenur_event_loadmore', 'awakenur_event_loadmore');
add_action('wp_ajax_nopriv_awakenur_event_loadmore', 'awakenur_event_loadmore');

function awakenur_button_loadmore($next_page, $total_pages)
{
    ob_start();
?>
    <a class="bt-loadmore-event" href="#" data-page="<?php echo esc_attr($next_page) ?>" data-total-page="<?php echo esc_attr($total_pages) ?>"><span><?php esc_html_e('Load More', 'awakenur') ?></span>
        <svg aria-hidden="true" class="e-font-icon-svg e-fas-spinner eicon-animation-spin" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path>
        </svg>
    </a>
    </div>
<?php
    return ob_get_clean();
}
