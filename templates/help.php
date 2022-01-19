<?php
    $user_email='';
    $user_password='';
?>

<?php get_template_part('template-parts/header/menu', 'mobile'); ?>

<div class="body_content">

      <?php get_template_part('template-parts/sidebar/left-sidebar'); ?>

      <!-- body_content__wrapper -->
      <div class="body_content__wrapper">
        <div class="text-center">

          <!-- hero_dashboard -->
          <div class="hero_dashboard hero_dashboard--internal hero_dashboard--no_picture">

            <?php get_template_part('template-parts/header/menu','links'); ?>

            <?php get_template_part('template-parts/header/search','form'); ?>

            <div class="clearfix"></div>

            <div class="warning_ghost"></div>



            <h1 tabindex="0">
              Help
            </h1>

          </div>
          <!-- /hero_dashboard -->


          <!-- main -->
         <main class="main--internal ">

         <div class="container mb-5">
          <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-10 col-12 text-center">
              <div class="hero-inner-page">
                  <p class="page_welcome__headline page_welcome__headline--small">
                      How would you like to contact us?
                </p>
              </div>
            </div>
          </div>
         </div>


         <div class="container">

          <div class="row">
            <div class="col-md-4 col-12">
              <div class="contact_card">
                <a href="email">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon-contact-email.svg" alt="">
                  <div class="contact_card__title">Email Us</div>
                  <div>Send us a message and someone will respond during normal business hours</div>
                </a>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="contact_card">
                <a href="text">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon-contact-text.svg" alt="">
                  <div class="contact_card__title">Text Us</div>
                  <div>
                      Shoot us a text and someone will respond during normal business hours
                  </div>
                </a>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="contact_card">
                <a href="call">
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon-contact-call.svg" alt="">
                  <div class="contact_card__title">Call Us</div>
                  <div>Give us a call during normal business hours, or leave a message and we'll get back to you</div>
                </a>
              </div>
            </div>
          </div>

          <div style="border-top: 1px solid #E3E3E3; margin-top: 56px; padding-top: 24px;">
            <div class="row">
              <div class="col-md-3 col-12">
                <div>
                  <p class="font-size font-size--large">SimpleNursing</p>
                  <p style="color: #655F5F; font-size: 14px;">2780 South Jones Blvd. #200-3939<br>
                  Las Vegas NV 89146</p>
                </div>
              </div>
              <div class="col-md-3 col-12">
                <div>
                  <p class="font-size font-size--large">Hours of Operation</p>
                  <p style="color: #655F5F; font-size: 14px;">Monday — Friday<br>
                  9:00am - 6:00pm Pacific Time</p>
                </div>
              </div>
            </div>
          </div>

         </div>



         </main>
         <!-- /main -->


          <footer class="footer_dashboard">
            Copyright © 2021 SimpleNursing.com. All Rights Reserved.
          </footer>

        </div>
      </div>
      <!-- /body_content__wrapper -->

    </div>


        <!-- Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <div class="modal-body">
                  <iframe src="https://simplenursing.com/members/rest-change-pwd/?username=<?php echo $user_email ?>&password=<?php echo $user_password ?>" width="100%" height="300" frameborder="0" allowtransparency="true"></iframe>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php get_template_part('template-parts/footer/footer', 'main'); ?>
