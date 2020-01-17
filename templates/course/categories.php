<div class="tutor-single-course-meta tutor-lead-meta">
    <ul>
        <?php
        $course_categories = get_tutor_course_categories();
        if(is_array($course_categories) && count($course_categories)){
            ?>
            <li class="tutor-single-course-meta-categories">
                <span><?php esc_html_e('Categories', 'tutor') ?></span>
                <?php
                foreach ($course_categories as $course_category){
                    $category_name = $course_category->name;
                    $category_link = get_term_link($course_category->term_id);
                    echo "<a href='$category_link'>$category_name</a>";
                }
                ?>
            </li>
        <?php } ?>
    </ul>
</div>