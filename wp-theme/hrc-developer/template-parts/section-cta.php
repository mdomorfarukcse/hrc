<?php
/**
 * Template Part: CTA Section
 *
 * @package HRC_Developer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cta_title = hrc_get_option( 'cta_title', 'Ready to Get Started?' );
$cta_text  = hrc_get_option( 'cta_text', 'Contact us today to discuss your travel and documentation needs. Our expert team is here to assist you every step of the way.' );
$cta_btn   = hrc_get_option( 'cta_btn1_text', 'Contact Us' );
$cta_url   = hrc_get_option( 'cta_btn1_url', '/contact/' );
$cta_phone = hrc_get_option( 'cta_phone', '313-443-1453' );
$phone_clean = preg_replace( '/[^0-9]/', '', $cta_phone );
?>

<section class="cta-section py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="cta-box text-center" data-aos="zoom-in">
                    <h2 class="cta-title mb-4"><?php echo esc_html( $cta_title ); ?></h2>
                    <p class="cta-text mb-5"><?php echo esc_html( $cta_text ); ?></p>
                    <div class="cta-buttons">
                        <a href="<?php echo esc_url( $cta_url ); ?>" class="btn btn-light btn-lg me-3 mb-3">
                            <i class="fas fa-envelope me-2"></i><?php echo esc_html( $cta_btn ); ?>
                        </a>
                        <?php if ( $cta_phone ) : ?>
                            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="btn btn-outline-light btn-lg mb-3">
                                <i class="fas fa-phone-alt me-2"></i><?php echo esc_html( $cta_phone ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
