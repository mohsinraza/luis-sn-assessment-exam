jQuery(document).ready(function($) {


    var user_device;

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      user_device = 'mobile';
    } else {
      user_device = 'desktop';
    }

    jQuery('[data-action="go-to-features"]').click(function () {
      jQuery('html,body').animate({
        scrollTop: jQuery("#feature-presentation").offset().top - 110
      }, 1000);
      return false;
    });


    $('[data-action="go-to-pricing"]').click(function () {
      $('html,body').animate({
        scrollTop: $("#pricing").offset().top - 110
      }, 1000);
      return false;
    });

    // MOBILE PRICING TAB NAVIGATION ========================
    var pricing_ref;

    $('.mobile_pricing_tabs li').click(function() {
      pricing_ref = $(this).attr('pricing-ref');
      // $('.mobile_pricing_tabs li').removeClass('active');
      // $(this).addClass('active');

      $('html,body').animate({
        scrollTop: $('[pricing-ref-section="' + pricing_ref + '"]').offset().top - 100
      }, 'slow');
    });

    var sections = $('.js_pricing_section'), nav = $('.mobile_pricing_tabs'), nav_height = nav.outerHeight();

    var pricing_visible_section = 1;


    $(window).on('scroll', function () {
      var cur_pos = $(this).scrollTop() + 100;

      sections.each(function() {
        var top = $(this).offset().top - nav_height,
            bottom = top + $(this).outerHeight();

        if (cur_pos >= top && cur_pos <= bottom) {
          pricing_visible_section = $(this).attr('pricing-ref-section');
          $('.mobile_pricing_tabs li').removeClass('active');
          $('[pricing-ref="' + pricing_visible_section + '"]').addClass('active');
        }
      });
    });

    // FAQ ========================
    var faq_current_question = null;
    var faq_previous_question = null;

    if (user_device == 'desktop') {
      faq_current_question = '1';
      faq_mark_current_question(faq_current_question);
      faq_show_answer_desktop(faq_current_question);
    }

    // When user clicks a question
    $('#faq .faq__content__questions__item').click(function () {
      faq_current_question = $(this).attr('faq-ref');

      // Mark selected question
      faq_mark_current_question(faq_current_question);

      if (user_device == 'mobile') {
        faq_show_answer_mobile(faq_current_question, faq_previous_question);
      } else {
        faq_show_answer_desktop(faq_current_question);
      }

      // Update previsous question reference
      if (faq_current_question != faq_previous_question) {
        faq_previous_question = faq_current_question;
      } else {
        faq_previous_question = null;
      }
    });

    function faq_mark_current_question(ref) {
      $('.faq__content__questions__item').removeClass('faq__content__questions__item--active');
      $('[faq-ref="' + ref + '"]').addClass('faq__content__questions__item--active');
    }


    function faq_show_answer_mobile(ref, previous_ref) {

      $('.js_faq_answer').slideUp();

      if (ref != previous_ref) {
        $('[faq-ref-answer="' + ref + '"]').slideDown();
      } else {
        $('.faq__content__questions__item').removeClass('faq__content__questions__item--active');
      }
    }

    function faq_show_answer_desktop(ref) {
      $('.js_faq_answer').hide();
      $('[faq-ref-answer="' + ref + '"]').show();
    }


    /* RUN QUIZ = Enter key pressed */
  $('.quiz li').on("keypress", function(e) {
    if (e.keyCode == 13) {
      $quiz_obj = $(this).closest('.quiz__question_block');

      if ($quiz_obj.attr('quiz-answered') == 0) {
        var quiz_ref = $quiz_obj.attr('quiz-ref');
        quiz_run($(this), quiz_ref);
      }
    }
  });

  /* RUN QUIZ = Mouse Click / Mobile Finger Tap */
  $('.quiz li').click(function () {
    $quiz_obj = $(this).closest('.quiz__question_block');

    if ($quiz_obj.attr('quiz-answered') == 0) {
      var quiz_ref = $quiz_obj.attr('quiz-ref');
      quiz_run($(this), quiz_ref);
    }
  });

  function quiz_run(choice, quiz_ref) {
    $quiz_obj = $('.quiz__question_block[quiz-ref="' + quiz_ref + '"]');
    // quiz_ref = $quiz_obj.attr('quiz-ref');
    quiz_answered = $quiz_obj.attr('quiz-answered');
    quiz_answer_correct = $quiz_obj.attr('quiz-correct-answer');
    quiz_choice = choice.attr('quiz-choice');

    if (quiz_choice == quiz_answer_correct) {
      // quiz_is_correct = true;
      $quiz_obj.attr('quiz-answered', 1);
      $('[quiz-ref-area="' + quiz_ref + '"] .quiz__feedback--positive').slideDown();
      choice.addClass('quiz__question_block__choices--correct');
    } else {
      // quiz_is_correct = false;
      $quiz_obj.attr('quiz-answered', 1);
      $('[quiz-ref-area="' + quiz_ref + '"] .quiz__feedback--negative').slideDown();
      choice.addClass('quiz__question_block__choices--wrong');
      $quiz_obj.find('li[quiz-choice="' + quiz_answer_correct + '"]').addClass('quiz__question_block__choices--correct-warning');
    }
  }


    $('[data-toggle="tooltip"]').tooltip();

         function showMobileMenu () {
           $('.aside_main').css('left', 0);
           $('.aside_main__close').show();
           $('.black_overlay').fadeIn(200);
           $('.header_mobile').addClass('filter_blur');
           $('.aside_main__cta_link').addClass('open');
           $('.body_content__wrapper').addClass('filter_blur');
         }

         function hideMobileMenu () {
           $('.aside_main').css('left', '-296px');
           $('.aside_main__close').hide();
           $('.black_overlay').fadeOut(200);
           $('.header_mobile').removeClass('filter_blur');
           $('.aside_main__cta_link').removeClass('open');
           $('.body_content__wrapper').removeClass('filter_blur');
         }

         $('.header_mobile__menu_btn').click(function() {
           showMobileMenu();
         });

         $('.aside_main__close').click(function() {
           hideMobileMenu();
         });

         $('.black_overlay').click(function() {
           hideMobileMenu();
         });

         $('.hero_dashboard__loggedIn__menu__avatar').click(function () {
           $('.hero_dashboard__loggedIn__menu ul').fadeToggle('fast');
       });

       $('.header_mobile__right_corner__loggedin_user').click(function () {
         $('.header_mobile__right_corner ul').fadeToggle('fast');
     });

         $('.dashboard_video_carousel').scrollLeft(120);


         // dashboard_video1  dashboard_video_carousel__item

         $('.dashboard_video_carousel__item').click(function () {
           var videoObj = jQuery.parseJSON( $(this).attr('video-data') );
           //$('#dashboard_video1 .dashboard_video1__iframe').attr("src", videoObj.url);
           $('#dashboard_video1 h2').html(videoObj.title);
           $('#dashboard_video1 .dashboard_video1__description__duration').html(videoObj.duration);
           $('#dashboard_video1 .dashboard_video1__description__text').html(videoObj.description);

           jQuery("#sn-video-player .flowplayer")
             .data('flowplayer')
             .load([{mpegurl: videoObj.url}]);

           $('html, body').animate({
             scrollTop: $("#dashboard_video1").offset().top - 100
           }, 500);
         });


         $('.dashboard_video_carousel_container__prev').click(function() {
         	$list = $('#dashboard_video_carousel');
         	var leftPos = $list.scrollLeft();
           $list.animate({scrollLeft: leftPos - 400}, 500);
         });

         $('.dashboard_video_carousel_container__next').click(function() {
         	$list = $('#dashboard_video_carousel');
         	var leftPos = $list.scrollLeft();
           $list.animate({scrollLeft: leftPos + 400}, 500);
         });

         var refPrevious = '';
         var openRef = false;
         if ($('.main-category').length==0) openRef = true;
         // only slide up on library main category
         $('.main-category .dashboard_library__group__item_container').slideUp(500);

         // open category if on url params
         if (window.location.pathname.includes('/video-library/')) {
             var queryString = window.location.search;
             var urlParams = new URLSearchParams(queryString);
             var groupTitleRef = urlParams.get('group-title-ref');
             if (groupTitleRef !== null) {
                 setTimeout(function(){
                     $( "h3[group-title-ref='"+groupTitleRef+"']" ).click();
                 }, 500);
             }
         }

         $('.dashboard_library__group h3').click(function () {

           // Mobile onlye
           // if (window.matchMedia('screen and (max-width: 991px)').matches) {
             var refCurrent = $(this).attr('group-title-ref');

             if (openRef) {
                  refPrevious = refCurrent;
                  openRef = false;
             }


             if (refCurrent != refPrevious) {

               $('.dashboard_library__group__item_container').slideUp(500);
               $('[group-items-ref="' + refCurrent + '"]').slideDown(500);
               $('.dashboard_library__group h3').removeClass('active');
               $(this).addClass('active');
               refPrevious = refCurrent;

               refGroupBefore = refCurrent > 1 ? refCurrent-1 : 1;

                $('html, body').animate({
                  scrollTop: $('[group-title-ref="' + refGroupBefore + '"]').offset().top
                }, 500);

               // change url with parameter group-title-ref
               var newUrl=window.location.href;
               if (newUrl.includes('group-title-ref')) {
                   var queryString = window.location.search;
                   var n = queryString.indexOf("group-title-ref")-1;
                   var res = queryString.substring(n);
                   newUrl = newUrl.replace(res,'');
               }

               if (newUrl.includes('?')) {
                   newUrl+='&group-title-ref='+refCurrent;
               } else {
                  newUrl+='?group-title-ref='+refCurrent;
               }
               window.history.pushState("", "", newUrl);
             } else {
               refPrevious = '';
               $('[group-items-ref="' + refCurrent + '"]').slideUp(500);
               $(this).removeClass('active');
               refCurrent = '';
             }
           // }
         });

    jQuery(".header_mobile__right_corner__search").on('click', function(event) {
        jQuery('#search').addClass('open');
        jQuery('#search form input[type="search"]').focus();
    });

    jQuery('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
             jQuery(this).removeClass('open');
         }
    });
});
