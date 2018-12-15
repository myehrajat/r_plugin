<?php
add_shortcode('rentit_find_car_map1', 'rentit_find_car_map1_function');
function rentit_find_car_map1_function($atts, $content)
{


    $rentit_categories = get_categories("taxonomy=product_cat&hide_empty=0");
    $places_categories = array();

    foreach ($rentit_categories as $rentit_place_cat) {
        $rentit_init_maps_point_by_term_slug = @rentit_init_maps_point_by_term_slug($rentit_place_cat->term_id);
        if (!$rentit_init_maps_point_by_term_slug) continue;

        $places_categories[] = "'" . esc_html($rentit_place_cat->slug) . "': [" . print_r($rentit_init_maps_point_by_term_slug, true) . "]";
    }


    $atts = shortcode_atts(
        array(
            'h_s' => esc_html__("Great Rental Cars", "rentit"),
            'h' => esc_html__('FIND YOUR CAR', "rentit"),
            'pl' => esc_html__('Picking Up Location', "rentit"),
            'pd' => esc_html__('Picking Up Date', "rentit"),
            'pc' => esc_html__('Price Category', "rentit"),
            'fc' => esc_html__('Find Car', "rentit"),
        ), $atts
    );

    ob_start();
    ?>
    <!-- PAGE -->
    <section class="page-section find-car dark">
        <div class="container">

            <form action="<?php
            if(function_exists('wc_get_page_id'))
            echo esc_url(get_permalink(wc_get_page_id(('shop')))); ?>" class="form-find-car">
                <div class="row">

                    <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">

                        <h2 class="section-title text-left no-margin">
                            <small>
                            <?php echo wp_kses_post($atts['h_s']); ?></small>
                            <span><?php echo wp_kses_post($atts['h']); ?></span>
                        </h2>

                    </div>
                    <div class="col-md-3 wow fadeInDown" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="form-group has-icon has-label">
                            <label for="formFindCarLocation"><?php echo wp_kses_post($atts['pl']); ?></label>
                            <input name="dropin" type="text" class="form-control formSearchUpLocation" id="formFindCarLocation"
                                   placeholder="<?php esc_html_e('Airport or Anywhere','rentit'); ?>"  value="<?php
                            if (function_exists('rentit_get_date_s'))
                                rentit_get_date_s('dropin_location');
                            ?>">
                            <span class="form-control-icon"><i class="fa fa-location-arrow"></i></span>
                        </div>
                    </div>
                    <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="300ms">
                        <div class="form-group has-icon has-label">
                            <label for="formFindCarDate"><?php echo wp_kses_post($atts['pd']); ?></label>
                            <input  name="start_date" type="text" class="form-control" id="formFindCarDate"
                                   placeholder="<?php  esc_html_e('dd/mm/yyyy','rentit'); ?>"  value="<?php
                            if (function_exists('rentit_get_date_s'))
                                rentit_get_date_s('dropin_date');
                            ?>">
                            <span class="form-control-icon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="400ms">
                        <div class="form-group has-icon has-label">
                            <label for="formFindCarCategory"><?php echo wp_kses_post($atts['pc']); ?></label>
                            <input name="Car_Group" type="text" class="form-control typeaheadgrupproduct" id="formFindCarCategory"
                                   placeholder="<?php esc_html_e('Select Car Group','rentit'); ?> ">
                            <span class="form-control-icon"><i class="fa fa-bars"></i></span>
                        </div>
                    </div>
                    <div class="col-md-2 wow fadeInDown" data-wow-offset="200" data-wow-delay="500ms">
                        <div class="form-group">
                            <button type="submit" id="formFindCarSubmit"
                                    class="btn btn-block btn-submit ripple-effect btn-theme"><?php echo wp_kses_post($atts['fc']); ?>
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </section>
    <!-- PAGE -->
    <section class="page-section no-padding no-bottom-space-off">
        <div class="container full-width">
            <script type="text/javascript">
                var
                    mapObject,
                    markers = [],
                    markersData = {
                        <?php     echo implode(",",$places_categories);
      ?>
                    };


                function initialize_map() {


                    loadScript("<?php echo esc_url( get_template_directory_uri() ); ?>/js/infobox.js", after_load);

                }

                function after_load() {
                    var global_scrollwheel = false;
                    var markerClusterer = null;
                    var markerCLuster;
                    var Clusterer;

                    initialize_new2();
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

?>