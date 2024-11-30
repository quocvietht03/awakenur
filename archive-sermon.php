<?php
get_header();
get_template_part( 'framework/templates/site', 'titlebar');

$archive_page = get_field('sermon_archive_page', 'options');
$limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 12;
$query_args = awakenur_sermon_query_args($_GET, $limit);
$wp_query = new \WP_Query($query_args);
$current_page = isset($_GET['current_page']) && $_GET['current_page'] != '' ? $_GET['current_page'] : 1;
$total_page = $wp_query->max_num_pages;

$paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;
$prev_posts = ($paged - 1) * $wp_query->query_vars['posts_per_page'];
$from = 1 + $prev_posts;
$to = count($wp_query->posts) + $prev_posts;
$of = $wp_query->found_posts;

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
            <?php get_template_part( 'framework/templates/sermon', 'filter'); ?>
            
            <div class="bt-filter-results">
                <span class="bt-loading-wave"></span>
                <?php if($wp_query->have_posts()) { ?>
                    <div class="bt-grid-post">
                        <?php
                            while ($wp_query->have_posts()) { 
                                $wp_query->the_post();

                                get_template_part( 'framework/templates/sermon', 'style', array('image-size' => 'medium_large') );
                            }
                        ?>
                    </div>
                    <div class="bt-pagination-wrap">
                        <?php echo awakenur_sermon_pagination($current_page, $total_page); ?>
                    </div>
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
