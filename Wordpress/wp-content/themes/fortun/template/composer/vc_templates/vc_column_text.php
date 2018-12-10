<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $additional_class = $additional_attr = $design_css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'agni_text_column agni-text-block ';
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$output = wpb_js_remove_wpautop( $content, true );
if( $parallax == '1' ){
	$additional_class .= ' has-parallax';
	$additional_attr .= ' data-bottom-top="'.$parallax_start.'" data-top-bottom="'.$parallax_end.'"';
}

if( !empty($margin_top) ){
	$design_css .= 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_top ) ? $margin_top : $margin_top . 'px' ) . '; ';
}
if( !empty($margin_right) ){
	$design_css .= 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_right ) ? $margin_right : $margin_right . 'px' ) . '; ';
}
if( !empty($margin_bottom) ){
	$design_css .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . '; ';
}
if( !empty($margin_left) ){
	$design_css .= 'margin-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_left ) ? $margin_left : $margin_left . 'px' ) . '; ';
}
if( !empty($padding_top) ){
	$design_css .= 'padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_top ) ? $padding_top : $padding_top . 'px' ) . '; ';
}
if( !empty($padding_right) ){
	$design_css .= 'padding-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_right ) ? $padding_right : $padding_right . 'px' ) . '; ';
}
if( !empty($padding_bottom) ){
	$design_css .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_bottom ) ? $padding_bottom : $padding_bottom . 'px' ) . '; ';
}
if( !empty($padding_left) ){
	$design_css .= 'padding-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_left ) ? $padding_left : $padding_left . 'px' ) . '; ';
}
if( !empty($border_top) ){
	$design_css .= 'border-top-width: ' . $border_top . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-top-style: ' . $border_style . '; ';
	}
}
if( !empty($border_right) ){
	$design_css .= 'border-right-width: ' . $border_right . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-right-style: ' . $border_style . '; ';
	}
}
if( !empty($border_bottom) ){
	$design_css .= 'border-bottom-width: ' . $border_bottom . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-bottom-style: ' . $border_style . '; ';
	}
}
if( !empty($border_left) ){
	$design_css .= 'border-left-width: ' . $border_left . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-left-style: ' . $border_style . '; ';
	}
}
if( !empty($border_color) ){
	$design_css .= 'border-color: ' . $border_color.'; ';
}
if( !empty($border_radius) ){
	$design_css .= 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $border_radius ) ? $border_radius : $border_radius . 'px' ) . '; ';
}

if( !empty($design_css) ){
	$design_css = 'style="'.$design_css.'"';
}

if( $animation == '1' ){
	$output = '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s; 	animation-delay: '.$animation_delay.'s; 	-moz-animation-duration: '.$animation_duration.'s; 	-moz-animation-delay: '.$animation_delay.'s; 	-webkit-animation-duration: '.$animation_duration.'s; 	-webkit-animation-delay: '.$animation_delay.'s;">'.$output.'</div>';	
}
/*if( $animation == '1' ){
	$additional_class .= ' animate';
	$additional_attr .= ' data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s; 	animation-delay: '.$animation_delay.'s; 	-moz-animation-duration: '.$animation_duration.'s; 	-moz-animation-delay: '.$animation_delay.'s; 	-webkit-animation-duration: '.$animation_duration.'s; 	-webkit-animation-delay: '.$animation_delay.'s;"';
}*/
$output = '
	<div class="' . esc_attr( $css_class ) . $additional_class. '" '.$additional_attr.' '.$design_css.'>
		' . $output . '
	</div>
';

echo  $output;
