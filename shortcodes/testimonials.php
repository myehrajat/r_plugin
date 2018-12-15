<?php
/**
 * testimonials
 */

add_shortcode('rentit_testimonials', 'rentit_testimonials_function');
function rentit_testimonials_function($atts, $content)
{
    ob_start();
    global $Rent_IT_class;
    $atts = shortcode_atts(
        array(
            'numbers' => 3,
            'items' => '',
        ), $atts
    );
    extract($atts);
    $items_v = array();
    if (function_exists('vc_param_group_parse_atts')) {
        $items_v = vc_param_group_parse_atts($items);
    }


    ?>
    <!-- PAGE -->

    <section class="page-section testimonials">
        <div class="container wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">
            <div class="testimonials-carousel">
                <div class="owl-carousel" id="testimonials">

                    <?php
                    if (count($items_v) > 0) {
                        foreach ($items_v as $item) {

                            ?>
                            <div class="testimonial">
                                <div class="media">  <?php if (!empty($item['img_src'])): ?>
                                    <div class="media-left">

                                            <a href="#">

                                                <img class="media-object testimonial-avatar"
                                                     src="<?php
                                                     $img = wp_get_attachment_image_src($item['img_src']);
                                                     echo esc_url($Rent_IT_class->trim_img_by_url(
                                                         $img[0], 140, 140)); ?>"
                                                     alt="<?php    if(isset($item['title'])) echo wp_kses_post($item['title']); ?>">
                                            </a>

                                    </div>  <?php endif; ?>
                                    <div class="media-body">
                                        <div class="testimonial-text">

                                            <?php
                                            if(isset($item['des']))  echo wp_kses_post($item['des']); ?>
                                        </div>
                                        <div
                                            class="testimonial-name"><?php if(isset($item['title'])) echo wp_kses_post($item['title']); ?>
                                            <span
                                                class="testimonial-position">

                                                    <?php
                                                    if (isset($item['position']{0}))
                                                        echo wp_kses_post($item['position']);
                                                    ?>

                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php


                        }

                    }
                    ?>


                </div>
            </div>
        </div>
    </section>
    <!-- /PAGE -->
    <?php

    return ob_get_clean();

}

?>
