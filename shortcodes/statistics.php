<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 15.01.2016
 * Time: 21:21
 */

add_shortcode('rentit_statistics', 'rentit_statistics_function');
function rentit_statistics_function($atts, $content)
{


    ob_start();
    $atts = shortcode_atts(
        array(
            'h_s' => esc_html__("What a Kind of Car You Want", "rentit"),
            'h' => esc_html__('Great Rental Offers for You' ,"rentit"),
            'number_1' => 5657,
            'title_1' => esc_html__("Happy costumers", "rentit"),
            'number_2' => 657,
            'title_2' => esc_html__("Total car count", "rentit"),
            'number_3' =>  esc_html__("1.255.657", "rentit"),
            'title_3' => esc_html__("Total KM/MIL", "rentit"),
            'number_4' =>  esc_html__("1255", "rentit"),
            'title_4' => esc_html__("Call Center Solutions", "rentit"),
            'fa_1' => 'fa-heart',
            'fa_2' => 'fa-car',
            'fa_3' => 'fa-flag',
            'fa_4' => 'fa-comments-o',
        ), $atts
    );

    ?>
    <section class="page-section image">
        <div class="container">

            <div class="row">
                <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
                    <div class="thumbnail thumbnail-counto no-border no-padding">
                        <div class="caption">
                            <div class="caption-icon"><i class="fa <?php   echo esc_attr($atts['fa_1']); ?>"></i></div>
                            <div class="caption-number"><?php   echo wp_kses_post($atts['number_1']); ?></div>
                            <h4 class="caption-title"><?php   echo wp_kses_post($atts['title_1']); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                    <div class="thumbnail thumbnail-counto no-border no-padding">
                        <div class="caption">
                        <div class="caption-icon"><i class="fa  <?php  echo esc_attr($atts['fa_2']);  ?>"></i></div>
                            <div class="caption-number"><?php   echo wp_kses_post($atts['number_2']); ?></div>
                            <h4 class="caption-title"><?php   echo wp_kses_post($atts['title_2']); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                    <div class="thumbnail thumbnail-counto no-border no-padding">
                        <div class="caption">
                            <div class="caption-icon"><i class="fa <?php  echo esc_attr($atts['fa_3']);  ?> "></i></div>
                            <div class="caption-number"><?php   echo wp_kses_post($atts['number_3']); ?></div>
                            <h4 class="caption-title"><?php   echo wp_kses_post($atts['title_3']); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                    <div class="thumbnail thumbnail-counto no-border no-padding">
                        <div class="caption">
                            <div class="caption-icon"><i class="fa  <?php   echo esc_attr($atts['fa_4']);  ?>"></i></div>
                            <div class="caption-number"><?php   echo wp_kses_post($atts['number_4']); ?></div>
                            <h4 class="caption-title"><?php   echo wp_kses_post($atts['title_4']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php
    return ob_get_clean();
}


