<?php
/*
 * All Theme Options for Barristar theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function barristar_settings( $settings ) {

  $settings           = array(
    'menu_title'      => BARRISTAR_NAME . esc_html__(' Options', 'barristar'),
    'menu_slug'       => sanitize_title(BARRISTAR_NAME) . '_options',
    'menu_type'       => 'theme',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => BARRISTAR_NAME .' <small>V-'. BARRISTAR_VERSION .' by <a href="'. BARRISTAR_BRAND_URL .'" target="_blank">'. BARRISTAR_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'barristar_settings' );

// Theme Framework Options
function barristar_options( $options ) {

  $options      = array(); // remove old options

  // ------------------------------
  // Branding
  // ------------------------------
  $options[]   = array(
    'name'     => 'barristar_theme_branding',
    'title'    => esc_html__('Brand', 'barristar'),
    'icon'     => 'fa fa-trophy',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo',
        'title'    => esc_html__('Logo', 'barristar'),
        'icon'     => 'fa fa-star',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Site Logo', 'barristar')
          ),
          array(
            'id'    => 'barristar_logo',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'barristar'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'barristar'),
            'add_title' => esc_html__('Add Logo', 'barristar'),
          ),
          array(
            'id'    => 'barristar_trlogo',
            'type'  => 'image',
            'title' => esc_html__('Transparent Logo', 'barristar'),
            'info'  => esc_html__('Upload your Transparent logo here. If you not upload, then site title will load in this logo location.', 'barristar'),
            'add_title' => esc_html__('Add Logo', 'barristar'),
          ),
          array(
            'id'          => 'barristar_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'barristar'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'barristar_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'barristar'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('WordPress Admin Logo', 'barristar')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'barristar'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'barristar'),
            'add_title' => esc_html__('Add Login Logo', 'barristar'),
          ),
        ) // end: fields
      ), // end: section
    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Layout', 'barristar'),
    'icon'   => 'fa fa-file-text'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General', 'barristar'),
    'icon'        => 'fa fa-wrench',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
       array(
        'id'    => 'theme_responsive',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'barristar'),
        'info' => esc_html__('Turn on if you don\'t want your site to be responsive.', 'barristar'),
        'default' => false,
      ),
      array(
        'id'    => 'theme_preloder',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Preloder', 'barristar'),
        'info' => esc_html__('Turn off if you don\'t want your site to be Preloder.', 'barristar'),
        'default' => true,
      ),
      array(
        'id'    => 'theme_layout_width',
        'type'  => 'image_select',
        'title' => esc_html__('Full Width & Extra Width', 'barristar'),
        'info' => esc_html__('Boxed or Fullwidth? Choose your site layout width. Default : Full Width', 'barristar'),
        'options'      => array(
          'container'    => BARRISTAR_CS_IMAGES .'/boxed-width.jpg',
          'container-fluid'    => BARRISTAR_CS_IMAGES .'/full-width.jpg',
        ),
        'default'      => 'container-fluid',
        'radio'      => true,
      ),
       array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Hide Page Comments?', 'barristar'),
        'label' => esc_html__('Yes! Hide Page Comments.', 'barristar'),
        'on_text' => esc_html__('Yes', 'barristar'),
        'off_text' => esc_html__('No', 'barristar'),
        'default' => false,
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('Background Options', 'barristar'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'barristar'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'barristar'),
          'bg-pattern' => esc_html__('Pattern', 'barristar'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'barristar'),
        'info' => esc_html__('Select background pattern', 'barristar'),
        'options'      => array(
          'pattern-1'    => BARRISTAR_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => BARRISTAR_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => BARRISTAR_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => BARRISTAR_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => BARRISTAR_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'barristar'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'barristar'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'barristar'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header', 'barristar'),
    'icon'     => 'fa fa-bars',
    'sections' => array(

      // header design tab
      array(
        'name'     => 'header_design_tab',
        'title'    => esc_html__('Design', 'barristar'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Header Select
          array(
            'id'           => 'select_header_design',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Header Design', 'barristar'),
            'options'      => array(
              'style_one'    => BARRISTAR_CS_IMAGES .'/hs-1.png',
              'style_two'    => BARRISTAR_CS_IMAGES .'/hs-2.png',
              'style_three'    => BARRISTAR_CS_IMAGES .'/hs-2.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'        => true,
            'default'   => 'style_one',
            'info' => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'barristar'),
          ),
          // Header Select

          // Extra's
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Extra\'s', 'barristar'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'barristar'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'barristar'),
            'default' => true,
          ),
          array(
            'id'    => 'header_menu_btn',
            'type'  => 'switcher',
            'title' => esc_html__('Header Button', 'barristar'),
            'info' => esc_html__('Turn On if you want to Show Navigation Bar Button .', 'barristar'),
            'default' => false,
          ),
          array(
            'id'    => 'menu_btn_text',
            'type'  => 'text',
            'attributes'  => array( 'placeholder' => 'Free Consultation' ),
            'title' => esc_html__('Header Button Text', 'barristar'),
            'info' => esc_html__('Write Header Button Text Here.', 'barristar'),
            'dependency' => array( 'header_menu_btn', '==', true ),
          ),
          array(
            'id'    => 'menu_btn_link',
            'type'  => 'text',
            'attributes'  => array( 'placeholder' => 'Type Link' ),
            'title' => esc_html__('Header Button Link', 'barristar'),
            'info' => esc_html__('Write Header Button Link Here.', 'barristar'),
            'dependency' => array( 'header_menu_btn', '==', true ),
          ),
           array(
            'id'    => 'barristar_cart_widget',
            'type'  => 'switcher',
            'title' => esc_html__('Header Cart', 'barristar'),
            'info' => esc_html__('Turn On if you want to Show Header Cart .', 'barristar'),
            'default' => false,
          ),
           array(
            'id'    => 'barristar_search',
            'type'  => 'switcher',
            'title' => esc_html__('Header Search', 'barristar'),
            'info' => esc_html__('Turn On if you want to hide Header Search .', 'barristar'),
            'default' => false,
          ),
        )
      ),

      // header top bar
      array(
        'name'     => 'header_top_bar_tab',
        'title'    => esc_html__('Top Bar', 'barristar'),
        'icon'     => 'fa fa-minus',
        'fields'   => array(

          array(
            'id'          => 'top_bar',
            'type'        => 'switcher',
            'title'       => esc_html__('Hide Top Bar', 'barristar'),
            'on_text'     => esc_html__('Yes', 'barristar'),
            'off_text'    => esc_html__('No', 'barristar'),
            'default'     => false,
          ),
          array(
            'id'          => 'top_left',
            'title'       => esc_html__('Top left Block', 'barristar'),
            'desc'        => esc_html__('Top bar left block.', 'barristar'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
          array(
            'id'          => 'top_right',
            'title'       => esc_html__('Top Right Block', 'barristar'),
            'desc'        => esc_html__('Top bar right block.', 'barristar'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
        )
      ),

      // header banner
      array(
        'name'     => 'header_banner_tab',
        'title'    => esc_html__('Title Bar (or) Banner', 'barristar'),
        'icon'     => 'fa fa-bullhorn',
        'fields'   => array(

          // Title Area
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Title Area', 'barristar')
          ),
          array(
            'id'      => 'need_title_bar',
            'type'    => 'switcher',
            'title'   => esc_html__('Title Bar ?', 'barristar'),
            'label'   => esc_html__('If you want to Hide title bar in your sub-pages, please turn this ON.', 'barristar'),
            'default'    => false,
          ),
          array(
            'id'             => 'title_bar_padding',
            'type'           => 'select',
            'title'          => esc_html__('Padding Spaces Top & Bottom', 'barristar'),
            'options'        => array(
              'padding-default' => esc_html__('Default Spacing', 'barristar'),
              'padding-custom' => esc_html__('Custom Padding', 'barristar'),
            ),
            'dependency'   => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'             => 'titlebar_top_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Top', 'barristar'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),
          array(
            'id'             => 'titlebar_bottom_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Bottom', 'barristar'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Background Options', 'barristar'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'      => 'titlebar_bg_overlay_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Overlay Color', 'barristar'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'barristar'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Breadcrumbs', 'barristar'),
          ),
         array(
            'id'      => 'need_breadcrumbs',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Breadcrumbs', 'barristar'),
            'label'   => esc_html__('If you want to hide breadcrumbs in your banner, please turn this ON.', 'barristar'),
            'default'    => false,
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer', 'barristar'),
    'icon'     => 'fa fa-ellipsis-h',
    'sections' => array(

      // footer widgets
      array(
        'name'     => 'footer_widgets_tab',
        'title'    => esc_html__('Widget Area', 'barristar'),
        'icon'     => 'fa fa-th',
        'fields'   => array(

          // Footer Widget Block
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Footer Widget Block', 'barristar')
          ),
          array(
            'id'    => 'footer_widget_block',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Widget Block', 'barristar'),
            'info' => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'barristar'),
            'default' => true,
          ),
          array(
            'id'    => 'footer_widget_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Widget Layouts', 'barristar'),
            'info' => esc_html__('Choose your footer widget theme-layouts.', 'barristar'),
            'default' => 4,
            'options' => array(
              1   => BARRISTAR_CS_IMAGES . '/footer/footer-1.png',
              2   => BARRISTAR_CS_IMAGES . '/footer/footer-2.png',
              3   => BARRISTAR_CS_IMAGES . '/footer/footer-3.png',
              4   => BARRISTAR_CS_IMAGES . '/footer/footer-4.png',
              5   => BARRISTAR_CS_IMAGES . '/footer/footer-5.png',
              6   => BARRISTAR_CS_IMAGES . '/footer/footer-6.png',
              7   => BARRISTAR_CS_IMAGES . '/footer/footer-7.png',
              8   => BARRISTAR_CS_IMAGES . '/footer/footer-8.png',
              9   => BARRISTAR_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'       => true,
            'dependency'  => array('footer_widget_block', '==', true),
          ),

        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'barristar'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Copyright Layout', 'barristar'),
          ),
         array(
            'id'    => 'hide_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Copyright?', 'barristar'),
            'default' => false,
            'on_text' => esc_html__('Yes', 'barristar'),
            'off_text' => esc_html__('No', 'barristar'),
            'label' => esc_html__('Yes, do it!', 'barristar'),
          ),
          array(
            'id'    => 'footer_copyright_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Select Copyright Layout', 'barristar'),
            'info' => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'barristar'),
            'default'      => 'copyright-3',
            'options'      => array(
              'copyright-1'    => BARRISTAR_CS_IMAGES .'/footer/copyright-1.png',
              ),
            'radio'        => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'barristar'),
            'shortcode' => true,
            'dependency' => array('hide_copyright', '!=', true),
            'after'       => 'Helpful shortcodes: [current_year] [home_url] or any shortcode.',
          ),

          // Copyright Another Text
          array(
            'type'    => 'notice',
            'class'   => 'warning cs-barristar-heading',
            'content' => esc_html__('Copyright Secondary Text', 'barristar'),
          ),
          array(
            'id'    => 'secondary_text',
            'type'  => 'textarea',
            'title' => esc_html__('Secondary Text', 'barristar'),
            'shortcode' => true,
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Design', 'barristar'),
    'icon'   => 'fa fa-magic'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'barristar'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'barristar'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'barristar'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'barristar'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'barristar'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'barristar'),
            'info'           => wp_kses( __('Enter css selectors like : <strong>body, .custom-class</strong>', 'barristar'), array( 'strong' => array() ) ),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'barristar'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'barristar'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'barristar'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'barristar'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'barristar'),
        'accordion_title'     => esc_html__('New Typography', 'barristar'),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'barristar'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'barristar'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => esc_html__('Thin 100', 'barristar'),
          '100i'  => esc_html__('Thin 100 Italic', 'barristar'),
          '200'   => esc_html__('Extra Light 200', 'barristar'),
          '200i'  => esc_html__('Extra Light 200 Italic', 'barristar'),
          '300'   => esc_html__('Light 300', 'barristar'),
          '300i'  => esc_html__('Light 300 Italic', 'barristar'),
          '400'   => esc_html__('Regular 400', 'barristar'),
          '400i'  => esc_html__('Regular 400 Italic', 'barristar'),
          '500'   => esc_html__('Medium 500', 'barristar'),
          '500i'  => esc_html__('Medium 500 Italic', 'barristar'),
          '600'   => esc_html__('Semi Bold 600', 'barristar'),
          '600i'  => esc_html__('Semi Bold 600 Italic', 'barristar'),
          '700'   => esc_html__('Bold 700', 'barristar'),
          '700i'  => esc_html__('Bold 700 Italic', 'barristar'),
          '800'   => esc_html__('Extra Bold 800', 'barristar'),
          '800i'  => esc_html__('Extra Bold 800 Italic', 'barristar'),
          '900'   => esc_html__('Black 900', 'barristar'),
          '900i'  => esc_html__('Black 900 Italic', 'barristar'),
        ),
        'attributes'         => array(
          'data-placeholder' => esc_html__('Font Weight', 'barristar'),
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'barristar'),
        'button_title'       => esc_html__('Add New Custom Font', 'barristar'),
        'accordion_title'    => esc_html__('Adding New Font', 'barristar'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'barristar'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'barristar'),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. Arial', 'barristar')
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .ttf <small><i>(optional)</i></small>', 'barristar'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'barristar'),
              'button_title' => wp_kses(__('Upload <i>.ttf</i>', 'barristar'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .eot <small><i>(optional)</i></small>', 'barristar'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'barristar'),
              'button_title' => wp_kses(__('Upload <i>.eot</i>', 'barristar'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'svg',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .svg <small><i>(optional)</i></small>', 'barristar'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'barristar'),
              'button_title' => wp_kses(__('Upload <i>.svg</i>', 'barristar'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .otf <small><i>(optional)</i></small>', 'barristar'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'barristar'),
              'button_title' => wp_kses(__('Upload <i>.otf</i>', 'barristar'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .woff <small><i>(optional)</i></small>', 'barristar'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'barristar'),
              'button_title' =>wp_kses(__('Upload <i>.woff</i>', 'barristar'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => wp_kses(__('Extra CSS Style <small><i>(optional)</i></small>', 'barristar'), array( 'small' => array(), 'i' => array() )),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. font-weight: normal;', 'barristar'),
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Pages', 'barristar'),
    'icon'   => 'fa fa-files-o'
  );


  // ------------------------------
  // Service Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'service_section',
    'title'    => esc_html__('Service', 'barristar'),
    'icon'     => 'fa fa-th-list',
    'fields' => array(

      // service name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'barristar')
      ),
      array(
        'id'      => 'theme_service_name',
        'type'    => 'text',
        'title'   => esc_html__('Service Name', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
        'id'      => 'theme_service_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Slug', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'service-item'
        ),
      ),
      array(
        'id'      => 'theme_service_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Category Slug', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'service-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set service slug and page slug as same. It\'ll not work.', 'barristar')
      ),

      // Service Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('Service Single', 'barristar')
      ),
      array(
        'id'      => 'single_service_title',
        'type'    => 'text',
        'title'   => esc_html__('Service Single Title', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
          'id'             => 'service_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'barristar'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'barristar'),
            'sidebar-left' => esc_html__('Left', 'barristar'),
            'sidebar-hide' => esc_html__('Hide', 'barristar'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'barristar'),
        ),
        array(
          'id'             => 'single_service_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'barristar'),
          'options'        => barristar_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'barristar'),
          'dependency'     => array('service_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'barristar'),
        ),
        array(
          'id'    => 'service_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'barristar'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'barristar'),
          'default' => true,
        ),
    ),
  );

   // ------------------------------
  // Project Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'project_section',
    'title'    => esc_html__('Project', 'barristar'),
    'icon'     => 'fa fa-medkit',
    'fields' => array(

      // project name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'barristar')
      ),
      array(
        'id'      => 'theme_project_name',
        'type'    => 'text',
        'title'   => esc_html__('Project Name', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
        'id'      => 'theme_project_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Slug', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'project-item'
        ),
      ),
      array(
        'id'      => 'theme_project_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Category Slug', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'project-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set project slug and page slug as same. It\'ll not work.', 'barristar')
      ),

      // Project Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('Project Single', 'barristar')
      ),
      array(
        'id'      => 'single_project_title',
        'type'    => 'text',
        'title'   => esc_html__('Project Single Title', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
          'id'             => 'project_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'barristar'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'barristar'),
            'sidebar-left' => esc_html__('Left', 'barristar'),
            'sidebar-hide' => esc_html__('Hide', 'barristar'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'barristar'),
        ),
        array(
          'id'             => 'single_project_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'barristar'),
          'options'        => barristar_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'barristar'),
          'dependency'     => array('project_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'barristar'),
        ),
        array(
          'id'    => 'project_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'barristar'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'barristar'),
          'default' => true,
        ),
    ),
  );


  // ------------------------------
  // Attorney Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'attorney_section',
    'title'    => esc_html__('Attorney', 'barristar'),
    'icon'     => 'fa fa-address-book-o',
    'fields' => array(

      // attorney name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'barristar')
      ),
      array(
        'id'      => 'theme_attorney_name',
        'type'    => 'text',
        'title'   => esc_html__('Attorney Name', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'Attorney'
        ),
      ),
      array(
        'id'      => 'theme_attorney_slug',
        'type'    => 'text',
        'title'   => esc_html__('Attorney Slug', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'attorney-item'
        ),
      ),
      array(
        'id'      => 'theme_attorney_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Attorney Category Slug', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'attorney-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set attorney slug and page slug as same. It\'ll not work.', 'barristar')
      ),
      // Attorney Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('attorney Single', 'barristar')
      ),
      array(
        'id'      => 'single_attorney_title',
        'type'    => 'text',
        'title'   => esc_html__('Attorney Single Title', 'barristar'),
        'attributes'     => array(
          'placeholder'  => 'Attorney'
        ),
      ),
    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog', 'barristar'),
    'icon'     => 'fa fa-edit',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'barristar'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Layout', 'barristar')
          ),
          array(
            'id'             => 'barristar_blog_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'barristar'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'barristar'),
              'sidebar-left' => esc_html__('Left', 'barristar'),
              'sidebar-hide' => esc_html__('Hide', 'barristar'),
            ),
            'default_option' => 'Select sidebar position',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'barristar'),
            'info'          => esc_html__('Default option : Right', 'barristar'),
          ),
          array(
            'id'             => 'barristar_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'barristar'),
            'options'        => barristar_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'barristar'),
            'dependency'     => array('barristar_blog_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'barristar'),
          ),
          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Global Options', 'barristar')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'barristar'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'barristar'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'barristar'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'barristar'),
            'default' => '55',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'barristar'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'barristar'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'barristar'),
              'date'    => esc_html__('Date', 'barristar'),
              'author'     => esc_html__('Author', 'barristar'),
              'comments'      => esc_html__('Comments', 'barristar'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'barristar'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Enable / Disable', 'barristar')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'barristar'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'barristar'),
            'default' => true,
          ),
           array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'barristar'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this On.', 'barristar'),
            'default' => false,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'barristar'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'barristar'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form ?', 'barristar'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this On.', 'barristar'),
            'default' => false,
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Sidebar', 'barristar')
          ),
          array(
            'id'             => 'barristar_single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'barristar'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'barristar'),
              'sidebar-left' => esc_html__('Left', 'barristar'),
              'sidebar-hide' => esc_html__('Hide', 'barristar'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'barristar'),
          ),
          array(
            'id'             => 'barristar_single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'barristar'),
            'options'        => barristar_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'barristar'),
            'dependency'     => array('barristar_single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'barristar'),
          ),
          // End fields

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )){
  // ------------------------------
  // WooCommerce Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'barristar'),
    'icon'     => 'fa fa-shopping-cart',
    'fields' => array(

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('Layout', 'barristar')
      ),
     array(
        'id'             => 'woo_product_columns',
        'type'           => 'select',
        'title'          => esc_html__('Product Column', 'barristar'),
        'options'        => array(
          2 => esc_html__('Two Column', 'barristar'),
          3 => esc_html__('Three Column', 'barristar'),
          4 => esc_html__('Four Column', 'barristar'),
        ),
        'default_option' => esc_html__('Select Product Columns', 'barristar'),
        'help'          => esc_html__('This style will apply, default woocommerce shop and archive pages.', 'barristar'),
      ),
      array(
        'id'             => 'woo_sidebar_position',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Position', 'barristar'),
        'options'        => array(
          'right-sidebar' => esc_html__('Right', 'barristar'),
          'left-sidebar' => esc_html__('Left', 'barristar'),
          'sidebar-hide' => esc_html__('Hide', 'barristar'),
        ),
        'default_option' => esc_html__('Select sidebar position', 'barristar'),
        'info'          => esc_html__('Default option : Right', 'barristar'),
      ),
      array(
        'id'             => 'woo_widget',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Widget', 'barristar'),
        'options'        => barristar_registered_sidebars(),
        'default_option' => esc_html__('Select Widget', 'barristar'),
        'dependency'     => array('woo_sidebar_position', '!=', 'sidebar-hide'),
        'info'          => esc_html__('Default option : Shop Page', 'barristar'),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('Listing', 'barristar')
      ),
      array(
        'id'      => 'theme_woo_limit',
        'type'    => 'text',
        'title'   => esc_html__('Product Limit', 'barristar'),
        'info'   => esc_html__('Enter the number value for per page products limit.', 'barristar'),
      ),
      // End fields

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-barristar-heading',
        'content' => esc_html__('Single Product', 'barristar')
      ),
      array(
        'id'             => 'woo_related_limit',
        'type'           => 'text',
        'title'          => esc_html__('Related Products Limit', 'barristar'),
      ),
      array(
        'id'    => 'woo_single_upsell',
        'type'  => 'switcher',
        'title' => esc_html__('You May Also Like', 'barristar'),
        'info' => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this ON.', 'barristar'),
        'default' => false,
      ),
      array(
        'id'    => 'woo_single_related',
        'type'  => 'switcher',
        'title' => esc_html__('Related Products', 'barristar'),
        'info' => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this ON.', 'barristar'),
        'default' => false,
      ),
      // End fields

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('Extra Pages', 'barristar'),
    'icon'     => 'fa fa-clone',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'barristar'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'barristar'),
            'info'  => esc_html__('Enter 404 page heading.', 'barristar'),
          ),
          array(
            'id'    => 'error_subheading',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Sub Heading', 'barristar'),
            'info'  => esc_html__('Enter 404 page Sub heading.', 'barristar'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'barristar'),
            'info'  => esc_html__('Enter 404 page content.', 'barristar'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_page_bg',
            'type'  => 'image',
            'title' => esc_html__('404 Page Background', 'barristar'),
            'info'  => esc_html__('Choose 404 page background styles.', 'barristar'),
            'add_title' => esc_html__('Add 404 Image', 'barristar'),
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'barristar'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'barristar'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'barristar'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'barristar')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'barristar'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'barristar'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'barristar'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_title',
            'type'           => 'text',
            'title'          => esc_html__('Maintenance Mode Text', 'barristar'),
          ),
          array(
            'id'             => 'maintenance_mode_text',
            'type'           => 'textarea',
            'title'          => esc_html__('Maintenance Mode Text', 'barristar'),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'barristar'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced', 'barristar'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Misc', 'barristar'),
    'icon'     => 'fa fa-recycle',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'barristar'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'barristar'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'barristar'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'barristar'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'barristar'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'barristar'),
            'accordion_title' => esc_html__('New Sidebar', 'barristar'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'barristar'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(
          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Custom JS', 'barristar')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'barristar'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'barristar'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Common Texts', 'barristar')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'barristar'),
          ),
          array(
            'id'          => 'view_more_text',
            'type'        => 'text',
            'title'       => esc_html__('View More Text', 'barristar'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'barristar'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'barristar'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'barristar'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'barristar'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('WooCommerce', 'barristar')
          ),
          array(
            'id'          => 'add_to_cart_text',
            'type'        => 'text',
            'title'       => esc_html__('Add to Cart Text', 'barristar'),
          ),
          array(
            'id'          => 'details_text',
            'type'        => 'text',
            'title'       => esc_html__('Details Text', 'barristar'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Pagination', 'barristar')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'barristar'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'barristar'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-barristar-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'barristar')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Case Text', 'barristar'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Case Text', 'barristar'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

 
  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'barristar'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'barristar_options' );