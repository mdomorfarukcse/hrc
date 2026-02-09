<?php
/**
 * 404 Page Template
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
                    <h1 class="page-title"><?php esc_html_e( '404 - Page Not Found', 'hrc-developer' ); ?></h1>
                    <p class="page-subtitle"><?php esc_html_e( "Sorry, the page you're looking for doesn't exist.", 'hrc-developer' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- 404 Content -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="mb-5">
                        <i class="fas fa-exclamation-triangle" style="font-size: 5rem; color: var(--accent-gold);"></i>
                    </div>
                    <h2 class="mb-4"><?php esc_html_e( "Oops! That page can't be found.", 'hrc-developer' ); ?></h2>
                    <p class="lead mb-5"><?php esc_html_e( 'It looks like nothing was found at this location. Try visiting our homepage or contact us for assistance.', 'hrc-developer' ); ?></p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-home me-2"></i><?php esc_html_e( 'Go to Homepage', 'hrc-developer' ); ?>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i><?php esc_html_e( 'Contact Us', 'hrc-developer' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
