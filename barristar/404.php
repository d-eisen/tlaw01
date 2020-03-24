<?php
/*
 * The template for displaying 404 pages (not found).
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
// Theme Options
$barristar_error_heading = cs_get_option('error_heading');
$barristar_error_subheading = cs_get_option('error_subheading');
$barristar_error_page_content = cs_get_option('error_page_content');
$barristar_error_page_bg = cs_get_option('error_page_bg');
$barristar_error_btn_text = cs_get_option('error_btn_text');
$barristar_error_heading = ( $barristar_error_heading ) ? $barristar_error_heading : esc_html__( '404', 'barristar' );
$barristar_error_subheading = ( $barristar_error_subheading ) ? $barristar_error_subheading : esc_html__( 'Oops! Page Not Found!', 'barristar' );
$barristar_error_page_content = ( $barristar_error_page_content ) ? $barristar_error_page_content : esc_html__( 'We’re sorry but we can’t seem to find the page you requested. This might be because you have typed the web address incorrectly.', 'barristar' );
$barristar_error_page_bg = ( $barristar_error_page_bg ) ? wp_get_attachment_url($barristar_error_page_bg) : BARRISTAR_IMAGES . '/404.png';
$barristar_error_btn_text = ( $barristar_error_btn_text ) ? $barristar_error_btn_text : esc_html__( 'BACK TO HOME', 'barristar' );
$image_alt = get_post_meta( $barristar_error_page_bg , '_wp_attachment_image_alt', true);
get_header(); ?>
<section class="error-404-section">
  <div class="container">
    <div class="row">
        <div class="col col-md-8 col-md-offset-2">
          <div class="content">
            <h2><?php echo esc_html( $barristar_error_heading ); ?></h2>
            <h3><?php echo wp_kses_post( $barristar_error_subheading ); ?></h3>
            <p><?php echo esc_html( $barristar_error_page_content ); ?></p>
            <a href="<?php echo esc_url(home_url( '/' )); ?>" class="theme-btn-s2">
              <?php echo esc_html( $barristar_error_btn_text ); ?>
            </a>
            </div>
          </div>
      </div> <!-- end row -->
  </div> <!-- end container -->
</div> <!-- end container -->
<?php
get_footer();