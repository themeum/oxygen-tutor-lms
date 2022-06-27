<?php

$disable_reviews    = ! get_tutor_option( 'enable_course_review' );

?>
<?php if ( ! $disable_reviews ) : ?>
    <div class="tutor-course-details-ratings">
        <?php
            $course_rating = tutor_utils()->get_course_rating();
            tutor_utils()->star_rating_generator_v2($course_rating->rating_avg, $course_rating->rating_count, true);
        ?>
    </div>
<?php endif; ?>