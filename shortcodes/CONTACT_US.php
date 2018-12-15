<?php

add_shortcode('rentit_contact_us', 'rentit_contact_us_function');
function rentit_contact_us_function($atts, $content)
{
    $content = $content ? $content : "";

    $atts = shortcode_atts(
        array(
            'st' => esc_html__('Search for Cheap Rental Cars Wherever Your Are', 'rentit'),
            'h1' =>  esc_html__('Contact Us', 'rentit'),
            'h2' =>  esc_html__('Contact Form', 'rentit'),
        ), $atts
    );

    ob_start();
    ?>

    <div class="col-md-4">
        <div class="contact-info">

            <h2 class="block-title"><span><?php echo  esc_html($atts['h1']); ?></span></h2>

            <div class="media-list">
                <?php echo do_shortcode($content); ?>

            </div>

        </div>
    </div>

    <div class="col-md-8 text-left">

        <h2 class="block-title"><span><?php echo  esc_html($atts['h2']); ?></span></h2>

        <!-- Contact form -->
        <form name="contact-form" method="post" action="#" class="contact-form" id="contact-form">

            <div class="outer required">
                <div class="form-group af-inner">
                    <label class="sr-only" for="name"><?php  esc_html_e('Name','rentit'); ?></label>
                    <input
                        type="text" name="name" id="name" placeholder="<?php  esc_html_e('Name','rentit'); ?>" value="" size="30"
                        data-toggle="tooltip" title="<?php  esc_html_e('Name is required','rentit'); ?>"
                        class="form-control placeholder"/>
                </div>
            </div>

            <div class="outer required">
                <div class="form-group af-inner">
                    <label class="sr-only" for="email"><?php  esc_html_e('Email','rentit'); ?></label>
                    <input
                        type="text" name="email" id="email" placeholder="<?php  esc_html_e('Email','rentit'); ?>" value="" size="30"
                        data-toggle="tooltip" title="<?php  esc_html_e('Email is required','rentit'); ?>"
                        class="form-control placeholder"/>
                </div>
            </div>

            <div class="outer required">
                <div class="form-group af-inner">
                    <label class="sr-only" for="subject"><?php  esc_html_e('Subject','rentit'); ?></label>
                    <input
                        type="text" name="subject" id="subject" placeholder="<?php  esc_html_e('Subject','rentit'); ?>" value="" size="30"
                        data-toggle="tooltip" title="<?php  esc_html_e('Subject is required','rentit'); ?>"
                        class="form-control placeholder"/>
                </div>
            </div>

            <div class="form-group af-inner">
                <label class="sr-only" for="input-message"><?php  esc_html_e('Message','rentit'); ?></label>
                                <textarea
                                    name="message" id="input-message" placeholder="<?php  esc_html_e('Message','rentit'); ?>" rows="4" cols="50"
                                    data-toggle="tooltip" title="<?php  esc_html_e('Message is required','rentit'); ?>"
                                    class="form-control placeholder"></textarea>
            </div>

            <div class="outer required">
                <div class="form-group af-inner">
                    <input type="submit" name="submit"
                           class="form-button form-button-submit btn btn-theme btn-theme-dark" id="submit_btn"
                           value="<?php  esc_html_e('Send message','rentit'); ?>"/>
                </div>
            </div>

        </form>
        <!-- /Contact form -->

    </div>
    <!-- /PAGE -->
    <?php
    return ob_get_clean();
}


add_shortcode('rentit_contact_us_media', 'rentit_contact_us_media_function');
function rentit_contact_us_media_function($atts, $content)
{

    $content = $content ? $content : "";

    $atts = shortcode_atts(
        array(
            's_icon' => false,
            'icon' => null
        ), $atts
    );

    ob_start();
    ?>
    <div class="media">
        <?php if (isset($atts['icon']) && strlen($atts['icon']) > 2 && $atts['s_icon'] == true): ?>
            <i class="pull-left <?php  echo esc_attr($atts['icon']); ?>"></i>
        <?php endif; ?>
        <div class="media-body">
            <?php echo wp_kses_post($content); ?>
        </div>
    </div>

    <!-- /PAGE -->
    <?php
    return ob_get_clean();
}
