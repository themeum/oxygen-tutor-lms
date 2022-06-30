<?php
/**
 * Course Share Template
 *
 * @package DTLMSCourseShare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$is_wish_listed     = tutor_utils()->is_wishlisted( $post->ID, get_current_user_id() );

?>
<div class="tutor-col-auto">
	<div class="tutor-course-details-actions tutor-mt-12 tutor-mt-sm-0">
		<a href="#" class="tutor-btn tutor-btn-ghost tutor-course-wishlist-btn tutor-mr-16" data-course-id="<?php echo get_the_ID(); ?>">
			<i class="<?php echo $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ?> tutor-mr-8"></i> <?php _e('Wishlist', 'oxygen-tutor-lms'); ?>
		</a>

		<?php
		if ( tutor_utils()->get_option('enable_course_share', false, true, true) ) {
			tutor_load_template_from_custom_path(tutor()->path . '/views/course-share.php', array(), false);
		}
		?>
	</div>
</div>