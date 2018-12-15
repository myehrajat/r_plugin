<?php

/**
 * VC Element: Accordion
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'rentit_VC_Simple_Message_Box' ) ) :

    class rentit_VC_Simple_Message_Box {

        public $settings ;
        public function __construct() {

            add_shortcode( 'rentit_simple_message_box', array($this, 'rentit_vc_elem_simple_message_box') );
            add_action( 'vc_before_init', array($this, 'rentit_vc_elem_simple_message_box_map') );
        }

        /**
         * Define shortcode
         * @package Rent It
         * @since Rent It 1.0
         */

        public function rentit_vc_elem_simple_message_box( $atts ) {

            $default = array(
                'class'  => '',
                'message' => '',
                'button_label' => '',
                'button_url' => '',
                'bg_color' => ''
            );

            extract( shortcode_atts( $default, $atts ) );

            $css = '';
            if(!empty($bg_color)){
                $css = 'style="background-color: '.$bg_color.'"';
            }

            $container_class = '';
            $inner_class = '';

            if( !empty($button_label) ){
                $container_class = 'alt';
                $inner_class = '';
            }

            $url = vc_build_link($button_url);

            $css = (isset($atts['css'])) ? $atts['css'] : '';

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), @@$this->settings['base'], $atts );


            ob_start(); ?>

            <div class="message-box <?php echo esc_attr($container_class) . ' '. esc_attr($css_class); ?>" <?php echo esc_attr($css); ?>>

                <div class="message-box-inner <?php echo esc_attr($inner_class); ?>">
                    <a class="btn btn-theme btn-theme-sm pull-right" title="<?php echo esc_attr($url['title']) ?>"
                       href="<?php echo esc_attr($url['url']) ?>">
                        <?php echo wp_kses_post($button_label); ?>
                    </a>

                    <h2><?php echo wp_kses_post($message); ?></h2>


                </div>

            </div>

            <?php
            return ob_get_clean();


        }



        /**
         * Shortcode MAP
         * @package Rent It
         * @since Rent It 1.0
         */

        public function rentit_vc_elem_simple_message_box_map() {

            $js = array();
            $css = array();

            $params = array(
                array(
                    'type' => 'textarea',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Message Content', 'rentit' ),
                    'param_name' => 'message',
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => esc_html__( 'Background Color', 'rentit' ),
                    'param_name' => 'bg_color'
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Button Label', 'rentit' ),
                    'param_name' => 'button_label',
                    'value' => esc_html__( '', 'rentit' )
                ),
                array(
                    'type' => 'vc_link',
                    'holder' => 'div',
                    'heading' => esc_html__( 'Button URL', 'rentit' ),
                    'param_name' => 'button_url',
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'rentit' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'rentit' ),
                )
            );

            vc_map( array(
                'name' => esc_html__( 'Rent It Simple Message Box', 'rentit' ),
                'base' => 'rentit_simple_message_box',
                'class' => '',
                "icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
                "category" => esc_html__("Rent It", 'rentit'),
                'params' => $params
            ) );

        }



    }

endif;

return new rentit_VC_Simple_Message_Box();
