<?php global $sn_current_user;

wp_enqueue_style( 'simplenursing-dashboard-quiz-style', get_stylesheet_directory_uri() . '/css/dashboard_quiz.css', ['simplenursing-style'],  SN_ASSETS_VERSION);
wp_enqueue_script('class-quiz-bank', get_stylesheet_directory_uri() . '/js/class-quiz-bank.js', ['vue-js'], SN_ASSETS_VERSION, true);
wp_enqueue_script('simplenursing-vue-quiz-results', get_stylesheet_directory_uri() . '/js/simplenursing-vue-quiz-results.js', ['vue-js'], SN_ASSETS_VERSION, true);

wp_enqueue_style( 'progress-circle-style', get_stylesheet_directory_uri() . '/vendors/progress-circle.min.css', ['simplenursing-style'],  '1.01');
wp_enqueue_style( 'progress-circle-blue-style', get_stylesheet_directory_uri() . '/vendors/progress-circle-blue.min.css', ['simplenursing-style'],  '1.07');

wp_enqueue_style( 'fancybox-style', get_stylesheet_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.css', ['simplenursing-style'],  '3.5.7');
wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.js', ['jquery'], '3.5.7', true);

wp_enqueue_script('html2canvas', get_stylesheet_directory_uri() . '/vendors/html2canvas.min.js', ['jquery'], '1.1.0.5', true);
wp_enqueue_script('canvas2image', get_stylesheet_directory_uri() . '/vendors/canvas2image.js', ['jquery'], '1.1.0.5', true);

$video_locked_url = 'https://d1pumg6d5kr18o.cloudfront.net/padlock/padlock.m3u8';

?>

<div id="app-quiz-results">

<div
    v-on:click="closeQuiz()"
    class="close_quiz"
    data-toggle="tooltip"
    data-placement="right"
    title=""
    data-original-title="Back to Dashboard"
></div>

<?php get_template_part('template-parts/quiz-results/header-results',''); ?>

<?php get_template_part('template-parts/quiz-results/header-chart',''); ?>

<main class="container">
  <div class="row">
    <div class="col-12">

      <!-- quiz_result_insights -->
      <section
        v-for="(quizItem, quizIndex) in quizData.quizResults"
        class="quiz_result_insights"
        >

        <!-- quiz_result_insights__chart_content -->
        <div class="quiz_result_insights__chart_content">

          <!-- quiz_result_insights__chart -->
          <div class="quiz_result_insights__chart_content__chart">
              <div class="progress-circle"
                v-bind:class="'progress-' + quizItem.categoryScore">
                  <span>
                      <div class="quiz_result_insights__chart_content__chart__number">{{quizItem.categoryScore}}%</div>
                      <div>{{quizItem.categoryRatio}}</div>
                  </span>
              </div>
          </div>
          <!-- /quiz_result_insights__chart -->

          <div class="quiz_result_insights__chart_content__header">
            <h2 v-html="quizItem.categoryName" tabindex="0" aria-label="{{quizItem.categoryName}}. Your answered correctly 2 of 3 questions. Your score is 66%.">
            </h2>

            <div v-if="quizItem.categoryScore >= quizItem.categoryGlobalScore" class="quiz_result_insights__chart_content__header__average quiz_result_insights__chart_content__header__average--above">
              Above avg.
            </div>
            <div v-if="quizItem.categoryScore < quizItem.categoryGlobalScore" class="quiz_result_insights__chart_content__header__average quiz_result_insights__chart_content__header__average--below">
              Below avg.
            </div>
          </div>

          <div class="clearfix"></div>
        </div>
        <!-- quiz_result_insights__chart_content -->

        <!-- quiz_result_insights__scores -->
        <div section-ref="1" class="quiz_result_insights__scores">

          <!-- quiz_result_insights__scores__item -->
          <div v-for="(topicItem, topicIndex) in quizItem.categoryTopics">

            <div v-if="topicItem.topicCount>0">
                <?php
                    // level2 (don't show if there are no questions)
                    get_template_part( 'template-parts/quiz-results/section-answers' );
                ?>
            </div>

            <div v-if="topicItem.level3">
                <h3
                    v-html="topicItem.topicName"
                    class="mt-3 quiz_result_insights__scores__item__subtopic"
                >
                </h3>
                <?php
                    // level3
                    get_template_part( 'template-parts/quiz-results/section-answers-level3' );
                ?>
            </div>

          </div>
          <!-- /quiz_result_insights__scores__item -->

        </div>
        <!-- /quiz_result_insights__scores -->

        <div class="clearfix"></div>
      </section>
      <!-- /quiz_result_insights -->

    </div>
  </div>
</main>

    <footer class="footer_quiz_result">
      <button v-on:click="closeQuiz()" type="button" class="btn btn-primary" style="margin: auto">Back to Dashboard</button>
    </footer>


    <?php get_template_part('template-parts/quiz-results/screenshot-element'); ?>

    <?php get_template_part('template-parts/quiz-results/modal-rationales',''); ?>
    <?php get_template_part('template-parts/quiz-results/modal-delete-quiz',''); ?>
    <?php get_template_part('template-parts/quiz-results/modal-share'); ?>
    <?php get_template_part('template-parts/modal/modal', 'spinner'); ?>

</div>


<script>
  jQuery(document).ready(function($) {

    $('[data-toggle="tooltip"]').tooltip();

    var prevTopicRef = null;
    var currTopicRef = null;

    // delegate to find new vue elements
    $('#app-quiz-results').on('click', '.quiz_result_insights__scores__item__topic',function () {

      currTopicRef = $(this).closest('.quiz_result_insights__scores__item').attr('topic-ref');

      $('.quiz_result_insights__scores__item').removeClass('quiz_result_insights__scores__item--open');
      $('.quiz_result_insights__scores__item__answers').slideUp();

      if (currTopicRef != prevTopicRef) {
        prevTopicRef = currTopicRef;
        $('[topic-ref="' + currTopicRef + '"].quiz_result_insights__scores__item').addClass('quiz_result_insights__scores__item--open');
        $('[topic-ref="' + currTopicRef + '"] .quiz_result_insights__scores__item__answers').slideDown();
      } else {
        prevTopicRef = null;
      }
    });

  });

</script>
