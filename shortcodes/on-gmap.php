<?php

add_shortcode('rentit_on_gmap', 'rentit_on_gmap_function');
function rentit_on_gmap_function($atts, $content)
{

    $rentit_categories = get_categories("taxonomy=product_cat&hide_empty=0");
    $places_categories = array();

    foreach ($rentit_categories as $rentit_place_cat) {
        $rentit_init_maps_point_by_term_slug = rentit_init_maps_point_by_term_slug($rentit_place_cat->term_id);
        if (!$rentit_init_maps_point_by_term_slug) continue;

        $places_categories[] = "'" . esc_html($rentit_place_cat->slug) . "': [" . print_r($rentit_init_maps_point_by_term_slug, true) . "]";
    }


    $atts = shortcode_atts(
        array(

            'st' => esc_html__('Search for Cheap Rental Cars Wherever Your Are', 'rentit'),
            'img_src' => '',
            'tb' => esc_html__(' Find Car', 'rentit'),
        ), $atts
    );

    ob_start();
    ?>
    <section class="page-section no-padding no-bottom-space-off">
        <div class="container full-width gmap-background">
            <div class="container">
                <div class="on-gmap">
                    <!-- Search form -->
                    <div class="form-search light">
                        <form action="<?php echo @esc_url(get_permalink(wc_get_page_id(('shop')))); ?>">
                            <div class="form-title">
                                <i class="fa fa-globe"></i>

                                <h2><?php echo wp_kses_post($atts['st']); ?></h2>
                            </div>

                            <div class="row row-inputs">
                                <div class="container-fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label
                                                for="formSearchUpLocation2">     <?php esc_html_e('Picking Up Location', 'rentit'); ?></label>
                                            <input name="dropin" type="text" class="form-control formSearchUpLocation"
                                                   id="formSearchUpLocation2"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropin_location');
                                                   ?>"
                                                   placeholder="<?php esc_html_e('Airport or Anywhere','rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-location-arrow"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label
                                                for="formSearchOffLocation2">   <?php esc_html_e('Dropping Off Location', 'rentit'); ?></label>
                                            <input name="dropoff" type="text" class="form-control formSearchUpLocation"
                                                   id="formSearchOffLocation2"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropoff_location');
                                                   ?>"
                                                   placeholder="<?php esc_html_e('Airport or Anywhere','rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-location-arrow"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-inputs">
                                <div class="container-fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label
                                                for="formSearchUpDate2">    <?php esc_html_e(' Picking Up Date', 'rentit'); ?></label>
                                            <input name="start_date" type="text" class="form-control"
                                                   id="formSearchUpDate2"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropin_date');
                                                   ?>"
                                                   placeholder="<?php  esc_html_e('dd/mm/yyyy','rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row row-inputs">
                                <div class="container-fluid">
                                    <div class="col-sm-12">
                                        <div class="form-group has-icon has-label">
                                            <label for="formSearchOffDate2">
                                                <?php esc_html_e('Dropping Off Date', 'rentit'); ?></label>
                                            <input name="end_date" type="text" class="form-control"
                                                   id="formSearchOffDate2"
                                                   value="<?php
                                                   if (function_exists('rentit_get_date_s'))
                                                       rentit_get_date_s('dropoff_date');
                                                   ?>"
                                                   placeholder="<?php  esc_html_e('dd/mm/yyyy','rentit'); ?>">
                                                                    <span class="form-control-icon"><i
                                                                            class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row row-submit">
                                <div class="container-fluid">
                                    <div class="inner">
                                        <i class="fa fa-plus-circle"></i> <a
                                            href="<?php echo esc_url(get_permalink(wc_get_page_id(('shop')))); ?>">
                                            <?php esc_html_e(' Advanced Search', 'rentit'); ?>
                                        </a>
                                        <button type="submit" id="formSearchSubmit2"
                                                class="btn btn-submit btn-theme ripple-effect pull-right">
                                            <?php echo wp_kses_post($atts['tb']); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search form -->
                </div>
            </div>
            <script type="text/javascript">
                var
                    mapObject,
                    markers = [],
                    markersData = {
                        <?php     echo  wp_kses_post(implode(",",$places_categories));
                        ?>
                    };


                function initialize_map() {


                    loadScript("<?php echo esc_url( get_template_directory_uri() ); ?>/js/infobox.js", after_load);

                }

                function after_load() {
                    initialize_new();
                }
                function loadScript(src, callback) {
                    var s,
                        r,
                        t;
                    r = false;
                    s = document.createElement('script');
                    s.type = 'text/javascript';
                    s.src = src;
                    s.onload = s.onreadystatechange = function () {
                        ////console.log( this.readyState ); //uncomment this line to see which ready states are called.
                        if (!r && (!this.readyState || this.readyState == 'complete')) {
                            r = true;
                            callback();
                        }
                    };
                    t = document.getElementsByTagName('script')[0];
                    t.parentNode.insertBefore(s, t);

                }
            </script>
            <!-- Google map -->
            <div class="google-map">
                <div id="map-canvas"></div>
            </div>
            <!-- /Google map -->

        </div>
    </section>
    <!-- /PAGE -->
    <?php
    return ob_get_clean();
}
