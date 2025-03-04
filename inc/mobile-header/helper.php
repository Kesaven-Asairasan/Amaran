<?php

if ( ! function_exists( 'touchup_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function touchup_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'touchup_filter_mobile_header_template', touchup_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}
	
	add_action( 'touchup_action_page_header_template', 'touchup_load_page_mobile_header' );
}

if ( ! function_exists( 'touchup_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function touchup_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'touchup_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'touchup' ) ) );
		
		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}
	
	add_action( 'touchup_action_after_include_modules', 'touchup_register_mobile_navigation_menus' );
}