<?php



class VCA_Responsive_Tabs {


    /**
     * Get things started
     */
    function __construct() {

        add_action('init', array($this, 'vca_tabs_parent'));
        add_action('init', array($this, 'vca_tab_child'));
        // add_action( 'wp_enqueue_scripts', array($this, 'loading_pricing_scripts') );
        add_shortcode('vca_tabs_parent', array($this, 'vca_tabs_parent_rendering'));
        add_shortcode('vca_tabs_child', array($this, 'vca_tabs_child_rendering'));
    }

    function vca_tabs_parent() {
        if (function_exists("vc_map")) {

            //Register "container" content element. It will hold all your inner (child) content elements
            vc_map(array(
                "name" => __("Responsive Tabs", "vca-tabs"),
                "base" => "vca_tabs_parent",
                "as_parent" => array('only' => 'vca_tabs_child'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                "content_element" => true,
                "show_settings_on_create" => true,
                "category" => 'by VCAddons',
                "is_container" => true,
                'description' => __('Insert Tab Parent', 'vca-tabs'),
                "js_view" => 'VcColumnView',
                "icon" => 'extended-custom-icon-wdo icon-wpb-advanced-tabs',
                'admin_enqueue_css' => array( plugins_url( '/admin/style.css' , __FILE__ ) ),
                "params" => array(
                    	array(
                            'type'          => 'dropdown',
                            'admin_label'   => true,
                            'heading'       => esc_html__('Tabs Style', 'vca-tabs'),
                            'param_name'    => 'vca_tabs_style',
                            'save_always'   => true,
                            'value' => array(
                                'Select Style' => '',
                                'Tab Design 1 - Top ' => 'tab-design-1',
                                'Tab Design 1 - Bottom  ' => 'tab-design-1-bottom',
                                'Tab Design 1 - Right  ' => 'tab-design-1-right',
                                'Tab Design 1 - Left  ' => 'tab-design-1-left',
                                'Tab Design 2 - Top  ' => 'tab-design-2',
                                'Tab Design 2 - Bottom  ' => 'tab-design-2-bottom',
                                'Tab Design 3 - Top  ' => 'tab-design-3',
                                'Tab Design 3 - Bottom  ' => 'tab-design-3-bottom',
                                'Tab Design 4 - Top  ' => 'tab-design-4',
                                'Tab Design 4 - Bottom  ' => 'tab-design-4-bottom',
                                'Tab Design 5 - Top  ' => 'tab-design-5',
                                'Tab Design 5 - Bottom  ' => 'tab-design-5-bottom',
                                'Tab Design 6 - Top  ' => 'tab-design-6',
                                'Tab Design 6 - Bottom  ' => 'tab-design-6-bottom',
                                'Tab Design 7 - Top  ' => 'tab-design-7',
                                'Tab Design 7 - Bottom  ' => 'tab-design-7-bottom',
                                'Tab Design 8 - Top  ' => 'tab-design-8',
                                'Tab Design 8 - Bottom  ' => 'tab-design-8-bottom',
                                // 'Tab Design 9(Circular) - Top  ' => 'tab-design-9',
                                // 'Tab Design 9(Circular) - Bottom  ' => 'tab-design-9-bottom',
                                // 'Tab Design 9(Circular) - Left  ' => 'tab-design-9-left',
                                // 'Tab Design 9(Circular) - Right  ' => 'tab-design-9-right',
                                // 'Tab Design 10(Feed) - left  ' => 'tab-design-10-left',
                            )
                        ),

                    	array(
                            'type'          => 'dropdown',
                            'admin_label'   => true,
                            'save_always'   => true,
                            'heading'       => esc_html__('Tab Icon Postion', 'vca-tabs'),
                            'param_name'    => 'vca_tabs_icon_position',
                            'value' => array(
                                 'Inline' => 'l-inline-list',
                                 'Block' => 'tab-marker-icon-block',
                                 'Only Icon' => 'tab-marker-icon-only',
                            ),
                            "description" => "Select how you want to display the icon in tabs.",
                        ),

                    	array(
                            'type'          => 'dropdown',
                            'admin_label'   => true,
                            'heading'       => esc_html__('Color Theme', 'vca-tabs'),
                            'param_name'    => 'vca_tabs_color_theme',
                            'value' => array(
                                'Select Color Scheme' => '',
                                'Theme 1' => 'theme-01',
                                'Theme 2' => 'theme-02',
                                'Theme 3' => 'theme-03',
                                'Theme 4' => 'theme-04',
                                'Theme 5' => 'theme-05',
                            )
                        ),

                        array(
                    		'type'			=> 'dropdown',
                    		'admin_label'	=> true,
                            'save_always'   => true,
                    		'heading'		=> esc_html__('Tabs Trigger', 'vca-tabs'),
                    		'param_name'	=> 'vca_tabs_trigger',
                    		'value' => array(
                                'Click' => '',
                                'Hover' => 'hover',
                    		)
                    	),
            	)
            ));


        }
    }

    function vca_tab_child() {
        $rand_id = rand(1000, 10000);
        if (function_exists("vc_map")) {

            vc_map(array(
                "name" => __("Tab", "vca-tabs"),
                "base" => "vca_tabs_child",
                "content_element" => true,
                "as_child" => array('only' => 'vca_tabs_parent'), // Use only|except attributes to limit parent (separate multiple values with comma)
                // "icon" => 'icon-wpb-pricing_column',
                'as_parent'			=> array(''),
                'js_view'					=> 'VcColumnView',
                'params' => array_merge(
					array(
                        array(
                            'type' => 'textfield',
                            "holder" => "div",
                            "value" => $rand_id,
                            'admin_label' => true,
                            'heading' => esc_html__('Tab ID', "vca-tabs"),
                            'param_name' => 'vca_tab_id',
                            "description" => "Give ID for the tab.You can also give custom unique ID",
                        ),
						array(
                            'type' => 'textfield',
                            "holder" => "div",
                            'admin_label' => true,
                            'heading' => esc_html__('Tab Title', "vca-tabs"),
                            'param_name' => 'vca_tab_title',
                            "description" => "Will be displayed as the name of tab.",
                        ),

                        array(
                            'type' => 'iconpicker',
                            'heading' => __( 'Icon', 'vca-tabs' ),
                            'param_name' => 'vca_tab_icon',
                            'settings' => array(
                               'emptyIcon' => false,
                               'type' => 'fontawesome',
                               'iconsPerPage' => 500, 
                            ),
                        ),
                        array(
                            'type'          => 'dropdown',
                            'admin_label'   => true,
                            'save_always'   => true,
                            'heading'       => esc_html__('Tabs Animation', 'vca-tabs'),
                            'param_name'    => 'vca_tabs_animation',
                            "description" => "It will be animation for the content present in tabs.",
                            'value' => array(
                                'Select Animation' => '',
                                'Bounce' => 'animation-bounce',
                                'Flash' => 'animation-flash',
                                'Pulse' => 'animation-pulse',
                                'Rubber Band' => 'animation-rubberBand',
                                'Shake' => 'animation-shake',
                                'Swing' => 'animation-swing',
                                'Tada' => 'animation-tada',
                                'Wobble' => 'animation-wobble',
                                'Jello' => 'animation-jello',
                                'Bounce In' => 'animation-bounceIn',
                            )
                        ),
					)
				)
            )); 


        }
    }

    function vca_tabs_parent_rendering($atts, $content = null, $tag) {
    	wp_enqueue_style( 'vca-tabs-bootstrap', plugins_url( '/assests/css/bootstrap.min.css' , __FILE__ ));
    	wp_enqueue_style( 'vca-tabs-css', plugins_url( '/assests/css/solid-tabs.css' , __FILE__ ));
        wp_enqueue_script( 'vca-bootstrap-js', plugins_url( '/assests/js/bootstrap.min.js', __FILE__ ),array('jquery'));
        wp_enqueue_script( 'vca-solidtabs-js', plugins_url( '/assests/js/solid-tabs.js', __FILE__ ),array('jquery','vca-bootstrap-js'));
        wp_enqueue_script( 'vca-custom-js', plugins_url( '/assests/js/script.js', __FILE__ ),array('jquery','vca-solidtabs-js'));

        $args = array(
        	'vca_tabs_style' => '',
            'vca_tabs_align' => '',
            'vca_tabs_icon_position' => '',
            'vca_tabs_color_theme' => '',
            'vca_tabs_trigger' => '',
        );

        $params  = shortcode_atts($args, $atts);

        extract($params);

        // Extract tab titles
        preg_match_all('/vca_tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
        $tab_titles = array();

        preg_match_all('/vca_tab_icon="([^\"]+)"/i', $content, $iconmatches, PREG_OFFSET_CAPTURE);
        $tab_icons = array();

        /**
         * get tab titles array
         *
         */
        if (isset($matches[0])) {
            $tab_titles = $matches[0];
        }
        if (isset($iconmatches[0])) {
        	$tab_icons = $iconmatches[0];
        }

        $tab_title_array = array();
        $tab_icons_array = array();

        foreach($tab_titles as $tab) {
            preg_match('/vca_tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
            $tab_title_array[] = $tab_matches[1][0];
        }
        foreach($tab_icons as $tab_icon) {
        	preg_match('/vca_tab_icon="([^\"]+)"/i', $tab_icon[0], $tab_icon_matches, PREG_OFFSET_CAPTURE);
        	$tab_icons_array[] = $tab_icon_matches[1][0];
        }

 
        $tabs_color_scheme = $params['vca_tabs_color_theme'];
        // echo '<pre>';var_dump($vca_tabs_color_theme);echo '</pre>';
        $color_scheme_path =  '/assests/themes/'.$tabs_color_scheme.'.css';

        wp_enqueue_style( 'vca-colorscheme-css', plugins_url( $color_scheme_path , __FILE__ )); 

        $include_path = 'includes/'.$vca_tabs_style.'.php';

        ob_start();

        ?> 
        
        <div class="solid-tabs <?php echo $vca_tabs_color_theme; ?>" id="solid-tabs"> 
            <?php include $include_path; ?>
        </div>
        <?php

        $output = ob_get_clean();

        return $output;
    }

    function vca_tabs_child_rendering($atts, $content = null, $tag) {
        extract(shortcode_atts(array(

        ), $atts));

        $default_atts = array(
        	'vca_tab_title' => 'Tab',
            'vca_tab_id' => '',
            'vca_tabs_animation' => '',
        	'vca_tab_icon' => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        extract($params);

        $rand_number = rand(0, 1000);
        $params['vca_tab_title'] = '-'.$rand_number;

        $params['content'] = $content;
        ?>
            <div id="tab-<?php echo $vca_tab_id; ?>" class="tab-pane <?php echo $vca_tabs_animation; ?>">
                <?php echo do_shortcode($content); ?>
            </div>

        <?php
    }

}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_vca_tabs_parent extends WPBakeryShortCodesContainer {
    }
}
if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_vca_tabs_child extends WPBakeryShortCodesContainer {
    }
}