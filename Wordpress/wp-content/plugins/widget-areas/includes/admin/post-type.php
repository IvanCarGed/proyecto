<?php
/**
 * Create custom Widget Area for widget areas
 * @since   1.0
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !function_exists( 'widgetopts_areas_post_type' ) ):
    // Register Custom Widget Area
    function widgetopts_areas_post_type() {

    	$labels = array(
    		'name'                  => _x( 'Widget Areas', 'Widget Area General Name', 'widget-areas' ),
    		'singular_name'         => _x( 'Widget Area', 'Widget Area Singular Name', 'widget-areas' ),
    		'menu_name'             => __( 'Widget Areas', 'widget-areas' ),
    		'name_admin_bar'        => __( 'Widget Area', 'widget-areas' ),
    		'parent_item_colon'     => __( 'Parent Item:', 'widget-areas' ),
    		'all_items'             => __( 'All Widget Areas', 'widget-areas' ),
    		'add_new_item'          => __( 'Add New Widget Area', 'widget-areas' ),
    		'add_new'               => __( 'Add New', 'widget-areas' ),
    		'new_item'              => __( 'New Widget Area', 'widget-areas' ),
    		'edit_item'             => __( 'Edit Widget Area', 'widget-areas' ),
    		'update_item'           => __( 'Update Widget Area', 'widget-areas' ),
    		'view_item'             => __( 'View Widget Area', 'widget-areas' ),
    		'view_items'            => __( 'View Widget Areas', 'widget-areas' ),
            'search_items'        => __( 'Search Widgets', 'widget-areas' ),
			'not_found'           => sprintf( __( 'Whoops, looks like you haven\'t created any widget areas yet. <a href="%s">Create one now</a>!', 'widget-areas' ), admin_url( 'post-new.php?post_type=widget_area' ) ),
			'not_found_in_trash'  => __( 'No items found in Trash.', 'widget-areas' ),
    	);
    	$args = array(
    		'label'                 => __( 'Widget Area', 'widget-areas' ),
    		'description'           => __( 'Widget Area Description', 'widget-areas' ),
    		'labels'                => $labels,
    		'supports'              => array( 'title' ),
    		'hierarchical'          => false,
    		'public'                => false,
    		'show_ui'               => true,
    		'show_in_menu'          => false,
    		'show_in_admin_bar'     => false,
    		'show_in_nav_menus'     => false,
    		'can_export'            => true,
    		'has_archive'           => true,
    		'exclude_from_search'   => true,
    		'publicly_queryable'    => false,
    		'capability_type'       => 'page',
    	);
    	register_post_type( 'widget_area', $args );

    }
    add_action( 'init', 'widgetopts_areas_post_type', 10 );
endif;

if( !function_exists( 'widgetopts_areas_before_delete_post' ) ):
    add_action( 'before_delete_post', 'widgetopts_areas_before_delete_post' );
    function widgetopts_areas_before_delete_post( $id ){
        // We check if the global post type isn't ours and just return
        global $post_type;
        if ( $post_type != 'widget_area' ) return;

        //remove cached option values
        delete_option( 'widgetopts_areas_before' );
        delete_option( 'widgetopts_areas_after' );

    }
endif;

?>
