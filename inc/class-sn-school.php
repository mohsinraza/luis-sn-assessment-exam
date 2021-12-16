<?php
/*
 * Individual School
*/

class SN_School {
    public $school_id;
    public $name;
    public $start_date;
    public $end_date;
    public $premium = false;
    public $nclex = false;
    public $students_limit = 0;

    function __construct($school_id) {
        $this->school_id = $school_id;
        $this->set_school_data();
    }

    private function set_school_data() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM sn_schools WHERE school_id = %d",
                $this->school_id
                )
        );
        $this->name = $sql_result->name;
        $this->start_date = $sql_result->start_date;
        $this->end_date = $sql_result->end_date;
        $this->students_limit = $sql_result->students_limit;

        // only check permissions is plan is still active
        if ($this->is_plan_active()) {
            $this->premium = ($sql_result->premium=='1'?true:false);
            $this->nclex = ($sql_result->nclex=='1'?true:false);
        }

    }

    /*
    * The plan is active if today is between start_date and end_date
    */
    public function is_plan_active() {
        $today = new DateTime("now");
        $school_start_date = date_create_from_format('Y-m-d', $this->start_date);
        $school_end_date = date_create_from_format('Y-m-d', $this->end_date);

        return ($school_start_date<=$today && $school_end_date>=$today);
    }

    public function get_school_id() {
        return $this->school_id;
    }

    public function get_school_name() {
         return $this->name;
    }

    public function get_students_limit() {
         return $this->students_limit;
    }

    public function has_membership() {
        return $this->premium;
    }

    public function has_nclex() {
        return $this->nclex;
    }

    public function get_students() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM sn_school_students WHERE school_id = %d",
                $this->school_id
                )
        );
        return $sql_result;
    }

    public function get_instructors() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM sn_school_managers WHERE school_id = %d AND instructor = 1",
                $this->school_id
                )
        );
        return $sql_result;
    }

    public function get_students_count() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT count(*) as students_count FROM sn_school_students WHERE school_id = %d",
                $this->school_id
                )
        );
        return $sql_result->students_count;

    }

    public function get_active_students_count() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT count(*) as students_count FROM sn_school_students WHERE school_id = %d AND active = 1",
                $this->school_id
                )
        );
        return $sql_result->students_count;

    }

    public function get_student_groups() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM sn_school_students_groups WHERE school_id = %d",
                $this->school_id
                )
        );
        return $sql_result;
    }

    public function get_instructor_groups() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM sn_school_managers_groups WHERE school_id = %d",
                $this->school_id
                )
        );
        return $sql_result;
    }

    public function get_students_from_group($group_id) {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT STUDENTS.* FROM `sn_school_students` as STUDENTS, `sn_school_group_students` as GROUPS WHERE STUDENTS.student_id = GROUPS.student_id AND GROUPS.group_id = %d",
                $group_id
                )
        );
        return $sql_result;
    }

    public function get_instructors_from_group($group_id) {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT INSTRUCTORS.* FROM `sn_school_managers` as INSTRUCTORS, `sn_school_group_managers` as GROUPS WHERE INSTRUCTORS.instructor=1 AND INSTRUCTORS.manager_id = GROUPS.manager_id AND GROUPS.group_id = %d",
                $group_id
                )
        );
        return $sql_result;
    }

    /* Create Students Group */
    public function create_school_group($school_id, $school_manager_id, $group_name) {
        global $wpdb;
        $new_group_id=0;

        $table = 'sn_school_students_groups';

        $data = array('school_id' => $school_id, 'manager_id' => $school_manager_id, 'group_name' => $group_name);
        $format = array('%d','%d','%s');
        $inserted = $wpdb->insert($table, $data, $format);

        if ($inserted==1) {
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_school_students_groups WHERE school_id = %d AND group_name='%s'",
                        $school_id,
                        $group_name
                    )
            );

            if (!is_null($sql_result)) $new_group_id=$sql_result->group_id;
        }


        return $new_group_id;
    }

    public function create_instructors_group($school_id, $group_name) {
        global $wpdb;
        $new_group_id=0;

        $table = 'sn_school_managers_groups';

        $data = array('school_id' => $school_id, 'group_name' => $group_name);
        $format = array('%d','%s');
        $inserted = $wpdb->insert($table, $data, $format);

        if ($inserted==1) {
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_school_managers_groups WHERE school_id = %d AND group_name='%s'",
                        $school_id,
                        $group_name
                    )
            );

            if (!is_null($sql_result)) $new_group_id=$sql_result->group_id;
        }


        return $new_group_id;
    }

    public function delete_school_group($group_id) {
        global $wpdb;

        $table = 'sn_school_students_groups';

        $data = array('group_id' => $group_id);
        $format = array('%d');
        $delete_result = $wpdb->delete($table, $data, $format);

        return $delete_result;
    }

    public function delete_instructors_group($group_id) {
        global $wpdb;

        $table = 'sn_school_managers_groups';

        $data = array('group_id' => $group_id);
        $format = array('%d');
        $delete_result = $wpdb->delete($table, $data, $format);

        return $delete_result;
    }

    public function update_school_group_name($group_id, $new_group_name) {
        global $wpdb;

        $table = 'sn_school_students_groups';

        $data = array('group_name' => $new_group_name);
        $where= array('group_id' => $group_id);
        $format = array('%s');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }

    public function update_instructors_group_name($group_id, $new_group_name) {
        global $wpdb;

        $table = 'sn_school_managers_groups';

        $data = array('group_name' => $new_group_name);
        $where= array('group_id' => $group_id);
        $format = array('%s');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }

    public function get_reports_quizzes_daily($start_date, $end_date) {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT date, sum(quizzes_created) as quizzes_created, sum(questions_correct) as questions_correct, sum(questions_incorrect) as questions_incorrect FROM `sn_school_reports_quizzes_daily` WHERE date BETWEEN '%s' AND '%s' AND school_id = '%d' group by 1 order by 1",
                $start_date,
                $end_date,
                $this->school_id
                )
        );
        return $sql_result;
    }

    public function get_reports_nclex_daily($start_date, $end_date) {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT date, sum(quizzes_created) as quizzes_created, sum(questions_correct) as questions_correct, sum(questions_incorrect) as questions_incorrect FROM `sn_school_reports_nclex_daily` WHERE date BETWEEN '%s' AND '%s' AND school_id = '%d' group by 1 order by 1",
                $start_date,
                $end_date,
                $this->school_id
                )
        );
        return $sql_result;
    }

    public function get_reports_videos_watched() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT WP_POSTS.post_title as video_name, VIDEO_PROGRESS_LOG.video_id, COUNT(DISTINCT STUDENTS.student_id) as students_count, SUM(VIDEO_PROGRESS_LOG.seconds_watched) as seconds_watched
                	FROM `wp_users` as WP_USER, simple65_wp101.`wpus_posts` as WP_POSTS, `sn_school_students` AS STUDENTS, `sn_video_progress_log` as VIDEO_PROGRESS_LOG
                   	WHERE WP_USER.user_email = STUDENTS.email
                		AND WP_USER.ID = VIDEO_PROGRESS_LOG.user_id
                        AND WP_POSTS.ID = VIDEO_PROGRESS_LOG.video_id
                    	AND STUDENTS.school_id = '%d'
                	GROUP BY 1 ORDER BY 4 DESC",
                    $this->school_id
                )
        );
        return $sql_result;
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
                        AND STUDENTS.school_id = %d
                    GROUP BY 1
                    ORDER BY 3 DESC",
                    $this->school_id
                )
        );
        return $sql_result;
    }

    public function insert_sn_school_reports_quizzes_daily($data) {
        global $wpdb;

        $table = 'sn_school_reports_quizzes_daily';

        $data = array(
            'school_id' => $this->school_id,
            'date' => $data['date'],
            'quizzes_created' => $data['quizzes_created'],
            'questions_correct' => $data['questions_correct'],
            'questions_incorrect' => $data['questions_incorrect'],
        );
        $format = array('%d','%s', '%d', '%d', '%d');
        $sql_result = $wpdb->insert($table, $data, $format);

        return $sql_result;
    }

    public function insert_sn_school_reports_nclex_daily($data) {
        global $wpdb;

        $table = 'sn_school_reports_nclex_daily';

        $data = array(
            'school_id' => $this->school_id,
            'date' => $data['date'],
            'quizzes_created' => $data['quizzes_created'],
            'questions_correct' => $data['questions_correct'],
            'questions_incorrect' => $data['questions_incorrect'],
        );
        $format = array('%d','%s', '%d', '%d', '%d');
        $sql_result = $wpdb->insert($table, $data, $format);

        return $sql_result;
    }

    /* Delete a specific date yyyy-mm-dd from the sn_school_reports_quizzes_daily table */
    public function delete_from_sn_school_reports_quizzes_daily($date) {
        global $wpdb;

        $table = 'sn_school_reports_quizzes_daily';

        $data = array(
            'school_id' => $this->school_id,
            'date' => $date
        );
        $format = array('%d', '%s');
        $delete_result = $wpdb->delete($table, $data, $format);

        return $delete_result;
    }

    /* Delete a specific date yyyy-mm-dd from the sn_school_reports_nclex_daily table */
    public function delete_from_sn_school_reports_nclex_daily($date) {
        global $wpdb;

        $table = 'sn_school_reports_nclex_daily';

        $data = array(
            'school_id' => $this->school_id,
            'date' => $date
        );
        $format = array('%d', '%s');
        $delete_result = $wpdb->delete($table, $data, $format);

        return $delete_result;
    }


    /* Get the group video permissions */
    public function get_group_permissions() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `sn_schools_access_video` WHERE school_id = %d",
                $this->school_id
                )
        );


        $group_permissions = array(
            'video_category_slugs' => []
        );

        //empty array if no group permissions yet
        if (is_null($sql_result)) return $group_permissions;

        $group_permissions = array(
            'video_category_slugs' => json_decode($sql_result->video_category_slugs),
        );

        return $group_permissions;
    }


    /*
    * Store the video permission slugs for the group
    * $video_category_slugs array of slugs
    */
    public function update_group_permissions($video_category_slugs) {
        global $wpdb;


        // delete if record exists
        $table = 'sn_schools_access_video';
        $data = array('school_id' => $this->school_id);
        $format = array('%d');
        $delete_result = $wpdb->delete( $table, $data, $format );

        $video_category_slugs_encoded = json_encode($video_category_slugs);

        $data = array(
            'school_id' => $this->school_id,
            'video_category_slugs'=>$video_category_slugs_encoded
        );
        $format = array('%d', '%s');
        $insert_result = $wpdb->insert( $table, $data, $format );

        return array(
            'delete_result' =>$delete_result,
            'insert_result' =>$insert_result
            );
    }


    /* Get the group video permissions */
    public function get_group_permissions_study_guides() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `sn_schools_access_study_guides` WHERE school_id = %d",
                $this->school_id
                )
        );

        $group_permissions = array(
            'study_guides_category_slugs' => [],
            'instructor_restriction_slugs' => [],
        );

        //empty array if no group permissions yet
        if (is_null($sql_result)) return $group_permissions;

        $group_permissions = array(
            'study_guides_category_slugs' => json_decode($sql_result->study_guides_category_slugs),
            'instructor_restriction_slugs' => json_decode($sql_result->instructor_restriction_slugs),
        );

        return $group_permissions;

    }


    /* Get the group quiz banks permissions */
    public function get_group_permissions_quiz_banks() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `sn_schools_access_quiz_banks` WHERE school_id = %d",
                $this->school_id
                )
        );

        $group_permissions = array(
            'quiz_banks_category_slugs' => []
        );

        //empty array if no group permissions yet
        if (is_null($sql_result)) return $group_permissions;

        $group_permissions = array(
            'quiz_banks_category_slugs' => json_decode($sql_result->qb_slugs),
        );

        return $group_permissions;
    }


    /*
    * Store the study guides permission slugs for the group
    * $study_guides_category_slugs array of slugs
    */
    public function update_group_permissions_study_guides($study_guides_category_slugs) {
        global $wpdb;


        // delete if record exists
        $table = 'sn_schools_access_study_guides';
        $data = array('school_id' => $this->school_id);
        $format = array('%d');
        $delete_result = $wpdb->delete( $table, $data, $format );

        $study_guides_category_slugs_encoded = json_encode($study_guides_category_slugs);

        $data = array(
            'school_id' => $this->school_id,
            'study_guides_category_slugs'=>$study_guides_category_slugs_encoded
        );
        $format = array('%d', '%s');
        $insert_result = $wpdb->insert( $table, $data, $format );

        return array(
            'delete_result' =>$delete_result,
            'insert_result' =>$insert_result
            );
    }


        /*
        * Store the quiz banks permission slugs for the group
        * $qb_slugs array of slugs
        */
        public function update_group_permissions_quiz_banks($qb_slugs) {
            global $wpdb;

            // delete if record exists
            $table = 'sn_schools_access_quiz_banks';
            $data = array('school_id' => $this->school_id);
            $format = array('%d');
            $delete_result = $wpdb->delete( $table, $data, $format );

            $qb_slugs_encoded = json_encode($qb_slugs);

            $data = array(
                'school_id' => $this->school_id,
                'qb_slugs'=>$qb_slugs_encoded
            );
            $format = array('%d', '%s');
            $insert_result = $wpdb->insert( $table, $data, $format );

            return array(
                'delete_result' =>$delete_result,
                'insert_result' =>$insert_result
                );
        }

        // Insert a student from school
        public function insert_student($student_data){
            global $wpdb;

            $table = 'sn_school_students';

            $data = array(
                'school_id' => $this->school_id,
                'email'=>$student_data["email_address"],
                'first_name'=>$student_data["first_name"],
                'last_name'=>$student_data["last_name"],
                'active'=>1,
                'active_date'=>date("Y-m-d"),
            );
            $format = array('%d', '%s', '%s', '%s', '%d', '%s');
            $insert_result = $wpdb->insert( $table, $data, $format );

            return $insert_result;
        }

}
