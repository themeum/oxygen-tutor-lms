<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

?>

<?php if(!get_option( 'users_can_register', false )): ?> 
    <?php 
        $args = array(
            'image_path'    => tutor()->url.'assets/images/construction.png',
            'title'         => __('Oooh! Access Denied', 'oxygen-tutor-lms'),
            'description'   => __('You do not have access to this area of the application. Please refer to your system  administrator.', 'oxygen-tutor-lms'),
            'button'        => array(
                'text'      => __('Go to Home', 'oxygen-tutor-lms'),
                'url'       => get_home_url(),
                'class'     => 'tutor-btn'
            )
        );
        tutor_load_template('feature_disabled', $args); 
    ?>
<?php else: ?>

<?php do_action('tutor_before_student_reg_form');?>
<div class="tutor-wrap tutor-student-registration tutor-py-80">
    <div class="tutor-container">
        <form method="post" enctype="multipart/form-data" id="tutor-registration-from">
            <input type="hidden" name="tutor_course_enroll_attempt" value="<?php echo isset( $_GET['enrol_course_id'] ) ? (int)$_GET['enrol_course_id'] : '';?>">
            <?php do_action('tutor_student_reg_form_start');?>

            <?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
            <input type="hidden" value="tutor_register_student" name="tutor_action"/>

            <?php
            
            $errors = apply_filters('tutor_student_register_validation_errors', array());
            if (is_array($errors) && count($errors)){
                echo '<div class="tutor-alert-warning tutor-mb-12"><ul class="tutor-required-fields">';
                foreach ($errors as $error_key => $error_value){
                    echo "<li>{$error_value}</li>";
                }
                echo '</ul></div>';
            }
            ?>

            <div class="tutor-row">
                <div class="tutor-col-6">
                    <div class="tutor-form-group">
                        <label>
                            <?php _e('First Name', 'oxygen-tutor-lms'); ?>
                        </label>

                        <input type="text" name="first_name" value="<?php esc_attr_e(tutor_utils()->input_old('first_name')) ; ?>" placeholder="<?php _e('First Name', 'oxygen-tutor-lms'); ?>" required autocomplete="given-name">
                    </div>
                </div>

                <div class="tutor-col-6">
                    <div class="tutor-form-group">
                        <label>
                            <?php _e('Last Name', 'oxygen-tutor-lms'); ?>
                        </label>

                        <input type="text" name="last_name" value="<?php esc_attr_e(tutor_utils()->input_old('last_name')); ?>" placeholder="<?php _e('Last Name', 'oxygen-tutor-lms'); ?>" required autocomplete="family-name">
                    </div>
                </div>

            </div>

            <div class="tutor-row">
                <div class="tutor-col-6">
                    <div class="tutor-form-group">
                        <label>
                            <?php _e('User Name', 'oxygen-tutor-lms'); ?>
                        </label>

                        <input type="text" name="user_login" class="tutor_user_name" value="<?php esc_attr_e(tutor_utils()->input_old('user_login')); ?>" placeholder="<?php _e('User Name', 'oxygen-tutor-lms'); ?>" required autocomplete="username">
                    </div>
                </div>

                <div class="tutor-col-6">
                    <div class="tutor-form-group">
                        <label>
                            <?php _e('E-Mail', 'oxygen-tutor-lms'); ?>
                        </label>

                        <input type="text" name="email" value="<?php esc_attr_e(tutor_utils()->input_old('email')); ?>" placeholder="<?php _e('E-Mail', 'oxygen-tutor-lms'); ?>" required autocomplete="email">
                    </div>
                </div>

            </div>

            <div class="tutor-row">
                <div class="tutor-col-6">
                    <div class="tutor-form-group">
                        <label>
                            <?php _e('Password', 'oxygen-tutor-lms'); ?>
                        </label>

                        <input type="password" name="password" value="<?php esc_attr_e(tutor_utils()->input_old('password')); ?>" placeholder="<?php _e('Password', 'oxygen-tutor-lms'); ?>" required autocomplete="new-password">
                    </div>
                </div>

                <div class="tutor-col-6">
                    <div class="tutor-form-group">
                        <label>
                            <?php _e('Password confirmation', 'oxygen-tutor-lms'); ?>
                        </label>

                        <input type="password" name="password_confirmation" value="<?php esc_attr_e(tutor_utils()->input_old('password_confirmation')); ?>" placeholder="<?php _e('Password Confirmation', 'oxygen-tutor-lms'); ?>" required autocomplete="new-password">
                    </div>
                </div>
            </div>


            <div class="tutor-row">
                <div class="tutor-col-12">
                    <div class="tutor-form-group">
                    <?php
                        //providing register_form hook
                        do_action('tutor_student_reg_form_middle');
                        do_action('register_form');
                    ?>
                    </div>
                </div>
            </div>    

            <?php do_action('tutor_student_reg_form_end');?>

            <?php
                $tutor_toc_page_link = tutor_utils()->get_toc_page_link();
            ?>
            
            <?php if( null !== $tutor_toc_page_link ) : ?>
                <div class="tutor-mb-24">
                    <?php _e( 'By signing up, I agree with the website\'s', 'oxygen-tutor-lms' ) ?> <a target="_blank" href="<?php echo $tutor_toc_page_link?>" title="<?php _e('Terms and Conditions', 'oxygen-tutor-lms'); ?>"><?php _e('Terms and Conditions', 'oxygen-tutor-lms'); ?></a>
                </div>
            <?php endif; ?>

            <div>
                <button type="submit" name="tutor_register_student_btn" value="register" class="tutor-btn tutor-btn-primary"><?php _e('Register', 'oxygen-tutor-lms'); ?></button>
            </div>

        </form>
    </div>
</div>
<?php do_action('tutor_after_student_reg_form');?>
<?php endif; ?>
