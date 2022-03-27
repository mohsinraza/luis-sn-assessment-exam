<?php



    require_once  get_stylesheet_directory() . '/inc/class-infusionsoft.php';



    wp_enqueue_script('vue-js', get_stylesheet_directory_uri() . '/vendors/vue.js', [], '2.6.11');

    wp_enqueue_script('axios', get_stylesheet_directory_uri() . '/vendors/axios.min.js', [], '0.19.2 ');



    wp_enqueue_script('sn-api', get_stylesheet_directory_uri() . '/js/class-api.js', ['jquery'], SN_ASSETS_VERSION, true);

    wp_enqueue_script('sn-vue-free-trial', get_stylesheet_directory_uri() . '/js/sn-vue-free-trial.js', ['vue-js'], SN_ASSETS_VERSION, true);



 ?>



<!-- Custom CSS -->

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/general.css?v=<?php echo SN_ASSETS_VERSION?>">

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/free_trial.css?v=<?php echo SN_ASSETS_VERSION?>">



<div id="app-free-trial">



    <div class="free-trial-logo">

      <a href="/" title="Go to home page">



        <!-- desktop & mobile logos -->

        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/logo-simple-nursing.svg" class="d-lg-block d-none" alt="SimpleNursing">

        <img class="logo1" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo-simple-nursing-white-v2.svg" class="d-lg-none d-inline-block" alt="SimpleNursing">



        <!-- mobile part 2 -->

        <img class="logo2" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo-simple-nursing.svg" style="display: none;" alt="SimpleNursing">

      </a>

    </div>





    <div class="container">

      <div class="row justify-content-end mb-2">

        <div class="col-lg-7 col-12">



          <header id="free-trial-header-short" class="free-trial-header-short" style="display: none;">

            <h1 tabindex="0">STEP <strong>{{formSteps}}</strong> OF <strong>{{formStepsMax}}</strong></h1>

          </header>



          <header id="free-trial-header" class="free-trial-header">

            <h1 tabindex="0">

              Try SimpleNursing<br>

              <strong>FREE</strong> for five days

            </h1>



            <div><strong>No commitment.</strong> Cancel anytime.</div>

          </header>





          <main>

            <form v-on:submit="submitForm" action="#" method="post">



              <!-- STEP 1 -->

              <div step-ref="step1">

                <h2 tabindex="0">Which <strong>membership</strong> are <br class="d-lg-none d-block">you most interested in?</h2>

                <ul class="box-options">



                    <li v-html="item.name" v-bind:id="item.id" class="box-options__item" v-for="item in items" :key="item.id" @click="stepSelectMembershipType(item)">

                    </li>



                </ul>

              </div>

              <!-- /STEP 1 -->





              <!-- STEP 2 -->

              <div step-ref="step2" style="display: none;">

                <h2 class="mt-5" tabindex="0">Enter your information to get started</h2>



                <div v-if="error_message" v-html="error_message" class="alert alert-danger" role="alert">

                </div>



                <section class="form-wrapper">

                  <div class="row mb-2">

                    <div class="col-6">

                      <input class="w-100" type="text" name="first_name"  v-model="first_name" placeholder="First name" required>

                    </div>

                    <div class="col-6">

                      <input class="w-100" type="text" name="last_name"  v-model="last_name" placeholder="Last name" required>

                    </div>



                    <div class="clearfix"></div>

                  </div>



                  <div class="mb-2">

                    <input class="w-100" type="email" name="email_address"  v-model="email_address" placeholder="Email address" required>

                  </div>



                  <button :disabled="details_empty() || fetching_data" obj-ref="btn-step2" v-on:click="stepEnterInformation" class="btn btn-lg btn-primary" >

                      Create Password

                      <span v-if="fetching_data" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                  </button>

                </section>

              </div>

              <!-- /STEP 2 -->







              <!-- STEP 3 -->

              <div step-ref="step3" style="display: none;">

                <h2 class="h2 mb-2">

                  <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon-free-trial-signed-up.svg" alt="SimpleNursing Join for Free">

                  <strong>Well done!</strong>

                </h2>

                <div class="subtitle">

                  Now, you just need to create your credentials.

                </div>



                <div v-if="error_message_password" v-html="error_message_password" class="alert alert-danger" role="alert">

                </div>



                <div class="mb-2">

                  <div class="info-check">

                    <strong>Your username is:</strong><br>

                    {{email_address}}

                  </div>

                  <input class="w-100" name="password" type="password"  v-model="password" placeholder="Create a password">

                </div>



                <button

                    v-if="membership_type!='premium_free_with_subscription'"

                    :disabled="password=='' || fetching_data"

                    v-on:click="stepCreatePassword"

                    obj-ref="btn-step4"

                    class="btn btn-lg btn-primary"

                    >

                  Save & Login

                  <span v-if="fetching_data" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                </button>



                <button

                    v-if="membership_type=='premium_free_with_subscription'"

                    :disabled="password=='' || fetching_data"

                    v-on:click="stepSelectMembershipPlan" obj-ref="btn-step4"

                    class="btn btn-lg btn-primary">

                  Save & Login

                  <span v-if="fetching_data" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                </button>







              </div>

              <!-- /STEP 3 -->



              <!-- STEP 4 -->

              <div step-ref="step4" style="display: none;">

                  <h2 class="h2 mb-2">

                    <strong>Try SimpleNursing FREE for five days</strong>

                  </h2>

                  <div class="features-list">

                    <ul>

                      <li><strong>1,000+</strong> fun and visual videos with memory tricks included</li>

                      <li><strong>500+</strong> study guides and cheat sheets</li>

                      <li><strong>Quiz Bank</strong> loaded with practice questions</li>

                    </ul>

                  </div>



                  <div class="font-size-small mb-3">Choose the plan that’s right for you:</div>



                  <ul class="box-options mb-5">

                    <li id="plan_monthly" @click="selectPaymentPlan('monthly')" class="box-options__item box-options__item--pricing">

                      <div class="box-options__item--pricing__msg">Pay once to get access<br>

                      <strong>Try for 5 days</strong></div>

                      <div class="box-options__item--pricing__period">Monthly</div>

                      <div class="box-options__item--pricing__price">$39</div>

                      <div class="box-options__item--pricing__discount box-options__item--pricing__discount--empty">

                        <strong>---</strong>

                        <br><br>

                        <s>---</s>

                        ---

                      </div>

                    </li>

                    <li id="plan_1_year" @click="selectPaymentPlan('1_year')" class="box-options__item box-options__item--pricing">

                      <div class="box-options__item--pricing__msg">Pay once to get access<br>

                      <strong>Try for 5 days</strong></div>

                      <div class="box-options__item--pricing__period">1 Year</div>

                      <div class="box-options__item--pricing__price">$199</div>

                      <div class="box-options__item--pricing__discount">

                        <strong>$16.6/mo</strong>

                        <br><br>

                        <s>$468</s>&nbsp&nbsp&nbsp

                        Save 57%

                      </div>

                    </li>

                    <li id="plan_2_year" @click="selectPaymentPlan('2_year')" class="box-options__item box-options__item--pricing">

                      <div class="box-options__item--pricing__msg">Pay once to get access<br>

                      <strong>Try for 5 days</strong></div>

                      <div class="box-options__item--pricing__period">2 Years</div>

                      <div class="box-options__item--pricing__price">$288</div>

                      <div class="box-options__item--pricing__discount">

                        <strong>$12/mo</strong>

                        <br><br>

                        <s>$936</s>&nbsp&nbsp&nbsp

                        Save 69%

                      </div>

                    </li>

                  </ul>



                  <div v-if="error_message" v-html="error_message" class="alert alert-danger" role="alert">

                  </div>



                  <button

                    :disabled="!paymentURL || fetching_data"

                    v-on:click="submitFiveDayTrial"

                    obj-ref="btn-step4"

                    class="btn btn-lg btn-primary mb-2">

                    Start a 5 Day Free Trial

                    <span v-if="fetching_data" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                  </button>



                  <div class="text_color_light_gray" style="margin-bottom: 80px; font-size: 12px; line-height: 18px;">

                        Your card <strong>will not be charged</strong> until your free trial expires (5 days).<br>

                        If you have any questions, call (702) 819-6645<br>

                        <strong class="text_color_pink">No commitment, cancel anytime.</strong>

                  </div>

                </div>

                <!-- /STEP 4 -->



            </form>

          </main>



        </div>

      </div>

    </div>



    <footer>

      <div>

        <a href="https://members.simplenursing.com">Log in</a>

        &nbsp;&nbsp;&nbsp;&nbsp;

        <a href="/help/" target="_blank">Support</a>

      </div>

      <div>

        By signing up you agree to our

        <a href="/privacy-policy/" target="_blank">Terms & Conditions</a>

      </div>

    </footer>

</div>

