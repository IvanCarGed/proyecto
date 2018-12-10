<?php
/*
Plugin Name: Agni Fortun
Plugin URI: http://themeforest.net/user/AgniHD
Description: This is a core plugin for Fortun theme by AgniDesigns.
Version: 1.0.2
Author: AgniDesigns
Author URI: http://themeforest.net/user/AgniHD
Text Domain: agni-fortun-plugin
License: GNU General Public License v2 or later
*/

/*
This is custom plugin specifically made for this theme by theme author(AgniDesigns). its strictly an offense to use this with third party author's theme.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



if ( ! class_exists( 'AgniFortunPlugin' ) ) {

    /**
     * Main AgniFortunPlugin class
     *
     * @since       1.0.0
     */
    class AgniFortunPlugin {

        /**
         * @const       string VERSION The plugin version, used for cache-busting and script file references
         * @since       1.0.0
         */

        const VERSION = '1.0.0';

        /**
         * @access      protected
         * @var         array $options Array of config options, used to check for demo mode
         * @since       1.0.0
         */
        protected $options = array();

        /**
         * Use this value as the text domain when translating strings from this plugin. It should match
         * the Text Domain field set in the plugin header, as well as the directory name of the plugin.
         * Additionally, text domains should only contain letters, number and hypens, not underscores
         * or spaces.
         *
         * @access      protected
         * @var         string $plugin_slug The unique ID (slug) of this plugin
         * @since       1.0.0
         */
        protected $plugin_slug = 'agni-fortun-plugin';
		function __construct() {

            // load language files
            load_plugin_textdomain( dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

            // We safely integrate with theme with this hook
			add_action( 'init', array( $this, 'AgniFortunCustomFunction' ), 1 );
	 
		}
		
		public function AgniFortunCustomFunction() {		
            if( !( defined('ENVATO_HOSTED_SITE') ) ){   
                /* Custom Redux Framework */
                require_once( 'inc/redux-framework/framework.php' );
            }

			/* Custom Post Types */
			require_once( 'inc/custom-posttypes.php' );

            /* Custom Shortcodes */
            require_once( 'inc/custom-vc-shortcodes.php' );
		}
			
		
	}
	// Finally initialize code
	new AgniFortunPlugin();
}
