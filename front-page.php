<?

defined( 'ABSPATH' ) || exit;

get_header(); 
?>

<div class="container">

	<div class="wrapper" id="frontpage-wrapper">
  <h1><?php _e( 'Vad letar du efter idag?')?></h1>
		<div class="row">

			
				<?
				$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC'));
				foreach($catTerms as $catTerm) : ?>
        <div class="col-md-6 categories">
          <div class="categorie-img">
				<?php $thumbnail_id = get_woocommerce_term_meta( $catTerm->term_id, 'thumbnail_id', true ); 
					$image = wp_get_attachment_url( $thumbnail_id );  ?>
          
           <a href="<?php echo "http://localhost/Woocomerce Projekt/wordpress/index.php/produkt-kategori/" . $catTerm->slug ;?>">
          <!-- Borde skrivas så här -->
           <!-- get_term_link($catTerm)  -->

            <img src="<? echo $image; ?>"></a>
             
            
	 				<div class="centered"><a href="<?php get_term_link($catTerm);?><?php echo $catTerm->slug; ?>">  <h2><img src="<?php echo $a['url']; ?>"> 
           <?php echo $catTerm->name; ?></h2></a>
           </div>
          </div>
           </div>
				<?php endforeach; ?>

			

		</div>

<h1><?php _e( 'Nyaste tillagda produkter')?> </h1>
	<div class="row"> 

		

<?
	if(!function_exists('wc_get_products')) {
    return;
  }
  $paged                   = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
  $ordering                = WC()->query->get_catalog_ordering_args();
  $ordering['orderby']     = array_shift(explode(' ', $ordering['orderby']));
  $ordering['orderby']     = stristr($ordering['orderby'], 'price') ? 'meta_value_num' : $ordering['orderby'];
  $products_per_page       = apply_filters('loop_shop_per_page', wc_get_default_products_per_row() * wc_get_default_product_rows_per_page());

  $products_ids            = wc_get_products(array(
    'status'               => 'publish',
    'limit'                => $products_per_page,
    'page'                 => $paged,
    'paginate'             => true,
    'return'               => 'ids',
    'orderby'              => $ordering['orderby'],
    'order'                => $ordering['order'],
  ));

  wc_set_loop_prop('current_page', $paged);
  wc_set_loop_prop('is_paginated', wc_string_to_bool(true));
  wc_set_loop_prop('page_template', get_page_template_slug());
  wc_set_loop_prop('per_page', $products_per_page);
  wc_set_loop_prop('total', $products_ids->total);
  wc_set_loop_prop('total_pages', $products_ids->max_num_pages);

  

  if($products_ids) {
    //do_action('woocommerce_before_shop_loop');
    //woocommerce_product_loop_start();
      foreach($products_ids->products as $featured_product) {
        ?>
        <div class="col-md-3 products">
          <?
        $post_object = get_post($featured_product);
        setup_postdata($GLOBALS['post'] =& $post_object);
        wc_get_template_part('content', 'product');
        ?>
      </div>
      <?
      }
      wp_reset_postdata();
      
    //woocommerce_product_loop_end();

   // do_action('woocommerce_after_shop_loop');
  } else {
    do_action('woocommerce_no_products_found');
  }
 
?>
			
		</div>
	</div>
</div>
<?
get_footer();
?>
