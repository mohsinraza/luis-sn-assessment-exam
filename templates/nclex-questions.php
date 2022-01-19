<?php global $sn_current_user;

// wp_enqueue_style( 'vue-cool-lightbox-style', get_stylesheet_directory_uri() . '/vendors/vue-cool-lightbox/vue-cool-lightbox.min.css', ['simplenursing-style'],  SN_ASSETS_VERSION);
// wp_enqueue_script('vue-cool-lightbox', get_stylesheet_directory_uri() . '/vendors/vue-cool-lightbox/vue-cool-lightbox.min.js', ['vue-js'], '2.3.3', true);

wp_enqueue_style( 'simplenursing-dashboard-quiz-style', get_stylesheet_directory_uri() . '/css/dashboard_quiz.css', ['simplenursing-style'],  SN_ASSETS_VERSION);
wp_enqueue_script('class-nclex', get_stylesheet_directory_uri() . '/js/class-nclex.js', ['vue-js'], SN_ASSETS_VERSION, true);
wp_enqueue_script('simplenursing-vue-nclex-questions', get_stylesheet_directory_uri() . '/js/simplenursing-vue-nclex-questions.js', ['vue-js'], SN_ASSETS_VERSION, true);

wp_enqueue_style( 'progress-circle-style', get_stylesheet_directory_uri() . '/vendors/progress-circle.min.css', ['simplenursing-style'],  '1.01');

wp_enqueue_style( 'fancybox-style', get_stylesheet_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.css', ['simplenursing-style'],  '3.5.7');
wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.js', ['jquery'], '3.5.7', true);


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


    <!-- question_form -->
    <div class="question_form">


        <?php get_template_part('template-parts/quiz-questions/question-side-navigation'); ?>

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

          <?php get_template_part('template-parts/quiz-questions/question-form-choices'); ?>
      </div>

      <?php get_template_part('template-parts/quiz-questions/question', 'performance'); ?>

      <?php get_template_part('template-parts/quiz-questions/question', 'feedback'); ?>

      <?php get_template_part('template-parts/quiz-questions/question', 'navigation'); ?>



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

<script>
  jQuery(document).ready(function($) {

    // var markedForReview = false;
    var mobileMenuActive = false;
    var choiceSelected = false;

    $('[data-toggle="tooltip"]').tooltip();


    $('.menu').click(function() {
      if (mobileMenuActive == false) {
        mobileMenuActive = true;
        toggle_menu_mobile('show');
      } else {
        mobileMenuActive = false;
        toggle_menu_mobile('hide');
      }
    });


    $('.black_overlay').click(function () {
      mobileMenuActive = false;
      toggle_menu_mobile('hide');
    });

    function toggle_menu_mobile(state) {
      if (state == 'show') {
        $('.menu').addClass('menu--active');
        $('.black_overlay').fadeIn('fast');

        $('.side_nav').show().animate({
          opacity: 1,
          right: "+=24"
        }, 250);
      } else if (state == 'hide') {
        $('.menu').removeClass('menu--active');
        $('.black_overlay').fadeOut('fast');

        $('.side_nav').animate({
          right: "-=25",
          opacity: 0,
        }, 250, function() {
          $('.side_nav').hide()
        });
      }
    }



    // 3x the image
    jQuery('[data-fancybox="images"]').fancybox({
    afterLoad : function(instance, current) {
        var pixelRatio = window.devicePixelRatio || 1;
        if ( pixelRatio > 1.5 ) {
            current.width  = (current.width  / pixelRatio)*3;
            current.height = (current.height / pixelRatio)*3;
        } else {
            current.width*=3;
            current.height*=3;
            }
        }
    });


  });


</script>
