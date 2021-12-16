<?php
/*
 * School Students Groups from the Schools database
*/

class SN_School_Students_Group {
    public $group_id;
    public $school_id;
    public $group_name;
    public $nclex_access;

    function __construct($group_id) {
        $this->group_id = $group_id;
        $this->set_school_group_data();
    }

    private function set_school_group_data() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `sn_school_students_groups` WHERE group_id = %d",
                $this->group_id
                )
        );
        $this->school_id = $sql_result->school_id;
        $this->group_name = $sql_result->group_name;
        $this->nclex_access = ($sql_result->nclex_access=='1'?true:false);
    }

    public function add_students_to_group($students) {
        global $wpdb;

        $table = 'sn_school_group_students';

        $total_inserted = 0;
        $total_not_inserted = 0;
        foreach ($students as $student) {
            $data = array('group_id' => $this->group_id, 'student_id' => $student['student_id']);
            $format = array('%d','%d');
            $insert_result = $wpdb->insert($table, $data, $format);

            if ($insert_result) $total_inserted += 1;
                else $total_not_inserted += 1;
        }

        return array(
            'total_inserted'=> $total_inserted,
            'total_not_inserted'=> $total_not_inserted
        );
    }

    public function remove_students_from_group($students) {
        global $wpdb;

        $table = 'sn_school_group_students';

        $total_deleted = 0;
        $total_not_deleted = 0;
        foreach ($students as $student) {
            $data = array('group_id' => $this->group_id, 'student_id' => $student['student_id']);
            $format = array('%d','%d');
            $delete_result = $wpdb->delete( $table, $data, $format );

            if ($delete_result) $total_deleted += 1;
                else $total_not_deleted += 1;
        }

        return array(
            'total_deleted'=> $total_deleted,
            'total_not_deleted'=> $total_not_deleted
        );
    }


        public function add_instructors_to_group($instructors) {
            global $wpdb;

            $table = 'sn_school_group_managers';

            $total_inserted = 0;
            $total_not_inserted = 0;
            foreach ($instructors as $instructor) {
                $data = array('group_id' => $this->group_id, 'manager_id' => $instructor['manager_id']);
                $format = array('%d','%d');
                $insert_result = $wpdb->insert($table, $data, $format);

                if ($insert_result) $total_inserted += 1;
                    else $total_not_inserted += 1;
            }

            return array(
                'total_inserted'=> $total_inserted,
                'total_not_inserted'=> $total_not_inserted
            );
        }

        public function remove_instructors_from_group($instructors) {
            global $wpdb;

            $table = 'sn_school_group_managers';

            $total_deleted = 0;
            $total_not_deleted = 0;
            foreach ($instructors as $instructor) {
                $data = array('group_id' => $this->group_id, 'manager_id' => $instructor['manager_id']);
                $format = array('%d','%d');
                $delete_result = $wpdb->delete( $table, $data, $format );

                if ($delete_result) $total_deleted += 1;
                    else $total_not_deleted += 1;
            }

            return array(
                'total_deleted'=> $total_deleted,
                'total_not_deleted'=> $total_not_deleted
            );
        }

    /*
    * Store the video permission slugs for the group
    * $video_category_slugs array of slugs
    */
    public function update_group_permissions($video_category_slugs) {
        global $wpdb;


        // delete if record exists
        $table = 'sn_school_students_group_access_video';
        $data = array('group_id' => $this->group_id);
        $format = array('%d');
        $delete_result = $wpdb->delete( $table, $data, $format );

        $video_category_slugs_encoded = json_encode($video_category_slugs);

        $data = array(
            'group_id' => $this->group_id,
            'video_category_slugs'=>$video_category_slugs_encoded
        );
        $format = array('%d', '%s');
        $insert_result = $wpdb->insert( $table, $data, $format );

        return array(
            'delete_result' =>$delete_result,
            'insert_result' =>$insert_result
            );
    }

    /*
    * Store the video permission restriction from instructor slugs for the group
    * $video_category_slugs array of slugs
    */
    public function update_group_instructor_restrictions($video_category_slugs) {
        global $wpdb;

        $table = 'sn_school_students_group_access_video';
        $video_category_slugs_encoded = json_encode($video_category_slugs);

        $data = array('instructor_restriction_slugs' => $video_category_slugs_encoded);
        $where= array('group_id' => $this->group_id);
        $format = array('%s');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }
    /*
    * Store the qb permission restriction from instructor slugs for the group
    * $video_category_slugs array of slugs
    */
    public function update_group_instructor_restrictions_quiz_banks($video_category_slugs) {
        global $wpdb;

        $table = 'sn_school_students_group_access_quiz_banks';
        $video_category_slugs_encoded = json_encode($video_category_slugs);

        $data = array('instructor_restriction_slugs' => $video_category_slugs_encoded);
        $where= array('group_id' => $this->group_id);
        $format = array('%s');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }
    /*
    * Store the guides permission restriction from instructor slugs for the group
    * $video_category_slugs array of slugs
    */
    public function update_group_instructor_restrictions_study_guides($video_category_slugs) {
        global $wpdb;

        $table = 'sn_school_students_group_access_study_guides';
        $video_category_slugs_encoded = json_encode($video_category_slugs);

        $data = array('instructor_restriction_slugs' => $video_category_slugs_encoded);
        $where= array('group_id' => $this->group_id);
        $format = array('%s');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }

    /* Get the group video permissions */
    public function get_group_permissions() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `sn_school_students_group_access_video` WHERE group_id = %d",
                $this->group_id
                )
        );


        $group_permissions = array(
            'video_category_slugs' => [],
            'instructor_restriction_slugs' => [],
        );

        //empty array if no group permissions yet
        if (is_null($sql_result)) return $group_permissions;

        $group_permissions = array(
            'video_category_slugs' => json_decode($sql_result->video_category_slugs),
            'instructor_restriction_slugs' => json_decode($sql_result->instructor_restriction_slugs),
        );

        return $group_permissions;
    }

    /* Get the group video permissions */
    public function get_group_permissions_study_guides() {
        global $wpdb;
        $sql_result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM `sn_school_students_group_access_study_guides` WHERE group_id = %d",
                $this->group_id
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


    /*
    * Store the study guides permission slugs for the group
    * $study_guides_category_slugs array of slugs
    */
    public function update_group_permissions_study_guides($study_guides_category_slugs) {
        global $wpdb;


        // delete if record exists
        $table = 'sn_school_students_group_access_study_guides';
        $data = array('group_id' => $this->group_id);
        $format = array('%d');
        $delete_result = $wpdb->delete( $table, $data, $format );

        $study_guides_category_slugs_encoded = json_encode($study_guides_category_slugs);

        $data = array(
            'group_id' => $this->group_id,
            'study_guides_category_slugs'=>$study_guides_category_slugs_encoded
        );
        $format = array('%d', '%s');
        $insert_result = $wpdb->insert( $table, $data, $format );

        return array(
            'delete_result' =>$delete_result,
            'insert_result' =>$insert_result
            );
    }

        /* Get the group quiz banks permissions */
        public function get_group_permissions_quiz_banks() {
            global $wpdb;
            $sql_result = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM `sn_school_students_group_access_quiz_banks` WHERE group_id = %d",
                    $this->group_id
                    )
            );

            $group_permissions = array(
                'qb_slugs' => [],
                'instructor_restriction_slugs' => [],
            );

            //empty array if no group permissions yet
            if (is_null($sql_result)) return $group_permissions;

            $group_permissions = array(
                'qb_slugs' => json_decode($sql_result->qb_slugs),
                'instructor_restriction_slugs' => json_decode($sql_result->instructor_restriction_slugs),
            );

            return $group_permissions;
        }

        /*
        * Store the quiz banks permission slugs for the group
        * $qb_slugs array of slugs
        */
        public function update_group_permissions_quiz_banks($qb_slugs) {
            global $wpdb;

            // delete if record exists
            $table = 'sn_school_students_group_access_quiz_banks';
            $data = array('group_id' => $this->group_id);
            $format = array('%d');
            $delete_result = $wpdb->delete( $table, $data, $format );

            $qb_slugs_encoded = json_encode($qb_slugs);

            $data = array(
                'group_id' => $this->group_id,
                'qb_slugs'=>$qb_slugs_encoded
            );
            $format = array('%d', '%s');
            $insert_result = $wpdb->insert( $table, $data, $format );

            return array(
                'delete_result' =>$delete_result,
                'insert_result' =>$insert_result
                );
        }


    /*
    * Update the nclex access to this group
    */
    public function update_students_group_nclex_permissions($nclex_access) {
        global $wpdb;

        $table = 'sn_school_students_groups';

        $data = array('nclex_access' => $nclex_access);
        $where= array('group_id' => $this->group_id);
        $format = array('%d');
        $where_format = array('%d');
        $update_result = $wpdb->update($table, $data, $where, $format, $where_format);

        return $update_result;
    }

}
