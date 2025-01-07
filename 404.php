<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header();
?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<h2><?php esc_html_e('Oops!', 'awakenur'); ?></h2>
			<h3><?php esc_html_e('Something is Missing....', 'awakenur'); ?></h3>
			<p><?php esc_html_e('The page you are looking for cannot be found. take a break before trying again', 'awakenur'); ?></p>
			<div class="bt-button-home bt-button-hover">
				<a class="button" href="<?php echo esc_url(home_url('/')) ?>"><?php esc_html_e('Back To Homepage', 'awakenur'); ?></a>
			</div>
		</div>
	</div>
</main><!-- #main -->
<?php get_footer(); ?>