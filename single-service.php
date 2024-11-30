<?php
/*
 * Single Service
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');
$post_id = get_the_ID();
$top_service = get_field('top_services', 'options');
$make_appointment = get_field('make_appointment', 'options');
$opening_hours_sidebar = get_field('opening_hours_sidebar', 'options');
$site_information = get_field('site_information', 'options');
$description = get_field('description_service', $post_id);
$price = get_field('price_service', $post_id);
$testimonials_section = get_field('testimonials_section', 'options');
?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<?php while (have_posts()) : the_post(); ?>
				<div class="bt-main-post-row">
					<div class="bt-sidebar-col">
						<div class="bt-sidebar-wrap">

							<div class="bt-sidebar-block bt-top-service-block">
								<h3 class="bt-block-heading">
									<?php
									if (!empty($top_service['heading'])) {
										echo esc_html($top_service['heading']);
									} else {
										echo esc_html__('Top Services', 'awakenur');
									}
									?>
								</h3>
								<ul class="bt-service-list">
									<?php
									$args = array(
										'post_type' => 'service',
										'posts_per_page' => -1,
										'posts_per_page'  => !empty($top_service['number_posts']) ? $top_service['number_posts'] : -1,
									);
									$popular_services = $top_service['popular_service'];
									if ($popular_services) {
										$popular_service_ids = array();
										foreach ($popular_services as $post) {
											$popular_service_ids[] = $post->ID;
										}
										$args['post__in'] = $popular_service_ids;
									}
									$query = new WP_Query($args);
									if ($query->have_posts()) {
										while ($query->have_posts()) {
											$query->the_post();
									?>
											<li class="bt-service-list--item <?php if ($post_id == get_the_ID()) {
																					echo 'active';
																				} ?>">
												<div class="bt-service-list--icon">
													<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
														<path fill-rule="evenodd" clip-rule="evenodd" d="M18.3333 9.95818C18.3333 10.4582 18.0833 10.9582 17.6666 11.2915L11.1667 16.3749C11 16.5415 10.8334 16.6249 10.6667 16.6249C10.25 16.6249 9.91668 16.2915 9.83336 15.8749L9.58336 13.2082C9.58336 12.7915 9.25004 12.5415 8.83336 12.4582L3.41668 11.8749C3.16668 11.8749 3.08336 11.8749 3 11.7915C2.25 11.6249 1.66668 11.0415 1.66668 10.2915V9.87486V9.45818C1.75 8.70818 2.25 8.12486 3 7.95818C3.08332 7.95818 3.16668 7.95818 3.41668 7.87486L8.83336 7.29154C9.25004 7.29154 9.50004 6.95822 9.58336 6.54154L9.83336 3.87486C9.91668 3.45818 10.25 3.12486 10.6667 3.12486C10.8334 3.12486 11 3.20818 11.1667 3.29154L17.6667 8.37486C18.0833 8.95818 18.3333 9.45818 18.3333 9.95818ZM18.6667 12.6249C19.5 11.9582 20 10.9582 20 9.95818C20 8.87486 19.5 7.95818 18.6667 7.2915L12.1667 2.20818C11.75 1.87486 11.1667 1.70818 10.5834 1.70818C9.33336 1.70818 8.25004 2.70818 8.08336 3.95818L7.91668 5.95818L3.16668 6.45818C3 6.45818 2.83336 6.45818 2.66668 6.5415C1.16668 6.7915 0.0833588 8.0415 0 9.5415C0 9.70818 0 9.7915 0 10.0415V9.95818C0 10.1249 0 10.2915 0 10.4582C0.0833206 11.9582 1.25 13.2082 2.66668 13.4582C2.83336 13.4582 2.91668 13.4582 3.16668 13.5415L7.91668 14.0415L8.08336 16.0415C8.33336 17.2915 9.41668 18.2915 10.6667 18.2915C11.25 18.2915 11.75 18.1249 12.25 17.7915L18.6667 12.6249Z" fill="#C2A74E" />
													</svg>
												</div>
												<div class="bt-service-list--content">
													<?php echo awakenur_post_title_render(); ?>
												</div>
											</li>
									<?php
										}

										wp_reset_postdata();
									}
									?>
								</ul>
							</div>
							<div class="bt-sidebar-block bt-make-appointment-block">
								<div class="bt-make-appointment">
									<?php
									if (!empty($make_appointment['sub_heading'])) {
										echo '<span class="bt-make-appointment--sub-head">' . $make_appointment['sub_heading'] . '</span>';
									}
									if (!empty($make_appointment['heading'])) {
										echo '<h3 class="bt-make-appointment--head">' . $make_appointment['heading'] . '</h3>';
									}

									if (!empty($make_appointment['text_heading'])) {
										echo '<div class="bt-make-appointment--desc">' . $make_appointment['text_heading'] . '</div>';
									}

									if (!empty($make_appointment['button'])) {
										echo '<a class="bt-make-appointment--button bt-button-effect" href="' . esc_url($make_appointment['button']['url']) . '" target="' . esc_attr($make_appointment['button']['target']) . '">' . $make_appointment['button']['title'] . '</a>';
									}
									?>
								</div>
							</div>
							<div class="bt-sidebar-block bt-opening-hours-block">
								<div class="bt-opening-hours">
									<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 72 72" fill="none">
										<path d="M53.4514 20.9016C53.4348 20.8843 53.411 20.8786 53.3938 20.8634C48.9442 16.4383 42.8191 13.6973 36.0655 13.6879C36.0533 13.6879 36.0418 13.6843 36.0295 13.6843C36.0166 13.6843 36.0043 13.6879 35.9914 13.6879C29.2478 13.6994 23.1322 16.434 18.6854 20.849C18.661 20.8699 18.63 20.8786 18.607 20.9016C18.5832 20.9254 18.5753 20.9563 18.5544 20.9808C14.1509 25.4189 11.4214 31.5173 11.3998 38.2428C11.3976 38.2694 11.3918 38.2954 11.3918 38.322C11.3918 38.3486 11.3976 38.3746 11.3998 38.4012C11.4214 45.1246 14.1494 51.2215 18.5508 55.6589C18.5731 55.6855 18.5825 55.7186 18.6077 55.7438C18.6329 55.769 18.666 55.7777 18.6926 55.8C23.1372 60.21 29.2493 62.9424 35.9878 62.9554C36.0029 62.9554 36.0166 62.9597 36.031 62.9597C36.0454 62.9597 36.0583 62.9561 36.072 62.9554C42.8213 62.9453 48.942 60.2064 53.3902 55.7856C53.4096 55.7691 53.4348 55.7618 53.4535 55.7431C53.4722 55.7244 53.4787 55.6992 53.4953 55.6805C57.9262 51.2237 60.6694 45.0871 60.6694 38.3213C60.6694 31.5533 57.9247 25.4146 53.4917 20.9578C53.4744 20.9412 53.4686 20.9182 53.4514 20.9016ZM55.9937 39.4027H58.4798C58.2235 44.7876 56.065 49.6829 52.6608 53.4276L50.9098 51.6766C50.4879 51.2554 49.8038 51.2554 49.3819 51.6766C48.9607 52.0985 48.9607 52.7825 49.3819 53.2044L51.133 54.9547C47.3882 58.3582 42.493 60.5153 37.1088 60.7702V58.2876C37.1088 57.6907 36.6257 57.2076 36.0288 57.2076C35.4319 57.2076 34.9488 57.6907 34.9488 58.2876V60.7702C29.5646 60.5131 24.6715 58.3553 20.9275 54.9511L22.675 53.2044C23.0969 52.7825 23.0969 52.0985 22.675 51.6766C22.253 51.2547 21.569 51.2554 21.1471 51.6766L19.4004 53.424C15.9977 49.68 13.8398 44.7862 13.5842 39.4027H16.0639C16.6608 39.4027 17.1439 38.9196 17.1439 38.3227C17.1439 37.7258 16.6608 37.2427 16.0639 37.2427H13.5842C13.8398 31.8593 15.9977 26.9662 19.3997 23.2222L21.1478 24.9703C21.3588 25.1806 21.6353 25.2864 21.9118 25.2864C22.1882 25.2864 22.4647 25.1813 22.6757 24.9703C23.0969 24.5484 23.0969 23.8644 22.6757 23.4425L20.9275 21.6943C24.6715 18.2902 29.5654 16.1316 34.9495 15.8746V18.3586C34.9495 18.9554 35.4326 19.4386 36.0295 19.4386C36.6264 19.4386 37.1095 18.9554 37.1095 18.3586V15.8746C42.4944 16.1294 47.3897 18.2873 51.1344 21.6907L49.3826 23.4418C48.9607 23.8637 48.9607 24.5477 49.3826 24.9696C49.5936 25.1806 49.8701 25.2857 50.1466 25.2857C50.423 25.2857 50.6995 25.1806 50.9105 24.9696L52.6622 23.2178C56.0664 26.9626 58.2242 31.8571 58.4806 37.242H55.9944C55.3975 37.242 54.9144 37.7251 54.9144 38.322C54.9144 38.9189 55.3968 39.4027 55.9937 39.4027Z" fill="#C2A74E" />
										<path d="M48.0074 37.2428H39.8555C39.4804 35.9172 38.435 34.8725 37.1095 34.4981V22.351C37.1095 21.7541 36.6263 21.271 36.0295 21.271C35.4326 21.271 34.9495 21.7541 34.9495 22.351V34.4996C33.2827 34.9726 32.0558 36.5055 32.0558 38.3228C32.0558 40.5152 33.8392 42.2986 36.0316 42.2986C37.8496 42.2986 39.3832 41.071 39.8555 39.4028H48.0074C48.6043 39.4028 49.0874 38.9196 49.0874 38.3228C49.0874 37.7259 48.6043 37.2428 48.0074 37.2428ZM37.8446 38.3624C37.823 39.3452 37.0202 40.1386 36.0316 40.1386C35.0301 40.1386 34.2158 39.3243 34.2158 38.3228C34.2158 37.3313 35.015 36.5249 36.0021 36.5091C36.0115 36.5091 36.0194 36.512 36.0287 36.512C36.0388 36.512 36.0482 36.5091 36.0583 36.5091C37.0339 36.5235 37.823 37.309 37.8439 38.2824C37.8439 38.2961 37.8403 38.3091 37.8403 38.3228C37.8403 38.3364 37.8439 38.3487 37.8446 38.3624Z" fill="#C2A74E" />
										<path d="M21.0894 61.0898L16.4512 65.7791C16.0314 66.2032 16.035 66.8872 16.4598 67.3063C16.6701 67.5143 16.9444 67.6187 17.2194 67.6187C17.4981 67.6187 17.776 67.5122 17.987 67.2983L22.6252 62.609C23.045 62.1849 23.0414 61.5009 22.6166 61.0819C22.1918 60.6614 21.5085 60.6643 21.0894 61.0898Z" fill="#C2A74E" />
										<path d="M50.8968 61.0674C50.4749 60.6455 49.7916 60.6455 49.3697 61.0674C48.9477 61.4886 48.9477 62.1726 49.3697 62.5945L54.0763 67.3012C54.2873 67.5121 54.5637 67.6173 54.8402 67.6173C55.1167 67.6173 55.3932 67.5121 55.6041 67.3012C56.0261 66.88 56.0261 66.196 55.6041 65.7741L50.8968 61.0674Z" fill="#C2A74E" />
										<path d="M52.9502 4.38184C48.2637 4.38184 44.0834 7.1812 42.3 11.5134C42.1754 11.8158 42.1949 12.1593 42.3533 12.4458C42.5109 12.7324 42.791 12.9318 43.1136 12.988C47.6741 13.7829 51.8256 15.9436 55.1181 19.2362C56.6093 20.728 57.8801 22.4178 58.8953 24.2589C59.0529 24.5454 59.3323 24.7449 59.6548 24.801C59.7168 24.8118 59.7787 24.8169 59.8406 24.8169C60.1005 24.8169 60.3547 24.7226 60.5534 24.5483C63.0396 22.3631 64.4659 19.2095 64.4659 15.8968C64.4659 9.54784 59.2999 4.38184 52.9502 4.38184ZM60.0588 21.983C59.0853 20.4386 57.942 19.0058 56.6453 17.709C53.3765 14.4402 49.3351 12.1895 44.8869 11.1462C46.5508 8.3116 49.5907 6.54112 52.9502 6.54112C58.109 6.54112 62.3059 10.738 62.3059 15.8968C62.3059 18.1439 61.4995 20.2989 60.0588 21.983Z" fill="#C2A74E" />
										<path d="M12.1593 24.8176C12.2213 24.8176 12.2832 24.8126 12.3451 24.8018C12.6677 24.7456 12.947 24.5462 13.1047 24.2596C14.1192 22.4186 15.39 20.7295 16.8818 19.2369C20.1751 15.9443 24.3259 13.7836 28.8864 12.9887C29.2089 12.9326 29.489 12.7331 29.6467 12.4466C29.8051 12.16 29.8245 11.8166 29.7 11.5142C27.9165 7.18193 23.7362 4.38257 19.0497 4.38257C12.7001 4.38257 7.53406 9.54857 7.53406 15.8982C7.53406 19.211 8.95966 22.3638 11.4465 24.5498C11.6453 24.7233 11.8994 24.8176 12.1593 24.8176ZM9.69406 15.8975C9.69406 10.7387 13.8909 6.54185 19.0497 6.54185C22.4093 6.54185 25.4491 8.31233 27.113 11.147C22.6649 12.1902 18.6228 14.441 15.3547 17.7098C14.058 19.0065 12.9139 20.4393 11.9412 21.9837C10.5005 20.2989 9.69406 18.1439 9.69406 15.8975Z" fill="#C2A74E" />
									</svg>
									<?php
									if (!empty($opening_hours_sidebar['sub_heading'])) {
										echo '<span class="bt-opening-hours--sub-head">' . $opening_hours_sidebar['sub_heading'] . '</span>';
									}
									if (!empty($opening_hours_sidebar['heading'])) {
										echo '<h3 class="bt-opening-hours--head">' . $opening_hours_sidebar['heading'] . '</h3>';
									}

									if (!empty($opening_hours_sidebar['text_heading'])) {
										echo '<div class="bt-opening-hours--desc">' . $opening_hours_sidebar['text_heading'] . '</div>';
									}
									?>
									<ul class="bt-opening-hours--time-list">
										<?php
										if (!empty($site_information['opening_hours'])) {
											foreach ($site_information['opening_hours'] as $item) { ?>
												<li class="bt-opening-hours--time-item">
													<div class="bt-label"><?php echo esc_html($item['heading']) ?></div>
													<div class="bt-hours"><?php echo esc_html($item['hours']) ?></div>
												</li>
										<?php }
										}
										?>
									</ul>
									<div class="bt-opening-hours--phone">
										<a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9]+/', '', $site_information['site_phone'])); ?>">
											<div class="bt-opening-hours--phone-icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52" fill="none">
													<g clip-path="url(#clip0_19_2362)">
														<path d="M47.4297 41.2344H38.2891V26H47.4297C49.1125 26 50.4766 27.3641 50.4766 29.0469V38.1875C50.4766 39.8703 49.1125 41.2344 47.4297 41.2344Z" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M13.7109 41.2344H4.57031C2.88752 41.2344 1.52344 39.8703 1.52344 38.1875V29.0469C1.52344 27.3641 2.88752 26 4.57031 26H13.7109V41.2344Z" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M7.61719 41.2344V19.8047C7.61719 9.70826 15.9036 1.52344 26 1.52344C36.0964 1.52344 44.3828 9.70826 44.3828 19.8047V41.2344" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M44.3828 19.8047H47.4297" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M4.57031 19.8047H7.61719" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M32.0938 47.4297H41.3359C43.0187 47.4297 44.3828 46.0656 44.3828 44.3828V41.2344" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
														<path d="M29.0469 50.4766H22.9531C21.2703 50.4766 19.9062 49.1125 19.9062 47.4297C19.9062 45.7469 21.2703 44.3828 22.9531 44.3828H29.0469C30.7297 44.3828 32.0938 45.7469 32.0938 47.4297C32.0938 49.1125 30.7297 50.4766 29.0469 50.4766Z" stroke="#C2A74E" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
													</g>
													<defs>
														<clipPath id="clip0_19_2362">
															<rect width="52" height="52" fill="white" />
														</clipPath>
													</defs>
												</svg>
											</div>

											<div class="bt-opening-hours--phone-infor">
												<div class="bt-label"><?php echo esc_html__('Chat Us Anytime', 'awakenur') ?></div>
												<div class="bt-head"><?php echo esc_html($site_information['site_phone']); ?> </div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bt-main-post-col">
						<div class="bt-post ">
							<div class="bt-post--thumbnail">
								<div class="bt-cover-image">
									<?php
									if (has_post_thumbnail()) {
										the_post_thumbnail('full');
									}
									?>
								</div>
							</div>
							<div class="bt-post--infor">
								<div class="bt-post--info">
									<?php
									if (!empty($price)) {
										$price = number_format($price, 2);
										echo '<div class="bt-post--price">$' . $price . '</div>';
									}
									?>
									<?php echo awakenur_single_post_title_render(); ?>
									<?php
									if (!empty($description)) {
										echo '<div class="bt-post--description">' . $description . '</div>';
									}
									?>
								</div>
							</div>
							<div class="bt-post--content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>


				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php
	if (!empty($testimonials_section['shortcode_testimonials'])) {
		$id_template = $testimonials_section['shortcode_testimonials']->ID;
		echo do_shortcode('[elementor-template id="' . $id_template . '"]');
	}
	?>
</main><!-- #main -->

<?php get_footer(); ?>