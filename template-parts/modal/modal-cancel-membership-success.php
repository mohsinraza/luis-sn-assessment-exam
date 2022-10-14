   <!-- Modal -->
<div class="modal fade" id="modalCancelMembershipSuccess" tabindex="-1" aria-labelledby="modalCancelMembershipSuccess" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered text-center modal-xl">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Cancel Membership</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      
    
    <div class="modal-body col-12 col-lg-10 m-auto pt-5">
      <div class="">
          <!-- Heading -->
          <div class="row">
            <div class="col-12">
              <p>cancelReason: {{cancelReason}}<br/>
              cancelMembershipType: {{cancelMembershipType}}</p>
              <h2 class="h2-small text-center" tabindex="0">
                <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-check-green.svg" class="mr-2" alt="">
                Jennifer, your membership has been canceled.
              </h2>
              <div class="text-center font-size font-size--medium" style="margin-top: -32px; margin-bottom: 40px;">
                Check your email for more detail.
              </div>
            </div>
          </div>
          <!-- /Heading -->

          <!-- Message -->
          <div class="row mb-5">
            <div class="col-12 text-center font-size font-size--medium2">
              You can <strong><a href="#">repurchase a membership</a></strong> at any time.
              <br>
              In the meantime, enjoy your remaining access until December 12, 2022.
            </div>
          </div>
          <!-- /Message -->


          <!-- Buttons -->
          <div class="modal-footer form_bottom_buttons justify-content-center pt-4">
            <button role="button" class="btn btn-lg btn-outlined" href="#">
              Go to my dashboard
            </button>
          </div>
          <!-- /Buttons -->


        </div>
      </div>
    </div>
  </div>
</div>
