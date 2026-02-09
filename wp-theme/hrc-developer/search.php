<?php
/**
 * Search Results Template
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
                    <h1 class="page-title">
                        <?php
                        printf(
                            /* translators: %s: search query */
                            esc_html__( 'Search Results for: %s', 'hrc-developer' ),
                            '<span>' . esc_html( get_search_query() ) . '</span>'
                        );
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5 pb-5 border-bottom' ); ?>>
                                <h2 class="mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a>
                                </h2>
                                <div class="text-muted mb-3">
                                    <span><i class="fas fa-calendar-alt me-2"></i><?php echo get_the_date(); ?></span>
                                </div>
                                <div class="mb-3">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                    <?php esc_html_e( 'Read More', 'hrc-developer' ); ?> <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </article>
                        <?php
                        endwhile;
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ) );
                    else :
                        ?>
                        <div class="text-center py-5">
                            <i class="fas fa-search" style="font-size: 3rem; color: var(--accent-gold);"></i>
                            <h3 class="mt-4"><?php esc_html_e( 'No results found', 'hrc-developer' ); ?></h3>
                            <p class="lead"><?php esc_html_e( 'Try a different search term or browse our services.', 'hrc-developer' ); ?></p>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i><?php esc_html_e( 'Go to Homepage', 'hrc-developer' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
