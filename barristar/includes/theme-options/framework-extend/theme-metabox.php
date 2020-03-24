<?php
/*
 * All Metabox related options for Barristar theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function barristar_metabox_options( $options ) {

 $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $contact_forms = array();
    if ( $cf7 ) {
      foreach ( $cf7 as $cform ) {
        $contact_forms[ $cform->ID ] = $cform->post_title;
      }
    } else {
      $contact_forms[ esc_html__( 'No contact forms found', 'barristar' ) ] = 0;
    }
  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'barristar'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title' => 'Standard Image',
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'barristar'),
            'wrap_class' => 'barristar-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => 'Gallery Format',
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Gallery Format', 'barristar')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'barristar'),
            'add_title'   => esc_html__('Add Image(s)', 'barristar'),
            'edit_title'  => esc_html__('Edit Image(s)', 'barristar'),
            'clear_title' => esc_html__('Clear Image(s)', 'barristar'),
          ),
          array(
            'type'    => 'text',
            'title'   => esc_html__('Add Video URL', 'barristar' ),
            'id'   => 'video_post_format',
            'desc' => esc_html__('Add youtube or vimeo video link', 'barristar' ),
            'wrap_class' => 'video_post_format',
          ),
          // Gallery

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'barristar'),
    'post_type' => array('post', 'page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'page_topbar_section',
        'title' => esc_html__('Top Bar', 'barristar'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'topbar_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Topbar', 'barristar'),
            'options'      => array(
              'default'     => BARRISTAR_CS_IMAGES .'/topbar-default.png',
              'custom'      => BARRISTAR_CS_IMAGES .'/topbar-custom.png',
              'hide_topbar' => BARRISTAR_CS_IMAGES .'/topbar-hide.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'hide_topbar_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'top_left',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Left', 'barristar'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'          => 'top_right',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Right', 'barristar'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'    => 'topbar_bg',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Background Color', 'barristar'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),
          array(
            'id'    => 'topbar_border',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Border Color', 'barristar'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),

        ), // End : Fields

      ), // Title Section

      // Header
      array(
        'name'  => 'header_section',
        'title' => esc_html__('Header', 'barristar'),
        'icon'  => 'fa fa-bars',
        'fields' => array(

          array(
            'id'           => 'select_header_design',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Header Design', 'barristar'),
            'options'      => array(
              'default'     => BARRISTAR_CS_IMAGES .'/hs-0.png',
              'style_one'   => BARRISTAR_CS_IMAGES .'/hs-1.png',
              'style_two'   => BARRISTAR_CS_IMAGES .'/hs-2.png',
              'style_three'   => BARRISTAR_CS_IMAGES .'/hs-2.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'barristar'),
          ),

          array(
            'id'    => 'transparency_header',
            'type'  => 'switcher',
            'title' => esc_html__('Transparent Header', 'barristar'),
            'info' => esc_html__('Use Transparent Method', 'barristar'),
          ),
          array(
            'id'    => 'transparent_menu_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Menu Color', 'barristar'),
            'info' => esc_html__('Pick your menu color. This color will only apply for non-sticky header mode.', 'barristar'),
            'dependency'   => array('transparency_header', '==', 'true'),
          ),
          array(
            'id'    => 'transparent_menu_hover_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Menu Hover Color', 'barristar'),
            'info' => esc_html__('Pick your menu hover color. This color will only apply for non-sticky header mode.', 'barristar'),
            'dependency'   => array('transparency_header', '==', 'true'),
          ),
          array(
            'id'             => 'choose_menu',
            'type'           => 'select',
            'title'          => esc_html__('Choose Menu', 'barristar'),
            'desc'          => esc_html__('Choose custom menus for this page.', 'barristar'),
            'options'        => 'menus',
            'default_option' => esc_html__('Select your menu', 'barristar'),
          ),
          
        ),
      ),
      // Header

      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'barristar'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'barristar'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'revolution-slider' => 'Shortcode [Rev Slider]',
              'hide-title-area'   => 'Hide Title/Banner Area',
            ),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'barristar'),
            'desc' => __('Enter any shortcodes that you want to show in this page title area. <br />Eg : Revolution Slider shortcode.', 'barristar'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'barristar'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'barristar'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'barristar'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'        => 'title_area_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Title Area Spacings', 'barristar'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'barristar'),
              'padding-custom' => esc_html__('Custom Padding', 'barristar'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'barristar'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'barristar'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_area_bg',
            'type'  => 'background',
            'title' => esc_html__('Background', 'barristar'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'titlebar_bg_overlay_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Overlay Color', 'barristar'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'barristar'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'barristar'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'barristar'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'barristar'),
              'padding-custom' => esc_html__('Custom Padding', 'barristar'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'barristar'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'barristar'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'barristar'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),

        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'barristar'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_header',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Header', 'barristar'),
            'label' => esc_html__('Yes, Please do it.', 'barristar'),
          ),
          array(
            'id'    => 'hide_breadcrumbs',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Breadcrumbs', 'barristar'),
            'label' => esc_html__('Yes, Please do it.', 'barristar'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'barristar'),
            'label' => esc_html__('Yes, Please do it.', 'barristar'),
          ),

        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'barristar'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => BARRISTAR_CS_IMAGES . '/page-1.png',
              'extra-width'   => BARRISTAR_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => BARRISTAR_CS_IMAGES . '/page-3.png',
              'right-sidebar' => BARRISTAR_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'barristar'),
            'options'        => barristar_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'barristar'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );


  // -----------------------------------------
  // Testimonial
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'testimonial_options',
    'title'     => esc_html__('Testimonial Client', 'barristar'),
    'post_type' => 'testimonial',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'testimonial_option_section',
        'fields' => array(

          array(
            'id'      => 'testi_name',
            'type'    => 'text',
            'title'   => esc_html__('Name', 'barristar'),
            'info'    => esc_html__('Enter client name', 'barristar'),
          ),
          array(
            'id'      => 'testi_name_link',
            'type'    => 'text',
            'title'   => esc_html__('Name Link', 'barristar'),
            'info'    => esc_html__('Enter client name link, if you want', 'barristar'),
          ),
          array(
            'id'      => 'testi_pro',
            'type'    => 'text',
            'title'   => esc_html__('Profession', 'barristar'),
            'info'    => esc_html__('Enter client profession', 'barristar'),
          ),
          array(
            'id'      => 'testi_pro_link',
            'type'    => 'text',
            'title'   => esc_html__('Profession Link', 'barristar'),
            'info'    => esc_html__('Enter client profession link', 'barristar'),
          ),

        ),
      ),

    ),
  );

 // -----------------------------------------
  // Service
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'service_options',
    'title'     => esc_html__('Service Extra Options', 'barristar'),
    'post_type' => 'service',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'service_option_section',
        'fields' => array(
         array(
            'id'    => 'service_title',
            'type'  => 'text',
            'title' => esc_html__('Service Title', 'barristar'),
            'info'    => esc_html__('Enter Service Title for Service Item.', 'barristar'),
          ),
         array(
            'id'    => 'service_icon',
            'type'  => 'icon',
            'title' => esc_html__('Service Icon', 'barristar'),
            'info'    => esc_html__('Enter Service Icon for Service Item.', 'barristar'),
          ),
        ),
      ),

    ),
  );

// -----------------------------------------
  // Attorney
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'attorney_options',
    'title'     => esc_html__('Attorney Meta', 'barristar'),
    'post_type' => 'attorney',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'attorney_option_section',
        'fields' => array(
          array(
            'title'   => esc_html__('Attorney Title', 'barristar'),
            'id'      => 'title',
            'type'    => 'text',
          ),
          array(
            'title'   => esc_html__('Attorney Sub Title', 'barristar'),
            'id'      => 'subtitle',
            'type'    => 'text',
          ),
          array(
            'title'   => esc_html__('Attorney Infomation Title', 'barristar'),
            'id'      => 'info_title',
            'type'    => 'text',
          ),
          // Start fields
          array(
            'id'                  => 'attorney_infos',
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'attorney_title',
                'type'            => 'text',
                'title'           => esc_html__('Info Title', 'barristar'),
              ),
              array(
                'id'              => 'attorney_desc',
                'type'            => 'text',
                'title'           => esc_html__('Info Description', 'barristar'),
              ),
            ),
            'button_title'        => esc_html__('Add Attorney info', 'barristar'),
            'accordion_title'     => esc_html__('attorney Info', 'barristar'),
          ),
          // Start fields
          array(
            'id'                  => 'attorney_socials',
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'icon',
                'type'            => 'icon',
                'title'           => esc_html__('Social Icon', 'barristar'),
              ),
              array(
                'id'              => 'link',
                'type'            => 'text',
                'title'           => esc_html__('URL', 'barristar'),
              ),
            ),
            'button_title'        => esc_html__('Add Social Icon', 'barristar'),
            'accordion_title'     => esc_html__('Social Icons', 'barristar'),
          ),
          array(
            'id'           => 'attorney_image',
            'type'         => 'image',
            'title'        => esc_html__('Attorney Image', 'barristar'),
            'add_title' => esc_html__('Add Attorney Image', 'barristar'),
          ),
        ),
      ),
    ),
  );

  // -----------------------------------------
  // Project
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'project_options',
    'title'     => esc_html__('Project Extra Options', 'barristar'),
    'post_type' => 'project',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'project_option_section',
        'fields' => array(
          array(
            'id'           => 'project_title',
            'type'         => 'text',
            'title'        => esc_html__('Project title', 'barristar'),
            'add_title' => esc_html__('Add Project title', 'barristar'),
            'attributes' => array(
              'placeholder' => esc_html__('Project Title', 'barristar'),
            ),
            'info'    => esc_html__('Write Project Title.', 'barristar'),
          ),
          array(
            'id'      => 'project_subtitle',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Project : Sub Title', 'barristar'),
            ),
            'info'    => esc_html__('Write Project Sub Title.', 'barristar'),
          ),
          array(
            'id'           => 'project_image',
            'type'         => 'image',
            'title'        => esc_html__('Project Grid Image', 'barristar'),
            'add_title' => esc_html__('Add Project Grid Image', 'barristar'),
          ),
        ),
      ),

    ),
  );

  // -----------------------------------------
  // post options
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_options',
    'title'     => esc_html__('Grid Image', 'barristar'),
    'post_type' => 'post',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'post_option_section',
        'fields' => array(
          array(
            'id'           => 'grid_image',
            'type'         => 'image',
            'title'        => esc_html__('Post Grid Image', 'barristar'),
            'add_title' => esc_html__('Add Post Grid Image', 'barristar'),
          ),
        ),
      ),

    ),
  );


  return $options;

}
add_filter( 'cs_metabox_options', 'barristar_metabox_options' );