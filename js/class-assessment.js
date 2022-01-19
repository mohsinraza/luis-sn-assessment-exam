/* jshint esversion: 8 */

class ASSESSMENT {

      constructor() {
         this.axiosHeaders = {headers: {'X-WP-Nonce':wpApiSettings.nonce}};
      }

      getCategories() {
         let headers = this.axiosHeaders;
         let data = {"action": "get_assessment_categories"};

         return new Promise(function(resolve, reject) {
             axios.post('/wp-json/simplenursing/v1/action', data, headers)
                 .then(response => {
                     resolve(response.data.data);
                 })
                 .catch(error => {
                     console.log('getCategories ERROR:', error);
                     reject(error);
                 });
          });
      }

      generateQuiz(quizData) {
          let headers = this.axiosHeaders;
          let data = {
              "action": "generate_assessment_quiz",
              "quiz_data": quizData
          };

          return new Promise(function(resolve, reject) {
              axios.post('/wp-json/simplenursing/v1/action', data, headers)
                  .then(response => {
                      resolve(response.data);
                  })
                  .catch(error => {
                      console.log('generateQuiz ERROR:', error);
                      reject(error);
                  });
           });

      }


      getQuiz(quizId) {
          let headers = this.axiosHeaders;
          let data = {
              "action": "get_assessment_quiz",
              "quiz_id": quizId
          };

          return new Promise(function(resolve, reject) {
              axios.post('/wp-json/simplenursing/v1/action', data, headers)
                  .then(response => {
                      resolve(response.data);
                  })
                  .catch(error => {
                      console.log('getQuiz ERROR:', error);
                      reject(error);
                  });
           });

      }

      // getQuizResults(quizId) {
      //     let headers = this.axiosHeaders;
      //     let data = {
      //         "action": "get_nclex_quiz_results",
      //         "quiz_id": quizId
      //     };
      //
      //     return new Promise(function(resolve, reject) {
      //         axios.post('/wp-json/simplenursing/v1/action', data, headers)
      //             .then(response => {
      //                 resolve(response.data);
      //             })
      //             .catch(error => {
      //                 console.log('getQuizResults ERROR:', error);
      //                 reject(error);
      //             });
      //      });
      //
      // }
      //
      // getUserQuizPerformance(quizId) {
      //     let headers = this.axiosHeaders;
      //     let data = {
      //         "action": "get_user_quiz_performance",
      //         "quiz_id": quizId
      //     };
      //
      //     return new Promise(function(resolve, reject) {
      //         axios.post('/wp-json/simplenursing/v1/action', data, headers)
      //             .then(response => {
      //                 resolve(response.data);
      //             })
      //             .catch(error => {
      //                 console.log('getUserQuizPerformance ERROR:', error);
      //                 reject(error);
      //             });
      //      });
      //
      // }

      storeQuiz(quizId, quizData) {
          let headers = this.axiosHeaders;
          let data = {
              "action": "store_assessment_quiz",
              "quiz_id": quizId,
              "quiz_data": quizData
          };

          return new Promise(function(resolve, reject) {
              axios.post('/wp-json/simplenursing/v1/action', data, headers)
                  .then(response => {
                      resolve(response.data);
                  })
                  .catch(error => {
                      console.log('storeQuiz ERROR:', error);
                      reject(error);
                  });
           });

      }

      // deleteQuiz(quizId) {
      //     let headers = this.axiosHeaders;
      //     let data = {
      //         "action": "delete_quiz",
      //         "quiz_id": quizId
      //     };
      //
      //     return new Promise(function(resolve, reject) {
      //         axios.post('/wp-json/simplenursing/v1/action', data, headers)
      //             .then(response => {
      //                 resolve(response.data);
      //             })
      //             .catch(error => {
      //                 console.log('deleteQuiz ERROR:', error);
      //                 reject(error);
      //             });
      //      });
      //
      // }


      calculateCurrentScore(examAnswers) {
          let totalQuestions=0;
          let correctQuestions=0;
          examAnswers.forEach(function(element) {

              if (element.answer !== '') {
                  totalQuestions++;

                  if (element.correct) {
                    correctQuestions++;
                  }
              }
          });

          return correctQuestions / totalQuestions;
      }

      getCorrectAnswerPosition(examActiveQuestion) {
          let index=[];
          examActiveQuestion.quiz_bank_answers.forEach((item, i) => {
                if (item.correct) {
                    index.push(i+1);
                }
          });
          console.log(index);
          return index;
      }

}
