<?php

// wp_enqueue_style( 'vue-cool-lightbox-style', get_stylesheet_directory_uri() . '/vendors/vue-cool-lightbox/vue-cool-lightbox.min.css', ['simplenursing-style'],  SN_ASSETS_VERSION);
// wp_enqueue_script('vue-cool-lightbox', get_stylesheet_directory_uri() . '/vendors/vue-cool-lightbox/vue-cool-lightbox.min.js', ['vue-js'], '2.3.3', true);
wp_enqueue_style( 'simplenursing-dashboard-quiz-style', get_stylesheet_directory_uri() . '/css/new/dashboard_quiz.css', ['simplenursing-style'],  SN_ASSETS_VERSION);
wp_enqueue_script('class-assessment', get_stylesheet_directory_uri() . '/js/class-assessment.js', ['vue-js'], SN_ASSETS_VERSION, true);
wp_enqueue_script('simplenursing-vue-assessment-questions', get_stylesheet_directory_uri() . '/js/new/simplenursing-vue-assessment-questions.js', ['vue-js'], SN_ASSETS_VERSION, true);
wp_enqueue_script('quiz-questions', get_stylesheet_directory_uri() . '/js/quiz_questions.js', ['vue-js'], SN_ASSETS_VERSION, true);

wp_enqueue_style( 'progress-circle-style', get_stylesheet_directory_uri() . '/vendors/progress-circle.min.css', ['simplenursing-style'],  '1.01');
//
wp_enqueue_style( 'fancybox-style', get_stylesheet_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.css', ['simplenursing-style'],  '3.5.7');
wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.js', ['jquery'], '3.5.7', true);

wp_enqueue_script('interact-js', 'https://cdnjs.cloudflare.com/ajax/libs/interact.js/1.10.11/interact.js', ['jquery']);
wp_enqueue_script('sortable', 'https://cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js', ['vue-js'], '1.8.4', true);
wp_enqueue_script('sortable-vue', 'https://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js', ['vue-js'], '2.20.0', true);


$video_locked_url = 'https://d1pumg6d5kr18o.cloudfront.net/padlock/padlock.m3u8';

?>

<div id="app-quiz-questions">

    <div
        class="close_quiz"
        data-placement="right"
        href="#" onclick="return false;"
        data-toggle="modal"
        data-target="#closeQuizModal"
        ></div>

    <div class="menu d-xl-none d-block"></div>
    <div class="black_overlay"></div>
    <div class="black_overlay_nav_answered"></div>
    <div class="blue_overlay_nav_answered">
      <b-button 
        class="align-middle"
        variant="primary"
        v-on:click="resumeQuiz()"
        >
          <i class="fa fa-pause-circle" aria-hidden="true"></i> Resume Quiz
      </b-button> 
    </div>


    <!-- question_form -->
    <div class="container-fluid">


        <?php get_template_part('template-parts/quiz-questions/new/question-top-navigation'); ?>

      <div id="question_section" v-if="!viewResults">
          <!-- question_form__question -->
          <div v-html="cleanedQuestion" class="question_form__question">
          </div>
          <!-- /question_form__question -->

          <!-- sn-video-player -->
            <div id="sn-video-player" v-bind:class="{ 'd-none': !hasVideo, 'd-block': hasVideo }">
                <?php echo do_shortcode('[fvplayer src="'.$video_locked_url.'"]') ;?>
            </div>
          <!-- /sn-video-player -->

          <template v-if="examActiveQuestion.answers">
              <?php get_template_part('template-parts/quiz-questions/question-form-choices'); ?>
          </template>

          <template v-if="examActiveQuestion.quiz_bank_question_type=='x'">
              <?php get_template_part('template-parts/quiz-questions/question-form-image-drag'); ?>
          </template>



      </div>

      <?php get_template_part('template-parts/quiz-questions/question', 'performance'); ?>

      <?php get_template_part('template-parts/quiz-questions/question', 'feedback'); ?>

      <?php get_template_part('template-parts/quiz-questions/new/question', 'navigation'); ?>

      


    </div>
    <!-- question_form -->


    <!-- question_feedback -->
    <?php get_template_part('template-parts/quiz-questions/nclex', 'explanation'); ?>

    <!-- closeQuizModal -->
    <div class="modal fade" id="closeQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Close Quiz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p v-if="!examFreeTrial">Do you want to save this quiz for later, or discard this quiz?</p>
          <p v-if="examFreeTrial">Do you want to discard this quiz?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button v-on:click="discardQuiz()" type="button" data-dismiss="modal" class="btn btn-discard">Discard Quiz</button>
          <button v-if="!examFreeTrial" v-on:click="saveQuiz()" type="button" class="btn btn-confirm">Save Quiz</button>
        </div>
      </div>
    </div>
    </div>


    <!-- pauseQuizModal -->
    <div class="modal fade" id="pauseQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pause Quiz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p v-if="!examFreeTrial">Do you want to take a break?</p>
          <p>It's been X hours since you started the exam. You should take a small break (please note, the clock won't stop)</p>
          <p v-if="!examFreeTrial">The break starts immediately after you complete the current question on screen and the screen will goes blue.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button v-on:click="takeBreakQuiz()" type="button" data-dismiss="modal" class="btn btn-confirm">Take Break</button>
          <!-- <button v-if="!examFreeTrial" v-on:click="saveQuiz()" type="button" class="btn btn-confirm">Save Quiz</button> -->
        </div>
      </div>
    </div>
    </div>

    <!-- resumeQuizModal -->
    <div class="modal fade" id="resumeQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pause Quiz</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p v-if="!examFreeTrial">Do you want to resume quiz?</p>
          <p>It's been X hours since you started the exam. </p>
        </div>
        <div class="modal-footer">
          <button v-on:click="resumeQuiz()" type="button" data-dismiss="modal" class="btn btn-discard">Resume</button>
        </div>
      </div>
    </div>
    </div>

    <!-- questionIndexModal -->
    <div class="modal fade" id="questionIndexModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Question Index</h5>
            <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <!-- question_index -->
            <ul class="question_index">

                    <li
                        v-for="(item, index) in examAnswers"
                        class="question_index__item question_index__item--answered_correctly"
                        >
                        <a v-on:click="clickQuestionIndex(index)" href="javascript:void(0)">
                            <div class="question_index__item__question">
                                <strong>{{index+1}}.</strong>
                                <span v-html="item.question_detail"></span>
                              </div>
                              <ul class="question_index__item__info">
                                <li v-show="item.review" class="question_index__item__info__item question_index__item__info__item--marked">Marked</li>
                                <li v-show="item.answer && item.correct" class="question_index__item__info__item question_index__item__info__item--answered_correctly">Answered</li>
                                <li v-show="item.answer && !item.correct" class="question_index__item__info__item question_index__item__info__item--answered_incorrectly">Answered</li>
                                <li v-show="!item.answer && item.seen" class="question_index__item__info__item question_index__item__info__item--seen">Seen</li>
                              </ul>
                          </a>
                    </li>


            </ul>
            <!-- /question_index -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: auto">Back to Quiz</button>
          </div>
        </div>
      </div>
    </div>


    <!-- /question_feedback -->
    <?php get_template_part('template-parts/footer/footer', 'main'); ?>
</div>
