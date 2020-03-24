<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Enqueue Files for FrontEnd
 */
function barristar_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'barristar' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Open Sans:300,400,600,700|Playfair Display:400,700' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}

if ( ! function_exists( 'barristar_scripts_styles' ) ) {
  function barristar_scripts_styles() {

    // Styles
    wp_enqueue_style( 'themify-icons', BARRISTAR_CSS .'/themify-icons.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'flaticon', BARRISTAR_CSS .'/flaticon.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'simple-line-icons', BARRISTAR_CSS .'/simple-line-icons.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'et-icons', BARRISTAR_CSS .'/et-icons.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'font-awesome', BARRISTAR_CSS .'/font-awesome.min.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'bootstrap', BARRISTAR_CSS .'/bootstrap.min.css', array(), '3.3.7', 'all' );
    wp_enqueue_style( 'animate', BARRISTAR_CSS .'/animate.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'odometer', BARRISTAR_CSS .'/odometer.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'owl-carousel', BARRISTAR_CSS .'/owl.carousel.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'owl-theme', BARRISTAR_CSS .'/owl.theme.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'slick', BARRISTAR_CSS .'/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'slick-theme', BARRISTAR_CSS .'/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'owl-transitions', BARRISTAR_CSS .'/owl.transitions.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'fancybox', BARRISTAR_CSS .'/fancybox.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'barristar-style', BARRISTAR_CSS .'/styles.css', array(), BARRISTAR_VERSION, 'all' );
    wp_enqueue_style( 'element', BARRISTAR_CSS .'/elements.css', array(), BARRISTAR_VERSION, 'all' );
     wp_enqueue_style( 'gutenberg-editor-styles', BARRISTAR_CSS . '/gutenberg-editor-style.css' , false );
    if ( !function_exists('cs_framework_init') ) {
      wp_enqueue_style('barristar-default-style', get_template_directory_uri() . '/style.css', array(),  BARRISTAR_VERSION, 'all' );
    }
    wp_enqueue_style( 'barristar-default-google-fonts', barristar_google_font_url(), array(), BARRISTAR_VERSION, 'all' );
    // Scripts
    wp_enqueue_script( 'bootstrap', BARRISTAR_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
    wp_enqueue_script( 'imagesloaded');
    wp_enqueue_script( 'isotope', BARRISTAR_SCRIPTS . '/isotope.min.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'fancybox', BARRISTAR_SCRIPTS . '/fancybox.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-carousel', BARRISTAR_SCRIPTS . '/owl-carousel.js', array( 'jquery' ), '2.0.0', true );
    wp_enqueue_script( 'jquery-easing', BARRISTAR_SCRIPTS . '/jquery-easing.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'wow', BARRISTAR_SCRIPTS . '/wow.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'magnific-popup', BARRISTAR_SCRIPTS . '/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'slick-slider', BARRISTAR_SCRIPTS . '/slick-slider.js', array( 'jquery' ), '1.6.0', true );
    wp_enqueue_script( 'odometer', BARRISTAR_SCRIPTS . '/odometer.min.js', array( 'jquery' ), '0.4.8', true );
    wp_enqueue_script( 'wc-quantity-increment', BARRISTAR_SCRIPTS . '/wc-quantity-increment.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'barristar-scripts', BARRISTAR_SCRIPTS . '/scripts.js', array( 'jquery' ), BARRISTAR_VERSION, true );
    // Comments
    wp_enqueue_script( 'barristar-validate', BARRISTAR_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'barristar-inline-validate', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $barristar_viewport = cs_get_option('theme_responsive');
    if( !$barristar_viewport ) {
      wp_enqueue_style( 'barristar-responsive', BARRISTAR_CSS .'/responsive.css', array(), BARRISTAR_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'barristar_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'barristar_admin_scripts_styles' ) ) {
  function barristar_admin_scripts_styles() {

    wp_enqueue_style( 'barristar-admin-main', BARRISTAR_CSS . '/admin-styles.css', true );
    wp_enqueue_style( 'flaticon', BARRISTAR_CSS . '/flaticon.css', true );
    wp_enqueue_script( 'barristar-admin-scripts', BARRISTAR_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'barristar_admin_scripts_styles' );
}
