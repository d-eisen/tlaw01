<?php
$barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true);

$header_menu_btn  = cs_get_option( 'header_menu_btn' );
$menu_btn_text  = cs_get_option( 'menu_btn_text' );
$menu_btn_link  = cs_get_option( 'menu_btn_link' );
$barristar_cart_widget  = cs_get_option( 'barristar_cart_widget' );
$barristar_search  = cs_get_option( 'barristar_search' );
$menu_btn_text = ( $menu_btn_text ) ? $menu_btn_text : esc_html__( 'Get A Quote', 'barristar' );
$menu_btn_link = ( $menu_btn_link ) ? $menu_btn_link : esc_html__( '#', 'barristar' );

?>
  <div class="cart-search-contact">
    <?php if ( !$barristar_search ) { ?>
      <div class="header-search-form-wrapper">
          <button class="search-toggle-btn"><i class="ti-search"></i></button>
          <div class="header-search-form">
              <form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                  <div>
                      <input type="text" name="s" id="s" class="form-control" placeholder="<?php echo esc_attr__('Search...','barristar'); ?>">
                      <button type="submit"><i class="ti-search"></i></button>
                  </div>
              </form>
          </div>
      </div>
    <?php }
      if ( $barristar_cart_widget &&  class_exists( 'WooCommerce' ) ) {
        get_template_part( 'theme-layouts/header/top','cart' );
      }
     if ( $header_menu_btn ) { ?>
      <div class="get-quote">
          <a href="<?php echo esc_url( $menu_btn_link ); ?>" class="theme-btn"><?php echo esc_html( $menu_btn_text ); ?></a>
      </div>
    <?php } ?>
</div>