<?php
/**
 * Front Page Template
 *
 * @package HRC_Developer
 */

get_header();
?>

    <!-- Hero Section -->
    <section class="hero-section" id="hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-8 mx-auto text-center text-white hero-content">
                    <h1 class="hero-title mb-4" data-aos="fade-up">
                        <?php echo esc_html( hrc_get_option( 'hero_title', 'Your Trusted Partner for' ) ); ?> <span class="text-accent"><?php echo esc_html( hrc_get_option( 'hero_title_accent', 'Travel & Document Services' ) ); ?></span>
                    </h1>
                    <p class="hero-subtitle mb-5" data-aos="fade-up" data-aos-delay="100">
                        <?php echo esc_html( hrc_get_option( 'hero_subtitle', 'From passport renewals to worldwide travel tickets, we provide comprehensive services with professionalism, care, and expertise you can trust.' ) ); ?>
                    </p>
                    <div class="hero-cta" data-aos="fade-up" data-aos-delay="200">
                        <a href="<?php echo esc_url( hrc_get_option( 'hero_btn1_url', '/services/' ) ); ?>" class="btn btn-primary btn-lg me-3 mb-3">
                            <i class="fas fa-briefcase me-2"></i><?php echo esc_html( hrc_get_option( 'hero_btn1_text', 'Explore Services' ) ); ?>
                        </a>
                        <a href="<?php echo esc_url( hrc_get_option( 'hero_btn2_url', '/contact/' ) ); ?>" class="btn btn-outline-light btn-lg mb-3">
                            <i class="fas fa-envelope me-2"></i><?php echo esc_html( hrc_get_option( 'hero_btn2_text', 'Get in Touch' ) ); ?>
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="hero-stats row g-4 mt-5">
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="stat-item">
                                <h3 class="stat-number"><?php echo esc_html( hrc_get_option( 'hero_stat1_number', '7+' ) ); ?></h3>
                                <p class="stat-label"><?php echo esc_html( hrc_get_option( 'hero_stat1_label', 'Years Experience' ) ); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="stat-item">
                                <h3 class="stat-number"><?php echo esc_html( hrc_get_option( 'hero_stat2_number', '5000+' ) ); ?></h3>
                                <p class="stat-label"><?php echo esc_html( hrc_get_option( 'hero_stat2_label', 'Happy Clients' ) ); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                            <div class="stat-item">
                                <h3 class="stat-number"><?php echo esc_html( hrc_get_option( 'hero_stat3_number', '24/7' ) ); ?></h3>
                                <p class="stat-label"><?php echo esc_html( hrc_get_option( 'hero_stat3_label', 'Support Available' ) ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview Section -->
    <section class="services-overview py-5" id="services">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="section-tag"><?php echo esc_html( hrc_get_option( 'services_tag', 'What We Offer' ) ); ?></span>
                    <h2 class="section-title mb-3"><?php echo esc_html( hrc_get_option( 'services_title', 'Comprehensive Services for Your Needs' ) ); ?></h2>
                    <p class="section-description"><?php echo esc_html( hrc_get_option( 'services_description', 'We specialize in travel documentation, visa assistance, and professional notary services to make your journey seamless and stress-free.' ) ); ?></p>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $services_count = hrc_get_option( 'services_count', 7 );
                $services = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => intval( $services_count ),
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ) );

                if ( $services->have_posts() ) :
                    $delay = 100;
                    while ( $services->have_posts() ) : $services->the_post();
                        $icon = get_post_meta( get_the_ID(), '_hrc_service_icon', true );
                        if ( empty( $icon ) ) {
                            $icon = 'fas fa-briefcase';
                        }
                        ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                                <h3 class="service-card-title"><?php the_title(); ?></h3>
                                <p class="service-card-text"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="service-link"><?php esc_html_e( 'Learn More', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i></a>
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
                        array( 'icon' => 'fas fa-plane-departure', 'title' => 'Worldwide Travel Ticket', 'text' => 'Book affordable and convenient flight tickets to destinations around the globe with expert assistance and competitive pricing.' ),
                        array( 'icon' => 'fas fa-globe-americas', 'title' => 'No Visa Required (NVR)', 'text' => 'Travel to visa-free destinations hassle-free. We guide you through documentation, requirements, and travel planning.' ),
                        array( 'icon' => 'fas fa-passport', 'title' => 'Passport Services', 'text' => 'New passport applications and renewals handled with care, accuracy, and efficiency by our experienced team.' ),
                        array( 'icon' => 'fas fa-camera', 'title' => 'Passport Photograph', 'text' => 'Professional passport photos meeting all official requirements and specifications for your travel documents.' ),
                        array( 'icon' => 'fas fa-suitcase-rolling', 'title' => 'Airport Services', 'text' => 'Comprehensive airport assistance including meet & greet, baggage help, and complete travel coordination.' ),
                        array( 'icon' => 'fas fa-kaaba', 'title' => 'UMRA Visa, Hotel & Flights', 'text' => 'Complete UMRA packages including visa processing, hotel bookings, and flight arrangements for your spiritual journey.' ),
                        array( 'icon' => 'fas fa-stamp', 'title' => 'Notary Services', 'text' => 'Licensed notary public services for all your legal document authentication and verification needs.' ),
                    );
                    $delay = 100;
                    foreach ( $static_services as $svc ) :
                        ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="<?php echo esc_attr( $svc['icon'] ); ?>"></i>
                                </div>
                                <h3 class="service-card-title"><?php echo esc_html( $svc['title'] ); ?></h3>
                                <p class="service-card-text"><?php echo esc_html( $svc['text'] ); ?></p>
                                <a href="#" class="service-link"><?php esc_html_e( 'Learn More', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i></a>
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

            <div class="text-center mt-5">
                <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="btn btn-primary btn-lg">
                    <?php esc_html_e( 'View All Services', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section bg-light py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="section-tag"><?php echo esc_html( hrc_get_option( 'why_tag', 'Why Choose HRC' ) ); ?></span>
                    <h2 class="section-title mb-4"><?php echo esc_html( hrc_get_option( 'why_title', 'Trusted Expertise, Personalized Care' ) ); ?></h2>
                    <p class="lead mb-4"><?php echo esc_html( hrc_get_option( 'why_description', 'With years of experience serving the community, HRC Multi Services LLC has become a trusted name for travel and documentation needs.' ) ); ?></p>

                    <div class="feature-list">
                        <?php
                        $features = array(
                            array(
                                'title' => hrc_get_option( 'why_feature1_title', 'Expert Guidance' ),
                                'text'  => hrc_get_option( 'why_feature1_text', 'Our knowledgeable team provides accurate information and assistance at every step of your journey.' ),
                            ),
                            array(
                                'title' => hrc_get_option( 'why_feature2_title', 'Fast Processing' ),
                                'text'  => hrc_get_option( 'why_feature2_text', 'We prioritize efficiency without compromising accuracy in all our documentation and booking services.' ),
                            ),
                            array(
                                'title' => hrc_get_option( 'why_feature3_title', 'Reliable Support' ),
                                'text'  => hrc_get_option( 'why_feature3_text', 'Our dedicated team is always ready to answer your questions and provide the support you need.' ),
                            ),
                        );
                        foreach ( $features as $feature ) :
                        ?>
                            <div class="feature-item mb-4">
                                <div class="feature-icon-box">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title"><?php echo esc_html( $feature['title'] ); ?></h4>
                                    <p class="feature-text"><?php echo esc_html( $feature['text'] ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-outline-primary btn-lg mt-3">
                        <?php esc_html_e( 'Learn More About Us', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="image-wrapper position-relative">
                        <?php
                        $why_image = hrc_get_option( 'why_image' );
                        $why_image_url = ! empty( $why_image['url'] ) ? $why_image['url'] : 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&h=600&fit=crop';
                        ?>
                        <img src="<?php echo esc_url( $why_image_url ); ?>" alt="<?php esc_attr_e( 'Professional Service', 'hrc-developer' ); ?>" class="img-fluid rounded-3 shadow-lg">
                        <div class="experience-badge">
                            <div class="badge-content">
                                <h3 class="badge-number"><?php echo esc_html( hrc_get_option( 'why_experience_years', '7+' ) ); ?></h3>
                                <p class="badge-text"><?php echo esc_html( hrc_get_option( 'why_experience_text', 'Years of Trusted Service' ) ); ?></p>
                            </div>
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
