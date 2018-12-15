<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 18.01.2016
 * Time: 9:31
 */

add_shortcode('rentit_SUBSCRIBE_block', 'rentit_SUBSCRIBE_block_function');
function rentit_SUBSCRIBE_block_function($atts, $content = '')
{
    $atts = shortcode_atts(
        array(
            'b_t' => esc_html__("Subscribe", "rentit"),

        ), $atts
    );
    ob_start();
    ?>
    <div class="row wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
        <div class="col-md-8 col-md-offset-2">

            <p class="text-center">
                <?php  echo wp_kses_post($content); ?>
            </p>

            <!-- Subscribe form -->
            <form action="#" class="form-subscribe">
                <div class="form-group">
                    <label for="formSubscribeEmail" class="sr-only"><?php  esc_html_e('Enter your email here','rentit'); ?></label>
                    <input type="text" class="form-control" id="formSubscribeEmail"
                           placeholder="<?php  esc_html_e('Enter your email here','rentit'); ?>" title="<?php  esc_html_e('Email is required','rentit'); ?>">
                </div>
                <button type="submit" class="btn btn-submit btn-theme ripple-effect btn-theme-dark">
                    <?php  echo wp_kses_post($atts['b_t']) ?>
                </button>
            </form>
            <!-- Subscribe form -->

        </div>
    </div>

    <?php
    return ob_get_clean();

} ?>
