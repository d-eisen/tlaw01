<?php
/*
 * All Front-End Helper Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Exclude category from blog */
if( ! function_exists( 'barristar_excludeCat' ) ) {
  function barristar_excludeCat($query) {
  	if ( $query->is_home ) {
  		$exclude_cat_ids = cs_get_option('theme_exclude_categories');
  		if($exclude_cat_ids) {
  			foreach( $exclude_cat_ids as $exclude_cat_id ) {
  				$exclude_from_blog[] = '-'. $exclude_cat_id;
  			}
  			$query->set('cat', implode(',', $exclude_from_blog));
  		}
  	}
  	return $query;
  }
  add_filter('pre_get_posts', 'barristar_excludeCat');
}

/* Excerpt Length */
class BarristarExcerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // Output: barristar_excerpt('short');
  public static $types = array(
    'short' => 25,
    'regular' => 55,
    'long' => 100
  );

  /**
   * Sets the length for the excerpt,
   * then it adds the WP filter
   * And automatically calls the_excerpt();
   *
   * @param string $new_length
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55) {
    BarristarExcerpt::$length = $new_length;
    add_filter('excerpt_length', 'BarristarExcerpt::new_length');
    BarristarExcerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(BarristarExcerpt::$types[BarristarExcerpt::$length]) )
      return BarristarExcerpt::$types[BarristarExcerpt::$length];
    else
      return BarristarExcerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// Custom Excerpt Length
if( ! function_exists( 'barristar_excerpt' ) ) {
  function barristar_excerpt($length = 55) {
    BarristarExcerpt::length($length);
  }
}

if ( ! function_exists( 'barristar_new_excerpt_more' ) ) {
  function barristar_new_excerpt_more( $more ) {
    return ' ';
  }
  add_filter('excerpt_more', 'barristar_new_excerpt_more');
}

/* Tag Cloud Widget - Remove Inline Font Size */
if( ! function_exists( 'barristar_tag_cloud' ) ) {
  function barristar_tag_cloud($tag_string){
    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
  }
  add_filter('wp_generate_tag_cloud', 'barristar_tag_cloud', 10, 3);
}

/* Password Form */
if( ! function_exists( 'barristar_password_form' ) ) {
  function barristar_password_form( $output ) {
    $output = str_replace( 'type="submit"', 'type="submit" class=""', $output );
    return $output;
  }
  add_filter('the_password_form' , 'barristar_password_form');
}

/* Maintenance Mode */
if( ! function_exists( 'barristar_maintenance_mode' ) ) {
  function barristar_maintenance_mode(){

    $maintenance_mode_page = cs_get_option( 'maintenance_mode_page' );

    if ( ! empty( $maintenance_mode_page ) && ! is_user_logged_in() ) {
      get_template_part('theme-layouts/post/content', 'maintenance');
      exit;
    }

  }
  add_action( 'wp', 'barristar_maintenance_mode', 1 );
}

/* Widget Layouts */
if ( ! function_exists( 'barristar_footer_widgets' ) ) {
  function barristar_footer_widgets() {

    $output = '';
    $footer_widget_layout = cs_get_option('footer_widget_layout');

    if( $footer_widget_layout ) {

      switch ( $footer_widget_layout ) {
        case 1: $widget = array('piece' => 1, 'class' => 'col-lg-12'); break;
        case 2: $widget = array('piece' => 2, 'class' => 'col-lg-6'); break;
        case 3: $widget = array('piece' => 3, 'class' => 'col-lg-4'); break;
        case 4: $widget = array('piece' => 4, 'class' => 'col-lg-3 col-md-3 col-sm-6'); break;
        case 5: $widget = array('piece' => 3, 'class' => 'col-lg-3', 'layout' => 'col-lg-6', 'queue' => 1); break;
        case 6: $widget = array('piece' => 3, 'class' => 'col-lg-3', 'layout' => 'col-lg-6', 'queue' => 2); break;
        case 7: $widget = array('piece' => 3, 'class' => 'col-lg-3', 'layout' => 'col-lg-6', 'queue' => 3); break;
        case 8: $widget = array('piece' => 4, 'class' => 'col-lg-2', 'layout' => 'col-lg-6', 'queue' => 1); break;
        case 9: $widget = array('piece' => 4, 'class' => 'col-lg-2', 'layout' => 'col-lg-6', 'queue' => 4); break;
        default : $widget = array('piece' => 4, 'class' => 'col-lg-3'); break;
      }

      for( $i = 1; $i < $widget["piece"]+1; $i++ ) {

        $widget_class = ( isset( $widget["queue"] ) && $widget["queue"] == $i ) ? $widget["layout"] : $widget["class"];

        if (is_active_sidebar('footer-'. $i)) {
          $output .= '<div class="'. $widget_class .'">';
          ob_start();
            dynamic_sidebar( 'footer-'. $i );
          $output .= ob_get_clean();
          $output .= '</div>';
        }

      }
    }

    return $output;

  }
}


/* WP Link Pages */
if ( ! function_exists( 'barristar_wp_link_pages' ) ) {
  function barristar_wp_link_pages() {
    $defaults = array(
      'before'           => '<div class="wp-link-pages">' . esc_html__( 'Pages:', 'barristar' ),
      'after'            => '</div>',
      'link_before'      => '<span>',
      'link_after'       => '</span>',
      'next_or_number'   => 'number',
      'separator'        => ' ',
      'pagelink'         => '%',
      'echo'             => 1
    );
    wp_link_pages( $defaults );
  }
}

/* Metas */
if ( ! function_exists( 'barristar_post_metas' ) ) {
  function barristar_post_metas() {
  $metas_hide = (array) cs_get_option( 'theme_metas_hide' );
  ?>
  <div class="bp-top-meta">
    <?php
    if ( !in_array( 'category', $metas_hide ) ) { // Category Hide
      if ( get_post_type() === 'post') {
        $category_list = get_the_category_list( ' ' );
        if ( $category_list ) {
          echo '<div class="bp-cat">'. $category_list .' </div>';
        }
      }
    } // Category Hides
    if ( !in_array( 'date', $metas_hide ) ) { // Date Hide
    ?>
    <div class="bp-date">
      <span><?php echo get_the_date('M d, Y'); ?></span>
    </div>
    <?php } // Date Hides
    if ( !in_array( 'author', $metas_hide ) ) { // Author Hide
    ?>
    <div class="bp-author">
      <?php
      printf(
        '<span>'. esc_html__('by','barristar') .' <a href="%1$s" rel="author">%2$s</a></span>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        get_the_author()
      );
      ?>
    </div>
    <?php } ?>
  </div>
  <?php
  }
}

/* Author Info */
if ( ! function_exists( 'barristar_author_info' ) ) {
  function barristar_author_info() {

    if (get_the_author_meta( 'url' )) {
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_the_author_meta( 'url' );
      $target = 'target="_blank"';
    } else {
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $target = '';
    }

    // variables
    $author_text = cs_get_option('author_text');
    $author_text = $author_text ? $author_text : esc_html__( 'Author', 'barristar' );
    $author_content = get_the_author_meta( 'description' );
    $facebook = get_the_author_meta( 'facebook' );
    $twitter = get_the_author_meta( 'twitter' );
    $instagram = get_the_author_meta( 'instagram' );
    $pinterest = get_the_author_meta( 'pinterest' );
if ($author_content) {
?>
<div class="author-box">
    <div class="author-avatar">
        <a href="<?php the_permalink(); ?>" target="_blank"><?php echo get_avatar( get_the_author_meta( 'ID' ), 125 ); ?></a>
    </div>
    <div class="author-content">
         <a href="<?php echo esc_url($author_url); ?>" class="author-name"><?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name'); ?></a>
        <p><?php echo get_the_author_meta( 'description' ); ?></p>
        <?php if( $facebook || $twitter || $instagram || $pinterest ) { ?>
        <div class="socials">
            <ul class="social-lnk">
                <li>
                  <?php if($twitter) { ?>
                  <a href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a>
                  <?php } ?>
               </li>
                <li>
                  <?php if($facebook) { ?>
                    <a href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a>
                  <?php } ?>
                </li>
                <li>
                  <?php if($instagram) { ?>
                    <a href="<?php echo esc_attr( $instagram ); ?>"><i class="fa fa-instagram"></i></a>
                  <?php } ?>
                </li>
                <li>
                 <?php if($pinterest) { ?>
                  <a href="<?php echo esc_url( $pinterest ); ?>"><i class="fa fa-pinterest-p"></i></a>
                 <?php } ?>
                </li>
            </ul>
        </div>
      <?php } ?>
    </div>
</div>

<?php
} // if $author_content
  }
}

/* ==============================================
   Custom Comment Area Modification
=============================================== */
if ( ! function_exists( 'barristar_comment_modification' ) ) {
  function barristar_comment_modification($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    $comment_class = empty( $args['has_children'] ) ? '' : 'parent';
  ?>

  <<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
   <article>
    <div id="div-comment-<?php comment_ID() ?>" class="barristar-comment">
    <?php endif; ?>
    <div class="comment-theme">
        <div class="comment-image">
          <?php if ( $args['avatar_size'] != 0 ) {
            echo get_avatar( $comment, 80 );
          } ?>
        </div>
    </div>
    <div class="comment-main-area">
      <div class="comments-meta">
        <h4><?php printf( '%s', get_comment_author() ); ?></h4>
         <span class="comments-date"><?php echo 'says '. get_comment_date(' F d, Y'); echo ' at '. get_comment_time(); ?></span>
      </div>
      <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'barristar' ); ?></em>
      <?php endif; ?>
      <div class="comment-content">
        <?php comment_text(); ?>
        <div class="comments-reply">
          <?php
            comment_reply_link( array_merge( $args, array(
            'reply_text' => '<span class="comment-reply-link icofont icofont-reply-all">'.esc_html__( 'Reply', 'barristar' ).'</span>',
            'before' => '',
            'class'  => '',
            'depth' => $depth,
            'max_depth' => $args['max_depth']
            ) ) );
          ?>
        </div>
      </div>
    </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  </article>
  <?php endif;
  }
}

/* Comments Form - Textarea next to Normal Fields */
if( ! function_exists( 'barristar_move_comment_field' ) ) {
  add_filter( 'comment_form_fields', 'barristar_move_comment_field' );
  function barristar_move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
  }
}


/* Title Area */
if ( ! function_exists( 'barristar_title_area' ) ) {
  function barristar_title_area() {

    $single_attorney_title = cs_get_option('single_attorney_title');
    $single_attorney_title = ( $single_attorney_title ) ? $single_attorney_title : esc_html__( 'Attorney', 'barristar' );

    $single_project_title = cs_get_option('single_project_title');
    $single_project_title = ( $single_project_title ) ? $single_project_title : esc_html__( 'Project', 'barristar' );

    $single_service_title = cs_get_option('single_service_title');
    $single_service_title = ( $single_service_title ) ? $single_service_title : esc_html__( 'Service', 'barristar' );

    global $post, $wp_query;
    // Get post meta in all type of WP pages
    $barristar_id    = ( isset( $post ) ) ? $post->ID : 0;
    $barristar_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $barristar_id;
    $barristar_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $barristar_id;
    $barristar_meta  = get_post_meta( $barristar_id, 'page_type_metabox', true );
    if ($barristar_meta && (!is_archive() || is_woocommerce_shop())) {
      $custom_title = $barristar_meta['page_custom_title'];
      if ($custom_title) {
        $custom_title = $custom_title;
      } elseif(post_type_archive_title()) {
        post_type_archive_title();
      } else {
        $custom_title = '';
      }
    } else { $custom_title = ''; }

    if ( is_home() && is_front_page() ) {
      echo esc_html__( 'Blog', 'barristar' );
    } elseif ( is_home() && !is_front_page() ) {
      single_post_title();
    } elseif ( is_search() ) {
      printf( esc_html__( 'Search Results for %s', 'barristar' ), '<span>' . get_search_query() . '</span>' );
    } elseif ( is_category() || is_tax() ){
      single_cat_title();
    } elseif ( is_tag() ){
      single_tag_title( esc_html__('Posts Tagged: ', 'barristar') );
    } elseif ( is_archive() ){
      if ( is_day() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'barristar' ), array( 'span' => array() ) ), get_the_date());
      } elseif ( is_month() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'barristar' ), array( 'span' => array() )), get_the_date( 'F, Y' ));
      } elseif ( is_year() ) {
        printf( wp_kses( __( 'Archive for <span>%s</span>', 'barristar' ), array( 'span' => array() ) ), get_the_date( 'Y' ));
      } elseif ( is_author() ) {
        printf( wp_kses( __( 'Posts by: <span>%s</span>', 'barristar' ), array( 'span' => array() ) ), get_the_author_meta( 'display_name', $wp_query->post->post_author ));
      } elseif( is_woocommerce_shop() ) {
        esc_html_e( 'Shop', 'barristar' );
      } elseif( is_product() ) {
        esc_html_e( 'Shop Single', 'barristar' );
      } elseif ( is_post_type_archive() ) {
        post_type_archive_title();
      } else {
        esc_html_e( 'Archives', 'barristar' );
      }
    } elseif( ( class_exists( 'WooCommerce' ) ) && ( is_product() ) ) {
       the_title();
    } elseif( is_singular( 'project' ) ) {
      echo esc_html( $single_project_title );
    } elseif( is_singular( 'service' ) ) {
      echo esc_html( $single_service_title );
    } elseif( is_singular( 'attorney' ) ) {
       echo esc_html( $single_attorney_title );
    } elseif( is_404() ) {
      esc_html_e('404 Error', 'barristar');
    } elseif( $custom_title ) {
      echo esc_html($custom_title);
    } else {
      if (is_single()) {
        the_title();
      } else {
        the_title();
      }
    }
  }
}

/**
 * Pagination Function
 */
if ( ! function_exists( 'barristar_paging_nav' ) ) {
  function barristar_paging_nav() {
    if ( function_exists('wp_pagenavi')) {
      wp_pagenavi();
    } else {
      $older_post = cs_get_option('older_post');
      $newer_post = cs_get_option('newer_post');
      $older_post = $older_post ? $older_post : wp_kses_post( '<i class="ti-arrow-left"></i>', 'barristar' );
      $newer_post = $newer_post ? $newer_post : wp_kses_post( '  <i class="ti-arrow-right"></i>', 'barristar' );
      global $wp_query;
      $big = 999999999;
      if($wp_query->max_num_pages == '1' ) {} else {echo '';}
      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format' => '?paged=%#%',
        'prev_text' => $older_post,
        'next_text' => $newer_post,
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type' => 'list'
      ));
      if($wp_query->max_num_pages == '1' ) {} else {echo '';}
    }
  }
}

// blog pagination
if ( !function_exists('barristar_paginate_links') ) {
  function barristar_paginate_links( $echo = true ) {
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'type'  => 'array',
      'prev_next'   => true,
      'prev_text'    => wp_kses_post( __( '<i class="fa fa-angle-left" aria-hidden="true"></i>', 'barristar' ) ),
      'next_text'    => wp_kses_post( __( '<i class="fa fa-angle-right" aria-hidden="true"></i>', 'barristar' ) ),
      )
    );
    if( is_array( $pages ) ) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
      $pagination = '<div class="row"><nav class="col-lg-12 irs-pagination text-center"><ul class="pagination">';
      foreach ( $pages as $page ) {
        $pagination .= "<li>$page</li>";
      }
      $pagination .= '</ul></nav></div>';
      if ( $echo ) {
        echo wp_kses_post( $pagination );
      } else {
        return $pagination;
      }
    }
  }
}
// Pingback Head
function barristar_pingback_header() {
  if ( is_singular() && pings_open() ) {
    printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
  }
}
add_action( 'wp_head', 'barristar_pingback_header' );


/**
 * SINGLE PAGINATION
 */
if(!function_exists('barristar_single_pagination')) {
  function barristar_single_pagination() {
    $next_post = get_next_post( '', false);
    $prev_post = get_previous_post( '', false);
    $newer_post = cs_get_option('newer_post');
    $newer_post = ( $newer_post ) ? $newer_post : esc_html__('Next Article', 'barristar');
    $older_post = cs_get_option('older_post');
    $older_post = ( $older_post ) ? $older_post : esc_html__('Previous Article', 'barristar');
    if (empty($next_post) || empty($prev_post)) {
      $style = 'border: none; width:100%;';
      $class = 'single';
    } else {
      $style = '';
      $class = '';
    }
    if ( !empty( $prev_post ) || !empty( $next_post ) ) { ?>
      <div class="more-posts clearfix">
        <?php if (!empty( $prev_post )): ?>
          <div class="previous-post <?php echo esc_attr($class); ?>" style="<?php echo esc_attr( $style ); ?>">
            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
              <span class="post-control-link"><?php echo esc_html($older_post); ?>: </span>
              <span class="post-name"><?php echo esc_html($prev_post->post_title); ?></span>
            </a>
          </div>
          <?php endif; ?>
          <?php  if (!empty( $next_post )): ?>
          <div class="next-post <?php echo esc_attr($class); ?>" style="<?php echo esc_attr( $style ); ?>">
            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
              <span class="post-control-link"><?php echo esc_html($newer_post); ?></span>
              <span class="post-name"><?php echo esc_html($next_post->post_title); ?></span>
            </a>
          </div>
        <?php endif; ?>
      </div>
    <?php
    }
  }
}
