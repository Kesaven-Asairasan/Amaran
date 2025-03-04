<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-reviews.php
 * 
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

?>
<li>
	<?php do_action( 'woocommerce_widget_product_review_item_start', $args ); ?>

	<div class="qodef-woo-product-image">
		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php echo touchup_wp_kses_html( 'img', $product->get_image() ); ?>
		</a>
	</div>
	<div class="qodef-woo-product-content">
		<h5 class="qodef-woo-product-title">
			<a itemprop="url" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php echo wp_kses_post( $product->get_name() ); ?></a>
		</h5>
		<?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div class="qodef-woo-product-reviewer">
			<?php echo sprintf( esc_html__( 'by %s', 'touchup' ), get_comment_author( $comment->comment_ID ) ); ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_widget_product_review_item_end', $args ); ?>
</li>
