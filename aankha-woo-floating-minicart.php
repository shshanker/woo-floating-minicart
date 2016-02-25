<?php
/*
 * Plugin Name:       Woo Floating Minicart 
 * Plugin URI:        https://github.com/shshanker/woo-floating-minicart
 * Description:       Woo floating minicart plugin for WooCommerce.
 * Version:           2.0.0
 * Author:            Sh Shanker, RiteshShakya
 * Author URI:        https://github.com/shshanker
 * Text Domain:       woo-floating-minicart
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );  // prevent direct access

if ( ! class_exists( 'Woo_Floating_Minicart' ) ) :
	
	class Woo_Floating_Minicart {


		/**
		 * Plugin version.
		 *
		 * @var string
		 */
		const VERSION = '2.0.0';

		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;


		/**
		 * Initialize the plugin.
		 */
		public function __construct(){

				
				/**
				 * Check if WooCommerce is active
				 **/
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			   		include_once 'includes/awfm-frontend.php';
			   		include_once 'includes/awfm-backend.php';
					
					
				} else {
					
					add_action( 'admin_init', array( $this, 'awfm_plugin_deactivate') );
					add_action( 'admin_notices', array( $this, 'awfm_woocommerce_missing_notice' ) );
				}

			} // end of contructor




		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * WooCommerce fallback notice.
		 *
		 * @return string
		 */
		public function awfm_woocommerce_missing_notice() {
			echo '<div class="error"><p>' . sprintf( __( 'Woocommerce Floating Minicart says "There must be active install of %s to take a flight!"', 'woo-floating-minicart' ), '<a href="http://www.woothemes.com/woocommerce/" target="_blank">' . __( 'WooCommerce', 'woo-floating-minicart' ) . '</a>' ) . '</p></div>';
			if ( isset( $_GET['activate'] ) )
                 unset( $_GET['activate'] );	
		}

		/**
		 * WooCommerce fallback notice.
		 *
		 * @return string
		 */
		public function awfm_plugin_deactivate() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
			

	}// end of the class

add_action( 'plugins_loaded', array( 'Woo_Floating_Minicart', 'get_instance' ), 0 );

endif;