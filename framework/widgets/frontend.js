(function ($) {
	/**
	   * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	**/

	function countDownHandler($scope) {
		var countDown = $scope.find('.bt-countdown-js'),
			countDownDate = new Date(countDown.data('time')).getTime(),
			timer = setInterval(function () {
				var now = new Date().getTime(),
					distance = countDownDate - now,
					days = Math.floor(distance / (1000 * 60 * 60 * 24)),
					hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
					mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
					secs = Math.floor((distance % (1000 * 60)) / 1000);

				if (days < 10) { days = '0' + days; }
				if (hours < 10) { hours = '0' + hours; }
				if (mins < 10) { mins = '0' + mins; }
				if (secs < 10) { secs = '0' + secs; }

				countDown.find('.bt-countdown-days').text(days);
				countDown.find('.bt-countdown-hours').text(hours);
				countDown.find('.bt-countdown-mins').text(mins);
				countDown.find('.bt-countdown-secs').text(secs);

				if (distance < 0) {
					clearInterval(timer);
					countDown.innerHTML = "EXPIRED";
				}
			}, 1000);
	}
	function AwakenurAnimateText(selector, delayFactor = 50) {
		const $text = $(selector);
		const textContent = $text.text();
		$text.empty();

		let letterIndex = 0;

		textContent.split(" ").forEach((word) => {
			const $wordSpan = $("<span>").addClass("bt-word");

			word.split("").forEach((char) => {
				const $charSpan = $("<span>").addClass("bt-letter").text(char);
				$charSpan.css("animation-delay", `${letterIndex * delayFactor}ms`);
				$wordSpan.append($charSpan);
				letterIndex++;
			});

			$text.append($wordSpan).append(" ");
		});
	}
	function headingAnimationHandler($scope) {
		var headingAnimationContainer = $scope.find('.bt-elwg-heading-animation');
		var animationElement = headingAnimationContainer.find('.bt-heading-animation-js');
		var animationClass = headingAnimationContainer.data('animation');
		var animationDelay = headingAnimationContainer.data('delay');

		if (animationClass === 'none') {
			return;
		}
		function checkIfElementInView() {
			const windowHeight = $(window).height();
			const elementOffsetTop = animationElement.offset().top;
			const elementOffsetBottom = elementOffsetTop + animationElement.outerHeight();

			const isElementInView =
				elementOffsetTop < $(window).scrollTop() + windowHeight &&
				elementOffsetBottom > $(window).scrollTop();

			if (isElementInView) {
				if (!animationElement.hasClass('bt-animated')) {
					animationElement
						.addClass('bt-animated')
						.addClass(animationClass);
					AwakenurAnimateText(animationElement, animationDelay);
				}
			}
		}
		jQuery(window).on('scroll', function () {
			checkIfElementInView();
		});
		jQuery(document).ready(function () {
			checkIfElementInView();
		});
	}
	function PricingHandler($scope) {
		var switchPricing = $scope.find('input[type="checkbox"]'),
			itemPricing = $scope.find('.bt-pricing li'),
			discount = $scope.find('.bt-pricing').data('discount');
		switchPricing.change(function () {
			if ($(this).prop('checked')) {
				itemPricing.each(function () {
					var price = $(this).data('price');
					var priceyear = price * 12;
					var priceDiscount = priceyear - (priceyear * discount / 100);
					$(this).find('.bt-price').text(priceDiscount);
					$(this).find('.bt-pricing--price-after').text(' /per year');
				});
			} else {
				itemPricing.each(function () {
					var price = $(this).data('price');
					$(this).find('.bt-price').text(price);
					$(this).find('.bt-pricing--price-after').text(' /per month');
				});
			}
		});
	}
	var FaqHandler = function ($scope, $) {
		const $titleFaq = $scope.find('.bt-item-title');
		if ($titleFaq.length > 0) {
			$titleFaq.on('click', function (e) {
				e.preventDefault();
				if ($(this).hasClass('active')) {
					$(this).parent().find('.bt-item-content').slideUp();
					$(this).removeClass('active');
				} else {
					$(this).parent().find('.bt-item-content').slideDown();
					$(this).addClass('active');
				}
			});
		}
	};
	// Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-upcoming-event.default', countDownHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-heading-animation.default', headingAnimationHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-pricing-item.default', PricingHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-list-faq.default', FaqHandler);
	});

})(jQuery);
