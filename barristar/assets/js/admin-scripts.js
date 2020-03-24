/*
 * All Admin Related Scripts in this Medikare Theme
 * Author & Copyright:wpocean
 * URL: http://themeforest.net/user/wpocean
 */

(function($) {
"use strict";
  /*---------------------------------------------------------------*/
  /* =  Toggle Meta boxes based on post formats
  /*---------------------------------------------------------------*/
   function barristar_gutenberg_toggle_metaboxes() {

        $(document).on('change','.editor-post-format__content select',function(){

        $('.cs-element-standard-image, .cs-element-gallery-format, .cs-element-add-gallery, .video_post_format, .quote_post_format').hide();

          var format = $(this).children("option:selected").val();
          console.log( format );

          if (format == '0' || format == 'image') {
              $('').slideUp('fast');
              $('.cs-element-standard-image').slideDown('slow');
          }
          if (format == 'gallery') {
              $('').slideUp('fast');
              $('.cs-element-gallery-format, .cs-element-add-gallery').slideDown('slow');
          }
          if (format == 'video') {
              $('').slideUp('fast');
              $('#post_type_metabox .video_post_format').slideDown('slow');
          }
          if (format == 'quote') {
              $('').slideUp('fast');
              $('#post_type_metabox .quote_post_format').slideDown('slow');
          }
        });
  }
  function barristar_toggle_metaboxes() {

    var format = $("input[name='post_format']:checked").val();

    $('.cs-element-standard-image, .cs-element-gallery-format, .cs-element-add-gallery, .video_post_format, .quote_post_format').hide();

    if (format == '0' || format == 'image') {
        $('').slideUp('fast');
        $('.cs-element-standard-image').slideDown('slow');
    }
    if (format == 'gallery') {
        $('').slideUp('fast');
        $('.cs-element-gallery-format, .cs-element-add-gallery').slideDown('slow');
    }
    if (format == 'video') {
        $('').slideUp('fast');
        $('#post_type_metabox .video_post_format').slideDown('slow');
    }
    if (format == 'quote') {
        $('').slideUp('fast');
        $('#post_type_metabox .quote_post_format').slideDown('slow');
    }

  }

  $(document).ready(function() {
      barristar_gutenberg_toggle_metaboxes();
      barristar_toggle_metaboxes();
    $('#post-formats-select input[type="radio"]').on('click', barristar_toggle_metaboxes);
  });

})(jQuery);