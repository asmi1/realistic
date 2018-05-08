<?php
/**
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*-----------------------------------------------------------------------------------*/
/*  Custom Customizer Controls
/*-----------------------------------------------------------------------------------*/
add_action( 'customize_register', 'realistic_custom_controls_register' );

function realistic_custom_controls_register( $wp_customize ) {

    // Switcher control class
	class Realistic_Customizer_Switcher_Control extends WP_Customize_Control {
		public $type = 'switcher';
		public function render_content() { ?>

			<label>

                <?php if ( !empty( $this->label ) ) { ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php } ?>
                <?php if ( !empty( $this->description ) ) { ?>
                    <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php } ?>

                <input type="checkbox" id="input_<?php echo $this->id; ?>" class="switcher-toggle" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
                <label class="switcher-viewport" for="input_<?php echo $this->id; ?>">
                    <div class="switcher">
                        <div class="switcher-button">&nbsp;</div>
                        <div class="switcher-content left"><span><?php esc_html_e( 'On', 'realistic' ); ?></span></div>
                        <div class="switcher-content right"><span><?php esc_html_e( 'Off', 'realistic' ); ?></span></div>
                    </div>
                </label>

			</label>
		<?php }
	}

    // Radio-Image control class
	class Realistic_Customizer_Radio_Image_Control extends WP_Customize_Control {

		public $type = 'radio-image';

		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-button' );
		}
			
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			$name = '_customize-radio-' . $this->id; ?>

            <?php if ( !empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php } ?>
            <?php if ( !empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>

			<div id="input_<?php echo $this->id; ?>" class="image">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
						<label for="<?php echo $this->id . $value; ?>">
							<img src="<?php echo esc_html( $label ); ?>">
						</label>
					</input>
				<?php endforeach; ?>
			</div>
			<script>jQuery(document).ready(function($) { $( '[id="input_<?php echo $this->id; ?>"]' ).buttonset(); });</script>
		<?php }
    }
    
    // Radio-Button control class
	class Realistic_Customizer_Radio_Button_Control extends WP_Customize_Control {
		public $type = 'radio-button';

		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}
			$name = '_customize-radio-' . $this->id; ?>

            <?php if ( !empty( $this->label ) ) { ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php } ?>
            <?php if ( !empty( $this->description ) ) { ?>
                <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>

			<div id="input_<?php echo $this->id; ?>" class="radio-button">
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<input class="button-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                    <label for="<?php echo $this->id . $value; ?>"><?php echo esc_html( $label ); ?></label>
				<?php endforeach; ?>
			</div>
		<?php }
    }

    // Register background control JS template.
    $wp_customize->register_control_type( 'Realistic_Customizer_Background_Control' );
    /**
     * Customize API: Realistic_Customizer_Background_Control class
     *
     * @since 1.0.0
     * @see https://github.com/devinsays/customizer-background-control
     */
    class Realistic_Customizer_Background_Control extends WP_Customize_Upload_Control {

        public $type = 'background-image';

        public $mime_type = 'image';

        public $button_labels = array();

        public $field_labels = array();

        public $background_choices = array();

        /**
         * Constructor.
         *
         * @since 1.0.0
         * @uses WP_Customize_Upload_Control::__construct()
         *
         * @param WP_Customize_Manager $manager Customizer bootstrap instance.
         * @param string               $id      Control ID.
         * @param array                $args    Optional. Arguments to override class property defaults.
         */
        public function __construct( $manager, $id, $args = array() ) {

            // Calls the parent __construct
            parent::__construct( $manager, $id, $args );

            // Set button labels for image uploader
            $button_labels = $this->get_button_labels();
            $this->button_labels = apply_filters( 'customizer_background_button_labels', $button_labels, $id );

            // Set field labels
            $field_labels = $this->get_field_labels();
            $this->field_labels = apply_filters( 'customizer_background_field_labels', $field_labels, $id );

            // Set background choices
            $background_choices = $this->get_background_choices();
            $this->background_choices = apply_filters( 'customizer_background_choices', $background_choices, $id );

        }

        public function enqueue() {

            parent::enqueue();
            wp_enqueue_script(
                'realistic-customizer-background',
                get_template_directory_uri() . '/js/customize-background.js',
                array( 'jquery', 'wp-color-picker' ),
                REALISTIC_THEME_VERSION,
                true
            );

            wp_enqueue_style( 'wp-color-picker' );
        }

        public function to_json() {

            parent::to_json();

            $background_choices = $this->background_choices;
            $field_labels = $this->field_labels;

            // Loop through each of the settings and set up the data for it.
            foreach ( $this->settings as $setting_key => $setting_id ) {

                $this->json[ $setting_key ] = array(
                    'link'  => $this->get_link( $setting_key ),
                    'value' => $this->value( $setting_key ),
                    'label' => isset( $field_labels[ $setting_key ] ) ? $field_labels[ $setting_key ] : ''
                );

                if ( 'image_url' === $setting_key ) {
                    if ( $this->value( $setting_key ) ) {
                        // Get the attachment model for the existing file.
                        $attachment_id = attachment_url_to_postid( $this->value( $setting_key ) );
                        if ( $attachment_id ) {
                            $this->json['attachment'] = wp_prepare_attachment_for_js( $attachment_id );
                        }
                    }
                }
                elseif ( 'repeat' === $setting_key ) {
                    $this->json[ $setting_key ]['choices'] = $background_choices['repeat'];
                }
                elseif ( 'size' === $setting_key ) {
                    $this->json[ $setting_key ]['choices'] = $background_choices['size'];
                }
                elseif ( 'position' === $setting_key ) {
                    $this->json[ $setting_key ]['choices'] = $background_choices['position'];
                }
                elseif ( 'attach' === $setting_key ) {
                    $this->json[ $setting_key ]['choices'] = $background_choices['attach'];
                }
            }

        }

        public function content_template() {

            parent::content_template();
            ?>

            <div class="background-image-fields">
            <# if ( data.attachment && data.repeat && data.repeat.choices ) { #>
                <li class="background-image-repeat">
                    <# if ( data.repeat.label ) { #>
                        <span class="customize-control-title">{{ data.repeat.label }}</span>
                    <# } #>
                    <select {{{ data.repeat.link }}}>
                        <# _.each( data.repeat.choices, function( label, choice ) { #>
                            <option value="{{ choice }}" <# if ( choice === data.repeat.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
            <# } #>

            <# if ( data.attachment && data.size && data.size.choices ) { #>
                <li class="background-image-size">
                    <# if ( data.size.label ) { #>
                        <span class="customize-control-title">{{ data.size.label }}</span>
                    <# } #>
                    <select {{{ data.size.link }}}>
                        <# _.each( data.size.choices, function( label, choice ) { #>
                            <option value="{{ choice }}" <# if ( choice === data.size.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
            <# } #>

            <# if ( data.attachment && data.position && data.position.choices ) { #>
                <li class="background-image-position">
                    <# if ( data.position.label ) { #>
                        <span class="customize-control-title">{{ data.position.label }}</span>
                    <# } #>
                    <select {{{ data.position.link }}}>
                        <# _.each( data.position.choices, function( label, choice ) { #>
                            <option value="{{ choice }}" <# if ( choice === data.position.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
            <# } #>

            <# if ( data.attachment && data.attach && data.attach.choices ) { #>
                <li class="background-image-attach">
                    <# if ( data.attach.label ) { #>
                        <span class="customize-control-title">{{ data.attach.label }}</span>
                    <# } #>
                    <select {{{ data.attach.link }}}>
                        <# _.each( data.attach.choices, function( label, choice ) { #>
                            <option value="{{ choice }}" <# if ( choice === data.attach.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
            <# } #>

            </div>

            <?php
        }

        public static function get_button_labels() {

            $button_labels = array(
                'select'       => esc_html__( 'Select Image', 'realistic' ),
                'change'       => esc_html__( 'Change Image', 'realistic' ),
                'remove'       => esc_html__( 'Remove', 'realistic' ),
                'default'      => esc_html__( 'Default', 'realistic' ),
                'placeholder'  => esc_html__( 'No image selected', 'realistic' ),
                'frame_title'  => esc_html__( 'Select Image', 'realistic' ),
                'frame_button' => esc_html__( 'Choose Image', 'realistic' ),
            );

            return $button_labels;

        }

        public static function get_field_labels() {

            $field_labels = array(
                'repeat'	=> esc_html__( 'Background Repeat', 'realistic' ),
                'size'		=> esc_html__( 'Background Size', 'realistic' ),
                'position'	=> esc_html__( 'Background Position', 'realistic' ),
                'attach'	=> esc_html__( 'Background Attachment', 'realistic' )
            );

            return $field_labels;

        }

        public static function get_background_choices() {

            $choices = array(
                'repeat' => array(
                    'no-repeat' => esc_html__( 'No Repeat', 'realistic' ),
                    'repeat'    => esc_html__( 'Tile', 'realistic' ),
                    'repeat-x'  => esc_html__( 'Tile Horizontally', 'realistic' ),
                    'repeat-y'  => esc_html__( 'Tile Vertically', 'realistic' )
                ),
                'size' => array(
                    'auto'    => esc_html__( 'Default', 'realistic' ),
                    'cover'   => esc_html__( 'Cover', 'realistic' ),
                    'contain' => esc_html__( 'Contain', 'realistic' )
                ),
                'position' => array(
                    'left top'      => esc_html__( 'Left Top', 'realistic' ),
                    'left center'   => esc_html__( 'Left Center', 'realistic' ),
                    'left bottom'   => esc_html__( 'Left Bottom', 'realistic' ),
                    'right top'     => esc_html__( 'Right Top', 'realistic' ),
                    'right center'  => esc_html__( 'Right Center', 'realistic' ),
                    'right bottom'  => esc_html__( 'Right Bottom', 'realistic' ),
                    'center top'    => esc_html__( 'Center Top', 'realistic' ),
                    'center center' => esc_html__( 'Center Center', 'realistic' ),
                    'center bottom' => esc_html__( 'Center Bottom', 'realistic' )
                ),
                'attach' => array(
                    'fixed'   => esc_html__( 'Fixed', 'realistic' ),
                    'scroll'  => esc_html__( 'Scroll', 'realistic' )
                )
            );

            return $choices;
        }
    }
}