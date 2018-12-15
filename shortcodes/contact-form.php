<?php

add_shortcode( 'rentit_contact_form', 'rentit_contact_form_function' );
function rentit_contact_form_function( $atts, $content ) {
	$content = ! empty( $content ) ? $content : "";
	$atts    = shortcode_atts(
		array(
			'show_subject' => true // get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg',
		), $atts
	);


	if ( strlen( $content ) < 5 ) {
		ob_start();
		?>
		<p>
			<?php esc_html_e( " This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean
                sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum.", 'rentit' ); ?>
		</p>

		<ul class="media-list contact-list">
			<li class="media">
				<div class="media-left"><i class="fa fa-home"></i></div>
				<div class="media-body">
					<?php esc_html_e( " Adress: 1600 Pennsylvania Ave NW, Washington, D.C.", 'rentit' ); ?>
				</div>
			</li>
			<li class="media">
				<div class="media-left"><i class="fa fa"></i></div>
				<div class="media-body"><?php esc_html_e( "DC 20500, ABD", 'rentit' ); ?></div>
			</li>
			<li class="media">
				<div class="media-left"><i class="fa fa-phone"></i></div>
				<div class="media-body"><?php esc_html_e( "Support Phone: 01865 339665", 'rentit' ); ?></div>
			</li>
			<li class="media">
				<div class="media-left"><i class="fa fa-envelope"></i></div>
				<div class="media-body"><?php esc_html_e( "E mails: info@example.com", 'rentit' ); ?></div>
			</li>
			<li class="media">
				<div class="media-left"><i class="fa fa-clock-o"></i></div>
				<div
					class="media-body"><?php esc_html_e( "Working Hours: 09:30-21:00 except on Sundays", 'rentit' ); ?></div>
			</li>
			<li class="media">
				<div class="media-left"><i class="fa fa-map-marker"></i></div>
				<div class="media-body"><?php esc_html_e( "View on The Map", 'rentit' ); ?></div>
			</li>
		</ul>
		<?php
		$content = ob_get_clean();

	}
	ob_start();

	?>
	<div class="row">
		<div class="col-md-6">
			<!-- Contact form -->
			<!-- Contact form -->
			<form name="contact-form" method="post" action="#" class="contact-form" id="contact-form">

				<div class="row">
					<div class="col-md-6">

						<div class="outer required">
							<div class="form-group af-inner has-icon">
								<label class="sr-only" for="name"><?php esc_html_e( 'Name', 'rentit' ); ?></label>
								<input
									type="text" name="name" id="name"
									placeholder="<?php esc_html_e( 'Name', 'rentit' ); ?>" value="" size="30"
									data-toggle="tooltip" title="<?php esc_html_e( 'Name is required', 'rentit' ); ?>"
									class="form-control placeholder"/>
								<span class="form-control-icon"><i class="fa fa-user"></i></span>
							</div>
						</div>

					</div>
					<div class="col-md-6">

						<div class="outer required">
							<div class="form-group af-inner has-icon">
								<label class="sr-only" for="email"><?php esc_html_e( 'Email', 'rentit' ); ?></label>
								<input
									type="text" name="email" id="email"
									placeholder="<?php esc_html_e( 'Email', 'rentit' ); ?>" value="" size="30"
									data-toggle="tooltip" title="<?php esc_html_e( 'Email is required', 'rentit' ); ?>"
									class="form-control placeholder"/>
								<span class="form-control-icon"><i class="fa fa-envelope"></i></span>
							</div>
						</div>

					</div>
				</div>

				<?php if ( $atts['show_subject'] == true ): ?>
					<div class="outer required">
						<div class="form-group af-inner has-icon">
							<label class="sr-only" for="subject"><?php esc_html_e( 'Subject', 'rentit' ); ?></label>
							<input
								type="text" name="subject" id="subject"
								placeholder="<?php esc_html_e( 'Subject', 'rentit' ); ?>" value="" size="30"
								data-toggle="tooltip" title="<?php esc_html_e( 'Subject is required', 'rentit' ); ?>"
								class="form-control placeholder"/>
							<span class="form-control-icon"><i class="fa fa-bars"></i></span>
						</div>
					</div>
				<?php endif; ?>
				<div class="form-group af-inner has-icon">
					<label class="sr-only" for="input-message"><?php esc_html_e( 'Message', 'rentit' ); ?></label>
                                <textarea
	                                name="message" id="input-message"
	                                placeholder="<?php esc_html_e( 'Message', 'rentit' ); ?>" rows="4" cols="50"
	                                data-toggle="tooltip"
	                                title="<?php esc_html_e( 'Message is required', 'rentit' ); ?>"
	                                class="form-control placeholder"></textarea>
					<span class="form-control-icon"><i class="fa fa-bars"></i></span>
				</div>

				<div class="outer required">
					<div class="form-group af-inner">
						<input type="submit" name="submit"
						       class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark"
						       id="submit_btn" value="Send message"/>
					</div>
				</div>

			</form>

		</div>
		<div class="col-md-6">
			<?php echo wp_kses_post( do_shortcode( $content ) ); ?>


		</div>
	</div>

	<?php

	return ob_get_clean();
}


/**
 * Post Carousel
 * @package Rent It
 * @since Rent It 1.0
 */


$all              = esc_html__( 'All', 'rentit' );
$post_cat         = array();
$post_cat[ $all ] = 'all';
$categories       = get_terms( 'category', 'orderby=name&hide_empty=1' );
if ( count( $categories ) > 0 ):
	foreach ( $categories as $cat ) {
		$post_cat[ $cat->name ] = $cat->term_id;
	}
endif;


vc_map( array(
	'name'          => esc_html__( 'Rent It contact form 2', 'rentit' ),
	'base'          => 'rentit_contact_form2',
	"icon"          => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
	'category'      => esc_html__( 'Rent It', 'rentit' ),
	'description'   => esc_html__( 'Contact form', 'rentit' ),
	'custom_markup' => '{{title}}<div class="vc_btn3-container"><h4 class="team-name"></h4></div>',
	'params'        => array(
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Widget title', 'rentit' ),
			'param_name' => 'title'
		),
		array(
			"type"        => "textarea",
			"holder"      => "div",
			"class"       => "",
			"heading"     => esc_html__( "Enter description text", "rentit" ),
			"param_name"  => "content",
			"value"       => 'This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum',
			"description" => ''
		),
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'Css', 'rentit' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Design options', 'rentit' ),
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'show_subject',
			"heading"    => esc_html__( "Show subject ?", "rentit" ),
			'value'      => array(
				esc_html__( 'Show subject', "rentit" ) => '1',
				esc_html__( 'Hide subject', "rentit" ) => '0',
			),
		),
		array(
			'type'       => 'param_group',
			'holder'     => 'div',
			'heading'    => esc_html__( 'Other Contact Details', 'rentit' ),
			'param_name' => 'items',
			'params'     => array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'rentit' ),
					'param_name' => 'icon',

					'description' => esc_html__( 'Select icon from library.', 'rentit' ),
				),
				array(
					'type'        => 'textfield',
					'holder'      => 'div',
					'heading'     => esc_html__( 'Text', 'rentit' ),
					'param_name'  => 'title',
					'description' => esc_html__( 'Label  E.g. Adress: 1600 Pennsylvania Ave NW, Washington, D.C. ', 'rentit' )
				),

			),
		),
	),
) );

VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_Vc_Carousel' );

class WPBakeryShortCode_rentit_contact_form2 extends WPBakeryShortCode_Vc_Carousel {

	/**
	 * Load specific template
	 * @package Rent It
	 * @since Rent It 1.0
	 */


	public function getFileName() {
		return 'rentit_vc_post_carousel_template';
	}

	protected function content( $atts, $content = null ) {

		ob_start();
		$atts    = shortcode_atts(
			array(
				'show_subject' => true, // get_template_directory_uri().'/img/preview/team/team-270x270x1.jpg',
				'css'          => '',
				'items'        => '',
				'icon'         => ''
			), $atts
		);
		$items_v = array();
		$atts    = vc_map_get_attributes( $this->getShortcode(), $atts );
		if ( function_exists( 'vc_param_group_parse_atts' ) ) {
			$items_v = vc_param_group_parse_atts( $atts['items'] );
		}
		extract( $atts );

		$css       = ( isset( $atts['css'] ) ) ? $atts['css'] : '';
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


		?>

		<div class="row <?php echo esc_attr( $css_class ); ?>">
			<div class="col-md-6">
				<!-- Contact form -->
				<!-- Contact form -->
				<form name="contact-form" method="post" action="#" class="contact-form" id="contact-form">

					<div class="row">
						<div class="col-md-6">

							<div class="outer required">
								<div class="form-group af-inner has-icon">
									<label class="sr-only" for="name"><?php esc_html_e( 'Name', 'rentit' ); ?></label>
									<input
										type="text" name="name" id="name"
										placeholder="<?php esc_html_e( 'Name', 'rentit' ); ?>" value="" size="30"
										data-toggle="tooltip"
										title="<?php esc_html_e( 'Name is required', 'rentit' ); ?>"
										class="form-control placeholder"/>
									<span class="form-control-icon"><i class="fa fa-user"></i></span>
								</div>
							</div>

						</div>
						<div class="col-md-6">

							<div class="outer required">
								<div class="form-group af-inner has-icon">
									<label class="sr-only" for="email"><?php esc_html_e( 'Email', 'rentit' ); ?></label>
									<input
										type="text" name="email" id="email"
										placeholder="<?php esc_html_e( 'Email', 'rentit' ); ?>" value="" size="30"
										data-toggle="tooltip"
										title="<?php esc_html_e( 'Email is required', 'rentit' ); ?>"
										class="form-control placeholder"/>
									<span class="form-control-icon"><i class="fa fa-envelope"></i></span>
								</div>
							</div>

						</div>
					</div>

					<?php if ( $atts['show_subject'] == true ): ?>
						<div class="outer required">
							<div class="form-group af-inner has-icon">
								<label class="sr-only" for="subject"><?php esc_html_e( 'Subject', 'rentit' ); ?></label>
								<input
									type="text" name="subject" id="subject"
									placeholder="<?php esc_html_e( 'Subject', 'rentit' ); ?>" value="" size="30"
									data-toggle="tooltip"
									title="<?php esc_html_e( 'Subject is required', 'rentit' ); ?>"
									class="form-control placeholder"/>
								<span class="form-control-icon"><i class="fa fa-bars"></i></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group af-inner has-icon">
						<label class="sr-only" for="input-message"><?php esc_html_e( 'Message', 'rentit' ); ?></label>
                                <textarea
	                                name="message" id="input-message"
	                                placeholder="<?php esc_html_e( 'Message', 'rentit' ); ?>" rows="4" cols="50"
	                                data-toggle="tooltip"
	                                title="<?php esc_html_e( 'Message is required', 'rentit' ); ?>"
	                                class="form-control placeholder"></textarea>
						<span class="form-control-icon"><i class="fa fa-bars"></i></span>
					</div>

					<div class="outer required">

						<div class="form-group af-inner">
							<input type="submit" name="submit"
							       class="form-button form-button-submit btn btn-block btn-theme ripple-effect btn-theme-dark"
							       id="submit_btn" value="<?php esc_html_e( 'Send message', 'rentit' ); ?>"/>
						</div>
					</div>

				</form>

			</div>
			<div class="col-md-6">
				<p><?php echo wp_kses_post( $content ); ?></p>

				<ul class="media-list contact-list">
					<?php
					if ( $items_v ) {
						foreach ( $items_v as $item ) { ?>
							<li class="media">
								<div class="media-left"><i class="<?php
									if ( isset( $item['icon'] ) ) {
										echo esc_attr( $item['icon'] );
									} ?>"></i></div>
								<div class="media-body"><?php
									if ( isset( $item['title'] ) ) {
										echo wp_kses_post( $item['title'] );
									} ?></div>
							</li>
						<?php }
					} ?>
				</ul>

			</div>
		</div>
		<?php

		return ob_get_clean();
	}

}






