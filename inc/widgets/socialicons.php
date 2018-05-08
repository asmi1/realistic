<?php

/*-----------------------------------------------------------------------------------

	Plugin Name: Realistic Social Icons
	Description: This widget shows social icons in the sidebar or footer.
	Version: 13.12.2017

-----------------------------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class realistic_social_icons_widget extends WP_Widget {

	protected $defaults;
	protected $profiles;

	function __construct() {

		// Defaults
		$this->defaults = array(
			'title' 	=> '',
			'new_tab' 	=> 0,
		);

		// Social Profiles
		$this->profiles = realistic_social_profiles_array();

		// Make defaults
		foreach ( $this->profiles as $key => $data ) {
			$this->defaults[$key] = 0;
		}

		$widget_ops = array(
			'classname'	 => 'realistic_social_icons_widget',
			'description' => esc_html__( 'Show social profile icons.', 'realistic' ),
		);
		$control_ops = array(
			'id_base' => 'social-icons',
		);

		parent::__construct ( 'social-icons', esc_html__( 'Realistic: Social Icons', 'realistic' ), $widget_ops, $control_ops );

	}

	function form( $instance ) {

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'realistic' ); ?></label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>

		<p><label><input id="<?php echo $this->get_field_id( 'new_tab' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="1" <?php checked( 1, $instance['new_tab'] ); ?>/> <?php esc_html_e( 'Open links in a new tab?', 'realistic' ); ?></label></p>

		<small><?php esc_html_e( 'Note: To define your social media URLs, go to "Appearance > Customize > Social".', 'realistic' ); ?></small>
		<hr style="background: #ccc; border: 0; height: 1px; margin-bottom: 20px;" />

		<?php foreach ( (array) $this->profiles as $profile => $data ) {

			printf( '<p><label><input id="%s" type="checkbox" name="%s" value="1" %s/> %s</label></p>', esc_attr( $this->get_field_id( $profile ) ), esc_attr( $this->get_field_name( $profile ) ), 1 == $instance[$profile]? 'checked="checked"': '', esc_attr( $data['label'] ) );
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = esc_attr( $new_instance['title'] );
		$instance['new_tab'] = realistic_sanitize_checkbox( $new_instance['new_tab'] );

		foreach ( $new_instance as $key => $value ) {

			// Sanitize Profiles.
			if ( array_key_exists( $key, (array) $this->profiles ) ) {
				$instance[$key] = realistic_sanitize_checkbox( $value );
			}
		}

		return $instance;
	}

	function widget( $args, $instance ) {

		extract( $args );

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

		if ( !empty( $instance['title'] ) ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		$output = '';

		$new_tab = $instance['new_tab'] ? 'target="_blank"' : '';

		foreach ( (array) $this->profiles as $profile => $data ) {
			if ( ! empty( $instance[$profile] ) ) {
				$output .= sprintf( $data['pattern'], esc_attr( $data['label'] ), realistic_format_social_url( get_theme_mod( 'social_'. $profile, '' ) ), $new_tab );
			}
		}

		if ( $output ) {
			printf( '<div class="widget-container social-icons mdl-cell mdl-cell--12-col"><ul class="%s">%s</ul></div>', '',$output );
		}

		echo $after_widget;
	}
}