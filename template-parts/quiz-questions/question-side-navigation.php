<!-- side_nav -->
<nav class="side_nav">
  <div v-if="timeLimitActive" class="side_nav__control side_nav__control--not_hittable side_nav__control--time_remaining">
    <svg class="side_nav__control__progress_circle" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <circle id="circle" class="circle_animation" r="50" cx="52" cy="52" fill="transparent" stroke-dasharray="315" stroke-dashoffset="315"></circle>
    </svg>
    <span>{{showCountDown(this.examTimeLimit)}}</span><br>
    time rem.
  </div>

  <div class="side_nav__control side_nav__control--not_hittable side_nav__control--progress">
    <span class="d-block">{{questionIndex + 1}}/{{examQuantity}}</span>
    questions
    <div class="side_nav__control__progress_bar">
      <div
          class="side_nav__control__progress_bar__progress"
           v-bind:style="{width: ((questionIndex + 1) / examQuantity)*100 + '%'}"
          >
      </div>
    </div>
  </div>

  <div class="side_nav__control side_nav__control--question_index"
       data-toggle="modal" data-target="#questionIndexModal">
    Question<br>
    <span>Index</span>
  </div>

  <div
      id="mark_for_review"
      v-on:click="markForReview()"
      class="side_nav__control side_nav__control--mark_for_review"
      v-bind:class="{ 'side_nav__control--highlighted': examActiveQuestion.review }"
  >
    <div v-if="examActiveQuestion.review!=true">
        Mark for<br><span>Review</span>
    </div>

    <div v-if="examActiveQuestion.review==true">
        <strong>Marked for</strong><br><span>Review</span>
    </div>

  </div>

  <div
      id="mark_for_review"
      v-on:click="skipRationales=!skipRationales"
      class="side_nav__control side_nav__control--tutor_mode"
      v-bind:class="{ 'side_nav__control--highlighted': !skipRationales }"
  >
    <div v-if="skipRationales==true">
        Tutor Mode<br><span>Off</span>
    </div>

    <div v-if="skipRationales==false">
        <strong>Tutor Mode</strong><br><span>On</span>
    </div>

  </div>


</nav>
<!-- /side_nav -->
