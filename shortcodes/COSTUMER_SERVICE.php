<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 18.01.2016
 * Time: 9:31
 */

add_shortcode('rentit_COSTUMER_SERVICE_block', 'rentit_COSTUMER_SERVICE_block_function');
function rentit_COSTUMER_SERVICE_block_function($atts, $content = '')
{
    $atts = shortcode_atts(
        array(
            'img_src' => '' // get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg',
        ), $atts
    );
    if(strlen($atts['img_src']) < 1) {
        $atts['img_src'] = get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg';
    } else {
        $img =  wp_get_attachment_image_src($atts['img_src'],'medium');
        $atts['img_src'] =$img[0];
    }
    ob_start();
    ?>

    <!-- Team 1 -->
    <div class="col-md-3 col-sm-6 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
        <div class="thumbnail thumbnail-team no-border no-padding">
            <div class="media">
                <img
                    src="<?php  echo esc_url($atts['img_src']); ?>"
                    alt=""/>
            </div>
            <div class="caption">
                <?php  echo wp_kses_post($content); ?>

            </div>
        </div>
    </div>
    <!-- /Team 1 -->
    <?php
    return ob_get_clean();

} ?>
