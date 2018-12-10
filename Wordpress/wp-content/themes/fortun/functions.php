<?php
/**
 * Agni Framework functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Agni Framework
 */

/**
 * Defining framwork constants
 */
define('AGNI_FRAMEWORK_DIR', 			get_template_directory() );
define('AGNI_FRAMEWORK_URL', 			get_template_directory_uri() );
define('AGNI_FRAMEWORK_CSS_URL', 		AGNI_FRAMEWORK_URL . '/css');
define('AGNI_FRAMEWORK_JS_URL', 		AGNI_FRAMEWORK_URL . '/js');
define('AGNI_THEME_FILES_DIR', 			AGNI_FRAMEWORK_DIR . '/agni' );
define('AGNI_THEME_FILES_URL', 			AGNI_FRAMEWORK_URL . '/agni' );

if ( ! function_exists( 'agni_framework_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function agni_framework_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Agni Framework, use a find and replace
	 * to change 'agni_framework' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fortun', AGNI_FRAMEWORK_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'gallery',
		'link',
		'quote',
		'video',
	) );

	/*
	 * Enable support for WooCommerce.
	 * See http://docs.woothemes.com/documentation/plugins/woocommerce/
	 */
	add_theme_support( 'woocommerce' );

}
endif; // agni_framework_setup
add_action( 'after_setup_theme', 'agni_framework_setup' );

/**
 * Load Custom metabox file CMB2 Conditionals 1.0.4.
 */
function agni_framework_meta_boxes_init() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require AGNI_THEME_FILES_DIR . '/cmb2/init.php';
        require AGNI_THEME_FILES_DIR . '/cmb2-conditionals.php';
    }

	class JW_Fancy_Color {
		const VERSION = '0.2.0';
		public function hooks() {
			add_action( 'cmb2_render_rgba_colorpicker', array( $this, 'render_color_picker' ), 10, 5 );
		}
		public function render_color_picker( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
			echo  $field_type_object->input( array(
				'class'              => 'cmb2-colorpicker color-picker',
				'data-default-color' => $field->args( 'default' ),
				'data-alpha'         => 'true',
			) );
		}
	}
	$jw_fancy_color = new JW_Fancy_Color();
	$jw_fancy_color->hooks();

}
add_action( 'after_setup_theme', 'agni_framework_meta_boxes_init' );

/**
 * Load Custom metabox file CMB2 Radio Image 0.1
 */
function cmb2_radio_image_callback($field, $escaped_value, $object_id, $object_type, $field_type_object) {

    echo  $field_type_object->radio();

}
add_action('cmb2_render_radio_image', 'cmb2_radio_image_callback', 10, 5);

function cmb2_radio_image_attributes($args, $defaults, $field, $cmb) {
    if ($field->args['type'] == 'radio_image' && isset($field->args['images'])) {
        foreach ($field->args['images'] as $field_id => $image) {
            if ($field_id == $args['value']) {
                $image = trailingslashit($field->args['images_path']) . $image;
                $args['label'] = '<img src="' . $image . '" alt="' . $args['value'] . '" title="' . $args['label'] . '" />';
            }
        }
    }
    return $args;
}
add_filter('cmb2_list_input_attributes', 'cmb2_radio_image_attributes', 10, 4);

/**
 * Enqueue scripts and styles for admin.
 */
function agni_cmb2_admin_scripts(){
	wp_deregister_style( 'cmb2-styles' );
	wp_enqueue_style( 'agni-cmb2-css', AGNI_THEME_FILES_URL . '/assets/css/cmb2.css' );
	wp_enqueue_style( 'cmb2-radio-image', AGNI_THEME_FILES_URL . '/assets/css/cmb2-radio-image.css' );
    if( is_rtl() ){
        wp_enqueue_style( 'agni-cmb2-rtl-css', AGNI_THEME_FILES_URL . '/assets/css/cmb2-rtl.css' );
    }

	wp_enqueue_script( 'cmb2-conditionals', AGNI_THEME_FILES_URL . '/assets/js/cmb2-conditionals.js', array('jquery'), CMB2_Conditionals::VERSION, true );
	wp_enqueue_script( 'jw-cmb2-rgba-picker-js', AGNI_THEME_FILES_URL . '/assets/js/jw-cmb2-rgba-picker.js', array( 'wp-color-picker' ), JW_Fancy_Color::VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'agni_cmb2_admin_scripts' );

/**
 * Modifing functions of visual Composer for theme.
 */
function agni_framework_vc_before_intialization() {	
	// Setting visual composer for theme.
	vc_set_as_theme( true );	
	
	// Disable Frontend
	//vc_disable_frontend();

	// Including custom functions for visual composer.
	require AGNI_FRAMEWORK_DIR . '/template/composer/agni_vc_addons.php';	
	
	vc_set_shortcodes_templates_dir( AGNI_FRAMEWORK_DIR . '/template/composer/vc_templates/' );

	// Disables redirect on activation.
	remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
	remove_action( 'admin_init', 'vc_page_welcome_redirect' );

}
add_action( 'vc_before_init', 'agni_framework_vc_before_intialization' );

function agni_framework_vc_after_intialization() {	

	// Setting Default Post types
	if ( function_exists( 'vc_set_default_editor_post_types' ) ) {	
		$args = array( 'page', 'post', 'portfolio', 'agni_block' );
		if( class_exists( 'WooCommerce' ) ){
			$args[] = 'product';
		}
		vc_set_default_editor_post_types( $args );	
	}

}
add_action( 'vc_after_init', 'agni_framework_vc_after_intialization' );

/**
 * Setting Revolution Slider for theme
 */
if(function_exists( 'set_revslider_as_theme' )){
	function agni_framework_revslider_as_theme() {
		set_revslider_as_theme();
	}
	add_action( 'init', 'agni_framework_revslider_as_theme' );
}

/**
 * To support SVG on media upload.
 */
function agni_additional_mime_types($mimes) {
	$mimes['eot'] = 'application/vnd.ms-fontobject';
	$mimes['otf|ttf'] = 'application/font-sfnt';
	$mimes['woff'] = 'application/font-woff';
	$mimes['woff2'] = 'application/font-woff2';
	$mimes['woff2'] = 'font/woff2';
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'agni_additional_mime_types');

/**
 * Load TGM Plugin action file.
 */
require AGNI_THEME_FILES_DIR . '/tgm/class-tgm-plugin-activation.php';

/**
 * Load Adobe TypeKit plugin file.
 */
require AGNI_THEME_FILES_DIR . '/agni-typekit/agni-typekit.php';

/**
 * Upload Custom Fonts plugin file.
 */
require AGNI_THEME_FILES_DIR . '/agni-custom-fonts/agni-custom-fonts.php';



/**
 * Loading Custom theme functions.
 */
function agni_framework_theme_custom_functions() {

	/**
	 * Custom template tags for this theme.
	 */
	require AGNI_FRAMEWORK_DIR . '/template/template-tags.php';

	// Unique functions for the particular theme
   	require AGNI_FRAMEWORK_DIR . '/template/theme-functions.php';

   	if( ( defined('ENVATO_HOSTED_SITE') ) ){
		// Redux Framework initation
		require AGNI_THEME_FILES_DIR . '/redux-framework/framework.php';
		require AGNI_FRAMEWORK_DIR . '/template/custom-redux-options.php';
	}

	// Theme option panel value customizations
   	require AGNI_FRAMEWORK_DIR . '/template/theme-customization.php';

   	// Theme Metabox functions
   	require AGNI_FRAMEWORK_DIR . '/template/custom-metabox-functions.php';

   	// Demo content import options
   	require AGNI_FRAMEWORK_DIR . '/template/custom-demo-import-functions.php';

   	// Woocommerce function for theme.
   	if( class_exists( 'WooCommerce' ) ){
		require AGNI_FRAMEWORK_DIR . '/template/woocommerce/functions.php';	
	}
}
add_action( 'after_setup_theme', 'agni_framework_theme_custom_functions' );
