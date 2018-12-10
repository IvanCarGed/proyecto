<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/*
 * Post format
 */
add_action( 'cmb2_init', 'agni_post_format_meta' );
function agni_post_format_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'post_format_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$quote_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'quote_post_options',
		'title'         => esc_html__( 'Quote Post Options', 'fortun' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$quote_post_option->add_field( array(
			'name' => esc_html__('Quote Text', 'fortun' ),
			'id' => $prefix.'quote_text',
			'type' => 'textarea_small'
	) );
	$quote_post_option->add_field( array(
			'name' => esc_html__('Quote author', 'fortun' ),
			'id' => $prefix.'quote_cite',
			'type' => 'text_small'
	) );
	
	$link_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'link_post_options',
		'title'         => esc_html__( 'Link Post Options', 'fortun' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$link_post_option->add_field( array( 
		'name'	=> esc_html__('Link', 'fortun' ), 
		'desc'	=> esc_html__('Type URL to display into the post', 'fortun' ), 
		'id'	=> $prefix.'link_url', 
		'type'	=> 'text_url',
	) );
	
	$audio_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'audio_post_options',
		'title'         => esc_html__( 'Audio Post Options', 'fortun' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	$audio_post_option->add_field( array( 
		'name'	=> esc_html__('Self Hosted Audio Link', 'fortun' ), 
		'id'	=> $prefix.'audio_url', 
		'type'	=> 'file'
	) );
	
	$video_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'video_post_options',
		'title'         => esc_html__( 'Video Post Options', 'fortun' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, 
	) );

	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Self Hosted Video Link', 'fortun' ), 
		'desc'	=> esc_html__('Fill one of any video source info!!..', 'fortun' ), 
		'id'	=> $prefix.'video_url', 
		'type'	=> 'file'
	) );
	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Video Poster', 'fortun' ), 
		'desc'	=> esc_html__('Only applicable for self hosted video', 'fortun' ), 
		'id'	=> $prefix.'video_poster', 
		'type'	=> 'file'
	) );
	$video_post_option->add_field( array( 
		'name'	=> esc_html__('Embed Link', 'fortun' ), 
		'desc'	=> esc_html__('enter the youtube, vimeo or any video embed link ', 'fortun' ), 
		'id'	=> $prefix.'video_embed_url', 
		'type'	=> 'textarea_small',
		'sanitization_cb' => false
	) );
	
	$gallery_post_option = new_cmb2_box( array(
		'id'            => $prefix . 'gallery_post_options',
		'title'         => esc_html__( 'Gallery Post Options', 'fortun' ),
		'object_types'  => array( 'post' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
		 
	) );

	$gallery_post_option->add_field( array( 
		'name'	=> esc_html__('Choose Images ', 'fortun' ), 
		'id'	=> $prefix . 'gallery_image', 
		'type'	=> 'file_list'			
	) );
}

/*
 * Page Options
 */
add_action( 'cmb2_init', 'agni_page_meta' );

function agni_page_meta() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'page_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$page_option = new_cmb2_box( array(
		'id'            => $prefix . 'page_options',
		'title'         => esc_html__( 'Page Options', 'fortun' ),
		'object_types'  => array( 'page', 'portfolio', 'post', 'product' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

    $page_option->add_field( array(
		'name' => esc_html__( 'Page Layout', 'fortun' ),
		'desc' => esc_html__('Inherit will use from the global(Fortun -> Page options) settings.  ', 'fortun' ),
		'id' => $prefix . 'layout',
		'type'	=> 'select',
		'options' => array( 
			'' 					=> esc_html__('Inherit', 'fortun' ), 
            'container'			=> esc_html__('Container', 'fortun'),
            'container-fluid'	=> esc_html__('Fullwidth', 'fortun'),
		),
        'default'	=> '',
		'before_row' => '<h3>Layout Options</h3>'
	) );

	$page_option->add_field( array(
        'name'             => esc_html__( 'Sidebar', 'fortun' ),
		'desc' 			   => esc_html__('This will not applicable for portfolio pages. Sidebar is diabled for portfolio.', 'fortun' ),
        'id'               => $prefix . 'sidebar',
        'type'             => 'radio_inline',
        'options'          => array(
            ''		=> esc_html__('Inherit', 'fortun'),
            'no-sidebar'		=> esc_html__('No Sidebar', 'fortun'),
            'has-sidebar'	=> esc_html__('Right Sidebar', 'fortun'),
            'has-sidebar left'		=> esc_html__('Left Sidebar', 'fortun'),
        ),
        'default'			=> ''
    ) );

	$page_option->add_field( array(
		'name' => esc_html__('Agni Slider List', 'fortun' ),
		'desc' => esc_html__('Here, you can choose the slider which is created under Agni Slider Menu(left side).', 'fortun' ),
		'id' => $prefix.'agni_sliders',
		'type' => 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_slides'), true ),
		'before_row' => '<h3>Content Options</h3>'
	) );

	$page_option->add_field( array(
		'name'	=> esc_html__('Background Color', 'fortun' ), 
		'id'	=> $prefix.'bg_color', 
		'type'	=> 'colorpicker',
		'default' => '',
	) );
	$page_option->add_field( array(
		'name' => esc_html__( 'Dark Mode', 'fortun' ),
		'id' => $prefix . 'dark_mode',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Yes', 'fortun' ), 
			'0' => esc_html__('No', 'fortun' ), 
		),
        'default'	=> '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Remove Title', 'fortun' ),
		'desc' => esc_html__('Inherit will use from the global(option panel) settings. This option will not applicable for Shop single, portfolio template, latest post pages.', 'fortun' ),
		'id' => $prefix.'remove_title',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Yes', 'fortun' ), 
			'0' => esc_html__('No', 'fortun' ), 
		),
		'default' => '',
	) );
	$page_option->add_field( array(
		'name'	=> esc_html__('Title Alignment', 'fortun' ),
		'id'	=> $prefix . 'title_align',
		'type'	=> 'radio_inline',
		'options' => array( 
			''		=> esc_html__('Inherit', 'fortun'),
			'left' => esc_html__('Left', 'fortun' ), 
			'center' => esc_html__('Center', 'fortun' ), 
			'right' => esc_html__('Right', 'fortun' ), 
		),
		'default'  => ''
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Menu Choice', 'fortun' ),
		'id' => $prefix.'menu_choice',
		'type'	=> 'select',
		'options' => agni_registered_menus( true ),
		'default' => '',
		'before_row' => '<h3>Menu Options</h3>'
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Fullwidth', 'fortun' ),
		'id' => $prefix.'menu_fullwidth',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Yes', 'fortun' ), 
			'0' => esc_html__('No', 'fortun' ), 
		),
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Transparent Menu', 'fortun' ),
		'id' => $prefix.'transparent',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Yes', 'fortun' ), 
			'0' => esc_html__('No', 'fortun' ), 
		),
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Reverse Menu Skin', 'fortun' ),
		'desc' => esc_html__('It will reverse(interchange) your current header menu bar skin.', 'fortun' ),
		'id' => $prefix.'skin_reverse',
		'type'	=> 'checkbox',
		'default' => '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Footer Bar', 'fortun' ),
		'id' => $prefix.'footer_bar',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Enable', 'fortun' ), 
			'0' => esc_html__('Disable', 'fortun' ), 
		),
		'default' => '',
		'before_row' => '<h3>Footer Options</h3>'
	) );

	$page_option->add_field( array(
		'name' => esc_html__( 'Footer Bar Fullwidth', 'fortun' ),
		'id' => $prefix . 'footer_bar_fullwidth',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Yes', 'fortun' ), 
			'0' => esc_html__('No', 'fortun' ), 
		),
        'default'	=> '',
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Footer Bar Choice', 'fortun' ),
		'desc' => esc_html__('Choose footer bar. ', 'fortun' ),
		'id' => $prefix.'footer_bar_choice',
		'type'	=> 'select',
		'options' => array( 
			'1' => esc_html__('Content Block', 'fortun' ), 
			'0' => esc_html__('Widget Bar', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'footer_bar' ,
 			'data-conditional-value' => '1',
 		),
		'default' => '0',
	) );
	$page_option->add_field( array(
		'name' => esc_html__('Footer Bar Choice', 'fortun' ),
		'desc' => esc_html__('Choose footer bar. ', 'fortun' ),
		'id' => $prefix.'footer_bar_contentblock',
		'type'	=> 'select',
		'options' => agni_posttype_options( array( 'post_type' => 'agni_block'), true ),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'footer_bar_choice' ,
 			'data-conditional-value' => '1',
 		),
	) );

	$page_option->add_field( array(
		'name' => esc_html__('Footer Info.', 'fortun' ),
		'id' => $prefix.'footer_text',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Enable', 'fortun' ), 
			'0' => esc_html__('Disable', 'fortun' ), 
		),
		'default' => '',
	) );
}

/*
 * Portfolio
 */
add_action( 'cmb2_init', 'agni_portfolio_meta' );
function agni_portfolio_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'portfolio_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$portfolio_option = new_cmb2_box( array(
		'id'            => $prefix . 'portfolio_options',
		'title'         => esc_html__( 'Portfolio Options', 'fortun' ),
		'object_types'  => array( 'portfolio' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	// Portfolio Layout Settings
	$portfolio_option->add_field( array( 
        'name'             => esc_html__( 'Portfolio Layout', 'fortun' ),
        'id'               => $prefix . 'layout',
        'type'             => 'radio_image',
        'options'          => array(
            'plain'			=> esc_html__('Plain/Simple Portfolio', 'fortun'),
            'side'			=> esc_html__('Side Portfolio', 'fortun'),
            'full'			=> esc_html__('Fullwidth Portfolio', 'fortun'),
            'zigzag'		=> esc_html__('ZigZag Portfolio', 'fortun'),
        ),
        'images_path'      => AGNI_FRAMEWORK_URL . '/template/img/',
        'images'           => array(
            'plain'			=> 'portfolio-layout-0.jpg',
            'side'			=> 'portfolio-layout-1.jpg',
            'full'			=> 'portfolio-layout-2.jpg',
            'zigzag'		=> 'portfolio-layout-3.jpg',
        ),
        'default'			=> 'plain',
        'before_row' => '<h3>Portfolio Layout Options</h3>'
    ) );

    $portfolio_option->add_field( array(
		'name' => esc_html__('Media Position', 'fortun' ),
		'desc' => esc_html__('Choose the position of the media to display. Behind Content option will display the content at right side only when you trigger.', 'fortun' ),
		'id' => $prefix.'media_position',
		'type'	=> 'select',
		'options' => array( 
			'top' => esc_html__('At Top', 'fortun' ), 
			'bottom' => esc_html__('At Bottom', 'fortun' ), 
			'behind' => esc_html__('Behind Content', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => json_encode(array('full', 'zigzag')),
 		),
		'default' => 'top',
	) );

	$portfolio_option->add_field( array(
		'name' => esc_html__('Columns Count', 'fortun' ),
		'desc'	=> esc_html__('No. of Columns for Media. Note: Total column count should be 12. ', 'fortun' ), 
		'id' => $prefix.'media_side_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'fortun' ), 
			'3' => esc_html__('3 Columns', 'fortun' ), 
			'4' => esc_html__('4 Columns', 'fortun' ), 
			'5' => esc_html__('5 Columns', 'fortun' ),
			'6' => esc_html__('6 Columns', 'fortun' ), 
			'7' => esc_html__('7 Columns', 'fortun' ), 
			'8' => esc_html__('8 Columns', 'fortun' ), 
			'9' => esc_html__('9 Columns', 'fortun' ), 
			'10' => esc_html__('10 Columns', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$portfolio_option->add_field( array(
		'name' => esc_html__('Media Columns Count', 'fortun' ),
		'desc'	=> esc_html__('No. of Columns for Content.', 'fortun' ), 
		'id' => $prefix.'content_side_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'fortun' ), 
			'3' => esc_html__('3 Columns', 'fortun' ), 
			'4' => esc_html__('4 Columns', 'fortun' ), 
			'5' => esc_html__('5 Columns', 'fortun' ),
			'6' => esc_html__('6 Columns', 'fortun' ), 
			'7' => esc_html__('7 Columns', 'fortun' ), 
			'8' => esc_html__('8 Columns', 'fortun' ), 
			'9' => esc_html__('9 Columns', 'fortun' ), 
			'10' => esc_html__('10 Columns', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
 		'show_names' => false,
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'after_row' => '</div>'
	) );
	$portfolio_option->add_field( array(
		'name' => esc_html__('Alignment', 'fortun' ),
		'desc'	=> esc_html__('.', 'fortun' ), 
		'id' => $prefix.'side_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'mc' => esc_html__('Media + Content', 'fortun' ), 
			'cm' => esc_html__('Content + Media', 'fortun' )
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
 		'default' => 'mc'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Content Sticky', 'fortun' ),
		'id'	=> $prefix.'side_content_sticky',
		'type'	=> 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'side',
 		),
	) );

	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Media Gap(Gutter)', 'fortun' ),
		'desc'	=> esc_html__('Enable to show the gutter between each media', 'fortun' ), 
		'id'	=> $prefix.'media_gutter',
		'type'	=> 'radio_inline',
		'options' => array( 
			'yes' => esc_html__('Yes', 'fortun' ), 
			'no' => esc_html__('No', 'fortun' )
		),
 		'default' => 'yes'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Gutter Value', 'fortun' ), 
		'desc'	=> esc_html__('Gap between each media item. Enter values in px. Don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix.'media_gutter_value', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'media_gutter' ,
 			'data-conditional-value' => 'yes',
 		),
		'default' => '30',
	) );

	$portfolio_layout_repeatable = $portfolio_option->add_field( array(
		'id'          => $prefix . 'layout_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Media {#}', 'fortun' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Media', 'fortun' ),
			'remove_button' => esc_html__( 'Remove Media', 'fortun' ),
			'sortable'      => true, // beta
		)
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Columns Count', 'fortun' ),
		'desc'	=> esc_html__('No. of Columns for Media.', 'fortun' ), 
		'id' => 'media_zigzag_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'fortun' ), 
			'3' => esc_html__('3 Columns', 'fortun' ), 
			'4' => esc_html__('4 Columns', 'fortun' ), 
			'5' => esc_html__('5 Columns', 'fortun' ),
			'6' => esc_html__('6 Columns', 'fortun' ), 
			'7' => esc_html__('7 Columns', 'fortun' ), 
			'8' => esc_html__('8 Columns', 'fortun' ), 
			'9' => esc_html__('9 Columns', 'fortun' ), 
			'10' => esc_html__('10 Columns', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		//'name' => esc_html__('Media Columns Count', 'fortun' ),
		'desc'	=> esc_html__('No. of Columns for Description.', 'fortun' ), 
		'id' => 'description_zigzag_column_count',
		'type'	=> 'select',
		'options' => array( 
			'2' => esc_html__('2 Columns', 'fortun' ), 
			'3' => esc_html__('3 Columns', 'fortun' ), 
			'4' => esc_html__('4 Columns', 'fortun' ), 
			'5' => esc_html__('5 Columns', 'fortun' ),
			'6' => esc_html__('6 Columns', 'fortun' ), 
			'7' => esc_html__('7 Columns', 'fortun' ), 
			'8' => esc_html__('8 Columns', 'fortun' ), 
			'9' => esc_html__('9 Columns', 'fortun' ), 
			'10' => esc_html__('10 Columns', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
 		'show_names' => false,
		'default' => '6',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'after_row' => '</div>'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Alignment', 'fortun' ),
		'id' => 'media_zigzag_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'md' => esc_html__('Media + Description', 'fortun' ), 
			'dm' => esc_html__('Description + Media', 'fortun' )
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
 		'default' => '1'
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Description', 'fortun' ),
		'desc'	=> esc_html__('It will display the description about this image/section at side.', 'fortun' ), 
		'id' => 'description_zigzag',
		'type' => 'textarea',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'layout' ,
 			'data-conditional-value' => 'zigzag',
 		),
	) );
	//Vertical align

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Media Type', 'fortun' ),
		'id' => 'media_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'image' => esc_html__('Image', 'fortun' ), 
			'gallery' => esc_html__('Gallery/Slider', 'fortun' ), 
			'beforeafter' => esc_html__('Before-After', 'fortun' ), 
			//'video' => esc_html__('Video', 'fortun' ), 
		),
		'default' => 'image',
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array( 
		'name'	=> esc_html__('Choose Image', 'fortun' ), 
		'id'	=> 'media_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => json_encode( array( 'image', 'beforeafter' ) ),
 		),
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name'	=> esc_html__('Choose Images ', 'fortun' ), 
		'id'	=> 'media_gallery', 
		'type'	=> 'file_list',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => 'gallery',
 		),	
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Show Image(s) Caption', 'fortun' ),
		'desc'	=> esc_html__('It will display the caption of the image(s) at the bottom.', 'fortun' ), 
		'id' => 'media_caption',
		'type' => 'checkbox',
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('On Click', 'fortun' ),
		'id' => 'media_onclick',
		'type'	=> 'select',
		'options' => array( 
			'1' => esc_html__('None', 'fortun' ), 
			'2' => esc_html__('Attachment Image', 'fortun' ), 
			'3' => esc_html__('Lightbox', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => json_encode( array( 'image', 'gallery') ),
 		),
		'default' => '1',
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Gallery Choice', 'fortun' ),
		'id' => 'gallery_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'gallery' => esc_html__('Grid Gallery', 'fortun' ), 
			'carousel' => esc_html__('Carousel', 'fortun' ), 
			'' => esc_html__('None', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => 'gallery',
 		),
		'default' => '',
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Grid Style', 'fortun' ),
		'id' => 'media_grid_layout',
		'type'	=> 'select',
		'options' => array( 
			'fitRows' => esc_html__('FitRows(Default)', 'fortun' ), 
			'masonry' => esc_html__('Masonry', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'gallery_choice' ) ),
 			'data-conditional-value' => 'gallery'
 		),
		'default' => 'fitRows'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Number of Images', 'fortun' ),
		'desc'	=> esc_html__('images per row.', 'fortun' ), 
		'id' => 'media_images_row',
		'type'	=> 'select',
		'options' => array( 
			'1' => esc_html__('1', 'fortun' ), 
			'2' => esc_html__('2', 'fortun' ), 
			'3' => esc_html__('3', 'fortun' ), 
			'4' => esc_html__('4', 'fortun' ), 
			'5' => esc_html__('5', 'fortun' ),
			'6' => esc_html__('6', 'fortun' ),
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'gallery_choice' ) ),
 			'data-conditional-value' => json_encode( array('gallery', 'carousel') )
 		),
		'default' => '3'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Carousel Holder', 'fortun' ),
		'id' => 'media_carousel_type',
		'type'	=> 'select',
		'options' => array( 
			'img-carousel' => esc_html__('Img tag', 'fortun' ), 
			'bg-carousel' => esc_html__('Background Image', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'gallery_choice' ) ),
 			'data-conditional-value' => 'carousel'
 		),
		'default' => 'img-carousel'
	) );
	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array( 
		'name'	=> esc_html__('Carousel Height', 'fortun' ), 
		'desc' => esc_html__( 'You can use px, em, %, etc. or enter just number and it will use pixels. Tip. for 100% Viewport height use "100vh"', 'fortun' ),
		'id'	=> 'media_carousel_height', 
		'type'	=> 'text',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_carousel_type' ) ),
 			'data-conditional-value' => 'bg-carousel'
 		),
		'default' => '500'
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array( 
		'name'	=> esc_html__('Choose After Image', 'fortun' ), 
		'id'	=> 'media_image_2', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_type' ) ),
 			'data-conditional-value' => 'beforeafter',
 		),
	) );

	$portfolio_option->add_group_field( $portfolio_layout_repeatable, array(
		'name' => esc_html__('Show After Image Caption', 'fortun' ),
		'desc'	=> esc_html__('It will display the caption of the image(s) at the bottom.', 'fortun' ), 
		'id' => 'media_caption_2',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $portfolio_layout_repeatable, 'media_image_2' ) ),
 		),
	) );

	// Portfolio Additional Settings
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Title', 'fortun' ), 
		'id'	=> $prefix.'project_title', 
		'type'	=> 'text',
		'before_row' => '<h3>Portfolio Additional Settings</h3>'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Details', 'fortun' ), 
		'id'	=> $prefix.'project_detail', 
		'type'	=> 'text_small',
		'attributes' => array(
			'placeholder' => 'Date : 27 Oct 2016'
		),
		'repeatable' => true
	) );

	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Link Text', 'fortun' ), 
		'desc'	=> esc_html__('value for the project link button.', 'fortun' ), 
		'id'	=> $prefix.'project_link', 
		'type'	=> 'text_small',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Project Link URL', 'fortun' ), 
		'desc'	=> esc_html__('url for the project link button.', 'fortun' ), 
		'id'	=> $prefix.'project_link_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'project_link' ,
 		),
	) );
	$portfolio_option->add_field( array(
		'name' => esc_html__('Addiitonal Details Alignment', 'fortun' ),
		'id' => $prefix.'additional_details_align',
		'type'	=> 'select',
		'options' => array( 
			'left' => esc_html__('Left', 'fortun' ), 
			'center' => esc_html__('Center', 'fortun' ), 
			'right' => esc_html__('Right', 'fortun' ), 
		),
		'default' => 'left',
	) );

	// Portfolio Thumbnail Options
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Custom Link', 'fortun' ), 
		'desc'	=> esc_html__('This custom link will replace the actual portfolio single page link.', 'fortun' ), 
		'id'	=> $prefix.'thumbnail_custom_link', 
		'type'	=> 'text_url',
		'before_row' => '<h3>Portfolio Thumbnail Settings</h3>'
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Thumbnail Width', 'fortun' ),
		'desc'	=> esc_html__('It will be ignored, if you\'re using carousels.', 'fortun'),
		'id'	=> $prefix.'thumbnail_width',
		'type'	=> 'radio_inline',
		'options' => array( 
			'width1x' => esc_html__('1x', 'fortun' ), 
			//'width1_5x' => esc_html__('1.5x', 'fortun' ), 
			'width2x' => esc_html__('2x', 'fortun' ), 
			'width3x' => esc_html__('3x', 'fortun' ), 
		),
		'default' => 'width1x',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Thumbnail Height', 'fortun' ),
		'desc'	=> esc_html__('It will be ignored, If you\'re using carousels or If you disabled the Portfolio Thumbnails Hard Crop at Fortun/Portfolio Settings & Shortcode elements.', 'fortun'),
		'id'	=> $prefix.'thumbnail_height',
		'type'	=> 'radio_inline',
		'options' => array( 
			'height1x' => esc_html__('1x', 'fortun' ), 
			//'height1_5x' => esc_html__('1.5x', 'fortun' ), 
			'height2x' => esc_html__('2x', 'fortun' ), 
			'height3x' => esc_html__('3x', 'fortun' ), 
		),
		'default' => 'height1x',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Portfolio Thumbnail Hover Style', 'fortun' ),
		'id'	=> $prefix.'thumbnail_hover_style',
		//'type'	=> 'radio_image',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('Inherit', 'fortun' ), 
			'1' => esc_html__('Style 1', 'fortun' ), 
			'2' => esc_html__('Style 2', 'fortun' ), 
			'3' => esc_html__('Style 3', 'fortun' ), 
			'4' => esc_html__('Style 4', 'fortun' ), 
			'5' => esc_html__('Style 5', 'fortun' ), 
			'6' => esc_html__('Style 6', 'fortun' ), 
			'7' => esc_html__('Style 7', 'fortun' )
		),
		'default' => '',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Hover Background Color', 'fortun' ), 
		'id'	=> $prefix.'thumbnail_hover_bg_color', 
		'type'	=> 'rgba_colorpicker',
 		'default' => ''
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Hover Content Color', 'fortun' ), 
		'id'	=> $prefix.'thumbnail_hover_color', 
		'type'	=> 'colorpicker',
	) );
	$portfolio_option->add_field( array( 
		'name'	=> esc_html__('Keep Hovered', 'fortun' ),
		'id'	=> $prefix.'thumbnail_native_hover',
		'type'	=> 'checkbox',
	) );
}

add_action( 'cmb2_init', 'agni_product_thumbnail_meta' );
function agni_product_thumbnail_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'product_thumbnail_';

	$product_option = new_cmb2_box( array(
		'id'            => $prefix . 'product_options',
		'title'         => esc_html__( 'Product Additional Image', 'fortun' ),
		'object_types'  => array( 'product' ), // Post type
		'context'       => 'side',
		'priority'      => 'low',
		'show_names'    => true, // Show field names on the left
	) );	
	
	$product_option->add_field( array(
		'name'	=> esc_html__('Additional featured Image', 'fortun' ), 
		'desc' => esc_html__('This image will be shown when you hover the product thumbnail.', 'fortun' ),
		'id'	=> $prefix.'features_image', 
		'type'	=> 'file',
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	    ),
	    'text'    => array(
	        'add_upload_file_text' => 'Add Featured Image' // Change upload button text. Default: "Add or Upload File"
	    ),
		'show_names'    => false,
	) );
}

/**
 * Page Header Options
 */
add_action( 'cmb2_init', 'agni_page_header_meta' );
function agni_page_header_meta() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix = 'page_header_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$page_header_option = new_cmb2_box( array(
		'id'            => $prefix . 'page_header_options',
		'title'         => esc_html__( 'Page Header Options', 'fortun' ),
		'object_types'  => array( 'page', 'post', 'portfolio', 'product', 'term' ), // Post type
		'taxonomies'       => array( 'category', 'post_tag', 'types', 'product_cat' ), // Tells CMB2 which taxonomies should have these fields
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Choice', 'fortun' ),
		'id'	=> $prefix.'bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'fortun' ), 
			'bg_image' => esc_html__('BG Image', 'fortun' ), 
			'bg_video' => esc_html__('BG Video', 'fortun' ), 
			'bg_featured' => esc_html__('BG Featured Image', 'fortun' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Background Color', 'fortun' ), 
		'id'	=> $prefix.'bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Background Image', 'fortun' ), 
		'id'	=> $prefix.'bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Position', 'fortun' ),
		'id'	=> $prefix.'bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'fortun' ), 
			'left center' => esc_html__('left center', 'fortun' ), 
			'left bottom' => esc_html__('left bottom', 'fortun' ), 
			'right top' => esc_html__('right top', 'fortun' ), 
			'right center' => esc_html__('right center', 'fortun' ), 
			'right bottom' => esc_html__('right bottom', 'fortun' ), 
			'center top' => esc_html__('center top', 'fortun' ), 
			'center center' => esc_html__('center center', 'fortun' ), 
			'center bottom' => esc_html__('center bottom', 'fortun' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_image', 'bg_featured' ) ),
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Repeat', 'fortun' ),
		'id'	=> $prefix.'bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'fortun' ), 
			'no-repeat' => esc_html__('no-repeat', 'fortun' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_image', 'bg_featured' ) ),
 		)
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Background Size', 'fortun' ),
		'id'	=> $prefix.'bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'fortun' ), 
			'auto' => esc_html__('auto', 'fortun' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_image', 'bg_featured' ) ),
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Background Video Source', 'fortun' ),
		'id'	=> $prefix.'bg_video_src', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'' => esc_html__('No Source', 'fortun' ), 
			'1' => esc_html__('YouTube', 'fortun' ), 
			'2' => esc_html__('Selfhosted/Vimeo', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => 'bg_video',
 		)
	) );
	$page_header_option->add_field( array(  
		'name'	=> esc_html__('Video URL', 'fortun' ), 
		'desc'	=> esc_html__('video url only from youtube!', 'fortun' ), 
		'id'	=> $prefix.'bg_video_src_yt', 
		'type'	=> 'text_url',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Fallback image for mobile & tablets', 'fortun' ), 
		'id'	=> $prefix.'bg_video_src_yt_fallback', 
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'bg_video_src_yt' ,
		)
	) );
	$page_header_option->add_field( array(  
		'name'	=> esc_html__('Video URL', 'fortun' ), 
		'desc'	=> esc_html__('Choose the media from your local server', 'fortun' ), 
		'id'	=> $prefix.'bg_video_src_sh',
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '2',
		)
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Poster URL', 'fortun' ), 
		'desc'	=> esc_html__('This poster will be displayed before video get started', 'fortun' ),
		'id'	=> $prefix.'bg_video_src_sh_poster', 
		'type'	=> 'file',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'bg_video_src_sh' ,
		)
	) );

	$page_header_option->add_field( array( 
		'name' => esc_html__('Autoplay', 'fortun' ),
		'desc' => esc_html__('Enable to make video autoplay.', 'fortun' ),
		'id' => $prefix.'bg_video_autoplay',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$page_header_option->add_field( array( 
		'name' => esc_html__('Loop', 'fortun' ),
		'desc' => esc_html__('Enable to make video loop.', 'fortun' ),
		'id' => $prefix.'bg_video_loop',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$page_header_option->add_field( array( 
		'name' => esc_html__('Muted', 'fortun' ),
		'desc' => esc_html__('Enable to make video quiet.', 'fortun' ),
		'id' => $prefix.'bg_video_muted',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Volumne Level', 'fortun' ), 
		'desc'	=> esc_html__('Enter your volume level. it will not applicable if video is muted.', 'fortun' ), 
		'id'	=> $prefix.'bg_video_volume', 
		'type'	=> 'text_small',
		'default' => '50',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '0',
			'max'  => '100',
			'step'  => '1',
			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
		),
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Video Quality', 'fortun' ),
		'desc'	=> esc_html__('choose your video quality by default.', 'fortun' ),
		'id'	=> $prefix.'bg_video_quality', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'hd720' => esc_html__('HD 720p', 'fortun' ), 
			'hd1080' => esc_html__('FullHD 1080p', 'fortun' ), 
		),
		'default' => 'default',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Video Start at/Stop at', 'fortun' ), 
		'desc'	=> esc_html__('Video Start at value', 'fortun' ), 
		'id'	=> $prefix.'bg_video_start_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Video Stop At', 'fortun' ), 
		'desc'	=> esc_html__('Video Stop at value', 'fortun' ), 
		'id'	=> $prefix.'bg_video_stop_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Overlay Choice', 'fortun' ),
		'desc'	=> esc_html__('Gradient Map(Duotone) will not work on IE & Edge.', 'fortun' ), 
		'id'	=> $prefix.'bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'fortun' ), 
			'2' => esc_html__('Simple Gradient', 'fortun' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'fortun' ), 
			'4' => esc_html__('No Overlay', 'fortun' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image', 'bg_featured' ) ),
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Overlay Color', 'fortun' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'fortun' ), 
		'id'	=> $prefix.'bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '2',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/fortun/documentation/kb/gradient-map-duotone/">See Presets</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'fortun' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'fortun' ), 
		'id'	=> $prefix.'bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'fortun' ), 
		'id'	=> $prefix.'bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_overlay_choice',
 			'data-conditional-value' => '3',
 		)
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Particle Ground', 'fortun' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'fortun' ),
		'id' => $prefix . 'bg_particle_ground',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Particle Ground Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'fortun' ), 
		'id'	=> $prefix.'bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_particle_ground',
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Image', 'fortun' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
		'before_row' => '<h3>Content Options</h3>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Max Image width', 'fortun' ), 
		'desc'	=> esc_html__('Enter your image width, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix.'image_size', 
		'type'	=> 'text_small',
		'default' => '240',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1000',
			'step'  => '5',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'image',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Max Image width', 'fortun' ), 
		'desc'	=> esc_html__('Enter your image width for tablets', 'fortun' ), 
		'id'	=> $prefix.'image_size_tab', 
		'type'	=> 'text_small',
		'default' => '160',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '40',
			'max'  => '700',
			'step'  => '5',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'image',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Max Image width', 'fortun' ), 
		'desc'	=> esc_html__('Enter your image width for mobiles', 'fortun' ), 
		'id'	=> $prefix.'image_size_mobile', 
		'type'	=> 'text_small',
		'default' => '100',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '20',
			'max'  => '300',
			'step'  => '5',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'image',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Title Choice', 'fortun' ),
		'id'	=> $prefix.'title_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Custom Title', 'fortun' ), 
			'2' => esc_html__('Page Title', 'fortun' ), 
		),
		'default' => '1',
		/*'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image', 'bg_featured' ) ),
 		)*/
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Title', 'fortun' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'fortun' ),
		'id' => $prefix . 'title',
		'type' => 'text',
		'sanitization_cb' => false,
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'title_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Title Rotator', 'fortun' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'fortun' ),
		'id' => $prefix . 'title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title',
		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Choose Rotator Effect', 'fortun' ),
		'id'	=> $prefix . 'title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'fortun' ), 
			'scale letters' => esc_html__('Scale', 'fortun' ), 
			'zoom' => esc_html__('Zoom', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title_rotator',
		),
		'default'  => 'scale letters'
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Title Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => $prefix . 'title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title',
		),
		'default' => 'primary-typo',
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Title Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix . 'title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Title Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for title', 'fortun' ), 
		'id'	=> $prefix . 'title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'title',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
 		)
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Description', 'fortun' ),
		'id' => $prefix . 'desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Description Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => $prefix . 'desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'desc',
		),
		'default' => 'default-typo',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Description Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix . 'desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => $prefix .'desc',
 			//'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Description Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> $prefix . 'desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'desc',
 		)
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Divide Line', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'fortun' ),
		'id' => $prefix . 'line',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Divide Line Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> $prefix . 'line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'line',
 		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1', 'fortun' ), 
		'desc'	=> esc_html__('button 1 info', 'fortun' ), 
		'id'	=> $prefix . 'button1', 
		'type'	=> 'text_small'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Icon', 'fortun' ),
		'id'	=> $prefix . 'button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> $prefix . 'button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 1 Style', 'fortun' ),
		'id'	=> $prefix . 'button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Type', 'fortun' ),
		'id'	=> $prefix . 'button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button1',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 1 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> $prefix . 'button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 1 Target', 'fortun' ),
		'id'	=> $prefix . 'button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => $prefix . 'button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button1',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2', 'fortun' ), 
		'desc'	=> esc_html__('button 2 info', 'fortun' ), 
		'id'	=> $prefix . 'button2', 
		'type'	=> 'text_small'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Icon', 'fortun' ),
		'id'	=> $prefix . 'button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button2',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> $prefix . 'button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 2 Style', 'fortun' ),
		'id'	=> $prefix . 'button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Type', 'fortun' ),
		'id'	=> $prefix . 'button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => $prefix .'button2',
		)
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Button 2 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> $prefix . 'button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Button 2 Target', 'fortun' ),
		'id'	=> $prefix . 'button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$page_header_option->add_field( array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => $prefix . 'button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'button2',
 			//'data-conditional-value' => 'on',
 		),
	) );

	$page_header_option->add_field( array(
		'name' => esc_html__('Breadcrumb(Navigation)', 'fortun' ),
		'desc' => esc_html__('check this to show the navigation link at header', 'fortun' ),
		'id'	=> $prefix.'breadcrumb',
		'type'	=> 'checkbox',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Breadcrumb Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> $prefix . 'breadcrumb_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix .'breadcrumb',
 		)
	) );

	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'fortun' ),
		'id'	=> $prefix . 'arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'fortun' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'fortun' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'fortun' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'fortun' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'fortun' ), 
		),
		'default' => '',
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Bottom Arrow link', 'fortun' ), 
		'id'	=> $prefix . 'arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix .'arrowicon',
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Bottom Arrow Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'fortun' ), 
		'id'	=> $prefix . 'arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix .'arrowicon',
		)		
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Animation', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => $prefix . 'animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'fortun' ), 
			'fade-in' => esc_html__('fadeIn', 'fortun' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'fortun' ),
			'fade-in-up' => esc_html__('fadeInUp', 'fortun' ),
			'zoom-in' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => '',
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Text Alignment', 'fortun' ),
		'id'	=> $prefix . 'text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Left', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Right', 'fortun' ), 
		),
		'default'  => 'flex-start'
	) );
	
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Vertical Alignment', 'fortun' ),
		'id'	=> $prefix . 'vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Top', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Bottom', 'fortun' ), 
		),
		'default'  => 'center'
	) );
	$page_header_option->add_field( array(
		'name'	=> esc_html__('Padding Values', 'fortun' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> $prefix.'padding_top', 
		'type'	=> 'text_small',
		'default' => '0',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'fortun' ), 
		'desc'	=> esc_html__('Padding Right', 'fortun' ), 
		'id'	=> $prefix.'padding_right', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'desc'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'id'	=> $prefix.'padding_bottom', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$page_header_option->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'fortun' ), 
		'desc'	=> esc_html__('Padding Left', 'fortun' ), 
		'id'	=> $prefix.'padding_left', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$page_header_option->add_field( array(
		'name'	=> esc_html__('Page Header Choice', 'fortun' ),
		'id'	=> $prefix.'choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'fortun' ), 
			'2' => esc_html__('Custom Height', 'fortun' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height', 'fortun' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix.'height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height(Tablet devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Tablets', 'fortun' ), 
		'id'	=> $prefix.'height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Page Header Height(Mobile devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'fortun' ), 
		'id'	=> $prefix.'height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$page_header_option->add_field( array(
		'name' => esc_html__('Parallax', 'fortun' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'fortun' ),
		'id' => $prefix.'parallax',
		'type' => 'checkbox',
	) );
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$page_header_option->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );

}

add_action( 'cmb2_init', 'agni_slider_meta' );
function agni_slider_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'agni_slides_';
	
	$agni_slider_option = new_cmb2_box( array(
		'id'            => $prefix . 'agni_slider_option',
		'title'         => esc_html__( 'Agni Slider Options', 'fortun' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	$agni_slider_option->add_field( array( 
		'name'	=> esc_html__('Slider Choice', 'fortun' ), 
		'desc'	=> esc_html__('choose your slider, And fill the details below. ', 'fortun' ), 
		'id'	=> $prefix.'choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'slideshow' => esc_html__('Default(Slider/Carousel)', 'fortun' ), 					
			//'videobg' => esc_html__('Video BG', 'fortun' ),
			'textslider' => esc_html__('Static Background Image/Video(Text Slider)', 'fortun' ),
			'imageslider' => esc_html__('Static Text(Background Image Slider)', 'fortun' ),
		)
	) );	
	
	$slideshow_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'slideshow_options',
		'title'         => esc_html__( 'Slider/Carousel Options', 'fortun' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$slideshow_repeatable = $slideshow_slider_options->add_field( array(
		'id'          => $prefix . 'slideshow_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'fortun' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'fortun' ),
			'remove_button' => esc_html__( 'Remove Slide', 'fortun' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Choice', 'fortun' ),
		'id'	=> 'slideshow_bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'fortun' ), 
			'bg_image' => esc_html__('BG Image', 'fortun' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Background Color', 'fortun' ), 
		'id'	=> 'slideshow_bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_choice' ) ),
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Background Image', 'fortun' ), 
		'id'	=> 'slideshow_bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_choice' ) ),
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Position', 'fortun' ),
		'id'	=> 'slideshow_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'fortun' ), 
			'left center' => esc_html__('left center', 'fortun' ), 
			'left bottom' => esc_html__('left bottom', 'fortun' ), 
			'right top' => esc_html__('right top', 'fortun' ), 
			'right center' => esc_html__('right center', 'fortun' ), 
			'right bottom' => esc_html__('right bottom', 'fortun' ), 
			'center top' => esc_html__('center top', 'fortun' ), 
			'center center' => esc_html__('center center', 'fortun' ), 
			'center bottom' => esc_html__('center bottom', 'fortun' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_image' ) ),
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Repeat', 'fortun' ),
		'id'	=> 'slideshow_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'fortun' ), 
			'no-repeat' => esc_html__('no-repeat', 'fortun' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_image' ) ),
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Background Size', 'fortun' ),
		'id'	=> 'slideshow_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'fortun' ), 
			'auto' => esc_html__('auto', 'fortun' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_image' ) ),
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Choice', 'fortun' ),
		'id'	=> 'slideshow_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'fortun' ), 
			'2' => esc_html__('Simple Gradient', 'fortun' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'fortun' ), 
			'4' => esc_html__('No Overlay', 'fortun' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_choice' ) ),
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image' ) ),
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Color', 'fortun' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'fortun' ), 
		'id'	=> 'slideshow_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '1',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'slideshow_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '2',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/fortun/documentation/kb/gradient-map-duotone/">See Presets</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'slideshow_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'fortun' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'fortun' ), 
		'id'	=> 'slideshow_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'fortun' ), 
		'id'	=> 'slideshow_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name' => esc_html__('Particle Ground', 'fortun' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'fortun' ),
		'id' => 'slideshow_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(  
		'name'	=> esc_html__('Particle Ground Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'fortun' ), 
		'id'	=> 'slideshow_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_bg_particle_ground' ) ),
 		)
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        'name'  => esc_html__('Image', 'fortun' ), 
        'id'    => 'slideshow_image', 
        'type'  => 'file',
        'before_row' => '<h3>Content Options</h3>'
    ) );
    $slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width, don\'t include "px" string', 'fortun' ), 
        'id'    => 'slideshow_image_size', 
        'type'  => 'text_small',
        'default' => '240',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '100',
            'max'  => '1000',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_image' ) ),
        ),
        'row_classes' => 'agni-slide-col agni-slide-height-desktop',
        'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
    ) );
    $slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width for tablets', 'fortun' ), 
        'id'    => 'slideshow_image_size_tab', 
        'type'  => 'text_small',
        'default' => '160',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '40',
            'max'  => '700',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-tab',
    ) );
    $slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width for mobiles', 'fortun' ), 
        'id'    => 'slideshow_image_size_mobile', 
        'type'  => 'text_small',
        'default' => '100',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '20',
            'max'  => '300',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-mobile',
        'after_row' => '</div>'
    ) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title', 'fortun' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'fortun' ),
		'id' => 'slideshow_title',
		'type' => 'text',
		'sanitization_cb' => false,
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title Rotator', 'fortun' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'fortun' ),
		'id' => 'slideshow_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Choose Rotator Effect', 'fortun' ),
		'id'	=> 'slideshow_title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'fortun' ), 
			'scale letters' => esc_html__('Scale', 'fortun' ), 
			'zoom' => esc_html__('Zoom', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title_rotator' ) ),
		),
		'default'  => 'scale letters'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Title Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => 'slideshow_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
		),
		'default' => 'primary-typo',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Title Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> 'slideshow_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Title Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for title', 'fortun' ), 
		'id'	=> 'slideshow_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Description', 'fortun' ),
		'id' => 'slideshow_desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Description Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => 'slideshow_desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
		),
		'default' => 'default-typo',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Description Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> 'slideshow_desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
 			//'data-conditional-id'    => 'agni_slides_slideshow_repeatable[{#}][slideshow_title]',
		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Description Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> 'slideshow_desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_desc' ) ),
 		)
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Divide Line', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'fortun' ),
		'id' => 'slideshow_line',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Divide Line Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> 'slideshow_line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_line' ) ),
 		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'fortun' ), 
		'desc'	=> esc_html__('button 1 info', 'fortun' ), 
		'id'	=> 'slideshow_button1', 
		'type'	=> 'text_small'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Icon', 'fortun' ),
		'id'	=> 'slideshow_button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> 'slideshow_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'fortun' ),
		'id'	=> 'slideshow_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Type', 'fortun' ),
		'id'	=> 'slideshow_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 1 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> 'slideshow_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'fortun' ),
		'id'	=> 'slideshow_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => 'slideshow_button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2', 'fortun' ), 
		'desc'	=> esc_html__('button 2 info', 'fortun' ), 
		'id'	=> 'slideshow_button2', 
		'type'	=> 'text_small'
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Icon', 'fortun' ),
		'id'	=> 'slideshow_button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> 'slideshow_button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 2 Style', 'fortun' ),
		'id'	=> 'slideshow_button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Type', 'fortun' ),
		'id'	=> 'slideshow_button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
		)
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Button 2 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> 'slideshow_button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Button 2 Target', 'fortun' ),
		'id'	=> 'slideshow_button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => 'slideshow_button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name' => esc_html__('Text Animation', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => 'slideshow_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'fortun' ), 
			'fade-in' => esc_html__('fadeIn', 'fortun' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'fortun' ),
			'fade-in-up' => esc_html__('fadeInUp', 'fortun' ),
			'zoom-in' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => '',
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'fortun' ),
		'id'	=> 'slideshow_arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'fortun' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'fortun' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'fortun' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'fortun' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'fortun' ), 
		),
		'default' => '',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow link', 'fortun' ), 
		'id'	=> 'slideshow_arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $slideshow_repeatable, 'slideshow_arrowicon' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'fortun' ), 
		'id'	=> 'slideshow_arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => json_encode( array( $slideshow_repeatable, 'slideshow_arrowicon' ) ),
		)		
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Text Alignment', 'fortun' ),
		'id'	=> 'slideshow_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Left', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Right', 'fortun' ), 
		),
		'default'  => 'flex-start'
	) );
	
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Vertical Alignment', 'fortun' ),
		'id'	=> 'slideshow_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Top', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Bottom', 'fortun' ), 
		),
		'default'  => 'center'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		'name'	=> esc_html__('Padding Values', 'fortun' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> 'slideshow_padding_top', 
		'type'	=> 'text_small',
		'default' => '0',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'fortun' ), 
		'desc'	=> esc_html__('Padding Right', 'fortun' ), 
		'id'	=> 'slideshow_padding_right', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
		
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'desc'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'id'	=> 'slideshow_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$slideshow_slider_options->add_group_field( $slideshow_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'fortun' ), 
		'desc'	=> esc_html__('Padding Left', 'fortun' ), 
		'id'	=> 'slideshow_padding_left', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'fortun' ),
		'id'	=> $prefix.'slideshow_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'fortun' ), 
			'2' => esc_html__('Custom Height', 'fortun' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'fortun' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix.'slideshow_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Tablets', 'fortun' ), 
		'id'	=> $prefix.'slideshow_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'fortun' ), 
		'id'	=> $prefix.'slideshow_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Carousel', 'fortun' ),
		'desc' => esc_html__('To use slider as a carousel enable this.', 'fortun' ),
		'id' => $prefix.'slideshow_carousel',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Carousel Items', 'fortun' ), 
		'desc'	=> esc_html__('Items per row', 'fortun' ), 
		'id'	=> $prefix.'slideshow_carousel_992', 
		'type'	=> 'text_small',
		'default' => '3',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '1',
			'max'  => '5',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Carousel Items(Tablets)', 'fortun' ), 
		'desc'	=> esc_html__('Items per row on Tablets', 'fortun' ), 
		'id'	=> $prefix.'slideshow_carousel_768', 
		'type'	=> 'text_small',
		'default' => '2',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '1',
			'max'  => '4',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Carousel Items(Mobile)', 'fortun' ), 
		'desc'	=> esc_html__('Items per row on Mobiles', 'fortun' ), 
		'id'	=> $prefix.'slideshow_carousel_0', 
		'type'	=> 'text_small',
		'default' => '1',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '1',
			'max'  => '3',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Margin(Gutter)', 'fortun' ),
		'desc' => esc_html__('Enter the margin amount between each item.', 'fortun' ),
		'id' => $prefix.'slideshow_carousel_margin',
		'type' => 'text_small',
		'default' => '0',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '0',
			'max'  => '45',
			'step'  => '1',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_carousel',
			'data-conditional-value' => 'on',
		),
	) );
	$slideshow_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'fortun' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'fortun' ),
		'id' => $prefix.'slideshow_parallax',
		'type' => 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'slideshow_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'slideshow_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'slideshow_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'fortun' ),
		'id'	=> $prefix.'slideshow_autoplay',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'fortun' ),
		'id'	=> $prefix.'slideshow_loop',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Duration & Speed', 'fortun' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'fortun' ), 
		'id'	=> $prefix.'slideshow_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100'
		),
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$slideshow_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Speed', 'fortun' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'fortun' ), 
		'id'	=> $prefix.'slideshow_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Animation In & Out', 'fortun' ),
		'id'	=> $prefix.'slideshow_animate_in',
		'type'	=> 'select',
		'options' => array( 
			'fadeIn' => esc_html__('fadeIn', 'fortun' ), 
			'fadeInDown' => esc_html__('fadeInDown', 'fortun' ),
			'fadeInRight' => esc_html__('fadeInRight', 'fortun' ),
			'fadeInLeft' => esc_html__('fadeInLeft', 'fortun' ),
			'fadeInUp' => esc_html__('fadeInUp', 'fortun' ),
			'flipInX' => esc_html__('flipInX', 'fortun' ),
			'slideInUp' => esc_html__('slideInUp', 'fortun' ),
			'slideInDown' => esc_html__('slideInDown', 'fortun' ),
			'slideInLeft' => esc_html__('slideInLeft', 'fortun' ),
			'slideInRight' => esc_html__('slideInRight', 'fortun' ),
			'zoomIn' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => 'slideInRight',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Animation Out', 'fortun' ),
		'id'	=> $prefix.'slideshow_animate_out',
		'type'	=> 'select',
		'options' => array( 
			'fadeOut' => esc_html__('fadeOut', 'fortun' ), 
			'fadeOutDown' => esc_html__('fadeOutDown', 'fortun' ),
			'fadeOutRight' => esc_html__('fadeOutRight', 'fortun' ),
			'fadeOutLeft' => esc_html__('fadeOutLeft', 'fortun' ),
			'fadeOutUp' => esc_html__('fadeOutUp', 'fortun' ),
			'flipOutX' => esc_html__('flipOutX', 'fortun' ),
			'slideOutUp' => esc_html__('slideOutUp', 'fortun' ),
			'slideOutDown' => esc_html__('slideOutDown', 'fortun' ),
			'slideOutLeft' => esc_html__('slideOutLeft', 'fortun' ),
			'slideOutRight' => esc_html__('slideOutRight', 'fortun' ),
			'zoomOut' => esc_html__('zoomOut', 'fortun' ),
		),
		'default' => 'slideOutLeft',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'fortun' ),
		'id'	=> $prefix.'slideshow_navigation',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'fortun' ),
		'id'	=> $prefix.'slideshow_pagination',
		'type'	=> 'checkbox',
	) );
	$slideshow_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'fortun' ),
		'id'	=> $prefix.'slideshow_mousedrag',
		'type'	=> 'checkbox',
	) );
	
	// Text Slider
	$textslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'textslider_options',
		'title'         => esc_html__( 'Text Slider Options', 'fortun' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$textslider_repeatable = $textslider_slider_options->add_field( array(
		'id'          => $prefix . 'textslider_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'fortun' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'fortun' ),
			'remove_button' => esc_html__( 'Remove Slide', 'fortun' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */

	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        'name'  => esc_html__('Image', 'fortun' ), 
        'id'    => 'textslider_image', 
        'type'  => 'file',
        'before_row' => '<h3>Content Options</h3>'
    ) );
    $textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width, don\'t include "px" string', 'fortun' ), 
        'id'    => 'textslider_image_size', 
        'type'  => 'text_small',
        'default' => '240',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '100',
            'max'  => '1000',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_image' ) ),
        ),
        'row_classes' => 'agni-slide-col agni-slide-height-desktop',
        'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
    ) );
    $textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width for tablets', 'fortun' ), 
        'id'    => 'textslider_image_size_tab', 
        'type'  => 'text_small',
        'default' => '160',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '40',
            'max'  => '700',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-tab',
    ) );
    $textslider_slider_options->add_group_field( $textslider_repeatable, array( 
        //'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width for mobiles', 'fortun' ), 
        'id'    => 'textslider_image_size_mobile', 
        'type'  => 'text_small',
        'default' => '100',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '20',
            'max'  => '300',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_image' ) ),
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-mobile',
        'after_row' => '</div>'
    ) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title', 'fortun' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'fortun' ),
		'id' => 'textslider_title',
		'type' => 'text',
		'sanitization_cb' => false,
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title Rotator', 'fortun' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'fortun' ),
		'id' => 'textslider_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Choose Rotator Effect', 'fortun' ),
		'id'	=> 'textslider_title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'fortun' ), 
			'scale letters' => esc_html__('Scale', 'fortun' ), 
			'zoom' => esc_html__('Zoom', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title_rotator' ) ),
		),
		'default'  => 'scale letters'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Title Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => 'textslider_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
		),
		'default' => 'primary-typo',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Title Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> 'textslider_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_textslider_repeatable[{#}][textslider_title]',
		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Title Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for title', 'fortun' ), 
		'id'	=> 'textslider_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_title' ) ),
 			//'data-conditional-id'    => 'agni_slides_textslider_repeatable[{#}][textslider_title]',
 		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Description', 'fortun' ),
		'id' => 'textslider_desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Description Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => 'textslider_desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
		),
		'default' => 'default-typo',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Description Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> 'textslider_desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
 			//'data-conditional-id'    => 'agni_slides_textslider_repeatable[{#}][textslider_title]',
		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Description Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> 'textslider_desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_desc' ) ),
 		)
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Divide Line', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'fortun' ),
		'id' => 'textslider_line',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Divide Line Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> 'textslider_line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_line' ) ),
 		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1', 'fortun' ), 
		'desc'	=> esc_html__('button 1 info', 'fortun' ), 
		'id'	=> 'textslider_button1', 
		'type'	=> 'text_small'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Icon', 'fortun' ),
		'id'	=> 'textslider_button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> 'textslider_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Style', 'fortun' ),
		'id'	=> 'textslider_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Type', 'fortun' ),
		'id'	=> 'textslider_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 1 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> 'textslider_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 1 Target', 'fortun' ),
		'id'	=> 'textslider_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => 'textslider_button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button1' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2', 'fortun' ), 
		'desc'	=> esc_html__('button 2 info', 'fortun' ), 
		'id'	=> 'textslider_button2', 
		'type'	=> 'text_small'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Icon', 'fortun' ),
		'id'	=> 'textslider_button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> 'textslider_button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Style', 'fortun' ),
		'id'	=> 'textslider_button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Type', 'fortun' ),
		'id'	=> 'textslider_button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
		)
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Button 2 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> 'textslider_button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Button 2 Target', 'fortun' ),
		'id'	=> 'textslider_button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => 'textslider_button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_button2' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name' => esc_html__('Text Animation', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => 'textslider_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'fortun' ), 
			'fade-in' => esc_html__('fadeIn', 'fortun' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'fortun' ),
			'fade-in-up' => esc_html__('fadeInUp', 'fortun' ),
			'zoom-in' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => '',
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'fortun' ),
		'id'	=> 'textslider_arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'fortun' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'fortun' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'fortun' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'fortun' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'fortun' ), 
		),
		'default' => '',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow link', 'fortun' ), 
		'id'	=> 'textslider_arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $textslider_repeatable, 'textslider_arrowicon' ) ),
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Bottom Arrow Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'fortun' ), 
		'id'	=> 'textslider_arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => json_encode( array( $textslider_repeatable, 'textslider_arrowicon' ) ),
		)		
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Text Alignment', 'fortun' ),
		'id'	=> 'textslider_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Left', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Right', 'fortun' ), 
		),
		'default'  => 'flex-start'
	) );
	
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Vertical Alignment', 'fortun' ),
		'id'	=> 'textslider_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Top', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Bottom', 'fortun' ), 
		),
		'default'  => 'center'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		'name'	=> esc_html__('Padding Values', 'fortun' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> 'textslider_padding_top', 
		'type'	=> 'text_small',
		'default' => '0',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Right', 'fortun' ), 
		'desc'	=> esc_html__('Padding Right', 'fortun' ), 
		'id'	=> 'textslider_padding_right', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'desc'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'id'	=> 'textslider_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$textslider_slider_options->add_group_field( $textslider_repeatable, array(
		//'name'	=> esc_html__('Padding Left', 'fortun' ), 
		'desc'	=> esc_html__('Padding Left', 'fortun' ), 
		'id'	=> 'textslider_padding_left', 
		'type'	=> 'text_small',
		'default' => '0',
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Choice', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'fortun' ), 
			'bg_image' => esc_html__('BG Image', 'fortun' ), 
			'bg_video' => esc_html__('BG Video', 'fortun' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Background Color', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Background Image', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Position', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'fortun' ), 
			'left center' => esc_html__('left center', 'fortun' ), 
			'left bottom' => esc_html__('left bottom', 'fortun' ), 
			'right top' => esc_html__('right top', 'fortun' ), 
			'right center' => esc_html__('right center', 'fortun' ), 
			'right bottom' => esc_html__('right bottom', 'fortun' ), 
			'center top' => esc_html__('center top', 'fortun' ), 
			'center center' => esc_html__('center center', 'fortun' ), 
			'center bottom' => esc_html__('center bottom', 'fortun' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'textslider_bg_image' ,
 		),
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Repeat', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'fortun' ), 
			'no-repeat' => esc_html__('no-repeat', 'fortun' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'textslider_bg_image' ,
 		),
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Background Size', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'fortun' ), 
			'auto' => esc_html__('auto', 'fortun' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'textslider_bg_image' ,
 		),
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Background Video Source', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_video_src', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'' => esc_html__('No Source', 'fortun' ), 
			'1' => esc_html__('YouTube', 'fortun' ), 
			'2' => esc_html__('Selfhosted/Vimeo', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => 'bg_video',
 		)
	) );
	$textslider_slider_options->add_field( array(  
		'name'	=> esc_html__('Video URL', 'fortun' ), 
		'desc'	=> esc_html__('video url only from youtube!', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_video_src_yt', 
		'type'	=> 'text_url',
		'attributes' => array(
			//'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Fallback image for mobile & tablets', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_video_src_yt_fallback', 
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'textslider_bg_video_src_yt' ,
		)
	) );
	$textslider_slider_options->add_field( array(  
		'name'	=> esc_html__('Video URL', 'fortun' ), 
		'desc'	=> esc_html__('Choose the media from your local server', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_video_src_sh',
		'type'	=> 'file',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '2',
		)
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Poster URL', 'fortun' ), 
		'desc'	=> esc_html__('This poster will be displayed before video get started', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_video_src_sh_poster', 
		'type'	=> 'file',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_bg_video_src_sh' ,
		)
	) );

	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Autoplay', 'fortun' ),
		'desc' => esc_html__('Enable to make video autoplay.', 'fortun' ),
		'id' => $prefix.'textslider_bg_video_autoplay',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Loop', 'fortun' ),
		'desc' => esc_html__('Enable to make video loop.', 'fortun' ),
		'id' => $prefix.'textslider_bg_video_loop',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Muted', 'fortun' ),
		'desc' => esc_html__('Enable to make video quiet.', 'fortun' ),
		'id' => $prefix.'textslider_bg_video_muted',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
 			'data-conditional-value' => json_encode(array('1', '2')),
 		)
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Volumne Level', 'fortun' ), 
		'desc'	=> esc_html__('Enter your volume level. it will not applicable if video is muted.', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_video_volume', 
		'type'	=> 'text_small',
		'default' => '50',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '0',
			'max'  => '100',
			'step'  => '1',
			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
		),
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Video Quality', 'fortun' ),
		'desc'	=> esc_html__('choose your video quality by default.', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_video_quality', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'hd720' => esc_html__('HD 720p', 'fortun' ), 
			'hd1080' => esc_html__('FullHD 1080p', 'fortun' ), 
		),
		'default' => 'default',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Video Start at/Stop at', 'fortun' ), 
		'desc'	=> esc_html__('Video Start at value', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_video_start_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Video Stop At', 'fortun' ), 
		'desc'	=> esc_html__('Video Stop at value', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_video_stop_at', 
		'type'	=> 'text_small',
		'default' => '0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'textslider_bg_video_src' ,
			'data-conditional-value' => '1',
 		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );

	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Overlay Choice', 'fortun' ),
		'desc'	=> esc_html__('Gradient Map will not work on video bg.', 'fortun' ),
		'id'	=> $prefix.'textslider_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'fortun' ), 
			'2' => esc_html__('Simple Gradient', 'fortun' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'fortun' ), 
			'4' => esc_html__('No Overlay', 'fortun' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_choice' ,
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image' ) ),
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Overlay Color', 'fortun' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '1',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'textslider_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '2',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/fortun/documentation/kb/gradient-map-duotone/">See Presets</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> $prefix.'textslider_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'fortun' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice' ,
 			'data-conditional-value' => '3',
 		)
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_overlay_choice',
 			'data-conditional-value' => '3',
 		)
	) );

	$textslider_slider_options->add_field( array( 
		'name' => esc_html__('Particle Ground', 'fortun' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'fortun' ),
		'id' => $prefix . 'textslider_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Particle Ground Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'fortun' ), 
		'id'	=> $prefix.'textslider_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'textslider_bg_particle_ground',
 		)
	) );

	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'fortun' ),
		'id'	=> $prefix.'textslider_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'fortun' ), 
			'2' => esc_html__('Custom Height', 'fortun' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'fortun' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix.'textslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Tablets', 'fortun' ), 
		'id'	=> $prefix.'textslider_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'fortun' ), 
		'id'	=> $prefix.'textslider_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'fortun' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'fortun' ),
		'id' => $prefix.'textslider_parallax',
		'type' => 'checkbox',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'textslider_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'textslider_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'textslider_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'fortun' ),
		'id'	=> $prefix.'textslider_autoplay',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'fortun' ),
		'id'	=> $prefix.'textslider_loop',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Duration', 'fortun' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'fortun' ), 
		'id'	=> $prefix.'textslider_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100'
		),
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$textslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Speed', 'fortun' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'fortun' ), 
		'id'	=> $prefix.'textslider_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Animation In', 'fortun' ),
		'id'	=> $prefix.'textslider_animate_in',
		'type'	=> 'select',
		'options' => array( 
			'fadeIn' => esc_html__('fadeIn', 'fortun' ), 
			'fadeInDown' => esc_html__('fadeInDown', 'fortun' ),
			'fadeInRight' => esc_html__('fadeInRight', 'fortun' ),
			'fadeInLeft' => esc_html__('fadeInLeft', 'fortun' ),
			'fadeInUp' => esc_html__('fadeInUp', 'fortun' ),
			'flipInX' => esc_html__('flipInX', 'fortun' ),
			'slideInUp' => esc_html__('slideInUp', 'fortun' ),
			'slideInDown' => esc_html__('slideInDown', 'fortun' ),
			'slideInLeft' => esc_html__('slideInLeft', 'fortun' ),
			'slideInRight' => esc_html__('slideInRight', 'fortun' ),
			'zoomIn' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => 'slideInRight',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Animation Out', 'fortun' ),
		'id'	=> $prefix.'textslider_animate_out',
		'type'	=> 'select',
		'options' => array( 
			'fadeOut' => esc_html__('fadeOut', 'fortun' ), 
			'fadeOutDown' => esc_html__('fadeOutDown', 'fortun' ),
			'fadeOutRight' => esc_html__('fadeOutRight', 'fortun' ),
			'fadeOutLeft' => esc_html__('fadeOutLeft', 'fortun' ),
			'fadeOutUp' => esc_html__('fadeOutUp', 'fortun' ),
			'flipOutX' => esc_html__('flipOutX', 'fortun' ),
			'slideOutUp' => esc_html__('slideOutUp', 'fortun' ),
			'slideOutDown' => esc_html__('slideOutDown', 'fortun' ),
			'slideOutLeft' => esc_html__('slideOutLeft', 'fortun' ),
			'slideOutRight' => esc_html__('slideOutRight', 'fortun' ),
			'zoomOut' => esc_html__('zoomOut', 'fortun' ),
		),
		'default' => 'slideOutLeft',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'fortun' ),
		'id'	=> $prefix.'textslider_navigation',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'fortun' ),
		'id'	=> $prefix.'textslider_pagination',
		'type'	=> 'checkbox',
	) );
	$textslider_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'fortun' ),
		'id'	=> $prefix.'textslider_mousedrag',
		'type'	=> 'checkbox',
	) );

	// Image Slider
	$imageslider_slider_options = new_cmb2_box( array(
		'id'            => $prefix . 'imageslider_options',
		'title'         => esc_html__( 'Background Slider Options', 'fortun' ),
		'object_types'  => array( 'agni_slides' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );
	
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$imageslider_repeatable = $imageslider_slider_options->add_field( array(
		'id'          => $prefix . 'imageslider_repeatable',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Slide {#}', 'fortun' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add another Slide', 'fortun' ),
			'remove_button' => esc_html__( 'Remove Slide', 'fortun' ),
			'sortable'      => true, // beta
		),
	) );

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Choice', 'fortun' ),
		'id'	=> 'imageslider_bg_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'bg_color' => esc_html__('BG Color', 'fortun' ), 
			'bg_image' => esc_html__('BG Image', 'fortun' ), 
		),
		'default'  => 'bg_image',
		'before_row' => '<h3>Background Options</h3>'
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('Background Color', 'fortun' ), 
		'id'	=> 'imageslider_bg_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_choice' ) ),
 			'data-conditional-value' => 'bg_color',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('Background Image', 'fortun' ), 
		'id'	=> 'imageslider_bg_image', 
		'type'	=> 'file',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_choice' ) ),
 			'data-conditional-value' => 'bg_image',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Position', 'fortun' ),
		'id'	=> 'imageslider_bg_image_position',
		'type'	=> 'select',
		'options' => array( 
			'left top' => esc_html__('left top', 'fortun' ), 
			'left center' => esc_html__('left center', 'fortun' ), 
			'left bottom' => esc_html__('left bottom', 'fortun' ), 
			'right top' => esc_html__('right top', 'fortun' ), 
			'right center' => esc_html__('right center', 'fortun' ), 
			'right bottom' => esc_html__('right bottom', 'fortun' ), 
			'center top' => esc_html__('center top', 'fortun' ), 
			'center center' => esc_html__('center center', 'fortun' ), 
			'center bottom' => esc_html__('center bottom', 'fortun' ), 
		),
		'default' => 'center center',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_image' ) ),
 		),
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Repeat', 'fortun' ),
		'id'	=> 'imageslider_bg_image_repeat',
		'type'	=> 'select',
		'options' => array( 
			'repeat' => esc_html__('repeat', 'fortun' ), 
			'no-repeat' => esc_html__('no-repeat', 'fortun' ), 
		),
		'default' => 'repeat',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_image' ) ),
 		),
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array(
		'name'	=> esc_html__('Background Size', 'fortun' ),
		'id'	=> 'imageslider_bg_image_size',
		'type'	=> 'select',
		'options' => array( 
			'cover' => esc_html__('cover', 'fortun' ), 
			'auto' => esc_html__('auto', 'fortun' ), 
		),
		'default' => 'cover',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_image' ) ),
 		),
	) );

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Choice', 'fortun' ),
		'id'	=> 'imageslider_bg_overlay_choice', 
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Simple', 'fortun' ), 
			'2' => esc_html__('Simple Gradient', 'fortun' ), 
			'3' => esc_html__('Gradient Map(Duotone)', 'fortun' ), 
			'4' => esc_html__('No Overlay', 'fortun' ), 
		),
		'default' => '4',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_choice' ) ),
 			'data-conditional-value' => json_encode( array( 'bg_video','bg_image' ) ),
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Overlay Color', 'fortun' ), 
		'desc'	=> esc_html__('This layer will be the overlay of the slider.', 'fortun' ), 
		'id'	=> 'imageslider_bg_overlay_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '1',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Overlay CSS', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Get/Type your Gradient CSS. Ref. <a target="_blank" href="http://uigradients.com/">http://uigradients.com/</a> <a target="_blank" href="http://hex2rgba.devoth.com/">HEX to RGBA converter for transparency</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'imageslider_bg_sg_overlay_css', 
		'type'	=> 'textarea_code',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '2',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 1', 'fortun' ), 
		'desc'	=> wp_kses( __( 'Choose the color for Shadows(Dark pixels). <a target="_blank" href="http://demo.agnidesigns.com/fortun/documentation/kb/gradient-map-duotone/">See Presets</a>', 'fortun' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
		'id'	=> 'imageslider_bg_gm_overlay_color1', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 2', 'fortun' ), 
		'desc'	=> esc_html__('Choose the mid-tone color. You can leave this empty for no mid-tone.', 'fortun' ), 
		'id'	=> 'imageslider_bg_gm_overlay_color2', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('BG Gradient Map(Duotone) Overlay Color 3', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for Highlights(White pixels).', 'fortun' ), 
		'id'	=> 'imageslider_bg_gm_overlay_color3', 
		'type'	=> 'colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_overlay_choice' ) ),
 			'data-conditional-value' => '3',
 		)
	) );

	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name' => esc_html__('Particle Ground', 'fortun' ),
		'desc' => esc_html__('It will enable the particles for the background.', 'fortun' ),
		'id' => 'imageslider_bg_particle_ground',
		'type' => 'checkbox',
	) );
	$imageslider_slider_options->add_group_field( $imageslider_repeatable, array( 
		'name'	=> esc_html__('Particle Ground Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color and transparency for the particle ground.', 'fortun' ), 
		'id'	=> 'imageslider_bg_particle_ground_color', 
		'type'	=> 'rgba_colorpicker',
		'default' => '',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => json_encode( array( $imageslider_repeatable, 'imageslider_bg_particle_ground' ) ),
 		)
	) );

	$imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Image', 'fortun' ), 
        'id'    => $prefix.'imageslider_image', 
        'type'  => 'file',
        'before_row' => '<h3>Content Options</h3>'
    ) );
    $imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width, don\'t include "px" string', 'fortun' ), 
        'id'    => $prefix.'imageslider_image_size', 
        'type'  => 'text_small',
        'default' => '240',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '100',
            'max'  => '1000',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => $prefix .'imageslider_image',
            //'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
        ),
        'row_classes' => 'agni-slide-col agni-slide-height-desktop',
        'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
    ) );
    $imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width for tablets', 'fortun' ), 
        'id'    => $prefix.'imageslider_image_size_tab', 
        'type'  => 'text_small',
        'default' => '160',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '40',
            'max'  => '700',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => $prefix .'imageslider_image',
            //'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-tab',
    ) );
    $imageslider_slider_options->add_field( array( 
        'name'  => esc_html__('Max Image width', 'fortun' ), 
        'desc'  => esc_html__('Enter your image width for mobiles', 'fortun' ), 
        'id'    => $prefix.'imageslider_image_size_mobile', 
        'type'  => 'text_small',
        'default' => '100',
        'attributes' => array(
            'type'  => 'number',
            'min'  => '20',
            'max'  => '300',
            'step'  => '5',
            //'required' => true,
            'data-conditional-id'    => $prefix .'imageslider_image',
            //'data-conditional-id'    => 'agni_slides_repeatable[{#}][title]',
        ),
        'show_names' => false,
        'row_classes' => 'agni-slide-col agni-slide-height-mobile',
        'after_row' => '</div>'
    ) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title', 'fortun' ),
		'desc' => esc_html__('To use a text effect. Add the texts with delimiter "|" inside <span> tag. For ex. Hello, <span>This is|Sample|Text</span>', 'fortun' ),
		'id' => $prefix . 'imageslider_title',
		'type' => 'text',
		'sanitization_cb' => false,
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title Rotator', 'fortun' ),
		'desc' => esc_html__('Check this for Title rotator. it enables the text effects to the title.', 'fortun' ),
		'id' => $prefix . 'imageslider_title_rotator',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'imageslider_title',
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Choose Rotator Effect', 'fortun' ),
		'id'	=> $prefix . 'imageslider_title_rotator_choice',
		'type'	=> 'select',
		'options' => array( 
			'type letters' => esc_html__('Type', 'fortun' ), 
			'scale letters' => esc_html__('Scale', 'fortun' ), 
			'zoom' => esc_html__('Zoom', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix .'imageslider_title_rotator',
		),
		'default'  => 'scale letters'
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Title Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Title which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => $prefix . 'imageslider_title_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
		),
		'default' => 'primary-typo',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_title_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '30',
			'max'  => '200',
			'step'  => '1',
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Title Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for title', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_title_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_title',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
 		)
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Description', 'fortun' ),
		'id' => $prefix . 'imageslider_desc',
		'type' => 'textarea_small',
		'sanitization_cb' => false,
		'attributes'  => array(
	        'placeholder' => 'A small amount of text',
	        'rows'        => 2,
	    ),
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Description Font', 'fortun' ),
		'desc' => esc_html__('It will apply the font to the Description which you choose at "Fortun/Theme Options/General Settings/Typography".', 'fortun' ),
		'id' => $prefix . 'imageslider_desc_font',
		'type' => 'select',
		'options' => array( 
			'primary-typo' => esc_html__('Primary Font', 'fortun' ), 
			'default-typo' => esc_html__('Default Font', 'fortun' ), 
			'additional-typo' => esc_html__('Additional Font', 'fortun' ), 
			'special-typo' => esc_html__('Special Font', 'fortun' ), 
		),
		'attributes' => array(
 			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_desc',
		),
		'default' => 'default-typo',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Description Font Size', 'fortun' ), 
		'desc'	=> esc_html__('Enter your title font size, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_desc_size', 
		'type'	=> 'text_small',
		'default' => '',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '15',
			'max'  => '60',
			'step'  => '1',
			//'required' => true,
 			'data-conditional-id'    => $prefix . 'imageslider_desc',
 			//'data-conditional-id'    => 'agni_slides_imageslider_repeatable[{#}][imageslider_title]',
		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Description Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_desc_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'imageslider_desc',
 		)
	) );

	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Divide Line', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInUp animation.', 'fortun' ),
		'id' => $prefix . 'imageslider_line',
		'type' => 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Divide Line Color ', 'fortun' ), 
		'desc'	=> esc_html__('choose the description color', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_line_color', 
		'type'	=> 'colorpicker',
		'default' => '#f0f0f0',
		'attributes' => array(
 			'data-conditional-id'    => $prefix . 'imageslider_line',
 		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1', 'fortun' ), 
		'desc'	=> esc_html__('button 1 info', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_button1', 
		'type'	=> 'text_small'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Icon', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button1_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button1',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_button1_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Style', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button1_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Type', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button1_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button1',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 1 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_button1_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 1 Target', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button1_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Button 1 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => $prefix . 'imageslider_button1_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button1',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2', 'fortun' ), 
		'desc'	=> esc_html__('button 2 info', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_button2', 
		'type'	=> 'text_small'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Icon', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button2_icon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'fa fa-play' => esc_html__('Play', 'fortun' ), 
			'fa fa-download' => esc_html__('Download', 'fortun' ), 
			'fa fa-mobile' => esc_html__('Mobile', 'fortun' ), 
			'fa fa-heart' => esc_html__('Heart', 'fortun' ), 
			'fa fa-diamond' => esc_html__('Diamond', 'fortun' ), 
		),
		'default' => '',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button2',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 URL', 'fortun' ), 
		'desc'	=> esc_html__('button href', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_button2_url', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		)
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Style', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button2_style',
		'type'	=> 'select',
		'options' => array( 
			'default' => esc_html__('Default', 'fortun' ), 
			'primary' => esc_html__('Primary', 'fortun' ), 
			'accent' => esc_html__('Accent', 'fortun' ), 
			'white' => esc_html__('White', 'fortun' ), 
		),
		'default' => 'white',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Type', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button2_type',
		'type'	=> 'radio_inline',
		'options' => array( 
			'btn-normal' => esc_html__('background', 'fortun' ), 
			'btn-alt' => esc_html__('Bordered', 'fortun' ), 
			'btn-plain' => esc_html__('Plain', 'fortun' ), 
		),
		'default' => 'btn-alt',
		'attributes' => array(
			'data-conditional-id' => $prefix . 'imageslider_button2',
		)
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Button 2 Radius', 'fortun' ), 
		'desc'	=> esc_html__('You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_button2_radius', 
		'type'	=> 'text_small',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Button 2 Target', 'fortun' ),
		'id'	=> $prefix . 'imageslider_button2_target',
		'type'	=> 'select',
		'options' => array( 
			'_self' => esc_html__('Same Window', 'fortun' ), 
			'_blank' => esc_html__('New Window', 'fortun' ), 
		),
		'default' => '_self',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );	
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Button 2 has Lightbox Video?', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => $prefix . 'imageslider_button2_lightbox',
		'type' => 'checkbox',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_button2',
 			//'data-conditional-value' => 'on',
 		),
	) );

	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Text Animation', 'fortun' ),
		'desc' => esc_html__('Checking this for FadeInDown animation.', 'fortun' ),
		'id' => $prefix . 'imageslider_animation',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No Animation', 'fortun' ), 
			'fade-in' => esc_html__('fadeIn', 'fortun' ), 
			'fade-in-down' => esc_html__('fadeInDown', 'fortun' ),
			'fade-in-up' => esc_html__('fadeInUp', 'fortun' ),
			'zoom-in' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => '',
	) );

	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Bottom Arrow Icon', 'fortun' ),
		'id'	=> $prefix . 'imageslider_arrowicon',
		'type'	=> 'select',
		'options' => array( 
			'' => esc_html__('No icon', 'fortun' ), 
			'pe-7s-angle-down' => esc_html__('Angle Down', 'fortun' ), 
			'pe-7s-angle-down-circle' => esc_html__('Angle Down Circled', 'fortun' ), 
			'ion-ios-arrow-thin-down' => esc_html__('Arrow Down', 'fortun' ), 
			'pe-7s-bottom-arrow' => esc_html__('Arrow Down Circled', 'fortun' ), 
			'pe-7s-mouse' => esc_html__('Mouse', 'fortun' ), 
		),
		'default' => '',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Bottom Arrow link', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_arrowlink', 
		'type'	=> 'text_url',
		'attributes' => array(
 			//'required' => true, // Will be required only if visible.
 			'data-conditional-id'    => $prefix . 'imageslider_arrowicon',
 			//'data-conditional-value' => 'on',
 		),
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Bottom Arrow Color', 'fortun' ), 
		'desc'	=> esc_html__('Choose the color for the bottom arrow', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_arrowicon_color', 
		'type'	=> 'colorpicker',
		'attributes' => array(
			//'required' => true, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_arrowicon',
		)		
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Text Alignment', 'fortun' ),
		'id'	=> $prefix . 'imageslider_text_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Left', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Right', 'fortun' ), 
		),
		'default'  => 'flex-start'
	) );
	
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Vertical Alignment', 'fortun' ),
		'id'	=> $prefix . 'imageslider_vertical_alignment',
		'type'	=> 'radio_inline',
		'options' => array( 
			'flex-start' => esc_html__( 'Top', 'fortun' ), 
			'center' => esc_html__( 'Center', 'fortun' ), 
			'flex-end' => esc_html__( 'Bottom', 'fortun' ), 
		),
		'default'  => 'center'
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Padding Values', 'fortun' ), 
		'desc'	=> esc_html__('Padding Top. You can use px, em, %, etc. or enter just number and it will use pixels.', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_padding_top', 
		'type'	=> 'text_small',
		'default' => '0',
		'row_classes' => 'agni-slide-col agni-slide-padding-top',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-padding-container">'
	) );

	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Right', 'fortun' ), 
		'desc'	=> esc_html__('Padding Right', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_padding_right', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-right'
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'desc'	=> esc_html__('Padding Bottom', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_padding_bottom', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-bottom',
	) );
	$imageslider_slider_options->add_field( array(
		//'name'	=> esc_html__('Padding Left', 'fortun' ), 
		'desc'	=> esc_html__('Padding Left', 'fortun' ), 
		'id'	=> $prefix . 'imageslider_padding_left', 
		'type'	=> 'text_small',
		'default' => '0',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-padding-left',
		'after_row' => '</div>'
	) );

	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Slider Choice', 'fortun' ),
		'id'	=> $prefix.'imageslider_choice',
		'type'	=> 'radio_inline',
		'options' => array( 
			'1' => esc_html__('Full Height(100%)', 'fortun' ), 
			'2' => esc_html__('Custom Height', 'fortun' ), 
		),
		'default' => '1',
		'before_row' => '<h3>Basic Options</h3>'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height', 'fortun' ), 
		'desc'	=> esc_html__('Enter your slider height, don\'t include "px" string', 'fortun' ), 
		'id'	=> $prefix.'imageslider_height', 
		'type'	=> 'text_small',
		'default' => '600',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_choice',
			'data-conditional-value' => '2',
		),
		'row_classes' => 'agni-slide-col agni-slide-height-desktop',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-height-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Tablet devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Tablets', 'fortun' ), 
		'id'	=> $prefix.'imageslider_height_tab', 
		'type'	=> 'text_small',
		'default' => '480',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-tab',
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Slider Height(Mobile devices)', 'fortun' ), 
		'desc'	=> esc_html__('Height on Mobiles', 'fortun' ), 
		'id'	=> $prefix.'imageslider_height_mobile', 
		'type'	=> 'text_small',
		'default' => '360',
		'attributes' => array(
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_choice',
			'data-conditional-value' => '2',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-height-mobile',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array(
		'name' => esc_html__('Parallax', 'fortun' ),
		'desc' => esc_html__('Check this to enable parallax, its purely based on skrollr.', 'fortun' ),
		'id' => $prefix.'imageslider_parallax',
		'type' => 'checkbox',
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s top at the top of the screen. for eg.transform:translateY(0px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'imageslider_parallax_start', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(0px);',
		'attributes' => array(
	        'rows'        => 2,
	        'placeholder' => 'Parallax Starting Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_parallax',
		),
		'row_classes' => 'agni-slide-col agni-slide-parallax-start',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-parallax-container">'
	) );
	
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Parallax End Value', 'fortun' ), 
		'desc'	=> esc_html__('Enter the css property for the slider\'s bottom when at the top of the screen. for eg.transform:translateY(600px); if don\'t want parallax just leave this empty', 'fortun' ), 
		'id'	=> $prefix.'imageslider_parallax_end', 
		'type'	=> 'textarea_small',
		'default'  => 'transform:translateY(600px);',
		'attributes' => array(
			'rows'        => 2,
			'placeholder' => 'Parallax End Value',
			'required' => false, // Will be required only if visible.
			'data-conditional-id' => $prefix . 'imageslider_parallax',
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-parallax-end',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Autoplay', 'fortun' ),
		'id'	=> $prefix.'imageslider_autoplay',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Loop', 'fortun' ),
		'id'	=> $prefix.'imageslider_loop',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Duration', 'fortun' ), 
		'desc'	=> esc_html__('Enter your transition duration in ms.', 'fortun' ), 
		'id'	=> $prefix.'imageslider_transition_duration', 
		'type'	=> 'text_small',
		'default' => '6000',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '3000',
			'max'  => '20000',
			'step'  => '100'
		),
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$imageslider_slider_options->add_field( array( 
		'name'	=> esc_html__('Transition Speed', 'fortun' ), 
		'desc'	=> esc_html__('Enter your transition speed in ms.', 'fortun' ), 
		'id'	=> $prefix.'imageslider_transition_speed', 
		'type'	=> 'text_small',
		'default' => '400',
		'attributes' => array(
			'type'  => 'number',
			'min'  => '100',
			'max'  => '1200',
			'step'  => '10'
		),
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Animation In', 'fortun' ),
		'id'	=> $prefix.'imageslider_animate_in',
		'type'	=> 'select',
		'options' => array( 
			'fadeIn' => esc_html__('fadeIn', 'fortun' ), 
			'fadeInDown' => esc_html__('fadeInDown', 'fortun' ),
			'fadeInRight' => esc_html__('fadeInRight', 'fortun' ),
			'fadeInLeft' => esc_html__('fadeInLeft', 'fortun' ),
			'fadeInUp' => esc_html__('fadeInUp', 'fortun' ),
			'flipInX' => esc_html__('flipInX', 'fortun' ),
			'slideInUp' => esc_html__('slideInUp', 'fortun' ),
			'slideInDown' => esc_html__('slideInDown', 'fortun' ),
			'slideInLeft' => esc_html__('slideInLeft', 'fortun' ),
			'slideInRight' => esc_html__('slideInRight', 'fortun' ),
			'zoomIn' => esc_html__('zoomIn', 'fortun' ),
		),
		'default' => 'slideInRight',
		'row_classes' => 'agni-slide-col agni-slide-animate-in',
		'before_row' => '<div class="cmb-row agni-slide-row agni-slide-animate-container">'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Animation Out', 'fortun' ),
		'id'	=> $prefix.'imageslider_animate_out',
		'type'	=> 'select',
		'options' => array( 
			'fadeOut' => esc_html__('fadeOut', 'fortun' ), 
			'fadeOutDown' => esc_html__('fadeOutDown', 'fortun' ),
			'fadeOutRight' => esc_html__('fadeOutRight', 'fortun' ),
			'fadeOutLeft' => esc_html__('fadeOutLeft', 'fortun' ),
			'fadeOutUp' => esc_html__('fadeOutUp', 'fortun' ),
			'flipOutX' => esc_html__('flipOutX', 'fortun' ),
			'slideOutUp' => esc_html__('slideOutUp', 'fortun' ),
			'slideOutDown' => esc_html__('slideOutDown', 'fortun' ),
			'slideOutLeft' => esc_html__('slideOutLeft', 'fortun' ),
			'slideOutRight' => esc_html__('slideOutRight', 'fortun' ),
			'zoomOut' => esc_html__('zoomOut', 'fortun' ),
		),
		'default' => 'slideOutLeft',
		'show_names' => false,
		'row_classes' => 'agni-slide-col agni-slide-animate-out',
		'after_row' => '</div>'
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Navigation Arrows', 'fortun' ),
		'id'	=> $prefix.'imageslider_navigation',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Pagination Dots', 'fortun' ),
		'id'	=> $prefix.'imageslider_pagination',
		'type'	=> 'checkbox',
	) );
	$imageslider_slider_options->add_field( array(
		'name'	=> esc_html__('Mouse Drag', 'fortun' ),
		'id'	=> $prefix.'imageslider_mousedrag',
		'type'	=> 'checkbox',
	) );
	
}


add_action( 'cmb2_init', 'agni_team_member_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_team_member_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'member_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$team_member_option = new_cmb2_box( array(
		'id'            => $prefix . 'team_member',
		'title'         => esc_html__( 'Team Members', 'fortun' ),
		'object_types'  => array( 'team' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Image/photo', 'fortun' ), 
		'id'	=> $prefix.'image_url', 
		'type'	=> 'file',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Name', 'fortun' ),  
		'id'	=> $prefix.'name', 
		'type'	=> 'text_small',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Link for Name', 'fortun' ),  
		'id'	=> $prefix.'name_link', 
		'type'	=> 'text_url',
	) );
	
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Designation', 'fortun' ),  
		'id'	=> $prefix.'designation', 
		'type'	=> 'text_small',
	) );
	$team_member_option->add_field( array( 
		'name'	=> esc_html__('Divide Line', 'fortun' ),
		'id'	=> $prefix.'line',
		'type'	=> 'checkbox',
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Description', 'fortun'),
		'desc'  => esc_html__('Additional information about the member', 'fortun'),
		'id'    => $prefix.'description',
		'type'  => 'textarea_small'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Facebook', 'fortun'),
		'desc'  => esc_html__('Facebook link', 'fortun'),
		'id'    => $prefix.'facebook_link',
		'type'  => 'text_url'
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Twitter', 'fortun'),
		'id'    => $prefix.'twitter_link',
		'type'  => 'text_url'
	) );
	
	$team_member_option->add_field( array(
		'name'=> esc_html__('Google Plus', 'fortun'),
		'id'    => $prefix.'google_plus_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('VK', 'fortun'),
		'id'    => $prefix.'vk_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Behance', 'fortun'),
		'id'    => $prefix.'behance_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Pinterest', 'fortun'),
		'id'    => $prefix.'pinterest_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Dribbble', 'fortun'),
		'id'    => $prefix.'dribbble_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Skype', 'fortun'),
		'id'    => $prefix.'skype_link',
		'type'  => 'text_small'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Linkedin', 'fortun'),
		'id'    => $prefix.'linkedin_link',
		'type'  => 'text_url'
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Email', 'fortun'),
		'id'    => $prefix.'envelope_link',
		'type'  => 'text_email',
	) );
	$team_member_option->add_field( array(
		'name'=> esc_html__('Phone/Mobile Number', 'fortun'),
		'id'    => $prefix.'number',
		'type'  => 'text_small'
	) );
	
}

add_action( 'cmb2_init', 'agni_clients_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_clients_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'clients_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$clients_option = new_cmb2_box( array(
		'id'            => $prefix . 'clients',
		'title'         => esc_html__( 'Clients', 'fortun' ),
		'object_types'  => array( 'clients' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$clients_option->add_field( array( 
		'name'	=> esc_html__('Image/photo', 'fortun' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
	) );
	
	$clients_option->add_field( array( 
		'name'	=> esc_html__('Link for Image', 'fortun' ),  
		'id'	=> $prefix.'image_link', 
		'type'	=> 'text_url',
	) );
}
	
add_action( 'cmb2_init', 'agni_testimonials_meta' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function agni_testimonials_meta() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'testimonial_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$testimonials_option = new_cmb2_box( array(
		'id'            => $prefix . 'testimonials',
		'title'         => esc_html__( 'Testimonials', 'fortun' ),
		'object_types'  => array( 'testimonials' ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );	
		
	$testimonials_option->add_field( array( 
		'name'	=> esc_html__('Avatar of author', 'fortun' ), 
		'id'	=> $prefix.'image', 
		'type'	=> 'file',
	) );
	
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Testimonial Text', 'fortun'),
		'desc'  => esc_html__('quote said by the author..', 'fortun'),
		'id'    => $prefix.'quote',
		'type'  => 'textarea_small'
	) );
	
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Author Name', 'fortun'),
		'id'    => $prefix.'author',
		'type'  => 'text_small'
	) );
	$testimonials_option->add_field( array(
		'name'=> esc_html__('Author Designation', 'fortun'),
		'id'    => $prefix.'author_designation',
		'type'  => 'text_small'
	) );
}
