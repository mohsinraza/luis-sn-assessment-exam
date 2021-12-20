<?php
/*
 * Schools
*/

class SN_Schools {

    function __construct() {

    }

    /**
     * Find if a student exists on any school by email
     * @return (SN_School | boolean) false if doesn't exist
     */
    public function get_student_school($student_email) {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM sn_school_students WHERE email = '%s'",
                $student_email
                )
        );

        // Didn't find the student in any school
        if (is_null($sql_result )) return false;

        // get the school ID
        $student_school_id = $sql_result->school_id;
        // get school
        $school= new SN_School($student_school_id);

        return $school;
    }


        /**
         * Get a student from database
         * @return (SN_School_Student | boolean) false if doesn't exist
         */
        public function get_student_by_email($student_email) {
            global $wpdb;
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_school_students WHERE email = '%s'",
                    $student_email
                    )
            );

            // Didn't find the student in any school
            if (is_null($sql_result )) return false;

            // get the student ID
            $student_id = $sql_result->student_id;
            // get student
            $student= new SN_School_Student($student_id);

            return $student;
        }

        /**
         * Find if a manager exists on any school by email
         * @return (SN_School | boolean) false if doesn't exist
         */
        public function get_manager_school($manager_email) {
            global $wpdb;
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_school_managers WHERE email = '%s'",
                    $manager_email
                    )
            );

            // Didn't find the manager in any school
            if (is_null($sql_result )) return false;

            // get the school ID
            $manager_school_id = $sql_result->school_id;
            // get school
            $school= new SN_School($manager_school_id);

            return $school;
        }


        /**
         * Get a manager from database (admin or instructor)
         * @return (SN_School_Manager | boolean) false if doesn't exist
         */
        public function get_manager_by_email($manager_email) {
            global $wpdb;
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_school_managers WHERE email = '%s'",
                    $manager_email
                    )
            );

            // Didn't find the manager in any school
            if (is_null($sql_result )) return false;

            // get the manager ID
            $manager_id = $sql_result->manager_id;
            // get manager
            $manager= new SN_School_Manager($manager_id);

            return $manager;
        }

        /**
         * Get an instructor manager from database
         * @return (SN_School_Manager | boolean) false if doesn't exist
         */
        public function get_instructor_by_email($manager_email) {
            global $wpdb;
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_school_managers WHERE email = '%s' AND instructor = 1",
                    $manager_email
                    )
            );

            // Didn't find the manager in any school
            if (is_null($sql_result )) return false;

            // get the manager ID
            $manager_id = $sql_result->manager_id;
            // get manager
            $manager= new SN_School_Manager($manager_id);

            return $manager;
        }

    /**
     * Get a list of all schools IDs
     * @return (array) Array of all school IDs
     */
    public function get_all_schools_id() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            "SELECT school_id FROM sn_schools ORDER BY school_id"
        );

        $schools_ids=[];
        foreach ($sql_result as $result) {
            $schools_ids[] = intval($result->school_id);
        }

        return $schools_ids;
    }

    /**
     * Get a list of all schools
     * @return (array) Array of all school
     */
    public function get_all_schools() {
        global $wpdb;
        $sql_result = $wpdb->get_results(
            "SELECT * FROM sn_schools ORDER BY school_id"
        );

        return $sql_result;
    }


    /* Create New School */
    public function create_new_school($name, $premium, $nclex, $students_limit) {
        global $wpdb;
        $new_group_id=0;

        $table = 'sn_schools';

        $data = array('name' => $name, 'premium' => $premium, 'nclex' => $nclex, 'students_limit' => $students_limit,'start_date' => '2021-11-21','end_date'=>'2030-11-21');
        $format = array('%s','%d','%d','%d','%s','%s');
        $inserted = $wpdb->insert($table, $data, $format);
        $school_id = $wpdb->insert_id;

        if ($inserted==1) {
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM sn_schools WHERE school_id = %d ",
                        $school_id
                    )
            );

            if (!is_null($sql_result)) $new_school_id=$sql_result->school_id;
        }


        return $school_id;
    }
}
