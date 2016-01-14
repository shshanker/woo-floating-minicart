/**
 * aankha-woo-assitive-menu.js
 *
 * Woocommerce assitive menu.
 *
 * Learn more: https://github.com/Automattic/aankhashop/pull/136
 */
jQuery(document).ready( function($) {
		
	//var minicart = $('#woo-floating-minicart-active');
	//$('#woo-floating-minicart-active').hide();

	/*if( typeof $.cookie( "MinicartStatus") != 'undefined'){


			if( $.cookie( "MinicartStatus") == 'show' ){
			
				//alert('show me');
				setTimeout(function() {
      				$('#woo-floating-minicart').show('slow');
      				$('#woo-floating-minicart-icon').hide('slow');
    			 }, 500);
			

			
			} else if( $.cookie( "MinicartStatus") == 'hide' ) {
			
				//alert('hide me');
				setTimeout(function() {
      				$('#woo-floating-minicart').hide('slow');
      				$('#woo-floating-minicart-icon').show('slow');
    			 }, 500);
				

			}

	}	*/
		



		$('body').on('click', '#woo-floating-minicart-icon', function(){
			
			//$('#woo-floating-minicart').css( 'left', '0');

			$('#woo-floating-minicart').toggleClass( "active" );

			/*$('#woo-floating-minicart').toggle(function () {
			    $("#woo-floating-minicart").css( 'left', '-215');
			}, function () {
			    $("#woo-floating-minicart").css( 'left', '0');
			});
*/
			/*alert('clicked');

			var minicart = $('#woo-floating-minicart'); 			
				
				$.cookie( "MinicartStatus" , 'show', { expires: 7, path: '/' } );
				//minicart.show('slow');

				minicart.show('slide', { direction: 'left', easing: 'easeOutCubic' }, 
				    800, function(){
						
						//$('#woo-floating-minicart-icon').hide( 'slide', { direction: 'left', easing: 'easeInCubic'});
				    });*/
				$(".cart_list").mCustomScrollbar( { theme:"minimal-dark" } );
				//minicartControllerFunction(minicart);
		});


		$('body').on('click', '#woo-floating-minicart-minimize', function(){
			
			var minicart = $('#woo-floating-minicart'); 			
				
				$.cookie( "MinicartStatus" , 'hide', { expires: 7, path: '/' } );
				
				minicart.hide('slide', { direction: 'left', easing: 'easeOutCubic' }, 
				    800, function(){
						
						//$('#woo-floating-minicart-icon').show( 'slide', { direction: 'left', easing: 'easeOutCubic'});
				    });
				//minicartControllerFunction(minicart);
		});
		
		
		// minicart controller function
		function minicartControllerFunction($param) {
		   //alert($param);  // or whatever you want to do

		   if( $param.is(":visible" ) ){
				
				//alert('visible');
				$.cookie( "MinicartStatus" , 'hide', { expires: 7, path: '/' } );
				$param.hide('slow');

			} else {
								
				$.cookie( "MinicartStatus" , 'show', { expires: 7, path: '/' } );
				$param.show('slow');

			}
		   
		}
			///alert($.cookie( "MinicartStatus"));




		
	  /*$(window).load(function(){
            $(".cart_list").mCustomScrollbar();
        });*/


    
});


