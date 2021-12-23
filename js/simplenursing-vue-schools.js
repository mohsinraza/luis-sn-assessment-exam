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
           { key: 'start_date', sortable: true, label: 'Start Date'  },
           { key: 'end_date', sortable: true, label: 'End Date'  },
           { key: 'students_limit', sortable: true, label: 'Students Limit'  },
           { key: 'actionsSelectedGroup', sortable: false, class:'selected', label: '' },
        ],
         items: [],
         newGroupName:"",
         groupNameToModal:"",
         permissionTreeVideo: Object,
         selectedPermissionSlugs:[],
         selectedPermissionSlugsFromAdmin:[],

         schoolId: '',
         schoolName: '',
         premium: 0,
         nclex: 0,
         studentsLimit: '',
         startDate: '',
         endDate: '',
         schoolLogo: '',

         schoolIdState: null,
         schoolNameState: null,
         premiumState: 1,
         nclexState: 1,
         studentsLimitState: null,
         startDateState: null,
         endDateState: null,
         schoolLogoState: null,
         options: [
          { text: 'True', value: 1 },
          { text: 'False', value: 0 }
         ]
  },
  computed: {
    
  },
  mounted: function () {
      // this.pageSchoolStudentGroups();
    //   var randomNum = Math.floor(Math.random() * 10) + 1;
    //   this.createSchool('sn test mohsin ' + randomNum,1,1,100);
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
      createSchool(name,premium,nclex,students_limit,start_date,end_date) { 
        this.schoolsApi.createSchool(name,premium,nclex,students_limit,start_date,end_date).then(
            response => {
                if (response.data.status) {
                        console.log("Added School #: "+response.data.school_id);
                        this.getSchools()
                    } else {
                        console.log(response.data.msg);
                    }
            }
        );
    },
    updateSchool(school_id,name,premium,nclex,students_limit,start_date,end_date) { 
        this.schoolsApi.updateSchool(school_id,name,premium,nclex,students_limit,start_date,end_date).then(
            response => {
                  console.log(response.data);
                    if (response.data.status) {
                        console.log("Updated School: "+ response.data.updated)
                        this.getSchools()
                    } else {
                        console.log(response.data.msg);
                    }
            }
        );
    },
      groupTableRowSelected(items) {
          if (items.length>0) {
              this.selectedGroup = items[0];
              this.handleEdit(this.selectedGroup)
          } else {
              this.selectedGroup=[];
              this.studentsList=[];
          }
    },
    clearSelected() {
        this.$refs.groupTable.clearSelected()
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

    //Script for add new school
    checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.schoolNameState = valid
        this.premiumState = valid
        this.nclexState = valid
        this.studentsLimitState = valid
        this.startDateState = valid
        this.endDateState = valid
        return valid
    },
    resetModal() {
        this.schoolId = ''
        this.schoolName = ''
        this.premium = 0
        this.nclex = 0
        this.studentsLimit = ''
        this.startDate = ''
        this.endDate = ''
        this.schoolLogo = ''

        this.schoolIdState = null
        this.schoolNameState = null
        this.premiumState = null
        this.nclexState = null
        this.studentsLimitState = null
        this.startDateState = null
        this.endDateState = null
        this.schoolLogoState = null

        this.clearSelected()
    },
    handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
    },
    handleEdit(item) {
        console.log(item.name)
        this.schoolName = item.name
        this.premium = item.premium
        this.nclex = item.nclex
        this.studentsLimit = item.students_limit

        this.schoolNameState = item.name
        this.premiumState = item.premium
        this.nclexState = item.nclex
        this.studentsLimitState = item.students_limit
    },
    handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
        return
        }
        console.log("schoolId: "+this.selectedGroup.school_id)
        console.log(this.schoolName)
        console.log(this.premium)
        console.log(this.nclex)
        console.log(this.studentsLimit)
        console.log(this.startDate)
        console.log(this.endDate)
        console.log(this.schoolLogo)

        if(this.selectedGroup.school_id>0){
            console.log('updating....')
            this.updateSchool(this.selectedGroup.school_id,this.schoolName,this.premium,this.nclex,this.studentsLimit,this.startDate,this.endDate)
        }else{
            console.log('creating....')
            this.createSchool(this.schoolName,this.premium,this.nclex,this.studentsLimit,this.startDate,this.endDate)
        }
        // Hide the modal manually
        this.$nextTick(() => {
            this.$bvModal.hide('modal-create-school')
        })
    }

    } //methods
});
