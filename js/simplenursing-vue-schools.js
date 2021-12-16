/* jshint esversion: 6 */

var AppStudentGroups = new Vue({
  el: "#app-schools",
  data: {
         currentUser: {
            is_school_admin: false,
            is_school_instructor: false,
            is_school_manager: false,
         },
         schoolsApi: new SN_API_SCHOOLS(),
         groupSortBy: 'school_id',
         groupSortDesc: false,
         checkedWizard: false,
         newGroupPopularSectionsSelected: null,
         newGroupPopularSections: [
             { value: null, text: 'Select a group' }
         ],
         selectMode: 'single',
         selectedGroup: [],
         fields: [
           { key: 'selectedGroup', sortable: false, class:'selected', label: '' },
           { key: 'school_id', sortable: true , label: 'ID' },
           { key: 'name', sortable: true },
           { key: 'premium', sortable: true },
           { key: 'nclex', sortable: true, label: 'NCLEX'  },
           { key: 'students_limit', sortable: true, label: 'Students Limit'  },
         ],
         items: [],
         newGroupName:"",
         groupNameToModal:"",
         permissionTreeVideo: Object,
         selectedPermissionSlugs:[],
         selectedPermissionSlugsFromAdmin:[],
  },
  computed: {

  },
  mounted: function () {
      // this.pageSchoolStudentGroups();
      this.getSchools();
  },
  methods: {
      // pageSchoolStudentGroups() {
      //     this.schoolsApi.pageSchoolStudentGroups().then(
      //         response => {
      //               console.log(response.data);
      //                 if (response.data.status) {
      //                     this.currentUser = response.data.current_user;
      //                 } else {
      //                     console.log(response.data.msg);
      //                 }
      //         }
      //     );
      // },
      getSchools() {
          this.schoolsApi.getSchools().then(
              response => {
                    console.log(response.data);
                      if (response.data.status) {
                          this.items = response.data.schools;
                      } else {
                          console.log(response.data.msg);
                      }
              }
          );
      },
      groupTableRowSelected(items) {
          if (items.length>0) {
              this.selectedGroup = items[0];
          } else {
              this.selectedGroup=[];
              this.studentsList=[];
          }
    },
    editGroupPermissionsOpenModal() {
        this.groupNameToModal = this.selectedGroup.name;
        this.permissionTreeVideo=Object;
        this.selectedPermissionSlugs=[];
        jQuery("#school-groups-permissions-modal").modal();
        this.schoolsApi.getVideoLibrarySlugTree().then(
            response => {
                console.log(response.data);
                if (response.data.status) {
                        let permissionTreeVideoTemp = response.data.permissions_tree;
                        this.schoolsApi.getSchoolPermissions(this.selectedGroup.school_id).then(
                            response => {
                                console.log(response.data);
                                if (response.data.status) {
                                        let selectedPermissionSlugsTemp=response.data.video_category_slugs;
                                        this.permissionTreeVideo = permissionTreeVideoTemp;
                                        this.selectedPermissionSlugs=selectedPermissionSlugsTemp;


                                    } else {
                                        console.log(response.data.msg);
                                    }
                            }
                        );
                    } else {
                        console.log(response.data.msg);
                    }
            }
        );
    },
    editGroupPermissions() {
        console.log(this.selectedPermissionSlugs);
        this.schoolsApi.updateSchoolsPermissions(this.selectedGroup.school_id, this.selectedPermissionSlugs).then(
            response => {
                  console.log(response.data);
                    if (response.data.status) {
                        jQuery("#school-groups-permissions-modal").modal('hide');
                    }
                }
        );
    },
    editStudyGuidesPermissionsOpenModal() {
        this.groupNameToModal = this.selectedGroup.name;
        this.permissionTreeVideo=Object;
        this.selectedPermissionSlugs=[];

        jQuery("#modal-groups-permissions-study-guides").modal();
        this.schoolsApi.getStudyGuidesLibrarySlugTree().then(
            response => {
                console.log(response.data);
                if (response.data.status) {
                        let permissionTreeVideoTemp = response.data.permissions_tree;
                        this.schoolsApi.getSchoolStudyGuidesPermissions(this.selectedGroup.school_id).then(
                            response => {
                                console.log(response.data);
                                if (response.data.status) {
                                        let selectedPermissionSlugsTemp=response.data.study_guides_category_slugs;
                                        this.permissionTreeVideo = permissionTreeVideoTemp;
                                        this.selectedPermissionSlugs=selectedPermissionSlugsTemp;
                                    } else {
                                        console.log(response.data.msg);
                                    }
                            }
                        );
                    } else {
                        console.log(response.data.msg);
                    }
            }
        );
    },
    editStudyGuidesGroupPermissions() {
        this.schoolsApi.updateSchoolStudyGuidesPermissions(this.selectedGroup.school_id, this.selectedPermissionSlugs).then(
            response => {
                  console.log(response.data);
                    if (response.data.status) {
                        jQuery("#modal-groups-permissions-study-guides").modal('hide');
                    }
                }
        );
    },
    editQuizBanksPermissionsOpenModal() {
        this.groupNameToModal = this.selectedGroup.name;
        this.permissionTreeVideo=Object;
        this.selectedPermissionSlugs=[];

        jQuery("#modal-groups-permissions-quiz-banks").modal();
        this.schoolsApi.getQuizBanksLibrarySlugTree().then(
            response => {
                console.log(response.data);
                if (response.data.status) {
                        let permissionTreeVideoTemp = response.data.permissions_tree;
                        this.schoolsApi.getSchoolQuizBanksPermissions(this.selectedGroup.school_id).then(
                            response => {
                                console.log(response.data);
                                if (response.data.status) {
                                        let selectedPermissionSlugsTemp=response.data.quiz_banks_category_slugs;
                                        this.permissionTreeVideo = permissionTreeVideoTemp;
                                        this.selectedPermissionSlugs=selectedPermissionSlugsTemp;

                                    } else {
                                        console.log(response.data.msg);
                                    }
                            }
                        );
                    } else {
                        console.log(response.data.msg);
                    }
            }
        );
    },
    editQuizBanksGroupPermissions() {
        this.schoolsApi.updateSchoolQuizBanksPermissions(this.selectedGroup.school_id, this.selectedPermissionSlugs).then(
            response => {
                  console.log(response.data);
                    if (response.data.status) {
                        jQuery("#modal-groups-permissions-quiz-banks").modal('hide');
                    }
                }
        );
    },
    getSchoolPopularGroups() {
        this.schoolsApi.getSchoolPopularGroups().then(
            response => {
                  console.log(response.data);
                  if (response.data.status) {
                      this.newGroupPopularSections = response.data.popular_groups;
                  }
                }
        );
    },
    restrictPermissionTree(tree, restrictionSlugs) {
            let restrictedTree=[];
            tree.forEach((item, i) => {
                if (restrictionSlugs.includes(item.slug)){
                    let restrictedCategory=[];
                    item.category_tree.forEach((item2, i2) => {
                        if (restrictionSlugs.includes(item2.slug)){
                            restrictedCategory.push(item2);
                        }
                    });

                    node = {
                        category_name: item.category_name,
                        slug: item.slug,
                        category_tree: restrictedCategory,
                    };
                    restrictedTree.push(node);

                }
            });

            return restrictedTree;
    },

    } //methods
});
