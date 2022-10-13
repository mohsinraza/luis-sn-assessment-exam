/* jshint esversion: 8 */

var App = new Vue({

  el: "#app-settings",
  data: {
      newPassword: '',
      errorMessage: '',
      successMessage: '',
      ccfullName: '',
      ccNumber:'',
      ccMonth: '',
      ccYear: '',
      ccCvv:'',
  },
  mounted: function () {

  },
  methods: {

    cancelUserPremiumWithReason(reason) {

        let headers = {headers: {'X-WP-Nonce':wpApiSettings.nonce}};
        let data = {
            "action": "cancel_premium_with_reason",
            "reason": reason
        };

        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    console.log(response.data);
                    if (response.data.status) {
                        jQuery("#cancelMembershipBraintreeModal").modal('hide');
                        showNotificationSuccess('Your membership was canceled successfully. Please wait while we update your subscription.');
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                    } else {
                        showNotificationError('There was an error canceling your subscription, please contact us.');
                    }
                })
                .catch(error => {

                });
         });
  },
    cancelUserNclexWithReason(reason) {

        let headers = {headers: {'X-WP-Nonce':wpApiSettings.nonce}};
        let data = {
            "action": "cancel_nclex_with_reason",
            "reason": reason
        };

        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    console.log(response.data);
                    if (response.data.status) {
                        jQuery("#cancelMembershipBraintreeModal").modal('hide');
                        showNotificationSuccess('Your membership was canceled successfully. Please wait while we update your subscription.');
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                    } else {
                        showNotificationError('There was an error canceling your subscription, please contact us.');
                    }
                })
                .catch(error => {

                });
         });
  },
  } //methods
});
