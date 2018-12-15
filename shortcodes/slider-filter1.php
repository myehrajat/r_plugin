<?php

add_shortcode( 'rentit_page_section_slider', 'rentit_page_section_slider' );
function rentit_page_section_slider( $atts, $content ) {
	$content = !empty( $content ) ? $content : "";
	$atts = shortcode_atts(
		array(
			'h' => '',
			'align' => 'center' //left|center|right
		), $atts
	);

	ob_start();

	?>

    <section class="page-section no-padding slider">
        <div class="container full-width">
            <div class="main-slider">
                <div class="owl-carousel" id="main-slider">
					<?php echo do_shortcode( $content ); ?>

                </div>
            </div>
        </div>
    </section>
	<?php

	return ob_get_clean();
}


add_shortcode( 'rentit_page_section_slider_v1', 'rentit_page_section_slider_v1' );
function rentit_page_section_slider_v1( $atts, $content ) {
	global $Rent_IT_class;
	$content = !empty( $content ) ? $content : "";

	$atts = shortcode_atts(
		array(
			'h' => esc_html__( 'All Discounts Just For You', 'rentit' ),
			'sh' => esc_html__( 'Find Best Rental Car', 'rentit' ),
			'st' => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
			'img_src' => '',
			'tb' => esc_html__( ' Find Car', 'rentit' ),
			'video' => ''

		), $atts
	);

	if ( strlen( $atts['img_src'] ) < 1 ) {
		$atts['img_src'] = get_template_directory_uri() . '/img/preview/slider/slide-2.jpg';
	} else {
		$img = wp_get_attachment_image_src( $atts['img_src'], 'full' );
		$atts['img_src'] = $img[0];
		//$atts['img_src'] = $Rent_IT_class->trim_img_by_url( $img[0], 1920, 900 );
	}


	ob_start();

	?>

    <!-- Slide 1 -->
    <div class="item slide1 ver1"

         style="
                 background-image: url('<?php echo esc_url( $atts['img_src'] ); ?>');"
    >
		<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) {

			?>
            <input type="hidden" name="lang" value="<?php echo esc_html( ICL_LANGUAGE_CODE ); ?>">

			<?php
		} ?>

		<?php


		if ( isset( $atts['video']{2} ) ): ?>
            <div class="videoID">
                <iframe
                        src="<?php echo esc_url( get_youtube_embed_url( $atts['video'] ) ) ?>"
                        frameborder="0"></iframe>
            </div>
		<?php endif; ?>
        <div class="caption">
            <div class="container">
                <div class="div-table">
                    <div class="div-cell">
                        <form
                                action="<?php
								if ( function_exists( 'wc_get_page_id' ) ) {
									echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) );
								}
								?>"
                                method="get" class="caption-content">
                            <h2 class="caption-title"><?php echo wp_kses_post( $atts['h'] ); ?></h2>

                            <h3 class="caption-subtitle"><?php echo wp_kses_post( $atts['sh'] ); ?></h3>
                            <!-- Search form -->
                            <div class="row">
                                <div class="col-sm-12 col-md-10 col-md-offset-1">

                                    <div class="form-search dark">
                                        <form action="#">
                                            <div class="form-title">
                                                <i class="fa fa-globe"></i>

                                                <h2><?php echo wp_kses_post( $atts['st'] ); ?></h2>
                                            </div>

                                            <div class="row row-inputs">
                                                <div class="container-fluid">
                                                    <div class="col-sm-6">
                                                        <div class="form-group has-icon has-label">
                                                            <label for="formSearchUpLocation">
																<?php esc_html_e( 'Picking Up Location', 'rentit' ); ?>
                                                            </label>
                                                            <input name="dropin" type="text"
                                                                   class="form-control formSearchUpLocation"
                                                                   id="formSearchUpLocation"
                                                                   value="<?php
															       if ( function_exists( 'rentit_get_date_s' ) ) {
																       rentit_get_date_s( 'dropin_location' );
															       }
															       ?>"
                                                                   placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>">
                                                            <span class="form-control-icon"><i
                                                                        class="fa fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group has-icon has-label">
                                                            <label for="formSearchUpDate">
																<?php esc_html_e( ' Picking Up Date', 'rentit' ); ?>
                                                            </label>
                                                            <input name="start_date" type="text" class="form-control"
                                                                   id="formSearchUpDate"
                                                                   value="<?php
															       if ( function_exists( 'rentit_get_date_s' ) ) {
																       rentit_get_date_s( 'dropin_date' );
															       }
															       ?>"
                                                                   placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                            <span class="form-control-icon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row row-inputs">
                                                <div class="container-fluid">
                                                    <div class="col-sm-6">
                                                        <div class="form-group has-icon has-label">
                                                            <label for="formSearchOffLocation">
																<?php esc_html_e( 'Dropping Off Location', 'rentit' ); ?>
                                                            </label>
                                                            <input name="dropoff" type="text"
                                                                   class="form-control formSearchUpLocation"
                                                                   id="formSearchOffLocation"
                                                                   value="<?php
															       if ( function_exists( 'rentit_get_date_s' ) ) {
																       rentit_get_date_s( 'dropoff_location' );
															       }
															       ?>"
                                                                   placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>">
                                                            <span class="form-control-icon"><i
                                                                        class="fa fa-map-marker"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group has-icon has-label">
                                                            <label for="formSearchOffDate">
																<?php esc_html_e( 'Dropping Off Date', 'rentit' ); ?>
                                                            </label>
                                                            <input name="end_date" type="text" class="form-control"
                                                                   id="formSearchOffDate"
                                                                   value="<?php
															       if ( function_exists( 'rentit_get_date_s' ) ) {
																       rentit_get_date_s( 'dropoff_date' );
															       }
															       ?>"
                                                                   placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                            <span class="form-control-icon"><i
                                                                        class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="row row-submit">
                                                <div class="container-fluid">
                                                    <div class="inner">
                                                        <i class="fa fa-plus-circle"></i>
                                                        <a href="<?php
														if ( function_exists( 'wc_get_page_id' ) ) {
															echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
														}

														?>">
															<?php esc_html_e( ' Advanced Search', 'rentit' ); ?>
                                                        </a>
                                                        <button type="submit" id="formSearchSubmit"
                                                                class="btn btn-submit btn-theme pull-right">
															<?php echo wp_kses_post( $atts['tb'] ); ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- /Search form -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /Slide 1 -->


	<?php

	return ob_get_clean();
}

add_shortcode( 'rentit_page_section_slider_v2', 'rentit_page_section_slider_v2' );
function rentit_page_section_slider_v2( $atts, $content ) {
	global $Rent_IT_class;
	$content = !empty( $content ) ? $content : " Vivamus in est sit amet risus rutrum facilisis sed ut mauris. Aenean
                                aliquam ex ut sem aliquet, eget vestibulum erat pharetra. Maecenas
                                vel
                                urna nulla. Mauris non risus pulvinar.";
	$atts = shortcode_atts(
		array(
			'h' => esc_html__( 'Find Your Car! Rent A Car Theme', 'rentit' ),
			'sh' => esc_html__( 'Find Best Rental Car', 'rentit' ),
			'st' => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
			'img_src' => '',
			'tb' => esc_html__( ' Find Car', 'rentit' ),
			'url' => '#',
			't_url' => esc_html__( 'See All Vehicles', 'rentit' ),
			'video' => ''
		), $atts
	);
	ob_start();
	if ( strlen( $atts['img_src'] ) < 1 ) {
		$atts['img_src'] = get_template_directory_uri() . '/img/preview/slider/slide-1.jpg';
	} else {
		$img = wp_get_attachment_image_src( $atts['img_src'], 'full' );
		$atts['img_src'] = $img[0];
		//$atts['img_src'] = $Rent_IT_class->trim_img_by_url( $img[0], 1920, 900 );
	}
	?>

    <!-- Slide 2 -->
    <div class="item slide2 ver2" style="  background-image: url('<?php echo esc_url( $atts['img_src'] ); ?>');">
		<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) {

			?>
            <input type="hidden" name="lang" value="<?php echo esc_html( ICL_LANGUAGE_CODE ); ?>">

			<?php
		} ?>
		<?php if ( isset( $atts['video']{2} ) ): ?>
            <div class="videoID">
                <iframe
                        src="<?php echo esc_url( get_youtube_embed_url( $atts['video'] ) ) ?>"
                        frameborder="0"></iframe>
            </div>
		<?php endif; ?>
        <div class="caption">
            <div class="container">
                <div class="div-table">
                    <div class="div-cell">
                        <div class="caption-content">
                            <!-- Search form -->
                            <div class="form-search light">
                                <form action="<?php
								if ( function_exists( 'wc_get_page_id' ) ) {
									echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
								}

								?>">
                                    <div class="form-title">
                                        <i class="fa fa-globe"></i>

                                        <h2><?php echo wp_kses_post( $atts['st'] ); ?></h2>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                            for="formSearchUpLocation2">     <?php esc_html_e( 'Picking Up Location', 'rentit' ); ?></label>
                                                    <input name="dropin" type="text"
                                                           class="form-control formSearchUpLocation"
                                                           id="formSearchUpLocation2"
                                                           placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropin_location' );
													       }
													       ?>"
                                                    >
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                            for="formSearchOffLocation2">   <?php esc_html_e( 'Dropping Off Location', 'rentit' ); ?></label>
                                                    <input name="dropoff" type="text"
                                                           class="form-control formSearchUpLocation"
                                                           id="formSearchOffLocation2"
                                                           placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropoff_location' );
													       }
													       ?>">
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                            for="formSearchUpDate2">    <?php esc_html_e( ' Picking Up Date', 'rentit' ); ?></label>
                                                    <input name="start_date" type="text" class="form-control"
                                                           id="formSearchUpDate2"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropin_date' );
													       }
													       ?>"
                                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label for="formSearchOffDate2">
														<?php esc_html_e( 'Dropping Off Date', 'rentit' ); ?></label>
                                                    <input name="end_date" type="text" class="form-control"
                                                           id="formSearchOffDate2"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropoff_date' );
													       }
													       ?>"

                                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-submit">
                                        <div class="container-fluid">
                                            <div class="inner">
                                                <i class="fa fa-plus-circle"></i> <a
                                                        href="<?php
														if ( function_exists( 'wc_get_page_id' ) ) {
															echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
														} ?>">
													<?php esc_html_e( ' Advanced Search', 'rentit' ); ?>
                                                </a>
                                                <button type="submit" id="formSearchSubmit2"
                                                        class="btn btn-submit btn-theme ripple-effect pull-right">
													<?php echo wp_kses_post( $atts['tb'] ); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /Search form -->

                            <h2 class="caption-subtitle"><?php echo wp_kses_post( $atts['h'] ); ?></h2>

                            <p class="caption-text">
								<?php echo wp_kses_post( $content ); ?>
                            </p>

                            <p class="caption-text">
								<?php if ( isset( $atts['t_url']{1}) ): ?>
                                    <a class="btn btn-theme ripple-effect btn-theme-md"
                                       href="<?php echo esc_url( $atts['url'] ); ?>">
										<?php echo wp_kses_post( $atts['t_url'] ); ?>
                                    </a>
								<?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slide 2 -->

	<?php

	return ob_get_clean();
}

add_shortcode( 'rentit_page_section_slider_v3', 'rentit_page_section_slider_v3' );
function rentit_page_section_slider_v3( $atts, $content ) {
	global $Rent_IT_class;
	$content = !empty( $content ) ? $content : esc_html__( 'Sales Up %45 Off', 'rentit' ) . '<br />' . esc_html__( 'All Rental Cars Start from 49$', 'rentit' );

	$atts = shortcode_atts(
		array(
			'h' => esc_html__( 'Best Deals', 'rentit' ),
			'sh' => esc_html__( 'For rental Cars', 'rentit' ),
			'st' => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
			'img_src' => '',
			'tb' => esc_html__( ' Find Car', 'rentit' ),
			'video' => ''
		), $atts
	);
	if ( strlen( $atts['img_src'] ) < 1 ) {
		$atts['img_src'] = get_template_directory_uri() . '/img/preview/slider/slide-2.jpg';
	} else {
		$img = wp_get_attachment_image_src( $atts['img_src'], 'full' );
		$atts['img_src'] = $img[0];
		//	$atts['img_src'] = $Rent_IT_class->trim_img_by_url( $img[0], 1920, 900 );
	}
	ob_start();
	?>

    <!-- Slide 3 -->
    <div class="item slide3 ver3" style="
            background-image: url('<?php echo esc_url( $atts['img_src'] ); ?>');">
		<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) {

			?>
            <input type="hidden" name="lang" value="<?php echo esc_html( ICL_LANGUAGE_CODE ); ?>">

			<?php
		} ?>
		<?php if ( isset( $atts['video']{2} ) ): ?>
            <div class="videoID">
                <iframe
                        src="<?php echo esc_url( get_youtube_embed_url( $atts['video'] ) ) ?>"
                        frameborder="0"></iframe>
            </div>
		<?php endif; ?>
        <div class="caption">
            <div class="container">
                <div class="div-table">
                    <div class="div-cell">
                        <div class="caption-content">
                            <!-- Search form -->
                            <div class="form-search light">
                                <form action="<?php
								if ( function_exists( 'wc_get_page_id' ) ) {
									echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
								}

								?>">
                                    <div class="form-title">
                                        <i class="fa fa-globe"></i>

                                        <h2><?php echo wp_kses_post( $atts['st'] ); ?></h2>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                            for="formSearchUpLocation2">     <?php esc_html_e( 'Picking Up Location', 'rentit' ); ?></label>
                                                    <input name="dropin" type="text"
                                                           class="form-control formSearchUpLocation"
                                                           placeholder="<?php esc_html_e( 'Airport or Anywhere',
														       'rentit' ); ?>"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropin_location' );
													       }
													       ?>"

                                                    >

                                                    <span class="form-control-icon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                            for="formSearchOffLocation2">   <?php esc_html_e( 'Dropping Off Location', 'rentit' ); ?></label>
                                                    <input name="dropoff" type="text"
                                                           class="form-control formSearchUpLocation"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropoff_location' );
													       }
													       ?>"
                                                           placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>">
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-map-marker"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label
                                                            for="formSearchUpDate500">    <?php esc_html_e( ' Picking Up Date', 'rentit' ); ?></label>
                                                    <input name="start_date" type="text" class="form-control"
                                                           id="formSearchUpDate500"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropin_date' );
													       }
													       ?>"
                                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-inputs">
                                        <div class="container-fluid">
                                            <div class="col-sm-12">
                                                <div class="form-group has-icon has-label">
                                                    <label for="formSearchOffDate500">
														<?php esc_html_e( 'Dropping Off Date', 'rentit' ); ?></label>
                                                    <input name="end_date" type="text" class="form-control"
                                                           id="formSearchOffDate500"
                                                           value="<?php
													       if ( function_exists( 'rentit_get_date_s' ) ) {
														       rentit_get_date_s( 'dropoff_date' );
													       }
													       ?>"
                                                           placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                    <span class="form-control-icon"><i
                                                                class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-submit">
                                        <div class="container-fluid">
                                            <div class="inner">
                                                <i class="fa fa-plus-circle"></i> <a
                                                        href="<?php
														if ( function_exists( 'wc_get_page_id' ) ) {
															echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
														} ?>">
													<?php esc_html_e( ' Advanced Search', 'rentit' ); ?>
                                                </a>
                                                <button type="submit" id="formSearchSubmit2"
                                                        class="btn btn-submit btn-theme ripple-effect pull-right">
													<?php echo wp_kses_post( $atts['tb'] ); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /Search form -->


                            <h2 class="caption-title"><?php echo wp_kses_post( $atts['sh'] ); ?>
                            </h2>

                            <h3 class="caption-subtitle"><?php echo wp_kses_post( $atts['h'] ); ?></h3>

                            <p class="caption-text">
								<?php echo wp_kses_post( $content ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function () {
                var nowDate = new Date();
                var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);


                jQuery('#formSearchUpDate500').datetimepicker({
                    minDate: today,
                    format: rentit_obj.date_format,
                    locale: rentit_obj.lang

                });
                jQuery('#formSearchOffDate500').datetimepicker({
                    minDate: today,
                    format: rentit_obj.date_format,
                    locale: rentit_obj.lang

                });


              /*  jQuery("#formSearchUpDate50").on("dp.change", function (e) {
                    jQuery("#formSearchOffDate50").data("DateTimePicker").minDate(e.date);
                });
                jQuery("#formSearchOffDate50").on("dp.change", function (e) {
                    jQuery("#formSearchUpDate50").data("DateTimePicker").minDate(e.date);
                });*/
            });

        </script>
    </div>


    <!-- /Slide 3 -->
	<?php

	return ob_get_clean();
}


add_shortcode( 'rentit_page_section_slider_v4', 'rentit_page_section_slider_v4' );
function rentit_page_section_slider_v4( $atts, $content ) {
	global $Rent_IT_class;
	$content = !empty( $content ) ? $content : esc_html__( 'Sales Up %45 Off', 'rentit' ) . '<br />' . esc_html__( 'All Rental Cars Start from 49$', 'rentit' );

	$atts = shortcode_atts(
		array(
			'h' => esc_html__( 'Best Deals', 'rentit' ),
			'sh' => esc_html__( 'For rental Cars', 'rentit' ),
			'st' => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
			'img_src' => '',
			'tb' => esc_html__( ' Find Car', 'rentit' ),
			'url' => '#',
			't_url' => esc_html__( 'See All Vehicles', 'rentit' ),
			'video' => ''
		), $atts
	);
	if ( strlen( $atts['img_src'] ) < 1 ) {
		$atts['img_src'] = get_template_directory_uri() . '/img/preview/slider/slide-3.jpg';
	} else {
		$img = wp_get_attachment_image_src( $atts['img_src'], 'full' );
		$atts['img_src'] = $img[0];
		//$atts['img_src'] = $Rent_IT_class->trim_img_by_url( $img[0], 1920, 900 );
	}
	ob_start();
	?>

    <!-- Slide 4 -->
    <div class="item slide4 ver4" style="
            background-image: url('<?php echo esc_url( $atts['img_src'] ); ?>');">
		<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) {

			?>
            <input type="hidden" name="lang" value="<?php echo esc_html( ICL_LANGUAGE_CODE ); ?>">

			<?php
		} ?>
		<?php if ( isset( $atts['video']{2} ) ): ?>
            <div class="videoID">
                <iframe
                        src="<?php echo esc_url( get_youtube_embed_url( $atts['video'] ) ) ?>"
                        frameborder="0"></iframe>
            </div>
		<?php endif; ?>

        <div class="caption">
            <div class="container">
                <div class="div-table">
                    <div class="div-cell">
                        <div class="caption-content">
                            <h2 class="caption-title"><?php echo wp_kses_post( $atts['sh'] ); ?></h2>

                            <h3 class="caption-subtitle"><span><?php echo wp_kses_post( $atts['h'] ); ?></span></h3>

                            <p class="caption-text">
								<?php echo wp_kses_post( $content ); ?>
                            </p>
                            <p class="caption-text">

	                            <?php if ( isset( $atts['t_url']{1})): ?>
                                    <a class="btn btn-theme ripple-effect btn-theme-md"
                                       href="<?php echo esc_url( $atts['url'] ); ?>">
			                            <?php echo wp_kses_post( $atts['t_url'] ); ?>
                                    </a>
	                            <?php endif; ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Slide 4 -->
	<?php

	return ob_get_clean();
}


add_shortcode( 'rentit_page_section_slider_v3_2', 'rentit_page_section_slider_v3_2' );
function rentit_page_section_slider_v3_2( $atts, $content ) {
	global $Rent_IT_class;
	$content = !empty( $content ) ? $content : esc_html__( 'Sales Up %45 Off', 'rentit' ) . '<br />' . esc_html__( 'All Rental Cars Start from 49$', 'rentit' );

	$atts = shortcode_atts(
		array(
			'h' => esc_html__( 'Best Deals', 'rentit' ),
			'sh' => esc_html__( 'For rental Cars', 'rentit' ),
			'st' => esc_html__( 'Search for Cheap Rental Cars Wherever Your Are', 'rentit' ),
			'img_src' => '',
			'tb' => esc_html__( ' Find Car', 'rentit' ),
			'video' => ''
		), $atts
	);
	if ( strlen( $atts['img_src'] ) < 1 ) {
		$atts['img_src'] = get_template_directory_uri() . '/img/preview/slider/slide-2.jpg';
	} else {
		$img = wp_get_attachment_image_src( $atts['img_src'], 'full' );
		$atts['img_src'] = $img[0];
		//$atts['img_src'] = $Rent_IT_class->trim_img_by_url( $img[0], 1920, 900 );
	}
	ob_start();
	?>

    <div class="item slide3 ver3 ver3_2" style="
            background-image: url('<?php echo esc_url( $atts['img_src'] ); ?>');">
		<?php if ( defined( 'ICL_LANGUAGE_CODE' ) ) {

			?>
            <input type="hidden" name="lang" value="<?php echo esc_html( ICL_LANGUAGE_CODE ); ?>">

			<?php
		} ?>
		<?php if ( isset( $atts['video']{2} ) ): ?>
            <div class="videoID">
                <iframe
                        src="<?php echo esc_url( get_youtube_embed_url( $atts['video'] ) ) ?>"
                        frameborder="0"></iframe>
            </div>
		<?php endif; ?>
        <div class="caption">
            <div class="container">
                <div class="div-table">
                    <div class="div-cell">
                        <div class="caption-content">
                            <!-- Search form -->
                            <div class="form-search light">

                                <div class="widget widget-tabs alt">
                                    <div class="widget-content">
                                        <div class="form-title">
                                            <!--i class="fa fa-globe"></i>

										<h2><?php echo wp_kses_post( $atts['st'] ); ?></h2-->
                                            <ul id="tabs" class="nav nav-justified">
                                                <li class="active"><a href="#tab-s1"
                                                                      data-toggle="tab"><?php esc_html_e( 'Reserve ', 'rentit' ); ?></a>
                                                </li>
                                                <li><a href="#tab-s2"
                                                       data-toggle="tab"><?php esc_html_e( 'o	Modify / Cancel ', 'rentit' ); ?></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <script>
                                            jQuery(document).ready(function ($) {

                                                $(document).on("click", '#tabs li', function (e) {
                                                    e.preventDefault();

                                                    itemPosition = $(this).index();

                                                    contentItem = jQuery('.ver3 .my_tabs_reser');
                                                    contentItem.removeClass('active in');
                                                    contentItem.eq(itemPosition + 2).addClass('active in'); //.siblings().removeClass('active');
                                                    // $(this).addClass('active');
                                                    // $(this).parent().siblings().children('a').removeClass('active');

                                                });
                                            });
                                        </script>


                                        <div class="tab-content">
                                            <!-- tab 1 -->
                                            <div class="tab-pane fade my_tabs_reser in active" id="tab-s1">
                                                <form action="<?php
												if ( function_exists( 'wc_get_page_id' ) ) {
													echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
												}

												?>">
                                                    <div class="recent-post">
                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label
                                                                                for="formSearchUpLocation2">     <?php esc_html_e( 'Picking Up Location', 'rentit' ); ?></label>
                                                                        <input name="dropin" type="text"
                                                                               class="form-control formSearchUpLocation"
                                                                               placeholder="<?php esc_html_e( 'Airport or Anywhere',
																			       'rentit' ); ?>"
                                                                               value="<?php
																		       if ( function_exists( 'rentit_get_date_s' ) ) {
																			       rentit_get_date_s( 'dropin_location' );
																		       }
																		       ?>"

                                                                        >

                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label
                                                                                for="formSearchOffLocation2">   <?php esc_html_e( 'Dropping Off Location', 'rentit' ); ?></label>
                                                                        <input name="dropoff" type="text"
                                                                               class="form-control formSearchUpLocation"
                                                                               value="<?php
																		       if ( function_exists( 'rentit_get_date_s' ) ) {
																			       rentit_get_date_s( 'dropoff_location' );
																		       }
																		       ?>"
                                                                               placeholder="<?php esc_html_e( 'Airport or Anywhere', 'rentit' ); ?>">
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-map-marker"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label
                                                                                for="formSearchUpDate50">    <?php esc_html_e( ' Picking Up Date', 'rentit' ); ?></label>
                                                                        <input name="start_date" type="text"
                                                                               class="form-control"
                                                                               id="formSearchUpDate50"
                                                                               value="<?php
																		       if ( function_exists( 'rentit_get_date_s' ) ) {
																			       rentit_get_date_s( 'dropin_date' );
																		       }
																		       ?>"
                                                                               placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate50">
																			<?php esc_html_e( 'Dropping Off Date', 'rentit' ); ?></label>
                                                                        <input name="end_date" type="text"
                                                                               class="form-control"
                                                                               id="formSearchOffDate50"
                                                                               value="<?php
																		       if ( function_exists( 'rentit_get_date_s' ) ) {
																			       rentit_get_date_s( 'dropoff_date' );
																		       }
																		       ?>"
                                                                               placeholder="<?php esc_html_e( 'dd/mm/yyyy', 'rentit' ); ?>">
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-calendar"></i></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row row-submit">
                                                            <div class="container-fluid">
                                                                <div class="inner">
                                                                    <i class="fa fa-plus-circle"></i> <a
                                                                            href="<?php
																			if ( function_exists( 'wc_get_page_id' ) ) {
																				echo esc_url( get_permalink( wc_get_page_id( ( 'shop' ) ) ) );
																			} ?>">
																		<?php esc_html_e( ' Advanced Search', 'rentit' ); ?>
                                                                    </a>
                                                                    <button type="submit" id="formSearchSubmit2"
                                                                            class="btn btn-submit btn-theme ripple-effect pull-right">
																		<?php echo wp_kses_post( $atts['tb'] ); ?>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                            <!-- tab 2 -->
                                            <div class="tab-pane fade  my_tabs_reser  " id="tab-s2">
                                                <form
                                                        action="<?php echo esc_url( rentit_get_permalink_by_template( 'template-order_edit.php' ) ); ?>"
                                                        method="get" class="recent-post2">
                                                    <div class="befor_tabs">
                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label
                                                                                for="formSearchUpDate50">    <?php esc_html_e( 'Reservation Number', 'rentit' ); ?></label>
                                                                        <input name="order_id" type="text"
                                                                               class="form-control"
                                                                               id="formSearchUpDate50"
                                                                               value=""
                                                                               placeholder="<?php esc_html_e( 'Reservation Number', 'rentit' ); ?>">
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-bars"></i></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row row-inputs">
                                                            <div class="container-fluid">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group has-icon has-label">
                                                                        <label for="formSearchOffDate50">
																			<?php esc_html_e( 'Last name', 'rentit' ); ?></label>
                                                                        <input name="last_name" type="text"
                                                                               class="form-control"
                                                                               id="formSearchOffDate50"
                                                                               value=""
                                                                               placeholder="<?php esc_html_e( 'Last name', 'rentit' ); ?>">
                                                                        <span class="form-control-icon"><i
                                                                                    class="fa fa-bars"></i></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row row-submit">
                                                        <div class="container-fluid">
                                                            <div class="inner">
                                                                <button type="submit" id="formSearchSubmit2"
                                                                        class="btn btn-submit btn-theme ripple-effect pull-right">
																	<?php esc_html_e( 'Proceed', 'rentit' ); ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>
                            <!-- /Search form -->


                            <h2 class="caption-title"><?php echo wp_kses_post( $atts['sh'] ); ?>
                            </h2>

                            <h3 class="caption-subtitle"><?php echo wp_kses_post( $atts['h'] ); ?></h3>

                            <p class="caption-text">
								<?php echo wp_kses_post( $content ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Slide 3 -->
	<?php

	return ob_get_clean();
}
