<!-- Bottom Navigation like NCLEX -->
<div class="question_form__nav container">
    <div class="bottom_nav fixed-bottom">
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

            <div class="col-6">
              <b-button 
                variant="primary" 
                class="float-right" 
                v-bind:class="{ 'btn-primary': selectedAnswer, 'btn-disabled': !selectedAnswer }"
                v-on:click="submitAnswer()"
                href="javascript:void(0)"
                id="answer_btn"
                >
                Next <i class="fa fa-arrow-right" aria-hidden="true"></i> 
              </b-button> 

              <b-button 
                variant="primary" 
                class="float-right" 
                v-if="questionIndex >= examQuantity - 1"
                v-on:click="viewResultsForm()"
                href="javascript:void(0)"
                style="display: none;"
                id="next_btn"
                >
                View Results <i class="fa fa-poll" aria-hidden="true"></i> 
              </b-button>
            </div>
            
          </div>
        </div> <!-- Bottom Nav -->
  </div>
<!-- /question_form__nav -->
