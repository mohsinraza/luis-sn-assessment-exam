<?php
    wp_enqueue_script('class-sn-api', get_stylesheet_directory_uri() . '/js/class-api.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_script('schools-list', get_stylesheet_directory_uri() . '/js/schools-list.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_script('simplenursing-vue-free-trial-questions', get_stylesheet_directory_uri() . '/js/simplenursing-vue-free-trial-nclex-questions.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_style( 'onboarding-nclex-css', get_stylesheet_directory_uri() . '/css/onboarding-nclex.css', [], SN_ASSETS_VERSION);

    global $sn_current_user;
    $user_billing = $sn_current_user->get_billing_details();
    $user_billing_first_name = ucfirst(strtolower($user_billing['billing_first_name']));

    if($sn_current_user->has_free_trial_nclex_pn()) $nclex_plan = "NCLEX-PN";
        else  $nclex_plan = "NCLEX-RN";
?>

<!-- header -->
<header>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-12">
        <img class="logo" src="<?php echo SN_ASSETS_URL ?>/images/logo-simple-nursing.svg" alt="SimpleNursing">
      </div>
      <div class="col-md-6 col-12">
        <div class="header_links">
          <ul>
            <li ref-type="tel"><a href="tel:+17028196645">702-819-6645</a></li
              ><li><a href="<?php echo wp_logout_url(  )?>"><strong>Logout</strong></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- /header -->

<!-- main -->
<div class="container" id="free-trial-questions">
    <button v-if="allowClosing" @click="closeOnboardingQuestionaire()" type="button" class="close close_onboarding" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <main v-bind:class="{'main_step_last':step==2}">




    <!-- ============ STEP 3 ============ -->
    <div id="step1" class="step_n" v-if="step==1">
        <!-- welcome -->
        <section class="welcome">
          <div class="welcome__title">Welcome to the <br class="d-md-none">SIMPLENURSING <?= $nclex_plan ?> FREE TRIAL</div>
          <div>
            Howdy <?php echo $user_billing_first_name ?>! Or should we say soon to be Nurse '<?php echo $user_billing_first_name ?>'? 😍
            <br class="d-md-inline-block d-none">
            Before you dive into SimpleNursing, please answer one question to help us customize your experience.
          </div>
        </section>
        <!-- /welcome -->

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 col-12">

              <form class="form_with_icon">
                <div class="form-group">
                  <img class="form-group__icon" src="<?php echo SN_ASSETS_URL ?>/images/onboarding/icon-graduate-date.png" alt="">
                  <label for="input_graduate_year">When do you <br class="d-md-none d-inline-block">plan on writing the <?= $nclex_plan ?> exam?</label>
                  <div class="clearfix"></div>
                  <select v-model="whenGraduateMonth" class="w-50 w-50 float-left">
                    <option disabled value="">Month</option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                  </select>

                  <select v-model="whenGraduateYear" class="w-50">
                    <option disabled value="">Year</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                    <option>2029</option>
                    <option>2030</option>
                  </select>

                </div>

                <button :disabled="whenGraduateMonth=='' || whenGraduateYear==''" id="submit" type="submit" class="btn btn-lg btn-primary btn-prominent btn-block-mobile" @click="nextStep()">Next</button>
              </form>

            </div>
          </div>
        </div>



    </div>
    <!-- /============ STEP 3 ============ -->



   <div class="onboarding_progress onboarding_progress--nclex" v-if="step<5">
      <ul v-if="step==1">
         <li v-bind:id="step+'1'" class="onboarding_progress__dot onboarding_progress__dot--current"></li>
         <li v-bind:id="step+'2'" class="onboarding_progress__dot cursor_not_allowed" data-toggle="tooltip" data-placement="top" title="Choose an option above"></li>
     </ul>
      <ul v-if="step==2">
         <li v-bind:id="step+'1'" data-original-title="" @click="step=1" class="onboarding_progress__dot" data-toggle="tooltip" data-placement="top" title="Back to previous step"></li>
         <li v-bind:id="step+'2'" class="onboarding_progress__dot onboarding_progress__dot--current"></li>
     </ul>
   </div>

   <!-- ============ STEP 5 ============ -->
   <div id="step2" class="step_last" v-if="step==2">
     <div class="container">
       <div class="row justify-content-center">
         <div class="col-8" style="text-align: left;">
           <h1>Thanks!<br>Ready to use<br>SimpleNursing!</h1>
           <!-- illustration-mike-cartoon.jpg -->

           <button
                :disabled="fetching_data"
                @click="submitAnswers()"
                type="submit"
                class="btn btn-lg btn-primary btn-prominent"
            >
             Get&nbsp;started
             <span v-if="fetching_data" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
           </button>
           <div v-if="errorMessage" v-html="errorMessage">
         </div>
       </div>
     </div>
   </div>
   <!-- /============ STEP 5 ============ -->

  </main>
</div>
</div>
<!-- /main -->
