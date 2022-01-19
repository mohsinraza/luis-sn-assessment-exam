<!-- question_feedback -->
<div class="question_result" style="display: none;">
  <div class="container">
    <div class="row">
        <div v-if="selectedAnswer.correct" class="col-md-3 col-6 question_result__item">
          <img class="question_result__item__icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-answer-correct.svg" alt=""><br>
          <span>Correctly</span><br>
          answered
        </div>
      <div v-if="!selectedAnswer.correct" class="col-md-3 col-6 question_result__item question_result__item--red">
        <img class="question_result__item__icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-answered-incorrectly.svg" alt=""><br>
        <span>Incorrectly</span><br>
        answered
      </div>
      <div class="col-md-3 col-6 question_result__item">
        <img class="question_result__item__icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-time-spent-question.svg" alt=""><br>
        <span>{{submitedAnswerSeconds}} seconds</span><br>
        in this question
      </div>
      <div class="col-md-3 col-6 question_result__item">
        <img class="question_result__item__icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-time-spent-total.svg" alt=""><br>
        <span>{{submitedAnswerTotalTimeSpent}}</span><br>
        total time spent
      </div>
      <div class="col-md-3 col-6 question_result__item">
        <img class="question_result__item__icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-users-4.svg" style="width:31px;height:25px;margin-bottom: 0px;" alt=""><br>
        <span>{{examActiveQuestion.score}}%</span><br>
        answered correctly
      </div>
    </div>
  </div>
</div>
<!-- /question_feedback -->
