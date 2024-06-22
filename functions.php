<?php




// css
function careercraaft_enqueue_scripts()
{
  wp_register_style('cc_home_css', get_stylesheet_directory_uri() . '/assets/css/main.min.css?' . time(), array(), '1');
  wp_enqueue_style('cc_home_css');

  if (is_page('home')) {
  } else if (is_page('about-us')) {

    wp_register_style('cc_home_css', get_stylesheet_directory_uri() . '/assets/css/main.min.css?' . time(), array(), '1');
    wp_enqueue_style('cc_home_css');

    wp_register_style('cc_fany_css', get_stylesheet_directory_uri() . '/assets/css/fancyapps.min.css?' . time(), array(), '1');
    wp_enqueue_style('cc_fany_css');
  } else if (is_page('gallery')) {

    wp_register_style('cc_fany_css', get_stylesheet_directory_uri() . '/assets/css/fancyapps.min.css?' . time(), array(), '1');
    wp_enqueue_style('cc_fany_css');
  } else if ((is_single() && 'gallery' == get_post_type())) {

    wp_register_style('cc_fany_css', get_stylesheet_directory_uri() . '/assets/css/fancyapps.min.css?' . time(), array(), '1');
    wp_enqueue_style('cc_fany_css');
  } else {
    // wp_register_style('cc_fany_css', get_stylesheet_directory_uri() . '/assets/css/fancyapps.min.css?' . time(), array(), '1');
    // wp_enqueue_style('cc_fany_css');
  }
}
add_action('wp_enqueue_scripts', 'careercraaft_enqueue_scripts');

// unhooks
function unhook_parent_style()
{
  wp_dequeue_style('twenty-twenty-one-style');
  wp_deregister_style('twenty-twenty-one-style');

  wp_dequeue_style('twenty-twenty-one-print-style');
  wp_deregister_style('twenty-twenty-one-print-style');
  wp_dequeue_style('parent-style');
  wp_deregister_style('parent-style');
}
add_action('wp_enqueue_scripts', 'unhook_parent_style', 20);

function project_dequeue_unnecessary_scripts()
{
  wp_dequeue_script('twenty-twenty-one-primary-navigation-script');
  wp_deregister_script('twenty-twenty-one-primary-navigation-script');

  wp_dequeue_script('twenty-twenty-one-responsive-embeds-script');
  wp_deregister_script('twenty-twenty-one-responsive-embeds-script');
}
add_action('wp_print_scripts', 'project_dequeue_unnecessary_scripts');


add_action('wp_enqueue_scripts', 'career_crft_script');
function career_crft_script()
{
  wp_register_script("script-popper", 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', '', '', true);
  wp_enqueue_script('script-popper');

  wp_register_script("script-bs", 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js', '', '', true);
  wp_enqueue_script('script-bs');


  wp_register_script("jquery-validate", 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js', '', '', true);
  wp_enqueue_script('jquery-validate');

  wp_register_script("script-con", get_stylesheet_directory_uri() . '/assets/scripts/contact.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('script-con');
  wp_localize_script('script-con', 'customAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

  wp_register_script("script-aos", get_stylesheet_directory_uri() . '/assets/scripts/vendors/aos/aos.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('script-aos');

  wp_register_script("script-service", get_stylesheet_directory_uri() . '/assets/scripts/service.js', array('jquery'), '1.0.0', true);
  wp_enqueue_script('script-service');

  wp_enqueue_script( 'related-products', get_template_directory_uri() . '/js/related-products.js', array( 'jquery' ), null, true );
  wp_localize_script( 'related-products', 'related_products_params', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
  ));


  if (is_page('home')) {
    wp_register_script("gallery_script-owl", get_stylesheet_directory_uri() . '/assets/scripts/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('gallery_script-owl');
  } else if (is_page('about-us')) {

    wp_register_script("gallery_script-owl", get_stylesheet_directory_uri() . '/assets/scripts/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('gallery_script-owl');
  } else if (is_page('gallery')) {

    wp_register_script("gallery_script-owl", get_stylesheet_directory_uri() . '/assets/scripts/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('gallery_script-owl');

    wp_register_script("gallery_script-fan", get_stylesheet_directory_uri() . '/assets/scripts/vendors/fancyapps/fancyapps.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('gallery_script-fan');
  } else if ((is_single() && 'gallery' == get_post_type())) {

    wp_register_script("gallery_script-fan", get_stylesheet_directory_uri() . '/assets/scripts/vendors/fancyapps/fancyapps.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('gallery_script-fan');
  }



  // wp_register_script("gallery_script_style", get_stylesheet_directory_uri() . '/assets/scripts/gallary.js', array('jquery'), '1.0.0', true);
  //   wp_enqueue_script('gallery_script_style');
}



// body class action hook
function add_custom_body_classes($classes)
{
  if ((is_single() && 'countrie' == get_post_type())) {
    $classes[] = 'page-template-countries';
  } else if ((is_single() && 'post' == get_post_type())) {
    $classes[] = 'page-template-countries';
  } else if ((is_single() && 'gallery' == get_post_type())) {
    $classes[] = 'page-template-countries';
  }
  return $classes;
}

add_action('body_class', 'add_custom_body_classes');



function my_acf_init()
{

  acf_update_setting('google_api_key', 'AIzaSyDNsicAsP6-VuGtAb1O9riI3oc_NOb7IOU');
}

add_action('acf/init', 'my_acf_init');


if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'  => 'Theme Options',
    'menu_title'  => 'Theme Options',
    'menu_slug'   => 'theme-options',
    'capability'  => 'edit_posts',
    'redirect'    => true
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Header Option',
    'menu_title'  => 'Header',
    'parent_slug' => 'theme-options',
    'menu_slug'   => 'header-options',
  ));
}


// Getting Started with the WordPress Theme Customization API

// function self_customizer_section($wp_customize) {
//   $wp_customize->add_section( 'section_name' , array(
//       'title'       => __( 'Self Logo', 'my_theme' ),
//       'description' => 'theme general options',
      
//   ));

//   /* LOGO */
//   $wp_customize->add_setting( 'self_logo', array(
//       'default' => get_template_directory_uri().'/images/mytheme.png'
      
//   ));
 
//   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'self_logo', array(
//       'label'    => __( 'Main Logo', 'my_theme' ),
//       'section'  => 'section_name',
//       'settings' => 'self_logo',
      
//   )));
  
// }
// add_action('customize_register', 'self_customizer_section');


//test

// function self_customizer_section($wp_customize) {
//   $wp_customize->add_section( 'section_name', array(
//       'title'       => __( 'Self Logo', 'my_theme' ),
//       'description' => 'Theme general options',
//   ));

//   /* LOGO */
//   $wp_customize->add_setting( 'self_logo', array(
//       'default' => get_template_directory_uri() . '/images/mytheme.png',
//   ));

//   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'self_logo', array(
//       'label'    => __( 'Main Logo', 'my_theme' ),
//       'section'  => 'section_name',
//       'settings' => 'self_logo',
//   )));

//   // Add width option for logo
//   $wp_customize->add_setting( 'self_logo_width', array(
//       'default' => '100', 
//       'sanitize_callback' => 'absint', 
//   ));

//   $wp_customize->add_control( 'self_logo_width', array(
//       'type' => 'number',
//       'label' => __( 'Logo Width (px)', 'my_theme' ),
//       'section' => 'section_name',
//   ));

//   // Add height option for logo
//   $wp_customize->add_setting( 'self_logo_height', array(
//       'default' => '100', 
//       'sanitize_callback' => 'absint',
//   ));

//   $wp_customize->add_control( 'self_logo_height', array(
//       'type' => 'number',
//       'label' => __( 'Logo Height (px)', 'my_theme' ),
//       'section' => 'section_name',
//   ));


//   /// menus
//   $wp_customize->add_section( 'menusw', array(
//     'title'       => __( 'Self menus', 'my_theme' ),
//     'description' => 'Theme general options',
//   ));

  
//   $wp_customize->add_setting( 'self_w', array(
//     'default' => '',
//     'sanitize_callback' => 'absint', 
//   ));

//   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'menusw', array(
//       'label'    => __( 'Self menus', 'my_theme' ),
//       'section'  => 'menusw',
//       'settings' => 'self_w',
//   )));


// }
// add_action('customize_register', 'self_customizer_section');




function self_customizer_section($wp_customize) {
  $wp_customize->add_section( 'section_name', array(
      'title'       => __( 'Self Image', 'my_theme' ),
      'description' => 'Theme general options',
  ));

  /* LOGO */
  $wp_customize->add_setting( 'self_logo', array(
      'default' => get_template_directory_uri() . '/images/mytheme.png',
  ));

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'self_logo', array(
      'label'    => __( 'Main Logo', 'my_theme' ),
      'section'  => 'section_name',
      'settings' => 'self_logo',
  )));

  // Add width option for logo
  $wp_customize->add_setting( 'self_logo_width', array(
      'default' => '100', 
      'sanitize_callback' => 'absint', 
  ));

  $wp_customize->add_control( 'self_logo_width', array(
      'type' => 'number',
      'label' => __( 'Logo Width (px)', 'my_theme' ),
      'section' => 'section_name',
  ));

  // Add height option for logo
  $wp_customize->add_setting( 'self_logo_height', array(
      'default' => '100', 
      'sanitize_callback' => 'absint',
  ));

  $wp_customize->add_control( 'self_logo_height', array(
      'type' => 'number',
      'label' => __( 'Logo Height (px)', 'my_theme' ),
      'section' => 'section_name',
  ));

}
add_action('customize_register', 'self_customizer_section');



function starter_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'starter_new_section_name' , array(
        'title'    => __( 'starter Section Name', 'starter' ),
        'priority' => 88
    ));   

    $wp_customize->add_setting( 'starter_new_setting_name' , array(
        'default'   => '#FFF454',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label'    => __( 'link_color', 'my_theme' ),
        'section'  => 'starter_new_section_name',
        'settings' => 'starter_new_setting_name',
    )));

    
}
add_action( 'customize_register', 'starter_customize_register');



function setup_woocommerce_support(){
  add_theme_support('woocommerce');
}
add_action( 'after_setup_theme', 'setup_woocommerce_support' );


function career_crft_init() {
  register_sidebar( array(
    'name'          => __( 'Main Sidebar', 'theme eis' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'theme eis' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'career_crft_init' );


// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action( 'wp_ajax_nopriv_get_related_products', 'get_related_products_by_title' );
add_action( 'wp_ajax_get_related_products', 'get_related_products_by_title' );

function get_related_products_by_title() {
    $product_id = intval( $_POST['product_id'] );

    if ( $product_id ) {
        $related_products = bbloomer_related_products_by_same_title( array(), $product_id, array() );

        if ( ! empty( $related_products ) ) {
            $response = array();
            foreach ( $related_products as $related_product_id ) {
                $product = wc_get_product( $related_product_id );
                $response[] = array(
                    'id' => $related_product_id,
                    'name' => $product->get_name(),
                    'link' => get_permalink( $related_product_id ),
                );
            }
            wp_send_json_success( $response );
        } else {
            wp_send_json_error( 'No related products found.' );
        }
    } else {
        wp_send_json_error( 'Invalid product ID.' );
    }
}


function create_event_post_type() {
  $labels = array(
      'name'               => _x( 'Events', 'post type general name', 'textdomain' ),
      'singular_name'      => _x( 'Event', 'post type singular name', 'textdomain' ),
      'menu_name'          => _x( 'Events', 'admin menu', 'textdomain' ),
      'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'textdomain' ),
      'add_new'            => _x( 'Add New', 'event', 'textdomain' ),
      'add_new_item'       => __( 'Add New Event', 'textdomain' ),
      'new_item'           => __( 'New Event', 'textdomain' ),
      'edit_item'          => __( 'Edit Event', 'textdomain' ),
      'view_item'          => __( 'View Event', 'textdomain' ),
      'all_items'          => __( 'All Events', 'textdomain' ),
      'search_items'       => __( 'Search Events', 'textdomain' ),
      'parent_item_colon'  => __( 'Parent Events:', 'textdomain' ),
      'not_found'          => __( 'No events found.', 'textdomain' ),
      'not_found_in_trash' => __( 'No events found in Trash.', 'textdomain' )
  );

  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'events' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 20,
      'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
      'taxonomies'         => array( 'category', 'post_tag' ), // Add any taxonomies you want to associate
  );

  register_post_type( 'event', $args );
}
add_action( 'init', 'create_event_post_type' );

function add_event_meta_boxes() {
  add_meta_box(
      'event_details_meta_box',
      __( 'Event Details', 'textdomain' ),
      'render_event_meta_box',
      'event',
      'normal',
      'high'
  );
}
add_action( 'add_meta_boxes', 'add_event_meta_boxes' );

function render_event_meta_box( $post ) {
  // Add a nonce field so we can check for it later.
  wp_nonce_field( 'event_details_nonce', 'event_details_nonce' );

  // Use get_post_meta to retrieve an existing value from the database and use the value for the form.
  $event_date = get_post_meta( $post->ID, '_event_date', true );
  $event_time = get_post_meta( $post->ID, '_event_time', true );
  $event_location = get_post_meta( $post->ID, '_event_location', true );

  // Display the form, using the current value.
  ?>
  <p>
      <label for="event_date"><?php _e( 'Event Date:', 'textdomain' ); ?></label>
      <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr( $event_date ); ?>" />
  </p>
  <p>
      <label for="event_time"><?php _e( 'Event Time:', 'textdomain' ); ?></label>
      <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr( $event_time ); ?>" />
  </p>
  <p>
      <label for="event_location"><?php _e( 'Event Location:', 'textdomain' ); ?></label>
      <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr( $event_location ); ?>" />
  </p>
  <?php
}

function save_event_meta_box_data( $post_id ) {
  // Check if our nonce is set.
  if ( ! isset( $_POST['event_details_nonce'] ) ) {
      return;
  }

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $_POST['event_details_nonce'], 'event_details_nonce' ) ) {
      return;
  }

  // If this is an autosave, our form has not been submitted, so we should not do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
  }

  // Check the user's permissions.
  if ( isset( $_POST['post_type'] ) && 'event' === $_POST['post_type'] ) {
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
          return;
      }
  }

  // Sanitize and save the meta box field values.
  if ( isset( $_POST['event_date'] ) ) {
      update_post_meta( $post_id, '_event_date', sanitize_text_field( $_POST['event_date'] ) );
  }

  if ( isset( $_POST['event_time'] ) ) {
      update_post_meta( $post_id, '_event_time', sanitize_text_field( $_POST['event_time'] ) );
  }

  if ( isset( $_POST['event_location'] ) ) {
      update_post_meta( $post_id, '_event_location', sanitize_text_field( $_POST['event_location'] ) );
  }
}
add_action( 'save_post', 'save_event_meta_box_data' );
function display_events_shortcode( $atts ) {
  ob_start();
  $query = new WP_Query( array(
      'post_type' => 'event',
      'posts_per_page' => -1, // Display all events
      'orderby' => 'meta_value',
      'meta_key' => '_event_date',
      'order' => 'ASC',
  ) );

  if ( $query->have_posts() ) {
      echo '<div class="events-list">';
      while ( $query->have_posts() ) {
          $query->the_post();
          $event_date = get_post_meta( get_the_ID(), '_event_date', true );
          $event_time = get_post_meta( get_the_ID(), '_event_time', true );
          $event_location = get_post_meta( get_the_ID(), '_event_location', true );

          echo '<div class="event">';
          echo '<h2>' . get_the_title() . '</h2>';
          echo '<p><strong>Date:</strong> ' . esc_html( $event_date ) . '</p>';
          echo '<p><strong>Time:</strong> ' . esc_html( $event_time ) . '</p>';
          echo '<p><strong>Location:</strong> ' . esc_html( $event_location ) . '</p>';
          echo '<div class="event-description">' . get_the_content() . '</div>';
          echo '</div>';
      }
      echo '</div>';
  } else {
      echo '<p>No events found.</p>';
  }

  wp_reset_postdata();
  return ob_get_clean();
}
add_shortcode( 'events_listing', 'display_events_shortcode' );















// Display custom fields in product general options
add_action('woocommerce_product_options_general_product_data', 'add_custom_fields');

function add_custom_fields() {
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_field',
            'label' => __('Custom Field', 'woocommerce'),
            'placeholder' => __('Enter custom field value', 'woocommerce'),
            'desc_tip' => true,
            'description' => __('Enter the custom field information here.', 'woocommerce'),
            'type' => 'text'
        )
    );
}

// Save custom fields values
add_action('woocommerce_process_product_meta', 'save_custom_fields');

function save_custom_fields($post_id) {
    $custom_field = $_POST['_custom_field'] ?? '';

    if (!empty($custom_field)) {
        update_post_meta($post_id, '_custom_field', sanitize_text_field($custom_field));
    }
}
