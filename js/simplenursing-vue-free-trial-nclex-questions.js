/* jshint esversion: 8 */
var AppFreeTrialNCLEXQuestions = new Vue({
  el: "#free-trial-questions",
  data: {
      api: new SN_API(),
      schoolsList: snSchoolsList(),
      step: 1,
      fetching_data: false,
      errorMessage:'',
      successMessage:'',
      whenPlanningExam: [
          {id: "30_day",name: "in 30 days", class: "plan30days"},
          {id: "1_3_months",name: "in 1-3 months", class: "plan13months"},
          {id: "3_6_months",name: "in 3-6 months", class: "plan36months"},
          {id: "6_more_months",name: "in 6 months +", class: "plan6months"},
      ],
      whichNclexWriting: [
          {id: "RN",name: "RN", class:"rn"},
          {id: "PN",name: "PN", class: "lpn"}
      ],
      howDidYouHear: [
          {id: "classmate_friend",name: "Classmate or friend", class: "classmate"},
          {id: "etsy",name: "Etsy", class:"etsy"},
          {id: "school",name: "School instructor or Admin", class:"instructor"},
          {id: "instagram_tiktok_facebook",name: "Instagram, Tiktok or Facebook", class:"social"},
          {id: "youtube",name: "Youtube", class:"youtube"},
      ],
      whenPlanningExamValue:'',
      whichNclexWritingValue:'',
      howDidYouHearValue:'',
      howDidYouHearOther:'',
      graduateNursingSchool:'',
      haveInstructors:'',
      allowClosing: false,
      whenGraduateMonth:'',
      whenGraduateYear:'',
      firstHearAbout:'',
      detailsEmpty () {
          return (
              this.whenPlanningExamValue == "" ||
              this.whichNclexWritingValue == "" ||
              this.howDidYouHearValue == "" ||
              this.firstHearAbout == "" ||
              this.graduateNursingSchool.trim() == ""
          );
        }
  },
  computed: {
       filteredList() {
         return this.schoolsList.filter(post => {
           return post.toLowerCase().includes(this.graduateNursingSchool.toLowerCase());
        });
        },
        whenGraduate() {
          return this.whenGraduateYear + " " + this.whenGraduateMonth;
        },
        firstHear() {
            return this.firstHearAbout;
       },
    }, //computed
  mounted: function () {
      this.getOnboardingPage();
  },
  methods: {
      nextStep: function() {
        this.step++;
      },
      showNavigationTitle: function(n) {
          return 'Choose an option above: ' + n + '-' + this.step;
      },
      selectWhenPlanningExam: function(item) {
          this.whenPlanningExamValue=item.id;
          this.nextStep();
          jQuery('.question-when-planning-exam .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
      },
      selectWhichNclexWriting: function(item) {
          this.whichNclexWritingValue=item.id;
          this.nextStep();
          jQuery('.question-which-nclex-writing .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
      },
      selectHowDidYouHear: function(item) {
          this.howDidYouHearValue=item.id;
          this.nextStep();
          jQuery('.question-how-did-you-hear .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
      },
      selectHowDidYouHearOther: function() {
            this.howDidYouHearValue='other';
      },
      inputHowDidYouHearOther: function() {
          this.nextStep();
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
                  "graduate_nursing_school": this.graduateNursingSchool,
                  "which_nclex_writing": this.whichNclexWritingValue,
                  "when_planning_exam": this.whenGraduate,
                  "how_did_you_hear": this.howDidYouHearValue,
                  "how_did_you_hear_other": this.howDidYouHearOther,
                  "first_hear": this.firstHear,
              };
              this.api.updateFreeTrialNCLEXQuestions(answers).then(
                  response => {
                          console.log(response.data);
                          if (response.data.status) {
                              this.successMessage = "Thanks for taking the time. That wasn't so bad, was it? Now, let's get to work!";
                              this.errorMessage = "";
                              setCookie('submitNursingGraduateForm', 'true', 999);
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
                  "graduate_nursing_school": this.graduateNursingSchool,
                  "which_nclex_writing": this.whichNclexWritingValue,
                  "when_planning_exam": this.whenGraduate,
                  "how_did_you_hear": this.howDidYouHearValue,
                  "how_did_you_hear_other": this.howDidYouHearOther,
                  "first_hear": this.firstHear,
              };
              console.log(answers);
              this.api.updateFreeTrialNCLEXQuestions(answers).then(
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
          this.graduateNursingSchool = school;
          jQuery('#input_nursing_school_typeahead').fadeOut();
      }
  }
});
