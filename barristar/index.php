<?php
/*
 * The main template file.
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
		$barristar_content_padding = isset( $barristar_meta['content_spacings'] ) ? $barristar_meta['content_spacings'] : '';
	} else { $barristar_content_padding = ''; }
	// Padding - Metabox
	if ($barristar_content_padding && $barristar_content_padding !== 'padding-default') {
		$barristar_content_top_spacings = $barristar_meta['content_top_spacings'];
		$barristar_content_bottom_spacings = $barristar_meta['content_bottom_spacings'];
		if ($barristar_content_padding === 'padding-custom') {
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

	// Theme Options
	$barristar_sidebar_position = cs_get_option( 'barristar_blog_sidebar_position' );
	$barristar_sidebar_position = $barristar_sidebar_position ?$barristar_sidebar_position : 'sidebar-right';
	$barristar_blog_widget = cs_get_option( 'barristar_blog_widget' );
	$barristar_blog_widget = $barristar_blog_widget ? $barristar_blog_widget : 'sidebar-1';

	if (isset($_GET['sidebar'])) {
	  $barristar_sidebar_position = $_GET['sidebar'];
	}
	$barristar_sidebar_position = $barristar_sidebar_position ? $barristar_sidebar_position : 'sidebar-right';

	// Sidebar Position
	if ( $barristar_sidebar_position === 'sidebar-hide' ) {
		$layout_class = 'col-md-12';
		$barristar_sidebar_class = 'hide-sidebar';
	} elseif ( $barristar_sidebar_position === 'sidebar-left' && is_active_sidebar( $barristar_blog_widget ) ) {
		$layout_class = 'col-md-8 col-md-push-4';
		$barristar_sidebar_class = 'left-sidebar';
	} elseif( $barristar_sidebar_position === 'sidebar-right' && is_active_sidebar( $barristar_blog_widget ) ) {
		$layout_class = 'col-md-8';
		$barristar_sidebar_class = 'right-sidebar';
	} else {
		$layout_class = 'col-md-12';
		$barristar_sidebar_class = 'hide-sidebar';
	}

	?>
	<div class="blog-pg-section section-padding">
		<div class="container content-area <?php echo esc_attr( $barristar_content_padding .' '. $barristar_sidebar_class ); ?>" style="<?php echo esc_attr( $barristar_custom_padding ); ?>">
		<div class="row">
			<div class="blog-wrap <?php echo esc_attr( $layout_class ); ?>">
				<div class="blog-content">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'theme-layouts/post/content' );
					endwhile;
				else :
					get_template_part( 'theme-layouts/post/content', 'none' );
				endif;
				barristar_paging_nav();
		    wp_reset_postdata(); ?>
		    </div>
			</div><!-- Content Area -->
			<?php
			if ( $barristar_sidebar_position !== 'sidebar-hide' && is_active_sidebar( $barristar_blog_widget ) ) {
				get_sidebar(); // Sidebar
			} ?>
		</div>
	</div>
</div>
<?php
get_footer();