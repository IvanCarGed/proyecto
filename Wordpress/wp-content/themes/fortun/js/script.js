// JavaScript Document
(function($) {
  "use strict";
	// makes sure the whole site is loaded	
	$(window).on('load', function() {

		// will first fade out the loading animation
		$(".preloader").fadeOut();
		$("body").css({'visibility':'visible'});
		// will fade out the whole DIV that covers the website.
		$(".preloader").delay(500).slideUp('slow');
		if(!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			// youtube video
			$(".player").each(function(){
				$(this).YTPlayer();
			});
		}
		else{
			// youtube video fallback
			$(".player").each(function(){
				$(this).addClass('player-background');
			});
			$('.section-video-controls').css({'display':'none'});
		}
		if(!(/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) ){
			// skrollr
			skrollr.init({
				smoothScrolling: false,
				mobileDeceleration: 0.004,
				forceHeight: false
			});	
		}
		else if($('body').hasClass('has-parallax-mobile') ){
			// skrollr
			skrollr.init({
				mobileCheck: function() {
					//hack - forces mobile version to be off
					return false;
				},
				smoothScrolling: false,
				mobileDeceleration: 0.004,
				forceHeight: false
			});	
			$(".agni-slides").css({"touch-action":"auto"});

		}
		else{
			// skrollr fallback
			$('html').addClass('no-Skrollr');	
		}
		
	})
	
	jQuery(document).on('ready', function(){
		
		$('body:not(.vc_editor) .preloader').each(function(){
			if( $(this).data('preloader-style') == '1' ){
				$('body').jpreLoader({
					splashID: "#preloader-1",
					loaderVPos: '50%',
					autoClose: $(this).data('close-button'),
					closeBtnText: $(this).data('close-button-text'),
				}, function(){
					// callback
				});
			}
		})	
		$("body").css({'visibility':'visible'}); 

		if((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) && !$('body').hasClass('has-animation-mobile') ){
			$("div").removeClass('animate');
		}
		// browser check
		var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
		var is_explorer = navigator.userAgent.indexOf('MSIE') > -1 || navigator.appVersion.indexOf('Trident/') > 0 ;
		var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
		var is_safari = navigator.userAgent.indexOf("Safari") > -1;
		var is_opera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;//navigator.userAgent.indexOf("Presto") > -1;
		if ((is_chrome)&&(is_safari)) {is_safari=false;}
		
		if( is_safari ){
			$('html').addClass('safari');	
		}
		else if( is_explorer ){
			$('html').addClass('ie');
		}
		else if( is_firefox ){
			$('html').addClass('firefox');	
		}
		else if( is_opera ){
			$('html').addClass('opera');	
		}
		else {
			$('html').addClass('chrome');
		}
		
		// back to top			
		var offset = 400;
		var duration = 1000;
		$('.back-to-top').fadeOut(duration);
		$(window).on('scroll', function() {
			($(this).scrollTop() > offset)?$('.back-to-top').fadeIn(duration):$('.back-to-top').fadeOut(duration);
		});
		
		$('.back-to-top').on('click', function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, duration);
			return false;
		})
				
		// one page scroll
		$('.page-scroll a').on('click', function(event) {
			//if( /#/.test(this.href) ){
			if($(this).is('[href*="#"]')) {
				$('html, body').stop().animate({
					scrollTop: ( $('.header-sticky').height() && !$('.header-sticky').hasClass('side-header-menu') )?$(this.hash).offset().top - 50:$(this.hash).offset().top,
				}, 1500, 'easeInOutExpo');
				event.preventDefault();
			}
		});

		// Agni Slider Image width Calculation
		$.fn.agni_slider_img_custom_width_calc = function(){
			$(this).each(function(){
				if( $(window).width() >= 768 && $(window).width() <= 991 ){
					$(this).find('img').css({'max-width':$(this).data('width-tab')});
				}
				else if( $(window).width() <= 767 ){
					$(this).find('img').css({'max-width':$(this).data('width-mobile')});
				}
				else{
					$(this).find('img').css({'max-width':$(this).data('width')});
				}
			});
		}
		$('.agni-slide-image').each(function(){
			$(this).agni_slider_img_custom_width_calc();
		});
		$(window).on('resize', function(){
			$('.agni-slide-image').each(function(){
				$(this).agni_slider_img_custom_width_calc();
			});
		});

		// Agni Slider & Page Header Height Calculation
		$.fn.full_height_calc = function(){
			$(this).each(function(){
				var viewport_height = $(window).height();
				var top_bar_height = ( $('.header-top-bar').data('transparent') != '1' )?$('.header-top-bar').height():'';
				var navigation_menu_height = '';
				if( !$('.header-navigation-menu').is('.strip-header-menu, .side-header-menu') ){
					navigation_menu_height = ( $('.header-navigation-menu').data('transparent') != '1' )?$('.header-navigation-menu').height():'';
				}
				var border_header_footer = ( $('.border-header-menu-footer').height() )?$('.border-header-menu-footer').height():'';
				var ignore_height = +navigation_menu_height + +top_bar_height + +border_header_footer;

				$(this).css('height',viewport_height-ignore_height)
			});
		}
		$.fn.custom_height_calc = function(){
			$(this).each(function(){
				if( $(window).width() >= 768 && $(window).width() <= 1024 ){
					$(this).css({'height':$(this).data('height-tab')});
				}
				else if( $(window).width() <= 767 ){
					$(this).css({'height':$(this).data('height-mobile')});
				}
				else{
					$(this).css({'height':$(this).data('height')});
				}
			});
		}

		// Page Header function
		$.fn.agni_page_header = function(){
			if( $(this).data('slider-choice') == '1' ){
				$(this).full_height_calc();
				$(window).on('resize', function(){
					$('.agni-page-header').full_height_calc();
				});
			}
			else if( $(this).data('slider-choice') == '2' ){
				$(this).custom_height_calc();
				$(window).on('resize', function(){
					$('.agni-page-header').custom_height_calc();
				});
			}
			$(this).owlCarousel({
				autoplay: false,
				nav: false,
				dots: false,
				loop: false,
				responsive:{
					0:{
						items:1
					},
					768:{
						items:1
					},
					992:{
						items:1
					},
					1200:{
						items:1
					}
				},
				mouseDrag: false,
				touchDrag: false
			});
		}

		// Agni Slider function
		$.fn.agni_slider = function(){
			//var $this = $(this);
			if( $(this).data('slider-choice') == '1' ){
				$(this).full_height_calc();
				$(window).on('resize', function(){
					$('.agni-slider').full_height_calc();
				});
			}
			else if( $(this).data('slider-choice') == '2' ){
				$(this).custom_height_calc();
				$(window).on('resize', function(){
					$('.agni-slider').custom_height_calc();
				});
			}
			
			$(this).owlCarousel({
				autoplay: $(this).data('slider-autoplay'),
				autoplayTimeout: $(this).data('slider-autoplay-timeout'),
				smartSpeed: $(this).data('slider-smart-speed'),
				animateIn: $(this).data('slider-animate-in'), //'slideInDown',
				animateOut: $(this).data('slider-animate-out'), //'fadeOut',
				nav: $(this).data('slider-nav'),
				navText: ['<i class="ion-ios-arrow-thin-left"></i>', '<i class="ion-ios-arrow-thin-right"></i>'],
				dots: $(this).data('slider-dots'),
				loop: $(this).data('slider-loop'),
				mouseDrag: $(this).data('slider-mousedrag'),
				margin: $(this).data('slider-carousel-margin'),
				nestedItemSelector: 'agni-slide',
				responsive:{
					0:{
						items: $(this).data('slider-0-items'),
					},
					768:{
						items: $(this).data('slider-768-items'),
					},
					992:{
						items: $(this).data('slider-992-items'),
					}
				},
				//touchDrag: false
			});
		}

		// Agni Slider 
		$('.agni-slider').each(function(){
			$(this).agni_slider();
		});

		// Gradient Map Overlay
		$('.gradient-map-overlay').each(function(){
			var gm_value = $(this).data('gm');
			GradientMaps.applyGradientMap($(this)[0], gm_value);
		});

		// text rotator

		// Particle ground function
		$.fn.agni_particle_ground = function(){
			$(this).particleground({
				density: 12000, // How many particles will be generated: one particle every n pixels
				dotColor: $(this).data('color'),
				lineColor: $(this).data('color'),
				particleRadius: 3, // Dot size
				lineWidth: 0.35,
				proximity: 75, // How close two dots need to be before they join
				parallaxMultiplier: 15, // The lower the number, the more extreme the parallax effect
			});
		}
		
		// Particle ground
		$('.particles').each(function(){
			$(this).agni_particle_ground();
		})
		
		// Strip menu
		$.fn.is_visible = function() {
			return this.css('visibility');
		};

		$.fn.visibilityToggle = function() {
			return this.css('visibility', function(i, visibility) {
				return (visibility == 'visible') ? 'hidden' : 'visible';
			});
		};

		$('.strip-header-menu .strip-header-menu-toggle').on( 'click', function(t){
			t.preventDefault();
			if ( $(this).parents('.strip-header-bar').siblings('.strip-header-menu-container').css('visibility') == 'hidden' ) {
				$(this).parents('.strip-header-menu').addClass('strip-header-menu-opened');
				$('.strip-header-menu-content').css({'left':'250px'});
			}
			else{
				$(this).parents('.strip-header-menu').removeClass('strip-header-menu-opened');
				$('.strip-header-menu-content').css({'left':'0px'});
			}

			var burg_text = $(this).children('.burg-text').data('burg-text');
			var burg_text_active = $(this).children('.burg-text').data('burg-text-active');
			var burg_text_display = $(this).children('.burg-text').text();

			if( burg_text == burg_text_display ){
				$(this).children('.burg-text').text(burg_text_active).animate(5000);
			}	
			else{
				$(this).children('.burg-text').text(burg_text).animate(5000);
			}

		});

		$('.portfolio-single-project-details-toggle').on( 'click', function(t){
			if ( $(this).siblings('.portfolio-single-content').css('visibility') == 'hidden' ) {	
				$(this).siblings('.portfolio-single-content').visibilityToggle();	
				$(this).siblings('.portfolio-single-content').css({'right':'0px'});
				$(this).css({'right':'360px'});
			}
			else{
				$(this).siblings('.portfolio-single-content').visibilityToggle();
				$(this).siblings('.portfolio-single-content').css({'right':'-360px'});
				$(this).css({'right':'0px'});
			}
		});

		// Header toggle class for offset function
		$.fn.agni_offset_toggle_class = function(offset, selector, reverse) {
			if( reverse == 1 ){
				($(window).scrollTop() < offset)?$(this).addClass(selector):$(this).removeClass(selector);
			}
			else{
				($(window).scrollTop() < offset)?$(this).removeClass(selector):$(this).addClass(selector);
			}
			return this;
		};

		// Header spacer function
		$.fn.agni_spacer = function() {
			var $headerMenuHeight = ( $(window).width() < 1200 )?$('.header-navigation-menu:not(.transparent-header-menu)').height():$('.header-navigation-menu:not(.transparent-header-menu, .side-header-menu)').height();
			var $headerTopHeight = ( $('.header-top-bar:not(.transparent-header-menu)').is(":visible") )?$('.header-top-bar:not(.transparent-header-menu)').height(): 0;
			var $spacerHeight = $headerTopHeight + $headerMenuHeight;
			$('.spacer').css({'height':$spacerHeight});
			return this;
		};

		// Header menu sticky
		$('.header-navigation-menu').each(function(){
			var $element = $(this);
			// Header Sticky
			if( $element.data('sticky') == '1' ){
				$element.agni_offset_toggle_class(400, 'top-sticky');
				$(window).on('scroll', function(){
					$element.agni_offset_toggle_class(400, 'top-sticky');
				});
				
				if($element.data('sticky-fancy') == '1' ){
					// Hide Header on on scroll down
					var lastScrollTop = 0;
					var min = 10;
					var topvalue = ( $('#wpadminbar').outerHeight() )? $('#wpadminbar').outerHeight() : 0;
					var navbarHeight = $element.outerHeight();
					$(window).on('scroll', function(event){
						if( $element.hasClass('header-sticky-nav-up') ){
							$('.header-sticky-nav-up').css({'top':-navbarHeight+topvalue });
						}
						else{
							$('.header-sticky-nav-down').css({'top':topvalue });
						}

						var st = $(this).scrollTop();
						// Make sure they scroll more than min value
						if(Math.abs(lastScrollTop - st) <= min)
							return;
						
						// If they scrolled down and are past the navbar, add class .nav-up.
						// This is necessary so you never see what is "behind" the navbar.
						if (st > lastScrollTop && st > navbarHeight){
							// Scroll Down
							$element.removeClass('header-sticky-nav-down').addClass('header-sticky-nav-up');
							$('.agni-nav-menu').css({'top':''});
						} else {
							// Scroll Up
							if(st + $(window).height() < $(document).height()) {
								$element.removeClass('header-sticky-nav-up').addClass('header-sticky-nav-down');
								if( $('.agni-nav-menu').hasClass('agni-nav-menu-sticky') ){
									$('.agni-nav-menu').css({'top':'50px'});
								}
								else{
									$('.agni-nav-menu').css({'top':''});
								}
							}
						}
						
						lastScrollTop = st;
					});
				}
			}

			// Header Transparent
			if( $element.data('transparent') == '1' ){
				$element.agni_offset_toggle_class(400, 'transparent-header-menu', 1);
				$(window).on('scroll', function(){
					$element.agni_offset_toggle_class(400, 'transparent-header-menu', 1);
				});
			}
			// Header Shrink
			if( $element.data('shrink') != '1' && $element.hasClass('header-sticky') ){
				$element.agni_offset_toggle_class(400, 'shrink-header-menu');
				$(window).on('scroll', function(){
					$element.agni_offset_toggle_class(400, 'shrink-header-menu');
				});
			}

			// Header Spacer
			if( $element.data('transparent') != '1' ){
				$element.agni_spacer();
				$(window).on('resize', function(){
					$element.agni_spacer();
				})
			}

		});

		// Header Cart
		$('.header-cart-toggle .cart-contents').on('click', function(c){
			c.preventDefault();
		})

		// Header Search
		$('.header-search-toggle').on('click', function(c){
			$('.header-search #search').animate({
		        opacity: 0
		    }, 200).animate({
		        bottom: '-25px'
		    }, 50);

			if($('.header-search').hasClass('search-invisible') ){
				$(this).css({'z-index': '4'});
				$(this).find('span:first-child').removeClass('active');
				$(this).find('span:last-child').addClass('active');
				$('.header-search').css({'right':'0'});
				$('.header-search').removeClass('search-invisible').addClass('search-visible');
			}
			else{
				$(this).css({'z-index': '0'});
				$(this).find('span:first-child').addClass('active');
				$(this).find('span:last-child').removeClass('active');
				$('.header-search').css({'right':'-100%'});
				$('.header-search').removeClass('search-visible').addClass('search-invisible');
			}
			
		    $('.header-search #search').delay(600).animate({
		        opacity: 1, 
		        bottom: 0,
		    }, 400);

			$('.header-search').find('#search').focus();
		})

		// tab-nav-menu
		$.fn.agni_tab_nav_menu_accordion = function(option) {
			var obj,
				item;
			var options = $.extend({
					Speed: 220,
					autostart: true,
					autohide: 1
				},
				option);
			obj = $(this);

			item = obj.find("ul").parent("li").children("a");
			item.attr("data-option", "off");

			item.unbind('click').on("click", function() {
				var a = $(this);
				if (options.autohide) {
					a.parent().parent().find("a[data-option='on']").parent("li").children("ul").slideUp(options.Speed / 1.2,
						function() {
							$(this).parent("li").children("a").attr("data-option", "off");
						})
				}
				if (a.attr("data-option") == "off") {
					a.parent("li").children("ul").slideDown(options.Speed,
						function() {
							a.attr("data-option", "on");
						});
				}
				if (a.attr("data-option") == "on") {
					a.attr("data-option", "off");
					a.parent("li").children("ul").slideUp(options.Speed)
				}
			});
			if (options.autostart) {
				obj.find("a").each(function() {

					$(this).parent("li").parent("ul").slideDown(options.Speed,
						function() {
							$(this).parent("li").children("a").attr("data-option", "on");
						})
				})
			}

		}

		$('.header-menu-toggle').on('click', function(e){
			e.preventDefault();
			$('.tab-nav-menu >ul >li').animate({
		        opacity: 0
		    }, 200).animate({
		        bottom: '-25px'
		    }, 50);

			if($('.tab-nav-menu').hasClass('tab-invisible') ){
				$('.tab-nav-menu').css({'right':'0'});
				$('.tab-nav-menu').removeClass('tab-invisible').addClass('tab-visible');
				$(this).find('.burg').addClass('activeBurg');
			}
			else{
				$('.tab-nav-menu').css({'right':'-100%'});
				$('.tab-nav-menu').removeClass('tab-visible').addClass('tab-invisible');
				$(this).find('.burg').removeClass('activeBurg');
			}
			var delay = 600;
			var duration = 400;
			if( $(".header-navigation-menu").hasClass("strip-header-menu") ){
				delay = 250;
			}
			$('.tab-nav-menu >ul >li').each(function(){
			    $(this).delay(delay).animate({
			        opacity: 1, 
			        bottom: 0,
			    }, duration);
			    delay += 150;
			});
		})

		$(".tab-nav-menu").agni_tab_nav_menu_accordion({
			Speed: 200,
			autostart: false,
			autohide: true
		});
		if( !$('.header-navigation-menu').hasClass('strip-header-menu') || $(window).width() <= 1199 ){
			$(".header-navigation-menu .tab-nav-menu-content li:not('.menu-item-has-children') a").on('click', function(m){
				$('.tab-nav-menu').animate({
			        opacity: 0
			    }, 100 );
				$('.tab-nav-menu').delay(600).animate({
			        right: '-100%'
			    }, 50 );
			    $('.tab-nav-menu').delay(700).animate({
			        opacity: 1
			    }, 50 );
				$('.tab-nav-menu').removeClass('tab-visible').addClass('tab-invisible');
				$('.header-menu-toggle').find('.burg').removeClass('activeBurg');
			});
		}

		// Removing mega menu for mobile
		$('.tab-nav-menu-content li').each(function(){
			$(this).removeClass("megamenu col-md-2 col-md-3 col-md-4 col-md-6");
		});

		// Footer Sticky
		$.fn.footer_height_detection = function(){
			$this = $(this);
			return ( $(window).width() > 991 )?$this.siblings('.content').css({'margin-bottom': $this.height()}):$this.siblings('.content').css({'margin-bottom': '0'});
		}
		$('.has-sticky-footer').footer_height_detection();
		$(window).on('resize', function(){
			$('.has-sticky-footer').footer_height_detection();
		});

		// Custom Nav menu Sticky
		$('.agni-nav-menu').each(function(){
			var $element = $(this);
			var distance = $element.offset().top;
			$(this).parents('.section-row').css({'z-index':'1'});
			if( $('.header-navigation-menu').data('sticky') == '1' && !$('.header-navigation-menu').data('sticky-fancy') == '1' ){
				distance = $element.offset().top - 50;
			}
			if( $element.data('sticky') == '1' ){
				$element.agni_offset_toggle_class(distance, 'agni-nav-menu-sticky');
				$(window).on('scroll', function() {
					$element.agni_offset_toggle_class(distance, 'agni-nav-menu-sticky');
					if( $('.header-navigation-menu').data('sticky') == '1' && !$('.header-navigation-menu').data('sticky-fancy') == '1' ){
						if( $('.agni-nav-menu').hasClass('agni-nav-menu-sticky') ){
							$('.agni-nav-menu-sticky').css({'top':'50px'});
						}
						else{
							$('.agni-nav-menu').css({'top':''});
						}
					}
				});
			}
		});

		// mbYTPlayer controls 
		$('.player').each(function() {
			$(this).on("YTPStart",function(e){
				$(this).siblings('div').children('.command-play').css({'display':'none'});	
				$(this).siblings('div').children('.command-pause').css({'display':'inline-block'});
			});
			$(this).on("YTPPause",function(e){
				$(this).siblings('div').children('.command-pause').css({'display':'none'});	
				$(this).siblings('div').children('.command-play').css({'display':'inline-block'});
			});

			$(this).siblings('div').find('.command-play').click(function(event) {
				event.preventDefault();
				$(this).parent('div').parent('div').find(".player").playYTP();	
			})
			$(this).siblings('div').find('.command-pause').click(function(event) {
				event.preventDefault();
				$(this).parent('div').parent('div').find(".player").pauseYTP();	
			})			
			
		});

		// Before & After Slider
		$('.ba-slider').each(function(){
			$(this).beforeAfter(); 
		});
		
		// Mile Count up function
		$.fn.countUp = function( options ) {
			$('.mile-count .count').each( function() {
				if( $(this).data('count-animation') == '1' ){
					var defaults = {
						startVal: 0,
						endVal: $(this).attr( "data-count" ),
						duration: 1.5,
						options: {
							useEasing: true,
							useGrouping: true ,
							decimals:'',
							separator : $(this).attr( "data-sep" ),
							prefix : $(this).attr( "data-pre" ), 
							suffix : $(this).attr( "data-suf" )
						}
					},
					options = $.extend({}, defaults, options);
					var mile_count = new countUp( this, options.startVal, options.endVal, options.decimals, options.duration, options.options );
					
					var $element = $(this);
					$element.waypoint(function() {
						mile_count.start();
						this.destroy();
					}, {
						offset: $element.data('animation-offset')
					})		
				}						
			})		
		};	
		$('.mile-count .count').each( function() {
			if( $(this).data('count-animation') == '1' ){
				$(this).countUp();
			}
		});
		
		// Carousel Gallery function
		$.fn.carousel_gallery = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('gallery-autoplay'),
				autoplayTimeout: $(this).data('gallery-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('gallery-autoplay-hover'),
				dots : $(this).data('gallery-pagination'),
				loop: $(this).data('gallery-loop'),
				center: $(this).data('gallery-center'),
				stagePadding: 0,
				autoHeight: $(this).data('gallery-autoheight'),
				margin: $(this).data('gallery-margin'),
				responsive:{
					0:{
						items:$(this).data('gallery-0')
					},
					768:{
						items:$(this).data('gallery-768')
					},
					992:{
						items:$(this).data('gallery-992')
					},
					1200:{
						items:$(this).data('gallery-1200')
					}
				}			
			})
		};

		// Carousel Posts function	
		$.fn.carousel_post = function() {
			$(this).owlCarousel({
				margin: $(this).data('gutter'),
				autoplay : $(this).data('posttype-autoplay'),
				autoplayTimeout: $(this).data('posttype-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('posttype-autoplay-hover'),
				smartSpeed: $(this).data('posttype-autoplay-speed'),
				nav: $(this).data('posttype-navigation'),
				navText: ['<i class="ion-ios-arrow-thin-left"></i>', '<i class="ion-ios-arrow-thin-right"></i>'],
				dots : $(this).data('posttype-pagination'),
				loop: $(this).data('posttype-loop'),
				responsive:{
					0:{
						items:$(this).data('post-0')
					},
					768:{
						items:$(this).data('post-768')
					},
					992:{
						items:$(this).data('post-992')
					},
					1200:{
						items:$(this).data('post-1200')
					}
				}
			
			});
		};

		// Carousel Portfolio function
		$.fn.carousel_portfolio = function() {
			$(this).owlCarousel({
				margin: $(this).data('gutter'),
				autoplay : $(this).data('posttype-autoplay'),
				autoplayTimeout: $(this).data('posttype-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('posttype-autoplay-hover'),
				smartSpeed: $(this).data('posttype-autoplay-speed'),
				nav: $(this).data('posttype-navigation'),
				navText: ['<i class="ion-ios-arrow-thin-left"></i>', '<i class="ion-ios-arrow-thin-right"></i>'],
				dots : $(this).data('posttype-pagination'),
				loop: $(this).data('posttype-loop'),
				responsive:{
					0:{
						items:$(this).data('post-0')
					},
					768:{
						items:$(this).data('post-768')
					},
					992:{
						items:$(this).data('post-992')
					},
					1200:{
						items:$(this).data('post-1200')
					}
				}
			});
		};
		
		// carousel clients	function	
		$.fn.carousel_clients = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('clients-autoplay'),
				autoplayTimeout: $(this).data('clients-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('clients-autoplay-hover'),
				dots : $(this).data('clients-pagination'),
				loop: $(this).data('clients-loop'),
				margin: $(this).data('clients-gutter'),
				responsive:{
					0:{
						items:$(this).data('client-0')
					},
					768:{
						items:$(this).data('client-768')
					},
					992:{
						items:$(this).data('client-992')
					},
					1200:{
						items:$(this).data('client-1200')
					}
				}			
			})
		};
		
		// carousel team function
		$.fn.carousel_team = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('team-autoplay'),
				autoplayTimeout: $(this).data('team-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('team-autoplay-hover'),
				dots : $(this).data('team-pagination'),
				loop: $(this).data('team-loop'),
				margin: $(this).data('team-gutter'),
				responsive:{
					0:{
						items:$(this).data('team-0')
					},
					768:{
						items:$(this).data('team-768')
					},
					992:{
						items:$(this).data('team-992')
					},
					1200:{
						items:$(this).data('team-1200')
					}
				}			
			})
		};		
		
		// carousel testimonials function
		$.fn.carousel_testimonials = function() {
			$(this).owlCarousel({
				autoplay : $(this).data('testimonial-autoplay'),
				autoplayTimeout: $(this).data('testimonial-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('testimonial-autoplay-hover'),
				smartSpeed: $(this).data('testimonial-autoplay-speed'),
				dots : $(this).data('testimonial-pagination'),
				loop: $(this).data('testimonial-loop'),
				margin: 30,
				responsive:{
					0:{
						items:$(this).data('test-0')
					},
					768:{
						items:$(this).data('test-768')
					},
					992:{
						items:$(this).data('test-992')
					},
					1200:{
						items:$(this).data('test-1200')
					}
				}
			
			})
		};	

		// carousel Service box function
		$.fn.carousel_service_box = function(){
			$(this).owlCarousel({
				autoplay : $(this).data('service-autoplay'),
				autoplayTimeout: $(this).data('service-autoplay-timeout'),
				autoplayHoverPause :  $(this).data('service-autoplay-hover'),
				dots : $(this).data('service-pagination'),
				loop: $(this).data('service-loop'),
				margin: $(this).data('service-gutter'),
				responsive:{
					0:{
						items:$(this).data('service-0')
					},
					768:{
						items:$(this).data('service-768')
					},
					992:{
						items:$(this).data('service-992')
					},
					1200:{
						items:$(this).data('service-1200')
					}
				}
			
			})
		};

		// sharing popup function
		$.fn.post_sharing_buttons = function(){
			$(this).find('a').on('click', function(s){
				s.preventDefault();
				window.open( $(this).attr('href'), 'popUpWindow',  'height=700, width=800, left=10, top=10, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
			})		
		};

		// magnific popup portfolio thumbnail
		$.fn.portfolio_attachment_magnific_popup = function(){
			$(this).magnificPopup({
				delegate: '.portfolio-column:not(.filterhide) a.portfolio-attachment', // the selector for gallery item
				type: 'image',
				mainClass: 'mfp-img-mobile mfp-portfolio-attachment-popup mfp-image-popup',
				image: {
					verticalFit: true
				},
				gallery:{
					enabled:true,
					navigateByImgClick: false
				},
			})
		}
		
		// Maginfic popup image
		$.fn.custom_image_magnific_popup = function(){
			$(this).magnificPopup({
				type: 'image',
				mainClass: 'mfp-img-mobile',
				showCloseBtn:false,
				image: {
					titleSrc: function(item) {
						return item.el.children('img').attr('alt');
					},
					verticalFit: true
				},
				zoom: {
					enabled: true, // By default it's false, so don't forget to enable it
					duration: 300, // duration of the effect, in milliseconds
					easing: 'ease-in-out' // CSS transition easing function 
				}
			});
		}

		// Maginfic popup gallery
		$.fn.custom_gallery_magnific_popup = function() { // the containers for all your galleries		
			var $delegate = ( $(this).find('.owl-item').hasClass('cloned') == true )? '.owl-item:not(.cloned) a': 'a';
			$(this).magnificPopup({
				delegate: $delegate, // the selector for gallery item
				type: 'image',
				mainClass: 'mfp-img-mobile mfp-image-popup',
				image: {
					titleSrc: function(item) {
						return item.el.children('img').attr('alt');
					},
					verticalFit: true
				},
				gallery:{
					enabled:true,
					navigateByImgClick: false
				},
				zoom: {
					enabled: true, // By default it's false, so don't forget to enable it
					duration: 300, // duration of the effect, in milliseconds
					easing: 'ease-in-out' // CSS transition easing function 
				}
			})
		}

		// Maginfic popup video
		$.fn.custom_video_link_magnific_popup = function() {
			$(this).magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-iframe-mobile mfp-iframe-popup',
				iframe: {
				  markup: '<div class="mfp-iframe-scaler">'+
							'<div class="mfp-close"></div>'+
							'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
						  '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

				  patterns: {
					youtube: {
					  index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

					  id: 'v=', // String that splits URL in a two parts, second part should be %id%
					  // Or null - full URL will be returned
					  // Or a function that should return %id%, for example:
					  // id: function(url) { return 'parsed id'; }

					  src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
					},
					vimeo: {
					  index: 'vimeo.com/',
					  id: '/',
					  src: '//player.vimeo.com/video/%id%?autoplay=1'
					},

					// you may add here more sources

				  },

				  srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
				}
			})
		}

		// Agni Gallery	
		$.fn.agni_gallery = function(){
			var $gallery_container = $(this);
	        var $gallery_row = '.agni-gallery-row';
	        $gallery_container.imagesLoaded( function() {
	            if( $gallery_container.find($gallery_row).data('grid') == 'fitRows' ){
	                $gallery_container.find($gallery_row).isotope({
	                    itemSelector: '.agni-gallery-column',
	                    layoutMode: 'fitRows',
	                    fitRows: {
	                        columnWidth: '.grid-sizer',
	                    }
	                });
	            }
	            else if( $gallery_container.find($gallery_row).data('grid') == 'masonry' ){
	                $gallery_container.find($gallery_row).isotope({
	                    itemSelector: '.agni-gallery-column',
	                    layoutMode: 'masonry',
	                    masonry: {
	                        columnWidth: '.grid-sizer',
	                    }
	                });
	            }
	        });
	    }
		
		// Agni Portfolio function for isotope & filter
		$.fn.agni_portfolio = function(){
			var $portfolio_container = $(this);
			var $portfolio_row = '.portfolio-row:not(.carousel-portfolio)';
			$portfolio_container.imagesLoaded( { background: '.portfollio-thumbnail-bg' }, function() {
				if( $portfolio_container.find($portfolio_row).data('grid') == 'fitRows' ){
					$portfolio_container.find($portfolio_row).isotope({
						itemSelector: '.portfolio-column',
						layoutMode: 'fitRows',
						fitRows: {
							columnWidth: '.grid-sizer',
						}
					});
				}
				else if( $portfolio_container.find($portfolio_row).data('grid') == 'masonry' ){
					$portfolio_container.find($portfolio_row).isotope({
						itemSelector: '.portfolio-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: '.grid-sizer'
						}
					});
				}

				if( $portfolio_container.hasClass('has-infinite-scroll') == true ){
					var $portfolio_infinite_msgText = $portfolio_container.find('.load-more').data('msg-text');
					var $portfolio_infinite_finishedText = $portfolio_container.find('.load-more').data('finished-text');
					$portfolio_container.find($portfolio_row).infinitescroll({
					    loading: {
						    finished: undefined,
						    finishedMsg: $portfolio_infinite_finishedText+"<script type='text/javascript'> jQuery('.load-more span').hide(); </script>",
						                img: '',
						    msg: null,
						    msgText: $portfolio_infinite_msgText,
						    selector: '.load-more',
						    speed: 0,
						    start: undefined
						},
						extraScrollPx: 150,
						animate: true,
					    navSelector  : "div.portfolio-number-navigation",      // selector for the paged navigation (it will be hidden) 
					    nextSelector : "div.portfolio-number-navigation a:first",    // selector for the NEXT link (to page 2)
					    itemSelector : ".portfolio-container div.portfolio-column",   // selector for all items you'll retrieve
					},
					function ( newElements ) {
						var $newElems = jQuery( newElements ).css({ opacity: 0, 'visibility': 'visible' }); // hide to begin with
						// ensure that images load before adding to masonry layout
					  	$newElems.imagesLoaded( { background: '.portfollio-thumbnail-bg' }, function(){
						    $newElems.fadeIn().delay(40); // fade in when ready
						    // Height Recalculation on Infinite scroll
						    $portfolio_container.find($portfolio_row).each(function(){
								if($(this).data('gutter') > 0 && !$(this).hasClass('portfolio-no-gutter') && !$(this).hasClass('ignore-thumbnail-settings')){
									var $gutter = $(this).data('gutter');
									$(this).find('.portfolio-column').each(function(){
										if( $(window).width() > 767 && $(this).data('hardcrop') == true ){
											$(this).portfolio_thumbnail_height_detection($gutter);
											$(window).on('resize', function(){
												$('.portfolio-column').portfolio_thumbnail_height_detection($gutter)
											})
										}
									})
								}
							});
						    $portfolio_container.find($portfolio_row).isotope( 'appended', $newElems, true );


					    });
					});
					if( $portfolio_container.hasClass('has-load-more') == true ){
				        $(window).unbind('.infscr');
						$('.load-more span').on('click', function(i){
							$portfolio_container.find($portfolio_row).infinitescroll('retrieve');
							return false;
						})
					}
				}

			});
			// filter
			$('.filter a').on('click', function(e){
				$portfolio_container.find('.portfolio-column').removeClass('animate animated fadeInUp');
				e.preventDefault();
				$(this).addClass('active');
				$(this).parent().siblings().find('a').removeClass('active');

				var selector = $(this).attr('data-filter');
				$portfolio_container.find($portfolio_row).isotope({ filter: selector })
				$('.portfolio-column').each(function(){
		            if( !$(this).hasClass(selector.replace(".", ""))){
		                $(this).addClass('filterhide');
		            }
		            else{
		                $(this).removeClass('filterhide');
		            }

		        });
			});	
		}		

		// Agni Gallery call
        $('.agni-gallery').each(function(){
        	$(this).agni_gallery();
        })

		// Agni Portfolio call
        $('.portfolio-container').each(function(){
        	$(this).agni_portfolio();
        	//$(this).agni_portfolio();
        })

		//Circle bar
		$('.chart').each(function() {
			var $element = $(this);

			$element.waypoint(function() {
				$element.easyPieChart({
					barColor : $element.data('barcolor'),
					trackColor : $element.data('trackcolor'),
					scaleColor : $element.data('scalecolor'),
					easing: $element.data('animation'),
					scaleLength: $element.data('scalelength') ,
					lineCap: $element.data('linecap'),
					lineWidth: $element.data('linewidth'),
					size: $element.data('size'),
					onStep: function(from, to, percent) {
						$(this.el).find('.percent').text(Math.round(percent));
					}
				}); 
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});


		$('.progress-bar-animate').each(function() {
			var $element = $(this);

			$element.waypoint(function() {
				if( $element.attr('role') == 'progressbar' ){
					$element.css({'width':$element.attr( 'aria-valuenow' )+'%'});
				}
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});

		// Custom Slider	
		$('.custom-slider').each(function() {
			$(this).custom_slider();
		});

		// Carousel Gallery	
		$('.carousel-gallery').each(function() {
			$(this).carousel_gallery();
		});

		// Carousel Posts	
		$('.carousel-post').each(function() {
			$(this).carousel_post();
		});

		// Carousel Portfolio	
		$('.carousel-portfolio').each(function() {
			$(this).carousel_portfolio();
		});
		
		// carousel clients		
		$('.carousel-clients').each(function() {
			$(this).carousel_clients();
		});
		
		// bottom caption height detection
		$('.has-bottom-caption').each(function(){
			$(this).find(".member-caption-content").css("bottom", $(this).find('.member-bottom-caption').innerHeight() );
		}) 
		// carousel team	
		$('.carousel-team').each(function() {
			$(this).carousel_team();
		});		
		
		// carousel testimonials	
		$('.carousel-testimonials').each(function() {
			$(this).carousel_testimonials();
		});	

		// carousel Service box
		$('.carousel-service-box').each(function() {
			$(this).carousel_service_box();
		});

		// Magnific Popup Image
		$('.custom-image').each(function() {
			$(this).custom_image_magnific_popup();
		});

		// Magnific Popup Gallery
		$('.custom-gallery').each(function() {
			$(this).custom_gallery_magnific_popup();
		});

		// Magnific Popup Image
		$('.custom-video-link a').each(function() {
			$(this).custom_video_link_magnific_popup();
		});

		// Magnific Popup Portfolio Attachment
		$('.page-portfolio').each(function(){
			// Magnific popup portfolio attachment
			$(this).portfolio_attachment_magnific_popup();	
		});

		// sharing popup
		$('.post-sharing-buttons, .portfolio-sharing-buttons').each(function(){
			$(this).post_sharing_buttons();		
		});
		
		// portfolio sticky conent
		if( $('.portfolio-single-content').hasClass('has-fixed-single-content') && $(window).width() > 767 ){
			var $this = $('.portfolio-single-content .portfolio-single-content-inner');
			$this.imagesLoaded( function() {
				$this.sticky({ topSpacing: 100, bottomSpacing: 360, responsiveWidth: true });
			});
		}

		$.fn.portfolio_thumbnail_height_detection = function($gutter){
			$(this).each(function(){
				function gcd (a, b) {
	            	return (b == 0) ? a : gcd (b, a%b);
		        }

				var $actual_width = $(this).data('thumbnail-width'); 
				var $actual_height = $(this).data('thumbnail-height');
				var $bottom_caption_height = $(this).find('.portfolio-bottom-caption').innerHeight();
				var $desired_width = $(this).width();

		        var r = gcd ($actual_width, $actual_height);
		        
				if( $(this).hasClass('width2x') ){
					$desired_width = $desired_width-$gutter;
				}
				else if( $(this).hasClass('width3x') ){
					$desired_width = $desired_width-($gutter*2);
				}
				else{
					$desired_width = $desired_width;
				}

		        var $thumbnail_height = Math.round($desired_width*($actual_height/r)/($actual_width/r));
		        if($(this).hasClass('height2x')){
		        	$thumbnail_height = $thumbnail_height+$gutter+$bottom_caption_height;
		        }
		        else if( $(this).hasClass('height3x') ){
		        	$thumbnail_height = $thumbnail_height+($gutter*2)+($bottom_caption_height*2);
		        }

				$(this).find('.portfolio-thumbnail').css({'height':$thumbnail_height});
			})
			
		}

		// Portfolio thumbnail height & Gutter corrections
		$('.portfolio-container .portfolio-row:not(.ignore-thumbnail-settings)').each(function(){
			if($(this).data('gutter') > 0 && !$(this).hasClass('portfolio-no-gutter')){
				var $gutter = $(this).data('gutter');
				$(this).find('.portfolio-column').each(function(){
					if( $(window).width() > 767 && $(this).data('hardcrop') == true ){
						$(this).portfolio_thumbnail_height_detection($gutter);
						$(window).on('resize', function(){
							$('.portfolio-column').portfolio_thumbnail_height_detection($gutter)
						})
					}
					
				})
			}
			
		});
		
		// Blog Masonry
		var $blog_container = $('.blog-column:not(.carousel-blog-column)');
		$blog_container.find('.site-main').imagesLoaded( function() {
			if( $blog_container.data('blog-grid') == 'fitRows' ){
				$blog_container.find('.site-main').isotope({
					itemSelector: 'article',
					layoutMode: 'fitRows',
					fitRows: {
						columnWidth: '.grid-sizer',
					}
				});
			}
			else if( $blog_container.data('blog-grid') == 'masonry' ){
				$blog_container.find('.site-main').isotope({
					itemSelector: 'article',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.grid-sizer',
					}
				});
			}

			if( $('.blog-row').hasClass('has-infinite-scroll') == true ){
				var $blog_infinite_msgText = $('.blog-row').find('.load-more').data('msg-text');
				var $blog_infinite_finishedText = $('.blog-row').find('.load-more').data('finished-text');
				$blog_container.find('.site-main').infinitescroll({
				   loading: {
					    finished: undefined,
					    finishedMsg: $blog_infinite_finishedText+"<script type='text/javascript'> jQuery('.load-more span').hide(); </script>",
					                img: '',
					    msg: null,
					    msgText: $blog_infinite_msgText,
					    selector: '.load-more',
					    speed: 0,
					    start: undefined
					},
					extraScrollPx: 150,
					animate: true,
				    navSelector  : "div.post-number-navigation",      // selector for the paged navigation (it will be hidden) 
				    nextSelector : "div.post-number-navigation a:first",    // selector for the NEXT link (to page 2)
				    itemSelector : ".blog-row .site-main article",   // selector for all items you'll retrieve
				},
				function ( newElements ) {
					var $newElems = jQuery( newElements ).css({ opacity: 0, visibility: 'visible' }); // hide to begin with
					// ensure that images load before adding to masonry layout
					$newElems.imagesLoaded(function(){
					    $newElems.fadeIn().delay(40).css({ opacity: 1, visibility: 'visible' }); // fade in when ready
					    $blog_container.find('.site-main').isotope( 'appended', $newElems, true );
					});

				});

				if( $('.blog-row').hasClass('has-load-more') == true ){
			        $(window).unbind('.infscr');
					$('.load-more span').on('click', function(i){
						$blog_container.find('.site-main').infinitescroll('retrieve');
						return false;
					})
				}
			}
		});

		// Column BG 
		$.fn.agni_column_edge_calculation = function(){
			$(this).each(function(){
				var $this = $(this);
				var $elm_width = $this.width();
				var $left_offset = $this.offset().left;
				var $right_offset = ($(window).width() - ($this.offset().left + $this.outerWidth()));
				if( $(window).width() > 767 ){
					if( $this.data('bg-edge') == 'left' ){
						$this.find('.section-column-bg, .section-column-bg-overlay').css({
							"width": $elm_width + $left_offset,
							'transform': 'translateX(-'+$left_offset+'px)',
						});
					}
					else if( $this.data('bg-edge') == 'right' ){
						$this.find('.section-column-bg, .section-column-bg-overlay').css({
							"width": $elm_width + $right_offset,
						});
					}	
				}
			})
		}

		// Column BG 
		$('.section-column-bg-container.has-bg-edge').agni_column_edge_calculation();
		$(window).on('resize', function(){
			$('.section-column-bg-container.has-bg-edge').agni_column_edge_calculation();
		})
		
		// Empty Space
		$('.agni_empty_space').custom_height_calc();
		$(window).on('resize', function(){
			$('.agni_empty_space').custom_height_calc();
		})

		// Icon 
		$('.icon-has-border.hover-icon-has-background').hover(function(){
			$(this).parents('.agni-icon').removeClass('icon-background-transparent');
		},function(){
			$(this).parents('.agni-icon').addClass('icon-background-transparent');
		})

		$('.agni-icon.has-svg').each(function(){
			var $icon_id = $(this).find('.agni-svg-icon').attr('id');
			var $icon_type = $(this).find('.agni-svg-icon').data('type');
			//var $icon_duration = $(this).find('.agni-svg-icon').data('duration');
			//var $icon_path_fn = $(this).find('.agni-svg-icon').data('path-fn');
			//var $icon_ani_fn = $(this).find('.agni-svg-icon').data('ani-fn');
			//var $icon_delay = $(this).find('.agni-svg-icon').data('ani-fn');
			//var $icon_ani_fn = $(this).find('.agni-svg-icon').data('ani-fn');
			var $icon_file = $(this).find('.agni-svg-icon').data('file');
			new Vivus( $icon_id, {type: 'delayed', file: $icon_file, delayStart: 300, duration: 150, pathTimingFunction: Vivus.EASE_OUT });
		})

		// coming soon countdown
		$('.countdown').each(function () { 
			// Coming Soon
			var $date = $(this).data( 'counter' );		
			var $label = $(this).data( 'label' );	
			$(this).countdown({
				date: $date, // add the countdown's end date (i.e. 3 november 2012 12:00:00)
				format: "on", // on (03:07:52) | off (3:7:52) - two_digits set to ON maintains layout consistency
				label: $label // add the countdown's label (i.e Day|Days|Hour|Hours|Minute|Minutes|Second|Seconds)
			});
		}); 

		// Waypoint Animation
		$('.animate').each(function() {
			var $element = $(this);

			$element.waypoint(function() {
				$element.addClass($element.data('animation') + ' animated').css('visibility', 'visible').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			      $(this).removeClass($element.data('animation') + ' animated');
			    });
				this.destroy();
			}, {
				offset: $element.data('animation-offset')
			});
		});
		
		$.fn.initializeMap = function(lat, lang, desc, lat_2, lang_2, desc_2, showImage, imageTitle, divId, mapstyle, mapcolor, mapdrag, mapzoom) {
			switch( mapstyle ){
				case '2' :
					var styles = [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}];
					break;
				case '3' :
					var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":mapcolor},{"visibility":"on"}]}];
					break;
				case '4' :
					var styles = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]; 
					break;
				default :
					var styles = [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}];
			}
			
			var locations = [
				[desc, lat,lang],
				[desc_2, lat_2, lang_2],
			];

			var map = new google.maps.Map(document.getElementById(divId), {
				zoom: mapzoom,
				center: new google.maps.LatLng(lat,lang),
				mapTypeControl: false,
				scrollwheel: false,
				draggable: mapdrag,
				mapTypeControlOptions: {  
					mapTypeIds: ['Styled']  
				},    
				navigationControl: true,
				navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
				mapTypeId: 'Styled', 
			});
			var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });  
			map.mapTypes.set('Styled', styledMapType);

			var infowindow = new google.maps.InfoWindow();

			var markerIcon = new google.maps.MarkerImage(showImage,
				new google.maps.Size(48,48),
				new google.maps.Point(0,0)
			);
			var marker, i;

			for (i = 0; i < locations.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					icon: markerIcon,
					title:imageTitle,
					zIndex: 3
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}
		}

		// google map
		$('.map-canvas').each(function(){
			var $element = $(this);
			var mapstyle = $element.attr( 'data-map-style' );
			var mapcolor = $element.attr( 'data-map-accent-color' );
			var mapdrag = ((/Android|iPhone|iPad|iPod|BlackBerry/i).test(navigator.userAgent || navigator.vendor || window.opera) && $element.attr( 'data-map-drag' ) == '1')?false:true;
			var mapzoom = $element.data( 'map-zoom' );
			var template_url = $element.attr( 'data-dir' );
			var map_icon = $element.attr( 'data-map' );
			var get_id = $element.attr( 'id' );
		
			var lat= $element.attr( 'data-lat' );   // Latitude of location
			var lang= $element.attr( 'data-lng' );  // Longitude  of location
			var desc='<div>'+
						  '<h6>'+$element.attr( 'data-add1' )+'</h6>'+
						  '<p>'+$element.attr( 'data-add2' )+'</p>'+
						  '<p>'+$element.attr( 'data-add3' )+'</p>'+
					 '</div>';

			var get_lat_2 = $element.attr( 'data-lat-2' );
			var get_lng_2 = $element.attr( 'data-lng-2' );
			var get_add1_2 = $element.attr( 'data-add1-2' );
			var get_add2_2 = $element.attr( 'data-add2-2' );
			var get_add3_2 = $element.attr( 'data-add3-2' );
			var lat_2=get_lat_2;   // Latitude of location
			var lang_2=get_lng_2;  // Longitude  of location
			var desc_2='<div>'+
						  '<h6>'+get_add1_2+'</h6>'+
						  '<p>'+get_add2_2+'</p>'+
						  '<p>'+get_add3_2+'</p>'+
					 '</div>';
			var showImage= map_icon; //template_url+'/img/marker.png';
			var imageTitle= $element.attr( 'data-add1' );
			var divId= get_id;			
			$element.initializeMap(lat, lang, desc, lat_2, lang_2, desc_2, showImage, imageTitle, divId, mapstyle, mapcolor, mapdrag, mapzoom);
		})
		
	});

})(jQuery);
