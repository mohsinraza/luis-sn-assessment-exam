<?php
    wp_enqueue_script('class-sn-api', get_stylesheet_directory_uri() . '/js/class-api.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_script('schools-list', get_stylesheet_directory_uri() . '/js/schools-list.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_script('simplenursing-vue-free-trial-questions', get_stylesheet_directory_uri() . '/js/simplenursing-vue-free-trial-nclex-pn-questions.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_style( 'onboarding-nclex-css', get_stylesheet_directory_uri() . '/css/onboarding-nclex-pn.css', [], SN_ASSETS_VERSION);

    global $sn_current_user;
    $user_billing = $sn_current_user->get_billing_details();
    $user_billing_first_name = ucfirst(strtolower($user_billing['billing_first_name']));

    if($sn_current_user->has_free_trial_nclex_pn()) $nclex_plan = "NCLEX-PN";
        else  $nclex_plan = "NCLEX-RN";
?>
<div class="page-wrap page-wrap-steps" id="free-trial-questions">
  <!-- <button v-if="allowClosing" @click="closeOnboardingQuestionaire()" type="button" class="close close_onboarding"
    aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> -->

  <!-- header -->
  <div class="">
    <header class="header header-user header-steps">
      <div class="container">
        <a href="index.html" class="logo">
          <img src="<?php echo SN_ASSETS_URL ?>/images/logo-simple-nursing.svg" alt="logo">
        </a>
        <ul class="user-nav">
          <li>
            <a href="tel:+17028196645">
              <img src="<?php echo SN_ASSETS_URL ?>/images/blue_icon-phone.svg" alt="icon-phone">
              702-819-6645
            </a>
          </li>
          <li><a href="<?php echo wp_logout_url(  )?>"><strong>Logout</strong></a></li>
          </il>
      </div>
    </header>
    <!-- /header -->

    <!-- main -->
    <main class="main-content">

      <!-- ============ STEP 1 ============ -->
      <div>
        <section class="section-steps section-steps-yellow">
          <div class="container">
            <div class="content-box" v-bind:class="{' main_step_last': step==2}">
              <div id="step1" class="step_n" v-if="step==1">
                <ul class="steps-nav">
                  <li class="steps-nav-item current">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/onboarding/step-icon-yellow.png"
                      alt="step-icon-yellow">
                  </li>
                  <li class="steps-nav-item">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/onboarding/step-icon-yellow.png"
                      alt="step-icon-yellow">
                  </li>
                </ul>
                <h2>Set up your profile</h2>
                <!-- Form -->
                <form class="form_with_icon">
                  <div class="step-item" id="form_group1">
                    <div class="step-icon">
                      <img src="<?php echo SN_ASSETS_URL ?>/images/onboarding/step-icon-1.svg" alt="step-icon-1">
                    </div>
                    <div>
                      <h5>When are you taking the NCLEX?</h5>
                      <div class="form-group flex-nowrap">
                        <select v-model="whenGraduateMonth" class="custom-select mr-2" id="month">
                          <option disabled selected value="">Month</option>
                          <option value="january">January</option>
                          <option value="february">February</option>
                          <option value="march">March</option>
                          <option value="april">April</option>
                          <option value="may">May</option>
                          <option value="june">June</option>
                          <option value="july">July</option>
                          <option value="august">August</option>
                          <option value="september">September</option>
                          <option value="october">October</option>
                          <option value="november">November</option>
                          <option value="december">December</option>
                        </select>
                        <select v-model="whenGraduateYear" class="custom-select" id="Year">
                          <option disabled selected value="">Year</option>
                          <option value="2004">2004</option>
                          <option value="2005">2005</option>
                          <option value="2006">2006</option>
                          <option value="2007">2007</option>
                          <option value="2008">2008</option>
                          <option value="2009">2009</option>
                          <option value="2010">2010</option>
                          <option value="2011">2011</option>
                          <option value="2012">2012</option>
                          <option value="2013">2013</option>
                          <option value="2014">2014</option>
                          <option value="2015">2015</option>
                          <option value="2016">2016</option>
                          <option value="2017">2017</option>
                          <option value="2018">2018</option>
                          <option value="2019">2019</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                          <option value="2026">2026</option>
                          <option value="2027">2027</option>
                          <option value="2028">2028</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="step-item d-none" id="form_group3">
                    <div class="step-icon">
                      <img src="<?php echo SN_ASSETS_URL ?>/images/onboarding/step-icon-3.svg" alt="step-icon-3">
                    </div>
                    <div>
                      <h5>How did you first hear about SimpleNursing?</h5>
                      <div class="form-group">
                        <select v-model="firstHearAbout" class="custom-select first-hear-select" id="first-hear">
                          <option disabled value="">Select only one</option>
                          <option value="tikTok">TikTok</option>
                          <option value="reddit">Reddit</option>
                          <option value="facebook">Facebook</option>
                          <option value="youTube">YouTube</option>
                          <option value="classmate">Classmate/Friend</option>
                          <option value="school-instructor">School instructor</option>
                          <option value="search-engine">Search Engine</option>
                          <option value="etsy">Etsy</option>
                          <option value="other">Other</option>
                        </select>
                        <textarea name="other-textarea" class="form-control d-none"
                          placeholder="Please type another option here" id="form_group3_other"></textarea>
                      </div>
                    </div>
                  </div>
                </form>
                <!-- /Form -->

                <div class="box-footer">
                  <button :disabled="whenGraduateMonth=='' || whenGraduateYear=='' || firstHearAbout==''"
                    id="submit" type="submit" @click="nextStep()" href="#" class="btn btn-arrow">
                    Set up and continue
                    <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.72 0.71995C14.8606 0.5795 15.0512 0.50061 15.25 0.50061C15.4488 0.50061 15.6394 0.5795 15.78 0.71995L19.53 4.46995C19.6705 4.61058 19.7493 4.8012 19.7493 4.99995C19.7493 5.1987 19.6705 5.38932 19.53 5.52995L15.78 9.27995C15.7113 9.35364 15.6285 9.41274 15.5365 9.45373C15.4445 9.49472 15.3452 9.51676 15.2445 9.51854C15.1438 9.52032 15.0438 9.50179 14.9504 9.46407C14.857 9.42635 14.7722 9.37021 14.701 9.29899C14.6297 9.22777 14.5736 9.14294 14.5359 9.04955C14.4982 8.95616 14.4796 8.85613 14.4814 8.75543C14.4832 8.65473 14.5052 8.55541 14.5462 8.46341C14.5872 8.37141 14.6463 8.28861 14.72 8.21995L17.19 5.74995H1C0.801088 5.74995 0.610322 5.67093 0.46967 5.53028C0.329018 5.38963 0.25 5.19886 0.25 4.99995C0.25 4.80104 0.329018 4.61027 0.46967 4.46962C0.610322 4.32897 0.801088 4.24995 1 4.24995H17.19L14.72 1.77995C14.5795 1.63932 14.5007 1.4487 14.5007 1.24995C14.5007 1.0512 14.5795 0.860576 14.72 0.71995Z"
                        fill="white" />
                    </svg>
                  </button>
                  <a href="#" class="link">Skip this step</a>
                </div>
              </div>

              <!-- /============ STEP 1 ============ -->
              <!-- ============ STEP 2 ============ -->
              <div id="step2" class="step_last" v-if="step==2">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-8" style="text-align: left;">
                      <h1>Thanks!<br>Ready to use<br>SimpleNursing!</h1>
                      <!-- illustration-mike-cartoon.jpg -->

                      <button :disabled="fetching_data" @click="submitAnswers()" type="submit"
                        class="btn btn-lg btn-primary btn-prominent">
                        Get&nbsp;started
                        <span v-if="fetching_data" class="spinner-border spinner-border-sm" role="status"
                          aria-hidden="true"></span>
                      </button>
                      <div v-if="errorMessage" v-html="errorMessage">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /============ STEP 2 ============ -->
              </div>
            </div>
          </div>
        </section>
      </div>




  </div>
  </main>
</div>
<!-- /main -->



<script>
  jQuery(document).ready(function ($) {

    $('#month,#Year,#first-hear').change(function () {
      var month_value = $("#month option:selected").val();
      var year_value = $("#Year option:selected").val();
      var first_hear_value = $("#first-hear option:selected").val();

      if (month_value !== '' && year_value !== '') {
        jQuery('#form_group3').removeClass('d-none');
        jQuery('.steps-nav li:first-child').addClass('done');
        jQuery('.steps-nav li:first-child').removeClass('current');
        jQuery('.steps-nav li:last-child').addClass('current');

        if($("#first-hear option:selected").val()!==''){
          jQuery('.steps-nav li:last-child').addClass('done');
          jQuery('.steps-nav li:last-child').removeClass('current');
        }
      } else {
        jQuery('#form_group3').addClass('d-none');
        jQuery('.steps-nav li:last-child').removeClass('current done');
      }

      if (first_hear_value === 'other') {
        jQuery('#form_group3_other').removeClass('d-none');
      } else {
        jQuery('#form_group3_other').addClass('d-none');
      }

      console.log($("#month option:selected").val());
      console.log($("#Year option:selected").val());
      console.log($("#first-hear option:selected").val());
    });


  })
</script>
