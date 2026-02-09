<?php
/**
 * Single Service Template
 *
 * @package HRC_Developer
 */

get_header();

$icon     = get_post_meta( get_the_ID(), '_hrc_service_icon', true );
$subtitle = get_post_meta( get_the_ID(), '_hrc_service_subtitle', true );
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
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="service-sidebar">
                        <!-- Contact Card -->
                        <div class="sidebar-card contact-card mb-4">
                            <h3 class="sidebar-title"><?php esc_html_e( 'Get Started Today', 'hrc-developer' ); ?></h3>
                            <p><?php esc_html_e( 'Contact us for personalized assistance with your needs.', 'hrc-developer' ); ?></p>
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
                            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary w-100 mt-3">
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
