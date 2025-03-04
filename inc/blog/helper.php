<?php

if ( ! function_exists( 'touchup_get_blog_holder_classes' ) ) {
	/**
	 * Function that return classes for the main blog holder
	 *
	 * @return string
	 */
	function touchup_get_blog_holder_classes() {
		$classes = array();
		
		if ( is_single() ) {
			$classes[] = 'qodef--single';
		} else {
			$classes[] = 'qodef--list';
		}

		return implode( ' ', apply_filters( 'touchup_filter_blog_holder_classes', $classes ) );
	}
}

if ( ! function_exists( 'touchup_get_blog_list_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on blog list page
	 *
	 * @return int
	 */
	function touchup_get_blog_list_excerpt_length() {
		$length = apply_filters( 'touchup_filter_blog_list_excerpt_length', 180 );
		
		return intval( $length );
	}
}

if ( ! function_exists( 'touchup_post_has_read_more' ) ) {
	/**
	 * Function that checks if current post has read more tag set
	 *
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function touchup_post_has_read_more() {
		global $post;
		
		return ! empty( $post ) ? strpos( $post->post_content, '<!--more-->' ) : false;
	}
}

if ( ! function_exists( 'touchup_quote_svg' ) ) {
	function touchup_quote_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		    width="16px" height="14px" viewBox="0 0 16 14" enable-background="new 0 0 16 14" xml:space="preserve">
			<path fill="#9E4B47" d="M8.104,0.42H3.189v3.867c-0.054,2.578-0.913,5.031-2.578,7.358l2.82,1.934
				c1.36-1.092,2.475-2.529,3.343-4.311c0.868-1.781,1.312-3.567,1.329-5.357V0.42z M10.475,0.42v3.867
				c-0.054,2.578-0.913,5.031-2.578,7.358l2.82,1.934c1.36-1.092,2.475-2.529,3.343-4.311c0.868-1.781,1.312-3.567,1.329-5.357V0.42
				H10.475z"/>
			</svg>';
		
		return $html;
	}
}

if ( ! function_exists( 'touchup_link_svg' ) ) {
	function touchup_link_svg() {
		
		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="26px" height="26px" viewBox="0 0 26 26" enable-background="new 0 0 26 26" xml:space="preserve">
			<path fill="#9E4B47" d="M13.503,14.646l-0.961,0.385l0.051,0.117c0.188,0.438,0.283,0.898,0.283,1.367
				c0,0.719-0.222,1.401-0.646,2.011l-4.688,4.639l-0.037,0.037v0.06c-0.654,0.884-1.564,1.332-2.707,1.332
				c-0.938,0-1.746-0.333-2.398-0.984c-0.659-0.721-0.993-1.53-0.993-2.406c0-0.872,0.349-1.664,1.038-2.354l5.012-5.063
				c0.627-0.438,1.31-0.661,2.028-0.661c0.5,0,0.959,0.095,1.364,0.281l0.12,0.056l0.386-0.965l-0.107-0.05
				c-0.503-0.234-1.096-0.354-1.762-0.354c-0.967,0-1.863,0.304-2.676,0.916l-5.126,5.126c-0.867,0.867-1.306,1.899-1.306,3.067
				c0,1.268,0.44,2.317,1.306,3.115c0.866,0.867,1.915,1.307,3.116,1.307c1.434,0,2.617-0.592,3.505-1.745l4.688-4.639l0.037-0.037
				v-0.06c0.583-0.791,0.879-1.675,0.879-2.629c0-0.666-0.119-1.259-0.354-1.762L13.503,14.646z M9.015,16.223l0.763,0.763l7.12-7.119
				l0.088-0.089l-0.763-0.763l-7.119,7.119L9.015,16.223z M24.319,1.681c-0.867-0.867-1.915-1.306-3.116-1.306
				c-1.001,0-1.897,0.305-2.676,0.915l-5.13,5.082c-0.864,0.931-1.303,1.978-1.303,3.112c0,0.668,0.119,1.261,0.354,1.762l0.041,0.052
				c0.023,0.158,0.144,0.167,0.17,0.167l0.739-0.355l0.147-0.086l-0.107-0.104l-0.019-0.044v-0.164l-0.058,0.024
				c-0.156-0.402-0.235-0.822-0.235-1.251c0-0.874,0.349-1.665,1.038-2.354l5.012-5.063c0.626-0.439,1.309-0.661,2.028-0.661
				c0.938,0,1.746,0.333,2.397,0.985c0.659,0.722,0.993,1.531,0.993,2.406c0,0.718-0.223,1.4-0.646,2.011l-4.688,4.639l-0.037,0.037
				v0.057c-0.716,0.886-1.627,1.335-2.707,1.335c-0.5,0-0.959-0.095-1.363-0.281l-0.12-0.056l-0.386,0.965l0.107,0.05
				c0.501,0.234,1.094,0.354,1.762,0.354c1.435,0,2.617-0.592,3.506-1.745l4.688-4.639l0.037-0.037v-0.06
				c0.583-0.791,0.879-1.675,0.879-2.629C25.625,3.53,25.184,2.48,24.319,1.681z"/>
			</svg>';
		
		return $html;
	}
}