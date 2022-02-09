<!-- Bottom Navigation like NCLEX -->
<div class="question_form__nav container">
    <div class="bottom_nav fixed-bottom">
        <div class="row row1">
            <div class="col-5">
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
              
              <b-button 
                class="mr-2 float-left"
                variant="primary"
                href="#" onclick="return false;"
                data-toggle="modal"
                data-target="#pauseQuizModal"
                >
                  <i class="fa fa-coffee" aria-hidden="true"></i> Take Break
              </b-button>  
            </div>

            <div class="col-2">
              <span class="d-block text-center">Questions: {{questionIndex + 1}}/{{examQuantity}}</span>
            </div>
            <div class="col-5">
              <!-- Next/Submit Button  -->
              <b-button v-if="selectedAnswer"
                variant="primary" 
                class="float-right" 
                v-bind:class="{ 'd-none': questionIndex >= examQuantity - 1}"
                v-on:click="submitAnswer()"
                href="javascript:void(0)"
                id="answer_btn"
                >
                Next <i class="fa fa-arrow-right" aria-hidden="true"></i> 
              </b-button> 

              <!-- Skip Button with Model -->
              <b-button v-else
                id="skip_btn"
                variant="primary" 
                class="float-right" 
                v-bind:class="{ 'd-none': questionIndex >= examQuantity - 1}"
                v-on:click="skipAnswer(true)"
                href="javascript:void(0)"
                >
                Skip <i class="fa fa-arrow-right" aria-hidden="true"></i> 
              </b-button> 

              <!-- View results after last question answered -->
              <b-button 
                variant="primary" 
                class="float-right" 
                v-if="questionIndex >= examQuantity - 1"
                v-on:click="viewResultsForm()"
                href="javascript:void(0)"
                id="next_btn"
                >
                View Results <i class="fa fa-poll" aria-hidden="true"></i> 
              </b-button>
            </div>
            
          </div>
        </div> <!-- Bottom Nav -->
  </div>
<!-- /question_form__nav -->
