<?php

the_post();
global $post, $authordata;

$profile_url        = is_object( $authordata ) ? tutor_utils()->profile_url( $authordata->ID, true ) : '';
$show_author        = tutor_utils()->get_option( 'enable_course_author' );
?>

<div class="tutor-meta tutor-course-details-info"> 
    <?php if ( $show_author ) : ?>
    <div>
        <a href="<?php echo $profile_url; ?>" class="tutor-d-flex">
            <?php echo tutor_utils()->get_tutor_avatar( get_the_author_meta('ID') ); ?>
        </a>
    </div>
    <?php endif; ?>
    
    <div>
        <?php if ( $show_author ) : ?>
            <span class="tutor-mr-16">
                <?php esc_html_e('By', 'tutor') ?>
                <a href="<?php echo $profile_url; ?>"><?php echo get_the_author_meta('display_name'); ?></a>
            </span>
        <?php endif; ?>
    </div>
</div>