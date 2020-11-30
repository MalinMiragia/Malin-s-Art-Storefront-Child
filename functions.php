<?php
// Remove reviews tab 

add_filter( 'woocommerce_product_tabs', 'malinsart_product_tabs', 100);
function malinsart_product_tabs( $tabs )    {
    unset($tabs['reviews']);
    return $tabs;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 30);
?>