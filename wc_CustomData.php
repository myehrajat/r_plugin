<?php

/*
 *  To add custom data above add to cart button in woocommerce
 *
 */

/// step 1


function rentit_get_season_price_by_custom_day( $product_id, $date ) {
	$season_date = get_post_meta( $product_id, '_rental_season_date', true );


	if ( $season_date ) {
		$paymentDate = strtotime( date( 'm/d/Y', $date ) );
		foreach ( $season_date as $key => $date ) {


			$contractDateBegin = strtotime( date( 'm/d', strtotime( $date['start_date'] ) ) );
			$contractDateEnd = strtotime( date( 'm/d', strtotime( $date['end_date'] ) ) );


			if ( $paymentDate >= $contractDateBegin && $paymentDate <= $contractDateEnd ) {


				return $date['price'];
			}


		}
	}
	return false;

}


add_action( 'init', 'rentit_add_user_custom_data_options_callback' );

if ( !function_exists( 'rentit_get_season_price_by_between_two_days' ) ) {
	function rentit_get_season_price_by_between_two_days( $product_id, $star_date, $end_date ) {
		$season_date = get_post_meta( $product_id, '_rental_season_date', true );


		$days = rentit_DateDiff( 'd', strtotime( $star_date ), strtotime( $end_date ) );
		$hour = rentit_DateDiff( 'h', strtotime( $star_date ), strtotime( $end_date ) );


		if ( $days < 1 ) {
			$days = 1;
		}

		$star_date = strtotime( $star_date );
		if ( $season_date ) {
			foreach ( $season_date as $key => $date ) {

				$contractDateBegin = strtotime( $date['start_date'] );
				$contractDateEnd = strtotime( $date['end_date'] );

				if ( ( $star_date > $contractDateBegin && $star_date < $contractDateEnd ) && $end_date < $contractDateEnd ) {


					$rental_season_discount = $date['rental_season_discount'];


					$arr_day = array();
					$arr_hour = array();
					if ( $rental_season_discount ) {

						for ( $i = 0; $i < count( $rental_season_discount['cost'] ); $i ++ ) {


							if ( isset( $rental_season_discount['duration_type'][$i] ) && $rental_season_discount['duration_type'][$i] == 'days' ) {
								if ( !empty( $rental_season_discount['cost'][$i] ) ) {

									$arr_day[$rental_season_discount['duration_val'][$i]] = array(
										'cost' => $rental_season_discount['cost'][$i],

									);
								}
							}

							if ( isset( $rental_season_discount['duration_type'][$i] ) && $rental_season_discount['duration_type'][$i] == 'hours' ) {
								if ( !empty( $rental_season_discount['cost'][$i] ) ) {

									$arr_hour[$rental_season_discount['duration_val'][$i]] = array(
										'cost' => $rental_season_discount['cost'][$i],

									);
								}
							}


						}



						krsort( $arr_day );
						krsort( $arr_hour );
						$price = null;
						//determine the largest number to the specified



						foreach ( $arr_day as $k => $price_disc ) {

							if ( $days >= $k ) {
								$price = $price_disc['cost'] * $days;

								break;
							}

						}

						if ( $arr_hour && $hour < 24 ) {

							///determine the largest number to the specified
							foreach ( $arr_hour as $k => $price_disc ) {
								if ( $hour >= $k ) {
									$price = $price_disc['cost'] * $hour;
									break;
								}

							}
						}

					}


					if ( isset( $price ) && !empty( $price ) ) {
						return $price;
					}
					return $date['price'] * $days;
				}


			}
		}
		return false;

	}
}

function rentit_get_two_season_price_by_between_two_days( $product_id, $star_date, $end_date ) {
	$season_date = get_post_meta( $product_id, '_rental_season_date', true );


	$days = rentit_DateDiff( 'd', strtotime( $star_date ), strtotime( $end_date ) );
	$hour = rentit_DateDiff( 'h', strtotime( $star_date ), strtotime( $end_date ) );
	var_dump($star_date);
	var_dump($end_date);

	if ( $days < 1 ) {
		$days = 1;
	}

	$star_date = strtotime( $star_date );
	$end_date = strtotime( $end_date );
	if ( $season_date ) {
		foreach ( $season_date as $key => $date ) {
			var_dump($date);
			if(!isset($date['start_date']{1}) || !isset($date['end_date']{1}) ) continue;


			$contractDateBegin = strtotime( $date['start_date'] );
			$contractDateEnd = strtotime( $date['end_date'] );


			if ( ( $star_date > $contractDateBegin && $star_date < $contractDateEnd ) && $end_date < $contractDateEnd ) {


//				var_dump($date);
			}
			if ( ( $end_date > $contractDateBegin && $end_date < $contractDateEnd )  ) {


				echo '22222222222222222';
				var_dump($date);
			}
			var_dump($end_date);
			var_dump($contractDateBegin);
//			echo '111111111111111111';
//			var_dump($end_date);

		}
	}
	return false;

}

/*
 *
 *
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);*/
function rentit_add_user_custom_data_options_callback() {
	//if the product does not add to cart return

	if ( !isset( $_POST['add-to-cart'] ) ) {
		return;
	}
	/*var_dump($_POST);
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);*/

	//product price
	$price = 0;

	//get product id
	//get product id
	$product_id = isset( $_POST['add-to-cart'] ) ? absint( $_POST['add-to-cart'] ) : '';
	$enable_Car_seles = get_post_meta( $product_id, '_rentit_disable_rent', 1 );


	//array product


	$array = array(
		'regular_price' => esc_html( rentit_get_current_price_product( $product_id ) ),
		'extras' => array(),
		'gender' => isset( $_POST['gender'] ) ? wc_clean( $_POST['gender'] ) : '',
		'name' => isset( $_POST['name'] ) ? wc_clean( $_POST['name'] ) : '',
		'email' => isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '',
		'phone' => isset( $_POST['phone'] ) ? wc_clean( $POST['phone'] ) : '',
		'cell_phone' => isset( $_POST['cell_phone'] ) ? wc_clean( $_POST['cell_phone'] ) : '',
		'payment_method' => isset( $_POST['get_payment_method'] ) ? wc_clean( $_POST['get_payment_method'] ) : '',
		'additional_info' => isset( $_POST['additional_info'] ) ? wc_clean( $_POST['additional_info'] ) : '',
		'dropin_location' => isset( $_POST['dropin_location'] ) ? wc_clean( $_POST['dropin_location'] ) : '',
		'dropin_date' => isset( $_POST['dropin_date'] ) ? wc_clean( $_POST['dropin_date'] ) : '',
		'dropin_time' => isset( $_POST['dropin_time'] ) ? wc_clean( $_POST['dropin_time'] ) : '',
		'dropoff_location' => isset( $_POST['dropoff_location'] ) ? wc_clean( $_POST['dropoff_location'] ) : '',
		'dropoff_date' => isset( $_POST['dropoff_date'] ) ? wc_clean( $_POST['dropoff_date'] ) : '',
		'dropoff_time' => isset( $_POST['dropoff_time'] ) ? wc_clean( $_POST['dropoff_time'] ) : '',
	);


	//departure date
	$dropin_date = isset( $_POST['dropin_date'] ) ? sanitize_text_field( $_POST['dropin_date'] ) : '';

	//the date of return of the car
	$dropoff_date = isset( $_POST['dropoff_date'] ) ? sanitize_text_field( $_POST['dropoff_date'] ) : '';

	//get unix time
	$dropoff_int = strtotime( $dropoff_date );
	$dropin_int = strtotime( $dropin_date );
	$mont = date( 'n', $dropoff_int );

	//dates
	$days = rentit_DateDiff( 'd', $dropin_int, $dropoff_int );
	$hour = rentit_DateDiff( 'h', $dropin_int, $dropoff_int );


	if ( $days < 1 ) {
		$days = 1;
	}


	//var_dump( rentit_get_season_price_by_between_two_days( $product_id, $dropin_date, $dropoff_date ) );
	$Season_price = get_post_meta( $product_id, "_base_cost_" . renit_getSeason_reserve_2( date( 'n', $dropoff_int ) ), true );

	/**
	 *
	 *//**
	 *
	 */
	if ( rentit_get_season_price_by_between_two_days( $product_id, $dropin_date, $dropoff_date ) ) {
	 $price = rentit_get_season_price_by_between_two_days( $product_id, $dropin_date, $dropoff_date );
		//rentit_get_two_season_price_by_between_two_days($product_id, $dropin_date, $dropoff_date);
	 //echo '1111111111111111111111111';

		/*$new_price_by_each_day = 0;
		$next_monday = $dropin_int;
		$num_days = ceil( $dropoff_int - $dropin_int ) / ( 60 * 60 * 24 );


		for ( $i = 0; $i < $num_days; $i ++ ) {


			$next_day = strtotime( "+" . $i . " day", $next_monday );

				if ( rentit_get_season_price_by_custom_day( $product_id, $next_day ) ) {
					$new_price_by_each_day += rentit_get_season_price_by_custom_day( $product_id, $next_day );

				} else {
					$new_price_by_each_day += rentit_get_current_price_product( $product_id, false );

				}


		}


		$price = $new_price_by_each_day;*/





	} elseif ( isset( $Season_price{0} ) && !empty( $Season_price ) ) {
		//echo '22222222222222222222222';
		$price = $Season_price * $days;;

	} else {

	//	echo '3333333333333333333333333333';

		//$price = esc_html( rentit_get_current_price_product( $product_id, false ) ) * $days;


		/*
		 * calculate price by each day
		 */
		$new_price_by_each_day = 0;
		$next_monday = $dropin_int;
		$num_days = ceil( $dropoff_int - $dropin_int ) / ( 60 * 60 * 24 );

		$rentit_weekend_price = get_post_meta( $product_id, '_rentit_weekend_price', true );


		for ( $i = 0; $i < $num_days; $i ++ ) {


			$next_day = strtotime( "+" . $i . " day", $next_monday );
			/*rentit_get_season_price_by_custom_day( $product_id, $next_day ));
			echo '<br>';*/
			if ( (int) $rentit_weekend_price > 0 && ( date( 'N', $next_day ) == 6 || date( 'N', $next_day ) == 7 ) ) {
				$new_price_by_each_day += $rentit_weekend_price;


			} else {
				if ( rentit_get_season_price_by_custom_day( $product_id, $next_day ) ) {
					$new_price_by_each_day += rentit_get_season_price_by_custom_day( $product_id, $next_day );

				} else {
					$new_price_by_each_day += rentit_get_current_price_product( $product_id, false );

				}
			}
			//date_i18n( "m/d/Y H:m", $next_day ));
		}


		$price = $new_price_by_each_day;
	}


	if ( $enable_Car_seles ) {
		$price = rentit_get_current_price_product( $product_id, false );
	}

	/****
	 *
	 */

	//var_dump($price);
//	die();

	//////////////////////////
	$arr_hour = array();
	$arr_day = array();
	$resources = get_post_meta( $product_id, '_rental_discounts', true );


	if ( $resources ) {
		foreach ( $resources as $key => $discounts ) {
			// var_dump($discounts);
			if ( $discounts['duration_type'] == 'days' ) {
				if ( !empty( $discounts['cost'] ) ) {
					$arr_day[$discounts['duration_val']] = array(
						'cost' => $discounts['cost'],

					);
				}
			}
			if ( $discounts['duration_type'] == 'hours' ) {
				if ( !empty( $discounts['cost'] ) ) {
					$arr_hour[$discounts['duration_val']] = array(
						'cost' => $discounts['cost'],

					);
				}
			}


		}


		// short to heaght deay
		krsort( $arr_day );
		krsort( $arr_hour );

		//determine the largest number to the specified
		//var_dump($arr_day);

		foreach ( $arr_day as $key => $price_disc ) {
			if ( $days >= $key ) {
				$price = $price_disc['cost'] * $days;
				break;
			}

		}

		if ( $arr_hour && $hour < 24 ) {

			///determine the largest number to the specified
			foreach ( $arr_hour as $key => $price_disc ) {
				if ( $hour >= $key ) {
					$price = $price_disc['cost'] * $hour;
					break;
				}

			}
		}
		if ( rentit_get_season_price_by_between_two_days( $product_id, $dropin_date, $dropoff_date ) ) {
			$price = rentit_get_season_price_by_between_two_days( $product_id, $dropin_date, $dropoff_date );
		}
	}


	$name = esc_html__( 'Day(s)', 'rentit' );
	$value = $days;

	if ( isset( $arr_hour ) && $arr_hour && $hour < 24 ) {
		$name = esc_html__( 'Hour(s)', 'rentit' );
		$value = $hour;
	}
	$array['extras'][] = array(
		'value' => $value,
		'name' => $name,
		'price' => 0,
		"duration_type" => 0

	);


	//var_dump($_POST);
	/*
	 * Additional services
	 */
	if ( isset( $_POST['checkbox_extras'] ) ) {

		$arr_resources = ( get_post_meta( $product_id, '_rental_resources', true ) );

		//Climb services
		$arr_extras = array();
		foreach ( $arr_resources as $item ) {


//var_dump($item);
			$val = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . $item["duration_type"];
			$checked = false;
			if ( $item["cost"] == '0' || empty( $item["cost"] ) ) {
				$val = esc_html__( 'Free', 'rentit' );

			}

			if ( $item["duration_type"] == 'total' ) {
				$val = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) . ' / ' . esc_html__( 'Total', 'rentit' );

			}
			if ( $item["duration_type"] == 'Included' ) {
				$val = esc_html__( 'Included', 'rentit' );

			}

			if ( $item["duration_type"] == 'fixed_change' ) {
				$val = $item["cost"] . " " . get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) );
			}

			$arr_extras[] = array(
				'value' => $val,
				'name' => esc_html( $item["item_name"] ),
				'price' => esc_attr( $item["cost"] ),
				"duration_type" => esc_attr( $item["duration_type"] )

			);


		}
//var_dump($_POST['checkbox_extras']);
		//this is checked extras
		foreach ( $_POST['checkbox_extras'] as $k => $v ) {
			$array['extras'][] = $arr_extras[$k];

			//if the service on days when multiplied by the days
			if ( $arr_extras[$k]["duration_type"] == "days" ) {
				$price += ( $arr_extras[$k]["price"] * (int) $days );
			}
			if ( $arr_extras[$k]["duration_type"] == "hours" ) {
				$price += ( (float) $arr_extras[$k]["price"] * $hour );
			}
			if ( $arr_extras[$k]["duration_type"] == "total" ) {
				$price += $arr_extras[$k]["price"];
			}
			if ( $arr_extras[$k]["duration_type"] == "fixed_change" ) {
				$price += $arr_extras[$k]["price"];
			}

			//var_dump($arr_extras[$k]["duration_type"]);


		}

	}


	$charge_locations = get_post_meta( $product_id, '_rental_charge_locations', true );

	$charge_price = 0;
	$array['location_charge'] = esc_html__( 'Free', 'rentit' );

	if ( isset( $charge_locations ) && is_array( $charge_locations ) ) {
		$i = 0;
		foreach ( $charge_locations as $charge_location ) {

			// we have two locations
			if ( isset( $charge_location['drop-off'] ) && isset( $charge_location['drop-in'] )

			     && in_array( $_POST['dropin_location'], $charge_location['drop-in'] )
			     && in_array( $_POST['dropoff_location'], $charge_location['drop-off'] )
			) {

				if ( isset( $charge_location['days'][0] ) && $charge_location['days'][0] > $days ) {

					$charge_price += $charge_location['cost'][0];
					$array['location_charge'] = + $charge_location['cost'][0];

				} elseif ( empty( $charge_location['days'][0]{1} ) ) {
					$charge_price += $charge_location['cost'][0];
					$array['location_charge'] = + $charge_location['cost'][0];

				}
			} elseif ( isset( $charge_location['drop-in'] ) && in_array( $_POST['dropin_location'], $charge_location['drop-in'] ) ) {

				if ( isset( $charge_location['days'] ) && isset( $charge_location['days'] ) > 0 && $charge_location['days'][0] > $days ) {

					$charge_price += $charge_location['cost'][0];
					$array['location_charge'] += $charge_location['cost'][0];
					$i ++;
				} elseif ( empty( $charge_location['days'][0] ) ) {
					$charge_price += $charge_location['cost'][0];
					$array['location_charge'] += $charge_location['cost'][0];
					$i ++;
				}

			} elseif ( isset( $charge_location['drop-off'] ) && in_array( $_POST['dropoff_location'], $charge_location['drop-off'] ) ) {
				if ( isset( $charge_location['days'] ) && isset( $charge_location['days'] ) > 0
				) {

					$charge_price += $charge_location['cost'][0];
					$array['location_charge'] += $charge_location['cost'][0];
					$i ++;
				} elseif ( empty( $charge_location['days'][0] ) ) {
					$charge_price += $charge_location['cost'][0];
					$array['location_charge'] += $charge_location['cost'][0];
					$i ++;
				}

			}


		}


		if ( $charge_price < 1 ) {
			$array['location_charge'] = esc_html__( 'Free', 'rentit' );
		} else {
			$array['location_charge'] = $charge_price;
		}
		$price += $charge_price;

	}


// get percent
	$rentit_deposit_percent = get_post_meta( $product_id, '_rentit_deposit_percent', 1 );

	if ( isset( $rentit_deposit_percent{0} ) && (int) $rentit_deposit_percent > 0 ) {

		$price = ( $rentit_deposit_percent / 100 ) * $price;

	}


	$array['new_price'] = sanitize_text_field( $price );
	$booking_data[$product_id] = apply_filters( 'rentit_booking_session_data', $array );

	WC()->session->set_customer_session_cookie( true );
	WC()->session->set( 'rentit_booking_data2', $booking_data );


	//Custom data - Sent Via AJAX post method
	@$product_id = @$_POST['id']; //This is product ID
	@$custom_data_1 = @$_POST['custom_data_1']; //This is User custom value sent via AJAX


//	var_dump($array);
	@session_start();


	$_SESSION['custom_data_1'] = $array;// $array['extras'];
	$_SESSION['custom_data_2'] = $array;


}

// step 2 set custom price WC 2

// old conde not works now
//add_action( 'woocommerce_before_calculate_totals', 'rentit_add_custom_price',999 );

function rentit_add_custom_price( $cart_object ) {

	$booking_session = WC()->session->get( 'rentit_booking_data2' );

	if ( isset( $booking_session ) ) {
		foreach ( $booking_session as $k => $v ) {

			$custom_price = $v["new_price"]; // This will be your custome price
			$target_product_id = $k;
			foreach ( $cart_object->cart_contents as $key => $value ) {
				if ( $value['product_id'] == $target_product_id ) {

					$value['data']->price = $custom_price;


				}
			}
		}
	}

}


// new code add custom price WC 3
add_filter( 'woocommerce_get_cart_item_from_session', 'rentit_set_session_prices', 20, 3 );


function rentit_set_session_prices( $woo_data, $values, $key ) {


	$booking_session = WC()->session->get( 'rentit_booking_data2' );

	if ( isset( $booking_session ) ) {
		foreach ( $booking_session as $k => $v ) {

			$custom_price = $v["new_price"]; // This will be your custome price
			$target_product_id = $k;

			// set new price
			if ( $values['product_id'] == $target_product_id ) {
				$woo_data['data']->set_price( $custom_price );

			}

		}
	}


	return $woo_data;
}


/***************/

add_filter( 'woocommerce_product_get_price', 'rentit_jc_get_price', 10, 2 );
function rentit_jc_get_price( $price, $product ) {

	if ( isset( $price ) && !empty( $price ) ) {
		return $price;
	} else {
		return rentit_get_current_price_product( $product->get_id() );
	}

	return $price;
}


add_filter( 'woocommerce_add_cart_item_data', 'rentit_add_item_data', 1, 3 );

if ( !function_exists( 'rentit_add_item_data' ) ) {
	function rentit_add_item_data( $cart_item_data, $product_id, $variation_id ) {
		/*Here, We are adding item in WooCommerce session with, rentit_user_custom_data_value name*/
		global $woocommerce;
		if ( session_id() == '' ) {
			@session_start();
		}

		$new_value = array();
		@$id = empty( $variation_id ) ? $product_id : $variation_id;
		@$booking_session = WC()->session->get( 'rentit_booking_data2' );
		@$booking_session = $booking_session[$id];

		if ( isset( $booking_session["extras"] ) ) {
			foreach ( $booking_session["extras"] as $item ) {
				$new_value[$item["name"]] = $item["value"];
			}

		}

		if ( isset( $_SESSION['custom_data_1'] ) ) {
			$option1 = $_SESSION['custom_data_1'];

			$new_value['custom_data_1'] = $option1;
		}
		if ( isset( $_SESSION['custom_data_2'] ) ) {
			$option2 = $_SESSION['custom_data_2'];
			$new_value['custom_data_2'] = $option2;
		}

		if ( empty( $option1 ) && empty( $option2 ) && empty( $option3 ) && empty( $option4 ) && empty( $option5 ) ) {
			return $cart_item_data;
		} else {
			if ( empty( $cart_item_data ) ) {
				return $new_value;
			} else {
				return array_merge( $cart_item_data, $new_value );
			}
		}


		unset( $_SESSION['custom_data_1'] );
		unset( $_SESSION['custom_data_2'] );
		unset( $_SESSION['custom_data_3'] );
		unset( $_SESSION['custom_data_4'] );
		unset( $_SESSION['custom_data_5'] );

		//Unset our custom session variable, as it is no longer needed.
	}
}

// step 3

add_filter( 'woocommerce_get_cart_item_from_session', 'rentit_get_cart_items_from_session', 1, 3 );
if ( !function_exists( 'rentit_get_cart_items_from_session' ) ) {
	function rentit_get_cart_items_from_session( $item, $values, $key ) {

		if ( array_key_exists( 'custom_data_1', $values ) ) {
			$item['custom_data_1'] = $values['custom_data_1'];
		}

		if ( array_key_exists( 'custom_data_2', $values ) ) {
			$item['custom_data_2'] = $values['custom_data_2'];
		}


		return $item;
	}
}


// step 4

add_filter( 'woocommerce_checkout_cart_item_quantity', 'rentit_add_user_custom_option_from_session_into_cart', 1, 3 );
add_filter( 'woocommerce_cart_item_price', 'rentit_add_user_custom_option_from_session_into_cart', 1, 3 );

if ( !function_exists( 'rentit_add_user_custom_option_from_session_into_cart' ) ) {
	function rentit_add_user_custom_option_from_session_into_cart( $product_name, $values, $cart_item_key ) {
		/*code to add custom data on Cart & checkout Page*/
		if ( isset( $values['custom_data_1'] ) && count( $values['custom_data_1'] ) > 0 ) {
			$return_string = $product_name . "</a><dl class='variation'>";

			$return_string .= "<table class='rentit_options_table' id='" . $values['product_id'] . "'>";

			//EXTRAS & FREES
			foreach ( $values['custom_data_1']['extras'] as $item ) {
				$return_string .= "<tr><td> " . $item["name"] . " : " . $item["value"] . "</td></tr>";


			}

			$return_string .= "<tr><td> <b> " . esc_html__( 'Rent data', 'rentit' ) . "</b></td></tr>";
			$return_string .= "<tr><td> <b>" . esc_html__( 'Start', 'rentit' ) . "</b> " . $values['custom_data_1']['dropin_date'] . " <b>: </b><b>" . esc_html__( 'End', 'rentit' ) . " </b>" . $values['custom_data_1']['dropoff_date'] . "</td></tr>";
			$return_string .= "<tr><td> " . esc_html__( 'Picking Up Location', 'rentit' ) . " : " . $values['custom_data_1']['dropin_location'] . "</td></tr>";
			$return_string .= "<tr><td> " . esc_html__( 'Dropping Off Location', 'rentit' ) . " : " . $values['custom_data_1']['dropoff_location'] . "</td></tr>";
			if ( isset( $values['custom_data_1']['location_charge'] ) ) {

				$return_string .= "<tr><td><b>" . esc_html__( 'Location charge', 'rentit' ) . " </b> : " . $values['custom_data_1']['location_charge'] . "</td></tr>";
			}


			$return_string .= "</table></dl>";


			return $return_string;
		} else {
			return $product_name;
		}
	}
}


// step 5

add_action( 'woocommerce_checkout_update_order_meta', 'rentit_add_item_met' );
function rentit_add_item_met( $order_id ) {

	update_post_meta( $order_id, '_has_event', $GLOBALS['rentit_user_custom_data_value'] );
}

add_action( 'woocommerce_add_order_item_meta', 'rentit_add_values_to_order_item_meta', 1, 2 );
if ( !function_exists( 'rentit_add_values_to_order_item_meta' ) ) {
	function rentit_add_values_to_order_item_meta( $item_id, $values ) {

		global $post;

		$user_custom_values = @$values['rentit_user_custom_data_value'];

		$GLOBALS['rentit_user_custom_data_value'] = $user_custom_values;
		if ( !empty( $user_custom_values ) ) {
			wc_add_order_item_meta( $item_id, 'rentit_user_custom_data', $user_custom_values );
		}

		foreach ( $values['custom_data_1']['extras'] as $item ) {

			wc_add_order_item_meta( $item_id, $item["name"], $item["value"] );

		}

		wc_add_order_item_meta( $item_id, esc_html__( 'Picking Up Date', 'rentit' ), $values['custom_data_1']['dropin_date'] );
		wc_add_order_item_meta( $item_id, esc_html__( 'Dropping Off Date', 'rentit' ), $values['custom_data_1']['dropoff_date'] );
		wc_add_order_item_meta( $item_id, esc_html__( 'Picking Up Location', 'rentit' ), $values['custom_data_1']['dropin_location'] );
		wc_add_order_item_meta( $item_id, esc_html__( 'Dropping Off Location', 'rentit' ), $values['custom_data_1']['dropoff_location'] );
		wc_add_order_item_meta( $item_id, esc_html__( 'location charge', 'rentit' ), $values['custom_data_1']['location_charge'] );

		global $wpdb;

		$order_id = $wpdb->get_var(
			$wpdb->prepare( "SELECT  order_id FROM  `{$wpdb->prefix}woocommerce_order_items`  WHERE order_item_id = %d", $item_id )

		);


		add_post_meta( $order_id, '_dropin_date', $values['custom_data_1']['dropin_date'], true );
		add_post_meta( $order_id, '_dropoff_date', $values['custom_data_1']['dropoff_date'], true );
		add_post_meta( $order_id, '_carr', $values, true );
		add_post_meta( $order_id, '_product_id', $values["product_id"], true );


	}
}


// step 6

add_action( 'woocommerce_before_cart_item_quantity_zero', 'rentit_remove_user_custom_data_options_from_cart', 1, 1 );
if ( !function_exists( 'rentit_remove_user_custom_data_options_from_cart' ) ) {
	function rentit_remove_user_custom_data_options_from_cart( $cart_item_key ) {
		global $woocommerce;
		// Get cart
		$cart = $woocommerce->cart->get_cart();
		// For each item in cart, if item is upsell of deleted product, delete it
		foreach ( $cart as $key => $values ) {
			if ( $values['rentit_user_custom_data_value'] == $cart_item_key ) {
				unset( $woocommerce->cart->cart_contents[$key] );
			}
		}
	}
}


if ( !function_exists( 'rentit_DateDiff' ) ):
	/**
	 * @param $interval
	 * @param $date1
	 * @param $date2
	 *
	 * @return float|string
	 */


	function rentit_DateDiff( $interval, $date1, $date2 ) {
		// get seconds
		$timedifference = $date2 - $date1;

		switch ( $interval ) {
			case 'w':
				$retval = ceil( $timedifference / 604800 );
				break;
			case 'd':
				$retval = ceil( $timedifference / 86400 );
				break;
			case 'h':
				$retval = ceil( $timedifference / 3600 );
				break;
			case 'n':
				$retval = bcdiv( $timedifference, 60 );
				break;
			case 's':
				$retval = $timedifference;
				break;

		}

		return $retval;

	}

endif;


add_action( 'woocommerce_order_status_completed', 'rentit_order_status_completed_function' );
add_action( 'woocommerce_order_status_pending_to_processing', 'rentit_order_status_completed_function' );
/*
 * Do something after WooCommerce sets an order on completed
 */
function rentit_order_status_completed_function( $order_id ) {
	$order = new WC_Order( $order_id );

	global $wpdb;
	$product_id = sanitize_text_field( get_post_meta( $order_id, '_product_id', true ) );
	$dropin_date = sanitize_text_field( get_post_meta( $order_id, '_dropin_date', true ) );
	$dropoff_date = sanitize_text_field( get_post_meta( $order_id, '_dropoff_date', true ) );

	//insets to table dates

	$wpdb->insert(
		"{$wpdb->prefix}rentit_booking",
		array(
			'product_id' => $product_id,
			'order_id' => $order_id,
			'dropin_date' => strtotime( $dropin_date ),
			'dropoff_date' => strtotime( $dropoff_date ),
			'status' => 1,
			'user_id' => get_current_user_id()
		),
		array(
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d'
		)
	);


}

add_action( 'woocommerce_order_status_cancelled', 'rentit_order_status_cancelled_function' );
/*
 * Do something after WooCommerce sets an order on completed
 */
function rentit_order_status_cancelled_function( $order_id ) {

	global $wpdb;
	$wpdb->delete( "{$wpdb->prefix}rentit_booking", array( 'order_id' => $order_id ) );


}

/**
 *  SET SESION
 */
add_action( 'init', 'rentit_init_site' );
function rentit_init_site() {
	if ( !empty( $_POST ) && function_exists( 'wc_setcookie' ) ) {
		//biling info
		if ( isset( $_POST['order_comments']{1} ) ) {
			wc_setcookie( 'order_comments', sanitize_text_field( $_POST['order_comments'] ) );
			$_SESSION['order_comments'] = sanitize_text_field( $_POST['order_comments'] );
		}


		if ( isset( $_POST['payment_method']{1} ) ) {
			wc_setcookie( 'payment_method', sanitize_text_field( $_POST['payment_method'] ) );
		}
		if ( isset( $_POST['dropin_location']{1} ) ) {
			wc_setcookie( 'dropin_location', sanitize_text_field( $_POST['dropin_location'] ) );
		}
		if ( isset( $_POST['dropoff_location']{1} ) ) {
			wc_setcookie( 'dropoff_location', sanitize_text_field( $_POST['dropoff_location'] ) );
		}
		if ( isset( $_POST['dropin_date']{1} ) ) {
			wc_setcookie( 'dropin_date', sanitize_text_field( $_POST['dropin_date'] ), time() + 62208000, '/', $_SERVER['HTTP_HOST'] );
		}
		if ( isset( $_POST['dropoff_date']{1} ) ) {
			setcookie( 'dropoff_date', sanitize_text_field( $_POST['dropoff_date'] ), time() + 62208000, '/', $_SERVER['HTTP_HOST'] );
		}
		if ( isset( $_POST['billing_first_name']{1} ) ) {
			wc_setcookie( 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		}
		if ( isset( $_POST['billing_last_name']{1} ) ) {
			wc_setcookie( 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		}
		if ( isset( $_POST['billing_email']{1} ) ) {
			wc_setcookie( 'billing_email', sanitize_text_field( $_POST['billing_email'] ) );
		}
		if ( isset( $_POST['billing_phone']{1} ) ) {
			wc_setcookie( 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
		}
		if ( isset( $_POST['payment_method']{1} ) ) {
			wc_setcookie( 'payment_method', sanitize_text_field( $_POST['payment_method'] ) );
		}


		if ( isset( $_POST['payment_method']{1} ) ) {
			$_SESSION['payment_method'] = sanitize_text_field( $_POST['payment_method'] );
		}

		if ( isset( $_POST['dropin_date']{1} ) ) {
			$_SESSION['dropin_date'] = sanitize_text_field( $_POST['dropin_date'] );
		}

		if ( isset( $_POST['dropoff_date']{1} ) ) {
			$_SESSION['dropoff_date'] = sanitize_text_field( $_POST['dropoff_date'] );
		}

		if ( isset( $_POST['billing_first_name']{1} ) ) {
			$_SESSION['billing_first_name'] = sanitize_text_field( $_POST['billing_first_name'] );
		}

		if ( isset( $_POST['billing_last_name']{1} ) ) {
			$_SESSION['billing_last_name'] = sanitize_text_field( $_POST['billing_last_name'] );
		}

		if ( isset( $_POST['billing_email']{1} ) ) {
			$_SESSION['billing_email'] = sanitize_text_field( $_POST['billing_email'] );
		}

		if ( isset( $_POST['billing_phone']{1} ) ) {
			$_SESSION['billing_phone'] = sanitize_text_field( $_POST['billing_phone'] );
		}

		if ( isset( $_POST['payment_method']{1} ) ) {
			$_SESSION['payment_method'] = sanitize_text_field( $_POST['payment_method'] );
		}


		if ( isset( $_POST['dropin_location']{1} ) ) {
			$_SESSION['dropin_location'] = sanitize_text_field( $_POST['dropin_location'] );
		}

		if ( isset( $_POST['dropoff_location']{1} ) ) {
			$_SESSION['dropoff_location'] = sanitize_text_field( $_POST['dropoff_location'] );
		}


	}
	if ( !empty( $_GET ) ) {
		if ( isset( $_GET['dropin']{1} ) ) {
			$_SESSION['dropin_location'] = sanitize_text_field( urldecode( $_GET['dropin'] ) );
			setcookie( 'dropin_location', sanitize_text_field( urldecode( $_GET['dropin'] ) ), time() + 62208000, '/', $_SERVER['HTTP_HOST'] );
		}
		if ( isset( $_GET['dropoff']{1} ) ) {
			$_SESSION['dropoff_location'] = sanitize_text_field( urldecode( $_GET['dropoff'] ) );
			setcookie( 'dropoff_location', sanitize_text_field( urldecode( $_GET['dropoff'] ) ), time() + 62208000, '/', $_SERVER['HTTP_HOST'] );
		}

		if ( isset( $_GET['start_date']{1} ) ) {
			$_SESSION['dropin_date'] = sanitize_text_field( urldecode( $_GET['start_date'] ) );
			setcookie( 'dropin_date', sanitize_text_field( urldecode( $_GET['start_date'] ) ), time() + 62208000, '/', $_SERVER['HTTP_HOST'] );

		}
		if ( isset( $_GET['end_date']{1} ) ) {
			$_SESSION['dropoff_date'] = sanitize_text_field( urldecode( $_GET['end_date'] ) );
			setcookie( 'dropoff_date', sanitize_text_field( urldecode( $_GET['end_date'] ) ), time() + 62208000, '/', $_SERVER['HTTP_HOST'] );

		}


	}
}

/*
 * get session
 */

function rentit_get_date_s( $name ) {
	if ( isset( $_COOKIE[$name] ) && !empty( $_COOKIE[$name] ) ) {
		echo wp_kses_post( $_COOKIE[$name] );
	} elseif ( isset( $_SESSION[$name] ) && !empty( $_SESSION[$name] ) ) {
		echo wp_kses_post( $_SESSION[$name] );
	}
}


function rentit_allow_cyrillic_username( $username, $raw_username, $strict ) {
	$username = wp_strip_all_tags( $raw_username );
	$username = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '', $username );
	$username = preg_replace( '/&amp;.+?;/', '', $username );

	if ( $strict ) {
		$username = preg_replace( '|[^a-zа-я0-9 _.\-@]|iu', '', $username );
	}

	return preg_replace( '|\s+|', ' ', $username );
}

add_filter( 'sanitize_user', 'rentit_allow_cyrillic_username', 10, 3 );


function renit_getSeason_reserve_2( $date ) {
	$seasons = array(
		0 => 'winter',
		1 => 'spring',
		2 => 'summer',
		3 => 'autumn'
	);

	return $seasons[floor( $date / 3 ) % 4];
}