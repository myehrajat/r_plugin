<?php

/**
 * Iconic Box
 * @package Rent It
 * @since Rent It 1.0
 */
class WPBakeryShortCode_rentit_vc_button extends WPBakeryShortCode
{


    /**
     * Load specific template
     * @package Rent It
     * @since Rent It 1.0
     */

    public function getFileName()
    {


    }


    /**
     * Load content
     * Output HTML
     * @package Rent It
     * @since Rent It 1.0
     */

    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes($this->getShortcode(), $atts);
        extract($atts);

        $class = (!empty($atts['unique_class'])) ? 'btn-' . $atts['unique_class'] : '';
        $style = $atts['button_style'];

        $size = '';
        switch ($atts['size']) {
            case 'default':
                $size = '';
                break;
            case 'large':
                $size = 'btn-theme-lg';
                break;
            case 'small':
                $size = 'btn-theme-sm';
                break;
            case 'extrasmall':
                $size = 'btn-theme-xs';
                break;
        }

        ob_start();

        ?>


        <style media="all">
            .rentit-vc-btn<?php echo '.'.$class; ?>.btn {
                color: <?php echo wp_kses_post($atts['text_color']); ?>;
                background-color: <?php echo  esc_html($atts['normal_color']); ?>;
                border: 2px solid <?php echo  esc_html($atts['normal_color']); ?>;
            }

            .rentit-vc-btn<?php echo '.'.$class; ?>.btn:hover {
                color: <?php echo  esc_html($atts['hover_text_color']); ?>;
                background-color: <?php echo  esc_html($atts['hover_color']); ?>;
                border: 2px solid <?php echo  esc_html($atts['hover_color']); ?>;
            }

            .rentit-vc-btn<?php echo '.'.$class; ?>.btn.bordered {
                color: <?php echo  esc_html($atts['text_color']); ?>;
                background-color: <?php echo  esc_html($atts['normal_color']); ?>;
                border: 2px solid <?php echo  esc_html($atts['border_color']); ?>;
            }

            .rentit-vc-btn<?php echo '.'.$class; ?>.btn.bordered:hover {
                color: <?php echo  esc_html($atts['hover_text_color']); ?>;
                background-color: <?php echo  esc_html($atts['hover_color']); ?>;
                border: 2px solid <?php echo  esc_html($atts['hover_border_color']); ?>;
            }

        </style>


        <?php

        $link = vc_build_link($atts['url']);

        ?>

        <a href="<?php echo esc_attr($link['url']); ?>" target="<?php echo esc_attr($link['target']) ?>"
           class="rentit-vc-btn btn btn-theme <?php echo esc_attr($size); ?>  <?php echo esc_attr($class . ' ' . $style); ?>"><?php echo esc_attr($link['title']) ?></a>

        <?php


        return ob_get_clean();
    }


}


vc_map(array(
    'name' => esc_html__('Rent It Button', 'rentit'),
    'base' => 'rentit_vc_button',
    'category' => esc_html__('Rent It', 'rentit'),
    "icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
    'js_view' => 'RentitVcButtonView',
    'custom_markup' => '{{title}}<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-color-grey">{{{ params.url }}}</button></div>',
    'params' => array(
        array(
            'type' => 'vc_link',
            'holder' => 'div',
            'heading' => esc_html__('Link', 'rentit'),
            'param_name' => 'url',
        ),
        array(
            'type' => 'el_id',
            'holder' => 'div',
            'heading' => esc_html__('Unique Class', 'rentit'),
            'param_name' => 'unique_class',
            'settings' => array(
                'auto_generate' => true,
            ),
            'description' => esc_html__('Enter unique class.', 'rentit')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Size', 'rentit'),
            'value' => array(
                esc_html__('Default', 'rentit') => 'default',
                esc_html__('Large', 'rentit') => 'large',
                esc_html__('Small', 'rentit') => 'small',
                esc_html__('Extra Small', 'rentit') => 'extrasmall',
            ),
            'admin_label' => true,
            'param_name' => 'size'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Text Color', 'rentit'),
            'param_name' => 'text_color'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Hover Text Color', 'rentit'),
            'param_name' => 'hover_text_color'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Normal Background Color', 'rentit'),
            'param_name' => 'normal_color'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Hover Background Color', 'rentit'),
            'param_name' => 'hover_color'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style', 'rentit'),
            'value' => array(
                esc_html__('Solid', 'rentit') => 'solid',
                esc_html__('Bordered', 'rentit') => 'bordered',
            ),
            'param_name' => 'button_style'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Border Color', 'rentit'),
            'param_name' => 'border_color',
            'dependency' => array(
                'element' => 'button_style',
                'value' => array('bordered')
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Hover Border Color', 'rentit'),
            'param_name' => 'hover_border_color',
            'dependency' => array(
                'element' => 'button_style',
                'value' => array('bordered')
            ),
        ),
    ),
));
