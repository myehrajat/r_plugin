<?php
/**
 * Auth register
 */

if (function_exists('rentit_base_encode')) {


    function rentit_auth()
    {

        //get users info
        $info = rentit_user_info_func();

        
        $user_signon = wp_signon($info, false);
        if (is_wp_error($user_signon)) {
            echo wp_kses_post($user_signon->get_error_message());
        } else {
            echo 1;
        }

        die();


    }

    /**
     * register users
     */
    function rentit_reg()
    {
        $info = rentit_user_info_func();
        $name = "";
        $email = "";
        //is this email get name
        if (is_email($info['user_login'])) {
            $email = $info['user_login'];
            preg_match('#(.*?)@#', $info['user_login'], $math);
            $name = $math[1];

        } elseif (preg_match('#(.*?)@#', $info['user_login'])) {
            die( esc_html__('Invalid email address', 'rentit'));
        } else {
            $email = $info['user_login'] . '@' . @$_SERVER['HTTP_HOST'];
            $name = $info['user_login'];
        }
        if (strlen($info['user_password']) < 8) {
            die( esc_html__('password should be longer than 8 characters', 'rentit'));
        }

        if (username_exists($name)) {
            die( esc_html__('user already exists, try a different login', 'rentit'));
        }
        //refister new user
        $user_id = wp_create_user($name, $info['user_password'], $email);
        if (!is_wp_error($user_id)) {


            $info['user_login'] = $name;
            $info['remember'] = true;

            $user_signon = wp_signon($info, false);
            if (is_wp_error($user_signon)) {
                echo wp_kses_post($user_signon->get_error_message());
            } else {
                ?>
                <script>
                    window.location = '/';
                </script>
                <?php
            }
        } else {
            echo wp_kses_post($user_id->get_error_message());
        }


        die();
    }

    function rentit_user_info_func()
    {
        $info = array();
        $info['user_login'] = @sanitize_text_field($_POST['user_login']);
        $info['user_password'] = @sanitize_text_field($_POST['user_password']);
        $info['remember'] = true;
        return $info;

    }

    add_action('wp_ajax_rentit_auth', 'rentit_auth');
    add_action('wp_ajax_nopriv_rentit_auth', 'rentit_auth');
    add_action('wp_ajax_rentit_reg', 'rentit_reg');
    add_action('wp_ajax_nopriv_rentit_reg', 'rentit_reg');


    /******************************************************************/

    function rentit_get_twiter_link()
    {

        $rentit_twiter_CONSUMER_KEY = @trim(get_theme_mod("sotial_networks_twitter_CONSUMER_KEY")); //'RRxzdUgZhjHXfiBlGk8fqcipg';
        $rentit_twiter_CONSUMER_SECRET = @trim(get_theme_mod("sotial_networks_twitter_CONSUMER_SECRET"));

        if (strlen($rentit_twiter_CONSUMER_KEY) < 5 && strlen($rentit_twiter_CONSUMER_SECRET) < 5) {
            return false;
        }
        $rentit_twiter_REQUEST_TOKEN_URL = 'https://api.twitter.com/oauth/request_token';
        $rentit_twiter_AUTHORIZE_URL = 'https://api.twitter.com/oauth/authorize';
        $rentit_twiter_ACCESS_TOKEN_URL = 'https://api.twitter.com/oauth/access_token';
        $rentit_twiter_ACCOUNT_DATA_URL = 'https://api.twitter.com/1.1/users/show.json';
        $rentit_twiter_CALLBACK_URL = get_home_url('/');
        $rentit_twiter_URL_SEPARATOR = '&';


        $oauth_nonce = md5(uniqid(rand(), true));
        $oauth_timestamp = time();

        $params = array(
            'oauth_callback=' . urlencode($rentit_twiter_CALLBACK_URL) . $rentit_twiter_URL_SEPARATOR,
            'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY . $rentit_twiter_URL_SEPARATOR,
            'oauth_nonce=' . $oauth_nonce . $rentit_twiter_URL_SEPARATOR,
            'oauth_signature_method=HMAC-SHA1' . $rentit_twiter_URL_SEPARATOR,
            'oauth_timestamp=' . $oauth_timestamp . $rentit_twiter_URL_SEPARATOR,
            'oauth_version=1.0'
        );

        $oauth_base_text = implode('', array_map('urlencode', $params));
        $key = $rentit_twiter_CONSUMER_SECRET . $rentit_twiter_URL_SEPARATOR;
        $oauth_base_text = 'GET' . $rentit_twiter_URL_SEPARATOR . urlencode($rentit_twiter_REQUEST_TOKEN_URL) . $rentit_twiter_URL_SEPARATOR . $oauth_base_text;
        $oauth_signature = rentit_base_encode(hash_hmac('sha1', $oauth_base_text, $key, true));


// get token
        $params = array(
            $rentit_twiter_URL_SEPARATOR . 'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY,
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature=' . urlencode($oauth_signature),
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_version=1.0'
        );
        $url = $rentit_twiter_REQUEST_TOKEN_URL . '?oauth_callback=' . urlencode($rentit_twiter_CALLBACK_URL) . implode('&', $params);

        $response = wp_remote_get($url);

        if (!is_wp_error($response) && isset($response["response"]) && $response["response"]["code"] != 401) {
            $response = $response["body"];

            parse_str($response, $response);
            $oauth_token = $response['oauth_token'];
            $oauth_token_secret = $response['oauth_token_secret'];
            $_SESSION['twiter_token_secret'] = $oauth_token_secret;

            return $rentit_twiter_AUTHORIZE_URL . '?oauth_token=' . $oauth_token;
        }


    }

    function rentit_get_faceook_register_link()
    {
        $client_id = @trim(get_theme_mod('sotial_networks_facebook_app_id'));  //  1291145017568928
        $client_secret = @trim(get_theme_mod('sotial_networks_facebook_app_secret')); //76c01069b8ad20872b710eada8be2e42

        //in not exits id app facebook
        if (strlen($client_id) < 5 && strlen($client_secret) < 5) {
            return false;
        }
        $redirect_uri = get_home_url('/') . '/'; // Redirect URIs

        $url_f = 'https://www.facebook.com/dialog/oauth';

        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'email,user_birthday'
        );

        return $url_f . '?' . urldecode(http_build_query($params));

    }

    add_action('init', 'rentit_twiter_get_user_date_and_register');

    function rentit_twiter_get_user_date_and_register()
    {
        @session_start();

        $rentit_twiter_CONSUMER_KEY = @trim(get_theme_mod("sotial_networks_twitter_CONSUMER_KEY")); //'RRxzdUgZhjHXfiBlGk8fqcipg';
        $rentit_twiter_CONSUMER_SECRET = @trim(get_theme_mod("sotial_networks_twitter_CONSUMER_SECRET"));


        if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']) && strlen($rentit_twiter_CONSUMER_KEY) > 5 && strlen($rentit_twiter_CONSUMER_SECRET) > 5) {


            $rentit_twiter_REQUEST_TOKEN_URL = 'https://api.twitter.com/oauth/request_token';
            $rentit_twiter_AUTHORIZE_URL = 'https://api.twitter.com/oauth/authorize';
            $rentit_twiter_ACCESS_TOKEN_URL = 'https://api.twitter.com/oauth/access_token';
            $rentit_twiter_ACCOUNT_DATA_URL = 'https://api.twitter.com/1.1/users/show.json';

            $rentit_twiter_CALLBACK_URL = esc_url(get_home_url('/'));
            $rentit_twiter_URL_SEPARATOR = '&';


            //We are preparing a signature for token access
            $oauth_token_secret = $_SESSION['twiter_token_secret'];
            $oauth_nonce = md5(uniqid(rand(), true));
            $oauth_timestamp = time();
            $oauth_token = sanitize_text_field($_GET['oauth_token']);
            $oauth_verifier = sanitize_text_field($_GET['oauth_verifier']);


            $oauth_base_text = "GET&";
            $oauth_base_text .= urlencode($rentit_twiter_ACCESS_TOKEN_URL) . "&";

            $params = array(
                'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY . $rentit_twiter_URL_SEPARATOR,
                'oauth_nonce=' . $oauth_nonce . $rentit_twiter_URL_SEPARATOR,
                'oauth_signature_method=HMAC-SHA1' . $rentit_twiter_URL_SEPARATOR,
                'oauth_token=' . $oauth_token . $rentit_twiter_URL_SEPARATOR,
                'oauth_timestamp=' . $oauth_timestamp . $rentit_twiter_URL_SEPARATOR,
                'oauth_verifier=' . $oauth_verifier . $rentit_twiter_URL_SEPARATOR,
                'oauth_version=1.0'
            );

            $key = $rentit_twiter_CONSUMER_SECRET . $rentit_twiter_URL_SEPARATOR . $oauth_token_secret;
            $oauth_base_text = 'GET' . $rentit_twiter_URL_SEPARATOR . urlencode($rentit_twiter_ACCESS_TOKEN_URL) . $rentit_twiter_URL_SEPARATOR . implode('', array_map('urlencode', $params));
            $oauth_signature = rentit_base_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

            // получаем токен доступа
            $params = array(
                'oauth_nonce=' . $oauth_nonce,
                'oauth_signature_method=HMAC-SHA1',
                'oauth_timestamp=' . $oauth_timestamp,
                'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY,
                'oauth_token=' . urlencode($oauth_token),
                'oauth_verifier=' . urlencode($oauth_verifier),
                'oauth_signature=' . urlencode($oauth_signature),
                'oauth_version=1.0'
            );
            $url = $rentit_twiter_ACCESS_TOKEN_URL . '?' . implode('&', $params);



            $response = wp_remote_get($url);
            if (@$response["response"]["code"] != 401) {
                $response = $response["body"];
                parse_str($response, $response);


                // формируем подпись для следующего запроса
                $oauth_nonce = md5(uniqid(rand(), true));
                $oauth_timestamp = time();

                $oauth_token = $response['oauth_token'];
                $oauth_token_secret = $response['oauth_token_secret'];
                $screen_name = $response['screen_name'];

                $params = array(
                    'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY . $rentit_twiter_URL_SEPARATOR,
                    'oauth_nonce=' . $oauth_nonce . $rentit_twiter_URL_SEPARATOR,
                    'oauth_signature_method=HMAC-SHA1' . $rentit_twiter_URL_SEPARATOR,
                    'oauth_timestamp=' . $oauth_timestamp . $rentit_twiter_URL_SEPARATOR,
                    'oauth_token=' . $oauth_token . $rentit_twiter_URL_SEPARATOR,
                    'oauth_version=1.0' . $rentit_twiter_URL_SEPARATOR,
                    'screen_name=' . $screen_name
                );
                $oauth_base_text = 'GET' . $rentit_twiter_URL_SEPARATOR . urlencode($rentit_twiter_ACCOUNT_DATA_URL) . $rentit_twiter_URL_SEPARATOR . implode('', array_map('urlencode', $params));

                $key = $rentit_twiter_CONSUMER_SECRET . '&' . $oauth_token_secret;
                $signature = rentit_base_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

                // получаем данные о пользователе
                $params = array(
                    'oauth_consumer_key=' . $rentit_twiter_CONSUMER_KEY,
                    'oauth_nonce=' . $oauth_nonce,
                    'oauth_signature=' . urlencode($signature),
                    'oauth_signature_method=HMAC-SHA1',
                    'oauth_timestamp=' . $oauth_timestamp,
                    'oauth_token=' . urlencode($oauth_token),
                    'oauth_version=1.0',
                    'screen_name=' . $screen_name
                );

                $url = $rentit_twiter_ACCOUNT_DATA_URL . '?' . implode($rentit_twiter_URL_SEPARATOR, $params);


                $response = wp_remote_get($url);
                if(!isset($response["body"])) return;
                $response  = $response["body"];
                $user_data = json_decode($response, true);


                //register user
                $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
                $ID = '';  // user id
                $user_id = wp_create_user($user_data['screen_name'], $random_password, $user_data['screen_name'] . '@twitter.com');

                //if this user new
                if (!is_wp_error($user_id)) {
                    update_user_meta($user_id, 'twitter_id', (int)$user_data['id']);
                    wp_update_user(array(
                        'ID' => $user_id,
                        'display_name' => $user_data['name']
                    ));

                    $creds['user_login'] = $user_data['screen_name'];
                    $creds['user_password'] = $random_password;
                    $creds['remember'] = true;
                    $user = wp_signon($creds, false);


                } else {
                    //if user exits on site

                    $user_query = new WP_User_Query(array('meta_key' => 'twitter_id', 'meta_value' => (int)$user_data['id']));
                    if (!empty($user_query->results)) {
                        foreach ($user_query->results as $user) {
                            $ID = $user->ID;
                            break;
                        }
                    }


                    $upd_info = wp_update_user(array(
                        'ID' => $ID,
                        'display_name' => $user_data['name'],
                        'user_pass' => $random_password
                    ));

                    $creds = array();
                    $creds['user_login'] = $user_data['screen_name'];
                    $creds['user_password'] = $random_password;
                    $creds['remember'] = true;

                    $user = wp_signon($creds, false);


                }


            }
        }


        /*******************facebook**********************************/
        $client_id = @trim(get_theme_mod('sotial_networks_facebook_app_id'));  //  1291145017568928
        $client_secret = @trim(get_theme_mod('sotial_networks_facebook_app_secret')); //76c01069b8ad20872b710eada8be2e42
        // $client_secret
        if (isset($_GET['code']) && strlen($client_id) > 5 && strlen($client_secret) > 5) {


            $redirect_uri = get_home_url('/') . '/'; // Redirect URIs


            $result = false;

            $params = array(
                'client_id' => $client_id,
                'redirect_uri' => $redirect_uri,
                'client_secret' => $client_secret,
                'code' => $_GET['code']
            );

            $url = 'https://graph.facebook.com/oauth/access_token';

            $tokenInfo = null;

            $tokem_ansver = wp_remote_get($url . '?' . http_build_query($params));

            @parse_str(@$tokem_ansver["body"], $tokenInfo);

            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params = array('access_token' => $tokenInfo['access_token']);
                $get = wp_remote_get('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params)));

                $userInfo = json_decode(@$get["body"], true);



                if (isset($userInfo['id'])) {
                    $fb_result = true;
                }
            }

            if ($fb_result) {


                //register user
                $random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);
                $ID = '';  // user id

                preg_match('#.*? #', $userInfo['name'], $math);
                if(isset($math['0'])){
                    $user_login = $math['0'];
                } else {
                    $user_login = $userInfo['name'];
                }

                $user_id = wp_create_user($user_login, $random_password, $user_login . '@facebook.com');
           
                //if this user new
                if (!is_wp_error($user_id)) {

                    update_user_meta($user_id, 'facebook_id', (int)$userInfo['id']);
                    wp_update_user(array(
                        'ID' => $user_id,
                        'display_name' => trim($userInfo['name'])
                    ));

                    $creds['user_login'] = sanitize_text_field($user_login);
                    $creds['user_password'] = sanitize_text_field($random_password);
                    $creds['remember'] = true;
                    $user = wp_signon($creds, false);



                } else {
                    //if user exits on site

                    $user_query = new WP_User_Query(array('meta_key' => 'facebook_id', 'meta_value' => (int)$userInfo['id']));
                    if (!empty($user_query->results)) {
                        foreach ($user_query->results as $user) {
                            $ID = $user->ID;
                            break;
                        }
                    }



                    $upd_info = wp_update_user(array(
                        'ID' => $ID,
                        'display_name' => trim($userInfo['name']),
                        'user_pass' => $random_password
                    ));

                    $creds = array();
                    $creds['user_login'] = $user_login;
                    $creds['user_password'] = $random_password;
                    $creds['remember'] = true;
                    $user = wp_signon($creds, false);



                }

            }

        }


    }


    ob_start();
    the_tags();
    ob_get_clean();

}


function rentit_dr_email_login_authenticate( $user, $username, $password ) {
    if ( is_a( $user, 'WP_User' ) )
        return $user;

    if ( !empty( $username ) ) {
        $username = str_replace( '&', '&amp;', stripslashes( $username ) );
        $user = get_user_by( 'email', $username );
        if ( isset( $user, $user->user_login, $user->user_status ) && 0 == (int) $user->user_status )
            $username = $user->user_login;
    }

    return wp_authenticate_username_password( null, $username, $password );
}

remove_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
add_filter( 'authenticate', 'rentit_dr_email_login_authenticate', 20, 3 );

