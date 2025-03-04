<?php

if ( ! function_exists( 'touchup_nav_item_classes' ) ) {
	function touchup_nav_item_classes( $classes, $item, $args, $depth ) {
		
		if ( $depth == 0 && in_array( 'menu-item-has-children', $item->classes ) ) {
			$classes[] = "qodef-menu-item--narrow";
		}
		
		return $classes;
	}
	
	add_filter( 'nav_menu_css_class', 'touchup_nav_item_classes', 10, 4 );
}