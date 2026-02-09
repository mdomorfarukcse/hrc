<?php
/**
 * Template Name: Contact Page
 *
 * @package HRC_Developer
 */

get_header();

$address   = hrc_get_option( 'contact_address', "3792 Nolan Dr\nSterling Heights, MI 483**" );
$phone1    = hrc_get_option( 'contact_phone1', '313-443-1453' );
$phone1_name = hrc_get_option( 'contact_phone1_name', 'Halim Chowdhury' );
$phone2    = hrc_get_option( 'contact_phone2', '832-359-8909' );
$phone2_name = hrc_get_option( 'contact_phone2_name', 'Raye Chowdhury' );
$email     = hrc_get_option( 'contact_email', 'info@hrcmultiservices.com' );
$hours     = hrc_get_option( 'business_hours', "Monday - Friday: 9:00 AM - 6:00 PM\nSaturday: 10:00 AM - 4:00 PM\nSunday: Closed" );
$maps_url  = hrc_get_option( 'google_maps_embed', '' );
?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <p class="page-subtitle"><?php echo esc_html( get_the_excerpt() ?: "We're here to help with all your travel and documentation needs" ); ?></p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hrc-developer' ); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Contact Information -->
                <div class="col-lg-5">
                    <div class="contact-info-wrapper">
                        <h2 class="mb-4"><?php esc_html_e( 'Get in Touch', 'hrc-developer' ); ?></h2>
                        <p class="mb-5"><?php esc_html_e( 'Have questions about our services? Need assistance with your travel plans? Our team is ready to help. Reach out through any of the following channels.', 'hrc-developer' ); ?></p>

                        <?php if ( $address ) : ?>
                            <div class="contact-info-card mb-4">
                                <div class="contact-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4><?php esc_html_e( 'Our Office', 'hrc-developer' ); ?></h4>
                                    <p><?php echo nl2br( esc_html( $address ) ); ?><br><?php esc_html_e( 'United States', 'hrc-developer' ); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="contact-info-card mb-4">
                            <div class="contact-info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4><?php esc_html_e( 'Phone Numbers', 'hrc-developer' ); ?></h4>
                                <p>
                                    <?php if ( $phone1 ) : ?>
                                        <strong><?php echo esc_html( $phone1_name ); ?>:</strong> <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone1 ) ); ?>"><?php echo esc_html( $phone1 ); ?></a><br>
                                    <?php endif; ?>
                                    <?php if ( $phone2 ) : ?>
                                        <strong><?php echo esc_html( $phone2_name ); ?>:</strong> <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone2 ) ); ?>"><?php echo esc_html( $phone2 ); ?></a>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <?php if ( $email ) : ?>
                            <div class="contact-info-card mb-4">
                                <div class="contact-info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4><?php esc_html_e( 'Email', 'hrc-developer' ); ?></h4>
                                    <p><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( $hours ) : ?>
                            <div class="contact-info-card">
                                <div class="contact-info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4><?php esc_html_e( 'Business Hours', 'hrc-developer' ); ?></h4>
                                    <p><?php echo nl2br( esc_html( $hours ) ); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form-wrapper">
                        <h2 class="mb-4"><?php esc_html_e( 'Send Us a Message', 'hrc-developer' ); ?></h2>
                        <form id="contactForm" class="contact-form">
                            <?php wp_nonce_field( 'hrc_contact_nonce', 'hrc_contact_nonce_field' ); ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label"><?php esc_html_e( 'First Name *', 'hrc-developer' ); ?></label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label"><?php esc_html_e( 'Last Name *', 'hrc-developer' ); ?></label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label"><?php esc_html_e( 'Email Address *', 'hrc-developer' ); ?></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label"><?php esc_html_e( 'Phone Number *', 'hrc-developer' ); ?></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-12">
                                    <label for="service" class="form-label"><?php esc_html_e( 'Service Interested In', 'hrc-developer' ); ?></label>
                                    <select class="form-select" id="service" name="service">
                                        <option value=""><?php esc_html_e( 'Select a service', 'hrc-developer' ); ?></option>
                                        <?php
                                        $service_options = new WP_Query( array(
                                            'post_type'      => 'service',
                                            'posts_per_page' => -1,
                                            'orderby'        => 'menu_order',
                                            'order'          => 'ASC',
                                        ) );
                                        if ( $service_options->have_posts() ) :
                                            while ( $service_options->have_posts() ) : $service_options->the_post();
                                                echo '<option value="' . esc_attr( sanitize_title( get_the_title() ) ) . '">' . esc_html( get_the_title() ) . '</option>';
                                            endwhile;
                                            wp_reset_postdata();
                                        else :
                                            ?>
                                            <option value="travel"><?php esc_html_e( 'Worldwide Travel Ticket', 'hrc-developer' ); ?></option>
                                            <option value="nvr"><?php esc_html_e( 'No Visa Required (NVR)', 'hrc-developer' ); ?></option>
                                            <option value="passport"><?php esc_html_e( 'Passport Services', 'hrc-developer' ); ?></option>
                                            <option value="photo"><?php esc_html_e( 'Passport Photograph', 'hrc-developer' ); ?></option>
                                            <option value="airport"><?php esc_html_e( 'Airport Services', 'hrc-developer' ); ?></option>
                                            <option value="umra"><?php esc_html_e( 'UMRA Visa, Hotel & Flights', 'hrc-developer' ); ?></option>
                                            <option value="notary"><?php esc_html_e( 'Notary Services', 'hrc-developer' ); ?></option>
                                        <?php endif; ?>
                                        <option value="other"><?php esc_html_e( 'Other', 'hrc-developer' ); ?></option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label"><?php esc_html_e( 'Message *', 'hrc-developer' ); ?></label>
                                    <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i><?php esc_html_e( 'Send Message', 'hrc-developer' ); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <?php if ( $maps_url ) : ?>
        <section class="map-section">
            <div class="container-fluid p-0">
                <div class="map-container">
                    <iframe
                        src="<?php echo esc_url( $maps_url ); ?>"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php
get_footer();
