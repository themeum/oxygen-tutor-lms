<?php
$disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');

if( !$disable_total_enrolled){ ?>
<div class="tutor-single-course-meta tutor-lead-meta">
    <ul>
        <li class="tutor-single-course-meta-total-enroll">
            <span><?php esc_html_e('Total Enrolled', 'tutor') ?></span>
            <?php echo (int) tutor_utils()->count_enrolled_users_by_course(); ?>
        </li>
    </ul>
</div>
<?php } ?>