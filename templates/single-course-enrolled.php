<?php
/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

// Prepare the nav items
$course_id = get_the_ID();
$course_nav_item = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), $course_id );
$student_must_login_to_view_course = tutor_utils()->get_option('student_must_login_to_view_course');
$is_public = \TUTOR\Course_List::is_public($course_id);

//tutor_utils()->tutor_custom_header();

if (!is_user_logged_in() && !$is_public && $student_must_login_to_view_course){
    tutor_load_template('login');
    tutor_utils()->tutor_custom_footer();
    return;
}
?>

<?php do_action('tutor_course/single/before/wrap'); ?>
<div <?php tutor_post_class('tutor-full-width-course-top tutor-course-top-info tutor-page-wrap tutor-wrap-parent'); ?>>
    <div class="tutor-course-details-page tutor-container">
        <?php (isset($is_enrolled) && $is_enrolled) ? tutor_course_enrolled_lead_info() : tutor_course_lead_info(); ?>
        <div class="tutor-row tutor-gx-xl-5">
            <main class="tutor-col-xl-8">
                <?php tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
	            <?php do_action('tutor_course/single/before/inner-wrap'); ?>
                <div class="tutor-course-details-tab tutor-mt-32">
                    <div class="tutor-is-sticky">
                        <?php tutor_load_template( 'single.course.enrolled.nav', array('course_nav_item' => $course_nav_item ) ); ?>
                    </div>
                    <div class="tutor-tab tutor-pt-24">
                        <?php foreach( $course_nav_item as $key => $subpage ) : ?>
                            <div id="tutor-course-details-tab-<?php echo $key; ?>" class="tutor-tab-item<?php echo $key == 'info' ? ' is-active' : ''; ?>">
                                <?php
                                    do_action( 'tutor_course/single/tab/'.$key.'/before' );
                                    
                                    $method = $subpage['method'];
                                    if ( is_string($method) ) {
                                        $method();
                                    } else {
                                        $_object = $method[0];
                                        $_method = $method[1];
                                        $_object->$_method(get_the_ID());
                                    }

                                    do_action( 'tutor_course/single/tab/'.$key.'/after' );
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
	            <?php do_action('tutor_course/single/after/inner-wrap'); ?>
            </main>

            <aside class="tutor-col-xl-4">
                <div class="tutor-single-course-sidebar tutor-mt-40 tutor-mt-xl-0">
                    <?php do_action('tutor_course/single/before/sidebar'); ?>
                    <?php 
                        $savedPrerequisitesIDS = maybe_unserialize(get_post_meta($course_id, '_tutor_course_prerequisites_ids', true));
                        if (is_array($savedPrerequisitesIDS) && count($savedPrerequisitesIDS)) { ?>
                        <div id="tutor_prereq" class="<?php echo ! is_single_course() || ! is_single() ? 'tutor-quiz-wrapper tutor-quiz-wrapper tutor-d-flex tutor-justify-center tutor-mt-32 tutor-pb-80' : ''; ?>">
                            <div class="course-prerequisites-lists-wrap">
                                <h3 class="tutor-fs-5 tutor-fw-bold tutor-color-black tutor-mb-24"><?php _e('Course Prerequisite(s)', 'tutor-pro'); ?></h3>
                                <ul class="prerequisites-course-lists">
                                    <li class="prerequisites-warning">
                                        <span>
                                            <i class="tutor-icon-warning tutor-color-warning"></i>
                                        </span>
                                        <?php _e('Please note that this course has the following prerequisites which must be completed before it can be accessed', 'tutor-pro'); ?>
                                    </li>
                                    <?php
                                    if (is_array($savedPrerequisitesIDS) && count($savedPrerequisitesIDS)){
                                        foreach ($savedPrerequisitesIDS as $courseID){
                                            ?>
                                            <li>
                                                <a href="<?php echo get_the_permalink($courseID); ?>" class="prerequisites-course-item">
                                                    <span class="prerequisites-course-feature-image">
                                                        <?php echo get_the_post_thumbnail($courseID); ?>
                                                    </span>

                                                    <span class="prerequisites-course-title">
                                                        <?php echo get_the_title($courseID); ?>
                                                    </span>

                                                    <?php if (tutor_utils()->is_completed_course($courseID)){
                                                        ?>
                                                        <div class="is-complete-prerequisites-course"><i class="tutor-icon-mark"></i></div>
                                                        <?php
                                                    } ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <?php } else{
                            tutor_load_template('single.course.course-entry-box');
                        }
                    ?>
                    <?php  ?>

                    <div class="tutor-single-course-sidebar-more tutor-mt-24">
                        <?php tutor_course_instructors_html(); ?>
                        <?php tutor_course_requirements_html(); ?>
                        <?php tutor_course_tags_html(); ?>
                        <?php tutor_course_target_audience_html(); ?>
                    </div>

                    <?php do_action('tutor_course/single/after/sidebar'); ?>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php do_action('tutor_course/single/after/wrap'); ?>

<?php
//tutor_utils()->tutor_custom_footer();
