/* jshint esversion: 8 */
var AppFreeTrialQuestions = new Vue({
  el: "#nclex-lecture",
  data: {
      axiosHeaders: {headers: {'X-WP-Nonce':wpApiSettings.nonce}},
      fetching_data: false,
      errorMessage:'',
      successMessage:'',
      modules:[],
      startLessonBtnTxt: '',
      startLessonBtnModuleId: 0,
  },
  computed: {

    }, //computed
  mounted: function () {
    //   this.getOnboardingPage("test");
      this.getAllModules();
    //   this.getAllVideosByModule(1);
  },
  methods: {
      getOnboardingPage(answers) {
         let headers = this.axiosHeaders;
         let data = {
             "action": "get_onboarding_page"
         };

         return new Promise(function(resolve, reject) {
             axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                 .then(response => {
                     console.log(response);
                 })
                 .catch(error => {
                     console.log('getOnboardingPage ERROR:', error);
                 });
          });
      },
      getAllModules(){
        let headers = this.axiosHeaders;
        let data = {
            "action": "get_all_modules"
        };

        let thisParent = this;
        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    thisParent.modules = response.data;
                    console.log("Axios response");
                    console.log(thisParent.modules);
                    console.log(thisParent.modules.length);
                    if(thisParent.modules.length > 0){
                        thisParent.modules.forEach((item,index) => {
                                console.log("index:"+index)
                                console.log("watch duration : module duration = " + item.module_watched_duration +' : '+ item.module_duration)

                                // if(index == 0 && (item.module_watched_duration == null || item.module_watched_duration == 0)){
                                //     thisParent.startLessonBtnTxt = "START DAY 1";
                                //     thisParent.startLessonBtnModuleId = item.module_id;

                                // }else 
                                if(thisParent.startLessonBtnTxt == '' && (item.module_watched_duration == null || item.module_watched_duration == 0)){
                                    thisParent.startLessonBtnTxt = "START " + item.module_day;
                                    thisParent.startLessonBtnModuleId = item.module_id;
                                    console.log("startLessonBtnTxt:"+thisParent.startLessonBtnTxt)

                                }else if(thisParent.startLessonBtnTxt == '' && item.module_watched_duration != null && parseInt(item.module_watched_duration) < parseInt(item.module_duration)){
                                    thisParent.startLessonBtnTxt = "CONTINUE " + item.module_day;
                                    thisParent.startLessonBtnModuleId = item.module_id;
                                    console.log("startLessonBtnTxt:"+thisParent.startLessonBtnTxt)

                                }else if(thisParent.startLessonBtnTxt == '' && item.module_watched_duration === item.module_duration && index == thisParent.modules.length-1){
                                        thisParent.startLessonBtnTxt = "RESTART "+ thisParent.modules[0].module_day;
                                        thisParent.startLessonBtnModuleId = thisParent.modules[0].module_id;
                                        console.log("startLessonBtnTxt:"+thisParent.startLessonBtnTxt)
                                        
                                }else{
                                    console.log('Start Lesson Button: condition was not matched');
                                }
                        });
                        
                    }
                })
                .catch(error => {
                    console.log('getAllModules ERROR:', error);
                });
         });
     },
     getAllVideosByModule(module_id){
        let headers = this.axiosHeaders;
        let data = {
            "action": "get_all_videos",
            "module_id": module_id,
        };

        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log('getAllModules ERROR:', error);
                });
         });
     }
  } //methods
});
