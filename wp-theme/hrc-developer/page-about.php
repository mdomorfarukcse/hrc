<?php
/**
 * Template Name: About Page
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
                    <p class="page-subtitle"><?php echo esc_html( get_the_excerpt() ?: 'Trusted expertise in travel and documentation services since 2017' ); ?></p>
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

    <!-- About Story Section -->
    <section class="about-story py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-image">
                        <?php
                        $story_image = hrc_get_option( 'about_story_image' );
                        $story_image_url = ! empty( $story_image['url'] ) ? $story_image['url'] : 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&h=600&fit=crop';
                        ?>
                        <img src="<?php echo esc_url( $story_image_url ); ?>" alt="<?php esc_attr_e( 'Our Office', 'hrc-developer' ); ?>" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="section-tag"><?php echo esc_html( hrc_get_option( 'about_story_tag', 'Our Story' ) ); ?></span>
                    <h2 class="section-title mb-4"><?php echo esc_html( hrc_get_option( 'about_story_title', 'Building Trust Through Service Excellence' ) ); ?></h2>
                    <?php
                    $story_content = hrc_get_option( 'about_story_content', '' );
                    if ( $story_content ) {
                        echo wp_kses_post( $story_content );
                    } else {
                        ?>
                        <p class="mb-4">HRC Multi Services LLC was founded with a simple mission: to provide reliable, professional, and compassionate assistance to individuals and families navigating the complexities of travel documentation and visa services.</p>
                        <p class="mb-4">Based in Sterling Heights, Michigan, we have been serving our community for over 7 years, helping thousands of clients achieve their travel goals, secure essential documents, and experience peace of mind throughout their journeys.</p>
                        <p>Our team combines deep knowledge of documentation requirements with a commitment to personalized service, ensuring every client receives the attention and expertise they deserve.</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section bg-light py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="section-tag"><?php esc_html_e( 'Our Values', 'hrc-developer' ); ?></span>
                    <h2 class="section-title mb-3"><?php esc_html_e( 'What Drives Us', 'hrc-developer' ); ?></h2>
                    <p class="section-description"><?php esc_html_e( 'Our core values guide everything we do and shape the experience we provide to every client.', 'hrc-developer' ); ?></p>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $values = array(
                    array( 'icon' => 'fas fa-shield-alt', 'title' => 'Trust & Integrity', 'text' => 'We handle your most important documents and travel plans with the utmost care and confidentiality.' ),
                    array( 'icon' => 'fas fa-users', 'title' => 'Client-Centered', 'text' => 'Your needs come first. We listen, understand, and provide personalized solutions for every situation.' ),
                    array( 'icon' => 'fas fa-award', 'title' => 'Excellence', 'text' => 'We maintain the highest standards in every service we provide, ensuring accuracy and reliability.' ),
                    array( 'icon' => 'fas fa-clock', 'title' => 'Efficiency', 'text' => 'We value your time and work diligently to process your requests as quickly as possible.' ),
                    array( 'icon' => 'fas fa-handshake', 'title' => 'Reliability', 'text' => 'Count on us to be there when you need us, with consistent, dependable service.' ),
                    array( 'icon' => 'fas fa-heart', 'title' => 'Compassion', 'text' => 'We understand the stress of travel and documentation. We\'re here to make it easier.' ),
                );
                $delay = 100;
                foreach ( $values as $value ) :
                ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
                            </div>
                            <h3 class="value-title"><?php echo esc_html( $value['title'] ); ?></h3>
                            <p class="value-text"><?php echo esc_html( $value['text'] ); ?></p>
                        </div>
                    </div>
                <?php
                    $delay += 100;
                    if ( $delay > 300 ) {
                        $delay = 100;
                    }
                endforeach;
                ?>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="section-tag"><?php esc_html_e( 'Our Team', 'hrc-developer' ); ?></span>
                    <h2 class="section-title mb-3"><?php esc_html_e( 'Meet Our Leadership', 'hrc-developer' ); ?></h2>
                    <p class="section-description"><?php esc_html_e( 'Experienced professionals dedicated to serving you with expertise and care.', 'hrc-developer' ); ?></p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                $team = new WP_Query( array(
                    'post_type'      => 'team_member',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ) );

                if ( $team->have_posts() ) :
                    $delay = 100;
                    while ( $team->have_posts() ) : $team->the_post();
                        $role  = get_post_meta( get_the_ID(), '_hrc_team_role', true );
                        $phone = get_post_meta( get_the_ID(), '_hrc_team_phone', true );
                        ?>
                        <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="team-card">
                                <div class="team-image">
                                    <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'hrc-team-photo', array( 'class' => 'img-fluid' ) );
                                    }
                                    ?>
                                </div>
                                <div class="team-content">
                                    <h3 class="team-name"><?php the_title(); ?></h3>
                                    <?php if ( $role ) : ?>
                                        <p class="team-role"><?php echo esc_html( $role ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( $phone ) : ?>
                                        <p class="team-contact">
                                            <i class="fas fa-phone-alt me-2"></i>
                                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback team
                    $fallback_team = array(
                        array( 'name' => 'Halim Chowdhury', 'role' => 'Principal Consultant', 'phone' => '313-443-1453', 'img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&h=400&fit=crop' ),
                        array( 'name' => 'Raye Chowdhury', 'role' => 'Senior Consultant', 'phone' => '832-359-8909', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=400&fit=crop' ),
                    );
                    $delay = 100;
                    foreach ( $fallback_team as $member ) :
                    ?>
                        <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                            <div class="team-card">
                                <div class="team-image">
                                    <img src="<?php echo esc_url( $member['img'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" class="img-fluid">
                                </div>
                                <div class="team-content">
                                    <h3 class="team-name"><?php echo esc_html( $member['name'] ); ?></h3>
                                    <p class="team-role"><?php echo esc_html( $member['role'] ); ?></p>
                                    <p class="team-contact">
                                        <i class="fas fa-phone-alt me-2"></i>
                                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $member['phone'] ) ); ?>"><?php echo esc_html( $member['phone'] ); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                        $delay += 100;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section text-white py-5">
        <div class="container py-5">
            <div class="row g-4 text-center">
                <?php
                $stats = array(
                    array( 'number' => hrc_get_option( 'about_stat1_number', '7+' ), 'label' => hrc_get_option( 'about_stat1_label', 'Years of Service' ) ),
                    array( 'number' => hrc_get_option( 'about_stat2_number', '5000+' ), 'label' => hrc_get_option( 'about_stat2_label', 'Satisfied Clients' ) ),
                    array( 'number' => hrc_get_option( 'about_stat3_number', '7' ), 'label' => hrc_get_option( 'about_stat3_label', 'Service Categories' ) ),
                    array( 'number' => hrc_get_option( 'about_stat4_number', '100%' ), 'label' => hrc_get_option( 'about_stat4_label', 'Commitment to Excellence' ) ),
                );
                $delay = 100;
                foreach ( $stats as $stat ) :
                ?>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
                        <div class="stat-box">
                            <h3 class="stat-number-large"><?php echo esc_html( $stat['number'] ); ?></h3>
                            <p class="stat-label-large"><?php echo esc_html( $stat['label'] ); ?></p>
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
