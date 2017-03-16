
 	var counter = 0;

	var countPages = function( tab ) {
		switch (tab) {
		    case 'tab1':
		        counter = 1;
		        break;
			case 'tab2':
		        counter = 2;
		        break;
			case 'tab3':
				($( "span#ARslide_no" ).text() == "") ? counter = 3 : counter = $( "span#ARslide_no" ).text();
		        break;	
			case 'tab4':
				($( "span#SCITslide_no" ).text() == "") ? counter = 11 : counter = $( "span#SCITslide_no" ).text();
		        break;	
		    case 'tab5':
		    	($( "span#SLITslide_no" ).text() == "") ? counter = 21 : counter = $( "span#SLITslide_no" ).text();
		        break;	
		    case 'tab6':
		    	($( "span#AFPslide_no" ).text() == "") ? counter = 51 : counter = $( "span#AFPslide_no" ).text();
		        break;		
		    case 'tab7':
		        counter =  62;
		        break;		
		    } 

		return counter;
	};

    /*$.noConflict();*/
    $(document).ready(function () {
    	//if jquery-hashchange-plugin is not used, the following statement will load and reload the tab in the hash url
    	//tab = location.hash.substring(1);
    	//$("#v-nav ul li[tab=" + tab + "]").click();
    	
    	var root = "<?= SCRIPT_ROOT ?>";

    	//This function is used to higlight each list section when clicked inside (Pretest and Postest only)
	    var items = $('.form-all>ul>li').each(function () {
	            $(this).click(function () {
	            			//The id_1 and id_8 are the ids of the first and last list elements of the form
	                       if(($(this).attr('id') !== 'id_1') && ($(this).attr('id') !== 'id_8')){
	                          //remove previous class and add it to clicked tab
	                        items.removeClass('form-line-active');
	                        $(this).addClass('form-line-active');
	                    }

	                    else{
	                      items.removeClass('form-line-active');
	                    }
	              
	            });

	      });

	    //this global function needs to be accessible to the loaded section in the tab
	    window.showTab = function (tab) {
	    	$("#v-nav ul li[tab=" + tab + "]").click();

	    	$( "span.count" ).empty().html(countPages(tab) + "/62" );
	    }

	    // Bind the event hashchange, using jquery-hashchange-plugin
	    $(window).hashchange(function () {
			showTab(location.hash.replace("#", ""));
	    })

	    // Trigger the event hashchange on page load, using jquery-hashchange-plugin
	    $(window).hashchange();

	    $("html, body").animate({
        	scrollTop: 0
    	}, 400);  

		$( ".count" ).tooltip({
			show: {
			effect: "slideDown",
			delay: 200
			},
			position: {
			my: "right top",
			at: "right+20 bottom+25",
			 	using: function( position, feedback ) {
				$( this ).css( position );
				$( "<div>" )
				.addClass( "arrow narrow" )
				.addClass( feedback.vertical )
				.addClass( feedback.horizontal )
				.appendTo( this );
				}
			}
		});

	    //Character limit counter for all text areas
		$('#eval_q_1, #eval_q_2, #eval_q_3, #eval_q_4, #eval_q_5, #eval_q_6, #eval_q_8, #eval_q_9').keyup(function () {
			  var max = 500;
			  var len = $(this).val().length;
			  var limit_indicator = '.' + $(this).attr('id');
			  if (len >= max) {
			    $(limit_indicator).text('* vous avez atteint la limite').css({ "color": "#FF0000", "font-weight": "bold", "font-size": "12px"});
			  }
			  else if(len === 0) {
			  	$(limit_indicator).text(' 500 caractères maximum ').css({ "color": "#666666", "font-weight": "initial", "font-size": "9px", "-webkit-transition": "all 0.5s ease", "-moz-transition": "all 0.5s ease", "-o-transition": "all 0.5s ease", "transition": "all 0.5s ease"});
			  }
			   else {
			    var character = max - len;
			    $(limit_indicator).text(character + ' charactères restant').css({ "color": "#666666", "font-weight": "initial", "font-size": "9px", "-webkit-transition": "all 0.5s ease", "-moz-transition": "all 0.5s ease", "-o-transition": "all 0.5s ease", "transition": "all 0.5s ease"});
			  }
		});

		if(showTip){
			$.blockUI({ 
			            message: $('.arrow_box'), 
			            fadeIn: 1500, 
			            fadeOut: 1300, 
			            timeout: 4000, 
			            showOverlay: false,
			            css: { 
			                width: '250px',
							height: '100px', 
							top:  '225px', 
							left: ($(window).width() + 250) /2 + 'px', 
			                border: 'none', 
			                padding: '5px', 
							textAlign: 'center',
							font: '19px Arial,Helvetica,sans-serif',
			                backgroundColor: '#000', 
			                '-moz-border-radius': '10px',
			                '-webkit-border-radius': '10px', 
			                'border-radius': '10px',
			                opacity: .8, 
			                color: '#fff' 
			            } 
			}); 
		}

	});//end document.ready
