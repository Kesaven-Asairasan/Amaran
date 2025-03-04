<?php

if ( ! function_exists( 'touchup_set_404_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param $classes string
	 *
	 * @return string
	 */
	function touchup_set_404_page_inner_classes( $classes ) {
		
		if ( is_404() ) {
			$classes = 'qodef-content-full-width';
		}
		
		return $classes;
	}
	
	add_filter( 'touchup_filter_page_inner_classes', 'touchup_set_404_page_inner_classes' );
}

if ( ! function_exists( 'touchup_get_404_page_parameters' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 */
	function touchup_get_404_page_parameters() {
		
		$params = array(
			'title'       => esc_html__( 'Error Page', 'touchup' ),
			'text'        => esc_html__( 'The page you are looking for doesn\'t exist. It may have been moved or removed altogether. Please try searching for some other page, or return to the website\'s homepage to find what you\'re looking for.', 'touchup' ),
			'button_text' => esc_html__( 'Back to home', 'touchup' )
		);
		
		return apply_filters( 'touchup_filter_404_page_template_params', $params );
	}
}
