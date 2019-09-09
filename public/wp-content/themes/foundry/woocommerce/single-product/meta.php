<?php
/**
 * @package Foundry
 * @author TommusRhodus
 * @version 9.9.9
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if( is_array( get_the_terms( $post->ID, 'product_tag' ) ) ) {
	$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
} else {
	$tag_count = '';
}

if( is_array( get_the_terms( $post->ID, 'product_cat' ) ) ) {
	$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
} else {
	$cat_count  = '';
}

?>
<hr class="mb24">
<div class="product_meta">
	<ul>

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<li><strong><?php _e( 'SKU:', 'foundry' ); ?></strong> <?php echo ( wp_kses_post($sku = $product->get_sku()) ) ? $sku : __( 'N/A', 'foundry' ); ?></li>

	<?php endif; ?>

	<?php echo wp_specialchars_decode(wc_get_product_category_list( $product->get_id(), ', ', '<li><strong>' . _n( 'Category:', 'Categories:', $cat_count, 'foundry' ) . '</strong> ', '.</li>' )); ?>

	<?php echo wp_specialchars_decode(wc_get_product_tag_list( $product->get_id(), ', ', '<li><strong>' . _n( 'Tag:', 'Tags:', $tag_count, 'foundry' ) . '</strong> ', '.</li>' )); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	
	</ul>
</div>