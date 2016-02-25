<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Woo Floating Minicart Backend
 *
 * Allows admin to set WooCommerce Floating Minicart of specific product.
 *
 * @class   Woo_floating_minicart_backend 
 */


class Woo_floating_minicart_backend {

	/**
	 * Init and hook in the integration.
	 *
	 * @return void
	 */


	public function __construct() {
		$this->id                 = 'Woo_floating_minicart_backend';
		$this->method_title       = __( 'WooCommerce Floating Minicart Backend', 'woo-floating-minicart' );
		$this->method_description = __( 'WooCommerce Floating Minicart Backend', 'woo-floating-minicart' );

	
		// Filters
		// Hooks floating minicart setting to the woocommerce general product product admin setting section.	 
		add_filter( 'woocommerce_general_settings', array( $this, 'awfm_general_total_sales_setting') , 100, 1 );

		
	}

	
	/**
	 * Loading  floating minicart setting to the woocommerce general product product admin setting section.
	 *
	 * @return array
	 */


	public static function awfm_general_total_sales_setting( $settings ){    
	   
		
		$settings[] = array( 'name' => __( 'Floating Minicart Setting', 'woo-floating-minicart' ), 'type' => 'title', 'desc' => 'The following options affect how floating minicart is displayed on the frontend.', 'id' => 'Woo_floating_minicart_title' );
					
		$settings[] = array(
			'title'    	=> __( 'Position', 'woo-floating-minicart' ),
			'css'      => 'min-width:350px;',
			'id'       	=> 'Woo_floating_minicart_position',
			'desc'  	=> __( 'Floating minicart position', 'woo-floating-minicart' ),
			'type' => 'select',  
                  'options' => array( 
                      '' => __( 'Select Minicart Position', 'woo-floating-minicart' ),  
                      'floating-left' => __( 'Float Minicart left', 'woo-floating-minicart' ),  
                      'floating-right' => __( 'Float Minicart right', 'woo-floating-minicart' ),  
 				),  
             'desc_tip' =>  true, 
			
		);


		$settings[] = array(
			'title'    	=> __( 'Primary Background', 'woo-floating-minicart' ),
			'css'      => 'min-width:55px;',
			'id'       	=> 'Woo_floating_minicart_primary_color',
			'desc'  	=> __( 'Select/paste minicart primary color', 'woo-floating-minicart' ),
			'type'     	=> 'color',
			'default'	=> '',
			'desc_tip'	=> true,
			'placeholder' => __( '#42a2ce', 'woo-floating-minicart' ),
		);

		$settings[] = array(
			'title'    	=> __( 'Secondary Background', 'woo-floating-minicart' ),
			'css'      => 'min-width:55px;',
			'id'       	=> 'Woo_floating_minicart_secondary_color',
			'desc'  	=> __( 'Select/paste floating minicart secondary color and also depandent to button hover color', 'woo-floating-minicart' ),
			'type'     	=> 'color',
			'default'	=> '',
			'desc_tip'	=> true,
			'placeholder' => __( '#3c3c3c', 'woo-floating-minicart' ),
		);


		$settings[] = array(
			'title'    	=> __( 'Button Background', 'woo-floating-minicart' ),
			'css'      => 'min-width:55px;',
			'id'       	=> 'Woo_floating_minicart_button_color',
			'desc'  	=> __( 'Select/paste floating minicart button color', 'woo-floating-minicart' ),
			'type'     	=> 'color',
			'default'	=> '',
			'desc_tip'	=> true,
			'placeholder' => __( '#71b02f', 'woo-floating-minicart' ),
		);

		$settings[] = array( 'type' => 'sectionend', 'id' => 'Woo_floating_minicart_sectionend');

		return $settings;
	   
	}
}

$awfm_backend = new Woo_floating_minicart_backend();