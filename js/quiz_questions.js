/* jshint esversion: 6 */

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
          $('.side_nav').hide();
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


    if (typeof interact !== 'undefined') {
        // target elements with the "draggable" class
        interact('.draggable')
          .draggable({
            // enable inertial throwing
            inertia: true,
            // keep the element within the area of it's parent
            modifiers: [
              interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
              })
            ],
            // enable autoScroll
            autoScroll: true,

            listeners: {
              // call this function on every dragmove event
              move: dragMoveListener,

              // call this function on every dragend event
              end (event) {
                 var dragPosition = jQuery("#drag-1").position();
                 var dragImage = jQuery("#drag-image");
                 var dragCircleSquare = 25; //50px size of the image, /2 to get center

                 var imgRatioWidth  = dragImage.width() / App.examActiveQuestion.question_image_width;
                 var imgRatioHeight = dragImage.height() / App.examActiveQuestion.question_image_height;

                 // Calculate the correct details applying the ratio of the original images
                 var imgCorrectDetailsRatio = {
                     'width': App.examActiveQuestion.question_image_width * imgRatioWidth,
                     'height': App.examActiveQuestion.question_image_height * imgRatioHeight,
                     'correct_top_left_x':App.examActiveQuestion.correct_top_left_x * imgRatioWidth,
                     'correct_top_left_y':App.examActiveQuestion.correct_top_left_y * imgRatioHeight,
                     'correct_bottom_right_x':App.examActiveQuestion.correct_bottom_right_x * imgRatioWidth,
                     'correct_bottom_right_y':App.examActiveQuestion.correct_bottom_right_y * imgRatioHeight,
                 };

                 // var draggedInsideArea = false;
                 App.draggedInsideArea =
                     ((dragPosition.left+dragCircleSquare) >= imgCorrectDetailsRatio.correct_top_left_x
                     &&
                     (dragPosition.top+dragCircleSquare) >= imgCorrectDetailsRatio.correct_top_left_y
                     &&
                     (dragPosition.left+dragCircleSquare) <= imgCorrectDetailsRatio.correct_bottom_right_x
                     &&
                     (dragPosition.top+dragCircleSquare) <= imgCorrectDetailsRatio.correct_bottom_right_y);


                App.selectedAnswer = true; // answer selected on first drag
               console.log("App.draggedInsideArea", App.draggedInsideArea);

              }
            }
        });
    }


});


  function dragMoveListener (event) {
    var target = event.target;
    // keep the dragged position in the data-x/data-y attributes
    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

    // translate the element
    target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

    // update the posiion attributes
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
  }

  // this function is used later in the resizing and gesture demos
  window.dragMoveListener = dragMoveListener;

  // KATEX
  function SnConvertKatexFieldAnswers() {
      jQuery(".question_form__choices__choice .item_answer").each(function( index ) {
          var currentText =  jQuery( this ).text();

          // find katex
          if (currentText.indexOf("[katex]")>-1) {
              currentText = currentText.replace("[katex]", "");
              currentText = currentText.replace("[/katex]", "");
              var element = jQuery( this )[0];
              katex.render(currentText, element, {
                  throwOnError: false
              });
          }

      });
  }
