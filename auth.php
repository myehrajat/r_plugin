<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 28.04.2016
 * Time: 20:58
 */



add_action('wp_footer', 'rentit_add_to_footer');

function rentit_add_to_footer()
{

    if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']) || isset($_GET['code'])) {
        wp_add_inline_script('renita_map_int', 'window.location.href = "'. esc_url(get_home_url('/')).'"');

    }
}