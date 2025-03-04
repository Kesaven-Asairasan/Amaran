<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		touchup_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				
				<div class="qodef-e-info-left">
					<?php
					// Include post date info
					touchup_template_part( 'blog', 'templates/parts/post-info/date' );
					
					// Include post category info
					touchup_template_part( 'blog', 'templates/parts/post-info/category' );
					?>
				</div>
				
				<div class="qodef-e-info-right">
					<?php
					// Hook to include socal share
					do_action( 'touchup_action_after_blog_bottom_right_content' );
					?>
				</div>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				touchup_template_part( 'blog', 'templates/parts/post-info/title' );
				
				// Include post content
				the_content();
				
				// Hook to include additional content after blog single content
				do_action( 'touchup_action_after_blog_single_content' );
				?>
			</div>
		</div>
	</div>
</article>