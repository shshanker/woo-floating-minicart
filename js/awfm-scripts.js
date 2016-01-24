/**
 * aankha-woo-assitive-menu.js
 *
 * Woocommerce assitive menu.
 *
 * 
 */
jQuery(document).ready( function($) {
		
		$('body').on('click', '#woo-floating-minicart-icon', function(){		
			

			$('#woo-floating-minicart').toggleClass( "active" );
		
				$(".cart_list").mCustomScrollbar( { theme:"minimal-dark" } );
				
		});


    
});


