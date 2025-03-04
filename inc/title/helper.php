<?php

if ( ! function_exists( 'touchup_is_page_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function touchup_is_page_title_enabled() {
		return apply_filters( 'touchup_filter_enable_page_title', true );
	}
}

if ( ! function_exists( 'touchup_load_page_title' ) ) {
	/**
	 * Function which loads page template module
	 */
	function touchup_load_page_title() {
		
		if ( touchup_is_page_title_enabled() ) {
			// Include title template
			echo apply_filters( 'touchup_filter_title_template', touchup_get_template_part( 'title', 'templates/title' ) );
		}
	}
	
	add_action( 'touchup_action_page_title_template', 'touchup_load_page_title' );
}

if ( ! function_exists( 'touchup_get_page_title_classes' ) ) {
	/**
	 * Function that return classes for page title area
	 *
	 * @return string
	 */
	function touchup_get_page_title_classes() {
		$classes = apply_filters( 'touchup_filter_page_title_classes', array() );
		
		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'touchup_get_page_title_text' ) ) {
	/**
	 * Function that returns current page title text
	 */
	function touchup_get_page_title_text() {
		$title = get_the_title( touchup_get_page_id() );

		if ( ( is_home() && is_front_page() ) || is_singular( 'post' ) || is_singular( 'portfolio-item' ) ) {
			$title = get_option( 'blogname' );
		} elseif ( is_tag() ) {
			$title = single_term_title( '', false ) . esc_html__( ' Tag', 'touchup' );
		} elseif ( is_date() ) {
			$title = get_the_time( 'F Y' );
		} elseif ( is_author() ) {
			$title = esc_html__( 'Author: ', 'touchup' ) . get_the_author();
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_archive() ) {
			$title = esc_html__( 'Archive', 'touchup' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results for: ', 'touchup' ) . get_search_query();
		} elseif ( is_404() ) {
			$title = esc_html__( '404 - Page not found', 'touchup' );
		}
		
		return apply_filters( 'touchup_filter_page_title_text', $title );
	}
}