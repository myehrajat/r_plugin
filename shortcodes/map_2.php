<?php
add_shortcode('rentit_find_car_map1_v2', 'rentit_find_car_map1_v2_function');
function rentit_find_car_map1_v2_function($atts, $content)
{


    $rentit_categories = get_categories("taxonomy=product_cat&hide_empty=0");
    $places_categories = array();

    foreach ($rentit_categories as $rentit_place_cat) {
        $rentit_init_maps_point_by_term_slug = rentit_init_maps_point_by_term_slug($rentit_place_cat->term_id);
        if (!$rentit_init_maps_point_by_term_slug) continue;

        $places_categories[] = "'" . esc_html($rentit_place_cat->slug) . "': [" . print_r($rentit_init_maps_point_by_term_slug, true) . "]";
    }



    ob_start();
    ?>

    <!-- PAGE -->
    <section class="page-section no-padding">
        <div class="container full-width">

            <script type="text/javascript">
                var
                    mapObject,
                    markers = [],
                    markersData = {
                        <?php     echo wp_kses_post(implode(",",$places_categories));
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

    <!-- /PAGE -->
    <?php
    return ob_get_clean();
}

?>