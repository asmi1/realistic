// Show/Hide advanced BG options when image selected.
(function($) {
	$(document).ready(function() {
        /* Header Background */
        $( "#customize-control-header_bg_position" ).hide();
        $( "#customize-control-header_bg_size" ).hide();
        $( "#customize-control-header_bg_repeat" ).hide();
        $( "#customize-control-header_bg_attachment" ).hide();
		$( "#input_header_bg_adv_link-show" ).click(function() {
			$( "#input_header_bg_adv_link-show" ).hide();
            $( "#input_header_bg_adv_link-hide" ).show();
            $( "#customize-control-header_bg_position" ).show();
            $( "#customize-control-header_bg_size" ).show();
            $( "#customize-control-header_bg_repeat" ).show();
            $( "#customize-control-header_bg_attachment" ).show();
		});
		$( "#input_header_bg_adv_link-hide" ).click(function() {
			$( "#input_header_bg_adv_link-hide" ).hide();
            $( "#input_header_bg_adv_link-show" ).show();
            $( "#customize-control-header_bg_position" ).hide();
            $( "#customize-control-header_bg_size" ).hide();
            $( "#customize-control-header_bg_repeat" ).hide();
            $( "#customize-control-header_bg_attachment" ).hide();
		});
        /* Body Background */
        $( "#customize-control-bg_position" ).hide();
        $( "#customize-control-bg_size" ).hide();
        $( "#customize-control-bg_repeat" ).hide();
        $( "#customize-control-bg_attachment" ).hide();
		$( "#input_bg_adv_link-show" ).click(function() {
			$( "#input_bg_adv_link-show" ).hide();
            $( "#input_bg_adv_link-hide" ).show();
            $( "#customize-control-bg_position" ).show();
            $( "#customize-control-bg_size" ).show();
            $( "#customize-control-bg_repeat" ).show();
            $( "#customize-control-bg_attachment" ).show();
		});
		$( "#input_bg_adv_link-hide" ).click(function() {
			$( "#input_bg_adv_link-hide" ).hide();
            $( "#input_bg_adv_link-show" ).show();
            $( "#customize-control-bg_position" ).hide();
            $( "#customize-control-bg_size" ).hide();
            $( "#customize-control-bg_repeat" ).hide();
            $( "#customize-control-bg_attachment" ).hide();
		});

        // Customizer: Toggle background options based on radio button selection
        $('#input_background_settings .button-select').change(function () {
            if($(this).val() === 'none' && $(this).is(':checked')) {
                $('#customize-control-background_pattern, #customize-control-realistic_bg').toggle(false);
            }else if($(this).val() === 'pattern' && $(this).is(':checked')) {
                $('#customize-control-background_pattern').toggle(true);
                $('#customize-control-realistic_bg').toggle(false);
            }else if($(this).val() === 'custom_image' && $(this).is(':checked')) {
                $('#customize-control-background_pattern').toggle(false);
                $('#customize-control-realistic_bg').toggle(true)  ;
            }
        }).change();

	});
}) (jQuery);