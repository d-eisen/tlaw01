<?php
/**
 * Single Project.
 */
$barristar_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$barristar_large_image = $barristar_large_image[0];
$image_alt = get_post_meta( $barristar_large_image, '_wp_attachment_image_alt', true);
$project_options = get_post_meta( get_the_ID(), 'project_options', true ); ?>
<div class="row">
  <div class="col-lg-12">
      <div class="practice-section-img">
          <?php if ( isset( $barristar_large_image ) ): ?>
              <img src="<?php echo esc_url( $barristar_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
          <?php endif ?>
      </div>
      <div class="practice-section-text">
          <h2><?php echo get_the_title(); ?></h2>
            <?php the_content();?>
      </div>
  </div>
</div>