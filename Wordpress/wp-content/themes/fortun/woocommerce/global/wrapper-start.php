<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $fortun_options, $post;

$agni_slider = $yith_wishlist = ''; 
$shop_id = $post->ID;
if( is_shop() ){
	$shop_id = wc_get_page_id('shop');
}
$agni_slides_post_id = esc_attr( get_post_meta($shop_id, 'page_agni_sliders', true) );	
	foreach ( (array) $agni_slides_post_id as $key => $slider ) {
		echo agni_slider( $slider, false );
	}

?>    
<?php echo agni_page_header( $shop_id ); 

if(is_plugin_active( 'yith-woocommerce-wishlist/init.php')){
	$yith_wishlist = ' has-yith-wishlist';
}

$page_bg_color = esc_attr( get_post_meta( $shop_id, 'page_bg_color', true ) );
$page_remove_title = esc_attr( get_post_meta( $shop_id, 'page_remove_title', true ) );
$page_layout = esc_attr( get_post_meta( $shop_id, 'page_layout', true ) );
$page_sidebar = esc_attr( get_post_meta( $shop_id, 'page_sidebar', true ) );

?>

<?php if(is_singular('product')){ 
	if( $page_layout == '' ){
		$page_layout = esc_attr( $fortun_options['shop-single-layout'] );
	}

	if( $page_sidebar == '' ){
		$page_sidebar = esc_attr( $fortun_options['shop-single-sidebar'] );
	} ?>
	<section class="shop page-single-shop  <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
		<div class="page-single-shop-container">
			<div class="shop-single-row row <?php echo esc_attr( $page_sidebar ); ?> <?php echo esc_attr( $yith_wishlist ); ?>">
				<div class="col-sm-12 col-md-<?php if( $page_sidebar != 'no-sidebar' ){ echo '9'; }else { echo '12'; } ?> page-single-shop-content">
					<div id="primary" class="content-area">
						<main id="main" class="site-main clearfix" role="main">
<?php } 
else{ 
	$shop_column_layout = esc_attr( $fortun_options['shop-column-layout'] );
	$shop_navigation = esc_attr( $fortun_options['shop-navigation'] );
    $shop_navigation_choice = esc_attr( $fortun_options['shop-navigation-choice'] );

	if( $page_remove_title == '' ){
		$page_remove_title = esc_attr( $fortun_options['page-remove-title'] );
	}
	if( $page_layout == '' ){
		$page_layout = esc_attr( $fortun_options['shop-layout'] );
	}
	if( $page_sidebar == '' ){
		$page_sidebar = esc_attr( $fortun_options['shop-sidebar'] );
	} ?>
	<section class="shop page-shop <?php if( $page_layout == 'container-fluid' ){ echo 'has-fullwidth'; }else{ echo 'has-container'; } ?>" <?php if( !empty($page_bg_color) ){ echo 'style="background-color:'.$page_bg_color.'"'; } ?>>
		<div class="page-shop-container <?php echo esc_attr( $page_layout ); ?>">
			<div class="shop-row row <?php echo esc_attr( $shop_column_layout ); ?>column-layout-post <?php echo esc_attr( $page_sidebar ); ?> <?php echo esc_attr( $yith_wishlist ); ?>">
				<div class="col-sm-12 col-md-<?php if( $page_sidebar != 'no-sidebar' ){ echo '9'; }else { echo '12'; } ?> page-shop-content">
					<div id="primary" class="content-area">
						<main id="main" class="site-main<?php 
						if( $shop_navigation_choice == '2' || $shop_navigation_choice == '3' ){ 
		                    echo ' has-infinite-scroll'; 
		                    echo ( $shop_navigation_choice == '3')?' has-load-more':'';
		                } ?> clearfix" role="main">
<?php } ?>
