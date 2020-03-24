<?php
	// Metabox - Header Transparent
	$barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
	$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
	$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
	$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox'. true );
?>
 <!-- start preloader -->
  <div class="preloader">
     <div class="sk-cube-grid">
		    <div class="sk-cube sk-cube1"></div>
		    <div class="sk-cube sk-cube2"></div>
		    <div class="sk-cube sk-cube3"></div>
		    <div class="sk-cube sk-cube4"></div>
		    <div class="sk-cube sk-cube5"></div>
		    <div class="sk-cube sk-cube6"></div>
		    <div class="sk-cube sk-cube7"></div>
		    <div class="sk-cube sk-cube8"></div>
		    <div class="sk-cube sk-cube9"></div>
		</div>
  </div>
  <!-- end preloader -->