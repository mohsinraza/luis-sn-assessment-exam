<?php
/*
 * School Student from the Schools database
*/

class SN_School_Student {
    public $student_id;
    public $school_id;
    public $email;
    public $first_name;
    public $last_name;
    public $active;
    public $active_date;

    function __construct($student_id) {
        $this->student_id = $student_id;
        $this->set_student_data();
    }

    private function set_student_data() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM sn_school_students WHERE student_id = '%d'",
                $this->student_id
                )
        );
        $this->school_id = $sql_result->school_id;
        $this->email = $sql_result->email;
        $this->first_name = $sql_result->first_name;
        $this->last_name = $sql_result->last_name;
        $this->active = $sql_result->active;
        $this->active_date = $sql_result->active_date;

    }

    /**
     * Get all the student groups ID he belongs to.
    */
    public function get_all_student_groups_id() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT GROUPS.group_id FROM
                    `sn_school_group_students` as GROUPS,
                    `sn_school_students` as STUDENTS
                WHERE STUDENTS.student_id = GROUPS.student_id
                    AND STUDENTS.student_id = '%d'",
                $this->student_id
                )
        );
        return $sql_result;
    }

    /*
     * Get all the allowed slugs from the video library
     * Restricted by the admin and also the instructors
     * If user belongs to multiple group, merge all categories
    */
    public function get_video_library_permissions() {

        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT *
                    FROM `sn_school_students_group_access_video` as GROUP_ACCESS,
                        `sn_school_group_students` as GROUPS,
                        `sn_school_students` as STUDENTS
                    WHERE GROUP_ACCESS.group_id = GROUPS.group_id
                        AND STUDENTS.student_id = GROUPS.student_id
                        AND STUDENTS.student_id = '%d'",
                $this->student_id
                )
        );

        //merge all slugs if user is in more than 1 group
        $all_slugs=array();
        if (is_array($sql_result)) {
            foreach ($sql_result as $row ) {

                // merge all group permissions
                $all_slugs = array_merge($all_slugs,json_decode($row->video_category_slugs));
                // remove duplicates
                $all_slugs = array_unique($all_slugs);

            }
        }

        return $all_slugs;
    }

    /*
     * Get all the allowed slugs from the study guides library
     * If user belongs to multiple group, merge all categories
    */
    public function get_study_guides_library_permissions() {

        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM `sn_school_students_group_access_study_guides` as GROUP_ACCESS, `sn_school_group_students` as GROUPS, `sn_school_students` as STUDENTS WHERE GROUP_ACCESS.group_id = GROUPS.group_id AND STUDENTS.student_id = GROUPS.student_id AND STUDENTS.student_id = '%d'",
                $this->student_id
                )
        );

        //merge all slugs if user is in more than 1 group
        $all_slugs=array();
        if (is_array($sql_result)) {
            foreach ($sql_result as $row ) {

                // merge all group permissions
                $all_slugs = array_merge($all_slugs,json_decode($row->study_guides_category_slugs));
                // remove duplicates
                $all_slugs = array_unique($all_slugs);
            }
        }

        return $all_slugs;
    }

    /*
     * Get all the allowed slugs from the quiz banks
     * If user belongs to multiple group, merge all categories
    */
    public function get_quiz_bank_permissions() {

        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM `sn_school_students_group_access_quiz_banks` as GROUP_ACCESS, `sn_school_group_students` as GROUPS, `sn_school_students` as STUDENTS WHERE GROUP_ACCESS.group_id = GROUPS.group_id AND STUDENTS.student_id = GROUPS.student_id AND STUDENTS.student_id = '%d'",
                $this->student_id
                )
        );

        //merge all slugs if user is in more than 1 group
        $all_slugs=array();
        if (is_array($sql_result)) {
            foreach ($sql_result as $row ) {
                // Remove the instructors slugs form the admin allowed slugs
                $allowed_slugs = json_decode($row->qb_slugs);

            }
        }

        return $allowed_slugs;
    }



    /*
     * Get the user ID for WordPress
    */
    public function get_wp_user_id() {
        $user = get_user_by( 'email', $this->email);

        if (!$user) return false;

        return $user->ID;
    }

    private function update_active_status($status) {
        global $wpdb;

        $table = 'sn_school_students';

        $data = array('active' => $status);
        $where= array('student_id' => $this->student_id);
        $format = array('%d');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }

    public function activate() {
        return $this->update_active_status(1);
    }

    public function deactivate() {
        return $this->update_active_status(0);
    }

    public function get_reports_study_guides_downloaded() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT WP_POSTS.post_title as guide_name,
                        GUIDES_DOWNLOAD_LOG.guide_id,
                        COUNT(DISTINCT STUDENTS.student_id) as students_count
                    FROM `wp_users` as WP_USER,
                        simple65_wp101.`wpus_posts` as WP_POSTS,
                        `sn_school_students` AS STUDENTS,
                        `sn_guides_download_log` as GUIDES_DOWNLOAD_LOG
                    WHERE WP_USER.user_email = STUDENTS.email
                        AND WP_USER.ID = GUIDES_DOWNLOAD_LOG.user_id
                        AND WP_POSTS.ID = GUIDES_DOWNLOAD_LOG.guide_id
                        AND STUDENTS.student_id = %d
                    GROUP BY 1
                    ORDER BY 3 DESC",
                    $this->student_id
                )
        );
        return $sql_result;
    }

    public function get_reports_videos_watched() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT WP_POSTS.post_title as video_name,
                     VIDEO_PROGRESS_LOG.video_id,
                     SUM(VIDEO_PROGRESS_LOG.seconds_watched) as seconds_watched
        	     FROM `wp_users` as WP_USER,
                     `simple65_wp101`.`wpus_posts` as WP_POSTS,
                     `sn_school_students` AS STUDENTS,
                     `sn_video_progress_log` as VIDEO_PROGRESS_LOG
                 WHERE WP_USER.user_email = STUDENTS.email
                	AND WP_USER.ID = VIDEO_PROGRESS_LOG.user_id
                    AND WP_POSTS.ID = VIDEO_PROGRESS_LOG.video_id
                	AND STUDENTS.student_id = '%d'
                 GROUP BY 1 ORDER BY 1 ASC",
                    $this->student_id
                )
        );
        return $sql_result;
    }


    public function get_videos_watched_count() {
        global $wpdb;
        $sql_result = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*)
                    FROM sn_video_progress_log
                 WHERE user_id='%d'"
                 ,$this->get_wp_user_id()
                )
        );
        return $sql_result;
    }

    public function get_study_guides_downloaded_count() {
        global $wpdb;
        $sql_result = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*)
                    FROM sn_guides_download_log
                 WHERE user_id='%d'"
                 ,$this->get_wp_user_id()
                )
        );
        return $sql_result;
    }

    public function get_login_count($start_date, $end_date) {
        global $wpdb;
        $sql_result = $wpdb->get_var(
            $wpdb->prepare(
                "SELECT COUNT(*)
                    FROM sn_user_daily_visit
                 WHERE user_id='%d'
                    AND `date` BETWEEN '%s' AND '%s'"
                 ,
                 $this->get_wp_user_id(),
                 $start_date,
                 $end_date
                )
        );
        return $sql_result;
    }

    // Delete the videos watched log
    public function delete_videos_watched_log() {
        global $wpdb;

        $table = 'sn_video_progress_log';

        $data = array(
            'user_id' => $this->get_wp_user_id()
        );
        $format = array('%d');
        $delete_result = $wpdb->delete( $table, $data, $format );

        return $delete_result;
    }

    // Delete the study guides downloaded log
    public function delete_study_guides_downloaded_log() {
        global $wpdb;

        $table = 'sn_guides_download_log';

        $data = array(
            'user_id' => $this->get_wp_user_id()
        );
        $format = array('%d');
        $delete_result = $wpdb->delete( $table, $data, $format );

        return $delete_result;
    }
}
