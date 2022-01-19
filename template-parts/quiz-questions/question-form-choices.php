<!-- question_form__choices -->
<div class="question_form__choices">

  <div
      v-for="(item, index) in examActiveQuestion.quiz_bank_answers"

      class="question_form__choices__choice"
  >
    <label v-if="examActiveQuestion.quiz_bank_question_type=='radio'">
      <input v-on:click="clickAnswer(item, index)" v-bind:disabled="submitedAnswer" type="radio" name="radio" class="radio-answer">
      <span class="checkmark"></span>
      <span class="item_answer" v-html="item.answer"></span>
      <img v-if="item.answer_image_url" v-bind:src="item.answer_image_url" class="img-fluid answer-image" />
    </label>

    <label v-if="examActiveQuestion.quiz_bank_question_type=='checkbox'">
      <input v-on:click="clickAnswer(item, index)" v-bind:id="index"  v-bind:value="index" v-bind:disabled="submitedAnswer" type="checkbox" name="radio" class="radio-answer">
      <span  class="item_answer checkmark"></span>
      <span v-html="item.answer"></span>
      <img v-if="item.answer_image_url" v-bind:src="item.answer_image_url" class="img-fluid answer-image" />
    </label>

  </div>

  <div
        v-if="examActiveQuestion.quiz_bank_question_type=='sort_drag'"
        class="question_form__sorte_drag"
    >
      <div class="row">
          <div class="col-12">
              <p>Instructions: Drag and sort the options from left to right list.</p>
          </div>
         <div class="col-6">
           <h5>Unordered Options</h5>
           <draggable class="list-group" :list="sortListOriginal" group="sortAnswers" @change="changeSortLists">
             <div
               class="list-group-item"
               v-for="(element, index) in sortListOriginal"
               :key="element.name"
             >
               {{ element.id }}. {{ element.name }}
             </div>
           </draggable>
         </div>

         <div class="col-6">
           <h5>Ordered Response</h5>
           <draggable class="list-group" :list="sortListDestination" group="sortAnswers" @change="changeSortLists">
             <div
               class="list-group-item"
               v-for="(element, index) in sortListDestination"
               :key="element.name"
             >
               {{ element.id }}. {{ element.name }}
             </div>
           </draggable>
         </div>
       </div>
  </div>

  <div v-if="examActiveQuestion.quiz_bank_question_type=='number'">
      <input v-bind:disabled="submitedAnswer" v-model="selectedAnswer" type="number" name="number-question" class="input-answer">
  </div>

  <div v-if="examActiveQuestion.quiz_bank_question_type=='fib'">
      <input v-bind:disabled="submitedAnswer" v-model="selectedAnswer" type="number" name="number-question" class="input-answer">
  </div>

  <div v-if="examActiveQuestion.quiz_bank_question_type=='sort'">

      <label class="w-100">
          Answer:
          <input  v-bind:disabled="submitedAnswer" v-model="selectedAnswer" type="number" name="sort-question" class="input-answer">
      </label>
  </div>


</div>
<!-- /question_form__choices -->
