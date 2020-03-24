<?php
/*
 * The sidebar containing the main widget area.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$barristar_blog_widget = cs_get_option( 'barristar_blog_widget' );
$barristar_single_blog_widget = cs_get_option( 'barristar_single_blog_widget' );
$barristar_service_widget = cs_get_option( 'single_service_widget' );
$barristar_service_sidebar_position = cs_get_option( 'service_sidebar_position' );
$barristar_project_sidebar_position = cs_get_option( 'project_sidebar_position' );
$barristar_project_widget = cs_get_option( 'single_project_widget' );
$barristar_blog_sidebar_position = cs_get_option( 'barristar_blog_sidebar_position' );
$barristar_sidebar_position = cs_get_option( 'barristar_single_sidebar_position' );
$woo_widget = cs_get_option('woo_widget');
$barristar_page_layout_shop = cs_get_option( 'woo_sidebar_position' );
$shop_sidebar_position = ( is_woocommerce_shop() ) ? $barristar_page_layout_shop : '';
if ( is_home() || is_archive() || is_search() ) {
	$barristar_blog_sidebar_position = $barristar_blog_sidebar_position;
} else {
	$barristar_blog_sidebar_position = '';
}
if ( is_single() ) {
	$barristar_sidebar_position = $barristar_sidebar_position;
} else {
	$barristar_sidebar_position = '';
}

if ( is_singular( 'service' ) ) {
	$barristar_service_sidebar_position = $barristar_service_sidebar_position;
} else {
	$barristar_service_sidebar_position = '';
}
if ( is_singular( 'project' ) ) {
	$barristar_project_sidebar_position = $barristar_project_sidebar_position;
} else {
	$barristar_project_sidebar_position = '';
}
if ( is_page() ) {
	// Page Layout Options
	$barristar_page_layout = get_post_meta( get_the_ID(), 'page_layout_options', true );
	if ( $barristar_page_layout ) {
		$barristar_page_sidebar_pos = $barristar_page_layout['page_layout'];
	} else {
		$barristar_page_sidebar_pos = '';
	}
} else {
	$barristar_page_sidebar_pos = '';
}
if (isset($_GET['sidebar'])) {
  $barristar_blog_sidebar_position = $_GET['sidebar'];
}
// sidebar class
if ( $barristar_sidebar_position === 'sidebar-left' || $barristar_page_sidebar_pos == 'left-sidebar' || $barristar_blog_sidebar_position === 'sidebar-left' || $barristar_service_sidebar_position === 'sidebar-left' || $barristar_project_sidebar_position === 'sidebar-left' || $shop_sidebar_position == 'left-sidebar'  ) {
	$col_class = 'col-md-pull-8';
} else {
	$col_class = '';
}

if ( $barristar_service_widget || $barristar_project_widget ) {
	$sidebar_class  = ' service-sidebar';
} else {
	$sidebar_class  = '';
}
?>
<div class="blog-sidebar col col-md-4 <?php echo esc_attr( $col_class.$sidebar_class ); ?>">
	<?php
	if (is_page() && isset( $barristar_page_layout['page_sidebar_widget'] ) && !empty( $barristar_page_layout['page_sidebar_widget'] ) ) {
		if ( is_active_sidebar( $barristar_page_layout['page_sidebar_widget'] ) ) {
			dynamic_sidebar( $barristar_page_layout['page_sidebar_widget'] );
		}
	} elseif (!is_page() && $barristar_blog_widget && !$barristar_single_blog_widget) {
		if ( is_active_sidebar( $barristar_blog_widget ) ) {
			dynamic_sidebar( $barristar_blog_widget );
		}
	}  elseif ( $barristar_service_widget && is_singular( 'service' ) ) {
		if ( is_active_sidebar( $barristar_service_widget ) ) {
			dynamic_sidebar( $barristar_service_widget );
		}
	} elseif ( $barristar_project_widget && is_singular( 'project' ) ) {
		if ( is_active_sidebar( $barristar_project_widget ) ) {
			dynamic_sidebar( $barristar_project_widget );
		}
	}  elseif (is_woocommerce_shop() && $woo_widget) {
		if (is_active_sidebar($woo_widget)) {
			dynamic_sidebar($woo_widget);
		}
	} elseif ( is_single() && $barristar_single_blog_widget ) {
		if ( is_active_sidebar( $barristar_single_blog_widget ) ) {
			dynamic_sidebar( $barristar_single_blog_widget );
		}
	} else {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		}
	} ?>
</div><!-- #secondary -->
