<?php
global $fortun_options;
/**
 * Loading Custom theme functions.
 */
function fortun_woocommerce_setup() {

	// Removing Wocommerce CSS
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

}
add_action( 'woocommerce_init', 'fortun_woocommerce_setup', 3 );

function fortun_woocommerce_scripts(){
	wp_enqueue_style( 'fortun-woocommerce-style', AGNI_FRAMEWORK_URL .'/template/woocommerce/css/woocommerce-style.css', array(), wp_get_theme()->get('Version')  );
    if( is_rtl() ){
        wp_enqueue_style( 'fortun-woocommerce-rtl-style', AGNI_FRAMEWORK_URL .'/template/woocommerce/css/woocommerce-style-rtl.css', array(), wp_get_theme()->get('Version') );
    }

	wp_enqueue_script( 'fortun-woocommerce-easyzoom', get_template_directory_uri() .'/template/woocommerce/js/easyzoom.min.js', array(), wp_get_theme()->get('Version'), true );
	wp_enqueue_script( 'fortun-woocommerce-script', get_template_directory_uri() .'/template/woocommerce/js/woocommerce-script.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'fortun_woocommerce_scripts' );

function fortun_woocommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Sidebar', 'fortun' ),
		'id'            => 'fortun-sidebar-2',
		'description'   => 'Additional Widget location that could appear on the left/right of shop pages.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'fortun_woocommerce_widgets_init' );

// Ensure cart contents update when products are added to the cart via AJAX.
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $fortun_options;
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart', 'fortun' ); ?>"><?php if($fortun_options['header-cart-amount'] == '1'){ echo WC()->cart->get_cart_total(); } ?><span class="header-toggle"><span class="header-cart-icon"><i class="pe-7s-shopbag"></i></span><span class="product-count"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'fortun' ), WC()->cart->cart_contents_count ); ?></span></span></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_contents();
	ob_end_clean();
	return $fragments;
}

// Woocommerce product title override
function woocommerce_template_loop_product_title() {
	?><h6 class="product-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6><?php
	
}

// Woocommerce Category title override
function woocommerce_template_loop_category_title( $category ) {
	echo '<h6 class="product-category-title">'.$category->name;
	if ( $category->count > 0 )
		echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
	echo '</h6>';
} 

// Woocommerce product thumbnail override 
function woocommerce_get_product_thumbnail( $size = 'fortun-standard-thumbnail', $deprecated1 = 0, $deprecated2 = 0 ) {
	global $post, $fortun_options;
	$shop_thumbnail_hardcrop = esc_attr( $fortun_options['shop-thumbnail-hardcrop'] );
	$shop_thumbnail_dimension_custom = esc_attr( $fortun_options['shop-thumbnail-dimension-custom'] );

	$shop_additional_thumbnail_id = esc_attr( get_post_meta( $post->ID, 'product_thumbnail_features_image_id', true ) );
	
	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

	if ( has_post_thumbnail() ) {
		if( $shop_thumbnail_hardcrop == '1'){
            $shop_thumbnail_customcrop_dimension = explode( 'x', $shop_thumbnail_dimension_custom );
            $shop_thumbnail = agni_thumbnail_customcrop( get_post_thumbnail_id(), $shop_thumbnail_customcrop_dimension[0].'x'.$shop_thumbnail_customcrop_dimension[1], 'shop-thumbnail-attachment-image' );
            if( !empty($shop_additional_thumbnail_id) ){
	            $shop_thumbnail .= '<div class="product-additional-thumbnail-container">'.agni_thumbnail_customcrop( $shop_additional_thumbnail_id, $shop_thumbnail_customcrop_dimension[0].'x'.$shop_thumbnail_customcrop_dimension[1], 'shop-thumbnail-attachment-image' ).'</div>';
	        }
        }
        else{
        	$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$shop_thumbnail = get_the_post_thumbnail( $post->ID, $image_size, array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
			) );
			if( !empty($shop_additional_thumbnail_id) ){
				$addtional_attr = array(
					'class' => $image_size.' fortun-product-additional-thumbnail',
				);
				$shop_thumbnail .= '<div class="product-additional-thumbnail-container">'.wp_get_attachment_image($shop_additional_thumbnail_id, $image_size, false, $addtional_attr ).'</div>';
			}
        }
        return $shop_thumbnail;
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $image_size );
	}
}

// Removing breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Removing & Showing sidebar as per the option panel value
if( $fortun_options['shop-single-sidebar'] == 'no-sidebar' ){ 
	function fortun_woocommerce_remove_sidebar() {
	    if ( is_singular('product') ) {
	        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	    }
	}
	add_action('template_redirect', 'fortun_woocommerce_remove_sidebar');
}

// Variable Single Product price override
function woocommerce_single_variation() {
	echo '<h4 class="single_variation"></h4>';
}

// Removing cross_sell_display (you may know this items) from collaterals
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

// Adding back the cross_sell_display (you may know this items)
add_action( 'agni_woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
?>