<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 08.03.2016
 * Time: 14:41
 */

add_shortcode('rentit_search', 'rentit_search_function');
/*
 *
 */
function rentit_search_function($atts, $content)
{
    ob_start();
    the_widget('rentit_searh_Wigdet_class', array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    return ob_get_clean();
}

add_shortcode('rentit_CATEGORIES_Wigdet', 'rentit_CATEGORIES_Wigdet_function');
/*
 *
 */
function rentit_CATEGORIES_Wigdet_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('Categories', 'rentit') // get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg',
        ), $atts
    );

    ob_start();
    the_widget('rentit_CATEGORIES_Wigdet_class', array('title' => $atts['title']), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    return ob_get_clean();
}

/**************************
 * rentit_twiter_Wigdet
 */

add_shortcode('rentit_twiter_Wigdet', 'rentit_twiter_Wigdet_function');
/*
 *
 */
function rentit_twiter_Wigdet_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('TWEETS', 'rentit'),// get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg',
            'Name' => '',
            'text' => 3
        ), $atts
    );

    ob_start();
    the_widget('rentit_twiter_Wigdet', array(
        'title' => $atts['title'],
        'Name' => $atts['Name'],
        'text' => $atts['text'],

    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</div></aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1><div class="widget-content">',
    ));
    return ob_get_clean();
}

/**************************
 * rentit_ARCHIVES_Wigdet_class
 */

add_shortcode('rentit_ARCHIVES_Wigdet_class', 'rentit_ARCHIVES_Wigdet_class_function');
/*
 *
 */
function rentit_ARCHIVES_Wigdet_class_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('archives', 'rentit'),// get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg',
            'number' => '',
        ), $atts
    );

    ob_start();
    the_widget('rentit_ARCHIVES_Wigdet_class', array(
        'title' => $atts['title'],
        'number' => $atts['number'],

    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</div></aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1><div class="widget-content">',
    ));
    return ob_get_clean();
}

/**************************
 * rentit_HELPING_CENTER_Wigdet_class
 */

add_shortcode('rentit_HELPING_CENTER_Wigdet_class', 'rentit_HELPING_CENTER_Wigdet_function');
/*
 *
 */
function rentit_HELPING_CENTER_Wigdet_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__(' HELPING CENTER', 'rentit'),
            'text' => esc_html__('Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.', 'rentit'),
            'phone_number' => '+90 555 444 66 33',
            'email' => 'support@supportcenter.com',
            'url' => '#'
        ), $atts
    );

    ob_start();
    the_widget('rentit_HELPING_CENTER_Wigdet_class', array(
        'title' => $atts['title'],
        'text' => $atts['text'],
        'phone_number' => $atts['phone_number'],
        'email' => $atts['email'],
        'url' => $atts['url']
    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    return ob_get_clean();
}

/**************************
 * rentit_TESTIMONIALS_Wigdet_class
 */

add_shortcode('rentit_TESTIMONIALS_Wigdet_class', 'rentit_TESTIMONIALS_Wigdet_class_function');
/*
 *
 */
function rentit_TESTIMONIALS_Wigdet_class_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('TESTIMONIALS', 'rentit'),
            'number' => 3
        ), $atts
    );

    ob_start();
    the_widget('rentit_TESTIMONIALS_Wigdet_class', array(
        'title' => $atts['title'],
        'number' => $atts['number'],
    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</div></aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1><div class="widget-content">',
    ));
    return ob_get_clean();
}

/**************************
 * rentit_TAG_Wigdet_class
 */

add_shortcode('rentit_TAG_Wigdet_class', 'rentit_TAG_Wigdet_class_function');
/*
 *
 */
function rentit_TAG_Wigdet_class_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('TAGS', 'rentit'),
            'type_tag' => '0'
        ), $atts
    );

    extract($atts);
    ob_start();
    the_widget('rentit_TAG_Wigdet_class', array(
        'title' => $atts['title'],
        'type_tag' => $type_tag
    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    return ob_get_clean();
}


/**************************
 * rentit_Flickr_Images_class
 */

add_shortcode('rentit_Flickr_Images_class', 'rentit_Flickr_Images_function');
function rentit_Flickr_Images_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('FLICKR IMAGES', 'rentit'),
            'number' => 9,
            'fliker_id' => '71865026@N00'
        ), $atts
    );

    ob_start();


    the_widget('rentit_Flickr_Images_class', array(
        'title' => $atts['title'],
        'number' => (int)$atts['number'],
        'fliker_id' => $atts['fliker_id']
    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    return ob_get_clean();
}


/**************************
 * rentit ABOUT_US_Wigdet
 */

add_shortcode('rentit_ABOUT_US_Wigdet_class', 'rentit_ABOUT_US_Wigdet_function');
function rentit_ABOUT_US_Wigdet_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('ABOUT US', 'rentit'),
            'social' => 'on',
            'fliker_id' => '71865026@N00'
        ), $atts
    );
    extract($atts);
    ob_start();
    $content = (!isset($content) || empty($content)) ? '' : $content;


    // run widgets with params
    the_widget('rentit_ABOUT_US_Wigdet_class', array(
        'title' => $title,
        'social' => $social,
        'text' => $content
    ), array(
        'name' => esc_html__('Footer area', "rentit"),
        'id' => 'rentit_footer',
        'before_widget' => '<div class="col-md-3"><div class="widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4 class="widget-title">',
    ));
    return ob_get_clean();
}


/**************************
 * rentit_menu_Wigdet_class
 */

add_shortcode('rentit_menu_Wigdet_class', 'rentit_menu_Wigdet_class_function');
function rentit_menu_Wigdet_class_function($atts, $content)
{

    $atts = shortcode_atts(
        array(
            'nav_menu' => false,
            'title' => esc_html__('INFORMATION', 'rentit')
        ), $atts
    );
    ob_start();

    extract($atts);

    // run widgets with params
    the_widget('rentit_menu_Wigdet_class', array(
        'title' => $title,
        'nav_menu' => $nav_menu,
    ), array(
        'name' => esc_html__('Footer area', "rentit"),
        'id' => 'rentit_footer',
        'before_widget' => '<div class="col-md-3"><div class="widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4 class="widget-title">',
    ));
    return ob_get_clean();
}


/**************************
 * rentit_menu_Wigdet_class
 */

add_shortcode('rentit_NEWS_LETTER_class', 'rentit_NEWS_LETTER_function');
function rentit_NEWS_LETTER_function($atts, $content = "")
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('NEWS LETTER', 'rentit'), // Legacy.

            'placeholder' => esc_html__('Enter Your Mail and Get $10 Cash', 'rentit'),
            'text_button' => esc_html__('Subscribe', 'rentit')

        ), $atts
    );
    ob_start();

    extract($atts);

    // run widgets with params
    the_widget('rentit_NEWS_LETTER_class', array(
        'title' => $title, // Legacy.
        'text' => $content, // Legacy URL field.
        'placeholder' => $placeholder,
        'text_button' => $text_button

    ), array(
        'name' => esc_html__('Footer area', "rentit"),
        'id' => 'rentit_footer',
        'before_widget' => '<div class="col-md-3"><div class="widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4 class="widget-title">',
    ));
    return ob_get_clean();
}


/**************************
 * rentit_ITEM_TAGS_class
 */

add_shortcode('rentit_ITEM_TAGS_class', 'rentit_ITEM_TAGS_class_function');
function rentit_ITEM_TAGS_class_function($atts, $content = "")
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('ITEM TAGS', 'rentit')


        ), $atts
    );
    ob_start();
    extract($atts);

    // run widgets with params
    the_widget('rentit_ITEM_TAGS_class', array(
        'title' => $title, // Legacy.
    ), array(
        'name' => esc_html__('Footer area', "rentit"),
        'id' => 'rentit_footer',
        'before_widget' => '<div class="col-md-3"><div class="widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4 class="widget-title">',
    ));
    return ob_get_clean();
}


/**************************
 * rentit_ITEM_TAGS_class
 */

add_shortcode('rentit_PRICE_FILTER_class', 'rentit_PRICE_FILTER_function');
function rentit_PRICE_FILTER_function($atts, $content = "")
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('PRICE', 'rentit'),
            'text_button' => esc_html__('Filter', 'rentit'),
        ), $atts
    );
    ob_start();
    extract($atts);

    // run widgets with params
    the_widget('rentit_PRICE_FILTER_class', array(
        'title' => $title, // Legacy.
        'text_button' => $text_button
    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</div></aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1><div class="widget-content">',
    ));
    return ob_get_clean();
}


/**************************
 * rentit_DETAIL_RESERVATION_class
 */

add_shortcode('rentit_DETAIL_RESERVATION_class', 'rentit_DETAIL_RESERVATION_class_function');
function rentit_DETAIL_RESERVATION_class_function($atts, $content = "")
{

    $atts = shortcode_atts(
        array(
            'title' => esc_html__('DETAIL RESERVATION', 'rentit'),

        ), $atts
    );
    ob_start();
    extract($atts);

    // run widgets with params
    the_widget('rentit_DETAIL_RESERVATION_class', array(
        'title' => $title, // Legacy.

    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ), array(
        'name' => esc_html__('sidebar', "rentit"),
        'id' => 'rentit_sidebar',
        'before_widget' => '<aside  class="widget shadow rentit_card-widget %s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
    return ob_get_clean();
}

/**************************
 * rentit_DETAIL_RESERVATION_class
 */

add_shortcode('rentit_wiget_sidebar', 'rentit_wiget_sidebar_function');
function rentit_wiget_sidebar_function($atts, $content = "")
{


    $atts = shortcode_atts(
        array(
            'title' => esc_html__('DETAIL RESERVATION', 'rentit'),
            'class' => '3'
        ), $atts
    );
    ob_start();
    extract($atts);
    ?>
<div class="col-md-<?php  echo wp_kses_post($class); ?> sidebar">
        <?php echo do_shortcode($content); ?>
    </div>
    <?php
    return ob_get_clean();
}

/**************************
 * rentit_DETAIL_RESERVATION_class
 */

add_shortcode('rentit_Car_tab_class', 'rentit_Car_tab_class_function');
function rentit_Car_tab_class_function($atts, $content = "")
{
    //parse atts
    $atts = shortcode_atts(
        array(
            'text_button' => esc_html__('View More', 'rentit'),
            'max' => 3,
            'more_url' => "#"


        ), $atts
    );
    ob_start();
    extract($atts);

    // run widgets with params

    the_widget('rentit_Car_tab_class', array(
        'text_button' => $text_button,
        'max' => $max, // Legacy.
        'more_url' => $more_url

    ));
    return ob_get_clean();
}


/**************************
 * rentit_DETAIL_RESERVATION_class
 */

add_shortcode('rentit_Widget_Tabbed_Post', 'rentit_Widget_Tabbed_Post_function');
function rentit_Widget_Tabbed_Post_function($atts, $content = "")
{

    //parse atts
    $atts = shortcode_atts(
        array(
            'title' => esc_html__('Title', 'rentit'),
            'recent_posts_title' => esc_html__('Recent Posts', 'rentit'),
            'recent_posts_limit' => 5,
            'popular_posts_title' =>  esc_html__('Popular Posts', 'rentit'),
            'popular_posts_limit' => 5,
            'url' => '#'
        ), $atts
    );


    ob_start();
    extract($atts);
   

    // run widgets with params

    the_widget('rentit_Widget_Tabbed_Post', array(
        'title' => $title,
        'recent_posts_title' => $recent_posts_title, // Legacy.
        'recent_posts_limit' => $recent_posts_limit,
        'popular_posts_title' => $popular_posts_title,
        'popular_posts_limit' => $popular_posts_limit,
        'url' => $url
    ), array(
        'name' => esc_html__('Footer area', "rentit"),
        'id' => 'rentit_footer',
        'before_widget' => '<div class="col-md-3"><div class="widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4 class="widget-title">',
    ));
    return ob_get_clean();
}

