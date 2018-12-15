<?php
/**
 * Created by PhpStorm.
 * User: Pro
 * Date: 14.01.2016
 * Time: 18:45
 */

/**
 * Define template location
 * @package Rent It
 * @since Rent It 1.0
 */


$dir = plugin_dir_path( __FILE__ ) . 'templates';

vc_set_shortcodes_templates_dir( $dir );

require 'slider-filter1.php';
require 'flipInY.php';
require 'present_block.php';
require 'Rental_Offers.php';
require 'testimonials.php';
require 'testimonials_v2.php';
require 'Rental_Fleet_cars.php';
require 'statistics.php';
require 'accordion.php';
require 'map_1.php';
require 'map_2.php';
require 'Recent_Blog_Posts.php';
require 'SUBSCRIBE_block.php';
require 'COSTUMER_SERVICE.php';
require 'contact-form.php';
require 'on-gmap.php';
require 'CONTACT_US.php';
require 'team.php';
require "rentit-vc-simple-message-box.php";
require "rentit_vc_button.php";
require "rentit-vc-post-carousel.php";
require "rentit-vc-carousel.php";
require 'rentit-vc-tabs.php';
require 'wigets_shortcode.php';
require 'rentit_tabs.php';


class WPBakeryShortCode_rentit_conatainer extends WPBakeryShortCodesContainer {

	/**
	 * Load specific template
	 * @package Rent It
	 * @since Rent It 1.0
	 */


	protected function content( $atts, $content = null ) {

		ob_start();
		$content = !empty( $content ) ? $content : "";
		$atts = shortcode_atts(
			array(
				'color' => '',
				'class' => '',
				'css' => '',
			), $atts
		);

		extract( $atts );
		if ( $class == 'contact' ) {
			$class = ' contact dark ';
		}
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
		?>

		<section class="page-section <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $css_class ); ?>">
			<div class="container <?php echo esc_attr( $atts['color'] ); ?> ">
				<?php echo do_shortcode( $content ); ?>
			</div>
		</section>
		<?php

		return ob_get_clean();
	}

}

add_shortcode( 'rentit_button_standart', 'rentit_button_standart_func' );

function rentit_button_standart_func( $atts ) {
	$atts = shortcode_atts(
		array(
			'url' => '#',
			'text' => esc_html__( 'See All Posts', 'rentit' )
		), $atts
	);
	ob_start();
	?>
	<div class="text-center margin-top wow fadeInDown" data-wow-offset="200" data-wow-delay="100ms">
		<a href="<?php echo esc_url( $atts['url'] ); ?>" class="btn btn-theme
        ripple-effect btn-theme-light btn-more-posts"><?php echo wp_kses_post( $atts['text'] ); ?></a>
	</div>
	<?php
	return ob_get_clean();
}

add_shortcode( 'rentit_social_links', 'rentit_social_links_function' );


function rentit_social_links_function( $atts ) {
	$atts = shortcode_atts(
		array(
			'url' => '#',
			'class' => '',
		), $atts
	);
	ob_start();
	?>
	<li>
		<a target="_blank" href="<?php echo esc_url( $atts['url'] ); ?>"><i class="fa <?php echo wp_kses_post( $atts['class'] ) ?>"></i></a>
	</li>
	<?php
	return ob_get_clean();
}

add_shortcode( 'rentit_section-title', 'rentit_section_title_function' );
/*
 *
 */
function rentit_section_title_function( $atts, $content ) {
	$content = !empty( $content ) ? $content : "";
	$atts = shortcode_atts(
		array(
			'h_s' => '',
			'h' => '',
			'text_align' => 'center'

		), $atts
	);
	$class = 'text-' . $atts['text_align'];
	ob_start();

	?>
	<h2 class="section-title wow fadeInDown <?php echo esc_attr( $class ); ?>" data-wow-offset="200"
	    data-wow-delay="100ms">
		<small><?php echo wp_kses_post( $atts['h_s'] ); ?></small>
		<span><?php echo wp_kses_post( $atts['h'] ); ?></span>
	</h2>

	<?php


	return ob_get_clean();
}


add_shortcode( 'rentit_row', 'rentit_row_function' );
/*
 *  row
 */
function rentit_row_function( $atts, $content ) {
	$content = !empty( $content ) ? $content : "";


	ob_start();
	?>

	<div class="row"><?php echo do_shortcode( $content ); ?></div>
	<?php


	return ob_get_clean();
}

/**
 * text center lead'
 */
add_shortcode( 'rentit_text_center_lead', 'rentit_text_center_lead_function' );
/*
 *
 */
function rentit_text_center_lead_function( $atts, $content ) {
	$content = !empty( $content ) ? $content : "";

	ob_start();
	?>
	<div class="text-center lead">
		<?php echo do_shortcode( $content ); ?>
	</div>
	<?php


	return ob_get_clean();
}


/**
 * text center lead'
 */
add_shortcode( 'rentit_page_divider', 'rentit_page_divider_function' );
/*
 *
 */
function rentit_page_divider_function( $atts, $content ) {
	return ' <hr class="page-divider">';
}

/**
 * text center lead'
 */
add_shortcode( 'rentit_one_page_section', 'rentit_one_page_section_function' );
/*
 *
 */
function rentit_one_page_section_function( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'id' => '',
			'title' => '',


		), $atts
	);
	$res = ' <section class="ankor" id="' . esc_attr( $atts['id'] ) . '" data-title="' .
	       esc_attr( $atts['title'] ) . '" ">';
	$res .= do_shortcode( $content ) . ' </section>';

	return $res;
}


/**
 * text center lead'
 */
add_shortcode( 'rentit_vc_iconic_box', 'rentit_vc_iconic_box_function' );
/*
 *
 */
function rentit_vc_iconic_box_function( $atts, $content ) {

	if ( function_exists( 'vc_map_get_attributes' ) ) {
		$atts = vc_map_get_attributes( 'rentit_vc_iconic_box', $atts );
		extract( $atts );
		$icon_type = $atts['type'];
		$icon_out = '';
		switch ( $icon_type ) {
			case 'fontawesome':
				$icon_out = $atts['icon_fontawesome'];
				break;

			case 'openiconic':
				$icon_out = $atts['icon_openiconic'];
				break;

			case 'typicons':
				$icon_out = $atts['icon_typicons'];
				break;

			case 'entypo':
				$icon_out = $atts['icon_entypo'];
				break;

			case 'linecons':
				$icon_out = $atts['linecons'];
				break;

			default:
				// Nothing to display
				$icon_out = '';
				break;
		}
		global $WPBakeryShortCode;

		$css = ( isset( $atts['css'] ) ) ? $atts['css'] : '';
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );

		ob_start(); ?>

		<div class="shop-info-banners <?php echo esc_attr( $css_class ); ?>">
			<div class="block">
				<div class="media">
					<div class="pull-right"><i class="<?php echo esc_attr( $icon_out ); ?>"></i></div>
					<div class="media-body">
						<h4 class="media-heading"><?php echo wp_kses_post( $atts['title'] ); ?></h4>
						<?php echo wp_kses_post( $atts['box_content'] ); ?>
					</div>
				</div>
			</div>
		</div><!-- /.shop-info-banners -->


		<?php
		return ob_get_clean();
	} else {
		return "";
	}
}


/******************************************************/


add_shortcode( 'rentit_TESTIMONIALS_slaid', 'rentit_TESTIMONIALS_slaid_fn' );

function rentit_TESTIMONIALS_slaid_fn( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'name' => '',
			'position' => '',

		), $atts
	);
	ob_start();
	?>
	<div class="testimonial">
		<div class="media">
			<div class="media-body">
				<div class="testimonial-text">   <?php
					echo wp_kses_post( $content ); ?>
				</div>
				<div class="testimonial-name"><?php echo wp_kses_post( $atts['name'] ); ?>
					<span
						class="testimonial-position"> <?php echo wp_kses_post( $atts['position'] ); ?> </span>
				</div>
			</div>
		</div>
	</div>
	<?php

	return ob_get_clean();
}


add_shortcode( 'rentit_portfolio_v1', 'rentit_portfolio_v1' );

function rentit_portfolio_v1( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'name' => '',
			'position' => '',
			'view' => sanitize_text_field( get_theme_mod( 'rentit_portfolio_view', 'standard' ) )


		), $atts
	);


	extract($atts);
	ob_start();

	$args = array(
		'post_type' => 'portfolio',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 100,
		'meta_query' => array( array( 'key' => '_thumbnail_id' ) )
	);

	$post_query = new WP_Query( $args );


	?>
	<div class="content-area">
		<section class="page-section sub-page">
			<div class="container">

				<div class="clearfix text-center">
					<ul id="filtrable" class="filtrable clearfix">
						<li class="all current"><a href="#"
						                           data-filter="*"> <?php esc_html_e( 'All', 'rentit' ); ?></a></li>
						<?php


						$terms = get_terms( 'portfolio_categories', array( 'hide_empty' => true ) );
						foreach ( $terms as $v ) {

							?>
							<li class="all "><a href="#"
							                    data-filter=".<?php echo esc_attr( $v->slug ); ?>"><?php echo esc_html( $v->name ); ?></a>
							</li>
							<?php

						}

						?>

					</ul>
				</div>

				<div class="row thumbnails portfolio isotope isotope-items">
					<?php
					$paged = (int) sanitize_text_field( get_query_var( 'paged' ) );
					$posts_per_page = (int) sanitize_text_field( get_option( 'posts_per_page' ) );

					$rentit_new_arr = array(
						'paged' => $paged,
						'showposts' => $posts_per_page + 100,

						'post_status' => 'publish',
						'post_type' => 'portfolio',
						'orderby' => 'date'
					);

					$rentit_custom_query = new WP_Query( $rentit_new_arr );
					if ( $rentit_custom_query->have_posts() ):
						while ( $rentit_custom_query->have_posts() ) {
							$rentit_custom_query->the_post();

							$terms = get_the_terms( get_the_ID(), 'portfolio_categories' );


							$params = array( 'standard', '4col', 'alt' );
							if ( isset( $_GET['showas'] ) && !empty( $_GET['showas'] ) && in_array( $_GET['showas'], $params ) ) {
								$view = sanitize_text_field( $_GET['showas'] );
							}
							$class = ( $view == 'standard' ) ? "col-md-4 col-sm-6" : "col-md-3 col-sm-6";

							?>


							<div class="<?php echo esc_attr( $class ); ?> isotope-item  <?php
							if ( !empty( $terms ) ):
								foreach ( $terms as $v ) {
									echo esc_html( $v->slug . " " );
								}
							endif; ?>">

								<?php
								if ( $view != 'alt' ) {
									get_template_part( 'partials/porfolio', 'default' );
								} else {
									get_template_part( 'partials/porfolio', 'alt' );
								}
								?>
							</div>

							<?php

						}
						wp_reset_postdata();


					endif;
					?>


				</div>


			</div>
		</section>
	</div>
	<?php

	return ob_get_clean();
}

