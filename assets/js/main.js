!(function ($) {
	"use strict";

	/* Toggle submenu align */
	function AwakenurSubmenuAuto() {
		if ($('.bt-site-header .bt-container').length > 0) {
			var container = $('.bt-site-header .bt-container'),
				containerInfo = { left: container.offset().left, width: container.innerWidth() },
				contLeftPos = containerInfo.left,
				contRightPos = containerInfo.left + containerInfo.width;

			$('.children, .sub-menu').each(function () {
				var submenuInfo = { left: $(this).offset().left, width: $(this).innerWidth() },
					smLeftPos = submenuInfo.left,
					smRightPos = submenuInfo.left + submenuInfo.width;

				if (smLeftPos <= contLeftPos) {
					$(this).addClass('bt-align-left');
				}

				if (smRightPos >= contRightPos) {
					$(this).addClass('bt-align-right');
				}

			});
		}
	}

	/* Toggle menu mobile */
	function AwakenurToggleMenuMobile() {
		$('.bt-site-header .bt-menu-toggle').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('bt-menu-open')) {
				$(this).addClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').addClass('bt-is-active');
			} else {
				$('.bt-menu-open').removeClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').removeClass('bt-is-active');
			}
		});
	}

	/* Toggle sub menu mobile */
	function AwakenurToggleSubMenuMobile() {
		var hasChildren = $('.bt-site-header .page_item_has_children, .bt-site-header .menu-item-has-children');

		hasChildren.each(function () {
			var $btnToggle = $('<div class="bt-toggle-icon"></div>');

			$(this).append($btnToggle);

			$btnToggle.on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('bt-is-active');
				$(this).parent().children('ul').toggle();
			});
		});
	}

	/* Orbit effect */
	function AwakenurOrbitEffect() {
		if ($('.bt-orbit-enable').length > 0) {
			var html = '<div class="bt-orbit-effect">' +
				'<div class="bt-orbit-wrap">' +
				'<div class="bt-orbit red"><span></span></div>' +
				'<div class="bt-orbit blue"><span></span></div>' +
				'<div class="bt-orbit yellow"><span></span></div>' +
				'<div class="bt-orbit purple"><span></span></div>' +
				'<div class="bt-orbit green"><span></span></div>' +
				'</div>' +
				'</div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Cursor effect */
	function AwakenurCursorEffect() {
		if ($('.bt-bg-pattern-enable').length > 0) {
			var html = '<div class="bt-bg-pattern-effect"></div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Buble effect */
	function AwakenurBubleEffect() {
		if ($('.bt-bg-buble-enable').length > 0) {
			var html = '<div class="bt-bg-buble-effect">' +
				'<div class="bt-bubles-beblow"></div>' +
				'<div class="bt-bubles-above"></div>'
			'</div>';

			$('.bt-social-mcn-ss').append(html);

			for (let i = 0; i < 40; i++) {
				$('.bt-bubles-beblow').append('<span class="buble"></span>');
				$('.bt-bubles-above').append('<span class="buble"></span>');
			}
		}
	}

	/* Units custom */
	function AwakenurUnitsCustom() {
		if ($('.give-btn').length > 0) {
			var ulIcon = '<svg width="32" height="20" viewBox="0 0 32 20" fill="none" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M27.5344 10.6689L21.9094 16.2939C21.7333 16.47 21.4944 16.569 21.2453 16.569C20.9962 16.569 20.7574 16.47 20.5813 16.2939C20.4051 16.1178 20.3062 15.8789 20.3062 15.6298C20.3062 15.3808 20.4051 15.1419 20.5813 14.9658L24.6055 10.9431H5.12109C4.87245 10.9431 4.634 10.8444 4.45818 10.6685C4.28237 10.4927 4.18359 10.2543 4.18359 10.0056C4.18359 9.75699 4.28237 9.51853 4.45818 9.34272C4.634 9.1669 4.87245 9.06813 5.12109 9.06813H24.6055L20.5828 5.04313C20.4067 4.86701 20.3078 4.62814 20.3078 4.37907C20.3078 4.13 20.4067 3.89113 20.5828 3.715C20.7589 3.53888 20.9978 3.43994 21.2469 3.43994C21.4959 3.43994 21.7348 3.53888 21.9109 3.715L27.5359 9.34C27.6234 9.42722 27.6927 9.53084 27.7399 9.64493C27.7872 9.75901 27.8114 9.8813 27.8113 10.0048C27.8111 10.1283 27.7866 10.2505 27.7391 10.3645C27.6916 10.4784 27.622 10.5819 27.5344 10.6689Z" fill="currentColor"></path>' +
				'</svg>';
			$('.give-btn').append(ulIcon);
		}

	}

	

	/* Sermon Filter */
	function AwakenurSermonFilter() {
		if (!$('body').hasClass('post-type-archive-sermon')) {
			return;
		}

		// Select2
		$('.bt-field-type-select select').select2({
			minimumResultsForSearch: -1
		});

		// Magnific Popup
		$('.bt-magnific-popup-js').magnificPopup({
			type:'inline',
			midClick: true
		});

		// Search by keywords
		$('.bt-sermon-filter-js .bt-field-type-search input').on('keyup', function (e) {
			if (e.key === 'Enter' || e.keyCode === 13) {
				$('.bt-sermon-filter-js .bt-current-page').val('');
				$('.bt-sermon-filter-js').submit();
			}
		});

		// Select option
		$('.bt-sermon-filter-js select').on('change', function () {
			$('.bt-sermon-filter-js').submit();
		});

		// Pagination
		$('.bt-sermon-pagination a').on('click', function (e) {
			e.preventDefault();

			var current_page = $(this).data('page');

			if (1 < current_page) {
				$('.bt-sermon-filter-js .bt-current-page').val(current_page);
			} else {
				$('.bt-sermon-filter-js .bt-current-page').val('');
			}

			$('.bt-sermon-filter-js').submit();
		});

		// Ajax filter
		$('.bt-sermon-filter-js').submit(function () {
			var param_str = '',
				param_out = [],
				param_in = $(this).serialize().split('&');

			var param_ajax = {
				action: 'awakenur_sermon_filter',
			};

			param_in.forEach(function (param) {
				var param_key = param.split('=')[0],
					param_val = param.split('=')[1];

				if ('' !== param_val) {
					param_out.push(param);
					param_ajax[param_key] = param_val.replace(/%2C/g, ',');

					if(param_key == 'search_keyword') {
						param_ajax[param_key] = param_val.replace(/%20/g, ' ');
					}
					
				}
			});

			if (0 < param_out.length) {
				param_str = param_out.join('&');
			}

			if ('' !== param_str) {
				window.history.replaceState(null, null, `?${param_str}`);
			} else {
				window.history.replaceState(null, null, window.location.pathname);
			}


			// console.log(param_ajax);

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: AJ_Options.ajax_url,
				data: param_ajax,
				context: this,
				beforeSend: function () {
					$('.bt-filter-results').addClass('loading');
					$('.bt-grid-post').fadeOut('fast');
					$('.bt-pagination-wrap').fadeOut('fast');
				},
				success: function (response) {
					if (response.success) {
						// console.log(response.data);

						setTimeout(function () {
							$('.bt-grid-post').html(response.data['items']).fadeIn('slow');
							$('.bt-pagination-wrap').html(response.data['pagination']).fadeIn('slow');
							$('.bt-filter-results').removeClass('loading');
							
							// Callback
							$('.bt-magnific-popup-js').magnificPopup({
								type:'inline',
								midClick: true
							});
						}, 1000);

						// Pagination
						$('.bt-sermon-pagination a').on('click', function (e) {
							e.preventDefault();
				
							var current_page = $(this).data('page');
				
							if (1 < current_page) {
								$('.bt-sermon-filter-js .bt-current-page').val(current_page);
							} else {
								$('.bt-sermon-filter-js .bt-current-page').val('');
							}
				
							$('.bt-sermon-filter-js').submit();
						});
					} else {
						console.log('error');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('The following error occured: ' + textStatus, errorThrown);
				}
			});

			return false;
		});
	}

	/* Pastor QuickView */
	function AwakenurPastorQuickView() {
		if (!$('body').hasClass('post-type-archive-pastor')) {
			return;
		}

		// Magnific Popup
		$('.bt-magnific-popup-js').magnificPopup({
			type:'inline',
			midClick: true
		});
	}
	
	
	/* Give Progress Bar Animation */
	function AwakenurGiveProgressBar() {
		const progressBar = document.querySelectorAll('.give-progress-bar');

		const observer = new IntersectionObserver((entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add('animated');
					entry.target.querySelector('span').style.width = entry.target.ariaValueNow + '%';
				}
			})
		}, { threshold: 0.5 });
		
		for (let i = 0; i < progressBar.length; i++) {
			const elements = progressBar[i];
			elements.querySelector('span').style.width = '0%';
			observer.observe(elements);
		}
	};

	

	jQuery(document).ready(function ($) {
		AwakenurSubmenuAuto();
		AwakenurToggleMenuMobile();
		AwakenurToggleSubMenuMobile();
		AwakenurOrbitEffect();
		AwakenurCursorEffect();
		AwakenurBubleEffect();
		AwakenurUnitsCustom();
		AwakenurSermonFilter();
		AwakenurPastorQuickView();
		AwakenurGiveProgressBar();

	});

	jQuery(window).on('resize', function () {
		AwakenurSubmenuAuto();
	});

	jQuery(window).on('scroll', function () {

	});

})(jQuery);
