<?php

if ( ! function_exists( 'touchup_include_comments_in_templates' ) ) {
	/**
	 * Function which includes comments templates on pages/posts
	 */
	function touchup_include_comments_in_templates() {

		// Include comments template
		comments_template();
	}

	add_action( 'touchup_action_after_page_content', 'touchup_include_comments_in_templates', 100 ); // permission 100 is set to comments template be at the last place
	add_action( 'touchup_action_after_blog_post_item', 'touchup_include_comments_in_templates', 100 );
}

if ( ! function_exists( 'touchup_is_page_comments_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function touchup_is_page_comments_enabled() {
		$is_enabled = apply_filters( 'touchup_filter_enable_page_comments', true );

		return $is_enabled;
	}
}

if ( ! function_exists( 'touchup_load_page_comments' ) ) {
	/**
	 * Function which loads page template module
	 */
	function touchup_load_page_comments() {

		if ( touchup_is_page_comments_enabled() ) {
			touchup_template_part( 'comments', 'templates/comments' );
		}
	}

	add_action( 'touchup_action_page_comments_template', 'touchup_load_page_comments' );
}

if ( ! function_exists( 'touchup_get_comments_list_template' ) ) {
	/**
	 * Function which modify default wordpress comments list template
	 *
	 * @param $comment object
	 * @param $args array
	 * @param $depth int
	 *
	 * @return string that contains comments list html
	 */
	function touchup_get_comments_list_template( $comment, $args, $depth ) {
		global $post;
		$GLOBALS['comment'] = $comment;

		$classes = array();

		$is_author_comment = $post->post_author == $comment->user_id;
		if ( $is_author_comment ) {
			$classes[] = 'qodef-comment--author';
		}
		
		$comment_author = get_user_by( 'email', $comment->comment_author_email );
		
		$is_specific_comment = $comment->comment_type == 'pingback' || $comment->comment_type == 'trackback';
		if ( $is_specific_comment ) {
			$classes[] = 'qodef-comment--no-avatar';
			$classes[] = 'qodef-comment--' . esc_attr( $comment->comment_type );
		}
		?>
    <li class="qodef-comment-item qodef-e <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="qodef-e-inner">
			<?php if ( ! $is_specific_comment ) { ?>
                <div class="qodef-e-image"><?php echo get_avatar( $comment, 88 ); ?></div>
			<?php } ?>
            <div class="qodef-e-content">
                <h5 class="qodef-e-title vcard"><?php echo sprintf( '<span class="fn">%s%s</span>', $is_specific_comment ? sprintf( '%s: ', esc_attr( ucwords( $comment->comment_type ) ) ) : '', get_comment_author_link() ); ?>
	            <?php if ($comment_author && get_the_author_meta( 'degree', $comment_author->ID ) !== '') { ?>
		            <span class="qodef-m-degree"><?php echo esc_html( get_the_author_meta( 'degree', $comment_author->ID ) ); ?></span>
	            <?php } ?>
                </h5>
	            <div class="qodef-e-date commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>"><?php comment_time( get_option( 'date_format' ) ); ?></a>
                </div>
				<?php if ( ! $is_specific_comment ) { ?>
                    <p class="qodef-e-text"><?php echo wp_kses_post( get_comment_text() ); ?></p>
				<?php } ?>
                <div class="qodef-e-links">
					<?php
					comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( 'Reply', 'touchup' ),
						'depth'      => $depth,
						'max_depth'  => $args['max_depth']
					) ) );

					edit_comment_link( esc_html__( 'Edit', 'touchup' ) ); ?>
                </div>
            </div>
        </div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}