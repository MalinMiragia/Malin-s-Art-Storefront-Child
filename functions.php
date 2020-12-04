<?php
// Remove reviews tab 

add_filter( 'woocommerce_product_tabs', 'malinsart_product_tabs', 100);
function malinsart_product_tabs( $tabs )    {
    unset($tabs['reviews']);
    unset($tabs['description']);
    unset($tabs['more information']);
    return $tabs;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 30);

add_action('woocommerce_template_single_rating', 'woocommerce_template_single_meta', 10);



// Change the number of products per page
// add_filter( 'loop_shop_per_page', 'malinsart_products_per_page',20);
// function malinsart_products_per_page( $num_products )   {
//     return 20;
// }

// Change the number of colums

// add_filter( 'loop_shop_colums', 'malinsart_number_colums',20);
// function malinsart_number_colums( $cols )   {
//     return 5;
// }

// Changing the sales logo

add_filter( 'woocommerce_sale_flash', 'malinsart_remove_on_sale_badge' );
 function malinsart_remove_on_sale_badge( $badge_html ){
	return '';
}

// Moving the add to cart button
remove_action( 'woocommerce_single_product_summary', 
'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 
'woocommerce_template_single_add_to_cart', 35 );

// Changing the menu in My Account

function my_account_menu_order() {
    $menuOrder = array(
       'dashboard' => __( 'Dashboard', 'woocommerce' ),
       'orders' => __( 'Orders', 'woocommerce' ),
       'downloads' => __( 'Download', 'woocommerce' ),
       'edit-address' => __( 'Addresses', 'woocommerce' ),
       'edit-account' => __( 'Account Details', 'woocommerce' ),
       'customer-logout' => __( 'Logout', 'woocommerce' ),
  );
 return $menuOrder;
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );
 ?>
