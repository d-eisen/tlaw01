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
	$barristar_single_comment = cs_get_option( 'single_comment_form' );
	?>
	<div class="attorneys-content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                 <?php
									if ( have_posts() ) :
										/* Start the Loop */
										while ( have_posts() ) : the_post();
											if ( post_password_required() ) {
													echo '<div class="password-form">'.get_the_password_form().'</div>';
												} else {
													get_template_part( 'theme-layouts/post/attorney', 'content' );
													$barristar_single_comment = !$barristar_single_comment ? comments_template() : '';

												}
										endwhile;
									else :
										get_template_part( 'theme-layouts/post/content', 'none' );
									endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();