<?php
/*
 * The template for displaying all single posts.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
// Metabox
$barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
if ( $barristar_meta ) {
	$barristar_content_padding = $barristar_meta['content_spacings'];
} else { $barristar_content_padding = ''; }
// Padding - Metabox
if ( $barristar_content_padding && $barristar_content_padding !== 'padding-default' ) {
	$barristar_content_top_spacings = $barristar_meta['content_top_spacings'];
	$barristar_content_bottom_spacings = $barristar_meta['content_bottom_spacings'];
	if ( $barristar_content_padding === 'padding-custom' ) {
		$barristar_content_top_spacings = $barristar_content_top_spacings ? 'padding-top:'. barristar_check_px($barristar_content_top_spacings) .';' : '';
		$barristar_content_bottom_spacings = $barristar_content_bottom_spacings ? 'padding-bottom:'. barristar_check_px($barristar_content_bottom_spacings) .';' : '';
		$barristar_custom_padding = $barristar_content_top_spacings . $barristar_content_bottom_spacings;
	} else {
		$barristar_custom_padding = '';
	}
} else {
	$barristar_custom_padding = '';
}
// Theme Options
$barristar_sidebar_position = cs_get_option( 'service_sidebar_position' );
$barristar_single_comment = cs_get_option( 'service_comment_form' );
$barristar_sidebar_position = $barristar_sidebar_position ? $barristar_sidebar_position : 'left-sidebar';
// Sidebar Position
if ( $barristar_sidebar_position === 'sidebar-hide' ) {
	$barristar_layout_class = 'col-md-12';
	$barristar_sidebar_class = 'hide-sidebar';
} elseif ( $barristar_sidebar_position === 'sidebar-left' ) {
	$barristar_layout_class = 'col-lg-8 col-md-8 col-lg-push-4 col-md-push-4';
	$barristar_sidebar_class = 'left-sidebar';
} else {
	$barristar_layout_class = 'col-lg-8 col-md-8';
	$barristar_sidebar_class = 'right-sidebar';
} ?>
<div class="service-single-section section-padding <?php echo esc_attr( $barristar_content_padding .' '. $barristar_sidebar_class ); ?>" style="<?php echo esc_attr( $barristar_custom_padding ); ?>">
	<div class="container content-area ">
		<div class="row">
			<div class=" <?php echo esc_attr( $barristar_layout_class ); ?>">
				<div class="service-single-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/service', 'single' );
									$barristar_single_comment = !$barristar_single_comment ? comments_template() : '';
								}
						endwhile;
					else :
						get_template_part( 'theme-layouts/post/content', 'none' );
					endif; ?>
				</div><!-- Service Div -->
				<?php
		    barristar_paging_nav();
		    wp_reset_postdata(); ?>
			</div><!-- Content Area -->
				<?php
				if ( $barristar_sidebar_position !== 'sidebar-hide' ) {
					get_sidebar(); // Sidebar
				} ?>
		</div>
	</div>
</div>
<?php
get_footer();