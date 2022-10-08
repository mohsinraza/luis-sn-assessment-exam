<?php
    wp_enqueue_script('simplenursing-vue-nclex-review-lecture-premium', get_stylesheet_directory_uri() . '/js/simplenursing-vue-nclex-review-lecture-premium.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_style('nclex-review-lecture', get_stylesheet_directory_uri() . '/css/nclex-review-lecture.css', [], SN_ASSETS_VERSION);
?>
<div id="nclex-lecture" >
    <!-- hero_dashboard -->
    <div class="hero_dashboard hero_dashboard--lecture_series" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-header.jpg)">
        <div class="hero_dashboard__gradient_bg">
            <?php get_template_part('template-parts/header/menu','links'); ?>

            <div class="clearfix"></div>

            <h1 class="" tabindex="0">NCLEX Review <br>Lecture Series</h1>
            <div class="text-left hero_dashboard__post_h1 mb-4">
                Join Mike on a video course designed to
                <br class="d-md-block d-none">
                get you prepared for the NCLEX
            </div>

            <div class="text-left hero_preview_btns">
                <div class="hero_preview_btns__btn hero_preview_btns__btn--trailer">
                    <a href="#">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-hero-dashboard-preview-trailer.svg" alt=""> START LESSON 1
                    </a>
                </div>
                <div class="hero_preview_btns__btn hero_preview_btns__btn--share dropdown-toggle">
                    <a href="#">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-hero-dashboard-preview-share.svg" alt=""> Share with a friend 
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /hero_dashboard -->





    <!-- main -->
    <main class="main--internal">
        <div class="container">
        <div class="row">
            <div class="col-md-9 offset-md-1 col-12 offset-0">
                <!-- Testing -->
                <!-- <ul>
                    <li v-for="(item, index) in modules">
                            <p>{{item.module_watched_duration}}</p>
                            <p>{{item.module_duration}}</p>
                            <p v-if="item.module_duration >= item.module_watched_duration">{{toHHMMSS(item.module_duration)}}</p>
                    </li>
                </ul> -->
                <!-- /Testing -->
                <!-- card_video -->
                <div class="card_video" v-for="(item, index) in modules">
                    <a href="#">
                        <div class="card_video__thumbnail">
                        <div class="card_video__thumbnail__info">
                            <ul>
                            <li>{{toHHMMSS(item.module_duration)}}</li>
                            <li><strong>{{item.module_videos}} videos</strong></li>
                            </ul>
                        </div>
                        <img :src="'<?php echo SN_ASSETS_URL ?>'+item.module_thumbnail" alt="">
                        </div>
                        <div class="card_video__details">
                        <div class="card_video__details__complete" v-if="item.module_duration===item.module_watched_duration">Complete</div>
                        <div class="card_video__details__day">{{item.module_day}}</div>
                        <div class="card_video__details__title">{{item.module_title}}</div>
                        <div class="card_video__details__summary">
                            {{item.module_summary}}
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <!-- /card_video -->

                <!-- card_video -->
                <div class="card_video">
                    <a href="#">
                        <div class="card_video__thumbnail">
                        <div class="card_video__thumbnail__info">
                            <ul>
                            <li>16:25</li>
                            <li><strong>5 videos</strong></li>
                            </ul>
                        </div>
                        <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-6.jpg" alt="">
                        </div>
                        <div class="card_video__details">
                        <!-- <div class="card_video__details__complete">Complete</div> -->
                        <div class="card_video__details__day">Day 2</div>
                        <div class="card_video__details__title">Cras finibus sit amet erat quis</div>
                        <div class="card_video__details__summary">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis.
                            Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <!-- /card_video -->

                <!-- card_video -->
                <div class="card_video">
                    <a href="#">
                        <div class="card_video__thumbnail">
                        <div class="card_video__thumbnail__info">
                            <ul>
                            <li>16:25</li>
                            <li><strong>5 videos</strong></li>
                            </ul>
                        </div>
                        <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-7.jpg" alt="">
                        </div>
                        <div class="card_video__details">
                        <!-- <div class="card_video__details__complete">Complete</div> -->
                        <div class="card_video__details__day">Day 3</div>
                        <div class="card_video__details__title">Cras finibus sit amet erat quis</div>
                        <div class="card_video__details__summary">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis.
                            Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <!-- /card_video -->


                <!-- card_video -->
                <div class="card_video">
                    <a href="#">
                        <div class="card_video__thumbnail">
                        <div class="card_video__thumbnail__info">
                            <ul>
                            <li>16:25</li>
                            <li><strong>5 videos</strong></li>
                            </ul>
                        </div>
                        <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-5.jpg" alt="">
                        </div>
                        <div class="card_video__details">
                        <!-- <div class="card_video__details__complete">Complete</div> -->
                        <div class="card_video__details__day">Day 4</div>
                        <div class="card_video__details__title">Cras finibus sit amet erat quis</div>
                        <div class="card_video__details__summary">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis.
                            Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <!-- /card_video -->

                <!-- card_video -->
                <div class="card_video">
                    <a href="#">
                        <div class="card_video__thumbnail">
                        <div class="card_video__thumbnail__info">
                            <ul>
                            <li>16:25</li>
                            <li><strong>5 videos</strong></li>
                            </ul>
                        </div>
                        <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-6.jpg" alt="">
                        </div>
                        <div class="card_video__details">
                        <!-- <div class="card_video__details__complete">Complete</div> -->
                        <div class="card_video__details__day">Day 5</div>
                        <div class="card_video__details__title">Cras finibus sit amet erat quis</div>
                        <div class="card_video__details__summary">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis.
                            Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <!-- /card_video -->

                <!-- card_video -->
                <div class="card_video">
                    <a href="#">
                        <div class="card_video__thumbnail">
                        <div class="card_video__thumbnail__info">
                            <ul>
                            <li>16:25</li>
                            <li><strong>5 videos</strong></li>
                            </ul>
                        </div>
                        <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-7.jpg" alt="">
                        </div>
                        <div class="card_video__details">
                        <!-- <div class="card_video__details__complete">Complete</div> -->
                        <div class="card_video__details__day">Day 6</div>
                        <div class="card_video__details__title">Cras finibus sit amet erat quis</div>
                        <div class="card_video__details__summary">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis.
                            Etiam morbi varius iaculis facilisis. Cras finibus sit amet erat quis.
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
                <!-- /card_video -->
            </div>
        </div>
    </div>
    </main>
    <!-- /main -->
</div>

<script>
jQuery(document).ready(function ($) {
   $('body').removeClass("dashboard_body_nclex_v2");
   $('body').addClass("dashboard_body_nclex_v2_black");


    $('.videoGrid__crop__label').click(function () {
      $('#video_crop').hide();
      $('.videoHidden').fadeIn();
    });
 })
 </script>
