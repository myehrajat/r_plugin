<?php

add_shortcode('rentit_flipInY', 'rentit_flipInY_function');
function rentit_flipInY_function($atts, $content)
{
    $content = !empty($content) ? $content : "";
    $atts = shortcode_atts(
        array(
            'h' => '',
            'icon' => 'fa-support',
            't_b' => esc_html__('Read More', 'rentit'),
            'url' => '#'
        ), $atts
    );
    extract($atts);
    if (strlen($atts['t_b']) < 2) {
        $atts['t_b'] = esc_html__('Read More', 'rentit');
    }
    ob_start();


    ?>

    <div class="col-md-4 wow flipInY" data-wow-offset="70" data-wow-duration="1s">
        <div class="thumbnail thumbnail-featured no-border no-padding">
            <div class="media">
                <a class="media-link" href="<?php echo esc_url($atts['url']) ?>">
                    <div class="caption">
                        <div class="caption-wrapper div-table">
                            <div class="caption-inner div-cell">
                                <div class="caption-icon"><i
                                        class="fa <?php echo wp_kses_post($atts['icon']); ?>"></i></div>
                                <h4 class="caption-title"><?php echo esc_attr($atts['h']); ?></h4>

                                <div class="caption-text">
                                    <?php echo wp_kses_post($content); ?>
                                </div>

                                <div class="buttons">
                                    <span
                                        <?php if ($atts['url'] !== '#') { ?>
                                            onclick="window.location.href ='<?php echo esc_url($atts['url']) ?>'"
                                        <?php } ?>
                                        class="btn btn-theme ripple-effect btn-theme-transparent">
                                        <!--a href="<?php echo esc_url($atts['url']) ?>"-->
                                        <?php echo esc_attr($atts['t_b']); ?>
                                        <!--/a-->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="caption hovered"       <?php if ($atts['url'] !== '#') { ?>
                        onclick="window.location.href ='<?php echo esc_url($atts['url']) ?>'"
                    <?php } ?>>
                        <div class="caption-wrapper div-table">
                            <div class="caption-inner div-cell">
                                <div class="caption-icon"><i class="fa  <?php echo wp_kses_post($atts['icon']); ?>"></i>
                                </div>
                                <h4 class="caption-title"><?php echo esc_attr($atts['h']); ?></h4>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
