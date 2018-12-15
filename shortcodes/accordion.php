<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 16.01.2016
 * Time: 16:12
 */

add_shortcode('rentit_accordion', 'rentit_accordion_function');
function rentit_accordion_function($atts, $content)
{

    $content = !empty($content) ? $content : "";
    $atts = shortcode_atts(
        array(
            'title' => '',
            'desc' => '',
            'class' => 'col-md-6'
        ), $atts
    );
    ob_start();


    ?>
    <div class=" <?php  echo esc_attr($atts['class']); ?> wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
        <div class="panel-group accordion" role="tablist" aria-multiselectable="true">

            <?php echo(do_shortcode($content)); ?>

        </div>

    </div>


    <?php
    return ob_get_clean();
}

add_shortcode('rentit_accordion_section', 'rentit_accordion_section_function');
function rentit_accordion_section_function($atts, $content)
{
    $content = !empty($content) ? $content : "";
    $atts = shortcode_atts(
        array(
            'title' => '',
        ), $atts
    );
    ob_start();
    STATIC $rentit_acirdion_section = 100;

    ?>

    <!-- faq -->
    <!-- /faq-->


    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading2<?php echo (int)$rentit_acirdion_section; ?>">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion2"
                   href="#collapse2<?php echo (int)$rentit_acirdion_section; ?>" aria-expanded="false"
                   aria-controls="collapse2<?php echo (int)$rentit_acirdion_section; ?>">
                    <span class="dot"></span> <?php echo wp_kses_post($atts['title']); ?>
                </a>
            </h4>
        </div>
        <div id="collapse2<?php echo (int)$rentit_acirdion_section; ?>" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading2<?php echo (int)$rentit_acirdion_section; ?>">
            <div class="panel-body">
                <?php echo wp_kses_post(($content)); ?>
            </div>
        </div>
    </div>

    <?php
    $rentit_acirdion_section++;
    return ob_get_clean();
}