<?php
/*
 * Single Sermon
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');
$post_id = get_the_ID();
$terms = get_the_terms($post_id, 'sermon_categories');
$video_type = get_field('video_type', $post_id);
$video_mp4 = get_field('video_mp4', $post_id);
$youtube = get_field('youtube', $post_id);
$vimeo = get_field('vimeo', $post_id);
$audio_type = get_field('audio_type', $post_id);
$audio_mp3 = get_field('audio_mp3', $post_id);
$soundcloud = get_field('soundcloud', $post_id);
$pdf_file = get_field('pdf_file', $post_id);
$tags = wp_get_post_terms($post_id, 'sermon_tag');
$pastor = get_field('pastor', $post_id);
$date = get_field('date', $post_id);
$start_time = get_field('start_time', $post_id);
$end_time = get_field('end_time', $post_id);
$date_time = '';
if (!empty($date)) {
	$date_time .= $date;
}
if (!empty($start_time)) {
	$date_time .= ': ' . $start_time;
}
if (!empty($end_time)) {
	$date_time .= ' - ' . $end_time;
}
if (!empty($tags) && !is_wp_error($tags)) {
	$tag_list = [];
	foreach ($tags as $tag) {
		$tag_list[] = esc_html($tag->name);
	}
}
if ($video_type == 'youtube') {
	$video_source = $youtube;
} elseif ($video_type == 'vimeo') {
	$video_source = $vimeo;
} else {
	$video_source = $video_mp4;
}

if ($audio_type == 'soundcloud') {
	$audio_source = $soundcloud;
} else {
	$audio_source = $audio_mp3;
}

$social_item = array();
$social_item[] = '<li>
                    <span>' . __('Share This Sermon: ', 'awakenur') . '</span>
                  </li>';
$social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-linkedin" data-toggle="tooltip" title="' . esc_attr__('Linkedin', 'awakenur') . '" href="https://www.linkedin.com/shareArticle?url=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                      </svg>
                    </a>
                  </li>';
$social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-facebook" data-toggle="tooltip" title="' . esc_attr__('Facebook', 'awakenur') . '" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">
                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
                      </svg>
                    </a>
                  </li>';

$social_item[] = '<li>
                    <a target="_blank" data-btIcon="fa fa-google-plus" data-toggle="tooltip" title="' . esc_attr__('Google Plus', 'awakenur') . '" href="https://plus.google.com/share?url=' . get_the_permalink() . '">
                      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
                        <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                      </svg>
                    </a>
                  </li>';
$social_item[] = '<li>
                  <a target="_blank" data-btIcon="fa fa-twitter" data-toggle="tooltip" title="' . esc_attr__('Twitter', 'awakenur') . '" href="https://twitter.com/share?url=' . get_the_permalink() . '">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                      <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                    </svg>
                  </a>
                </li>';
?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<?php while (have_posts()) : the_post(); ?>
				<div class="bt-main-post-row">
					<div class="bt-main-post-col">
						<div class="bt-post">
							<div class="bt-post--video-wrap">
								<div class="bt-post--thumbnail">
									<?php
									if (has_post_thumbnail()) {
										the_post_thumbnail('full');
									}
									?>
									<?php if (!empty($video_source)) { ?>
										<a class="bt-button-play" href="#"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M6.75 3.78441V20.3069C6.75245 20.4388 6.78962 20.5676 6.85776 20.6805C6.9259 20.7934 7.0226 20.8864 7.13812 20.95C7.25364 21.0136 7.38388 21.0456 7.51572 21.0428C7.64756 21.04 7.77634 21.0025 7.88906 20.9341L21.3966 12.6728C21.5045 12.6075 21.5937 12.5155 21.6556 12.4056C21.7175 12.2958 21.7501 12.1718 21.7501 12.0457C21.7501 11.9195 21.7175 11.7956 21.6556 11.6857C21.5937 11.5758 21.5045 11.4838 21.3966 11.4185L7.88906 3.15722C7.77634 3.08879 7.64756 3.05129 7.51572 3.04851C7.38388 3.04572 7.25364 3.07774 7.13812 3.14135C7.0226 3.20495 6.9259 3.29789 6.85776 3.41079C6.78962 3.52369 6.75245 3.65256 6.75 3.78441Z" fill="currentColor" />
											</svg></a>
									<?php } ?>
								</div>
								<?php if ($video_type == 'youtube' || $video_type == 'vimeo') { ?>
									<?php
									if ($video_type == 'youtube') {
										echo '<div class="bt-cover-iframe bt-youtube-wrap">' . $youtube . '</div>';
									} else {
										echo '<div class="bt-cover-iframe bt-vimeo-wrap">' . $vimeo . '</div>';
									}
									?>
								<?php } else { ?>
									<div class="bt-cover-video">
										<video class="video" width="600" height="360" controls>
											<source src="<?php echo esc_url($video_mp4); ?>" type="video/mp4">
										</video>
									</div>
								<?php } ?>
							</div>

							<div class="bt-post--content">
								<?php the_content(); ?>
							</div>
							<div class="bt-post--share">
								<ul class="bt-share-list"><?php echo implode(' ', $social_item); ?></ul>
							</div>
						</div>
					</div>
					<div class="bt-sidebar-col">
						<div class="bt-sidebar-wrap">
							<h2><?php esc_html_e('Sermon Details', 'awakenur') ?></h2>
							<ul class="bt-sidebar--info">
								<?php if (!empty($pastor)) { ?>
									<li class="bt-sidebar--item">
										<div class="bt-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
												<g clip-path="url(#clip0_16970_978)">
													<path d="M14 17.7954C17.866 17.7954 21 14.6614 21 10.7954C21 6.92942 17.866 3.79541 14 3.79541C10.134 3.79541 7 6.92942 7 10.7954C7 14.6614 10.134 17.7954 14 17.7954Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M3.5 23.9204C5.61859 20.2596 9.46641 17.7954 14 17.7954C18.5336 17.7954 22.3814 20.2596 24.5 23.9204" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath id="clip0_16970_978">
														<rect width="28" height="28" fill="white" transform="translate(0 0.29541)" />
													</clipPath>
												</defs>
											</svg>
										</div>
										<div class="bt-content">
											<label><?php esc_html_e('Pastor:', 'awakenur') ?></label>
											<p><?php echo esc_html($pastor->post_title) ?></p>
										</div>
									</li>
								<?php } ?>
								<?php if (!empty($date_time)) { ?>
									<li class="bt-sidebar--item">
										<div class="bt-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
												<g clip-path="url(#clip0_16970_971)">
													<path d="M22.75 4.67041H5.25C4.76675 4.67041 4.375 5.06216 4.375 5.54541V23.0454C4.375 23.5287 4.76675 23.9204 5.25 23.9204H22.75C23.2332 23.9204 23.625 23.5287 23.625 23.0454V5.54541C23.625 5.06216 23.2332 4.67041 22.75 4.67041Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M19.25 2.92041V6.42041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M8.75 2.92041V6.42041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M4.375 9.92041H23.625" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath id="clip0_16970_971">
														<rect width="28" height="28" fill="white" transform="translate(0 0.29541)" />
													</clipPath>
												</defs>
											</svg>
										</div>
										<div class="bt-content">
											<label><?php esc_html_e('Date & Time:', 'awakenur') ?></label>
											<p><?php echo esc_html($date_time) ?></p>
										</div>
									</li>
								<?php } ?>
								<?php if (!empty($tag_list)) { ?>
									<li class="bt-sidebar--item">
										<div class="bt-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="29" viewBox="0 0 28 29" fill="none">
												<g clip-path="url(#clip0_16970_1006)">
													<path d="M23.7223 23.0454H4.30719C4.09329 23.0448 3.88831 22.9596 3.73706 22.8084C3.58581 22.6571 3.50058 22.4521 3.5 22.2382V9.04541H23.625C23.8571 9.04541 24.0796 9.1376 24.2437 9.30169C24.4078 9.46579 24.5 9.68835 24.5 9.92041V22.2678C24.5 22.474 24.4181 22.6718 24.2722 22.8176C24.1264 22.9635 23.9286 23.0454 23.7223 23.0454Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M3.5 9.04541V6.42041C3.5 6.18835 3.59219 5.96579 3.75628 5.80169C3.92038 5.6376 4.14294 5.54541 4.375 5.54541H10.138C10.3697 5.54552 10.592 5.63756 10.7559 5.80135L14 9.04541" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath id="clip0_16970_1006">
														<rect width="28" height="28" fill="white" transform="translate(0 0.29541)" />
													</clipPath>
												</defs>
											</svg>
										</div>
										<div class="bt-content">
											<label><?php esc_html_e('Tag:', 'awakenur') ?></label>
											<?php echo '<p class="tag-list">' . implode(', ', $tag_list) . '</p>'; ?>
										</div>
									</li>
								<?php } ?>
							</ul>
							<div class="bt-actions bt-button-hover-style2">
								<?php if (!empty($audio_source)) { ?>
									<?php if ($audio_type == 'soundcloud') { ?>
										<a href="#" class="btn-button btn-soundcloud"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
												<g clip-path="url(#clip0_16967_10910)">
													<path d="M13.125 5.29541C13.125 3.56952 11.7259 2.17041 10 2.17041C8.27411 2.17041 6.875 3.56952 6.875 5.29541V10.2954C6.875 12.0213 8.27411 13.4204 10 13.4204C11.7259 13.4204 13.125 12.0213 13.125 10.2954V5.29541Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M10 15.9204V19.0454" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M15.625 10.2954C15.625 11.7873 15.0324 13.218 13.9775 14.2729C12.9226 15.3278 11.4918 15.9204 10 15.9204C8.50816 15.9204 7.07742 15.3278 6.02252 14.2729C4.96763 13.218 4.375 11.7873 4.375 10.2954" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath id="clip0_16967_10910">
														<rect width="20" height="20" fill="white" transform="translate(0 0.29541)" />
													</clipPath>
												</defs>
											</svg><span><?php esc_html_e('Audio', 'awakenur') ?></span></a>
									<?php } else { ?>
										<a href="#" class="btn-button btn-audio"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
												<g clip-path="url(#clip0_16967_10910)">
													<path d="M13.125 5.29541C13.125 3.56952 11.7259 2.17041 10 2.17041C8.27411 2.17041 6.875 3.56952 6.875 5.29541V10.2954C6.875 12.0213 8.27411 13.4204 10 13.4204C11.7259 13.4204 13.125 12.0213 13.125 10.2954V5.29541Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M10 15.9204V19.0454" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													<path d="M15.625 10.2954C15.625 11.7873 15.0324 13.218 13.9775 14.2729C12.9226 15.3278 11.4918 15.9204 10 15.9204C8.50816 15.9204 7.07742 15.3278 6.02252 14.2729C4.96763 13.218 4.375 11.7873 4.375 10.2954" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												</g>
												<defs>
													<clipPath id="clip0_16967_10910">
														<rect width="20" height="20" fill="white" transform="translate(0 0.29541)" />
													</clipPath>
												</defs>
											</svg><span><?php esc_html_e('Play Audio', 'awakenur') ?></span></a>
								<?php
									}
								} ?>
								<?php if (!empty($pdf_file)) { ?>
									<a href="<?php echo esc_url($pdf_file); ?>" class="btn-button btn-download" download="sample"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
											<g clip-path="url(#clip0_16967_10930)">
												<path d="M10 11.5454V2.79541" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M16.875 11.5454V16.5454H3.125V11.5454" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M13.125 8.42041L10 11.5454L6.875 8.42041" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
											</g>
											<defs>
												<clipPath id="clip0_16967_10930">
													<rect width="20" height="20" fill="white" transform="translate(0 0.29541)" />
												</clipPath>
											</defs>
										</svg> <?php esc_html_e('Download', 'awakenur') ?></a>
								<?php } ?>

							</div>
							<?php if (!empty($audio_source)) { ?>
								<div id="<?php echo esc_attr('bt_play_audio_' . $post_id); ?>" class="bt-sermon-audio">
									<div class="bt-sermon-popup--inner bt-audio-wrap">
										<div class="bt-audio-close">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
												<path d="M4 6.79541L8 10.7954L12 6.79541" stroke="#4F320E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</div>
										<?php if ($audio_type == 'soundcloud') { ?>
											<?php echo '<div class="bt-fullwidth-audio bt-cover-iframe bt-soundcloud">' . $soundcloud . '</div>';  ?>
										<?php } else { ?>
											<div class="bt-fullwidth-audio bt-audio-player">
												<audio class="audio" controls>
													<source src="<?php echo esc_url($audio_mp3); ?>" type="audio/mpeg">
												</audio>
												<div class="bt-timeline">
													<div class="bt-progress"></div>
												</div>
												<div class="bt-controls">
													<div class="bt-audio-inner">
														<div class="bt-play-container">
															<div class="bt-toggle-play play">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
																	<g clip-path="url(#clip0_16960_4332)">
																		<path d="M6.75 4.489V21.0115C6.75245 21.1433 6.78962 21.2722 6.85776 21.3851C6.9259 21.498 7.0226 21.591 7.13812 21.6546C7.25364 21.7182 7.38388 21.7502 7.51572 21.7474C7.64756 21.7446 7.77634 21.7071 7.88906 21.6387L21.3966 13.3774C21.5045 13.3121 21.5937 13.2201 21.6556 13.1102C21.7175 13.0004 21.7501 12.8764 21.7501 12.7503C21.7501 12.6241 21.7175 12.5001 21.6556 12.3903C21.5937 12.2804 21.5045 12.1884 21.3966 12.1231L7.88906 3.86181C7.77634 3.79338 7.64756 3.75588 7.51572 3.7531C7.38388 3.75031 7.25364 3.78233 7.13812 3.84594C7.0226 3.90954 6.9259 4.00248 6.85776 4.11538C6.78962 4.22828 6.75245 4.35715 6.75 4.489Z" fill="#FFFFFF" />
																	</g>
																	<defs>
																		<clipPath id="clip0_16960_4332">
																			<rect width="24" height="24" fill="white" transform="translate(0 0.75)" />
																		</clipPath>
																	</defs>
																</svg>
															</div>
														</div>
														<div class="bt-volume-container">
															<div class="bt-volume-button">
																<div class="bt-volume volumeMedium">
																	<svg class="volumeon" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M16.0004 9.00009C16.6281 9.83575 17 10.8745 17 12.0001C17 13.1257 16.6281 14.1644 16.0004 15.0001M18 5.29177C19.8412 6.93973 21 9.33459 21 12.0001C21 14.6656 19.8412 17.0604 18 18.7084M4.6 9.00009H5.5012C6.05213 9.00009 6.32759 9.00009 6.58285 8.93141C6.80903 8.87056 7.02275 8.77046 7.21429 8.63566C7.43047 8.48353 7.60681 8.27191 7.95951 7.84868L10.5854 4.69758C11.0211 4.17476 11.2389 3.91335 11.4292 3.88614C11.594 3.86258 11.7597 3.92258 11.8712 4.04617C12 4.18889 12 4.52917 12 5.20973V18.7904C12 19.471 12 19.8113 11.8712 19.954C11.7597 20.0776 11.594 20.1376 11.4292 20.114C11.239 20.0868 11.0211 19.8254 10.5854 19.3026L7.95951 16.1515C7.60681 15.7283 7.43047 15.5166 7.21429 15.3645C7.02275 15.2297 6.80903 15.1296 6.58285 15.0688C6.32759 15.0001 6.05213 15.0001 5.5012 15.0001H4.6C4.03995 15.0001 3.75992 15.0001 3.54601 14.8911C3.35785 14.7952 3.20487 14.6422 3.10899 14.4541C3 14.2402 3 13.9601 3 13.4001V10.6001C3 10.04 3 9.76001 3.10899 9.54609C3.20487 9.35793 3.35785 9.20495 3.54601 9.10908C3.75992 9.00009 4.03995 9.00009 4.6 9.00009Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
																	</svg>
																	<svg class="volumeoff" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path d="M16 9.50009L21 14.5001M21 9.50009L16 14.5001M4.6 9.00009H5.5012C6.05213 9.00009 6.32759 9.00009 6.58285 8.93141C6.80903 8.87056 7.02275 8.77046 7.21429 8.63566C7.43047 8.48353 7.60681 8.27191 7.95951 7.84868L10.5854 4.69758C11.0211 4.17476 11.2389 3.91335 11.4292 3.88614C11.594 3.86258 11.7597 3.92258 11.8712 4.04617C12 4.18889 12 4.52917 12 5.20973V18.7904C12 19.471 12 19.8113 11.8712 19.954C11.7597 20.0776 11.594 20.1376 11.4292 20.114C11.239 20.0868 11.0211 19.8254 10.5854 19.3026L7.95951 16.1515C7.60681 15.7283 7.43047 15.5166 7.21429 15.3645C7.02275 15.2297 6.80903 15.1296 6.58285 15.0688C6.32759 15.0001 6.05213 15.0001 5.5012 15.0001H4.6C4.03995 15.0001 3.75992 15.0001 3.54601 14.8911C3.35785 14.7952 3.20487 14.6422 3.10899 14.4541C3 14.2402 3 13.9601 3 13.4001V10.6001C3 10.04 3 9.76001 3.10899 9.54609C3.20487 9.35793 3.35785 9.20495 3.54601 9.10908C3.75992 9.00009 4.03995 9.00009 4.6 9.00009Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
																	</svg>
																</div>
															</div>
															<div class="bt-volume-slider">
																<div class="bt-volume-percentage"></div>
															</div>
														</div>
														<div class="bt-time">
															<div class="current"></div>
															<div class="divider">/</div>
															<div class="length"></div>
														</div>
													</div>
													<div class="bt-name">
														<span> <?php echo get_the_title($post_id); ?></span>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>

				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php get_template_part('framework/templates/sermon', 'related-posts'); ?>
</main><!-- #main -->

<?php get_footer(); ?>