<?php
// Metabox
global $post;
$barristar_id    = ( isset( $post ) ) ? $post->ID : false;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
$barristar_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $barristar_id : false;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
if ($barristar_meta) {
  $barristar_topbar_options = $barristar_meta['topbar_options'];
} else {
  $barristar_topbar_options = '';
}
// Define Theme Options and Metabox varials in right way!
if ($barristar_meta) {
  if ($barristar_topbar_options === 'custom' && $barristar_topbar_options !== 'default') {
    $barristar_top_left          = $barristar_meta['top_left'];
    $barristar_top_right          = $barristar_meta['top_right'];
    $barristar_hide_topbar        = $barristar_topbar_options;
    $barristar_topbar_bg          = $barristar_meta['topbar_bg'];
    if ($barristar_topbar_bg) {
      $barristar_topbar_bg = 'background-color: '. $barristar_topbar_bg .';';
    } else {$barristar_topbar_bg = '';}
  } else {
    $barristar_top_left          = cs_get_option('top_left');
    $barristar_top_right          = cs_get_option('top_right');
    $barristar_hide_topbar        = cs_get_option('top_bar');
    $barristar_topbar_bg          = '';
  }
} else {
  // Theme Options fields
  $barristar_top_left         = cs_get_option('top_left');
  $barristar_top_right          = cs_get_option('top_right');
  $barristar_hide_topbar        = cs_get_option('top_bar');
  $barristar_topbar_bg          = '';
}
// All options
if ( $barristar_meta && $barristar_topbar_options === 'custom' && $barristar_topbar_options !== 'default' ) {
  $barristar_top_right = ( $barristar_top_right ) ? $barristar_meta['top_right'] : cs_get_option('top_right');
  $barristar_top_left = ( $barristar_top_left ) ? $barristar_meta['top_left'] : cs_get_option('top_left');
} else {
  $barristar_top_right = cs_get_option('top_right');
  $barristar_top_left = cs_get_option('top_left');
}
if ( $barristar_meta && $barristar_topbar_options !== 'default' ) {
  if ( $barristar_topbar_options === 'hide_topbar' ) {
    $barristar_hide_topbar = 'hide';
  } else {
    $barristar_hide_topbar = 'show';
  }
} else {
  $barristar_hide_topbar_check = cs_get_option( 'top_bar' );
  if ( $barristar_hide_topbar_check === true ) {
    $barristar_hide_topbar = 'hide';
  } else {
    $barristar_hide_topbar = 'show';
  }
}
if ( $barristar_meta ) {
  $barristar_topbar_bg = ( $barristar_topbar_bg ) ? $barristar_meta['topbar_bg'] : '';
} else {
  $barristar_topbar_bg = '';
}
if ( $barristar_topbar_bg ) {
  $barristar_topbar_bg = 'background-color: '. $barristar_topbar_bg .';';
} else { $barristar_topbar_bg = ''; }
if( $barristar_hide_topbar === 'show' && ( $barristar_top_left || $barristar_top_right ) ) {
?>
 <!-- header top area start -->
  <div class="topbar" style="<?php echo esc_attr( $barristar_topbar_bg ); ?>">
    <div class="container">
        <div class="row">
            <div class="col col-lg-10 col-md-8 top-contact-info">
              <?php echo do_shortcode( $barristar_top_left ); ?>
            </div>
            <div class="col col-lg-2 col-md-4">
                <?php echo do_shortcode( $barristar_top_right ); ?>
            </div>
        </div>
    </div>
  </div>
<!-- header top area end -->
<?php } // Hide Topbar - From Metabox