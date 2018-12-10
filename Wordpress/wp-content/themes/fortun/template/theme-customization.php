<?php 

function fortun_options(){
	global $fortun_options;	
	
	wp_enqueue_style( 'fortun-custom-styles', AGNI_FRAMEWORK_CSS_URL . '/custom.css' );

	$style = '';
	if( $fortun_options['loader'] == '1' ){
		if( $fortun_options['loader-style'] == '1' ){
			$style .= 'body:not(.vc_editor){
					display: none;
				}';
		}
	}
	else{
		$style .= 'body{
				visibility: hidden;
			}';
	}
		
	if( $fortun_options['layout-container'] == '1' ){
		$style .= '/* Container */
		@media (min-width:768px) {
			.container {
				width: '.$fortun_options['layout-container-768'].'px;
			}
			.boxed{
				width: '.$fortun_options['layout-boxed-768'].'px;
			}
		}
		@media (min-width:992px) {
			.container, .container .megamenu .sub-menu {
				width: '.$fortun_options['layout-container-992'].'px;
			}
			.boxed{
				width: '.$fortun_options['layout-boxed-992'].'px;
			}
		}
		@media (min-width:1200px) {
			.container, .container .megamenu .sub-menu {
				width: '.$fortun_options['layout-container-1200'].'px;
			}
			.boxed{
				width: '.$fortun_options['layout-boxed-1200'].'px;
			}
		}
		@media (min-width:1500px) {
			.container, .container .megamenu .sub-menu{
				width: '.$fortun_options['layout-container-1500'].'px;
			}
			.boxed{
				width: '.$fortun_options['layout-boxed-1500'].'px;
			}
		}';
	}

	if( $fortun_options['custom-logo-height'] == '1' ){
		$custom_height = esc_attr( $fortun_options['custom-logo-height-value'] );
		$nav_menu_line_height = ($custom_height - 34) + 80;
		$header_icon_margin = ($custom_height - 34)/2 + 24;
		$header_toggle_menu_padding = ($custom_height - 34)/2 + 15;

		$style .= '.header-icon img{
				max-height:'.$custom_height.'px;
				height:'.$custom_height.'px;
			}
			@media (max-width: 767px) {	
				.header-icon img {
					max-height:28px;
				}
			}';
		if( $fortun_options['header-menu-style'] == 'default-header-menu' || $fortun_options['header-menu-style'] == 'minimal-header-menu' ){
			$style .= '.nav-menu{
					line-height: '.$nav_menu_line_height.'px;
				}
				.header-menu-icons{
					margin: '.$header_icon_margin.'px 0px;
				}
				.toggle-nav-menu{
					padding: '.$header_toggle_menu_padding.'px 0px;
				}
				@media (max-width: 767px) {	
					.header-menu-icons{
						margin:14px 0;
					}
					.toggle-nav-menu{
						padding: 12px 0px;
					}
				}';
		}
	}

	$style .= '/* Fortun Custom CSS */
		body{
			font-size: '.$fortun_options['font-3-fontsize'].'px;
			line-height: '.$fortun_options['font-3-lineheight'].';
			text-transform: '.$fortun_options['font-3-text-transform'].';
		}
		h1, .h1{
			font-size: '.$fortun_options['font-h1-fontsize'].'px;
		}
		h2, .h2{
			font-size: '.$fortun_options['font-h2-fontsize'].'px;
		}
		h3, .h3{
			font-size: '.$fortun_options['font-h3-fontsize'].'px;
		}
		h4, .h4{
			font-size: '.$fortun_options['font-h4-fontsize'].'px;
		}
		h5, .h5{
			font-size: '.$fortun_options['font-h5-fontsize'].'px;
		}
		h6, .h6{
			font-size: '.$fortun_options['font-h6-fontsize'].'px;
		}
		ul.nav-menu-content >li, div.nav-menu-content ul > li, ul.nav-menu-content >li >a, div.nav-menu-content ul > li > a{
			font-size: '.$fortun_options['header-fontsize'].'px;
		}
		.nav-menu a, .tab-nav-menu a{
			text-transform: '.$fortun_options['header-text-transform'].';
		}
		.burg-text{
			color: '.$fortun_options['header-minimal-menu-color'].';
		}
		@media (max-width: 1199px) {
			.header-navigation-menu.strip-header-menu{
				background-color: '.(!empty($fortun_options['header-strip-bg-color-1']['rgba'])?$fortun_options['header-strip-bg-color-1']['rgba']:'').';
			}
		}
		@media (min-width: 1200px) {
			.strip-header-menu .activeBurg.burg:before, .strip-header-menu .activeBurg.burg:after{
				background-color: '.$fortun_options['header-minimal-menu-color'].';
			}
			.strip-header-menu.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .strip-header-menu.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
				background-color: '.$fortun_options['header-minimal-menu-color-2'].';
			}
		}
		.header-sticky.top-sticky .toggle-nav-menu-additional .burg-text{
			color: '.$fortun_options['header-minimal-menu-color-2'].';
		}
		
		h1, h2, h3, h4, h5, h6,.h1,.h2,.h3,.h4,.h5,.h6, .primary-typo, .vc_tta-title-text{
			line-height: '.$fortun_options['font-1-lineheight'].';
			text-transform: '.$fortun_options['font-1-text-transform'].';
		}
		.section-sub-heading-text, .additional-typo{
			line-height: '.$fortun_options['font-2-lineheight'].';
			text-transform: '.$fortun_options['font-2-text-transform'].';
		}

		.has-menu-button ul.nav-menu-content >li:last-child >a, .has-menu-button div.nav-menu-content >ul >li:last-child >a{
			font-size: '.$fortun_options['header-menu-button-fontsize'].'px;
		}
		.has-menu-button ul.nav-menu-content >li:last-child >a, .has-menu-button div.nav-menu-content >ul >li:last-child >a{
			color: '.$fortun_options['header-menu-button-color'].' !important;
		}

		.special-typo{
			line-height: '.$fortun_options['font-4-lineheight'].';
			text-transform: '.$fortun_options['font-4-text-transform'].';
		}

		.preloader-style-2 .cssload-loader:before{
			border-color: '.$fortun_options['loader-bg-color'].';
		}

		/* Fortun Custom Colors */
		blockquote{
			border-color: '.$fortun_options['color-1'].';
		}

		/* Buttons */
		.btn-default, input.btn-default {
			color: #fff;
			background-color: '.$fortun_options['color-3'].';
			border-color: '.$fortun_options['color-3'].';
		}
		.btn-default:hover, input.btn-default:hover {
			color: '.$fortun_options['color-3'].';
			background-color: transparent;
			border-color: '.$fortun_options['color-3'].';
		}
		.btn-primary, input.btn-primary {
			color: #fff;
			background-color: '.$fortun_options['color-2'].';
			border-color: '.$fortun_options['color-2'].';
		}
		.btn-primary:hover, input.btn-primary:hover{
			color: '.$fortun_options['color-2'].';
			background-color: transparent;
			border-color: '.$fortun_options['color-2'].';
		}
		.btn-accent, input.btn-accent {
			color: #fff;
			background-color: '.$fortun_options['color-1'].';
			border-color: '.$fortun_options['color-1'].';
		}
		.btn-accent:hover, input.btn-accent:hover {
			color: '.$fortun_options['color-1'].';
			background-color: transparent;
			border-color: '.$fortun_options['color-1'].';
		}
		.btn-alt, .btn-alt:focus, .btn-alt:hover, input.btn-alt, input.btn-alt:focus, input.btn-alt:hover {
			background-color: transparent;
		}
		.btn-default.btn-alt, input.btn-default.btn-alt {
			color: '.$fortun_options['color-3'].';
			border-color: '.$fortun_options['color-3'].';
		}
		.btn-primary.btn-alt, input.btn-primary.btn-alt {
			color: '.$fortun_options['color-2'].';
			border-color: '.$fortun_options['color-2'].';
		}
		.btn-accent.btn-alt, input.btn-accent.btn-alt {
			color: '.$fortun_options['color-1'].';
			border-color: '.$fortun_options['color-1'].';
		}
		.btn-default.btn-alt:hover, input.btn-default.btn-alt:hover {
			background-color: '.$fortun_options['color-3'].';
			color: #fff;
			border-color: '.$fortun_options['color-3'].';
		}
		.btn-primary.btn-alt:hover, input.btn-primary.btn-alt:hover {
			background-color: '.$fortun_options['color-2'].';
			color: #fff;
			border-color: '.$fortun_options['color-2'].';
		}
		.btn-accent.btn-alt:hover, input.btn-accent.btn-alt:hover {
			background-color: '.$fortun_options['color-1'].';
			color: #fff;
			border-color: '.$fortun_options['color-1'].';
		}
		.btn-link {
			color: '.$fortun_options['color-2'].';
			border-color: transparent;
		}
		.btn-link:hover {
			border-color: '.$fortun_options['color-2'].';
		}
		
		/* Custom colors */
		.additional-nav-menu a:hover, .nav-menu-content li a:hover, .nav-menu-content li a:active, .nav-menu-content li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li.current-menu-item:not(.current_page_item) > a:hover, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a:hover, .tab-nav-menu a:hover, .header-toggle ul a:hover, .post-author a, .post-sharing-buttons a:hover, .widget_fortun_social_icons a:hover, .sidebar .widget-title, .filter a:hover, .filter a:focus, .filter a.active, .section-heading-icon, .agni_custom_heading i{
			color: '.$fortun_options['color-1'].';
		}
		.nav-menu-content li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a, .nav-menu-content li.current-menu-item:not(.current_page_item) > a:hover, .nav-menu-content li ul li.current-menu-item:not(.current_page_item) > a:hover{
			color: '.$fortun_options['header-menu-link-color-1']['hover'].';
		}
		.nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a {
		    color:'.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.nav-menu-content .current_page_ancestor .current-menu-item:not(.current_page_item) > a:hover {
			color:'.$fortun_options['header-menu-link-color-1']['hover'].';
		}

		.sticky:before, .owl-dot.active span, .page-numbers li span:not(.dots), .blog-single-post .tags-links a, .pricing-style-1 .pricing-title, #jpreBar{
			background-color: '.$fortun_options['color-1'].';
		}
		.owl-dot span, #fp-nav ul li a.active span,
#fp-nav ul li:hover a.active span, #multiscroll-nav li .active span, .slides-pagination a.current, .entry-title:after, .page-numbers li span:not(.dots), .widget_fortun_social_icons a:hover, .sidebar .widget-title, .member-meta, .milestone-style-1  .mile-count h3:after, .feature-box-title:after{
			border-color: '.$fortun_options['color-1'].';
		}

		input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea, a, .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6, .h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, .h4 .small, .h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small, h4 .small, h4 small, h5 .small, h5 small, h6 .small, h6 small, .toggle-nav-menu, .slides-navigation a, .portfolio-navigation-container .post-navigation a, .footer-bar .textwidget i{
			color: '.$fortun_options['color-2'].';
		}
		.nav-tabs-style-3 .nav-tabs li.active, .divide-line span, .accordion-style-3 .panel-title:not(.collapsed){
			background-color: '.$fortun_options['color-2'].';
		}
		.nav-tabs-style-1 .nav-tabs li.active a, .nav-tabs li a:hover, .nav-tabs li a:focus, .nav-tabs-style-2 .nav-tabs li.active, .accordion-style-1 .panel-title, .accordion-style-1 .panel-title.collapsed:hover, .accordion-style-1 .panel-title.collapsed:focus, .accordion-style-3 .panel-title:not(.collapsed){
			border-color: '.$fortun_options['color-2'].';
		}

		body, .post-sharing-buttons a, .widget_fortun_instagram_feed .follow-link{
			color: '.$fortun_options['color-3'].';
		}
		.widget_fortun_instagram_feed .follow-link{
			border-color: '.$fortun_options['color-3'].';
		}

		/* General & Contact form buttons */
		.btn-default {
			background-color: '.$fortun_options['color-3'].';
			border-color: '.$fortun_options['color-3'].';
		}
		.btn-default:hover {
			color: '.$fortun_options['color-3'].';
			background-color: transparent;
		}
		.btn-primary {
			background-color: '.$fortun_options['color-2'].';
			border-color: '.$fortun_options['color-2'].';
		}
		.btn-primary:hover {
			color: '.$fortun_options['color-2'].';
			background-color: transparent;
		}
		.btn-accent {
			background-color: '.$fortun_options['color-1'].';
			border-color: '.$fortun_options['color-1'].';
		}
		.btn-accent:hover {
			color: '.$fortun_options['color-1'].';
			background-color: transparent;
		}
		.btn-alt, .btn-alt:focus, .btn-alt:hover {
			background-color: transparent;
		}
		.btn-default.btn-alt {
			color: '.$fortun_options['color-3'].';
		}
		.btn-primary.btn-alt {
			color: '.$fortun_options['color-2'].';
		}
		.btn-accent.btn-alt {
			color: '.$fortun_options['color-1'].';
		}
		.btn-default.btn-alt:hover {
			background-color: '.$fortun_options['color-3'].';
			color: #fff;
		}
		.btn-primary.btn-alt:hover {
			background-color: '.$fortun_options['color-2'].';
			color: #fff;
		}
		.btn-accent.btn-alt:hover {
			background-color: '.$fortun_options['color-1'].';
			color: #fff;
		}
		.btn-link {
			color: '.$fortun_options['color-2'].';
			border-color: transparent;
		}
		.btn-link:hover {
			border-color: '.$fortun_options['color-2'].';
		}

		.has-padding, .has-padding .top-padding, .has-padding .bottom-padding, .has-padding .header-sticky, .has-padding .header-top-bar, .has-padding .header-navigation-menu{
			border-width: '.$fortun_options['layout-padding-size']['border-top'].';
		}
		@media (max-width:767px) {
			.has-padding, .has-padding .top-padding, .has-padding .bottom-padding{
				border-width: 0;
			}
		}
		@media (min-width:1200px) {
			.has-padding .side-header-menu{
				margin-left: '.$fortun_options['layout-padding-size']['border-top'].';
				margin-top: '.$fortun_options['layout-padding-size']['border-top'].';
				bottom: '.$fortun_options['layout-padding-size']['border-top'].';
			}
		}
		@media (min-width:768px) {
			.has-padding .mfp-main .mfp-container{
				border-width: '.$fortun_options['layout-padding-size']['border-top'].';
			}
		}
		.has-padding, .has-padding .top-padding, .has-padding .bottom-padding, .has-padding .header-top-bar, .has-padding .header-navigation-menu, .has-padding .mfp-main .mfp-container{
			border-color: '.$fortun_options['layout-padding-size']['border-color'].';
		}

		.toggle-circled{
		    border-color: '.$fortun_options['header-icon-link-color-1']['regular'].';
		}
		.header-social a, .header-toggle a, .header-toggle span{
		    color: '.$fortun_options['header-icon-link-color-1']['regular'].';
		}
		.header-toggle ul a:hover{
		    color: '.$fortun_options['header-icon-link-color-1']['hover'].';
		}
		.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .toggle-circled{
		    border-color: '.$fortun_options['header-icon-link-color-2']['regular'].';
		}
		.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-social a, .header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle a, .header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle span{
		    color: '.$fortun_options['header-icon-link-color-2']['regular'].';
		}
		.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle ul a:hover{
		    color: '.$fortun_options['header-icon-link-color-2']['hover'].';
		}
		
		.toggle-nav-menu{
			color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.header-sticky.top-sticky .toggle-nav-menu.toggle-nav-menu-additional{
			color: '.$fortun_options['header-menu-link-color-2']['regular'].';
		}
		/*.burg-text{
			color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}*/
		.burg, .burg:before, .burg:after{
			background-color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.activeBurg{
			background-color: transparent !important;
		}

		.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .burg:after{
			background-color: '.$fortun_options['header-menu-link-color-2']['regular'].';
		}
		.activeBurg.burg, .activeBurg.burg:before, .activeBurg.burg:after{
			background-color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
			background-color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.header-navigation-menu .header-menu-content, .side-header-menu .tab-nav-menu, .reverse_skin.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .reverse_skin.header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu{
			border-left:0;
			border-right:0;
			border-top: '    . $fortun_options['header-menu-border-1']['border-top'].';
			border-bottom: ' . $fortun_options['header-menu-border-1']['border-bottom'].';
			border-style: '  . $fortun_options['header-menu-border-1']['border-style'].';
		}
		.header-sticky.top-sticky.header-navigation-menu.header-menu-border-additional:not(.side-header-menu) .header-menu-content, .header-sticky.top-sticky.side-header-menu.header-menu-border-additional:not(.side-header-menu) .tab-nav-menu, .reverse_skin.header-navigation-menu .header-menu-content, .reverse_skin.side-header-menu .tab-nav-menu{
			border-top: '    . $fortun_options['header-menu-border-2']['border-top'].';
			border-bottom: ' . $fortun_options['header-menu-border-2']['border-bottom'].';
			border-style: '  . $fortun_options['header-menu-border-2']['border-style'].';
		}
		
		
		/* Reverse Skin */
		.reverse_skin .toggle-circled{
		    border-color: '.$fortun_options['header-icon-link-color-2']['regular'].';
		}
		.reverse_skin .header-social a, .reverse_skin .header-toggle a, .reverse_skin .header-toggle span{
		    color: '.$fortun_options['header-icon-link-color-2']['regular'].';
		}
		.reverse_skin .header-toggle ul a:hover{
		    color: '.$fortun_options['header-icon-link-color-2']['hover'].';
		}
		.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .toggle-circled{
		    border-color: '.$fortun_options['header-icon-link-color-1']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-social a, .reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle a, .reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle span{
		    color: '.$fortun_options['header-icon-link-color-1']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky:not(.side-header-menu) .header-menu-icons-additional-color .header-toggle ul a:hover{
		    color: '.$fortun_options['header-icon-link-color-1']['hover'].';
		}
		
		.reverse_skin .toggle-nav-menu{
			color: '.$fortun_options['header-menu-link-color-2']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky .toggle-nav-menu.toggle-nav-menu-additional{
			color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.reverse_skin .burg, .reverse_skin .burg:before, .reverse_skin .burg:after{
			background-color: '.$fortun_options['header-menu-link-color-2']['regular'].';
		}

		.reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg:before, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .burg:after{
			background-color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.reverse_skin .activeBurg.burg, .reverse_skin .activeBurg.burg:before, .reverse_skin .activeBurg.burg:after{
			background-color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}
		.reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:before, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg:after{
			background-color: '.$fortun_options['header-menu-link-color-1']['regular'].';
		}

		.footer-social .circled{
			color: '.$fortun_options['footer-social-link-color']['regular'].';
		}
		.footer-social a, .footer-social .circled{
			color: '.$fortun_options['footer-social-link-color']['regular'].';
		}
		.footer-social .circled{
			border-color: '.$fortun_options['footer-social-link-color']['regular'].';
		}
		.footer-social a:hover, .footer-social .circled:hover{
			color: '.$fortun_options['footer-social-link-color']['hover'].';
		}
		.footer-social .circled:hover{
			border-color: '.$fortun_options['footer-social-link-color']['hover'].';
		}
		.activeBurg.burg, .header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg, .reverse_skin .activeBurg.burg, .reverse_skin.header-sticky.top-sticky .toggle-nav-menu-additional .activeBurg.burg{
			background-color: transparent;
		}
		.portfolio-navigation-container .post-navigation a {
		    background-color: transparent;
		}';

	// Woocommerce
	if( class_exists('WooCommerce') ){
		$style .= '.woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.loading, .woocommerce .sidebar .widget_shopping_cart .buttons a:hover, .woocommerce .star-rating:before, .woocommerce .star-rating span:before, .woocommerce #comments .star-rating span:before, .woocommerce p.stars a.star-1:after, .woocommerce p.stars a.star-2:after, .woocommerce p.stars a.star-3:after, .woocommerce p.stars a.star-4:after, .woocommerce p.stars a.star-5:after, .woocommerce-shipping-calculator .shipping-calculator-button{
				color: '.$fortun_options['color-1'].';
			}
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.added, .woocommerce-dropdown-list li.active a, .woocommerce .sidebar .widget_shopping_cart .buttons a, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a:hover, .woocommerce .login input[type="submit"], .woocommerce-checkout-payment .place-order input[type="submit"]:hover, .header-cart-toggle .product-count, .header-cart-toggle .buttons a{
				background-color: '.$fortun_options['color-1'].';
			}
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.loading, .woocommerce .sidebar .widget_shopping_cart .buttons a, .woocommerce .products .product-add-to-cart .product-add-to-cart-button a.add_to_cart_button.product_type_simple.added{
				border-color: '.$fortun_options['color-1'].';
			}
			.woocommerce .price > .amount, .woocommerce .price ins{
				color: '.$fortun_options['color-2'].';
			}
			.woocommerce .products .product .onsale, .woocommerce .widget_price_filter .price_slider_amount .button, .single-product-page .single-product-images .onsale, .single-product-page .single-product-description button, .woocommerce .page-cart-summary .shop_table input[type="submit"], .woocommerce .page-cart-calculation .cart-collaterals .wc-proceed-to-checkout a, .woocommerce-checkout-payment .place-order input[type="submit"], .woocommerce .track_order input[type="submit"]{
				background-color: '.$fortun_options['color-2'].';
				border-color: '.$fortun_options['color-2'].';
			}
			.single-product-page .single-product-page .single-product-description button:hover, .woocommerce .track_order input[type="submit"]:hover{
				background-color: transparent;
				color: '.$fortun_options['color-2'].';
			}
			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a, .single-product-page .single-product-description button{
				border-color: '.$fortun_options['color-2'].';
				//background-color: transparent;
				color: '.$fortun_options['color-2'].';
			}

			.woocommerce .products .product-add-to-cart .product-add-to-cart-button a:hover{
				background-color: '.$fortun_options['color-2'].';
				color: #fff;
			}
			.single-product-page .single-product-description button{
				border-color: '.$fortun_options['color-2'].';
				color: #fff;
				background-color: '.$fortun_options['color-2'].';
			}
			.single-product-page .single-product-description button:hover{
				background-color: transparent;
				color: '.$fortun_options['color-2'].';
			}
			.woocommerce .price, .woocommerce-dropdown-list, .toggle-woocommerce-dropdown, .woocommerce-dropdown-list li a, .single-product-page .single-product-description table .label{
				color: '.$fortun_options['color-3'].';
			}
			.woocommerce .page-cart-summary .shop_table .coupon input[type="submit"], .woocommerce .cart_totals .shipping-calculator-form button, .woocommerce .checkout_coupon input[type="submit"], .woocommerce .lost_reset_password input[type="submit"]{
				background-color: '.$fortun_options['color-3'].';
				border-color: '.$fortun_options['color-3'].';
			}
			.woocommerce .cart_totals .shipping-calculator-form button:hover, .woocommerce .lost_reset_password input[type="submit"]:hover{
				background-color: transparent;
				color: '.$fortun_options['color-3'].';
			}';
	}

	wp_add_inline_style( 'fortun-custom-styles', $style );
	
	//custom css
	if(!empty($fortun_options["css-code"])){
		wp_add_inline_style( 'fortun-custom-styles', $fortun_options["css-code"] );
	}
	
	//custom js
	if(!empty($fortun_options["js-code"])){
		wp_add_inline_script( 'jquery-migrate', '(function($) {' . $fortun_options["js-code"] . ' })(jQuery)' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'fortun_options' );

?>