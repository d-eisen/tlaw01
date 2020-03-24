<?php
add_action( 'wp_enqueue_scripts', 'barristar_enqueue_styles' );
function barristar_enqueue_styles() {
	$parent_style = 'barristar-style';
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/css/styles.css', array('font-awesome', 'themify-icons', 'flaticon', 'bootstrap','animate', 'odometer', 'owl-carousel', 'owl-theme', 'owl-transitions', 'slick','slick-theme','fancybox', ) );
  wp_enqueue_style( 'barristar-child',
      get_stylesheet_directory_uri() . '/style.css',
      array( $parent_style ),
      wp_get_theme()->get('Version')
    );
}
if( ! function_exists( 'barristar_child_theme_language_setup' ) ) {
	function barristar_child_theme_language_setup(){
	  load_theme_textdomain( 'barristar-child', get_template_directory() . '/languages' );
	}
	add_action('after_setup_theme', 'barristar_child_theme_language_setup');
}