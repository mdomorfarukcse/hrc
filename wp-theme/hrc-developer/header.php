<?php
/**
 * Theme Header
 *
 * @package HRC_Developer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Header / Navigation -->
    <header class="header-main" id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
            <div class="container">
                <!-- Logo -->
                <?php if ( has_custom_logo() ) : ?>
                    <div class="navbar-brand">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="brand-text"><?php echo esc_html( hrc_get_option( 'brand_name', 'HRC' ) ); ?></span>
                        <span class="brand-accent"><?php echo esc_html( hrc_get_option( 'brand_accent', 'MULTI SERVICES' ) ); ?></span>
                    </a>
                <?php endif; ?>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'hrc-developer' ); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'navbar-nav ms-auto align-items-lg-center',
                            'walker'         => new HRC_Bootstrap_Nav_Walker(),
                            'fallback_cb'    => false,
                        ) );
                    } else {
                        // Fallback menu
                        ?>
                        <ul class="navbar-nav ms-auto align-items-lg-center">
                            <li class="nav-item">
                                <a class="nav-link<?php echo is_front_page() ? ' active' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hrc-developer' ); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'hrc-developer' ); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'hrc-developer' ); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'hrc-developer' ); ?></a>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                    <?php
                    $header_phone = hrc_get_option( 'contact_phone1', '313-443-1453' );
                    if ( $header_phone ) :
                        $phone_clean = preg_replace( '/[^0-9]/', '', $header_phone );
                    ?>
                        <div class="ms-lg-3">
                            <a class="btn btn-primary btn-nav-cta" href="tel:<?php echo esc_attr( $phone_clean ); ?>">
                                <i class="fas fa-phone-alt me-2"></i><?php esc_html_e( 'Call Now', 'hrc-developer' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
