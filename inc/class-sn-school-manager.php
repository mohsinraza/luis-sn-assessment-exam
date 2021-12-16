<?php
/*
 * School Manager from the Schools database
*/

class SN_School_Manager {
    public $manager_id;
    public $school_id;
    public $email;
    public $first_name;
    public $last_name;
    public $active;
    private $admin;
    private $instructor;

    function __construct($manager_id) {
        $this->manager_id = $manager_id;
        $this->set_manager_data();
    }

    private function set_manager_data() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM sn_school_managers WHERE manager_id = '%d'",
                $this->manager_id
                )
        );
        $this->school_id = $sql_result->school_id;
        $this->email = $sql_result->email;
        $this->first_name = $sql_result->first_name;
        $this->last_name = $sql_result->last_name;

        $this->instructor = ($sql_result->instructor=='1'?true:false);
        $this->admin = ($sql_result->admin=='1'?true:false);
        $this->active = ($sql_result->active=='1'?true:false);

    }

    public function is_admin() {
        return $this->admin;
    }

    public function is_instructor() {
        return $this->instructor;
    }

    public function activate() {
        return $this->update_active_status(1);
    }

    public function deactivate() {
        return $this->update_active_status(0);
    }

    private function update_active_status($status) {
        global $wpdb;

        $table = 'sn_school_managers';

        $data = array('active' => $status);
        $where= array('manager_id' => $this->manager_id);
        $format = array('%d');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }


    /*
    * Get all the allowed slugs from the video library
    * Restricted by the admin and also the instructors
    * If user belongs to multiple group, merge all categories
    */
    public function get_video_library_permissions() {

        global $wpdb;

        //get permissions from the school or the instructor tables
        if ($this->is_admin()) {

            $sql_result = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
                        FROM `sn_schools_access_video`
                        WHERE school_id = '%d'",
                    $this->school_id
                    )
            );
        } else {
            $sql_result = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
                        FROM `sn_school_managers_group_access_video` as GROUP_ACCESS,
                            `sn_school_group_managers` as GROUPS,
                            `sn_school_managers` as MANAGERS
                        WHERE GROUP_ACCESS.group_id = GROUPS.group_id
                            AND MANAGERS.manager_id = GROUPS.manager_id
                            AND MANAGERS.manager_id = '%d'",
                    $this->manager_id
                    )
            );
        }

        //merge all slugs if user is in more than 1 group
        $all_slugs=array();
        if (is_array($sql_result)) {
            foreach ($sql_result as $row ) {
                // merge all group permissions
                $all_slugs = array_merge($all_slugs,json_decode($row->video_category_slugs));
                // remove duplicates
                // $all_slugs = array_unique($all_slugs);
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

        //get permissions from the school or the instructor tables
        if ($this->is_admin()) {

            $sql_result = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
                        FROM `sn_schools_access_study_guides`
                        WHERE school_id = '%d'",
                    $this->school_id
                    )
            );
        } else {
            $sql_result = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM
                        `sn_school_managers_group_access_study_guides` as GROUP_ACCESS,
                        `sn_school_group_managers` as GROUPS,
                        `sn_school_managers` as MANAGERS
                    WHERE GROUP_ACCESS.group_id = GROUPS.group_id
                        AND MANAGERS.manager_id = GROUPS.manager_id
                        AND MANAGERS.manager_id = '%d'",
                    $this->manager_id
                    )
            );
        }
        //merge all slugs if user is in more than 1 group
        $all_slugs=array();
        if (is_array($sql_result)) {
            foreach ($sql_result as $row ) {
                // merge all group permissions
                $all_slugs = array_merge($all_slugs,json_decode($row->study_guides_category_slugs));
                // remove duplicates
                // $all_slugs = array_unique($all_slugs);
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

        //get permissions from the school or the instructor tables
        if ($this->is_admin()) {

            $sql_result = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT *
                        FROM `sn_schools_access_quiz_banks`
                        WHERE school_id = '%d'",
                    $this->school_id
                    )
            );
        } else {
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM
                    `sn_school_managers_group_access_quiz_banks` as GROUP_ACCESS,
                    `sn_school_group_managers` as GROUPS,
                    `sn_school_managers` as MANAGERS
                WHERE GROUP_ACCESS.group_id = GROUPS.group_id
                    AND MANAGERS.manager_id = GROUPS.manager_id
                    AND MANAGERS.manager_id = '%d'",
                $this->manager_id
                )
            );
        }

        //merge all slugs if user is in more than 1 group
        $all_slugs=array();
        if (is_array($sql_result)) {
            foreach ($sql_result as $row ) {
                // merge all group permissions
                $all_slugs = array_merge($all_slugs,json_decode($row->qb_slugs));
                // remove duplicates
                // $all_slugs = array_unique($all_slugs);
            }
        }

        return $all_slugs;
    }

    /**
     * Get all the manager groups ID he belongs to.
    */
    public function get_all_instructor_groups_id() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT GROUPS.group_id FROM
                    `sn_school_group_managers` as GROUPS,
                    `sn_school_managers` as MANAGERS
                WHERE MANAGERS.manager_id = GROUPS.manager_id
                    AND MANAGERS.admin = FALSE
                    AND MANAGERS.instructor = TRUE
                    AND MANAGERS.manager_id = '%d'",
                $this->manager_id
                )
        );
        return $sql_result;
    }

    /**
     * Get all the student groups created by this manager
    */
    public function get_all_student_groups_created() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM
                    `sn_school_students_groups` as GROUPS,
                    `sn_school_managers` as MANAGERS
                WHERE MANAGERS.manager_id = GROUPS.manager_id
                    AND MANAGERS.manager_id = '%d'",
                $this->manager_id
                )
        );
        return $sql_result;
    }
}
