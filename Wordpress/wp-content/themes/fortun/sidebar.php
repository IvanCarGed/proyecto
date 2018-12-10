<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

if ( ! is_active_sidebar( 'fortun-sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area sidebar" role="complementary">
	<?php dynamic_sidebar( 'fortun-sidebar-1' ); ?>
</div><!-- #secondary -->
