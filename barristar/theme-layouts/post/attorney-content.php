<?php
/**
 * Single Post.
 */
$barristar_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$barristar_large_image = $barristar_large_image[0];
$barristar_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$attorney_options = get_post_meta( get_the_ID(), 'attorney_options', true );
$attorney_infos = isset($attorney_options['attorney_infos']) ? $attorney_options['attorney_infos'] : '';
$subtitle = isset($attorney_options['subtitle']) ? $attorney_options['subtitle'] : '';
$info_title = isset($attorney_options['info_title']) ? $attorney_options['info_title'] : '';
$attorney_socials = isset($attorney_options['attorney_socials']) ? $attorney_options['attorney_socials'] : '';
$attorney_image = isset($attorney_options['attorney_image']) ? $attorney_options['attorney_image'] : '';
$image_url = wp_get_attachment_url( $attorney_image );
$image_alt = get_post_meta( $attorney_image, '_wp_attachment_image_alt', true);
 ?>
 <div class="attorneys-area">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-l">
            <div class="attorneys-item">
                <div class="attorneys-img">
                    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?> ">
                </div>
                <div class="attorneys-text">
                    <h2><?php echo get_the_title(); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-2">
            <div class="attorneys-info">
                <div class="attorneys-content">
                    <h3><?php echo esc_html( $info_title ); ?></h3>
                </div>
                <div class="info-outer">
                    <ul class="info">
                        <?php if ( $attorney_infos ) {
                         foreach ( $attorney_infos as $key => $attorney_info ) { ?>
                          <li>
                            <span><?php echo esc_html( $attorney_info['attorney_title']); ?></span>
                            <?php echo esc_html( $attorney_info['attorney_desc']); ?>
                          </li>
                        <?php } } ?>
                    </ul>
                    <ul class="social">
                    <?php if ( $attorney_socials ) {
                       foreach ( $attorney_socials as $key => $attorney_social ) {
                        echo'<li><a href="'.esc_url( $attorney_social['link'] ).'"><i class="'.esc_attr( $attorney_social['icon']  ).'" aria-hidden="true"></i></a></li>';
                    } } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <div class="attorneys-content-wrap">
                    <?php the_content();?>
                </div>
            </div>
        </div>
    </div>
</div>