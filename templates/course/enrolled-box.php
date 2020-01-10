<?php
global $wp_query;
?>

<div class="tutor-price-preview-box">
    <div class="tutor-lead-info-btn-group">
	    <?php do_action('tutor_course/single/actions_btn_group/before'); ?>

        <?php
        if ( $wp_query->query['post_type'] !== 'lesson') {
            $lesson_url = tutor_utils()->get_course_first_lesson();
            $completed_lessons = tutor_utils()->get_completed_lesson_count_by_course();
            if ( $lesson_url ) { ?>
                <a href="<?php echo $lesson_url; ?>" class="tutor-button tutor-success">
                    <?php
                        if($completed_lessons){
                            _e( 'Continue to lesson', 'tutor' );
                        }else{
                            _e( 'Start Course', 'tutor' );
                        }
                    ?>
                </a>
            <?php }
        }
        ?>
        <?php tutor_course_mark_complete_html(); ?>

        <?php do_action('tutor_course/single/actions_btn_group/after'); ?>
    </div>
	<?php tutor_course_price(); ?>

    <div class="tutor-single-course-segment  tutor-course-enrolled-wrap">
        <p>
            <i class="tutor-icon-purchase"></i>
            <?php
                $enrolled = tutor_utils()->is_enrolled();

                echo sprintf(__('You have been enrolled on %s.', 'tutor'),  "<span>". date_i18n(get_option('date_format'), strtotime($enrolled->post_date)
                    )."</span>"  );
                ?>
        </p>
        <?php do_action('tutor_enrolled_box_after') ?>

    </div>

</div> <!-- tutor-price-preview-box -->

