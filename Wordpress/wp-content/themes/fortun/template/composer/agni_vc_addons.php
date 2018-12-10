<?php 

if( !function_exists('agni_remove_vc_elements') ){
	function agni_remove_vc_elements() {
		vc_remove_element("vc_message");
		vc_remove_element("vc_tweetmeme");
		vc_remove_element("vc_googleplus");
		vc_remove_element("vc_facebook");
		vc_remove_element("vc_pinterest");
		vc_remove_element("vc_flickr");
		vc_remove_element("vc_posts_slider");
		vc_remove_element("vc_basic_grid");
		vc_remove_element("vc_raw_html");
		vc_remove_element("vc_raw_js");
		vc_remove_element("vc_single_image");
		vc_remove_element("vc_images_carousel");
		vc_remove_element("vc_media_grid");
		vc_remove_element("vc_masonry_grid");
		vc_remove_element("vc_gmaps");
		vc_remove_element("vc_progress_bar");
		vc_remove_element("vc_pie");
		vc_remove_element("vc_gallery");
		vc_remove_element("vc_masonry_media_grid");
		vc_remove_element("vc_icon");
		vc_remove_element("vc_video");
		vc_remove_element("vc_round_chart");
		vc_remove_element("vc_line_chart");
		vc_remove_element("vc_tweetmeme");
		vc_remove_element("vc_googleplus");
		vc_remove_element("vc_facebook");
		vc_remove_element("vc_pinterest");
		vc_remove_element("vc_flickr");
		vc_remove_element("vc_gmaps");
		vc_remove_element("vc_raw_html");
		vc_remove_element("vc_raw_js");
		vc_remove_element("vc_separator");
		vc_remove_element("vc_text_separator");
		vc_remove_element("vc_cta");
		vc_remove_element("vc_btn");
		vc_remove_element("vc_widget_sidebar");
		vc_remove_element("vc_toggle");
		vc_remove_element("rev_slider_vc");
		vc_remove_element("vc_tta_tour");
		vc_remove_element("vc_tta_pageable");
		vc_remove_element("vc_tta_tabs");
		vc_remove_element("vc_tta_accordion");
		vc_remove_element("vc_zigzag");
		vc_remove_element("vc_hoverbox");
	}

	// Hook for admin editor.
	$fortun_options = get_option('fortun_options');
	if( $fortun_options['vc_elements'] == '0' ){
	    add_action( 'vc_build_admin_page', 'agni_remove_vc_elements', 11 );
	    add_action( 'vc_load_shortcode', 'agni_remove_vc_elements', 11 );
	}
}

// Deprecated
vc_remove_element("vc_tour");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_cta");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");


// Removing WooCommerce elements
if( !function_exists('agni_remove_woocommerce_elements') ){
	function agni_remove_woocommerce_elements() {
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			vc_remove_element("woocommerce_cart");
			vc_remove_element("woocommerce_checkout");
			vc_remove_element("woocommerce_order_tracking");
			vc_remove_element("woocommerce_my_account");
			vc_remove_element("recent_products");
			vc_remove_element("featured_products");
			vc_remove_element("product");
			vc_remove_element("products");
			vc_remove_element("add_to_cart");
			vc_remove_element("add_to_cart_url");
			vc_remove_element("product_page");
			vc_remove_element("product_category");
			vc_remove_element("product_categories");
			vc_remove_element("sale_products");
			vc_remove_element("best_selling_products");
			vc_remove_element("top_rated_products");
			vc_remove_element("product_attribute");
		}
	}
}

class AgniShortcodesFunctions {
	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'integrateAgniWithVC' ) );
		
	}
	
	public function integrateAgniWithVC() {
		// Check if Visual Composer is installed
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			// Display notice that Visual Compser is required
			add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
			return;
		}
		
		// Including Icon Fonts list
		include ( AGNI_FRAMEWORK_DIR . '/template/composer/agni_iconfonts.php' );

		// Including Google Fonts list
		include ( AGNI_FRAMEWORK_DIR . '/template/composer/agni_googlefonts.php' );

		// Section
		$section_settings_update = array (
		  'weight' => '99',
		  'icon' => 'ion-ios-barcode-outline'
		);
		vc_map_update( 'vc_section', $section_settings_update );

		// Row
		$row_settings_update = array (
		  'weight' => '98',
		  'icon' => 'ion-ios-plus-outline'
		);
		vc_map_update( 'vc_row', $row_settings_update );

		// Column Text
		$column_text_settings_update = array (
		  'weight' => '98',
		  'icon' => 'ion-ios-paper-outline'
		);
		vc_map_update( 'vc_column_text', $column_text_settings_update );

		// Custom Heading
		$custom_heading_settings_update = array (
		  'weight' => '96',
		  'icon' => 'ion-ios-glasses-outline'
		);
		vc_map_update( 'vc_custom_heading', $custom_heading_settings_update );
		// Empty space
		$space_settings_update = array (
		  'weight' => '94',
		  'icon' => 'ion-ios-minus-empty'
		);
		vc_map_update( 'vc_empty_space', $space_settings_update );
		
		// Tab
		$tab_settings_update = array (
		  'weight' => '65',
		  'icon' => 'ion-ios-browsers-outline'
		);
		vc_map_update( 'vc_tabs', $tab_settings_update );
		// Accordion
		$accordion_settings_update = array (
		  'weight' => '64',
		  'icon' => 'ion-ios-arrow-down'
		);
		vc_map_update( 'vc_accordion', $accordion_settings_update );
		

		if( defined( 'WPCF7_PLUGIN' ) ){
			// Contact Form 7
			$contact_form_settings_update = array (
			  'weight' => '63',
			);
			vc_map_update( 'contact-form-7', $contact_form_settings_update );
		}
		
		if( class_exists( 'RevSlider' ) ){
			// Revolution slider
			$rev_settings_update = array (
			  'weight' => '62',
			);
			//vc_map_update( 'rev_slider_vc', $rev_settings_update );
			vc_remove_element("rev_slider_vc");
			vc_map_update( 'rev_slider', $rev_settings_update );
		}


		//vc_remove_param( "vc_section", "css" );
		vc_remove_param( "vc_section", "full_width" );
		vc_remove_param( "vc_section", "video_bg" );
		vc_remove_param( "vc_section", "video_bg_url" );
		vc_remove_param( "vc_section", "video_bg_parallax" );
		vc_remove_param( "vc_section", "parallax" );
		vc_remove_param( "vc_section", "parallax_image" );
		vc_remove_param( "vc_section", "parallax_speed_video" );
		vc_remove_param( "vc_section", "parallax_speed_bg" );
		vc_remove_param( "vc_section", "css_animation" );


		vc_remove_param( "vc_row", "css" );
		vc_remove_param( "vc_row", "full_width" );
		vc_remove_param( "vc_row", "video_bg" );
		vc_remove_param( "vc_row", "video_bg_url" );
		vc_remove_param( "vc_row", "video_bg_parallax" );
		vc_remove_param( "vc_row", "parallax" );
		vc_remove_param( "vc_row", "parallax_image" );
		vc_remove_param( "vc_row", "parallax_speed_video" );
		vc_remove_param( "vc_row", "parallax_speed_bg" );
		vc_remove_param( "vc_row", "css_animation" );

		vc_add_param( "vc_row", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'fortun' ),
			'param_name' => 'fullwidth',
			'weight' => '1',
			'value' => array(
				esc_html__( 'Default(container)', 'fortun' ) => '',
				esc_html__( 'Fullwidth content', 'fortun' ) => 'has-fullwidth-column',
				esc_html__( 'Fullwidth content w/o padding', 'fortun' ) => 'has-fullwidth-column-no-padding',
			),
			'description' => esc_html__( 'Choose any one to display the content on this paricular row. Note. This only affect the content not background.', 'fortun' ),
			'std' => '',
		));
		
		$row_bg_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Choice', 'fortun' ),
				'param_name' => 'bg_choice',
				'weight' => '1',
				'value' => array(
					esc_html__( 'Background Color', 'fortun' ) => '1',
					esc_html__( 'Background Image', 'fortun' ) => '2',
					esc_html__( 'Background Video', 'fortun' ) => '3',
				),
				'description' => esc_html__( 'Choose your desired background option.', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '1',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Color', 'fortun' ),
				'param_name' => 'bg_color',
				'weight' => '1',
				'description' => esc_html__( 'Choose your desired background color for this row.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'fortun' ),
				'param_name' => 'bg_image',
				'weight' => '1',
				'description' => esc_html__( 'Choose your desired background image for this row', 'fortun' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Repeat', 'fortun' ),
				'param_name' => 'bg_image_repeat',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'Repeat', 'fortun' ) => 'repeat',
					 esc_html__('No Repeat', 'fortun') => 'no-repeat'
					),
				'description' => esc_html__( 'Choose whether your background image should be repeated to X-axis Y-axis or not.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'repeat',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Size', 'fortun' ),
				'param_name' => 'bg_image_size',
				'weight' => '1',
				'value' => array(
					 esc_html__('Cover', 'fortun') => 'cover',
					 esc_html__( 'Auto', 'fortun' ) => 'auto'
					),
				'description' => esc_html__( 'Choose your desired background image size.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'cover',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Position', 'fortun' ),
				'param_name' => 'bg_image_position',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'center center', 'fortun' ) => 'center center',
					 esc_html__( 'left top', 'fortun') => 'left top',
					 esc_html__( 'left center', 'fortun' ) => 'left center',
					 esc_html__( 'left bottom', 'fortun' ) => 'left bottom',
					 esc_html__( 'right top', 'fortun' ) => 'right top',
					 esc_html__( 'right center', 'fortun' ) => 'right center',
					 esc_html__( 'right bottom', 'fortun' ) => 'right bottom',
					 esc_html__( 'center top', 'fortun' ) => 'center top',
					 esc_html__( 'center bottom', 'fortun' ) => 'center bottom',
				),
				'description' => esc_html__( 'Choose your desired background image position', 'fortun' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'center center',
			),

			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Image Attachment', 'fortun' ),
				'param_name' => 'bg_image_attachment',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'Scroll', 'fortun' ) => 'scroll',
					 esc_html__( 'Fixed', 'fortun' ) => 'fixed',
					),
				'description' => esc_html__( 'Choose your desired background image attachment', 'fortun' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => 'scroll'
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Fallback BG Color', 'fortun' ),
				'param_name' => 'fallback_bg_color',
				'weight' => '1',
				'description' => esc_html__( 'It will replace the backgroud image on mobile devices.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_image', 'not_empty' => true),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background Video Source', 'fortun' ),
				'param_name' => 'bg_video_src',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'YouTube', 'fortun' ) => '1',
					 esc_html__( 'Selfhosted/Vimeo', 'fortun') => '2',
				),
				'dependency' => array( 'element' => 'bg_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => '1',
			),
			array(
				'type' => 'href',
				'heading' => esc_html__( 'Video URL', 'fortun' ),
				'param_name' => 'bg_video_src_yt',
				'weight' => '1',
				'description' => esc_html__( 'Enter the YouTube video url.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => ''
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Fallback image for mobile & tablets', 'fortun' ),
				'param_name' => 'bg_video_src_yt_fallback',
				'weight' => '1',
				'dependency' => array( 'element' => 'bg_video_src_yt', 'not_empty' => true ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => '',
			),
			array(
				'type' => 'href',
				'heading' => esc_html__( 'Video URL', 'fortun' ),
				'param_name' => 'bg_video_src_sh',
				'weight' => '1',
				'description' => wp_kses( __( 'Enter the media link from your local server. <a target="_blank" href="#">See here</a> to get the video url.', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => ''
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Poster URL', 'fortun' ),
				'param_name' => 'bg_video_src_sh_poster',
				'weight' => '1',
				'description' => esc_html__( 'This poster will be displayed before video get started.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_video_src_sh', 'not_empty' => true ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'save_always' => true,
				'std' => '',
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Autoplay', 'fortun' ),
				'param_name' => 'bg_video_autoplay',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'fortun' ) => '1', ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-4 vc_col-sm-2 vc_column',
				'std' => '1'
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Loop', 'fortun' ),
				'param_name' => 'bg_video_loop',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'fortun' ) => '1', ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-4 vc_col-sm-2 vc_column',
				'std' => ''
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Muted', 'fortun' ),
				'param_name' => 'bg_video_muted',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'fortun' ) => '1', ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-4 vc_col-sm-2 vc_column',
				'std' => ''
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Volumne Level', 'fortun' ),
				'param_name' => 'bg_video_volume',
				'weight' => '1',
				'description' => esc_html__( 'Enter your volume level. it will not applicable if video is muted.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_col-sm-12 vc_column',
				'std' => '50',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Video Quality', 'fortun' ),
				'param_name' => 'bg_video_quality',
				'weight' => '1',
				'description' => esc_html__( 'Choose your video quality by default.', 'fortun' ),
				'value' => array(
					 esc_html__( 'Default', 'fortun' ) => 'default',
					 esc_html__( 'HD 720p', 'fortun') => 'hd720',
					 esc_html__( 'FullHD 1080p', 'fortun') => 'hd1080',
				),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => 'default',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video Start at', 'fortun' ),
				'param_name' => 'bg_video_start_at',
				'weight' => '1',
				'description' => esc_html__( 'Video Start at value.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_col-sm-6 vc_column',
				'std' => '0',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video Stop At', 'fortun' ),
				'param_name' => 'bg_video_stop_at',
				'weight' => '1',
				'description' => esc_html__( 'Video Stop at value.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_video_src', 'value' => array('1', '2') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_col-sm-6 vc_column',
				'std' => '0',
			),

			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'BG Overlay', 'fortun' ),
				'param_name' => 'bg_overlay',
				'weight' => '1',
				'value' => array( esc_html__( 'Yes', 'fortun' ) => '1', ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => array('2', '3') ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'BG Overlay Choice', 'fortun' ),
				'param_name' => 'bg_overlay_choice',
				'weight' => '1',
				'value' => array(
				 esc_html__( 'Simple', 'fortun' ) => '1',
				 esc_html__( 'Simple Gradient', 'fortun' ) => '2',
				 esc_html__( 'Gradient Map', 'fortun' ) => '3',
				),
				'dependency' => array( 'element' => 'bg_overlay', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => '1'
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Overlay Color', 'fortun' ),
				'param_name' => 'bg_overlay_color',
				'weight' => '1',
				'description' => esc_html__( 'This layer will be the overlay of the background.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '1' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'BG Gradient Overlay CSS', 'fortun' ),
				'param_name' => 'bg_sg_overlay_css',
				'weight' => '1',
				'description' => wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '2' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Gradient Map(Duotone) Overlay Color 1', 'fortun' ),
				'param_name' => 'bg_gm_overlay_color1',
				'weight' => '1',
				'description' => wp_kses( __( 'Choose the color for Shadows(Dark pixels).  <a target="_blank" href="http://demo.agnidesigns.com/fortun/documentation/kb/gradient-map-duotone/">See Presets</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Gradient Map(Duotone) Overlay Color 2', 'fortun' ),
				'param_name' => 'bg_gm_overlay_color2',
				'weight' => '1',
				'description' => esc_html__( 'Choose the mid-tone color. You can leave this empty for no mid-tone.', 'fortun' ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'BG Gradient Map(Duotone) Overlay Color 3', 'fortun' ),
				'param_name' => 'bg_gm_overlay_color3',
				'weight' => '1',
				'description' => esc_html__( 'Choose the color for Highlights(White pixels).', 'fortun' ),
				'dependency' => array( 'element' => 'bg_overlay_choice', 'value' => '3' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'std' => '',
			),

		);
		vc_add_params( "vc_row", $row_bg_atts );

		$row_space_atts = array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Top', 'fortun' ),
				'param_name' => 'margin_top',
				'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Right', 'fortun' ),
				'param_name' => 'margin_right',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Bottom', 'fortun' ),
				'param_name' => 'margin_bottom',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Margin Left', 'fortun' ),
				'param_name' => 'margin_left',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Top', 'fortun' ),
				'param_name' => 'padding_top',
				'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Right', 'fortun' ),
				'param_name' => 'padding_right',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Bottom', 'fortun' ),
				'param_name' => 'padding_bottom',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Padding Left', 'fortun' ),
				'param_name' => 'padding_left',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Top', 'fortun' ),
				'param_name' => 'border_top',
				'description' => esc_html__( 'Don\'t include "px" string', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Right', 'fortun' ),
				'param_name' => 'border_right',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Bottom', 'fortun' ),
				'param_name' => 'border_bottom',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Left', 'fortun' ),
				'param_name' => 'border_left',
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-3 vc_col-md-3 vc_column',
				'std' => '',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color', 'fortun' ),
				'param_name' => 'border_color',
				'description' => esc_html__( 'Choose your desired for the border.', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Border Style', 'fortun' ),
				'param_name' => 'border_style',
				'value' => array(
					 esc_html__( 'No style', 'fortun' ) => '',
					 esc_html__( 'Solid', 'fortun' ) => 'solid',
					 esc_html__( 'Dashed', 'fortun' ) => 'dashed',
					 esc_html__( 'Dotted', 'fortun' ) => 'dotted',
					 esc_html__( 'Double', 'fortun' ) => 'double',
					),
				'description' => esc_html__( 'Choose your desired border style.', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Radius', 'fortun' ),
				'param_name' => 'border_radius',
				'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-sm-4 vc_col-md-4 vc_column',
				'std' => '',
			),
		);
		vc_add_params( "vc_row", $row_space_atts );

		$row_parallax_atts = array(
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Background Parallax', 'fortun' ),
				'param_name' => 'bg_parallax',
				'description' => wp_kses( __( 'Recommened - Choose "Background attachment: fixed" at Design Options for seemless parallax. This parallax effect is purely based on skrollr plugin. You can do tons of things by refer this <a href="https://github.com/Prinzhorn/skrollr">Skrollr</a>.', 'fortun' ), array( 'a' => array( 'href' => array() ) ) ),
				'value' => array( esc_html__( 'Enable', 'fortun' ) => '1' ),
				'group' => esc_html__( 'Parallax Settings', 'fortun' ),
				'dependency' => array( 'element' => 'bg_choice', 'value' => array( '1', '2' ) ),
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Element\'s Top at the Bottom.', 'fortun' ),
				'param_name' => 'data_bottom_top',
				'description' => esc_html__( 'Enter the values for ex. background-color: rgba(255, 255, 255, 1), it will be triggered when the element\'s top at the bottom.', 'fortun' ),
				'group' => esc_html__( 'Parallax Settings', 'fortun' ),
				'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
				'std' => 'background-position: 0px 200px'
				
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Element\'s Center at the Center.', 'fortun' ),
				'param_name' => 'data_center',
				'description' => esc_html__( 'It will be triggered when the element\'s center at the center.', 'fortun' ),
				'group' => esc_html__( 'Parallax Settings', 'fortun' ),
				'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
				'std' => 'background-position: 0px 0px'
				
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Element\'s Bottom reach the Top.', 'fortun' ),
				'param_name' => 'data_top_bottom',
				'description' => esc_html__( 'It will be triggered when the element\'s bottom at the Top.', 'fortun' ),
				'group' => esc_html__( 'Parallax Settings', 'fortun' ),
				'dependency' => array( 'element' => 'bg_parallax', 'value' => '1' ),
				'std' => 'background-position: 0px -200px;'
				
			)
		);
		vc_add_params( "vc_row", $row_parallax_atts );

		// Column 
		vc_remove_param( "vc_column", "css_animation" );
		vc_remove_param( "vc_column", "css" );
		vc_remove_param("vc_column", "video_bg");
		vc_remove_param("vc_column", "video_bg_url");
		vc_remove_param("vc_column", "video_bg_parallax");
		vc_remove_param("vc_column", "parallax");
		vc_remove_param("vc_column", "parallax_speed_video");
		vc_remove_param("vc_column", "parallax_speed_bg");
		vc_remove_param("vc_column", "parallax_image");

		global $vc_column_width_list;
		$vc_column_width_list = array(
			esc_html__( '1 column - 1/12', 'fortun' ) => '1/12',
			esc_html__( '2 columns - 1/6', 'fortun' ) => '1/6',
			esc_html__( '3 columns - 1/4', 'fortun' ) => '1/4',
			esc_html__( '4 columns - 1/3', 'fortun' ) => '1/3',
			esc_html__( '5 columns - 5/12', 'fortun' ) => '5/12',
			esc_html__( '6 columns - 1/2', 'fortun' ) => '1/2',
			esc_html__( '7 columns - 7/12', 'fortun' ) => '7/12',
			esc_html__( '8 columns - 2/3', 'fortun' ) => '2/3',
			esc_html__( '9 columns - 3/4', 'fortun' ) => '3/4',
			esc_html__( '10 columns - 5/6', 'fortun' ) => '5/6',
			esc_html__( '11 column - 11/12', 'fortun' ) => '11/12',
			esc_html__( '12 columns - 1/1', 'fortun' ) => '1/1'
		);

		$animation_atts = array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Animation', 'fortun' ),
			'description' => esc_html__( 'It will enable the animation for this particular element.', 'fortun' ),
			'param_name' => 'animation',
			'group' => esc_html__( 'Animation Settings', 'fortun' ),
			'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
			'std' => ''
		);
		$animation_style_atts = array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Animation Style', 'fortun' ),
			'param_name' => 'animation_style',
			'value' => array(
				'No Animation' => '',
				'fadeIn'    => 'fadeIn',
				'fadeInUp'  => 'fadeInUp',
				'fadeInDown'    => 'fadeInDown',
				'fadeInLeft'    => 'fadeInLeft',
				'fadeInRight'   => 'fadeInRight',
				'zoomIn'    => 'zoomIn',
				'bounceIn'  => 'bounceIn',
				'flipInX'   => 'flipInX',
				'flipInY'   => 'flipInY',
				'rotateIn'  => 'rotateIn',
				'rotateInDownLeft'  => 'rotateInDownLeft',
				'rotateInDownRight' => 'rotateInDownRight',
				'rotateInUpLeft'    => 'rotateInUpLeft',
				'rotateInUpRight'   => 'rotateInUpRight',
				'slideInDown'   => 'slideInDown',
				'slideInLeft'   => 'slideInLeft',
				'slideInRight'  => 'slideInRight',
				'slideInUp' => 'slideInUp',
			),
			'description' => esc_html__( 'Select how the content will be aligned in column', 'fortun' ),
			'group' => esc_html__( 'Animation Settings', 'fortun' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => 'fadeInUp'
		);

		$animation_delay_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Animation Delay', 'fortun' ),
			'description' => esc_html__( 'Delay in seconds. for ex 0.4', 'fortun' ),
			'param_name' => 'animation_delay',
			'group' => esc_html__( 'Animation Settings', 'fortun' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => '0.4',
			
		);
		$animation_duration_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Animation Duration', 'fortun' ),
			'description' => esc_html__( 'Duration in seconds. for ex 0.4', 'fortun' ),
			'param_name' => 'animation_duration',
			'group' => esc_html__( 'Animation Settings', 'fortun' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => '0.8',
			
		);
		$animation_offset_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Animation Offset', 'fortun' ),
			'param_name' => 'animation_offset',
			'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the animation only when the element reach 90% from the top.', 'fortun' ),
			'group' => esc_html__( 'Animation Settings', 'fortun' ),
			'dependency' => array( 'element' => 'animation', 'value' => '1' ),
			'std' => '95%',
		);

		$col_animation_atts = array(
			$animation_atts, 
			$animation_style_atts, 
			$animation_duration_atts, 
			$animation_delay_atts, 
			$animation_offset_atts
		);
		$parallax_atts = array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Parallax', 'fortun' ),
			'description' => esc_html__( 'It will enable the parallax effect for this particular element.', 'fortun' ),
			'param_name' => 'parallax',
			'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
			'group' => esc_html__( 'Parallax Settings', 'fortun' ),
			'std' => ''
		);
		$parallax_start_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax Start value', 'fortun' ),
			'description' => esc_html__( 'Enter your starting value of parallax for ex. transform:translateY(0px);', 'fortun' ),
			'param_name' => 'parallax_start',
			'group' => esc_html__( 'Parallax Settings', 'fortun' ),
			'dependency' => array( 'element' => 'parallax', 'value' => '1' ),
			'std' => 'transform:translateY(50px);'
		);
		$parallax_end_atts = array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax End value', 'fortun' ),
			'description' => esc_html__( 'Enter your end value of parallax for ex. transform:translateY(-100px);', 'fortun' ),
			'param_name' => 'parallax_end',
			'group' => esc_html__( 'Parallax Settings', 'fortun' ),
			'dependency' => array( 'element' => 'parallax', 'value' => '1' ),
			'std' => 'transform:translateY(-50px);'
		);

		$col_parallax_atts = array(
			$parallax_atts,
			$parallax_start_atts,
			$parallax_end_atts
		);

		$col_general_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Column Alignment', 'fortun' ),
				'param_name' => 'align',
				'weight' => '1',
				'value' => array(
					 esc_html__( 'left', 'fortun' ) => 'left',
					 esc_html__( 'right', 'fortun' ) => 'right',
					 esc_html__('center', 'fortun') => 'center'
					),
				'description' => esc_html__( 'Choose your desired Column\'s Text Alignment.', 'fortun' ),
				'std' => 'left',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Dark Mode', 'fortun' ),
				'param_name' => 'dark_mode',
				'weight' => '2',
				'description' => esc_html__( 'It will make your column\'s content/text color to white.', 'fortun' ),
				'value' => array( esc_html__( 'Yes', 'fortun' ) => 'has-dark-mode' ),
				'std' => '',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Full height', 'fortun' ),
				'param_name' => 'column_fullheight',
				'weight' => '3',
				'description' => esc_html__( 'It will make your column height to 100% of the view port.', 'fortun' ),
				'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
				'std' => '',
			),
		);

		$col_bg_edge_atts = array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pull BG', 'fortun' ),
				'param_name' => 'bg_edge',
				'weight' => '1',
				'description' => esc_html__( 'It will pull the background element to the left/right edge.', 'fortun' ),
				'value' => array(
				 esc_html__( 'None', 'fortun' ) => '',
				 esc_html__( 'Left', 'fortun' ) => 'left',
				 esc_html__( 'Right', 'fortun' ) => 'right',
				),
				'group' => esc_html__( 'Design Options', 'fortun' ),
				'edit_field_class' => 'vc_col-xs-12 vc_column',
				'std' => ''
			),
		);

		// VC Column
		vc_add_params( "vc_column", $col_animation_atts );
		vc_add_params( "vc_column", $col_parallax_atts );
		vc_add_params( "vc_column", $col_general_atts );
		vc_add_params( "vc_column", $row_bg_atts );
		vc_add_params( "vc_column", $col_bg_edge_atts );
		vc_add_params( "vc_column", $row_space_atts );
		vc_add_params( "vc_column", $row_parallax_atts );

		// VC Row inner
		vc_remove_param( "vc_row_inner", "css" );

		vc_add_param( "vc_row_inner", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Dark Mode', 'fortun' ),
			'param_name' => 'dark_mode',
			'weight' => '1',
			'description' => esc_html__( 'It will make your column\'s content/text color to white.', 'fortun' ),
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'has-dark-mode' ),
			'std' => '',
		));

		vc_add_params( "vc_row_inner", $row_bg_atts );
		vc_add_params( "vc_row_inner", $row_space_atts );
		vc_add_params( "vc_row_inner", $row_parallax_atts );

		// VC Column inner
		vc_remove_param( "vc_column_inner", "css" );

		vc_add_params( "vc_column_inner", $col_animation_atts );
		vc_add_params( "vc_column_inner", $col_general_atts );
		vc_add_params( "vc_column_inner", $row_bg_atts );
		vc_add_params( "vc_column_inner", $row_parallax_atts );
		vc_add_params( "vc_column_inner", $row_space_atts );

		/* VC Text block */
		vc_remove_param( "vc_column_text", "css_animation" );
		vc_remove_param( "vc_column_text", "css" );

		vc_add_params( "vc_column_text", $row_space_atts );
		vc_add_params( "vc_column_text", $col_animation_atts );
		vc_add_params( "vc_column_text", $col_parallax_atts );

		/* VC Custom Heading */
		vc_remove_param( "vc_custom_heading", "source" );
		vc_remove_param( "vc_custom_heading", "css" );

		vc_add_params( "vc_custom_heading", $row_space_atts );
		vc_add_params( "vc_custom_heading", $col_animation_atts );
		vc_add_params( "vc_custom_heading", $col_parallax_atts );
		vc_add_param( "vc_custom_heading", array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Choose Icon', 'fortun' ),
			'param_name' => 'icon',
			'weight' => '1',
			'value' => '',
			'settings' => array(
				'type' => 'iconlist',
				'iconsPerPage' => 545,
			),
			'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
			'std' => ''
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Divide Line', 'fortun' ),
			'description' => esc_html__( 'It will display fancy line below the heading/Title.' , 'fortun' ),
			'param_name' => 'divide_line',
			'weight' => '1',
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
			'std' => '',
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Divide Line Width', 'fortun' ),
			'param_name' => 'divide_line_width',
			'weight' => '1',
			'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.' , 'fortun' ),
			'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
			'std' => '90'
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Divide Line Height', 'fortun' ),
			'param_name' => 'divide_line_height',
			'weight' => '1',
			'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
			'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
			'std' => '1'
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Divide Line Color', 'fortun' ),
			'param_name' => 'divide_line_color',
			'weight' => '1',
			'description' => esc_html__( 'Choose your desired color for the Divide Line.', 'fortun' ),
			'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
			'std' => '#ff655c',
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Letter Spacing', 'fortun' ),
			'param_name' => 'custom_heading_letter_spacing',
			'weight' => '0',
			'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
			'std' => ''
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Font Weight', 'fortun' ),
			'param_name' => 'custom_heading_font_weight',
			'weight' => '0',
			'value' => array(
				 esc_html__( 'Default', 'fortun' ) => '',
				 esc_html__( '200', 'fortun') => '200',
				 esc_html__( '300', 'fortun') => '300',
				 esc_html__( '400', 'fortun') => '400',
				 esc_html__( '500', 'fortun') => '500',
				 esc_html__( '600', 'fortun') => '600',
				 esc_html__( '700', 'fortun' ) => '700',   
				),

			'description' => esc_html__( 'Choose your desired font weight. Note: Some options may not be applicable for the choosen font. make sure that you have added this font weight at option panel', 'fortun' ),
			'dependency' => array( 'element' => 'use_theme_fonts', 'value' => 'yes' ),
			'std' => ''
		));
		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Font Italic', 'fortun' ),
			'description' => esc_html__( 'This options may/may not be applicable for the choosen font.' , 'fortun' ),
			'param_name' => 'font_italic',
			'weight' => '0',
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
			'std' => '',
		));

		vc_add_param( "vc_custom_heading", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Responsive Font Size', 'fortun' ),
			'description' => esc_html__( 'This will reduce the font size in order to fit with screen.' , 'fortun' ),
			'param_name' => 'responsive_font_size',
			'weight' => '0',
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
			'std' => '',
		));

		// tabs @deprecated
		vc_add_param("vc_tab", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Active Tab', 'fortun' ),
			'param_name' => 'active',
			'description' => esc_html__( 'It will make this tab Active.', 'fortun' ),
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'active' ),
			'std' => ''
		));

		vc_remove_param("vc_tabs", "interval");
		vc_remove_param("vc_tabs", "title");
		vc_add_param("vc_tabs", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Tabs Style', 'fortun' ),
			'param_name' => 'style',
			'weight' => '1',
			'value' => array(
				 esc_html__('Underlined', 'fortun') => '1',
				 esc_html__('Bordered', 'fortun' ) => '2',                      
				 esc_html__('Backgrounded', 'fortun' ) => '3'
				),
			'description' => esc_html__( 'Choose your desired tabs style', 'fortun' ),
			'std' => '1'
		));
		vc_add_param( "vc_tabs", array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tab Radius', 'fortun' ),
			'param_name' => 'radius',
			'weight' => '1',
			'description' => esc_html__( 'It will add radius to an active tab. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
			'std' => ''
		));
		vc_add_param( "vc_tabs", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Tabs Alignment', 'fortun' ),
			'param_name' => 'align',
			'weight' => '1',
			'value' => array(
				 esc_html__('Center', 'fortun') => 'center',
				 esc_html__( 'Left', 'fortun' ) => 'left',                      
				 esc_html__( 'Right', 'fortun' ) => 'right'
				),
			'description' => esc_html__( 'Choose your desired tabs alignment.', 'fortun' ),
			'std' => 'left'
		));
		vc_add_param("vc_tabs", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Vertical Tabs?', 'fortun' ),
			'param_name' => 'vertical',
			'weight' => '1',
			'description' => esc_html__( 'It will display the tabs vertically.', 'fortun' ),
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'vertical' ),
			'std' => ''
		));
		vc_add_param( "vc_tabs", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Vertical Tabs Alignment', 'fortun' ),
			'param_name' => 'vertical_align',
			'weight' => '1',
			'value' => array(
				 esc_html__('Center', 'fortun') => 'center',
				 esc_html__( 'Left', 'fortun' ) => 'left',                      
				 esc_html__( 'Right', 'fortun' ) => 'right'
				),
			'description' => esc_html__( 'Choose your desired vertical tabs alignment. Note. it will not affect tabs content.', 'fortun' ),
					'dependency' => array( 'element' => 'vertical', 'value' => 'vertical' ),
			'std' => 'left'
		));

		// Accordions  @deprecated
		// accordion & toggle
		vc_remove_param("vc_accordion_tab", "el_id");
		vc_add_param("vc_accordion_tab", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Active', 'fortun' ),
			'param_name' => 'active',
			'description' => esc_html__( 'It will make this accordion tab Active.', 'fortun' ),
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'in' ),
			'std' => ''
		));

		vc_remove_param("vc_accordion", "interval");
		vc_remove_param("vc_accordion", "collapsible");
		vc_remove_param("vc_accordion", "active_tab");
		vc_remove_param("vc_accordion", "disable_keyboard");
		vc_remove_param("vc_accordion", "title");
		vc_add_param("vc_accordion", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Accordion Style', 'fortun' ),
			'param_name' => 'style',
			'weight' => '1',
			'value' => array(
				 esc_html__('Style 1', 'fortun') => '1',
				 esc_html__('Style 2', 'fortun' ) => '2',                       
				 esc_html__('Style 3', 'fortun' ) => '3'
				),
			'description' => esc_html__( 'Choose your desired accordion style', 'fortun' ),
			'std' => '1'
		));
		vc_add_param( "vc_accordion", array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Alignment', 'fortun' ),
			'param_name' => 'alignment',
			'weight' => '1',
			'value' => array(
				 esc_html__( 'Center', 'fortun') => 'center',
				 esc_html__( 'Left', 'fortun' ) => 'left',                      
				 esc_html__( 'Right', 'fortun' ) => 'right'
				),
			'description' => esc_html__( 'Choose your desired accordion alignment', 'fortun' ),
			'std' => 'left'
		));
		vc_add_param("vc_accordion", array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Not an Accordion?', 'fortun' ),
			'param_name' => 'choice',
			'description' => esc_html__( 'It will make each accordion independent and make it as a toggle.', 'fortun' ),
			'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
			'std' => ''
		));

		$empty_space_atts = array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Height on Tablets(Optional)', 'fortun' ),
				'param_name' => 'height_tab',
				'description' => esc_html__( 'Enter your desired height on tablets. Leave it empty it will inherit the main value.', 'fortun' ),
				'std' => '',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Height on Mobile(Optional)', 'fortun' ),
				'param_name' => 'height_mobile',
				'description' => esc_html__( 'Enter your desired height on tablets. Leave it empty it will inherit the main value.', 'fortun' ),
				'std' => '',
			),

		);
		vc_add_params( "vc_empty_space", $empty_space_atts );


		/*
		Add your Visual Composer logic here.
		Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

		More info: http://kb.wpbakery.com/index.php?title=Vc_map
		*/
		// Section heading
		vc_map( array(
			'name' => esc_html__( 'Section Heading', 'fortun' ),
			'base' => 'agni_section_heading',
			'icon' => 'ion-ios-compose-outline',
			'weight' => '97',
			'category' => esc_html__( 'Typography', 'fortun' ),
			'description' => esc_html__( 'Various headings styles for your web page', 'fortun' ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>.', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'fortun' ),
					'param_name' => 'icon_size',
					'description' => esc_html__( 'Enter your icon size. don\'t include "px" string.' , 'fortun' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '60'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'fortun' ),
					'param_name' => 'icon_color',
					'description' => esc_html__('Choose your desired color for the icon.', 'fortun' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Heading Text', 'fortun' ),
					'param_name' => 'heading',
					'description' => esc_html__( 'Enter your heading text or leave it empty.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Heading Font Size', 'fortun' ),
					'param_name' => 'heading_size',
					'description' => esc_html__( 'Enter your heading font size. don\'t include "px" string.' , 'fortun' ),
					'dependency' => array( 'element' => 'heading', 'not_empty' => true ),
					'std' => '48'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Sub Heading Text', 'fortun' ),
					'param_name' => 'sub_heading',
					'description' => esc_html__( 'Enter your sub-heading text or leave it empty.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Sub Heading Font Size', 'fortun' ),
					'param_name' => 'sub_heading_size',
					'description' => esc_html__( 'Enter your sub-heading font size. don\'t include "px" string.' , 'fortun' ),
					'dependency' => array( 'element' => 'sub_heading', 'not_empty' => true ),
					'std' => '18'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text', 'fortun' ),
					'param_name' => 'additional',
					'description' => esc_html__( 'Enter your additional/description text or leave it empty.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text Font Size', 'fortun' ),
					'param_name' => 'additional_size',
					'description' => esc_html__( 'Enter your additonal text font size. don\'t include "px" string.' , 'fortun' ),
					'dependency' => array( 'element' => 'additional', 'not_empty' => true ),
					'std' => '22'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Divide Line', 'fortun' ),
					'param_name' => 'divide_line',
					'description' => esc_html__( 'It will display fancy line above/below the headings.' , 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
					'std' => 'yes',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Divide Line Width', 'fortun' ),
					'param_name' => 'divide_line_width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
					'std' => '90'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Divide Line Height', 'fortun' ),
					'param_name' => 'divide_line_height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
					'std' => '1'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Divide Line Color', 'fortun' ),
					'param_name' => 'divide_line_color',
					'description' => esc_html__('Choose your desired color for the Divide Line.', 'fortun' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => 'yes' ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Heading Alignment', 'fortun' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Left', 'fortun' ) => 'left',
						 esc_html__( 'Center', 'fortun') => 'center',
						 esc_html__( 'Right', 'fortun' ) => 'right',
					),
					'description' => esc_html__( 'Choose your desired Heading alignment.', 'fortun' ),
					'std' => 'left',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display Order', 'fortun' ),
					'param_name' => 'display_order',
					'value' => array(
						 esc_html__( 'Icon, Headings, Divide line, Addtional', 'fortun' ) => 'ihda',
						 esc_html__( 'Headings, Divide line, Additional, Icon', 'fortun' ) => 'hdai',
						 esc_html__( 'Additional, Headings, Divide line, Icon', 'fortun' ) => 'ahdi',
						 esc_html__( 'Divide line, Headings, Additional, Icon', 'fortun' ) => 'dhai',
						 esc_html__( 'Icon, Divide line, Headings, Additional', 'fortun' ) => 'idha',
						 esc_html__( 'Icon, Sub Heading, Heading, Divide line, Additional', 'fortun' ) => 'ishda',
						 esc_html__( 'Icon, Sub Heading, Heading, Additional, Divide line', 'fortun' ) => 'ishad',
						),
					'description' => esc_html__( 'Choose your desired display order.', 'fortun' ),
					'std' => 'ihda',
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Responsive Font Size', 'fortun' ),
					'description' => esc_html__( 'This will reduce the heading font size in order to fit with screen.' , 'fortun' ),
					'param_name' => 'responsive_font_size',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
					'std' => '',
				),
				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				$parallax_atts,
				$parallax_start_atts,
				$parallax_end_atts,
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		) );
		
		// Blockquote
		vc_map( array(
			'name' => esc_html__( 'Blockquote', 'fortun' ),
			'base' => 'agni_blockquote',
			'icon' => 'ion-ios-heart-outline',
			'weight' => '96',
			'category' => esc_html__( 'Typography', 'fortun' ),
			'description' => esc_html__( 'Blockquote text for your webpage.', 'fortun' ),
			'params' => array(
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Reverse Quote', 'fortun' ),
					'param_name' => 'reverse',
					'description' => esc_html__( 'It will reverse your quote & text.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
					'std' => '',
				),
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Quote Text', 'fortun' ),
					'param_name' => 'content',
					'value' => '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>',
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Quote Symbol', 'fortun' ),
					'param_name' => 'quote',
					'description' => esc_html__( 'It will be displayed behind the quote text.', 'fortun' ),
					'std' => '"',
					//'save_always' => true
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Quote Symbol Color', 'fortun' ),
					'param_name' => 'quote_color',
					'description' => esc_html__( 'Choose your desired Quote Symbol color.', 'fortun' ),
					'std' => '',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__( 'Choose your desired Background color for quote.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Quote Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired color for quote.', 'fortun' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Dropcap
		vc_map( array(
			'name' => esc_html__( 'Dropcap', 'fortun' ),
			'base' => 'agni_dropcap',
			'icon' => 'ion-ios-information-outline',
			'weight' => '95',
			'category' => esc_html__( 'Typography', 'fortun' ),
			'description' => esc_html__( 'Dropcap Text for your webpage.', 'fortun' ),
			'params' => array(
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Dropcap Text', 'fortun' ),
					'param_name' => 'content',
					'value' => 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'std' => '',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Dropcap Style', 'fortun' ),
					'param_name' => 'dropcap_style',
					'value' => array(
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'bordered',
						),
					'description' => esc_html__( 'Choose your desired style for the dropcap letter.', 'fortun' ),
					'std' => 'background',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Dropcap Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Dropcap Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired dropcap letter\'s background color.', 'fortun' ),
					'dependency' => array( 'element' => 'dropcap_style', 'value' => 'background' ),
					'std' => '#000000',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Dropcap Border Color', 'fortun' ),
					'param_name' => 'border_color',
					'description' => esc_html__('choose your desired dropcap letter\'s border color.', 'fortun' ),
					'dependency' => array( 'element' => 'dropcap_style', 'value' => 'bordered' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Dropcap Text Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('choose your desired dropcap letter\'s color', 'fortun' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Seperator
		vc_map( array(
			'name' => esc_html__( 'separator', 'fortun' ),
			'base' => 'agni_separator',
			'icon' => 'ion-ios-infinite-outline',
			'weight' => '94',
			'category' => esc_html__( 'Typography', 'fortun' ),
			'description' => esc_html__( 'separator for your content', 'fortun' ),
			'params' => array(
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Separator Choice', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(
						 esc_html__('Default', 'fortun') => '',
						 esc_html__( 'With Text', 'fortun' ) => 'text',    
						 esc_html__( 'With Icon', 'fortun' ) => 'icon',    
						),
					'description' => esc_html__( 'Choose your desired separator style.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Separator Text', 'fortun' ),
					'param_name' => 'text',
					'description' => esc_html__( 'Enter your text to display over the separator.', 'fortun' ),
					'dependency' => array( 'element' => 'choice', 'value' => 'text' ),
					'std' => '',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>.', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'choice', 'value' => 'icon' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Separator Width', 'fortun' ),
					'param_name' => 'width',
					'description' => esc_html__( 'Enter your width. You can use px, em, %, etc. or enter just number and it will use percentage', 'fortun' ),
					'std' => '100'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Separator Style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Solid', 'fortun') => 'solid',
						 esc_html__( 'Dashed', 'fortun' ) => 'dashed', 
						 esc_html__( 'Dotted', 'fortun' ) => 'dotted', 
						),
					'description' => esc_html__( 'Choose your desired separator style.', 'fortun' ),
					'std' => 'solid'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Separator Alignment', 'fortun' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Center', 'fortun') => 'center',
						 esc_html__( 'Left', 'fortun' ) => 'left',                      
						 esc_html__( 'Right', 'fortun' ) => 'right'
						),
					'description' => esc_html__( 'Choose your desired Separator alignment.', 'fortun' ),
					'std' => 'center'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Separator Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired Separator color.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Separator Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired Separator color.', 'fortun' ),
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Call to Action
		vc_map( array(
			'name' => esc_html__( 'Call to Action', 'fortun' ),
			'base' => 'agni_call_to_action',
			'icon' => 'ion-ios-bolt-outline',
			'weight' => '93',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Simple call to action element', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the style', 'fortun' ),
					'param_name' => 'type',
					'value' => array(   
						 esc_html__( 'Style 1(Default)', 'fortun') => '1',
						 esc_html__( 'Style 2', 'fortun') => '2'
					),
					'std' => '1'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),


				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Top Margin', 'fortun' ),
					'param_name' => 'icon_margin_top',
					'description' => esc_html__( 'It will add the magin for icon. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Right Margin', 'fortun' ),
					'param_name' => 'icon_margin_right',
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Bottom Margin', 'fortun' ),
					'param_name' => 'icon_margin_bottom',
					'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title Text', 'fortun' ),
					'param_name' => 'quote',
					'description' => esc_html__( 'Enter your call to action title text or leave it empty.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Additional Text', 'fortun' ),
					'param_name' => 'additional_quote',
					'description' => esc_html__( 'Enter your call to action additional title text or leave it empty.', 'fortun' ),
					'std' => '',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'fortun' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter your call to action button value.', 'fortun' ),
					'std' => 'Button'
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'fortun' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Enter the URL for the button.', 'fortun' ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Target', 'fortun' ),
					'param_name' => 'target',
					'value' => array(   
						esc_html__( 'Same window', 'fortun' ) => '_self',
						esc_html__( 'New window', 'fortun' ) => '_blank'
					),
					'description' => esc_html__( 'Choose your desired button target.', 'fortun' ),
					'std' => '_self'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => '',
						 esc_html__( 'Bordered', 'fortun') => 'alt'
					),
					'description' => esc_html__( 'Choose your desired button style.', 'fortun' ),
					'std' => '',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => 'default',
						 esc_html__( 'Primary', 'fortun') => 'primary',
						 esc_html__( 'Accent', 'fortun') => 'accent',
						 esc_html__( 'White', 'fortun') => 'white'
					),
					'description' => esc_html__( 'Choose your desired button type.', 'fortun' ),
					'std' => 'default'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Size', 'fortun' ),
					'param_name' => 'size',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => '',
						 esc_html__( 'Large', 'fortun') => 'lg',
						 esc_html__( 'Small', 'fortun' ) => 'sm',
						 esc_html__( 'Extra Small', 'fortun' ) => 'xs',
						 esc_html__( 'Block', 'fortun' ) => 'block',
					),
					'description' => esc_html__( 'Choose your desired button size.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '',
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Top margin', 'fortun' ),
					'param_name' => 'button_margin_top',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '10'
					
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Bottom margin', 'fortun' ),
					'param_name' => 'button_margin_bottom',
					'std' => '',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Icons
		vc_map( array(
			'name' => esc_html__( 'Icon', 'fortun' ),
			'base' => 'agni_icon',
			'icon' => 'ion-ios-star-outline',
			'weight' => '92',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Icon( Ionicons, Fontawesome )', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Type', 'fortun' ),
					'param_name' => 'icon_type',
					'value' => array(
						 esc_html__( 'Icon Fonts', 'fortun' ) => 'icon',
						 esc_html__( 'Svg Icons', 'fortun' ) => 'svg',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
					'std' => 'icon',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
					'std' => 'pe-7s-diamond'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'SVG Icon Type', 'fortun' ),
					'param_name' => 'svg_icon_type',
					'value' => array(
						 esc_html__( 'Choose from list', 'fortun' ) => 'svg_list',
						 esc_html__( 'Upload SVG', 'fortun' ) => 'svg_upload',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
					'std' => 'svg_list',
				),

				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'svg_icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'svgiconlist',
						'iconsPerPage' => 360,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_list' ),
					'std' => 'icon-ecommerce-diamond'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Choose SVG', 'fortun' ),
					'param_name' => 'svg_icon_upload',
					'description' => esc_html__( 'Select svg file from media library.', 'fortun' ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_upload' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'fortun' ),
					'param_name' => 'size',
					'description' => esc_html__( 'Enter your icon size. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '32',
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Icon URL', 'fortun' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Enter your URL/Link for the icon or leave it empty.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style', 'fortun' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'fortun' ),
					'param_name' => 'width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'fortun' ),
					'param_name' => 'height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired icon background color.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
					'std' => '#f0f1f2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'fortun' ),
					'param_name' => 'border_color',
					'description' => esc_html__('Choose your desired icon border color.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired icon color.', 'fortun' ),
					'std' => '#000000',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style on Hover', 'fortun' ),
					'param_name' => 'hover_icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius on hover', 'fortun' ),
					'param_name' => 'hover_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color on hover', 'fortun' ),
					'param_name' => 'hover_background_color',
					'description' => esc_html__('Choose your desired icon background color when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color on hover', 'fortun' ),
					'param_name' => 'hover_border_color',
					'description' => esc_html__('Choose your desired icon border color when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color on hover', 'fortun' ),
					'param_name' => 'hover_color',
					'description' => esc_html__('Choose your desired icon color when the icon hovered.', 'fortun' ),
					'std' => '#000000',
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Inline Icon', 'fortun' ),
					'param_name' => 'inline',
					'description' => esc_html__( 'It will bring the buttons to the same line.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
					'std' => 'yes'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding(Gap)', 'fortun' ),
					'param_name' => 'icon_padding',
					'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "10px" or "5px 10px" or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Service Box
		vc_map( array(
			'name' => esc_html__( 'Service Box', 'fortun' ),
			'base' => 'agni_service',
			'icon' => 'ion-ios-wineglass-outline',
			'weight' => '91',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'various Service boxes', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Service Choice', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'fortun' ) => '1',
						 esc_html__( 'Style 2', 'fortun' ) => '2',
						 esc_html__( 'Style 3', 'fortun' ) => '3',
						),
					'description' => esc_html__( 'Choose your desired service box style.', 'fortun' ),
					'std' => '1'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background Choice', 'fortun' ),
					'param_name' => 'bg_choice',
					'weight' => '1',
					'value' => array(
						esc_html__( 'None', 'fortun' ) => '',
						esc_html__( 'Background Color', 'fortun' ) => '1',
						esc_html__( 'Background Image', 'fortun' ) => '2',
						esc_html__( 'Border Color', 'fortun' ) => '3',
					),
					'description' => esc_html__( 'Choose your desired background option service box.', 'fortun' ),
					//'dependency' => array( 'element' => 'choice', 'value' => '3' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'bg_color',
					'description' => esc_html__( 'Choose your desired background color for this service box.', 'fortun' ),
					'dependency' => array( 'element' => 'bg_choice', 'value' => '1' ),
					'std' => '',
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Background Image', 'fortun' ),
					'param_name' => 'bg_image',
					'description' => esc_html__( 'Choose your desired background image for this service box', 'fortun' ),
					'dependency' => array( 'element' => 'bg_choice', 'value' => '2' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'fortun' ),
					'param_name' => 'bg_border_color',
					'description' => esc_html__( 'Choose your desired border color for this service box.', 'fortun' ),
					'dependency' => array( 'element' => 'bg_choice', 'value' => '3' ),
					'std' => '',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Icon/Text', 'fortun' ),
					'param_name' => 'text_i_icon',
					'description' => esc_html__( 'It will let you to use icon/text as per your wish.', 'fortun' ),
					'value' => array(
						 esc_html__( 'Icon', 'fortun' ) => '1',
						 esc_html__( 'Text', 'fortun' ) => '2',
					),
					'std' => '1'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Type', 'fortun' ),
					'param_name' => 'icon_type',
					'value' => array(
						 esc_html__( 'Icon Fonts', 'fortun' ) => 'icon',
						 esc_html__( 'Svg Icons', 'fortun' ) => 'svg',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => 'icon',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
					'std' => 'pe-7s-diamond'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'SVG Icon Type', 'fortun' ),
					'param_name' => 'svg_icon_type',
					'value' => array(
						 esc_html__( 'Choose from list', 'fortun' ) => 'svg_list',
						 esc_html__( 'Choose SVG', 'fortun' ) => 'svg_upload',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
					'std' => 'svg_list',
				),

				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'svg_icon',
					'value' => '',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'svgiconlist',
						'iconsPerPage' => 360,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_list' ),
					'std' => 'icon-ecommerce-diamond'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Choose SVG', 'fortun' ),
					'param_name' => 'svg_icon_upload',
					'description' => esc_html__( 'Select svg file from media library.', 'fortun' ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_upload' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'fortun' ),
					'param_name' => 'size',
					'description' => esc_html__( 'Enter your icon size. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '',
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Icon URL', 'fortun' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Enter your URL/Link for the icon or leave it empty.', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style', 'fortun' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style.', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'fortun' ),
					'param_name' => 'width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'fortun' ),
					'param_name' => 'height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('Choose your desired icon background color.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
					'std' => '#f0f1f2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'fortun' ),
					'param_name' => 'border_color',
					'description' => esc_html__('Choose your desired icon border color.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('Choose your desired icon color.', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '#000000',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Style on Hover', 'fortun' ),
					'param_name' => 'hover_icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Choose your desired icon style when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius on hover', 'fortun' ),
					'param_name' => 'hover_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color on hover', 'fortun' ),
					'param_name' => 'hover_background_color',
					'description' => esc_html__('Choose your desired icon background color when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color on hover', 'fortun' ),
					'param_name' => 'hover_border_color',
					'description' => esc_html__('Choose your desired icon border color when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color on hover', 'fortun' ),
					'param_name' => 'hover_color',
					'description' => esc_html__('Choose your desired icon color when the icon hovered.', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
					'std' => '#000000',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Text', 'fortun' ),
					'param_name' => 'text',
					'description' => esc_html__( 'Enter your letter/number. Please do not use more the two letter, it may break the layout. ', 'fortun' ),
					'dependency' => array( 'element' => 'text_i_icon', 'value' => '2' ),
					'std' => '01'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Text Size', 'fortun' ),
					'param_name' => 'text_size',
					'description' => esc_html__( 'Enter your text/number font size. Don\'t include px string.', 'fortun' ),
					'dependency' => array( 'element' => 'text', 'not_empty' => true ),
					'std' => '45'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Text Color', 'fortun' ),
					'param_name' => 'text_color',
					'description' => esc_html__( 'Choose your desired color for this text.', 'fortun' ),
					'dependency' => array( 'element' => 'text', 'not_empty' => true ),
					'std' => '',
				),                  
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Heading', 'fortun' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter your service title/text', 'fortun' ),
					'std' => 'Lorem ipsum'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Service Heading Font Size', 'fortun' ),
					'param_name' => 'title_size',
					'description' => esc_html__( 'Enter your service title/text font size. Don\'t include px string.', 'fortun' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => '24'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Heading Color', 'fortun' ),
					'param_name' => 'title_color',
					'description' => esc_html__('Choose your desired color for heading', 'fortun' ),
					'dependency' => array( 'element' => 'title', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Divide Line', 'fortun' ),
					'param_name' => 'divide_line',
					'description' => esc_html__( 'Check this, if you want to show the divide line.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'std' => '1'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Divide Line Color', 'fortun' ),
					'param_name' => 'divide_line_color',
					'description' => esc_html__('Choose your desired color for divideline', 'fortun' ),
					'dependency' => array( 'element' => 'divide_line', 'value' => '1' ),
					'std' => '',
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Service Description', 'fortun' ),
					'param_name' => 'content',
					'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Service Description Color', 'fortun' ),
					'param_name' => 'description_color',
					'description' => esc_html__('Choose your desired color for description', 'fortun' ),
					'dependency' => array( 'element' => 'content', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'fortun' ),
					'param_name' => 'btn_value',
					'description' => esc_html__( 'Enter your call to action button value.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'fortun' ),
					'param_name' => 'btn_url',
					'description' => esc_html__( 'Enter the URL for the button.', 'fortun' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button style', 'fortun' ),
					'param_name' => 'btn_style',
					'value' => array(   
						 esc_html__( 'Background', 'fortun') => '',
						 esc_html__( 'Bordered', 'fortun') => 'alt'
					),
					'description' => esc_html__( 'Choose your desired button style.', 'fortun' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'fortun' ),
					'param_name' => 'btn_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => '',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'fortun' ),
					'param_name' => 'btn_choice',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => 'default',
						 esc_html__( 'Primary', 'fortun') => 'primary',
						 esc_html__( 'Accent', 'fortun') => 'accent',
						 esc_html__( 'White', 'fortun') => 'white'
					),
					'description' => esc_html__( 'Choose your desired button type.', 'fortun' ),
					'dependency' => array( 'element' => 'btn_value', 'not_empty' => true ),
					'std' => 'default'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'fortun' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__( 'Left', 'fortun' ) => 'left',
						 esc_html__( 'Center', 'fortun') => 'center',
						 esc_html__( 'Right', 'fortun' ) => 'right',
					),
					'description' => esc_html__( 'Choose your desired service box alignment.', 'fortun' ),
					'dependency' => array( 'element' => 'choice', 'value' => array('1', '3') ),
					'std' => 'left'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'fortun' ),
					'param_name' => 'service_2_align',
					'value' => array(
						 esc_html__( 'Left', 'fortun' ) => 'left',                      
						 esc_html__( 'Right', 'fortun' ) => 'right'
						),
					'description' => esc_html__( 'Choose your desired service box alignment.', 'fortun' ),
					'dependency' => array( 'element' => 'choice', 'value' => array('2') ),
					'std' => 'left'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding(Gap)', 'fortun' ),
					'param_name' => 'service_padding',
					'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),

			)
		
		));
		
		// Service Boxes
		vc_map( array(
			'name' => esc_html__( 'Service Boxes', 'fortun' ),
			'base' => 'agni_service_boxes',
			'icon' => 'ion-ios-wineglass',
			'weight' => '90',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'various Service boxes', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Service Choice', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'fortun' ) => '1',
						 esc_html__( 'Style 2', 'fortun' ) => '2',
						 esc_html__( 'Style 3', 'fortun' ) => '3',
						),
					'description' => esc_html__( 'Choose your desired service box style.', 'fortun' ),
					'std' => '1'
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Values', 'fortun' ),
					'param_name' => 'values',
					'value' => urlencode( json_encode( array(
						array(
							'bg_choice' => '',
							'bg_color' => '',
							'bg_image' => '',
							'bg_border_color' => '',
							'text_i_icon' => '1',
							'icon_type' => 'icon',
							'icon' => 'pe-7s-diamond',
							'svg_icon_type' => 'svg_list',
							'svg_icon' => 'icon-ecommerce-diamond',
							'svg_icon_upload' => '',
							'size' => '',
							'url' => '',
							'icon_style' => '',
							'width' => '',
							'height' => '',
							'radius' => '50%',
							'background_color' => '#f0f1f2',
							'border_color' => '#000000',
							'color' => '#000000',
							'hover_icon_style' => '',
							'hover_radius' => '50%',
							'hover_background_color' => '#ff655c',
							'hover_border_color' => '#000000',
							'hover_color' => '#000000',
							'text' => '01',
							'text_size' => '45',
							'text_color' => '',
							'title' => esc_attr__( 'Lorem ipsum', 'fortun' ),
							'title_size' => '24',
							'title_color' => '',
							'divide_line' => '1',
							'divide_line_color' => '',
							'content' => esc_attr__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'fortun' ),
							'description_color' => '',
							'btn_value' => '',
							'btn_url' => '#',
							'btn_style' => '',
							'btn_radius' => '',
							'btn_choice' => 'default'
						),
						array(
							'bg_choice' => '',
							'bg_color' => '',
							'bg_image' => '',
							'bg_border_color' => '',
							'text_i_icon' => '1',
							'icon_type' => 'icon',
							'icon' => 'pe-7s-diamond',
							'svg_icon_type' => 'svg_list',
							'svg_icon' => 'icon-ecommerce-diamond',
							'svg_icon_upload' => '',
							'size' => '',
							'url' => '',
							'icon_style' => '',
							'width' => '',
							'height' => '',
							'radius' => '50%',
							'background_color' => '#f0f1f2',
							'border_color' => '#000000',
							'color' => '#000000',
							'hover_icon_style' => '',
							'hover_radius' => '50%',
							'hover_background_color' => '#ff655c',
							'hover_border_color' => '#000000',
							'hover_color' => '#000000',
							'text' => '01',
							'text_size' => '45',
							'text_color' => '',
							'title' => esc_attr__( 'Lorem ipsum', 'fortun' ),
							'title_size' => '24',
							'title_color' => '',
							'divide_line' => '1',
							'divide_line_color' => '',
							'content' => esc_attr__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'fortun' ),
							'description_color' => '',
							'btn_value' => '',
							'btn_url' => '#',
							'btn_style' => '',
							'btn_radius' => '',
							'btn_choice' => 'default'
						)
					) ) ),
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Background Choice', 'fortun' ),
							'param_name' => 'bg_choice',
							'weight' => '1',
							'value' => array(
								esc_html__( 'None', 'fortun' ) => '',
								esc_html__( 'Background Color', 'fortun' ) => '1',
								esc_html__( 'Background Image', 'fortun' ) => '2',
								esc_html__( 'Border Color', 'fortun' ) => '3',
							),
							'description' => esc_html__( 'Choose your desired background option. Note: it will work only on Style 3.', 'fortun' ),
							'std' => '',
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Background Color', 'fortun' ),
							'param_name' => 'bg_color',
							'description' => esc_html__( 'Choose your desired background color for this service box.', 'fortun' ),
							'dependency' => array( 'element' => 'bg_choice', 'value' => '1' ),
							'std' => '',
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Background Image', 'fortun' ),
							'param_name' => 'bg_image',
							'description' => esc_html__( 'Choose your desired background image for this service box.', 'fortun' ),
							'dependency' => array( 'element' => 'bg_choice', 'value' => '2' ),
							'std' => '',
						),

						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Border Color', 'fortun' ),
							'param_name' => 'bg_border_color',
							'description' => esc_html__( 'Choose your desired border color for this service box.', 'fortun' ),
							'dependency' => array( 'element' => 'bg_choice', 'value' => '3' ),
							'std' => '',
						),
						
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Choose Icon/Text', 'fortun' ),
							'param_name' => 'text_i_icon',
							'description' => esc_html__( 'It will let you to use icon/text as per your wish.', 'fortun' ),
							'value' => array(
								 esc_html__( 'Icon', 'fortun' ) => '1',
								 esc_html__( 'Text', 'fortun' ) => '2',
							),
							'std' => '1'
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Icon Type', 'fortun' ),
							'param_name' => 'icon_type',
							'value' => array(
								 esc_html__( 'Icon Fonts', 'fortun' ) => 'icon',
								 esc_html__( 'Svg Icons', 'fortun' ) => 'svg',
								),
							'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
							'std' => 'icon',
						),
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Choose Icon', 'fortun' ),
							'param_name' => 'icon',
							'value' => '',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'iconlist',
								'iconsPerPage' => 545,
							),
							'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
							'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
							'std' => 'pe-7s-diamond'
						),

						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'SVG Icon Type', 'fortun' ),
							'param_name' => 'svg_icon_type',
							'value' => array(
								 esc_html__( 'Choose from list', 'fortun' ) => 'svg_list',
								 esc_html__( 'Choose SVG', 'fortun' ) => 'svg_upload',
								),
							'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
							'std' => 'svg_list',
						),

						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Choose Icon', 'fortun' ),
							'param_name' => 'svg_icon',
							'value' => '',
							'settings' => array(
								'emptyIcon' => false,
								'type' => 'svgiconlist',
								'iconsPerPage' => 360,
							),
							'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
							'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_list' ),
							'std' => 'icon-ecommerce-diamond'
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__( 'Choose SVG', 'fortun' ),
							'param_name' => 'svg_icon_upload',
							'description' => esc_html__( 'Select svg file from media library.', 'fortun' ),
							'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_upload' ),
							'std' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Icon Size', 'fortun' ),
							'param_name' => 'size',
							'description' => esc_html__( 'Enter your icon size. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
							'std' => '',
						),
						array(
							'type' => 'href',
							'heading' => esc_html__( 'Icon URL', 'fortun' ),
							'param_name' => 'url',
							'description' => esc_html__( 'Enter your URL/Link for the icon or leave it empty.', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
							'std' => ''
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Icon Style', 'fortun' ),
							'param_name' => 'icon_style',
							'value' => array(
								 esc_html__( 'Default', 'fortun' ) => '',
								 esc_html__( 'Background', 'fortun' ) => 'background',
								 esc_html__( 'Bordered', 'fortun' ) => 'border',
								),
							'description' => esc_html__( 'Choose your desired icon style.', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
							'std' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Width', 'fortun' ),
							'param_name' => 'width',
							'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
							'std' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Height', 'fortun' ),
							'param_name' => 'height',
							'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
							'std' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Radius', 'fortun' ),
							'param_name' => 'radius',
							'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
							'std' => '50%',
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Background Color', 'fortun' ),
							'param_name' => 'background_color',
							'description' => esc_html__('Choose your desired icon background color.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
							'std' => '#f0f1f2',
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Border Color', 'fortun' ),
							'param_name' => 'border_color',
							'description' => esc_html__('Choose your desired icon border color.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
							'std' => '#000000',
						),

						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Icon Color', 'fortun' ),
							'param_name' => 'color',
							'description' => esc_html__('Choose your desired icon color.', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
							'std' => '#000000',
						),
						
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Icon Style on Hover', 'fortun' ),
							'param_name' => 'hover_icon_style',
							'value' => array(
								 esc_html__( 'Default', 'fortun' ) => '',
								 esc_html__( 'Background', 'fortun' ) => 'background',
								 esc_html__( 'Bordered', 'fortun' ) => 'border',
								),
							'description' => esc_html__( 'Choose your desired icon style when the icon hovered.', 'fortun' ),
							'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
							'std' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Radius on hover', 'fortun' ),
							'param_name' => 'hover_radius',
							'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
							'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
							'std' => '50%',
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Background Color on hover', 'fortun' ),
							'param_name' => 'hover_background_color',
							'description' => esc_html__('Choose your desired icon background color when the icon hovered.', 'fortun' ),
							'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
							'std' => '#ff655c',
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Border Color on hover', 'fortun' ),
							'param_name' => 'hover_border_color',
							'description' => esc_html__('Choose your desired icon border color when the icon hovered.', 'fortun' ),
							'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
							'std' => '#000000',
						),

						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Icon Color on hover', 'fortun' ),
							'param_name' => 'hover_color',
							'description' => esc_html__('Choose your desired icon color when the icon hovered.', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '1' ),
							'std' => '#000000',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Service Text', 'fortun' ),
							'param_name' => 'text',
							'description' => esc_html__( 'Enter your letter/number. Please do not use more the two letter, it may break the layout. ', 'fortun' ),
							'dependency' => array( 'element' => 'text_i_icon', 'value' => '2' ),
							'std' => '01',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Service Text Size', 'fortun' ),
							'param_name' => 'text_size',
							'description' => esc_html__( 'Enter your text/number font size. Don\'t include px string.', 'fortun' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'std' => '45'
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Service Text Color', 'fortun' ),
							'param_name' => 'text_color',
							'description' => esc_html__( 'Choose your desired color for this text.', 'fortun' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'std' => '',
						),                  
						
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Service Heading', 'fortun' ),
							'param_name' => 'title',
							'description' => esc_html__( 'Enter your service title/text', 'fortun' ),
							'std' => esc_attr__( 'Lorem ipsum', 'fortun' ),
							'admin_label' => true,
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Service Heading Font Size', 'fortun' ),
							'param_name' => 'title_size',
							'description' => esc_html__( 'Enter your service title/text font size. Don\'t include px string.', 'fortun' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'std' => '24'
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Service Heading Color', 'fortun' ),
							'param_name' => 'title_color',
							'description' => esc_html__('Choose your desired color for heading', 'fortun' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'std' => '',
						),
						array(
							'type' => 'checkbox',
							'heading' => esc_html__( 'Divide Line', 'fortun' ),
							'param_name' => 'divide_line',
							'description' => esc_html__( 'Check this, if you want to show the divide line.', 'fortun' ),
							'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
							'std' => '1'
						),
						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Divide Line Color', 'fortun' ),
							'param_name' => 'divide_line_color',
							'description' => esc_html__('Choose your desired color for divideline', 'fortun' ),
							'dependency' => array( 'element' => 'divide_line', 'value' => '1' ),
							'std' => '',
						),
						
						array(
							'type' => 'textarea',
							'heading' => esc_html__( 'Service Description', 'fortun' ),
							'param_name' => 'content',
							'std' => esc_attr__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'fortun' ),
						),

						array(
							'type' => 'colorpicker',
							'heading' => esc_html__( 'Service Description Color', 'fortun' ),
							'param_name' => 'description_color',
							'description' => esc_html__('Choose your desired color for description', 'fortun' ),
							'dependency' => array( 'element' => 'content', 'not_empty' => true ),
							'std' => '',
						),

						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button Value', 'fortun' ),
							'param_name' => 'btn_value',
							'description' => esc_html__( 'Enter your call to action button value.', 'fortun' ),
							'std' => ''
						),
						array(
							'type' => 'href',
							'heading' => esc_html__( 'Button URL', 'fortun' ),
							'param_name' => 'btn_url',
							'description' => esc_html__( 'Enter the URL for the button.', 'fortun' ),
							'dependency' => array( 'element' => 'value', 'not_empty' => true ),
							'std' => '#'
						),
						
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Button style', 'fortun' ),
							'param_name' => 'btn_style',
							'value' => array(   
								 esc_html__( 'Background', 'fortun') => '',
								 esc_html__( 'Bordered', 'fortun') => 'alt'
							),
							'description' => esc_html__( 'Choose your desired button style.', 'fortun' ),
							'dependency' => array( 'element' => 'value', 'not_empty' => true ),
							'std' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Button Radius', 'fortun' ),
							'param_name' => 'btn_radius',
							'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
							'dependency' => array( 'element' => 'value', 'not_empty' => true ),
							'std' => '',
						),
						
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Button Type', 'fortun' ),
							'param_name' => 'btn_choice',
							'value' => array(   
								 esc_html__( 'Default', 'fortun') => 'default',
								 esc_html__( 'Primary', 'fortun') => 'primary',
								 esc_html__( 'Accent', 'fortun') => 'accent',
								 esc_html__( 'White', 'fortun') => 'white'
							),
							'description' => esc_html__( 'Choose your desired button type.', 'fortun' ),
							'dependency' => array( 'element' => 'value', 'not_empty' => true ),
							'std' => 'default'
						),

					),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display type', 'fortun' ),
					'param_name' => 'type',
					'value' => array(   
						 esc_html__( 'Carousel', 'fortun') => '1',
						 esc_html__( 'Grid', 'fortun') => '2',
					),
					'description' => esc_html__( 'you can choose your desire type, it allows you to decide whether you need carousel or not. ', 'fortun' ),
					'std' => '1'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Number of Columns', 'fortun' ),
					'param_name' => 'column_count',
					'value' => array(   
						 esc_html__( '1 column', 'fortun') => '1',
						 esc_html__( '2 columns', 'fortun') => '2',
						 esc_html__( '3 columns', 'fortun') => '3',
						 esc_html__( '4 columns', 'fortun' ) => '4',
						 esc_html__( '5 columns', 'fortun' ) => '5',
						 esc_html__( '6 columns', 'fortun' ) => '6',
					),
					'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'fortun' ),
					'std' => '3'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Items per Columns', 'fortun' ),
					'param_name' => 'column_items',
					'value' => array(   
						 esc_html__( '1 column', 'fortun') => '1',
						 esc_html__( '2 columns', 'fortun') => '2',
						 esc_html__( '3 columns', 'fortun') => '3',
						 esc_html__( '4 columns', 'fortun' ) => '4',
					),
					'description' => esc_html__( 'Choose the no. of items to show vertically on each column.', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std' => '1'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Gutter(gap)', 'fortun' ),
					'param_name' => 'service_gutter',
					'description' => esc_html__( 'Gap between each item. Enter values in px. Don\'t include "px" string', 'fortun' ),
					'std' => '30'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'fortun' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__('center', 'fortun') => 'center',
						 esc_html__( 'left', 'fortun' ) => 'left',                      
						 esc_html__( 'right', 'fortun' ) => 'right'
						),
					'description' => esc_html__( 'Select how the servicebox will be aligned', 'fortun' ),
					'dependency' => array( 'element' => 'choice', 'value' => array('1', '3') ),
					'std' => 'left'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'fortun' ),
					'param_name' => 'service_2_align',
					'value' => array(
						 esc_html__( 'left', 'fortun' ) => 'left',                      
						 esc_html__( 'right', 'fortun' ) => 'right'
						),
					'description' => esc_html__( 'Select how the servicebox will be aligned', 'fortun' ),
					'dependency' => array( 'element' => 'choice', 'value' => array('2') ),
					'std' => 'left'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Padding(Gap)', 'fortun' ),
					'param_name' => 'service_padding',
					'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Box Shadow', 'fortun' ),
					'param_name' => 'service_shadow',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'std'  => ''
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Autoplay', 'fortun' ),
					'param_name' => 'service_autoplay',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => '1'
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Timeout duration', 'fortun' ),
					'param_name' => 'service_autoplay_timeout',
					'description' => esc_html__( 'Enter the duration of each slide Transition', 'fortun' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'std' => '5000',
					'dependency' => array( 'element' => 'service_autoplay', 'value' => '1' )
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Pause on Hover', 'fortun' ),
					'param_name' => 'service_autoplay_hover',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'std'  => '1',
					'dependency' => array( 'element' => 'service_autoplay', 'value' => '1' )
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Loop', 'fortun' ),
					'param_name' => 'service_loop',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => '1'
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Pagination', 'fortun' ),
					'param_name' => 'service_pagination',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => '1'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,
			)
		
		));
		
		// Pricing Table
		vc_map( array(
			'name' => esc_html__( 'Pricing Table', 'fortun' ),
			'base' => 'agni_pricingtable',
			'icon' => 'ion-ios-pricetags-outline',
			'weight' => '88',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Pricing column for many purpose', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Pricing Table Style', 'fortun' ),
					'param_name' => 'pricing_style',
					'value' => array(
						 esc_html__( 'Style 1', 'fortun' ) => '1',
						 esc_html__( 'Style 2', 'fortun' ) => '2', 
						),
					'description' => esc_html__( 'Select the style to display the featured pricing table.', 'fortun' ),
					'std' => '1'
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'bg_color',
					'description' => esc_html__( 'select the background color for this pricing table', 'fortun' ),
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Heading of the table', 'fortun' ),
					'param_name' => 'heading',
					'description' => esc_html__( 'title or heading of the pricing table.', 'fortun' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price', 'fortun' ),
					'param_name' => 'price',
					'description' => esc_html__( 'Price or charge for the subscribers. for.eg $99', 'fortun' )
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Price Color', 'fortun' ),
					'param_name' => 'price_color',
					'description' => esc_html__('choose your desired price color.', 'fortun' ),
					'dependency' => array( 'element' => 'price', 'not_empty' => true ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Interval', 'fortun' ),
					'param_name' => 'interval',
					'description' => esc_html__( 'title or heading of the pricing table. for.eg mo.', 'fortun' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'fortun' ),
					'param_name' => 'value',
					'description' => esc_html__( 'value of the pricing button. for.eg Sign Up', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Link', 'fortun' ),
					'param_name' => 'url',
					'description' => esc_html__( 'link of the pricing button.', 'fortun' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '#'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Target', 'fortun' ),
					'param_name' => 'target',
					'value' => array(   
						esc_html__( 'Same window', 'fortun' ) => '_self',
						esc_html__( 'New window', 'fortun' ) => '_blank'
					),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '_self'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button Style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Background', 'fortun') => '',
						 esc_html__( 'Bordered', 'fortun') => 'alt'
					),
					'description' => esc_html__( 'Select the button style.', 'fortun' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => '50px'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Type', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => 'default',
						 esc_html__( 'Primary', 'fortun') => 'primary',
						 esc_html__( 'Accent', 'fortun') => 'accent',
						 esc_html__( 'White', 'fortun') => 'white'
					),
					'description' => esc_html__( 'Select the button type.', 'fortun' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => 'accent'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'fortun' ),
					'param_name' => 'size',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => '',
						 esc_html__( 'Large', 'fortun') => 'lg',
						 esc_html__( 'Small', 'fortun' ) => 'sm',
						 esc_html__( 'Extra Small', 'fortun' ) => 'xs',
						 esc_html__( 'Block', 'fortun' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button.', 'fortun' ),
					'dependency' => array( 'element' => 'value', 'not_empty' => true ),
					'std' => 'sm'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Bottom padding', 'fortun' ),
					'param_name' => 'padding_bottom',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '15%'
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Service description', 'fortun' ),
					'param_name' => 'content',
					'value' => '<br><li>Content</li><li>Content</li><li>Content</li><li>Content</li></br>',
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Milestone
		vc_map( array(
			'name' => esc_html__( 'Milestone', 'fortun' ),
			'base' => 'agni_milestone',
			'icon' => 'ion-ios-paw-outline',
			'weight' => '87',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Milestone content', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Milestone Style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'fortun' ) => '1',
						 esc_html__( 'Style 2', 'fortun' ) => '2', 
						),
					'std' => '1'
				),
				/*array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),*/

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon Type', 'fortun' ),
					'param_name' => 'icon_type',
					'value' => array(
						 esc_html__( 'Icon Fonts', 'fortun' ) => 'icon',
						 esc_html__( 'Svg Icons', 'fortun' ) => 'svg',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
					'std' => 'icon',
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'icon' ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'SVG Icon Type', 'fortun' ),
					'param_name' => 'svg_icon_type',
					'value' => array(
						 esc_html__( 'Choose from list', 'fortun' ) => 'svg_list',
						 esc_html__( 'Choose SVG', 'fortun' ) => 'svg_upload',
						),
					'description' => esc_html__( 'Choose your desired icon type.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_type', 'value' => 'svg' ),
					'std' => 'svg_list',
				),

				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'svg_icon',
					'value' => '',
					'settings' => array(
						'type' => 'svgiconlist',
						'iconsPerPage' => 360,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_list' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Choose SVG', 'fortun' ),
					'param_name' => 'svg_icon_upload',
					'description' => esc_html__( 'Select svg file from media library.', 'fortun' ),
					'dependency' => array( 'element' => 'svg_icon_type', 'value' => 'svg_upload' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Icon Size', 'fortun' ),
					'param_name' => 'icon_size',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					//'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
					'std' => '30'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'fortun' ),
					'param_name' => 'icon_color',
					'description' => esc_html__( 'Choose your desired color for icon.', 'fortun' ),
					//'dependency' => array( 'element' => 'icon', 'not_empty' => true ),
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number count', 'fortun' ),
					'param_name' => 'mile',
					'description' => esc_html__( 'Number count for the milestone..  for.eg <strong>99</strong>', 'fortun' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number count Font Size', 'fortun' ),
					'param_name' => 'mile_font_size',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '60'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Mile text', 'fortun' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Number count for the milestone.. for.eg <strong>coffee cups</strong>', 'fortun' )
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Dark Mode', 'fortun' ),
					'param_name' => 'dark_mode',
					'description' => esc_html__( 'This option makes your content white.. it may helpful for dark backgrounds', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'has-dark-mode' )
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'fortun' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__('center', 'fortun') => 'center',
						 esc_html__( 'left', 'fortun' ) => 'left',                      
						 esc_html__( 'right', 'fortun' ) => 'right'
						),
					'dependency' => array( 'element' => 'style', 'value' => '1' ),
					'std' => 'center'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Count Animation', 'fortun' ),
					'param_name' => 'count',
					'description' => esc_html__( 'if you want the count animation enable it.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Animation Offset', 'fortun' ),
					'param_name' => 'animation_offset',
					'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the counter only when the element reach 90% from the top.', 'fortun' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => '90%'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number Seperator', 'fortun' ),
					'param_name' => 'mile_separator',
					'description' => esc_html__( 'You can use any letter, number or special characters. just keep empty for no seperator.', 'fortun' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number prefix', 'fortun' ),
					'param_name' => 'mile_prefix',
					'description' => esc_html__( 'You can use any letter, number or special characters. just keep empty for no prefix.', 'fortun' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number suffix', 'fortun' ),
					'param_name' => 'mile_suffix',
					'description' => esc_html__( 'You can use any letter, number or special characters. just keep empty for no suffix.', 'fortun' ),
					'dependency' => array( 'element' => 'count', 'value' => '1' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Progress Bar
		vc_map( array(
			'name' => esc_html__( 'Progress Bar', 'fortun' ),
			'base' => 'agni_progressbar',
			'icon' => 'ion-ios-settings',
			'weight' => '86',
			'category' => esc_html__( 'Graphic', 'fortun' ),
			'description' => esc_html__( 'Progress bar for your site!!..', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Progress bar Style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'fortun' ) => '1',
						 esc_html__( 'Style 2', 'fortun' ) => '2', 
						),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Percentage', 'fortun' ),
					'param_name' => 'percentage',
					'description' => esc_html__( 'Progress bar completion percentage for eg. 80', 'fortun' ),
					'std' => '80'
				),              
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'fortun' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Progress bar title', 'fortun' ),
					'std' => 'Progress bar'
				),  
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Track Color', 'fortun' ),
					'param_name' => 'track_color',
					'description' => esc_html__( 'select the progress bar color', 'fortun' ),
					'std' => ''
				),  
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Bar Color', 'fortun' ),
					'param_name' => 'bar_color',
					'description' => esc_html__( 'select the progress bar color', 'fortun' ),
					'std' => ''
				),  
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Animation Offset', 'fortun' ),
					'param_name' => 'animation_offset',
					'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the progressbar only when the element reach 90% from the top.', 'fortun' ),
					'group' => esc_html__( 'Animation Settings', 'fortun' ),
					'std' => '90%'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));

		// Circle Bar
		vc_map( array(
			'name' => esc_html__( 'Circle Bar', 'fortun' ),
			'base' => 'agni_circlebar',
			'icon' => 'ion-ios-pie-outline',
			'weight' => '85',
			'category' => esc_html__( 'Graphic', 'fortun' ),
			'description' => esc_html__( 'Circle bar for your site!!..', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Circle bar Style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(
						 esc_html__( 'Style 1(Default)', 'fortun' ) => '1',
						 esc_html__( 'Style 2', 'fortun' ) => '2', 
						),
					'description' => esc_html__( 'choose Style 2 to show icon instead of percentage', 'fortun' ),
					'std' => '1'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'style', 'value' => '2' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Percentage to Fill', 'fortun' ),
					'param_name' => 'percentage',
					'description' => esc_html__( 'Circle bar completion percentage', 'fortun' ),
					'std' => '75'
				),
								
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Size', 'fortun' ),
					'param_name' => 'size',
					'description' => esc_html__( 'size of circle bar..  for.eg 160', 'fortun' ),
					'std' => '160'
				),
				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Track Color', 'fortun' ),
					'param_name' => 'track_color',
					'description' => esc_html__( 'select the track color for the circle bar. if you don\'t want to use color just leave it blank. ', 'fortun' ),
					'std' => ''
				),
				
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Bar Color', 'fortun' ),
					'param_name' => 'bar_color',
					'description' => esc_html__( 'select the bar color for the circle bar. if you don\'t want  to use color just leave it blank. ', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Scale Color', 'fortun' ),
					'param_name' => 'scale_color',
					'description' => esc_html__( 'select the scale color for the circle bar. if you don\'t want  to use color just leave it blank.', 'fortun' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Scale Length', 'fortun' ),
					'param_name' => 'scale_length',
					'description' => esc_html__( 'scale length for circle bar.  for.eg 15', 'fortun' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Line Width', 'fortun' ),
					'param_name' => 'line_width',
					'description' => esc_html__( 'Line length for circle bar.  for.eg 4', 'fortun' ),
					'std' => '4'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Line Cap', 'fortun' ),
					'param_name' => 'line_cap',
					'description' => esc_html__( 'butt, round and square.. are the options for line cap', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Alignment', 'fortun' ),
					'param_name' => 'align',
					'value' => array(
						 esc_html__('center', 'fortun') => 'center',
						 esc_html__( 'left', 'fortun' ) => 'left',                      
						 esc_html__( 'right', 'fortun' ) => 'right'
						),
					'std' => 'center'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Animation', 'fortun' ),
					'param_name' => 'animation',
					'value' => array(
						'linear'=>'defaultEasing',
						'swing'=>'swing',
						'easeInQuad'=>'easeInQuad',
						'easeOutQuad' => 'easeOutQuad',
						'easeInOutQuad'=>'easeInOutQuad',
						'easeInCubic'=>'easeInCubic',
						'easeOutCubic'=>'easeOutCubic',
						'easeInOutCubic'=>'easeInOutCubic',
						'easeInQuart'=>'easeInQuart',
						'easeOutQuart'=>'easeOutQuart',
						'easeInOutQuart'=>'easeInOutQuart',
						'easeInQuint'=>'easeInQuint',
						'easeOutQuint'=>'easeOutQuint',
						'easeInOutQuint'=>'easeInOutQuint',
						'easeInExpo'=>'easeInExpo',
						'easeOutExpo'=>'easeOutExpo',
						'easeInOutExpo'=>'easeInOutExpo',
						'easeInSine'=>'easeInSine',
						'easeOutSine'=>'easeOutSine',
						'easeInOutSine'=>'easeInOutSine',
						'easeInCirc'=>'easeInCirc',
						'easeOutCirc'=>'easeOutCirc',
						'easeInOutCirc'=>'easeInOutCirc',
						'easeInElastic'=>'easeInElastic',
						'easeOutElastic'=>'easeOutElastic',
						'easeInOutElastic'=>'easeInOutElastic',
						'easeInBack'=>'easeInBack',
						'easeOutBack'=>'easeOutBack',
						'easeInOutBack'=>'easeInOutBack',
						'easeInBounce'=>'easeInBounce',
						'easeOutBounce'=>'easeOutBounce',
						'easeInOutBounce'=>'easeInOutBounce',
					
					),
					'description' => esc_html__( 'Select the animation which you want.', 'fortun' ),
					'std' => 'linear'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Animation Offset', 'fortun' ),
					'param_name' => 'animation_offset',
					'description' => esc_html__( 'You can use "simply number" or "%" to denote the offset. for ex. 90%. It will trigger the counter only when the element reach 90% from the top.', 'fortun' ),
					'group' => esc_html__( 'Animation Settings', 'fortun' ),
					'std' => '90%'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// List
		vc_map( array(
			'name' => esc_html__( 'List', 'fortun' ),
			'base' => 'agni_list',
			'icon' => 'ion-ios-list-outline',
			'weight' => '84',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'List with icons ( Ionicons, Fontawesome )', 'fortun' ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon style', 'fortun' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Select how the heading will be aligned', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'not_empty' => true ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('This will apply if the heading has divide line.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Border Color', 'fortun' ),
					'param_name' => 'border_color',
					'description' => esc_html__('This will apply if the heading has border.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('This will apply if the heading has divide line.', 'fortun' ),
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'List items', 'fortun' ),
					'param_name' => 'content',
					'value' => '<li>List item</li><li>List item</li><li>List item</li>',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
				
			)
		
		));
		
		// Button
		vc_map( array(
			'name' => esc_html__( 'Button', 'fortun' ),
			'base' => 'agni_button',
			'icon' => 'ion-ios-circle-outline',
			'weight' => '83',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Various Button for eg. success, block', 'fortun' ),
			'params' => array(      
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'fortun' ),
					'class' => 'wpb_button',
					'param_name' => 'value',
					'description' => esc_html__( 'Value for the button.', 'fortun' ),
					'std' => 'Button'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'value' => '',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'std' => ''
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Button URL', 'fortun' ),
					'param_name' => 'url',
					'description' => esc_html__( 'URL for the button.', 'fortun' ),
					'std' => '#'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Target', 'fortun' ),
					'param_name' => 'target',
					'value' => array(   
						esc_html__( 'Same window', 'fortun' ) => '_self',
						esc_html__( 'New window', 'fortun' ) => '_blank'
					),
					'std' => '_self'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Background(Default)', 'fortun') => '',
						 esc_html__( 'Bordered', 'fortun') => 'alt'
					),
					'description' => esc_html__( 'Select the button style.', 'fortun' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => '50'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose button type', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => 'default',
						 esc_html__( 'Primary', 'fortun') => 'primary',
						 esc_html__( 'Accent', 'fortun') => 'accent',
						 esc_html__( 'White', 'fortun') => 'white'
					),
					'description' => esc_html__( 'Select the button type.', 'fortun' ),
					'std' => 'default'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'fortun' ),
					'param_name' => 'size',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => '',
						 esc_html__( 'Large', 'fortun') => 'lg',
						 esc_html__( 'Small', 'fortun' ) => 'sm',
						 esc_html__( 'Extra Small', 'fortun' ) => 'xs',
						 esc_html__( 'Block', 'fortun' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button..', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Inline Button', 'fortun' ),
					'param_name' => 'inline',
					'description' => esc_html__( 'It will bring the buttons to the same line.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'inline' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Alignment', 'fortun' ),
					'param_name' => 'alignment',
					'value' => array(   
						 esc_html__( 'Left', 'fortun') => 'left',
						 esc_html__( 'Center', 'fortun') => 'center',
						 esc_html__( 'Right', 'fortun' ) => 'right',
					),
					'description' => esc_html__( 'Select the Alignment of the button.', 'fortun' ),
					'std' => 'left',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Top margin', 'fortun' ),
					'param_name' => 'margin_top',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Left margin', 'fortun' ),
					'param_name' => 'margin_left',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Bottom margin', 'fortun' ),
					'param_name' => 'margin_bottom',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Right margin', 'fortun' ),
					'param_name' => 'margin_right',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				$parallax_atts,
				$parallax_start_atts,
				$parallax_end_atts,
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Alerts
		vc_map( array(
			'name' => esc_html__( 'Alerts', 'fortun' ),
			'base' => 'agni_alerts',
			'icon' => 'ion-ios-alarm-outline',
			'weight' => '82',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'List with icons ( Ionicons, Fontawesome )', 'fortun' ),
			'params' => array(
								
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the style', 'fortun' ),
					'param_name' => 'choice',
					'value' => array(   
						 esc_html__( 'Success', 'fortun') => 'success',
						 esc_html__( 'Danger', 'fortun') => 'danger',
						 esc_html__( 'Warning', 'fortun' ) => 'warning',
						 esc_html__( 'Info', 'fortun' ) => 'info',
					),
					'description' => esc_html__( 'Choose the releavant alert message type. ', 'fortun' ),
					'std' => 'success'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Dismissable alert', 'fortun' ),
					'param_name' => 'dismissable',
					'description' => esc_html__( 'if you want the close button. just check this.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
					'std' => ''
				),
				
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Alert Message', 'fortun' ),
					'param_name' => 'content',
					'value' => 'Nam convallis velit ac nibh imperdiet, eget euismod eros consequat.',
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Image
		vc_map( array(
			'name' => esc_html__( 'Image', 'fortun' ),
			'base' => 'agni_image',
			'icon' => 'ion-ios-camera-outline',
			'weight' => '81',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Choose whether to use Simple image or Before/After Image.', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choice', 'fortun' ),
					'param_name' => 'img_type',
					'description' => esc_html__( 'choose image size', 'fortun' ),
					'value' => array(   
						 esc_html__( 'Simple Image', 'fortun') => 'default',
						 esc_html__( 'Before/After', 'fortun') => 'beforeafter',
					),
					'std' => 'default'
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'fortun' ),
					'param_name' => 'img_url',
					'description' => esc_html__( 'Select image from media library. It will act a before image, if you use Before/After.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'After Image', 'fortun' ),
					'param_name' => 'img_after_url',
					'description' => esc_html__( 'Select image from media library.', 'fortun' ),
					'dependency' => array( 'element' => 'img_type', 'value' => 'beforeafter' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image size', 'fortun' ),
					'param_name' => 'img_size',
					'description' => esc_html__( 'choose image size', 'fortun' ),
					'value' => array(   
						 esc_html__( 'thumbnail', 'fortun') => 'thumbnail',
						 esc_html__( 'medium', 'fortun') => 'medium',
						 esc_html__( 'large', 'fortun') => 'large',
						 esc_html__( 'Full', 'fortun') => 'full',
						 esc_html__( 'Custom', 'fortun') => 'custom',
					),
					'std' => 'full'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom Image Size', 'fortun' ),
					'param_name' => 'img_size_custom',
					'description' => esc_html__( 'It will hard crop all images to the mentioned dimensions.', 'fortun' ),
					'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
					'std' => '640x640'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add caption?', 'fortun' ),
					'param_name' => 'img_caption',
					'description' => esc_html__( 'Add image caption.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Grayscale Filter', 'fortun' ),
					'param_name' => 'img_gs_filter',
					'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image alignment', 'fortun' ),
					'param_name' => 'alignment',
					'value' => array(
						esc_html__( 'Left', 'fortun' ) => 'left',
						esc_html__( 'Right', 'fortun' ) => 'right',
						esc_html__( 'Center', 'fortun' ) => 'center'
					),
					'description' => esc_html__( 'Select image alignment.', 'fortun' ),
					'std' => 'left'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image style', 'fortun' ),
					'param_name' => 'img_style',
					'value' => array(
						 esc_html__( 'None', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'bordered',
						),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('choose the background color for image.', 'fortun' ),
					'dependency' => array( 'element' => 'img_style', 'value' => 'background' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'fortun' ),
					'param_name' => 'border_color',
					'description' => esc_html__('choose the border color for image.', 'fortun' ),
					'dependency' => array( 'element' => 'img_style', 'value' => 'bordered' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'On click action', 'fortun' ),
					'param_name' => 'img_link',
					'value' => array(
						esc_html__( 'None', 'fortun' ) => '1',
						esc_html__( 'Attachment Image', 'fortun' ) => '2',
						esc_html__( 'Lightbox', 'fortun' ) => '3',
						esc_html__( 'Custom link', 'fortun' ) => '4',
						//esc_html__( 'Zoom', 'fortun' ) => '5',
					),
					'description' => esc_html__( 'Select action for click action.', 'fortun' ),
					'dependency' => array( 'element' => 'img_type', 'value' => 'default' ),
					'std' => '1'
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Image link', 'fortun' ),
					'param_name' => 'img_custom_link',
					'description' => esc_html__( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'fortun' ),
					'dependency' => array( 'element' => 'img_link', 'value' => '4', ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'On click target', 'fortun' ),
					'param_name' => 'img_custom_link_target',
					'value' => array(
						esc_html__( 'Same Window', 'fortun' ) => '_self',
						esc_html__( 'New Window', 'fortun' ) => '_blank',
					),
					'description' => esc_html__( 'Select target for click action.', 'fortun' ),
					'dependency' => array( 'element' => 'img_link', 'value' => '4' ),
					'std' => '_self'
				),
				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,

				$parallax_atts,
				$parallax_start_atts,
				$parallax_end_atts,

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		) );
		
		// Gallery
		global $vc_column_width_list;
		vc_map( array(
			'name' => esc_html__( 'Gallery', 'fortun' ),
			'base' => 'agni_gallery',
			'icon' => 'ion-ios-albums-outline',
			'weight' => '80',
			'category' => esc_html__( 'Media', 'fortun' ),
			'description' => esc_html__( 'group of image with lightbox gallery.', 'fortun' ),
			'params' => array(
				
				array(
					'type' => 'attach_images',
					'heading' => esc_html__( 'Select Image', 'fortun' ),
					'param_name' => 'img_url',
					'description' => esc_html__( 'Select the image', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Image size', 'fortun' ),
					'param_name' => 'img_size',
					'description' => esc_html__( 'choose image size', 'fortun' ),
					'value' => array(   
						 esc_html__( 'thumbnail', 'fortun') => 'thumbnail',
						 esc_html__( 'medium', 'fortun') => 'medium',
						 esc_html__( 'large', 'fortun') => 'large',
						 esc_html__( 'Full', 'fortun') => 'full',
						 esc_html__( 'Custom', 'fortun') => 'custom',
					),
					'std' => 'full'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Custom Image Size', 'fortun' ),
					'param_name' => 'img_size_custom',
					'description' => esc_html__( 'It will hard crop all images to the mentioned dimensions.', 'fortun' ),
					'dependency' => array( 'element' => 'img_size', 'value' => 'custom' ),
					'std' => '640x640'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Add caption?', 'fortun' ),
					'param_name' => 'img_caption',
					'description' => esc_html__( 'Add image caption.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
					'std' => ''
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Grayscale Filter', 'fortun' ),
					'param_name' => 'img_gs_filter',
					'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'yes' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'On click action', 'fortun' ),
					'param_name' => 'img_link',
					'value' => array(
						esc_html__( 'None', 'fortun' ) => '1',
						esc_html__( 'Attachment Image', 'fortun' ) => '2',
						esc_html__( 'Lightbox', 'fortun' ) => '3',
					),
					'description' => esc_html__( 'Select action for click action.', 'fortun' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Gap(Gutter)', 'fortun' ),
					'param_name' => 'gap',
					'description' => esc_html__( 'Gap between each item. Enter values in px. Don\'t include "px" string', 'fortun' ),
					'std' => '30'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Display type', 'fortun' ),
					'param_name' => 'type',
					'value' => array(   
						 esc_html__( 'Carousel', 'fortun') => '1',
						 esc_html__( 'Grid', 'fortun') => '2',
					),
					'description' => esc_html__( 'you can choose your desire type, it allows you to decide whether you need carousel or not. ', 'fortun' ),
					'std' => '2'
				),
				array(
                    'type'     => 'dropdown',
                    'heading'    => esc_html__( 'Gallery Grid Style', 'fortun' ),
                    'param_name' => 'gallery-grid-layout',
                    'description' => esc_html__( 'Choose any of one grid style. fitRows is default.', 'fortun' ),
                    'value' => array(
                        esc_html__( 'FitRows(Default Grid)', 'fortun') => 'fitRows',
                        esc_html__( 'Masonry', 'fortun') => 'masonry',
                    ),
                    'dependency' => array( 'element' => 'type', 'value' => '2' ),
                    'std'  => 'fitRows'
                ),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Number of Columns', 'fortun' ),
					'param_name' => 'column',
					'value' => array(   
						 esc_html__( '1 column', 'fortun' ) => '1',
						 esc_html__( '2 columns', 'fortun' ) => '2',
						 esc_html__( '3 columns', 'fortun' ) => '3',
						 esc_html__( '4 columns', 'fortun' ) => '4',
						 esc_html__( '5 columns', 'fortun' ) => '5',
						 esc_html__( '6 columns', 'fortun' ) => '6',
					),
					'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'fortun' ),
					//'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std' => '3'
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Carousel Holder', 'fortun' ),
					'param_name' => 'carousel_type',
					'value' => array(
						esc_html__( 'Img tag', 'fortun' ) => 'img-carousel',
						esc_html__( 'Background', 'fortun' ) => 'bg-carousel',
					),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std' => 'img-carousel'
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'fortun' ),
					'param_name' => 'carousel_height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels. Tip. for 100% Viewport height use "100vh"', 'fortun' ),
					'dependency' => array( 'element' => 'carousel_type', 'value' => 'bg-carousel' ),
					'std' => '500'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Autoplay', 'fortun' ),
					'param_name' => 'gallery_autoplay',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => '1'
				),  
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Timeout duration', 'fortun' ),
					'param_name' => 'gallery_autoplay_timeout',
					'description' => esc_html__( 'Enter the duration of each slide Transition', 'fortun' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'gallery_autoplay', 'value' => '1' ),
					'std' => '5000',
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Pause on Hover', 'fortun' ),
					'param_name' => 'gallery_autoplay_hover',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'gallery_autoplay', 'value' => '1' ),
					'std'  => '1',
				),
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Loop', 'fortun' ),
					'param_name' => 'gallery_loop',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => '1'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Center', 'fortun' ),
					'param_name' => 'gallery_center',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => ''
				), 
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Height', 'fortun' ),
					'param_name' => 'gallery_autoheight',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => ''
				), 
				
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Pagination', 'fortun' ),
					'param_name' => 'gallery_pagination',
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'group' => esc_html__( 'Carousel Settings', 'fortun' ),
					'dependency' => array( 'element' => 'type', 'value' => '1' ),
					'std'  => '1'
				),

				$animation_atts,
				$animation_style_atts, 
				$animation_duration_atts,
				$animation_delay_atts,
				$animation_offset_atts,
			)
		
		));
		
		// Video
		vc_map( array(
			'name' => esc_html__( 'Video', 'fortun' ),
			'base' => 'agni_video',
			'icon' => 'ion-ios-play-outline',
			'weight' => '79',
			'category' => esc_html__( 'Media', 'fortun' ),
			'description' => esc_html__( 'Youtube, Vimeo, etc.. any embedded video', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Video Type', 'fortun' ),
					'param_name' => 'video_type',
					'value' => array(   
						 esc_html__( 'Youtube Video', 'fortun') => '1',
						 esc_html__( 'Self Hosted Video', 'fortun') => '2',
						 esc_html__( 'Lightbox Video', 'fortun') => '3',
						 esc_html__( 'Embed Video', 'fortun') => '4',
					),
					'description' => esc_html__( 'if you want ordinary youtube or vimeo video container. then choose Default. ', 'fortun' ),
					'std' => '1'
				),
				
				array(
					'type' => 'href',
					'heading' => esc_html__( 'URL', 'fortun' ),
					'param_name' => 'url',
					'description' => esc_html__( 'Youtube URL of the Video', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Fallback Image', 'fortun' ),
					'param_name' => 'fallback',
					'description' => esc_html__( 'This player will not work on mobile device. so you set the fallback image here', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Overlay Opacity', 'fortun' ),
					'param_name' => 'overlay_opacity',
					'description' => esc_html__( 'Set your opacity amount range from 0 to 1', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '0.6'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Video Height', 'fortun' ),
					'param_name' => 'youtube_height',
					'description' => esc_html__( 'height of video container!.. for eg.450', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '360'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Play', 'fortun' ),
					'param_name' => 'auto_play',
					'description' => esc_html__( 'video starts automatically..', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'true'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Loop', 'fortun' ),
					'param_name' => 'loop',
					'description' => esc_html__( 'It repeat the video once completed!.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'true'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Volume level', 'fortun' ),
					'param_name' => 'vol',
					'description' => esc_html__( 'Set a default volume level of the video..for eg. 50', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '50'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Mute', 'fortun' ),
					'param_name' => 'mute',
					'description' => esc_html__( 'Muted video', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'true' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'true'
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Start at', 'fortun' ),
					'param_name' => 'start_at',
					'description' => esc_html__( 'Starting from N second.. for eg. 20 ', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '0'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Stop at', 'fortun' ),
					'param_name' => 'stop_at',
					'description' => esc_html__( 'Starting from N second.. for eg. 30 ', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => '30'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the quality', 'fortun' ),
					'param_name' => 'quality',
					'value' => array(   
						 esc_html__( 'Default(small)', 'fortun') => 'default',
						 esc_html__( 'Medium', 'fortun') => 'medium',
						 esc_html__( 'Large', 'fortun') => 'large',
						 esc_html__( '720p', 'fortun' ) => 'hd720',
						 esc_html__( '1080p', 'fortun' ) => 'hd1080',
						 esc_html__( 'High', 'fortun' ) => 'highres',
					),
					'description' => esc_html__( 'Choose the releavant resolution quality!!.. ', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '1' ),
					'std' => 'default'
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'Video URL', 'fortun' ),
					'param_name' => 'self_url',
					'description' => esc_html__( 'To find media url go to "Media" menu at left side panel and click on your(desire) media file. now you can find url at right side panel. copy/paste the url here', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => ''
				),
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Poster Image', 'fortun' ),
					'param_name' => 'self_poster',
					'description' => esc_html__( 'This poster will be shown before video get started.', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => ''
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the player', 'fortun' ),
					'param_name' => 'self_player',
					'value' => array(   
						 esc_html__( 'Default(HTML 5 player)', 'fortun') => '1',
						 esc_html__( 'WordPress player', 'fortun') => '2',
					),
					'description' => esc_html__( 'Choose the style which you would like to have. ', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => '1'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Auto Play', 'fortun' ),
					'param_name' => 'self_auto_play',
					'description' => esc_html__( 'video starts automatically..', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'on' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => 'on'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Loop', 'fortun' ),
					'param_name' => 'self_loop',
					'description' => esc_html__( 'It repeat the video once completed!.', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'on' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '2' ),
					'std' => 'on'
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Mute', 'fortun' ),
					'param_name' => 'self_mute',
					'description' => esc_html__( 'it will Mute the video(volume 0)', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => 'on' ),
					'dependency' => array( 'element' => 'self_player', 'value' => '1' ),
					'std' => 'on'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Preload', 'fortun' ),
					'param_name' => 'self_preload',
					'value' => array(   
						 esc_html__( 'metadata', 'fortun') => 'metadata',
						 esc_html__( 'none', 'fortun') => 'none',
						 esc_html__( 'auto', 'fortun') => 'auto',
					),
					'dependency' => array( 'element' => 'self_player', 'value' => '2' ),
					'std' => 'metadata'
				),
				array(
					'type' => 'href',
					'heading' => esc_html__( 'URL', 'fortun' ),
					'param_name' => 'iframe_url',
					'description' => esc_html__( 'Youtube/Vimeo URL of the Video', 'fortun' ),
					'dependency' => array( 'element' => 'video_type', 'value' => '3' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Link Style to open Lightbox', 'fortun' ),
					'param_name' => 'iframe_style',
					'value' => array(   
						 esc_html__( 'Button', 'fortun') => '1',
						 esc_html__( 'Icon', 'fortun') => '2',
					),
					'dependency' => array( 'element' => 'video_type', 'value' => '3' ),
					'std' => '1'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Button Value', 'fortun' ),
					'class' => 'wpb_button',
					'param_name' => 'button_value',
					'description' => esc_html__( 'Value for the button!!..', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => 'Button'
				),
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Choose Icon', 'fortun' ),
					'param_name' => 'icon',
					'settings' => array(
						'type' => 'iconlist',
						'iconsPerPage' => 545,
					),
					'description' => wp_kses( __( '<small>Select the icon which you want <strong><a href="http://ionicons.com/">Ionicons</a>, <a href="http://fortawesome.github.io/Font-Awesome/icons/">FontAwesome</a>, <a href="http://themes-pixeden.com/font-demos/7-stroke/index.html">Pe Icon 7 Stroke</a>, <a href="http://themes-pixeden.com/font-demos/7-filled/index.html">Pe Icon 7 Filled</a> supported.</strong></small>', 'fortun' ), array( 'small' => array(), 'strong' => array(), 'a' => array( 'href' => array() ) ) ),
					'dependency' => array( 'element' => 'video_type', 'value' => '3' ),
					'std' => ''
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'button style', 'fortun' ),
					'param_name' => 'button_style',
					'value' => array(   
						 esc_html__( 'Background(Default)', 'fortun') => '',
						 esc_html__( 'Bordered', 'fortun') => 'alt'
					),
					'description' => esc_html__( 'Select the button style...', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'button_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose button type', 'fortun' ),
					'param_name' => 'button_choice',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => 'default',
						 esc_html__( 'Primary', 'fortun') => 'primary',
						 esc_html__( 'Accent', 'fortun') => 'accent',
						 esc_html__( 'White', 'fortun') => 'white'
					),
					'description' => esc_html__( 'Select the button type...', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => 'default'
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose the size of button', 'fortun' ),
					'param_name' => 'button_size',
					'value' => array(   
						 esc_html__( 'Default', 'fortun') => '',
						 esc_html__( 'Large', 'fortun') => 'lg',
						 esc_html__( 'Small', 'fortun' ) => 'sm',
						 esc_html__( 'Extra Small', 'fortun' ) => 'xs',
						 esc_html__( 'Block', 'fortun' ) => 'block',
					),
					'description' => esc_html__( 'Select the size of the button..', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Button Alignment', 'fortun' ),
					'param_name' => 'button_alignment',
					'value' => array(   
						 esc_html__( 'Left', 'fortun') => 'left',
						 esc_html__( 'Center', 'fortun') => 'center',
						 esc_html__( 'Right', 'fortun' ) => 'right',
					),
					'description' => esc_html__( 'Select the Alignment of the button..', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '1' ),
					'std' => 'left',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Size', 'fortun' ),
					'param_name' => 'size',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels. for ex.24', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '32',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon style', 'fortun' ),
					'param_name' => 'icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Select how the heading will be aligned', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Width', 'fortun' ),
					'param_name' => 'width',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'fortun' ),
					'param_name' => 'height',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '72',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius', 'fortun' ),
					'param_name' => 'radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'background_color',
					'description' => esc_html__('choose the dropdown background color.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'background' ),
					'std' => '#f0f1f2',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'fortun' ),
					'param_name' => 'border_color',
					'description' => esc_html__('choose the dropdown border color.', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('This will apply if the heading has divide line.', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '#000000',
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon style on hover', 'fortun' ),
					'param_name' => 'hover_icon_style',
					'value' => array(
						 esc_html__( 'Default', 'fortun' ) => '',
						 esc_html__( 'Background', 'fortun' ) => 'background',
						 esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
					'description' => esc_html__( 'Select how the heading will be aligned', 'fortun' ),
					'dependency' => array( 'element' => 'icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Radius on hover', 'fortun' ),
					'param_name' => 'hover_radius',
					'description' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => array( 'border', 'background' ) ),
					'std' => '50%',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color on hover', 'fortun' ),
					'param_name' => 'hover_background_color',
					'description' => esc_html__('choose the dropdown background color.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'background' ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color on hover', 'fortun' ),
					'param_name' => 'hover_border_color',
					'description' => esc_html__('choose the dropdown border color.', 'fortun' ),
					'dependency' => array( 'element' => 'hover_icon_style', 'value' => 'border' ),
					'std' => '#000000',
				),

				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icon Color on hover', 'fortun' ),
					'param_name' => 'hover_color',
					'description' => esc_html__('This will apply if the heading has divide line!!..', 'fortun' ),
					'dependency' => array( 'element' => 'iframe_style', 'value' => '2' ),
					'std' => '#ffffff',
				),
				
				array(
					'type' => 'textarea_safe',
					'heading' => esc_html__( 'Video embed iframe', 'fortun' ),
					'param_name' => 'embed',
					'description' => esc_html__('Your embeded URL to display a video.. all video source supported', 'fortun'),
					'dependency' => array( 'element' => 'video_type', 'value' => '4' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		// Gmap
		vc_map( array(
			'name' => esc_html__( 'Gmap', 'fortun' ),
			'base' => 'agni_gmap',
			'icon' => 'ion-ios-location-outline',
			'weight' => '78',
			'category' => esc_html__( 'Graphic', 'fortun' ),
			'description' => esc_html__( 'Google Map', 'fortun' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Height', 'fortun' ),
					'param_name' => 'height',
					'description' => esc_html__( 'Enter your desired map Height. You can use px, vh, etc. or enter just number and it will use pixels. IMPORTANT: Make sure that you\'ve added the API Key at "Fortun(option panel)/Home Settings/Additional" ', 'fortun' ),
					'std' => '400'
				),

				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Map Marker', 'fortun' ),
					'param_name' => 'google_map_icon',
					'value' => '',
					'description' => esc_html__( 'Select image from media library. icon size should be 48x48', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Google Map Latitude', 'fortun' ),
					'param_name' => 'google_map_lat',
					'description' => esc_html__( 'enter your latitude value <strong>for ex. 10.010509</strong> ', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Google Map Longitude', 'fortun' ),
					'param_name' => 'google_map_lng',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address Line 1', 'fortun' ),
					'param_name' => 'google_address_1',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address Line 2', 'fortun' ),
					'param_name' => 'google_address_2',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address Line 3', 'fortun' ),
					'param_name' => 'google_address_3',
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Google Map Latitude 2', 'fortun' ),
					'param_name' => 'google_map_lat_2',
					'description' => esc_html__( 'enter your latitude value <strong>for ex. 10.010509</strong> ', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Google Map Longitude 2', 'fortun' ),
					'param_name' => 'google_map_lng_2',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address Line 1', 'fortun' ),
					'param_name' => 'google_address_1_2',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address Line 2', 'fortun' ),
					'param_name' => 'google_address_2_2',
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Address Line 3', 'fortun' ),
					'param_name' => 'google_address_3_2',
					'std' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Zoom level', 'fortun' ),
					'param_name' => 'zoom',
					'value' => array(   
						 esc_html__( '1', 'fortun') => '1',
						 esc_html__( '3', 'fortun') => '3',
						 esc_html__( '5', 'fortun') => '5',
						 esc_html__( '7', 'fortun') => '7',
						 esc_html__( '9', 'fortun') => '9',
						 esc_html__( '11', 'fortun') => '11',
						 esc_html__( '12', 'fortun') => '12',
						 esc_html__( '13', 'fortun') => '13',
						 esc_html__( '14', 'fortun') => '14',
						 esc_html__( '15', 'fortun') => '15',
						 esc_html__( '16', 'fortun') => '16',
						 esc_html__( '17', 'fortun') => '17',
						 esc_html__( '18', 'fortun') => '18',
						 esc_html__( '19', 'fortun') => '19',
						 esc_html__( '20', 'fortun') => '20',
					),
					'std' => '16'
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Choose Map Style', 'fortun' ),
					'param_name' => 'style',
					'value' => array(   
						 esc_html__( 'Style 1', 'fortun') => '1',
						 esc_html__( 'Style 2', 'fortun') => '2',
						 esc_html__( 'Style 3', 'fortun') => '3',
						 esc_html__( 'Style 4', 'fortun') => '4',
					),
					'std' => '1'
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Map Accent Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('choose the color for water in the map.', 'fortun' ),
					'dependency' => array( 'element' => 'style', 'value' => '3' ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Disable Dragging in Mobile', 'fortun' ),
					'param_name' => 'drag',
					'description' => esc_html__( 'it will disable the dragging at mobile devices', 'fortun' ),
					'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'ID', 'fortun' ),
					'param_name' => 'id',
					'description' => esc_html__( 'ID is mandatory to show more than one map.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));

		// Countdown
		vc_map( array(
			'name' => esc_html__( 'Countdown', 'fortun' ),
			'base' => 'agni_countdown',
			'icon' => 'ion-ios-timer-outline',
			'weight' => '77',
			'category' => esc_html__( 'Graphic', 'fortun' ),
			'description' => esc_html__( 'counter for Comingsoon/any page.', 'fortun' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Date', 'fortun' ),
					'param_name' => 'date',
					'description' => esc_html__( 'you can type your deadline. for ex. 20 January 2016 10:45:00', 'fortun' ),
					'std' => '20 January 2016 10:45:00'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'fortun' ),
					'param_name' => 'label',
					'description' => esc_html__( 'you can type your label format.', 'fortun' ),
					'std' => 'Day|Days|Hour|Hours|Minute|Minutes|Second|Seconds'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));
		
		$custom_menus = array();
		if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
			if ( is_array( $menus ) && ! empty( $menus ) ) {
				foreach ( $menus as $single_menu ) {
					if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->term_id ) ) {
						$custom_menus[ $single_menu->name ] = $single_menu->term_id;
					}
				}
			}
		}
		// Menu
		vc_map( array(
			'name' => esc_html__( 'Navigation Menu', 'fortun' ),
			'base' => 'agni_menu',
			'icon' => 'ion-ios-drag',
			'weight' => '75',
			'category' => esc_html__( 'Content', 'fortun' ),
			'description' => esc_html__( 'Place Menus which you have created at Appearance/Menus', 'fortun' ),
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Menu', 'fortun' ),
					'param_name' => 'nav_menu',
					'value' => $custom_menus,
					'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'fortun' ) : esc_html__( 'Select menu to display.', 'fortun' ),
					'save_always' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Fullwidth Menu', 'fortun' ),
					'param_name' => 'fullwidth',
					'weight' => '1',
					'value' => array(
						esc_html__( 'Default(container)', 'fortun' ) => '',
						esc_html__( 'Fullwidth Menu', 'fortun' ) => '-fluid',
					),
					'description' => esc_html__( 'choose any one to display the content on this paricular row. This option affect only the content not the background.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Background Color', 'fortun' ),
					'param_name' => 'bg_color',
					'description' => esc_html__('choose the color for background.', 'fortun' ),
					'std' => '#ff655c',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'fortun' ),
					'param_name' => 'color',
					'description' => esc_html__('choose the color for text.', 'fortun' ),
					'std' => '#fff',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		) );
		
		// Catalog
		vc_map( array(
			'name' => esc_html__( 'Menu Card', 'fortun' ),
			'base' => 'agni_menu_card',
			'icon' => 'ion-ios-nutrition-outline',
			'weight' => '74',
			'category' => esc_html__( 'Media', 'fortun' ),
			'description' => esc_html__( 'Create your restaurant menu card/catalog here.', 'fortun' ),
			'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'fortun' ),
					'param_name' => 'img_url',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'fortun' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Menu Item Title', 'fortun' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter your service title/text', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Title Color', 'fortun' ),
					'param_name' => 'title_color',
					'description' => esc_html__('choose the color for title.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Price', 'fortun' ),
					'param_name' => 'price',
					'description' => esc_html__( 'Enter your item price.', 'fortun' ),
					'std' => ''
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Price Color', 'fortun' ),
					'param_name' => 'price_color',
					'description' => esc_html__('choose the color for price.', 'fortun' ),
					'std' => '',
				),
				array(
					'type' => 'textarea_html',
					'heading' => esc_html__( 'Description', 'fortun' ),
					'param_name' => 'content',
					'std' => ''
				),
				
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fortun' ),
					'param_name' => 'class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
				),
			)
		
		));

		if(is_plugin_active( 'agni-fortun-plugin/agni_fortun.php')){
			// Agnislider
			$agnislider_options = agni_posttype_options( array( 'post_type' => 'agni_slides'), false, true );
			$agniblock_options = agni_posttype_options( array( 'post_type' => 'agni_block'), false, true );

			// Team
			$team_options = $client_options = $test_options = $blog_options = $portfolio_options = array();

			$team_categories = get_terms('team_types');
			foreach ($team_categories as $category) {
				$team_options[$category->name] = $category->slug;
			}
			
			// Client
			$client_categories = get_terms('client_types');
			foreach ($client_categories as $category) {
				$client_options[$category->name] = $category->slug;
			}
			
			// Testimonials
			$test_categories = get_terms('quote_types');
			foreach ($test_categories as $category) {
				$test_options[$category->name] = $category->slug;
			}
			
			// Posts & Portfolio
			$blog_categories = get_categories();
			foreach ($blog_categories as $category) {
				$blog_options[$category->name] = $category->term_id;
			}
			
			$portfolio_categories = get_terms('types');     
			foreach ($portfolio_categories as $category) {
				$portfolio_options[$category->name] = $category->term_id;
			}

			if( !empty($agnislider_options) ){
				vc_map( array(
					'name' => esc_html__( 'Agni Slider', 'fortun' ),
					'base' => 'agni_agnislider',
					'icon' => 'ion-ios-monitor-outline',
					'weight' => '73',
					'category' => esc_html__( 'Media', 'fortun' ),
					'description' => esc_html__( 'Display slider which you have created at Agni Slider Menu', 'fortun' ),
					'params' => array(
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Choose Slider', 'fortun' ),
							'param_name' => 'post_id',
							'description' => esc_html__( 'Note. It will ignore the parallax settings of the slider, if any.', 'fortun' ),
							'value' => $agnislider_options,
							'admin_label' => true,
							'std' => ''
						),
					)
				));
			}

			vc_map( array(
				'name' => esc_html__( 'Agni Blocks', 'fortun' ),
				'base' => 'agni_block',
				'icon' => 'ion-ios-monitor-outline',
				'weight' => '72',
				'category' => esc_html__( 'Content', 'fortun' ),
				'description' => esc_html__( 'Display block content which you have created at Block Menu', 'fortun' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Choose Block', 'fortun' ),
						'param_name' => 'post_id',
						'description' => esc_html__( 'choose your desired content which you created at "Blocks".', 'fortun' ),
						'value' => $agniblock_options,
						'admin_label' => true,
						'std' => ''
					),
				)
			));


			vc_map( array(
				'name' => esc_html__( 'Team', 'fortun' ),
				'base' => 'agni_team',
				'icon' => 'ion-ios-people-outline',
				'weight' => '70',
				'category' => esc_html__( 'Carousel', 'fortun' ),
				'description' => esc_html__( 'display team by getting the team member post type', 'fortun' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of members to display', 'fortun' ),
						'param_name' => 'posts',
						'description' => esc_html__( 'Mention the number of posts that you want to display. -1 for infinite posts', 'fortun' ),
						'std' => '-1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'fortun' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'fortun') => 'DESC',
							 esc_html__( 'Ascending', 'fortun') => 'ASC',
						),
						'std' => 'DESC'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'fortun' ),
						'param_name' => 'order_by',
						'value' => array(                       
							 esc_html__( 'None', 'fortun') => 'none',
							 esc_html__( 'Post ID', 'fortun') => 'id',
							 esc_html__( 'Post author', 'fortun') => 'author',
							 esc_html__( 'Post title', 'fortun') => 'title',
							 esc_html__( 'Post slug', 'fortun') => 'name',
							 esc_html__( 'Date', 'fortun') => 'date',
							 esc_html__( 'Last modified date', 'fortun') => 'modified',
							 esc_html__( 'Random', 'fortun') => 'rand',
							 esc_html__( 'Comments number', 'fortun') => 'comment_count',
							 esc_html__( 'Menu order', 'fortun') => 'menu_order',
						),
						'std' => 'date'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Team Categories', 'fortun' ),
						'param_name' => 'team_categories',
						'value' => $team_options,
						'description' => esc_html__( 'Categories of Team', 'fortun' )
					),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display type', 'fortun' ),
						'param_name' => 'team_type',
						'value' => array(   
							 esc_html__( 'Carousel', 'fortun') => '1',
							 esc_html__( 'Grid', 'fortun') => '2',
						),
						'description' => esc_html__( 'you can choose your desire type, it allows you to decide whether you need carousel or not. ', 'fortun' ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Columns', 'fortun' ),
						'param_name' => 'column',
						'value' => array(   
							 esc_html__( '1 column', 'fortun') => '1',
							 esc_html__( '2 columns', 'fortun') => '2',
							 esc_html__( '3 columns', 'fortun') => '3',
							 esc_html__( '4 columns', 'fortun' ) => '4',
							 esc_html__( '5 columns', 'fortun' ) => '5'
						),
						'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'fortun' ),
						//'dependency' => array( 'element' => 'type', 'value' => '2' ),
						'std' => '3'
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'fortun' ),
						'param_name' => 'team_style',
						'value' => array(   
							 esc_html__( 'Style 1', 'fortun') => '1',
							 esc_html__( 'Style 2', 'fortun') => '2',
							 esc_html__( 'Style 3', 'fortun') => '3',
							 esc_html__( 'Style 4', 'fortun') => '4',
						),
						'description' => esc_html__( 'Various Team display style.. ', 'fortun' ),
						'std' => '1'
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover BG Color', 'fortun' ),
						'param_name' => 'member_thumbnail_hover_bg_color',
						'description' => esc_html__('choose the background color for member thumbnail.', 'fortun' ),
						'dependency' => array( 'element' => 'team_style', 'value' => array('1','4') ),
						'std' => '',
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Text Color', 'fortun' ),
						'param_name' => 'member_thumbnail_hover_color',
						'description' => esc_html__('choose the color for member thumbnail.', 'fortun' ),
						'dependency' => array( 'element' => 'team_style', 'value' => array('1','4') ),
						'std' => '',
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Member Thumbnail', 'fortun' ),
						'param_name' => 'member_show_thumbnail',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Member Name', 'fortun' ),
						'param_name' => 'member_show_name',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Member Designation', 'fortun' ),
						'param_name' => 'member_show_designation',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Member Description', 'fortun' ),
						'param_name' => 'member_show_description',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Thumbnail Hard Crop', 'fortun' ),
						'param_name' => 'member_thumbnail_hardcrop',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'member_show_thumbnail', 'value' => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Dimension', 'fortun' ),
						'param_name' => 'member_thumbnail_custom',
						'description' => esc_html__( 'Just enter your desired dimension to crop. for ex. 640x640', 'fortun' ),
						'dependency' => array( 'element' => 'member_thumbnail_hardcrop', 'value' => '1' ),
						'std' => '640x640',
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Thumbnail Grayscale Filter', 'fortun' ),
						'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). but it will not work on IE browsers.', 'fortun' ),
						'param_name' => 'member_thumbnail_gs_filter',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Gutter(Gap)', 'fortun' ),
						'param_name' => 'team_gutter',
						'description' => esc_html__( 'It will allow you to adjust the space in between each team members.', 'fortun' ),
						'std' => '30',
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Circle Image', 'fortun' ),
						'param_name' => 'circle_avatar',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'team_style', 'value' => array('2', '3') ),
						'std'  => '',
					), 
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'fortun' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
					),

					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Autoplay', 'fortun' ),
						'param_name' => 'team_autoplay',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'team_type', 'value' => '1' ),
						'std'  => '1'
					),  
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Timeout duration', 'fortun' ),
						'param_name' => 'team_autoplay_timeout',
						'description' => esc_html__( 'Enter the duration of each slide Transition', 'fortun' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'std' => '5000',
						'dependency' => array( 'element' => 'team_autoplay', 'value' => '1' )
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pause on Hover', 'fortun' ),
						'param_name' => 'team_autoplay_hover',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'std'  => '1',
						'dependency' => array( 'element' => 'team_autoplay', 'value' => '1' )
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Loop', 'fortun' ),
						'param_name' => 'team_loop',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'team_type', 'value' => '1' ),
						'std'  => '1'
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pagination', 'fortun' ),
						'param_name' => 'team_pagination',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'team_type', 'value' => '1' ),
						'std'  => '1'
					),
					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,
				)
			
			));
			
			vc_map( array(
				'name' => esc_html__( 'Clients', 'fortun' ),
				'base' => 'agni_clients',
				'icon' => 'ion-ios-personadd-outline',
				'weight' => '69',
				'category' => esc_html__( 'Carousel', 'fortun' ),
				'description' => esc_html__( 'display clients by getting the clients post type', 'fortun' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of clients to display', 'fortun' ),
						'param_name' => 'posts',
						'description' => esc_html__( 'Mention the number of posts that you want to display!!.. -1 for infinite posts', 'fortun' ),
						'std' => '-1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'fortun' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'fortun') => 'DESC',
							 esc_html__( 'Ascending', 'fortun') => 'ASC',
						),
						'std' => 'DESC'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'fortun' ),
						'param_name' => 'order_by',
						'value' => array(                       
							 esc_html__( 'None', 'fortun') => 'none',
							 esc_html__( 'Post ID', 'fortun') => 'id',
							 esc_html__( 'Post author', 'fortun') => 'author',
							 esc_html__( 'Post title', 'fortun') => 'title',
							 esc_html__( 'Post slug', 'fortun') => 'name',
							 esc_html__( 'Date', 'fortun') => 'date',
							 esc_html__( 'Last modified date', 'fortun') => 'modified',
							 esc_html__( 'Random', 'fortun') => 'rand',
							 esc_html__( 'Comments number', 'fortun') => 'comment_count',
							 esc_html__( 'Menu order', 'fortun') => 'menu_order',
						),
						'std' => 'date'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Client Categories', 'fortun' ),
						'param_name' => 'client_categories',
						'value' => $client_options,
						'description' => esc_html__( 'Categories of Clients', 'fortun' )
					),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display type', 'fortun' ),
						'param_name' => 'type',
						'value' => array(   
							 esc_html__( 'Carousel', 'fortun') => '1',
							 esc_html__( 'Grid', 'fortun') => '2',
						),
						'description' => esc_html__( 'you can choose your desire type, it allows you to decide whether you need carousel or not. ', 'fortun' ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Columns', 'fortun' ),
						'param_name' => 'column',
						'value' => array(   
							 esc_html__( '1 column', 'fortun') => '1',
							 esc_html__( '2 columns', 'fortun') => '2',
							 esc_html__( '3 columns', 'fortun') => '3',
							 esc_html__( '4 columns', 'fortun' ) => '4',
							 esc_html__( '5 columns', 'fortun' ) => '5',
							 esc_html__( '6 columns', 'fortun' ) => '6',
						),
						'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'fortun' ),
						//'dependency' => array( 'element' => 'type', 'value' => '2' ),
						'std' => '4'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Gutter(Gap)', 'fortun' ),
						'param_name' => 'client_gutter',
						'description' => esc_html__( 'It will allow you to adjust the space in between the clients.', 'fortun' ),
						'std' => '30',
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Client Logo Grayscale Filter', 'fortun' ),
						'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). but it will not work on IE browsers.', 'fortun' ),
						'param_name' => 'client_gs_filter',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Client Logo Invert Filter', 'fortun' ),
						'description' => esc_html__( 'It will invery the thumbnail colors.', 'fortun' ),
						'param_name' => 'client_invert_filter',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '',
					), 
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Client Logo Opacity', 'fortun' ),
						'param_name' => 'client_opacity',
						'description' => esc_html__( 'Enter your desired logo/image opacity between 0.0 to 1.0 or you can Leave it empty for default setting.', 'fortun' ),
						'std' => '',
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Style', 'fortun' ),
						'param_name' => 'client_display_style',
						'value' => array(
							esc_html__( 'Plain(Default)', 'fortun' ) => '',
							esc_html__( 'Background', 'fortun' ) => 'background',
							esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
						'description' => esc_html__( 'Choose your desired background option.', 'fortun' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background Color', 'fortun' ),
						'param_name' => 'client_bg_color',
						'description' => esc_html__( 'Choose your desired background color for each client.', 'fortun' ),
						'dependency' => array( 'element' => 'client_display_style', 'value' => 'background' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '#f6f7f8',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Border Color', 'fortun' ),
						'param_name' => 'client_border_color',
						'description' => esc_html__( 'Choose your desired border for the each client.', 'fortun' ),
						'dependency' => array( 'element' => 'client_display_style', 'value' => 'border' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '#dddddd',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'fortun' ),
						'param_name' => 'client_padding',
						'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'fortun' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '25px',
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'fortun' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
					),
					
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Autoplay', 'fortun' ),
						'param_name' => 'clients_autoplay',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std'  => '1',
					),  
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Timeout duration', 'fortun' ),
						'param_name' => 'clients_autoplay_timeout',
						'description' => esc_html__( 'Enter the duration of each slide Transition', 'fortun' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'std' => '4000',
						'dependency' => array( 'element' => 'clients_autoplay', 'value' => '1' )
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pause on Hover', 'fortun' ),
						'param_name' => 'clients_autoplay_hover',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'std'  => '1',
						'dependency' => array( 'element' => 'clients_autoplay', 'value' => '1' )
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Loop', 'fortun' ),
						'param_name' => 'clients_loop',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std'  => '1'
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pagination', 'fortun' ),
						'param_name' => 'clients_pagination',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std'  => '1'
					),
					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,
					
				)
			
			));

			vc_map( array(
				'name' => esc_html__( 'Testimonials', 'fortun' ),
				'base' => 'agni_testimonials',
				'icon' => 'ion-ios-chatboxes-outline',
				'weight' => '68',
				'category' => esc_html__( 'Carousel', 'fortun' ),
				'description' => esc_html__( 'display testimonials by getting the testimonials post type', 'fortun' ),
				'params' => array(
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of members to display', 'fortun' ),
						'param_name' => 'posts',
						'description' => esc_html__( 'Mention the number of posts that you want to display!!.. -1 for infinite posts', 'fortun' ),
						'std' => '-1',
						'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'fortun' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'fortun') => 'DESC',
							 esc_html__( 'Ascending', 'fortun') => 'ASC',
						),
						'std' => 'DESC',
						'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'fortun' ),
						'param_name' => 'order_by',
						'value' => array(                       
							 esc_html__( 'None', 'fortun') => 'none',
							 esc_html__( 'Post ID', 'fortun') => 'id',
							 esc_html__( 'Post author', 'fortun') => 'author',
							 esc_html__( 'Post title', 'fortun') => 'title',
							 esc_html__( 'Post slug', 'fortun') => 'name',
							 esc_html__( 'Date', 'fortun') => 'date',
							 esc_html__( 'Last modified date', 'fortun') => 'modified',
							 esc_html__( 'Random', 'fortun') => 'rand',
							 esc_html__( 'Comments number', 'fortun') => 'comment_count',
							 esc_html__( 'Menu order', 'fortun') => 'menu_order',
						),
						'std' => 'date',
						'save_always' => true
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Testimonial Categories', 'fortun' ),
						'param_name' => 'testimonial_categories',
						'value' => $test_options,
						'description' => esc_html__( 'Categories of testimonials', 'fortun' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Style', 'fortun' ),
						'param_name' => 'style',
						'value' => array(   
							 esc_html__( 'Style 1', 'fortun') => '1',
							 esc_html__( 'Style 2', 'fortun') => '2',
							 esc_html__( 'Style 3', 'fortun') => '3',
						),
						'description' => esc_html__( 'Various style to display testimonials. ', 'fortun' ),
						'std' => '1',
						'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display type', 'fortun' ),
						'param_name' => 'type',
						'value' => array(   
							 esc_html__( 'Carousel', 'fortun') => '1',
							 esc_html__( 'Grid', 'fortun') => '2',
						),
						'description' => esc_html__( 'you can choose your desire type, it allows you to decide whether you need carousel or not. ', 'fortun' ),
						'std' => '1',
						'save_always' => true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Number of Columns', 'fortun' ),
						'param_name' => 'column',
						'value' => array(   
							 esc_html__( '1 column', 'fortun' ) => '1',
							 esc_html__( '2 columns', 'fortun') => '2',
							 esc_html__( '3 columns', 'fortun') => '3',
							 esc_html__( '4 columns', 'fortun') => '4',
							 esc_html__( '5 columns', 'fortun') => '5',
						),
						'description' => esc_html__( 'Choose the column on desktop screen. it will adjust the columns count on responsive screens automatically.', 'fortun' ),
						//'dependency' => array( 'element' => 'type', 'value' => '2' ),
						'std' => '1',
						'save_always' => true
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Avatar Grayscale Filter', 'fortun' ),
						'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). but it will not work on IE browsers.', 'fortun' ),
						'param_name' => 'testimonial_thumbnail_gs_filter',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '',
					), 

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Gutter(Gap)', 'fortun' ),
						'param_name' => 'testimonial_gutter',
						'description' => esc_html__( 'It will allow you to adjust the space in between each testimonials.', 'fortun' ),
						'std' => '30',
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Circle Avatar', 'fortun' ),
						'param_name' => 'circle_avatar',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std'  => '',
					),  
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Alignment', 'fortun' ),
						'param_name' => 'alignment',
						'value' => array(   
							 esc_html__( 'Left', 'fortun' ) => 'left',
							 esc_html__( 'Center', 'fortun') => 'center',
							 esc_html__( 'Right', 'fortun') => 'right',
						),
						'description' => esc_html__( 'Choose your testimonials alignment', 'fortun' ),
						//'dependency' => array( 'element' => 'type', 'value' => '2' ),
						'std' => 'left',
						'save_always' => true
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Display Style', 'fortun' ),
						'param_name' => 'testimonial_display_style',
						'value' => array(
							esc_html__( 'Plain(Default)', 'fortun' ) => '',
							esc_html__( 'Background', 'fortun' ) => 'background',
							esc_html__( 'Bordered', 'fortun' ) => 'border',
						),
						'description' => esc_html__( 'Choose your desired background option.', 'fortun' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background Color', 'fortun' ),
						'param_name' => 'testimonial_bg_color',
						'description' => esc_html__( 'Choose your desired background color for each testimonial.', 'fortun' ),
						'dependency' => array( 'element' => 'testimonial_display_style', 'value' => 'background' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '#f6f7f8',
						'save_always' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Border Color', 'fortun' ),
						'param_name' => 'testimonial_border_color',
						'description' => esc_html__( 'Choose your desired border for the each testimonial.', 'fortun' ),
						'dependency' => array( 'element' => 'testimonial_display_style', 'value' => 'border' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '#dddddd',
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Padding', 'fortun' ),
						'param_name' => 'testimonial_padding',
						'description' => esc_html__( 'Common padding for all side. You can use simple Padding CSS here. for ex. "12% 24%" or "80px". or enter just number and it will use pixels.', 'fortun' ),
						'group' => esc_html__( 'Background Settings', 'fortun' ),
						'std' => '',
					),
									
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'fortun' ),
						'param_name' => 'class',
						'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fortun' ),
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Autoplay', 'fortun' ),
						'param_name' => 'testimonial_autoplay',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std'  => '1',
						'save_always' => true
					),  
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Timeout duration', 'fortun' ),
						'param_name' => 'testimonial_autoplay_timeout',
						'description' => esc_html__( 'Enter the duration of each slide Transition', 'fortun' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'std' => '4000',
						'dependency' => array( 'element' => 'testimonial_autoplay', 'value' => '1' ),
						'save_always' => true
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pause on Hover', 'fortun' ),
						'param_name' => 'testimonial_autoplay_hover',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'std'  => '1',
						'dependency' => array( 'element' => 'testimonial_autoplay', 'value' => '1' ),
						'save_always' => true
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Slide Speed', 'fortun' ),
						'param_name' => 'testimonial_autoplay_speed',
						'description' => esc_html__( 'Enter the speed of each slide Transition', 'fortun' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std' => '700',
						'save_always' => true
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Loop', 'fortun' ),
						'param_name' => 'testimonial_loop',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std'  => '1',
						'save_always' => true
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pagination', 'fortun' ),
						'param_name' => 'testimonial_pagination',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'type', 'value' => '1' ),
						'std'  => '1',
						'save_always' => true
					),
					$animation_atts,
					$animation_style_atts, 
					$animation_duration_atts,
					$animation_delay_atts,
					$animation_offset_atts,
					
				)
			
			));

			vc_map( array(
				'name' => esc_html__( 'Posts, Portfolio', 'fortun' ),
				'base' => 'agni_posttypes',
				'icon' => 'ion-ios-eye-outline',
				'weight' => '67',
				'category' => esc_html__( 'Content', 'fortun' ),
				'description' => esc_html__( 'Choose the post & portfolio post type to show the loop!!', 'fortun' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Post type', 'fortun' ),
						'param_name' => 'posttype',
						'value' => array(   
							esc_html__( 'Posts', 'fortun') => 'post',
							esc_html__( 'Portfolio', 'fortun') => 'portfolio',
						),
						'description' => esc_html__( 'Display the post from the various post types..', 'fortun' ),
						'admin_label' => true,
						'std' => 'post'
					),

					array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Blog Layout', 'fortun'),
                        'param_name' => 'blog-layout',
                        'value' => array(
                            esc_html__( 'Standard', 'fortun') => 'standard',
                            esc_html__( 'Grid', 'fortun') => 'grid',
                            esc_html__( 'Modern Grid 1', 'fortun') => 'modern',
                            esc_html__( 'Modern Grid 2', 'fortun') => 'modern-2',
                            esc_html__( 'List', 'fortun') => 'list',
                            esc_html__( 'Minimal List', 'fortun') => 'minimal-list',
                        ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => 'standard'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Blog Layout(Columns)', 'fortun'),
                        'param_name' => 'blog-column-layout',
                        'value' => array(   
                            esc_html__( '1 Column', 'fortun') => '1',
                            esc_html__( '2 Columns', 'fortun') => '2',
                            esc_html__( '3 Columns', 'fortun') => '3',
                            esc_html__( '4 Columns', 'fortun') => '4',
                            esc_html__( '5 Columns', 'fortun') => '5',
                        ),
                        'description' => esc_html__( 'Choose the column layout you would like to use.', 'fortun' ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array('grid', 'modern', 'modern-2') ),
                        'std' => '3'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Post Excerpt Length', 'fortun'),
                        'param_name' => 'blog-excerpt-length',
                        'description' => esc_html__('It will display the excerpt content with your desired length.', 'fortun'),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array( 'standard', 'grid', 'list' ) ),
                        'std' => '150'
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__('Use Post Content', 'fortun'),
                        'param_name' => 'blog-content-choice',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__('It will display the whole post content and ignore the above excerpt value.', 'fortun'),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => 'standard' ),
                        'std' => ''
                    ),

                    array(
                        'type'     => 'dropdown',
                        'heading'    => esc_html__( 'Blog Grid Style', 'fortun' ),
                        'param_name'       => 'blog-grid-layout',
                        'description' => esc_html__( 'Choose any of one grid style. fitRows is default.', 'fortun' ),
                        'value' => array(
                            esc_html__( 'FitRows(Default Grid)', 'fortun') => 'fitRows',
                            esc_html__( 'Masonry', 'fortun') => 'masonry',
                        ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array('grid', 'modern', 'modern-2') ),
                        'std'  => 'fitRows'
                    ),

                    array(
                        'type'     => 'dropdown',
                        'heading' => esc_html__('Blog Sidebar', 'fortun'),
                        'param_name' => 'blog-sidebar',
                        'value' => array(
                            esc_html__( 'No Sidebar', 'fortun') => 'no-sidebar',
                            esc_html__( 'Right Sidebar', 'fortun') => 'has-sidebar',
                            esc_html__( 'Left Sidebar', 'fortun') => 'has-sidebar left',
                        ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => 'has-sidebar'
                    ),

                    // Common for Portfolio & Post
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Carousel', 'fortun' ),
                        'param_name' => 'carousel',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will display the portfolio/blog items inside the carousel.', 'fortun' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Ignore Thumbnail Settings', 'fortun' ),
                        'param_name' => 'portfolio_thumbnail_individual_settings',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will ignore the portfolio thumbnail width & height settings(if any).', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

					array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Blog Gutter', 'fortun' ),
                        'param_name' => 'blog-gutter',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will bring some space in between the items horizontally.', 'fortun' ),
                        'dependency' => array( 'element' => 'blog-layout', 'value' => array( 'grid', 'modern', 'modern-2' ) ),
                        'std' => '1'
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Blog Gutter Value', 'fortun' ),
                        'param_name' => 'blog-gutter-value',
                        'description' => esc_html__( 'Enter the space you want to add between each item.', 'fortun' ),
                        'dependency' => array( 'element' => 'blog-gutter', 'value' => '1' ),
                        'std' => '30'
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Blog Thumbnails Hard Crop', 'fortun' ),
                        'param_name' => 'blog-thumbnail-hardcrop',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will crop all the images by ignoring original dimension of an image.', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Thumbnails Crop Size', 'fortun' ),
                        'param_name' => 'blog-thumbnail-dimension-custom',
                        'description' => esc_html__( 'Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'fortun' ),
                        'dependency' => array( 'element' => 'blog-thumbnail-hardcrop', 'value' => '1' ),
                        'std' => '640x640'
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Blog Thumbnails Clickable', 'fortun' ),
                        'param_name' => 'blog-thumbnail-has-link',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will enable clickable single post link to blog thumbnails.', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => ''
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Thumbnail Grayscale', 'fortun' ),
                        'param_name' => 'blog-thumbnail-gs-filter',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Navigation', 'fortun' ),
                        'param_name' => 'blog-navigation',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
                        'std' => '1'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Navigation style', 'fortun' ),
                        'param_name' => 'blog-navigation-choice',
                        'description' => esc_html__( 'Choose your pagination style', 'fortun' ),
                        'value' => array( 
                            esc_html__( 'Classic', 'fortun' ) => '1',
                            esc_html__( 'Number', 'fortun' ) => '2',
                            esc_html__( 'Infinite', 'fortun' ) => '3',
                            esc_html__( 'Infinite with Load More', 'fortun' ) => '4' 
                        ),
                        'dependency' => array( 'element' => 'blog-navigation', 'value' => '1' ),
                        'std' => '1'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text to show on loading', 'fortun' ),
                        'param_name' => 'blog-navigation-ifs-load-text',
                        'dependency' => array( 'element' => 'blog-navigation-choice', 'value' => array('2', '3') ),
                        'std' => 'Loading'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text to show at the end of page', 'fortun' ),
                        'param_name' => 'blog-navigation-ifs-finish-text',
                        'dependency' => array( 'element' => 'blog-navigation-choice', 'value' => array('2', '3') ),
                        'std' => 'No More Items'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Button Text', 'fortun' ),
                        'param_name' => 'blog-navigation-ifs-btn-text',
                        'dependency' => array( 'element' => 'blog-navigation-choice', 'value' => '3' ),
                        'std' => 'Load More'
                    ),

					array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio layout(Columns)', 'fortun' ),
                        'param_name' => 'portfolio-layout',
                        'value' => array(   
                            esc_html__( '1 Column', 'fortun') => '1',
                            esc_html__( '2 Columns', 'fortun') => '2',
                            esc_html__( '3 Columns', 'fortun') => '3',
                            esc_html__( '4 Columns', 'fortun') => '4',
                            esc_html__( '5 Columns', 'fortun') => '5',
                        ),
                        'description' => esc_html__( 'Choose the column layout you would like to use.', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '3'
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Fullwidth', 'fortun' ),
                        'param_name' => 'portfolio-fullwidth',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'Kindly set your row as fullwidth to get the fullwidth portfolio. ', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Masonry Style', 'fortun' ),
                        'param_name' => 'portfolio-grid',
                        'value' => array(   
                             esc_html__( 'FitRows(Default Grid)', 'fortun') => 'fitRows',
                             esc_html__( 'Masonry', 'fortun') => 'masonry',
                        ),
                        'description' => esc_html__( 'You can choose your isotope layout style.', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => 'fitRows'
                    ),
                    
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Gutter', 'fortun' ),
                        'param_name' => 'portfolio-gutter',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will bring some space in between the items horizontally.', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '1'
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Portfolio Gutter Value', 'fortun' ),
                        'param_name' => 'portfolio-gutter-value',
                        'description' => esc_html__( 'Enter the space you want to add between each item.', 'fortun' ),
                        'dependency' => array( 'element' => 'portfolio-gutter', 'value' => '1' ),
                        'std' => '30'
                    ),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Thumbnails Hard Crop', 'fortun' ),
                        'param_name' => 'portfolio-thumbnail-hardcrop',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will crop all the images by ignoring original dimension of an image.', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Thumbnails Crop Size', 'fortun' ),
                        'param_name' => 'portfolio-thumbnail-dimension-custom',
                        'description' => esc_html__( 'Set the maximum width & height of a thumbnail. Note: it may not be an actual image size but the ratio will be the same.', 'fortun' ),
                        'dependency' => array( 'element' => 'portfolio-thumbnail-hardcrop', 'value' => '1' ),
                        'std' => '640x640'
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Thumbnail Grayscale', 'fortun' ),
                        'param_name' => 'portfolio-thumbnail-gs-filter',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will change the thumbnail to grayscale(black&white). Note: It will not work on IE browsers', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Portfolio Hover style', 'fortun'),
                        'param_name' => 'portfolio-hover-style',
                        'value' => array(
                            esc_html__('Style 1', 'fortun') => '1',
                            esc_html__('Style 2', 'fortun') => '2',
                            esc_html__('Style 3', 'fortun') => '3',
                            esc_html__('Style 4', 'fortun') => '4',
                            esc_html__('Style 5', 'fortun') => '5',
                            esc_html__('Style 6', 'fortun') => '6',
                            esc_html__('Style 7', 'fortun') => '7',
                        ), //Must provide key => value pairs for select options
                        'description' => esc_html__( 'Various hover style for portfolio.. ', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '1'
                    ),
                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Background color', 'fortun' ),
						'param_name' => 'portfolio-hover-bg-color',
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std' => ''
					),
                    array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Hover Content color', 'fortun' ),
						'param_name' => 'portfolio-hover-color',
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std' => ''
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Title', 'fortun' ),
						'param_name' => 'portfolio-hover-show-title',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Category', 'fortun' ),
						'param_name' => 'portfolio-hover-show-category',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Link', 'fortun' ),
						'param_name' => 'portfolio-hover-show-link',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Hover Portfolio Attachment Link', 'fortun' ),
						'param_name' => 'portfolio-hover-show-attachment-link',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std'  => '1',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
					), 

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Bottom Title', 'fortun' ),
                        'param_name' => 'portfolio-bottom-title',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Bottom Category', 'fortun' ),
                        'param_name' => 'portfolio-bottom-category',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '',
						'edit_field_class' => 'vc_col-xs-6 vc_col-sm-3 vc_column',
                    ),

                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Link Target', 'fortun' ),
                        'param_name' => 'portfolio-post-link-target',
                        'value' => array(
							esc_html__( 'Same window', 'fortun' ) => '_self',
							esc_html__( 'New window', 'fortun' ) => '_blank'
                        ), //Must provide key => value pairs for select options
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => '_self'
                    ),
                    
                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Filter', 'fortun' ),
                        'param_name' => 'portfolio-filter',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
                        'std' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Filter Order', 'fortun' ),
                        'param_name' => 'portfolio-filter-order',
                        'value' => array(   
                             esc_html__( 'Ascending', 'fortun') => 'ASC',
                             esc_html__( 'Descending ', 'fortun') => 'DESC',
                        ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'ASC'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Filter Order by', 'fortun' ),
                        'param_name' => 'portfolio-filter-orderby',
                        'value' => array(                       
                             esc_html__( 'None', 'fortun') => 'none',
                             esc_html__( 'Name', 'fortun') => 'name',
                             esc_html__( 'Slug', 'fortun') => 'slug',
                             esc_html__( 'Term Group', 'fortun') => 'term_group',
                             esc_html__( 'Term ID', 'fortun') => 'term_id',
                             esc_html__( 'ID', 'fortun') => 'id',
                             esc_html__( 'Description', 'fortun') => 'description',
                        ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'name'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Portfolio Filter alignment', 'fortun' ),
                        'param_name' => 'portfolio-filter-align',
                        'value' => array(
                             esc_html__( 'left', 'fortun' ) => 'left', 
                             esc_html__('center', 'fortun') => 'center',                    
                             esc_html__( 'right', 'fortun' ) => 'right',
                            ),
                        'description' => esc_html__( 'Select the filter style to be aligned', 'fortun' ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'left'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Text alternative for "All"', 'fortun' ),
                        'param_name' => 'portfolio-filter-all-text',
                        'description' => esc_html__( 'Type the alternative text for the portfolio filter\'s All text', 'fortun' ),
                        'dependency' => array( 'element' => 'portfolio-filter', 'value' => '1' ),
                        'std' => 'All'
                    ),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Navigation', 'fortun' ),
						'param_name' => 'portfolio-navigation',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Navigation style', 'fortun' ),
						'param_name' => 'portfolio-navigation-choice',
						'description' => esc_html__( 'Choose your pagination style', 'fortun' ),
						'value' => array( 
							esc_html__( 'Number', 'fortun' ) => '1',
							esc_html__( 'Infinite', 'fortun' ) => '2',
							esc_html__( 'Infinite with Load More', 'fortun' ) => '3' 
						),
						'dependency' => array( 'element' => 'portfolio-navigation', 'value' => '1' ),
						'std' => '1'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text to show on loading', 'fortun' ),
						'param_name' => 'portfolio-navigation-ifs-load-text',
						'dependency' => array( 'element' => 'portfolio-navigation-choice', 'value' => array('2', '3') ),
						'std' => 'Loading'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text to show at the end of page', 'fortun' ),
						'param_name' => 'portfolio-navigation-ifs-finish-text',
						'dependency' => array( 'element' => 'portfolio-navigation-choice', 'value' => array('2', '3') ),
						'std' => 'No More Items'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Text', 'fortun' ),
						'param_name' => 'portfolio-navigation-ifs-btn-text',
						'dependency' => array( 'element' => 'portfolio-navigation-choice', 'value' => '3' ),
						'std' => 'Load More'
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number of Posts to display', 'fortun' ),
						'param_name' => 'posts_per_page',
						'description' => esc_html__( 'Mention the number of posts that you want to display. -1 for infinite posts', 'fortun' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => '5'
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Categories', 'fortun' ),
						'param_name' => 'blog-categories',
						'value' => $blog_options,
						'description' => esc_html__( 'Categories of post post type. ignore this to show all', 'fortun' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'post' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => ''
					),

                    array(
                        'type' => 'checkbox',
                        'heading' => esc_html__( 'Portfolio Categories', 'fortun' ),
                        'param_name' => 'portfolio-categories',
                        'value' => $portfolio_options,
                        'description' => esc_html__( 'Categories of portfolio post type', 'fortun' ),
                        'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
                        'std' => ''
                    ),
                    array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Exclude above chosen Categories', 'fortun' ),
						'param_name' => 'portfolio-cateogory-operator',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'portfolio' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => ''
					),
					
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'fortun' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'fortun') => 'DESC',
							 esc_html__( 'Ascending', 'fortun') => 'ASC',
						),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => 'DESC'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'fortun' ),
						'param_name' => 'orderby',
						'value' => array(                       
							 esc_html__( 'None', 'fortun') => 'none',
							 esc_html__( 'Post ID', 'fortun') => 'id',
							 esc_html__( 'Post author', 'fortun') => 'author',
							 esc_html__( 'Post title', 'fortun') => 'title',
							 esc_html__( 'Post slug', 'fortun') => 'name',
							 esc_html__( 'Date', 'fortun') => 'date',
							 esc_html__( 'Last modified date', 'fortun') => 'modified',
							 esc_html__( 'Random', 'fortun') => 'rand',
							 esc_html__( 'Comments number', 'fortun') => 'comment_count',
							 esc_html__( 'Menu order', 'fortun') => 'menu_order',
						),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => 'date'
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts to include', 'fortun' ),
						'param_name' => 'post_in',
						'description' => esc_html__( 'Mention the posts id to includes for.eg.401', 'fortun' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => ''
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts to exclude', 'fortun' ),
						'param_name' => 'post_not_in',
						'description' => esc_html__( 'Mention the posts id to excludes for.eg.401', 'fortun' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'std' => ''
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Ignore Sticky', 'fortun' ),
						'param_name' => 'ignore_sticky',
						'description' => esc_html__( 'Just check this if you want to ignore sticky posts..', 'fortun' ),
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Posttype Settings', 'fortun' ),
						'dependency' => array( 'element' => 'posttype', 'value' => 'post' )
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Autoplay', 'fortun' ),
						'param_name' => 'posttype_autoplay',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1',
					),  
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Timeout duration', 'fortun' ),
						'param_name' => 'posttype_autoplay_timeout',
						'description' => esc_html__( 'Enter the duration of each slide Transition', 'fortun' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std' => '4000'
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pause on Hover', 'fortun' ),
						'param_name' => 'posttype_autoplay_hover',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1'
					),
					
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Slide Speed', 'fortun' ),
						'param_name' => 'posttype_autoplay_speed',
						'description' => esc_html__( 'Enter the speed of each slide Transition', 'fortun' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std' => '700',
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Loop', 'fortun' ),
						'param_name' => 'posttype_loop',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1'
					),
					
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Pagination Dots', 'fortun' ),
						'param_name' => 'posttype_pagination',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '1'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Navigation Arrows', 'fortun' ),
						'param_name' => 'posttype_navigation',
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'group' => esc_html__( 'Carousel Settings', 'fortun' ),
						'dependency' => array( 'element' => 'carousel', 'value' => '1' ),
						'std'  => '0'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Animation', 'fortun' ),
						'param_name' => 'animation',
						'group' => esc_html__( 'Animation Settings', 'fortun' ),
						'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
						'std' => '1'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Animation style', 'fortun' ),
						'param_name' => 'animation_style',
						'description' => esc_html__( 'Choose your animation style', 'fortun' ),
						'value' => array( 
							esc_html__('fadeIn', 'fortun') => 'fadeIn',
							esc_html__('fadeInDown', 'fortun') => 'fadeInDown',
							esc_html__('fadeInUp', 'fortun') => 'fadeInUp',
							esc_html__('fadeInRight', 'fortun') => 'fadeInRight',
							esc_html__('fadeInLeft', 'fortun') => 'fadeInLeft',
							esc_html__('flipInX', 'fortun') => 'flipInX',
							esc_html__('flipInY', 'fortun') => 'flipInY',
							esc_html__('zoomIn', 'fortun') => 'zoomIn',
						),
						'group' => esc_html__( 'Animation Settings', 'fortun' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => 'fadeInUp'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Duration', 'fortun' ),
						'param_name' => 'animation_duration',
						'description' => esc_html__( 'Enter the value in seconds. for ex. 0.6', 'fortun' ),
						'group' => esc_html__( 'Animation Settings', 'fortun' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => '0.8'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Delay', 'fortun' ),
						'param_name' => 'animation_delay',
						'description' => esc_html__( 'Enter the value in seconds. for ex. 0.6', 'fortun' ),
						'group' => esc_html__( 'Animation Settings', 'fortun' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => '0.4'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Animation Offset', 'fortun' ),
						'param_name' => 'animation_offset',
						'description' => esc_html__( 'Animation will be triggered only when portfolio reaches particular percentage on viewport. for eg. 90', 'fortun' ),
						'group' => esc_html__( 'Animation Settings', 'fortun' ),
						'dependency' => array( 'element' => 'animation', 'value' => '1' ),
						'std' => '90'
					),
				)
			));     
		}   

		//WooCommerce Product List
		if( class_exists( 'WooCommerce' ) ){
			$product_options = array();
			$product_categories = get_terms('product_cat');     
			foreach ($product_categories as $category) {
				$product_options[$category->name] = $category->slug;
			}

			vc_map( array(
				'name' => esc_html__('WooCommerce Products', 'fortun'),
				'base' => 'agni_woo_products',
				'icon' => 'ion-ios-cart-outline',
				'weight' => '66',
				'category' => esc_html__('WooCommerce', 'fortun'),
				'description' => esc_html__('Setup your product to display.', 'fortun'),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Product Type', 'fortun'),
						'param_name' => 'product_type',
						'value' => array(
							esc_html__( 'All', 'fortun') => 'all',
							esc_html__( 'Sale', 'fortun') => 'sale',
							esc_html__( 'Featured', 'fortun') => 'featured',
							esc_html__( 'Best Selling', 'fortun') => 'best_selling',
							esc_html__( 'Top Rated', 'fortun') => 'toprated',
						),
						'save_always' => true,
						'description' => esc_html__('Please select the type of products you would like to display.', 'fortun'),
						'std' => 'all'
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__('Product Categories', 'fortun'),
						'param_name' => 'product_categories',
						'value' => $product_options,
						'save_always' => true,
						'description' => esc_html__('choose your desired Categories', 'fortun'),
						'std' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Number Of Columns', 'fortun'),
						'param_name' => 'product_layout',
						'value' => array(
                            esc_html__( '1 Column', 'fortun') => '1',
                            esc_html__( '2 Columns', 'fortun') => '2',
                            esc_html__( '3 Columns', 'fortun') => '3',
                            esc_html__( '4 Columns', 'fortun') => '4',
                            esc_html__( '5 Columns', 'fortun') => '5',
						),
						'save_always' => true,
						'description' => esc_html__('Please select the number of columns you would like to display.', 'fortun'),
						'std' => '3'
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__('Carousel', 'fortun'),
                        'param_name' => 'carousel',
                        'value' => array( esc_html__( 'Yes', 'fortun' ) => '1' ),
                        'description' => esc_html__( 'It will display the portfolio/blog items inside the carousel.', 'fortun' ),
						'save_always' => true,
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__('Number of Products to display', 'fortun'),
						'param_name' => 'posts_per_page',
						'description' => esc_html__('Mention the number of posts that you want to display!!.. -1 for infinite posts', 'fortun'),
						'std' => '3'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'fortun' ),
						'param_name' => 'order',
						'value' => array(   
							 esc_html__( 'Descending ', 'fortun') => 'DESC',
							 esc_html__( 'Ascending', 'fortun') => 'ASC',
						),
						'std' => 'DESC'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'fortun' ),
						'param_name' => 'order_by',
						'value' => array(                       
							 esc_html__( 'None', 'fortun') => 'none',
							 esc_html__( 'Post ID', 'fortun') => 'id',
							 esc_html__( 'Post author', 'fortun') => 'author',
							 esc_html__( 'Post title', 'fortun') => 'title',
							 esc_html__( 'Post slug', 'fortun') => 'name',
							 esc_html__( 'Date', 'fortun') => 'date',
							 esc_html__( 'Last modified date', 'fortun') => 'modified',
							 esc_html__( 'Random', 'fortun') => 'rand',
							 esc_html__( 'Comments number', 'fortun') => 'comment_count',
							 esc_html__( 'Menu order', 'fortun') => 'menu_order',
						),
						'std' => 'date'
					),

				)
			));
		}
	
	}

	/*
	Shortcode logic how it should be rendered
	*/
	public static function agni_section_heading( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_section_heading', $atts );
		extract( $atts );
		$icon = $heading = $subheading = $additional = $divide_line = $additional_class = $additional_attr = $heading_class = '';

		if($atts['responsive_font_size'] == 'yes'){
			$heading_class = 'section-heading-text_responsive';
		}

		if( !empty($atts['icon']) ){
			$icon = '<i class="section-heading-icon '.$atts['icon'].'" style="font-size:'.$atts['icon_size'].'px; color:'.$atts['icon_color'].'"></i>';
		}
		if( !empty($atts['heading']) ){
			$atts['heading_size'] = ( !empty($atts['heading_size']) )? 'style="font-size:'.$atts['heading_size'].'px;"':'';
			$heading = '<h2 class="section-heading-text '.$heading_class.'" '.$atts['heading_size'].'><span>'.$atts['heading'].'</span></h2>';
		}
		if( !empty($atts['sub_heading']) ){
			$atts['sub_heading_size'] = ( !empty($atts['sub_heading_size']) )? 'style="font-size:'.$atts['sub_heading_size'].'px;"':'';
			$subheading = '<div class="section-sub-heading-text" '.$atts['sub_heading_size'].'>'.$atts['sub_heading'].'</div>';
		}
		if( !empty($atts['additional']) ){
			$atts['additional_size'] = ( !empty($atts['additional_size']) )? 'style="font-size:'.$atts['additional_size'].'px;"':'';
			$additional = '<p class="section-additional-heading-text" '.$atts['additional_size'].'>'.$atts['additional'].'</p>';
		}

		if( $atts['divide_line'] == 'yes'  ){
			$divide_line = '<div class="section-divide-line divide-line text-'.$atts['align'].'"><span style="width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['divide_line_width'] ) ? $atts['divide_line_width'] : $atts['divide_line_width'] . 'px' ).'; height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['divide_line_height'] ) ? $atts['divide_line_height'] : $atts['divide_line_height'] . 'px' ).'; background-color:'.$atts['divide_line_color'].'"></span></div>';
		}

		if( $atts['parallax'] == '1' ){
			$additional_class = ' has-parallax';
			$additional_attr = ' data-bottom-top="'.$atts['parallax_start'].'" data-top-bottom="'.$atts['parallax_end'].'"';
		}

		switch( $atts['display_order'] ){
			case 'hdai' :
				$output = $heading . $subheading . $divide_line . $additional . $icon ;
				break;
			case 'ahdi' :
				$output = $additional . $heading . $subheading . $divide_line . $icon ;
				break;
			case 'dhai' :
				$output = $divide_line . $heading . $subheading . $additional . $icon ;
				break;
			case 'idha' :
				$output = $icon . $divide_line . $heading . $subheading . $additional ;
				break;
			case 'ishda' :
				$output = $icon . $subheading . $heading . $divide_line . $additional ;
				break;
			case 'ishad' :
				$output = $icon . $subheading . $heading . $additional . $divide_line ;
				break;
			default :
				$output = $icon . $heading . $subheading . $divide_line . $additional ;
		}
		if( $atts['animation'] == '1' ){
			$output = '<div class="animate" data-animation="'.$atts['animation_style'].'" data-animation-offset="'.$atts['animation_offset'].'" style="animation-duration: '.$atts['animation_duration'].'s; 	animation-delay: '.$atts['animation_delay'].'s; 	-moz-animation-duration: '.$atts['animation_duration'].'s; 	-moz-animation-delay: '.$atts['animation_delay'].'s; 	-webkit-animation-duration: '.$atts['animation_duration'].'s; 	-webkit-animation-delay: '.$atts['animation_delay'].'s;">'.$output.'</div>';	
		}
		$output = '<div class="'.$atts['class'].$additional_class.' agni-section-heading text-'.$atts['align'].' '.$atts['display_order'].'" '.$additional_attr.'>'.$output.'</div>';
		
		return $output;

	}
	
	// Blockquote
	public static function agni_blockquote( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_blockquote', $atts );
		extract( $atts );   
		
		$output = $reverse_class = $style = '';
		if( $atts['reverse'] == 'yes' ){
			$reverse_class= '-reverse'; 
		}

		if( !empty($atts['color']) ){
			$style = 'style="color:'.$atts['color'].' "';
		}

		if( !empty($atts['background_color']) ){
			$output = '<div class="agni-blockquote-container" style="background-color: '.$atts['background_color'].'" >';
		}

		$output .= '<blockquote class="'.$atts['class'].' agni-blockquote'.$reverse_class.'" '.$style .'><span style="color: '.$atts['quote_color'].'">'.$atts['quote'].'</span>' . wpb_js_remove_wpautop($content, true) . '</blockquote>'; 
		if( !empty($atts['background_color']) ){
			$output .= '</div>';
		}
		return $output;
	}

	// Dropcap
	public static function agni_dropcap( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_dropcap', $atts );
		extract( $atts );   
		
		$output = do_shortcode( $content );

		$radius = '';
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
		}

		if( $atts['dropcap_style'] == 'background' ){
			$dropcap_style = 'style="'.$radius.' background-color:'.$atts['background_color'].'; color:'.$atts['color'].'"';
		}
		else{
			$dropcap_style = 'style="'.$radius.' border-color:'.$atts['border_color'].'; color:'.$atts['color'].'"';
		}
		$output = '<p class="'.$atts['class'].' dropcap"><span '.$dropcap_style.'>'.$output[0].'</span>'. substr( $output, 1 ) .'</p>';
		return $output;
	}
	
	// separator
	public static function agni_separator( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_separator', $atts );
		extract( $atts );   
		
		$text = $bg = $color = '';

		if( !empty($atts['color']) ){
			$color = 'style="color:'.$atts['color'].';"';
		}

		if( $atts['choice'] == 'text' && $atts['text'] != '' ){
			$text = '<p '.$color.'>'.$atts['text'].'</p>';          
		}
		else if( $atts['choice'] == 'icon' && $atts['icon'] != '' ){
			$text = '<i class="'.$atts['icon'].'" '.$color.'></i>';
		}
		if( !empty($atts['background_color']) ){
			$bg = 'background-color:'.$atts['background_color'].';';
		}
		$output = '<div class="'.$atts['class'].' separator separator_'.$atts['align'].'" style="width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['width'] ) ? $atts['width'] : $atts['width'] . '%' ).'; '.$bg.'">
					<span class="sep_holder sep_holder_l"><span style="border-top-style:'.$atts['style'].'; border-color:'.$atts['color'].'" class="sep_line"></span></span>
					'.$text.'
					<span class="sep_holder sep_holder_r"><span style="border-top-style:'.$atts['style'].'; border-color:'.$atts['color'].'" class="sep_line"></span></span>
				</div>';
		
		return $output;
	}
	
	// call to action
	public static function agni_call_to_action( $atts, $content=null ){
		$atts = vc_map_get_attributes( 'agni_call_to_action', $atts );
		extract( $atts );   
		$size = $style = $heading = $additional = $button = $button_css = $icon_margin = $icon = '';    

		if( !empty($atts['icon_margin_top']) || !empty( $atts['icon_margin_bottom'] ) || !empty( $atts['icon_margin_right'] ) ){
			$icon_margin = 'style="';
			$icon_margin .= ( !empty($atts['icon_margin_top']) ) ? 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_margin_top'] ) ? $atts['icon_margin_top'] : $atts['icon_margin_top'] . 'px' ) . '; ' : '';
			$icon_margin .= ( !empty($atts['icon_margin_right']) ) ? 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_margin_right'] ) ? $atts['icon_margin_right'] : $atts['icon_margin_right'] . 'px' ) . '; ' : '';
			$icon_margin .= ( !empty($atts['icon_margin_bottom']) ) ? 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_margin_bottom'] ) ? $atts['icon_margin_bottom'] : $atts['icon_margin_bottom'] . 'px' ) . '; ' : '';
			$icon_margin .= '"';
		}
		
		if( $atts['icon'] != '' ){
			$icon = '<div class="call-to-action-icon" '.$icon_margin.'><i class="'.$atts['icon'].'"></i></div>';
		}

		if( $atts['size'] != '' ){
			$size = 'btn-'.$atts['size'].'';    
		}
		if( $atts['style'] != '' ){
			$style = 'btn-'.$atts['style']; 
		}

		if( !empty($atts['button_margin_top']) || !empty( $atts['button_margin_bottom'] ) || !empty($atts['radius']) ){
			$button_css = 'style="';
			$button_css .= ( !empty($atts['button_margin_top']) ) ? 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['button_margin_top'] ) ? $atts['button_margin_top'] : $atts['button_margin_top'] . 'px' ) . '; ' : '';
			$button_css .= ( !empty($atts['button_margin_bottom']) ) ? 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['button_margin_bottom'] ) ? $atts['button_margin_bottom'] : $atts['button_margin_bottom'] . 'px' ) . '; ' : '';
			$button_css .= ( !empty($atts['radius']) ) ? 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ) . '; ' : '';
			$button_css .= '"';
		}
		
		if( !empty( $atts['quote'] ) ){
			$heading = '<h4 class="call-to-action-heading">'.$atts['quote'].'</h4>';
		}
		if( !empty( $atts['additional_quote'] ) ){
			$additional = '<p class="call-to-action-additonal">'.$atts['additional_quote'].'</p>';
		}
		if( !empty( $atts['value'] ) ){
			$button = '<div class="call-to-action-button"><a class="btn '.$style.' btn-'.$atts['choice'].' '.$size.'" target="'.$atts['target'].'" href="'.$atts['url'].'" '.$button_css.'> '.$atts['value'].'</a></div>';
		}

		$output = '<div class="'.$atts['class'].' call-to-action call-to-action-style-'.$atts['type'].'">'.$icon.'<div class="call-to-action-description">' . $heading . $additional .'</div>'. $button .'</div>';  
			
		return $output;
	}
	
	// icon
	public static function agni_icon($atts=null, $content=null ){
		$atts = vc_map_get_attributes( 'agni_icon', $atts );
		extract( $atts );
		$style = $icon_style = $radius = $width = $height = $font_size = $icon_has = $icon_transparent = $icon_location = '';

		$icon_tag = 'div';
		if( $atts['inline'] == 'yes' ){
			$icon_tag = 'span';
		}
		if( !empty($atts['icon_padding']) ){
			$style = 'style="padding:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_padding'] ) ? $atts['icon_padding'] : $atts['icon_padding'] . 'px' ).'; "';
		}
		
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).'; ';
		}
		if( !empty($atts['size']) ){
			$font_size = 'font-size:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['size'] ) ? $atts['size'] : $atts['size'] . 'px' ).'; ';
		}
		if( !empty($atts['width']) ){
			$width = 'width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['width'] ) ? $atts['width'] : $atts['width'] . 'px' ).'; ';
		}
		if( !empty($atts['height']) ){
			$height = 'height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['height'] ) ? $atts['height'] : $atts['height'] . 'px' ).'; ';
		}

		$icon_style = 'style="'.$font_size.$radius.'color:'.$atts['color'].'; ';
		if( $atts['icon_style'] == 'background' ){
			$icon_style .= ''.$width.$height.''.$atts['icon_style'].'-color:'.$atts[$atts['icon_style'].'_color'].';  border-color:'.$atts[$atts['icon_style'].'_color'].';';
			$icon_has = 'icon-has-'.$atts['icon_style'].'';
		}
		if( $atts['icon_style'] == 'border' ){
			$icon_style .= ''.$width.$height.''.$atts['icon_style'].'-color:'.$atts[$atts['icon_style'].'_color'].'; ';
			$icon_has = 'icon-has-'.$atts['icon_style'].'';
		}
		$icon_style .= '"';

		// Hover style
		$hover_icon_style = $hover_radius = $hover_icon_has = '';
		if( !empty($atts['hover_radius']) ){
			$hover_radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['hover_radius'] ) ? $atts['hover_radius'] : $atts['hover_radius'] . 'px' ).'; ';
		}

		$hover_icon_style = 'style="'.$hover_radius.'color:'.$atts['hover_color'].'; ';
		if( $atts['icon_type'] == 'svg'){
			$hover_icon_style .= 'stroke:'.$atts['hover_color'].'; ';
		}
		if( $atts['hover_icon_style'] != '' ){
			$hover_icon_style .= ''.$atts['hover_icon_style'].'-color:'.$atts['hover_'.$atts['hover_icon_style'].'_color'].'; ';
			$hover_icon_has = 'hover-icon-has-'.$atts['hover_icon_style'].'';
		}
		$hover_icon_style .= '"';

		if( $icon_has == 'icon-has-border' && $hover_icon_has == 'hover-icon-has-background' ){ 
			$icon_transparent = 'icon-background-transparent';
		}

		$svg_icon_style =  'style="stroke:'.$atts['color'].'; '; 
		$svg_icon_style .= 'width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['size'] ) ? $atts['size'] : $atts['size'] . 'px' ).'; ';
		$svg_icon_style .=  '"'; 

		if( $atts['icon_type'] == 'svg'){
			if( $atts['svg_icon_type'] == 'svg_upload' ){
				//codes
				$icon_location = wp_get_attachment_url( $atts['svg_icon_upload'] );
			}else{
				$output = substr($atts['svg_icon'], 5);
				$output = str_replace('-', '_', $output);
				$icon_location = AGNI_FRAMEWORK_URL . '/css/svg/'.$output.'.svg';
			}
			$ran_id = rand(10000, 99999);
			$output = '<span class="svg-icon-container '.$icon_has.' '.$hover_icon_has.'" '.$icon_style.'><span id="agni-svg-icon-'.$ran_id.'" class="agni-svg-icon" '.$svg_icon_style.' data-file="'.$icon_location.'"></span></span>';
		}
		else{
			$output = '<i class="'.$atts['icon'].' '.$icon_has.' '.$hover_icon_has.'" '.$icon_style.'></i>';
		}

		if( !empty($atts['url']) ){
			$output = '<a href="'.$atts['url'].'">'.$output.'</a>';
		}
		$output = '<'.$icon_tag.' class="'.$atts['class'].' agni-icon has-'.$icon_type.' '.$icon_transparent.'" '.$style.'><span class="agni-icon-container" '.$hover_icon_style.'>'.$output.'</span></'.$icon_tag.'>';
		
		return $output;
	}
		
	// Services
	public static function agni_service($atts=null, $content=null ){
		$atts = vc_map_get_attributes( 'agni_service', $atts );
		extract( $atts );
		
		$output = $service_has = $icon = $heading = $description = $divideline = $button = $btn_style = $btn_radius = $bg_style = $service_padding_style = $service_bg_class = '';

		if( $atts['text_i_icon'] == '1' ){
			$icon = do_shortcode('[agni_icon icon_type="'.$atts['icon_type'].'" icon="'.$atts['icon'].'" svg_icon_type="'.$atts['svg_icon_type'].'" svg_icon="'.$atts['svg_icon'].'" svg_icon_upload="'.$atts['svg_icon_upload'].'" size="'.$atts['size'].'" url="'.$atts['url'].'" icon_style="'.$atts['icon_style'].'" width="'.$atts['width'].'" height="'.$atts['height'].'" radius="'.$atts['radius'].'" background_color="'.$atts['background_color'].'" border_color="'.$atts['border_color'].'" color="'.$atts['color'].'" hover_icon_style="'.$atts['hover_icon_style'].'" hover_radius="'.$atts['hover_radius'].'" hover_background_color="'.$atts['hover_background_color'].'" hover_border_color="'.$atts['hover_border_color'].'" hover_color="'.$atts['hover_color'].'" inline=""]');
		}
		else{
			$atts['text_size'] = ($atts['text_size'])?'font-size:'.$atts['text_size'].'px;':'';
			$atts['text_color'] = ($atts['text_color'])?'color:'.$atts['text_color'].';':'';
			if( !empty($atts['text_size']) || !empty($atts['text_color']) ){
				$text_style = 'style="'.$atts['text_size'].$atts['text_color'].'"';
			}
			$icon = ( $atts['text'] != '' )? '<h5 class="service-box-text" '.$text_style.'>'.$atts['text'].'</h5>' : '';
		}

		$atts['title_color'] = ($atts['title_color'])?'color:'.$atts['title_color'].';':'';
		if( !empty($atts['title']) ){
			$heading = '<h6 class="service-box-heading" style="font-size:'.$atts['title_size'].'px; '.$atts['title_color'].'">'.$atts['title'].'</h6>';
		}

		$atts['description_color'] = ($atts['description_color'])?'style = "color:'.$atts['description_color'].';"':'';
		$description = '<div class="service-box-description" '.$atts['description_color'].'>'.wpb_js_remove_wpautop($content, true).'</div>';
		if( $atts['divide_line'] == '1' ){
			$atts['divide_line_color'] = (!empty($atts['divide_line_color']))?'style="background-color:'.$atts['divide_line_color'].'"':'';
			$divideline = '<div class="divide-line text-'.$atts['align'].'"><span '.$atts['divide_line_color'].'></span></div>';
		}
		if( !empty( $atts['btn_value'] ) ){
			if( $atts['btn_style'] != '' ){
				$btn_style = 'btn-'.$atts['btn_style']; 
			}
			if( $atts['btn_radius'] != '' ){
				$btn_radius = 'style = "border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['btn_radius'] ) ? $atts['btn_radius'] : $atts['btn_radius'] . 'px' ).'; "';  
			}
			$button = '<div class="service-box-btn"><a class="btn '.$btn_style.' btn-'.$atts['btn_choice'].' btn-sm" href="'.$atts['btn_url'].'" '.$btn_radius.'> '.$atts['btn_value'].'</a></div>';
		}

		if( !empty($atts['bg_choice']) ){
			if( !empty($atts['bg_color']) ){
				$bg_style = 'background-color: ' . $atts['bg_color'] . '; ';
				$service_bg_class = 'service-has-background-color ';
			}
			else if( !empty($atts['bg_image']) ){
				$bg_style .= 'background-image: url(\'' . wp_get_attachment_url($atts['bg_image']) . '\'); ';
				$service_bg_class = 'service-has-background-image ';
			}
			else {
				$bg_style = 'border-color: ' . $atts['bg_border_color'] . '; ';
				$service_bg_class = 'service-has-border ';
			}

		}
		if( !empty( $atts['service_padding'] ) ){
			$service_padding_style = 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['service_padding'] ) ? $atts['service_padding'] : $atts['service_padding'] . 'px' ) . '; ';
		}
		if( !empty($bg_style) || !empty($service_padding_style) ){
			$bg_style = 'style="'.$bg_style.$service_padding_style.'"';
			$service_padding_style = 'style="'.$service_padding_style.'"';
		}

		switch( $atts['choice'] ){
			case '1':
				$output = '<div class="'.$atts['class'].' service-box service-box-style-'.$atts['choice'].' text-'.$atts['align'].' '.$service_bg_class.$service_has.'" '.$bg_style.'>
					'.$icon.$heading.$divideline.$description.$button.'
				</div>';
				break;          
			case '2': 
				$output = '<div class="'.$atts['class'].' service-box service-box-style-'.$atts['choice'].' text-'.$atts['service_2_align'].' '.$service_bg_class.$service_has.'" '.$bg_style.'>
					<div class="service-box-style-'.$atts['choice'].'-icon">
						'.$icon.'
					</div>
					<div class="service-box-style-'.$atts['choice'].'-text">
						'.$heading.$divideline.$description.$button.'
					</div>
				</div>';
				break;
			case '3':           
				$output = '<div class="'.$atts['class'].' service-box service-box-style-'.$atts['choice'].' text-'.$atts['align'].' '.$service_bg_class.$service_has.'" '.$bg_style.'>                        
					<div class="service-box-style-'.$atts['choice'].'-icon">
						'.$icon.$divideline.$heading.'
					</div>
					<div class="service-box-style-'.$atts['choice'].'-text" '.$service_padding_style.'>
						'.$description.$button.'
					</div>
				</div>';
				break;
			
		}
		
		return $output;
		
	}

	// Service Boxes
	public static function agni_service_boxes($atts=null, $content=null ){
		$atts = vc_map_get_attributes( 'agni_service_boxes', $atts );
		extract( $atts );

		$values = vc_param_group_parse_atts( $atts['values'] );
		$data = array();

		$output = $col_gutter_css = $row_gutter_css = $grid_column_count = '';

		$carousel = $type;
		$service_autoplay = ( $atts['service_autoplay'] == '1' )?'true':'false';
		$service_autoplay_timeout = $atts['service_autoplay_timeout'];
		$service_autoplay_hover = ( $atts['service_autoplay_hover'] == '1' )?'true':'false';
		$service_loop = ( $atts['service_loop'] == '1' )?'true':'false';
		$service_pagination = ( $atts['service_pagination'] == '1' )?'true':'false';

		$animation = $atts['animation'];
		$animation_style = $atts['animation_style'];
		$animation_delay = $atts['animation_delay'];
		$animation_duration = $atts['animation_duration'];
		$animation_offset = $atts['animation_offset'];

		if( $carousel != '1' ){
			switch( $column_count ){
				case '1' :
					$grid_column_count = ' col-xs-12 col-sm-12 col-md-12 col-lg-12';
					break;
				case '2' :
					$grid_column_count = ' col-xs-12 col-sm-12 col-md-6 col-lg-6';
					break;
				case '3' :
					$grid_column_count = ' col-xs-12 col-sm-6 col-md-4 col-lg-4';
					break;
				case '4' :
					$grid_column_count = ' col-xs-12 col-sm-4 col-md-3 col-lg-3';
					break;
				case '5' :
					$grid_column_count = ' col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
					break;
				case '6' :
					$grid_column_count = ' col-xs-12 col-sm-4 col-md-2_5 col-lg-2';
					break;
			}
		}
		else{
			switch( $column_count ){
				case '1' :
					$carousel_column_count = 'data-service-0="1" data-service-768="1" data-service-992="1" data-service-1200="1"';
					break;
				case '2' :
					$carousel_column_count = 'data-service-0="1" data-service-768="1" data-service-992="2" data-service-1200="2"';
					break;
				case '3' :
					$carousel_column_count = 'data-service-0="1" data-service-768="2" data-service-992="3" data-service-1200="3"';
					break;
				case '4' :
					$carousel_column_count = 'data-service-0="1" data-service-768="3" data-service-992="4" data-service-1200="4"';
					break;
				case '5' :
					$carousel_column_count = 'data-service-0="1" data-service-768="3" data-service-992="4" data-service-1200="5"';
					break;
				case '6' :
					$carousel_column_count = 'data-service-0="1" data-service-768="3" data-service-992="5" data-service-1200="6"';
					break;
			}
		}

		foreach ( $values as $k => $v ) {
			$data[] = array(
				'bg_choice' => ( isset($v['bg_choice']) ) ? $v['bg_choice'] : '',
				'bg_color' => ( isset($v['bg_color']) ) ? $v['bg_color'] : '',
				'bg_image' => ( isset($v['bg_image']) ) ? $v['bg_image'] : '',
				'bg_border_color' =>  ( isset($v['bg_border_color']) ) ? $v['bg_border_color'] : '',
				'text_i_icon' => $v['text_i_icon'],
				'icon_type' => $v['icon_type'],
				'icon' => $v['icon'],
				'svg_icon_type' => $v['svg_icon_type'],
				'svg_icon' => ( isset($v['svg_icon'])) ? $v['svg_icon'] : '',
				'svg_icon_upload' => ( isset($v['svg_icon_upload'])) ? $v['svg_icon_upload'] : '',
				'size' => ( isset($v['size'])) ? $v['size'] : '',
				'url' => ( isset($v['url'])) ? $v['url'] : '',
				'icon_style' => ( isset($v['icon_style'])) ? $v['icon_style'] : '',
				'width' => ( isset($v['width'])) ? $v['width'] : '',
				'height' => ( isset($v['height'])) ? $v['height'] : '',
				'radius' => ( isset( $v['radius']) ) ? $v['radius'] : '',
				'border_color' => ( isset( $v['border_color'] ) ) ? $v['border_color'] : '',
				'background_color' => ( isset( $v['background_color'] ) ) ? $v['background_color'] : '',
				'color' => ( isset( $v['color'] ) ) ? $v['color'] : '',
				'hover_icon_style' => ( isset($v['hover_icon_style'])) ? $v['hover_icon_style'] : '',
				'hover_radius' => ( isset( $v['hover_radius']) ) ? $v['hover_radius'] : '',
				'hover_border_color' =>  ( isset( $v['hover_border_color']) ) ? $v['hover_border_color'] : '',
				'hover_background_color' => ( isset( $v['hover_background_color']) ) ? $v['hover_background_color'] : '',
				'hover_color' => ( isset( $v['hover_color']) ) ? $v['hover_color'] : '',
				'text' => ( isset( $v['text']) ) ? $v['text'] : '',
				'text_size' => ( isset($v['text_size']) ) ? $v['text_size'] : '',
				'text_color' => ( isset($v['text_color']) ) ? $v['text_color'] : '',
				'title' => ( isset($v['title']) ) ? $v['title'] : '',
				'title_size' => ( isset($v['title_size']) ) ? $v['title_size'] : '',
				'title_color' => ( isset($v['title_color']) ) ? $v['title_color'] : '',
				'divide_line' => ( isset($v['divide_line']) ) ? $v['divide_line'] : '',
				'divide_line_color' => ( isset($v['divide_line_color']) ) ? $v['divide_line_color'] : '',
				'content' => ( isset($v['content']) ) ? $v['content'] : '',
				'description_color' => ( isset($v['description_color']) ) ? $v['description_color'] : '',
				'btn_value' => ( isset($v['btn_value']) ) ? $v['btn_value'] : '',
				'btn_url' => ( isset($v['btn_url']) ) ? $v['btn_url'] : '',
				'btn_style' => ( isset($v['btn_style']) ) ? $v['btn_style'] : '',
				'btn_radius' => ( isset($v['btn_radius']) ) ? $v['btn_radius'] : '',
				'btn_choice' => $v['btn_choice']
			);
		}

		$output = $service_box = $service_animation_class = $service_animation_style = $service_animation_attr = '';
		
		if( $carousel != '1' ){
			if( $service_gutter != '0' || empty($service_gutter) ){
				$col_gutter_css = 'padding: '.intval($service_gutter/2).'px;';
				$row_gutter_css = 'style="margin: 0px -'.intval($service_gutter/2).'px;"';
			}
			$count = $delay = 0;
		}
		else{
			$i = $c = 0;
		}

		foreach ( $data as $atts ) {
			//$output .=  $v['label'];
			$service_has = $icon = $heading = $description = $divideline = $button = $btn_style = $btn_radius = $bg_style = $service_padding_style = $service_bg_class = '';
			if( $atts['text_i_icon'] == '1' ){
				$icon = do_shortcode('[agni_icon icon_type="'.$atts['icon_type'].'" icon="'.$atts['icon'].'" svg_icon_type="'.$atts['svg_icon_type'].'" svg_icon="'.$atts['svg_icon'].'" svg_icon_upload="'.$atts['svg_icon_upload'].'" size="'.$atts['size'].'" url="'.$atts['url'].'" icon_style="'.$atts['icon_style'].'" width="'.$atts['width'].'" height="'.$atts['height'].'" radius="'.$atts['radius'].'" background_color="'.$atts['background_color'].'" border_color="'.$atts['border_color'].'" color="'.$atts['color'].'" hover_icon_style="'.$atts['hover_icon_style'].'" hover_radius="'.$atts['hover_radius'].'" hover_background_color="'.$atts['hover_background_color'].'" hover_border_color="'.$atts['hover_border_color'].'" hover_color="'.$atts['hover_color'].'" inline=""]');

				}
			else{
				$atts['text_size'] = ($atts['text_size'])?'font-size:'.$atts['text_size'].'px;':'';
				$atts['text_color'] = ($atts['text_color'])?'color:'.$atts['text_color'].';':'';
				if( !empty($atts['text_size']) || !empty($atts['text_color']) ){
					$text_style = 'style="'.$atts['text_size'].$atts['text_color'].'"';
				}
				$icon = ( $atts['text'] != '' )? '<h5 class="service-box-text" '.$text_style.'>'.$atts['text'].'</h5>' : '';
			}
			$atts['title_color'] = ($atts['title_color'])?'color:'.$atts['title_color'].';':'';
			if( !empty($atts['title']) ){
				$heading = '<h6 class="service-box-heading" style="font-size:'.$atts['title_size'].'px; '.$atts['title_color'].'">'.$atts['title'].'</h6>';
			}

			$atts['description_color'] = ($atts['description_color'])?'style = "color:'.$atts['description_color'].';"':'';
			$description = '<div class="service-box-description" '.$atts['description_color'].'>'.$atts['content'].'</div>';
			if( $atts['divide_line'] == '1' ){
				$atts['divide_line_color'] = (!empty($atts['divide_line_color']))?'style="background-color:'.$atts['divide_line_color'].'"':'';
				$divideline = '<div class="divide-line text-'.$align.'"><span '.$atts['divide_line_color'].'></span></div>';
			}
			if( !empty( $atts['btn_value'] ) ){
				if( $atts['btn_style'] != '' ){
					$btn_style = 'btn-'.$atts['btn_style']; 
				}
				if( $atts['btn_radius'] != '' ){
					$btn_radius = 'style = "border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['btn_radius'] ) ? $atts['btn_radius'] : $atts['btn_radius'] . 'px' ).'; "';  
				}
				$button = '<div class="service-box-btn"><a class="btn '.$btn_style.' btn-'.$atts['btn_choice'].' btn-sm" href="'.$atts['btn_url'].'" '.$btn_radius.'> '.$atts['btn_value'].'</a></div>';
			}

			if( !empty($atts['bg_choice']) ){
				if( !empty($atts['bg_color']) ){
					$bg_style = 'background-color: ' . $atts['bg_color'] . '; ';
					$service_bg_class = 'service-has-background-color ';
				}
				else if( !empty($atts['bg_image']) ){
					$bg_style = 'background-image: url(\'' . wp_get_attachment_url($atts['bg_image']) . '\'); ';
					$service_bg_class = 'service-has-background-image ';
				}
				else {
					$bg_style = 'border-color: ' . $atts['bg_border_color'] . '; ';
					$service_bg_class = 'service-has-border ';
				}
			}
			if( !empty( $service_padding ) ){
				$service_padding_style = 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $service_padding ) ? $service_padding : $service_padding . 'px' ) . '; ';
			}

			if( !empty($bg_style) || !empty($service_padding_style) ){
				$bg_style = 'style="'.$bg_style.$service_padding_style.'"';
				$service_padding_style = 'style="'.$service_padding_style.'"';
			}

			if( $service_shadow == '1' ){
				$service_shadow = ' has-shadow';
			}

			switch( $choice ){
				case '1':
					$service_box = '<div class ="service-box service-box-style-'.$choice.' text-'.$align.' '.$service_bg_class.$service_has.$service_shadow.'" '.$bg_style.'>
						'.$icon.$heading.$divideline.$description.$button.'
					</div>';
					break;              
				case '2': 
					$service_box = '<div class ="service-box service-box-style-'.$choice.' text-'.$service_2_align.' '.$service_bg_class.$service_has.$service_shadow.'" '.$bg_style.'>
						<div class="service-box-style-'.$choice.'-icon">
							'.$icon.'
						</div>
						<div class="service-box-style-'.$choice.'-text">
							'.$heading.$divideline.$description.$button.'
						</div>
					</div>';
					break;
				case '3':           
					$service_box = '<div class ="service-box service-box-style-'.$choice.' text-'.$align.' '.$service_bg_class.$service_has.$service_shadow.'" '.$bg_style.'>
						<div class="service-box-style-'.$choice.'-icon">
							'.$icon.$divideline.$heading.'
						</div>
						<div class="service-box-style-'.$choice.'-text" '.$service_padding_style.'>
							'.$description.$button.'
						</div>
					</div>';
					break;
				
			}

			if( $animation == '1' ){
				if( $count >= $column_count ){
	                $delay = $count = 0;
	            }

				$delay += $animation_delay; // Animation Delay
		        $duration = $animation_duration;  // Animation Duration
		        $count += 1;  // Animation Iteration

				$service_animation_class = ' animate';
				$service_animation_attr = 'data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'"';
				$service_animation_style = 'animation-duration: '.$duration.'s; animation-delay: '.$delay.'s; -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s';
			}

			$service_box = '<div class="service-box-column'.$grid_column_count.$service_animation_class.'" style="'.$col_gutter_css.$service_animation_style.'" '.$service_animation_attr.'>'.$service_box.'</div>';

			// added additionally for carusel
			if( $carousel == '1' ){
				if( $i == $c ){ $c += $column_items; // number of items in carousel
					$service_box = '<div class="service-box-carousel-column">'.$service_box.'</div>';
				}
				$i += 1;
			}

			$output .= $service_box;
		}
		
		if( $carousel != '1' ){
			$output = '<div class="row service-box-container" '.$row_gutter_css.'>'.$output.'</div>';
		}
		else{
			$output = '<div class="service-box-container carousel-service-box" data-service-gutter="'.$service_gutter.'" data-service-autoplay="'.$service_autoplay.'" data-service-autoplay-timeout="'.$service_autoplay_timeout.'" data-service-autoplay-hover="'.$service_autoplay_hover.'" data-service-loop="'.$service_loop.' " data-service-pagination="'.$service_pagination.'" '.$carousel_column_count.'>'.$output.'</div>';
		}
		
		return $output;
		
	}
	
	//pricing table
	public static function  agni_pricingtable($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_pricingtable', $atts );
		extract( $atts );   

		if( !empty($atts['heading']) ){
			if( $atts['pricing_style'] == '1' ){
				$atts['heading'] = '<p class="pricing-title">'.$atts['heading'].'</p>';
			}
			else{
				$atts['heading'] = '<h6 class="pricing-title">'.$atts['heading'].'</h6>';
			}
		}
		if( !empty($atts['interval']) ){
			$atts['interval'] = '<span class="pricing-interval">'.$atts['interval'].'</span>';
		}

		if( !empty($atts['value']) ){
			$btn_style = $style = $size = $padding_bottom = $radius = $padding_bottom_style = '';
			if( $atts['size'] != '' ){
				$size = ' btn-'.$atts['size'];  
			}
			if( $atts['style'] != '' ){
				$btn_style = ' btn-'.$atts['style'];
			}
			if( !empty($atts['radius']) ){
				$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
			}
			if( !empty( $atts['padding_bottom'] ) ){
				$padding_bottom .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['padding_bottom'] ) ? $atts['padding_bottom'] : $atts['padding_bottom'] . 'px' ) . '; ';
			}
			if( $radius != '' ){
				$style = 'style="'.$radius.'"';
			}
			if( $padding_bottom != '' ){
				$padding_bottom_style = 'style="'.$padding_bottom.'"';
			}

			$atts['value'] = '<div class="pricing-button" '.$padding_bottom_style.'><a class="btn'.$btn_style.$size.' btn-'.$atts['choice'].'" target="'.$atts['target'].'" href="'.$atts['url'].'" '.$style.'>'.$atts['value'].'</a></div>';
		}

		if( !empty($atts['price_color']) ){
				$atts['price_color'] = 'style="color:'.$atts['price_color'].'"';
			}
		
		$output= '<div class="'.$atts['class'].' pricing-table-content pricing-style-'.$atts['pricing_style'].'" style="background-color:'.$atts['bg_color'].';">
			<div class="pricing-cost-details">
				'.$atts['heading'].'
				<h2 class="pricing-cost" '.$atts['price_color'].'>'.$atts['price'].$atts['interval'].'</h2>
			</div>
			<div class="pricing-feature-details">
				'.wpb_js_remove_wpautop($content, true).$atts['value'].'                
			</div>
		</div>';
		return $output;
	}
	
	// Milestone
	public static function  agni_milestone($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_milestone', $atts );
		extract( $atts );
		
		$align = $mile_icon = '';

		if( $atts['style'] == '1' && !empty($atts['align']) ){
			$align = 'text-'.$atts['align'];
		}

		if( !empty( $atts['icon'] ) || !empty( $atts['svg_icon'] ) || !empty( $atts['svg_icon_upload'] ) ){
			/*$mile_icon = '<div class="mile-icon" style="color:'.$atts['icon_color'].'; font-size: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['icon_size'] ) ? $atts['icon_size'] : $atts['icon_size'] . 'px' ) . '; '.'">
				<i class="'.$atts['icon'].'"></i>                                       
			</div>';*/

			$mile_icon = do_shortcode('[agni_icon icon_type="'.$atts['icon_type'].'" icon="'.$atts['icon'].'" svg_icon_type="'.$atts['svg_icon_type'].'" svg_icon="'.$atts['svg_icon'].'" svg_icon_upload="'.$atts['svg_icon_upload'].'" size="'.$atts['icon_size'].'" color="'.$atts['icon_color'].'"  hover_color="'.$atts['icon_color'].'" inline="" class="mile-icon"]');
		}
		
		$output = '<div class="mile-content '.$atts['dark_mode'].' '.$align.' milestone-style-'.$atts['style'].' '.$atts['class'].'">
			'.$mile_icon.'
			<div class="mile-description">
				<div class="mile-count">
					<h4 class="count" style="font-size: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['mile_font_size'] ) ? $atts['mile_font_size'] : $atts['mile_font_size'] . 'px' ) . '; '.'" data-count="'.$atts['mile'].'" data-count-animation="'.$atts['count'].'" data-sep="'.$atts['mile_separator'].'" data-pre="'.$atts['mile_prefix'].'" data-suf="'.$atts['mile_suffix'].'" data-animation-offset="'.$atts['animation_offset'].'" >'.$atts['mile'].'</h4>
				</div>
				<div class="mile-title">
					<p>'.$atts['title'].'</p>
				</div>
			</div>
		</div>';
				
		return $output;

	}
	
	// Progress bar
	public static function  agni_progressbar($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_progressbar', $atts );
		extract( $atts );
		
		$percent_1 = $percent_2 = $style = '';
		if( $atts['style'] == '1' ){
			$percent_1 = '<span class="progress-percentage">'.$atts['percentage'].'%</span>';
		}
		else{
			$percent_2 = '<h2 class="progress-percentage">'.$atts['percentage'].'%</h2>';
		}

		$output= '<div class="'.$atts['class'].' progress-bar-style-'.$atts['style'].'">
			'.$percent_2.'
			<div class="progress-bar-container">
				<p class="progress-heading">' . $atts['title'] . $percent_1 .'</p>
				<div class="progress" style="background-color:'.$atts['track_color'].';">
					<div class="progress-bar progress-bar-animate" style="background-color:'.$atts['bar_color'].'" role="progressbar" aria-valuenow="'.$atts['percentage'].'" aria-valuemin="0" aria-valuemax="100"  data-animation-offset="'.$atts['animation_offset'].'" >
						<span class="sr-only">'.$atts['percentage'].'% Complete</span>
					</div>
				</div>
			</div>
		</div>';
		
		return $output;
	}

	// Circle bar
	public static function  agni_circlebar($atts = null, $content = null){
		$atts = vc_map_get_attributes( 'agni_circlebar', $atts );
		extract( $atts );
		
		if( $atts['style'] == '1' ){
			$circle_content = '<p class="percent circle-bar-content"></p>';
		}
		else{
			$circle_content = '<p class="circle-bar-icon circle-bar-content"><i class="'.$atts['icon'].'"></i></p>';
		}

		$output= '<div class="'.$atts['class'].' circle-bar chart text-'.$atts['align'].'"  data-animation-offset="'.$atts['animation_offset'].'"  data-percent="'.$atts['percentage'].'" data-barcolor="'.$atts['bar_color'].'" data-trackcolor="'.$atts['track_color'].'" data-scalecolor="'.$atts['scale_color'].'" data-animation="'.$atts['animation'].'" data-scalelength="'.$atts['scale_length'].'" data-linewidth="'.$atts['line_width'].'" data-linecap="'.$atts['line_cap'].'" data-size="'.$atts['size'].'" style="width:'.$atts['size'].'px; height:'.$atts['size'].'px; line-height:'.$atts['size'].'px;">
			'.$circle_content.'
		</div>';
		
		return $output;
	}
	
	// list
	public static function agni_list( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_list', $atts );
		extract( $atts );
		
		$radius = $icon_style = '';
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
		}

		if( $atts['icon_style'] != '' ){
			$icon_style = 'style="'.$radius.' '.$atts['icon_style'].'-color:'.$atts[$atts['icon_style'].'_color'].'; color:'.$atts['color'].'"';
			$icon_has = 'icon-has-'.$atts['icon_style'].'';
		}
		else{
			$icon_style = 'style="color:'.$atts['color'].'"';
			$icon_has = '';
		}

		$output = str_replace( '<li>', '<li><i class="'.$atts['icon'].' '.$icon_has.'" '.$icon_style.'></i>', wpb_js_remove_wpautop($content, true) );
		return str_replace( '<ul>','<ul class="list '.$atts['class'].'">', $output );
	}

	// button
	public static function agni_button( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_button', $atts );
		extract( $atts );
		
		$output = $btn_style = $style = $size = $margin = $icon = $no_btn = $additional_class = $additional_attr = ''; 

		if( $atts['icon'] != '' ){
			$icon = '<i class="'.$atts['icon'].'"></i>';
		}
		if( $atts['size'] != '' ){
			$size = ' btn-'.$atts['size'];  
		}
		if( $atts['style'] != '' ){
			$btn_style = ' btn-'.$atts['style'];
		}
		if( $atts['value'] == '' ){
			$no_btn = ' no-btn-text';
		}
		
		if( !empty($atts['margin_top']) || !empty( $atts['margin_bottom'] ) || !empty( $atts['margin_left'] ) || !empty( $atts['margin_right'] ) ){
			$margin .= 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['margin_top'] ) ? $atts['margin_top'] : $atts['margin_top'] . 'px' ) . '; ';
			$margin .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['margin_bottom'] ) ? $atts['margin_bottom'] : $atts['margin_bottom'] . 'px' ) . '; ';
			$margin .= 'margin-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['margin_left'] ) ? $atts['margin_left'] : $atts['margin_left'] . 'px' ) . '; ';
			$margin .= 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['margin_right'] ) ? $atts['margin_right'] : $atts['margin_right'] . 'px' ) . '; ';
		}
		$radius = '';
		if( !empty($atts['radius']) ){
			$radius = 'border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ).';';
		}
		if( $margin != '' || $radius != '' ){
			$style = 'style="'.$margin.$radius.'"';
		}

		if( $atts['parallax'] == '1' ){
			$additional_class = ' has-parallax';
			$additional_attr = ' data-bottom-top="'.$atts['parallax_start'].'" data-top-bottom="'.$atts['parallax_end'].'"';
		}

		$output = $atts['value'].$icon;

		if( $atts['animation'] == '1' ){
			$output = '<div class="animate" data-animation="'.$atts['animation_style'].'" data-animation-offset="'.$atts['animation_offset'].'" style="animation-duration: '.$atts['animation_duration'].'s; 	animation-delay: '.$atts['animation_delay'].'s; 	-moz-animation-duration: '.$atts['animation_duration'].'s; 	-moz-animation-delay: '.$atts['animation_delay'].'s; 	-webkit-animation-duration: '.$atts['animation_duration'].'s; 	-webkit-animation-delay: '.$atts['animation_delay'].'s;">'.$output.'</div>';	
		}

		$output = '<div class="'.$atts['class'].$additional_class.' agni-button '.$atts['inline'].$no_btn.' text-'.$atts['alignment'].' page-scroll"><a class="btn'.$btn_style.$size.' btn-'.$atts['choice'].'" target="'.$atts['target'].'" href="'.$atts['url'].'" '.$style.' '.$additional_attr.'>'.$output.'</a></div>';
		
		return $output;
	}
	
	// Alerts
	public static function agni_alerts( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_alerts', $atts );
		extract( $atts );
			
		if($atts['dismissable'] == 'yes'){
			$output = '<div class="'.$atts['class'].' alert alert-'.$atts['choice'].' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.wpb_js_remove_wpautop($content, true).'</div>';  
		}
		else{
			$output = '<div class="'.$atts['class'].' alert alert-'.$atts['choice'].'">'.wpb_js_remove_wpautop($content, true).'</div>';    
		}
		
		return $output;
	}
	
	// Image
	public static function agni_image( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_image', $atts );
		extract( $atts );

		$grayscale = $img_link = $lightbox = $img_style = $beforeafter_class = $caption = $caption_after = '';
		$animation = $atts['animation'];
		$animation_style = $atts['animation_style'];
		$animation_delay = $atts['animation_delay'];
		$animation_duration = $atts['animation_duration'];
		$animation_offset = $atts['animation_offset'];

		$background_color = ( !empty($atts['background_color']) ) ? 'background-color: ' . $atts['background_color'] . '; ' : '';
		$border_color = ( !empty($atts['border_color']) ) ? 'border-color: ' . $atts['border_color'] . '; ' : '';
		$radius = ( !empty($atts['radius']) ) ? 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['radius'] ) ? $atts['radius'] : $atts['radius'] . 'px' ) . '; ' : '';

		if( $atts['img_style'] !== '' ){
			$img_style = 'image-has-'.$atts['img_style'].'';
		}

		$img_id = preg_replace( '/[^\d]/', '', $atts['img_url'] );
		
		if( $atts['img_size'] == 'custom' ){
			$atts['img_size'] = $atts['img_size_custom'];
		}
		$img = wpb_getImageBySize( array(
			'attach_id' => $img_id,
			'thumb_size' => $atts['img_size'],
			'class' => 'fullwidth-image attachment-'.$atts['img_size'] .' '. $img_style.''
		) );

		if( $atts['img_type'] == 'beforeafter' ){
			$img_aft_id = preg_replace( '/[^\d]/', '', $atts['img_after_url'] );
			$img_after = wpb_getImageBySize( array(
				'attach_id' => $img_aft_id,
				'thumb_size' => $atts['img_size'],
				'class' => 'fullwidth-image attachment-'.$atts['img_size'] .' '. $img_style.''
			) );
			$beforeafter_class = ' ba-slider';
		}
		
		if( $atts['img_link'] == '4' ){
			$img_link = $atts['img_custom_link'];
		}
		else{
			$img_link = wp_get_attachment_url( $atts['img_url'] );
		}   

		if( $atts['img_link'] == '3' ){
			$lightbox = 'class="custom-image"';
		}

		$html = $img['thumbnail'];


		$img['thumbnail'] = str_replace( '<img ', '<img style="'.$radius. $border_color . $background_color .'" ', $img['thumbnail'] );
		if( $atts['img_link'] != '1' ){
			$html = '<a href="'.$img_link.'" '.$lightbox.' target="'.$atts['img_custom_link_target'].'">'.$img['thumbnail'].'</a>';
		}
		else{
			$html = $img['thumbnail'];
		}
		if($atts['img_gs_filter']){ 
            $grayscale = ' has-grayscale'; 
        }

		if ( !empty($atts['img_caption']) ) {
			$post = get_post( $img_id );
			$caption = $post->post_excerpt;
			if( !empty($img_aft_id) ){
				$post_after = get_post( $img_aft_id );
				$caption_after = $post_after->post_excerpt;
			}
		}
		$html = '
			<figure class="agni-image-figure">
				' . $html . '
				<figcaption class="vc_figure-caption">' . esc_html( $caption ) . '</figcaption>
			</figure>
		';
		if( !empty($img_after) ){
			$img_after['thumbnail'] = str_replace( '<img ', '<img style="'.$radius. $border_color . $background_color .'" ', $img_after['thumbnail'] );
			$html .= '<div class=" resize">
		    	<figure class="agni-image-figure">
		    		'.$img_after['thumbnail'].'
		       		<figcaption class="vc_figure-caption">'.$caption_after.'</figcaption>
		       </figure>
		   </div>
		   <span class="handle"><span><i class="fa fa-arrows-h"></i></span></span>';
		}


		$output = '<div class="'.$atts['class'].' agni-image custom-image-container text-'.$atts['alignment'].$grayscale.$beforeafter_class.'">';
		if( $animation == '1' ){
			$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s;     animation-delay: '.$animation_delay.'s;     -moz-animation-duration: '.$animation_duration.'s;  -moz-animation-delay: '.$animation_delay.'s;    -webkit-animation-duration: '.$animation_duration.'s;   -webkit-animation-delay: '.$animation_delay.'s; ">';    
		}
		if( $atts['parallax'] == '1' ){
			$output .= '<div class="image-has-parallax" data-bottom-top="'.$atts['parallax_start'].'" data-top-bottom="'.$atts['parallax_end'].'">';
		}
		$output .= $html;
		if( $atts['parallax'] == '1' ){
			$output .= '</div>';
		}
		if( $animation == '1' ){
			$output .= '</div>';    
		}
		$output .= '</div>';
		return $output;
	}
	
	// Gallery
	public static function agni_gallery( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_gallery', $atts );
		extract( $atts );

		$carousel_column = $column = $gallery_autoplay = $gallery_autoplay_timeout = $gallery_autoplay_hover = $gallery_loop = $gallery_autoheight = $gallery_center = $gallery_pagination = $gallery_row_attr = $gallery_column_padding = $gallery_row_margin = $gallery_lightbox = $grayscale = $img = $img_array = $gallery_grid_sizer = '';

		if( $atts['gap'] == '' )
			$atts['gap'] = 0;
		if( $atts['type'] == '1' ){
			switch( $atts['column'] ){
				case '1' :
					$carousel_column = 'data-gallery-0="1" data-gallery-768="1" data-gallery-992="1" data-gallery-1200="1"';
					break;
				case '2' :
					$carousel_column = 'data-gallery-0="1" data-gallery-768="1" data-gallery-992="2" data-gallery-1200="2"';
					break;
				case '3' :
					$carousel_column = 'data-gallery-0="1" data-gallery-768="2" data-gallery-992="3" data-gallery-1200="3"';
					break;
				case '4' :
					$carousel_column = 'data-gallery-0="1" data-gallery-768="3" data-gallery-992="4" data-gallery-1200="4"';
					break;
				case '5' :
					$carousel_column = 'data-gallery-0="2" data-gallery-768="4" data-gallery-992="5" data-gallery-1200="5"';
					break;
				case '6' :
					$carousel_column = 'data-gallery-0="2" data-gallery-768="4" data-gallery-992="6" data-gallery-1200="6"';
					break;
			}
			$gallery_type = 'carousel-gallery';
			$gallery_autoplay = ( $atts['gallery_autoplay'] == '1' )?'true':'false';
			$gallery_autoplay_timeout = $atts['gallery_autoplay_timeout'];
			$gallery_autoplay_hover = ( $atts['gallery_autoplay_hover'] == '1' )?'true':'false';
			$gallery_loop = ( $atts['gallery_loop'] == '1' )?'true':'false';
			$gallery_autoheight = ( $atts['gallery_autoheight'] == '1' )?'true':'false';
			$gallery_center = ( $atts['gallery_center'] == '1' )?'true':'false';
			$gallery_pagination = ( $atts['gallery_pagination'] == '1' )?'true':'false';
			if( $atts['carousel_type'] == 'bg-carousel' ){
				$gallery_row_margin = 'style="height:'.( preg_match( '/(px|em|\%|pt|cm|vh|\))$/', $atts['carousel_height'] ) ? $atts['carousel_height'] : $atts['carousel_height'] . 'px' ).'"';
			}
			$gallery_row_attr =  'data-gallery-margin='.$atts['gap'].' data-gallery-autoplay='.$gallery_autoplay.' data-gallery-autoplay-timeout='.$gallery_autoplay_timeout.' data-gallery-autoplay-hover='.$gallery_autoplay_hover.' data-gallery-loop='.$gallery_loop.' data-gallery-autoheight='.$gallery_autoheight.' data-gallery-center='.$gallery_center.' data-gallery-pagination='.$gallery_pagination.' ';
		}
		else{
			switch( $atts['column'] ){
				case '1' :
					$column = 'col-xs-12 col-sm-12 col-md-12 ';
					break;
				case '2' :
					$column = 'col-xs-12 col-sm-12 col-md-6 ';
					break;
				case '3' :
					$column = 'col-xs-12 col-sm-6 col-md-4 ';
					break;
				case '4' :
					$column = 'col-xs-12 col-sm-4 col-md-3 ';
					break;
				case '5' :
					$column = 'col-xs-12 col-sm-4 col-md-2_5 ';
					break;
				case '6' :
					$column = 'col-xs-12 col-sm-4 col-md-2 ';
					break;
			}
			$gallery_type = 'grid-gallery';
			$gallery_column_padding = 'padding: 0 '.($atts['gap']/2).'px '.$atts['gap'].'px; ';
			$gallery_row_margin = 'style="margin: 0 -'.($atts['gap']/2).'px -'.$atts['gap'].'px;"';
			$gallery_row_attr = 'data-grid="'.$atts['gallery-grid-layout'].'"';
		}
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $column .'custom-gallery-item agni-gallery-column' , 'agni_gallery', $atts );
		
		if( $atts['img_link'] == '3' ){
			$gallery_lightbox = 'custom-gallery';
		}

		if($atts['img_gs_filter']){ 
            $grayscale = 'has-grayscale '; 
        }

		$slides = array_filter( explode(",", $atts['img_url']) );
		$src1 = $caption = '';
		$i = $delay = 0; 
		foreach( (array) $slides as $key => $slide_id ){
			$gallery_animation_class = $gallery_animation_attr = $gallery_animation_style = '';

			$attachment_image = get_post( $slide_id );
				$attachment_info = get_post( $slide_id );
			if ( !empty($atts['img_caption']) ) {
				$caption = '<figcaption>'.$attachment_info->post_excerpt.'</figcaption>';
			}
			
			if( $atts['img_size'] == 'custom' ){
				$img_array = wpb_getImageBySize( array(
					'attach_id' => $slide_id,
					'thumb_size' => $atts['img_size_custom'],
					'class' => 'fullwidth-image attachment-'.$atts['img_size_custom'] .' ',
				) );
				//$img = str_replace('<img', '<img title="'.$attachment_info->post_excerpt.'"', $img_array['thumbnail']);
				$img = $img_array['thumbnail'];
			}
			else{
				if( $atts['carousel_type'] == 'bg-carousel' ){
					$img = '<div class="agni-gallery-figure-bg" style="background-image:url('.wp_get_attachment_url( $slide_id ).');"></div>';
				}
				else{
					$img = wp_get_attachment_image( $slide_id, $atts['img_size'] );
				}
			}
			
			if( $atts['img_link'] != '1' ){
				$img = '<a href="'.wp_get_attachment_url( $slide_id ).'">'. $img.'</a>';
			}

			if( $atts['type'] != '1' ){
				if( $i >= $atts['column'] ){
	                $delay = $i = 0;
	            }
	        }
	        $delay += $atts['animation_delay']; // Animation Delay
	        $duration = $atts['animation_duration'];  // Animation Duration
	        $i += 1;  // Animation Iteration
			if( $atts['animation'] == '1' ){
				$gallery_animation_class = 'animate ';
				$gallery_animation_attr = 'data-animation="'.$atts['animation_style'].'" data-animation-offset="'.$atts['animation_offset'].'"';
				$gallery_animation_style = 'animation-duration: '.$duration.'s; 	animation-delay: '.$delay.'s; -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s';
			}

			$src1 .= '<div class="'.$gallery_animation_class.$grayscale.$css_class.'" style="'.$gallery_column_padding.$gallery_animation_style.'" '.$gallery_animation_attr.'><figure class="agni-gallery-figure">';
			$src1 .= $img;
			$src1 .= $caption;
			$src1 .= '</figure></div>';
		
		}
		if( $atts['type'] != '1' ){
			$gallery_grid_sizer = '<div class="grid-sizer '.$column.'"></div>';
		}
		
		$output = '<div class="agni-gallery '.$atts['carousel_type'].' '.$gallery_lightbox.'"><div class="agni-gallery-row row '.$gallery_type.' '. $atts['class'].'" '.$gallery_row_attr.$carousel_column.' '.$gallery_row_margin.'>'.$src1.$gallery_grid_sizer.'</div></div>';
			
		return $output;
	}
	
	// video
	public static function agni_video( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_video', $atts );
		extract( $atts );

		$id = rand(10000,99999);

		if( $atts['auto_play'] != 'true' ){
			$atts['auto_play'] = 'false';
		}
		if( $atts['loop'] != 'true' ){
			$atts['loop'] = 'false';
		}
		if( $atts['mute'] != 'true' ){
			$atts['mute'] = 'false';
		}

		if( $atts['video_type'] == '1' ){
			$height = '';
			if( $atts['height'] != '' ){
				$height = 'style="height:'.$atts['youtube_height'].'px"';
			}
			$output = '<div class="'.$atts['class'].' agni-video">
				<div class="agni-video-container agni-video-container-'.$id.'" '.$height.'>
					<a id="agni-video-'.$id.'" class="player" data-property="{videoURL:\''.$atts['url'].'\', containment:\'.agni-video-container-'.$id.' \', showControls:false, autoPlay:'.$atts['auto_play'].', loop:'.$atts['loop'].', vol:'.$atts['vol'].', mute:'.$atts['mute'].', startAt:'.$atts['start_at'].', stopAt:'.$atts['stop_at'].', opacity:1, addRaster:false, optimizeDisplay:true, quality:\''.$atts['quality'].'\'}" style="background-image:url(\' '.wp_get_attachment_url( $atts['fallback'] ).' \')"></a>
					<div class="overlay" style="opacity:'.$atts['overlay_opacity'].'"></div>
					<div class="section-video-controls agni-video-controls">
						<a class="command command-play" href="#"></a>
						<a class="command command-pause" href="#"></a>
					</div>
				</div>
			</div>';
		}
		elseif( $atts['video_type'] == '2' ){
			$autoplay = $loop = $muted = '';
			if( $atts['self_player'] == '1' ){
				if( $atts['self_auto_play'] == 'on' ){
					$autoplay = 'autoplay ';
				}
				if( $atts['self_loop'] == 'on' ){
					$loop = 'loop ';
				}
				if( $atts['self_mute'] == 'on' ){
					$muted = 'muted ';
				}
				$output = '<div id="agni-video-'.$id.'" class="'.$atts['class'].' custom-video agni-video self-hosted embed-responsive embed-responsive-16by9">
					<video '. $autoplay . $loop . $muted . ' class="custom-self-hosted-video" poster="'.wp_get_attachment_url( $atts['self_poster'] ).'">
						<source src="'.$atts['self_url'].'" type="video/mp4">
					</video>
				</div>';
			}
			else{
				if( $atts['self_auto_play'] == 'on' ){
					$autoplay = 'autoplay = "on"';
				}
				if( $atts['self_loop'] == 'on' ){
					$loop = 'loop = "on"';
				}
				$output = '<div class="agni-video">'.do_shortcode('[video src="'.$atts['self_url'].'" '.$autoplay.' '.$loop.' preload="'.$atts['self_preload'].'" ]').'</div>';
			}
		}
		elseif( $atts['video_type'] == '3' ){
			if( $atts['iframe_style'] == '1' ){
				$output = do_shortcode('[agni_button value="'.$atts['button_value'].'" icon="'.$atts['icon'].'" url="'.$atts['iframe_url'].'" size="'.$atts['button_size'].'" style="'.$atts['button_style'].'" choice="'.$atts['button_choice'].'" radius="'.$atts['button_radius'].'" alignment="'.$atts['button_alignment'].'" class="'.$atts['class'].' custom-video-link cutom-iframe-style-'.$atts['iframe_style'].'" ]');
			}
			else{
				$output = '<div class="'.$atts['class'].' custom-video-link custom-iframe-style-'.$atts['iframe_style'].'"><a href="'.$atts['iframe_url'].'">'.do_shortcode( '[agni_icon icon="'.$atts['icon'].'" size="'.$atts['size'].'" icon_style="'.$atts['icon_style'].'" width="'.$atts['width'].'" height="'.$atts['height'].'" radius="'.$atts['radius'].'" border_color="'.$atts['border_color'].'" background_color="'.$atts['background_color'].'" color="'.$atts['color'].'" hover_icon_style="'.$atts['hover_icon_style'].'" hover_radius="'.$atts['hover_radius'].'" hover_border_color="'.$atts['hover_border_color'].'" hover_background_color="'.$atts['hover_background_color'].'" hover_color="'.$atts['hover_color'].'" ]' ).'</a></div>';
			}
		} 
		else{
			$output = '<div id="agni-video-'.$id.'" class="'.$atts['class'].' custom-video agni-video embed-responsive embed-responsive-16by9">
				'.trim( vc_value_from_safe( $atts['embed'] ) ).'
			</div>  ' ; 
		}
		return $output;
	}
	
	
	// gmap
	public static function agni_gmap( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_gmap', $atts );
		extract( $atts );  
		
		$map_icon = ( !empty($atts['google_map_icon']) ) ? wp_get_attachment_url($atts['google_map_icon']) : get_template_directory_uri().'/img/marker.png';
		$id = ( !empty($atts['id']) ) ? $atts['id'] : 'map_canvas';

		$output = '<div id="'.$id.'" class="map-canvas '.$atts['class'].' map-canvas-style-'.$atts['style'].'" style="height:'.( preg_match( '/(px|\%|vh)$/', $atts['height'] ) ? $atts['height'] : $atts['height'] . 'px' ).';" data-map-style="'.$atts['style'].'" data-map-accent-color="'.$atts['color'].'" data-map-drag="'.$atts['drag'].'" data-map-zoom = "'.$atts['zoom'].'" data-map="'.$map_icon.'" data-lng="'.$atts['google_map_lng'].'" data-lat="'.$atts['google_map_lat'].'" data-add1="'.$atts['google_address_1'].'" data-add2="'.$atts['google_address_2'].'" data-add3="'.$atts['google_address_3'].'" data-lng-2="'.$atts['google_map_lng_2'].'" data-lat-2="'.$atts['google_map_lat_2'].'" data-add1-2="'.$atts['google_address_1_2'].'" data-add2-2="'.$atts['google_address_2_2'].'" data-add3-2="'.$atts['google_address_3_2'].'" data-dir="'.get_template_directory_uri().'"></div>';
			
		return $output;
	}

	// countdown
	public static function agni_countdown( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_countdown', $atts );
		extract( $atts );         
			
		$output = '<ul class="countdown list-inline '.$atts['class'].'" data-counter="'.$atts['date'].'" data-label="'.$atts['label'].'">
			<li class="col-xs-12 col-sm-6 col-md-3">
				<h2 class="days">00</h2>
				<p class="timeRefDays"></p>
			</li>
			<li class="col-xs-12 col-sm-6 col-md-3">
				<h2 class="hours">00</h2>
				<p class="timeRefHours"></p>
			</li>
			<li class="col-xs-12 col-sm-6 col-md-3">
				<h2 class="minutes">00</h2>
				<p class="timeRefMinutes"></p>
			</li>
			<li class="col-xs-12 col-sm-6 col-md-3">
				<h2 class="seconds">00</h2>
				<p class="timeRefSeconds"></p>
			</li>
		</ul>';
			
		return $output;
	}

	// menu
	public static function agni_menu( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_menu', $atts );
		extract( $atts );   
		$output = '';

		$output = '<div class="' . esc_attr( $atts['class'] ) . ' agni-nav-menu custom-nav-menu page-scroll" style="background-color:'.$atts['bg_color'].'; color:'.$atts['color'].';" data-sticky="1"><div class="container'.$atts['fullwidth'].'">';
		$type = 'WP_Nav_Menu_Widget';
		$args = array();
		global $wp_widget_factory;
		// to avoid unwanted warnings let's check before using widget
		if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
			ob_start();
			the_widget( $type, $atts, $args );
			$output .= ob_get_clean();

			$output .= '</div></div><div class="agni-nav-menu-spacer"></div>';
		} else {
			$output = $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_custommenu' );
		}
			
		return $output;
	}

	// menu card
	public static function agni_menu_card( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_menu_card', $atts );
		extract( $atts );   
		$output = '';

		if( !empty($atts['img_url']) ){
			$atts['img_url'] = '<div class="menu-card-item-image">
				<img src="'.wp_get_attachment_url( $atts['img_url'] ).'" alt="" />
			</div>';
		}
		if( !empty($atts['price']) ){
			$atts['price'] = '<span class="menu-card-item-price" style="color:'.$atts['price_color'].'">'.$atts['price'].'</span>';
		}
		$output = '<div class="' . esc_attr( $atts['class'] ) . ' agni-menu-item">
			'.$atts['img_url'].'
			<div class="menu-card-item-details">
				<h6 class="menu-card-item-title" style="color:'.$atts['title_color'].'">'.$atts['title'].$atts['price'].'</h6>
				'.wpb_js_remove_wpautop($content, true).'
			</div>
		</div>';
			
		return $output;
	}

	// agnislider
	public static function agni_agnislider( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_agnislider', $atts );
		extract( $atts );  
		
		$output = agni_slider( $atts['post_id'], true );
			
		return $output;
	}

	// agnislider
	public static function agni_block( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_block', $atts );
		extract( $atts );  
		
		$output = apply_filters('the_content', get_post_field('post_content', $atts['post_id']));
		$output = '<div class="agni-content-block">'.$output.'</div>';
		
		return $output;
	}
	
	//team
	public static function agni_team($atts=null, $content=null){
		$atts = vc_map_get_attributes( 'agni_team', $atts );
		extract( $atts );
		
		$output = agni_team( $atts );  
	
		return $output ;
	}
	
	//Clients   
	public static function agni_clients($atts=null, $content=null){
		$atts = vc_map_get_attributes( 'agni_clients', $atts );
		extract( $atts );

		$output = agni_clients( $atts );

		return $output ;
	}
	
	//Testimonials  
	public static function agni_testimonials($atts=null, $content=null){
		$atts = vc_map_get_attributes( 'agni_testimonials', $atts );
		extract( $atts );
			
		$output = agni_testimonials( $atts );
		
		return $output ;
	}
	
	// Post & portfolio post type
	public static function agni_posttypes( $atts = null, $content = null ) {
		$atts = vc_map_get_attributes( 'agni_posttypes', $atts );
		extract( $atts );  

		ob_start();
		
		if( $atts['posttype'] == 'portfolio' ){ 
			do_action( 'agni_portfolio_init', $atts, $shortcode = true );
		}
		elseif( $atts['posttype'] == 'post' ){  
			do_action( 'agni_posts_init', $atts, '', $shortcode = true ); 
		}
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		
		return $output;
	}

	// Woocommerce
	public static function agni_woo_products( $atts = null, $content = null ){
		$atts = vc_map_get_attributes( 'agni_woo_products', $atts );
		extract( $atts );  

		global $product_layout, $product_carousel, $product_shortcode;
		
		$product_layout = $atts['product_layout'];
		$product_shortcode = true;
		if( $atts['carousel'] == '1'){
			$product_carousel = 'carousel-products';
		}

		switch( $atts['product_type'] ){
			case 'all' :
			case 'toprated' :
				$meta_query = WC()->query->get_meta_query();
				$args = array(
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'posts_per_page'        => $atts['posts_per_page'],
					'product_cat'           => $atts['product_categories'],
					'orderby'               => $atts['order_by'],
					'order'                 => $atts['order'],
					'meta_query'            => $meta_query
				);

				break;
			case 'sale' :
				$product_on_sale_IDs = wc_get_product_ids_on_sale();
				$meta_query   = array();
				$meta_query[] = WC()->query->visibility_meta_query();
				$meta_query[] = WC()->query->stock_status_meta_query();
				$meta_query   = array_filter( $meta_query );
				$args = array(
					'posts_per_page'    => $atts['posts_per_page'],
					'post_status'       => 'publish',
					'post_type'         => 'product',
					'product_cat'       => $atts['product_categories'],
					'orderby'           => $atts['order_by'],
					'order'             => $atts['order'],
					'meta_query'        => $meta_query,
					'post__in'          => array_merge( array( 0 ), $product_on_sale_IDs )
				);
				break;
			case 'featured' :
				$args = array(
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'product_cat'           => $atts['product_categories'],
					'ignore_sticky_posts'   => 1,
					'posts_per_page'        => $atts['posts_per_page'],
					'orderby'               => $atts['order_by'],
					'order'                 => $atts['order'],
					'meta_query'            => array(
						array(
							'key'       => '_visibility',
							'value'     => array('catalog', 'visible'),
							'compare'   => 'IN'
						),
						array(
							'key'       => '_featured',
							'value'     => 'yes'
						)
					)
				);
				break;
			case 'best_selling' :
				$args = array(
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'product_cat'           => $atts['product_categories'],
					'posts_per_page'        => $atts['posts_per_page'],
					'orderby'               => $atts['order_by'],
					'order'                 => $atts['order'],
					'meta_key'              => 'total_sales',
					'orderby'               => 'meta_value_num',
					'meta_query'            => array(
						array(
							'key'       => '_visibility',
							'value'     => array( 'catalog', 'visible' ),
							'compare'   => 'IN'
						)
					)
				);
				break;
		}

		ob_start();

		if( $atts['product_type'] == 'toprated' ){
			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		}
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>
		
			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>


		<?php endif;

		if( $atts['product_type'] == 'toprated' ){
			remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
		}
		wp_reset_postdata();

		$output = ob_get_contents();
		ob_end_clean();

		$output = '<div class="woocommerce shortcode-products agni-products-'.$atts['product_type'].'">' . $output . '</div>';

		return $output;
			
	}

}
// Finally initialize code
new AgniShortcodesFunctions();

?>