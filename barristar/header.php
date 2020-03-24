<?php
/*
 * The header for our theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
?><!DOCTYPE html>
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
$barristar_viewport = cs_get_option( 'theme_responsive' );
if( !$barristar_viewport ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } $barristar_all_element_color  = cs_get_customize_option( 'all_element_colors' ); ?>
<meta name="msapplication-TileColor" content="<?php echo esc_attr( $barristar_all_element_color ); ?>">
<meta name="theme-color" content="<?php echo esc_attr( $barristar_all_element_color ); ?>">
<link rel="profile" href="//gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
// Metabox
global $post;
$barristar_id    = ( isset( $post ) ) ? $post->ID : false;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
$barristar_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $barristar_id : false;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
// Theme Layout Width
$barristar_layout_width  = cs_get_option( 'theme_layout_width' );
$theme_preloder  = cs_get_option( 'theme_preloder' );
$barristar_layout_width_class = ( $barristar_layout_width === 'container' ) ? 'layout-boxed' : 'layout-full';
// Header Style

if ( $barristar_meta ) {
  $barristar_header_design  = $barristar_meta['select_header_design'];
} else {
  $barristar_header_design  = cs_get_option( 'select_header_design' );
}

$barristar_sticky_header  = cs_get_option( 'sticky_header' );

if ( $barristar_header_design === 'default' ) {
  $barristar_header_design_actual  = cs_get_option( 'select_header_design' );
} else {
  $barristar_header_design_actual = ( $barristar_header_design ) ? $barristar_header_design : cs_get_option('select_header_design');
}
$barristar_header_design_actual = $barristar_header_design_actual ? $barristar_header_design_actual : 'style_one';

if ( $barristar_header_design_actual == 'style_one' ) {
  $header_class = 'header-style-1';
} elseif ( $barristar_header_design_actual == 'style_two' ) {
  $header_class = 'header-style-2';
} else {
  $header_class = 'header-style-3';
}

if ( $barristar_sticky_header ) {
  $barristar_sticky_header = $barristar_sticky_header ? ' sticky-menu-on ' : '';
} else {
  $barristar_sticky_header = '';
}
// Header Transparent
if ( $barristar_meta ) {
  $barristar_transparent_header = $barristar_meta['transparency_header'];
  $barristar_transparent_header = $barristar_transparent_header ? ' header-transparent' : ' dont-transparent';
  // Shortcode Banner Type
  $barristar_banner_type = ' '. $barristar_meta['banner_type'];
} else { $barristar_transparent_header = ' dont-transparent'; $barristar_banner_type = ''; }
wp_head();
?>
</head>
<body <?php body_class(); ?>>
<?php
  wp_body_open();
  ?>
<div class="page-wrapper <?php echo esc_attr( $barristar_layout_width_class ); ?>"> <!-- #barristar-theme-wrapper -->
<?php if( $theme_preloder ) {
 get_template_part( 'theme-layouts/header/preloder' );
 } ?>
 <header id="header" class="site-header <?php echo esc_attr( $header_class ); ?>">
      <?php get_template_part( 'theme-layouts/header/top','bar' ); ?>
      <nav class="navigation <?php echo esc_attr( $barristar_sticky_header ); ?> navbar navbar-default">
        <?php get_template_part( 'theme-layouts/header/menu','bar' ); ?>
      </nav>
  </header>
  <?php
  // Title Area
  $barristar_need_title_bar = cs_get_option('need_title_bar');
  if ( !$barristar_need_title_bar ) {
    get_template_part( 'theme-layouts/header/title', 'bar' );
  }
