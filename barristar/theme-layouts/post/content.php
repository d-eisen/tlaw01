<?php
/**
 * Template part for displaying posts.
 */
$barristar_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$barristar_large_image = $barristar_large_image[0];
$barristar_alt = get_post_meta($barristar_large_image, '_wp_attachment_image_alt', true);
$barristar_read_more_text = cs_get_option('read_more_text');
$barristar_read_text = $barristar_read_more_text ? $barristar_read_more_text : esc_html__( 'Read More', 'barristar' );
$barristar_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$barristar_metas_hide = (array) cs_get_option( 'theme_metas_hide' );
  // Sticky
$post_class = get_post_class();
$find_sticky = array_search( 'sticky', $post_class );

if ( 'gallery' == get_post_format() && ! empty( $barristar_post_type['gallery_post_format'] ) ) {
  $post_format_class = ' slider-post';
} elseif ( 'video' == get_post_format() && ! empty( $barristar_post_type['video_post_format'] ) ) {
  $post_format_class = ' video-post';
}  elseif ( 'quote' == get_post_format() && ! empty( $barristar_post_type['quote_post_format'] ) ) {
  $post_format_class = ' quote-post';
} else {
  $post_format_class = ' ';
}
?>
 <div <?php post_class('post'.$post_format_class); ?>>
  <?php
    if ( $find_sticky ) {
        echo '<div class="sticky-badge"><h2>Featured</h2></div>';
    }
    if ( 'gallery' == get_post_format() && ! empty( $barristar_post_type['gallery_post_format'] ) ) { ?>
    <div class="entry-media post-slider"
        data-nav="true"
        data-autoplay="true"
        data-auto-height="true"
        data-dots="true">
    <?php
      $barristar_ids = explode( ',', $barristar_post_type['gallery_post_format'] );
      foreach ( $barristar_ids as $id ) {
        $barristar_attachment = wp_get_attachment_image_src( $id, 'full' );
        $barristar_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        echo '<img src="'. $barristar_attachment[0] .'" alt="'. esc_attr( $barristar_alt ) .'" />';
      }
    ?>
   </div>
  <?php } elseif ( 'video' == get_post_format() && ! empty( $barristar_post_type['video_post_format'] ) ) { ?>
    <div class="entry-media video-holder">
        <img src="<?php echo esc_url( $barristar_large_image ); ?>" alt="<?php echo esc_attr( $barristar_alt ); ?>">
        <a href="<?php echo esc_url( $barristar_post_type['video_post_format'] ); ?>?autoplay=1" class="video-btn" data-type="iframe">
            <i class="fi flaticon-round-play-button"></i>
        </a>
    </div>
   <?php } elseif ( $barristar_large_image ) { ?>
    <div class="entry-media">
        <img src="<?php echo esc_url( $barristar_large_image ); ?>" alt="<?php echo esc_attr( $barristar_alt ); ?>">
    </div>
    <?php } ?>
    <h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title(); ?></a></h3>
    <ul class="post-meta">
        <li><?php echo get_avatar( get_the_author_meta( 'ID' ), 125 ); ?></li>
        <li>
           <?php if ( !in_array( 'author', $barristar_metas_hide ) ) { // Author Hide
             printf( esc_html__(' By:','barristar') .' <a href="%1$s" rel="author">%2$s</a>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
              );
          } ?>
        </li>
        <?php
          $last_tag = get_the_tags();
          if ( !empty( $last_tag ) ) {
              $last_tag = end( $last_tag );
              echo '<li>'.esc_html( $last_tag->name ).'</li>';
          }
        ?>
        <li><i class="ti-calendar"></i>
          <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_date() );  ?></a></li>
        <li>
             <i class="ti-comment"></i><a class="barristar-comment" href="<?php echo esc_url( get_comments_link() ); ?>">
              <?php printf( esc_html( _nx( 'Comment (%1$s)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'barristar' ) ), number_format_i18n( get_comments_number() ),'<span>' . get_the_title() . '</span>' ); ?>
            </a>
          </li>
    </ul>
    <div class="entry-details">
        <p><?php
              $blog_excerpt = cs_get_option('theme_blog_excerpt');
              if ($blog_excerpt) {
                $blog_excerpt = $blog_excerpt;
              } else {
                $blog_excerpt = '25';
              }
              barristar_excerpt($blog_excerpt);
              echo barristar_wp_link_pages();
          ?></p>
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"><?php echo esc_attr($barristar_read_text); ?></a>
    </div>
</div>
