<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

if ( ! is_active_sidebar( 'fortun-sidebar-2' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area sidebar shop-sidebar" role="complementary">
	<?php dynamic_sidebar( 'fortun-sidebar-2' ); ?>
</div><!-- #secondary -->
