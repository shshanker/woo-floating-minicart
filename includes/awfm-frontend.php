<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Woo Floating Minicart
 *
 * Allows user to get WooCommerce Floating Minicart.
 *
 * @class   Woo_floating_minicart_frontend 
 */


class Woo_floating_minicart_frontend {

	/**
	 * Init and hook in the integration.
	 *
	 * @return void
	 */


	public function __construct() {
		$this->id                 = 'Woo_floating_minicart_menu';
		$this->method_title       = __( 'Woocommerce Floating Minicart', 'woo-floating-minicart' );
		$this->method_description = __( 'Woocommerce Floating Minicart.', 'woo-floating-minicart' );


		// Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'woo_floating_minicart_scripts' ));
		
		// Actions
		add_action( 'wp_head', array( $this, 'woo_floating_minicart' ));
		add_action( 'wp_footer', array( $this, 'awfm_footer_style' ));		

		// Filters 
		add_filter('add_to_cart_fragments', array( $this, 'woo_floating_minicart_add_to_cart_fragment'));

	}

	/**
	 * Loading scripts.
	 *
	 * @return void
	 */

	public function woo_floating_minicart_scripts(){

		// loading WordPress Default jquery.js file
		wp_enqueue_script('jquery');

		// loading plugin custom js file
		wp_register_script( 'woo-floating-minicart-script', plugins_url( 'woo-floating-minicart/js/awfm-scripts.js' ), array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'woo-floating-minicart-script' );

		// loading plugin custom css file
		wp_register_style( 'woo-floating-minicart-style', plugins_url( 'woo-floating-minicart/css/awfm-style.css' ) );
		wp_enqueue_style( 'woo-floating-minicart-style' );

		// lodaing third-party js file for custom scroll bar 
		wp_register_script( 'woo-floating-minicart-malihu-script', plugins_url( 'woo-floating-minicart/lib/jquery.mCustomScrollbar.concat.min.js' ), array('jquery'), '1.0.0', true );		
		wp_enqueue_script( 'woo-floating-minicart-malihu-script' );

		// lodaing third-party css file for custom scroll bar 
		wp_register_style( 'woo-floating-minicart-malihu-style', plugins_url( 'woo-floating-minicart/lib/jquery.mCustomScrollbar.min.css' ) );
		wp_enqueue_style( 'woo-floating-minicart-malihu-style' );
	
	} // end of woo_floating_minicart_scripts

	
	/**
	 * Loading minicart option on wp_head section.
	 *
	 * @return void
	 */

	public function woo_floating_minicart(){

		if( !( is_cart() || is_checkout()) ){

			echo "<div class='awfm-warp-content'>";
				$this->awfm_woocommerce_mini_cart();
			echo "</div>";

		}

	}


	/**
	 * Handling WooCommerce ajax on cart items update .
	 *
	 * @param  obj $fragments WooCommerce.
	 *
	 * @return obj
	 */
	public function woo_floating_minicart_add_to_cart_fragment( $fragments ) {
			
			ob_start();
			
			echo "<div class='awfm-warp-content'>";
				$this->awfm_woocommerce_mini_cart( );
			echo "</div>";

			$fragments['div.awfm-warp-content'] = ob_get_clean();

			return $fragments;

			}
			
	

	/**
	 * Initiating WooCommerce minicart function .
	 *
	 * @return void
	 */


	public function awfm_woocommerce_mini_cart(){
		

			$cart = new WC_Cart;
			
			$empty_cart_status = false;
			
			// For WooCommerce newer versions
			if( method_exists($cart, 'is_empty') ){
				
				if( WC()->cart->is_empty() ){

					$empty_cart_status = true;
				}

			} 
			
			// For WooCommerce older versions
			else {
				
				global $woocommerce;			
				if( sizeof( $woocommerce->cart->cart_contents ) == 0 ){

					$empty_cart_status = true;		
				}
				

			}

		?>


			<div id="woo-floating-minicart" class="woo-floating-minicart" style="">
			
			<div id="woo-floating-minicart-wrapper">
			
			<div id="woo-floating-minicart-icon">
				<?php 
				
				if ( $empty_cart_status == false ) :

					echo "<span class='cart_contents_count'>";
					echo WC()->cart->cart_contents_count;
					echo "</span>";

				endif;
				?>		
				<span class="cart-icon"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . 'images/basketg.png'; ?>" title="WooCommerce Floating Cart" alt="WooCommerce Floating Cart" width="32" height="32" /></span>
			</div><!-- END .woo-floating-minicart-inactive -->
			
			
			<?php do_action( 'woocommerce_before_mini_cart' ); ?>
			
			
			<?php if ( $empty_cart_status == false ):  ?>
			<p class="cart-items"><?php echo sprintf(_n('%d product in the cart.', '%d products in the cart.', WC()->cart->cart_contents_count, 'woo-floating-minicart'), WC()->cart->cart_contents_count); ?></p>
			
			<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">
			
								

					<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

								$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
								$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
								$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								
								?>
								
								<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
									
									<?php if ( ! $_product->is_visible() ) : ?>
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="item-thumbnail">
											<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
										</a>

										<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="item-detail">
											<?php echo $product_name . '&nbsp;'; ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
											<?php echo WC()->cart->get_item_data( $cart_item ); ?>
											<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'woo-floating-minicart' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
											?>
										</a>
									<?php endif; ?>

								</li>
								<?php
							}
						}
					?>
			</ul><!-- end product list -->
				
				<?php else : ?>
					<p class="cart-items"><?php _e( 'No products in the cart.', 'woo-floating-minicart' ); ?></p>
			
			<?php endif; ?>

			
			<?php if ( $empty_cart_status == false ) : ?>

				<div id="woo-floating-minicart-base">
					
				
					<p class="total"><strong><?php _e( 'Subtotal', 'woo-floating-minicart' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

					<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

					<p class="buttons">
						<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button wc-forward"><?php _e( 'Cart', 'woo-floating-minicart' ); ?></a>
						<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'woo-floating-minicart' ); ?></a>
					</p>

				</div> <!-- end woo-floating-minicart-base -->

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_mini_cart' ); ?>
		</div>	
		</div> <!-- END .woo-floating-minicart-active -->
		<?php
	}


	/**
	 * Loading footer css.
	 *
	 * @return void
	 */
	public function awfm_footer_style(){

		


			$minicart_position 	= get_option('Woo_floating_minicart_position');
			$primary_color 	= get_option('Woo_floating_minicart_primary_color');
			$secondary_color 	= get_option('Woo_floating_minicart_secondary_color');
			$button_color 	= get_option('Woo_floating_minicart_button_color');
			
			
			echo '<style type="text/css">';			   

			// check if bar-chart color.
			if( empty($minicart_position) || !empty($minicart_position) && $minicart_position == 'floating-left' ){ 
				/*left position css*/
				echo '	#woo-floating-minicart.active{
							left:0%;
						}

						#woo-floating-minicart-icon {
							float: right;
							position:absolute;
							right: -62px;
							top: 0px;
							}

							#woo-floating-minicart-icon .cart_contents_count{
								position:absolute;
								top:0px;
								left:40px;
							}

							#woo-floating-minicart{
								position: fixed;
								left:-220px;
								top:15%;
							}

							#woo-floating-minicart-icon  span.cart-icon{	
							    border-top-right-radius: 50%; 
							    -webkit-border-top-right-radius: 50%;   
							    
							}'; 
			} elseif(!empty($minicart_position) && $minicart_position == 'floating-right'){

				echo '	#woo-floating-minicart.active{
							right:0%;
						}

						#woo-floating-minicart-icon {
						float: left;
						position:absolute;
						left: -56px;
						top: 0px;
						}

						#woo-floating-minicart-icon .cart_contents_count{
							position:absolute;
							top:0px;
							right:40px;
						}

						#woo-floating-minicart{
							position: fixed;
							right:-220px;
							top:15%;
						}
						#woo-floating-minicart-icon  span.cart-icon{	
						    border-top-left-radius: 50%; 
						    -webkit-border-top-left-radius: 50%;   
						    
						}';
									}

						// minicart primary color			
						if(!empty($primary_color)){

							echo ' #woo-floating-minicart-icon span.cart-icon {
   							 background-color: '.$primary_color.'; }

   							 #woo-floating-minicart-base {
								    background-color: '.$primary_color.';
								}';

						} else {

							echo ' #woo-floating-minicart-icon span.cart-icon {
   							 background-color: #42a2ce; }

   							 #woo-floating-minicart-base {
								    background-color: #42a2ce;
								}';
						}	

						// minicart secondary color			
						if(!empty($secondary_color)){

							echo ' #woo-floating-minicart p.cart-items {
									    background: '.$secondary_color.'; }';

						} else {

							echo ' #woo-floating-minicart p.cart-items {
									    background: #3c3c3c;}';
						}	

						// minicart button color			
						if(!empty($button_color)){

							echo '
							#woo-floating-minicart-base p.buttons a.button{
								background: '.$button_color.';
							}
							#woo-floating-minicart-base p.buttons a.button:hover {
								background: '.$secondary_color.';}';

						} else {

							echo '
							#woo-floating-minicart-base p.buttons a.button{
								background: #71b02f;
							}
							#woo-floating-minicart-base p.buttons a.button:hover {
								    background: #79bc32;}';
						}		


			
		    	echo '</style>';
		    


		
	}
	


}

$minicart = new Woo_floating_minicart_frontend();