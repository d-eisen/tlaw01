<?php
/**
 * Single Post.
 */
$barristar_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$barristar_large_image = $barristar_large_image[0];
$image_alt = get_post_meta( $barristar_large_image, '_wp_attachment_image_alt', true);
$barristar_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
// Single Theme Option
$barristar_post_pagination_option = cs_get_option('single_post_pagination');
$barristar_single_featured_image = cs_get_option('single_featured_image');
$barristar_single_author_info = cs_get_option('single_author_info');
$barristar_single_share_option = cs_get_option('single_share_option');
$barristar_metas_hide = (array) cs_get_option( 'theme_metas_hide' );
?>
  <div <?php post_class('post clearfix'); ?>>
    <?php if ( $barristar_large_image ) { ?>
      <div class="entry-media">
        <img src="<?php echo esc_url( $barristar_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
      </div>
    <?php } ?>
    <ul class="meta">
        <li><?php echo get_avatar( get_the_author_meta( 'ID' ), 125 ); ?></li>
        <li>
           <?php if ( !in_array( 'author', $barristar_metas_hide ) ) { // Author Hide
             printf( esc_html__(' By: ','barristar') .' <a href="%1$s" rel="author">%2$s</a>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
              );
          } ?>
        </li>
        <?php
          $last_tag = get_the_tags();
          if ( !empty( $last_tag ) ) {
              $last_tag = end( $last_tag );
              echo '<li><i class="ti-pencil-alt"></i>'.esc_html( $last_tag->name ).'</li>';
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
       <?php
        the_content();
        echo barristar_wp_link_pages();
       ?>
    </div>
</div>
<?php if( has_tag() || ( $barristar_single_share_option && function_exists('barristar_wp_share_option') ) ) { ?>
<div class="tag-share">
    <div class="tag">
        <i class="ti-folder"></i>
        <?php
          $tag_list = get_the_tags();
          if($tag_list) {
            echo the_tags( ' <ul><li>', '</li><li>', '</li></ul>' );
         } ?>
    </div>
      <?php
        if ( $barristar_single_share_option && function_exists('barristar_wp_share_option') ) {
              echo barristar_wp_share_option();
          }
       ?>
</div>
<?php
}
if( !$barristar_single_author_info ) {
  barristar_author_info();
  }
 if( !$barristar_post_pagination_option ){
    barristar_single_pagination();
} ?>

