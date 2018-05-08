<?php
/**
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/* Settings & Controls Render Functions
/*-----------------------------------------------------------------------------------*/

// Render Panel
function realistic_customizer_render_panel( $panel_name, $title, $priority ) {
    global $wp_customize;
    if ( isset( $title ) && isset( $panel_name ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }

        $wp_customize->add_panel(
            $panel_name, array(
                'priority'	=> $priority,
                'title'		=> $title,
            )
        );
    }
}

// Render Section
function realistic_customizer_render_section( $section_name, $title, $panel_name, $priority ) {
    global $wp_customize;
    if ( isset( $title ) && isset( $section_name ) && isset( $panel_name ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }

        $wp_customize->add_section( 
            $section_name, array(
                'priority'	=> $priority,
                'title'		=> $title,
                'panel'		=> $panel_name,
            ) 
        );


    }
}

// Render Switcher
function realistic_customizer_render_switcher( $control_name, $section, $label, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = 1; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'     		=> $default,
                'sanitize_callback' => 'realistic_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            new Realistic_Customizer_Switcher_Control(
                $wp_customize,				
                $control_name,
                array(
                    'type' 			=> 'checkbox',
                    'label'			=> $label,
                    'description'	=> $description,
                    'section'		=> $section,
                    'priority'		=> $priority,
                )
            )
        );
    }
}

// Render Checkbox
function realistic_customizer_render_checkbox( $control_name, $section, $label, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = 1; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'              => $default,
                'sanitize_callback'    => 'realistic_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'         => 'checkbox',
                'label'        => $label,
                'description'  => $description,
                'section'      => $section,
                'priority'     => $priority,
            )
        );
    }
}

// Render Textfield
function realistic_customizer_render_textfield( $control_name, $section, $label, $priority, $default, $description, $sanitize_callback ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }
        if ( !isset( $sanitize_callback ) ) { $sanitize_callback = 'realistic_sanitize_text'; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => $sanitize_callback,
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'			=> 'textfield',
                'label'			=> $label,
                'description'	=> $description,
                'section'		=> $section,
                'priority'		=> $priority,
            )
        );
    }
}

// Render Textarea
function realistic_customizer_render_textarea( $control_name, $section, $label, $priority, $default, $description, $sanitize_callback ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }
        if ( !isset( $sanitize_callback ) ) { $sanitize_callback = 'realistic_sanitize_text'; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => $sanitize_callback,
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'			=> 'textarea',
                'label'			=> $label,
                'description'	=> $description,
                'section'		=> $section,
                'priority'		=> $priority,
            )
        );
    }
}

// Render Uploader
function realistic_customizer_render_uploader( $control_name, $section, $label, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                $control_name,
                array(
                    'label'			=> $label,
                    'description'	=> $description,
                    'section'		=> $section,
                    'priority'		=> $priority,
                )
            )
        );
    }
}

// Render Color Picker
function realistic_customizer_render_color( $control_name, $section, $label, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $control_name,
                array(
                    'label'			=> $label,
                    'description'	=> $description,
                    'section'		=> $section,
                    'priority'		=> $priority,
                )
            )
        );
    }
}

// Render Radio
function realistic_customizer_render_radio( $control_name, $section, $label, $choices, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) && isset( $choices ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => 'realistic_sanitize_choices',
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'			=> 'radio',
                'label'			=> $label,
                'description'	=> $description,
                'section'		=> $section,
                'priority'		=> $priority,
                'choices'		=> $choices,
            )
        );
    }
}

// Render Radio-Image
function realistic_customizer_render_radio_image( $control_name, $section, $label, $choices, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) && isset( $choices ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => 'realistic_sanitize_choices',
            )
        );

        $wp_customize->add_control(
            new Realistic_Customizer_Radio_Image_Control(
                $wp_customize,				
                $control_name,
                array(
                    'label'			=> $label,
                    'description'	=> $description,
                    'section'		=> $section,
                    'priority'		=> $priority,
                    'choices'		=> $choices,
                )
            )
        );
    }
}

// Render Radio-Button
function realistic_customizer_render_radio_button( $control_name, $section, $label, $choices, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) && isset( $choices ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => 'realistic_sanitize_choices',
            )
        );

        $wp_customize->add_control(
            new Realistic_Customizer_Radio_Button_Control(
                $wp_customize,				
                $control_name,
                array(
                    'label'			=> $label,
                    'description'	=> $description,
                    'section'		=> $section,
                    'priority'		=> $priority,
                    'choices'		=> $choices,
                )
            )
        );
    }
}

// Render Select
function realistic_customizer_render_select( $control_name, $section, $label, $choices, $priority, $default, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) && isset( $choices ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $default ) ) { $default = ''; }
        if ( !isset( $description ) ) { $description = ''; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => 'realistic_sanitize_choices',
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'			=> 'select',
                'label'			=> $label,
                'description'	=> $description,
                'section'		=> $section,
                'priority'		=> $priority,
                'choices'		=> $choices,
            )
        );
    }
}

// Render Range
function realistic_customizer_render_range( $control_name, $section, $label, $priority, $default, $min, $max, $description, $sanitize_callback ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $min ) ) { $min = 0; }
        if ( !isset( $max ) ) { $max = 100; }
        if ( !isset( $default ) ) { $default = 0; }
        if ( !isset( $description ) ) { $description = ''; }
        if ( !isset( $sanitize_callback ) ) { $sanitize_callback = 'realistic_sanitize_posint'; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => $sanitize_callback,
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'          => 'range',
                'label'			=> $label,
                'description'	=> $description,
                'section'		=> $section,
                'priority'		=> $priority,
                'input_attrs'   => array(
                    'min'       => $min,
                    'max'       => $max,
                    'step'      => 1,
                ),
            )
        );
    }
}

// Render Number
function realistic_customizer_render_number( $control_name, $section, $label, $priority, $default, $min, $max, $description, $sanitize_callback ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $min ) ) { $min = 0; }
        if ( !isset( $max ) ) { $max = 100; }
        if ( !isset( $default ) ) { $default = 0; }
        if ( !isset( $description ) ) { $description = ''; }
        if ( !isset( $sanitize_callback ) ) { $sanitize_callback = 'realistic_sanitize_posint'; }

        $wp_customize->add_setting( 
            $control_name , array(
                'default'			=> $default,
                'sanitize_callback' => $sanitize_callback,
            )
        );

        $wp_customize->add_control(
            $control_name,
            array(
                'type'          => 'number',
                'label'			=> $label,
                'description'	=> $description,
                'section'		=> $section,
                'priority'		=> $priority,
                'input_attrs'   => array(
                    'min'       => $min,
                    'max'       => $max,
                    'step'      => 1,
                ),
            )
        );
    }
}

// Render Background
function realistic_customizer_render_background( $control_name, $section, $label, $priority, $defaults, $description ) {
    global $wp_customize;
    if ( isset( $label ) && isset( $control_name ) && isset( $section ) ) {

        if ( !isset( $priority ) ) { $priority = 20; }
        if ( !isset( $description ) ) { $description = ''; }

        $defaults['repeat'] = ( array_key_exists( 'repeat', $defaults ) )? $defaults['repeat']: 'repeat';
        $defaults['size'] = ( array_key_exists( 'size', $defaults ) )? $defaults['size']: 'auto';
        $defaults['position'] = ( array_key_exists( 'position', $defaults ) )? $defaults['position']: 'left-top';
        $defaults['attach'] = ( array_key_exists( 'attach', $defaults ) )? $defaults['attach']: 'scroll';

        $wp_customize->add_setting(
            $control_name .'_image_url', array(
                'sanitize_callback' => 'esc_url',
                'type'              => 'theme_mod',
           )
        );

        $wp_customize->add_setting(
            $control_name .'_image_id', array(
                'sanitize_callback' => 'absint',
                'type'              => 'theme_mod',
           )
        );

        $wp_customize->add_setting(
            $control_name .'_repeat', array(
                'default'           => $defaults['repeat'],
                'sanitize_callback' => 'sanitize_text_field',
                'type'              => 'theme_mod',
           )
        );

        $wp_customize->add_setting(
            $control_name .'_size', array(
                'default'           => $defaults['size'],
                'sanitize_callback' => 'sanitize_text_field',
                'type'              => 'theme_mod',
           )
        );

        $wp_customize->add_setting(
            $control_name .'_attach', array(
                'default'           => $defaults['attach'],
                'sanitize_callback' => 'sanitize_text_field',
                'type'              => 'theme_mod',
           )
        );

        $wp_customize->add_setting(
            $control_name .'_position', array(
                'default'           => $defaults['position'],
                'sanitize_callback' => 'sanitize_text_field',
                'type'              => 'theme_mod',
           )
        );

        $wp_customize->add_control(
            new Realistic_Customizer_Background_Control(
                $wp_customize,				
                $control_name,
                array(
                    'label'			=> $label,
                    'description'	=> $description,
                    'section'		=> $section,
                    'priority'		=> $priority,
                    'settings'      => array(
                        'image_url' => $control_name .'_image_url',
                        'image_id'  => $control_name .'_image_id',
                        'repeat'    => $control_name .'_repeat', // Use false to hide the field
                        'size'      => $control_name .'_size',
                        'position'  => $control_name .'_position',
                        'attach'    => $control_name .'_attach'
                    )
                )
            )
        );
    }
}