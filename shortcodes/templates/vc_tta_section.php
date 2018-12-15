<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

$output = '';

$output .= '<div class="tab-pane  ' . esc_attr( str_replace( array('vc_active','vc_tta-panel') , array('in active',''),$this->getElementClasses() )) . '"';
$output .= ' id="' . esc_attr( $this->getTemplateVariable( 'tab_id' ) ) . '"';
$output .= '>';



if ( $isPageEditable ) {
    $output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable( 'content' );
if ( $isPageEditable ) {
    $output .= '</div>';
}
$output .= '</div>';


echo rentit_esc_js($output);
