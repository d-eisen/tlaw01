<?php
/*
 * All Barristar Theme Related Functions Files are Linked here
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Theme All Barristar Setup */
require_once( BARRISTAR_FRAMEWORK . '/theme-support.php' );
require_once( BARRISTAR_FRAMEWORK . '/backend-functions.php' );
require_once( BARRISTAR_FRAMEWORK . '/frontend-functions.php' );
require_once( BARRISTAR_FRAMEWORK . '/enqueue-files.php' );
require_once( BARRISTAR_CS_FRAMEWORK . '/custom-style.php' );
require_once( BARRISTAR_CS_FRAMEWORK . '/config.php' );

/* Install Plugins */
require_once( BARRISTAR_FRAMEWORK . '/theme-options/plugins/activation.php' );

/* Breadcrumbs */
require_once( BARRISTAR_FRAMEWORK . '/theme-options/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( BARRISTAR_FRAMEWORK . '/theme-options/plugins/aq_resizer.php' );

/* Bootstrap Menu Walker */
require_once( BARRISTAR_FRAMEWORK . '/core/wp_bootstrap_navwalker.php' );

/* Sidebars */
require_once( BARRISTAR_FRAMEWORK . '/core/sidebars.php' );

if ( class_exists( 'WooCommerce' ) ) :
	require_once( BARRISTAR_FRAMEWORK . '/woocommerce-extend.php' );
endif;