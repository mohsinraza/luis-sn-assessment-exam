/* jshint esversion: 8 */
var AppNclexReviewLectureSeriesPremium = new Vue({
  el: "#nclex-lecture-modules",
  data: {
      axiosHeaders: {headers: {'X-WP-Nonce':wpApiSettings.nonce}},
      fetching_data: false,
      errorMessage:'',
      successMessage:'',
      modules:[]
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
                    console.log(this.modules);
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
