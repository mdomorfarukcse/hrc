<?php
/**
 * Archive Template
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
                    <h1 class="page-title"><?php the_archive_title(); ?></h1>
                    <?php the_archive_description( '<p class="page-subtitle">', '</p>' ); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Archive Content -->
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
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="mb-4">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded-3' ) ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <h2 class="mb-3">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a>
                                </h2>

                                <div class="text-muted mb-3">
                                    <span><i class="fas fa-calendar-alt me-2"></i><?php echo get_the_date(); ?></span>
                                    <span class="ms-3"><i class="fas fa-user me-2"></i><?php the_author(); ?></span>
                                </div>

                                <div class="mb-4">
                                    <?php the_excerpt(); ?>
                                </div>

                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">
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
                        <p><?php esc_html_e( 'No posts found.', 'hrc-developer' ); ?></p>
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
