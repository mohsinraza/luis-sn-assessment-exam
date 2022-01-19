<div id="question_result" v-if="viewResults">
    <!-- question_form__question -->
    <div class="question_form__question">
        You've finished! Here are your results.
    </div>
    <!-- /question_form__question -->

   <div class="container">
       <div class="row align-items-center">
           <!-- card_performance_review__chart -->
           <div class="col-lg-4 card_performance_review__chart_content__chart quiz_questions">

             <div
                 class="progress-circle"
                 v-bind:class="[progressCircleClass]"
             >
                 <span>
                 <div class="card_performance_review__chart_content__chart__number">{{(performance.user.success_ratio*100).toFixed(0)}}%</div>
                 <div class="card_performance_review__chart_content__chart__success">{{performance.user.correct_answers}}/{{performance.user.total_answers}}</div>
             </span>
         </div>

             <div v-if="performance.above" class="card_performance_review__chart_content__chart__average card_performance_review__chart_content__chart__average--above">
               Above avg.
             </div>
             <div v-if="!performance.above" class="card_performance_review__chart_content__chart__average card_performance_review__chart_content__chart__average--below">
               Below avg.
             </div>

             <a v-bind:href="quizResultsUrl">
                 <button type="button" class="btn btn-primary card_performance_review__chart_content__view_results">CLICK HERE TO VIEW ANSWER DETAILS</button>
             </a>

           </div>
           <!-- /card_performance_review__chart -->

          <!--performance_section-->
           <div class="col-lg-8 p-5 performance_section">
                <!-- performance_review-->
               <div class="performance_review">
                   <h3 tabindex="0">Your Result</h3>

                   <ul>
                     <li class="performance_review__item performance_review__item--correct_answers">
                       <div>Correct Answers</div>
                       <div class="performance_review__item__value">{{performance.user.correct_answers}}</div>
                     </li>
                     <li class="performance_review__item performance_review__item--incorrect_answers">
                       <div>Incorrect Answers</div>
                       <div class="performance_review__item__value">{{performance.user.incorrect_answers}}</div>
                     </li>
                     <li class="performance_review__item performance_review__item--hit_rate">
                       <div>Score</div>
                       <div class="performance_review__item__value">{{(performance.user.success_ratio*100).toFixed(0)}}<span>%</span></div>
                     </li>
                   </ul>
                 </div>
             <!-- /performance_review-->
          </div>
          <!-- /performance_section-->
       </div>
   </div>


</div>
