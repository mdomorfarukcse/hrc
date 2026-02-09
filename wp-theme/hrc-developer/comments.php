<?php
/**
 * Comments Template
 *
 * @package HRC_Developer
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area mt-5 pt-4 border-top">
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title mb-4">
            <?php
            $comment_count = get_comments_number();
            printf(
                /* translators: 1: comment count, 2: post title */
                esc_html( _nx( '%1$s Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'hrc-developer' ) ),
                number_format_i18n( $comment_count ),
                get_the_title()
            );
            ?>
        </h3>

        <ol class="comment-list list-unstyled">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php
    comment_form( array(
        'class_form'    => 'contact-form',
        'class_submit'  => 'btn btn-primary',
        'title_reply'   => esc_html__( 'Leave a Comment', 'hrc-developer' ),
    ) );
    ?>
</div>
