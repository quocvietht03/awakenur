<?php
get_header();
get_template_part( 'framework/templates/site', 'titlebar');
?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
            <?php
                if( have_posts() ) {
                    ?>
                        <div class="bt-grid-post">
                            <?php
                                while ( have_posts() ) : the_post();
                                    get_template_part( 'framework/templates/give', 'style', array('image-size' => 'medium_large') );
                                endwhile;
                            ?> 
                        </div>
                    <?php
                    awakenur_paging_nav();
                } else {
                    get_template_part( 'framework/templates/post', 'none');
                }
            ?>
        </div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>
