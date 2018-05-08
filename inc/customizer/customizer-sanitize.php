<?php
/**
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Sanitize text
if ( !function_exists( 'realistic_sanitize_text' ) ) {
    function realistic_sanitize_text( $input ) {
        $allowed_html = array(
            'a' => array(
                'title' => array(),
                'class' => array(),
                'style' => array(),
                'href' => array(),
                'rel' => array(),
                'target' => array(),
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
            'i' => array(
                'class' => array(),
                'style' => array(),
            ),
            'span' => array(
                'class' => array(),
                'style' => array(),
            ),
            'img' => array(
                'src' => array(),
                'width' => array(),
                'height' => array(),
                'class' => array(),
                'style' => array(),
            ),
        );

    	return wp_kses( $input, $allowed_html );
    }
}

// Sanitize checkbox
if ( !function_exists( 'realistic_sanitize_checkbox' ) ) {
    function realistic_sanitize_checkbox( $input ) {
    	if ( $input == 1 ) {
    		return 1;
    	} else {
    		return '';
    	}
    }
}

// Sanitize integer
if ( !function_exists( 'realistic_sanitize_integer' ) ) {
    function realistic_sanitize_integer( $input ) {
    	return intval( $input );
    }
}

// Sanitize posint
if ( !function_exists( 'realistic_sanitize_posint' ) ) {
    function realistic_sanitize_posint( $input ) {
        return absint( $input );
    }
}

// Sanitize Choices
if ( !function_exists( 'realistic_sanitize_choices' ) ) {
function realistic_sanitize_choices( $input, $setting ) {
    	global $wp_customize;
    	$control = $wp_customize->get_control( $setting->id );

    	if ( array_key_exists( $input, $control->choices ) ) {
    		return $input;
    	} else {
    		return $setting->default;
    	}
    }
}

// Sanitize color ( Validate both HEX & RGBA colors )
if ( !function_exists( 'realistic_sanitize_color' ) ) {
    function realistic_sanitize_color( $input ) {

        if ( preg_match( '/^#[a-f0-9]{6}$/i', $input ) || preg_match( '/\A^rgba\(([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0]*[0-9]{1,2}|[1][0-9]{2}|[2][0-4][0-9]|[2][5][0-5])\s*,\s*([0-9]*\.?[0-9]+)\)$\z/im', $input ) ) {
            return $input;
        }

        return '';
    }
}

// Sanitize social media URL
if ( !function_exists( 'realistic_sanitize_social_url' ) ) {
    function realistic_sanitize_social_url( $input ) {

        // If email
        if ( false !== strpos( $input, '@' ) ) {

            return sanitize_email( $input );

        } else {
            return esc_url_raw( $input );
        }
    }
}

// Format social media URL
if ( !function_exists( 'realistic_format_social_url' ) ) {
    function realistic_format_social_url( $input ) {

        // If email
        if ( false !== strpos( $input, '@' ) ) {

            return sprintf( 'mailto:%s', sanitize_email( $input ) );

        } else {
            return esc_url( $input );
        }
    }
}