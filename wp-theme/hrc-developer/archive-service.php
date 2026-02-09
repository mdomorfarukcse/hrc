<?php
/**
 * Service Archive Template
 * Redirects to services page or displays services grid
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
                    <h1 class="page-title"><?php esc_html_e( 'Our Services', 'hrc-developer' ); ?></h1>
                    <p class="page-subtitle"><?php esc_html_e( 'Comprehensive solutions for all your travel and documentation needs', 'hrc-developer' ); ?></p>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hrc-developer' ); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php esc_html_e( 'Services', 'hrc-developer' ); ?></li>
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
                if ( have_posts() ) :
                    $delay = 100;
                    while ( have_posts() ) :
                        the_post();
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
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <?php get_template_part( 'template-parts/section', 'cta' ); ?>

<?php
get_footer();
