<?php
add_shortcode( 'rentit_present_block', 'rentit_present_block_fn' );

function rentit_present_block_fn( $atts, $content = '' ) {

	global $Rent_IT_class;
	$atts = shortcode_atts(
		array(
			'h_s' => esc_html__( 'What Do You Know About Us', 'rentit' ),
			'h' => esc_html__( 'Who We Are ?', 'rentit' ),
			'images' => '',
			'btn_r_t' => esc_html__( 'See All Vehicles', 'rentit' ),
			'btn_b_t' => esc_html__( 'Reservation Now', 'rentit' ),
			'btn_r_t_url' => '#',
			'btn_b_t_url' => '#',
			'items' => ''
		), $atts
	);
	$items_v = vc_param_group_parse_atts( $atts['items'] );

	$images = explode( ',', $atts['images'] );


	ob_start();

	?>
    <div class="row">
        <div class="col-md-6 wow fadeInLeft" data-wow-offset="200" data-wow-delay="100ms">
            <h2 class="section-title text-left">
                <small><?php echo wp_kses_post( $atts['h_s'] ); ?></small>
                <span><?php echo wp_kses_post( $atts['h'] ); ?></span>
            </h2>

			<?php echo wp_kses_post( str_replace( array( '<ul>', '<li>' ), array(
				' <ul class="list-icons">',
				' <li><i class="fa fa-check-circle"></i>'
			), do_shortcode( $content ) ) ); ?>
			<?php
			if ( $items_v ) {
				?>
                <ul class="list-icons"><?php
					foreach ( $items_v as $item ) {
						?>
                        <li><i class="fa fa-check-circle"></i><?php if ( isset( $item['title'] ) ) {
								echo wp_kses_post( $item['title'] );
							} ?></li>
						<?php
					}
					?>
                </ul>
				<?php

			} ?>
            <p class="btn-row">
				<?php if ( isset( $atts['btn_r_t']{1} ) ): ?>
                <a href="<?php echo esc_url( $atts['btn_r_t_url'] ); ?>"
                   class="btn btn-theme ripple-effect btn-theme-md"><?php echo wp_kses_post( $atts['btn_r_t'] ); ?></a>
				<?php endif; ?>
	            <?php if ( isset( $atts['btn_b_t']{1} ) ): ?>
                <a href="<?php echo esc_url( $atts['btn_b_t_url'] ); ?>"
                   class="btn btn-theme ripple-effect btn-theme-md btn-theme-transparent"><?php echo wp_kses_post( $atts['btn_b_t'] ); ?></a>
                <?php endif; ?>
            </p>
        </div>
        <div class="col-md-6 wow fadeInRight" data-wow-offset="200" data-wow-delay="300ms">
            <div class="owl-carousel img-carousel">

				<?php
				if ( !empty( $images ) ) {
					foreach ( $images as $id ) :
						$img_arr = wp_get_attachment_image_src( $id, 'full' );

						if ( isset( $img_arr[0] ) && !empty( $img_arr[0] ) ) {
							?>

                            <div class="item">

                                <a
                                        href="<?php echo esc_url( $img_arr[0] ); ?>"
                                        data-gal="prettyPhoto">
                                    <img class="img-responsive"
                                         src="<?php echo esc_url( $Rent_IT_class->trim_img_by_url( $img_arr[0], 550, 350 ) ); ?>"
                                         alt=""/>
                                </a>
                            </div>
						<?php } ?>

					<?php endforeach;
				} ?>

            </div>
        </div>
    </div>


    <!-- /PAGE -->
	<?php
	return ob_get_clean();
}

?>