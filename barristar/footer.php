<?php
/*
 * The template for displaying the footer.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

$barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
if ( $barristar_meta ) {
	$barristar_hide_footer  = $barristar_meta['hide_footer'];
} else { $barristar_hide_footer = ''; }
if ( !$barristar_hide_footer ) { // Hide Footer Metabox
	$hide_copyright = cs_get_option('hide_copyright');
?>
	<!-- Footer -->
	<footer class="site-footer">
		<?php
			$footer_widget_block = cs_get_option( 'footer_widget_block' );
			if ( $footer_widget_block ) {
	      get_template_part( 'theme-layouts/footer/footer', 'widgets' );
	    }
			if ( !$hide_copyright ) {
      	get_template_part( 'theme-layouts/footer/footer', 'copyright' );
	    }
    ?>
	</footer>
	<!-- Footer -->
<?php } // Hide Footer Metabox ?>
</div><!--barristar-theme-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
