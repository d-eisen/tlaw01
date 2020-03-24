<?php
  // Metabox
  $barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
  $barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
  $barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
  $barristar_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $barristar_id : false;
  $barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
  $header_menu_btn  = cs_get_option( 'header_menu_btn' );
  $barristar_cart_widget  = cs_get_option( 'barristar_cart_widget' );
  if ($barristar_meta) {
    $barristar_choose_menu = $barristar_meta['choose_menu'];
  } else { $barristar_choose_menu = ''; }
  $barristar_choose_menu = $barristar_choose_menu ? $barristar_choose_menu : '';

  if ( !$header_menu_btn ) {
   $navbar_class = ' header-padding ';
  } else {
  $navbar_class = ' has-header-btn ';
  }
  if ( !$barristar_cart_widget ) {
   $cart_class = ' no-header-cart';
  } else {
  $cart_class = ' has-header-cart';
  }
?>
<!-- Navigation & Search -->
 <div class="container">
      <div class="navbar-header">
          <button type="button" class="open-btn">
              <span class="sr-only"><?php echo esc_html__( 'Toggle navigation','barristar' ) ?></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <?php get_template_part( 'theme-layouts/header/logo' ); ?>
      </div>
    <div id="navbar" class="navbar-collapse navbar-right collapse navigation-holder <?php echo esc_attr( $navbar_class.$cart_class ); ?>">
     <button class="close-navbar"><i class="ti-close"></i></button>
        <?php
            wp_nav_menu(
              array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'container'         => '',
                'container_class'   => '',
                'container_id'      => '',
                'menu'              => $barristar_choose_menu,
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => '__return_false',
              )
            );
          ?>
      </div><!-- end of nav-collapse -->
      <?php get_template_part( 'theme-layouts/header/search','bar' ); ?>
  </div><!-- end of container -->


