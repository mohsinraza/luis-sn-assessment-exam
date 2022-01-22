<!-- question_form__nav -->
<div class="question_form__nav container">
  <a id="prev_bnt"
      v-on:click="previousQuestion()"
      v-if="questionIndex>0"
      role="button"
      class="btn btn-secondary question_form__nav__prev_btn"
      href="javascript:void(0)"
      >
    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-back.svg" alt="" class="mr-1" style="vertical-align: middle">
    <span class="d-md-inline-block d-none">Prev</span>
  </a>
  <a id="answer_btn"
      v-bind:class="{ 'btn-primary': selectedAnswer, 'btn-disabled': !selectedAnswer }"
      v-on:click="submitAnswer()"
      role="button"
      class="btn"
      href="javascript:void(0)"
  >
    Submit
  </a>
  <a id="skip_btn"
      v-if="questionIndex < examQuantity - 1"
      v-on:click="skipAnswer()"
      role="button"
      class="btn btn-secondary question_form__nav__next_btn"
      href="javascript:void(0)"
      >
    <span class="d-md-inline-block d-none">Skip</span>
    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-next.svg" alt="" class="ml-1" style="vertical-align: middle;">
  </a>

  <a id="next_btn"
      v-if="questionIndex < examQuantity - 1"
      v-on:click="nextQuestion()"
      role="button"
      class="btn btn-highlighted"
      href="javascript:void(0)"
      style="display: none;"
  >
    Next
  </a>
  <a id="next_btn"
      v-if="questionIndex >= examQuantity - 1"
      v-on:click="viewResultsForm()"
      role="button"
      class="btn btn-highlighted"
      href="javascript:void(0)"
      style="display: none;"
  >
    View Results
  </a>

  <div class="bottom_nav">
        <div class="row row1">
            <div class="col-6">
              <b-button 
                class="mr-2 float-left"
                variant="primary" 
                href="#" onclick="return false;"
                data-toggle="modal"
                data-target="#closeQuizModal"
              >
                <i class="fa fa-sign-out-alt" aria-hidden="true"></i> End
              </b-button> 
              
              <b-button class="mr-2 float-left"variant="primary"><i class="fa fa-pause-circle" aria-hidden="true"></i> Suspend</b-button>  
            </div>

            <div class="col-6">
              <b-button 
                variant="primary" 
                class="float-right" 
                v-if="questionIndex < examQuantity - 1"
                v-on:click="nextQuestion()"
                href="javascript:void(0)"
              >
                Next <i class="fa fa-arrow-right" aria-hidden="true"></i> 
              </b-button> 
            </div>
        </div>
      </div>
</div>
<!-- /question_form__nav -->
