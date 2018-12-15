<?php
global $wpdb;
$wpdb->show_errors();
function rentit_my_appearance_menu_item() {
	add_theme_page( __( 'Import demo data', 'rentit' ), esc_html__( 'Import demo data',
		'rentit' ), 'edit_theme_options', 'rentit_wp_importer_geocity244',
		'rentit_wp_importer_geocity' );
}

add_action( 'admin_menu', 'rentit_my_appearance_menu_item' );


function rentit_wp_importer_geocity() {
	global $_POST;
	if ( isset( $_POST['wfm_hidenn'] ) && $_POST['wfm_hidenn'] == 'wmf_hiden' ) {
		global $wpdb, $wp_filesystem;

		/*
		 * uploads files
		 */
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}
		$siteurl = get_option( 'siteurl' );
		$home = get_option( 'home' );


		//dowload files
		$tmp_files = download_url( 'http://rentit.wpmix.net/uploads_2016_04.zip' );

		if ( is_wp_error( $tmp_files ) ) {
			$tmp_files->get_error_messages();

		} else {
			$destination = wp_upload_dir();
			unzip_file( $tmp_files, $destination['basedir'] );
		}
		/*
		 * SQL
		 */

		global $wpdb;

		$wpdb->hide_errors();
		$users_role = get_option( 'user_roles' );
		$admin_email = get_option( 'admin_email' );
		/*********************************************************************************/
		rentit_import_sql_from_file( plugin_dir_path( __FILE__ ) . 'sql/vioo_rentit.sql', array(
				'wprent_',
				'http://rentit.wpmix.net',
				'admin@rentit.wpmix.net',
				'http://http://'
			)
			, array( $wpdb->prefix, get_home_url( '/' ), $admin_email, 'http://' )
		);


		/**************************************************************************************/


		/***********import demo date ****************************/
		global $wp_customize;

		$setting = 'a:3:{s:8:"template";s:6:"rentit";s:4:"mods";a:25:{i:0;b:0;s:18:"nav_menu_locations";a:3:{s:8:"usermenu";i:0;s:14:"rentit_topmenu";i:118;s:19:"posts_category_menu";i:0;}s:23:"rentit_sidebar_position";s:2:"s1";s:30:"sotial_networks_control_google";s:24:"https://plus.google.com/";s:32:"sotial_networks_control_facebook";s:38:"https://www.facebook.com/jthemesstudio";s:33:"sotial_networks_control_PINTEREST";s:25:"https://ru.pinterest.com/";s:31:"sotial_networks_control_twitter";s:33:"https://twitter.com/jthemesstudio";s:24:"Color_them_control_color";s:0:"";s:21:"mailchimp_api_control";s:37:"c9494bfb6f60ebc0bbd945a1a72983a6-us12";s:24:"mailchimpid_list_control";s:10:"606e120f4f";s:31:"sotial_networks_facebook_app_id";s:15:"570302256483956";s:35:"sotial_networks_facebook_app_secret";s:32:"f49ec3b5d22924042ad61fbf954c48ed";s:36:"sotial_networks_twitter_CONSUMER_KEY";s:25:"7IgaoiXDlGv7oBm0A0j6Sk5TT";s:39:"sotial_networks_twitter_CONSUMER_SECRET";s:50:"Ebo7j4fj57BbO6kjzJ68UbZ6sCCDyWtZcNr9MGAPvJmUggfm4X";s:20:"rentit_COMING_SOON_y";i:2017;s:20:"rentit_COMING_SOON_m";i:12;s:20:"rentit_COMING_SOON_d";i:25;s:15:"Coordinates_map";s:20:"34.800155, 33.030800";s:12:"c_form_s_val";s:1155:"[rentit_conatainer class=&quot;contact dark&quot; css=&quot;.vc_custom_1455961794165{background-image: url(http://rentit.wpmix.net/wp-content/uploads/2016/01/12000.jpg?id=10606) !important;}&quot;][rentit_section-title h_s=&quot;Feel Free to Say Hello!&quot; h=&quot;GET IN TOUCH WITH US&quot;][rentit_contact_form2 show_subject=&quot;0&quot; items=&quot;%5B%7B%22icon%22%3A%22fa%20fa-home%22%2C%22title%22%3A%22Adress%3A%201600%20Pennsylvania%20Ave%20NW%2C%20Washington%2C%20D.C.%20%20DC%2020500%2C%20ABD%22%7D%2C%7B%22icon%22%3A%22fa%20fa-phone%22%2C%22title%22%3A%22Support%20Phone%3A%2001865%20339665%22%7D%2C%7B%22icon%22%3A%22fa%20fa-envelope%22%2C%22title%22%3A%22E%20mails%3A%20info%40example.com%22%7D%2C%7B%22icon%22%3A%22fa%20fa-clock-o%22%2C%22title%22%3A%22%5CtWorking%20Hours%3A%2009%3A30-21%3A00%20except%20on%20Sundays%22%7D%2C%7B%22icon%22%3A%22fa%20fa-map-marker%22%2C%22title%22%3A%22%5CtView%20on%20The%20Map%22%7D%5D&quot;]This is Photoshop&#039;s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum[/rentit_contact_form2][/rentit_conatainer]";s:19:"rentit_c_form_s_val";s:951:"[rentit_conatainer class="contact"][rentit_section-title h_s="Feel Free to Say Hello!" h="GET IN TOUCH WITH US"][rentit_contact_form2 items="%5B%7B%22icon%22%3A%22fa%20fa-home%22%2C%22title%22%3A%22Adress%3A%201600%20Pennsylvania%20Ave%20NW%2C%20Washington%2C%20D.C.%20%22%7D%2C%7B%22title%22%3A%22DC%2020500%2C%20ABD%22%7D%2C%7B%22icon%22%3A%22fa%20fa-phone%22%2C%22title%22%3A%22Support%20Phone%3A%2001865%20339665%22%7D%2C%7B%22icon%22%3A%22fa%20fa-envelope-o%22%2C%22title%22%3A%22E%20mails%3A%20info%40example.com%22%7D%2C%7B%22icon%22%3A%22fa%20fa-clock-o%22%2C%22title%22%3A%22Working%20Hours%3A%2009%3A30-21%3A00%20except%20on%20Sundays%22%7D%2C%7B%22icon%22%3A%22fa%20fa-map-marker%22%2C%22title%22%3A%22View%20on%20The%20Map%22%7D%5D"]This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum[/rentit_contact_form2][/rentit_conatainer]";s:20:"performans_preloader";s:1:"1";s:18:"rentit_rlt_control";s:0:"";s:16:"footer_copyright";s:76:"© 2016 Rent It — An Rental Car Theme made with passion by jThemes Studio1";s:40:"sotial_networks_control_social_shortcode";s:302:"[rentit_social_links url="https://www.facebook.com/jthemesstudio" class="fa-facebook"]
[rentit_social_links url="https://twitter.com/" class="fa-twitter"]
[rentit_social_links url="https://www.instagram.com/" class="fa-instagram"]
[rentit_social_links url="https://pinterest.com/" class="fa-pinterest"]";s:23:"rentit_shop_sidebar_pos";s:2:"s1";}s:7:"options";a:1:{s:9:"site_icon";s:1:"0";}}';
		$data = @unserialize( $setting );
		// Call the customize_save action.

		// Loop through the mods.
		if ( isset( $data['mods'] ) ) {
			foreach ( $data['mods'] as $key => $val ) {

				// Call the customize_save_ dynamic action.
				do_action( 'customize_save_' . $key, $wp_customize );

				// Save the mod.
				set_theme_mod( $key, $val );
			}
		}


		do_action( 'customize_save' );

		// set menu in top
		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['rentit_topmenu'] = 118;
		set_theme_mod( 'nav_menu_locations', $locations );


		update_option( 'user_roles', $users_role );
		update_option( 'admin_email', $admin_email );


		/*
		 * one page
		 */
		if ( isset( $_POST['import_one_page'] ) ) {
			rentit_import_sql_from_file( plugin_dir_path( __FILE__ ) . 'sql/one_page.sql', 'rentitop_', $wpdb->prefix );
			update_option( 'page_on_front', 10696 );
			update_option( 'show_on_front', 'page' );


			$menuname = esc_html__( 'Rentit one page menu', 'rentit' );
			$menulocation = 'rentit_topmenu';
			// Does the menu exist already?

			$menu_exists = wp_get_nav_menu_object( $menuname );

			// If it doesn't exist, let's create it.
			if ( !$menu_exists ) {
				$menu_id = wp_create_nav_menu( $menuname );

				// Set up default OnePage Menu links and add them to the menu.

				$top_menu = wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title' => esc_html__( 'Blog', 'rentit' ),
					'menu-item-classes' => '',
					'menu-item-url' => esc_url( get_home_url( '/' ) . '/blog' ),
					'menu-item-status' => 'publish'
				) );

				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title' => esc_html__( 'Blog Sidebar Left', 'rentit' ),
					'menu-item-classes' => '',
					'menu-item-url' => esc_url( get_home_url( '/' ) . '/blog/?showas=left' ),
					'menu-item-status' => 'publish',
					'menu-item-parent-id' => $top_menu,
				) );

				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title' => esc_html__( 'Blog Sidebar Right', 'rentit' ),
					'menu-item-classes' => '',
					'menu-item-url' => esc_url( get_home_url( '/' ) . '/blog/?showas=right' ),
					'menu-item-status' => 'publish',
					'menu-item-parent-id' => $top_menu,
				) );

				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title' => esc_html__( 'Blog Single Post', 'rentit' ),
					'menu-item-classes' => '',
					'menu-item-url' => esc_url( get_home_url( '/' ) . '/2015/10/12/professional-car-rental-2/' ),
					'menu-item-status' => 'publish',
					'menu-item-parent-id' => $top_menu,
				) );


				$locations = get_theme_mod( 'nav_menu_locations' );
				$locations['rentit_topmenu'] = $menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );


			} else {

				$locations = get_theme_mod( 'nav_menu_locations' );
				$locations['rentit_topmenu'] = $menu_exists->term_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}


		} else {
			delete_option( 'rentit_one_page_menu_right' );
			delete_option( 'rentit_one_page_menu' );
		}
		update_option( 'user_roles', $users_role );
		update_option( 'admin_email', $admin_email );


		update_option( 'siteurl', $siteurl );
		update_option( 'home', $home );


		?>
        <div class="updated below-h2 rs-update-notice-wrap" id="message">

            <p>
				<?php
				esc_html_e( 'Import was successful. ReActivate all plugins!', 'rentit' )
				?>
            </p></div>
		<?php
	}

	?>
    <div style="padding:20px;background-color:white;

        margin-bottom: 2px;
margin-left: 15px;
margin-right: 15px;
margin-top: 5px;
        ">
		<?php
		esc_html_e( 'Press the button for import', 'rentit' )
		?>

        <form action="" method="post">
            <table border="0" width="600">
                <input type="hidden" name="wfm_hidenn" value="wmf_hiden"/>
                <tbody>
                <tr>
                    <span
                            style="color: red; font-weight: bold"> <?php esc_html_e( 'All exist data will be deleted!', 'rentit' ) ?></span>

                    <td colspan="2">

                        <fieldset><label>

                                <input name="import_one_page" type="checkbox" id="import_one_page" value="1">
								<?php esc_html_e( 'Import one page?', 'rentit' ); ?>
                            </label>
                        </fieldset>
                    </td>
                    <br>

                </tr>
                <tr>
                    <td colspan="2">
						<?php submit_button( esc_html__( 'Import', 'rentit' ) ); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
	<?php
}


/**
 * import from file
 * @param $file_path
 * @param $arr1
 * @param $arr2
 */
function rentit_import_sql_from_file( $file_path, $arr1, $arr2 ) {
	// $filename = plugin_dir_path(__FILE__) . 'sql/vioo_rentit.sql';
	$filename = $file_path;
	( $fp = fopen( $filename, 'r' ) );
	global $wpdb;
	$wpdb->hide_errors();
	$query = '';


	while ( $line = fgets( $fp, 1024000 ) ) {
		if ( substr( $line, 0, 2 ) == '--' OR trim( $line ) == '' ) {
			continue;
		}
		$query .= $line;
		$query = str_replace( $arr1, $arr2, $query );

		if ( substr( trim( $query ), - 1 ) == ';' ) {
			if ( !$wpdb->query( $query ) ) {
			}
			$query = '';
		}
	}
}

?>