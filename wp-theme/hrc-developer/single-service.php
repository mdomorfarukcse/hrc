<?php
/**
 * Single Service Template
 *
 * @package HRC_Developer
 */

get_header();

$icon     = get_post_meta( get_the_ID(), '_hrc_service_icon', true );
$subtitle = get_post_meta( get_the_ID(), '_hrc_service_subtitle', true );
$offers   = get_post_meta( get_the_ID(), '_hrc_what_we_offer', true );
$packages = get_post_meta( get_the_ID(), '_hrc_package_include', true );
$phone1   = hrc_get_option( 'contact_phone1', '313-443-1453' );
$phone1_name = hrc_get_option( 'contact_phone1_name', 'Halim Chowdhury' );
$phone2   = hrc_get_option( 'contact_phone2', '832-359-8909' );
$phone2_name = hrc_get_option( 'contact_phone2_name', 'Raye Chowdhury' );
$address  = hrc_get_option( 'contact_address', "3792 Nolan Dr\nSterling Heights, MI" );

if ( empty( $icon ) ) {
    $icon = 'fas fa-briefcase';
}
?>

    <!-- Service Header -->
    <section class="service-header">
        <div class="service-header-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="service-icon-large mb-4">
                        <i class="<?php echo esc_attr( $icon ); ?>"></i>
                    </div>
                    <h1 class="service-page-title"><?php the_title(); ?></h1>
                    <?php if ( $subtitle ) : ?>
                        <p class="service-page-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                    <?php endif; ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hrc-developer' ); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'hrc-developer' ); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Content -->
    <section class="service-content py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="service-details">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            the_content();
                        endwhile;
                        ?>
                    </div>

                    <?php
                    // What We Offer Section
                    $has_offers = false;
                    if ( ! empty( $offers ) && is_array( $offers ) ) {
                        foreach ( $offers as $offer ) {
                            if ( ! empty( $offer['title'] ) ) {
                                $has_offers = true;
                                break;
                            }
                        }
                    }

                    if ( $has_offers ) :
                    ?>
                    <!-- What We Offer -->
                    <div class="what-we-offer-section mt-5 p-4 p-lg-5" data-aos="fade-up">
                        <h2 class="section-title mb-4"><?php esc_html_e( 'What We Offer', 'hrc-developer' ); ?></h2>
                        <div class="row g-4">
                            <?php foreach ( $offers as $index => $offer ) :
                                if ( empty( $offer['title'] ) ) continue;
                                $offer_icon = ! empty( $offer['icon'] ) ? $offer['icon'] : 'fas fa-check-circle';
                                $delay = ( $index + 1 ) * 100;
                            ?>
                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                                    <div class="offer-card">
                                        <div class="offer-card-icon">
                                            <i class="<?php echo esc_attr( $offer_icon ); ?>"></i>
                                        </div>
                                        <h4 class="offer-card-title"><?php echo esc_html( $offer['title'] ); ?></h4>
                                        <?php if ( ! empty( $offer['description'] ) ) : ?>
                                            <p class="offer-card-text"><?php echo esc_html( $offer['description'] ); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php
                    // Package Include Section
                    if ( ! empty( $packages ) && is_array( $packages ) ) :
                    ?>
                    <!-- Package Include -->
                    <div class="package-include-section mt-5" data-aos="fade-up">
                        <h2 class="section-title mb-4"><?php esc_html_e( 'Package Includes', 'hrc-developer' ); ?></h2>
                        <ul class="package-list">
                            <?php foreach ( $packages as $index => $item ) :
                                if ( empty( $item ) ) continue;
                                $delay = ( $index + 1 ) * 50;
                            ?>
                                <li class="package-list-item" data-aos="fade-left" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                                    <span class="check-icon"><i class="fas fa-check"></i></span>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Contact Form on Service Page -->
                    <div class="service-contact-section mt-5" data-aos="fade-up">
                        <h2 class="section-title mb-2"><?php esc_html_e( 'Get a Free Consultation', 'hrc-developer' ); ?></h2>
                        <p class="text-muted mb-4"><?php esc_html_e( 'Interested in this service? Fill out the form below and we will get back to you shortly.', 'hrc-developer' ); ?></p>

                        <form id="serviceContactForm" class="service-contact-form">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="svcFirstName" class="form-label"><?php esc_html_e( 'First Name', 'hrc-developer' ); ?> *</label>
                                    <input type="text" class="form-control" id="svcFirstName" required placeholder="<?php esc_attr_e( 'Your first name', 'hrc-developer' ); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="svcLastName" class="form-label"><?php esc_html_e( 'Last Name', 'hrc-developer' ); ?> *</label>
                                    <input type="text" class="form-control" id="svcLastName" required placeholder="<?php esc_attr_e( 'Your last name', 'hrc-developer' ); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="svcEmail" class="form-label"><?php esc_html_e( 'Email Address', 'hrc-developer' ); ?> *</label>
                                    <input type="email" class="form-control" id="svcEmail" required placeholder="<?php esc_attr_e( 'your@email.com', 'hrc-developer' ); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="svcPhone" class="form-label"><?php esc_html_e( 'Phone Number', 'hrc-developer' ); ?> *</label>
                                    <input type="tel" class="form-control" id="svcPhone" required placeholder="<?php esc_attr_e( '(123) 456-7890', 'hrc-developer' ); ?>">
                                </div>
                                <div class="col-12">
                                    <label for="svcService" class="form-label"><?php esc_html_e( 'Service', 'hrc-developer' ); ?></label>
                                    <input type="text" class="form-control" id="svcService" value="<?php echo esc_attr( get_the_title() ); ?>" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="svcMessage" class="form-label"><?php esc_html_e( 'Message', 'hrc-developer' ); ?> *</label>
                                    <textarea class="form-control" id="svcMessage" rows="4" required placeholder="<?php esc_attr_e( 'Tell us about your requirements...', 'hrc-developer' ); ?>"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-paper-plane me-2"></i><?php esc_html_e( 'Send Inquiry', 'hrc-developer' ); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="service-sidebar">
                        <!-- Contact Card -->
                        <div class="sidebar-card contact-card mb-4">
                            <h3 class="sidebar-title"><?php esc_html_e( 'Get Started Today', 'hrc-developer' ); ?></h3>
                            <p style="position: relative; z-index: 1;"><?php esc_html_e( 'Contact us for personalized assistance with your needs.', 'hrc-developer' ); ?></p>
                            <div class="contact-info">
                                <?php if ( $phone1 ) : ?>
                                    <div class="contact-item">
                                        <i class="fas fa-phone-alt"></i>
                                        <div>
                                            <strong><?php echo esc_html( $phone1_name ); ?></strong>
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone1 ) ); ?>"><?php echo esc_html( $phone1 ); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $phone2 ) : ?>
                                    <div class="contact-item">
                                        <i class="fas fa-phone-alt"></i>
                                        <div>
                                            <strong><?php echo esc_html( $phone2_name ); ?></strong>
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone2 ) ); ?>"><?php echo esc_html( $phone2 ); ?></a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $address ) : ?>
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <strong><?php esc_html_e( 'Visit Us', 'hrc-developer' ); ?></strong>
                                            <span><?php echo nl2br( esc_html( $address ) ); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary w-100 mt-3" style="position: relative; z-index: 1;">
                                <i class="fas fa-envelope me-2"></i><?php esc_html_e( 'Send Inquiry', 'hrc-developer' ); ?>
                            </a>
                        </div>

                        <!-- All Services -->
                        <div class="sidebar-card">
                            <h3 class="sidebar-title"><?php esc_html_e( 'All Services', 'hrc-developer' ); ?></h3>
                            <ul class="sidebar-services">
                                <?php
                                $all_services = new WP_Query( array(
                                    'post_type'      => 'service',
                                    'posts_per_page' => -1,
                                    'orderby'        => 'menu_order',
                                    'order'          => 'ASC',
                                ) );

                                if ( $all_services->have_posts() ) :
                                    while ( $all_services->have_posts() ) : $all_services->the_post();
                                        $svc_icon = get_post_meta( get_the_ID(), '_hrc_service_icon', true );
                                        if ( empty( $svc_icon ) ) {
                                            $svc_icon = 'fas fa-briefcase';
                                        }
                                        $is_active = ( get_the_ID() === get_queried_object_id() ) ? ' class="active"' : '';
                                        ?>
                                        <li<?php echo $is_active; ?>>
                                            <a href="<?php the_permalink(); ?>">
                                                <i class="<?php echo esc_attr( $svc_icon ); ?>"></i>
                                                <?php the_title(); ?>
                                            </a>
                                        </li>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <?php get_template_part( 'template-parts/section', 'cta' ); ?>

<?php
get_footer();
