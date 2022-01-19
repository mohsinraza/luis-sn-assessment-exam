<!-- question_feedback -->
<div class="question_feedback" style="display: none;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div v-if="examActiveQuestion.explanation" id="explanation" v-html="examActiveQuestion.explanation">
        </div>

        <h2 v-if="examActiveQuestion.overview" tabindex="0">Overview</h2>
        <div v-html="examActiveQuestion.overview"></div>

        <h2 v-if="examActiveQuestion.learning_outcomes" tabindex="0">Learning Outcomes</h2>
        <div v-html="examActiveQuestion.learning_outcomes"></div>

        <h2 v-if="examActiveQuestion.learning_outcomes" tabindex="0">Rationales</h2>
        <div
            v-if="examActiveQuestion.learning_outcomes"
            v-for="(item, index) in examActiveQuestion.quiz_bank_answers"
            class="question_feedback__rationale"
         >
            <div v-show="item.correct" class="question_feedback__rationale__title question_feedback__rationale__title--correct">Correct</div>
            <div v-show="!item.correct" class="question_feedback__rationale__title question_feedback__rationale__title--incorrect">Incorrect</div>
            <div v-html="item.rationale"></div>
        </div>

        <h2 v-if="examActiveQuestion.test_taking_tip" tabindex="0">Test Taking Tips</h2>
        <div v-html="examActiveQuestion.test_taking_tip"></div>
      </div>
    </div>
  </div>
</div>
