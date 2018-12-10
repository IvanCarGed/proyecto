<?php
/*
 * @package     WBC_Importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0
 */


if ( !function_exists( 'wbc_filter_title' ) ) {

	/**
	 * Filter for changing demo title in options panel so it's not folder name.
	 *
	 * @param [string] $title name of demo data folder
	 *
	 * @return [string] return title for demo name.
	 */

	function wbc_filter_title( $title ) {
		return trim( ucfirst( str_replace( "-", " ", $title ) ) );
	}

	// Uncomment the below
	add_filter( 'wbc_importer_directory_title', 'wbc_filter_title', 10 );
}

if ( !function_exists( 'wbc_importer_description_text' ) ) {

	/**
	 * Filter for changing importer description info in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $title description above demos
	 *
	 * @return [string] return.
	 */

	function wbc_importer_description_text( $description ) {

		$message = '<h3 style="font-size:18px"><span>'. esc_html__( 'Click "Demo 1 - Demo 18" to import respective demo contents. Click "Other pages" to import all additional pages.', 'fortun' ) .'</span></h3>';
		$message .= '<p><strong style="color:#11B6ED;">'. wp_kses( __( 'Note 1: It will import all corresponding demo settings, widgets, sliders(if any). Note 2: Demo 2, Demo 3, Demo 6, Demo 15, Demo 17 are using Custom/Typekit fonts, refer <a href="http://demo.agnidesigns.com/fortun/documentation/">documentation</a> to get exact same fonts.', 'fortun' ), array( 'a' => array( 'href' => array() ) ) ) .'</strong></p>';
		$message .= '<p><strong style="color:red;">'. esc_html__( 'This process may take serveral minutes to complete. Please be patience :) If the process bar stops working, refresh the page and click "Import Demo" again.', 'fortun' ) .'</strong></p>';

		return $message;
	}

	// Uncomment the below
	add_filter( 'wbc_importer_description', 'wbc_importer_description_text', 10 );
}


if ( !function_exists( 'wbc_change_demo_directory_path' ) ) {

	/**
	 * Change the path to the directory that contains demo data folders.
	 *
	 * @param [string] $demo_directory_path
	 *
	 * @return [string]
	 */

	function wbc_change_demo_directory_path( $demo_directory_path ) {

		$demo_directory_path = get_template_directory() .'/template/demo-data/';

		return $demo_directory_path;

	}

	// Uncomment the below
	add_filter('wbc_importer_dir_path', 'wbc_change_demo_directory_path' );
}

/************************************************************************
* Extended Example:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/

if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/

		if ( class_exists( 'RevSlider' ) ) {

			//If it's demo3 or demo5
			$wbc_sliders_array = array(
				'demo-6' => 'demo6.zip', //Set slider zip name
				'demo-8' => 'demo8.zip',
				'demo-10' => 'demo10.zip',
				'demo-12' => 'demo12.zip',
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/

		// mention all your demo names
		// Primary Menu
		$wbc_menu_array = array( 'demo-1', 'demo-2', 'demo-3', 'demo-4', 'demo-5', 'demo-6', 'demo-7', 'demo-8', 'demo-9', 'demo-10', 'demo-11', 'demo-12', 'demo-13', 'demo-14', 'demo-15', 'demo-16', 'demo-17', 'demo-18' );
		foreach ($wbc_menu_array as $value) {
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$value = substr($value, 5);
				$primary_menu = get_term_by( 'name', 'Demo '.$value.' - Primary Menu', 'nav_menu' );

				if ( isset( $primary_menu->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
							'primary' => $primary_menu->term_id,
						)
					);
				}
			}
		}

		// Footer Menu
		$wbc_menu_array = array( 'demo-10', 'demo-16', 'demo-17' );
		foreach ($wbc_menu_array as $value) {
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
				$value = substr($value, 5);
				$ternary_menu = get_term_by( 'name', 'Demo '.$value.' - Footer Menu', 'nav_menu' );

				if ( isset( $ternary_menu->term_id ) ) {
					set_theme_mod( 'nav_menu_locations', array(
							'ternary'  => $ternary_menu->term_id,
						)
					);
				}
			}
		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'demo-1' => 'Demo 1',
			'demo-2' => 'Demo 2',
			'demo-3' => 'Demo 3',
			'demo-4' => 'Demo 4',
			'demo-5' => 'Demo 5',
			'demo-6' => 'Demo 6',
			'demo-7' => 'Demo 7',
			'demo-8' => 'Demo 8',
			'demo-9' => 'Demo 9',
			'demo-10' => 'Demo 10',
			'demo-11' => 'Demo 11',
			'demo-12' => 'Demo 12',
			'demo-13' => 'Demo 13',
			'demo-14' => 'Demo 14',
			'demo-15' => 'Demo 15',
			'demo-16' => 'Demo 16',
			'demo-17' => 'Demo 17',
			'demo-18' => 'Demo 18',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}

	}


	// Uncomment the below
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}

?>
