<?php
/**
 * Admin Options Page
 * Appearance > Widget Areas
 *
 * @copyright   Copyright (c) 2017, Jeffrey Carandang
 * @since       1.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Creates the admin submenu pages under the Appearance
 *
 * @since 1.0
 * @return void
 */
if( !function_exists( 'widgetopts_areas_options_page' ) ):
	function widgetopts_areas_options_page() {
		add_submenu_page(
			'themes.php',
            __( 'Widget Areas', 'widget-areas' ),
            __( 'Widget Areas', 'widget-areas' ),
            'manage_options',
            'edit.php?post_type=widget_area'
		);
	}
	add_action( 'admin_menu', 'widgetopts_areas_options_page', 10 );
endif;
