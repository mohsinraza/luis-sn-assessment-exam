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
      cancelReason:'',
      cancelMembershipType:'',
  },
  mounted: function () {

  },
  methods: {
    onChange(event,membershipType) {
        var optionText = event.target.value;
        console.log(optionText);
        console.log(membershipType);
        this.cancelReason = optionText;
        this.cancelMembershipType = membershipType;

        if(membershipType==='nclex'){
            jQuery("#cancelNclexBtn").removeAttr('disabled');
        }else if(membershipType==='premium'){
            jQuery("#cancelPremiumBtn").removeAttr('disabled');
        }else{
            console.log('membershipType not defined');
        }
    },

    cancelUserPremiumWithReason(reason) {

        let headers = {headers: {'X-WP-Nonce':wpApiSettings.nonce}};
        let data = {
            "action": "cancel_premium_with_reason",
            "reason": this.cancelReason
        };

        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    console.log(response.data);
                    if (response.data.status) {
                        jQuery("#cancelMembershipBraintreeModal").modal('hide');
                        jQuery("#modalCancelMembershipSuccess").modal('show');
                        showNotificationSuccess('Your membership was canceled successfully. Please wait while we update your subscription.');
                        // setTimeout(function(){
                        //     location.reload();
                        // }, 5000);
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
            "reason": this.cancelReason
        };
        console.log(this.cancelReason);

        return new Promise(function(resolve, reject) {
            axios.post('/wp-json/simplenursing/v1/action_dev2', data, headers)
                .then(response => {
                    console.log(response.data);
                    if (response.data.status) {
                        jQuery("#cancelMembershipBraintreeModal").modal('hide');
                        jQuery("#modalCancelMembershipSuccess").modal('show');
                        showNotificationSuccess('Your membership was canceled successfully. Please wait while we update your subscription.');
                        // setTimeout(function(){
                        //     location.reload();
                        // }, 5000);
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
