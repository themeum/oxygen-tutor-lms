<div class="tutor-single-course-sidebar tutor-mt-40 tutor-mt-xl-0">
    <?php 

        do_action('tutor_course/single/before/sidebar'); 
        tutor_load_template('single.course.course-entry-box');
        do_action('tutor_course/single/after/sidebar');
    ?>
</div>