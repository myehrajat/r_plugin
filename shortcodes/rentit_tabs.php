<?php
if (!defined('ABSPATH')) {
    die('-1');
}
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Accordion');

class WPBakeryShortCode_rentit_Tabs extends WPBakeryShortCode_VC_Tta_Accordion
{

    public $layout = 'tabs';

    public function enqueueTtaScript()
    {
       
    }

    public function getTtaPaginationClasses()
    {
       
        return null;
    }

    public function getWrapperAttributes()
    {
   
    }

    public function getTtaGeneralClasses()
    {
        

        return 'tabs-wrapper content-tabs';
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamTabPosition($atts, $content)
    {
        return 'tabs-wrapper content-tabs';

    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamTabsListTop($atts, $content)
    {
        if (empty($atts['tab_position']) || 'top' !== $atts['tab_position']) {
            return null;
        }

        return $this->getParamTabsList($atts, $content);
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamTabsListBottom($atts, $content)
    {
        if (empty($atts['tab_position']) || 'bottom' !== $atts['tab_position']) {
            return null;
        }

        return $this->getParamTabsList($atts, $content);
    }

    /**
     * Pagination is on top only if tabs are at bottom
     *
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamPaginationTop($atts, $content)
    {
        if (empty($atts['tab_position']) || 'bottom' !== $atts['tab_position']) {
            return null;
        }

        return $this->getParamPaginationList($atts, $content);
    }

    /**
     * Pagination is at bottom only if tabs are on top
     *
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamPaginationBottom($atts, $content)
    {
        if (empty($atts['tab_position']) || 'top' !== $atts['tab_position']) {
            return null;
        }

        return $this->getParamPaginationList($atts, $content);
    }

    /**
     * @param $atts
     *
     * @return string
     */
    function constructIcon($atts)
    {
        vc_icon_element_fonts_enqueue($atts['i_type']);

        $class = 'vc_tta-icon';

        if (isset($atts['i_icon_' . $atts['i_type']])) {
            $class .= ' ' . $atts['i_icon_' . $atts['i_type']];
        } else {
            $class .= ' fa fa-adjust';
        }

        return '<i class="' . $class . '"></i>';
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string
     */
    public function getParamTabsList($atts, $content)
    {
        $isPageEditabe = vc_is_page_editable();
        $html = array();

        $html[] = '<ul class="nav nav-tabs">';
        if (!$isPageEditabe) {
            $strict_bounds = ('vc_tta_tabs' === $this->shortcode);
            $active_section = $this->getActiveSection($atts, $strict_bounds);

            foreach (WPBakeryShortCode_VC_Tta_Section::$section_info as $nth => $section) {
                $classes = array('vc_tta-tab');
                if (($nth + 1) === $active_section) {
                    $classes[] = $this->activeClass;
                }

                $title = '<span class="vc_tta-title-text">' . $section['title'] . '</span>';
                if ('true' === $section['add_icon']) {
                    $icon_html = $this->constructIcon($section);
                    if ('left' === $section['i_position']) {
                        $title = $icon_html . $title;
                    } else {
                        $title = $title . $icon_html;
                    }
                }
                $a_html = '<a href="#' . $section['tab_id'] . '" data-toggle="tab">' . $title . '</a>';
                $html[] = '<li class="' . str_replace(array('vc_active', 'vc_tta-tab'), array('active', ''), implode(' ', $classes)) . '" >' . $a_html . '</li>';
            }
        }

        $html[] = '</ul>';


        return implode('', apply_filters('vc-tta-get-params-tabs-list', $html, $atts, $content, $this));
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamAlignment($atts, $content)
    {
        if (isset($atts['alignment']) && strlen($atts['alignment']) > 0) {
            return 'vc_tta-controls-align-' . $atts['alignment'];
        }

        return null;
    }
}


///////////////////////vc_tta_section/////////////////////////////////////////*

/******************************-------------------------------------------**********************/
class WPBakeryShortCode_rentit_tta_section extends WPBakeryShortCode_VC_Tta_Accordion
{
    protected $controls_css_settings = 'tc vc_control-container';
    protected $controls_list = array('add', 'edit', 'clone', 'delete');
    protected $backened_editor_prepend_controls = false;
    /**
     * @var WPBakeryShortCode_VC_Tta_Accordion
     */
    public static $tta_base_shortcode;
    public static $self_count = 0;
    public static $section_info = array();

    public function getFileName()
    {
        if (isset(self::$tta_base_shortcode) && 'vc_tta_pageable' === self::$tta_base_shortcode->getShortcode()) {
            return 'vc_tta_pageable_section';
        } else {
            return 'vc_tta_section';
        }
    }

    public function containerContentClass()
    {
        return 'wpb_column_container vc_container_for_children vc_clearfix';
    }

    public function getElementClasses()
    {
        $classes = array();
        $classes[] = 'vc_tta-panel';
        $isActive = !vc_is_page_editable() && $this->getTemplateVariable('section-is-active');

        if ($isActive) {
            $classes[] = $this->activeClass;
        }

        /**
         * @since 4.6.2
         */
        if (isset($this->atts['el_class'])) {
            $classes[] = $this->atts['el_class'];
        }

        return implode(' ', array_filter($classes));
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string
     */
    public function getParamContent($atts, $content)
    {
        return wpb_js_remove_wpautop($content);
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamTabId($atts, $content)
    {
        if (isset($atts['tab_id']) && strlen($atts['tab_id']) > 0) {
            return $atts['tab_id'];
        }

        return null;
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamTitle($atts, $content)
    {
        if (isset($atts['title']) && strlen($atts['title']) > 0) {
            return $atts['title'];
        }

        return null;
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamIcon($atts, $content)
    {
        if (!empty($atts['add_icon']) && 'true' === $atts['add_icon']) {
            $iconClass = '';
            if (isset($atts['i_icon_' . $atts['i_type']])) {
                $iconClass = $atts['i_icon_' . $atts['i_type']];
            }
            vc_icon_element_fonts_enqueue($atts['i_type']);

            return '<i class="vc_tta-icon ' . esc_attr($iconClass) . '"></i>';
        }

        return null;
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamIconLeft($atts, $content)
    {
        if ('left' === $atts['i_position']) {
            return $this->getParamIcon($atts, $content);
        }

        return null;
    }

    /**
     * @param $atts
     * @param $content
     *
     * @return string|null
     */
    public function getParamIconRight($atts, $content)
    {
        if ('right' === $atts['i_position']) {
            return $this->getParamIcon($atts, $content);
        }

        return null;
    }

    /**
     * Section param active
     */
    public function getParamSectionIsActive($atts, $content)
    {
        if (is_object(self::$tta_base_shortcode)) {
            if (isset(self::$tta_base_shortcode->atts['active_section']) && strlen(self::$tta_base_shortcode->atts['active_section']) > 0) {
                $active = (int)self::$tta_base_shortcode->atts['active_section'];
                if ($active === self::$self_count) {
                    return true;
                }
            }
        }

        return null;
    }

    public function getParamControlIconPosition($atts, $content)
    {
        if (is_object(self::$tta_base_shortcode)) {
            if (
                isset(self::$tta_base_shortcode->atts['c_icon']) && strlen(self::$tta_base_shortcode->atts['c_icon']) > 0 &&
                isset(self::$tta_base_shortcode->atts['c_position']) && strlen(self::$tta_base_shortcode->atts['c_position']) > 0
            ) {
                $c_position = self::$tta_base_shortcode->atts['c_position'];

                return 'vc_tta-controls-icon-position-' . $c_position;
            }
        }

        return null;
    }

    public function getParamControlIcon($atts, $content)
    {
        if (is_object(self::$tta_base_shortcode)) {
            if (isset(self::$tta_base_shortcode->atts['c_icon']) && strlen(self::$tta_base_shortcode->atts['c_icon']) > 0) {
                $c_icon = self::$tta_base_shortcode->atts['c_icon'];

                return '<i class="vc_tta-controls-icon vc_tta-controls-icon-' . $c_icon . '"></i>';
            }
        }

        return null;
    }

    public function getParamHeading($atts, $content)
    {
        $isPageEditable = vc_is_page_editable();

        $h4attributes = array();
        $h4classes = array(
            'vc_tta-panel-title',
        );
        if ($isPageEditable) {
            $h4attributes[] = 'data-vc-tta-controls-icon-position=""';
        } else {
            $controlIconPosition = $this->getTemplateVariable('control-icon-position');
            if ($controlIconPosition) {
                $h4classes[] = $controlIconPosition;
            }
        }
        $h4attributes[] = 'class="' . implode(' ', $h4classes) . '"';

        $output = '<h4 ' . implode(' ', $h4attributes) . '>'; // close h4

        if ($isPageEditable) {
            $output .= '<a href="javascript:;" data-vc-target=""';
            $output .= ' data-vc-tta-controls-icon-wrapper';
            $output .= ' data-vc-use-cache="false"';
        } else {
            $output .= '<a href="#' . esc_attr($this->getTemplateVariable('tab_id')) . '"';
        }

        $output .= ' data-vc-accordion';

        $output .= ' data-vc-container=".vc_tta-container">';
        $output .= $this->getTemplateVariable('icon-left');
        $output .= '<span class="vc_tta-title-text">'
            . $this->getTemplateVariable('title')
            . '</span>';
        $output .= $this->getTemplateVariable('icon-right');
        if (!$isPageEditable) {
            $output .= $this->getTemplateVariable('control-icon');
        }

        $output .= '</a>';
        $output .= '</h4>'; // close h4 fix #2229

        return $output;
    }

    /**
     * Get basic heading
     *
     * These are used in Pageable element inside content and are hidden from view
     *
     * @param $atts
     * @param $content
     *
     * @return string
     */
    public function getParamBasicHeading($atts, $content)
    {
        $isPageEditable = vc_is_page_editable();

        if ($isPageEditable) {
            $attributes = array(
                'href' => 'javascript:;',
                'data-vc-container' => '.vc_tta-container',
                'data-vc-accordion' => '',
                'data-vc-target' => '',
                'data-vc-tta-controls-icon-wrapper' => '',
                'data-vc-use-cache' => 'false',
            );
        } else {
            $attributes = array(
                'data-vc-container' => '.vc_tta-container',
                'data-vc-accordion' => '',
                'data-vc-target' => esc_attr('#' . $this->getTemplateVariable('tab_id')),
            );
        }

        $output = '
			<span class="vc_tta-panel-title">
				<a ' . vc_convert_atts_to_string($attributes) . '></a>
			</span>
		';

        return $output;
    }

    /**
     * Check is allowed to add another element inside current element.
     *
     * @since 4.8
     *
     * @return bool
     */
    public function getAddAllowed()
    {
        return vc_user_access()
            ->part('shortcodes')
            ->checkStateAny(true, 'custom', null)->get();
    }
}


add_action('vc_before_init', 'rentit_subtitle_integrateWithVC2');
/**
 *
 */
function rentit_subtitle_integrateWithVC2()
{
    vc_map(
        array(
            'name' => esc_html__('Rentit Tabs', 'js_composer'),
            'base' => 'rentit_tabs',
            "icon" => get_template_directory_uri() . "/img/rentit.png", // Simply pass url to your icon here
            'is_container' => true,
            'show_settings_on_create' => false,
            'as_parent' => array(
                'only' => 'rentit_tta_section',
            ),
            "category" => esc_html__("Rent It", 'rentit'),
            'description' => esc_html__('Tabbed content', 'js_composer'),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'title',
                    'heading' => esc_html__('Widget title', 'js_composer'),
                    'description' => esc_html__('Enter text used as widget title (Note: located above content element).', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'style',
                    'value' => array(
                        esc_html__('Classic', 'js_composer') => 'classic',
                        esc_html__('Modern', 'js_composer') => 'modern',
                        esc_html__('Flat', 'js_composer') => 'flat',
                        esc_html__('Outline', 'js_composer') => 'outline',
                    ),
                    'heading' => esc_html__('Style', 'js_composer'),
                    'description' => esc_html__('Select tabs display style.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'shape',
                    'value' => array(
                        esc_html__('Rounded', 'js_composer') => 'rounded',
                        esc_html__('Square', 'js_composer') => 'square',
                        esc_html__('Round', 'js_composer') => 'round',
                    ),
                    'heading' => esc_html__('Shape', 'js_composer'),
                    'description' => esc_html__('Select tabs shape.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'color',
                    'heading' => esc_html__('Color', 'js_composer'),
                    'description' => esc_html__('Select tabs color.', 'js_composer'),
                    'value' => getVcShared('colors-dashed'),
                    'std' => 'grey',
                    'param_holder_class' => 'vc_colored-dropdown',
                ),
                array(
                    'type' => 'checkbox',
                    'param_name' => 'no_fill_content_area',
                    'heading' => esc_html__('Do not fill content area?', 'js_composer'),
                    'description' => esc_html__('Do not fill content area with color.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'spacing',
                    'value' => array(
                        esc_html__('None', 'js_composer') => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html__('Spacing', 'js_composer'),
                    'description' => esc_html__('Select tabs spacing.', 'js_composer'),
                    'std' => '1',
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'gap',
                    'value' => array(
                        esc_html__('None', 'js_composer') => '',
                        '1px' => '1',
                        '2px' => '2',
                        '3px' => '3',
                        '4px' => '4',
                        '5px' => '5',
                        '10px' => '10',
                        '15px' => '15',
                        '20px' => '20',
                        '25px' => '25',
                        '30px' => '30',
                        '35px' => '35',
                    ),
                    'heading' => esc_html__('Gap', 'js_composer'),
                    'description' => esc_html__('Select tabs gap.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'tab_position',
                    'value' => array(
                        esc_html__('Top', 'js_composer') => 'top',
                        esc_html__('Bottom', 'js_composer') => 'bottom',
                    ),
                    'heading' => esc_html__('Position', 'js_composer'),
                    'description' => esc_html__('Select tabs navigation position.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html__('Left', 'js_composer') => 'left',
                        esc_html__('Right', 'js_composer') => 'right',
                        esc_html__('Center', 'js_composer') => 'center',
                    ),
                    'heading' => esc_html__('Alignment', 'js_composer'),
                    'description' => esc_html__('Select tabs section title alignment.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'autoplay',
                    'value' => array(
                        esc_html__('None', 'js_composer') => 'none',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '10' => '10',
                        '20' => '20',
                        '30' => '30',
                        '40' => '40',
                        '50' => '50',
                        '60' => '60',
                    ),
                    'std' => 'none',
                    'heading' => esc_html__('Autoplay', 'js_composer'),
                    'description' => esc_html__('Select auto rotate for tabs in seconds (Note: disabled by default).', 'js_composer'),
                ),
                array(
                    'type' => 'textfield',
                    'param_name' => 'active_section',
                    'heading' => esc_html__('Active section', 'js_composer'),
                    'value' => 1,
                    'description' => esc_html__('Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_style',
                    'value' => array(
                        esc_html__('None', 'js_composer') => '',
                        esc_html__('Square Dots', 'js_composer') => 'outline-square',
                        esc_html__('Radio Dots', 'js_composer') => 'outline-round',
                        esc_html__('Point Dots', 'js_composer') => 'flat-round',
                        esc_html__('Fill Square Dots', 'js_composer') => 'flat-square',
                        esc_html__('Rounded Fill Square Dots', 'js_composer') => 'flat-rounded',
                    ),
                    'heading' => esc_html__('Pagination style', 'js_composer'),
                    'description' => esc_html__('Select pagination style.', 'js_composer'),
                ),
                array(
                    'type' => 'dropdown',
                    'param_name' => 'pagination_color',
                    'value' => getVcShared('colors-dashed'),
                    'heading' => esc_html__('Pagination color', 'js_composer'),
                    'description' => esc_html__('Select pagination color.', 'js_composer'),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'std' => 'grey',
                    'dependency' => array(
                        'element' => 'pagination_style',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Extra class name', 'js_composer'),
                    'param_name' => 'el_class',
                    'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer'),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => esc_html__('CSS box', 'js_composer'),
                    'param_name' => 'css',
                    'group' => esc_html__('Design Options', 'js_composer'),
                ),
            ),
            'js_view' => 'VcBackendTtaTabsView',
            'custom_markup' => '
<div class="vc_tta-container2" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
                . '<ul class="vc_tta-tabs-list">'
                . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
                . '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
            'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', esc_html__('Tab', 'js_composer'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', esc_html__('Tab', 'js_composer'), 2) . '"][/vc_tta_section]
	',
            'admin_enqueue_js' => array(
                vc_asset_url('lib/vc_tabs/vc-tabs.min.js'),
            ),
        )
    );


}











