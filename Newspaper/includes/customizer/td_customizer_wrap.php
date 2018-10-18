<?php

//used by /wp_cake_config/td_customizer.php


if( class_exists( 'WP_Customize_Control' ) ) {
    class WP_Customize_td_separator_Control extends WP_Customize_Control {
        public $type = 'td_label';

        public function render_content() {
            ?>
            <div class="td-customizer-separator">
                <?php echo esc_html( $this->label ); ?>
            </div>
        <?php
        }
    }


    class WP_Customize_td_text_area_Control extends WP_Customize_Control {
        public $type = 'td_text_area';

        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
            </label>
        <?php
        }
    }

}


class td_customizer_wrap {

    var $wp_customize;
    var $last_section_id;
    var $last_setting_id;

    var $td_priority;


    function __construct($wp_customize) {
        $this->wp_customize = $wp_customize;
        $this->last_section_id = '';
        $this->td_priority = 21;
        $this->td_control_priority = 1;



    }


    function add_section($title, $section_id = '', $priority = false) {
        if (empty($section_id)) {
            $section_id = str_replace(' ', '_', trim(strtolower($title)));
        }


        if ($priority === false) {
            $priority = $this->td_priority;
        }

        $this->wp_customize->add_section($section_id, array(
            'title' => TD_THEME_NAME . ' : ' . $title,
            'priority' => $priority,
        ));
        $this->last_section_id = $section_id;

        $this->td_priority++;
    }




    function add_radio($title, $setting_id, $parms) {
        $this->last_setting_id = $setting_id;

        $td_default_selected_id = '';
        foreach ($parms as $parm_id => $parm_value) {
            $td_default_selected_id = $parm_id;
            break;
        }
        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']', array(
            'default' => $td_default_selected_id,
            'type' => 'option',
            'capability' => 'edit_theme_options',
        ));
        $this->wp_customize->add_control('tdc_' . $setting_id, array(
            'label' => $title,
            'section' => $this->last_section_id,
            'settings' => TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']',
            'type' => 'radio',
            'choices' => $parms,
            'priority' => $this->td_control_priority
        ));


        $this->td_control_priority++;
    }


    function add_select($title, $setting_id, $parms) {
        $this->last_setting_id = $setting_id;

        $td_default_selected_id = '';
        foreach ($parms as $parm_id => $parm_value) {
            $td_default_selected_id = $parm_id;
            break;
        }
        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']', array(
            'default' => $td_default_selected_id,
            'type' => 'option',
            'capability' => 'edit_theme_options',
        ));
        $this->wp_customize->add_control('tdc_' . $setting_id, array(
            'label' => $title,
            'section' => $this->last_section_id,
            'settings' => TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']',
            'type' => 'select',
            'choices' => $parms,
            'priority' => $this->td_control_priority
        ));

        $this->td_control_priority++;
    }


    function add_color($title, $setting_id, $default = '#FFFFFF') {
        //theme color
        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']', array(
            'default' => $default,
            'type' => 'option'
        ));

        $this->wp_customize->add_control(new WP_Customize_Color_Control($this->wp_customize, 'tds_' . $setting_id, array(
            'label'   => $title,
            'section' => $this->last_section_id,
            'settings'   => TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']',
            'priority' => $this->td_control_priority
        )));

        $this->td_control_priority++;
    }

    function add_input($title, $setting_id, $default = '') {
        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']', array(
            'default'       => $default,
            'type'          => 'option'
        ));

        $this->wp_customize->add_control('tds_' . $setting_id, array(
            'label'      => $title,
            'section'    => $this->last_section_id,
            'settings'   => TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']',
            'type'       => 'text',
            'priority' => $this->td_control_priority
        ) );

        $this->td_control_priority++;
    }

    function add_image_upload($title, $setting_id, $default = '') {
        //custom logo
        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']', array(
            'default' => $default,
            'type' => 'option'
        ));

        $this->wp_customize->add_control( new WP_Customize_Image_Control( $this->wp_customize, 'tds_' . $setting_id, array(
            'label'   => $title,
            'section' => $this->last_section_id,
            'settings'   => TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']',
            'priority' => $this->td_control_priority
        )));

        $this->td_control_priority++;
    }

    function add_td_separator($title, $setting_id) {
        //make 1 separator dummy setting :)
        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_separator' . $setting_id . ']', array(
            'default' => '',
            'type' => 'option'
        ));

        //settings separator
        $this->wp_customize->add_control( new WP_Customize_td_separator_Control( $this->wp_customize, 'tds_' . $setting_id, array(
            'label'   => $title,
            'section' => $this->last_section_id,
            'settings'   => TD_THEME_OPTIONS_NAME . '[tds_separator' . $setting_id . ']',
            'priority' => $this->td_control_priority
        )));

        $this->td_control_priority++;
    }


    function add_td_textarea($title, $setting_id, $default = '') {

        $this->wp_customize->add_setting(TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']', array(
            'default'       => $default,
            'type'          => 'option'
        ));

        $this->wp_customize->add_control( new WP_Customize_td_text_area_Control( $this->wp_customize, 'tds_' . $setting_id, array(
            'label'      => $title,
            'section'    => $this->last_section_id,
            'settings'   => TD_THEME_OPTIONS_NAME . '[tds_' . $setting_id . ']',
            'type'       => 'text',
            'priority' => $this->td_control_priority
        )));

        $this->td_control_priority++;
    }



    function render($settings_map) {
        foreach ($settings_map as $setting) {
            switch ($setting['command']) {
                case 'add_section':
                    $this->add_section($setting['title'], $setting['section_id'], $setting['priority']);
                    break;
                case 'add_radio':
                    $this->add_radio($setting['title'], $setting['section_id'], $setting['parms']);
                    break;
                case 'add_select':
                    $this->add_select($setting['title'], $setting['section_id'], $setting['parms']);
                    break;
                case 'add_color':
                    $this->add_color($setting['title'], $setting['section_id'], $setting['default']);
                    break;
                case 'add_input':
                    $this->add_input($setting['title'], $setting['section_id'], $setting['default']);
                    break;
                case 'add_image_upload':
                    $this->add_image_upload($setting['title'], $setting['section_id'], $setting['default']);
                    break;
                case 'add_td_separator':
                    $this->add_td_separator($setting['title'], $setting['section_id']);
                    break;
                case 'add_td_textarea':
                    $this->add_td_textarea($setting['title'], $setting['section_id'], $setting['default']);
                    break;
            }
        }
    }
}




//render the customizer panel
function td_register_customizer($wp_customize) {
    $td_customizer = new td_customizer_wrap($wp_customize);
    $td_customizer->render(td_util::$td_customizer_settings->get_map());

}



add_action('customize_register', 'td_register_customizer');

?>