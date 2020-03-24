<?php
	// Metabox
	$barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
	$barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
	$barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
	$barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
	if ($barristar_meta && is_page()) {
		$barristar_title_bar_padding = $barristar_meta['title_area_spacings'];
	} else { $barristar_title_bar_padding = ''; }
	// Padding - Theme Options
	if ($barristar_title_bar_padding && $barristar_title_bar_padding !== 'padding-default') {
		$barristar_title_top_spacings = $barristar_meta['title_top_spacings'];
		$barristar_title_bottom_spacings = $barristar_meta['title_bottom_spacings'];
		if ($barristar_title_bar_padding === 'padding-custom') {
			$barristar_title_top_spacings = $barristar_title_top_spacings ? 'padding-top:'. barristar_check_px($barristar_title_top_spacings) .';' : '';
			$barristar_title_bottom_spacings = $barristar_title_bottom_spacings ? 'padding-bottom:'. barristar_check_px($barristar_title_bottom_spacings) .';' : '';
			$barristar_custom_padding = $barristar_title_top_spacings . $barristar_title_bottom_spacings;
		} else {
			$barristar_custom_padding = '';
		}
	} else {
		$barristar_title_bar_padding = cs_get_option('title_bar_padding');
		$barristar_titlebar_top_padding = cs_get_option('titlebar_top_padding');
		$barristar_titlebar_bottom_padding = cs_get_option('titlebar_bottom_padding');
		if ($barristar_title_bar_padding === 'padding-custom') {
			$barristar_titlebar_top_padding = $barristar_titlebar_top_padding ? 'padding-top:'. barristar_check_px($barristar_titlebar_top_padding) .';' : '';
			$barristar_titlebar_bottom_padding = $barristar_titlebar_bottom_padding ? 'padding-bottom:'. barristar_check_px($barristar_titlebar_bottom_padding) .';' : '';
			$barristar_custom_padding = $barristar_titlebar_top_padding . $barristar_titlebar_bottom_padding;
		} else {
			$barristar_custom_padding = '';
		}
	}
	// Banner Type - Meta Box
	if ($barristar_meta && is_page()) {
		$barristar_banner_type = $barristar_meta['banner_type'];
	} else { $barristar_banner_type = ''; }
	// Header Style
	if ($barristar_meta) {
	  $barristar_header_design  = $barristar_meta['select_header_design'];
	  $barristar_hide_breadcrumbs  = $barristar_meta['hide_breadcrumbs'];
	} else {
	  $barristar_header_design  = cs_get_option('select_header_design');
	  $barristar_hide_breadcrumbs = cs_get_option('need_breadcrumbs');
	}
	if ( $barristar_header_design === 'default') {
	  $barristar_header_design_actual  = cs_get_option('select_header_design');
	} else {
	  $barristar_header_design_actual = ( $barristar_header_design ) ? $barristar_header_design : cs_get_option('select_header_design');
	}
	if ( $barristar_header_design_actual == 'style_three') {
		$overly_class = ' overly';
	} else {
		$overly_class = ' ';
	}
	// Overlay Color - Theme Options
		if ($barristar_meta && is_page()) {
			$barristar_bg_overlay_color = $barristar_meta['titlebar_bg_overlay_color'];
			$title_color = isset( $barristar_meta['title_color'] );
		} else { $barristar_bg_overlay_color = ''; }
		if (!empty($barristar_bg_overlay_color)) {
			$barristar_bg_overlay_color = $barristar_bg_overlay_color;
			$title_color = $title_color;
		} else {
			$barristar_bg_overlay_color = cs_get_option('titlebar_bg_overlay_color');
			$title_color = cs_get_option('title_color');
		}
		$e_uniqid        = uniqid();
		$inline_style  = '';
		if ( $barristar_bg_overlay_color ) {
		 $inline_style .= '.crumbs-area-'.$e_uniqid .'.crumbs-area.overly:after  {';
		 $inline_style .= ( $barristar_bg_overlay_color ) ? 'background-color:'. $barristar_bg_overlay_color.';' : '';
		 $inline_style .= '}';
		}
		if ( $title_color ) {
		 $inline_style .= '.crumbs-area-'.$e_uniqid .'.crumbs-area.overly .banner-content h2, .crumbs-area-'.$e_uniqid .'.crumbs-area.overly .crumbs ul li span, .crumbs-area-'.$e_uniqid .'.crumbs-area.overly .crumbs ul li a {';
		 $inline_style .= ( $title_color ) ? 'color:'. $title_color.';' : '';
		 $inline_style .= '}';
		}
		// add inline style
		add_inline_style( $inline_style );
		$styled_class  = ' crumbs-area-'.$e_uniqid;
	// Background - Type
	if( $barristar_meta ) {
		$title_bar_bg = $barristar_meta['title_area_bg'];
	} else {
		$title_bar_bg = '';
	}
	$barristar_custom_header = get_custom_header();
	$header_text_color = get_theme_mod( 'header_textcolor' );
	$background_color = get_theme_mod( 'background_color' );
	if( isset( $title_bar_bg['image'] ) && ( $title_bar_bg['image'] ||  $title_bar_bg['color'] ) ) {
	  extract( $title_bar_bg );
	  $barristar_background_image       = ( ! empty( $image ) ) ? 'background-image: url(' . esc_url($image) . ');' : '';
	  $barristar_background_repeat      = ( ! empty( $image ) && ! empty( $repeat ) ) ? ' background-repeat: ' . esc_attr( $repeat) . ';' : '';
	  $barristar_background_position    = ( ! empty( $image ) && ! empty( $position ) ) ? ' background-position: ' . esc_attr($position) . ';' : '';
	  $barristar_background_size    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-size: ' . esc_attr($size) . ';' : '';
	  $barristar_background_attachment    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-attachment: ' . esc_attr( $attachment ) . ';' : '';
	  $barristar_background_color       = ( ! empty( $color ) ) ? ' background-color: ' . esc_attr( $color ) . ';' : '';
	  $barristar_background_style       = ( ! empty( $image ) ) ? $barristar_background_image . $barristar_background_repeat . $barristar_background_position . $barristar_background_size . $barristar_background_attachment : '';
	  $barristar_title_bg = ( ! empty( $barristar_background_style ) || ! empty( $barristar_background_color ) ) ? $barristar_background_style . $barristar_background_color : '';
	} elseif( $barristar_custom_header->url ) {
		$barristar_title_bg = 'background-image:  url('. esc_url( $barristar_custom_header->url ) .');';
	} else {
		$barristar_title_bg = '';
	}
	if($barristar_banner_type === 'hide-title-area') { // Hide Title Area
	} elseif($barristar_meta && $barristar_banner_type === 'revolution-slider') { // Hide Title Area
		echo do_shortcode($barristar_meta['page_revslider']);
	} else {
	?>
 <!-- start page-title -->
  <section class="page-title <?php echo esc_attr( $overly_class.$styled_class.' '.$barristar_banner_type ); ?>" style="<?php echo esc_attr( $barristar_title_bg ); ?>">
      <div class="container">
          <div class="row">
              <div class="col col-xs-12" style="<?php echo esc_attr( $barristar_custom_padding ); ?>" >
                  <div class="title">
                      <h2><?php echo barristar_title_area(); ?></h2>
                  </div>
                   <?php if ( !$barristar_hide_breadcrumbs && function_exists( 'breadcrumb_trail' )) { breadcrumb_trail();  } ?>
              </div>
          </div> <!-- end row -->
      </div> <!-- end container -->
  </section>
  <!-- end page-title -->
<?php } ?>