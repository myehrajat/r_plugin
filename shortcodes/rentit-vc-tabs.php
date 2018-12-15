<?php

/**
 * Modify default tab element.
 * @package Rent It
 * @since Rent It 1.0
 */


// Use defaut tab element.
// Add new param.

$attributes = array(
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Disable default tab styles?', 'rentit' ),
        'param_name' => 'disable_default_style',
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Enable solid bar?', 'rentit' ),
        'param_name' => 'enable_solid_bar',
    ),
    array(
        'type'	=> 'hidden',
        'param_name' => 'rentit_tab_hidden',
        'value' => 'yes_rentit_tab'
    ),
);
vc_add_params( 'vc_tta_tabs', $attributes );
