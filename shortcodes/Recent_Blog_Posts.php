<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 18.01.2016
 * Time: 9:31
 */

add_shortcode('rentit_recent_blog_post', 'rentit_recent_blog_post_function');
function rentit_recent_blog_post_function($atts, $content)
{
    ob_start();
    global $Rent_IT_class, $post;

    $args = array(
        'posts_per_page' => 2,
        'post_type' => 'post',
        'orderby' => 'title',
        'meta_query' => array(array('key' => '_thumbnail_id'))

    );

    $rent_blog_query = new WP_Query($args);
    global $post;
    $points = array();
    $duplictas = array();
    if ($rent_blog_query->have_posts()):
        while ($rent_blog_query->have_posts()) {
            $rent_blog_query->the_post();
            ?>
            <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                <div class="recent-post alt">
                    <div class="media">
                        <a class="media-link"
                           href="<?php echo esc_url(get_permalink(get_the_ID())); ?>">
                            <?php

                            $cat_lists = wp_get_post_terms(get_the_ID(), 'category', array("fields" => "all"));

                            if (count($cat_lists) > 0) {
                                echo '<div class="badge type">';
                                $get_cat = array();
                                foreach ($cat_lists as $cat) {
                                    $get_cat[] = $cat->name;
                                }
                                echo wp_kses_post($get_cat[0]);
                                echo '</div>';
                            }

                            ?>
                            <?php
                            $post_format = get_post_format();
                            if ($post_format == 'video' || $post_format == 'gallery' || $post_format == 'image') {
                                $icon = '';
                                switch ($post_format) {
                                    case 'video':
                                        $icon = 'fa-video-camera';
                                        break;
                                    case 'gallery':
                                    case 'image':
                                        $icon = 'fa-image';
                                        break;
                                    default:
                                        // Display nothing
                                        $icon = '';
                                        break;
                                }

                                ?>
                                <div class="badge post">
                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                </div>
                            <?php } else { ?>
                                <div class="badge post">
                                    <i class="fa fa-image"></i>
                                </div>
                            <?php } ?>
                            <img class="media-object"
                                 src="<?php $Rent_IT_class->get_post_thumbnail(get_the_ID(), 555, 263); ?>"
                                 alt="">
                            <i class="fa fa-plus"></i>
                        </a>

                        <div class="media-left">
                            <div class="meta-date">
                                <div class="day"><?php echo wp_kses_post(get_the_date('d')); ?></div>
                                <div class="month"><?php echo wp_kses_post(get_the_date('M')); ?></div>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="media-meta">

                                <?php
                                $author = esc_html__('By ', 'rentit') . '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a>';
                                echo wp_kses_post($author);
                                ?>

                                <?php if (comments_open()) : ?>
                                    <span class="divider">|</span>
                                    <a
                                        href="<?php echo esc_url(get_post_reply_link()) ?>"><i
                                            class="fa fa-comment"></i><?php echo wp_kses_post(get_comments_number()); ?>
                                    </a>
                                <?php endif; ?>
                                <span class="divider">|</span>
                                <a data-id="<?php  echo wp_kses_post(get_the_ID()); ?>" class="heart_post_like" href="#">
                                    <i class="fa fa-heart"> </i>
                                <?php  echo  esc_html((int)get_post_meta(get_the_ID(), '_rentit_post_like',true)); ?>
                                </a>

                                <span class="divider">|</span><a href="#"><i
                                        class="fa fa-share-alt"></i></a>


                            </div>
                            <h4 class="media-heading">
                                <a href="<?php echo  esc_url(get_permalink(get_the_ID())); ?>">
                                    <?php echo  esc_html(get_the_title(get_the_ID())); ?>
                                </a>
                            </h4>

                            <div class="media-excerpt"><?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        wp_reset_postdata();
    endif;
    ?>

    <?php
    return ob_get_clean();

} ?>
