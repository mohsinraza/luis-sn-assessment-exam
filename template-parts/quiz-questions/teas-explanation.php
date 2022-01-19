<?php
    $video_locked_url = 'https://d1pumg6d5kr18o.cloudfront.net/padlock/padlock.m3u8';
?>

<!-- question_feedback -->
<div class="question_feedback" style="display: none;">
  <div class="container">
    <div class="row">
      <div class="col-12">

            <div class="question_feedback__video">
              <!-- <iframe src="https://www.youtube.com/embed/uuXJNJ9LvdM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
              <!-- sn-video-player -->
                <div id="sn-video-rationale" v-bind:class="{ 'd-none': !hasVideoRationale, 'd-block': hasVideoRationale }">
                    <?php echo do_shortcode('[fvplayer src="'.$video_locked_url.'"]') ;?>
                </div>
              <!-- /sn-video-player -->
            </div>


            <h2 tabindex="0">Overview</h2>
            <div v-html="examActiveQuestion.overview"></div>

            <h2 tabindex="0">Learning Outcomes</h2>
            <div v-html="examActiveQuestion.learning_outcomes"></div>

            <h2 tabindex="0">Rationales</h2>

            <div
                v-for="(item, index) in examActiveQuestion.answers"
                class="question_feedback__rationale"
             >
                <div v-show="item.correct" class="question_feedback__rationale__title question_feedback__rationale__title--correct">Correct</div>
                <div v-show="!item.correct" class="question_feedback__rationale__title question_feedback__rationale__title--incorrect">Incorrect</div>
                <div v-html="item.rationale"></div>
            </div>

            <h2 tabindex="0">Test Taking Tips</h2>
            <div v-html="examActiveQuestion.test_taking_tip"></div>
      </div>
    </div>
  </div>
</div>
