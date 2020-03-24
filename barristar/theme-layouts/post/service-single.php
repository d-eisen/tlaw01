<?php
/**
 * Single Post.
 */
$barristar_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$barristar_large_image = $barristar_large_image[0];
$image_alt = get_post_meta( $barristar_large_image, '_wp_attachment_image_alt', true);
$barristar_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
 ?>

<div class="service-single-content">
  <div class="service-pic">
       <img src="<?php echo esc_url( $barristar_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?> ">
  </div>
  <h2><?php echo get_the_title(); ?></h2>
 	<?php the_content();?>
</div>