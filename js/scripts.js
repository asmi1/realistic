(function($) {
    $(document).ready(function() {

		//move-to-top arrow
		$("body").prepend("<div id='move-to-top' class='animate mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--accent'><i class='material-icons'>expand_less</i></div>");
		var scrollDes = 'html,body';
		if(navigator.userAgent.match(/opera/i)){
			scrollDes = 'html';
		}
		//show ,hide
		$(window).scroll(function () {
			if ($(this).scrollTop() > 500) {
				$('#move-to-top').addClass('filling').removeClass('hiding');
			} else {
				$('#move-to-top').removeClass('filling').addClass('hiding');
			}
		});
		// scroll to top when click 
		$('#move-to-top').click(function () {
			$(scrollDes).animate({ 
				scrollTop: 0
			},{
				duration :500
			});
		});

	    // Off-canvas Menu Accordion
	    $('.mobile-navigation li.has-sub > .expander').on('click', function(){
	        var element = $(this);
	        var parent = element.parent('li');

	        if (element.hasClass('collapsed')) {
	            element.removeClass('collapsed').addClass('expanded');
	            parent.children('ul').slideDown();
	        } else {
	            parent.find('span.expander').removeClass('expanded').addClass('collapsed');
	            parent.find('ul').slideUp();
	        }
	    });

		// Login Widget Buttons
		$('.widget_realistic_login_widget input[type="button"], .widget_realistic_login_widget input[type="reset"], .widget_realistic_login_widget input[type="submit"]').addClass('mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored');

		// Login Widget Textfields
		$('.widget_realistic_login_widget input[type="text"], .widget_realistic_login_widget input[type="password"],textarea').addClass('mdl-textfield__input');

		// Extracting main & accent colors & dynamically set the background-color/color style for some elements.
		var mainColor = $('header').css( "background-color" );
		$(".featured").css("background-color", mainColor );
		$(".sidebar-widget .widget-title h3 .thin-bar").css("border-color", mainColor );

		$(".main-navigation li ul li").mouseenter(function() {
			$(this).css("background-color", mainColor );
		}).mouseleave(function() {
			 $(this).css("background-color", "transparent" );
		});

		// Adding MDL buttons classes to nav-links and its links.
		$('.nav-links a').addClass('mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect');
		$('.page-numbers.dots').addClass('mdl-button mdl-js-button mdl-button--raised');
		$('.nav-links .current').addClass('mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect');

    });
})(jQuery);