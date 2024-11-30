<div class="bt-filter-bar">
    <form class="bt-filter-form bt-sermon-filter-js" action="" method="get">
        <!--View current page-->
        <input type="hidden" class="bt-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? esc_attr($_GET['current_page']) : ''; ?>">

        <div  class="bt-filter-form--left">
            <div class="bt-form-field bt-field-type-search">
                <input type="text" name="search_keyword" value="<?php if (isset($_GET['search_keyword'])) echo esc_attr($_GET['search_keyword']); ?>" placeholder="<?php esc_attr_e('Search …', 'awakenur'); ?>">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.3973 20.8979L16.5804 16.081C17.954 14.5014 18.6606 12.4501 18.5513 10.3596C18.442 8.26915 17.5253 6.30277 15.9944 4.875C14.4635 3.44723 12.4381 2.66961 10.3451 2.70606C8.25208 2.74251 6.25497 3.59019 4.77475 5.07041C3.29454 6.55062 2.44686 8.54773 2.41041 10.6408C2.37395 12.7338 3.15157 14.7592 4.57934 16.2901C6.00712 17.8209 7.9735 18.7376 10.064 18.8469C12.1545 18.9563 14.2057 18.2496 15.7854 16.876L20.6023 21.6929C20.7089 21.7923 20.8499 21.8464 20.9957 21.8438C21.1414 21.8412 21.2804 21.7822 21.3835 21.6791C21.4865 21.5761 21.5456 21.437 21.5481 21.2913C21.5507 21.1456 21.4966 21.0045 21.3973 20.8979ZM3.56226 10.7954C3.56226 9.42331 3.96914 8.08201 4.73144 6.94115C5.49374 5.80028 6.57723 4.91108 7.84489 4.386C9.11256 3.86092 10.5075 3.72353 11.8532 3.99122C13.1989 4.2589 14.4351 4.91963 15.4053 5.88986C16.3755 6.86009 17.0363 8.09623 17.304 9.44198C17.5716 10.7877 17.4343 12.1826 16.9092 13.4503C16.3841 14.7179 15.4949 15.8014 14.354 16.5637C13.2132 17.326 11.8719 17.7329 10.4998 17.7329C8.66051 17.7307 6.89722 16.9991 5.59667 15.6985C4.29612 14.398 3.56449 12.6347 3.56226 10.7954Z" fill="#4F320E"/>
                </svg>
            </div>
        </div>

        <div  class="bt-filter-form--right">
            <?php 
                $field_title = __('Sermon Topics', 'awakenur');
                $field_value = (isset($_GET['sm_topic'])) ? $_GET['sm_topic'] : '';
                $slug = 'sermon_categories';

                $terms = get_terms(array(
                    'taxonomy' => $slug,
                    'hide_empty' => true
                ));
            
                if (!empty($terms)) {
                    ?>
                        <div class="bt-form-field bt-field-type-select <?php echo esc_attr('bt-field-' . $slug); ?>">
                            <select name="sm_topic">
                                <option value="">
                                    <?php echo esc_html($field_title); ?>
                                </option>
                                <?php foreach ($terms as $term) { ?>
                                    <?php if ($term->slug == $field_value) { ?>
                                        <option value="<?php echo esc_attr($term->slug); ?>" selected="selected">
                                            <?php echo esc_html($term->name); ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?php echo esc_attr($term->slug); ?>">
                                            <?php echo esc_html($term->name); ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.9445 16.5454H3.07656C2.92378 16.545 2.77736 16.4841 2.66933 16.3761C2.56129 16.268 2.50041 16.1216 2.5 15.9688V6.54541H16.875C17.0408 6.54541 17.1997 6.61126 17.3169 6.72847C17.4342 6.84568 17.5 7.00465 17.5 7.17041V15.9899C17.5 16.1373 17.4415 16.2785 17.3373 16.3827C17.2331 16.4869 17.0919 16.5454 16.9445 16.5454Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M2.5 6.54541V4.67041C2.5 4.50465 2.56585 4.34568 2.68306 4.22847C2.80027 4.11126 2.95924 4.04541 3.125 4.04541H7.24141C7.40695 4.04549 7.56569 4.11123 7.68281 4.22822L10 6.54541" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    <?php
                }

                $field_title = __('All Pastor', 'awakenur');
                $field_value = (isset($_GET['sm_pastor'])) ? $_GET['sm_pastor'] : '';
                $slug = 'pastor';

                $list_pastor = get_posts( array(
                    'post_type' => $slug,
                    'post_status' => 'publish',
                ));
                
                if (!empty($list_pastor)) {
                    ?>
                        <div class="bt-form-field bt-field-type-select <?php echo esc_attr('bt-field-' . $slug); ?>">
                            <select name="sm_pastor">
                                <option value="">
                                    <?php echo esc_html($field_title); ?>
                                </option>

                                <?php foreach ( $list_pastor as $post ) { ?>
                                    <?php if ($post->ID == $field_value) { ?>
                                        <option value="<?php echo esc_attr($post->ID); ?>" selected="selected">
                                            <?php echo $post->post_title; ?>
                                        </option>
                                    <?php } else { ?>
                                        <option value="<?php echo esc_attr($post->ID); ?>">
                                            <?php echo $post->post_title;; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12.7954C12.7614 12.7954 15 10.5568 15 7.79541C15 5.03399 12.7614 2.79541 10 2.79541C7.23858 2.79541 5 5.03399 5 7.79541C5 10.5568 7.23858 12.7954 10 12.7954Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M2.5 17.1704C4.01328 14.5556 6.76172 12.7954 10 12.7954C13.2383 12.7954 15.9867 14.5556 17.5 17.1704" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    <?php
                }
            ?>
        </div>
    </form>
</div>