<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
if ( $barristar_meta ) {
	$barristar_content_padding = $barristar_meta['content_spacings'];
} else { $barristar_content_padding = 'section-padding'; }
// Top and Bottom Padding
if ( $barristar_content_padding && $barristar_content_padding !== 'padding-default' ) {
	$barristar_content_top_spacings = isset( $barristar_meta['content_top_spacings'] ) ? $barristar_meta['content_top_spacings'] : '';
	$barristar_content_bottom_spacings = isset( $barristar_meta['content_bottom_spacings'] ) ? $barristar_meta['content_bottom_spacings'] : '';
	if ( $barristar_content_padding === 'padding-custom' ) {
		$barristar_content_top_spacings = $barristar_content_top_spacings ? 'padding-top:'. barristar_check_px( $barristar_content_top_spacings ) .';' : '';
		$barristar_content_bottom_spacings = $barristar_content_bottom_spacings ? 'padding-bottom:'. barristar_check_px($barristar_content_bottom_spacings) .';' : '';
		$barristar_custom_padding = $barristar_content_top_spacings . $barristar_content_bottom_spacings;
	} else {
		$barristar_custom_padding = '';
	}
	$padding_class = '';
} else {
	$barristar_custom_padding = '';
	$padding_class = '';
}
// Page Layout
$page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );
if ( $page_layout_options ) {
	$barristar_page_layout = $page_layout_options['page_layout'];
	$page_sidebar_widget = $page_layout_options['page_sidebar_widget'];
} else {
	$barristar_page_layout = 'right-sidebar';
	$page_sidebar_widget = '';
}
$page_sidebar_widget = $page_sidebar_widget ? $page_sidebar_widget : 'sidebar-1';
if ( $barristar_page_layout === 'extra-width' ) {
	$barristar_page_column = 'extra-width';
	$barristar_page_container = 'container-fluid';
} elseif ( $barristar_page_layout === 'full-width' ) {
	$barristar_page_column = 'col-md-12';
	$barristar_page_container = 'container ';
} elseif( ( $barristar_page_layout === 'left-sidebar' || $barristar_page_layout === 'right-sidebar' ) && is_active_sidebar( $page_sidebar_widget ) ) {
	if( $barristar_page_layout === 'left-sidebar' ){
		$barristar_page_column = 'col-md-8 order-12';
	} else {
		$barristar_page_column = 'col-md-8';
	}
	$barristar_page_container = 'container ';
} else {
	$barristar_page_column = 'col-md-12';
	$barristar_page_container = 'container ';
}
$barristar_theme_page_comments = cs_get_option( 'theme_page_comments' );
get_header();
?>
<div class="page-wrap <?php echo esc_attr( $padding_class ); ?>">
	<div class="<?php echo esc_attr( $barristar_page_container.''.$barristar_content_padding.' '.$barristar_page_layout ); ?>" style="<?php echo esc_attr( $barristar_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $barristar_page_column ); ?>">
				<div class="page-wraper clearfix">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
					barristar_paging_nav();
					if ( !$barristar_theme_page_comments && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
				</div>
				<div class="page-link-wrap">
					<?php barristar_wp_link_pages(); ?>
				</div>
			</div>
			<?php
			// Sidebar
			if( ($barristar_page_layout === 'left-sidebar' || $barristar_page_layout === 'right-sidebar') && is_active_sidebar( $page_sidebar_widget )  ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();