<?php
/**
 * Display Widget Areas on Front-end
 * @since   1.0
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !function_exists( 'widgetopts_areas_display' ) ):
    add_filter( 'the_content', 'widgetopts_areas_display' );
    function widgetopts_areas_display( $content ){
        if( is_single() || is_page() ){
            global $post;
            $before = get_option( 'widgetopts_areas_before', null );
            $after  = get_option( 'widgetopts_areas_after', null );

            if( is_null( $before ) ) {
                $widgets_before = get_posts( array(
                    'post_type'         => 'widget_area',
                    'post_status'       => 'publish',
                    'fields'            => 'ids',
                    'posts_per_page'    => apply_filters( 'widgetopts_areas_limit', 100 ),
                    'meta_query'        => array(
                                            array(
                                                'key'   => '_widgetopts-areas_types-' . $post->post_type,
                                                'value' => '1',
                                            ),
                                            array(
                                                'key'   => '_widgetopts-areas-display',
                                                'value' => 'before_content',
                                            )
                                        )
                ) );
                // Let's let devs alter that value coming in
                if( is_array( $widgets_before ) ){
                    asort( $widgets_before );
                }
                $before = apply_filters( 'widgetopts_areas_before_update', $widgets_before );
                update_option( 'widgetopts_areas_before', $before );
            }

            if( is_null( $after ) ) {
                $widgets_after = get_posts( array(
                    'post_type'         => 'widget_area',
                    'post_status'       => 'publish',
                    'fields'            => 'ids',
                    'posts_per_page'    => apply_filters( 'widgetopts_areas_limit', 100 ),
                    'meta_query'        => array(
                                            array(
                                                'key'   => '_widgetopts-areas_types-' . $post->post_type,
                                                'value' => '1',
                                            ),
                                            array(
                                                'key'   => '_widgetopts-areas-display',
                                                'value' => 'after_content',
                                            )
                                        )
                ) );
                // Let's let devs alter that value coming in
                if( is_array( $widgets_after ) ){
                    asort( $widgets_after );
                }
                $after = apply_filters( 'widgetopts_areas_after_update', $widgets_after );
                update_option( 'widgetopts_areas_after', $after );
            }

            $widgets_before = apply_filters( 'widgetopts_areas_types_before_content', $before );
            $widgets_after  = apply_filters( 'widgetopts_areas_types_after_content', $after );
            // print_r( $widgets_before );

            //add widget before contents
            if( !empty( $widgets_before ) && is_array( $widgets_before ) ){
                ob_start();
                foreach ( $widgets_before as $widget ) {
                    $class = get_post_meta( $widget, '_widgetopts-areas-class', true );
                    ?>

                    <?php if ( is_active_sidebar( 'widget-areas-'. $widget ) ) : ?>
                    	<div id="widget-areas-<?php echo $widget;?>" class="widget-areas <?php echo $class;?>">
                    	<?php dynamic_sidebar( 'widget-areas-'. $widget ); ?>
                    	</div>
                    <?php endif; ?>

                <?php }
                $before_content = ob_get_clean();
                $content        = $before_content . $content;
            }

            //add after content widgets
            if( !empty( $widgets_after ) && is_array( $widgets_after ) ){
                ob_start();
                foreach ( $widgets_after as $widget_id ) {
                    $class = get_post_meta( $widget_id, '_widgetopts-areas-class', true );
                    ?>

                    <?php if ( is_active_sidebar( 'widget-areas-'. $widget_id ) ) : ?>
                    	<div id="widget-areas-<?php echo $widget_id;?>" class="widget-areas <?php echo $class;?>">
                    	<?php dynamic_sidebar( 'widget-areas-'. $widget_id ); ?>
                    	</div>
                    <?php endif; ?>

                <?php }
                $after_content  = ob_get_clean();
                $content        = $content . $after_content;
            }
        }

        return $content;
    }
endif;

?>
