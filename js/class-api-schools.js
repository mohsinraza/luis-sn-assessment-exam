/* jshint esversion: 8 */

class SN_API_SCHOOLS {

    constructor() {
       this.axiosHeaders = {headers: {'X-WP-Nonce':wpApiSettings.nonce}};
    }

    getSchoolStudents(extraFilters) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_students",
           "filters": extraFilters
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolStudents ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolInstructors() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_instructors"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolInstructors ERROR:', error);
                   reject(error);
               });
        });
    }

    getStudentsFromGroup(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_students_from_group",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentsFromGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    getInstructorsFromGroup(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_instructors_from_group",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getInstructorsFromGroup ERROR:', error);
                   reject(error);
               });
        });
    }


    addStudentsToGroup(groupId, students) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "add_students_to_group",
           "group_id": groupId,
           "students": students
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('addStudentsToGroup ERROR:', error);
                   reject(error);
               });
        });
    }


    removeStudentsFromGroup(groupId, students) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "remove_students_from_group",
           "group_id": groupId,
           "students": students
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('removeStudentsFromGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    addInstructorsToGroup(groupId, instructors) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "add_instructors_to_group",
           "group_id": groupId,
           "instructors": instructors
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('addInstructorsToGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    removeInstructorsFromGroup(groupId, instructors) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "remove_instructors_from_group",
           "group_id": groupId,
           "instructors": instructors
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('removeInstructorsFromGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolStudentGroups() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_student_groups"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolStudentGroups ERROR:', error);
                   reject(error);
               });
        });
    }
    getSchoolInstructorGroups() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_instructor_groups"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolInstructorGroups ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchools() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_schools"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchools ERROR:', error);
                   reject(error);
               });
        });
    }

    createSchoolGroup(groupName) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "create_school_group",
           "group_name": groupName
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('createSchoolGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    deleteSchoolGroup(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "delete_school_group",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('deleteSchoolGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    renameSchoolGroup(groupId, newGroupName) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "rename_school_group",
           "group_id": groupId,
           "new_group_name": newGroupName
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('renameSchoolGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    createInstructorsGroup(groupName) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "create_instructors_group",
           "group_name": groupName
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('createInstructorsGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    deleteInstructorsGroup(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "delete_instructors_group",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('deleteInstructorsGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    renameInstructorsGroup(groupId, newGroupName) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "rename_instructors_group",
           "group_id": groupId,
           "new_group_name": newGroupName
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('renameInstructorsGroup ERROR:', error);
                   reject(error);
               });
        });
    }

    getVideoLibrarySlugTree() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_video_library_slug_tree"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getVideoPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getInstructorGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_instructor_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getInstructorGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }


    getManagerPermissions() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_manager_permissions",
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getManagerPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolPermissions(schoolId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_permissions",
           "school_id": schoolId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateInstructorsGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_instructors_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateInstructorsGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolsPermissions(schoolId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_permissions",
           "school_id": schoolId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolsPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolGroupInstructorRestrictions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_group_instructor_restrictions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolGroupInstructorRestrictions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolQuizBanksGroupInstructorRestrictions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_quiz_banks_group_instructor_restrictions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolQuizBanksGroupInstructorRestrictions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolStudyGuidesGroupInstructorRestrictions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_study_guides_group_instructor_restrictions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolStudyGuidesGroupInstructorRestrictions ERROR:', error);
                   reject(error);
               });
        });
    }

    getStudyGuidesLibrarySlugTree() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_study_guides_library_slug_tree"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudyGuidesLibrarySlugTree ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolStudyGuidesGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_study_guides_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolStudyGuidesGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getInstructorStudyGuidesGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_instructor_study_guides_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getInstructorStudyGuidesGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolStudyGuidesGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_study_guides_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolStudyGuidesGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateInstructorStudyGuidesGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_instructor_study_guides_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateInstructorStudyGuidesGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolStudyGuidesPermissions(schoolId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_study_guides_permissions",
           "school_id": schoolId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolStudyGuidesPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolStudyGuidesPermissions(schoolId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_study_guides_permissions",
           "school_id": schoolId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolStudyGuidesPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getQuizBanksLibrarySlugTree() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_quiz_banks_slug_tree"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getQuizBanksLibrarySlugTree ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolQuizBanksGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_quiz_banks_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolQuizBanksGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getInstructorQuizBanksGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_instructor_quiz_banks_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getInstructorQuizBanksGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolQuizBanksGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_quiz_banks_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolQuizBanksGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateInstructorQuizBanksGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_instructor_quiz_banks_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateInstructorQuizBanksGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolQuizBanksPermissions(schoolId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_quiz_banks_permissions",
           "school_id": schoolId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolQuizBanksPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolQuizBanksPermissions(schoolId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_quiz_banks_permissions",
           "school_id": schoolId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolQuizBanksPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    getNCLEXLibrarySlugTree() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_nclex_slug_tree"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getNCLEXLibrarySlugTree ERROR:', error);
                   reject(error);
               });
        });
    }

    getSchoolNCLEXGroupPermissions(groupId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_nclex_group_permissions",
           "group_id": groupId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolNCLEXGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateSchoolNCLEXGroupPermissions(groupId, slugs) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_school_nclex_group_permissions",
           "group_id": groupId,
           "slugs": slugs,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateSchoolNCLEXGroupPermissions ERROR:', error);
                   reject(error);
               });
        });
    }


    schoolReportQuizzesTaken(startDate, endDate) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "school_report_quizzes_taken",
           "start_date": startDate,
           "end_date": endDate,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('schoolReportQuizzesTaken ERROR:', error);
                   reject(error);
               });
        });
    }

    schoolReportNCLEXTaken(startDate, endDate) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "school_report_nclex_taken",
           "start_date": startDate,
           "end_date": endDate,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('schoolReportNCLEXTaken ERROR:', error);
                   reject(error);
               });
        });
    }

    schoolReportVideosWatched() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "school_report_videos_watched"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('schoolReportVideosWatched ERROR:', error);
                   reject(error);
               });
        });
    }

    schoolReportStudyGuidesDownloaded() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "school_report_study_guides_downloaded"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('schoolReportStudyGuidesDownloaded ERROR:', error);
                   reject(error);
               });
        });
    }

    async getStudentQuizBanksPerformance(schoolStudentId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_student_quiz_banks_performance",
           "school_student_id": schoolStudentId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentQuizBanksPerformance ERROR:', error);
                   reject(error);
               });
        });
    }

    async getStudentNCLEXPerformance(schoolStudentId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_student_nclex_performance",
           "school_student_id": schoolStudentId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentNCLEXPerformance ERROR:', error);
                   reject(error);
               });
        });
    }

    async getStudentStudyGuidesDownloaded(schoolStudentId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_student_study_guides_downloaded",
           "school_student_id": schoolStudentId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentStudyGuidesDownloaded ERROR:', error);
                   reject(error);
               });
        });
    }

    async getStudentVideosWatched(schoolStudentId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_student_videos_watched",
           "school_student_id": schoolStudentId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentVideosWatched ERROR:', error);
                   reject(error);
               });
        });
    }

    async getStudentVideosWatchedCount(schoolStudentId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_student_videos_watched_count",
           "school_student_id": schoolStudentId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentVideosWatchedCount ERROR:', error);
                   reject(error);
               });
        });
    }

    async getStudentGuidesDownloadedCount(schoolStudentId) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_student_guides_downloaded_count",
           "school_student_id": schoolStudentId
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getStudentGuidesDownloadedCount ERROR:', error);
                   reject(error);
               });
        });
    }

    activateStudents(students) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "activate_students",
           "students": students
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('activateStudents ERROR:', error);
                   reject(error);
               });
        });
    }

    deactivateStudents(students) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "deactivate_students",
           "students": students
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('deactivateStudents ERROR:', error);
                   reject(error);
               });
        });
    }

    activateInstructors(instructors) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "activate_instructors",
           "instructors": instructors
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('activateInstructors ERROR:', error);
                   reject(error);
               });
        });
    }

    deactivateInstructors(instructors) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "deactivate_instructors",
           "instructors": instructors
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('deactivateInstructors ERROR:', error);
                   reject(error);
               });
        });
    }

    pageSchoolStudentGroups() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "page_school_student_groups"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('pageSchoolStudentGroups ERROR:', error);
                   reject(error);
               });
        });
    }


    getSchoolPopularGroups() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_school_popular_groups"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getSchoolPopularGroups ERROR:', error);
                   reject(error);
               });
        });
    }

    getFullVideoLibrary() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_full_video_library"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getFullVideoLibrary ERROR:', error);
                   reject(error);
               });
        });
    }
    getManagerAssignments() {
       let headers = this.axiosHeaders;
       let data = {
           "action": "get_manager_assignments"
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('getManagerAssignments ERROR:', error);
                   reject(error);
               });
        });
    }

    createVideoAssignment(assignmentData) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "create_video_assignment",
           "data": assignmentData
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('createVideoAssignment ERROR:', error);
                   reject(error);
               });
        });
    }

    updateInstructorsGroupNCLEXPermissions(groupId, nclexAccess) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_instructors_group_nclex_permissions",
           "group_id": groupId,
           "nclex_access": nclexAccess,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateInstructorsGroupNCLEXPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

    updateStudentsGroupNCLEXPermissions(groupId, nclexAccess) {
       let headers = this.axiosHeaders;
       let data = {
           "action": "update_students_group_nclex_permissions",
           "group_id": groupId,
           "nclex_access": nclexAccess,
       };

       return new Promise(function(resolve, reject) {
           axios.post('/wp-json/simplenursing/v1/school-action', data, headers)
               .then(response => {
                   resolve(response);
               })
               .catch(error => {
                   console.log('updateStudentsGroupNCLEXPermissions ERROR:', error);
                   reject(error);
               });
        });
    }

}
