<?php
    wp_enqueue_script('simplenursing-vue-nclex-review-lecture-premium', get_stylesheet_directory_uri() . '/js/simplenursing-vue-nclex-review-lecture-premium.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_style('nclex-review-lecture', get_stylesheet_directory_uri() . '/css/nclex-review-lecture.css', [], SN_ASSETS_VERSION);
?>
<div id="nclex-lecture" >

<!-- hero_dashboard -->
<div class="hero_dashboard hero_dashboard--lecture_series"
               style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-header.jpg)">
    <div class="hero_dashboard__gradient_bg">
        <?php get_template_part('template-parts/header/menu','links'); ?>

        <div class="clearfix"></div>

        <div class="container text-md-left text-center">

        <div style="position: relative">
            <div class="hero_dashboard__back hero_dashboard__back--white">
                <a href="#">
                    NCLEX Lite
                </a>
            </div>
        </div>


            <div class="row">
                <div style="position: relative">
                <h1 tabindex="0" class="text-md-left text-center">
                    NCLEX Review
                    <!-- <br class="d-md-block d-none"> -->
                    <br>
                    Lecture Series
                </h1>

                <div class="hero_dashboard__post_h1 mb-4">
                    Join Mike on a video course designed to
                    <br class="d-md-block d-none">
                    get you prepared for the NCLEX
                </div>

                <a :href="'<?php echo "https://dev2members.simplenursing.com/nclex-review-lecture-series-module?mid="?>'+startLessonBtnModuleId" role="button" class="btn btn-lg-extra btn-with-icon btn-prominent mr-md-3 mr-0 mb-md-0 mb-3">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-hero-dashboard-preview-trailer.svg" alt="">
                    {{startLessonBtnTxt}}
                </a>
                <br class="d-md-none d-block">

                <!-- <a href="" role="button" class="btn btn-lg-extra btn-with-icon btn-outline btn-outline-subtle">
                    <img src="images/dashboard/icon-hero-dashboard-preview-share.svg" alt="">
                    Share with a friend
                </a> -->

                <!-- <div class="dropdown show d-inline-block">
                    <a class="btn btn-lg-extra btn-with-icon btn-outline btn-outline-subtle dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-hero-dashboard-preview-share.svg" alt="">
                    Share with a friend
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#"><img class="dropdown-item-icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/share-url.svg" alt=""> Copy URL</a>
                        <a class="dropdown-item" href="#"><img class="dropdown-item-icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/share-facebook.svg" alt=""> Facebook</a>
                        <a class="dropdown-item" href="#"><img class="dropdown-item-icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/share-messenger.svg" alt=""> Messenger</a>
                        <a class="dropdown-item" href="#"><img class="dropdown-item-icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/share-twitter.svg" alt=""> Twitter</a>
                        <a class="dropdown-item" href="#"><img class="dropdown-item-icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/share-whatsapp.svg" alt=""> WhatsApp</a>
                        <a class="dropdown-item" href="#"><img class="dropdown-item-icon" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/share-telegram.svg" alt=""> Telegram</a>
                    </div>
                </div> -->
                <div class="dropdown show d-inline-block">
                    <a class="btn btn-lg-extra btn-with-icon btn-outline btn-outline-subtle btn-share-page" href="javascript:void(0);">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/icon-hero-dashboard-preview-share.svg" alt="">
                    Share with a friend
                    </a>
                </div>

                </div>
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
                    <!-- card_video -->
                    <div class="card_video" v-for="(item, index) in modules">
                        <a :href="'<?php echo "https://dev2members.simplenursing.com/nclex-review-lecture-series-module?mid="?>'+item.module_id">
                            <div class="card_video__thumbnail">
                            <div class="card_video__thumbnail__info">
                                <ul>
                                <li>{{toHHMM(item.module_duration)}}</li>
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
                </div>
            </div>
        </div>
    </main>
    <?php get_template_part('template-parts/modal/modal-share'); ?>
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
