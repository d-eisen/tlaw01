<?php


// Count Ajax
function barristar_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>

  <span class="cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>

  <?php
  $fragments['span.cart-count'] = ob_get_clean();

  return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'barristar_woocommerce_header_add_to_cart_fragment');

// Amount Ajax
function barristar_amount_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <span class="total-amount"><?php echo wp_kses( WC()->cart->get_cart_total(), array( 'span' => array( 'class' => array() ) ) ); ?></span>
  <?php

  $fragments['span.total-amount'] = ob_get_clean();

  return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'barristar_amount_woocommerce_header_add_to_cart_fragment');


remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_filter('woocommerce_show_page_title', '__return_false');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function barristar_woocommerce_products_per_page() {
  $barristar_product_count = cs_get_option('barristar_woo_limit');
  $barristar_product_count = $barristar_product_count ? $barristar_product_count : 8;
  return (int) $barristar_product_count;
}
add_filter( 'loop_shop_per_page', 'barristar_woocommerce_products_per_page' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 */
function barristar_woocommerce_related_products_args( $args ) {
  $barristar_releted_count = cs_get_option('woo_related_limit');
  $defaults = array(
    'posts_per_page' => $barristar_releted_count,
  );
  $args = wp_parse_args( $defaults, $args );
  return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'barristar_woocommerce_related_products_args' );


function barristar_wc_theme_setup()  {
  $barristar_woo_single_related = cs_get_option('woo_single_related');
  $barristar_woo_single_upsell = cs_get_option('woo_single_upsell');
  if ( $barristar_woo_single_related == true ) {
     return remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
  }
  if ( $barristar_woo_single_upsell == true ) {
     return remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
  }

  if( is_woocommerce_activated() && class_exists( 'YITH_WCWL' ) ) {
    add_action('woocommerce_after_shop_loop_item', 'barristar_yith_wcwl_add_to_wishlist_button', 5);
  }

   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

   remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
}
add_action('after_setup_theme','barristar_wc_theme_setup', 10);


  function barristar_yith_wcwl_add_to_wishlist_button() {
    global $product;

    if( ! isset( $product ) ){
      $product = ( isset( $atts['product_id'] ) ) ? wc_get_product( $atts['product_id'] ) : false;
    }

    $label_option = get_option( 'yith_wcwl_add_to_wishlist_text' );
    $label = apply_filters( 'yith_wcwl_button_label', $label_option );
    $browse_wishlist = get_option( 'yith_wcwl_browse_wishlist_text' );

    $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

    if( ! empty( $default_wishlists ) ){
      $default_wishlist = $default_wishlists[0]['ID'];
    }
    else{
      $default_wishlist = false;
    }
    $wishlist_url = YITH_WCWL()->get_wishlist_url();

  ?>
    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr($product->get_id()); ?>">
      <div class="yith-wcwl-add-button show" style="display:block">
        <a href="<?php echo esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>" rel="nofollow" data-product-id="<?php echo esc_attr($product->get_id()); ?>" data-product-type="simple"  data-toggle="Add to Wishlist"  class="add_to_wishlist"><i class="fa fa-heart"></i></a>
      </div>
      <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
          <span class="feedback"><?php echo esc_html__( 'Product added!', 'barristar' ); ?></span>
          <a href="<?php echo esc_url( $wishlist_url ); ?>" class="view-wishlist" rel="nofollow"><?php echo esc_html__( 'View List', 'barristar' ); ?></a>
      </div>
        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback"><?php echo esc_html__( 'The product is already in the wishlist!', 'barristar' ); ?></span>
            <a href="<?php echo esc_url( $wishlist_url ); ?>"  class="wishilist-already-added" rel="nofollow"><i class="fa fa-heart"></i></a>
        </div>
        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    </div>
  <?php
}
  update_option( 'woocommerce_thumbnail_cropping', 'custom' );
  update_option( 'woocommerce_thumbnail_cropping_custom_width', '4' );
  update_option( 'woocommerce_thumbnail_cropping_custom_height', '5' );


if (!function_exists('barristar_loop_columns')) {
  function barristar_loop_columns() {
  $woo_product_columns = cs_get_option('woo_product_columns');
  $woo_product_columns = $woo_product_columns ? $woo_product_columns : 3;
    return (int) $woo_product_columns;
  }
}
add_filter('loop_shop_columns', 'barristar_loop_columns');

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function barristar_products_per_page() {
  $barristar_product_count = cs_get_option('theme_woo_limit');
  $barristar_product_count = $barristar_product_count ? $barristar_product_count : 9;
  return (int) $barristar_product_count;
}
add_filter( 'loop_shop_per_page', 'barristar_products_per_page' );


// Count Ajax
function barristar_cart_woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
     <div class="mini-cart-content">
        <div class="mini-cart-title">
            <p><?php echo esc_html__('Shopping Cart','barristar'); ?></p>
        </div>
        <?php if ( ! WC()->cart->is_empty() ) : ?>
          <div class="mini-cart-items">
             <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
              $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
              $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

              if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
            <div class="mini-cart-item clearfix">
                <div class="mini-cart-item-image">
                    <?php
                      $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                      if ( ! $product_permalink ) {
                        echo wp_kses_post( $thumbnail );
                      } else {
                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                      }
                    ?>
                </div>
                <div class="mini-cart-item-des">
                     <?php
                      if ( ! $product_permalink ) {
                        echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
                      } else {
                        echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
                      }
                    ?>
                    <span class="mini-cart-item-price">
                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                    </span>
                    <span class="mini-cart-item-quantity"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                    <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                          '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                          esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                          esc_html__( 'Remove this item', 'barristar' ),
                          esc_attr( $product_id ),
                          esc_attr( $_product->get_sku() )
                        ), $cart_item_key );
                      ?>
                </div>
            </div>
            <?php
              }
             }
            ?>
        </div>
        <?php else : ?>
          <span class="no-products"><?php echo esc_html__(' No products in the cart.','barristar' ); ?></span class="no-products">
        <?php endif; ?>
        <div class="mini-cart-action clearfix">
            <span class="mini-checkout-price"><?php echo WC()->cart->get_cart_total(); ?></span>
             <?php $mini_cart_url = wc_get_page_permalink( 'cart' ); $mini_shop_url = wc_get_page_permalink( 'shop' ); ?>
             <?php if (! WC()->cart->is_empty() ) { ?>
              <a href="<?php  echo esc_url( $mini_cart_url ) ?>" class="theme-btn-s2"><?php echo esc_html__(' View Cart','barristar' ); ?>
            </a>
             <?php } else { ?>
               <a href="<?php  echo esc_url( $mini_shop_url ) ?>" class="theme-btn-s2"><?php echo esc_html__(' Go to Shop','barristar' ); ?>
            </a>
            <?php } ?>
        </div>
    </div>

  <?php
  $fragments['div.mini-cart-content'] = ob_get_clean();

  return $fragments;

}
add_filter('woocommerce_add_to_cart_fragments', 'barristar_cart_woocommerce_header_add_to_cart_fragment');


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );