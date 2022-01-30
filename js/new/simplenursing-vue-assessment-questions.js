/* jshint esversion: 8 */

var App = new Vue({

  el: "#app-quiz-questions",
  data: {
      assessment: new ASSESSMENT(),
      quizId: 0,
      quizResultsUrl: '',
      localStorageNclexAnswers: [],
      localStorageId:'',
      skipRationales: true,
      finalQuestion: false,
      examQuantity:0,
      examType: '',
      examTimeLimit:0,
      examTimeLimitOriginal:0,
      examFreeTrial: false,
      partialScore: 0,
      submitedAnswerTotalTimeSpent:0,
      examAnswers:[],
      examActiveQuestion: {
        answer: false,
        correct: false,
        explanation: false,
        question: false,
        question_detail: false,
        quiz_bank_answers: false,
        quiz_bank_question_type: false,
        review: false,
        seconds: false,
        seen: false,
        score: 0,
        correct_top_left_x: 0,
        correct_top_left_y: 0,
        correct_bottom_right_x: 0,
        correct_bottom_right_y: 0,
        question_image_for_drag: null,
        question_image_height: 0,
        question_image_width: 0,
        correct_answer_sort: false
      },
      questionIndex: 0,
      timeLimitActive: false,
      selectedAnswer: false,
      submitedAnswer:false,
      submitedAnswerSeconds: 0,
      dateQuestionStart: null,
      checkedAnswers: [],
      checkboxCorrectAnswers: '',
      hasVideo: false,
      hasVideoRationale: false,
      cleanedQuestion: '',
      examStartTime: new Date(),
      viewResults: false,
      performance: false,
      progressCircleClass: '',
      draggedInsideArea: false,
      sortListOriginal: [
         ],
      sortListDestination: [
         ],
      quizBreak: false
  },
  mounted: function () {
      this.quizId = getUrlParameter("quiz_id");
      this.quizResultsUrl = '/quiz-results/?quiz_id='+this.quizId;
      this.localStorageId = 'assessment_exam_'+this.quizId;
      showNotificationWarning("If you have to leave the exam without saving, please resume in the next 72 hours or the progress will be lost.");
      this.getQuizData(this.quizId);
  },
  methods: {
      getQuizData(quizId) {
          this.assessment.getQuiz(quizId).then(
              response => {
                  if (response.status == false) {
                      setTimeout(function(){
                          jQuery('.sn-spinner-modal').modal('hide');
                          showNotificationError('Error: ' + response.msg);
                      }, 1000);
                  } else {
                      console.log(response);
                      this.examQuantity = response.data.exam_quantity;
                      this.examAnswers = response.data.exam_answers;
                      this.examType = response.data.exam_type;

                      // if (this.examType=='exam') this.skipRationales = true;
                      //   else this.skipRationales = false;

                      if (response.data.exam_time_limit !== 'Unlimited') {
                          this.examTimeLimitOriginal = this.examTimeLimit= (response.data.exam_time_limit * 60);
                          this.timeLimitActive = true;
                          this.countDownTimer();
                          this.startCircleAnimation();
                      }

                      this.getAnswersFromLocalStorage();

                      this.loadQuestion(0);

                  }
              }
          );
      },
      loadQuestion(questionIndex) {
          console.log(this.examAnswers[questionIndex]);
        this.submitedAnswer=false;
        this.selectedAnswer=false;
        this.checkedAnswers=[];
        this.viewResults=false;

        jQuery('.question_form__choices__choice input').removeClass('correct incorrect');
        jQuery('.question_form__nav').fadeIn();

        // stop video if previous loadedVideo had one
        if (this.hasVideo) stopVideo('#sn-video-player');
        if (this.hasVideoRationale) stopVideo('#sn-video-rationale');


        //this.examActiveQuestion = this.examAnswers[questionIndex];
        this.examActiveQuestion.review = this.examAnswers[questionIndex].review;
        this.examActiveQuestion.answer = this.examAnswers[questionIndex].answer;
        this.examActiveQuestion.answers = this.examAnswers[questionIndex].answers;
        this.examActiveQuestion.correct = this.examAnswers[questionIndex].correct;
        this.examActiveQuestion.learning_outcomes = this.examAnswers[questionIndex].learning_outcomes;
        this.examActiveQuestion.video_rationale = this.examAnswers[questionIndex].video_rationale;
        this.examActiveQuestion.overview = this.examAnswers[questionIndex].overview;
        this.examActiveQuestion.test_taking_tip = this.examAnswers[questionIndex].test_taking_tip;
        this.examActiveQuestion.question = this.examAnswers[questionIndex].question;
        this.examActiveQuestion.question_detail = this.examAnswers[questionIndex].question_detail;
        this.examActiveQuestion.quiz_bank_answers = this.examAnswers[questionIndex].answers;
        this.examActiveQuestion.quiz_bank_question_type = this.examAnswers[questionIndex].question_type;
        this.examActiveQuestion.seconds = this.examAnswers[questionIndex].seconds;
        this.examActiveQuestion.seen = this.examAnswers[questionIndex].seen = true;
        this.examActiveQuestion.score = Math.round(this.examAnswers[questionIndex].score * 100);
        this.examActiveQuestion.correct_top_left_x = this.examAnswers[questionIndex].correct_top_left_x;
        this.examActiveQuestion.correct_top_left_y = this.examAnswers[questionIndex].correct_top_left_y;
        this.examActiveQuestion.correct_bottom_right_x = this.examAnswers[questionIndex].correct_bottom_right_x;
        this.examActiveQuestion.correct_bottom_right_y = this.examAnswers[questionIndex].correct_bottom_right_y;
        this.examActiveQuestion.question_image_for_drag = this.examAnswers[questionIndex].question_image_for_drag;
        this.examActiveQuestion.question_image_height = this.examAnswers[questionIndex].question_image_height;
        this.examActiveQuestion.question_image_width = this.examAnswers[questionIndex].question_image_width;
        this.examActiveQuestion.correct_answer_sort = this.examAnswers[questionIndex].assessment_correct_answer_sort;


        // create correct answer on checkbox
        if (this.examActiveQuestion.quiz_bank_question_type == 'checkbox') {
            let correctAnswers = '';
            this.examActiveQuestion.quiz_bank_answers.forEach(function(element, index){
                if (element.correct) correctAnswers += (index+1)+',';
            });
            this.checkboxCorrectAnswers = correctAnswers.slice(0, -1);
        }

        // populate sortListOriginal
        if (this.examActiveQuestion.quiz_bank_question_type == 'sort_drag') {
            this.sortListOriginal=[];
            this.sortListDestination=[];
            let thisParent = this;
            let answerId=1;
            this.examActiveQuestion.quiz_bank_answers.forEach(function(element, index){
                thisParent.sortListOriginal.push(
                    { name: element.answer, id: answerId }
                );
                answerId++;
            });
        }

        console.log('this.examActiveQuestion', this.examActiveQuestion);
        this.questionIndex=questionIndex;
        this.dateQuestionStart=new Date();

        let videoFound = removeVideoFromHTML(this.examActiveQuestion.question_detail);
        console.log('data returned', videoFound);

        if (!videoFound) {
            this.hasVideo = false;
            this.cleanedQuestion = this.examActiveQuestion.question_detail;
        } else {
            this.hasVideo = true;
            this.cleanedQuestion = videoFound.clean_html;
            let videoUrl = videoFound.video_url;
            loadVideo('#sn-video-player', videoUrl);
        }

        if (this.examActiveQuestion.video_rationale===null || this.examActiveQuestion.video_rationale=='') {
            this.hasVideoRationale = false;
        } else {
            this.hasVideoRationale = true;
        }

        console.log('hasVideoRationale', this.hasVideoRationale);

        // Add fancybox to images in html
        setTimeout(function(){
            jQuery(".question_form__question img").wrap(function() {
                return '<a data-fancybox="images" href="'+ jQuery( this ).attr("src") +'"></a>';
            });
        }, 1000);

      },
      clickAnswer(item, index) {

          if (this.examActiveQuestion.quiz_bank_question_type == 'radio') {
              if (!this.submitedAnswer) {
                this.selectedAnswer = item;
                this.selectedAnswer.option = (index + 1);
              }
          } else {

              if (this.checkedAnswers.includes(index)===false) {
                  this.checkedAnswers.push(index);
              } else {
                  removeA(this.checkedAnswers, index);
              }

                // // checkbox
                if (this.checkedAnswers.length == 0) {
                    this.selectedAnswer = false;
                    return;
                }

                // store multiple options comma separated
                this.selectedAnswer = {
                    option: '',
                    correct: false
                };
                let checkedAnswersOption = this.checkedAnswers.map(function(num) {
                  return num + 1;
                });
                this.selectedAnswer.option = checkedAnswersOption.sort().toString();
                this.selectedAnswer.correct = (this.checkboxCorrectAnswers == this.selectedAnswer.option);

              }

      },
      clickQuestionIndex(index) {
          this.questionIndex = index;
          this.loadQuestion(this.questionIndex);
          this.clearForm();
          jQuery('#questionIndexModal').modal('hide');
      },
      submitAnswer(){

          let questionTypeOptions = (this.examActiveQuestion.quiz_bank_question_type == 'checkbox' || this.examActiveQuestion.quiz_bank_question_type == 'radio');

          // it's the final question
          if (this.questionIndex >= this.examQuantity - 1) this.finalQuestion = true;
            else this.finalQuestion = false;

        if(this.quizBreak)
            this.takeBreakQuiz();

          // don't show rationales
          if (!this.skipRationales) {
              jQuery('.question_form').addClass('question_form--not_centered');
              // jQuery('#prev_bnt').css('left', '16px');
              jQuery('#prev_bnt').addClass('moved');
              jQuery('#answer_btn').hide();
              jQuery('#skip_btn').hide();
              jQuery('.menu').hide();
              jQuery('.question_result').fadeIn();
              jQuery('.question_feedback').fadeIn();
              jQuery('.black_overlay_nav_answered').fadeIn();
              jQuery('.menu').css('opacity', 0);
              jQuery('html,body').animate({
                scrollTop: jQuery('.question_form__choices').offset().top + 20
              }, 'slow');

              if (this.hasVideoRationale) {
                  loadVideo('#sn-video-rationale', this.examActiveQuestion.video_rationale);
                  // wait a few seconds to load video
                  setTimeout(function(){
                      jQuery('#next_btn').fadeIn();
                  }, 4000);
              } else {
                  jQuery('#next_btn').fadeIn();
              }
          } else {
              jQuery('#answer_btn').hide();
              jQuery('#skip_btn').hide();
              jQuery('#prev_bnt').hide();
              if (this.finalQuestion) {
                  jQuery('#next_btn').fadeIn();
              }
          }


          // total duration until now
          let dateQuestionEnd = new Date();
          let timePassedSeconds = differenceSeconds(this.examStartTime, dateQuestionEnd);
          // let timePassedSeconds = this.examTimeLimitOriginal - this.examTimeLimit;
          this.submitedAnswerTotalTimeSpent = formatSecondsToTime(timePassedSeconds);
          // console.log(timePassedSeconds);

          // validate checkbox and radio differently from open/sort
          if (questionTypeOptions) {
              // visual indicators of correct/wrong answer
              let $question = jQuery(".question_form__choices__choice input");
              let correctAnswer = this.assessment.getCorrectAnswerPosition(this.examActiveQuestion);
              let userAnswersArray;
              if (this.selectedAnswer.correct) {
                  $question.eq(this.selectedAnswer.option-1).addClass("correct");
                  showNotificationSuccess('Correct');
              } else {

                  showNotificationError('Incorrect');

                  if (this.examActiveQuestion.quiz_bank_question_type == 'checkbox') {
                      userAnswersArray = this.selectedAnswer.option.split(',');
                  } else if (this.examActiveQuestion.quiz_bank_question_type == 'radio') {
                      userAnswersArray = [this.selectedAnswer.option];
                      }

                  userAnswersArray.forEach((item, i) => {
                      if (correctAnswer.includes(item)==false) {
                          $question.eq(item-1).addClass("incorrect");
                      }
                  });
              }

              correctAnswer.forEach((item, i) => {
                  $question.eq(item-1).addClass("correct");
              });
          } else if (this.examActiveQuestion.quiz_bank_question_type=="x"){
              if(this.draggedInsideArea) {
                  showNotificationSuccess('Correct');
              } else {
                  showNotificationError('Incorrect');
              }
          } else if (this.examActiveQuestion.quiz_bank_question_type=="sort_drag"){
              let correctAnswer = this.examActiveQuestion.correct_answer_sort;
              let isCorrect = (this.selectedAnswer==correctAnswer);

              if(isCorrect) {
                  showNotificationSuccess('Correct');
              } else {
                  showNotificationError('Incorrect');
              }
            }else{
              //open / sort

              let correctAnswer = this.examActiveQuestion.answers[0].answer;



              let isCorrect = (this.selectedAnswer==correctAnswer);

              if(isCorrect) {
                  showNotificationSuccess('Correct');
              } else {
                  showNotificationError('Incorrect');
              }

              this.selectedAnswer = {
                'option':  this.selectedAnswer,
                'correct': isCorrect
            };
          }
          // total duration on this question (seconds)
          // let dateQuestionEnd = new Date();
          this.submitedAnswerSeconds = differenceSeconds(this.dateQuestionStart, dateQuestionEnd);
          this.submitedAnswer=true;
          this.examAnswers[this.questionIndex].answer = this.selectedAnswer.option;
          this.examAnswers[this.questionIndex].correct = this.selectedAnswer.correct;
          this.examAnswers[this.questionIndex].seconds = this.submitedAnswerSeconds;

          // store answers in local storage
          this.storeAnswersLocalStorage();

          // load next question if not final
          if (this.skipRationales && !this.finalQuestion) this.nextQuestion();

      },
      getAnswersFromLocalStorage() {
           let localStorageNclexAnswersString = localStorage.getItem(this.localStorageId);

           // If object exists, populate nclex answers
           if (localStorageNclexAnswersString!=null) {
               this.localStorageNclexAnswers = JSON.parse(localStorageNclexAnswersString);
               let answersObj = this.localStorageNclexAnswers.answers;

               if (this.examAnswers.length == answersObj.length) {
                   this.examAnswers.forEach((item, i) => {
                       if (typeof answersObj == "object") {
                           if (typeof answersObj[i].answer != 'undefined') {
                               this.examAnswers[i].answer= answersObj[i].answer;
                               this.examAnswers[i].correct= answersObj[i].correct;
                               this.examAnswers[i].seconds= answersObj[i].seconds;
                               this.examAnswers[i].seen= answersObj[i].seen;
                           }
                       }
                   });
                   showNotificationSuccess('We found previous unsaved answers and loaded them into the exam. Please check the Question Index to see all answers recorded.');
               }


           }

           removeExpiredExamsFromLocalStorage("assessment_exam");

      },
      storeAnswersLocalStorage() {

          // Store answers fields in local storage
          let answersArray=[];
          this.examAnswers.forEach((item, i) => {
              let currentAnswer=[];
              if (item.answer!='') {
                  currentAnswer = {
                      "answer": item.answer,
                      "correct": item.correct,
                      "seconds": item.seconds,
                      "seen": item.seen
                  };
              }
            answersArray.push(currentAnswer);
          });

          let exdays = 3;
          const d = new Date();
          d.setTime(d.getTime() + (exdays*24*60*60*1000));

          var localStorageObject={
            "answers": answersArray,
            "expirationDate": d.toUTCString()
          };

          localStorage.setItem(this.localStorageId, JSON.stringify(localStorageObject));

      },
      nextQuestion() {

          if ((this.questionIndex+1)<this.examQuantity) {
              this.questionIndex++;
              this.loadQuestion(this.questionIndex);
              this.clearForm();
          }


      },
      previousQuestion() {
          this.questionIndex--;
          this.loadQuestion(this.questionIndex);

          this.clearForm();
      },
      skipAnswer() {
          this.nextQuestion();
      },
      clearForm() {
          // Clear form
          jQuery(".radio-answer").prop('checked', false);
          jQuery('.question_form').removeClass('question_form--not_centered');
          // jQuery('#prev_bnt').css('left', '94px');
          jQuery('#prev_bnt').removeClass('moved');
          jQuery('#answer_btn').show();
          jQuery('#prev_bnt').show();
          jQuery('#skip_btn').show();
          jQuery('.menu').show();
          jQuery('#next_btn').hide();
          jQuery('.question_result').hide();
          jQuery('.question_feedback').hide();
          jQuery('.black_overlay_nav_answered').hide();
          jQuery('.menu').css('opacity', 1);
          jQuery('html,body').animate({
            scrollTop: jQuery('.question_form__question').offset().top + 20
          }, 'slow');
      },
      countDownTimer() {
          if(this.examTimeLimit > 0) {
              setTimeout(() => {
                  this.examTimeLimit -= 1;
                  this.countDownTimer();
              }, 1000);
          }
      },
      showCountDown(counter) {
          return formatSecondsToTime(counter);
      },
      startTimer() {
          // let timePassedSeconds = this.examTimeLimitOriginal - this.examTimeLimit;
          // this.submitedAnswerTotalTimeSpent = formatSecondsToTime(timePassedSeconds);
          // console.log(timePassedSeconds);

          // var interval = setInterval(function() {
          //      this.completeTimer += 1;
          //      this.submitedAnswerTotalTimeSpent = formatSecondsToTime(this.completeTimer);
          // }, 1000);


      },
      startCircleAnimation() {
          var time = this.examTimeLimit;
          var initialOffset = '315';
          var i = 1;

          var interval = setInterval(function() {
              if (i == time) {
                  clearInterval(interval);
                  return;
              }
              jQuery('.circle_animation').css('stroke-dashoffset', initialOffset-((i+1)*(initialOffset/time)));
              i++;
          }, 1000);
      },
      markForReview() {
          this.examActiveQuestion.review = !this.examActiveQuestion.review ;
          this.examAnswers[this.questionIndex].review=this.examActiveQuestion.review;
    },
    closeQuiz() {
        window.location.href = '/';
    },
    discardQuiz() {
        console.log('discardQuiz');
        this.assessment.deleteQuiz(this.quizId).then(
            response => {
                if (response.status == false) {
                    setTimeout(function(){
                        showNotificationError('Error: ' + response.msg);
                    }, 1000);
                } else {
                    showNotificationSuccess('Quiz Discarded');
                    localStorage.removeItem(this.localStorageId);
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                }
            }
        );
    },
    saveQuiz() {

        jQuery('.sn-spinner-modal').modal('show');
        this.assessment.storeQuiz(this.quizId, this.examAnswers)
            .then(
                response => {
                    console.log(response);
                    if (response.status == false) {
                        setTimeout(function(){
                            showNotificationError('Error: ' + response.msg);
                        }, 1000);
                    } else {
                        showNotificationSuccess('Quiz Saved! You can see the results on the Insights page.');
                        localStorage.removeItem(this.localStorageId);
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 2000);
                    }
                })
                .catch(error => {
                    showNotificationError(error);
                })
                .finally(function() {
                    setTimeout(() => {
                        jQuery('.sn-spinner-modal').modal('hide');
                    }, 2000);
                });
    },
    takeBreakQuiz() {
        console.log('Quiz Break Starts!');
        if(!this.quizBreak){
            this.quizBreak = true;
            showNotificationSuccess('Quiz break will start as soon you answer current question.');
        }else{
            jQuery('.blue_overlay_nav_answered').css("display","block");
            showNotificationSuccess('Quiz break starts! please note, the clock won\'t stop');
        }
    },
    resumeQuiz() {
        console.log('Quiz Resumed!');
        this.quizBreak = false;
        jQuery('.blue_overlay_nav_answered').css("display","none");
        // jQuery('div.blue_overlay_nav_answered').addClass('invisible');
        showNotificationSuccess('Quiz Resumed!');
    },
    viewResultsForm() {
        this.clearForm();
        jQuery('.question_form__nav').hide();

        jQuery('.sn-spinner-modal').modal('show');
        this.assessment.storeQuiz(this.quizId, this.examAnswers).then(
            response => {
                if (response.status == false) {
                    setTimeout(function(){
                        showNotificationError('Error: ' + response.msg);
                    }, 1000);
                } else {
                    console.log(response);
                    localStorage.removeItem(this.localStorageId);
                    this.assessment.getUserQuizPerformance(this.quizId).then(
                        response => {
                            if (response.status == false) {
                                setTimeout(function(){
                                    showNotificationError('Error: ' + response.msg);
                                }, 1000);
                            } else {
                                this.performance = response.result;
                                this.performance.above = (this.performance.user.success_ratio >= this.performance.global_ratio);
                                this.progressCircleClass = 'progress-'+ (this.performance.user.success_ratio*100).toFixed(0);
                                this.viewResults=true;
                            }
                        }
                    );
                }
            }
        )
        .catch(error => {
            showNotificationError(error);
        })
        .finally(function() {
            setTimeout(() => {
                jQuery('.sn-spinner-modal').modal('hide');
            }, 2000);
        });

    },
    changeSortLists: function(evt) {
        if (this.sortListOriginal.length==0) {
            let createSelectedAnswer='';
            this.sortListDestination.forEach(function(element, index){
                createSelectedAnswer+=element.id;
            });
            this.selectedAnswer = createSelectedAnswer;
        } else {
            this.selectedAnswer    = false;
        }
    }

} //methods

});
