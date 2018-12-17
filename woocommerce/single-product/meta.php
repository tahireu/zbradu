<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;
?>
<div class="product_meta">

    <?php do_action( 'woocommerce_product_meta_start' ); ?>

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <small class="sku_wrapper"><?php ?><b><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></b> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></small>

    <?php endif; ?>

    <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<small class="posted_in"><b>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . '</b> ', '</small>' ); ?>

    <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<small class="tagged_as">' . _n( '<b>Tag:</b>', '<b>Tags:<b/>', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</small>' ); ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>