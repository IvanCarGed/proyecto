<?php
/**
 * Add Shortcode Column to Widget Area Post Type Table
 *
 * @copyright   Copyright (c) 2017, Jeffrey Carandang
 * @since       1.0
 */

 if( !function_exists( 'widgetopts_areas_shortcode_column_head' ) ):
      add_filter( 'manage_widget_area_posts_columns', 'widgetopts_areas_shortcode_column_head', 10 );
     function widgetopts_areas_shortcode_column_head( $defaults ){
          $date = $defaults['date'];
          unset( $defaults['date'] );
          $defaults['widgetopts_shortcode'] = __( 'Shortcode', 'widget-areas' );
          $defaults['date'] = $date;
          return $defaults;
     }
 endif;
 if( !function_exists( 'widgetopts_areas_shortcode_column_contents' ) ):
      add_filter( 'manage_widget_area_posts_custom_column', 'widgetopts_areas_shortcode_column_contents', 10, 2 );
     function widgetopts_areas_shortcode_column_contents( $column_name, $post_ID ){ ?>
          <input type="text" size="30" value='[display_widget_area id="<?php echo $post_ID;?>"]' onfocus="this.select();" onmouseup="return false;" readonly  />
     <?php }
 endif;
?>
