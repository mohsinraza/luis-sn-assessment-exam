   <!-- Modal -->
<div class="modal fade" id="modalCancelPremiumMembership" tabindex="-1" aria-labelledby="modalCancelPremiumMembership" aria-hidden="true">
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
              <h2 class="h2-small text-md-center text-left" tabindex="0">
                Jennifer, we are sorry you're thinking of canceling your membership.
                <br class="d-md-block d-none">
                Which of these best describes your reason for canceling?
              </h2>
          <!-- /Heading -->

          <!-- Reasons -->
          <div id="reasonCheckboxes" class="form_checkbox_special row justify-content-center text-left">
            <div class="col-md-6 col-12">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="premiumCancel" @change="onChange($event,'premium')" value="option1">
                <label class="form-check-label">I graduated from nursing school.</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="premiumCancel" @change="onChange($event,'premium')" value="option2">
                <label class="form-check-label">I'm no longer in nursing school.</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="premiumCancel" @change="onChange($event,'premium')" value="option3">
                <label class="form-check-label">I'm still in nursing school, but I no longer need SimpleNursing.</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="premiumCancel" @change="onChange($event,'premium')" value="option4">
                <label class="form-check-label">SimpleNursing did not meet my expectations.</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="premiumCancel" @change="onChange($event,'premium')" value="option4">
                <label class="form-check-label">I can't afford my SimpleNursing membership.</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="premiumCancel" @change="onChange($event,'premium')" value="option4">
                <label class="form-check-label">I chose a different nursing school study resource.</label>
              </div>
            </div>
          </div>
          <!-- /Reasons -->


          <!-- Buttons -->
          <div class="modal-footer form_bottom_buttons justify-content-center pt-4">
            <button role="button" class="btn btn-lg btn-outlined" href="#">
              Do not cancel my membership
            </button>
            <!-- <button id="cancelBtn" role="button" class="btn btn-lg btn-black" href="#" onclick="location.href='dashboard_cancel_phase1_2.html'" disabled="disabled"> -->
            <button id="cancelPremiumBtn" role="button" class="btn btn-lg btn-black" href="#modalCancelMembershipSuccess" data-toggle="modal" disabled="disabled">
              Cancel my membership
            </button>
          </div>
          <!-- /Buttons -->
        </div>
      </div>
    </div>
  </div>
</div>
