<?php
$args = [
    'posts_per_page' => -1,
    'eventDisplay'   => 'upcoming',
];
$events = tribe_get_events($args);
$last_event = end($events);
$last_event_date =  tribe_get_start_date($last_event->ID, true, 'd M Y');
?>
<div class="bt-filter-bar">
    <form class="bt-filter-form bt-event-filter-js" action="" method="get">
        <!--View type-->
        <input type="hidden" class="bt-event-view-type" name="view_type" value="<?php if (isset($_GET['view_type'])) echo esc_attr($_GET['view_type']); ?>">
        <div class="bt-filter-form--left">
            <input id="bt-date-filter" name="date_filter" class="bt-date-filter" type="text" value="<?php echo isset($_GET['date_filter']) ? esc_attr($_GET['date_filter']) : esc_html__('today', 'awakenur'); ?>" readonly />
            <div class="bt-date-wrap" data-datelast="<?php echo esc_attr($last_event_date); ?>">
                <div id="bt-date-result"><?php if (isset($_GET['date_filter'])) {
                                                echo esc_attr($_GET['date_filter']) . ', ';
                                            } else {
                                                esc_html_e('Today, ', 'awakenur');
                                            } ?></div><span><?php echo esc_attr($last_event_date); ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                    <path d="M26.7081 13.003L16.7081 23.003C16.6152 23.096 16.5049 23.1697 16.3835 23.22C16.2621 23.2704 16.132 23.2963 16.0006 23.2963C15.8691 23.2963 15.739 23.2704 15.6176 23.22C15.4962 23.1697 15.3859 23.096 15.2931 23.003L5.29306 13.003C5.10542 12.8153 5 12.5608 5 12.2955C5 12.0301 5.10542 11.7756 5.29306 11.588C5.4807 11.4003 5.73519 11.2949 6.00056 11.2949C6.26592 11.2949 6.52042 11.4003 6.70806 11.588L16.0006 20.8817L25.2931 11.588C25.386 11.4951 25.4963 11.4214 25.6177 11.3711C25.7391 11.3208 25.8692 11.2949 26.0006 11.2949C26.132 11.2949 26.2621 11.3208 26.3835 11.3711C26.5048 11.4214 26.6151 11.4951 26.7081 11.588C26.801 11.6809 26.8747 11.7912 26.9249 11.9126C26.9752 12.034 27.0011 12.1641 27.0011 12.2955C27.0011 12.4269 26.9752 12.557 26.9249 12.6784C26.8747 12.7998 26.801 12.9101 26.7081 13.003Z" fill="#4F320E" />
                </svg>
            </div>
        </div>
        <div class="bt-filter-form--center">
            <?php
            $type_active = 'list';
            if (isset($_GET['view_type']) && 'grid' == $_GET['view_type']) {
                $type_active = 'grid';
            }
            ?>
            <a href="#" class="bt-view-type bt-view-list <?php if ('list' == $type_active) echo 'active'; ?>" data-view="list">
                <div class="bt-icon">
                    <span class="bt-dot"></span>
                    <span class="bt-dot long"></span>
                    <span class="bt-dot"></span>
                    <span class="bt-dot long"></span>
                </div>
            </a>
            <a href="#" class="bt-view-type bt-view-grid <?php if ('grid' == $type_active) echo 'active'; ?>" data-view="grid">
                <div class="bt-icon">
                    <span class="bt-dot"></span>
                    <span class="bt-dot"></span>
                    <span class="bt-dot"></span>
                    <span class="bt-dot"></span>
                </div>
            </a>

        </div>
        <div class="bt-filter-form--right">
            <div class="bt-form-field bt-field-type-search">
                <input type="text" name="search_keyword" value="<?php if (isset($_GET['search_keyword'])) echo esc_attr($_GET['search_keyword']); ?>" placeholder="<?php esc_attr_e('Search …', 'awakenur'); ?>">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.3973 20.8979L16.5804 16.081C17.954 14.5014 18.6606 12.4501 18.5513 10.3596C18.442 8.26915 17.5253 6.30277 15.9944 4.875C14.4635 3.44723 12.4381 2.66961 10.3451 2.70606C8.25208 2.74251 6.25497 3.59019 4.77475 5.07041C3.29454 6.55062 2.44686 8.54773 2.41041 10.6408C2.37395 12.7338 3.15157 14.7592 4.57934 16.2901C6.00712 17.8209 7.9735 18.7376 10.064 18.8469C12.1545 18.9563 14.2057 18.2496 15.7854 16.876L20.6023 21.6929C20.7089 21.7923 20.8499 21.8464 20.9957 21.8438C21.1414 21.8412 21.2804 21.7822 21.3835 21.6791C21.4865 21.5761 21.5456 21.437 21.5481 21.2913C21.5507 21.1456 21.4966 21.0045 21.3973 20.8979ZM3.56226 10.7954C3.56226 9.42331 3.96914 8.08201 4.73144 6.94115C5.49374 5.80028 6.57723 4.91108 7.84489 4.386C9.11256 3.86092 10.5075 3.72353 11.8532 3.99122C13.1989 4.2589 14.4351 4.91963 15.4053 5.88986C16.3755 6.86009 17.0363 8.09623 17.304 9.44198C17.5716 10.7877 17.4343 12.1826 16.9092 13.4503C16.3841 14.7179 15.4949 15.8014 14.354 16.5637C13.2132 17.326 11.8719 17.7329 10.4998 17.7329C8.66051 17.7307 6.89722 16.9991 5.59667 15.6985C4.29612 14.398 3.56449 12.6347 3.56226 10.7954Z" fill="#4F320E" />
                </svg>
            </div>
        </div>
    </form>
</div>