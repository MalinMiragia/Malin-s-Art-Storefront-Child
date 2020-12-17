<?php

// // Include Bootstrap
function your_script_enqueue() {
    wp_enqueue_script( 'bootstrap_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'), NULL, true );
    
    wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css', false, NULL, 'all' );
    wp_enqueue_style( 'custom_style', get_template_directory_uri() . '/css/your_style.css', array(), '1.0.0', 'all');
  
    wp_enqueue_script( 'custom_js', get_template_directory_uri() . '/js/custom.js' ); 
 }
 
 add_action( 'wp_enqueue_scripts', 'your_script_enqueue' );


// Remove reviews tab 

add_filter( 'woocommerce_product_tabs', 'malinsart_product_tabs', 100);
function malinsart_product_tabs( $tabs )    {
    unset($tabs['reviews']);
    unset($tabs['description']);
    unset($tabs['additional information']);
    return $tabs;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 30);


// //Change the number of products per page
// add_filter( 'loop_shop_per_page', 'malinsart_products_per_page',20);
// function malinsart_products_per_page( $num_products )   {
//     return 20;
// }

// //Change the number of colums

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
       'edit-address' => __( 'Addresses', 'woocommerce' ),
       'edit-account' => __( 'Account Details', 'woocommerce' ),
       'customer-logout' => __( 'Logout', 'woocommerce' ),
  );
 return $menuOrder;
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );
 




// Is supposed to make it so I can have full-width pages

add_action( 'wp', 'woa_remove_sidebar_shop_page' );
function woa_remove_sidebar_shop_page() {

if ( is_shop() || is_tax( 'product_cat' ) || get_post_type() == 'product' ) {

remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
add_filter( 'body_class', 'woa_remove_sidebar_class_body', 10 );
}
}

function woa_remove_sidebar_class_body( $wp_classes ) {

$wp_classes[] = 'page-template-template-fullwidth-php';
return $wp_classes;
}

?>