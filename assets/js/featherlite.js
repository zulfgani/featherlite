(function($) {
	'use strict';
	$(document).ready(function() {		
		
		/*
		/*  Detect touch screen device
		*/ 
		var mobileDetect = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);	
	
		/*
		/*  Mobile Menu
		*/ 
		if ($( window ).width() <= 767) {
			$('.main-navigation').find('li').each(function(){
				if($(this).children('ul').length > 0){
					$(this).append('<span class="indicator"></span>');
				}
			});
			$('.main-navigation ul > li.menu-item-has-children .indicator, .main-navigation ul > li.page_item_has_children .indicator').click(function() {
				$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpen');
				$(this).toggleClass('yesOpen');
				var $self = $(this).parent();
				if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpen')) {
					$self.find('> ul.sub-menu, > ul.children').slideDown(300);
				} else {
					$self.find('> ul.sub-menu, > ul.children').slideUp(200);
				}
			});
		}
		$(window).resize(function() {
			if ($( window ).width() > 767) {
				$('.main-navigation ul > li.menu-item-has-children, .main-navigation ul > li.page_item_has_children').find('> ul.sub-menu, > ul.children').slideDown(300);
			}
		});
		
		if ($( window ).width() <= 767) {
			$('.secondary-navigation').find('li').each(function(){
				if($(this).children('ul').length > 0){
					$(this).append('<span class="indicator"></span>');
				}
			});
			$('.secondary-navigation ul > li.menu-item-has-children .indicator, .secondary-navigation ul > li.page_item_has_children .indicator').click(function() {
				$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpen');
				$(this).toggleClass('yesOpen');
				var $self = $(this).parent();
				if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpen')) {
					$self.find('> ul.sub-menu, > ul.children').slideDown(300);
				} else {
					$self.find('> ul.sub-menu, > ul.children').slideUp(200);
				}
			});
		}
		$(window).resize(function() {
			if ($( window ).width() > 767) {
				$('.secondary-navigation ul > li.menu-item-has-children, .secondary-navigation ul > li.page_item_has_children').find('> ul.sub-menu, > ul.children').slideDown(300);
			}
		});
		/*
		 *  Detect Mobile Browser
		 */ 
		if (!mobileDetect) {
			/*
			 *  Scroll To Top
			 */ 
			$(window).scroll(function(){
				if ($(this).scrollTop() > 300) {
					$('#toTop').addClass('visible');
				} 
				else {
					$('#toTop').removeClass('visible');
				}
			}); 
			$('#toTop').click(function(){
				$('html, body').animate({ scrollTop: 0 }, 1000);
				return false;
			});
		}
	});
})(jQuery);