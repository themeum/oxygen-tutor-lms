<?php
$course_duration = get_tutor_course_duration_context();
$disable_course_duration = get_tutor_option('disable_course_duration');

if( !empty($course_duration) && !$disable_course_duration){ ?>
<div class="tutor-single-course-meta tutor-lead-meta">
    <ul>
        <li class="tutor-single-course-meta-duration">
            <span><?php esc_html_e('Duration', 'tutor') ?></span>
            <?php echo $course_duration; ?>
        </li>
    </ul>
</div>
<?php } ?>