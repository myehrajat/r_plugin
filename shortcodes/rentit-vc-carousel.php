<?php
/**
 * Carousel Element
 * @package Rent It
 * @since Rent It 1.0
 */

/* Image Carousel
---------------------------------------------------------- */
if (function_exists('vc_map')):



    VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_Vc_Carousel');

    class WPBakeryShortCode_rentit_vc_carousel extends WPBakeryShortCode_Vc_Carousel
    {

        /**
         * Load specific template
         * @package Rent It
         * @since Rent It 1.0
         */


        public function getFileName()
        {
            return 'rentit_vc_carousel_template';
        }

        protected function content($atts, $content = null)
        {

            global  $Rent_IT_class;
            ob_start();

            /**
             * Carousel Template
             * @package Rent It
             * @since Rent It 1.0
             */

            $atts = vc_map_get_attributes($this->getShortcode(), $atts);
            extract($atts);


            $images = $atts['images'];
            $images = explode(',', $images);

            $css = '';
            /*if (isset($atts['item_padding']) && !empty($atts['item_padding']) || $atts['item_padding'] != '') {
                $css = 'padding_' . $atts['item_padding'];
            }*/

            $css_setting = (isset($atts['css'])) ? $atts['css'] : '';

            $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css_setting, ' '), $this->settings['base'], $atts);


            if (count($images) > 0) {

                $html = '<div class="partners-carousel ' . esc_attr($css_class) . '">';
                $html .= '<div class="owl-carousel carousel-' . esc_attr($atts["class"]) . ' " id="partners">';

                $size = (!empty($atts['size'])) ? $atts['size'] : 'fullsize';

                foreach ($images as $image) {
                    $img = wp_get_attachment_image_src($image, 'full');
                    $html .= '<img src="' .      $Rent_IT_class->trim_img_by_url($img[0], 170, 90) . '"/>';
                }

                $html .= '</div>';
                $html .= '</div>';

            }


// JS carousel init starts
            $js = '<script type="text/javascript">
        jQuery(document).ready(function($) {

          jQuery(".carousel-' . esc_attr($atts["class"]) . '").owlCarousel({
            items: ' . $atts["item"] . ',
            dots: false,
            nav: true,
            navText: [
                "<i class=\'fa fa-angle-left\'></i>",
                "<i class=\'fa fa-angle-right\'></i>"
            ]
          });

        });
    </script>';
// JS carousel init ends

            $html .= $js;




            return ob_get_clean() . $html;
        }

    }


endif;

