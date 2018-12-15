<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
$el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

$this->setGlobalTtaInfo();

$this->enqueueTtaScript();

$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$style = $atts['rentit_tab_style'];

$wrapper_class = '';
if( !empty($style) ){
    switch ($style) {
        case 'has-slider-tab':
            $wrapper_class = '';
            break;
        case 'content-tab':
            $wrapper_class = 'tabs-wrapper content-tabs';
            break;
        default:
            # code...
            break;
    }
}

$output = '<div class="'.esc_attr($wrapper_class).'">';
$output .= $this->getTemplateVariable( 'title' );
$output .= '<div>';
$output .= $this->getTemplateVariable( 'tabs-list-top' );
$output .= $this->getTemplateVariable( 'tabs-list-left' );
$output .= $this->getTemplateVariable( 'pagination-top' );
$output .= '<div class="tab-content">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable( 'pagination-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-right' );
$output .= '</div>';
$output .= '</div>';

echo wp_kses_post($output);

return;
