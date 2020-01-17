<?php
$disable_update_date = get_tutor_option('disable_course_update_date');

if( !$disable_update_date){ ?>
<div class="tutor-single-course-meta tutor-lead-meta">
    <ul>
        <li class="tutor-single-course-meta-last-update">
            <span><?php esc_html_e('Last Update', 'tutor') ?></span>
            <?php echo esc_html(get_the_modified_date()); ?>
        </li>
    </ul>
</div>
<?php } ?>