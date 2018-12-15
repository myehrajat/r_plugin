<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 14.01.2016
 * Time: 18:33
 */
add_action( 'vc_before_init', 'fmr_subtitle_integrateWithVC' );
/**
 *
 */
function fmr_subtitle_integrateWithVC() {


//Register "container" content element. It will hold all your inner (child) content elements

	vc_map( array(
		"name" => esc_html__( "Rentit porfolio", 'rentit' ),
		"base" => "rentit_portfolio_v1", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),

		"params" => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select type portfolio', 'rentit' ),
				'value' => array(
					esc_html__( 'standard 3 column', 'rentit' ) => 'standard',
					esc_html__( '4 column ', 'rentit' ) => '4col',
					esc_html__( 'alt', 'rentit' ) => 'alt',

				),
				'param_name' => 'view'
			),
		)

	) );


	vc_map( array(
		"name" => esc_html__( "page section slider with filters", 'rentit' ),
		"base" => "rentit_page_section_slider", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'rentit' ),
				"param_name" => "img_url",
				"value" => '',
				"description" => esc_html__( "insert url img", 'rentit' )
			)
		),
		"js_view" => 'VcColumnView'
	) );


//slaid 1
	vc_map( array(
		"name" => esc_html__( "Rentit slider ver1", 'rentit' ),
		"base" => "rentit_page_section_slider_v1", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'as_parent' => array(
			'only' => 'rentit_page_section_slider',
			'vc_row'

		),
		"params" => array(
			array(
				'type' => 'attach_image',
				"holder" => "img",
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'img_src',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),

			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Insert video youtube url for example https://www.youtube.com/embed/8Q1gMEqlJtA ", 'rentit' ),
				"param_name" => "video",
				"value" => '',
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Text small", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'All Discounts Just For You', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Text big", 'rentit' ),
				"param_name" => "sh",
				"value" => esc_html__( 'Find Best Rental Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Text of search", 'rentit' ),
				"param_name" => "st",
				"value" => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button", 'rentit' ),
				"param_name" => "tb",
				"value" => esc_html__( ' Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),


		)
	) );


	vc_map( array(
		"name" => esc_html__( "Rentit slider ver2", 'rentit' ),
		"base" => "rentit_page_section_slider_v2", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'as_parent' => array(
			'only' => 'rentit_page_section_slider',
			'vc_row'

		),
		"params" => array(
			array(
				'type' => 'attach_image',
				"holder" => "img",
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'img_src',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Insert video youtube url for example https://www.youtube.com/embed/8Q1gMEqlJtA ", 'rentit' ),
				"param_name" => "video",
				"value" => '',
				"description" => esc_html__( "insert url", 'rentit' )
			),

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text big", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Find Your Car! Rent A Car Theme', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text small", 'rentit' ),
				"param_name" => "sh",
				"value" => esc_html__( 'Find Best Rental Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text of search", 'rentit' ),
				"param_name" => "st",
				"value" => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button", 'rentit' ),
				"param_name" => "tb",
				"value" => esc_html__( ' Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "description", 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert description", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "button url", 'rentit' ),
				"param_name" => "url",
				"value" => esc_html__( '#', 'rentit' ),
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button url", 'rentit' ),
				"param_name" => "t_url",
				"value" => esc_html__( 'See All Vehicles', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
		)
	) );


	vc_map( array(
		"name" => esc_html__( "Rentit slider ver3", 'rentit' ),
		"base" => "rentit_page_section_slider_v3", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'as_parent' => array(
			'only' => 'rentit_page_section_slider',
			'vc_row'

		),
		"params" => array(
			array(
				'type' => 'attach_image',
				"holder" => "img",
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'img_src',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Insert video youtube url for example https://www.youtube.com/embed/8Q1gMEqlJtA ", 'rentit' ),
				"param_name" => "video",
				"value" => '',
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text big", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Best Deals', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text small", 'rentit' ),
				"param_name" => "sh",
				"value" => esc_html__( 'For rental Cars', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",

				"class" => "",
				"heading" => esc_html__( "Text of search", 'rentit' ),
				"param_name" => "st",
				"value" => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button", 'rentit' ),
				"param_name" => "tb",
				"value" => esc_html__( ' Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "description", 'rentit' ),
				"param_name" => "content",
				"value" => esc_html__( 'Sales Up %45 Off', 'rentit' ) . '<br />' . esc_html__( 'All Rental Cars Start from 49$', 'rentit' ),
				"description" => esc_html__( "insert description", 'rentit' )
			),

		)
	) );


	vc_map( array(
		"name" => esc_html__( "Rentit slider ver3_2", 'rentit' ),
		"base" => "rentit_page_section_slider_v3_2", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'as_parent' => array(
			'only' => 'rentit_page_section_slider',
			'vc_row'

		),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Insert video youtube url for example https://www.youtube.com/embed/8Q1gMEqlJtA ", 'rentit' ),
				"param_name" => "video",
				"value" => '',
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				'type' => 'attach_image',
				"holder" => "img",
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'img_src',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text big", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Best Deals', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text small", 'rentit' ),
				"param_name" => "sh",
				"value" => esc_html__( 'For rental Cars', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text of search", 'rentit' ),
				"param_name" => "st",
				"value" => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button", 'rentit' ),
				"param_name" => "tb",
				"value" => esc_html__( ' Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "description", 'rentit' ),
				"param_name" => "content",
				"value" => esc_html__( 'Sales Up %45 Off', 'rentit' ) . '<br />' . esc_html__( 'All Rental Cars Start from 49$', 'rentit' ),
				"description" => esc_html__( "insert description", 'rentit' )
			),

		)
	) );

	vc_map( array(
		"name" => esc_html__( "Rentit slider ver4", 'rentit' ),
		"base" => "rentit_page_section_slider_v4", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(

			array(
				'type' => 'attach_image',
				"holder" => "img",
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'img_src',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__( "Insert video youtube url for example https://www.youtube.com/embed/8Q1gMEqlJtA ", 'rentit' ),
				"param_name" => "video",
				"value" => '',
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text big", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Best Deals', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text small", 'rentit' ),
				"param_name" => "sh",
				"value" => esc_html__( 'For rental Cars', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),

			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "description", 'rentit' ),
				"param_name" => "content",
				"value" => esc_html__( 'Sales Up %45 Off', 'rentit' ) . '<br />' . esc_html__( 'All Rental Cars Start from 49$', 'rentit' ),
				"description" => esc_html__( "insert description", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "button url", 'rentit' ),
				"param_name" => "url",
				"value" => esc_html__( '#', 'rentit' ),
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button url", 'rentit' ),
				"param_name" => "t_url",
				"value" => esc_html__( 'See All Vehicles', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),

		)
	) );


//flipInY

	vc_map( array(
		"name" => esc_html__( "Rent It gray blocks", 'rentit' ),
		"base" => "rentit_flipInY", //shortcode tag
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'rentit' ),
				"param_name" => "h",
				"value" => '',
				"description" => esc_html__( "insert title", 'rentit' )
			),

			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "description", 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert description", 'rentit' )
			)
		,
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "The text on the button", 'rentit' ),
				"param_name" => "t_b",
				"value" => esc_html__( 'Read More', 'rentit' ),
				"description" => esc_html__( "insert title", 'rentit' )
			),
			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "The icons 1 ", 'rentit' ),
				"param_name" => "icon",
				"value" => 'fa-support',
				"description" => esc_html__( "insert icon", 'rentit' ),
				"settings" => array(
					"emptyIcon" => false,
					"iconsPerPage" => 4000,
				)
			),


			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "The url on the button", 'rentit' ),
				"param_name" => "url",
				"value" => esc_html__( '#', 'rentit' ),
				"description" => esc_html__( "insert url", 'rentit' )
			)
		)
	) );

	/***************************/

	/**************************
	 **/

	vc_map( array(

		"name" => esc_html__( "Present block with slider ", 'rentit' ),
		"base" => "rentit_present_block", //shortcode tag
		"as_parent" => array( 'only' => 'vc_column_text' ),
		"content_element" => true,
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"show_settings_on_create" => false,
		"category" => esc_html__( "Rent It", 'rentit' ),
		"is_container" => true,
		//'custom_markup' => '{{title}}<div class="vc_btn3-container"><h4 class="team-name"></h4></div>',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "small headline", 'rentit' ),
				"param_name" => "h_s",
				"value" => esc_html__( 'What Do You Know About Us', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Big heading", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Who We Are ?', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				'type' => 'attach_images',
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'images',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "The text of the first button", 'rentit' ),
				"param_name" => 'btn_r_t',
				"value" => esc_html__( 'See All Vehicles', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "The url of the first button", 'rentit' ),
				"param_name" => 'btn_r_t_url',
				"value" => '#',
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "The text of the second button", 'rentit' ),
				"param_name" => 'btn_b_t',
				"value" => esc_html__( 'Reservation Now', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "The url of the second button", 'rentit' ),
				"param_name" => 'btn_b_t_url',
				"value" => '#',
				"description" => esc_html__( "insert url", 'rentit' )
			),
			array(
				'type' => 'param_group',
				'holder' => 'div',
				'heading' => esc_html__( 'Other Contact Details', 'rentit' ),
				'param_name' => 'items',
				'params' => array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Text', 'rentit' ),
						'param_name' => 'title',
						'description' => esc_html__( 'insert text steps', 'rentit' )
					),

				),
			)

		),
		"js_view" => 'VcColumnView'
	) );


//rentit_Rental_Offers
	vc_map( array(
		"name" => esc_html__( "Great Rental Offers for You", 'rentit' ),
		"base" => "rentit_Rental_Offers",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Small text title", 'rentit' ),
				"param_name" => 'h_s',
				"value" => esc_html__( 'What a Kind of Car You Want', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text large title", 'rentit' ),
				"param_name" => 'h',
				"value" => esc_html__( 'Great Rental Offers for You', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Insert  product cat id ", 'rentit' ),
				"param_name" => 'id',
				"value" => '',
				"description" => esc_html__( "insert  number for example 5,6,9", 'rentit' )
			),
		),

	) );
	//Testimonials full
	vc_map( array(
		"name" => esc_html__( "Rent It Testimonials full block", 'rentit' ),
		"base" => "rentit_testimonials",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'js_view' => 'RentitVcTeamView',
		'custom_markup' => '{{title}}<div class="vc_btn3-container"><h4 class="team-name"></h4></div>',
		"params" => array(
			// add params same as with any other content element\\
			array(
				'type' => 'param_group',
				'holder' => 'div',
				'heading' => esc_html__( 'Other Contact Details', 'rentit' ),
				'param_name' => 'items',
				'params' => array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Name', 'rentit' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Label cometns E.g. John Anthony Gibson ', 'rentit' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'testimonial position', 'rentit' ),
						'param_name' => 'position',
						'description' => esc_html__( 'Co- founder at Rent It', 'rentit' )
					),
					array(
						'type' => 'textarea',
						'holder' => 'div',
						'heading' => esc_html__( 'Comment', 'rentit' ),
						'param_name' => 'des',
						'description' => esc_html__( 'Comment', 'rentit' )
					),

					array(
						'type' => 'attach_image',
						"holder" => "img",
						'heading' => esc_html__( 'Images Avatar', 'rentit' ),
						'param_name' => 'img_src',
						'value' => '',
						'description' => esc_html__( 'Select images from media library.', 'rentit' ),
					),
				),
			),

		),

	) );
	//Testimonials full
	vc_map( array(
		"name" => esc_html__( "Rent It Testimonials full block v2", 'rentit' ),
		"base" => "rentit_testimonials_v2",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'js_view' => 'RentitVcTeamView',
		'custom_markup' => '{{title}}<div class="vc_btn3-container"><h4 class="team-name"></h4></div>',
		"params" => array(
			// add params same as with any other content element\\
			array(
				'type' => 'param_group',
				'holder' => 'div',
				'heading' => esc_html__( 'Other Contact Details', 'rentit' ),
				'param_name' => 'items',
				'params' => array(
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'Name', 'rentit' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Label cometns E.g. John Anthony Gibson ', 'rentit' )
					),
					array(
						'type' => 'textfield',
						'holder' => 'div',
						'heading' => esc_html__( 'testimonial position', 'rentit' ),
						'param_name' => 'position',
						'description' => esc_html__( 'Co- founder at Rent It', 'rentit' )
					),
					array(
						'type' => 'textarea',
						'holder' => 'div',
						'heading' => esc_html__( 'Comment', 'rentit' ),
						'param_name' => 'des',
						'description' => esc_html__( 'Comment', 'rentit' )
					),

					array(
						'type' => 'attach_image',
						"holder" => "img",
						'heading' => esc_html__( 'Images Avatar', 'rentit' ),
						'param_name' => 'img_src',
						'value' => '',
						'description' => esc_html__( 'Select images from media library.', 'rentit' ),
					),
				),
			),

		),

	) );

	//rentit_Rental_Offers
	vc_map( array(
		"name" => esc_html__( "Our awesome Rental Fleet cars", 'rentit' ),
		"base" => "rentit_Rental_Fleet_cars",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Small headline", 'rentit' ),
				"param_name" => "h_s",
				"value" => esc_html__( 'Select What You Want', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'insert number to select cats', 'rentit' ),
				"param_name" => "s1",
				"value" => 1,
				"description" => esc_html__( "insert number example 1", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'insert number to select left isms', 'rentit' ),
				"param_name" => "s2",
				"value" => 1,
				"description" => esc_html__( "insert number example 3", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Big heading", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Our awesome Rental Fleet cars', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Group', 'rentit' ),
				'value' => array(
					esc_html__( 'Product cat', 'rentit' ) => 'product_cat',
					esc_html__( 'Product group', 'rentit' ) => 'product_group',

				),
				'param_name' => 'taxonomy'
			),

		),

	) );
	vc_map( array(
		"name" => esc_html__( "Statistics block", 'rentit' ),
		"base" => "rentit_statistics",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Small headline", 'rentit' ),
				"param_name" => "h_s",
				"value" => esc_html__( 'Select What You Want', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Big heading", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Our awesome Rental Fleet cars', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),


		),

	) );
	/*
     * statistics
     */
	vc_map( array(
		"name" => esc_html__( "Statistics block", 'rentit' ),
		"base" => "rentit_statistics",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Small headline", 'rentit' ),
				"param_name" => "h_s",
				"value" => esc_html__( 'Select What You Want', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Big heading", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Our awesome Rental Fleet cars', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),

			// param 1

			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "The icons 1 ", 'rentit' ),
				"param_name" => "fa_1",
				"value" => 'fa-heart',
				"description" => esc_html__( "insert icon", 'rentit' ),
				"settings" => array(
					"emptyIcon" => false,
					"iconsPerPage" => 4000,
				)
			),

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics number 1", 'rentit' ),
				"param_name" => "number_1",
				"value" => esc_html__( '5657', 'rentit' ),
				"description" => esc_html__( "insert numbers ", 'rentit' )
			),

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics title 1", 'rentit' ),
				"param_name" => "title_1",
				"value" => esc_html__( "Happy costumers", 'rentit' ),
				"description" => esc_html__( "insert text ", 'rentit' )
			),
			// param 2
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics title 2", 'rentit' ),
				"param_name" => "title_2",
				"value" => esc_html__( "Happy costumers", 'rentit' ),
				"description" => esc_html__( "insert text ", 'rentit' )
			),

			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "The icons 3 ", 'rentit' ),
				"param_name" => "fa_2",
				"value" => 'fa-car',
				"description" => esc_html__( "insert icon", 'rentit' ),
				"settings" => array(
					"emptyIcon" => false,
					"iconsPerPage" => 4000,
				)
			),

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics number 2", 'rentit' ),
				"param_name" => "number_2",
				"value" => esc_html__( '5657', 'rentit' ),
				"description" => esc_html__( "insert numbers ", 'rentit' )
			),


			// param 3
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics title 3", 'rentit' ),
				"param_name" => "title_3",
				"value" => esc_html__( "Total KM/MIL", 'rentit' ),
				"description" => esc_html__( "insert text ", 'rentit' )
			),

			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "The icons 3 ", 'rentit' ),
				"param_name" => "fa_3",
				"value" => 'fa-flag',
				"description" => esc_html__( "insert icon", 'rentit' ),
				"settings" => array(
					"emptyIcon" => false,
					"iconsPerPage" => 4000,
				)
			),


			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics number 3", 'rentit' ),
				"param_name" => "number_3",
				"value" => esc_html__( "1.255.657", 'rentit' ),
				"description" => esc_html__( "insert numbers ", 'rentit' )
			),

			// param 4
			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "The icons 4 ", 'rentit' ),
				"param_name" => "fa_4",
				"value" => 'fa fa-comments-o',
				"description" => esc_html__( "insert icon for example (fa-car)", 'rentit' ),
				"settings" => array(
					"emptyIcon" => false,
					"iconsPerPage" => 4000,
				)
			),


			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics number 4", 'rentit' ),
				"param_name" => "number_4",
				"value" => esc_html__( "1255", 'rentit' ),
				"description" => esc_html__( "insert numbers ", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Statistics number 4", 'rentit' ),
				"param_name" => "title_4",
				"value" => esc_html__( "Call Center Solutions", 'rentit' ),
				"description" => esc_html__( "insert text ", 'rentit' )
			),

		),

	) );


	/**
	 * rentit_find-car-map1
	 *
	 * */

	vc_map( array(
		"name" => esc_html__( "rentit section find car map", 'rentit' ),
		"base" => "rentit_find_car_map1",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'show_settings_on_create' => false,
		"params" => array(
			// add params same as with any other content element
			//Great Rental Cars
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Small headline", 'rentit' ),
				"param_name" => "h_s",
				"value" => esc_html__( "Great Rental Cars", 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			//FIND YOUR CAR
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Big headline", 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'FIND YOUR CAR', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			//Picking Up Locatio
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Picking Up Locatio", 'rentit' ),
				"param_name" => "pl",
				"value" => esc_html__( 'Picking Up Location', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			//Picking Up Date
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Picking Up Date', 'rentit' ),
				"param_name" => "pd",
				"value" => esc_html__( 'Picking Up Date', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			//Price Category
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Price Category', 'rentit' ),
				"param_name" => "pc",
				"value" => esc_html__( 'Price Category', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			//Find Car
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Find Car', 'rentit' ),
				"param_name" => "h",
				"value" => esc_html__( 'Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),


		),

	) );

	//section-title
	vc_map( array(
		"name" => esc_html__( "Section title", 'rentit' ),
		"base" => "rentit_section-title",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Small headline", 'rentit' ),
				"param_name" => "h_s",
				"value" => '',
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Big heading", 'rentit' ),
				"param_name" => "h",
				"value" => '',
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Text Align', 'rentit' ),
				'value' => array(
					esc_html__( 'Center', 'rentit' ) => 'center',
					esc_html__( 'Left', 'rentit' ) => 'left',
					esc_html__( 'Right', 'rentit' ) => 'right',
				),
				'param_name' => 'text_align'
			),


		),

	) );

	vc_map( array(
		'name' => esc_html__( 'rentit Accordion section', 'rentit' ),
		"base" => "rentit_accordion_section",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		'show_settings_on_create' => false,
		"params" => array(
			// add params same as with any other content element
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Widget title', 'rentit' ),
				'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'rentit' ),
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Enter description text", 'rentit' ),
				"param_name" => "content",
				"value" => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
				"description" => ''
			),


		),

	) );

	/**
	 * rentit_recent_blog_post
	 * */

	vc_map( array(
		'name' => esc_html__( 'Recent Blog Posts', 'rentit' ),
		"base" => "rentit_recent_blog_post",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		'show_settings_on_create' => false,
		"params" => array(
			// add params same as with any other content element
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Widget title', 'rentit' ),
				'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'rentit' ),
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Enter description text", 'rentit' ),
				"param_name" => "content",
				"value" => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
				"description" => ''
			),


		),

	) );

	/*
     * rentit_contact_form
     */

	ob_start();
	?>
	<p>
		<?php esc_html_e( " This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean
                sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum.", 'rentit' ); ?>
	</p>

	<ul class="media-list contact-list">
		<li class="media">
			<div class="media-left">[fa-home]</i></div>
			<div class="media-body">
				<?php esc_html_e( " Adress: 1600 Pennsylvania Ave NW, Washington, D.C.", 'rentit' ); ?>
			</div>
		</li>
		<li class="media">
			<div class="media-left"></div>
			<div class="media-body"><?php esc_html_e( "DC 20500, ABD", 'rentit' ); ?></div>
		</li>
		<li class="media">
			<div class="media-left">[fa-phone]</i></div>
			<div class="media-body"><?php esc_html_e( "Support Phone: 01865 339665", 'rentit' ); ?></div>
		</li>
		<li class="media">
			<div class="media-left">[fa-envelope]</div>
			<div class="media-body"><?php esc_html_e( "E mails: info@example.com", 'rentit' ); ?></div>
		</li>
		<li class="media">
			<div class="media-left">[fa-clock-o]</div>
			<div
				class="media-body"><?php esc_html_e( "Working Hours: 09:30-21:00 except on Sundays", 'rentit' ); ?></div>
		</li>
		<li class="media">
			<div class="media-left">[fa-map-marker]</div>
			<div class="media-body"><?php esc_html_e( "View on The Map", 'rentit' ); ?></div>
		</li>
	</ul>
	<?php
	$content = ob_get_clean();

	vc_map( array(
		'name' => esc_html__( 'Rent It contact form', 'rentit' ),
		"base" => "rentit_contact_form",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textarea_html",
				"class" => "",
				"heading" => esc_html__( "Enter html", 'rentit' ),
				"param_name" => "content",
				"value" => $content,
				"description" => ''
			),


		),

	) );

	vc_map( array(
		'name' => esc_html__( 'Rent It contact form', 'rentit' ),
		"base" => "rentit_contact_form",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Enter html", 'rentit' ),
				"param_name" => "content",
				"value" => $content,
				"description" => ''
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'show_subject',
				"heading" => esc_html__( "Show subject ?", 'rentit' ),
				'value' => array(
					esc_html__( 'Show subject', 'rentit' ) => '1',
					esc_html__( 'Hide subject', 'rentit' ) => '0',
				),
			)

		),

	) );
	///end rentit_contact_form

	vc_map( array(
		'name' => esc_html__( 'rentit Accordion', 'rentit' ),
		"base" => "rentit_accordion",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		'is_container' => true,
		'show_settings_on_create' => false,
		'as_parent' => array(
			'only' => 'rentit_accordion_section',
			'vc_row'

		),
		"category" => esc_html__( "Rent It", 'rentit' ),
		'description' => esc_html__( 'Collapsible content panels', 'rentit' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Widget title', 'rentit' ),
				'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'rentit' ),
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Enter description text", 'rentit' ),
				"param_name" => "content",
				"value" => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
				"description" => ''
			),
			array(
				'type' => 'dropdown',
				'param_name' => 'class',
				"heading" => esc_html__( "Select type accordion", 'rentit' ),
				'value' => array(
					esc_html__( 'half width', 'rentit' ) => 'col-md-6',
					esc_html__( 'full width', 'rentit' ) => '',
				),
			)

		),
		"js_view" => 'VcColumnView',


	) );

	/***
	 * conatainer
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It container", 'rentit' ),
		"base" => "rentit_conatainer",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		'is_container' => true,
		'show_settings_on_create' => false,
		"category" => esc_html__( "Rent It", 'rentit' ),
		'description' => esc_html__( 'Collapsible content panels', 'rentit' ),
		'params' => array(
			array(
				'type' => 'dropdown',
				'param_name' => 'class',
				'value' => array(
					esc_html__( 'Classic', 'rentit' ) => 'classic',
					esc_html__( 'parallax image', 'rentit' ) => 'image',
					esc_html__( 'dark', 'rentit' ) => 'dark',
					esc_html__( 'contact dark', 'rentit' ) => 'contact dark',


				),
				'heading' => esc_html__( 'display style ', 'rentit' ),
				'description' => esc_html__( 'Select display style.', 'rentit' ),


			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Css', 'rentit' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design options', 'rentit' ),
			),

		),
		"js_view" => 'VcColumnView',

	) );


	vc_map( array(
		'name' => esc_html__( 'rentit ROW', 'rentit' ),
		"base" => "rentit_row",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		'is_container' => true,
		'show_settings_on_create' => false,
		"category" => esc_html__( "Rent It", 'rentit' ),
		'description' => esc_html__( 'Collapsible content panels', 'rentit' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Widget title', 'rentit' ),
				'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'rentit' ),
			),

		),
		"js_view" => 'VcColumnView',

	) );


	/*
   * rentit_SUBSCRIBE_block
   */

	vc_map( array(
		'name' => esc_html__( 'SUBSCRIBE block', 'rentit' ),
		"base" => "rentit_SUBSCRIBE_block",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content element

			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => esc_html__( 'Content', 'rentit' ),
				'param_name' => 'content',
				'value' => esc_html__( "This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit
                auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum,
                nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet
                mauris.", 'textdomain' )
			),
			array(
				'type' => 'textfield',
				'param_name' => 'b_t',
				'heading' => esc_html__( 'button text', 'rentit' ),
				'description' => esc_html__( 'Enter text used as button', 'rentit' ),
			),

		),

	) );

	/*
 * rentit_COSTUMER_SERVICE_block
 */

	ob_start();
	?>
	<h4 class="caption-title">
		<?php esc_html_e( 'Kelly Doe Surname', 'rentit' ); ?>
		<small>
			<?php esc_html_e( 'Costumer Service', 'rentit' ); ?>
		</small>
	</h4>
	<ul class="team-details">
		<li> <?php esc_html_e( 'Skype: team.member', 'rentit' ); ?>
		</li>
		<li>
			<?php esc_html_e( 'Tel: 555 555-5555', 'rentit' ); ?>
		</li>
		<li><a href="mailto:supportname@gmail.com">
				<?php esc_html_e( ' supportname@gmail.com', 'rentit' ); ?>

			</a>
		</li>
	</ul>
	<?php
	$value = ob_get_clean();
	vc_map( array(
		'name' => esc_html__( 'Rent It COSTUMER SERVICE', 'rentit' ),
		"base" => "rentit_COSTUMER_SERVICE_block",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content element
			array(
				'type' => 'attach_image',
				"holder" => "img",
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'img_src',
				'value' => '',
				'description' => esc_html__( 'Select images from media library.', 'rentit' ),
			),

			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => esc_html__( 'Content', 'rentit' ),
				'param_name' => 'content',
				'value' => $value
			),


		),

	) );


	//on gma

	vc_map( array(
		'name' => esc_html__( 'Rent It on gma', 'rentit' ),
		"base" => "rentit_on_gmap",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => false,
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content element


			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text of search", 'rentit' ),
				"param_name" => "st",
				"value" => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button", 'rentit' ),
				"param_name" => "tb",
				"value" => esc_html__( ' Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),


		),

	) );


	//on gma

	vc_map( array(
		'name' => esc_html__( 'Rent It on gma', 'rentit' ),
		"base" => "rentit_contact_us",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => false,
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text of search", 'rentit' ),
				"param_name" => "st",
				"value" => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text button", 'rentit' ),
				"param_name" => "tb",
				"value" => esc_html__( ' Find Car', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),


		),

	) );

	//Rent It contact us

	vc_map( array(
		'name' => esc_html__( 'Rent It contact us', 'rentit' ),
		"base" => "rentit_contact_us",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content

			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text left", 'rentit' ),
				"param_name" => "h1",
				"value" => esc_html__( 'Contact Us', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text right", 'rentit' ),
				"param_name" => "h2",
				"value" => esc_html__( 'Contact Form', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),


		),
		"js_view" => 'VcColumnView'

	) );


	vc_map( array(
		'name' => esc_html__( 'Rent It contact us media', 'rentit' ),
		"base" => "rentit_contact_us_media",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => false,
		'show_settings_on_create' => true,
		"params" => array(
			// add params same as with any other content
			// param 4
			array(
				"type" => "iconpicker",
				"heading" => esc_html__( "The icon ", 'rentit' ),
				"param_name" => "icon",
				"value" => '',
				"description" => esc_html__( "insert icon ", 'rentit' ),
				"settings" => array(
					"emptyIcon" => false,
					"iconsPerPage" => 4000,
				)
			),
			array(
				"type" => "checkbox",
				"heading" => esc_html__( "Show icon?", 'rentit' ),
				"param_name" => "s_icon",
				"value" => array( 'Yes' => 1 ),
				"description" => esc_html__( "", 'rentit' ),

			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Description", 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert description", 'rentit' )

			),

		),


	) );


	vc_map( array(
		'name' => esc_html__( 'Rent It map v2', 'rentit' ),
		"base" => "rentit_find_car_map1_v2",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => true,
		'show_settings_on_create' => true,
		"params" => array(// add params same as with any other content


		),

	) );

	/**
	 * rentit text center lead
	 */
	vc_map( array(
		'name' => esc_html__( 'Rent It text center lead', 'rentit' ),
		"base" => "rentit_text_center_lead",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => false,
		'show_settings_on_create' => true,
		"params" => array(
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Description", 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert description", 'rentit' )

			),

		),


	) );
	/**
	 * rentit text center lead
	 */
	vc_map( array(
		'name' => esc_html__( 'Rent It text center lead', 'rentit' ),
		"base" => "rentit_text_center_lead",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => false,
		'show_settings_on_create' => true,
		"params" => array(
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Description", 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert description", 'rentit' )

			),

		),


	) );

	/**
	 * rentit text center lead
	 */
	vc_map( array(
		'name' => esc_html__( 'Rent It page divider', 'rentit' ),
		"base" => "rentit_page_divider",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'is_container' => false,
		'show_settings_on_create' => false,
		"params" => array(),


	) );

	/**
	 * rentit text center lead
	 */
	vc_map( array(
		'name' => esc_html__( 'Rent It standard button', 'rentit' ),
		"base" => "rentit_button_standart",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		"params" => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Insert url ', 'rentit' ),
				'param_name' => 'url',
				'description' => esc_html__( 'insert url', 'rentit' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Text button', 'rentit' ),
				'param_name' => 'text',
				'description' => esc_html__( 'Insert text', 'rentit' )
			),

		),


	) );
	/**
	 * Rent It Iconic Info Box
	 */
	vc_map( array(
		'name' => esc_html__( 'Rent It Iconic Info Box', 'rentit' ),
		'base' => 'rentit_vc_iconic_box',
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It", 'rentit' ),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'rentit' ),
				'value' => array(
					esc_html__( 'Font Awesome', 'rentit' ) => 'fontawesome',
					esc_html__( 'Open Iconic', 'rentit' ) => 'openiconic',
					esc_html__( 'Typicons', 'rentit' ) => 'typicons',
					esc_html__( 'Entypo', 'rentit' ) => 'entypo',
					esc_html__( 'Linecons', 'rentit' ) => 'linecons',
				),
				'admin_label' => true,
				'param_name' => 'type',
				'description' => esc_html__( 'Select icon library.', 'rentit' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'rentit' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'rentit' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'rentit' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'openiconic',
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'openiconic',
				),
				'description' => esc_html__( 'Select icon from library.', 'rentit' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'rentit' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'typicons',
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'typicons',
				),
				'description' => esc_html__( 'Select icon from library.', 'rentit' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'rentit' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'entypo',
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'rentit' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'linecons',
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'linecons',
				),
				'description' => esc_html__( 'Select icon from library.', 'rentit' ),
			),
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Title', 'rentit' ),
				'param_name' => 'title',
				'value' => esc_html__( '', 'rentit' )
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'class' => '',
				'heading' => esc_html__( 'Content', 'rentit' ),
				'param_name' => 'box_content',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Css', 'rentit' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design options', 'rentit' ),
			)
		),
	) );
	/**
	 * END Rent It Iconic Info Box
	 */
	vc_map( array(
		'name' => esc_html__( 'Rent It Image Carousel', 'rentit' ),
		'base' => 'rentit_vc_carousel',
		'category' => esc_html__( 'Rent It', 'rentit' ),
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		'description' => esc_html__( 'Animated carousel with images', 'rentit' ),
		'params' => array(
			array(
				'type' => 'attach_images',
				'heading' => esc_html__( 'Images', 'rentit' ),
				'param_name' => 'images',
				'description' => esc_html__( 'Select images from media library.', 'rentit' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Size', 'rentit' ),
				'param_name' => 'size',
				'description' => esc_html__( 'e.g. fullsize', 'rentit' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Item', 'rentit' ),
				'param_name' => 'item',
				'description' => esc_html__( 'The number of items you want to see on the screen.', 'rentit' )
			),
			array(
				'type' => 'el_id',
				'holder' => 'h3',
				'class' => '',
				'heading' => esc_html__( 'Class', 'rentit' ),
				'param_name' => 'class',
				'settings' => array(
					'auto_generate' => true,
				),
				'description' => esc_html__( 'Enter unique class.', 'rentit' )
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Css', 'rentit' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design options', 'rentit' ),
			),
		)
	) );
//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_rentit_page_section_slider extends WPBakeryShortCodesContainer {
		}

		class WPBakeryShortCode_rentit_one_page_section extends WPBakeryShortCodesContainer {
		}
	}


	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_rentit_contact_us extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_rentit_accordion extends WPBakeryShortCodesContainer {
		}
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_rentit_row extends WPBakeryShortCodesContainer {
		}
	}

	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_rentit_present_block extends WPBakeryShortCodesContainer {
		}
	}

	/******************************************************************************
	 *  Wiget
	 */


	vc_map( array(
		"name" => esc_html__( "Rent It search widget", 'rentit' ),
		"base" => "rentit_search",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),
		"show_settings_on_create" => false,
		"params" => array(// add params same as with any other content element


		),

	) );


	vc_map( array(
		"name" => esc_html__( "Rent It CATEGORIES widget", 'rentit' ),
		"base" => "rentit_CATEGORIES_Wigdet",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'Categories', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),

		),

	) );


	vc_map( array(
		"name" => esc_html__( "Rent It twiter widget", 'rentit' ),
		"base" => "rentit_twiter_Wigdet",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'TWITTER', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Name', 'rentit' ),
				"param_name" => "Name",
				"value" => '',
				"description" => esc_html__( "insert Name user", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'how shows twits?', 'rentit' ),
				"param_name" => "text",
				"value" => '',
				"description" => esc_html__( "insert number example 3", 'rentit' )
			),


		),

	) );

	/**********************************************
	 * rentit_ARCHIVES_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It ARCHIVES widget", 'rentit' ),
		"base" => "rentit_ARCHIVES_Wigdet_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'ARCHIVES', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'how shows?', 'rentit' ),
				"param_name" => "text",
				"value" => '20',
				"description" => esc_html__( "insert number example 20", 'rentit' )
			),


		),

	) );


	/**********************************************
	 * rentit_ARCHIVES_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It HELPING_CENTER widget", 'rentit' ),
		"base" => "rentit_HELPING_CENTER_Wigdet_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( ' HELPING CENTER', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'text', 'rentit' ),
				"param_name" => "text",
				"value" => esc_html__( 'Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.', 'rentit' ),
				"description" => esc_html__( "insert number example 20", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'phone number', 'rentit' ),
				"param_name" => "phone_number",
				"value" => '+90 555 444 66 33',
				"description" => esc_html__( "insert number", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'email', 'rentit' ),
				"param_name" => "email",
				"value" => '\'support@supportcenter.com,',
				"description" => esc_html__( "insert email", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'url', 'rentit' ),
				"param_name" => "url",
				"value" => '#',
				"description" => esc_html__( "insert url", 'rentit' )
			),
		),

	) );

	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It TESTIMONIALS widget", 'rentit' ),
		"base" => "rentit_TESTIMONIALS_Wigdet_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'TESTIMONIALS', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'How show testimonials?', 'rentit' ),
				"param_name" => "number",
				"value" => 3,
				"description" => esc_html__( 'insert number', 'rentit' )
			),
		),

	) );


	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It TAGS widget", 'rentit' ),
		"base" => "rentit_TAG_Wigdet_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'TAGS', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select type tag', 'rentit' ),
				'value' => array(
					esc_html__( 'Post tags', 'rentit' ) => '0',
					esc_html__( 'Product tags', 'rentit' ) => '1',

				),
				'param_name' => 'type_tag'
			),
		),

	) );
	/*
        * rentit_TESTIMONIALS_Wigdet_class
    */
	vc_map( array(
		"name" => esc_html__( "Rent It ITEM TAGS widget", 'rentit' ),
		"base" => "rentit_ITEM_TAGS_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'ITEM TAGS', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),

		),

	) );

	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It Flickr Images widget", 'rentit' ),
		"base" => "rentit_Flickr_Images_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'FLICKR IMAGES', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'How show images', 'rentit' ),
				"param_name" => "number",
				"value" => 9,
				"description" => esc_html__( "insert numbers max 12", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'How show images', 'rentit' ),
				"param_name" => "fliker_id",
				"value" => '71865026@N009',
				"description" => esc_html__( "insert fliker id", 'rentit' )
			),
		),

	) );

	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It Flickr Images widget", 'rentit' ),
		"base" => "rentit_Flickr_Images_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'FLICKR IMAGES', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'How show images', 'rentit' ),
				"param_name" => "number",
				"value" => 9,
				"description" => esc_html__( "insert numbers max 12", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'How show images', 'rentit' ),
				"param_name" => "number",
				"value" => '71865026@N009',
				"description" => esc_html__( "insert fliker id", 'rentit' )
			),
		),

	) );

	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It ABOUT_US widget", 'rentit' ),
		"base" => "rentit_ABOUT_US_Wigdet_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'FLICKR IMAGES', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Show social icon', 'rentit' ),
				'value' => array(
					esc_html__( 'Yes', 'rentit' ) => 'on',
					esc_html__( 'No', 'rentit' ) => 'off',

				),
				'param_name' => 'social'
			),

			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Text', 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert text", 'rentit' )
			),
		),

	) );

	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	$menus = wp_get_nav_menus();
	$arr_all_menu = array(
		'---' => ''
	);
	foreach ( $menus as $menu ) :
		$arr_all_menu[esc_attr( $menu->name )] = esc_html( $menu->term_id );
	endforeach;


	vc_map( array(
		"name" => esc_html__( "Rent It menu  widget", 'rentit' ),
		"base" => "rentit_menu_Wigdet_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Insert title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'INFORMATION', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'select menu to display', 'rentit' ),
				'value' => $arr_all_menu,
				'param_name' => 'nav_menu'
			),

		),

	) );
	unset( $arr_all_menu );

	/**********************************************
	 * rentit_TESTIMONIALS_Wigdet_class
	 */
	vc_map( array(
		"name" => esc_html__( "Rent It NEWS LETTER widget", 'rentit' ),
		"base" => "rentit_NEWS_LETTER_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),

		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'NEWS LETTER', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'text button', 'rentit' ),
				"param_name" => "number",
				"value" => '',
				"description" => esc_html__( "insert text_button", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'placeholder text', 'rentit' ),
				"param_name" => "placeholder",
				"value" => '',
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Text', 'rentit' ),
				"param_name" => "content",
				"value" => '',
				"description" => esc_html__( "insert text", 'rentit' )
			),
		),

	) );

	/*
        * rentit_TESTIMONIALS_Wigdet_class
    */
	vc_map( array(
		"name" => esc_html__( "Rent It PRICE FILTER widget", 'rentit' ),
		"base" => "rentit_PRICE_FILTER_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'PRICE', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'text button', 'rentit' ),
				"param_name" => "text_button",
				"value" => esc_html__( 'Filter', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
		),

	) );
	/*
    * rentit_TESTIMONIALS_Wigdet_class
*/
	vc_map( array(
		"name" => esc_html__( "Rent It DETAIL RESERVATION widget", 'rentit' ),
		"base" => "rentit_DETAIL_RESERVATION_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'DETAIL RESERVATION', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),

		),

	) );

	/*
      * rentit_TESTIMONIALS_Wigdet_class
  */
	vc_map( array(
		"name" => esc_html__( "Rent It Car tab widget", 'rentit' ),
		"base" => "rentit_Car_tab_class",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'text button', 'rentit' ),
				"param_name" => "text_button",
				"value" => esc_html__( 'View More', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'How show product', 'rentit' ),
				"param_name" => "max",
				"value" => 3,
				"description" => esc_html__( "insert  number", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'url to more button', 'rentit' ),
				"param_name" => "more_url",
				"value" => '#',
				"description" => esc_html__( "insert url", 'rentit' )
			),
		),

	) );

	/*
  * rentit_TESTIMONIALS_Wigdet_class
*/
	vc_map( array(
		"name" => esc_html__( "Rent Tabbed Post widget", 'rentit' ),
		"base" => "rentit_Widget_Tabbed_Post",
		"class" => "",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Title', 'rentit' ),
				"param_name" => "title",
				"value" => esc_html__( 'Title', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Recent Posts title', 'rentit' ),
				"param_name" => "recent_posts_title",
				"value" => esc_html__( 'Recent Posts', 'rentit' ),
				"description" => esc_html__( "insert  text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Recent Posts Limit', 'rentit' ),
				"param_name" => "recent_posts_limit",
				"value" => 5,
				"description" => esc_html__( "insert number", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Popular Posts title', 'rentit' ),
				"param_name" => "popular_posts_title",
				"value" => esc_html__( 'Popular Posts', 'rentit' ),
				"description" => esc_html__( "insert text", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'Popular Posts Limit', 'rentit' ),
				"param_name" => "popular_posts_limit",
				"value" => 5,
				"description" => esc_html__( "insert number", 'rentit' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( 'url to all post', 'rentit' ),
				"param_name" => "url",
				"value" => '#',
				"description" => esc_html__( "insert url", 'rentit' )
			),
		),

	) );

	vc_map( array(
		"name" => esc_html__( "Rent It wiget sidebar", 'rentit' ),
		"base" => "rentit_wiget_sidebar",
		"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
		'is_container' => true,
		'show_settings_on_create' => false,
		"category" => esc_html__( "Rent It Widgets", 'rentit' ),
		'description' => esc_html__( 'Collapsible content panels', 'rentit' ),
		'params' => array(
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Css', 'rentit' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design options', 'rentit' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select class', 'rentit' ),
				'value' => array(
					esc_html__( 'col-md-3', 'rentit' ) => '3',
					esc_html__( 'col-md-3', 'rentit' ) => '1',
					esc_html__( 'col-md-3', 'rentit' ) => '2',
					esc_html__( 'col-md-4', 'rentit' ) => '4',
					esc_html__( 'col-md-5', 'rentit' ) => '5',
					esc_html__( 'col-md-6', 'rentit' ) => '6',
					esc_html__( 'col-md-7', 'rentit' ) => '7',
					esc_html__( 'col-md-8', 'rentit' ) => '8',
					esc_html__( 'col-md-9', 'rentit' ) => '9',
					esc_html__( 'col-md-10', 'rentit' ) => '10',
					esc_html__( 'col-md-11', 'rentit' ) => '11',
					esc_html__( 'col-md-12', 'rentit' ) => '12',

				),
				'param_name' => 'class'
			),

		),
		"js_view" => 'VcColumnView',

	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_rentit_wiget_sidebar extends WPBakeryShortCodesContainer {
		}
	}
}

/**
 *  rentit_one_page_section
 */
vc_map( array(
	"name" => esc_html__( "Rent It one page section", 'rentit' ),
	"base" => "rentit_one_page_section",
	"icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
	'is_container' => true,
	'show_settings_on_create' => false,
	"category" => esc_html__( "Rent It", 'rentit' ),
	'description' => esc_html__( 'Collapsible content panels', 'rentit' ),
	'params' => array(
		array(
			'type' => 'el_id',
			'holder' => 'h3',
			'class' => '',
			'heading' => esc_html__( 'Enter unique id', 'rentit' ),
			'param_name' => 'id',
			'settings' => array(
				'auto_generate' => true,
			),
			'description' => esc_html__( 'Enter unique id', 'rentit' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__( 'Title section', 'rentit' ),
			"param_name" => "title",
			"value" => '',
			"description" => esc_html__( "insert text", 'rentit' )
		),

		array(
			"type" => "checkbox",
			"heading" => esc_html__( 'showing the right menu?', 'rentit' ),
			"param_name" => 'right_s',
			"value" => array( 'yes' => 1 ),
			"description" => esc_html__( "", 'rentit' ),

		),

	),
	"js_view" => 'VcColumnView',

) );
