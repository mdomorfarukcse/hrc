<?php
/**
 * Redux Framework Configuration
 *
 * @package HRC_Developer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = 'hrc_options';

/**
 * Redux Framework Arguments
 */
$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => esc_html__( 'HRC Theme Options', 'hrc-developer' ),
    'display_version'      => HRC_THEME_VERSION,
    'menu_type'            => 'menu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__( 'Theme Options', 'hrc-developer' ),
    'page_title'           => esc_html__( 'HRC Multi Services - Theme Options', 'hrc-developer' ),
    'admin_bar'            => true,
    'admin_bar_icon'       => 'dashicons-admin-generic',
    'admin_bar_priority'   => 50,
    'global_variable'      => $opt_name,
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => true,
    'page_priority'        => 3,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => 'dashicons-admin-generic',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'hrc_options',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    'output_tag'           => true,
    'footer_credit'        => esc_html__( 'HRC Multi Services LLC - Theme Options', 'hrc-developer' ),
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'light',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
);

Redux::set_args( $opt_name, $args );

/*
 * ------------------------------------------------------------------
 * SECTION: General Settings
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'General Settings', 'hrc-developer' ),
    'id'     => 'general',
    'desc'   => esc_html__( 'General theme settings and branding options.', 'hrc-developer' ),
    'icon'   => 'el el-home',
    'fields' => array(
        array(
            'id'       => 'site_logo',
            'type'     => 'media',
            'title'    => esc_html__( 'Site Logo', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Upload your site logo.', 'hrc-developer' ),
            'desc'     => esc_html__( 'Recommended size: 250x60px', 'hrc-developer' ),
        ),
        array(
            'id'       => 'site_favicon',
            'type'     => 'media',
            'title'    => esc_html__( 'Favicon', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Upload your favicon.', 'hrc-developer' ),
            'desc'     => esc_html__( 'Recommended size: 32x32px, .ico or .png format', 'hrc-developer' ),
        ),
        array(
            'id'      => 'brand_name',
            'type'    => 'text',
            'title'   => esc_html__( 'Brand Name (First Part)', 'hrc-developer' ),
            'default' => 'HRC',
        ),
        array(
            'id'      => 'brand_accent',
            'type'    => 'text',
            'title'   => esc_html__( 'Brand Name (Accent Part)', 'hrc-developer' ),
            'default' => 'MULTI SERVICES',
        ),
        array(
            'id'       => 'preloader_switch',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Preloader', 'hrc-developer' ),
            'default'  => false,
        ),
        array(
            'id'       => 'back_to_top',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Back to Top Button', 'hrc-developer' ),
            'default'  => true,
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Color Settings
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Colors', 'hrc-developer' ),
    'id'     => 'colors',
    'desc'   => esc_html__( 'Customize the theme color palette.', 'hrc-developer' ),
    'icon'   => 'el el-brush',
    'fields' => array(
        array(
            'id'       => 'primary_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Primary Color', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Main brand color (gradient start). Changes all buttons, links, and the left side of gradients.', 'hrc-developer' ),
            'default'  => '#9B1D34',
        ),
        array(
            'id'       => 'gradient_end_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Gradient End Color', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Gradient end color (navy). Changes the right side of all gradients.', 'hrc-developer' ),
            'default'  => '#1E3066',
        ),
        array(
            'id'       => 'accent_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Accent Color', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Accent/gold color for highlights and hover effects.', 'hrc-developer' ),
            'default'  => '#D4AF37',
        ),
        array(
            'id'       => 'header_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Header Background', 'hrc-developer' ),
            'default'  => '#FFFFFF',
        ),
        array(
            'id'       => 'footer_bg_color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer Background', 'hrc-developer' ),
            'default'  => '#0E1B3D',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Hero Section
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Hero Section', 'hrc-developer' ),
    'id'     => 'hero',
    'desc'   => esc_html__( 'Configure the homepage hero section.', 'hrc-developer' ),
    'icon'   => 'el el-photo',
    'fields' => array(
        array(
            'id'      => 'hero_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Hero Title', 'hrc-developer' ),
            'default' => 'Your Trusted Partner for',
        ),
        array(
            'id'      => 'hero_title_accent',
            'type'    => 'text',
            'title'   => esc_html__( 'Hero Title (Accent Text)', 'hrc-developer' ),
            'default' => 'Travel & Document Services',
        ),
        array(
            'id'      => 'hero_subtitle',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Hero Subtitle', 'hrc-developer' ),
            'default' => 'From passport renewals to worldwide travel tickets, we provide comprehensive services with professionalism, care, and expertise you can trust.',
        ),
        array(
            'id'      => 'hero_btn1_text',
            'type'    => 'text',
            'title'   => esc_html__( 'Primary Button Text', 'hrc-developer' ),
            'default' => 'Explore Services',
        ),
        array(
            'id'      => 'hero_btn1_url',
            'type'    => 'text',
            'title'   => esc_html__( 'Primary Button URL', 'hrc-developer' ),
            'default' => '/services/',
        ),
        array(
            'id'      => 'hero_btn2_text',
            'type'    => 'text',
            'title'   => esc_html__( 'Secondary Button Text', 'hrc-developer' ),
            'default' => 'Get in Touch',
        ),
        array(
            'id'      => 'hero_btn2_url',
            'type'    => 'text',
            'title'   => esc_html__( 'Secondary Button URL', 'hrc-developer' ),
            'default' => '/contact/',
        ),
        array(
            'id'      => 'hero_stat1_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 1 Number', 'hrc-developer' ),
            'default' => '7+',
        ),
        array(
            'id'      => 'hero_stat1_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 1 Label', 'hrc-developer' ),
            'default' => 'Years Experience',
        ),
        array(
            'id'      => 'hero_stat2_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 2 Number', 'hrc-developer' ),
            'default' => '5000+',
        ),
        array(
            'id'      => 'hero_stat2_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 2 Label', 'hrc-developer' ),
            'default' => 'Happy Clients',
        ),
        array(
            'id'      => 'hero_stat3_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 3 Number', 'hrc-developer' ),
            'default' => '24/7',
        ),
        array(
            'id'      => 'hero_stat3_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 3 Label', 'hrc-developer' ),
            'default' => 'Support Available',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Services Section (Homepage)
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Services Section', 'hrc-developer' ),
    'id'     => 'services_section',
    'desc'   => esc_html__( 'Configure the homepage services section.', 'hrc-developer' ),
    'icon'   => 'el el-briefcase',
    'fields' => array(
        array(
            'id'      => 'services_tag',
            'type'    => 'text',
            'title'   => esc_html__( 'Section Tag', 'hrc-developer' ),
            'default' => 'What We Offer',
        ),
        array(
            'id'      => 'services_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Section Title', 'hrc-developer' ),
            'default' => 'Comprehensive Services for Your Needs',
        ),
        array(
            'id'      => 'services_description',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Section Description', 'hrc-developer' ),
            'default' => 'We specialize in travel documentation, visa assistance, and professional notary services to make your journey seamless and stress-free.',
        ),
        array(
            'id'      => 'services_count',
            'type'    => 'spinner',
            'title'   => esc_html__( 'Number of Services to Show', 'hrc-developer' ),
            'default' => 7,
            'min'     => 3,
            'max'     => 12,
            'step'    => 1,
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Why Choose Us
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Why Choose Us', 'hrc-developer' ),
    'id'     => 'why_choose',
    'desc'   => esc_html__( 'Configure the Why Choose Us section on the homepage.', 'hrc-developer' ),
    'icon'   => 'el el-ok-sign',
    'fields' => array(
        array(
            'id'      => 'why_tag',
            'type'    => 'text',
            'title'   => esc_html__( 'Section Tag', 'hrc-developer' ),
            'default' => 'Why Choose HRC',
        ),
        array(
            'id'      => 'why_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Section Title', 'hrc-developer' ),
            'default' => 'Trusted Expertise, Personalized Care',
        ),
        array(
            'id'      => 'why_description',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Section Description', 'hrc-developer' ),
            'default' => 'With years of experience serving the community, HRC Multi Services LLC has become a trusted name for travel and documentation needs. We understand the importance of your journey and handle every detail with professionalism.',
        ),
        array(
            'id'       => 'why_image',
            'type'     => 'media',
            'title'    => esc_html__( 'Section Image', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Upload the image for the Why Choose Us section.', 'hrc-developer' ),
        ),
        array(
            'id'      => 'why_experience_years',
            'type'    => 'text',
            'title'   => esc_html__( 'Experience Badge Number', 'hrc-developer' ),
            'default' => '7+',
        ),
        array(
            'id'      => 'why_experience_text',
            'type'    => 'text',
            'title'   => esc_html__( 'Experience Badge Text', 'hrc-developer' ),
            'default' => 'Years of Trusted Service',
        ),
        array(
            'id'      => 'why_feature1_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Feature 1 Title', 'hrc-developer' ),
            'default' => 'Expert Guidance',
        ),
        array(
            'id'      => 'why_feature1_text',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Feature 1 Description', 'hrc-developer' ),
            'default' => 'Our knowledgeable team provides accurate information and assistance at every step of your journey.',
        ),
        array(
            'id'      => 'why_feature2_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Feature 2 Title', 'hrc-developer' ),
            'default' => 'Fast Processing',
        ),
        array(
            'id'      => 'why_feature2_text',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Feature 2 Description', 'hrc-developer' ),
            'default' => 'We prioritize efficiency without compromising accuracy in all our documentation and booking services.',
        ),
        array(
            'id'      => 'why_feature3_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Feature 3 Title', 'hrc-developer' ),
            'default' => 'Reliable Support',
        ),
        array(
            'id'      => 'why_feature3_text',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Feature 3 Description', 'hrc-developer' ),
            'default' => 'Our dedicated team is always ready to answer your questions and provide the support you need.',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: CTA Section
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Call to Action', 'hrc-developer' ),
    'id'     => 'cta',
    'desc'   => esc_html__( 'Configure the Call to Action section.', 'hrc-developer' ),
    'icon'   => 'el el-bullhorn',
    'fields' => array(
        array(
            'id'      => 'cta_title',
            'type'    => 'text',
            'title'   => esc_html__( 'CTA Title', 'hrc-developer' ),
            'default' => 'Ready to Get Started?',
        ),
        array(
            'id'      => 'cta_text',
            'type'    => 'textarea',
            'title'   => esc_html__( 'CTA Text', 'hrc-developer' ),
            'default' => 'Contact us today to discuss your travel and documentation needs. Our expert team is here to assist you every step of the way.',
        ),
        array(
            'id'      => 'cta_btn1_text',
            'type'    => 'text',
            'title'   => esc_html__( 'CTA Button 1 Text', 'hrc-developer' ),
            'default' => 'Contact Us',
        ),
        array(
            'id'      => 'cta_btn1_url',
            'type'    => 'text',
            'title'   => esc_html__( 'CTA Button 1 URL', 'hrc-developer' ),
            'default' => '/contact/',
        ),
        array(
            'id'      => 'cta_phone',
            'type'    => 'text',
            'title'   => esc_html__( 'CTA Phone Number', 'hrc-developer' ),
            'default' => '313-443-1453',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Contact Information
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Contact Information', 'hrc-developer' ),
    'id'     => 'contact_info',
    'desc'   => esc_html__( 'Your business contact details used across the site.', 'hrc-developer' ),
    'icon'   => 'el el-phone',
    'fields' => array(
        array(
            'id'      => 'contact_address',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Office Address', 'hrc-developer' ),
            'default' => "3792 Nolan Dr\nSterling Heights, MI 483**",
        ),
        array(
            'id'      => 'contact_phone1_name',
            'type'    => 'text',
            'title'   => esc_html__( 'Phone 1 Contact Name', 'hrc-developer' ),
            'default' => 'Halim Chowdhury',
        ),
        array(
            'id'      => 'contact_phone1',
            'type'    => 'text',
            'title'   => esc_html__( 'Phone Number 1', 'hrc-developer' ),
            'default' => '313-443-1453',
        ),
        array(
            'id'      => 'contact_phone2_name',
            'type'    => 'text',
            'title'   => esc_html__( 'Phone 2 Contact Name', 'hrc-developer' ),
            'default' => 'Raye Chowdhury',
        ),
        array(
            'id'      => 'contact_phone2',
            'type'    => 'text',
            'title'   => esc_html__( 'Phone Number 2', 'hrc-developer' ),
            'default' => '832-359-8909',
        ),
        array(
            'id'      => 'contact_email',
            'type'    => 'text',
            'title'   => esc_html__( 'Email Address', 'hrc-developer' ),
            'default' => 'info@hrcmultiservices.com',
        ),
        array(
            'id'      => 'business_hours',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Business Hours', 'hrc-developer' ),
            'default' => "Monday - Friday: 9:00 AM - 6:00 PM\nSaturday: 10:00 AM - 4:00 PM\nSunday: Closed",
        ),
        array(
            'id'      => 'google_maps_embed',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Google Maps Embed URL', 'hrc-developer' ),
            'subtitle' => esc_html__( 'Paste the Google Maps embed iframe src URL.', 'hrc-developer' ),
            'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2939.8!2d-83.0!3d42.6!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDLCsDM2JzAwLjAiTiA4M8KwMDAnMDAuMCJX!5e0!3m2!1sen!2sus!4v1234567890',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Social Media
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Social Media', 'hrc-developer' ),
    'id'     => 'social',
    'desc'   => esc_html__( 'Social media profile URLs.', 'hrc-developer' ),
    'icon'   => 'el el-globe',
    'fields' => array(
        array(
            'id'      => 'social_facebook',
            'type'    => 'text',
            'title'   => esc_html__( 'Facebook URL', 'hrc-developer' ),
            'default' => '#',
        ),
        array(
            'id'      => 'social_twitter',
            'type'    => 'text',
            'title'   => esc_html__( 'Twitter URL', 'hrc-developer' ),
            'default' => '#',
        ),
        array(
            'id'      => 'social_instagram',
            'type'    => 'text',
            'title'   => esc_html__( 'Instagram URL', 'hrc-developer' ),
            'default' => '#',
        ),
        array(
            'id'      => 'social_linkedin',
            'type'    => 'text',
            'title'   => esc_html__( 'LinkedIn URL', 'hrc-developer' ),
            'default' => '#',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: Footer Settings
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'Footer', 'hrc-developer' ),
    'id'     => 'footer',
    'desc'   => esc_html__( 'Footer settings and content.', 'hrc-developer' ),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'      => 'footer_description',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Footer Company Description', 'hrc-developer' ),
            'default' => "Your trusted partner for travel, documentation, and professional services. We're committed to making your journey seamless and stress-free.",
        ),
        array(
            'id'      => 'footer_copyright',
            'type'    => 'text',
            'title'   => esc_html__( 'Copyright Text', 'hrc-developer' ),
            'default' => '&copy; ' . date( 'Y' ) . ' HRC Multi Services LLC. All rights reserved.',
        ),
        array(
            'id'       => 'footer_privacy_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Privacy Policy URL', 'hrc-developer' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'footer_terms_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Terms of Service URL', 'hrc-developer' ),
            'default'  => '#',
        ),
    ),
) );

/*
 * ------------------------------------------------------------------
 * SECTION: About Page
 * ------------------------------------------------------------------
 */
Redux::set_section( $opt_name, array(
    'title'  => esc_html__( 'About Page', 'hrc-developer' ),
    'id'     => 'about_page',
    'desc'   => esc_html__( 'Configure the About page sections.', 'hrc-developer' ),
    'icon'   => 'el el-info-circle',
    'fields' => array(
        array(
            'id'      => 'about_story_tag',
            'type'    => 'text',
            'title'   => esc_html__( 'Story Section Tag', 'hrc-developer' ),
            'default' => 'Our Story',
        ),
        array(
            'id'      => 'about_story_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Story Section Title', 'hrc-developer' ),
            'default' => 'Building Trust Through Service Excellence',
        ),
        array(
            'id'      => 'about_story_content',
            'type'    => 'editor',
            'title'   => esc_html__( 'Story Content', 'hrc-developer' ),
            'default' => '<p>HRC Multi Services LLC was founded with a simple mission: to provide reliable, professional, and compassionate assistance to individuals and families navigating the complexities of travel documentation and visa services.</p><p>Based in Sterling Heights, Michigan, we have been serving our community for over 7 years, helping thousands of clients achieve their travel goals, secure essential documents, and experience peace of mind throughout their journeys.</p><p>Our team combines deep knowledge of documentation requirements with a commitment to personalized service, ensuring every client receives the attention and expertise they deserve.</p>',
        ),
        array(
            'id'       => 'about_story_image',
            'type'     => 'media',
            'title'    => esc_html__( 'Story Section Image', 'hrc-developer' ),
        ),
        array(
            'id'      => 'about_stat1_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 1 Number', 'hrc-developer' ),
            'default' => '7+',
        ),
        array(
            'id'      => 'about_stat1_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 1 Label', 'hrc-developer' ),
            'default' => 'Years of Service',
        ),
        array(
            'id'      => 'about_stat2_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 2 Number', 'hrc-developer' ),
            'default' => '5000+',
        ),
        array(
            'id'      => 'about_stat2_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 2 Label', 'hrc-developer' ),
            'default' => 'Satisfied Clients',
        ),
        array(
            'id'      => 'about_stat3_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 3 Number', 'hrc-developer' ),
            'default' => '7',
        ),
        array(
            'id'      => 'about_stat3_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 3 Label', 'hrc-developer' ),
            'default' => 'Service Categories',
        ),
        array(
            'id'      => 'about_stat4_number',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 4 Number', 'hrc-developer' ),
            'default' => '100%',
        ),
        array(
            'id'      => 'about_stat4_label',
            'type'    => 'text',
            'title'   => esc_html__( 'Stat 4 Label', 'hrc-developer' ),
            'default' => 'Commitment to Excellence',
        ),
    ),
) );
