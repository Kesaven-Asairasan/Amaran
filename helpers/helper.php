<?php

if ( ! function_exists( 'touchup_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string - plugin name
	 *
	 * @return bool
	 */
	function touchup_is_installed( $plugin ) {

		switch ( $plugin ) {
			case 'framework';
				return class_exists( 'QodeFramework' );
				break;
			case 'core';
				return class_exists( 'TouchUpCore' );
				break;
			case 'woocommerce';
				return class_exists( 'WooCommerce' );
				break;
			case 'gutenberg-page';
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'touchup_include_theme_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param $installed bool
	 * @param $plugin string - plugin name
	 *
	 * @return bool
	 */
	function touchup_include_theme_is_installed( $installed, $plugin ) {

		if ( $plugin === 'theme' ) {
			return class_exists( 'TouchupHandler' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'touchup_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'touchup_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params array of parameters to pass to template
	 */
	function touchup_template_part( $module, $template, $slug = '', $params = array() ) {
		echo touchup_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'touchup_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   the array of parameters to pass to the template
	 *
	 * @return string - string containing html of template
	 */
	function touchup_get_template_part( $module, $template, $slug = '', $params = array() ) {
		// HTML Content from template
		$html          = '';
		$template_path = TOUCHUP_INC_ROOT_DIR . '/' . $module;

		$temp = $template_path . '/' . $template;

		// The array of parameters to pass to the template
		if ( is_array( $params ) && count( $params ) ) {
            extract( $params, EXTR_SKIP ); // @codingStandardsIgnoreLine
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'touchup_get_page_id' ) ) {
	/**
	 * Function that returns current page id
	 * Additional conditional is to check if current page is any wp archive page (archive, category, tag, date etc.) and returns -1
	 *
	 * @return int
	 */
	function touchup_get_page_id() {
		$page_id = get_queried_object_id();

		if ( touchup_is_wp_template() ) {
			$page_id = -1;
		}

		return apply_filters( 'touchup_filter_page_id', $page_id );
	}
}

if ( ! function_exists( 'touchup_is_wp_template' ) ) {
	/**
	 * Function that checks if current page default wp page
	 *
	 * @return bool
	 */
	function touchup_is_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'touchup_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param $status string - success or error
	 * @param $message string - ajax message value
	 * @param $data string|array - returned value
	 * @param $redirect string - url address
	 */
	function touchup_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => esc_attr( $status ),
			'message'  => esc_html( $message ),
			'data'     => $data,
			'redirect' => ! empty( $redirect ) ? esc_url( $redirect ) : '',
		);

		$output = json_encode( $response );

		exit( $output );
	}
}

if ( ! function_exists( 'touchup_get_icon' ) ) {
	/**
	 * Function that return icon html
	 *
	 * @param $icon string - icon class name
	 * @param $icon_pack string - icon pack name
	 * @param $backup_text string - backup text label if framework is not installed
	 * @param $params array - icon parameters
	 *
	 * @return string|mixed
	 */
	function touchup_get_icon( $icon, $icon_pack, $backup_text, $params = array() ) {
		$value = touchup_is_installed( 'framework' ) && touchup_is_installed( 'core' ) ? qode_framework_icons()->render_icon( $icon, $icon_pack, $params ) : $backup_text;

		return $value;
	}
}

if ( ! function_exists( 'touchup_render_icon' ) ) {
	/**
	 * Function that render icon html
	 *
	 * @param $icon string - icon class name
	 * @param $icon_pack string - icon pack name
	 * @param $backup_text string - backup text label if framework is not installed
	 * @param $params array - icon parameters
	 */
	function touchup_render_icon( $icon, $icon_pack, $backup_text, $params = array() ) {
		echo touchup_get_icon( $icon, $icon_pack, $backup_text, $params );
	}
}

if ( ! function_exists( 'touchup_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param $params array - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function touchup_get_button_element( $params ) {
		if ( class_exists( 'TouchUpCoreButtonShortcode' ) ) {
			return TouchUpCoreButtonShortcode::call_shortcode( $params );
		} else {
			$link   = isset( $params['link'] ) ? $params['link'] : '#';
			$target = isset( $params['target'] ) ? $params['target'] : '_self';
			$text   = isset( $params['text'] ) ? $params['text'] : '';

			return '<a itemprop="url" class="qodef-theme-button" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $text ) . '</a>';
		}
	}
}

if ( ! function_exists( 'touchup_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param $params array - array of parameters
	 */
	function touchup_render_button_element( $params ) {
		echo touchup_get_button_element( $params );
	}
}

if ( ! function_exists( 'touchup_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param $class string
	 */
	function touchup_class_attribute( $class ) {
		echo touchup_get_class_attribute( $class );
	}
}

if ( ! function_exists( 'touchup_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param $class string
	 *
	 * @return string|mixed
	 */
	function touchup_get_class_attribute( $class ) {
		$value = touchup_is_installed( 'framework' ) ? qode_framework_get_class_attribute( $class ) : '';

		return $value;
	}
}

if ( ! function_exists( 'touchup_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists
	 *
	 * @param string $name name of option
	 * @param int    $post_id id of
	 *
	 * @return string value of option
	 */
	function touchup_get_post_value_through_levels( $name, $post_id = null ) {
		return touchup_is_installed( 'framework' ) && touchup_is_installed( 'core' ) ? touchup_core_get_post_value_through_levels( $name, $post_id ) : '';
	}
}

if ( ! function_exists( 'touchup_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function touchup_get_space_value( $text_value ) {
		return touchup_is_installed( 'core' ) ? touchup_core_get_space_value( $text_value ) : 0;
	}
}

if ( ! function_exists( 'touchup_wp_kses_html' ) ) {
	/**
	 * Function that does escaping of specific html.
	 * It uses wp_kses function with predefined attributes array.
	 *
	 * @see wp_kses()
	 *
	 * @param string $type - type of html element
	 * @param string $content - string to escape
	 *
	 * @return string escaped output
	 */
	function touchup_wp_kses_html( $type, $content ) {
		return touchup_is_installed( 'framework' ) ? qode_framework_wp_kses_html( $type, $content ) : $content;
	}
}

if ( ! function_exists( 'touchup_escape_title_tag' ) ) {
	/**
	 * Function that escape title tag variable for modules
	 *
	 * @param string $title_tag
	 *
	 * @return string
	 */
	function touchup_escape_title_tag( $title_tag ) {
		$allowed_tags = array(
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'p',
			'span',
			'ul',
			'ol',
		);

		$escaped_title_tag = '';
		$title_tag         = strtolower( sanitize_key( $title_tag ) );

		if ( in_array( $title_tag, $allowed_tags, true ) ) {
			$escaped_title_tag = $title_tag;
		}

		return $escaped_title_tag;
	}
}

if ( ! function_exists( 'touchup_search_icon_svg' ) ) {
	function touchup_search_icon_svg() {

		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="26px" height="21px" viewBox="0 0 26 21" enable-background="new 0 0 26 21" xml:space="preserve">
					<path fill="#858585" d="M25.547,19.51l-6.491-4.352c0.737-1.393,1.159-2.977,1.159-4.659c0-5.514-4.486-10-10-10s-10,4.486-10,10
						c0,5.514,4.486,10,10,10c3.445,0,6.489-1.751,8.288-4.411l6.443,4.319c0.092,0.062,0.197,0.092,0.3,0.092
						c0.174,0,0.345-0.084,0.45-0.24C25.861,20.013,25.795,19.677,25.547,19.51z M10.214,19.419c-4.918,0-8.919-4.001-8.919-8.919
						s4.001-8.919,8.919-8.919s8.919,4.001,8.919,8.919S15.132,19.419,10.214,19.419z"/>
				</svg>';

		return $html;
	}
}

if ( ! function_exists( 'touchup_dropdown_cart_opener_icon_svg' ) ) {
	function touchup_dropdown_cart_opener_icon_svg() {

		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="23px" height="23px" viewBox="0 0 23 23" enable-background="new 0 0 23 23" xml:space="preserve">
					<g display="none">
						<g display="inline">
							<path fill="#EC008C" d="M19.527,22.5H3.473c-1.639,0-2.973-1.334-2.973-2.973V7.338c0-1.639,1.334-2.973,2.973-2.973h16.054 c1.639,0,2.973,1.334,2.973,2.973v12.189C22.5,21.166,21.166,22.5,19.527,22.5z M3.473,5.554c-0.984,0-1.784,0.8-1.784,1.784 v12.189c0,0.984,0.8,1.784,1.784,1.784h16.054c0.984,0,1.784-0.8,1.784-1.784V7.338c0-0.984-0.8-1.784-1.784-1.784H3.473z"/>
						</g>
						<g display="inline">
							<path fill="#EC008C" d="M15.365,5.554h-7.73c-0.328,0-0.595-0.266-0.595-0.595c0-2.459,2-4.459,4.459-4.459 c2.459,0,4.459,2,4.459,4.459C15.959,5.288,15.693,5.554,15.365,5.554z M8.284,4.365h6.432c-0.28-1.52-1.616-2.676-3.216-2.676 C9.9,1.689,8.564,2.844,8.284,4.365z"/>
						</g>
						<circle display="inline" fill="#EC008C" cx="7.635" cy="8.824" r="0.892"/>
						<circle display="inline" fill="#EC008C" cx="15.365" cy="8.824" r="0.892"/>
					</g>
					<path fill="none" stroke="#FFFFFF" stroke-width="1.1944" stroke-miterlimit="10" d="M19.448,21.963H3.624 c-1.369,0-2.488-1.12-2.488-2.488V7.426c0-1.369,1.12-2.488,2.488-2.488h15.823c1.369,0,2.488,1.12,2.488,2.488v12.049 C21.936,20.843,20.816,21.963,19.448,21.963z"/>
					<path fill="none" stroke="#FFFFFF" stroke-width="1.423" stroke-miterlimit="10" d="M7.775,4.778c0-2.077,1.684-3.761,3.761-3.761 s3.761,1.684,3.761,3.761"/>
					<g>
						<circle fill="none" stroke="#FFFFFF" stroke-width="1.68" stroke-miterlimit="10" cx="7.646" cy="8.824" r="0.05"/>
						<circle fill="none" stroke="#FFFFFF" stroke-width="1.68" stroke-miterlimit="10" cx="15.426" cy="8.824" r="0.05"/>
					</g>
				</svg>';

		return $html;
	}
}

if ( ! function_exists( 'touchup_arrow_left_svg' ) ) {
	function touchup_arrow_left_svg() {

		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="75px" viewBox="0 0 40 75" enable-background="new 0 0 40 75" xml:space="preserve">
					<polyline fill="none" stroke="#777777" stroke-width="2" stroke-miterlimit="10" points="38.25,74 1.75,37.5 38.25,1 "/>
				</svg>';

		return $html;
	}
}

if ( ! function_exists( 'touchup_mobile_opener_svg' ) ) {
	function touchup_mobile_opener_svg() {

		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" enable-background="new 0 0 45 45" xml:space="preserve">
					<circle fill="#F4847E" cx="22.5" cy="22.5" r="22"/>
					<line fill="none" stroke="#FFFFFF" stroke-width="1.2" stroke-miterlimit="10" x1="12.511" y1="13.063" x2="32.512" y2="13.063"/>
					<line fill="none" stroke="#FFFFFF" stroke-width="1.2" stroke-miterlimit="10" x1="15.512" y1="19.354" x2="29.512" y2="19.354"/>
					<line fill="none" stroke="#FFFFFF" stroke-width="1.2" stroke-miterlimit="10" x1="15.512" y1="31.937" x2="29.512" y2="31.937"/>
					<line fill="none" stroke="#FFFFFF" stroke-width="1.2" stroke-miterlimit="10" x1="12.512" y1="25.646" x2="32.512" y2="25.646"/>
				</svg>';

		return $html;
	}
}

if ( ! function_exists( 'touchup_small_left_arrow_svg' ) ) {
	function touchup_small_left_arrow_svg() {

		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="8px" height="14px" viewBox="0 0 8 14" enable-background="new 0 0 8 14" xml:space="preserve">
					<polyline fill="none" stroke="#454546" stroke-width="0.8021" stroke-linejoin="bevel" stroke-miterlimit="10" points="7.225,0.55 0.775,7 7.225,13.45 "/>
				</svg>';

		return $html;
	}
}

if ( ! function_exists( 'touchup_small_right_arrow_svg' ) ) {
	function touchup_small_right_arrow_svg() {

		$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="8px" height="14px" viewBox="0 0 8 14" enable-background="new 0 0 8 14" xml:space="preserve">
					<polyline fill="none" stroke="#454546" stroke-width="0.8021" stroke-linejoin="bevel" stroke-miterlimit="10" points="0.775,0.55 7.225,7 0.775,13.45 "/>
				</svg>';

		return $html;
	}
}
