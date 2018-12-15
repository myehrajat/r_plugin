<?php

/**
 * Post Carousel
 * @package Rent It
 * @since Rent It 1.0
 */


$all = esc_html__('All', 'rentit');
$post_cat = array();
$post_cat[$all] = 'all';
$categories = get_terms('category', 'orderby=name&hide_empty=1');
if (count($categories) > 0):
    foreach ($categories as $cat) {
        $post_cat[$cat->name] = $cat->term_id;
    }
endif;

vc_map(array(
    'name' => esc_html__('Rent It Post Carousel', 'rentit'),
    'base' => 'rentit_vc_post_carousel',
    "icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
    'category' => esc_html__('Rent It', 'rentit'),
    'description' => esc_html__('Animated carousel for blog posts.', 'rentit'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Widget title', 'rentit'),
            'param_name' => 'title'
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'category',
            'value' => $post_cat,
            'heading' => esc_html__('Category', 'rentit'),
            'description' => esc_html__('Select product category.', 'rentit'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Maximum posts limit', 'rentit'),
            'param_name' => 'limit'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Image size (in pixel)', 'rentit'),
            'description' => esc_html__('WIDTH, HEIGHT. Example: <em>600,260</em>', 'rentit'),
            'param_name' => 'image_size'
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__('Css', 'rentit'),
            'param_name' => 'css',
            'group' => esc_html__('Design options', 'rentit'),
        )
    ),
));


VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_Vc_Carousel');

class WPBakeryShortCode_rentit_vc_post_carousel extends WPBakeryShortCode_Vc_Carousel
{

    /**
     * Load specific template
     * @package Rent It
     * @since Rent It 1.0
     */


    public function getFileName()
    {
        return 'rentit_vc_post_carousel_template';
    }

    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes($this->getShortcode(), $atts);
        extract($atts);

        ob_start();

        ?>
        <?php

        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );

        $css = (isset($atts['css'])) ? $atts['css'] : '';
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


        ?>

        <article class="post-wrap rentit-vc-post-slider <?php echo esc_attr($css_class); ?>">
            <?php if(!empty($atts['title'])): ?>
                <h2 class="block-title"><span><?php echo wp_kses_post($atts['title']); ?></span></h2>
            <?php endif; ?>

            <?php

            $max = -1;

            if( isset($atts['limit']) && !empty($atts['limit']) ){
                $max = $atts['limit'];
            }


            $args = array(
                'post_type' => 'post',
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $max,
                'meta_query' => array(array('key' => '_thumbnail_id'))
            );

            if( isset($atts['category']) && $atts['category'] != ''  && $atts['category'] != 'all' ){
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $atts['category']
                    )
                );
            }

            $post_query = new WP_Query( $args );
           
            global $post;

            ?>


            <?php if ($post_query->have_posts()) : ?>

                <div class="owl-carousel img-carousel">
                    <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
                        <div class="item">
                            <a href="<?php echo esc_url(get_permalink($post_query->ID)) ?>">
                                <?php
                                $image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );

                                if( empty($atts['image_size']) ){
                                    $image_size = 'vc-post-slider';
                                }else{
                                    $image_size = explode(',', $atts["image_size"]);
                                }

                                $image = get_the_post_thumbnail( $post->ID, $image_size, array(
                                    'title'	=> $image_title,
                                    'alt'	=> $image_title,
                                    'class' => 'img-responsive'
                                ) );
                                echo wp_kses_post($image);
                                ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>

            <?php endif;   wp_reset_postdata(); ?>

        </article>

        <?php

        return ob_get_clean();
    }

}



