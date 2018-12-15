<?php

/**
 * VC Element: Team
 * @package Rent It
 * @since Rent It 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'rentit_VC_Team' ) ) :

    class rentit_VC_Team {

        public $settings;

        public function __construct() {

            add_shortcode( 'rentit_team', array($this, 'rentit_vc_elem_team') );
            add_action( 'vc_before_init', array($this, 'rentit_vc_elem_team_map') );
        }

        /**
         * Define shortcode
         * @package Rent It
         * @since Rent It 1.0
         */

        public function rentit_vc_elem_team( $atts ) {

            $default = array(
                'class'  => '',
                'name' => '',
                'avatar' => '',
                'position' => '',
                'socials' => '',
                'bio'     => '',
                'email' => '',
                'other_contacts' => ''
            );

            extract( shortcode_atts( $default, $atts ) );
            global  $Rent_IT_class;


            $photo = wp_get_attachment_image_src( $avatar, apply_filters('rentit-team-photo-size', 'full') );
            $photo = '<img src="'. esc_attr($Rent_IT_class->trim_img_by_url($photo[0], 270, 270)).'" alt="'.esc_attr($name).'" />';
            $social_icons = vc_param_group_parse_atts($socials);
            $other_contacts = isset($atts['other_contacts']) ? vc_param_group_parse_atts($atts['other_contacts']) : '';
            $css = (isset($atts['css'])) ? $atts['css'] : '';
            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

            ob_start(); ?>

            <div class="rentit-team thumbnail thumbnail-team no-border no-padding <?php echo esc_attr($class . ' ' .$css_class); ?>">

                <div class="media">
                    <?php echo wp_kses_post($photo); ?>
                </div>

                <div class="caption">

                    <h4 class="caption-title">
                        <?php echo wp_kses_post($name); ?>
                        <small><?php echo wp_kses_post($position); ?></small>
                    </h4>

                    <?php

                    if(count($social_icons) > 0){
                        echo '<ul class="social-icons">';
                        foreach ($social_icons as $icon) {

                            if(!isset($icon['url'])) continue;
                            $link = vc_build_link($icon['url']);

                            if( !empty($icon['url']) ):

                                $html = '<li>';
                                $html .= '<a  target="_blank" href="'.esc_url($link['url']).'" title="'.esc_attr($link['title']).'" target="'.$link['target'].'">';
                                $html .= '<i  class="fa '.esc_attr($icon['icon']).'"></i>';
                                $html .= '</a>';
                                $html .= '</li>';

                            endif;

                            echo  wp_kses_post($html);

                        }
                        echo '</ul>';
                    }
                    ?>

                    <div class="caption-text">
                        <?php echo wp_kses_post($bio); ?>
                    </div>


                    <?php

                    if( count($other_contacts) > 0 || !empty($atts['email']) ){

                        $html = '<ul class="team-details">';

                        if( count($other_contacts) > 0 && is_array($other_contacts) ):
                            foreach ($other_contacts as $contact) {

                                if( !empty($contact['contact_label']) && !empty($contact['contact_address']) ){
                                    $html .= '<li>'.$contact['contact_label'].': '.$contact['contact_address'].'</li>';
                                }

                            }
                        endif;

                        if(isset($atts['email'])){
                            $html .= '<li><a href="mailto:'.esc_attr($atts['email']).'" target="_blank">'.esc_attr($atts['email']).'</a></li>';
                        }
                        $html .= '</ul>';

                        echo wp_kses_post($html);

                    }

                    ?>

                </div>

            </div><!-- /.rentit-team -->

            <?php
            return ob_get_clean();


        }



        /**
         * Shortcode MAP
         * @package Rent It
         * @since Rent It 1.0
         */

        public function rentit_vc_elem_team_map() {

            $js = array();
            $css = array();

            $params = array(
                array(
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class'   => '',
                    'heading' => esc_html__('Avatar', 'rentit'),
                    'param_name'  => 'avatar'
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Name', 'rentit' ),
                    'param_name' => 'name',
                    'value' => esc_html__( '', 'rentit' ),
                    'description' => esc_html__( 'Team member name.', 'rentit' )
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Position', 'rentit' ),
                    'param_name' => 'position',
                ),
                array(
                    'type'  => 'param_group',
                    'holder'  => 'div',
                    'heading'  => esc_html__('Socials', 'rentit'),
                    'param_name' => 'socials',
                    'params'  => array(
                        array(
                            'type'  => 'textfield',
                            'holder'  => 'div',
                            'heading'  => esc_html__('Icon', 'rentit'),
                            'param_name' => 'icon',
                            'description' => esc_html__('Put a Font Awesome https://fortawesome.github.io/Font-Awesome/cheatsheet/ icon class name. Example: fa-home', 'rentit')
                        ),
                        array(
                            'type' => 'vc_link',
                            'holder' => 'div',
                            'heading' => esc_html__( 'URL', 'rentit' ),
                            'param_name' => 'url',
                        ),
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Email', 'rentit' ),
                    'param_name' => 'email',
                    'value' => esc_html__( '', 'rentit' )
                ),
                array(
                    'type'  => 'param_group',
                    'holder'  => 'div',
                    'heading'  => esc_html__('Other Contact Details', 'rentit'),
                    'param_name' => 'other_contacts',
                    'params'  => array(
                        array(
                            'type'  => 'textfield',
                            'holder'  => 'div',
                            'heading'  => esc_html__('Label', 'rentit'),
                            'param_name' => 'contact_label',
                            'description' => esc_html__('Label for contact. E.g. Skype', 'rentit')
                        ),
                        array(
                            'type'  => 'textfield',
                            'holder'  => 'div',
                            'heading'  => esc_html__('Address', 'rentit'),
                            'param_name' => 'contact_address',
                            'description' => esc_html__('Contact address.', 'rentit')
                        ),
                    ),
                ),

                array(
                    'type' => 'textarea',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Bio', 'rentit' ),
                    'param_name' => 'bio',
                ),
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => esc_html__( 'Class', 'rentit' ),
                    'param_name' => 'class',
                    'value' => esc_html__( '', 'rentit' ),
                    'description' => esc_html__( 'CSS class.', 'rentit' )
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__( 'Css', 'rentit' ),
                    'param_name' => 'css',
                    'group' => esc_html__( 'Design options', 'rentit' ),
                )
            );

            vc_map( array(
                'name' => esc_html__( 'Rent It Team', 'rentit' ),
                'base' => 'rentit_team',
                'class' => '',
                "icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
                "category" => esc_html__("Rent It", 'rentit'),
                'js_view' => 'RentitVcTeamView',

                'custom_markup' => '{{title}}<div class="vc_btn3-container"><h4 class="team-name"></h4></div>',
                'params' => $params
            ) );

        }



    }

endif;

return new rentit_VC_Team();
