<?php
/**
 * Template Name: Services Page
 *
 * @package HRC_Developer
 */

get_header();
?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <p class="page-subtitle"><?php echo esc_html( get_the_excerpt() ?: 'Comprehensive solutions for all your travel and documentation needs' ); ?></p>
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

    <!-- Services Grid -->
    <section class="services-grid-section py-5">
        <div class="container py-5">
            <div class="row g-4">
                <?php
                $services = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ) );

                if ( $services->have_posts() ) :
                    $delay = 100;
                    while ( $services->have_posts() ) : $services->the_post();
                        $icon     = get_post_meta( get_the_ID(), '_hrc_service_icon', true );
                        $features = get_post_meta( get_the_ID(), '_hrc_service_features', true );

                        if ( empty( $icon ) ) {
                            $icon = 'fas fa-briefcase';
                        }

                        $feature_list = array();
                        if ( ! empty( $features ) ) {
                            $feature_list = array_filter( array_map( 'trim', explode( "\n", $features ) ) );
                        }
                        ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="service-card-detailed">
                                <div class="service-card-icon">
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                                <h3 class="service-card-title"><?php the_title(); ?></h3>
                                <p class="service-card-description"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                <?php if ( ! empty( $feature_list ) ) : ?>
                                    <ul class="service-features">
                                        <?php foreach ( $feature_list as $feature ) : ?>
                                            <li><i class="fas fa-check me-2"></i><?php echo esc_html( $feature ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary w-100 mt-3">
                                    <?php esc_html_e( 'View Details', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                        <?php
                        $delay += 100;
                        if ( $delay > 300 ) {
                            $delay = 100;
                        }
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback static services
                    $static_services = array(
                        array( 'icon' => 'fas fa-plane-departure', 'title' => 'Worldwide Travel Ticket', 'desc' => 'Book affordable and convenient flight tickets to destinations around the globe. We offer competitive pricing, expert route planning, and personalized assistance to make your travel seamless.', 'features' => array( 'Competitive airfare rates', 'Expert route planning', 'Multi-city bookings', '24/7 booking assistance' ) ),
                        array( 'icon' => 'fas fa-globe-americas', 'title' => 'No Visa Required (NVR)', 'desc' => 'Travel to visa-free destinations hassle-free. We provide comprehensive guidance on documentation requirements, entry procedures, and travel planning for NVR destinations.', 'features' => array( 'Destination guidance', 'Documentation assistance', 'Entry requirement updates', 'Travel planning support' ) ),
                        array( 'icon' => 'fas fa-passport', 'title' => 'New Passport & Renewal', 'desc' => 'Expert assistance with new passport applications and renewals. We ensure accuracy, completeness, and timely processing of all your passport documentation needs.', 'features' => array( 'Application guidance', 'Document verification', 'Fast processing options', 'Renewal reminders' ) ),
                        array( 'icon' => 'fas fa-camera', 'title' => 'Passport Photograph', 'desc' => 'Professional passport photos meeting all official specifications and requirements. Quick service with guaranteed compliance to international standards.', 'features' => array( 'Official specifications', 'Professional quality', 'Same-day service', 'Digital & print copies' ) ),
                        array( 'icon' => 'fas fa-suitcase-rolling', 'title' => 'Airport Services', 'desc' => 'Comprehensive airport assistance including meet & greet, baggage help, wheelchair assistance, and complete travel coordination for a stress-free experience.', 'features' => array( 'Meet & greet service', 'Baggage assistance', 'Wheelchair support', 'Check-in coordination' ) ),
                        array( 'icon' => 'fas fa-kaaba', 'title' => 'UMRA Visa, Hotel & Flights', 'desc' => 'Complete UMRA packages including visa processing, hotel bookings, and flight arrangements. We handle all details for your spiritual journey with care and respect.', 'features' => array( 'Visa processing', 'Hotel near Haram', 'Flight arrangements', 'Group packages' ) ),
                        array( 'icon' => 'fas fa-stamp', 'title' => 'Notary Services', 'desc' => 'Licensed notary public services for all your legal document authentication needs. Professional, reliable, and compliant with state regulations.', 'features' => array( 'Document notarization', 'Acknowledgments', 'Oath administration', 'Mobile notary available' ) ),
                    );
                    $delay = 100;
                    foreach ( $static_services as $svc ) :
                    ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="service-card-detailed">
                                <div class="service-card-icon">
                                    <i class="<?php echo esc_attr( $svc['icon'] ); ?>"></i>
                                </div>
                                <h3 class="service-card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
                                <p class="service-card-description"><?php echo esc_html( $svc['desc'] ); ?></p>
                                <ul class="service-features">
                                    <?php foreach ( $svc['features'] as $feat ) : ?>
                                        <li><i class="fas fa-check me-2"></i><?php echo esc_html( $feat ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="#" class="btn btn-outline-primary w-100 mt-3">
                                    <?php esc_html_e( 'View Details', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    <?php
                        $delay += 100;
                        if ( $delay > 300 ) {
                            $delay = 100;
                        }
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section bg-light py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="section-tag"><?php esc_html_e( 'How It Works', 'hrc-developer' ); ?></span>
                    <h2 class="section-title mb-3"><?php esc_html_e( 'Simple & Straightforward Process', 'hrc-developer' ); ?></h2>
                    <p class="section-description"><?php esc_html_e( 'Getting started with our services is easy. Follow these simple steps.', 'hrc-developer' ); ?></p>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $steps = array(
                    array( 'number' => '01', 'title' => 'Contact Us', 'text' => 'Reach out via phone, email, or visit our office to discuss your needs.' ),
                    array( 'number' => '02', 'title' => 'Consultation', 'text' => 'Our experts will guide you through requirements and options available.' ),
                    array( 'number' => '03', 'title' => 'Processing', 'text' => 'We handle all paperwork and coordination efficiently and accurately.' ),
                    array( 'number' => '04', 'title' => 'Completion', 'text' => 'Receive your documents or travel plans ready for your journey.' ),
                );
                $delay = 100;
                foreach ( $steps as $step ) :
                ?>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                        <div class="process-card">
                            <div class="process-number"><?php echo esc_html( $step['number'] ); ?></div>
                            <h3 class="process-title"><?php echo esc_html( $step['title'] ); ?></h3>
                            <p class="process-text"><?php echo esc_html( $step['text'] ); ?></p>
                        </div>
                    </div>
                <?php
                    $delay += 100;
                endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <?php get_template_part( 'template-parts/section', 'cta' ); ?>

<?php
get_footer();
