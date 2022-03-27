/* jshint esversion: 8 */

var App = new Vue({

  el: "#app-free-trial",
  data: {
      api: new SN_API(),
      error_message: '',
      password_error: true,
      error_message_password: '',
      fetching_data: false,
      email_address: '',
      first_name: '',
      last_name: '',
      password: '',
      membership_type: '',
      membership_plan: '',
      paymentURL: '',
      formSteps: 1,
      formStepsMax: 1,
      utm_source: '',
      utm_medium: '',
      utm_campaign: '',
      utm_term: '',
      utm_content: '',
      items: [
          // {id: "teas_free_trial",name: "TEAS"},
          {id: "nursing",name: "Nursing School Premium"},
          {id: "nclex",name: "NCLEX-RN<sup>®</sup>"},
          {id: "nclex_pn",name: "NCLEX-PN<sup>®</sup>"}
      ],
      details_empty () {
        return (
            this.email_address == "" ||
            this.first_name == "" ||
            this.last_name == "" ||
            this.membership_type == "" ||
            checkEmail(this.email_address) == false
        );
    }
  },
  mounted: function () {
      this.getUtmParameters();

      // step 1 of the form
        gtag('event', 'page_view', {
          page_title: 'FREE TRIAL: 1 Login Details',
          page_location: 'https://simplenursing.com/free-trial',
          page_path: 'free-trial/step1',
          send_to: 'UA-107677918-1'
      });
  },
  methods: {
      getUtmParameters: function() {
          let snUtm = getCookie('sn_utm');
          if(snUtm!=='') {
              var json = JSON.parse(snUtm);
              this.utm_source = json.utm_source;
              this.utm_medium = json.utm_medium;
              this.utm_campaign = json.utm_campaign;
              this.utm_term = json.utm_term;
              this.utm_content = json.utm_content;
          }

      },
      submitForm: function(event) {
          console.log('submitForm');
          event.preventDefault();
      },
      setFormStepsMax(membership) {
          this.formSteps = 1;
          if (membership=='premium_free_with_subscription') this.formStepsMax=4;
            else this.formStepsMax=3;
      },
      stepSelectMembershipType(item) {
          this.membership_type=item.id;
          this.setFormStepsMax(this.membership_type);
          this.formSteps++;
          jQuery('[step-ref="step1"] .box-options__item').removeClass('box-options__item--selected');
          jQuery('#'+item.id).addClass('box-options__item--selected');
          if (!isMobile()) {
            jQuery('#free-trial-header-short').fadeIn();
            jQuery('#free-trial-header').slideUp(500, function() {
              jQuery('[step-ref="step2"]').fadeIn(500);
            });
          } else {
            setTimeout(function() {
              jQuery('footer').fadeOut();
              jQuery('.free-trial-logo .logo1').hide();
              jQuery('.free-trial-logo .logo2').show();
              jQuery('body').css('background', '#fff');
              jQuery('[step-ref="step1"]').fadeOut(500);
              jQuery('#free-trial-header').slideUp(500, function() {
                jQuery('[step-ref="step2"]').fadeIn(500);
            });
            }, 400);
        }
      },
      selectPaymentPlan(plan) {
          this.membership_plan = plan;
          switch (plan) {
              case 'monthly':
                    this.paymentURL = 'https://payments.simplenursing.com/?add-to-cart=101052&currency=USD&free_trial=1';
                    break;
              case '1_year':
                    this.paymentURL = 'https://payments.simplenursing.com/?add-to-cart=102166&currency=USD&free_trial=1';
                    break;
              case '2_year':
                    this.paymentURL = 'https://payments.simplenursing.com/?add-to-cart=102167&currency=USD&free_trial=1';
                    break;
              default:
          }

          jQuery('[step-ref="step4"] .box-options__item').removeClass('box-options__item--selected');
          jQuery('#plan_'+plan).addClass('box-options__item--selected');
      },
      submitFiveDayTrial() {
          let emailEncoded = encodeURIComponent(this.email_address);
          let passwordEncoded = encodeURIComponent(this.password);
          this.createIsUser();
          // console.log(this.paymentURL);
          // add email
          // this.paymentURL+='&billing_email='+emailEncoded+'&sn_password='+passwordEncoded;
          // window.location.href = this.paymentURL;
      },
      async stepEnterInformation() {

          this.error_message = "";
          if(this.email_address == "" || this.first_name == "" || this.last_name == "" || this.membership_type == "" ){

              this.error_message = "Please enter all required details.";
          } else {

              let moveNextStep = true;
              this.fetching_data = true;
              if (this.membership_type=='premium_free_with_subscription') {
                  let premiumFreeTrialByEmailCountTemp = await this.api.premiumFreeTrialByEmailCount(this.email_address);

                  if (premiumFreeTrialByEmailCountTemp.data.count>0) {
                      this.error_message = "This email was already used for a Free Trial.";
                      moveNextStep = false;
                  }

              }

              if (moveNextStep) {
                  this.formSteps++;
                  this.error_message='';
                  jQuery('[step-ref="step1"]').fadeOut(500);
                  jQuery('[step-ref="step2"]').fadeOut(500, function () {
                    jQuery('[step-ref="step3"]').fadeIn();
                  });

                  // step 2 of the form
                  gtag('event', 'page_view', {
                      page_title: 'FREE TRIAL: 2 Password',
                      page_location: 'https://simplenursing.com/free-trial',
                      page_path: 'free-trial/step2',
                      send_to: 'UA-107677918-1'
                  });
              }
            this.fetching_data = false;
          }
      },
      stepCreatePassword() {

          this.password_error=true;
          if(this.password.trim() == "") {

              this.error_message_password = "Password cannot be empty.";

          } else if(this.password.trim().length < 6) {

                this.error_message_password = "Please enter at least 6 characters.";

            } else if(this.password.trim() == "123qweasD!") {

                this.error_message_password = "Wrong Password";

            } else {

              this.formSteps++;
              this.error_message_password = '';
              this.password_error=false;
              this.createIsUser();

          }
      },
      stepSelectMembershipPlan() {

          this.password_error=true;
          if(this.password.trim() == "") {

              this.error_message_password = "Password cannot be empty.";

          } else if(this.password.trim().length < 6) {

                this.error_message_password = "Please enter at least 6 characters.";

            } else {

              this.formSteps++;
              this.error_message_password = '';
              this.password_error=false;
              jQuery('[step-ref="step3"]').fadeOut(500, function () {
                jQuery('[step-ref="step4"]').fadeIn();
              });

              // step 1 of the form
                gtag('event', 'page_view', {
                  page_title: 'FREE TRIAL: 3 Select Membership Plan',
                  page_location: 'https://simplenursing.com/free-trial',
                  page_path: 'free-trial/step3',
                  send_to: 'UA-107677918-1'
              });

          }
      },
      createIsUser() {
          this.error_message = "";
          let accountData={
              "email_address": this.email_address,
              "first_name": this.first_name,
              "last_name": this.last_name,
              "password": this.password,
              "membership_type": this.membership_type,
              "membership_plan": this.membership_plan,
              "utm_source": this.utm_source,
              "utm_medium": this.utm_medium,
              "utm_campaign": this.utm_campaign,
              "utm_term": this.utm_term,
              "utm_content": this.utm_content
          };
          this.fetching_data=true;
          // form was submited
            gtag('event', 'page_view', {
              page_title: 'FREE TRIAL SUBMISSION: ' + this.membership_type,
              page_location: 'https://simplenursing.com/free-trial/'+this.membership_type,
              page_path: 'free-trial/submission/' + this.membership_type,
              send_to: 'UA-107677918-1'
          });
          this.api.createIsUser(accountData).then(
            response => {
                console.log(response.data);
                if (response.data.status) {
                    let emailEncoded = encodeURIComponent(this.email_address);
                    let passwordEncoded = encodeURIComponent(this.password);
                    let contactStatus = response.data.contact_status;

                    if (this.membership_type=="premium_free_with_subscription") {

                        // Add the email to the database (moved to payments)
                        // this.api.premiumFreeTrialByEmailInsert(this.email_address);

                        this.paymentURL+='&billing_email='+emailEncoded+'&sn_password='+passwordEncoded;
                        window.location.href = this.paymentURL;
                    } else {
                        window.location.href = 'https://members.simplenursing.com/phone-verification/?action=login&email='+emailEncoded+'&password='+passwordEncoded+'&status='+contactStatus;
                    }

                } else {
                    this.error_message=response.data.msg;
                    this.fetching_data=false;
                }

            }
        );
      }
  } // methods
});
