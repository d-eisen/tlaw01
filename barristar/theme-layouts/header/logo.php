<?php
// Metabox
global $post;
$barristar_id    = ( isset( $post ) ) ? $post->ID : false;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
$barristar_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('service') ) ? $barristar_id : false;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
// Header Style
if ( $barristar_meta ) {
  $barristar_header_design  = $barristar_meta['select_header_design'];
} else {
  $barristar_header_design  = cs_get_option( 'select_header_design' );
}

if ( $barristar_header_design === 'default' ) {
  $barristar_header_design_actual  = cs_get_option( 'select_header_design' );
} else {
  $barristar_header_design_actual = ( $barristar_header_design ) ? $barristar_header_design : cs_get_option('select_header_design');
}
$barristar_header_design_actual = $barristar_header_design_actual ? $barristar_header_design_actual : 'style_one';

$barristar_logo = cs_get_option( 'barristar_logo' );
$barristar_trlogo = cs_get_option( 'barristar_trlogo' );
$logo_url = wp_get_attachment_url( $barristar_logo );
$logo_alt = get_post_meta( $barristar_logo, '_wp_attachment_image_alt', true );
$trlogo_url = wp_get_attachment_url( $barristar_trlogo );
$trlogo_alt = get_post_meta( $barristar_trlogo, '_wp_attachment_image_alt', true );

if ( $logo_url ) {
  $logo_url = $logo_url;
} else {
 $logo_url = BARRISTAR_IMAGES.'/logo.png';
}

if ( $trlogo_url ) {
  $trlogo_url = $trlogo_url;
} else {
 $trlogo_url = BARRISTAR_IMAGES.'/tr-logo.png';
}

if ( $barristar_header_design_actual == 'style_one' ) {
  $barristar_logo_url = $logo_url;
  $barristar_logo_alt = $logo_alt;
} elseif ( $barristar_header_design_actual == 'style_two' ) {
  $barristar_logo_url = $trlogo_url;
  $barristar_logo_alt = $trlogo_alt;
} else {
  $barristar_logo_url = $trlogo_url;
  $barristar_logo_alt = $trlogo_alt;
}

// Logo Spacings
// Logo Spacings
$barristar_brand_logo_top = cs_get_option( 'barristar_logo_top' );
$barristar_brand_logo_bottom = cs_get_option( 'barristar_logo_bottom' );
if ( $barristar_brand_logo_top ) {
  $barristar_brand_logo_top = 'padding-top:'. barristar_check_px( $barristar_brand_logo_top ) .';';
} else { $barristar_brand_logo_top = ''; }
if ( $barristar_brand_logo_bottom ) {
  $barristar_brand_logo_bottom = 'padding-bottom:'. barristar_check_px( $barristar_brand_logo_bottom ) .';';
} else { $barristar_brand_logo_bottom = ''; }
?>
<div class="site-logo"  style="<?php echo esc_attr( $barristar_brand_logo_top ); echo esc_attr( $barristar_brand_logo_bottom ); ?>">
   <?php if ( $barristar_logo ) {
    ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $barristar_logo_url ); ?>" alt=" <?php echo esc_attr( $barristar_logo_alt ); ?>">
     </a>
   <?php } elseif( has_custom_logo() ) {
      the_custom_logo();
    } else {
    ?>
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $barristar_logo_url ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
     </a>
   <?php
  } ?>
</div>