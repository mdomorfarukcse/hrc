<?php
/**
 * Theme Footer
 *
 * @package HRC_Developer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$footer_desc    = hrc_get_option( 'footer_description', "Your trusted partner for travel, documentation, and professional services. We're committed to making your journey seamless and stress-free." );
$copyright      = hrc_get_option( 'footer_copyright', '&copy; ' . date( 'Y' ) . ' HRC Multi Services LLC. All rights reserved.' );
$privacy_url    = hrc_get_option( 'footer_privacy_url', '#' );
$terms_url      = hrc_get_option( 'footer_terms_url', '#' );
$address        = hrc_get_option( 'contact_address', "3792 Nolan Dr\nSterling Heights, MI 483**" );
$phone1         = hrc_get_option( 'contact_phone1', '313-443-1453' );
$phone2         = hrc_get_option( 'contact_phone2', '832-359-8909' );
$email          = hrc_get_option( 'contact_email', 'info@hrcmultiservices.com' );
$facebook       = hrc_get_option( 'social_facebook', '#' );
$twitter        = hrc_get_option( 'social_twitter', '#' );
$instagram      = hrc_get_option( 'social_instagram', '#' );
$linkedin       = hrc_get_option( 'social_linkedin', '#' );
?>

    <!-- Footer -->
    <footer class="footer bg-dark text-white pt-5">
        <div class="container py-5">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <h3 class="footer-brand mb-4"><?php echo esc_html( hrc_get_option( 'brand_name', 'HRC' ) . ' ' . hrc_get_option( 'brand_accent', 'MULTI SERVICES' ) ); ?></h3>
                    <p class="footer-text mb-4"><?php echo esc_html( $footer_desc ); ?></p>
                    <div class="social-links">
                        <?php if ( $facebook ) : ?>
                            <a href="<?php echo esc_url( $facebook ); ?>" class="social-link" aria-label="<?php esc_attr_e( 'Facebook', 'hrc-developer' ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if ( $twitter ) : ?>
                            <a href="<?php echo esc_url( $twitter ); ?>" class="social-link" aria-label="<?php esc_attr_e( 'Twitter', 'hrc-developer' ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if ( $instagram ) : ?>
                            <a href="<?php echo esc_url( $instagram ); ?>" class="social-link" aria-label="<?php esc_attr_e( 'Instagram', 'hrc-developer' ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if ( $linkedin ) : ?>
                            <a href="<?php echo esc_url( $linkedin ); ?>" class="social-link" aria-label="<?php esc_attr_e( 'LinkedIn', 'hrc-developer' ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h4 class="footer-heading mb-4"><?php esc_html_e( 'Quick Links', 'hrc-developer' ); ?></h4>
                    <?php
                    if ( has_nav_menu( 'footer-links' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer-links',
                            'container'      => false,
                            'menu_class'     => 'footer-links list-unstyled',
                            'depth'          => 1,
                        ) );
                    } else {
                        ?>
                        <ul class="footer-links list-unstyled">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hrc-developer' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'hrc-developer' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'hrc-developer' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'hrc-developer' ); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-heading mb-4"><?php esc_html_e( 'Our Services', 'hrc-developer' ); ?></h4>
                    <?php
                    if ( has_nav_menu( 'footer-services' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer-services',
                            'container'      => false,
                            'menu_class'     => 'footer-links list-unstyled',
                            'depth'          => 1,
                        ) );
                    } else {
                        // Dynamic services from CPT
                        $footer_services = new WP_Query( array(
                            'post_type'      => 'service',
                            'posts_per_page' => 4,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ) );

                        if ( $footer_services->have_posts() ) :
                            echo '<ul class="footer-links list-unstyled">';
                            while ( $footer_services->have_posts() ) : $footer_services->the_post();
                                echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
                            endwhile;
                            echo '</ul>';
                            wp_reset_postdata();
                        else :
                            ?>
                            <ul class="footer-links list-unstyled">
                                <li><a href="#"><?php esc_html_e( 'Travel Tickets', 'hrc-developer' ); ?></a></li>
                                <li><a href="#"><?php esc_html_e( 'Passport Services', 'hrc-developer' ); ?></a></li>
                                <li><a href="#"><?php esc_html_e( 'UMRA Packages', 'hrc-developer' ); ?></a></li>
                                <li><a href="#"><?php esc_html_e( 'Notary Services', 'hrc-developer' ); ?></a></li>
                            </ul>
                            <?php
                        endif;
                    }
                    ?>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="footer-heading mb-4"><?php esc_html_e( 'Contact Us', 'hrc-developer' ); ?></h4>
                    <ul class="footer-contact list-unstyled">
                        <?php if ( $address ) : ?>
                            <li class="mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span><?php echo nl2br( esc_html( $address ) ); ?></span>
                            </li>
                        <?php endif; ?>
                        <?php if ( $phone1 ) : ?>
                            <li class="mb-3">
                                <i class="fas fa-phone-alt me-2"></i>
                                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone1 ) ); ?>"><?php echo esc_html( $phone1 ); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ( $phone2 ) : ?>
                            <li class="mb-3">
                                <i class="fas fa-phone-alt me-2"></i>
                                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone2 ) ); ?>"><?php echo esc_html( $phone2 ); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ( $email ) : ?>
                            <li>
                                <i class="fas fa-envelope me-2"></i>
                                <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom py-4 border-top border-secondary">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-0"><?php echo wp_kses_post( $copyright ); ?></p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <?php if ( $privacy_url ) : ?>
                            <a href="<?php echo esc_url( $privacy_url ); ?>" class="footer-bottom-link me-3"><?php esc_html_e( 'Privacy Policy', 'hrc-developer' ); ?></a>
                        <?php endif; ?>
                        <?php if ( $terms_url ) : ?>
                            <a href="<?php echo esc_url( $terms_url ); ?>" class="footer-bottom-link"><?php esc_html_e( 'Terms of Service', 'hrc-developer' ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <?php if ( hrc_get_option( 'back_to_top', true ) ) : ?>
        <button class="back-to-top" id="backToTop" aria-label="<?php esc_attr_e( 'Back to top', 'hrc-developer' ); ?>">
            <i class="fas fa-chevron-up"></i>
        </button>
    <?php endif; ?>

    <?php wp_footer(); ?>
</body>
</html>
