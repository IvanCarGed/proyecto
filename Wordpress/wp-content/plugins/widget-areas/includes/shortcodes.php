<?php
/**
 * Shortcodes Handler
 *
 * @copyright   Copyright (c) 2016, Jeffrey Carandang
 * @since       4.0
 */

 // Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) exit;

if( !function_exists( 'widgetopts_areas_shortcode' ) ){
    function widgetopts_areas_shortcode( $atts, $contents ){
        extract(
            shortcode_atts(
                array(
                    'id'              => '',
                ),
            $atts )
        );

        $return = '';

        if( !empty( $id ) ){
            $class = get_post_meta( $id, '_widgetopts-areas-class', true );
            $return = do_shortcode( '[do_sidebar name="widget-areas-'. $id .'" container="div" container_id="widget-areas-'. $id .'" container_class="widget-areas '. $class .'"  ]' );
        }

        return $return;
    }
    add_shortcode( 'display_widget_area', 'widgetopts_areas_shortcode' );
}

?>
