/* jshint esversion: 8 */
var AppFreeTrialQuestions = new Vue({
  el: "#nclex-lecture",
  data: {
      axiosHeaders: {headers: {'X-WP-Nonce':wpApiSettings.nonce}},
      fetching_data: false,
      errorMessage:'',
      successMessage:'',
      modules:[
        {
            "module_id": "1",
            "module_day": "Day 1",
            "module_title": "Cras finibus sit amet erat quis",
            "module_summary": "Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.                         Sed nec purus posuere, pharetra dui eget, rhoncus turpis.                         Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.",
            "module_thumbnail": "/images/dashboard/_placeholder-lecture-series-5.jpg",
            "module_videos": "2",
            "module_duration": "171040",
            "module_watched_duration": "171040"
        },
        {
            "module_id": "2",
            "module_day": "Day 2",
            "module_title": "Cras finibus sit amet erat quis",
            "module_summary": "Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.                         Sed nec purus posuere, pharetra dui eget, rhoncus turpis.                         Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.",
            "module_thumbnail": "/images/dashboard/_placeholder-lecture-series-6.jpg",
            "module_videos": "1",
            "module_duration": "80920",
            "module_watched_duration": null
        }
    ]
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

        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    this.modules = response.data;
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
