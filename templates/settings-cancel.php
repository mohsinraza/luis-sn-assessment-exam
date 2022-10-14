<?php
// Load Vue Script
wp_enqueue_script('class-sn-settings-cancel', get_stylesheet_directory_uri() . '/js/simplenursing-vue-settings-cancel.js', ['vue-js'], SN_ASSETS_VERSION, true);
wp_enqueue_style( 'settings-cancel', get_stylesheet_directory_uri() . '/css/settings-cancel.css', [], SN_ASSETS_VERSION);

global $current_user;
global $sn_current_user;


?>


<div class="hero_dashboard hero_dashboard--nclex_special">

    <?php get_template_part('template-parts/header/menu','links'); ?>

    <div class="clearfix"></div>

    <h1 tabindex="0">
        Settings <span></span>
    </h1>

    <div class="hero_dashboard__post_h1">

    </div>
</div>

          <!-- main -->
  <main id="app-settings" class="main--internal">
    <div class="container">
      <div class="row">

        <div class="col-lg-8 col-12">

          <!-- settings -->
          <section class="settings">
            <h2 tabindex="0">Account</h2>

            <!-- settings__group -->
            <div class="settings__group">
              <div class="settings__group__label">
                Email
              </div>
              <div class="settings__group__value">
                <?php echo $user_email ?>
              </div>
            </div>
            <!-- /settings__group -->

            <!-- settings__group -->
            <div class="settings__group">
              <div class="settings__group__label">
                Password
              </div>
              <div class="settings__group__value">
                ******
                <!-- <span>Last changed on <strong>23/07/2019</strong></span> -->
              </div>
            </div>
            <!-- /settings__group -->

            <div class="settings__options">
              <ul>
                <!-- <li>
                  <a href="#">
                    Change account email
                  </a>
                </li> -->
                <li>
                  <a href="javascript:void()" data-toggle="modal" data-target="#changePasswordModalInfusionSoft">
                    Change password
                </a>
                </li>
              </ul>
            </div>
          </section>
          <!-- settings -->

          <?php

              set_query_var( 'settings', $settings );
              // Send to correct settings page, sort by the most important membership first
              if ($sn_current_user->has_membership && $sn_current_user->has_monthly) {
                      // Premium monthly
                      get_template_part('template-parts/settings/settings-membership-monthly');
                  }  elseif($sn_current_user->has_nclex_rn_monthly) {
                      // NCLEX RN monthly
                      get_template_part('template-parts/settings/settings-membership-monthly');
                  } elseif($sn_current_user->has_nclex_pn_monthly) {
                      // NCLEX PN monthly
                      get_template_part('template-parts/settings/settings-membership-monthly');
                  } elseif($sn_current_user->has_membership && !$sn_current_user->has_monthly) {
                      // Premium onetime
                      get_template_part('template-parts/settings/settings-membership');
                  } elseif ($sn_current_user->has_free_trial_premium_subscription) {
                      //Free Trial with Premium Subscription
                      get_template_part('template-parts/settings/settings-membership-premium-subscription');
                  } elseif ($sn_current_user->has_free_trial || $sn_current_user->has_free_trial_teas) {
                      //Free Trials
                      get_template_part('template-parts/settings/settings-free-trial');
                  } elseif($sn_current_user->has_teas_full && $sn_current_user->has_teas_monthly) {
                      // TEAS monthly (TEAS comes after the memberships, because they have lower priority)
                      get_template_part('template-parts/settings/settings-membership-monthly-teas');
                  } elseif($sn_current_user->has_teas_full && !$sn_current_user->has_teas_monthly) {
                      // TEAS onetime
                      get_template_part('template-parts/settings/settings-membership-teas');
                  }
              ?>

          <div id="upgrade-section" style="display:none">
              <?php get_template_part('template-parts/settings/upgrade-nursing'); ?>
          </div>


        </div>

      </div>
    </div>

    <a href="#modalCancelPremiumMembership" data-toggle="modal" class="text-left btn">CANCEL PREMIUM MEMBERSHIP!</a>
    <a href="#modalCancelNclexMembership" data-toggle="modal" class="text-left btn">CANCEL NCLEX MEMBERSHIP!</a>

    <!-- Cancel NCLEX Membership Modal -->
    <?php get_template_part('template-parts/modal/modal-cancel-nclex-membership'); ?>

    <!-- Cancel Premium Membership Modal -->
    <?php get_template_part('template-parts/modal/modal-cancel-premium-membership'); ?>


  </main>
<!-- /main -->

<script type="text/javascript">
    jQuery( document ).ready(function($) {
      $('#upgrade-membership').click(function(e) {
          e.preventDefault();
          $('#upgrade-section').show();
          $([document.documentElement, document.body]).animate({
            scrollTop: $("#upgrade-section").offset().top
        }, 1000);
      })
    });
</script>
