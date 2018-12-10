<?php
/**
 * Register all available widget areas
 * @since   1.0
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !function_exists( 'widgetopts_areas_register_sidebars' ) ):
    add_action( 'widgets_init', 'widgetopts_areas_register_sidebars' );
    function widgetopts_areas_register_sidebars(){
        $posts_ids = get_posts( 'post_type=widget_area&post_status=publish&order=ASC&posts_per_page='. apply_filters( 'widgetopts_areas_limit', 100 ) .'&fields=ids' );
        $widgets = apply_filters( 'widgetopts_areas_widget_ids', $posts_ids );
        if( !empty( $widgets ) && is_array( $widgets ) ){
            foreach ( $widgets as $widget ) {
                $meta = get_post_meta( $widget );

                register_sidebar( array(
                    'name'          => ( isset( $meta['_widgetopts-areas-name'] ) ) ? $meta['_widgetopts-areas-name'][0] : __( 'Widget Area ' . $widget, 'widget-areas' ),
                    'id'            => 'widget-areas-' . $widget,
                    'description'   => ( isset( $meta['_widgetopts-areas-description'] ) ) ? $meta['_widgetopts-areas-description'][0] : '',
                    'before_widget' => '<'. ( ( isset( $meta['_widgetopts-areas-before'] ) ) ? $meta['_widgetopts-areas-before'][0] : '' ) .' id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</'. ( ( isset( $meta['_widgetopts-areas-before'] ) ) ? $meta['_widgetopts-areas-before'][0] : '' ) .'>',
                    'before_title'  => '<'. ( ( isset( $meta['_widgetopts-areas-before_title'] ) ) ? $meta['_widgetopts-areas-before_title'][0] : '' ) .' class="widgettitle '. ( ( isset( $meta['_widgetopts-areas-title_class'] ) ) ? $meta['_widgetopts-areas-title_class'][0] : '' ) .'">',
                    'after_title'   => '</'. ( ( isset( $meta['_widgetopts-areas-before_title'] ) ) ? $meta['_widgetopts-areas-before_title'][0] : '' ) .'>',
                ) );
            }
        }
    }
endif;
?>
