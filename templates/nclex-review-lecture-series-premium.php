<?php
    wp_enqueue_script('simplenursing-vue-nclex-review-lecture-premium', get_stylesheet_directory_uri() . '/js/simplenursing-vue-nclex-review-lecture-premium.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_style('nclex-review-lecture', get_stylesheet_directory_uri() . '/css/nclex-review-lecture.css', [], SN_ASSETS_VERSION);
?>

<!-- hero_dashboard -->
<div id="nclex-lecture" class="hero_dashboard hero_dashboard--lecture_series" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-header.jpg)">
    <div class="hero_dashboard__gradient_bg">
        <?php get_template_part('template-parts/header/menu','links'); ?>

        <div class="clearfix"></div>

        <h1 class="text-center" tabindex="0">NCLEX Review Lecture Series</h1>

        <div class="hero_dashboard__post_h1 mb-4">
            Nurse Mike's Masterclass on how to pass
            <br class="d-md-block d-none">
            the NCLEX. 23+ hours of contentAnatomy and Physiology
        </div>

        <div class="hero_preview_btns">
            <div class="hero_preview_btns__btn hero_preview_btns__btn--trailer">
                <a href="#">
                    Trailer
                </a>
            </div>
            <div class="hero_preview_btns__btn hero_preview_btns__btn--share">
                <a href="#">
                    Share
                </a>
            </div>
        </div>

        <a href="/nclex-pricing" role="button" class="btn btn-lg-extra btn-prominent-nclex">
            Upgrade to unlock
        </a>

        <div class="mt-3">
            Just $49/month for unlimited on-demand
            <br class="d-md-block d-none">
            access to all lessons
        </div>
    </div>
</div>
<!-- /hero_dashboard -->





<!-- main -->
<main class="main--internal">
    <div class="container">


        <div class="row">
            <div class="col-12">
                <h3 tabindex="0"><strong>About this Review Lecture</strong></h3>
            </div>
        </div>

        <!-- Playlist -->
        <section class="playlistInPage">
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="playlistInPage__video" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-video1.jpg)">
                        <div class="playlistInPage__video__play"></div>
                    </div>
                    <div class="playlistInPage__description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id auctor ligula. Donec ornare diam vel odio efficitur,
                        eget facilisis dolor cursus. Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat. Sed nec purus
                        posuere, pharetra dui eget, rhoncus turpis. Etiam at placerat nibh, a vulputate risus. Pellentesque pulvinar molestie
                        rutrum. Ut vel posuere erat. Pellentesque vehicula ligula egestas neque.
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <!-- <div class="playlistInPage__list_heading">
                    Browse lesson plan
                </div> -->

                <ul class="playlistInPage__list">
                    <li class="selected">Anatomy and Physiology</li>
                    <li>Medication Calculation</li>
                    <li>Pathophysiology</li>
                    <li>Fundamentals</li>
                    <li>Medical / Surgical</li>
                    <li>Fundamentals</li>
                    <li>Medication Calculation</li>
                    <li>Pathophysiology</li>
                    <li>Fundamentals</li>
                    <li>Medical / Surgical</li>
                    <li>Fundamentals</li>
                    <li>Medication Calculation</li>
                    <li>Pathophysiology</li>
                    <li>Fundamentals</li>
                    <li>Medical / Surgical</li>
                    <li>Fundamentals</li>
                    <li>Medication Calculation</li>
                    <li>Fundamentals</li>
                    <li>Medical / Surgical</li>
                    <li>Fundamentals</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /Playlist -->



    <!-- Video grid -->
    <section class="videoGrid">
        <div class="row">
            <div class="col-12">
                <h3 tabindex="0"><strong>Browse lesson plan</strong></h3>
            </div>
        </div>


        <div class="row">

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-1.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Donec ornare diam vel odio efficitur, eget
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Donec ornare diam vel odio efficitur, eget facilisis dolor cursus. Morbi varius iaculis facilisis.
                            Cras finibus sit amet erat quis placerat. Sed nec.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-2.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis. Etiam.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-3.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat. Sed nec purus posuere
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id auctor ligula.
                            Donec ornare diam vel odio efficitur, eget facilisis.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-4.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Lorem ipsum dolor sit amet cras id
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Etiam at placerat nibh, a vulputate risus. Pellentesque pulvinar molestie rutrum.
                            Ut vel posuere erat. Pellentesque vehicula.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-4.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Lorem ipsum dolor sit amet cras id
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Etiam at placerat nibh, a vulputate risus. Pellentesque pulvinar molestie rutrum.
                            Ut vel posuere erat. Pellentesque vehicula.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-2.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis. Etiam.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-1.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Donec ornare diam vel odio efficitur, eget
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Donec ornare diam vel odio efficitur, eget facilisis dolor cursus. Morbi varius iaculis facilisis.
                            Cras finibus sit amet erat quis placerat. Sed nec.
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-3.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat. Sed nec purus posuere
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id auctor ligula.
                            Donec ornare diam vel odio efficitur, eget facilisis.
                        </div>
                    </a>
                </div>
            </div>

            <div id="video_crop" class="col-12">
                <div class="videoGrid__crop">
                    <div class="videoGrid__crop__label">
                        View more classes
                    </div>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-1.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Donec ornare diam vel odio efficitur, eget
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Donec ornare diam vel odio efficitur, eget facilisis dolor cursus. Morbi varius iaculis facilisis.
                            Cras finibus sit amet erat quis placerat. Sed nec.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-2.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis. Etiam.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-3.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat. Sed nec purus posuere
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id auctor ligula.
                            Donec ornare diam vel odio efficitur, eget facilisis.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-4.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Lorem ipsum dolor sit amet cras id
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Etiam at placerat nibh, a vulputate risus. Pellentesque pulvinar molestie rutrum.
                            Ut vel posuere erat. Pellentesque vehicula.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-4.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Lorem ipsum dolor sit amet cras id
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Etiam at placerat nibh, a vulputate risus. Pellentesque pulvinar molestie rutrum.
                            Ut vel posuere erat. Pellentesque vehicula.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-2.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis. Etiam.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-1.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Donec ornare diam vel odio efficitur, eget
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Donec ornare diam vel odio efficitur, eget facilisis dolor cursus. Morbi varius iaculis facilisis.
                            Cras finibus sit amet erat quis placerat. Sed nec.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-3.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat. Sed nec purus posuere
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id auctor ligula.
                            Donec ornare diam vel odio efficitur, eget facilisis.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-1.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Donec ornare diam vel odio efficitur, eget
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Donec ornare diam vel odio efficitur, eget facilisis dolor cursus. Morbi varius iaculis facilisis.
                            Cras finibus sit amet erat quis placerat. Sed nec.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-2.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Morbi varius iaculis facilisis. Cras finibus sit amet erat quis placerat.
                            Sed nec purus posuere, pharetra dui eget, rhoncus turpis. Etiam.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-3.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Cras finibus sit amet erat quis placerat. Sed nec purus posuere
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id auctor ligula.
                            Donec ornare diam vel odio efficitur, eget facilisis.
                        </div>
                    </a>
                </div>
            </div>

            <div class="videoHidden col-md-3 col-6" style="display: none">
                <div class="videoGrid__video">
                    <a href="#">
                        <div class="videoGrid__video__thumb" style="background-image: url(<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-4.jpg);">
                            <div class="videoGrid__video__thumb__title">
                                Lorem ipsum dolor sit amet cras id
                            </div>
                            <div class="videoGrid__video__thumb__gradient_bg"></div>
                        </div>
                        <div class="videoGrid__video__desc">
                            Etiam at placerat nibh, a vulputate risus. Pellentesque pulvinar molestie rutrum.
                            Ut vel posuere erat. Pellentesque vehicula.
                        </div>
                    </a>
                </div>
            </div>


        </div>
    </section>
    <!-- /Video grid -->


    <div class="cta_huge_photo">
        <div class="cta_huge_photo__body">
            <div class="cta_huge_photo__body__heading">
                Lorem ipsum dolor sit consectetur adipiscing elit
            </div>
            <div class="cta_huge_photo__body__text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ipsum quam, luctus in felis id, tempus.
            </div>
            <a role="button" class="btn btn-lg btn-black" href="#">
                Get started
            </a>
        </div>
        <img class="cta_huge_photo__pic" src="<?php echo SN_ASSETS_URL ?>/images/dashboard/mike-bw-photo-1.jpg" alt="">
        <div class="clearfix"></div>
    </div>




</div>
</main>
<!-- /main -->

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
