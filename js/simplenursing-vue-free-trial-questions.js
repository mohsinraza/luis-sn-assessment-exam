/* jshint esversion: 8 */
var AppFreeTrialQuestions = new Vue({
  el: "#free-trial-questions",
  data: {
      api: new SN_API(),
      schoolsList: snSchoolsList(),
      step: 1,
      fetching_data: false,
      errorMessage:'',
      successMessage:'',
      licensePursuing: [
          {id: "LVN_LPN",name: "LVN/LPN", class:"question_cards--square_big__card--lvn_lpn"},
          {id: "RN",name: "RN", class:"question_cards--square_big__card--rn"},
          {id: "NP",name: "NP", class:"question_cards--square_big__card question_cards--square_big__card--np"}
      ],
      classesCurrentlyTaking: [
          {id: "fundamentals",name: "Fundamentals", class:"fundamentals"},
          {id: "health_assessment",name: "Health Assessment", class: "health_assessment"},
          {id: "patho",name: "Patho", class:"patho"},
          {id: "pharmacology",name: "Pharmacology", class:"pharmacology"},
          {id: "med_surg",name: "Med Surg", class:"med_surg"},
          {id: "pediatrics_ob",name: "Pediatrics or OB", class:"pediatrics_or_ob"},
          {id: "critical_care",name: "Critical Care", class:"critical_care"},
          {id: "fluid_electrolytes",name: "Fluid & Electrolytes", class:"fluid_electrolytes"},
          {id: "abgs",name: "ABG's or OB", class:"abgs_or_ob"},
      ],
      becomingAmbassador: [
          {id: "absolutely",name: "Yes, sure! 😍"},
          {id: "no",name: "No 😞"}
      ],
      licensePursuingValue:'',
      classesCurrentlyTakingValue:'',
      becomingAmbassadorValue:'',
      attendingNursingSchool:'',
      whenGraduateMonth:'',
      whenGraduateYear:'',
      firstHearAbout:'',
      license:'',
      haveInstructors:'',
      allowClosing: false,
      detailsEmpty () {
          return (
              this.licensePursuingValue == "" ||
              this.classesCurrentlyTakingValue == "" ||
              this.becomingAmbassadorValue == "" ||
              this.whenGraduateMonth.trim() == "" ||
              this.whenGraduateYear.trim() == "" ||
              this.firstHearAbout.trim() == "" ||
              this.license.trim() == "" ||
              this.haveInstructors.trim() == "" ||
              this.attendingNursingSchool.trim() == ""
          );
        }
  },
  computed: {
       filteredList() {
             return this.schoolsList.filter(post => {
               return post.toLowerCase().includes(this.attendingNursingSchool.toLowerCase());
            });
        },
       whenGraduate() {
             return this.whenGraduateYear + " " + this.whenGraduateMonth;
        },
       firstHear() {
             return this.firstHearAbout;
        },
       whichLicense() {
             return this.license;
        },
    }, //computed
  mounted: function () {
      this.getOnboardingPage();
  },
  methods: {
      selectLicensePursuing: function(item) {
          this.licensePursuingValue=item.id;
          this.step=2;
          jQuery('.question-license-pursuing .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
      },
      selectClassesCurrentlyTaking: function(item) {
          this.classesCurrentlyTakingValue=item.id;
          this.step=3;
          jQuery('.question-classes-currently-taking .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
      },
      nextStep: function() {
        console.log("this.license: "+this.license);
        this.step++;
      },
      showNavigationTitle: function(n) {
          return 'Choose an option above: ' + n + '-' + this.step;
      },
      selectBecomingAmbassador: function(item) {
          this.becomingAmbassadorValue=item.id;
          this.step=5;
          jQuery('.question-becoming-ambassador .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
      },
      submitForm: function(event) {
          event.preventDefault();
          if (this.detailsEmpty()) {
              this.errorMessage = "Please answer all questions.";
              this.successMessage = "";
              this.fetching_data=false;
          } else {
              this.fetching_data=true;
              var answers={
                  "license_pursuing": this.licensePursuingValue,
                  "classes_currently_taking": this.classesCurrentlyTakingValue,
                  "becoming_ambassador": this.becomingAmbassadorValue,
                  "when_graduate": this.whenGraduate,
                  "first_hear": this.firstHear,
                  "license": this.whichLicense,
                  "have_instructors": this.haveInstructors,
                  "attending_nursing_school": this.attendingNursingSchool
              };
              this.api.updateFreeTrialQuestions(answers).then(
                  response => {
                          console.log(response.data);
                          if (response.data.status) {
                              this.successMessage = "Thanks for taking the time. That wasn't so bad, was it? Now, let's get to work!";
                              this.errorMessage = "";
                              setTimeout(function(){
                                  location.reload();
                              }, 2000);
                          } else {
                              this.successMessage= "";
                              this.errorMessage = response.data.msg;
                              this.fetching_data=false;
                          }
                  }
              );

          }
      },
      closeOnboardingQuestionaire: function() {
          this.api.closeOnboardingQuestionaire().then(
              response => {
                      console.log(response.data);
                      if (response.data.status) {
                          this.successMessage = "You can answer this later. Now, let's get to work!";
                          this.errorMessage = "";
                          setTimeout(function(){
                              location.href='/';
                          }, 1000);
                      } else {
                          this.successMessage= "";
                          this.errorMessage = response.data.msg;
                          this.fetching_data=false;
                      }
              }
          );
      },
      getOnboardingPage: function() {
          this.api.getOnboardingPage().then(
              response => {
                      console.log(response.data);
                      if (response.data.status) {
                          this.allowClosing = (response.data.user_login_count<=1);
                      } else {
                          this.errorMessage = response.data.msg;
                          this.fetching_data=false;
                      }
              }
          );
      },
      submitAnswers: function() {
              this.fetching_data=true;
              var answers={
                  "license_pursuing": this.licensePursuingValue,
                  "classes_currently_taking": this.classesCurrentlyTakingValue,
                  "becoming_ambassador": this.becomingAmbassadorValue,
                  "when_graduate": this.whenGraduate,
                  "first_hear": this.firstHear,
                  "license": this.whichLicense,
                  "have_instructors": this.haveInstructors,
                  "attending_nursing_school": this.attendingNursingSchool
              };
              console.log(answers);
              this.api.updateFreeTrialQuestions(answers).then(
                  response => {
                          console.log(response.data);
                          if (response.data.status) {
                              this.errorMessage = "";
                              setTimeout(function(){
                                  location.href='/';
                              }, 2000);
                          } else {
                              this.errorMessage = response.data.msg;
                              this.fetching_data=false;
                          }
                  }
              );


      },
      inputSchool: function(event) {
          jQuery('#input_nursing_school_typeahead').fadeIn();
      },
      selectSchool: function(school) {
          this.attendingNursingSchool = school;
          jQuery('#input_nursing_school_typeahead').fadeOut();
      }
  } //methods
});
