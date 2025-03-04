<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			touchup_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			touchup_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			touchup_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			touchup_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	} ?>
</div>