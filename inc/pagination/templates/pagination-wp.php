<?php if ( get_the_posts_pagination() !== '' ): ?>

    <div class="qodef-m-pagination qodef--wp">
		<?php
		// Load posts pagination (in order to override template use navigation_markup_template filter hook)
		the_posts_pagination( array(
			'prev_text'          => touchup_get_icon( 'icon-arrows-left', 'linea-icons', touchup_small_left_arrow_svg() ),
			'next_text'          => touchup_get_icon( 'icon-arrows-right', 'linea-icons', touchup_small_right_arrow_svg() )
		) ); ?>
    </div>

<?php endif; ?>