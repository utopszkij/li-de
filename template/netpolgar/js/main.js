jQuery(function($) {'use strict',

	//#main-slider
	/*
	jQuery(function(){
		jQuery('#main-slider.carousel').carousel({
			interval: 8000
		});
	});
	*/

	// accordian
	jQuery('.accordion-toggle').on('click', function(){
		jQuery(this).closest('.panel-group').children().each(function(){
		jQuery(this).find('>.panel-heading').removeClass('active');
		 });

	 	jQuery(this).closest('.panel-heading').toggleClass('active');
	});

	//Initiat WOW JS
	new WOW().init();

	// portfolio filter
	jQuery(window).load(function(){'use strict';
		var $portfolio_selectors = jQuery('.portfolio-filter >li>a');
		var $portfolio = jQuery('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			jQuery(this).addClass('active');
			var selector = jQuery(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});

	// Contact form
	var form = jQuery('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = jQuery('<div class="form_status"></div>');
		$.ajax({
			url: jQuery(this).attr('action'),

			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">' + data.message + '</p>').delay(3000).fadeOut();
		});
	});

	
	//goto top
	jQuery('.gototop').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({
			scrollTop: jQuery("body").offset().top
		}, 500);
	});	

	//Pretty Photo
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});

	/* slide*/
	jQuery.slide_i = 1;
	jQuery.slideFun = function() {
		if (jQuery.slide_i == 1) {
			jQuery('#slide2').show(500);
			jQuery('#slide1').hide();
			jQuery('#slide3').hide();
			jQuery('#slide4').hide();
			jQuery.slide_i = 2;
		} else if (jQuery.slide_i == 2) {
			jQuery('#slide3').show(500);
			jQuery('#slide1').hide();
			jQuery('#slide2').hide();
			jQuery('#slide4').hide();
			jQuery.slide_i = 3;
		} else if (jQuery.slide_i == 3) {
			jQuery('#slide4').show(500);
			jQuery('#slide1').hide();
			jQuery('#slide2').hide();
			jQuery('#slide3').hide();
			jQuery.slide_i = 4;
		} else if (jQuery.slide_i == 4) {
			jQuery('#slide1').show(500);
			jQuery('#slide2').hide();
			jQuery('#slide3').hide();
			jQuery('#slide4').hide();
			jQuery.slide_i = 1;
		}
		
	}
	
	if (jQuery('#myslide')) {
	  window.setInterval("jQuery.slideFun()",8000);
	}
});