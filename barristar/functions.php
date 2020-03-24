<?php
/*
 * Barristar Theme's Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Define - Folder Paths
 */
define( 'BARRISTAR_THEMEROOT_PATH', get_template_directory() );
define( 'BARRISTAR_THEMEROOT_URI', get_template_directory_uri() );
define( 'BARRISTAR_CSS', BARRISTAR_THEMEROOT_URI . '/assets/css' );
define( 'BARRISTAR_IMAGES', BARRISTAR_THEMEROOT_URI . '/assets/images' );
define( 'BARRISTAR_SCRIPTS', BARRISTAR_THEMEROOT_URI . '/assets/js' );
define( 'BARRISTAR_FRAMEWORK', get_template_directory() . '/includes' );
define( 'BARRISTAR_LAYOUT', get_template_directory() . '/theme-layouts' );
define( 'BARRISTAR_CS_IMAGES', BARRISTAR_THEMEROOT_URI . '/includes/theme-options/framework-extend/images' );
define( 'BARRISTAR_CS_FRAMEWORK', get_template_directory() . '/includes/theme-options/framework-extend' ); // Called in Icons field *.json
define( 'BARRISTAR_ADMIN_PATH', get_template_directory() . '/includes/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$barristar_theme_child = wp_get_theme();
	$barristar_get_parent = $barristar_theme_child->Template;
	$barristar_theme = wp_get_theme($barristar_get_parent);
} else { // Parent Theme Active
	$barristar_theme = wp_get_theme();
}
define('BARRISTAR_NAME', $barristar_theme->get( 'Name' ) );
define('BARRISTAR_VERSION', $barristar_theme->get( 'Version' ) );
define('BARRISTAR_BRAND_URL', $barristar_theme->get( 'AuthorURI' ) );
define('BARRISTAR_BRAND_NAME', $barristar_theme->get( 'Author' ) );

/**
 * All Main Files Include
 */
require_once( BARRISTAR_FRAMEWORK . '/init.php' );