<?php if ( is_active_sidebar( touchup_get_sidebar_name() ) ) { ?>
	<aside id="qodef-page-sidebar">
		<?php dynamic_sidebar( touchup_get_sidebar_name() ); ?>
	</aside>
<?php } ?>