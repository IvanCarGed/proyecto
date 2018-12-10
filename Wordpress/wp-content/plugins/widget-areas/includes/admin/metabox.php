<?php
/**
 * Create metaboxes for Widget Areas post types
 * @since   1.0
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

//Register Widget Info Metabox
if( !function_exists( 'widgetopts_areas_widget_info' ) ):
    function widgetopts_areas_widget_info() {
        //remove unnecessary metabox first
        remove_meta_box( 'slugdiv', 'widget_area', 'normal' );

        add_meta_box( 'widgetopts-areas-info', esc_html__( 'Sidebar Definitions', 'widget-areas' ), 'widgetopts_areas_widget_info_callback', 'widget_area', 'advanced', 'high' );
        if( is_plugin_active( 'extended-widget-options/plugin.php' ) ){
            add_meta_box( 'widgetopts-areas-shortcode', esc_html__( 'Shortcode', 'widget-areas' ), 'widgetopts_areas_widget_shortcode_callback', 'widget_area', 'advanced', 'high' );
        }

        add_meta_box( 'widgetopts-areas-code', esc_html__( 'PHP Code', 'widget-areas' ), 'widgetopts_areas_widget_code_callback', 'widget_area', 'advanced', 'high' );
        add_meta_box( 'widgetopts-areas-display', esc_html__( 'Display', 'widget-areas' ), 'widgetopts_areas_widget_display_callback', 'widget_area', 'side', 'core' );
        add_meta_box( 'widgetopts-areas-visibility', esc_html__( 'Post Type Visibility', 'widget-areas' ), 'widgetopts_areas_widget_visibility_callback', 'widget_area', 'side', 'core' );

        if( !defined( 'WIDGETOPTS_PLUGIN_NAME' ) ){
            add_meta_box( 'widgetopts-areas-upsell', esc_html__( 'Widget Options', 'widget-areas' ), 'widgetopts_areas_widget_upsell_callback', 'widget_area', 'side', 'core' );
        }
    }
    add_action( 'add_meta_boxes', 'widgetopts_areas_widget_info');
endif;

//Add Sidebar Definitions Metabox Fields
if( !function_exists( 'widgetopts_areas_widget_info_callback' ) ):
    function widgetopts_areas_widget_info_callback( $post  ){
        $meta = get_post_meta( $post->ID );
        $before_widget = ( isset( $meta['_widgetopts-areas-before'] ) ) ? $meta['_widgetopts-areas-before'][0] : '';
        $before_title = ( isset( $meta['_widgetopts-areas-before_title'] ) ) ? $meta['_widgetopts-areas-before_title'][0] : '';

        wp_nonce_field( 'widgetopts_areas-meta-metabox', 'widgetopts_areas-meta-nonce' );
        ?>
        <table class="form-table widgetopts-areas-metabox">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="widgetopts-areas-def-name"><?php _e( 'Name*', 'widget-areas' );?></label></th>
                    <td>
                        <input type="text" name="widgetopts_areas[name]" value="<?php echo ( isset( $meta['_widgetopts-areas-name'] ) ) ? $meta['_widgetopts-areas-name'][0] : ''; ?>" id="widgetopts-areas-def-name" class="widefat" placeholder="<?php _e( 'Add Widget Area Name', 'widget-areas' );?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="widgetopts-areas-def-desc"><?php _e( 'Description', 'widget-areas' );?></label></th>
                    <td>
                        <textarea name="widgetopts_areas[description]" id="widgetopts-areas-def-desc" class="widefat" placeholder="<?php _e( 'Add Sidebar Description', 'widget-areas' );?>" ><?php echo ( isset( $meta['_widgetopts-areas-description'] ) ) ? $meta['_widgetopts-areas-description'][0] : ''; ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="widgetopts-areas-def-class"><?php _e( 'Class', 'widget-areas' );?></label></th>
                    <td>
                        <input type="text" name="widgetopts_areas[class]" value="<?php echo ( isset( $meta['_widgetopts-areas-class'] ) ) ? $meta['_widgetopts-areas-class'][0] : ''; ?>" id="widgetopts-areas-def-class" class="widefat" placeholder="<?php _e( 'Add Custom CSS Classes', 'widget-areas' );?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="widgetopts-areas-def-before"><?php _e( 'Before/After Widget', 'widget-areas' );?></label></th>
                    <td>
                        <select name="widgetopts_areas[before]" id="widgetopts-areas-def-before" class="widefat">
                            <option value="li" <?php echo ( $before_widget == 'li' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'li', 'widget-areas' );?></option>
                            <option value="div" <?php echo ( $before_widget == 'div' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'div', 'widget-areas' );?></option>
                            <option value="span" <?php echo ( $before_widget == 'span' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'span', 'widget-areas' );?></option>
                            <option value="aside" <?php echo ( $before_widget == 'aside' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'aside', 'widget-areas' );?></option>
                            <option value="section" <?php echo ( $before_widget == 'section' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'section', 'widget-areas' );?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="widgetopts-areas-def-title_class"><?php _e( 'Title Class', 'widget-areas' );?></label></th>
                    <td>
                        <input type="text" name="widgetopts_areas[title_class]" value="<?php echo ( isset( $meta['_widgetopts-areas-title_class'] ) ) ? $meta['_widgetopts-areas-title_class'][0] : ''; ?>" id="widgetopts-areas-def-title_class" class="widefat" placeholder="<?php _e( 'Widget Title CSS Classes', 'widget-areas' );?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="widgetopts-areas-def-before_title"><?php _e( 'Before/After Widget Title', 'widget-areas' );?></label></th>
                    <td>
                        <select name="widgetopts_areas[before_title]" id="widgetopts-areas-def-before_title" class="widefat">
                            <option value="h1" <?php echo ( $before_title == 'h1' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'h1', 'widget-areas' );?></option>
                            <option value="h2" <?php echo ( $before_title == 'h2' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'h2', 'widget-areas' );?></option>
                            <option value="h3" <?php echo ( $before_title == 'h3' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'h3', 'widget-areas' );?></option>
                            <option value="h4" <?php echo ( $before_title == 'h4' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'h4', 'widget-areas' );?></option>
                            <option value="h5" <?php echo ( $before_title == 'h5' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'h5', 'widget-areas' );?></option>
                            <option value="h6" <?php echo ( $before_title == 'h6' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'h6', 'widget-areas' );?></option>
                            <option value="span" <?php echo ( $before_title == 'span' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'span', 'widget-areas' );?></option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <style type="text/css">
            body.post-type-widget_area #post-body #normal-sortables{
                min-height: 0px;
            }
            .widgetopts-areas-metabox small{
                opacity: 0.75;
            }
        </style>
    <?php }
endif;

if( !function_exists( 'widgetopts_areas_widget_code_callback' ) ):
    function widgetopts_areas_widget_code_callback( $post ){
        $class = get_post_meta( $post->ID, '_widgetopts-areas-class', true );
        ?>
        <p><?php _e( 'Copy the PHP code below and paste it on your template files to display the widget area. Thanks!', 'widget-areas' );?></p>
        <pre>&lt;?php if ( is_active_sidebar( 'widget-areas-<?php echo $post->ID; ?>' ) ) : ?>
	&lt;div id="widget-areas-<?php echo $post->ID; ?>" class="widget-areas <?php echo $class;?>">
	&lt;?php dynamic_sidebar( 'widget-areas-<?php echo $post->ID; ?>' ); ?>
	&lt;/div>
&lt;?php endif; ?></pre>
        <?php
    }
endif;

if( !function_exists( 'widgetopts_areas_widget_shortcode_callback' ) ):
    function widgetopts_areas_widget_shortcode_callback( $post ){ ?>
        <p><?php _e( 'Copy the shortcode below display the widget area. Thanks!', 'widget-areas' );?></p>
        <input type="text" class="widefat" value='[display_widget_area id="<?php echo $post->ID;?>"]' onfocus="this.select();" onmouseup="return false;" readonly  />
        <?php
    }
endif;

if( !function_exists( 'widgetopts_areas_widget_display_callback' ) ):
    function widgetopts_areas_widget_display_callback( $post ){
        $display = get_post_meta( $post->ID, '_widgetopts-areas-display', true );
        ?>
        <div class="widgetopts-areas-metabox">
            <p><small><?php _e( 'Select display position you want the widget areas to appear.', 'widget-areas' );?></small></p>
            <select name="widgetopts_areas[display]" class="widefat widgetopts_areas_display_opts">
                <option value="before_content" <?php echo ( $display == 'before_content' ) ? 'selected="selected"' : ''; ?> ><?php _e( 'Before Content', 'widget-areas' );?></option>
                <option value="after_content" <?php echo ( $display == 'after_content' ) ? 'selected="selected"' : ''; ?>><?php _e( 'After Content', 'widget-areas' );?></option>
                <option value="shortcode" <?php echo ( $display == 'shortcode' ) ? 'selected="selected"' : ''; ?>><?php _e( 'Manually using Shortcodes', 'widget-areas' );?></option>
                <option value="manual" <?php echo ( $display == 'manual' ) ? 'selected="selected"' : ''; ?>><?php _e( 'Manually using PHP code', 'widget-areas' );?></option>
            </select>
            <?php if( !is_plugin_active( 'extended-widget-options/plugin.php' ) ){ ?>
                <p class="widgetopts_areas_display_sc" style="<?php echo ( $display != 'shortcode' ) ? 'display: none;' : ''; ?>"><?php _e( 'Get <a href="https://widget-options.com/?utm_source=widget-areas&utm_medium=widget-areas-shortcode&utm_campaign=widget-areas-meta" target="_blank">Extended Widget Options for WordPress</a> to display any Widget Areas via shortcodes. Thanks!', 'widget-areas' );?></p>
            <?php } ?>
        </div>
        <style type="text/css">
            .widgetopts_areas_display_sc{
                padding: 7px;
                color: #31708f;
                background-color: #d9edf7;
                border: 1px solid #bce8f1;
                border-radius: 4px;
            }
            .widgetopts_areas_display_sc a{
                font-weight: bold;
                text-decoration: none;
                border-bottom: 1px dotted #31708f;
            }
            #widgetopts-areas-upsell.postbox{
                background: transparent;
                border: 0px;
                box-shadow: none;
            }
            #widgetopts-areas-upsell.postbox .hndle,
            #widgetopts-areas-upsell.postbox .handlediv{
                display: none;
            }
            #widgetopts-areas-upsell.postbox img{
                max-width: 100%;
            }
            #widgetopts-areas-upsell.postbox .inside{
                padding: 0px;
                margin: 0px;
            }
        </style>
        <?php if( !is_plugin_active( 'extended-widget-options/plugin.php' ) ){ ?>
            <script type='text/javascript'>
                jQuery( document ).ready( function(){
                    jQuery( '.widgetopts_areas_display_opts' ).on('change', '', function (e) {
                        var v = jQuery( this ).val();
                        if( 'shortcode' == v ){
                            jQuery( '.widgetopts_areas_display_sc' ).show();
                        }else{
                            jQuery( '.widgetopts_areas_display_sc' ).hide();
                        }
                    });
                } );
            </script>
        <?php } ?>
    <?php }
endif;

if( !function_exists( 'widgetopts_areas_widget_visibility_callback' ) ):
    function widgetopts_areas_widget_visibility_callback( $post ){
        $types  = get_post_types( array(
                                'public' => true,
                            ), 'object' );
        echo '<div class="widgetopts-areas-metabox">';
        echo '<p><small>'. __( 'Select which post types you want the widget areas to be displayed unless you will be displaying it manually.', 'widget-areas' ) .'</small></p>';
        if( !empty( $types ) ){
            foreach ( array( 'revision', 'attachment', 'nav_menu_item', 'widget_area' ) as $unset ) {
                unset( $types[ $unset ] );
            }

            foreach ( $types as $ptype => $type ) {
                $meta = get_post_meta( $post->ID, '_widgetopts-areas_types-' . $ptype, true );

                if( '1' == $meta ){
                    $checked = 'checked="checked"';
                }else{
                    $checked = '';
                }
                ?>
                <p>
                    <input type="checkbox" name="widgetopts_areas_types[<?php echo $ptype;?>]" id="widgetopts-areas-types-<?php echo $ptype;?>" value="1" <?php echo $checked;?> />
                    <label for="widgetopts-areas-types-<?php echo $ptype;?>"><?php echo stripslashes( $type->labels->name );?></label>
                </p>
                <?php
            }
        }
        echo '</div>';
    }
endif;

if( !function_exists( 'widgetopts_areas_widget_upsell_callback' ) ){
    function widgetopts_areas_widget_upsell_callback( $post ){
        echo '<a href="https://widget-options.com/?utm_source=widget-areas&utm_medium=widget-areas-metabox&utm_campaign=widget-areas-metabox" target="_blank"><img src="'. WIDGETOPTS_AREAS_PLUGIN_URL .'/assets/images/widget-options-free.jpg"></a>';
    }
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
if( !function_exists( 'widgetopts_areas_save_meta_box_data' ) ):
    add_action( 'save_post', 'widgetopts_areas_save_meta_box_data' );
    function widgetopts_areas_save_meta_box_data( $post_id ){
        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */


        // Check if our nonce is set.
        if ( ! isset( $_POST['widgetopts_areas-meta-nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['widgetopts_areas-meta-nonce'], 'widgetopts_areas-meta-metabox' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        /* OK, it's safe for us to save the data now. */

        // Make sure that it is set.
        if ( isset( $_POST['widgetopts_areas'] ) ) {
            $meta 	= $_POST['widgetopts_areas'];
            if( is_array( $meta ) && !empty( $meta ) ){
                foreach ( $meta  as $key => $value ) {
                    update_post_meta( $post_id, '_widgetopts-areas-' . $key, sanitize_text_field( $value ) );
                }
            }
        }

        $types  = get_post_types( array(
                                'public' => true,
                            ), 'object' );

        if ( isset( $_POST['widgetopts_areas_types'] ) ) {
            $meta_types 	= $_POST['widgetopts_areas_types'];
            $diff = array_diff_key( $types, $meta_types );

            if( is_array( $meta_types ) && !empty( $meta_types ) ){
                foreach ( $meta_types  as $k => $v ) {
                    update_post_meta( $post_id, '_widgetopts-areas_types-' . $k, sanitize_text_field( $v ) );
                }
            }
            if( !empty( $diff ) && is_array( $diff ) ){
                foreach ( $diff as $ky => $val ) {
                    delete_post_meta( $post_id, '_widgetopts-areas_types-' . $ky );
                }
            }
        }else{
            if( !empty( $types ) && is_array( $types ) ){
                foreach ( $types as $kk => $vvv ) {
                    delete_post_meta( $post_id, '_widgetopts-areas_types-' . $kk );
                }
            }
        }

        //remove cached option values
        delete_option( 'widgetopts_areas_before' );
        delete_option( 'widgetopts_areas_after' );

    }
endif;
