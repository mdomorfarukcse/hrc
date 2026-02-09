<?php
/**
 * Single Post Template
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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hrc-developer' ); ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'hrc-developer' ); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="mb-4">
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded-3' ) ); ?>
                                </div>
                            <?php endif; ?>

                            <div class="text-muted mb-4">
                                <span><i class="fas fa-calendar-alt me-2"></i><?php echo get_the_date(); ?></span>
                                <span class="ms-3"><i class="fas fa-user me-2"></i><?php the_author(); ?></span>
                                <?php if ( has_category() ) : ?>
                                    <span class="ms-3"><i class="fas fa-folder me-2"></i><?php the_category( ', ' ); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>

                            <?php if ( has_tag() ) : ?>
                                <div class="mt-4 pt-4 border-top">
                                    <i class="fas fa-tags me-2"></i><?php the_tags( '', ', ' ); ?>
                                </div>
                            <?php endif; ?>
                        </article>

                        <!-- Post Navigation -->
                        <div class="mt-5 pt-4 border-top">
                            <div class="row">
                                <div class="col-6">
                                    <?php previous_post_link( '<div class="text-start">%link</div>', '<i class="fas fa-chevron-left me-2"></i>%title' ); ?>
                                </div>
                                <div class="col-6">
                                    <?php next_post_link( '<div class="text-end">%link</div>', '%title<i class="fas fa-chevron-right ms-2"></i>' ); ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        // Comments
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile;
                    ?>
                </div>

                <div class="col-lg-4">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
