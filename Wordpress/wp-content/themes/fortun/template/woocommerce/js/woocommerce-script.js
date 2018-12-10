// JavaScript Document

(function($) {
  "use strict";
	
	$(document).ready(function(){
		
		// Woocommerce ordering
		$('.woocommerce-ordering').each(function() {
			$(this).find('.dropdown-menu a').click(function(w){
				w.preventDefault();

				var $id = $(this).attr('href').replace('#', '');
				$('select[name="orderby"] option').each(function(i, el) {
					$(el).prop('selected', false);
					if($(el).val() == $id) {
						$(el).prop('selected', true);
					}
				});
				$('.woocommerce-ordering').submit();
			});
		});

		// Shop Carousel
		$('.carousel-products').each(function(){
			$(this).owlCarousel({
				//margin: $(this).data('gutter'),
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
		});

		// Woocommerce Isotope
		var $shop_container = $('.products:not(".related, .upsells, .carousel-products")');
		$shop_container.imagesLoaded( function() {
			if( $shop_container.data('shop-grid') == 'fitRows' ){
				$shop_container.isotope({
					itemSelector: '.shop-column',
					layoutMode: 'fitRows',
					fitRows: {
						columnWidth: '.shop-column',
					}
				});
			}
			else if( $shop_container.data('shop-grid') == 'masonry' ){
				var $colwidth = $('.shop-column' )[0].getBoundingClientRect().width;
				$shop_container.isotope({
					itemSelector: '.shop-column',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: $colwidth,
					}
				});
				$(window).on('resize', function(){
					var $colwidth = $('.shop-column' )[0].getBoundingClientRect().width;
					$shop_container.isotope({
						itemSelector: '.shop-column',
						layoutMode: 'masonry',
						masonry: {
							columnWidth: $colwidth,
						}
					});
				});
			}

			if( $('.shop-row .site-main').hasClass('has-infinite-scroll') == true ){
				var $shop_infinite_msgText = $('.shop-row .site-main').find('.load-more').data('msg-text');
				var $shop_infinite_finishedText = $('.shop-row .site-main').find('.load-more').data('finished-text');
				$shop_container.infinitescroll({
				   loading: {
					    finished: undefined,
					    finishedMsg: $shop_infinite_finishedText+"<script type='text/javascript'> jQuery('.load-more span').hide(); </script>",
					                img: '',
					    msg: null,
					    msgText: $shop_infinite_msgText,
					    selector: '.load-more',
					    speed: 0,
					    start: undefined
					},
					//extraScrollPx: 70,
					//animate: true,
				    navSelector  : "div.woocommerce-pagination",      // selector for the paged navigation (it will be hidden) 
				    nextSelector : "div.woocommerce-pagination a:first",    // selector for the NEXT link (to page 2)
				    itemSelector : ".products .shop-column",   // selector for all items you'll retrieve
				},
				function ( newElements ) {
					var $newElems = jQuery( newElements ).css({ opacity: 0, visibility: 'visible' }); // hide to begin with
					// ensure that images load before adding to masonry layout
					$newElems.imagesLoaded(function(){
					    $newElems.fadeIn().delay(40); // fade in when ready
					    $shop_container.isotope( 'appended', $newElems, true );
					});

				});

				if( $('.shop-row .site-main').hasClass('has-load-more') == true ){
			        $(window).unbind('.infscr');
					$('.load-more span').on('click', function(i){
						$shop_container.infinitescroll('retrieve');
						return false;
					})
				}
			}
		});

		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});
		
	});

	/*jQuery( document ).ready( function($){
	    var update_wishlist_count = function() {
	        $.ajax({
	            beforeSend: function () {

	            },
	            complete  : function () {

	            },
	            data      : {
	                action: 'update_wishlist_count'
	            },
	            success   : function (data) {

	                console.log( data );
	                $('.wishlist-url').find('span:first-child').html( data );
	                //do something
	            },

	            url: yith_wcwl_l10n.ajax_url
	        });
	    };

	    $('body').on( 'added_to_wishlist removed_from_wishlist', update_wishlist_count );
	} );*/


})(jQuery);
