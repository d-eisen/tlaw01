<?php
	// Main Text
	$barristar_need_copyright = cs_get_option('hide_copyright');
?>
<div class="lower-footer">
  <div class="container">
    <div class="row">
      <div class="separator"></div>
      <div class="col col-xs-12">
          <?php
			  $barristar_copyright_text = cs_get_option( 'copyright_text' );
			  if ( $barristar_copyright_text ) {
				  echo '<p class="copyright" >'. wp_kses_post( do_shortcode( $barristar_copyright_text ) ) .'</p>';
			  } else {
				  echo '<p>&copy; Copyright '.current_time( 'Y' ).' | <a href="'.esc_url( get_home_url( '/' ) ).'">'.get_bloginfo( 'name' ).'</a> | All right reserved.<p>';
			  }
			  $barristar_secondary_text = cs_get_option( 'secondary_text' );
			  echo wp_kses_post( do_shortcode( $barristar_secondary_text ) );
		  ?>
      </div>
    </div>
  </div>
</div>