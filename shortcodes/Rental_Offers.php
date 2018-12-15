<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 15.01.2016
 * Time: 17:52
 */

add_shortcode('rentit_Rental_Offers', 'rentit_Rental_Offers_function');
function rentit_Rental_Offers_function($atts, $content)
{


    ob_start();
    global $Rent_IT_class, $post;
    $atts = shortcode_atts(
        array(
            'h_s' => esc_html__("What a Kind of Car You Want", "rentit"),
            'h' => esc_html__('Great Rental Offers for You', "rentit"),
            'id' =>''
        ), $atts
    );
    ?>

    <section class="page-section">
        <div class="container">

            <h2 class="section-title wow fadeInUp" data-wow-offset="70" data-wow-delay="100ms">
                <small><?php echo wp_kses_post($atts['h_s']); ?></small>
                <span><?php echo wp_kses_post($atts['h']); ?></span>
            </h2>

            <div class="tabs wow fadeInUp" data-wow-offset="70" data-wow-delay="300ms">
                <ul id="tabs" class="nav"><!--
                        -->

                    <?php
                    $args = array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => 0,
                    );

                    if( isset( $atts['id']{2})){
                        $args['include'] = $atts['id'];
                    }


                    $cats = get_categories($args);
                
                    
                    $i = 1;
                    foreach ($cats as $cat) {
                        if (!isset($cat->name)) continue;
                        $class = ($i == 1) ? 'active' : "";
                        ?>


                        <li class="<?php echo sanitize_html_class($class); ?>"><a
                                href="#tab-<?php echo esc_attr($i); ?>"
                                data-toggle="tab"><?php
                                echo wp_kses_post($cat->name); ?></a></li>
                        <?php
                        $i++;
                    } ?>

                    <!--
                        -->

                </ul>
            </div>

            <div class="tab-content wow fadeInUp" data-wow-offset="70" data-wow-delay="500ms">

                <?php $i = 1;
                //show tabs
                foreach ($cats as $cat) {

                    if (!isset($cat->name)) continue;

                   
                    $class = ($i == 1) ? ' active in ' : "";

                    ?>
                    <!-- tab 1 -->
                    <div class="sladersss tab-pane fade  <?php echo esc_attr($class); ?>"
                         id="tab-<?php echo esc_attr((int)$i); ?>">

                        <div class="swiper swiper--<?php echo esc_attr(str_ireplace(' ', '-', $cat->name)); ?>">
                            <div class="swiper-container-GREAT-RENTAL swiper-container">

                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <?php
                                    $rentit_new_arr = array(
                                        'paged' => 1,
                                        'showposts' => 5,
                                        'post_status' => 'publish',
                                        'post_type' => 'product',
                                        'orderby' => 'date'
                                    );


                                    $rentit_new_arr['tax_query'] =
                                        array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field' => 'id',
                                                'terms' => array(sanitize_text_field($cat->term_id))
                                            )
                                        );


                                    $rentit_custom_query = new WP_Query($rentit_new_arr);

                                    
                                    $j = 1;
                                    if ($rentit_custom_query->have_posts()):
                                        while ($rentit_custom_query->have_posts()):
                                            $rentit_custom_query->the_post();

                                            $class = ($j == 1) ? ' active' : "";
                                            ?>

                                            <div class="swiper-slide">
                                                <div class="thumbnail no-border no-padding thumbnail-car-card">

                                                    <div class="media">
                                                        <a class="media-link" data-gal="prettyPhoto"
                                                           href="<?php $Rent_IT_class->get_post_thumbnail($post->ID, 370, 220, true); ?>">
                                                            <?php
                                                            /**
                                                             * woocommerce_before_shop_loop_item_title hook
                                                             *
                                                             * @hooked woocommerce_show_product_loop_sale_flash - 10
                                                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                                                             */
                                                      
                                                            ?>
                                                            <img
                                                                src="<?php $Rent_IT_class->get_post_thumbnail($post->ID, 370, 230); ?>"
                                                                alt="">


                                                    <span class="icon-view"><strong><i
                                                                class="fa fa-eye"></i></strong></span>
                                                        </a>
                                                    </div>


                                                    <div class="caption text-center">
                                                        <h4 class="caption-title"><a
                                                                href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
                                                        </h4>

                                                        <div class="caption-text">
                                                            <?php echo wp_kses_post($Rent_IT_class->get_price_with_text()); ?>
                                                        </div>
                                                        <div class="buttons">
                                                            <a class="btn btn-theme ripple-effect"
                                                               href="<?php echo esc_url(get_the_permalink()) ?>">
                                                                <?php echo wp_kses_post(apply_filters('rentit_rentit_text', esc_html__('Rent It', 'rentit'))); ?>
                                                            </a>
                                                        </div>
                                                        <table class="table">
                                                            <?php
                                                            $post_id = get_the_ID(); ?>
                                                            <tr>
                                                                <td>
                                                                    <i class="fa fa-car"></i> <?php echo wp_kses_post(get_post_meta($post_id, '_rental_car_year', true) ? get_post_meta($post_id, '_rental_car_year', true) : "2015"); ?>
                                                                </td>
                                                                <td>
                                                                    <i class="fa fa-dashboard"></i> <?php echo wp_kses_post(get_post_meta($post_id, '_rental_car_engine', true) ? get_post_meta($post_id, '_rental_car_engine', true) : esc_html__("Diesel", "rentit")); ?>
                                                                </td>
                                                                <td>
                                                                    <i class="fa fa-cog"></i> <?php echo wp_kses_post(get_post_meta($post_id, '_rental_car_transmission', true) ? get_post_meta($post_id, '_rental_car_transmission', true) : esc_html__("Auto", "rentit")); ?>
                                                                </td>
                                                                <td>
                                                                    <i class="fa fa-road"></i> <?php echo wp_kses_post(get_post_meta($post_id, '_rental_car_mileage', true) ? get_post_meta($post_id, '_rental_car_mileage', true) : "25000"); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $j++;


                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>


                                </div>

                            </div>

                            <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                            <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>

                        </div>

                    </div>
                    <?php
                    $i++;

                } ?>

            </div>

        </div>
    </section>
    <?php
    return ob_get_clean();
}