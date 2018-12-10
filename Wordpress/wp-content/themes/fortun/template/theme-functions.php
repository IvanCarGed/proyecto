<?php 
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Agni Framework
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function agni_framework_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'agni_framework_content_width', 960 );
}
add_action( 'after_setup_theme', 'agni_framework_content_width', 0 );

/**
 * Loading Custom theme functions.
 */
function fortun_setup() {
    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'fortun-standard-thumbnail', 960, 0, true );
    add_image_size( 'fortun-square-thumbnail', 960, 960, true );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'fortun' ),
        'secondary' => esc_html__( 'Top Bar Menu', 'fortun' ),
        'ternary' => esc_html__( 'Footer Menu', 'fortun' ),
    ) );

}
add_action( 'init', 'fortun_setup', 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fortun_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'fortun' ),
        'id'            => 'fortun-sidebar-1',
        'description'   => 'Main widget location that could appear on the left/right of all blog posts.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer bar', 'fortun' ),
        'id'            => 'fortun-footerbar-1'
    ) );
}
add_action( 'widgets_init', 'fortun_widgets_init' );

function fortun_footer_widgets_init() {
    //unregister_sidebar('footerbar-1');
    global $fortun_options;
    $col = 'col-md-4';
    if( !empty($fortun_options['footer-col']) ){
        switch($fortun_options['footer-col']){
            case '2':
                $col = 'col-xs-12 col-sm-12 col-md-6';
                break;
            case '3':
                $col = 'col-xs-12 col-sm-6 col-md-4';
                break;
            case '4':
                $col = 'col-xs-12 col-sm-6 col-md-3';
                break;
            case '5':
                $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
                break;
            case '6':
                $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2';
                break;
        }
    }
    register_sidebar( array(
        'name'          => esc_html__( 'Footer bar', 'fortun' ),
        'id'            => 'fortun-footerbar-1',
        'description'   => 'Additional Widget location that could appear at the bottom of the pages.',
        'before_widget' => '<aside id="%1$s" class="'.$col.' widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
}
add_action( 'redux/loaded', 'fortun_footer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fortun_iconfont_styles(){
    wp_deregister_style( 'font-awesome' );
    // Enqueue 3rd party CSS
    wp_enqueue_style( 'ionicons', AGNI_FRAMEWORK_CSS_URL . '/ionicons.min.css', array(), '2.0.1' );
    wp_enqueue_style( 'font-awesome', AGNI_FRAMEWORK_CSS_URL . '/font-awesome.min.css', array(), '4.7' );
    wp_enqueue_style( 'pe-stroke', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-stroke.min.css', array(), '1.2.0' );
    wp_enqueue_style( 'pe-filled', AGNI_FRAMEWORK_CSS_URL . '/Pe-icon-7-filled.min.css', array(), '1.2.0' );
    wp_enqueue_style( 'linea-arrows', AGNI_FRAMEWORK_CSS_URL . '/linea-arrows.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-basic', AGNI_FRAMEWORK_CSS_URL . '/linea-basic.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-elaboration', AGNI_FRAMEWORK_CSS_URL . '/linea-elaboration.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-ecommerce', AGNI_FRAMEWORK_CSS_URL . '/linea-ecommerce.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-software', AGNI_FRAMEWORK_CSS_URL . '/linea-software.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-music', AGNI_FRAMEWORK_CSS_URL . '/linea-music.min.css', array(), '1.0' );
    wp_enqueue_style( 'linea-weather', AGNI_FRAMEWORK_CSS_URL . '/linea-weather.min.css', array(), '1.0' );
    wp_enqueue_style( 'webfont-medical-icons', AGNI_FRAMEWORK_CSS_URL . '/wfmi-style.min.css', array(), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'fortun_iconfont_styles' );

function fortun_scripts() {
    global $fortun_options;
    
    $gmap_api = (!empty($fortun_options['gmap-api']))?'?key='.$fortun_options['gmap-api']:'';
    $theme_template = esc_attr( $fortun_options['theme-template'] );

    // Enqueue CSS
    wp_enqueue_style( 'fortun-plugins-style', AGNI_FRAMEWORK_CSS_URL . '/fortun-plugins.css' );
    wp_enqueue_style( 'fortun-bootstrap', AGNI_FRAMEWORK_CSS_URL . '/fortun.css' );
    wp_enqueue_style( 'fortun-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );

    if( !empty($theme_template) ){
        wp_enqueue_style( "fortun-style-{$theme_template}", AGNI_FRAMEWORK_CSS_URL . "/{$theme_template}.css", array(), wp_get_theme()->get('Version')  );
    }
    wp_enqueue_style( 'fortun-responsive', AGNI_FRAMEWORK_CSS_URL . '/responsive.css', array(), wp_get_theme()->get('Version')  );

    // Enqueue google web fonts
    wp_enqueue_style( 'fortun-fonts', '//fonts.googleapis.com/css?family=Poppins:600|Source+Sans+Pro:400,600,700' );

    if( !empty($fortun_options['google-font-additional']) ){
        wp_enqueue_style( 'fortun-google-fonts-additional', '//fonts.googleapis.com/css?family='.$fortun_options['google-font-additional'] );
    }

    // Enqueue JS
    wp_enqueue_script( 'jquery' );
    
    wp_enqueue_script( 'fortun-plugins-script', AGNI_FRAMEWORK_JS_URL . '/fortun-plugins.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );

    wp_enqueue_script( 'fortun-script', AGNI_FRAMEWORK_JS_URL . '/script.js', array( 'jquery', 'fortun-plugins-script' ), wp_get_theme()->get('Version'), true );
    wp_enqueue_script( 'googleapi', '//maps.google.com/maps/api/js'.$gmap_api );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'fortun_scripts' );

function fortun_admin_scripts() {

    wp_deregister_style( 'font-awesome' );
    wp_deregister_style( 'vc_openiconic' );
    wp_deregister_style( 'vc_typicons' );
    wp_deregister_style( 'vc_entypo' );
    wp_deregister_style( 'vc_linecons' );
    wp_deregister_style( 'vc_monosocialiconsfont' );

    // vc_style
    wp_enqueue_style( 'fortun-admin-style', AGNI_THEME_FILES_URL . '/assets/css/admin.css' );
    if( is_rtl() ){
        wp_enqueue_style( 'fortun-admin-rtl-style', AGNI_THEME_FILES_URL . '/assets/css/admin-rtl.css' );
    }

    wp_enqueue_script( 'fortun-admin-script', AGNI_FRAMEWORK_JS_URL . '/fortun-admin.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'admin_enqueue_scripts', 'fortun_admin_scripts' );

add_action( 'admin_enqueue_scripts', 'fortun_iconfont_styles' );

/**
 * Include custom widget for posts
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_latest_posts.php';
/**
 * Include custom widget for works
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_latest_works.php';
/**
 * Include custom widget for social icons
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_social_icons.php';
/**
 * Include custom widget for Instagram
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_instagram_feed.php';
/**
 * Include custom widget for Instagram
 */
require AGNI_FRAMEWORK_DIR . '/template/widgets/agni_widget_about_text.php';

/**
 * Custom Redux Framework Option panel 
 */
if( !( defined('ENVATO_HOSTED_SITE') ) ){
    function agni_custom_redux_options(){
        require AGNI_FRAMEWORK_DIR . '/template/custom-redux-options.php';
    }
    add_action( 'redux/init', 'agni_custom_redux_options' );
}

/**
 * Redirect to Theme Admin Panel
 */
function agni_theme_activation_redirect() {
    header( 'Location:' . admin_url() . 'admin.php?page=fortun' );
}
add_action( 'after_switch_theme', 'agni_theme_activation_redirect' );

/**
 * Register a custom menu page Admin panel.
 */
/*function agni_admin_menu() {
    if ( current_user_can( 'edit_theme_options' ) ) {
        add_theme_page( esc_html__( 'Admin Panel', 'fortun' ), esc_html__( 'Welcome', 'fortun' ), 'edit_theme_options', 'fortun', 'agni_admin_menu_welcome_page' );
    }
}
add_action( 'admin_menu', 'agni_admin_menu' );*/

/**
 * Register a custom menu page Admin panel.
 */
function agni_admin_menu() {
    if ( current_user_can( 'edit_theme_options' ) ) {
        add_menu_page( 'Fortun', 'Fortun', 'edit_theme_options', 'fortun', 'agni_admin_menu_welcome_page', AGNI_FRAMEWORK_URL  . '/img/fortun_options.png', 58  );
        add_submenu_page( 'fortun', esc_html__( 'Admin Panel', 'fortun' ), esc_html__( 'Welcome', 'fortun' ), 'edit_theme_options', 'fortun', '' );
        //add_submenu_page( 'fortun', esc_html__( 'Import Demo', 'fortun' ), esc_html__( 'Import Demo', 'fortun' ), 'edit_theme_options', 'fortun-theme-options&tab=32', 'agni_admin_menu_import_demo' );
    }
}
add_action( 'admin_menu', 'agni_admin_menu' );

/**
 * Custom Submenu order.
 */
function agni_custom_submenu_order( $menu_ord ) 
{
    if ( !empty ( $GLOBALS['admin_page_hooks']['fortun'] ) ){
        global $submenu;

        $temp = $submenu['fortun'][1];
        $submenu['fortun'][1] = $submenu['fortun'][2];
        $submenu['fortun'][2] = $temp;

        return $menu_ord;
    }
}
add_filter( 'custom_menu_order', 'agni_custom_submenu_order' );

/**
 * Admin panel function.
 */
function agni_admin_menu_welcome_page(){
    include ( AGNI_THEME_FILES_DIR . '/admin/agni-welcome-page.php' );
}
function agni_admin_menu_import_demo(){
    return false;
}

/**
 * Register Admin menu 
 */
function agni_admin_menu_bar( $wp_admin_bar ){
    if( current_user_can( 'edit_theme_options' ) ){
        $args = array(
            'id' => 'fortun-admin-menu',
            'title' => 'Fortun',
            'href' => admin_url() . 'admin.php?page=fortun', 
            'meta' => array(
                'class' => 'fortun-admin-menu', 
            ),
        );
        $wp_admin_bar-> add_menu( $args );
    }
}
add_action( 'admin_bar_menu', 'agni_admin_menu_bar', 99 );

/**
 * Maintenance Mode
 */
$fortun_options = get_option('fortun_options');
if( $fortun_options['maintenance-mode'] == '1' ){
    include ( AGNI_THEME_FILES_DIR . '/agni-maintenance/agni-maintenance-page.php' );
}

/**
 * Search form
 */
if( !function_exists('agni_search_form') ){
    function agni_search_form( $form ) {
        $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
            <label> <span class="screen-reader-text">' . esc_html__( 'Search for:', 'fortun' ) . '</span>
            <input type="search"  title="Search for:" value="" placeholder="'.esc_attr__( 'Search', 'fortun' ).'" name="s" id="s" class="search-field" /></label>
            <input type="submit" id="searchsubmit" class="search-submit" value="" />
        </form>';
        return $form;
    }
    add_filter( 'get_search_form', 'agni_search_form' );
}

/**
 * Post Excerpt
 */
if( !function_exists('agni_excerpt_length') ){
    function agni_excerpt_length( $charlength = null ) {
        $excerpt = get_the_excerpt();
        $charlength++;

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
            if ( $excut < 0 ) {
                $excerpt = mb_substr( $subex, 0, $excut );
            } else {
                $excerpt = $subex;
            }
        } 
        $readmore = '<p><a class="more-link btn-accent btn-alt" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__( 'Read More', 'fortun') . '</a></p>';
        $excerpt =  $excerpt.$readmore;
        
        return $excerpt;
    }
}

/**
 * Page Navigation
 */
if( !function_exists('agni_page_navigation') ){
    function agni_page_navigation( $query, $nav_type ) {
        global $wp_query;
        if( $query == '' ){
            $query = $wp_query;
        }
        if( get_query_var('paged') != '' ){
            $paged = get_query_var('paged');
        }
        elseif( get_query_var('page') != '' ){
            $paged = get_query_var('page');
        }
        else{
            $paged = 1;
        }
        $pages = paginate_links( array(
            'base'         => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ), 
            'format'       => '',
            'add_args'     => '',
            'current'      => max( 1, $paged ),
            'total'        => $query->max_num_pages,
            'prev_next'    => true,
            'prev_text'    => esc_html__('Previous', 'fortun'),
            'next_text'    => esc_html__('Next', 'fortun'),
            'type'         => 'list',
            'end_size'     => 1,
            'mid_size'     => 1
        ) );
        $output =  '<div class="'.$nav_type.' page-number-navigation navigation text-center">'.$pages.'</div>';
        return $output;
    }
}

/**
 * Portfolio Thumbnail Custom Crop
 */
if( !function_exists('agni_thumbnail_customcrop') ){
    function agni_thumbnail_customcrop( $img_id = null, $img_size = null, $img_class = null ){
        $portfolio_thumbnail = '';
        if( function_exists('wpb_getImageBySize') ){
            $img = wpb_getImageBySize( array(
                'attach_id' => $img_id,
                'thumb_size' => $img_size,
                'class' => $img_class.' attachment-'.$img_size
            ) );
            $portfolio_thumbnail = $img['thumbnail'];
        }   
        return $portfolio_thumbnail;
    }
}

/**
 * Portfolio filter
 */
if( !function_exists('agni_portfolio_filter') ){
    function agni_portfolio_filter( $term_order, $term_orderby, $filter_all_text ){
        global $fortun_options, $category;
        $output = '';
        $categories = explode( ',', $category );
        $terms = get_terms( 'types', array( 'orderby' => $term_orderby, 'order' => $term_order ) );
        $count = count($terms);
        $output .= '<span class="filter-button" ><i class="pe-7f-filter"></i></span><ul id="filters" class="filter list-inline">';
        $output .= '<li><a class="active" href="#all" data-filter=".all" title="">'.$filter_all_text.'</a></li>';
        if ( $count > 0 ){   
            foreach ( $terms as $term ) {   
                foreach ($categories as $cat) {
                    if(empty($cat)){ 
                        $termslug = strtolower($term->slug);
                        $output .= '<li><a href="#'.$termslug.'" data-filter=".'.$termslug.'" title="">'.$term->name.'</a></li>';
                    }
                    else if( $cat == $term->slug ){
                        $termslug = strtolower($term->slug);
                        $output .= '<li><a href="#'.$termslug.'" data-filter=".'.$termslug.'" title="">'.$term->name.'</a></li>';
                    }
                }
            }
        }
        $output .= '</ul>';
        return $output;
    }
}

/*
 * Breadcrumbs
 */
if( !function_exists('agni_breadcrumb_navigation') ){
    function agni_breadcrumb_navigation() {
        $delimiter = ' / ';
        $home = esc_html( get_bloginfo('name') );
        $before = '<span>';
        $after = '</span>';
        
        echo '<p class="breadcrumb">';
        
        global $post;
        
        $homeLink = esc_url( home_url( '/' ) );

        echo '<a href="' . $homeLink . '">'.esc_html__( 'Home', 'fortun' ).'</a> ' . $delimiter .' ';

        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo wp_kses_post( $before . single_cat_title('', false)  . $after );
        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo wp_kses_post( $before  . get_the_time('d')  . $after );
        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo wp_kses_post( $before  . get_the_time('F')  . $after );
        } elseif ( is_year() ) {
            echo wp_kses_post( $before . get_the_time('Y')  . $after );
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter . ' ';
                echo wp_kses_post( $before . get_the_title() . $after );
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                echo ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . ' ';
                echo wp_kses_post( $before  . get_the_title()  . $after );
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo wp_kses_post( $before . $post_type->labels->singular_name . $after );
        } elseif ( is_attachment() ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id    = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
            echo wp_kses_post( $before . get_the_title()  . $after );
        } elseif ( is_page() && !$post->post_parent ) {
            echo wp_kses_post( $before  . get_the_title()  . $after );
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id    = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
            echo wp_kses_post( $before . get_the_title()  . $after );
        } elseif ( is_search() ) {
            echo wp_kses_post( $before . get_search_query()  . $after );
        } elseif ( is_tag() ) {
            echo wp_kses_post( $before. single_tag_title('', false)  . $after );
        } elseif ( is_author() ) {
        global $author;
            $userdata = get_userdata($author);
            echo wp_kses_post( $before . $userdata->display_name  . $after );
        } elseif ( is_404() ) {
            echo wp_kses_post( $before . ' 404 ' . $after );
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo ('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</p>';
    }
}

/**
 * Getting Posts from the posttype
 */
if( !function_exists('agni_posttype_options') ){
    function agni_posttype_options( $query_args, $empty, $vc = null  ) {
        $post_options = array();
        $args = wp_parse_args( $query_args, array(
            'post_type'   => 'post',
            'numberposts' => -1,
        ) );

        $posts = get_posts( $args );
        if( $empty == true ){
            $post_options = array("" => "");
        }
        if ( $posts ) {
            foreach ( $posts as $post ) {
                if( $vc == true ){
                    $post_options[ $post->post_title ] = $post->ID;
                }else{
                    $post_options[ $post->ID ] = $post->post_title;
                }
            }

        }
        return $post_options;
    }
}

/**
 * Getting Registered Menus
 */
if( !function_exists('agni_registered_menus') ){
    function agni_registered_menus( $empty ) {
        $menu_list = '';
        if( $empty == true ){
            $menu_list = array("" => "Inherit");
        }
        $menus = get_terms('nav_menu', array( 'hide_empty' => true ));
        foreach($menus as $menu){
          $menu_list[ $menu->slug ] = $menu->name;
        } 
        return $menu_list;
    }
}

// New shortcode column for Agni Slider posttype
function agni_agni_slides_columns_head($defaults) {
    $defaults['agni_slides_shortcode'] = 'Shortcode';
    return $defaults;
}
 
function agni_agni_slides_columns_content($column_name) {
    global $post;
    if ($column_name == 'agni_slides_shortcode') {
        echo '<pre><code>[agni_agnislider post_id = '.$post->ID.']</code></pre>';
    }
}

add_filter( 'manage_agni_slides_posts_columns', 'agni_agni_slides_columns_head' );
add_action( 'manage_agni_slides_posts_custom_column', 'agni_agni_slides_columns_content', 10, 1 );

/**
 * Post Format functions
 */

// Video post
if( !function_exists('agni_post_video') ){
    function agni_post_video( $post ){
        $output = '';
        $post_video_url = esc_url( get_post_meta($post, 'post_format_video_url' , true) );
        $post_video_poster = esc_url( get_post_meta($post, 'post_format_video_poster' , true) );
        $post_video_embed_url = get_post_meta($post, 'post_format_video_embed_url' , true);
        
        if(!empty($post_video_url)){
            $output = '<div class="post-video">'.do_shortcode('[video width="740" mp4="'.$post_video_url.'" webm="'.$post_video_url.'" ogv="'.$post_video_url.'" mov="'.$post_video_url.'" poster="'.$post_video_poster.'"][/video]').'</div>';
        }
        elseif(!empty($post_video_embed_url)){
            $output = '<div class="custom-video embed-responsive embed-responsive-16by9">'.$post_video_embed_url.'</div>';
        }
            
        return $output; 
    }
}

// Audio post
if( !function_exists('agni_post_audio') ){
    function agni_post_audio( $post){   
        $output = '';
        $post_audio_url = esc_url( get_post_meta($post, 'post_format_audio_url' , true) );
        if(!empty($post_audio_url)){
            $output = '<div class="post-format-indent">'.do_shortcode('[audio mp3="'.$post_audio_url.'" ogg="'.$post_audio_url.'" wmv="'.$post_audio_url.'" ][/audio]').'</div>';
        }

        return $output; 
    }
}

// Gallery post
if( !function_exists('agni_post_gallery') ){
    function agni_post_gallery($post){
        $post_media_gallery_id = $prefix = $output = '';

        $post_gallery_image = get_post_meta( $post, 'post_format_gallery_image', true );
        foreach ( (array) $post_gallery_image as $attachment_id => $attachment_url ) {
            $post_media_gallery_id .= $prefix.$attachment_id;
            $prefix = ',';
        }
        $output = do_shortcode('[agni_gallery img_url="'.$post_media_gallery_id.'" type="1" column="1" gallery_pagination=""]');
        return $output;
    }
}

// Link post
if( !function_exists('agni_post_link') ){
    function agni_post_link( $post ){
        $output = '';
        $post_link_text = esc_url( get_post_meta($post, 'post_format_link_url' , true) );   
        if( !empty($post_link_text) ){
            $output = '<div class="post-format-indent"><a class="post-format-link additional-heading" href="'.$post_link_text.'">'.$post_link_text.'</a></div>';
        }

        return $output;
    }
}

// Quote post
if( !function_exists('agni_post_quote') ){
    function agni_post_quote( $post ){
        $output = $cite = '';
        $post_quote_text = esc_attr( get_post_meta($post, 'post_format_quote_text' , true) );
        $post_quote_cite = esc_attr( get_post_meta($post, 'post_format_quote_cite' ,true) );
        
        if(!empty($post_quote_cite)){
            $cite = '<h6 class="quote-cite ">&nbsp;&mdash;&nbsp;'.$post_quote_cite.'</h6>';
        }
        if( !empty( $post_quote_text ) ){
            $output = '
                <div class="post-format-indent">
                    <p class="post-format-quote additional-heading">' . $post_quote_text .'</p>'. $cite . '
                </div>
            ';
        }
        return $output;
    }
}


// Filters of Agni Slider H tags
add_filter( 'agni_page_header_h_tag', 'fortun_agni_slider_h_tag', 999 );
add_filter( 'agni_slider_h_tag', 'fortun_agni_slider_h_tag', 999 );
function fortun_agni_slider_h_tag($args){
    return 'h2';
}


// Header 
if( !function_exists('agni_header') ){
function agni_header(){ 
    global $fortun_options; 
    $page_id = get_the_ID();
    if( function_exists('is_shop') && is_shop() ){
        $page_id = wc_get_page_id('shop');
    }


    $header_custom_menu_choice =  esc_attr( get_post_meta( $page_id, 'page_menu_choice', true ) );
    $header_transparent = esc_attr( get_post_meta( $page_id, 'page_transparent', true ) );
    $header_menu_fullwidth = esc_attr( get_post_meta( $page_id, 'page_menu_fullwidth', true ) );
    $footer_text_choice = esc_attr( get_post_meta( $page_id, 'page_footer_text', true ) );

    if( $header_transparent == '' ){
        $header_transparent = esc_attr( $fortun_options['header-bg-transparent'] );
    }
    if( $header_menu_fullwidth == '' ){
        $header_menu_fullwidth = esc_attr( $fortun_options['fullwidth-header-menu'] );
    }
    if( $footer_text_choice == '' ){
        $footer_text_choice = esc_attr( $fortun_options['footer-text-choice'] );
    }

    // Logo choice  
    if( esc_attr( get_post_meta( $page_id, 'page_skin_reverse', true ) ) == 'on' ){
        $logo_1_class = 'logo-additional';
        $logo_2_class = 'logo-main';
        $reverse_skin = 'reverse_skin';
    }
    else {
        $logo_1_class = 'logo-main';
        $logo_2_class = 'logo-additional';
        $reverse_skin = '';
    }
    
    // WPML Lang bar  
    if ( function_exists('icl_object_id') ) {
        function agni_wpml_languages_bar(){
            $languages = icl_get_languages('skip_missing=0');
            if(1 < count($languages)){
                echo '<div class="header-toggle header-lang-toggle header-wpml-toggle toggle-circled">';
                foreach($languages as $l){
                    if($l['active']) echo '<span>'.$l['translated_name'].'</span>';
                }
                echo '<ul>';
                foreach($languages as $l){
                    if(!$l['active']) echo '<li><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
                }
                echo '</ul></div>';
            }
        }
    }

    // Header Menu 
    function agni_nav_menu( $menu_class, $menu_id, $page_id ){
        $header_custom_menu_choice =  esc_attr( get_post_meta( $page_id, 'page_menu_choice', true ) );
        ob_start();
            wp_nav_menu( array( 'menu' => $header_custom_menu_choice, 'menu_class' => $menu_class, 'menu_id' => $menu_id, 'container' => false, 'theme_location' => 'primary', 'fallback_cb'     => 'wp_page_menu' ) ); 
            $header_menu = ob_get_contents();
        ob_end_clean();

        return $header_menu;
    }

    // Additional Classes
    function agni_additional_body_classes( $classes ) {
        global $fortun_options;

        $page_id = get_the_ID();
        if( function_exists('is_shop') && is_shop() ){
            $page_id = wc_get_page_id('shop');
        }

        $page_dark_mode = esc_attr( get_post_meta( $page_id, 'page_dark_mode', true ) );
        
        if( $fortun_options['layout-padding'] == '1' ){ $classes[] = 'has-padding'; }
        if( $fortun_options['header-menu-style'] == 'side-header-menu' ){ $classes[] = 'has-side-header'; }
        if( $page_dark_mode == '' ){
            $page_dark_mode = ( $fortun_options['dark-mode'] == '1' )?'1':'';
        }
        if( $page_dark_mode == '1' ){ 
            $classes[] = 'has-dark-mode'; 
        }
        if( $fortun_options['animation-mobile'] == '1' ){ $classes[] = 'has-animation-mobile'; }
        if( $fortun_options['parallax-mobile'] == '1' ){ $classes[] = 'has-parallax-mobile'; }
              
        return $classes;
    }
    add_filter( 'body_class','agni_additional_body_classes' );

    ?>
    <body <?php if( $fortun_options['parallax-mobile'] == '1' ){ echo 'id="skrollr-body"'; } ?> <?php body_class(); ?>>

        <?php 
        // Header Icon  
        ob_start(); ?>  
            <div class="header-icon <?php if( !empty($fortun_options['logo-2']['url']) ){ echo 'header-icon-additional-logo '; }?><?php if( !empty($fortun_options['header-logo-bg-color-2']) ){ echo 'header-logo-additional-bg-color'; }?>">
                <?php  if(!empty($fortun_options['logo-1']['url']) && $fortun_options['header-site-title'] == '0'){  ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-icon <?php echo esc_attr($logo_1_class); ?>"><img src="<?php echo esc_html($fortun_options['logo-1']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a><?php 
                }

                if (!empty($fortun_options['logo-2']['url']) && $fortun_options['header-site-title'] == '0' ) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-icon <?php echo esc_attr($logo_2_class); ?>"><img src="<?php echo esc_html($fortun_options['logo-2']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a><?php 
                }
                if ($fortun_options['header-site-title'] == '1' ) { ?>
                    <div class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text <?php echo esc_attr($logo_1_class); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-text <?php echo esc_attr($logo_2_class); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                    </div>
                    <?php if( $fortun_options['logo-description'] == '1' ){ ?>
                        <div class="site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
                    <?php } ?>
                <?php }  ?>
            </div>
        <?php $header_logo = ob_get_contents();
        ob_end_clean(); 

        // Header Social media items  
        ob_start(); ?>  
            <?php if( $fortun_options['social-media-header-style'] == 'minimal' ){?>
                <div class="header-toggle header-social-toggle text-center">
                    <span><i class="pe-7s-share"></i></span> 
            <?php } else{ ?>
                <div class="header-social">
            <?php } ?>
                    <ul class="social-icons list-inline">
                        <?php if( $fortun_options['social-media-header'] == '1' ){ 
                            foreach( $fortun_options['social-media-icons-header'] as $social_checkbox => $social_icons ){
                                if( $social_icons == '1' ){ ?>
                                    <li><a target="<?php echo esc_attr($fortun_options['header-link-target']);?>" href="<?php echo esc_url($fortun_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
                                <?php }
                            } 
                        }?>   
                    </ul>
                </div>
                <div class="header-toggle tab-header-social-toggle header-social-toggle tab-social-header text-center">
                    <span><i class="pe-7s-share"></i></span> 
                    <ul class="social-icons list-inline">
                        <?php if( $fortun_options['social-media-header'] == '1' ){ 
                            foreach( $fortun_options['social-media-icons-header'] as $social_checkbox => $social_icons ){
                                if( $social_icons == '1' ){ ?>
                                    <li><a target="<?php echo esc_attr($fortun_options['header-link-target']);?>" href="<?php echo esc_url($fortun_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
                                <?php }
                            }
                        }?>   
                    </ul>
                </div>
        <?php $header_social = ob_get_contents();
        ob_end_clean();

        // Header Additional items(including social icons)
        ob_start(); 
            if( $fortun_options['header-cart-box'] == '1' ){ 
                if(is_plugin_active( 'woocommerce/woocommerce.php')){?> 
                    <div class="header-cart-toggle header-toggle">
                        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart', 'fortun' ); ?>"><?php if($fortun_options['header-cart-amount'] == '1'){ echo WC()->cart->get_cart_total(); } ?><span class="header-toggle"><span class="header-cart-icon"><i class="pe-7s-shopbag"></i></span><span class="product-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'fortun' ), WC()->cart->cart_contents_count ); ?></span></span></a>
                        <?php if($fortun_options['header-menu-style'] != 'side-header-menu'){ the_widget( 'WC_Widget_Cart' ); } ?>
                    </div>
                <?php } 
            } 
            if( $fortun_options['header-wishlist-box'] == '1' ){ 
                if(is_plugin_active( 'woocommerce/woocommerce.php') && is_plugin_active( 'yith-woocommerce-wishlist/init.php')){ ?> 
                    <div class="header-wishlist-toggle header-toggle">
                        <a class="wishlist-url" href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>"><span><i class="pe-7s-like"></i></span></a>
                    </div>
                <?php } 
            } 
            if( $fortun_options['header-lang-box'] == '1' ){ ?>
                <div class="header-toggle header-lang-toggle">
                    <span><?php echo htmlspecialchars_decode( esc_html($fortun_options['header-lang-name']) ); ?></span>
                    <?php echo htmlspecialchars_decode( esc_html($fortun_options['header-lang-list']) ); ?>
                </div>
            <?php } 
            if( $fortun_options['header-wpml-box'] == '1' && function_exists('agni_wpml_languages_bar') ){
                echo agni_wpml_languages_bar(); 
            }
            if( $fortun_options['header-search-box'] == '1' ){ ?>
                <div class="header-toggle header-search-toggle" >
                    <span class="active"><i class="pe-7s-search"></i></span>
                    <span><i class="pe-7s-close"></i></span>
                </div>
            <?php }
            if( $fortun_options['social-media-header'] == '1' && $fortun_options['social-media-header-location'] == '1' ){ 
                echo wp_kses_post( $header_social ); 
            }

        $header_menu_icons = ob_get_contents();
        if( !empty($header_menu_icons) ){
            $header_menu_icons_additional_color = ( !empty($fortun_options['header-icon-link-color-2']) )?'header-menu-icons-additional-color':'';
            $header_menu_icons = '<div class="header-menu-icons '.$header_menu_icons_additional_color.'">'.$header_menu_icons.'</div>';
        }
        ob_end_clean();

        ob_start(); ?>  
            <nav class="footer-nav-menu additional-nav-menu" >
                <?php  wp_nav_menu(array( 'menu_class' => 'footer-nav-menu-content list-inline', 'menu_id' => 'footer-navigation-additional', 'container' => false, 'theme_location' => 'ternary', 'fallback_cb'     => '' ) ); ?> 
            </nav>
        <?php $footer_nav = ob_get_contents();
        ob_end_clean(); 

        ob_start(); ?>  
            <div class="footer-social">
                <ul class="social-icons list-inline">
                    <?php if( $fortun_options['social-media-footer'] == '1' ){ 
                        foreach( $fortun_options['social-media-icons-footer'] as $social_checkbox => $social_icons ){
                            if( $social_icons == '1' ){ ?>
                                <li><a class="<?php echo esc_attr($fortun_options['social-media-style']); ?>" target="<?php echo esc_attr($fortun_options['footer-link-target']);?>" href="<?php echo esc_url($fortun_options[ $social_checkbox .'-link' ]);?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox); ?>"></i></a></li>
                            <?php }
                        }
                    }?>   
                </ul>
            </div>
        <?php $footer_social = ob_get_contents();
        ob_end_clean(); 

        ob_start(); ?>  
            <div class="footer-text"><?php echo esc_html( $fortun_options['footer-text'] );?></div>
        <?php $footer_text = ob_get_contents();
        ob_end_clean(); ?>

        <div class="top-padding"></div>
        <div class="bottom-padding"></div>
        <?php if( $fortun_options['backtotop'] == '1' ){ ?>
            <div id="back-to-top" class="back-to-top"><a href="#back-to-top"><i class="<?php echo esc_attr($fortun_options['backtotop-icon']); ?>"></i></a></div>
        <?php } ?>

        <div id="page" class="hfeed site wrapper <?php if( $fortun_options['layout-boxed'] == '1' ){ echo 'boxed'; } ?> ">
            <header id="masthead" class="site-header" role="banner">            
                <!-- Header -->  
                <?php if( $fortun_options['header-top-bar'] == '1' && $fortun_options['header-menu-style'] != 'side-header-menu' ){ ?>
                    <div class="header-top-bar <?php 
                        if( $header_menu_fullwidth == '1'){ echo 'fullwidth-header-menu '; } ?><?php 
                        if( $header_transparent == '1' ){ echo 'transparent-header-menu '; } ?><?php 
                        if( $fortun_options['header-sticky'] == '1' ){ echo 'top-sticky '; } ?>" <?php 
                        if( $header_transparent == '1' ){ echo 'data-transparent="1" '; } ?><?php 
                        if( $fortun_options['header-sticky'] == '1' ){ echo 'data-sticky="1" '; } ?><?php 
                        if( $fortun_options['shrink-header-menu'] == '1' ){ echo 'data-shrink="1" '; } ?>>
                        <div class="container<?php if( $header_menu_fullwidth == '1'){ echo '-fluid'; } ?>">
                            <?php if( !empty($fortun_options['header-top-email']) ){ ?><span class="top-bar-email"><i class="fa fa-envelope-o"></i><?php echo wp_kses( $fortun_options['header-top-email'], array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></span><?php } ?>
                            <?php if( !empty($fortun_options['header-top-number']) ){ ?><span class="top-bar-number"><i class="fa fa-mobile-phone"></i><?php echo wp_kses( $fortun_options['header-top-number'], array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></span><?php } ?>
                            <?php if( $fortun_options['social-media-header'] == '1' && $fortun_options['social-media-header-location'] == '2' ){ echo wp_kses_post( $header_social ); }?>
                            <?php if( $fortun_options['top-bar-nav'] == '1' ){ ?>
                                <nav class="top-nav-menu additional-nav-menu" >
                                    <?php  // Top Bar Menu   
                                    wp_nav_menu(array( 'menu_class' => 'top-nav-menu-content list-inline', 'menu_id' => 'top-navigation', 'container' => false, 'theme_location' => 'secondary', 'fallback_cb'     => 'wp_page_menu' ) ); ?> 
                                </nav>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="header-navigation-menu <?php 
                    echo esc_attr($fortun_options['header-menu-style']).' '; ?><?php
                    if( $fortun_options['header-menu-style'] == 'strip-header-menu'){ echo 'side-header-menu '; } ?><?php 
                    if( $header_menu_fullwidth == '1'){ echo 'fullwidth-header-menu '; } ?><?php 
                    if( $header_transparent == '1' ){ echo 'transparent-header-menu '; } ?><?php 
                    if( $fortun_options['shrink-header-menu'] == '1' ){ echo 'shrink-header-menu '; } ?><?php 
                    if( $fortun_options['header-sticky'] == '1' ){ echo 'header-sticky '; } ?><?php 
                    if( !empty($fortun_options['header-menu-bg-color-2']) ){ echo 'header-additional-bg-color '; }?><?php 
                    if( !empty($fortun_options['header-menu-border-2']) ){ echo 'header-menu-border-additional '; }?><?php 
                    if( $fortun_options['header-menu-button'] == '1' ){ echo 'has-menu-button '; }?><?php
                    echo esc_attr($reverse_skin); 
                    ?> clearfix" <?php 
                    if( $header_transparent == '1' ){ echo 'data-transparent="1" '; }  ?><?php
                    if( $fortun_options['header-sticky'] == '1' ){ echo 'data-sticky = "1" '; 
                        if( $fortun_options['header-sticky-fancy'] == '1' ){
                            echo 'data-sticky-fancy = "1" ';
                        }
                    } ?><?php
                    if( $fortun_options['shrink-header-menu'] == '1' ){ echo 'data-shrink="1"'; } ?>>
                    <div class="header-navigation-menu-container <?php echo esc_attr( $fortun_options['header-menu-style'] ).'-container'; ?> ">
                        <?php if( in_array( $fortun_options['header-menu-style'], array( 'center-header-menu', 'side-header-menu', 'strip-header-menu' ) ) ) { echo wp_kses_post( $header_logo ); }?>
                        <div class="header-menu-content">
                            <div class="container<?php if( $header_menu_fullwidth == '1'){ echo '-fluid'; } ?>">
                                <div class="header-menu-flex <?php echo ( !empty($fortun_options['header-menu-style-default-choice'] ))?$fortun_options['header-menu-style-default-choice']:'right'; ?>-menu-flex <?php echo esc_attr( $fortun_options['header-menu-style-choice-order'] ); ?>">
                                    <?php if( in_array( $fortun_options['header-menu-style'], array( 'default-header-menu', 'minimal-header-menu', 'side-header-menu', 'strip-header-menu', 'border-header-menu' ) ) || empty($fortun_options) ){ 
                                        echo wp_kses_post( $header_logo ); 
                                    }?>
                                    <div class="header-menu clearfix">
                                        <?php if( $fortun_options['header-menu-style'] != 'minimal-header-menu'){ ?>
                                            <nav class="nav-menu <?php if( !empty($fortun_options['header-menu-link-color-2']) ){ echo 'nav-menu-additional-color '; }?>page-scroll" >
                                                <?php // Main Nav menu  
                                                    echo agni_nav_menu( 'nav-menu-content', 'navigation', $page_id );
                                                ?> 
                                            </nav>  
                                        <?php } ?>
                                        <div class="header-menu-toggle-container">
                                            <div class="tab-header-menu-toggle header-menu-toggle toggle-nav-menu <?php if( !empty($fortun_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>">
                                                <div class="burg-icon"><a href="#"><div class="burg"></div></a></div>
                                            </div> 
                                            <?php if( $fortun_options['header-menu-style'] == 'minimal-header-menu'){ ?>
                                                <div class="header-menu-toggle toggle-nav-menu <?php if( !empty($fortun_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>"><?php if( !empty($fortun_options['header-menu-name']) ){ ?><div class="burg-text"><?php echo esc_attr($fortun_options['header-menu-name']); ?></div><?php } if( $fortun_options['header-menu-burg'] == '1' ){ ?><div class="burg-icon"><a href="#"><div class="burg"></div></a></div><?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="header-menu-icons-container">
                                        <?php echo wp_kses_post( $header_menu_icons );  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav class="tab-nav-menu tab-invisible page-scroll">
                            <?php // Mobile Nav menu  
                            echo agni_nav_menu( 'tab-nav-menu-content container-fluid', 'tab-navigation', $page_id );
                            ?>
                        </nav>
                        <?php if( $fortun_options['header-menu-style'] == 'side-header-menu' || $fortun_options['header-menu-style'] == 'strip-header-menu' ){ 
                            echo wp_kses_post( $header_menu_icons ); ?>
                            <div class="site-info">
                                <?php if(!empty($fortun_options['footer-logo']['url'])){  ?>
                                    <div class="footer-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($fortun_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
                                <?php }  ?>
                                <div class="footer-content side-footer-content style-1">
                                    <?php if( $fortun_options['footer-nav'] == '1' ){ echo agni_footer_nav(); } 
                                    if( $fortun_options['social-media-footer'] == '1'){ echo agni_footer_social(); }
                                    if( !empty($fortun_options['footer-text']) ){ echo agni_footer_text(); } ?>
                                </div>
                            </div><!-- .site-info -->
                        <?php  } ?>
                    </div>
                    <?php if( $fortun_options['header-search-box'] == '1' ){ ?>
                        <div class="header-search search-invisible">
                            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="search-form"><input id="search" name="s" type="text" size="40" placeholder="<?php echo esc_attr($fortun_options['header-search-box-text']); ?>" /></form>
                        </div>
                    <?php } ?>
                    <?php if( $fortun_options['header-menu-style'] == 'strip-header-menu' ){ ?>
                        <div class="strip-header-bar">
                            <div class="strip-header-logo"><?php echo wp_kses_post( $header_logo ); ?></div>
                            <div class="strip-header-toggle">
                                <div class="header-menu-toggle strip-header-menu-toggle <?php if( !empty($fortun_options['header-menu-link-color-2']) ){ echo 'toggle-nav-menu-additional '; }?>"><?php if( !empty($fortun_options['header-menu-name']) ){ ?><div class="burg-text" data-burg-text="<?php echo esc_attr($fortun_options['header-menu-name']); ?>" data-burg-text-active="<?php echo esc_attr($fortun_options['header-menu-name-active']); ?>"><?php echo esc_attr($fortun_options['header-menu-name']); ?></div><?php } if( $fortun_options['header-menu-burg'] == '1' ){ ?><div class="burg-icon"><a href="#"><div class="burg"></div></a></div><?php } ?>
                                </div>
                            </div>
                            <div class="strip-header-social-icon">
                                <?php echo wp_kses_post( $header_menu_icons ); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if( $footer_text_choice == '1' && $fortun_options['header-menu-style'] == 'border-header-menu' ){ ?>
                    <div class="site-info <?php echo esc_attr( $fortun_options['header-menu-style'] ); ?>-footer">
                        <div class="container<?php if( $fortun_options['footer-fullwidth'] == '1' ){ echo '-fluid'; }?>">
                            <?php if(!empty($fortun_options['footer-logo']['url'])){  ?>
                                <div class="footer-logo <?php echo esc_attr($fortun_options['footer-style']);?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($fortun_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
                            <?php }  ?>
                            <div class="footer-content border-footer-content <?php echo esc_attr($fortun_options['footer-style']);?>">
                                <?php if($fortun_options['footer-style'] == 'style-1' ){ 
                                    if( !empty($fortun_options['footer-text']) ){ 
                                        echo '<div class="footer-text-container">'.agni_footer_text().'</div>';
                                    } 
                                    if( !empty($fortun_options['social-media-footer']) ){ 
                                        echo '<div class="footer-social-container">'. agni_footer_social() .'</div>';
                                    } 
                                    if( !empty($fortun_options['footer-nav']) ){ 
                                        echo '<div class="footer-menu-container">'.agni_footer_nav().'</div>';
                                    } 
                                } ?>
                            </div>
                        </div>
                    </div><!-- .site-info -->
                    <div class="<?php echo esc_attr( $fortun_options['header-menu-style'] ); ?>-right"></div>
                    <div class="<?php echo esc_attr( $fortun_options['header-menu-style'] ); ?>-left"></div>
                <?php  } ?>
            </header><!-- #masthead -->
            <div class="spacer"></div>
    
            <div id="content" class="site-content content <?php echo esc_attr($fortun_options['header-menu-style']).'-content'; ?>">
        <?php } 
}

// Footer nav
if( !function_exists('agni_footer_nav') ){
    function agni_footer_nav(){
        ob_start(); ?>  
            <nav class="footer-nav-menu additional-nav-menu" >
                <?php  wp_nav_menu(array( 'menu_class' => 'footer-nav-menu-content list-inline', 'menu_id' => 'footer-navigation', 'container' => false, 'theme_location' => 'ternary', 'fallback_cb'     => '' ) ); ?> 
            </nav>
        <?php $footer_nav = ob_get_contents();
        ob_end_clean(); 

        return $footer_nav;
    } 
}

// Footer social
if( !function_exists('agni_footer_social') ){
    function agni_footer_social(){
        global $fortun_options;
        ob_start(); ?>  
            <div class="footer-social">
                <ul class="social-icons list-inline">
                    <?php if( $fortun_options['social-media-footer'] == '1' ){ 
                        foreach( $fortun_options['social-media-icons-footer'] as $social_checkbox => $social_icons ){
                            if( $social_icons == '1' ){ ?>
                                <li><a class="<?php echo esc_attr($fortun_options['social-media-style']); ?>" target="<?php echo esc_attr($fortun_options['footer-link-target']);?>" href="<?php echo esc_url( $fortun_options[ $social_checkbox .'-link' ] );?>"> <i class="fa fa-<?php echo esc_attr($social_checkbox);?>"></i></a></li>
                            <?php }
                        }
                    }?>   
                </ul>
            </div>
        <?php $footer_social = ob_get_contents();
        ob_end_clean();

        return $footer_social;
    }
}

// Footer text
if( !function_exists('agni_footer_text') ){
    function agni_footer_text(){
        global $fortun_options;
        ob_start(); ?>  
            <div class="footer-text"><?php echo wp_kses_post( $fortun_options['footer-text'] );?></div>
            <?php $footer_text = ob_get_contents();
        ob_end_clean(); 
        return $footer_text;
    }
}

// Footer
if( !function_exists('agni_footer') ){
    function agni_footer(){ 
        global $fortun_options;
        $page_id = get_the_ID();

        $footer_bar =  esc_attr( get_post_meta( $page_id, 'page_footer_bar', true ) );
        $footer_bar_choice = esc_attr( get_post_meta( $page_id, 'page_footer_bar_choice', true ) );
        $footer_bar_contentblock = esc_attr( get_post_meta( $page_id, 'page_footer_bar_contentblock', true ) );
        $footer_bar_fullwidth = esc_attr( get_post_meta( $page_id, 'page_footer_bar_fullwidth', true ) );
        $footer_text_choice = esc_attr( get_post_meta( $page_id, 'page_footer_text', true ) );
        
        if( $footer_bar == '' ){
            $footer_bar = esc_attr( $fortun_options['footer-bar'] );
            $footer_bar_choice = esc_attr( $fortun_options['footer-bar-choice'] );
            $footer_bar_contentblock = (!empty($fortun_options['footer-contentblock-choice']))?$fortun_options['footer-contentblock-choice']:'';
        }
        if( $footer_bar_fullwidth == '' ){
            $footer_bar_fullwidth = esc_attr( $fortun_options['footer-bar-fullwidth'] );
        }
        if( $footer_text_choice == '' ){
            $footer_text_choice = esc_attr( $fortun_options['footer-text-choice'] );
        } ?>    
        
        <footer class="site-footer<?php if( $fortun_options['footer-sticky'] == '1' ){ echo ' has-sticky-footer'; } ?>" role="contentinfo">
            <div class="site-info">
                <?php if( $footer_bar == '1' ){ ?>
                    <div id="footer-bar-area" class="footer-bar">
                        <div class="container<?php if( $footer_bar_fullwidth == '1' ){ echo '-fluid'; }; ?>">  
                            <?php if( $footer_bar_choice == '0' ){ ?>         
                                <div class="footer-widget-row row">
                                <?php if ( is_active_sidebar( 'fortun-footerbar-1' )  ){ 
                                    dynamic_sidebar( 'fortun-footerbar-1' ); 
                                } ?>
                                </div>
                            <?php } 
                            else{ ?>
                                <div class="footer-content-block">
                                <?php if( !empty($footer_bar_contentblock) ){
                                    echo do_shortcode('[agni_block post_id="'.$footer_bar_contentblock.'"]');
                                } ?>
                               </div>
                            <?php }?>
                        </div>
                    </div>
                <?php } ?>
                <?php if( $footer_text_choice == '1' ){ ?>
                    <div id="footer-colophon" class="footer-colophon">
                        <div class="container<?php if( $fortun_options['footer-fullwidth'] == '1' ){ echo '-fluid'; }?>">
                            <?php if(!empty($fortun_options['footer-logo']['url'])){  ?>
                                <div class="footer-logo <?php echo esc_attr($fortun_options['footer-style']);?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" ><img src="<?php echo esc_url($fortun_options['footer-logo']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
                            <?php }  ?>
                            <div class="footer-content <?php echo esc_attr($fortun_options['footer-style']);?>">
                                <?php if($fortun_options['footer-style'] == 'style-1' ){ 
                                    if( !empty($fortun_options['footer-text']) ){ 
                                        echo '<div class="footer-text-container">'.agni_footer_text().'</div>';
                                    } 
                                    if( !empty($fortun_options['social-media-footer']) ){ 
                                        echo '<div class="footer-social-container">'. agni_footer_social() .'</div>';
                                    } 
                                    if( !empty($fortun_options['footer-nav']) ){ 
                                        echo '<div class="footer-menu-container">'.agni_footer_nav().'</div>';
                                    } 
                                }
                                else{  
                                    if( $fortun_options['footer-nav'] == '1' ){ echo agni_footer_nav(); } 
                                    if( $fortun_options['social-media-footer'] == '1'){ echo agni_footer_social(); }
                                    if( !empty($fortun_options['footer-text']) ){ echo agni_footer_text(); }
                                } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </footer><!-- .site-footer -->
    <?php }
}

// Preloader
if( !function_exists('agni_preloader') ){
    function agni_preloader(){
        global $fortun_options; 

        if( $fortun_options['loader'] == '1' ){ 
            if( $fortun_options['loader-close'] == '1' ){
                $loader_close = 'false';
            }else{
                $loader_close = 'true';
            } 
            ?>
            <div id="preloader-<?php echo esc_attr($fortun_options['loader-style']); ?>" class="preloader preloader-style-<?php echo esc_attr( $fortun_options['loader-style'] ); ?>" data-preloader="<?php echo esc_attr($fortun_options['loader']); ?>" data-preloader-style="<?php echo esc_attr($fortun_options['loader-style']); ?>" <?php if( $fortun_options['loader-style'] == '1' ){ echo 'data-close-button="'.$loader_close.'" data-close-button-text="'.esc_attr($fortun_options['loader-close-button-text']).'"'; } ?>>
                <?php if( $fortun_options['loader-style'] == '2' ){ ?>
                    <div class="preloader-container">
                        <div class="preloader-content">
                            <div class="cssload-loader"></div>
                        </div>
                    </div>
                <?php  }
                else if( $fortun_options['loader-style'] == '3' ){ ?>
                    <div class="preloader-container">
                        <div class="cssload-loader">
                            <div class="cssload-flipper">
                                <div class="cssload-front"></div>
                                <div class="cssload-back"></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div><!-- #preloader -->
        <?php } 
    }
}

// Page 
if( !function_exists('agni_page') ){
    function agni_page(){
        global $fortun_options, $post;

        $page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
        $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
        $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
        $page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );
        $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

        if( $page_remove_title == '' ){
            $page_remove_title = esc_attr( $fortun_options['page-remove-title'] );
        }
        if( $page_title_align == '' ){
            $page_title_align = esc_attr( $fortun_options['page-title-align'] );
        }

        if( $page_layout == '' ){
            if( !empty($fortun_options['page-layout']) ){
                $page_layout = esc_attr( $fortun_options['page-layout'] );
            }
            else{
                $page_layout = 'container';
            }
        }

        if( $page_sidebar == '' ){
            $page_sidebar = esc_attr( $fortun_options['page-sidebar'] );
        }

    ?>
    <div class="page-layout <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
        <div class="page-container <?php echo esc_attr( $page_layout ); ?>">
            <div class="page-row row <?php 
                echo esc_attr( $page_sidebar );
                if( $page_remove_title != '1' ){ echo ' has-title has-margin'; } 
            ?> ">

                <?php function agni_page_content(){
                    global $fortun_options, $post;

                    $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
                    $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
                    $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

                    if( $page_remove_title == '' ){
                        $page_remove_title = esc_attr( $fortun_options['page-remove-title'] );
                    }
                    if( $page_title_align == '' ){
                        $page_title_align = esc_attr( $fortun_options['page-title-align'] );
                    }
                    if( $page_sidebar == '' ){
                        $page_sidebar = esc_attr( $fortun_options['page-sidebar'] );
                    }

                    ob_start(); ?>
                    <div class="page-column page-content col-sm-12 col-md-<?php if( $page_sidebar != 'no-sidebar' ){ echo '9'; }else{ echo '12'; } ?>">
                        <div id="primary" class="primary content-area">
                            <main id="main" class="site-main">

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <?php if( $page_remove_title != '1' ){ ?>
                                            <div class="entry-header">
                                                <?php the_title( '<h1 class="entry-title text-'.$page_title_align.'">', '</h1>' ); ?>
                                            </div><!-- .entry-header -->
                                        <?php } ?>
                                        <div class="entry-content">
                                            <?php the_content(); ?>
                                            <?php
                                                wp_link_pages( array(
                                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fortun' ),
                                                    'after'  => '</div>',
                                                ) );
                                            ?>
                                        </div><!-- .entry-content -->
                                    </article><!-- #post-## -->

                                    <?php
                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if ( comments_open() || get_comments_number() ) :
                                            comments_template();
                                        endif;
                                    ?>

                                <?php endwhile; // End of the loop. ?>

                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
                    <?php $output_page_content = ob_get_contents();

                    ob_end_clean(); 

                    return $output_page_content;
                } ?>

                <?php function agni_page_sidebar(){ 
                    global $fortun_options, $post;

                    $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

                    if( $page_sidebar == '' ){
                        $page_sidebar = esc_attr( $fortun_options['page-sidebar'] );
                    }
                    
                    ob_start();
                    if( $page_sidebar != 'no-sidebar' ){ ?>
                        <div class="page-column page-sidebar col-sm-12 col-md-3 ">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php }
                    $output_page_sidebar = ob_get_contents();

                    ob_end_clean();

                    return $output_page_sidebar;
                }

                if( $page_sidebar == 'has-sidebar left' ){
                    echo agni_page_sidebar().agni_page_content();
                }
                else if( $page_sidebar == 'has-sidebar' ){
                    echo agni_page_content().agni_page_sidebar();
                }
                else{
                    echo agni_page_content();
                }

                ?>
            </div>
        </div>
    </div>
    <?php }
}

// Blog Single
if( !function_exists('agni_single') ){
    function agni_single(){
        global $fortun_options, $post; 

        $page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
        $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
        $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
        $page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );
        $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

        if( $page_remove_title == '' ){
            $page_remove_title = esc_attr( $fortun_options['blog-single-remove-title'] );
        }
        if( $page_title_align == '' ){
            $page_title_align = esc_attr( $fortun_options['blog-single-title-align'] );
        }

        if( $page_layout == '' ){
            if( !empty($fortun_options['blog-single-layout']) ){
                $page_layout = esc_attr( $fortun_options['blog-single-layout'] );
            }
            else{
                $page_layout = 'container';
            }
        }

        if( $page_sidebar == '' ){
            $page_sidebar = esc_attr( $fortun_options['blog-single-sidebar'] );
        }

        ?>
        <section class="blog blog-single-post <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
            <div class="blog-single-container <?php echo esc_attr( $page_layout ); ?>">
                <div class="blog-single-row row <?php 
                echo esc_attr( $page_sidebar );
                if( $page_remove_title != '1' ){ echo ' has-title has-margin'; } 
            ?> ">
                    <?php function agni_single_page_content(){
                        global $fortun_options, $post; 

                        $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
                        $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
                        $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

                        if( $page_remove_title == '' ){
                            $page_remove_title = esc_attr( $fortun_options['blog-single-remove-title'] );
                        }
                        if( $page_title_align == '' ){
                            $page_title_align = esc_attr( $fortun_options['blog-single-title-align'] );
                        }
                        if( $page_sidebar == '' ){
                            $page_sidebar = esc_attr( $fortun_options['blog-single-sidebar'] );
                        }

                        ob_start(); ?>
                        <div class="<?php if( $page_sidebar != 'no-sidebar' ){ echo 'col-sm-12 col-md-9'; }else { echo 'col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 '; } ?> blog-single-post-content">
                            
                            <div id="primary" class="content-area">
                                <main id="main" class="site-main" role="main">

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php  
                                    $post_format = get_post_format();
                                    if( !empty( $post_format ) ){
                                        $post_format_function = 'agni_post_'.$post_format;
                                        if( function_exists($post_format_function) ){
                                            $post_thumbnail = $post_format_function($post->ID);
                                        }
                                    }
                                    elseif( has_post_thumbnail() ){ 
                                        $post_thumbnail = get_the_post_thumbnail( '','fortun-standard-thumbnail' );
                                    }
                                    ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                        <?php if( $page_remove_title != '1' ){
                                            the_title( '<h1 class="entry-title text-'.$page_title_align.'">', '</h1>' ); ?>
                                            <div class="entry-meta <?php echo 'text-'.$page_title_align;?>">
                                                <?php echo agni_framework_post_date(); ?>
                                                <?php echo agni_framework_post_cat(); ?>
                                            </div>
                                        <?php } ?>

                                        <?php if( !empty($post_thumbnail) ){ ?> 
                                        <div class="entry-thumbnail">
                                            <?php echo $post_thumbnail; ?>
                                        </div>
                                        <?php } ?>

                                        <div class="entry-content clearfix">
                                            <?php the_content(); ?>
                                            <?php
                                                wp_link_pages( array(
                                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fortun' ),
                                                    'after'  => '</div>',
                                                ) );
                                            ?>
                                            
                                        </div><!-- .entry-content -->

                                        <div class="entry-footer">
                                            <?php agni_framework_post_tag(); ?>
                                            <?php if( $fortun_options['blog-sharing-panel'] == '1' ){?>
                                                <div class=" post-sharing-buttons">
                                                    <ul class="list-inline">
                                                        <?php  if($fortun_options['blog-sharing-icons'][1] == '1'){ ?>
                                                            <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>/&amp;t=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-facebook"></i></a></li>
                                                        <?php  }?>
                                                        <?php  if($fortun_options['blog-sharing-icons'][2] == '1'){ ?>
                                                            <li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?> - <?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a></li>
                                                        <?php  }?>
                                                        <?php  if($fortun_options['blog-sharing-icons'][3] == '1'){ ?>             
                                                            <li><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() );?>"><i class="fa fa-google-plus"></i></a></li>
                                                        <?php  }?>
                                                        <?php  if($fortun_options['blog-sharing-icons'][4] == '1'){ ?>             
                                                            <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() );?>&title=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
                                                        <?php  }?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div><!-- .entry-footer -->
                                    </article><!-- #post-## -->

                                    <?php  if( $fortun_options['author-biography'] == '1' ){  ?>
                                        <div class="author-bio">
                                            <div class="author-avatar"><?php echo get_avatar( get_the_author_meta('email'), 100 ); ?></div>
                                            <div class="author-details">
                                                <h6 class="author-name"><?php the_author(); ?></h6>                
                                                <p class="author-description"><?php the_author_meta('description'); ?></p>
                                            </div>
                                        </div>
                                    
                                    <?php  } ?> 

                                    <div class="post-navigation-container">
                                        <?php agni_framework_post_nav(); ?>
                                    </div>  
                                    <?php //agni_framework_post_nav(); //the_post_navigation(); ?>

                                    <?php
                                        // If comments are open or we have at least one comment, load up the comment template.
                                        if ( comments_open() || get_comments_number() ) :
                                            comments_template();
                                        endif;
                                    ?>

                                <?php endwhile; // End of the loop. ?>

                                </main><!-- #main -->
                            </div><!-- #primary -->
                        </div>
                        <?php $output_page_content = ob_get_contents();

                        ob_end_clean(); 
                        return $output_page_content;
                    } ?>

                    <?php 
                    function agni_single_page_sidebar(){
                        global $fortun_options, $post; 

                        $page_sidebar = esc_attr( get_post_meta( $post->ID, 'page_sidebar', true ) );

                        if( $page_sidebar == '' ){
                            $page_sidebar = esc_attr( $fortun_options['blog-single-sidebar'] );
                        }

                        ob_start();
                        if( $page_sidebar != 'no-sidebar' ){ ?>
                            <div class="col-sm-12 col-md-3 blog-post-sidebar">
                                <?php get_sidebar(); ?>
                            </div>
                        <?php }
                        $output_page_sidebar = ob_get_contents();

                        ob_end_clean(); 
                        return $output_page_sidebar;
                    }

                    if( $page_sidebar == 'has-sidebar left' ){
                        echo agni_single_page_sidebar().agni_single_page_content();
                    }
                    else if( $page_sidebar == 'has-sidebar' ){
                        echo agni_single_page_content().agni_single_page_sidebar();
                    }
                    else{
                        echo agni_single_page_content();
                    } ?>

                </div>
            </div>
        </section>
    <?php }
}

// Portfolio Single 
if( !function_exists('agni_portfolio_single') ){
    function agni_portfolio_single(){ 
        global $fortun_options, $post;

        $page_bg_color = esc_attr( get_post_meta( $post->ID, 'page_bg_color', true ) );
        $page_remove_title = esc_attr( get_post_meta( $post->ID, 'page_remove_title', true ) );
        $page_title_align = esc_attr( get_post_meta( $post->ID, 'page_title_align', true ) );
        $page_layout = esc_attr( get_post_meta( $post->ID, 'page_layout', true ) );

        if( $page_remove_title == '' ){
            $page_remove_title = esc_attr( $fortun_options['portfolio-single-remove-title'] );
        }
        if( $page_title_align == '' ){
            $page_title_align = esc_attr( $fortun_options['portfolio-single-title-align'] );
        }

        if( $page_layout == '' ){
            $page_layout = esc_attr( $fortun_options['portfolio-single-layout'] );
        }
        
        ?>
        <div id="primary" class="portfolio-single-post content-area  <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
            <main id="main" class="site-main portfolio-single-post-container <?php echo esc_attr( $page_layout ); ?>" role="main">        
            
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php 
                    $portfolio_media = $project_details = $portfolio_single = $portfolio_project_details = $portfolio_project_title = $portfolio_project_additional = $zigzag_count = $portfolio_single_row_class = $portfolio_gutter_row_css = '';
                    $portfolio_layout = esc_attr( get_post_meta( $post->ID, 'portfolio_layout', true ) );
                    $portfolio_media_position = esc_attr( get_post_meta( $post->ID, 'portfolio_media_position', true ) );
                    $portfolio_media_side_column_count = esc_attr( get_post_meta( $post->ID, 'portfolio_media_side_column_count', true ) );
                    $portfolio_content_side_column_count = esc_attr( get_post_meta( $post->ID, 'portfolio_content_side_column_count', true ) );
                    $portfolio_side_alignment = esc_attr( get_post_meta( $post->ID, 'portfolio_side_alignment', true ) );
                    $portfolio_side_content_sticky = esc_attr( get_post_meta( $post->ID, 'portfolio_side_content_sticky', true ) );
                    $portfolio_media_gutter = esc_attr( get_post_meta( $post->ID, 'portfolio_media_gutter', true ) );
                    $portfolio_media_gutter_value = esc_attr( get_post_meta( $post->ID, 'portfolio_media_gutter_value', true ) );
                    $portfolio_layout_repeatable = get_post_meta( $post->ID, 'portfolio_layout_repeatable', true );

                    $portfolio_thumbnail_width = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_width', true ) );
                    $portfolio_thumbnail_height = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_height', true ) );
                    $portfolio_thumbnail_hover_style = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_style', true ) );
                    $portfolio_thumbnail_custom_link = esc_url( get_post_meta( $post->ID, 'portfolio_thumbnail_custom_link', true ) );

                    $portfolio_project_title = esc_attr( get_post_meta( $post->ID, 'portfolio_project_title', true ) );
                    $portfolio_project_detail = get_post_meta( $post->ID, 'portfolio_project_detail', true );
                    $portfolio_project_link = esc_attr( get_post_meta( $post->ID, 'portfolio_project_link', true ) );
                    $portfolio_project_link_text = esc_attr( get_post_meta( $post->ID, 'portfolio_project_link_text', true ) );
                    $portfolio_project_link_url = esc_url( get_post_meta( $post->ID, 'portfolio_project_link_url', true ) );
                    $portfolio_additional_details_align = esc_attr( get_post_meta( $post->ID, 'portfolio_additional_details_align', true ) );

                    $portfolio_media_side_column_count = ( $portfolio_layout == 'side' )?$portfolio_media_side_column_count:'12';
                    $portfolio_content_side_column_count = ( $portfolio_layout == 'side' )?$portfolio_content_side_column_count:'12';

                    if( $portfolio_media_gutter == 'yes' ){
                        $portfolio_gutter_row_css = 'style="';
                        if( $page_layout == 'container-fluid' ){
                            $portfolio_gutter_row_css .= 'margin: -'.intval($portfolio_media_gutter_value/2).'px 0;'; 
                        }
                        else{
                            $portfolio_gutter_row_css .= 'margin: -'.intval($portfolio_media_gutter_value/2).'px; '; 
                        }
                        $portfolio_gutter_row_css .= '"'; 
                    }

                    foreach ( (array) $portfolio_layout_repeatable as $key => $media ) {
                        $portfolio_media_zigzag_column_count = $portfolio_content_zigzag_column_count = $portfolio_media_zigzag_alignment = $portfolio_description_zigzag = $portfolio_media_type = $portfolio_media_image_id = $portfolio_media_gallery = $portfolio_media_caption = $portfolio_gallery_choice = $portfolio_media_images_row = $portfolio_media_image_2_id = $portfolio_media_caption_2 = $portfolio_media_output = $portfolio_media_gallery_id = $portfolio_zigzag_media = $portfolio_zigzag_description = $portfolio_gutter_col_css = $portfolio_media_gutter_gallery = '';

                        if ( isset( $media['media_zigzag_column_count'] ) )
                            $portfolio_media_zigzag_column_count = esc_attr( $media['media_zigzag_column_count'] );

                        if ( isset( $media['description_zigzag_column_count'] ) )
                            $portfolio_description_zigzag_column_count = esc_attr( $media['description_zigzag_column_count'] );

                        if ( isset( $media['media_zigzag_alignment'] ) )
                            $portfolio_media_zigzag_alignment = esc_attr( $media['media_zigzag_alignment'] );

                        if ( isset( $media['description_zigzag'] ) )
                            $portfolio_description_zigzag = esc_attr( $media['description_zigzag'] );

                        if ( isset( $media['media_type'] ) )
                            $portfolio_media_type = esc_attr( $media['media_type'] );

                        if ( isset( $media['media_image_id'] ) )
                            $portfolio_media_image_id = esc_attr( $media['media_image_id'] );

                        if ( isset( $media['media_gallery'] ) )
                            $portfolio_media_gallery = $media['media_gallery'];

                        if ( isset( $media['media_caption'] ) )
                            $portfolio_media_caption = esc_attr( $media['media_caption'] );

                        if ( isset( $media['media_onclick'] ) )
                            $portfolio_media_onclick = esc_attr( $media['media_onclick'] );

                        if ( isset( $media['gallery_choice'] ) )
                            $portfolio_gallery_choice = esc_attr( $media['gallery_choice'] );

                        if ( isset( $media['media_grid_layout'] ) )
                            $portfolio_gallery_grid_layout = esc_attr( $media['media_grid_layout'] );

                        if ( isset( $media['media_images_row'] ) )
                            $portfolio_media_images_count = esc_attr( $media['media_images_row'] );

                        if ( isset( $media['media_carousel_type'] ) )
                            $portfolio_media_carousel_type = esc_attr( $media['media_carousel_type'] );

                        if ( isset( $media['media_carousel_height'] ) )
                            $portfolio_media_carousel_height = esc_attr( $media['media_carousel_height'] );

                        if ( isset( $media['media_image_2_id'] ) )
                            $portfolio_media_image_2_id = esc_attr( $media['media_image_2_id'] );

                        if ( isset( $media['media_caption_2'] ) )
                            $portfolio_media_caption_2 = esc_attr( $media['media_caption_2'] );

                        $portfolio_media_caption = ( $portfolio_media_caption == 'on' )?'img_caption="yes"':'';

                        switch ($portfolio_media_type) {
                            case 'image':
                                $portfolio_media_output = do_shortcode('[agni_image img_url="'.$portfolio_media_image_id.'" '.$portfolio_media_caption.' img_link="'.$portfolio_media_onclick.'" animation="1"]');

                                break;
                            case 'gallery':
                                $prefix = '';
                                foreach ( (array) $portfolio_media_gallery as $attachment_id => $attachment_url ) {
                                    $portfolio_media_gallery_id .= $prefix.$attachment_id;
                                    $prefix = ',';
                                }
                                
                                if( $portfolio_media_gutter == 'yes' ){
                                    $portfolio_media_gutter_gallery = 'gap="'.$portfolio_media_gutter_value.'"';
                                }
                                else{
                                    $portfolio_media_gutter_gallery = 'gap="0"';
                                }

                                if( $portfolio_gallery_choice == 'gallery' ){
                                    $portfolio_media_output = do_shortcode('[agni_gallery img_url="'.$portfolio_media_gallery_id.'" img_link="'.$portfolio_media_onclick.'" '.$portfolio_media_caption.' type="2" column="'.$portfolio_media_images_count.'" gallery-grid-layout="'.$portfolio_gallery_grid_layout.'" animation="1" '.$portfolio_media_gutter_gallery.']');
                                }
                                else if( $portfolio_gallery_choice == 'carousel' ){
                                    $portfolio_media_output = do_shortcode('[agni_gallery img_url="'.$portfolio_media_gallery_id.'" img_link="'.$portfolio_media_onclick.'" '.$portfolio_media_caption.' type="1" column="'.$portfolio_media_images_count.'" carousel_type="'.$portfolio_media_carousel_type.'" carousel_height="'.$portfolio_media_carousel_height.'" gallery_autoplay_hover="" animation="1" '.$portfolio_media_gutter_gallery.']');
                                }

                                break;
                            case 'beforeafter':
                                $portfolio_media_output = do_shortcode('[agni_image img_type="beforeafter" img_url="'.$portfolio_media_image_id.'" img_after_url="'.$portfolio_media_image_2_id.'" '.$portfolio_media_caption.' animation="1"]');
                                
                                break;
                            
                        }

                        if( $portfolio_layout == 'zigzag' ){
                            $zigzag_count++;
                            $portfolio_zigzag_media = '<div class="portfolio-zigzag-media portfolio-zigzag-column col-xs-12 col-sm-12 col-md-'.$portfolio_media_zigzag_column_count.'"><div class="portfolio-zigzag-column-inner">'.$portfolio_media_output.'</div></div>';
                            $portfolio_zigzag_description = '<div class="portfolio-zigzag-description portfolio-zigzag-column col-xs-12 col-sm-12 col-md-'.$portfolio_description_zigzag_column_count.'""><div class="portfolio-zigzag-column-inner">'.htmlspecialchars_decode($portfolio_description_zigzag).'</div></div>';

                            $portfolio_media_output = ($portfolio_media_zigzag_alignment == 'md')?$portfolio_zigzag_media.$portfolio_zigzag_description:$portfolio_zigzag_description.$portfolio_zigzag_media;
                            $portfolio_media_output = '<div id="portfolio-zigzag-row-'.$zigzag_count.'" class="portfolio-zigzag-row row">'.$portfolio_media_output.'</div>';

                        }


                        if( $portfolio_media_gutter == 'yes' ){
                            $portfolio_gutter_col_css = 'style="padding: '.intval($portfolio_media_gutter_value/2).'px;"';
                        }

                        $portfolio_media .= '<div class="portfolio-'.$portfolio_layout.'-media" '.$portfolio_gutter_col_css.'>'.$portfolio_media_output.'</div>';
                    }

                    if( !empty($portfolio_project_detail) ){
                        foreach ( (array) $portfolio_project_detail as $key => $detail ) {
                            $portfolio_project_details .= '<span>'.$detail.'</span>';
                        }
                        $portfolio_project_details = '<div class="project-additional-details">'.$portfolio_project_details.'</div>';
                    }

                    if( !empty($portfolio_project_title) ){
                        $portfolio_project_title = '<h6 class="project-title">'.$portfolio_project_title.'</h6>';
                    }

                    ob_start();
                    if( $fortun_options['portfolio-sharing-panel'] == '1' ){ ?>
                        <div class="portfolio-sharing-buttons">
                            <span class="portfolio-sharing-icon"><i class="pe-7s-share"></i></span>
                            <ul class="portfolio-sharing-list">
                                <?php  if($fortun_options['portfolio-sharing-icons'][1] == '1'){ ?>
                                    <li><a href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() );?>/&amp;t=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php  }?>
                                <?php  if($fortun_options['portfolio-sharing-icons'][2] == '1'){ ?>
                                    <li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?> - <?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php  }?>
                                <?php  if($fortun_options['portfolio-sharing-icons'][3] == '1'){ ?>             
                                    <li><a href="https://plus.google.com/share?url=<?php esc_url( the_permalink() );?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php  }?>
                                <?php  if($fortun_options['portfolio-sharing-icons'][4] == '1'){ ?>             
                                    <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() );?>&title=<?php echo esc_html( str_replace( ' ', '%20', the_title('', '', false) ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <?php  }?>
                            </ul>
                        </div>
                    <?php }

                    $portfolio_share_icons = ob_get_contents();
                    ob_clean();

                    if( !empty($portfolio_project_link) ){
                        $portfolio_project_link = '<div class="project-link">
                                <a href="'.$portfolio_project_link_url.'" class="btn btn-sm btn-accent" target="_blank">'.$portfolio_project_link.'</a>
                            </div>';
                    }

                    if( !empty($portfolio_project_detail) || !empty($portfolio_project_title) || !empty($portfolio_share_icons) || !empty($portfolio_project_link) ){
                        $portfolio_project_additional = '<div class="portfolio-project-details text-'.$portfolio_additional_details_align.'">
                            <div class="portfolio-project-details-container">
                                <div class="portfolio-project-details-inner">
                                    '.$portfolio_project_title.$portfolio_project_details.$portfolio_project_link.$portfolio_share_icons.'
                                </div>
                            </div>
                        </div>';
                    }


                    ob_start(); ?>
                    <div class="portfolio-single-media col-xs-12 col-sm-12 col-md-<?php echo esc_attr( $portfolio_media_side_column_count ); ?>">
                        <div class="portfolio-single-media-container" <?php echo wp_kses_post( $portfolio_gutter_row_css ); ?>>
                            <?php echo $portfolio_media; ?>
                        </div>
                    </div>
                    <?php
                    $portfolio_single_media = ob_get_contents();
                    ob_end_clean();

                    ob_start(); 
                    if( $portfolio_side_content_sticky == 'on' ){
                        $portfolio_side_content_sticky = ' has-fixed-single-content';
                    } ?>
                    <div class="portfolio-single-content col-xs-12 col-sm-12 col-md-<?php echo esc_attr( $portfolio_content_side_column_count.$portfolio_side_content_sticky ); ?>">
                        <div class="portfolio-single-content-inner">
                            <?php if( $page_remove_title != '1' ){
                                the_title( '<h1 class="portfolio-title text-'.$page_title_align.'">', '</h1>' ); ?>
                            <?php } ?>
                            <div class="portfolio-entry-content">
                                <?php the_content(); ?>
                            </div>  <!-- .entry-content -->
                            <?php echo wp_kses_post( $portfolio_project_additional ); ?>
                        </div>
                    </div>
                    <?php
                    $portfolio_single_content = ob_get_contents();
                    ob_end_clean();

                    $portfolio_single = $portfolio_single_content;
                    if( $portfolio_layout == 'full' || $portfolio_layout == 'zigzag' ){
                        if( $portfolio_media_position == 'behind' ){
                            $portfolio_single_content = '<span class="portfolio-single-project-details-toggle">Details</span>'.$portfolio_single_content;
                        }
                        $portfolio_single = ( $portfolio_media_position == 'bottom' )?$portfolio_single_content.$portfolio_single_media:$portfolio_single_media.$portfolio_single_content;
                        $portfolio_single_row_class = 'portfolio-single-media-position-'.$portfolio_media_position;
                    }
                    else if( $portfolio_layout == 'side' ){
                        $portfolio_single = ( $portfolio_side_alignment == 'mc' )?$portfolio_single_media.$portfolio_single_content:$portfolio_single_content.$portfolio_single_media;
                    }
                 
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single-content portfolio-single-layout-'.$portfolio_layout ); ?>>  
                        <div class="portfolio-single-container">
                            <div class="portfolio-single-row row <?php echo esc_attr( $portfolio_single_row_class ); ?>">
                                <?php echo $portfolio_single; ?>       
                            </div>
                            <div class="portfolio-navigation-container">
                                <?php agni_framework_portfolio_nav(); //the_post_navigation(); ?>
                            </div>  
                        </div>
                    </article>
                    
                <?php endwhile; // end of the loop. ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    <?php }
}

// 404
if( !function_exists('agni_404') ){
    function agni_404(){
        global $fortun_options;

        if( !isset($fortun_options['404-title']) ){
            $title_404 = esc_html__( '404', 'fortun' );
        }
        else{
            $title_404 = esc_attr( $fortun_options['404-title'] );
        }
        if( empty($fortun_options['404-title']) ){
            $desc_404 = esc_html__( 'It looks like nothing was found at this location. Page could be removed/moved.', 'fortun' );
        }
        else{
            $desc_404 = esc_attr( $fortun_options['404-description-text'] );
        }

        ?>
        <section class="page-404">
            <div class="page-container container">
                <div class="row">
                    <div class="col-sm-12 col-md-offset-3 col-md-6 page-404-content">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main" role="main">
                                <div class="error-404 not-found text-center">
                                    <h1 class="page-title"><?php echo esc_html( $title_404 ); ?></h1>
                                    <p><?php echo esc_html( $desc_404 ); ?></p>

                                    <?php if( $fortun_options['404-searchbox'] == '1'){
                                        echo get_search_form();
                                    } ?>
                                </div><!-- .error-404 -->
                            </main><!-- #main -->
                        </div><!-- #primary -->
                    </div>
                </div>
            </div>
        </section>
    <?php } 
}

// Blog Posts
function agni_posts( $atts = null, $archive = null, $shortcode = null ){ 
    global $post, $fortun_options; 

    $var = ( $shortcode == true )?'atts':'fortun_options';

    if( $shortcode == true ){
        $var = 'atts';
        $blog_categories = !empty(${$var}['blog-categories'])?esc_attr( ${$var}['blog-categories'] ):'';
    }
    else{
        $var = 'fortun_options';
        $blog_categories = !empty(${$var}['blog-categories'])?esc_attr( join(",", ${$var}['blog-categories'] ) ):'';
    }

    //$blog_categories = !empty(${$var}['blog-categories'])?esc_attr( ${$var}['blog-categories'] ):'';
    $blog_layout = esc_attr( ${$var}['blog-layout'] );
    $blog_fullwidth_layout = !empty(${$var}['blog-fullwidth-layout'])?esc_attr( ${$var}['blog-fullwidth-layout'] ):'';
    $blog_column_layout = esc_attr( ${$var}['blog-column-layout'] );
    $blog_grid_layout = esc_attr( ${$var}['blog-grid-layout'] );
    $blog_navigation = esc_attr( ${$var}['blog-navigation'] );
    $blog_navigation_choice = esc_attr( ${$var}['blog-navigation-choice'] );
    $blog_navigation_ifs_btn_text = esc_attr( ${$var}['blog-navigation-ifs-btn-text'] );
    $blog_navigation_ifs_load_text = esc_attr( ${$var}['blog-navigation-ifs-load-text'] );
    $blog_navigation_ifs_finish_text = esc_attr( ${$var}['blog-navigation-ifs-finish-text'] );
    $blog_sidebar = esc_attr( ${$var}['blog-sidebar'] );
    $blog_gutter = esc_attr( ${$var}['blog-gutter'] );
    $blog_gutter_value = esc_attr( ${$var}['blog-gutter-value'] );
    $blog_thumbnail_hardcrop = esc_attr( ${$var}['blog-thumbnail-hardcrop'] );
    $blog_thumbnail_dimension_custom = esc_attr( ${$var}['blog-thumbnail-dimension-custom'] );
    $blog_thumbnail_has_link = esc_attr( ${$var}['blog-thumbnail-has-link'] );
    $blog_thumbnail_gs_filter = esc_attr( ${$var}['blog-thumbnail-gs-filter'] );
    $blog_content_choice = esc_attr( ${$var}['blog-content-choice'] );
    $blog_excerpt_length = esc_attr( ${$var}['blog-excerpt-length'] );

    $blog_per_page = esc_attr( $fortun_options['blog-per-page'] );
    $blog_post_include = esc_attr( $fortun_options['blog-post-include'] );
    $blog_post_exclude = esc_attr( $fortun_options['blog-post-exclude'] );
    $blog_post_order = esc_attr( $fortun_options['blog-post-order'] );
    $blog_post_orderby = esc_attr( $fortun_options['blog-post-orderby'] );
    $blog_carousel = esc_attr( $fortun_options['blog-carousel'] );
    $blog_carousel_autoplay = esc_attr( $fortun_options['blog-carousel-autoplay'] );
    $blog_carousel_autoplay_timeout = esc_attr( $fortun_options['blog-carousel-autoplay-timeout'] );
    $blog_carousel_autoplay_speed = esc_attr( $fortun_options['blog-carousel-autoplay-speed'] );
    $blog_carousel_autoplay_hover = esc_attr( $fortun_options['blog-carousel-autoplay-hover'] );
    $blog_carousel_loop = esc_attr( $fortun_options['blog-carousel-loop'] );
    $blog_carousel_pagination = esc_attr( $fortun_options['blog-carousel-pagination'] );
    $blog_carousel_navigation = esc_attr( $fortun_options['blog-carousel-navigation'] );
    $blog_animation = esc_attr( $fortun_options['blog-animation'] );
    $blog_animation_style = esc_attr( $fortun_options['blog-animation-style'] );
    $blog_animation_offset = esc_attr( $fortun_options['blog-animation-offset'] );
    $blog_animation_delay = esc_attr( $fortun_options['blog-animation-delay'] );
    $blog_animation_duration = esc_attr( $fortun_options['blog-animation-duration'] );
    if( $shortcode == true ){
        $blog_per_page = esc_attr( $atts['posts_per_page'] );
        $blog_post_include = esc_attr( $atts['post_in'] );
        $blog_post_exclude = esc_attr( $atts['post_not_in'] );
        $blog_post_order = esc_attr( $atts['order'] );
        $blog_post_orderby = esc_attr( $atts['orderby'] );
        $blog_carousel = esc_attr( $atts['carousel'] );    
        $blog_carousel_autoplay = esc_attr( $atts['posttype_autoplay'] );
        $blog_carousel_autoplay_timeout = esc_attr( $atts['posttype_autoplay_timeout'] );
        $blog_carousel_autoplay_speed = esc_attr( $atts['posttype_autoplay_speed'] );
        $blog_carousel_autoplay_hover = esc_attr( $atts['posttype_autoplay_hover'] );
        $blog_carousel_loop = esc_attr( $atts['posttype_loop'] );
        $blog_carousel_pagination = esc_attr( $atts['posttype_pagination'] );
        $blog_carousel_navigation = esc_attr( $atts['posttype_navigation'] );
        $blog_animation = esc_attr( $atts['animation'] );
        $blog_animation_style = esc_attr( $atts['animation_style'] );
        $blog_animation_duration = esc_attr( $atts['animation_duration'] );
        $blog_animation_delay = esc_attr( $atts['animation_delay'] );
        $blog_animation_offset = esc_attr( $atts['animation_offset'] );
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if( get_query_var('paged') != '' ){
        $paged = get_query_var('paged');
    }
    elseif( get_query_var('page') != '' ){
        $paged = get_query_var('page');
    }
    else{
        $paged = 1;
    }
    $include_ids = (!empty($blog_post_include))?explode( ',', $blog_post_include ):'';
    $exclude_ids = (!empty($blog_post_exclude))?explode( ',', $blog_post_exclude ):'';

    $blog_carousel_autoplay = ( $blog_carousel_autoplay == '1' )?'true':'false';
    $blog_carousel_autoplay_hover = ( $blog_carousel_autoplay_hover == '1' )?'true':'false';
    $blog_carousel_loop = ( $blog_carousel_loop == '1' )?'true':'false';
    $blog_carousel_pagination = ( $blog_carousel_pagination == '1' )?'true':'false';
    $blog_carousel_navigation = ( $blog_carousel_navigation == '1' )?'true':'false';

    $args = array(          
        //'post_type' => array( 'post' ),     
        'posts_per_page' => $blog_per_page,
        'max_num_pages' => $blog_per_page,
        'order' => $blog_post_order,
        'orderby' => $blog_post_orderby,
        'post__in'   => $include_ids, 
        'post__not_in'   => $exclude_ids, 
        'cat'  => $blog_categories,
        'paged'=> $paged
    ); 
    
    if( $archive == true ){ 
    	$blog_query = $GLOBALS['wp_query'];
    }
    else{
    	$blog_query = new WP_Query( $args );
    }           	

    $col = $post_additional_class = '';
    $i = $delay = 0;

    switch($blog_column_layout){
        case '1':
            $col = 'col-xs-12 col-sm-12 col-md-12 ';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="1" data-post-1200="1"';
            break;
        case '2':
            $col = 'col-xs-12 col-sm-12 col-md-6 ';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="2" data-post-1200="2"';
            break;
        case '3':
            $col = 'col-xs-12 col-sm-6 col-md-4 ';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="3"';
            break;
        case '4':
            $col = 'col-xs-12 col-sm-6 col-md-3 ';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="4"';
            break;
        case '5':
            $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5 ';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="4" data-post-1200="5"';
            break;
    }
    if( $blog_carousel == '1' ){
        $col = '';
        $carousel_class = ' carousel-post';
    }
    else{
        $carousel_class = $column = '';
    }

    if( $blog_layout == 'grid' || $blog_layout == 'modern' || $blog_layout == 'modern-2' ){
        $post_additional_class = 'grid-item '.$col;
        if( $blog_layout == 'modern' || $blog_layout == 'modern-2' ){
            $post_additional_class .= 'modern '.$col;
        }
    }
    else if( $blog_layout == 'list' || $blog_layout == 'minimal-list' ){
        $post_additional_class = 'list-item ';
        if( $blog_layout == 'minimal-list' ){
            $post_additional_class .= 'minimal ';
        }
    }
    else{
        $post_additional_class = 'standard-item ';
    }

	if( $blog_gutter == '1' ){
        $blog_gutter_row_attr = 'data-gutter="'.$blog_gutter_value.'" ';
        $blog_gutter_row_css = 'style="';
        if( $blog_carousel == '1' ){
            if( $blog_fullwidth_layout == '1' ){
                $blog_gutter_row_css .= 'padding: 0 '.intval($blog_gutter_value).'px; ';
            }
        }
        else{
            $blog_gutter_row_css .= 'margin: 0 -'.intval($blog_gutter_value/2).'px; '; 
            if( $blog_fullwidth_layout == '1' ){
                $blog_gutter_row_css .= 'margin: 0 '.intval($blog_gutter_value/2).'px; '; 
            }
        }
        $blog_gutter_row_css .= '"'; 
    }
    
    ?>
    <section class="blog blog-post <?php echo ( $shortcode == true )?'shortcode-blog-post ':''; echo esc_html($blog_layout); ?>-layout-post <?php echo ($blog_fullwidth_layout == '1')?'has-fullwidth':''; ?>">
        <div class="blog-container container<?php echo ($blog_fullwidth_layout == '1')?'-fluid':''; echo ( $blog_gutter != '1' )?' blog-no-gutter':''; ?>">
            <div class="blog-row row <?php 
            if( $blog_navigation_choice == '3' || $blog_navigation_choice == '4' ){ 
                echo 'has-infinite-scroll ';
                echo ( $blog_navigation_choice == '4' )?'has-load-more ':'';
            } 
            echo esc_attr( $blog_sidebar ); ?>">
                <div class="blog-column<?php if( $blog_carousel == '1' ){ echo ' carousel-blog-column'; }?> col-sm-12 col-md-<?php 
                    if( $blog_sidebar != 'no-sidebar' ){ 
                        echo '9'; 
                    }else { 
                        echo '12'; 
                    } ?> blog-post-content" <?php 
                    if( $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ 
                        echo 'data-blog-grid="'.$blog_grid_layout.'"'; 
                    } 

                ?>>
                    <div id="primary-blog" class="content-area">
                        <?php if( $archive == true ){ ?>
                            <header class="page-header-archive">
                                <?php if( is_search() ){ ?>
                                    <h5 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'fortun' ), '<span>' . get_search_query() . '</span>' ); ?></h5>
                                <?php } 
                                else { 
                                    the_archive_title( '<h5 class="page-title">', '</h5>' );
                                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                } ?>
                            </header>
                        <?php } ?>
                        <div id="main-blog" class="site-main<?php echo esc_attr( $carousel_class ); ?>" <?php 
                        if( $blog_gutter == '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ 
                            echo wp_kses_post( $blog_gutter_row_css ); 
                        } ?> <?php 
			            if( $blog_gutter == '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ 
			                echo wp_kses_post( $blog_gutter_row_attr ); 
			            } ?> data-posttype-autoplay='<?php echo esc_attr( $blog_carousel_autoplay ); ?>' data-posttype-autoplay-timeout='<?php echo esc_attr( $blog_carousel_autoplay_timeout ); ?>' data-posttype-autoplay-speed='<?php echo esc_attr( $blog_carousel_autoplay_speed ); ?>' data-posttype-autoplay-hover='<?php echo esc_attr( $blog_carousel_autoplay_hover ); ?>' data-posttype-loop='<?php echo esc_attr( $blog_carousel_loop ); ?>' data-posttype-pagination='<?php echo esc_attr( $blog_carousel_pagination ); ?>'  data-posttype-navigation='<?php echo esc_attr( $blog_carousel_navigation ); ?>' <?php echo wp_kses_post( $column ); ?>>

                        <?php if ( $blog_query->have_posts() ) : 
                        	while ( $blog_query->have_posts() ) : $blog_query->the_post();

                                $post_thumbnail = $overlay = $post_title = $post_excerpt = $no_excerpt = $post_additional_attr = $post_additional_style = $entry_content_style = '';

                                $post_format = get_post_format();
                                if( $blog_gutter == '1' && $blog_carousel != '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){
                                    $post_additional_style = 'margin: '.intval($blog_gutter_value/2).'px 0; padding: 0 '.intval($blog_gutter_value/2).'px;';
                                    if( has_post_thumbnail() ){ 
                                        $entry_content_style = 'style="margin: 0 '.intval($blog_gutter_value/2).'px;"';
                                    }
                                }

                                if( has_post_thumbnail() ){ 
                                    if( $blog_thumbnail_hardcrop == '1'){
                                        $blog_thumbnail_customcrop_dimension = explode( 'x', $blog_thumbnail_dimension_custom );
                                        $post_thumbnail = agni_thumbnail_customcrop( get_post_thumbnail_id(), $blog_thumbnail_customcrop_dimension[0].'x'.$blog_thumbnail_customcrop_dimension[1], 'blog-thumbnail-attachment-image' );

                                    }
                                    else{
                                        $post_thumbnail = get_the_post_thumbnail( '','fortun-standard-thumbnail' );

                                    }
                                    if( $blog_thumbnail_has_link == '1'){
                                        $post_thumbnail = '<a href="'.esc_url( get_permalink() ).'">'.$post_thumbnail.'</a>';
                                    }

                                }elseif( !empty($post_format) && ($blog_layout == 'standard' || $blog_layout == 'grid') ){
                                    $post_format_function = 'agni_post_'.$post_format;
                                    if( function_exists($post_format_function) ){
                                        $post_thumbnail = $post_format_function($post->ID);
                                    }
                                }

                                if( $blog_layout == 'modern' || $blog_layout == 'modern-2' || $blog_layout == 'minimal-list' ){
                                    $overlay = '<div class="overlay"></div>';
                                }

                                if( !empty($post_thumbnail) ){
                                    $grayscale = ($blog_thumbnail_gs_filter == '1')?'has-grayscale':'';
                                    $post_thumbnail = '<div class="entry-thumbnail '.$grayscale.'">
                                        '.$post_thumbnail.$overlay.'
                                    </div>';
                                }
                                
                                $post_title = ( $blog_layout == 'standard' )?'h4':'h5';
                                $post_title = '<'.$post_title.' class="entry-title"><a href="'.esc_url( get_permalink() ).'" rel="bookmark">'.get_the_title().'</a></'.$post_title.'>';

                                $entry_meta = '<div class="entry-meta">
                                    '.agni_framework_post_date().agni_framework_post_cat().'
                                </div>';

                                if( $blog_layout != 'standard' || $blog_content_choice != '1' ){
                                    $post_excerpt = (!empty($blog_excerpt_length))?agni_excerpt_length( $blog_excerpt_length ):'';
                                }
                                else{
                                    $post_excerpt = apply_filters( 'the_content', get_the_content( sprintf(
                                            wp_kses( __( 'Read More %s', 'fortun' ), array( 'span' => array( 'class' => array() ) ) ),
                                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                                    ) ) ); 
                                    $post_excerpt .= wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fortun' ),
                                        'after'  => '</div>',
                                        'echo'  => false
                                    ) );
                                    $no_excerpt = 'no-excerpt';
                                }

                                if( $blog_animation == '1' ){

                                    if( $blog_layout == 'grid' || $blog_layout == 'modern' || $blog_layout == 'modern-2' ){
                                        if( $i >= $blog_column_layout ){
                                            $delay = $i = 0;
                                        }
                                    }
                                    else{
                                        $delay = $i = 0;
                                    }
                                    $delay += $blog_animation_delay;
                                    $duration = $blog_animation_duration;
                                    $i += 1;

                                    $post_additional_class .= 'animate ';
                                    $post_additional_attr = 'data-animation="'.esc_attr($blog_animation_style).'" data-animation-offset="'.esc_attr($blog_animation_offset).'%"';
                                    $post_additional_style .= ' -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s; animation-duration: '.$duration.'s; animation-delay: '.$delay.'s;';
                                }
                                ?>

                                <article id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class( $post_additional_class ); ?> style="<?php echo esc_attr( $post_additional_style ); ?>" <?php echo wp_kses_post( $post_additional_attr ); ?>>
                                    <?php switch( $blog_layout ){
                                        case 'grid': 
                                            echo  $post_thumbnail.$entry_meta.$post_title.'
                                            <div class="entry-content" '.$entry_content_style.'>'.
                                                $post_excerpt.'
                                            </div>';
                                            break;
                                        case 'modern':
                                        case 'modern-2': 
                                            echo  $post_thumbnail.'
                                            <div class="entry-content" '.$entry_content_style.'>'.
                                                $post_title.$entry_meta.'
                                            </div>';
                                            break;
                                        case 'list':
                                            echo  $post_thumbnail.'
                                            <div class="entry-content">'.
                                                $entry_meta.$post_title.$post_excerpt.'
                                            </div>';
                                            break;
                                        case 'minimal-list':
                                            echo  $post_thumbnail.'
                                            <div class="entry-content">
                                                <div class="entry-container container">'.
                                                $entry_meta.$post_title.'
                                                </div>
                                            </div>';
                                            break;
                                        default : 
                                            echo  $post_thumbnail.$entry_meta.$post_title.'
                                            <div class="entry-content '.$no_excerpt.'">'.
                                                $post_excerpt.'
                                            </div>';
                                            break;
                                    } ?>
                                </article>

                            <?php endwhile; 
                        else : ?>

                            <?php get_template_part( 'template/content', 'none' ); ?>

                        <?php endif; ?>
                        
                        <?php if( $blog_carousel != '1' && $blog_layout != 'standard' && $blog_layout != 'list' && $blog_layout != 'minimal-list' ){ ?>
                            <div class="grid-sizer <?php echo esc_attr( $col ); ?>"></div>
                        <?php } ?>

                        </div><!-- #main -->
                        <?php
                        if( $blog_navigation == '1' && $blog_carousel != '1' ){ 
                            if( $blog_navigation_choice == '3' || $blog_navigation_choice == '4' ){ 
                                $load_more_button = ( $blog_navigation_choice == '4' )?'<span class="btn btn-accent">'.$blog_navigation_ifs_btn_text.'</span>':'';
                                echo '<div class="load-more" data-msg-text="'.$blog_navigation_ifs_load_text.'" data-finished-text="'.$blog_navigation_ifs_finish_text.'">'.$load_more_button.'</div>';
                            } 
                            if( $blog_navigation_choice != '1' ){ 
                                echo agni_page_navigation( $blog_query, $number_navigation = 'post-number-navigation' ); 
                            }else{ 
                                if( $archive != true && $blog_query->have_posts() ){
                                    $GLOBALS['wp_query']->max_num_pages = $blog_per_page;
                                }
                                the_posts_navigation(array( 
                                    'prev_text' => esc_html__( 'Older posts', 'fortun' ), 
                                    'next_text' => esc_html__( 'Newer Posts', 'fortun' ), 
                                )); 
                            }
                        } 
                        if( !isset(${$var}['blog-navigation']) ){
                            the_posts_navigation(array( 
                                'prev_text' => esc_html__( 'Older posts', 'fortun' ), 
                                'next_text' => esc_html__( 'Newer Posts', 'fortun' ), 
                            )); 
                        }?>
                    </div><!-- #primary -->
                </div>
                <?php if( $blog_sidebar != 'no-sidebar' ){ ?>
                    <div class="blog-column col-sm-12 col-md-3 blog-post-sidebar">
                        <?php get_sidebar(); ?>
                    </div>
                <?php }?>
            </div>
        </div>
    </section>
<?php }
add_action( 'agni_posts_init', 'agni_posts', 10, 3 );

// Portfolio Posts
function agni_portfolio( $atts = null, $shortcode = null ){
    global $fortun_options, $post;

    $portfolio_filter_fullwidth = $portfolio_gutter_row_css = $portfolio_gutter_row_attr = $tax_args = $portfolio_thumbnail_individual_settings = '';
    $portfolio_categories = array();

    if( $shortcode == true ){
        $var = 'atts';
        $portfolio_categories = !empty(${$var}['portfolio-categories'])?esc_attr( ${$var}['portfolio-categories'] ):'';
    }
    else{
        $var = 'fortun_options';
        $portfolio_categories = !empty(${$var}['portfolio-categories'])?esc_attr( join(",", ${$var}['portfolio-categories'] ) ):'';
    }

    //$portfolio_categories = !empty(${$var}['portfolio-categories'])?esc_attr( ${$var}['portfolio-categories'] ):'';
    $portfolio_cateogory_operator = !empty(${$var}['portfolio-cateogory-operator'])?esc_attr( ${$var}['portfolio-cateogory-operator'] ):'';
    $portfolio_fullwidth = !empty(${$var}['portfolio-fullwidth'])?esc_attr( ${$var}['portfolio-fullwidth'] ):'';
    $portfolio_grid = esc_attr( ${$var}['portfolio-grid'] );
    $portfolio_layout = esc_attr( ${$var}['portfolio-layout'] );
    $portfolio_filter = (${$var}['portfolio-filter'] == '1')?esc_attr( ${$var}['portfolio-filter'] ):'';
    $portfolio_filter_align = esc_attr( ${$var}['portfolio-filter-align'] );
    $portfolio_filter_order = esc_attr( ${$var}['portfolio-filter-order'] );
    $portfolio_filter_orderby = esc_attr( ${$var}['portfolio-filter-orderby'] );
    $portfolio_filter_all_text = esc_attr( ${$var}['portfolio-filter-all-text'] );
    $portfolio_gutter = esc_attr( ${$var}['portfolio-gutter'] );
    $portfolio_gutter_value = esc_attr( ${$var}['portfolio-gutter-value'] );
    $portfolio_hover_style = esc_attr( ${$var}['portfolio-hover-style'] );
    $portfolio_hover_color = esc_attr( ${$var}['portfolio-hover-color'] );
    $portfolio_hover_show_title = esc_attr( ${$var}['portfolio-hover-show-title'] );
    $portfolio_hover_show_category = esc_attr( ${$var}['portfolio-hover-show-category'] );
    $portfolio_hover_show_attachment_link = esc_attr( ${$var}['portfolio-hover-show-attachment-link'] );
    $portfolio_hover_show_link = esc_attr( ${$var}['portfolio-hover-show-link'] );
    $portfolio_thumbnail_hardcrop = esc_attr( ${$var}['portfolio-thumbnail-hardcrop'] );
    $portfolio_thumbnail_dimension_custom = esc_attr( ${$var}['portfolio-thumbnail-dimension-custom'] );
    $portfolio_thumbnail_gs_filter = esc_attr( ${$var}['portfolio-thumbnail-gs-filter'] );
    $portfolio_bottom_title = esc_attr( ${$var}['portfolio-bottom-title'] );
    $portfolio_bottom_category = esc_attr( ${$var}['portfolio-bottom-category'] );
    $portfolio_post_link_target = esc_attr( ${$var}['portfolio-post-link-target'] );
    $portfolio_navigation = esc_attr( ${$var}['portfolio-navigation'] );
    $portfolio_navigation_choice = esc_attr( ${$var}['portfolio-navigation-choice'] );
    $portfolio_navigation_ifs_btn_text = esc_attr( ${$var}['portfolio-navigation-ifs-btn-text'] );
    $portfolio_navigation_ifs_load_text = esc_attr( ${$var}['portfolio-navigation-ifs-load-text'] );
    $portfolio_navigation_ifs_finish_text = esc_attr( ${$var}['portfolio-navigation-ifs-finish-text'] );

    
    $portfolio_hover_bg_color = esc_attr( $fortun_options['portfolio-hover-bg-color']['rgba'] );
    $portfolio_carousel = esc_attr( $fortun_options['portfolio-carousel'] );
    $portfolio_carousel_autoplay = esc_attr( $fortun_options['portfolio-carousel-autoplay'] );
    $portfolio_carousel_autoplay_timeout = esc_attr( $fortun_options['portfolio-carousel-autoplay-timeout'] );
    $portfolio_carousel_autoplay_speed = esc_attr( $fortun_options['portfolio-carousel-autoplay-speed'] );
    $portfolio_carousel_autoplay_hover = esc_attr( $fortun_options['portfolio-carousel-autoplay-hover'] );
    $portfolio_carousel_loop = esc_attr( $fortun_options['portfolio-carousel-loop'] );
    $portfolio_carousel_pagination = esc_attr( $fortun_options['portfolio-carousel-pagination'] );
    $portfolio_carousel_navigation = esc_attr( $fortun_options['portfolio-carousel-navigation'] );
    $portfolio_per_page = esc_attr( $fortun_options['portfolio-per-page'] );
    $portfolio_post_include = esc_attr( $fortun_options['portfolio-post-include'] );
    $portfolio_post_exclude = esc_attr( $fortun_options['portfolio-post-exclude'] );
    $portfolio_post_order = esc_attr( $fortun_options['portfolio-post-order'] );
    $portfolio_post_orderby = esc_attr( $fortun_options['portfolio-post-orderby'] );
    $portfolio_animation = esc_attr( $fortun_options['portfolio-animation'] );
    $portfolio_animation_style = esc_attr( $fortun_options['portfolio-animation-style'] );
    $portfolio_animation_duration = esc_attr( $fortun_options['portfolio-animation-duration'] );
    $portfolio_animation_delay = esc_attr( $fortun_options['portfolio-animation-delay'] );
    $portfolio_animation_offset = esc_attr( $fortun_options['portfolio-animation-offset'] );
    if( $shortcode == true ){
        $portfolio_hover_bg_color = esc_attr( $atts['portfolio-hover-bg-color'] );
        $portfolio_per_page = esc_attr( $atts['posts_per_page'] );
        $portfolio_post_include = esc_attr( $atts['post_in'] );
        $portfolio_post_exclude = esc_attr( $atts['post_not_in'] );
        $portfolio_post_order = esc_attr( $atts['order'] );
        $portfolio_post_orderby = esc_attr( $atts['orderby'] );
        $portfolio_thumbnail_individual_settings = esc_attr( $atts['portfolio_thumbnail_individual_settings'] );   
        $portfolio_carousel = esc_attr( $atts['carousel'] );    
        $portfolio_carousel_autoplay = esc_attr( $atts['posttype_autoplay'] );
        $portfolio_carousel_autoplay_timeout = esc_attr( $atts['posttype_autoplay_timeout'] );
        $portfolio_carousel_autoplay_speed = esc_attr( $atts['posttype_autoplay_speed'] );
        $portfolio_carousel_autoplay_hover = esc_attr( $atts['posttype_autoplay_hover'] );
        $portfolio_carousel_loop = esc_attr( $atts['posttype_loop'] );
        $portfolio_carousel_pagination = esc_attr( $atts['posttype_pagination'] );
        $portfolio_carousel_navigation = esc_attr( $atts['posttype_navigation'] );
        $portfolio_animation = esc_attr( $atts['animation'] );
        $portfolio_animation_style = esc_attr( $atts['animation_style'] );
        $portfolio_animation_duration = esc_attr( $atts['animation_duration'] );
        $portfolio_animation_delay = esc_attr( $atts['animation_delay'] );
        $portfolio_animation_offset = esc_attr( $atts['animation_offset'] );
    }
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if( get_query_var('paged') != '' ){
        $paged = get_query_var('paged');
    }
    elseif( get_query_var('page') != '' ){
        $paged = get_query_var('page');
    }
    else{
        $paged = 1;
    }
    $include_ids = (!empty($portfolio_post_include))?explode( ',', $portfolio_post_include ):'';
    $exclude_ids = (!empty($portfolio_post_exclude))?explode( ',', $portfolio_post_exclude ):'';

    $portfolio_carousel_autoplay = ( $portfolio_carousel_autoplay == '1' )?'true':'false';
    $portfolio_carousel_autoplay_hover = ( $portfolio_carousel_autoplay_hover == '1' )?'true':'false';
    $portfolio_carousel_loop = ( $portfolio_carousel_loop == '1' )?'true':'false';
    $portfolio_carousel_pagination = ( $portfolio_carousel_pagination == '1' )?'true':'false';
    $portfolio_carousel_navigation = ( $portfolio_carousel_navigation == '1' )?'true':'false';

    if ( !empty( $portfolio_categories ) ) {
        $portfolio_cateogory_operator = ( $portfolio_cateogory_operator == '1' )?'NOT IN':'IN';
        $tax_args = array( array(
            'taxonomy' => 'types',
            'field' => 'term_id',
            'terms' =>  explode( ',', $portfolio_categories ),
            'operator' => $portfolio_cateogory_operator
        ) );
    }
    $args = array(          
        'post_type' => array( 'portfolio' ),            
        'posts_per_page' => $portfolio_per_page,
        'order' => $portfolio_post_order,
        'orderby' => $portfolio_post_orderby,
        'post__in'   => $include_ids, 
        'post__not_in'   => $exclude_ids, 
        'tax_query' => $tax_args,
        'paged'=> $paged   
    ); 
    
    $query = new WP_Query( $args );
    
    switch($portfolio_layout){
        case '1':
            $col = 'col-xs-12 col-sm-12 col-md-12';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="1" data-post-1200="1"';
            break;
        case '2':
            $col = 'col-xs-12 col-sm-12 col-md-6';
            $column = 'data-post-0="1" data-post-768="1" data-post-992="2" data-post-1200="2"';
            break;
        case '3':
            $col = 'col-xs-12 col-sm-6 col-md-4';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="3"';
            break;
        case '4':
            $col = 'col-xs-12 col-sm-6 col-md-3';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="3" data-post-1200="4"';
            break;
        case '5':
            $col = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
            $column = 'data-post-0="1" data-post-768="2" data-post-992="4" data-post-1200="5"';
            break;
    }
    if( $portfolio_carousel == '1' ){
        $portfolio_filter = $col = '';
        $carousel_class = ' carousel-portfolio';
    }
    else{
        $carousel_class = $column = '';
    }

    if( $portfolio_gutter == '1' ){
        $portfolio_gutter_row_attr = 'data-gutter="'.$portfolio_gutter_value.'" ';
        $portfolio_gutter_row_css = 'style="';
        if( $portfolio_carousel == '1' ){
            if( $portfolio_fullwidth == '1' ){
                $portfolio_gutter_row_css .= 'padding: 0 '.intval($portfolio_gutter_value).'px; ';
            }
        }
        else{
            $portfolio_gutter_row_css .= 'margin: 0 -'.intval($portfolio_gutter_value/2).'px; '; 
            if( $portfolio_fullwidth == '1' ){
                $portfolio_gutter_row_css .= 'margin: 0 '.intval($portfolio_gutter_value/2).'px; '; 
            }
        }
        $portfolio_gutter_row_css .= '"'; 
    }

    if( $portfolio_filter == '1' && $portfolio_carousel != '1' ){ 
        if( $portfolio_fullwidth == '1' ){
            $portfolio_filter_fullwidth = 'container-fluid ';
        }
        $portfolio_filter = '<div class="portfolio-filter '.$portfolio_filter_fullwidth.'text-'.esc_attr($portfolio_filter_align).'">'.agni_portfolio_filter( $portfolio_filter_order, $portfolio_filter_orderby, $portfolio_filter_all_text ).'</div>';
    }

    ?>
    <div id="primary-portfolio" class="page-portfolio content-area <?php echo ( $shortcode == true )?'shortcode-page-portfolio':''; ?>">
        <div id="main-portfolio" class="page-portfolio-container container<?php echo ( $portfolio_fullwidth == '1' )?'-fluid ':''; ?> site-main">

            <?php echo $portfolio_filter; ?>
            <div class="portfolio-container<?php echo ( $portfolio_fullwidth == '1' )?' portfolio-fullwidth':''; echo ( $portfolio_gutter != '1' )?' portfolio-no-gutter':''; echo ( $portfolio_thumbnail_hardcrop == '1')?' has-hardcrop':''; 
                if( $portfolio_navigation_choice == '2' || $portfolio_navigation_choice == '3' ){ 
                    echo ' has-infinite-scroll'; 
                    echo ( $portfolio_navigation_choice == '3')?' has-load-more':'';
                } ?>">
                <div class="row portfolio-row<?php echo esc_attr( $carousel_class ); if( $portfolio_thumbnail_individual_settings == '1' ){ echo ' ignore-thumbnail-settings'; } ?>" <?php echo wp_kses_post( $portfolio_gutter_row_css ); ?> <?php echo wp_kses_post( $portfolio_gutter_row_attr ); ?> data-grid="<?php echo esc_attr( $portfolio_grid ); ?>" <?php echo wp_kses_post( $column ); ?> data-posttype-autoplay="<?php echo esc_attr( $portfolio_carousel_autoplay ); ?>" data-posttype-autoplay-timeout="<?php echo esc_attr( $portfolio_carousel_autoplay_timeout ); ?>" data-posttype-autoplay-speed="<?php echo esc_attr( $portfolio_carousel_autoplay_speed ); ?>" data-posttype-autoplay-hover="<?php echo esc_attr( $portfolio_carousel_autoplay_hover ); ?>" data-posttype-loop="<?php echo esc_attr( $portfolio_carousel_loop ); ?>" data-posttype-pagination="<?php echo esc_attr( $portfolio_carousel_pagination ); ?>" data-posttype-navigation="<?php echo esc_attr( $portfolio_carousel_navigation ); ?>">
                    <?php $i = $delay = 0; if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post(); 

                        $portfolio_additional_class = $portfolio_additional_attr = $portfolio_additional_style = $portfolio_category_list = $portfolio_category = $portfolio_thumbnail_hover_css = $portfolio_show_title = $portfolio_show_category = $portfolio_show_link = $portfolio_show_attachment_link = $portfolio_show_bottom = $portfolio_show_bottom_title = $portfolio_show_bottom_category = $portfolio_meta = '';
                        $portfolio_thumbnail_width = ( $portfolio_thumbnail_individual_settings != '1' )?esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_width', true ) ):'width1x';
                        $portfolio_thumbnail_height = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_height', true ) );
                        $portfolio_thumbnail_hover_style = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_style', true ) );
                        $portfolio_thumbnail_native_hover = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_native_hover', true ) );
                        $portfolio_thumbnail_hover_bg_color = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_bg_color', true ) );
                        $portfolio_thumbnail_hover_color = esc_attr( get_post_meta( $post->ID, 'portfolio_thumbnail_hover_color', true ) );
                        $portfolio_thumbnail_custom_link = esc_url( get_post_meta( $post->ID, 'portfolio_thumbnail_custom_link', true ) );

                        $portfolio_thumbnail_link = ( !empty($portfolio_thumbnail_custom_link) ) ? $portfolio_thumbnail_custom_link : get_permalink();
                        $portfolio_thumbnail_hover_style = ( !empty($portfolio_thumbnail_hover_style) )?$portfolio_thumbnail_hover_style : $portfolio_hover_style;
                        $portfolio_thumbnail_native_hover = ( !empty($portfolio_thumbnail_native_hover) )?' has-native-hover':'';
                        if( $portfolio_thumbnail_hover_bg_color == '' ){
                            $portfolio_thumbnail_hover_bg_color = $portfolio_hover_bg_color;
                        } 
                        $portfolio_thumbnail_hover_bg_color = ($portfolio_thumbnail_hover_bg_color != '')?'background-color:'.$portfolio_thumbnail_hover_bg_color.'; ':'';
                        if( $portfolio_thumbnail_hover_color == '' ){
                            $portfolio_thumbnail_hover_color = $portfolio_hover_color;
                        }
                        $portfolio_thumbnail_hover_color = ($portfolio_thumbnail_hover_color != '')?'color:'.$portfolio_thumbnail_hover_color.'; ':'';
                        
                        if( $portfolio_thumbnail_hover_bg_color != '' || $portfolio_thumbnail_hover_color != '' ){
                            $portfolio_thumbnail_hover_css = 'style="'.$portfolio_thumbnail_hover_bg_color.$portfolio_thumbnail_hover_color.'"';
                        }

                        $terms = get_the_terms( $post->ID, 'types' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            foreach ( $terms as $term ){
                                $portfolio_category .= strtolower($term->slug).' '; //strtolower($term->name).' ';
                                $portfolio_category_list .= '<li>'.$term->name.'</li>';
                            }
                        }

                        if( $portfolio_thumbnail_hardcrop == '1'){
                            $portfolio_thumbnail_customcrop_dimension = explode( 'x', $portfolio_thumbnail_dimension_custom );
                            
                            if( $portfolio_thumbnail_individual_settings != '1' ){
                                if( $portfolio_thumbnail_width == 'width2x' && $portfolio_thumbnail_height == 'height1x' ){
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width1x' && $portfolio_thumbnail_height == 'height2x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width1x' && $portfolio_thumbnail_height == 'height3x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*3);
                                }
                                else if( $portfolio_thumbnail_width == 'width3x' && $portfolio_thumbnail_height == 'height1x' ){
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*3);
                                }
                                else if( $portfolio_thumbnail_width == 'width3x' && $portfolio_thumbnail_height == 'height2x' ){
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*3);
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width2x' && $portfolio_thumbnail_height == 'height3x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*3);
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width2x' && $portfolio_thumbnail_height == 'height2x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*2);
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*2);
                                }
                                else if( $portfolio_thumbnail_width == 'width3x' && $portfolio_thumbnail_height == 'height3x' ){
                                    $portfolio_thumbnail_customcrop_dimension[1] = ($portfolio_thumbnail_customcrop_dimension[1]*3);
                                    $portfolio_thumbnail_customcrop_dimension[0] = ($portfolio_thumbnail_customcrop_dimension[0]*3);
                                }
                            }

                            $portfolio_thumbnail = agni_thumbnail_customcrop( get_post_thumbnail_id(), $portfolio_thumbnail_customcrop_dimension[0].'x'.$portfolio_thumbnail_customcrop_dimension[1], 'portfolio-thumbnail-attachment-image' );
                            
                            if( $portfolio_gutter == '1' && $portfolio_thumbnail_individual_settings != '1' && !empty($portfolio_thumbnail) ){
                                $xpath = new DOMXPath(@DOMDocument::loadHTML($portfolio_thumbnail));
                                $src = $xpath->evaluate("string(//img/@src)");
                                $portfolio_thumbnail .= '<div class="portfollio-thumbnail-bg" style="background-image:url('.$src.')"></div>';
                            }
                            
                            $portfolio_additional_attr .= ' data-hardcrop="true" data-thumbnail-width="'.$portfolio_thumbnail_customcrop_dimension[0].'" data-thumbnail-height="'.$portfolio_thumbnail_customcrop_dimension[1].'"';
                        }
                        else{
                            $portfolio_thumbnail = get_the_post_thumbnail();
                        }
                        if( $portfolio_gutter == '1' && $portfolio_carousel != '1' ){
                            $portfolio_additional_style = 'margin: '.intval($portfolio_gutter_value/2).'px 0; padding: 0 '.intval($portfolio_gutter_value/2).'px;';
                        }

                        $portfolio_additional_class = 'portfolio-column portfolio-post portfolio-hover-style-'.esc_attr($portfolio_thumbnail_hover_style).$portfolio_thumbnail_native_hover.' all '.$portfolio_category.' '.$portfolio_thumbnail_width.' '.$portfolio_thumbnail_height.' '.$col;

                        if($portfolio_thumbnail_gs_filter){ 
                            $portfolio_additional_class .= ' has-grayscale'; 
                        }

                        if( $portfolio_hover_show_title == '1' ){
                            $portfolio_show_title = '<h5 class="portfolio-title">'.get_the_title().'</h5>';
                        }
                        if( $portfolio_hover_show_category == '1' ){
                            $portfolio_show_category = '<ul class="portfolio-category list-inline">'.$portfolio_category_list.'</ul>';
                        }
                        if( $portfolio_hover_show_link == '1' ){
                            $portfolio_show_link = '<a href="'.$portfolio_thumbnail_link.'" target="'.$portfolio_post_link_target.'"><i class="pe-7s-link"></i></a>';
                        }
                        if( $portfolio_hover_show_attachment_link == '1' ){
                            $portfolio_show_attachment_link = '<a href="'.wp_get_attachment_url( get_post_thumbnail_id($post->ID) ).'" class="portfolio-attachment"><i class="pe-7s-photo"></i></a>';
                        }
                        if( $portfolio_hover_show_link == '1' || $portfolio_hover_show_attachment_link == '1' ){
                            $portfolio_meta = '<div class="portfolio-meta">'.$portfolio_show_link.$portfolio_show_attachment_link.'</div>';
                        }
                        if( $portfolio_bottom_title == '1' ){
                            $portfolio_show_bottom_title = '<h5 class="portfolio-bottom-caption-title"><a href="'.$portfolio_thumbnail_link.'" target="'.$portfolio_post_link_target.'">'.get_the_title().'</a></h5>';
                        }
                        if( $portfolio_bottom_category == '1' ){
                            $portfolio_show_bottom_category = '<ul class="portfolio-bottom-caption-category list-inline">'.$portfolio_category_list.'</ul>';
                        }
                        if( $portfolio_bottom_title == '1' || $portfolio_bottom_category == '1' ){
                            $portfolio_additional_class .= ' has-bottom-caption'; 
                            $portfolio_show_bottom = '<div class="portfolio-bottom-caption">'.$portfolio_show_bottom_title.$portfolio_show_bottom_category.'</div>';
                        }

                        if( $i >= $portfolio_layout ){
                            $delay = $i = 0;
                        }
                        $delay += $portfolio_animation_delay; // Animation Delay 0.4;
                        $duration = $portfolio_animation_duration;  // Animation Duration 0.8;
                        if( $portfolio_thumbnail_width == 'width2x' ){
                            $i += 2;
                        }
                        else if( $portfolio_thumbnail_width == 'width3x' ){
                            $i += 3;
                        }
                        else{
                            $i += 1;  // Animation Iteration
                        }
                        if( $portfolio_animation == '1' ){
                            $portfolio_additional_class .= ' animate';
                            $portfolio_additional_attr .= ' data-animation="'.esc_attr($portfolio_animation_style).'" data-animation-offset="'.esc_attr($portfolio_animation_offset).'%"';
                            $portfolio_additional_style .= ' -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s; animation-duration: '.$duration.'s; animation-delay: '.$delay.'s;';
                        }

                        ?><div id="portfolio-post-<?php esc_attr( the_ID() ); ?>" class="<?php echo esc_attr( $portfolio_additional_class ); ?>" <?php echo wp_kses_post( $portfolio_additional_attr ); ?> style="<?php echo esc_attr( $portfolio_additional_style ); ?>">
                            <div class="portfolio-content-container" <?php echo wp_kses_post( $portfolio_thumbnail_hover_css ); ?>>
                                <div class="portfolio-thumbnail">
                                    <?php echo  $portfolio_thumbnail; ?>
                                </div> 
                                <div class="portfolio-caption-content">
                                    <a class="portfolio-content-link" href="<?php echo esc_url( $portfolio_thumbnail_link ); ?>" target="<?php echo esc_attr( $portfolio_post_link_target ); ?>"></a>
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-details">
                                            <a class="portfolio-content-link" href="<?php echo esc_url( $portfolio_thumbnail_link ); ?>" target="<?php echo esc_attr( $portfolio_post_link_target ); ?>">
                                                <div class="portfolio-content-inner" <?php if( $portfolio_thumbnail_hover_style == '3' ){ echo wp_kses_post( $portfolio_thumbnail_hover_css ); } ?>>
                                                    <?php echo wp_kses_post( $portfolio_show_title.$portfolio_show_category ); ?>
                                                </div>
                                            </a>
                                           <?php echo wp_kses_post( $portfolio_meta ); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo wp_kses_post( $portfolio_show_bottom ); ?>
                        </div><?php 
                    endwhile;
                    endif; 

                    if( $portfolio_carousel != '1' ){ ?>
                        <div class="grid-sizer <?php echo esc_attr( $col ); ?>"></div>
                    <?php }

                    // Reset Post Data
                    wp_reset_postdata(); ?>
                </div>
                <?php 
                if( $portfolio_navigation == '1' && $portfolio_carousel != '1' ){ 
                    if( $portfolio_navigation_choice == '2' || $portfolio_navigation_choice == '3' ){ 
                        $load_more_button = ( $portfolio_navigation_choice == '3' )?'<span class="btn btn-accent">'.$portfolio_navigation_ifs_btn_text.'</span>':'';
                        echo '<div class="load-more" data-msg-text="'.$portfolio_navigation_ifs_load_text.'" data-finished-text="'.$portfolio_navigation_ifs_finish_text.'">'.$load_more_button.'</div>';
                    } 

                    echo agni_page_navigation( $query, $number_navigation = 'portfolio-number-navigation' ); 
                } ?>
            </div>
        </div><!-- #main -->
    </div><!-- #primary --> 
<?php }
add_action( 'agni_portfolio_init', 'agni_portfolio', 10, 2 );

// Agni Team
if( !function_exists('agni_team') ){
    function agni_team( $atts ){

        global $post; 
        $output = $team_cat = $carousel_column = $column = $team_gutter_row_style = $team_gutter_style = '';
        
        if(!empty($atts['team_categories'])){       
            $team_cat = array( array(
                'taxonomy' => 'team_types',
                'field' => 'slug',
                'terms' =>  explode( ',', $atts['team_categories'] ) 
            ) );
        }
        
        if( $atts['team_type'] == '1' ){
            switch( $atts['column'] ){
                case '1' :
                    $carousel_column = 'data-team-0="1" data-team-768="1" data-team-992="1" data-team-1200="1"';
                    break;
                case '2' :
                    $carousel_column = 'data-team-0="1" data-team-768="1" data-team-992="2" data-team-1200="2"';
                    break;
                case '3' :
                    $carousel_column = 'data-team-0="1" data-team-768="2" data-team-992="3" data-team-1200="3"';
                    break;
                case '4' :
                    $carousel_column = 'data-team-0="1" data-team-768="3" data-team-992="4" data-team-1200="4"';
                    break;
                case '5' :
                    $carousel_column = 'data-team-0="1" data-team-768="3" data-team-992="4" data-team-1200="5"';
                    break;
            }
        }
        else{
            switch( $atts['column'] ){
                case '1' :
                    $column = 'col-xs-12 col-sm-12 col-md-12';
                    break;
                case '2' :
                    $column = 'col-xs-12 col-sm-12 col-md-6';
                    break;
                case '3' :
                    $column = 'col-xs-12 col-sm-6 col-md-4';
                    break;
                case '4' :
                    $column = 'col-xs-12 col-sm-4 col-md-3';
                    break;
                case '5' :
                    $column = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
                    break;
            }
        }

        $team_autoplay = ( $atts['team_autoplay'] == '1' )?'true':'false';
        $team_autoplay_timeout = esc_attr( $atts['team_autoplay_timeout'] );
        $team_autoplay_hover = ( $atts['team_autoplay_hover'] == '1' )?'true':'false';
        $team_loop = ( $atts['team_loop'] == '1' )?'true':'false';
        $team_pagination = ( $atts['team_pagination'] == '1' )?'true':'false';

        $member_thumbnail_hover_bg = esc_attr( $atts['member_thumbnail_hover_bg_color'] );
        $member_thumbnail_hover_color = esc_attr( $atts['member_thumbnail_hover_color'] );

        $member_thumbnail_hover_bg = ( !empty($member_thumbnail_hover_bg) )?'background-color:'.$member_thumbnail_hover_bg.'; ':'';
        $member_thumbnail_hover_color = ( !empty($member_thumbnail_hover_color) )?'color:'.$member_thumbnail_hover_color.'; ':'';
        $member_thumbnail_style = ( !empty($member_thumbnail_hover_color) || !empty($member_thumbnail_hover_bg) )?'style="'.$member_thumbnail_hover_color.$member_thumbnail_hover_bg.'"':'';
        
        $atts['circle_avatar'] = ($atts['circle_avatar'] == '1')?'img-circle':'';
        $atts['member_thumbnail_gs_filter'] = ( $atts['member_thumbnail_gs_filter'] == '1' )?'has-grayscale':'';

        $team_thumb_args  = array( 'class' => $atts['circle_avatar'].' team-thumbnail' ); 

        if( $atts['team_type'] != '1' ){
            $atts['team_gutter'] = ( empty($atts['team_gutter']) )?'0':intval($atts['team_gutter']/2);
            $team_gutter_style = 'padding: '.$atts['team_gutter'].'px; ';
            $team_gutter_row_style = 'style="margin: 0px -'.$atts['team_gutter'].'px"';
        }

        $args = array(
            'post_type' => 'team',
            'posts_per_page'    => $atts['posts'],
            'tax_query' => $team_cat,
            'orderby' => $atts['order_by'],
            'order'   => $atts['order'],
        );
        // The Query
        $team_query = new WP_Query( $args ); 

        $i = $delay = 0; 
        // Check if the Query returns any posts
        if ( $team_query->have_posts() ) {
            while( $team_query->have_posts() ) : $team_query->the_post();  
                
                $member_links = $member_content_not_4 = $member_content_4 = $member_thumbnail = $team_animation_class = $team_animation_attr = $team_animation_style = '';
                
                $member_image_id = esc_attr( get_post_meta( $post->ID , 'member_image_url_id' , true ) );
                $member_name = ( $atts['member_show_name'] == '1' )?esc_attr( get_post_meta( $post->ID , 'member_name' , true ) ):'';
                $member_name_link = esc_url( get_post_meta( $post->ID , 'member_name_link' , true ) );
                $member_designation = ( $atts['member_show_designation'] == '1' )?esc_attr( get_post_meta( $post->ID , 'member_designation' , true ) ):'';
                $member_line = esc_attr( get_post_meta( $post->ID , 'member_line' , true ) );
                $member_description = ( $atts['member_show_description'] == '1' )?esc_attr( get_post_meta( $post->ID , 'member_description' , true ) ):'';
                        
                $member_facebook_link = esc_url( get_post_meta( $post->ID , 'member_facebook_link' , true ) );
                $member_twitter_link = esc_url( get_post_meta( $post->ID , 'member_twitter_link' , true ) );
                $member_google_plus_link = esc_url( get_post_meta( $post->ID , 'member_google_plus_link' , true ) );
                $member_vk_link = esc_url( get_post_meta( $post->ID , 'member_vk_link' , true ) );
                $member_behance_link = esc_url( get_post_meta( $post->ID , 'member_behance_link' , true ) );
                $member_pinterest_link = esc_url( get_post_meta( $post->ID , 'member_pinterest_link' , true ) );
                $member_dribbble_link = esc_url( get_post_meta( $post->ID , 'member_dribbble_link' , true ) );
                $member_skype_link = esc_attr( get_post_meta( $post->ID , 'member_skype_link' , true ) );
                $member_linkedin_link = esc_url( get_post_meta( $post->ID , 'member_linkedin_link' , true ) );
                $member_envelope_link = esc_attr( get_post_meta( $post->ID , 'member_envelope_link' , true ) );

                $member_number = esc_attr( get_post_meta( $post->ID , 'member_number' , true ) );
                
                $member_links_array = array('facebook', 'twitter', 'google-plus', 'vk', 'behance', 'pinterest', 'dribbble', 'skype', 'linkedin', 'envelope');
                foreach ($member_links_array as $key => $member_links_class ) {
                    $member_links_prefix = '';
                    $member_links_href = str_replace('-', '_', $member_links_class);
                    if( !empty(${'member_' . $member_links_href . '_link'}) ){
                        $member_links_prefix = ( $member_links_class == 'envelope' )?'mailto:':'';
                        $member_links .= '<li><a href="'.$member_links_prefix.${'member_' . $member_links_href . '_link'}.'"><i class=" fa fa-'.$member_links_class.'" ></i></a></li>';
                    }
                }
                
                if( !empty($member_name) ){
                    if( !empty($member_name_link) ){
                        $member_name = '<a href="'.$member_name_link.'">'.$member_name.'</a>';
                    }
                    $member_name = '<h6 class="member-title">'.$member_name.'</h6>';
                }   
                
                if( !empty($member_designation) ){
                    $member_designation = '<p class="member-designation-text">'.$member_designation.'</p>'; 
                }
                
                if( $member_line == 'on' ){
                    $member_line = '<div class="member-divide-line divide-line"><span></span></div>';
                }   

                if( !empty($member_description) ){
                    $member_description = '<p class="member-description-text">'.$member_description.'</p>'; 
                }

                $member_links = '<ul class="list-inline">'.$member_links.'</ul>';
                $member_meta = '<div class="member-meta">
                    '.$member_links.'
                    <span class="member-contact">'.$member_number.'</span>
                </div>';

                $has_bottom_caption = ( $atts['team_style'] == '2' )?'has-bottom-caption':'';

               if( $atts['team_style'] != '4' ){
                    $member_content_not_4 = $member_name.$member_designation.$member_line;  
                }
                else{
                    $member_content_4 = '<div class="member-bottom-caption">'.$member_name.$member_designation.$member_line.'</div>';
                }

                if( $atts['member_show_thumbnail'] == '1' ){
                    if( $atts['member_thumbnail_hardcrop'] == '1' ){
                        $member_thumbnail_customcrop_dimension = explode( 'x', $atts['member_thumbnail_custom'] );
                        $member_thumbnail = agni_thumbnail_customcrop( $member_image_id, $member_thumbnail_customcrop_dimension[0].'x'.$member_thumbnail_customcrop_dimension[1], $atts['circle_avatar'] );
                    }
                    else{
                        $member_thumbnail = wp_get_attachment_image( $member_image_id, 'fortun-standard-thumbnail', '', $team_thumb_args );
                    }
                }

                $delay += esc_attr( $atts['animation_delay'] ); // Animation Delay
                $duration = esc_attr( $atts['animation_duration'] );  // Animation Duration
                $i += 1;  // Animation Iteration
                if( $atts['animation'] == '1' ){
                    $team_animation_class = 'animate ';
                    $team_animation_attr = 'data-animation="'.esc_attr( $atts['animation_style'] ).'" data-animation-offset="'.esc_attr( $atts['animation_offset'] ).'"';
                    $team_animation_style = 'animation-duration: '.$duration.'s;    animation-delay: '.$delay.'s; -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s';
                }

                $output .= '<div id="member-post-'.$post->ID.'" class="'.$team_animation_class.'member-column '.$column.' '.join( ' ', get_post_class() ).' '.esc_attr( $atts['member_thumbnail_gs_filter'] ).'" style="'.$team_gutter_style.$team_animation_style.'" '.$team_animation_attr.'>
                    <div class="member-content member-post '.$has_bottom_caption.' member-style-'.esc_attr( $atts['team_style'] ).'">
                        <div class="member-container" '.$member_thumbnail_style.'>
                            <div class="member-thumbnail">
                                '.$member_thumbnail.'
                            </div>
                            <div class="member-caption-content">
                                <div class="member-content">
                                    <div class="member-content-details">
                                    '.$member_content_not_4.$member_description.$member_meta.'
                                    </div>
                                </div>
                            </div>
                        </div>
                        '.$member_content_4.'
                    </div>
                </div>';
            endwhile; 
        } 

        $atts['team_type'] = ( $atts['team_type'] == '1' )? 'carousel-team':'grid-team row';

        $output = '<div class="'.$atts['team_type'].' '.$atts['class'].'" data-team-gutter="'.esc_attr( $atts['team_gutter'] ).'" data-team-autoplay="'.$team_autoplay.'" data-team-autoplay-timeout="'.$team_autoplay_timeout.'" data-team-autoplay-hover="'.$team_autoplay_hover.'" data-team-loop="'.$team_loop.'" data-team-pagination="'.$team_pagination.'" '.$carousel_column.' '.$team_gutter_row_style.'>'.$output.'</div>';

        wp_reset_postdata();

        return $output;
    }
}

// Clients 
if( !function_exists('agni_clients') ){
    function agni_clients( $atts ){

        global $post;
        $output = $client_cat = $client_bg_color = $client_border_color = $client_padding = $column = $carousel_column = $client_gutter_style = $client_gutter_row_style = $client_filter = '';

        $clients_autoplay = ( $atts['clients_autoplay'] == '1' )?'true':'false';
        $clients_autoplay_timeout = esc_attr( $atts['clients_autoplay_timeout'] );
        $clients_autoplay_hover = ( $atts['clients_autoplay_hover'] == '1' )?'true':'false';
        $clients_loop = ( $atts['clients_loop'] == '1' )?'true':'false';
        $clients_pagination = ( $atts['clients_pagination'] == '1' )?'true':'false';

        if( $atts['type'] == '1' ){
            switch( $atts['column'] ){
                case '2' :
                    $carousel_column = 'data-client-0="1" data-client-768="2" data-client-992="2" data-client-1200="2"';
                    break;
                case '3' :
                    $carousel_column = 'data-client-0="1" data-client-768="2" data-client-992="3" data-client-1200="3"';
                    break;
                case '4' :
                    $carousel_column = 'data-client-0="1" data-client-768="3" data-client-992="4" data-client-1200="4"';
                    break;
                case '5' :
                    $carousel_column = 'data-client-0="1" data-client-768="3" data-client-992="4" data-client-1200="5"';
                    break;
                case '6' :
                    $carousel_column = 'data-client-0="2" data-client-768="4" data-client-992="5" data-client-1200="6"';
                    break;
                default :
                    $carousel_column = 'data-client-0="1" data-client-768="1" data-client-992="1" data-client-1200="1"';

            }
        }
        else{
            switch( $atts['column'] ){
                case '2' :
                    $column = 'col-xs-12 col-sm-6 col-md-6';
                    break;
                case '3' :
                    $column = 'col-xs-12 col-sm-6 col-md-4';
                    break;
                case '4' :
                    $column = 'col-xs-12 col-sm-4 col-md-3';
                    break;
                case '5' :
                    $column = 'col-xs-12 col-sm-4 col-md-3 col-lg-2_5';
                    break;
                case '6' :
                    $column = 'col-xs-6 col-sm-3 col-md-3 col-lg-2';
                    break;
                default :
                    $column = 'col-xs-12 col-sm-4 col-md-3';
            }
        }

        $client_display_style = (!empty($atts['client_display_style']))?'has-'.$atts['client_display_style']:'' ; 
        $atts['client_gs_filter'] = ( $atts['client_gs_filter'] == '1' )?'has-grayscale':'';
        $atts['client_invert_filter'] = ( $atts['client_invert_filter'] == '1' )?'has-invert':'';

        if( !empty($atts['client_invert_filter']) || !empty($atts['client_gs_filter']) ){
            $client_filter = ' filter: ';
            $client_filter .= ( !empty($atts['client_gs_filter']) )?'grayscale(100%) ':'';
            $client_filter .= ( !empty($atts['client_invert_filter']) )?'invert(100%)':'';
        }

        $cli_thumb_args = array( 'style' => 'opacity: '.$atts['client_opacity'].'' );

        if( $atts['type'] != '1' ){
            $atts['client_gutter'] = ( empty($atts['client_gutter']) )?'0':intval($atts['client_gutter']/2);
            $client_gutter_style = 'padding: '.$atts['client_gutter'].'px; ';
            $client_gutter_row_style = 'style="margin: 0px -'.$atts['client_gutter'].'px"';
        }

        if( !empty($atts['client_categories']) ){
            $client_cat = array( array(
                'taxonomy' => 'client_types',
                'field' => 'slug',
                'terms' =>  explode( ',', $atts['client_categories'] )  
            ) );
        }

        $args = array(
            'post_type' => 'clients',
            'posts_per_page'    => $atts['posts'],
            'tax_query' => $client_cat,
            'orderby' => $atts['order_by'],
            'order'   => $atts['order'],
        );
        // The Query
        $clients_query = new WP_Query( $args );

        $i = $delay = 0; 
        // Check if the Query returns any posts
        if ( $clients_query->have_posts() ) {
            while( $clients_query->have_posts() ) : $clients_query->the_post(); 
                $client = $client_style = $client_animation_class = $client_animation_attr = $client_animation_style = '';

                $clients_image = esc_attr( get_post_meta( $post->ID , 'clients_image_id' , true ) );
                $clients_image_link = esc_attr( get_post_meta( $post->ID  , 'clients_image_link' , true ) ); 

                if( $atts['client_display_style'] == 'background' ){
                    $client_style = 'background-color: '.$atts['client_bg_color'].'; ';
                }
                else if( $atts['client_display_style'] == 'border' ){
                    $client_style = 'border-color: '.$atts['client_border_color'].'; ';
                }

                if( !empty($atts['client_padding']) ){
                    $client_style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['client_padding'] ) ? $atts['client_padding'] : $atts['client_padding'] . 'px' ) . '; ';
                }
                if( !empty($client_style) ){ 
                    $client_style = 'style="'.$client_style.'"'; 
                }

                if( $clients_image_link != '' ){    
                    $client = '<a href="'.$clients_image_link.'">'.wp_get_attachment_image( $clients_image, 'full', '', $cli_thumb_args  ).'</a>';
                } else{ 
                    $client = wp_get_attachment_image( $clients_image, 'full', '', $cli_thumb_args );
                } 

                $delay += esc_attr( $atts['animation_delay'] ); // Animation Delay
                $duration = esc_attr( $atts['animation_duration'] );  // Animation Duration
                $i += 1;  // Animation Iteration
                if( $atts['animation'] == '1' ){
                    $client_animation_class = 'animate ';
                    $client_animation_attr = 'data-animation="'.esc_attr( $atts['animation_style'] ).'" data-animation-offset="'.esc_attr( $atts['animation_offset'] ).'"';
                    $client_animation_style = 'animation-duration: '.$duration.'s;  animation-delay: '.$delay.'s; -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s';
                }

                $output .= '<div id="post-'.$post->ID.'" class="'.$client_animation_class.'client-column '.$column.' '.join( ' ', get_post_class() ).' '.esc_attr( $atts['client_gs_filter'] ).' '.esc_attr( $atts['client_invert_filter'] ).'" style="'.$client_gutter_style.$client_animation_style.$client_filter.'" '.$client_animation_attr.'>
                    <div class="client '.$client_display_style.'" '.$client_style.'>
                        '.$client.'
                    </div>
                </div>'; 

            endwhile; 
        } 

        $atts['type'] = ( $atts['type'] == '1' )?'carousel-clients':'grid-clients row'; 

        $output = '<div class="agni-clients '.esc_attr( $atts['type'] ).'" data-clients-gutter="'.esc_attr( $atts['client_gutter'] ).'" data-clients-autoplay="'.$clients_autoplay.'" data-clients-autoplay-timeout="'.$clients_autoplay_timeout.'" data-clients-autoplay-hover="'.$clients_autoplay_hover.'" data-clients-loop="'.$clients_loop.'" data-clients-pagination="'.$clients_pagination.'" '.$carousel_column.' '.$client_gutter_row_style.'>'.$output.'</div>';
        
        wp_reset_postdata();
        
        return $output;
    }  
}

// Agni Testimonials
if( !function_exists('agni_testimonials') ){
    function agni_testimonials( $atts ){

        global $post;
        $output = $quote_cat = $carousel_column = $column = $testimonial_gutter_row_style = $testimonial_gutter_style = '';
        
        if( $atts['type'] == '1' ){
            switch( $atts['column'] ){
                case '1' :
                    $carousel_column = 'data-test-0="1" data-test-768="1" data-test-992="1" data-test-1200="1"';
                    break;
                case '2' :
                    $carousel_column = 'data-test-0="1" data-test-768="1" data-test-992="2" data-test-1200="2"';
                    break;
                case '3' :
                    $carousel_column = 'data-test-0="1" data-test-768="2" data-test-992="3" data-test-1200="3"';
                    break;
                case '4' :
                    $carousel_column = 'data-test-0="1" data-test-768="2" data-test-992="4" data-test-1200="4"';
                    break;
                case '5' :
                    $carousel_column = 'data-test-0="1" data-test-768="2" data-test-992="4" data-test-1200="5"';
                    break;
            }
        }
        else{
            switch( $atts['column'] ){
                case '1' :
                    $column = 'col-xs-12 col-sm-12 col-md-12';
                    break;
                case '2' :
                    $column = 'col-xs-12 col-sm-12 col-md-6';
                    break;
                case '3' :
                    $column = 'col-xs-12 col-sm-6 col-md-4';
                    break;
                case '4' :
                    $column = 'col-xs-12 col-sm-6 col-md-3';
                    break;
                case '5' :
                    $column = 'col-xs-12 col-sm-6 col-md-3 col-lg-2_5';
                    break;
            }
        }

        $testimonial_autoplay = ( $atts['testimonial_autoplay'] == '1' )?'true':'false';
        $testimonial_autoplay_timeout = esc_attr( $atts['testimonial_autoplay_timeout'] );
        $testimonial_autoplay_speed = esc_attr( $atts['testimonial_autoplay_speed'] );
        $testimonial_autoplay_hover = ( $atts['testimonial_autoplay_hover'] == '1' )?'true':'false';
        $testimonial_loop = ( $atts['testimonial_loop'] == '1' )?'true':'false';
        $testimonial_pagination = ( $atts['testimonial_pagination'] == '1' )?'true':'false';

        $atts['testimonial_display_style'] = ( !empty($atts['testimonial_display_style']) )?'has-'.$atts['testimonial_display_style']:'';
        $atts['testimonial_thumbnail_gs_filter'] = ( $atts['testimonial_thumbnail_gs_filter'] == '1' )?'has-grayscale':'';
        $test_args = array( 'class' => ($atts['circle_avatar'] == '1')?'img-circle':''.' testimonial-thumbnail' ); 

        if( $atts['type'] != '1' ){
            $atts['testimonial_gutter'] = ( empty($atts['testimonial_gutter']) )?'0':intval($atts['testimonial_gutter']/2);
            $testimonial_gutter_style = 'padding: '.$atts['testimonial_gutter'].'px; ';
            $testimonial_gutter_row_style = 'style="margin: 0px -'.$atts['testimonial_gutter'].'px"';
        }

        if(!empty($atts['testimonial_categories'])){
            $quote_cat = array( array(
                'taxonomy' => 'quote_types',
                'field' => 'slug',
                'terms' =>  explode( ',', $atts['testimonial_categories'] )  
            ) ) ;
        }
        $args = array(
            'post_type' => 'testimonials',
            'posts_per_page'    => $atts['posts'],
            'tax_query' => $quote_cat,
            'orderby' => $atts['order_by'],
            'order'   => $atts['order'],
        );
        // The Query

        $testimonials_query = new WP_Query( $args ); 

        $i = $delay = 0; 
        // Check if the Query returns any posts
        if ( $testimonials_query->have_posts() ) {
            while( $testimonials_query->have_posts() ) : $testimonials_query->the_post();           
                
                $testimonial_image = $testimonial_style = $testimonial_content = $testimonial_animation_class = $testimonial_animation_attr = $testimonial_animation_style = '';
                $testimonial_image = esc_attr( get_post_meta( $post->ID , 'testimonial_image_id' , true ) );
                $testimonial_quote = esc_attr( get_post_meta( $post->ID , 'testimonial_quote' , true ) );
                $testimonial_author = esc_attr( get_post_meta( $post->ID , 'testimonial_author' , true ) ); 
                $testimonial_author_designation = esc_attr( get_post_meta( $post->ID , 'testimonial_author_designation' , true ) );   

                if( !empty( $testimonial_author_designation ) ){
                    $testimonial_author_designation = '<p class="testimonial-quote-designation">'.$testimonial_author_designation.'</p>';
                }

                /* if( !empty($testimonial_image) || $testimonial_image != '0' ){
                    $testimonial_image = '<div class="testimonial-avatar">'.wp_get_attachment_image( $testimonial_image, 'thumbnail', '', $test_args ).'</div>';
                } */
                $testimonial_image = ( !empty($testimonial_image) || $testimonial_image != '0' )?'<div class="testimonial-avatar">'.wp_get_attachment_image( $testimonial_image, 'thumbnail', '', $test_args ).'</div>':'';

                if( !empty($testimonial_quote) ){
                    $testimonial_quote = '<p class="testimonial-quote-text">'.$testimonial_quote.'</p>';
                }
                if( !empty($testimonial_author) ){
                    $testimonial_author = '<p class="testimonial-quote-cite">'.$testimonial_author.'</p>';
                }

                if( $atts['testimonial_display_style'] == 'background' ){
                    $testimonial_style = 'background-color: '.$atts['testimonial_bg_color'].'; ';
                }
                else if( $atts['testimonial_display_style'] == 'border' ){
                    $testimonial_style = 'border-color: '.$atts['testimonial_border_color'].'; ';
                }

                if( !empty($atts['testimonial_padding']) ){
                    $testimonial_style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $atts['testimonial_padding'] ) ? $atts['testimonial_padding'] : $atts['testimonial_padding'] . 'px' ) . '; ';
                }

                $testimonial_style = ( !empty($testimonial_style) )?'style="'.$testimonial_style.'"':'';

                $testimonial_content = ( $atts['style'] == '1' )?$testimonial_image.$testimonial_quote:$testimonial_quote.$testimonial_image;

                $delay += $atts['animation_delay']; // Animation Delay
                $duration = $atts['animation_duration'];  // Animation Duration
                $i += 1;  // Animation Iteration
                if( $atts['animation'] == '1' ){
                    $testimonial_animation_class = 'animate ';
                    $testimonial_animation_attr = 'data-animation="'.esc_attr( $atts['animation_style'] ).'" data-animation-offset="'.esc_attr( $atts['animation_offset'] ).'"';
                    $testimonial_animation_style = 'animation-duration: '.$duration.'s;     animation-delay: '.$delay.'s; -webkit-animation-duration: '.$duration.'s; -webkit-animation-delay: '.$delay.'s';
                }

                $output .= '<div id="post-'.$post->ID.'" class="'.$testimonial_animation_class.'testimonial-column '.$column.' '.join( ' ', get_post_class() ).' '.$atts['testimonial_thumbnail_gs_filter'].'" style="'.$testimonial_gutter_style.$testimonial_animation_style.'" '.$testimonial_animation_attr.'>
                    <div class="testimonial-content text-'.esc_attr( $atts['alignment'] ).' testimonial-style-'.esc_attr( $atts['style'] ).' '.esc_attr( $atts['testimonial_display_style'] ).'" '.$testimonial_style.'>
                        '.$testimonial_content.'
                        <div class="testimonial-meta">
                            '.$testimonial_author.$testimonial_author_designation.'
                        </div>
                    </div>
                </div>';
            endwhile; 
        }  

        $atts['type'] = ( $atts['type'] == '1' )?'carousel-testimonials':'grid-testimonials row';

        $output = '<div class="'.esc_attr( $atts['type'] ).' '.esc_attr( $atts['class'] ).'" data-testimonial-gutter="'.esc_attr( $atts['testimonial_gutter'] ).'" data-testimonial-autoplay="'.$testimonial_autoplay.'" data-testimonial-autoplay-timeout="'.$testimonial_autoplay_timeout.'" data-testimonial-autoplay-speed="'.$testimonial_autoplay_speed.'" data-testimonial-autoplay-hover="'.$testimonial_autoplay_hover.'" data-testimonial-loop="'.$testimonial_loop.'" data-testimonial-pagination="'.$testimonial_pagination.'" '.$carousel_column.' '.$testimonial_gutter_row_style.'>'.$output.'</div>';

        wp_reset_postdata(); 

        return $output;

    }
}

    
if( !function_exists('agni_page_header') ){
    function agni_page_header( $post, $term = null ){
        
        if( $term == true ){
            $meta_fn = 'get_term_meta';
        }
        else{
            $meta_fn = 'get_post_meta';
        }

        $output = $slide_height = $slide_parallax = $page_header_overlay = '';
        $page_header_bg_choice = $page_header_bg_color = $page_header_bg_image = $page_header_bg_image_position = $page_header_bg_image_repeat = $page_header_bg_image_size = $agni_slide_bg_container_id = $page_header_bg_video_loop = $page_header_bg_video_autoplay = $page_header_bg_video_muted = $bg_video_loop = $bg_video_autoplay = $bg_video_muted = $page_header_overlay_choice = $page_header_overlay_color = $page_header_bg_sg_overlay_css = $page_header_bg_gm_overlay_color1 = $page_header_bg_gm_overlay_color2 = $page_header_bg_gm_overlay_color3 = $page_header_particle_ground = $page_header_bg = $page_header_size = $page_header_image = $page_header_title = $page_header_title_effect = $page_header_title_size = $page_header_title_color = $page_header_desc = $page_header_desc_size = $page_header_desc_color = $page_header_title_line = $page_header_title_line_color = $page_header_button1 = $page_header_button1_icon = $page_header_button1_url = $page_header_button1_style = $page_header_button1_type = $page_header_button1_radius = $page_header_button1_target = $page_header_button1_lightbox = $page_header_button2 = $page_header_button2_icon = $page_header_button2_url = $page_header_button2_style = $page_header_button2_type = $page_header_button2_radius = $page_header_button2_target = $page_header_button2_lightbox = $page_header_buttons = $page_header_has_animation = $page_header_animation_delay = $page_header_animation_delay_amount = $page_header_arrow = $page_header_arrowicon = $page_header_arrowlink = $page_header_arrowicon_color = $page_header_vertical_alignment = $page_header_text_alignment = $page_header_padding = $page_header_padding_top = $page_header_padding_bottom = $page_header_padding_right = $page_header_padding_left = '';
        
        $page_header_bg_choice = esc_attr( $meta_fn( $post, 'page_header_bg_choice', true ) );
        $page_header_bg_color = esc_attr( $meta_fn( $post, 'page_header_bg_color', true ) );
        $page_header_bg_image = esc_attr( $meta_fn( $post, 'page_header_bg_image', true ) );
        $page_header_bg_image_position = esc_attr( $meta_fn( $post, 'page_header_bg_image_position', true ) );
        $page_header_bg_image_repeat = esc_attr( $meta_fn( $post, 'page_header_bg_image_repeat', true ) );
        $page_header_bg_image_size = esc_attr( $meta_fn( $post, 'page_header_bg_image_size', true ) );

        $page_header_bg_video_src = esc_attr( $meta_fn( $post, 'page_header_bg_video_src', true ) );
        $page_header_bg_video_src_yt = esc_url( $meta_fn( $post, 'page_header_bg_video_src_yt', true ) );
        $page_header_bg_video_src_yt_fallback = esc_url( $meta_fn( $post, 'page_header_bg_video_src_yt_fallback', true ) );
        $page_header_bg_video_src_sh = esc_url( $meta_fn( $post, 'page_header_bg_video_src_sh', true ) );
        $page_header_bg_video_src_sh_poster = esc_url( $meta_fn( $post, 'page_header_bg_video_src_sh_poster', true ) );
        $page_header_bg_video_loop = esc_attr( $meta_fn( $post, 'page_header_bg_video_loop', true ) );
        $page_header_bg_video_autoplay = esc_attr( $meta_fn( $post, 'page_header_bg_video_autoplay', true ) );
        $page_header_bg_video_muted = esc_attr( $meta_fn( $post, 'page_header_bg_video_muted', true ) );
        $page_header_bg_video_volume = esc_attr( $meta_fn( $post, 'page_header_bg_video_volume', true ) );
        $page_header_bg_video_quality = esc_attr( $meta_fn( $post, 'page_header_bg_video_quality', true ) );
        $page_header_bg_video_start_at = esc_attr( $meta_fn( $post, 'page_header_bg_video_start_at', true ) );
        $page_header_bg_video_stop_at = esc_attr( $meta_fn( $post, 'page_header_bg_video_stop_at', true ) );

        $page_header_overlay_choice = esc_attr( $meta_fn( $post, 'page_header_bg_overlay_choice', true ) );
        $page_header_overlay_color = esc_attr( $meta_fn( $post, 'page_header_bg_overlay_color', true ) );      
        $page_header_bg_sg_overlay_css = esc_attr( $meta_fn( $post, 'page_header_bg_sg_overlay_css', true ) );
        $page_header_bg_gm_overlay_color1 = esc_attr( $meta_fn( $post, 'page_header_bg_gm_overlay_color1', true ) );   
        $page_header_bg_gm_overlay_color2 = esc_attr( $meta_fn( $post, 'page_header_bg_gm_overlay_color2', true ) );   
        $page_header_bg_gm_overlay_color3 = esc_attr( $meta_fn( $post, 'page_header_bg_gm_overlay_color3', true ) );   

        $page_header_bg_particle_ground = esc_attr( $meta_fn( $post, 'page_header_bg_particle_ground', true ) );
        $page_header_bg_particle_ground_color = esc_attr( $meta_fn( $post, 'page_header_bg_particle_ground_color', true ) );       

        $page_header_image_id = esc_attr( $meta_fn( $post, 'page_header_image_id', true ) );
        $page_header_image_size = esc_attr( $meta_fn( $post, 'page_header_image_size', true ) );
        $page_header_image_size_tab = esc_attr( $meta_fn( $post, 'page_header_image_size_tab', true ) );
        $page_header_image_size_mobile = esc_attr( $meta_fn( $post, 'page_header_image_size_mobile', true ) );
        $page_header_title_choice = esc_attr( $meta_fn( $post, 'page_header_title_choice', true ) );
        $page_header_title = esc_attr( $meta_fn( $post, 'page_header_title', true ) );
        $page_header_title_rotator = esc_attr( $meta_fn( $post, 'page_header_title_rotator', true ) );
        $page_header_title_rotator_choice = esc_attr( $meta_fn( $post, 'page_header_title_rotator_choice', true ) );
        $page_header_title_size = esc_attr( $meta_fn( $post, 'page_header_title_size', true ) );   
        $page_header_title_color = esc_attr( $meta_fn( $post, 'page_header_title_color', true ) ); 
        $page_header_title_font = esc_attr( $meta_fn( $post, 'page_header_title_font', true ) );
        $page_header_title_line = esc_attr( $meta_fn( $post, 'page_header_line', true ) );
        $page_header_title_line_color = esc_attr( $meta_fn( $post, 'page_header_line_color', true ) );
        $page_header_desc = esc_attr( $meta_fn( $post, 'page_header_desc', true ) );   
        $page_header_desc_size = esc_attr( $meta_fn( $post, 'page_header_desc_size', true ) );
        $page_header_desc_color = esc_attr( $meta_fn( $post, 'page_header_desc_color', true ) );   
        $page_header_desc_font = esc_attr( $meta_fn( $post, 'page_header_desc_font', true ) );
        $page_header_arrowicon = esc_attr( $meta_fn( $post, 'page_header_arrowicon', true ) );
        $page_header_arrowlink = esc_url( $meta_fn( $post, 'page_header_arrowlink', true ) );
        $page_header_arrowicon_color = esc_attr( $meta_fn( $post, 'page_header_arrowicon_color', true ) );
        $page_header_button1 = esc_attr( $meta_fn( $post, 'page_header_button1', true ) );
        $page_header_button1_icon = esc_attr( $meta_fn( $post, 'page_header_button1_icon', true ) );
        $page_header_button1_url = esc_url( $meta_fn( $post, 'page_header_button1_url', true ) );
        $page_header_button1_style = esc_attr( $meta_fn( $post, 'page_header_button1_style', true ) );
        $page_header_button1_type = esc_attr( $meta_fn( $post, 'page_header_button1_type', true ) );
        $page_header_button1_radius = esc_attr( $meta_fn( $post, 'page_header_button1_radius', true ) );
        $page_header_button1_target = esc_attr( $meta_fn( $post, 'page_header_button1_target', true ) );
        $page_header_button1_lightbox = esc_attr( $meta_fn( $post, 'page_header_button1_lightbox', true ) );
        $page_header_button2 = esc_attr( $meta_fn( $post, 'page_header_button2', true ) );
        $page_header_button2_icon = esc_attr( $meta_fn( $post, 'page_header_button2_icon', true ) );
        $page_header_button2_url = esc_url( $meta_fn( $post, 'page_header_button2_url', true ) );
        $page_header_button2_style = esc_attr( $meta_fn( $post, 'page_header_button2_style', true ) );
        $page_header_button2_type = esc_attr( $meta_fn( $post, 'page_header_button2_type', true ) );
        $page_header_button2_radius = esc_attr( $meta_fn( $post, 'page_header_button2_radius', true ) );
        $page_header_button2_target = esc_attr( $meta_fn( $post, 'page_header_button2_target', true ) );
        $page_header_button2_lightbox = esc_attr( $meta_fn( $post, 'page_header_button2_lightbox', true ) );
        $page_header_breadcrumb = esc_attr( $meta_fn( $post, 'page_header_breadcrumb', true ) );
        $page_header_breadcrumb_color = esc_attr( $meta_fn( $post, 'page_header_breadcrumb_color', true ) );
        $page_header_animation = esc_attr( $meta_fn( $post, 'page_header_animation', true ) );
        $page_header_vertical_alignment = esc_attr( $meta_fn( $post, 'page_header_vertical_alignment', true ) );
        $page_header_text_alignment = esc_attr( $meta_fn( $post, 'page_header_text_alignment', true ) );
        $page_header_padding_top = esc_attr( $meta_fn( $post, 'page_header_padding_top', true ) );
        $page_header_padding_bottom = esc_attr( $meta_fn( $post, 'page_header_padding_bottom', true ) );
        $page_header_padding_right = esc_attr( $meta_fn( $post, 'page_header_padding_right', true ) );
        $page_header_padding_left = esc_attr( $meta_fn( $post, 'page_header_padding_left', true ) );
        
        $page_header_choice = esc_attr( $meta_fn( $post, 'page_header_choice', true ) );
        $page_header_height = esc_attr( $meta_fn( $post, 'page_header_height', true ) );
        $page_header_height_tab = esc_attr( $meta_fn( $post, 'page_header_height_tab', true ) );
        $page_header_height_mobile = esc_attr( $meta_fn( $post, 'page_header_height_mobile', true ) );
        $page_header_parallax = esc_attr( $meta_fn( $post, 'page_header_parallax', true ) );
        $page_header_parallax_start = esc_attr( $meta_fn( $post, 'page_header_parallax_start', true ) );
        $page_header_parallax_end = esc_attr( $meta_fn( $post, 'page_header_parallax_end', true ) );

        if( !empty( $page_header_bg_image ) || $page_header_bg_choice != 'bg_image' ){
            if( $page_header_choice == '1' ){
                $slide_height = 'data-fullscreen-height = 1';
            }
            else{
                $slide_height = 'data-height="'.$page_header_height.'" data-height-tab="'.$page_header_height_tab.'" data-height-mobile="'.$page_header_height_mobile.'"';
            }
            
            if( $page_header_parallax == 'on' ){
                $slide_parallax = 'data-0="'.$page_header_parallax_start.'" data-1500="'.$page_header_parallax_end.'"';
            }   

            if( !empty($page_header_animation) ){
                $page_header_has_animation = 'has-slide-content-animation';
                $page_header_animation_delay_amount = 0;
            }
            if( !empty($page_header_image_id) ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_image_width = 'data-width="'.$page_header_image_size.'" data-width-tab="'.$page_header_image_size_tab.'" data-width-mobile="'.$page_header_image_size_mobile.'"';

                $page_header_image = '<div class="agni-slide-image '.$page_header_animation.'" style="'.$page_header_animation_delay.'" '.$page_header_image_width.'>'.wp_get_attachment_image($page_header_image_id, 'full' ).'</div>';
            }

            $page_header_title = ( $page_header_title_choice == '2' )?get_the_title():$page_header_title;
            if ( !empty( $page_header_title ) ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }

                if ( strpos($page_header_title, '|') !== false && $page_header_title_rotator == 'on') {
                    $page_header_title_span = $page_header_title_no_span[0] = $page_header_title_no_span[1] = '';

                    $page_header_title_effect = 'class="cd-headline '.$page_header_title_rotator_choice.'"';

                    $page_header_title_decode = htmlspecialchars_decode( $page_header_title );
                    $pattern = '/<span>(.*?)<\/span>/';
                    $page_header_title_no_span  = preg_split( $pattern, $page_header_title_decode );

                    $page_header_title_span_content = substr($page_header_title_decode, strpos($page_header_title_decode, "<span>") + 0);
                    $page_header_title_span_content = substr($page_header_title_span_content, 0, strpos($page_header_title_span_content, "</span>") + 7);
                    $page_header_title_span_content = explode( "|", $page_header_title_span_content );
                    foreach( $page_header_title_span_content as $page_header_title_span_text ){
                        $page_header_title_span .=  '<span class="rotate">'.$page_header_title_span_text.'</span>';
                    }
                    $page_header_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $page_header_title_span);
                    
                    $page_header_title = $page_header_title_no_span[0].$page_header_title_span.$page_header_title_no_span[1];
                }
                $page_header_title = '<div class="agni-slide-title '.$page_header_animation.' '.$page_header_title_font.'" style="font-size:'.$page_header_title_size.'px; color:'.$page_header_title_color.';'.$page_header_animation_delay.'"><'.apply_filters( 'agni_page_header_h_tag', $args = '' ).' '.$page_header_title_effect.'>'.htmlspecialchars_decode( $page_header_title ).'</'.apply_filters( 'agni_page_header_h_tag', $args = '' ).'></div>';

            }

            if ( $page_header_title_line == 'on' ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = 'style="-webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;"';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_title_line = '<div class="agni-slide-divideline divide-line '.$page_header_animation.'" '.$page_header_animation_delay.'><span style="background-color:'.$page_header_title_line_color.'"></span></div>';  
            }
            
            if ( !empty( $page_header_desc ) ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_desc = '<div class="agni-slide-description '.$page_header_animation.' '.$page_header_desc_font.'" style="font-size:'.$page_header_desc_size.'px; color:'.$page_header_desc_color.';'.$page_header_animation_delay.'"><p>'.htmlspecialchars_decode( $page_header_desc ).'</p></div>';
            }
            if( $page_header_breadcrumb == 'on' ){
                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = ' -webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;';
                    $page_header_animation_delay_amount += 250;
                }
                ob_start();
                agni_breadcrumb_navigation();
                $page_header_breadcrumb = ob_get_clean();
                $page_header_breadcrumb = '<div class="agni-page-header-breadcrumb '.$page_header_animation.'" style="color:'.$page_header_breadcrumb_color.'; '.$page_header_animation_delay.'">'.$page_header_breadcrumb.'</div>';
            }

            if ( !empty($page_header_arrowicon) ){
                $page_header_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$page_header_arrowlink.'" style="color:'.$page_header_arrowicon_color.'"><i class="'.
            $page_header_arrowicon.'"></i></a></div>';
            }

            if( !empty($page_header_button1) ){

                if( !empty($page_header_button1_icon) ){
                    $page_header_button1_icon = '<i class="'.$page_header_button1_icon.'"></i>';
                }
                if( $page_header_button1_lightbox == 'on' ){
                    $page_header_button1_lightbox = 'custom-video-link has-video-lightbox';
                }
                if( !empty($page_header_button1_radius) ){
                    $page_header_button1_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_button1_radius ) ? $page_header_button1_radius : $page_header_button1_radius . 'px' ).';"';
                }

                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = 'style="-webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;"';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-1 page-scroll '.$page_header_button1_lightbox.' '.$page_header_animation.'" '.$page_header_animation_delay.'><a class="btn btn-'.$page_header_button1_style.' '.$page_header_button1_type.'" href="'.$page_header_button1_url.'" target="'.$page_header_button1_target.'" '.$page_header_button1_radius.'>'.$page_header_button1.$page_header_button1_icon.'</a></div>';

            }
            if( !empty($page_header_button2) ){

                if( !empty($page_header_button2_icon) ){
                    $page_header_button2_icon = '<i class="'.$page_header_button2_icon.'"></i>';
                }
                if( $page_header_button2_lightbox == 'on' ){
                    $page_header_button2_lightbox = 'custom-video-link has-video-lightbox';
                }
                if( !empty($page_header_button2_radius) ){
                    $page_header_button2_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_button2_radius ) ? $page_header_button2_radius : $page_header_button2_radius . 'px' ).';"';
                }

                if( $page_header_has_animation == 'has-slide-content-animation'){
                    $page_header_animation_delay = 'style="-webkit-animation-delay: '.$page_header_animation_delay_amount.'ms; animation-delay: '.$page_header_animation_delay_amount.'ms;"';
                    $page_header_animation_delay_amount += 250;
                }
                $page_header_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-2 page-scroll '.$page_header_button2_lightbox.' '.$page_header_animation.'" '.$page_header_animation_delay.'><a class="btn btn-'.$page_header_button2_style.' '.$page_header_button2_type.'" href="'.$page_header_button2_url.'" target="'.$page_header_button2_target.'" '.$page_header_button2_radius.'>'.$page_header_button2.$page_header_button2_icon.' </a></div>';
            }
            if( !empty($page_header_buttons) ){
                $page_header_buttons = '<div class="agni-slide-buttons">'.$page_header_buttons.'</div>';
            } 
            
            // Content Padding              
            $page_header_padding .= 'padding-top:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_padding_top ) ? $page_header_padding_top : $page_header_padding_top . 'px' ).';';
                $page_header_padding .= 'padding-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_padding_bottom ) ? $page_header_padding_bottom : $page_header_padding_bottom . 'px' ).';';
                $page_header_padding .= 'padding-right:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_padding_right ) ? $page_header_padding_right : $page_header_padding_right . 'px' ).';';
                $page_header_padding .= 'padding-left:'.( preg_match( '/(px|em|\%|pt|cm)$/', $page_header_padding_left ) ? $page_header_padding_left : $page_header_padding_left . 'px' ).';';
                
            
            // BG
            if ( $page_header_bg_choice == 'bg_color' ){
                $page_header_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$page_header_bg_color.'; "></div>';
            }
            else if( $page_header_bg_choice == 'bg_image' ){
                $page_header_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.esc_url( $page_header_bg_image ).'); background-repeat:'.$page_header_bg_image_repeat.'; background-position:'.$page_header_bg_image_position.'; background-size:'.$page_header_bg_image_size.'; "></div>';
            }
            else if( $page_header_bg_choice == 'bg_video' ){

                if( $page_header_bg_video_loop == 'on'){
                    $page_header_bg_video_loop = 'true';
                    $bg_video_loop = 'loop ';
                }
                else{
                    $page_header_bg_video_loop = 'false';
                }
                
                if( $page_header_bg_video_autoplay == 'on'){
                    $page_header_bg_video_autoplay = 'true';
                    $bg_video_autoplay = 'autoplay ';
                }
                else{
                    $page_header_bg_video_autoplay = 'false';
                }
                
                if( $page_header_bg_video_muted == 'on'){
                    $page_header_bg_video_muted = 'true';
                    $bg_video_muted = 'muted ';
                }
                else{
                    $page_header_bg_video_muted = 'false';
                }

                if( $page_header_bg_video_src == '1' ){
                    $agni_slide_bg_container_id = 'agni-slide-bg-container-'.rand(10000, 99999);
                    $page_header_bg = '<a id="bgndVideo-'.$post.'" class="player" style="background-image:url('.$page_header_bg_video_src_yt_fallback.');" data-property="{videoURL:\''.$page_header_bg_video_src_yt.'\',containment:\'.'.$agni_slide_bg_container_id.'\', showControls:false, autoPlay:'.$page_header_bg_video_autoplay.', loop:'.$page_header_bg_video_loop.', vol:'.$page_header_bg_video_volume.', mute:'.$page_header_bg_video_muted.', startAt:'.$page_header_bg_video_start_at.', stopAt:'.$page_header_bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$page_header_bg_video_quality.'\',}"></a>
                        <div class="section-video-controls">
                            <a class="command command-play" href="#"></a>
                            <a class="command command-pause" href="#"></a>
                        </div>';
                }
                else if( $page_header_bg_video_src == '2' ){
                    $page_header_bg = '<div id="agni-selfhosted-video-'.$post.'" class="agni-slide-bg agni-slide-bg-video self-hosted embed-responsive">
                            <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.$page_header_bg_video_src_sh_poster.'">
                                <source src="'.$page_header_bg_video_src_sh.'" type="video/mp4">
                            </video>
                        </div>';
                }
            }
            else if( $page_header_bg_choice == 'bg_featured' ){
                $page_header_bg = '<div class="agni-slide-bg agni-slide-bg-image agni-slide-featured-image" style="background-image:url('.esc_url( get_the_post_thumbnail_url() ).'); background-repeat:'.$page_header_bg_image_repeat.'; background-position:'.$page_header_bg_image_position.'; background-size:'.$page_header_bg_image_size.'; "></div>';
            }
            
            // BG Overlay
            if ( $page_header_bg_choice != 'bg_color' && $page_header_overlay_choice != '4' ){
                if( $page_header_overlay_choice == '3' ){
                    $page_header_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$page_header_bg_gm_overlay_color1.','.$page_header_bg_gm_overlay_color2.','.$page_header_bg_gm_overlay_color3.' " style="background-image:url('.$page_header_bg_image.'); background-repeat:'.$page_header_bg_image_repeat.'; background-position:'.$page_header_bg_image_position.'; background-size:'.$page_header_bg_image_size.'; "></div>';
                }
                elseif ( $page_header_overlay_choice == '2' ) {
                    $page_header_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$page_header_bg_sg_overlay_css.';"></div>';
                }
                else{
                    $page_header_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$page_header_overlay_color.';"></div>';
                }
            }

            // BG particles
            if( $page_header_bg_particle_ground == 'on' ){
                $page_header_particle_ground = '<div class="particles" data-color="'.$page_header_bg_particle_ground_color.'"></div>';
            } 

            $output = '<div id="agni-page-header-'.$post.'" class="agni-slider agni-page-header" '.$slide_height.' data-slider-choice="'.$page_header_choice.'" data-slider-autoplay-timeout="5000" data-slider-smart-speed="250" data-slider-mousedrag="false" data-slider-nav="false" data-slider-dots="false" data-slider-autoplay="false" data-slider-loop="false" data-slider-animate-in="false" data-slider-animate-out="false" data-slider-992-items="1" data-slider-768-items="1" data-slider-0-items="1" data-slider-carousel-margin="0">
                <div class="agni-slide '.$page_header_has_animation.'" '.$slide_parallax.'>
                    <div class="agni-slide-bg-container '.$agni_slide_bg_container_id.'">'.$page_header_bg.$page_header_overlay.$page_header_particle_ground.'</div>
                    <div class="agni-slide-content-container container agni-slide-align-items-'.$page_header_vertical_alignment.' agni-slide-justify-content-'.$page_header_text_alignment.'">
                        <div class="agni-slide-content-inner page-scroll" style="'.$page_header_padding.'">
                            '.$page_header_image.$page_header_title.$page_header_title_line.$page_header_desc.$page_header_breadcrumb.$page_header_buttons.$page_header_arrow.'
                        </div>
                    </div>
                </div>
            </div>';
        }
        
        return $output;
    }
}

if( !function_exists('agni_slider') ){
    function agni_slider( $post, $shortcode = null ){
        global $fortun_options;
        
        $agni_slider_choice = get_post_meta( $post, 'agni_slides_choice', true );
        switch( $agni_slider_choice ){
        
            case 'slideshow' :

                $slides = $slideshow_animation = $slide_height = $slide_parallax = $slideshow_fullwidth_container = '';
                        
                $slideshow_repeatable = get_post_meta( $post, 'agni_slides_slideshow_repeatable', true );
                
                $slideshow_choice = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_choice', true ) );
                $slideshow_height = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height', true ) );
                $slideshow_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height_tab', true ) );
                $slideshow_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_height_mobile', true ) );
                $slideshow_carousel = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel', true ) );
                $slideshow_carousel_992 = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_992', true ) );
                $slideshow_carousel_768 = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_768', true ) );
                $slideshow_carousel_0 = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_0', true ) );
                $slideshow_carousel_margin = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_carousel_margin', true ) );
                $slideshow_parallax = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax', true ) );
                $slideshow_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax_start', true ) );
                $slideshow_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_parallax_end', true ) );
                $slideshow_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_animate_in', true ) );
                $slideshow_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_animate_out', true ) );
                $slideshow_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_autoplay', true ) ) == 'on')?'true':'false';
                $slideshow_loop = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_loop', true ) ) == 'on')?'true':'false';
                $slideshow_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_transition_duration', true ) );
                $slideshow_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_slideshow_transition_speed', true ) );
                $slideshow_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_navigation', true ) ) == 'on')?'true':'false';
                $slideshow_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_pagination', true ) ) == 'on')?'true':'false';
                $slideshow_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_slideshow_mousedrag', true ) ) == 'on')?'true':'false';


                if( $slideshow_choice == '1' ){
                    $slide_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slide_height = 'data-height="'.$slideshow_height.'" data-height-tab="'.$slideshow_height_tab.'" data-height-mobile="'.$slideshow_height_mobile.'"';
                }
                
                if( $slideshow_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$slideshow_parallax_start.'" data-1500="'.$slideshow_parallax_end.'"';
                }
                if( $slideshow_carousel == 'on' ){
                    $slideshow_carousel = 'data-slider-992-items="'.$slideshow_carousel_992.'" data-slider-768-items="'.$slideshow_carousel_768.'" data-slider-0-items="'.$slideshow_carousel_0.'" data-slider-carousel-margin="'.$slideshow_carousel_margin.'"';
                    $slideshow_fullwidth_container = '-fluid';
                }
                else{
                    $slideshow_carousel = 'data-slider-992-items="1" data-slider-768-items="1" data-slider-0-items="1" data-slider-carousel-margin="0"';
                }
                
                foreach( (array) $slideshow_repeatable as $key => $slide ){
                    $slideshow_bg_choice = $slideshow_bg_color = $slideshow_bg_image = $slideshow_bg_image_position = $slideshow_bg_image_repeat = $slideshow_bg_image_size = $slideshow_overlay =  $slideshow_overlay_choice = $slideshow_overlay_color = $slideshow_bg_sg_overlay_css = $slideshow_bg_gm_overlay_color1 = $slideshow_bg_gm_overlay_color2 = $slideshow_bg_gm_overlay_color3 = $slideshow_particle_ground = $slideshow_bg_particle_ground = $slideshow_bg_particle_ground_color = $slideshow_bg = $slideshow_size = $slideshow_image_width = $slideshow_image = $slideshow_title = $slideshow_title_effect = $slideshow_title_size = $slideshow_title_color = $slideshow_desc = $slideshow_desc_size = $slideshow_desc_color = $slideshow_title_line = $slideshow_title_line_color = $slideshow_button1 = $slideshow_button1_icon = $slideshow_button1_url = $slideshow_button1_style = $slideshow_button1_type = $slideshow_button1_radius = $slideshow_button1_target = $slideshow_button1_lightbox = $slideshow_button2 = $slideshow_button2_icon = $slideshow_button2_url = $slideshow_button2_style = $slideshow_button2_type = $slideshow_button2_radius = $slideshow_button2_target = $slideshow_button2_lightbox = $slideshow_buttons = $slideshow_arrow = $slideshow_arrowicon = $slideshow_arrowlink = $slideshow_arrowicon_color = $slideshow_has_animation = $slideshow_animation_delay = $slideshow_animation_delay_amount = $slideshow_vertical_alignment = $slideshow_text_alignment = $slideshow_padding = $slideshow_padding_top = $slideshow_padding_bottom = $slideshow_padding_right = $slideshow_padding_left = '';

                    if( isset( $slide['slideshow_bg_choice'] ) )
                        $slideshow_bg_choice = esc_attr( $slide['slideshow_bg_choice'] );

                    if( isset( $slide['slideshow_bg_color'] ) )
                        $slideshow_bg_color = esc_attr( $slide['slideshow_bg_color'] );

                    if( isset( $slide['slideshow_bg_image'] ) )
                        $slideshow_bg_image = esc_attr( $slide['slideshow_bg_image'] );

                    if( isset( $slide['slideshow_bg_image_position'] ) )
                        $slideshow_bg_image_position = esc_attr( $slide['slideshow_bg_image_position'] );

                    if( isset( $slide['slideshow_bg_image_repeat'] ) )
                        $slideshow_bg_image_repeat = esc_attr( $slide['slideshow_bg_image_repeat'] );

                    if( isset( $slide['slideshow_bg_image_size'] ) )
                        $slideshow_bg_image_size = esc_attr( $slide['slideshow_bg_image_size'] );
                                        
                    if ( isset( $slide['slideshow_bg_overlay_choice'] ) )
                        $slideshow_overlay_choice = esc_attr( $slide['slideshow_bg_overlay_choice'] );
                        
                    if ( isset( $slide['slideshow_bg_overlay_color'] ) )
                        $slideshow_overlay_color = esc_attr( $slide['slideshow_bg_overlay_color'] );        

                    if ( isset( $slide['slideshow_bg_sg_overlay_css'] ) )
                        $slideshow_bg_sg_overlay_css = esc_attr( $slide['slideshow_bg_sg_overlay_css'] );

                    if ( isset( $slide['slideshow_bg_gm_overlay_color1'] ) )
                        $slideshow_bg_gm_overlay_color1 = esc_attr( $slide['slideshow_bg_gm_overlay_color1'] ); 

                    if ( isset( $slide['slideshow_bg_gm_overlay_color2'] ) )
                        $slideshow_bg_gm_overlay_color2 = esc_attr( $slide['slideshow_bg_gm_overlay_color2'] ); 

                    if ( isset( $slide['slideshow_bg_gm_overlay_color3'] ) )
                        $slideshow_bg_gm_overlay_color3 = esc_attr( $slide['slideshow_bg_gm_overlay_color3'] ); 

                    if ( isset( $slide['slideshow_bg_particle_ground'] ) )
                        $slideshow_bg_particle_ground = esc_attr( $slide['slideshow_bg_particle_ground'] ); 

                    if ( isset( $slide['slideshow_bg_particle_ground_color'] ) )
                        $slideshow_bg_particle_ground_color = esc_attr( $slide['slideshow_bg_particle_ground_color'] ); 

                    
                    
                    if ( isset( $slide['slideshow_animation'] ) ){
                        $slideshow_animation = esc_attr( $slide['slideshow_animation'] );
                        if( !empty($slideshow_animation) ){
                            $slideshow_has_animation = 'has-slide-content-animation';
                            $slideshow_animation_delay_amount = 0;
                        }
                    }

                    if ( isset( $slide['slideshow_image_id'] ) ){
                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = ' -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;';
                            $slideshow_animation_delay_amount += 250;
                        }
                        if ( isset( $slide['slideshow_image_size'] ) )
                            $slideshow_image_size = esc_attr( $slide['slideshow_image_size'] );

                        if ( isset( $slide['slideshow_image_size_tab'] ) )
                            $slideshow_image_size_tab = esc_attr( $slide['slideshow_image_size_tab'] );

                        if ( isset( $slide['slideshow_image_size_mobile'] ) )
                            $slideshow_image_size_mobile = esc_attr( $slide['slideshow_image_size_mobile'] );

                        $slideshow_image_width = 'data-width="'.$slideshow_image_size.'" data-width-tab="'.$slideshow_image_size_tab.'" data-width-mobile="'.$slideshow_image_size_mobile.'"';
                        
                        $slideshow_image = '<div class="agni-slide-image '.$slideshow_animation.'" style="'.$slideshow_animation_delay.'" '.$slideshow_image_width.'>'.wp_get_attachment_image($slide['slideshow_image_id'], 'full' ).'</div>';
                    }

                    if ( isset( $slide['slideshow_title'] ) ){
                        $slideshow_title_span = $slideshow_title_no_span[0] = $slideshow_title_no_span[1] = '';

                        if ( isset( $slide['slideshow_title_font'] ) )
                            $slideshow_title_font = esc_attr( $slide['slideshow_title_font'] ); 

                        if ( isset( $slide['slideshow_title_size'] ) )
                            $slideshow_title_size = esc_attr( $slide['slideshow_title_size'] ); 

                        if ( isset( $slide['slideshow_title_color'] ) )
                            $slideshow_title_color = esc_attr( $slide['slideshow_title_color'] );   

                        if ( isset( $slide['slideshow_title_rotator'] ) )
                            $slideshow_title_rotator = esc_attr( $slide['slideshow_title_rotator'] );

                        if ( isset( $slide['slideshow_title_rotator_choice'] ) )
                            $slideshow_title_rotator_choice = esc_attr( $slide['slideshow_title_rotator_choice'] );

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = ' -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;';
                            $slideshow_animation_delay_amount += 250;
                        }

                        if ( strpos($slide['slideshow_title'], '|') !== false && $slideshow_title_rotator == 'on') {
                            $slideshow_title_span = $slideshow_title_no_span[0] = $slideshow_title_no_span[1] = '';

                            $slideshow_title_effect = 'class="cd-headline '.$slideshow_title_rotator_choice.'"';

                            $slideshow_title_decode = htmlspecialchars_decode( $slide['slideshow_title'] );
                            $pattern = '/<span>(.*?)<\/span>/';
                            $slideshow_title_no_span  = preg_split( $pattern, $slideshow_title_decode );

                            $slideshow_title_span_content = substr($slideshow_title_decode, strpos($slideshow_title_decode, "<span>") + 0);
                            $slideshow_title_span_content = substr($slideshow_title_span_content, 0, strpos($slideshow_title_span_content, "</span>") + 7);
                            $slideshow_title_span_content = explode( "|", $slideshow_title_span_content );
                            foreach( $slideshow_title_span_content as $slideshow_title_span_text ){
                                $slideshow_title_span .=  '<span class="rotate">'.$slideshow_title_span_text.'</span>';
                            }
                            $slideshow_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $slideshow_title_span);
                            
                            $slide['slideshow_title'] = $slideshow_title_no_span[0].$slideshow_title_span.$slideshow_title_no_span[1];
                        }

                        $slideshow_title = '<div class="agni-slide-title '.$slideshow_animation.' '.$slideshow_title_font.'" style="font-size:'.$slideshow_title_size.'px; color:'.$slideshow_title_color.'; '.$slideshow_animation_delay.'"><'.apply_filters( 'agni_slider_h_tag', $args = '' ).' '.$slideshow_title_effect.'>'.htmlspecialchars_decode( esc_attr( $slide['slideshow_title'] ) ).'</'.apply_filters( 'agni_slider_h_tag', $args = '' ).'></div>';
                    }

                    if ( isset( $slide['slideshow_line'] ) && $slide['slideshow_line'] == 'on' ){

                        if ( isset( $slide['slideshow_line_color'] ) )
                            $slideshow_title_line_color = esc_attr( $slide['slideshow_line_color'] );

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = 'style=" -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms; "';
                            $slideshow_animation_delay_amount += 250;
                        }
                        $slideshow_title_line = '<div class="agni-slide-divideline divide-line '.$slideshow_animation.'" '.$slideshow_animation_delay.'><span style="background-color:'.$slideshow_title_line_color.';"></span></div>'; 
                    }
                        
                    if ( isset( $slide['slideshow_desc'] ) ){

                        if ( isset( $slide['slideshow_desc_font'] ) )
                            $slideshow_desc_font = esc_attr( $slide['slideshow_desc_font'] ); 

                        if ( isset( $slide['slideshow_desc_size'] ) )
                            $slideshow_desc_size = esc_attr( $slide['slideshow_desc_size'] );   

                        if ( isset( $slide['slideshow_desc_color'] ) )
                            $slideshow_desc_color = esc_attr( $slide['slideshow_desc_color'] );

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = ' -webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;';
                            $slideshow_animation_delay_amount += 250;
                        }
                        $slideshow_desc = '<div class="agni-slide-description '.$slideshow_animation.' '.$slideshow_desc_font.'" style="font-size:'.$slideshow_desc_size.'px; color:'.$slideshow_desc_color.'; '.$slideshow_animation_delay.'"><p>'.htmlspecialchars_decode( esc_attr( $slide['slideshow_desc'] ) ).'</p></div>';
                    }
                        
                    if ( isset( $slide['slideshow_button1'] ) )
                        $slideshow_button1 = esc_attr( $slide['slideshow_button1'] );

                    if ( isset( $slide['slideshow_button1_icon'] ) )
                        $slideshow_button1_icon = esc_attr( $slide['slideshow_button1_icon'] );
                        
                    if ( isset( $slide['slideshow_button1_url'] ) )
                        $slideshow_button1_url = esc_url( $slide['slideshow_button1_url'] );
                        
                    if ( isset( $slide['slideshow_button1_style'] ) )
                        $slideshow_button1_style = esc_attr( $slide['slideshow_button1_style'] );
                        
                    if ( isset( $slide['slideshow_button1_type'] ) )
                        $slideshow_button1_type = esc_attr( $slide['slideshow_button1_type'] );
                        
                    if ( isset( $slide['slideshow_button1_radius'] ) )
                        $slideshow_button1_radius = esc_attr( $slide['slideshow_button1_radius'] );

                    if ( isset( $slide['slideshow_button1_target'] ) )
                        $slideshow_button1_target = esc_attr( $slide['slideshow_button1_target'] );

                    if ( isset( $slide['slideshow_button1_lightbox'] ) )
                        $slideshow_button1_lightbox = esc_attr( $slide['slideshow_button1_lightbox'] );

                    if ( isset( $slide['slideshow_button2'] ) )
                        $slideshow_button2 = esc_attr( $slide['slideshow_button2'] );

                    if ( isset( $slide['slideshow_button2_icon'] ) )
                        $slideshow_button2_icon = esc_attr( $slide['slideshow_button2_icon'] );
                        
                    if ( isset( $slide['slideshow_button2_url'] ) )
                        $slideshow_button2_url = esc_url( $slide['slideshow_button2_url'] );
                        
                    if ( isset( $slide['slideshow_button2_style'] ) )
                        $slideshow_button2_style = esc_attr( $slide['slideshow_button2_style'] );
                        
                    if ( isset( $slide['slideshow_button2_type'] ) )
                        $slideshow_button2_type = esc_attr( $slide['slideshow_button2_type'] );
                        
                    if ( isset( $slide['slideshow_button2_radius'] ) )
                        $slideshow_button2_radius = esc_attr( $slide['slideshow_button2_radius'] );

                    if ( isset( $slide['slideshow_button2_target'] ) )
                        $slideshow_button2_target = esc_attr( $slide['slideshow_button2_target'] );

                    if ( isset( $slide['slideshow_button2_lightbox'] ) )
                        $slideshow_button2_lightbox = esc_attr( $slide['slideshow_button2_lightbox'] );

                    if ( isset( $slide['slideshow_arrowicon'] ) ){

                        if ( isset( $slide['slideshow_arrowlink'] ) )
                            $slideshow_arrowlink = esc_url( $slide['slideshow_arrowlink'] );

                        if ( isset( $slide['slideshow_arrowicon_color'] ) )
                            $slideshow_arrowicon_color = esc_attr( $slide['slideshow_arrowicon_color'] );

                        if( !empty( $slideshow_arrowlink ) ){
                            $slideshow_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$slideshow_arrowlink.'" style="color:'.$slideshow_arrowicon_color.'"><i class="'.$slide['slideshow_arrowicon'].'"></i></a></div>';
                        }
                    }

                    if( !empty($slideshow_button1) ){

                        if( !empty($slideshow_button1_icon) ){
                            $slideshow_button1_icon = '<i class="'.$slideshow_button1_icon.'"></i>';
                        }
                        if( $slideshow_button1_lightbox == 'on' ){
                            $slideshow_button1_lightbox = 'custom-video-link has-video-lightbox';
                        }
                        if( !empty($slideshow_button1_radius) ){
                            $slideshow_button1_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_button1_radius ) ? $slideshow_button1_radius : $slideshow_button1_radius . 'px' ).';"';
                        }

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = 'style="-webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;"';
                            $slideshow_animation_delay_amount += 250;
                        }
                        $slideshow_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-1 page-scroll '.$slideshow_button1_lightbox.' '.$slideshow_animation.'" '.$slideshow_animation_delay.'><a class="btn btn-'.$slideshow_button1_style.' '.$slideshow_button1_type.'" href="'.$slideshow_button1_url.'" target="'.$slideshow_button1_target.'" '.$slideshow_button1_radius.'>'.$slideshow_button1.$slideshow_button1_icon.'</a></div>';

                    }
                    if( !empty($slideshow_button2) ){

                        if( !empty($slideshow_button2_icon) ){
                            $slideshow_button2_icon = '<i class="'.$slideshow_button2_icon.'"></i>';
                        }
                        if( $slideshow_button2_lightbox == 'on' ){
                            $slideshow_button2_lightbox = 'custom-video-link has-video-lightbox';
                        }
                        if( !empty($slideshow_button2_radius) ){
                            $slideshow_button2_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_button2_radius ) ? $slideshow_button2_radius : $slideshow_button2_radius . 'px' ).';"';
                        }

                        if( $slideshow_has_animation == 'has-slide-content-animation'){
                            $slideshow_animation_delay = 'style="-webkit-animation-delay: '.$slideshow_animation_delay_amount.'ms; animation-delay: '.$slideshow_animation_delay_amount.'ms;"';
                            $slideshow_animation_delay_amount += 250;
                        }
                        $slideshow_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-2 page-scroll '.$slideshow_button2_lightbox.' '.$slideshow_animation.'" '.$slideshow_animation_delay.'><a class="btn btn-'.$slideshow_button2_style.' '.$slideshow_button2_type.'" href="'.$slideshow_button2_url.'" target="'.$slideshow_button2_target.'" '.$slideshow_button2_radius.'>'.$slideshow_button2.$slideshow_button2_icon.' </a></div>';
                    }
                    if( !empty($slideshow_buttons) ){
                        $slideshow_buttons = '<div class="agni-slide-buttons">'.$slideshow_buttons.'</div>';
                    } 

                    if ( isset( $slide['slideshow_vertical_alignment'] ) )
                        $slideshow_vertical_alignment = esc_attr( $slide['slideshow_vertical_alignment'] );
                                        
                    if ( isset( $slide['slideshow_text_alignment'] ) )
                        $slideshow_text_alignment = esc_attr( $slide['slideshow_text_alignment'] );
                                        
                    if ( isset( $slide['slideshow_padding_top'] ) ){
                        $slideshow_padding_top = esc_attr( $slide['slideshow_padding_top'] );
                        $slideshow_padding .= 'padding-top:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_padding_top ) ? $slideshow_padding_top : $slideshow_padding_top . 'px' ).';';
                    }
                                        
                    if ( isset( $slide['slideshow_padding_bottom'] ) ){
                        $slideshow_padding_bottom = esc_attr( $slide['slideshow_padding_bottom'] );
                        $slideshow_padding .= 'padding-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_padding_bottom ) ? $slideshow_padding_bottom : $slideshow_padding_bottom . 'px' ).';';
                    }
                                        
                    if ( isset( $slide['slideshow_padding_right'] ) ){
                        $slideshow_padding_right = esc_attr( $slide['slideshow_padding_right'] );
                        $slideshow_padding .= 'padding-right:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_padding_right ) ? $slideshow_padding_right : $slideshow_padding_right . 'px' ).';';
                    }

                    if ( isset( $slide['slideshow_padding_left'] ) ){
                        $slideshow_padding_left = esc_attr( $slide['slideshow_padding_left'] );
                        $slideshow_padding .= 'padding-left:'.( preg_match( '/(px|em|\%|pt|cm)$/', $slideshow_padding_left ) ? $slideshow_padding_left : $slideshow_padding_left . 'px' ).';';
                    }
                        
                    if ( $slideshow_bg_choice == 'bg_color' ){
                        $slideshow_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$slideshow_bg_color.'; "></div>';
                    }
                    else {
                        $slideshow_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$slideshow_bg_image.'); background-repeat:'.$slideshow_bg_image_repeat.'; background-position:'.$slideshow_bg_image_position.'; background-size:'.$slideshow_bg_image_size.'; "></div>';
                    }
                    
                    if ( $slideshow_bg_choice != 'bg_color' && $slideshow_overlay_choice != '4'  ){
                        if( $slideshow_overlay_choice == '3' ){
                            $slideshow_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$slideshow_bg_gm_overlay_color1.','.$slideshow_bg_gm_overlay_color2.','.$slideshow_bg_gm_overlay_color3.' " style="background-image:url('.$slideshow_bg_image.'); background-repeat:'.$slideshow_bg_image_repeat.'; background-position:'.$slideshow_bg_image_position.'; background-size:'.$slideshow_bg_image_size.'; "></div>';
                        }
                        elseif ( $slideshow_overlay_choice == '2' ) {
                            $slideshow_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$slideshow_bg_sg_overlay_css.';"></div>';
                        }
                        else{
                            $slideshow_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$slideshow_overlay_color.';"></div>';
                        }
                    }

                    // BG particles
                    if( $slideshow_bg_particle_ground == 'on' ){
                        $slideshow_bg_particle_ground_color = ( $slideshow_bg_particle_ground_color != '' ) ? $slideshow_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                        $slideshow_particle_ground = '<div class="particles" data-color="'.$slideshow_bg_particle_ground_color.'"></div>';
                    } 
                    
                    $slides .= '<div class="agni-slide '.$slideshow_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-bg-container">'.$slideshow_bg.$slideshow_overlay.$slideshow_particle_ground.'</div>
                        <div class="agni-slide-content-container container'.$slideshow_fullwidth_container.' agni-slide-align-items-'.$slideshow_vertical_alignment.' agni-slide-justify-content-'.$slideshow_text_alignment.'">
                            <div class="agni-slide-content-inner page-scroll" style="'.$slideshow_padding.'">
                                '.$slideshow_image.$slideshow_title.$slideshow_title_line.$slideshow_desc.$slideshow_buttons.$slideshow_arrow.'
                            </div>
                        </div>
                    </div>';

                }

                $output = '<div id="agni-slider-'.$post.'" class="agni-slider" '.$slide_height.' data-slider-choice="'.$slideshow_choice.'" data-slider-autoplay-timeout="'.$slideshow_transition_duration.'" data-slider-smart-speed="'.$slideshow_transition_speed.'" data-slider-mousedrag="'.$slideshow_mousedrag.'" data-slider-nav="'.$slideshow_navigation.'" data-slider-dots="'.$slideshow_pagination.'" data-slider-autoplay="'.$slideshow_autoplay.'" data-slider-loop="'.$slideshow_loop.'" data-slider-animate-in="'.$slideshow_animate_in.'" data-slider-animate-out="'.$slideshow_animate_out.'" '.$slideshow_carousel.'>'.$slides.'</div>';
                
                return $output;
                
                break;
            
            case 'textslider':
                
                $slides = $textslider_animation = $slide_height = $slide_parallax = $textslider_bg_choice = $textslider_bg_color = $textslider_bg_image = $textslider_bg_image_position = $textslider_bg_image_repeat = $textslider_bg_image_size = $textslider_overlay = $textslider_overlay_choice = $textslider_overlay_color = $textslider_bg_sg_overlay_css = $textslider_bg_gm_overlay_color1 = $textslider_bg_gm_overlay_color2 = $textslider_bg_gm_overlay_color3 = $textslider_particle_ground = $textslider_bg = $agni_slide_bg_container_id = $textslider_bg_video_loop = $textslider_bg_video_autoplay = $textslider_bg_video_muted = $bg_video_loop = $bg_video_autoplay = $bg_video_muted = '';
                        
                $textslider_repeatable = get_post_meta( $post, 'agni_slides_textslider_repeatable', true );
                
                $textslider_bg_choice = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_choice', true ) );
                $textslider_bg_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_color', true ) );
                $textslider_bg_image = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_image', true ) );
                $textslider_bg_image_position = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_image_position', true ) );
                $textslider_bg_image_repeat = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_image_repeat', true ) );
                $textslider_bg_image_size = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_image_size', true ) );
                $textslider_bg_video_src = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_src', true ) );
                $textslider_bg_video_src_yt = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_yt', true ) );
                $textslider_bg_video_src_yt_fallback = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_yt_fallback', true ) );
                $textslider_bg_video_src_sh = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_sh', true ) );
                $textslider_bg_video_src_sh_poster = esc_url( get_post_meta( $post, 'agni_slides_textslider_bg_video_src_sh_poster', true ) );

                $textslider_bg_video_loop = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_loop', true ) );
                $textslider_bg_video_autoplay = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_autoplay', true ) );
                $textslider_bg_video_muted = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_muted', true ) );
                $textslider_bg_video_volume = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_volume', true ) );
                $textslider_bg_video_quality = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_quality', true ) );
                $textslider_bg_video_start_at = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_start_at', true ) );
                $textslider_bg_video_stop_at = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_video_stop_at', true ) );

                $textslider_overlay_choice = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_overlay_choice', true ) );
                $textslider_overlay_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_overlay_color', true ) );        
                $textslider_bg_sg_overlay_css = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_sg_overlay_css', true ) );
                $textslider_bg_gm_overlay_color1 = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_gm_overlay_color1', true ) ); 
                $textslider_bg_gm_overlay_color2 = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_gm_overlay_color2', true ) ); 
                $textslider_bg_gm_overlay_color3 = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_gm_overlay_color3', true ) );

                $textslider_bg_particle_ground = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_particle_ground', true ) );
                $textslider_bg_particle_ground_color = esc_attr( get_post_meta( $post, 'agni_slides_textslider_bg_particle_ground_color', true ) ); 

                $textslider_choice = esc_attr( get_post_meta( $post, 'agni_slides_textslider_choice', true ) );
                $textslider_height = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height', true ) );
                $textslider_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height_tab', true ) );
                $textslider_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_textslider_height_mobile', true ) );
                $textslider_parallax = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax', true ) );
                $textslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax_start', true ) );
                $textslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_textslider_parallax_end', true ) );
                $textslider_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_textslider_animate_in', true ) );
                $textslider_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_textslider_animate_out', true ) );
                $textslider_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_autoplay', true ) ) == 'on')?'true':'false';
                $textslider_loop = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_loop', true ) ) == 'on')?'true':'false';
                $textslider_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_textslider_transition_duration', true ) );
                $textslider_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_textslider_transition_speed', true ) );
                $textslider_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_navigation', true ) ) == 'on')?'true':'false';
                $textslider_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_pagination', true ) ) == 'on')?'true':'false';
                $textslider_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_textslider_mousedrag', true ) ) == 'on')?'true':'false';

                if( $textslider_choice == '1' ){
                    $slide_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slide_height = 'data-height="'.$textslider_height.'" data-height-tab="'.$textslider_height_tab.'" data-height-mobile="'.$textslider_height_mobile.'"';
                }
                
                if( $textslider_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$textslider_parallax_start.'" data-1500="'.$textslider_parallax_end.'"';
                }

                $textslider_carousel = 'data-slider-992-items="1" data-slider-768-items="1" data-slider-0-items="1" data-slider-carousel-margin="0"';
                
                foreach( (array) $textslider_repeatable as $key => $slide ){
                    $textslider_vertical_alignment = $textslider_text_alignment = $textslider_size = $textslider_image_width = $textslider_image = $textslider_title = $textslider_title_effect = $textslider_title_size = $textslider_title_color = $textslider_desc = $textslider_desc_size = $textslider_desc_color = $textslider_title_line = $textslider_title_line_color = $textslider_button1 = $textslider_button1_icon = $textslider_button1_url = $textslider_button1_style = $textslider_button1_type = $textslider_button1_radius = $textslider_button1_target = $textslider_button1_lightbox = $textslider_button2 = $textslider_button2_icon = $textslider_button2_url = $textslider_button2_style = $textslider_button2_type = $textslider_button2_radius = $textslider_button2_target = $textslider_button2_lightbox = $textslider_buttons = $textslider_animation = $textslider_has_animation = $textslider_animation_delay = $textslider_animation_delay_amount = $textslider_arrow = $textslider_arrowicon = $textslider_arrowlink = $textslider_arrowicon_color = $textslider_padding = $textslider_padding_top = $textslider_padding_bottom = $textslider_padding_right = $textslider_padding_left = '';


                    if ( isset( $slide['textslider_animation'] ) ){
                        $textslider_animation = esc_attr( $slide['textslider_animation'] );
                        if( !empty($textslider_animation) ){
                            $textslider_has_animation = 'has-slide-content-animation';
                            $textslider_animation_delay_amount = 0;
                        }
                    }

                    if ( isset( $slide['textslider_image_id'] ) ){
                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = ' -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;';
                            $textslider_animation_delay_amount += 250;
                        }
                        if ( isset( $slide['textslider_image_size'] ) )
                            $textslider_image_size = esc_attr( $slide['textslider_image_size'] );

                        if ( isset( $slide['textslider_image_size_tab'] ) )
                            $textslider_image_size_tab = esc_attr( $slide['textslider_image_size_tab'] );

                        if ( isset( $slide['textslider_image_size_mobile'] ) )
                            $textslider_image_size_mobile = esc_attr( $slide['textslider_image_size_mobile'] );

                        $textslider_image_width = 'data-width="'.$textslider_image_size.'" data-width-tab="'.$textslider_image_size_tab.'" data-width-mobile="'.$textslider_image_size_mobile.'"';
                        
                        $textslider_image = '<div class="agni-slide-image '.$textslider_animation.'" style="'.$textslider_animation_delay.'" '.$textslider_image_width.'>'.wp_get_attachment_image($slide['textslider_image_id'], 'full' ).'</div>';
                    }

                    if ( isset( $slide['textslider_title'] ) ){
                        $textslider_title_span = $textslider_title_no_span[0] = $textslider_title_no_span[1] = '';

                        if ( isset( $slide['textslider_title_font'] ) )
                            $textslider_title_font = esc_attr( $slide['textslider_title_font'] );   

                        if ( isset( $slide['textslider_title_size'] ) )
                            $textslider_title_size = esc_attr( $slide['textslider_title_size'] );   

                        if ( isset( $slide['textslider_title_color'] ) )
                            $textslider_title_color = esc_attr( $slide['textslider_title_color'] ); 

                        if ( isset( $slide['textslider_title_rotator'] ) )
                            $textslider_title_rotator = esc_attr( $slide['textslider_title_rotator'] );

                        if ( isset( $slide['textslider_title_rotator_choice'] ) )
                            $textslider_title_rotator_choice = esc_attr( $slide['textslider_title_rotator_choice'] );

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = ' -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;';
                            $textslider_animation_delay_amount += 250;
                        }

                        if ( strpos($slide['textslider_title'], '|') !== false && $textslider_title_rotator == 'on') {
                            $textslider_title_span = $textslider_title_no_span[0] = $textslider_title_no_span[1] = '';

                            $textslider_title_effect = 'class="cd-headline '.$textslider_title_rotator_choice.'"';

                            $textslider_title_decode = htmlspecialchars_decode( $slide['textslider_title'] );
                            $pattern = '/<span>(.*?)<\/span>/';
                            $textslider_title_no_span  = preg_split( $pattern, $textslider_title_decode );

                            $textslider_title_span_content = substr($textslider_title_decode, strpos($textslider_title_decode, "<span>") + 0);
                            $textslider_title_span_content = substr($textslider_title_span_content, 0, strpos($textslider_title_span_content, "</span>") + 7);
                            $textslider_title_span_content = explode( "|", $textslider_title_span_content );
                            foreach( $textslider_title_span_content as $textslider_title_span_text ){
                                $textslider_title_span .=  '<span class="rotate">'.$textslider_title_span_text.'</span>';
                            }
                            $textslider_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $textslider_title_span);
                            
                            $slide['textslider_title'] = $textslider_title_no_span[0].$textslider_title_span.$textslider_title_no_span[1];
                        }
                        $textslider_title = '<div class="agni-slide-title '.$textslider_animation.' '.$textslider_title_font.'" style="font-size:'.$textslider_title_size.'px; color:'.$textslider_title_color.'; '.$textslider_animation_delay.'"><'.apply_filters( 'agni_slider_h_tag', $args = '' ).' '.$textslider_title_effect.'>'.htmlspecialchars_decode( esc_attr( $slide['textslider_title'] ) ).'</'.apply_filters( 'agni_slider_h_tag', $args = '' ).'></div>';
                    }

                    if ( isset( $slide['textslider_line'] ) && $slide['textslider_line'] == 'on' ){

                        if ( isset( $slide['textslider_line_color'] ) )
                            $textslider_title_line_color = esc_attr( $slide['textslider_line_color'] );

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = 'style=" -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms; "';
                            $textslider_animation_delay_amount += 250;
                        }
                        $textslider_title_line = '<div class="agni-slide-divideline divide-line '.$textslider_animation.'" '.$textslider_animation_delay.'><span style="background-color:'.$textslider_title_line_color.';"></span></div>'; 
                    }
                        
                    if ( isset( $slide['textslider_desc'] ) ){

                        if ( isset( $slide['textslider_desc_font'] ) )
                            $textslider_desc_font = esc_attr( $slide['textslider_desc_font'] ); 

                        if ( isset( $slide['textslider_desc_size'] ) )
                            $textslider_desc_size = esc_attr( $slide['textslider_desc_size'] ); 

                        if ( isset( $slide['textslider_desc_color'] ) )
                            $textslider_desc_color = esc_attr( $slide['textslider_desc_color'] );

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = ' -webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;';
                            $textslider_animation_delay_amount += 250;
                        }
                        $textslider_desc = '<div class="agni-slide-description '.$textslider_animation.' '.$textslider_desc_font.'" style="font-size:'.$textslider_desc_size.'px; color:'.$textslider_desc_color.'; '.$textslider_animation_delay.'"><p>'.htmlspecialchars_decode( esc_attr( $slide['textslider_desc'] ) ).'</p></div>';
                    }
                        
                    if ( isset( $slide['textslider_button1'] ) )
                        $textslider_button1 = esc_attr( $slide['textslider_button1'] );

                    if ( isset( $slide['textslider_button1_icon'] ) )
                        $textslider_button1_icon = esc_attr( $slide['textslider_button1_icon'] );
                        
                    if ( isset( $slide['textslider_button1_url'] ) )
                        $textslider_button1_url = esc_url( $slide['textslider_button1_url'] );
                        
                    if ( isset( $slide['textslider_button1_style'] ) )
                        $textslider_button1_style = esc_attr( $slide['textslider_button1_style'] );
                        
                    if ( isset( $slide['textslider_button1_type'] ) )
                        $textslider_button1_type = esc_attr( $slide['textslider_button1_type'] );
                        
                    if ( isset( $slide['textslider_button1_radius'] ) )
                        $textslider_button1_radius = esc_attr( $slide['textslider_button1_radius'] );

                    if ( isset( $slide['textslider_button1_target'] ) )
                        $textslider_button1_target = esc_attr( $slide['textslider_button1_target'] );

                    if ( isset( $slide['textslider_button1_lightbox'] ) )
                        $textslider_button1_lightbox = esc_attr( $slide['textslider_button1_lightbox'] );

                    if ( isset( $slide['textslider_button2'] ) )
                        $textslider_button2 = esc_attr( $slide['textslider_button2'] );

                    if ( isset( $slide['textslider_button2_icon'] ) )
                        $textslider_button2_icon = esc_attr( $slide['textslider_button2_icon'] );
                        
                    if ( isset( $slide['textslider_button2_url'] ) )
                        $textslider_button2_url = esc_url( $slide['textslider_button2_url'] );
                        
                    if ( isset( $slide['textslider_button2_style'] ) )
                        $textslider_button2_style = esc_attr( $slide['textslider_button2_style'] );
                        
                    if ( isset( $slide['textslider_button2_type'] ) )
                        $textslider_button2_type = esc_attr( $slide['textslider_button2_type'] );
                        
                    if ( isset( $slide['textslider_button2_radius'] ) )
                        $textslider_button2_radius = esc_attr( $slide['textslider_button2_radius'] );

                    if ( isset( $slide['textslider_button2_target'] ) )
                        $textslider_button2_target = esc_attr( $slide['textslider_button2_target'] );

                    if ( isset( $slide['textslider_button2_lightbox'] ) )
                        $textslider_button2_lightbox = esc_attr( $slide['textslider_button2_lightbox'] );

                    if ( isset( $slide['textslider_arrowicon'] ) ){

                        if ( isset( $slide['textslider_arrowlink'] ) )
                            $textslider_arrowlink = esc_url( $slide['textslider_arrowlink'] );

                        if ( isset( $slide['textslider_arrowicon_color'] ) )
                            $textslider_arrowicon_color = esc_attr( $slide['textslider_arrowicon_color'] );

                        if( !empty( $textslider_arrowlink ) ){
                            $textslider_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$textslider_arrowlink.'" style="color:'.$textslider_arrowicon_color.'"><i class="'.$slide['textslider_arrowicon'].'"></i></a></div>';
                        }
                    }

                    if( !empty($textslider_button1) ){

                        if( !empty($textslider_button1_icon) ){
                            $textslider_button1_icon = '<i class="'.$textslider_button1_icon.'"></i>';
                        }
                        if( $textslider_button1_lightbox == 'on' ){
                            $textslider_button1_lightbox = 'custom-video-link has-video-lightbox';
                        }
                        if( !empty($textslider_button1_radius) ){
                            $textslider_button1_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_button1_radius ) ? $textslider_button1_radius : $textslider_button1_radius . 'px' ).';"';
                        }

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = 'style="-webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;"';
                            $textslider_animation_delay_amount += 250;
                        }
                        $textslider_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-1 '.$textslider_button1_lightbox.' '.$textslider_animation.'" '.$textslider_animation_delay.'><a class="btn btn-'.$textslider_button1_style.' '.$textslider_button1_type.'" href="'.$textslider_button1_url.'" target="'.$textslider_button1_target.'" '.$textslider_button1_radius.'>'.$textslider_button1.$textslider_button1_icon.'</a></div>';

                    }
                    if( !empty($textslider_button2) ){

                        if( !empty($textslider_button2_icon) ){
                            $textslider_button2_icon = '<i class="'.$textslider_button2_icon.'"></i>';
                        }
                        if( $textslider_button2_lightbox == 'on' ){
                            $textslider_button2_lightbox = 'custom-video-link has-video-lightbox';
                        }
                        if( !empty($textslider_button2_radius) ){
                            $textslider_button2_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_button2_radius ) ? $textslider_button2_radius : $textslider_button2_radius . 'px' ).';"';
                        }

                        if( $textslider_has_animation == 'has-slide-content-animation'){
                            $textslider_animation_delay = 'style="-webkit-animation-delay: '.$textslider_animation_delay_amount.'ms; animation-delay: '.$textslider_animation_delay_amount.'ms;"';
                            $textslider_animation_delay_amount += 250;
                        }
                        $textslider_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-2 '.$textslider_button2_lightbox.' '.$textslider_animation.'" '.$textslider_animation_delay.'><a class="btn btn-'.$textslider_button2_style.' '.$textslider_button2_type.'" href="'.$textslider_button2_url.'" target="'.$textslider_button2_target.'" '.$textslider_button2_radius.'>'.$textslider_button2.$textslider_button2_icon.' </a></div>';
                    }
                    if( !empty($textslider_buttons) ){
                        $textslider_buttons = '<div class="agni-slide-buttons">'.$textslider_buttons.'</div>';
                    } 

                    if ( isset( $slide['textslider_vertical_alignment'] ) )
                        $textslider_vertical_alignment = esc_attr( $slide['textslider_vertical_alignment'] );
                                        
                    if ( isset( $slide['textslider_text_alignment'] ) )
                        $textslider_text_alignment = esc_attr( $slide['textslider_text_alignment'] );
                                        
                    if ( isset( $slide['textslider_padding_top'] ) ){
                        $textslider_padding_top = esc_attr( $slide['textslider_padding_top'] );
                        $textslider_padding .= 'padding-top:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_padding_top ) ? $textslider_padding_top : $textslider_padding_top . 'px' ).';';
                    }

                    if ( isset( $slide['textslider_padding_bottom'] ) ){
                        $textslider_padding_bottom = esc_attr( $slide['textslider_padding_bottom'] );
                        $textslider_padding .= 'padding-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_padding_bottom ) ? $textslider_padding_bottom : $textslider_padding_bottom . 'px' ).';';
                    }
                    if ( isset( $slide['textslider_padding_right'] ) ){
                        $textslider_padding_right = esc_attr( $slide['textslider_padding_right'] );
                        $textslider_padding .= 'padding-right:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_padding_right ) ? $textslider_padding_right : $textslider_padding_right . 'px' ).';';
                    }

                    if ( isset( $slide['textslider_padding_left'] ) ){
                        $textslider_padding_left = esc_attr( $slide['textslider_padding_left'] );
                        $textslider_padding .= 'padding-left:'.( preg_match( '/(px|em|\%|pt|cm)$/', $textslider_padding_left ) ? $textslider_padding_left : $textslider_padding_left . 'px' ).';';
                    }

                    $slides .= '<div class="agni-slide '.$textslider_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-content-container container agni-slide-align-items-'.$textslider_vertical_alignment.' agni-slide-justify-content-'.$textslider_text_alignment.'">
                            <div class="agni-slide-content-inner page-scroll" style="'.$textslider_padding.'">
                                '.$textslider_image.$textslider_title.$textslider_title_line.$textslider_desc.$textslider_buttons.$textslider_arrow.'
                            </div>
                        </div>
                    </div>';

                }
                if ( $textslider_bg_choice == 'bg_color' ){
                    $textslider_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$textslider_bg_color.'; "></div>';
                }
                else if( $textslider_bg_choice == 'bg_image' ) {
                    $textslider_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$textslider_bg_image.'); background-repeat:'.$textslider_bg_image_repeat.'; background-position:'.$textslider_bg_image_position.'; background-size:'.$textslider_bg_image_size.'; "></div>';
                }
                else{

                    if( $textslider_bg_video_loop == 'on'){
                        $textslider_bg_video_loop = 'true';
                        $bg_video_loop = 'loop ';
                    }
                    else{
                        $textslider_bg_video_loop = 'false';
                    }
                    
                    if( $textslider_bg_video_autoplay == 'on'){
                        $textslider_bg_video_autoplay = 'true';
                        $bg_video_autoplay = 'autoplay ';
                    }
                    else{
                        $textslider_bg_video_autoplay = 'false';
                    }
                    
                    if( $textslider_bg_video_muted == 'on'){
                        $textslider_bg_video_muted = 'true';
                        $bg_video_muted = 'muted ';
                    }
                    else{
                        $textslider_bg_video_muted = 'false';
                    }

                    if( $textslider_bg_video_src == '1' ){
                        $agni_slide_bg_container_id = 'agni-slide-bg-container-'.rand(10000, 99999);
                        $textslider_bg = '<a id="bgndVideo-'.$post.'" class="player" style="background-image:url('.$textslider_bg_video_src_yt_fallback.');" data-property="{videoURL:\''.$textslider_bg_video_src_yt.'\',containment:\'.'.$agni_slide_bg_container_id.'\', showControls:false, autoPlay:'.$textslider_bg_video_autoplay.', loop:'.$textslider_bg_video_loop.', vol:'.$textslider_bg_video_volume.', mute:'.$textslider_bg_video_muted.', startAt:'.$textslider_bg_video_start_at.', stopAt:'.$textslider_bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$textslider_bg_video_quality.'\',}"></a>';
                    }
                    else if( $textslider_bg_video_src == '2' ){
                        $textslider_bg = '<div id="agni-selfhosted-video-'.$post.'" class="agni-slide-bg agni-slide-bg-video self-hosted embed-responsive">
                                <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.$textslider_bg_video_src_sh_poster.'">
                                    <source src="'.$textslider_bg_video_src_sh.'" type="video/mp4">
                                </video>
                            </div>';
                    }
                }
                
                if ( $textslider_bg_choice != 'bg_color' && $textslider_overlay_choice != '4' ){
                    if( $textslider_overlay_choice == '3' ){
                        $textslider_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$textslider_bg_gm_overlay_color1.','.$textslider_bg_gm_overlay_color2.','.$textslider_bg_gm_overlay_color3.' " style="background-image:url('.$textslider_bg_image.'); background-repeat:'.$textslider_bg_image_repeat.'; background-position:'.$textslider_bg_image_position.'; background-size:'.$textslider_bg_image_size.'; "></div>';
                    }
                    elseif ( $textslider_overlay_choice == '2' ) {
                        $textslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$textslider_bg_sg_overlay_css.';"></div>';
                    }
                    else{
                        $textslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$textslider_overlay_color.';"></div>';
                    }
                }

                // BG particles
                if( $textslider_bg_particle_ground == 'on' ){
                    $textslider_bg_particle_ground_color = ( $textslider_bg_particle_ground_color != '' ) ? $textslider_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                    $textslider_particle_ground = '<div class="particles" data-color="'.$textslider_bg_particle_ground_color.'"></div>';
                } 

                $output = '<div id="agni-slider-'.$post.'" class="agni-slider agni-text-slider" '.$slide_height.' data-slider-choice="'.$textslider_choice.'" data-slider-autoplay-timeout="'.$textslider_transition_duration.'" data-slider-smart-speed="'.$textslider_transition_speed.'" data-slider-mousedrag="'.$textslider_mousedrag.'" data-slider-nav="'.$textslider_navigation.'" data-slider-dots="'.$textslider_pagination.'" data-slider-autoplay="'.$textslider_autoplay.'" data-slider-loop="'.$textslider_loop.'" data-slider-animate-in="'.$textslider_animate_in.'" data-slider-animate-out="'.$textslider_animate_out.'" '.$textslider_carousel.'><div class="agni-slide-bg-container '.$agni_slide_bg_container_id.'" '.$slide_parallax.'>'.$textslider_bg.$textslider_overlay.$textslider_particle_ground.'</div>'.$slides.'</div>';
                
                return $output;

                break;

            case 'imageslider':
                
                $slides = $imageslider_animation = $slide_height = $slide_parallax = $imageslider_image = $imageslider_title = $imageslider_title_effect = $imageslider_title_size = $imageslider_title_color = $imageslider_desc = $imageslider_desc_size = $imageslider_desc_color = $imageslider_title_line = $imageslider_title_line_color = $imageslider_button1 = $imageslider_button1_icon = $imageslider_button1_url = $imageslider_button1_style = $imageslider_button1_type = $imageslider_button1_radius = $imageslider_button1_target = $imageslider_button1_lightbox = $imageslider_button2 = $imageslider_button2_icon = $imageslider_button2_url = $imageslider_button2_style = $imageslider_button2_type = $imageslider_button2_radius = $imageslider_button2_target = $imageslider_button2_lightbox = $imageslider_buttons = $imageslider_arrow = $imageslider_arrowicon = $imageslider_arrowlink = $imageslider_arrowicon_color = $imageslider_vertical_alignment = $imageslider_text_alignment = $imageslider_padding = $imageslider_padding_top = $imageslider_padding_bottom = $imageslider_padding_right = $imageslider_padding_left = $imageslider_has_animation = $imageslider_animation_delay = $imageslider_animation_delay_amount = '';
                        
                $imageslider_repeatable = get_post_meta( $post, 'agni_slides_imageslider_repeatable', true );
                
                $imageslider_choice = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_choice', true ) );
                $imageslider_height = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height', true ) );
                $imageslider_height_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height_tab', true ) );
                $imageslider_height_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_height_mobile', true ) );
                $imageslider_parallax = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax', true ) );
                $imageslider_parallax_start = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax_start', true ) );
                $imageslider_parallax_end = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_parallax_end', true ) );
                $imageslider_animate_in = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_animate_in', true ) );
                $imageslider_animate_out = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_animate_out', true ) );
                $imageslider_autoplay = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_autoplay', true ) ) == 'on')?'true':'false';
                $imageslider_loop = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_loop', true ) ) == 'on')?'true':'false';
                $imageslider_transition_duration = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_transition_duration', true ) );
                $imageslider_transition_speed = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_transition_speed', true ) );
                $imageslider_navigation = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_navigation', true ) ) == 'on')?'true':'false';
                $imageslider_pagination = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_pagination', true ) ) == 'on')?'true':'false';
                $imageslider_mousedrag = (esc_attr( get_post_meta( $post, 'agni_slides_imageslider_mousedrag', true ) ) == 'on')?'true':'false';

                $imageslider_image_id = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_id', true ) );
                $imageslider_image_size = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_size', true ) );
                $imageslider_image_size_tab = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_size_tab', true ) );
                $imageslider_image_size_mobile = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_image_size_mobile', true ) );
                $imageslider_title = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title', true ) );
                $imageslider_title_rotator = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_rotator', true ) );
                $imageslider_title_rotator_choice = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_rotator_choice', true ) );
                $imageslider_title_font = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_font', true ) );   
                $imageslider_title_size = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_size', true ) );   
                $imageslider_title_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_title_color', true ) ); 
                $imageslider_title_line = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_line', true ) );
                $imageslider_title_line_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_line_color', true ) );
                $imageslider_desc = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc', true ) );
                $imageslider_desc_font = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_font', true ) ); 
                $imageslider_desc_size = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_size', true ) ); 
                $imageslider_desc_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_desc_color', true ) );
                $imageslider_button1 = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1', true ) );
                $imageslider_button1_icon = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_icon', true ) );
                $imageslider_button1_url = esc_url( get_post_meta( $post, 'agni_slides_imageslider_button1_url', true ) );
                $imageslider_button1_style = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_style', true ) );
                $imageslider_button1_type = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_type', true ) );
                $imageslider_button1_radius = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_radius', true ) );
                $imageslider_button1_target = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_target', true ) );
                $imageslider_button1_lightbox = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button1_lightbox', true ) );
                $imageslider_button2 = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2', true ) );
                $imageslider_button2_icon = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_icon', true ) );
                $imageslider_button2_url = esc_url( get_post_meta( $post, 'agni_slides_imageslider_button2_url', true ) );
                $imageslider_button2_style = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_style', true ) );
                $imageslider_button2_type = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_type', true ) );
                $imageslider_button2_radius = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_radius', true ) );
                $imageslider_button2_target = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_target', true ) );
                $imageslider_button2_lightbox = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_button2_lightbox', true ) );
                $imageslider_animation = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_animation', true ) );
                $imageslider_arrowicon = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_arrowicon', true ) );
                $imageslider_arrowlink = esc_url( get_post_meta( $post, 'agni_slides_imageslider_arrowlink', true ) );
                $imageslider_arrowicon_color = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_arrowicon_color', true ) );
                $imageslider_vertical_alignment = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_vertical_alignment', true ) );
                $imageslider_text_alignment = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_text_alignment', true ) );
                $imageslider_padding_top = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_top', true ) );
                $imageslider_padding_bottom = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_bottom', true ) );
                $imageslider_padding_right = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_right', true ) );
                $imageslider_padding_left = esc_attr( get_post_meta( $post, 'agni_slides_imageslider_padding_left', true ) );


                if( $imageslider_choice == '1' ){
                    $slide_height = 'data-fullscreen-height = 1';
                }
                else{
                    $slide_height = 'data-height="'.$imageslider_height.'" data-height-tab="'.$imageslider_height_tab.'" data-height-mobile="'.$imageslider_height_mobile.'"';
                }
                
                if( $imageslider_parallax == 'on' && $shortcode == false ){
                    $slide_parallax = 'data-0="'.$imageslider_parallax_start.'" data-1500="'.$imageslider_parallax_end.'"';
                }
                $imageslider_carousel = 'data-slider-992-items="1" data-slider-768-items="1" data-slider-0-items="1" data-slider-carousel-margin="0"';

                if( !empty($imageslider_animation) ){
                        $imageslider_has_animation = 'has-slide-content-animation';
                        $imageslider_animation_delay_amount = 0;
                }

                if( !empty($imageslider_image_id) ){
                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = ' -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_image_width = 'data-width="'.$imageslider_image_size.'" data-width-tab="'.$imageslider_image_size_tab.'" data-width-mobile="'.$imageslider_image_size_mobile.'"';
                    
                    $imageslider_image = '<div class="agni-slide-image '.$imageslider_animation.'" style="'.$imageslider_animation_delay.'" '.$imageslider_image_width.'>'.wp_get_attachment_image($imageslider_image_id, 'full' ).'</div>';
                }

                if ( !empty($imageslider_title) ){
                    $imageslider_title_span = $imageslider_title_no_span[0] = $imageslider_title_no_span[1] = '';

                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = ' -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;';
                        $imageslider_animation_delay_amount += 250;
                    }

                    if ( strpos($imageslider_title, '|') !== false && $imageslider_title_rotator == 'on') {
                        $imageslider_title_span = $imageslider_title_no_span[0] = $imageslider_title_no_span[1] = '';

                        $imageslider_title_effect = 'class="cd-headline '.$imageslider_title_rotator_choice.'"';

                        $imageslider_title_decode = htmlspecialchars_decode( $imageslider_title );
                        $pattern = '/<span>(.*?)<\/span>/';
                        $imageslider_title_no_span  = preg_split( $pattern, $imageslider_title_decode );

                        $imageslider_title_span_content = substr($imageslider_title_decode, strpos($imageslider_title_decode, "<span>") + 0);
                        $imageslider_title_span_content = substr($imageslider_title_span_content, 0, strpos($imageslider_title_span_content, "</span>") + 7);
                        $imageslider_title_span_content = explode( "|", $imageslider_title_span_content );
                        foreach( $imageslider_title_span_content as $imageslider_title_span_text ){
                            $imageslider_title_span .=  '<span class="rotate">'.$imageslider_title_span_text.'</span>';
                        }
                        $imageslider_title_span = str_replace('<span class="rotate"><span>', '<span class="cd-words-wrapper"><span class="rotate is-visible">', $imageslider_title_span);
                        
                        $imageslider_title = $imageslider_title_no_span[0].$imageslider_title_span.$imageslider_title_no_span[1];
                    }
                    $imageslider_title = '<div class="agni-slide-title '.$imageslider_animation.' '.$imageslider_title_font.'" style="font-size:'.$imageslider_title_size.'px; color:'.$imageslider_title_color.'; '.$imageslider_animation_delay.'"><'.apply_filters( 'agni_slider_h_tag', $args = '' ).' '.$imageslider_title_effect.'>'.htmlspecialchars_decode( esc_attr( $imageslider_title ) ).'</'.apply_filters( 'agni_slider_h_tag', $args = '' ).'></div>';
                }

                if ( $imageslider_title_line == 'on' ){

                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = 'style=" -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms; "';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_title_line = '<div class="agni-slide-divideline divide-line '.$imageslider_animation.'" '.$imageslider_animation_delay.'><span style="background-color:'.$imageslider_title_line_color.';"></span></div>'; 
                }
                    
                if ( !empty($imageslider_desc) ){
                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = ' -webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_desc = '<div class="agni-slide-description '.$imageslider_animation.' '.$imageslider_desc_font.'" style="font-size:'.$imageslider_desc_size.'px; color:'.$imageslider_desc_color.'; '.$imageslider_animation_delay.'"><p>'.htmlspecialchars_decode( $imageslider_desc ).'</p></div>';
                }

                if ( !empty($imageslider_arrowlink) ){
                    if( !empty( $imageslider_arrowlink ) ){
                        $imageslider_arrow = '<div class="agni-slide-arrow page-scroll"><a href="'.$imageslider_arrowlink.'" style="color:'.$imageslider_arrowicon_color.'"><i class="'.$slide['imageslider_arrowicon'].'"></i></a></div>';
                    }
                }

                if( !empty($imageslider_button1) ){

                    if( !empty($imageslider_button1_icon) ){
                        $imageslider_button1_icon = '<i class="'.$imageslider_button1_icon.'"></i>';
                    }
                    if( $imageslider_button1_lightbox == 'on' ){
                        $imageslider_button1_lightbox = 'custom-video-link has-video-lightbox';
                    }
                    if( !empty($imageslider_button1_radius) ){
                        $imageslider_button1_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_button1_radius ) ? $imageslider_button1_radius : $imageslider_button1_radius . 'px' ).';"';
                    }

                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = 'style="-webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;"';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-1 page-scroll '.$imageslider_button1_lightbox.' '.$imageslider_animation.'" '.$imageslider_animation_delay.'><a class="btn btn-'.$imageslider_button1_style.' '.$imageslider_button1_type.'" href="'.$imageslider_button1_url.'" target="'.$imageslider_button1_target.'" '.$imageslider_button1_radius.'>'.$imageslider_button1.$imageslider_button1_icon.'</a></div>';

                }
                if( !empty($imageslider_button2) ){

                    if( !empty($imageslider_button2_icon) ){
                        $imageslider_button2_icon = '<i class="'.$imageslider_button2_icon.'"></i>';
                    }
                    if( $imageslider_button2_lightbox == 'on' ){
                        $imageslider_button2_lightbox = 'custom-video-link has-video-lightbox';
                    }
                    if( !empty($imageslider_button2_radius) ){
                        $imageslider_button2_radius = 'style="border-radius:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_button2_radius ) ? $imageslider_button2_radius : $imageslider_button2_radius . 'px' ).';"';
                    }

                    if( $imageslider_has_animation == 'has-slide-content-animation'){
                        $imageslider_animation_delay = 'style="-webkit-animation-delay: '.$imageslider_animation_delay_amount.'ms; animation-delay: '.$imageslider_animation_delay_amount.'ms;"';
                        $imageslider_animation_delay_amount += 250;
                    }
                    $imageslider_buttons .= '<div class="agni-slide-btn-container agni-slide-btn-2 page-scroll '.$imageslider_button2_lightbox.' '.$imageslider_animation.'" '.$imageslider_animation_delay.'><a class="btn btn-'.$imageslider_button2_style.' '.$imageslider_button2_type.'" href="'.$imageslider_button2_url.'" target="'.$imageslider_button2_target.'" '.$imageslider_button2_radius.'>'.$imageslider_button2.$imageslider_button2_icon.' </a></div>';
                }
                if( !empty($imageslider_buttons) ){
                    $imageslider_buttons = '<div class="agni-slide-buttons">'.$imageslider_buttons.'</div>';
                } 
                    
                $imageslider_padding .= 'padding-top:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_padding_top ) ? $imageslider_padding_top : $imageslider_padding_top . 'px' ).';';
                $imageslider_padding .= 'padding-bottom:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_padding_bottom ) ? $imageslider_padding_bottom : $imageslider_padding_bottom . 'px' ).';';
                $imageslider_padding .= 'padding-right:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_padding_right ) ? $imageslider_padding_right : $imageslider_padding_right . 'px' ).';';
                $imageslider_padding .= 'padding-left:'.( preg_match( '/(px|em|\%|pt|cm)$/', $imageslider_padding_left ) ? $imageslider_padding_left : $imageslider_padding_left . 'px' ).';';
                
                foreach( (array) $imageslider_repeatable as $key => $slide ){
                    $imageslider_bg_choice = $imageslider_bg_color = $imageslider_bg_image = $imageslider_bg_image_position = $imageslider_bg_image_repeat = $imageslider_bg_image_size = $imageslider_overlay =  $imageslider_overlay_choice = $imageslider_overlay_color = $imageslider_bg_sg_overlay_css = $imageslider_bg_gm_overlay_color1 = $imageslider_bg_gm_overlay_color2 = $imageslider_bg_gm_overlay_color3 = $imageslider_particle_ground = $imageslider_bg_particle_ground = $imageslider_bg_particle_ground_color = $imageslider_bg = $imageslider_size = '';

                    if( isset( $slide['imageslider_bg_choice'] ) )
                        $imageslider_bg_choice = esc_attr( $slide['imageslider_bg_choice'] );

                    if( isset( $slide['imageslider_bg_color'] ) )
                        $imageslider_bg_color = esc_attr( $slide['imageslider_bg_color'] );

                    if( isset( $slide['imageslider_bg_image'] ) )
                        $imageslider_bg_image = esc_attr( $slide['imageslider_bg_image'] );

                    if( isset( $slide['imageslider_bg_image_position'] ) )
                        $imageslider_bg_image_position = esc_attr( $slide['imageslider_bg_image_position'] );

                    if( isset( $slide['imageslider_bg_image_repeat'] ) )
                        $imageslider_bg_image_repeat = esc_attr( $slide['imageslider_bg_image_repeat'] );

                    if( isset( $slide['imageslider_bg_image_size'] ) )
                        $imageslider_bg_image_size = esc_attr( $slide['imageslider_bg_image_size'] );
                                        
                    if ( isset( $slide['imageslider_bg_overlay_choice'] ) )
                        $imageslider_overlay_choice = esc_attr( $slide['imageslider_bg_overlay_choice'] );
                        
                    if ( isset( $slide['imageslider_bg_overlay_color'] ) )
                        $imageslider_overlay_color = esc_attr( $slide['imageslider_bg_overlay_color'] );        

                    if ( isset( $slide['imageslider_bg_sg_overlay_css'] ) )
                        $imageslider_bg_sg_overlay_css = esc_attr( $slide['imageslider_bg_sg_overlay_css'] );

                    if ( isset( $slide['imageslider_bg_gm_overlay_color1'] ) )
                        $imageslider_bg_gm_overlay_color1 = esc_attr( $slide['imageslider_bg_gm_overlay_color1'] ); 

                    if ( isset( $slide['imageslider_bg_gm_overlay_color2'] ) )
                        $imageslider_bg_gm_overlay_color2 = esc_attr( $slide['imageslider_bg_gm_overlay_color2'] ); 

                    if ( isset( $slide['imageslider_bg_gm_overlay_color3'] ) )
                        $imageslider_bg_gm_overlay_color3 = esc_attr( $slide['imageslider_bg_gm_overlay_color3'] ); 

                    if ( isset( $slide['imageslider_bg_particle_ground'] ) )
                        $imageslider_bg_particle_ground = esc_attr( $slide['imageslider_bg_particle_ground'] ); 

                    if ( isset( $slide['imageslider_bg_particle_ground_color'] ) )
                        $imageslider_bg_particle_ground_color = esc_attr( $slide['imageslider_bg_particle_ground_color'] ); 

                        
                    if ( $imageslider_bg_choice == 'bg_color' ){
                        $imageslider_bg = '<div class="agni-slide-bg agni-slide-bg-color" style="background-color:'.$imageslider_bg_color.'; "></div>';
                    }
                    else {
                        $imageslider_bg = '<div class="agni-slide-bg agni-slide-bg-image" style="background-image:url('.$imageslider_bg_image.'); background-repeat:'.$imageslider_bg_image_repeat.'; background-position:'.$imageslider_bg_image_position.'; background-size:'.$imageslider_bg_image_size.'; "></div>';
                    }
                    
                    if ( $imageslider_bg_choice != 'bg_color' && $imageslider_overlay_choice != '4' ){
                        if( $imageslider_overlay_choice == '3' ){
                            $imageslider_overlay = '<div class="agni-slide-bg-overlay agni-gradient-map-overlay gradient-map-overlay overlay" data-gm="'.$imageslider_bg_gm_overlay_color1.','.$imageslider_bg_gm_overlay_color2.','.$imageslider_bg_gm_overlay_color3.' " style="background-image:url('.$imageslider_bg_image.'); background-repeat:'.$imageslider_bg_image_repeat.'; background-position:'.$imageslider_bg_image_position.'; background-size:'.$imageslider_bg_image_size.'; "></div>';
                        }
                        elseif ( $imageslider_overlay_choice == '2' ) {
                            $imageslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="'.$imageslider_bg_sg_overlay_css.';"></div>';
                        }
                        else{
                            $imageslider_overlay = '<div class="agni-slide-bg-overlay overlay" style="background-color:'.$imageslider_overlay_color.';"></div>';
                        }
                    }

                    // BG particles
                    if( $imageslider_bg_particle_ground == 'on' ){
                        $imageslider_bg_particle_ground_color = ( $imageslider_bg_particle_ground_color != '' ) ? $imageslider_bg_particle_ground_color : 'rgba(255,255,255,0.2)';
                        $imageslider_particle_ground = '<div class="particles" data-color="'.$imageslider_bg_particle_ground_color.'"></div>';
                    } 
                    
                    $slides .= '<div class="agni-slide '.$imageslider_has_animation.'" '.$slide_parallax.'>
                        <div class="agni-slide-bg-container">'.$imageslider_bg.$imageslider_overlay.$imageslider_particle_ground.'</div>
                    </div>';

                }

                $output = '<div id="agni-slider-'.$post.'" class="agni-slider agni-image-slider" '.$slide_height.' data-slider-choice="'.$imageslider_choice.'" data-slider-autoplay-timeout="'.$imageslider_transition_duration.'" data-slider-smart-speed="'.$imageslider_transition_speed.'" data-slider-mousedrag="'.$imageslider_mousedrag.'" data-slider-nav="'.$imageslider_navigation.'" data-slider-dots="'.$imageslider_pagination.'" data-slider-autoplay="'.$imageslider_autoplay.'" data-slider-loop="'.$imageslider_loop.'" data-slider-animate-in="'.$imageslider_animate_in.'" data-slider-animate-out="'.$imageslider_animate_out.'" '.$imageslider_carousel.'>'.$slides.'
                    <div class="agni-slide-content-container container agni-slide-align-items-'.$imageslider_vertical_alignment.' agni-slide-justify-content-'.$imageslider_text_alignment.'">
                        <div class="agni-slide-content-inner page-scroll" style="'.$imageslider_padding.'">
                            '.$imageslider_image.$imageslider_title.$imageslider_title_line.$imageslider_desc.$imageslider_buttons.$imageslider_arrow.'
                        </div>
                    </div>
                </div>';
                
                return $output;
        }
    }
}

/**
 * TGM Plugin activation function
 */
function fortun_register_required_plugins() {

    $plugins = array(
        
        array(
            'name'                  => 'Agni Fortun', 
            'slug'                  => 'agni-fortun-plugin', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/agni-fortun-plugin.zip', 
            'required'              => true,
            'version'               => '1.0.1', 
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'      => '',
        ),
        
        array(
            'name'                  => 'WPBakery Visual Composer', 
            'slug'                  => 'js_composer', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/js_composer.zip', 
            'required'              => true,
            'version'               => '5.5.5', 
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
        
        array(
            'name'                  => 'Contact Form 7', 
            'slug'                  => 'contact-form-7', 
            'source'                => '', 
            'required'              => false,
            'version'               => '4.9', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/contact-form-7/' ),
        ),
        
        array(
            'name'                  => 'Revolution Slider', 
            'slug'                  => 'revslider', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/revslider.zip', 
            'required'              => false,
            'version'               => '5.4.8', 
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => esc_url( 'http://revolution.themepunch.com/' ),
        ),
        
        array(
            'name'                  => 'MailChimp for WordPress', 
            'slug'                  => 'mailchimp-for-wp', 
            'source'                => '', 
            'required'              => false,
            'version'               => '4.1.9', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/mailchimp-for-wp/' ),
        ),

        array(
            'name'                  => 'WooCommerce', 
            'slug'                  => 'woocommerce', 
            'source'                => '',
            'required'              => false,
            'version'               => '3.4.7', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/woocommerce/' ),
        ),

        array(
            'name'                  => 'Restaurant Reservations', 
            'slug'                  => 'restaurant-reservations', 
            'source'                => '', 
            'required'              => false,
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://wordpress.org/plugins/restaurant-reservations/' ),
        ),
        array(
            'name'                  => 'Envato Market', 
            'slug'                  => 'envato-market', 
            'source'                => AGNI_FRAMEWORK_DIR . '/template/plugins/envato-market.zip', 
            'required'              => false,
            'version'               => '1.0.0-RC2', 
            'force_activation'      => false,
            'force_deactivation'    => false, 
            'external_url'          => esc_url( 'https://envato.github.io/wp-envato-market/' ),
        ),

        
        
    );

    $config = array(  
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'fortun-install-plugins', // Menu slug.
        'parent_slug'  => 'fortun',               // Parent menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                       
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required Plugins', 'fortun' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'fortun' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'fortun' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'fortun' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'fortun' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'fortun' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'fortun' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'fortun' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'fortun' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'fortun' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'fortun' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'fortun' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'fortun' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'fortun' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'fortun' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'fortun' ),
            'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'fortun' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'fortun_register_required_plugins' );
