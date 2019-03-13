var UI = {

	/**
	 * Initialize the installation UI
	 */
	initialize: function()
	{
		this.Tooltip.initialize();
        
        // how-to box
        $('.how_to_box .title').click(function() {
            $(this).parent().children('.content').slideToggle();
        });
        
        // bind previous buttons
        $('.installer_navigation .prev').click(function() { 
            UI.Navigation.previous(); 
        });
        
        // bind next buttons, without validation
        $('.installer_navigation .next').click(function() { 
            UI.Navigation.next(); 
        });

        // navigation
        $('nav .sub a').click(function() {
            UI.Navigation.goTo( $(this).attr('id') );
        });
	},
    
    /**
     * Displays a loading animation in the next / previous 
     * navigation area
     * @param onComplete
     */
    displayLoading: function(onComplete)
    {
        $('.installer_navigation:visible').fadeOut(100, function() {
            $(this).find('a').hide();
            
			$(this).append('<img src="images/ajax.gif" />').fadeIn(100, function()
            {
                if (onComplete !== undefined)
                    onComplete();
            });
        });
    },

    
    /**
     * Remove the loading animation in the next / previous 
     * navigation area
     * @param onComplete
     */
    completeLoading: function() 
    {
        $('.installer_navigation').find('img').remove();
        $('.installer_navigation a:not(:visible)').show();
    },
    
    Validation: 
	{

        
        requirements: function(notifyResult) 
		{

                    // check php extensions
                    Ajax.checkPhpExtensions(function(result) {
                        
                        if (result == '1') 
						{
							// check php version
							Ajax.checkPhpVersion(function(result) {
								
								if (result == '1') {
									// Apache Modules
									Ajax.checkApacheModules(function(result) {

										if (result == '1') {
											notifyResult(true);
										}
										else {
											notifyResult(false, 'FusionCMS requires Apache Mods.');
										}
									});
								}
								else {
	                                notifyResult(false, 'FusionCMS requires at least PHP 5.3.');
								}
							});
						}
                        else {
                            notifyResult(false, 'Please enable all required PHP extensions to continue.');
                        }
                    });

        },
		general : function (notifyResult) {
			var copyrights = $('#emulator').val();
			var general_form = {
				server_name: $('#server_name').val(),
				code: $('#security_code').val(),
				rows: $('#rows').val(),
				copy: copyrights,
				state: $('#state').val(),
				kings: $("#kings").val(),
				prince :$("#prince").val()
			};
			var required = ['server_name','rows', 'code', 'copy', 'state', 'kings', 'prince'];
			var general_filled = true;

			for (var key in required) {
				key = required[key];

				if ( (general_form[key] === undefined || ! general_form[key].length))
				{
					general_filled = false;
					break;
				}
			}
			if ( ! general_filled) {
				notifyResult(false, 'Please fill all fields.');
				return;
			}
			if (copyrights != 'System Created By Malek Mohamed')
			{
				notifyResult(false, 'Error : System.php file has been Modified.');
				return;
			}
			if (general_filled && copyrights == 'System Created By Malek Mohamed')
			{
				notifyResult(true);
			}
		},
		database: function(notifyResult) 
		{
			// check cms db connection
			var dbCMS = {
				hostname: $('#cms_hostname').val(),
				username: $('#cms_username').val(),
				password: $('#cms_password').val(),
				database: $('#cms_database').val()
			};
			
			if ($('#cms_port').val())
				dbCMS['port'] = $('#cms_port').val();
			


			
			// check if all required fields filled
			var required = ['hostname', 'username', 'password', 'database'];
			var all_filled = true;
			
			for (var key in required) {
				key = required[key];
				
				if ( (dbCMS[key] === undefined || ! dbCMS[key].length))
				{
					all_filled = false;
					break;
				}
			}
			
			if ( ! all_filled) {
				notifyResult(false, 'Please fill all fields.');
				return;
			}
			
			// all filled, check connections
			Ajax.checkDbConnection(dbCMS, function(result) {
				
				if (result != '1') {
					notifyResult(false, 'CMS database connection failed:<br />' + result);
				}
				else {
					notifyResult(true);
				}


			})
            // check cms db connection
            var dbGame = {
                hostname: $('#game_hostname').val(),
                username: $('#game_username').val(),
                password: $('#game_password').val(),
                database: $('#game_database').val()
            };

            // check if all required fields filled
            var required = ['hostname', 'username', 'password', 'database'];
            var all_filled = true;

            for (var key in required) {
                key = required[key];

                if ( (dbGame[key] === undefined || ! dbGame[key].length))
                {
                    all_filled = false;
                    break;
                }
            }

            if ( ! all_filled) {
                notifyResult(false, 'Please fill all fields.');
                return;
            }

            // all filled, check connections
            Ajax.checkDbConnection(dbGame, function(result) {

                if (result != '1') {
                    notifyResult(false, 'Game database connection failed:<br />' + result);
                }
                else {
                    notifyResult(true);
                }


            })
		},


    },

	/**
	 * Shows an alert box
	 * @param String message
	 */
	alert: function(question, time)
	{
		// Put question and button text
		$("#alert_message").html(question);

		// Show box
		$("#popup_bg").fadeTo(200, 0.5);
		$("#alert").fadeTo(200, 1);

		if(typeof time == "undefined")
		{
			$("#alert_message").css({marginBottom:"10px"});
			$(".popup_links").show();

			// Assign click event
			$("#alert_button").bind('click', function()
			{
				UI.hidePopup();	
			});
		}
		else
		{
			$("#alert_message").css({marginBottom:"0px"});
			$(".popup_links").hide();

			setTimeout(function()
			{
				UI.hidePopup();
			}, time);
		}

		// Assign hide-function to background
		$("#popup_bg").bind('click', function()
		{
			UI.hidePopup();
		});

		// Assign key events
		$(document).keypress(function(event)
		{
			// If "enter"
			if(event.which == 13)
			{
				UI.hidePopup();
			}
		});
	},

	/**
	 * Shows a confirm box
	 * @param String question
	 * @param String button
	 * @param Function callback
	 */
	confirm: function(question, button, callback, callback_false)
	{
		$(".popup_links").show();
		
		// Put question and button text
		$("#confirm_question").html(question);
		$("#confirm_button").html(button);

		// Show box
		$("#popup_bg").fadeTo(200, 0.5);
		$("#confirm").fadeTo(200, 1);

		// Assign click event
		$("#confirm_button").bind('click', function()
		{
			callback();
			UI.hidePopup();	
		});
		
		if (callback_false !== undefined)
			$('#confirm_hide').bind('click', callback_false);

		// Assign hide-function to background
		$("#popup_bg").bind('click', function()
		{
			UI.hidePopup();
		});

		// Assign key events
		$(document).keypress(function(event)
		{
			// If "enter"
			if(event.which == 13)
			{
				callback();
				UI.hidePopup();
			}
		});
	},

	/**
	 * Hides the current popup box
	 */
	hidePopup: function()
	{
		// Hide box
		$("#popup_bg").hide();
		$("#confirm").hide();
		$("#alert").hide();
		$("#vote_reminder").hide();

		// Remove events
		$("#confirm_button").unbind('click');
		$("#alert_button").unbind('click');
		$(document).unbind('keypress');
	},

	Navigation: {
		current: 1,

		next: function(onComplete)
		{
			if (this.current < ($('.step').length + 1))
				UI.Navigation.goTo(UI.Navigation.current + 1);
		},

		previous: function(onComplete)
		{
			if(this.current > 1)
				UI.Navigation.goTo(UI.Navigation.current - 1);
		},

		goTo: function(id, onComplete)
		{
			id = parseInt(id);
			
			if (UI.Navigation.current == id)
				return;
			
			// check if step is accessible yet (is next step, is first step or was completed before)
			if ( ! (UI.Navigation.current == 1 && id == 2) && id != (UI.Navigation.current+1)  && ! $('.sub a:nth-child(' + id + ')').hasClass('unlocked')) {
				console.log('goto failed: '+id);
				return;
			}
			
			console.log('current=' + UI.Navigation.current, 'loading next='+id);
			
			var showRequestedStep = function()
			{
	            // Save the current step's fields
				Memory.save(UI.Navigation.current);
				
				// display tick in navigation for current step
				$('.sub a:nth-child(' + UI.Navigation.current + ')').addClass('unlocked');				
				$(".sub .active").removeClass("active");
				
				// fade current step out, requested step in
				$(".step:eq(" + (UI.Navigation.current - 1) + ")").fadeOut(200, function()
				{
					UI.Navigation.current = id;
			
					$(".sub a:nth-child(" + UI.Navigation.current + ")").addClass("active");
					$(".step:eq(" + (UI.Navigation.current - 1) + ")").fadeIn(200, function() {
						$('document').scrollTop();
						
					   if (onComplete !== undefined)
                           onComplete();
					});
				});
			}
			
			// validate current step (only if moving forward)
			var validation = $('.step:eq(' + (UI.Navigation.current - 1) + ')').attr('data-validation');
			
			if (id > UI.Navigation.current && validation && UI.Validation[validation] !== undefined) 
			{
				// display loading animation, run validation, remove loading
				UI.displayLoading(function() {
					var result = UI.Validation[validation](function(result, errorMsg) 
					{
						UI.completeLoading();
						
						if ( ! result) {
							$('.sub a:nth-child(' + id + ')').removeClass('unlocked');
							
							if (errorMsg !== undefined)
								UI.alert(errorMsg);

 						   if (onComplete !== undefined)
 	                           onComplete();
						}
						else {
							// validation OK, show requested step page
							showRequestedStep();
						}
					});
				});
			}
			else {
				showRequestedStep();
			}
		}
	},
	
	Tooltip: {

		/**
		 * Add event-listeners
		 */
		initialize: function()
		{
			// Add the tooltip element
			$("body").prepend('<div id="tooltip"></div>');

			// Add mouse-over event listeners
			this.addEvents();

			// Add mouse listener
			$(document).mousemove(function(e)
			{
				UI.Tooltip.move(e.pageX, e.pageY);
			});
		},

		/**
		 * Used to support Ajax content
		 * Reloads the tooltip elements
		 */
		refresh: function()
		{
			// Remove all
			$("[data-tip]").unbind('hover');

			// Re-add
			this.addEvents();
		},

		addEvents: function()
		{
			// Add mouse-over event listeners
			$("[data-tip]").hover(
				function()
				{
					UI.Tooltip.show($(this).attr("data-tip"));
				},
				function()
				{
					$("#tooltip").hide();
				}
			);
		},

		/**
		 * Moves tooltip
		 * @param Int x
		 * @param Int y
		 */
		move: function(x, y)
		{
			// Get half of the width
			var width = ($("#tooltip").css("width").replace("px", "") / 2);

			// Position it at the mouse, and center
			$("#tooltip").css("left", x - width).css("top", y + 25);
		},

		/**
		 * Displays the tooltip
		 * @param Object element
		 */
		show: function(data)
		{
			$("#tooltip").html(data).show();
		}
	}
}