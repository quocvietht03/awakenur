(function ($) {
	/**
	   * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	**/

	function countDownHandler($scope) {
		var countDown = $scope.find('.bt-countdown-js'),
			countDownDate = new Date(countDown.data('time')).getTime(),
			timer = setInterval(function() {
				var now = new Date().getTime(),
					distance = countDownDate - now,
					days = Math.floor(distance / (1000 * 60 * 60 * 24)),
					hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
					mins = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
					secs = Math.floor((distance % (1000 * 60)) / 1000);
				
				if(days < 10) { days = '0' + days; }
				if(hours < 10) { hours = '0' + hours; }
				if(mins < 10) { mins = '0' + mins; }
				if(secs < 10) { secs = '0' + secs; }
				
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
	

	// Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/bt-upcoming-event.default', countDownHandler);
		
	});

})(jQuery);
