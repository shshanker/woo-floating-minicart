/**
 * aankha-woo-assitive-menu.js
 *
 * Woocommerce assitive menu.
 *
 * Learn more: https://github.com/Automattic/aankhashop/pull/136
 */
jQuery(document).ready( function($) {
		
		$('body').on('click', '#woo-floating-minicart-icon', function(){		
			

			$('#woo-floating-minicart').toggleClass( "active" );
		
				$(".cart_list").mCustomScrollbar( { theme:"minimal-dark" } );
				
		});


    
});


