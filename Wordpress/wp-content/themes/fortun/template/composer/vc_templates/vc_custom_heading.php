<?php
/**
 * Shortcode attributes
 * @var $atts
 * //@var $source
 * @var $divide_line
 * @var $divide_line_width
 * @var $divide_line_color
 * @var $custom_heading_letter_spacing
 * @var $custom_heading_font_weight
 * @var $responsive_font_size
 * @var $text
 * //@var $link
 * @var $google_fonts
 * @var $font_container
 * @var $el_class
 * @var $css
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data - returned from $this->getAttributes
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */

$additional_class = $additional_attr = $design_css = $css = '';

// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if ( isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if( $custom_heading_font_weight != '' ){
	$custom_heading_font_weight = 'font-weight:'.$custom_heading_font_weight.'; ';
}
if( $font_italic == 'yes' ){
	$font_italic = 'font-style:italic; ';
}
if( $custom_heading_letter_spacing != '' ){
	$custom_heading_letter_spacing =  ( preg_match( '/(px|em|\%|pt|cm)$/', $custom_heading_letter_spacing ) ? 'letter-spacing:'. $custom_heading_letter_spacing : 'letter-spacing:'. $custom_heading_letter_spacing . 'px' ).'; ';
}
$design_css = esc_attr( implode( ';', $styles ) ) . '; '.$custom_heading_font_weight.$font_italic.$custom_heading_letter_spacing;

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

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"'
	        . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	        . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	        . '>' . $text . '</a>';
}
if( $icon != '' ){
	$icon = '<i class="'.$icon.'"></i>  -  ';
}

if( $divide_line == 'yes' ){
	$divide_line = '<div class="divide-line text-'.$font_container_data['values']['text_align'].' "><span style="width:'.( preg_match( '/(px|em|\%|pt|cm)$/', $divide_line_width ) ? $divide_line_width : $divide_line_width . 'px' ).'; height:'.( preg_match( '/(px|em|\%|pt|cm)$/', $divide_line_height ) ? $divide_line_height : $divide_line_height . 'px' ).'; background-color:'.$divide_line_color.'"></span></div>';
}

if($responsive_font_size == 'yes'){
	$css_class .= ' agni_custom_heading_responsive ';
}
$css_class .= ' agni_custom_heading_content ';

if( $parallax == '1' ){
	$additional_class = ' column-has-parallax';
	$additional_attr = 'data-bottom-top="'.$parallax_start.'" data-top-bottom="'.$parallax_end.'"';
}

$output = '';
$output .= '<div class="agni_custom_heading page-scroll'.$additional_class.'" '.$additional_attr.'>';
if( $animation == '1' ){
	$output .= '<div class="animate" data-animation="'.$animation_style.'" data-animation-offset="'.$animation_offset.'" style="animation-duration: '.$animation_duration.'s; 	animation-delay: '.$animation_delay.'s; 	-moz-animation-duration: '.$animation_duration.'s; 	-moz-animation-delay: '.$animation_delay.'s; 	-webkit-animation-duration: '.$animation_duration.'s; 	-webkit-animation-delay: '.$animation_delay.'s;">';	
}
$output .= '<' . $font_container_data['values']['tag'] . ' class="' . esc_attr( $css_class ) . '" ' . $design_css . '>';
$output .= '<span>'.$icon.$text.'</span>';
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= $divide_line;
if( $animation == '1' ){
	$output .= '</div>';	
}
$output .= '</div>';

echo  $output;