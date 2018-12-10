<?php

/*
 * Custom post type portfolio
 */
 
 if( !function_exists( 'register_portfolio_posttype' ) ){
	function register_portfolio_posttype() {
		global $fortun_options;

		$portfolio_slug = 'portfolio';
		if( !empty($fortun_options['portfolio-posttype-slug']) ){
			$portfolio_slug = $fortun_options['portfolio-posttype-slug'];
		}

		$labels = array(
			'name'                => _x( 'Portfolio', 'Portfolio General Name', 'agni-fortun-plugin' ),
			'singular_name'       => _x( 'Portfolio', 'Portfolio Singular Name', 'agni-fortun-plugin' ),
			'menu_name'           => __( 'Portfolio', 'agni-fortun-plugin' ),
			'parent_item_colon'   => __( 'Parent Item:', 'agni-fortun-plugin' ),
			'all_items'           => __( 'All Items', 'agni-fortun-plugin' ),
			'view_item'           => __( 'View Item', 'agni-fortun-plugin' ),
			'add_new_item'        => __( 'Add New Item', 'agni-fortun-plugin' ),
			'add_new'             => __( 'Add New', 'agni-fortun-plugin' ),
			'edit_item'           => __( 'Edit Item', 'agni-fortun-plugin' ),
			'update_item'         => __( 'Update Item', 'agni-fortun-plugin' ),
			'search_items'        => __( 'Search Item', 'agni-fortun-plugin' ),
			'not_found'           => __( 'Not found', 'agni-fortun-plugin' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'agni-fortun-plugin' ),
		);
		$post_type_args = array(
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-portfolio',
			'can_export'          => true,
			'has_archive'         => true,
			'rewrite' 			=> array( 'slug' => $portfolio_slug, 'with_front' => false ),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'portfolio', $post_type_args );

	}

	// Hook into the 'init' action
	add_action( 'init', 'register_portfolio_posttype');

	register_taxonomy('types', array('portfolio'), array('hierarchical' => true, 'label' => 'Portfolio Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));

}

/**
 * Post Type team
 */	
 if( !function_exists( 'register_team_posttype' ) ){
	function register_team_posttype() {
		$labels = array(
			'name' 				=> _x( 'Team Member', 'post type general name','agni-fortun-plugin' ),
			'singular_name'		=> _x( 'Member', 'post type singular name','agni-fortun-plugin' ),
			'add_new' 			=> __( 'Add New Member','agni-fortun-plugin' ),
			'add_new_item' 		=> __( 'Add New Member','agni-fortun-plugin' ),
			'all_items' 		=> __( 'All Members','agni-fortun-plugin' ),
			'edit_item' 		=> __( 'Edit Member','agni-fortun-plugin' ),
			'new_item' 			=> __( 'New Member','agni-fortun-plugin' ),
			'view_item' 		=> __( 'View Member','agni-fortun-plugin' ),
			'search_items' 		=> __( 'Search Members','agni-fortun-plugin' ),
			'not_found' 		=> __( 'Member','agni-fortun-plugin' ),
			'not_found_in_trash'=> __( 'Member','agni-fortun-plugin' ),
			'parent_item_colon' => __( 'Member','agni-fortun-plugin' ),
			'menu_name'			=> __( 'Team','agni-fortun-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Member','agni-fortun-plugin'),
			'public' 			=> false,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'team', 'with_front' => false ),
			'supports' 			=> 'title',
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-businessman',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('team',$post_type_args);
	}
	add_action('init', 'register_team_posttype');

	register_taxonomy('team_types', array('team'), array('hierarchical' => true, 'label' => 'Team Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}

/**
 * Post Type client
 */	
 if( !function_exists( 'register_clients_posttype' ) ){
	function register_clients_posttype() {
		$labels = array(
			'name' 				=> _x( 'Clients', 'post type general name','agni-fortun-plugin' ),
			'singular_name'		=> _x( 'Client', 'post type singular name','agni-fortun-plugin' ),
			'add_new' 			=> __( 'Add New Client','agni-fortun-plugin' ),
			'add_new_item' 		=> __( 'Add New Client','agni-fortun-plugin' ),
			'all_items' 		=> __( 'All Clients','agni-fortun-plugin' ),
			'edit_item' 		=> __( 'Edit Client','agni-fortun-plugin' ),
			'new_item' 			=> __( 'New Client','agni-fortun-plugin' ),
			'view_item' 		=> __( 'View Client','agni-fortun-plugin' ),
			'search_items' 		=> __( 'Search Clients','agni-fortun-plugin' ),
			'not_found' 		=> __( 'Client','agni-fortun-plugin' ),
			'not_found_in_trash'=> __( 'Client','agni-fortun-plugin' ),
			'parent_item_colon' => __( 'Client','agni-fortun-plugin' ),
			'menu_name'			=> __( 'Clients','agni-fortun-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Client','agni-fortun-plugin'),
			'public' 			=> false,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'clients', 'with_front' => false ),
			'supports' 			=> 'title',
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-smiley',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('clients',$post_type_args);
	}
	add_action('init', 'register_clients_posttype');

	register_taxonomy('client_types', array('clients'), array('hierarchical' => true, 'label' => 'Clients Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}

/**
 * Post Type testimonials
 */	
 if( !function_exists( 'register_testimonials_posttype' ) ){
	function register_testimonials_posttype() {
		$labels = array(
			'name' 				=> _x( 'Testimonials', 'post type general name','agni-fortun-plugin' ),
			'singular_name'		=> _x( 'Testimonial', 'post type singular name','agni-fortun-plugin' ),
			'add_new' 			=> __( 'Add New Testimonial','agni-fortun-plugin' ),
			'add_new_item' 		=> __( 'Add New Testimonial','agni-fortun-plugin' ),
			'all_items' 		=> __( 'All Testimonials','agni-fortun-plugin' ),
			'edit_item' 		=> __( 'Edit Testimonial','agni-fortun-plugin' ),
			'new_item' 			=> __( 'New Testimonial','agni-fortun-plugin' ),
			'view_item' 		=> __( 'View Testimonial','agni-fortun-plugin' ),
			'search_items' 		=> __( 'Search Testimonials','agni-fortun-plugin' ),
			'not_found' 		=> __( 'Testimonial','agni-fortun-plugin' ),
			'not_found_in_trash'=> __( 'Testimonial','agni-fortun-plugin' ),
			'parent_item_colon' => __( 'Testimonial','agni-fortun-plugin' ),
			'menu_name'			=> __( 'Testimonials','agni-fortun-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Testimonial','agni-fortun-plugin'),
			'public' 			=> false,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'testimonials', 'with_front' => false ),
			'supports' 			=> 'title',
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-testimonial',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('testimonials',$post_type_args);
	}
	add_action('init', 'register_testimonials_posttype');

	register_taxonomy('quote_types', array('testimonials'), array('hierarchical' => true, 'label' => 'Testimonials Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}

/**
 * Block Custom Post Type
 */ 
 if( !function_exists( 'register_block_posttype' ) ){
    function register_block_posttype() {
        $labels = array(
            'name'              => _x( 'Blocks', 'post type general name','agni-fortun-plugin' ),
            'singular_name'     => _x( 'Block', 'post type singular name','agni-fortun-plugin' ),
            'add_new'           => __( 'Add New Block','agni-fortun-plugin' ),
            'add_new_item'      => __( 'Add New Block','agni-fortun-plugin' ),
            'all_items'         => __( 'All Blocks','agni-fortun-plugin' ),
            'edit_item'         => __( 'Edit Block','agni-fortun-plugin' ),
            'new_item'          => __( 'New Block','agni-fortun-plugin' ),
            'view_item'         => __( 'View Block','agni-fortun-plugin' ),
            'search_items'      => __( 'Search Blocks','agni-fortun-plugin' ),
            'not_found'         => __( 'Block','agni-fortun-plugin' ),
            'not_found_in_trash'=> __( 'Block','agni-fortun-plugin' ),
            'parent_item_colon' => __( 'Block','agni-fortun-plugin' ),
            'menu_name'         => __( 'Blocks','agni-fortun-plugin' )
        );
        
        $taxonomies = array();
        
        
        $post_type_args = array(
            'labels'            => $labels,
            'singular_label'    => __( 'Block','agni-fortun-plugin' ),
            'public'            => true,
            'show_ui'           => true,
            'show_in_nav_menus' => false,
            'publicly_queryable'=> true,
            'query_var'         => true,
            'capability_type'   => 'page',
            'has_archive'       => false,
            'hierarchical'      => false,
            'exclude_from_search' => true,
            'rewrite'           => array('slug' => 'agni_block', 'with_front' => false  ),
            'supports'          => array('title', 'editor'),
            'menu_position'     => 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
            'menu_icon'         => 'dashicons-layout',
            'taxonomies'        => $taxonomies
         );
         register_post_type('agni_block',$post_type_args);
    }
    add_action('init', 'register_block_posttype');

	register_taxonomy('block_types', array('agni_block'), array('hierarchical' => true, 'label' => 'Block Categories', 'singular_label' => 'Category', 'show_ui' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => true));
}


/**
 * Agni Slider Post Type
 */	
 if( !function_exists( 'register_slides_posttype' ) ){
	function register_slides_posttype() {
		$labels = array(
			'name' 				=> _x( 'Sliders', 'post type general name','agni-fortun-plugin' ),
			'singular_name'		=> _x( 'Slider', 'post type singular name','agni-fortun-plugin' ),
			'add_new' 			=> __( 'Add New Slider','agni-fortun-plugin' ),
			'add_new_item' 		=> __( 'Add New Slider','agni-fortun-plugin' ),
			'all_items' 		=> __( 'All Sliders','agni-fortun-plugin' ),
			'edit_item' 		=> __( 'Edit Slider','agni-fortun-plugin' ),
			'new_item' 			=> __( 'New Slider','agni-fortun-plugin' ),
			'view_item' 		=> __( 'View Slider','agni-fortun-plugin' ),
			'search_items' 		=> __( 'Search Sliders','agni-fortun-plugin' ),
			'not_found' 		=> __( 'Slider','agni-fortun-plugin' ),
			'not_found_in_trash'=> __( 'Slider','agni-fortun-plugin' ),
			'parent_item_colon' => __( 'Slider','agni-fortun-plugin' ),
			'menu_name'			=> __( 'Agni Slider','agni-fortun-plugin' )
		);
		
		$taxonomies = array();
		
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Slide','agni-fortun-plugin'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'show_in_nav_menus'	=> false,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'agni_slides', 'with_front' => false  ),
			'supports' 			=> array('title', 'author'),
			'menu_position' 	=> 6, // Where it is in the menu. Change to 6 and it's below posts. 11 and it's below media, etc.
			'menu_icon' 		=> 'dashicons-images-alt',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('agni_slides',$post_type_args);
	}
	add_action('init', 'register_slides_posttype');
}

function agni_flush_rewrite_rules()
{
	flush_rewrite_rules();
}
add_action('after_theme_switch', 'agni_flush_rewrite_rules');

