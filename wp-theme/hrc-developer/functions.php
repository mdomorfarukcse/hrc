<?php
/**
 * HRC Multi Services Theme Functions
 *
 * @package HRC_Developer
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'HRC_THEME_VERSION', '1.0.0' );
define( 'HRC_THEME_DIR', get_template_directory() );
define( 'HRC_THEME_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function hrc_theme_setup() {
    // Add title tag support
    add_theme_support( 'title-tag' );

    // Add post thumbnail support
    add_theme_support( 'post-thumbnails' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Custom image sizes
    add_image_size( 'hrc-service-thumb', 800, 600, true );
    add_image_size( 'hrc-team-photo', 400, 400, true );
    add_image_size( 'hrc-hero', 1920, 1080, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary'        => esc_html__( 'Primary Menu', 'hrc-developer' ),
        'footer-links'   => esc_html__( 'Footer Quick Links', 'hrc-developer' ),
        'footer-services' => esc_html__( 'Footer Services', 'hrc-developer' ),
    ) );
}
add_action( 'after_setup_theme', 'hrc_theme_setup' );

/**
 * Enqueue Scripts and Styles
 */
function hrc_enqueue_scripts() {
    // Google Fonts
    wp_enqueue_style(
        'hrc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        array(),
        '5.3.2'
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // AOS Animation CSS
    wp_enqueue_style(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );

    // Theme stylesheet
    wp_enqueue_style(
        'hrc-theme-style',
        get_stylesheet_uri(),
        array( 'bootstrap', 'font-awesome', 'aos' ),
        HRC_THEME_VERSION
    );

    // Bootstrap JS
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.2',
        true
    );

    // AOS Animation JS
    wp_enqueue_script(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );

    // Theme main JS
    wp_enqueue_script(
        'hrc-main',
        HRC_THEME_URI . '/assets/js/main.js',
        array( 'bootstrap', 'aos' ),
        HRC_THEME_VERSION,
        true
    );

    // Localize script for AJAX
    wp_localize_script( 'hrc-main', 'hrc_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'hrc_contact_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'hrc_enqueue_scripts' );

/**
 * Register Custom Post Type: Services
 */
function hrc_register_post_types() {
    $labels = array(
        'name'               => esc_html__( 'Services', 'hrc-developer' ),
        'singular_name'      => esc_html__( 'Service', 'hrc-developer' ),
        'menu_name'          => esc_html__( 'Services', 'hrc-developer' ),
        'add_new'            => esc_html__( 'Add New Service', 'hrc-developer' ),
        'add_new_item'       => esc_html__( 'Add New Service', 'hrc-developer' ),
        'edit_item'          => esc_html__( 'Edit Service', 'hrc-developer' ),
        'new_item'           => esc_html__( 'New Service', 'hrc-developer' ),
        'view_item'          => esc_html__( 'View Service', 'hrc-developer' ),
        'search_items'       => esc_html__( 'Search Services', 'hrc-developer' ),
        'not_found'          => esc_html__( 'No services found', 'hrc-developer' ),
        'not_found_in_trash' => esc_html__( 'No services found in Trash', 'hrc-developer' ),
        'all_items'          => esc_html__( 'All Services', 'hrc-developer' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'service' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'service', $args );
}
add_action( 'init', 'hrc_register_post_types' );

/**
 * Register Custom Meta Boxes for Services
 */
function hrc_register_service_meta_boxes() {
    add_meta_box(
        'hrc_service_details',
        esc_html__( 'Service Details', 'hrc-developer' ),
        'hrc_service_details_callback',
        'service',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hrc_register_service_meta_boxes' );

function hrc_service_details_callback( $post ) {
    wp_nonce_field( 'hrc_service_details', 'hrc_service_details_nonce' );

    $icon_class = get_post_meta( $post->ID, '_hrc_service_icon', true );
    $subtitle   = get_post_meta( $post->ID, '_hrc_service_subtitle', true );
    $features   = get_post_meta( $post->ID, '_hrc_service_features', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="hrc_service_icon"><?php esc_html_e( 'Font Awesome Icon Class', 'hrc-developer' ); ?></label></th>
            <td>
                <input type="text" id="hrc_service_icon" name="hrc_service_icon" value="<?php echo esc_attr( $icon_class ); ?>" class="regular-text" placeholder="fas fa-plane-departure" />
                <p class="description"><?php esc_html_e( 'Enter the Font Awesome icon class (e.g., fas fa-plane-departure)', 'hrc-developer' ); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="hrc_service_subtitle"><?php esc_html_e( 'Service Subtitle', 'hrc-developer' ); ?></label></th>
            <td>
                <input type="text" id="hrc_service_subtitle" name="hrc_service_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" class="regular-text" placeholder="Brief description for header" />
            </td>
        </tr>
        <tr>
            <th><label for="hrc_service_features"><?php esc_html_e( 'Key Features (one per line)', 'hrc-developer' ); ?></label></th>
            <td>
                <textarea id="hrc_service_features" name="hrc_service_features" rows="6" class="large-text"><?php echo esc_textarea( $features ); ?></textarea>
                <p class="description"><?php esc_html_e( 'Enter one feature per line. These will be displayed as a bullet list on the service card.', 'hrc-developer' ); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

function hrc_save_service_details( $post_id ) {
    if ( ! isset( $_POST['hrc_service_details_nonce'] ) ||
         ! wp_verify_nonce( $_POST['hrc_service_details_nonce'], 'hrc_service_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['hrc_service_icon'] ) ) {
        update_post_meta( $post_id, '_hrc_service_icon', sanitize_text_field( $_POST['hrc_service_icon'] ) );
    }

    if ( isset( $_POST['hrc_service_subtitle'] ) ) {
        update_post_meta( $post_id, '_hrc_service_subtitle', sanitize_text_field( $_POST['hrc_service_subtitle'] ) );
    }

    if ( isset( $_POST['hrc_service_features'] ) ) {
        update_post_meta( $post_id, '_hrc_service_features', sanitize_textarea_field( $_POST['hrc_service_features'] ) );
    }
}
add_action( 'save_post_service', 'hrc_save_service_details' );

/**
 * Register Widget Areas
 */
function hrc_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'hrc-developer' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Footer widget area - column 1', 'hrc-developer' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-heading mb-4">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'hrc-developer' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Footer widget area - column 2', 'hrc-developer' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-heading mb-4">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'hrc-developer' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Default sidebar widget area', 'hrc-developer' ),
        'before_widget' => '<div id="%1$s" class="widget sidebar-card mb-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="sidebar-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'hrc_widgets_init' );

/**
 * Custom Walker for Bootstrap 5 Navigation
 */
class HRC_Bootstrap_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown-menu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';

        if ( in_array( 'menu-item-has-children', $classes, true ) ) {
            $classes[] = 'dropdown';
        }

        $class_names = implode( ' ', array_filter( $classes ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';

        if ( $depth === 0 ) {
            $atts['class'] = 'nav-link';
            if ( in_array( 'current-menu-item', $classes, true ) ) {
                $atts['class'] .= ' active';
            }
        } else {
            $atts['class'] = 'dropdown-item';
        }

        if ( in_array( 'menu-item-has-children', $classes, true ) && $depth === 0 ) {
            $atts['class']         .= ' dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['role']           = 'button';
            $atts['aria-expanded']  = 'false';
        }

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = isset( $args->before ) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= ( isset( $args->link_before ) ? $args->link_before : '' ) . $title . ( isset( $args->link_after ) ? $args->link_after : '' );
        $item_output .= '</a>';
        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Redux Framework Configuration
 */
if ( class_exists( 'Redux' ) ) {
    require_once HRC_THEME_DIR . '/inc/redux-config.php';
}

/**
 * Helper: Get Redux option with fallback
 */
function hrc_get_option( $option, $default = '' ) {
    global $hrc_options;

    if ( isset( $hrc_options[ $option ] ) && ! empty( $hrc_options[ $option ] ) ) {
        return $hrc_options[ $option ];
    }

    return $default;
}

/**
 * Contact Form AJAX Handler
 */
function hrc_handle_contact_form() {
    check_ajax_referer( 'hrc_contact_nonce', 'nonce' );

    $first_name = sanitize_text_field( $_POST['firstName'] ?? '' );
    $last_name  = sanitize_text_field( $_POST['lastName'] ?? '' );
    $email      = sanitize_email( $_POST['email'] ?? '' );
    $phone      = sanitize_text_field( $_POST['phone'] ?? '' );
    $service    = sanitize_text_field( $_POST['service'] ?? '' );
    $message    = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please fill in all required fields.', 'hrc-developer' ) ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please enter a valid email address.', 'hrc-developer' ) ) );
    }

    $to      = hrc_get_option( 'contact_email', get_option( 'admin_email' ) );
    $subject = sprintf(
        /* translators: %1$s: first name, %2$s: last name */
        esc_html__( 'New Contact Form Submission from %1$s %2$s', 'hrc-developer' ),
        $first_name,
        $last_name
    );

    $body = sprintf(
        "Name: %s %s\nEmail: %s\nPhone: %s\nService: %s\n\nMessage:\n%s",
        $first_name,
        $last_name,
        $email,
        $phone,
        $service,
        $message
    );

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>',
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => esc_html__( 'Thank you for your message! We will get back to you soon.', 'hrc-developer' ) ) );
    } else {
        wp_send_json_error( array( 'message' => esc_html__( 'There was an error sending your message. Please try again.', 'hrc-developer' ) ) );
    }
}
add_action( 'wp_ajax_hrc_contact_form', 'hrc_handle_contact_form' );
add_action( 'wp_ajax_nopriv_hrc_contact_form', 'hrc_handle_contact_form' );

/**
 * Register Custom Post Type: Team Members
 */
function hrc_register_team_post_type() {
    $labels = array(
        'name'               => esc_html__( 'Team Members', 'hrc-developer' ),
        'singular_name'      => esc_html__( 'Team Member', 'hrc-developer' ),
        'menu_name'          => esc_html__( 'Team', 'hrc-developer' ),
        'add_new'            => esc_html__( 'Add New Member', 'hrc-developer' ),
        'add_new_item'       => esc_html__( 'Add New Team Member', 'hrc-developer' ),
        'edit_item'          => esc_html__( 'Edit Team Member', 'hrc-developer' ),
        'new_item'           => esc_html__( 'New Team Member', 'hrc-developer' ),
        'view_item'          => esc_html__( 'View Team Member', 'hrc-developer' ),
        'search_items'       => esc_html__( 'Search Team Members', 'hrc-developer' ),
        'not_found'          => esc_html__( 'No team members found', 'hrc-developer' ),
        'not_found_in_trash' => esc_html__( 'No team members found in Trash', 'hrc-developer' ),
    );

    $args = array(
        'labels'       => $labels,
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'supports'     => array( 'title', 'thumbnail' ),
        'menu_icon'    => 'dashicons-groups',
        'menu_position' => 6,
    );

    register_post_type( 'team_member', $args );
}
add_action( 'init', 'hrc_register_team_post_type' );

/**
 * Team Member Meta Box
 */
function hrc_register_team_meta_boxes() {
    add_meta_box(
        'hrc_team_details',
        esc_html__( 'Team Member Details', 'hrc-developer' ),
        'hrc_team_details_callback',
        'team_member',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hrc_register_team_meta_boxes' );

function hrc_team_details_callback( $post ) {
    wp_nonce_field( 'hrc_team_details', 'hrc_team_details_nonce' );

    $role  = get_post_meta( $post->ID, '_hrc_team_role', true );
    $phone = get_post_meta( $post->ID, '_hrc_team_phone', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="hrc_team_role"><?php esc_html_e( 'Role / Title', 'hrc-developer' ); ?></label></th>
            <td><input type="text" id="hrc_team_role" name="hrc_team_role" value="<?php echo esc_attr( $role ); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="hrc_team_phone"><?php esc_html_e( 'Phone Number', 'hrc-developer' ); ?></label></th>
            <td><input type="text" id="hrc_team_phone" name="hrc_team_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}

function hrc_save_team_details( $post_id ) {
    if ( ! isset( $_POST['hrc_team_details_nonce'] ) ||
         ! wp_verify_nonce( $_POST['hrc_team_details_nonce'], 'hrc_team_details' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['hrc_team_role'] ) ) {
        update_post_meta( $post_id, '_hrc_team_role', sanitize_text_field( $_POST['hrc_team_role'] ) );
    }

    if ( isset( $_POST['hrc_team_phone'] ) ) {
        update_post_meta( $post_id, '_hrc_team_phone', sanitize_text_field( $_POST['hrc_team_phone'] ) );
    }
}
add_action( 'save_post_team_member', 'hrc_save_team_details' );

/**
 * Flush rewrite rules on theme activation
 */
function hrc_theme_activation() {
    hrc_register_post_types();
    hrc_register_team_post_type();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'hrc_theme_activation' );

/**
 * Add excerpt support for pages
 */
function hrc_add_page_excerpts() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'hrc_add_page_excerpts' );
