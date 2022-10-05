/* jshint esversion: 8 */
var AppFreeTrialQuestions = new Vue({
  el: "#nclex-lecture",
  data: {
      axiosHeaders: {headers: {'X-WP-Nonce':wpApiSettings.nonce}},
      fetching_data: false,
      errorMessage:'',
      successMessage:'',
  },
  computed: {

    }, //computed
  mounted: function () {
      this.getOnboardingPage("test");
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
      }
  } //methods
});
