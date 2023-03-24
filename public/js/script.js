/**
 * WEBSITE: https://themefisher.com
 * TWITTER: https://twitter.com/themefisher
 * FACEBOOK: https://www.facebook.com/themefisher
 * GITHUB: https://github.com/themefisher/
 */

(function ($) {
	'use strict';

	// navbarDropdown
	if ($(window).width() < 992) {
		$('.navigation .dropdown-toggle').on('click', function () {
			$(this).siblings('.dropdown-menu').animate({
				height: 'toggle'
			}, 300);
		});
  }

	// scroll to top button
	$(window).on('scroll', function () {
		if ($(window).scrollTop() > 70) {
			$('.backtop').addClass('reveal');
		} else {
			$('.backtop').removeClass('reveal');
		}
	});
	// scroll-to-top
  $('.scroll-top-to').on('click', function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });

	// counter
	function counter() {
		var oTop;
		if ($('.counter').length !== 0) {
			oTop = $('.counter').offset().top - window.innerHeight;
		}
		if ($(window).scrollTop() > oTop) {
			$('.counter').each(function () {
				var $this = $(this),
					countTo = $this.attr('data-count');
				$({
					countNum: $this.text()
				}).animate({
					countNum: countTo
				}, {
					duration: 500,
					easing: 'swing',
					step: function () {
						$this.text(Math.floor(this.countNum));
					},
					complete: function () {
						$this.text(this.countNum);
					}
				});
			});
		}
  }
  $(window).on('scroll', function () {
		counter();
	});



	$(function(){

	});

	$(document).ready(function() {
		$.fn.selectProduct = function(){
			$.ajax({
				url: "http://localhost:8080/list",
				method: 'GET',
				success: function(response) {
					var itemList = $('<div id="itemList"></div>');
					itemList.css({
						'position': 'absolute',
						'top': '25%',
						'left': '50%',
						'transform': 'translate(-50%, -50%)',
						'width': '400px',
						'height': '300px',
						'background-color': '#ffffff',
						'border': '6px solid #000000FF',
						'overflow-y': 'auto'
					});
					$.each(response, function(index, item) {
						var itemDiv = $('<div class="item">' + item.name + '</div>');
						itemDiv.css({
							'padding': '10px',
							'border-bottom': '1px solid #FFFFFFFF',
							'cursor': 'pointer'
						});
						itemList.append(itemDiv);
					});
					itemList.on('click', '.item', function() {
						var selectedItem = $(this).text();
						$('td.item-name').text(selectedItem);
						itemList.hide();
					});
					$('body').append(itemList);
				}
			});		}
		$(document).on('click', '.selectProduct', function() {
			// Call selectProduct() function
			$.fn.selectProduct();
		});
		// Add click event handler to button

	});



	// Shuffle js filter and masonry

})(jQuery);
