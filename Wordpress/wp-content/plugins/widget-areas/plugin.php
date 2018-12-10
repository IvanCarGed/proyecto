<?php
/**
 * Plugin Name: Widget Areas
 * Plugin URI: https://wordpress.org/plugins/widget-areas
 * Description: Create custom widget areas before and after content for posts, pages and/or custom post types; or add them manually via PHP code.
 * Version: 1.0
 * Author: Phpbits Creative Studio
 * Author URI: https://phpbits.net/
 * Text Domain: widget-areas
 * Domain Path: languages
 *
 * @category Widgets
 * @author Jeffrey Carandang
 * @version 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'WIDGETOPTS_WIDGET_AREAS' ) ) :
/**
 * Main WIDGETOPTS_WIDGET_AREAS Class.
 *
 * @since  1.0
 */
final class WIDGETOPTS_WIDGET_AREAS {
	/**
	 * @var WIDGETOPTS_WIDGET_AREAS The one true WIDGETOPTS_WIDGET_AREAS
	 * @since  1.0
	 */
	private static $instance;
	/**
	 * Main WIDGETOPTS_WIDGET_AREAS Instance.
	 *
	 * Insures that only one instance of WIDGETOPTS_WIDGET_AREAS exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since  1.0
	 * @static
	 * @staticvar array $instance
	 * @uses WIDGETOPTS_WIDGET_AREAS::setup_constants() Setup the constants needed.
	 * @uses WIDGETOPTS_WIDGET_AREAS::includes() Include the required files.
	 * @uses WIDGETOPTS_WIDGET_AREAS::load_textdomain() load the language files.
	 * @see WIDGETOPTS_AREAS()
	 * @return object|WIDGETOPTS_WIDGET_AREAS The one true WIDGETOPTS_WIDGET_AREAS
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WIDGETOPTS_WIDGET_AREAS ) ) {
			self::$instance = new WIDGETOPTS_WIDGET_AREAS;
			self::$instance->setup_constants();
			// add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
			self::$instance->includes();
			// self::$instance->roles         = new WIDGETOPTS_Roles();
		}
		return self::$instance;
	}
	/**
	 * Setup plugin constants.
	 *
	 * @access private
	 * @since 4.1
	 * @return void
	 */
	private function setup_constants() {
		// Plugin version.
		if ( ! defined( 'WIDGETOPTS_AREAS_PLUGIN_NAME' ) ) {
			define( 'WIDGETOPTS_AREAS_PLUGIN_NAME', 'Widget Areas' );
		}
		// Plugin version.
		if ( ! defined( 'WIDGETOPTS_AREAS_VERSION' ) ) {
			define( 'WIDGETOPTS_AREAS_VERSION', ' 1.0' );
		}
		// Plugin Folder Path.
		if ( ! defined( 'WIDGETOPTS_AREAS_PLUGIN_DIR' ) ) {
			define( 'WIDGETOPTS_AREAS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}
		// Plugin Folder URL.
		if ( ! defined( 'WIDGETOPTS_AREAS_PLUGIN_URL' ) ) {
			define( 'WIDGETOPTS_AREAS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}
		// Plugin Root File.
		if ( ! defined( 'WIDGETOPTS_AREAS_PLUGIN_FILE' ) ) {
			define( 'WIDGETOPTS_AREAS_PLUGIN_FILE', __FILE__ );
		}
	}
	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function includes() {
		global $widgetopts_areas;

		// require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/admin/settings/register-settings.php';

		//call admin only resources
		if ( is_admin() ) {
			require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/admin/post-type.php';
			require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/admin/metabox.php';
			require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/admin/admin-menus.php';
			if( defined( 'WIDGETOPTS_PLUGIN_NAME' ) && 'Extended Widget Options' == WIDGETOPTS_PLUGIN_NAME ){
				require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/admin/shortcode-column.php';
			}
		}

		if( defined( 'WIDGETOPTS_PLUGIN_NAME' ) && 'Extended Widget Options' == WIDGETOPTS_PLUGIN_NAME ){
			require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/shortcodes.php';
		}

		require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/admin/sidebar.php';
		require_once WIDGETOPTS_AREAS_PLUGIN_DIR . 'includes/display.php';

	}
}
endif; // End if class_exists check.
/**
 * The main function for that returns WIDGETOPTS_WIDGET_AREAS
 *
 * The main function responsible for returning the one true WIDGETOPTS_WIDGET_AREAS
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $widgetopts = WIDGETOPTS_WIDGET_AREAS(); ?>
 *
 * @since 1.0
 * @return object|WIDGETOPTS_WIDGET_AREAS The one true WIDGETOPTS_WIDGET_AREAS Instance.
 */
if( !function_exists( 'WIDGETOPTS_WIDGET_AREAS_FN' ) ){
	function WIDGETOPTS_WIDGET_AREAS_FN() {
		return WIDGETOPTS_WIDGET_AREAS::instance();
	}
	// Get Plugin Running.
	add_action( 'plugins_loaded', 'WIDGETOPTS_WIDGET_AREAS_FN', apply_filters( 'widgetopts_areas_priority', 90 ) );
}
?>
