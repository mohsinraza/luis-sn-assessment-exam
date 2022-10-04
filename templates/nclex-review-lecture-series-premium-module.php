<?php
    wp_enqueue_script('simplenursing-vue-nclex-review-lecture-premium', get_stylesheet_directory_uri() . '/js/simplenursing-vue-nclex-review-lecture-premium.js', ['vue-js'], SN_ASSETS_VERSION, true);
    wp_enqueue_style('nclex-review-lecture', get_stylesheet_directory_uri() . '/css/nclex-review-lecture-module.css', [], SN_ASSETS_VERSION);
?>

        <?php get_template_part('template-parts/header/menu','links'); ?>

    <!-- main -->
    <main>

      <!-- watch -->
      <section class="watch">

        <!-- watch__player -->
        <div class="watch__player">
          <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/sUFeuEON9h4" title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
          <?php 
          $video_locked_url = "https://d1pumg6d5kr18o.cloudfront.net/new/fundamentals/1_nursing_process_2_adpie/part.m3u8";
          echo do_shortcode('[fvplayer src="'.$video_locked_url.'"]') ; 
          ?>
        </div>
        <!-- /watch__player -->

        <!-- description for mobile screens --->
        <div class="watch__description d-md-none d-block text-left">
          <div class="watch__description__title">
            What is Schizophrenia? Therapeutic Communication Nursing
          </div>
          <div class="watch__description__summary">
            Schizophrenia is a type of mental disorder that leads to a cluster of symptoms comprising of...
            <br><strong>Read more</strong>
          </div>
        </div>

        <!-- watch__playlist -->
        <div class="watch__playlist">
          <div class="watch__playlist__tabs">
            <ul>
              <li tab-ref="videos" class="watch__playlist__tabs__item watch__playlist__tabs__item--active">Lessons (6)</li
              ><li tab-ref="notes" class="watch__playlist__tabs__item">My notes</li>
            </ul>
          </div>

          <!-- watch__playlist__videos -->
          <div content-ref="videos" class="watch_content watch__playlist__videos text-left">
            <p>6 videos • 2 hr 30 min</p>

            <ul>
              <li class="watch__playlist__videos__item text-left">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-5.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                    <div class="watch__playlist__videos__item__info__watched">
                      Watched
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-6.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                    <div class="watch__playlist__videos__item__info__watching_now">
                      Watching now
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-7.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-5.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-6.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-7.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-5.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-6.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
              <li class="watch__playlist__videos__item">
                <a href="#">
                  <div class="watch__playlist__videos__item__thumbnail">
                    <img src="<?php echo SN_ASSETS_URL ?>/images/dashboard/_placeholder-lecture-series-7.jpg" alt="Lesson 1">
                  </div>
                  <div class="watch__playlist__videos__item__info">
                    <div class="watch__playlist__videos__item__info__title">
                      Lorem ipsum dolor sit amet amenit
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </a>
              </li>
            </ul>
          </div>
          <!-- /watch__playlist__videos -->

          <!-- watch__playlist__notes -->
          <div content-ref="notes" class="watch_content watch__playlist__notes" style="display: none;">
            <ul>
              <li note-ref="1" class="watch__playlist__notes__item">
                <div class="watch__playlist__notes__item__title">
                  Lesson 1
                  <span class="watch__playlist__notes__item__title__watching_now">
                    Watching now
                  </span>
                </div>
                <div class="watch__playlist__notes__item__note">

                  <div class="watch__playlist__notes__item__note__textarea">
                    <textarea name="">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquet leo eget mi convallis pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque laoreet sapien velit, at blandit dui ultrices a. Sed sed nibh eros. Mauris at iaculis eros. Ut orci libero, tincidunt in ante vitae, vulputate sollicitudin ipsum. Suspendisse potenti. Vestibulum eget enim sit amet leo iaculis pretium.</textarea>
                    <button role="button" class="save btn btn-black mb-2 mr-2" href="#">Save</button
                    ><button role="button" class="discard btn btn-outlined mb-2" href="#">Discard</button>
                  </div>

                  <div class="watch__playlist__notes__item__note__static">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquet leo eget mi convallis pulvinar.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;
                    Pellentesque laoreet sapien velit, at blandit dui ultrices a. Sed sed nibh eros. Mauris at iaculis eros.
                    Ut orci libero, tincidunt in ante vitae, vulputate sollicitudin ipsum. Suspendisse potenti.
                    Vestibulum eget enim sit amet leo iaculis pretium.
                  </div>
                </div>
              </li>
              <li note-ref="2" class="watch__playlist__notes__item">
                <div class="watch__playlist__notes__item__title">
                  Lesson 2
                </div>
                <div class="watch__playlist__notes__item__note">
                  <div class="watch__playlist__notes__item__note__textarea">
                    <textarea name="" placeholder="Write your notes..."></textarea>
                    <button role="button" class="save btn btn-black mb-2 mr-2" href="#">Save</button
                    ><button role="button" class="discard btn btn-outlined mb-2" href="#">Discard</button>
                  </div>
                  <div class="watch__playlist__notes__item__note__static watch__playlist__notes__item__note__static--empty">
                    Write your notes...
                  </div>
                </div>
              </li>
              <li note-ref="3" class="watch__playlist__notes__item">
                <div class="watch__playlist__notes__item__title">
                  Lesson 3
                </div>
                <div class="watch__playlist__notes__item__note">
                  <div class="watch__playlist__notes__item__note__textarea">
                    <textarea name="" placeholder="Write your notes..."></textarea>
                    <button role="button" class="save btn btn-black mb-2 mr-2" href="#">Save</button
                    ><button role="button" class="discard btn btn-outlined mb-2" href="#">Discard</button>
                  </div>
                  <div class="watch__playlist__notes__item__note__static watch__playlist__notes__item__note__static--empty">
                    Write your notes...
                  </div>
                </div>
              </li>
              <li note-ref="4" class="watch__playlist__notes__item">
                <div class="watch__playlist__notes__item__title">
                  Lesson 4
                </div>
                <div class="watch__playlist__notes__item__note">
                  <div class="watch__playlist__notes__item__note__textarea">
                    <textarea name="" placeholder="Write your notes..."></textarea>
                    <button role="button" class="save btn btn-black mb-2 mr-2" href="#">Save</button
                    ><button role="button" class="discard btn btn-outlined mb-2" href="#">Discard</button>
                  </div>
                  <div class="watch__playlist__notes__item__note__static watch__playlist__notes__item__note__static--empty">
                    Write your notes...
                  </div>
                </div>
              </li>
              <li note-ref="5" class="watch__playlist__notes__item">
                <div class="watch__playlist__notes__item__title">
                  Lesson 5
                </div>
                <div class="watch__playlist__notes__item__note">
                  <div class="watch__playlist__notes__item__note__textarea">
                    <textarea name="" placeholder="Write your notes..."></textarea>
                    <button role="button" class="save btn btn-black mb-2 mr-2" href="#">Save</button
                    ><button role="button" class="discard btn btn-outlined mb-2" href="#">Discard</button>
                  </div>
                  <div class="watch__playlist__notes__item__note__static watch__playlist__notes__item__note__static--empty">
                    Write your notes...
                  </div>
                </div>
              </li>
              <li note-ref="6" class="watch__playlist__notes__item">
                <div class="watch__playlist__notes__item__title">
                  Lesson 6
                </div>
                <div class="watch__playlist__notes__item__note">
                  <div class="watch__playlist__notes__item__note__textarea">
                    <textarea name="" placeholder="Write your notes..."></textarea>
                    <button role="button" class="save btn btn-black mb-2 mr-2" href="#">Save</button
                    ><button role="button" class="discard btn btn-outlined mb-2" href="#">Discard</button>
                  </div>
                  <div class="watch__playlist__notes__item__note__static watch__playlist__notes__item__note__static--empty">
                    Write your notes...
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- /watch__playlist__notes -->

        </div>
        <!-- /watch__playlist -->

        <div class="clearfix"></div>

        <!-- description for non-mobile screens --->
        <div class="watch__description d-md-block d-none text-left">
          <div class="watch__description__title">
            What is Schizophrenia? Therapeutic Communication Nursing
          </div>
          <div class="watch__description__summary">
            Schizophrenia is a type of mental disorder that leads to a cluster of symptoms comprising of delusions,
            hallucinations, alogia, apathy and cognitive symptoms. Hallucinations and delusions are usually the positive symptoms,
            while alogia and cognitive symptoms are negative.
          </div>
        </div>

      </section>
      <!-- /watch -->



    </main>
    <!-- /main -->





    <script>
      jQuery(document).ready(function ($) {

        $('[data-toggle="tooltip"]').tooltip();

        function showMobileMenu () {
          $('.aside_main').css('left', 0);
          $('.aside_main__close').show();
          $('.black_overlay').fadeIn(200);
          $('.header_mobile').addClass('filter_blur');
          $('.body_content__wrapper').addClass('filter_blur');
        }

        function hideMobileMenu () {
          $('.aside_main').css('left', '-296px');
          $('.aside_main__close').hide();
          $('.black_overlay').fadeOut(200);
          $('.header_mobile').removeClass('filter_blur');
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

        $('.loggedIn__menu__avatar').click(function () {
          $('.loggedIn__menu ul').fadeToggle('fast');
        });

        $('.toggle_menu').click(function () {
          $('#aside_menu').toggleClass('aside_main--compact');
        });


        // TABS
        var currentTab = 'videos';

        $('.watch__playlist__tabs__item').click(function () {
          $('.watch__playlist__tabs__item').removeClass('watch__playlist__tabs__item--active');
          $(this).addClass('watch__playlist__tabs__item--active');

          currentTab = $(this).attr('tab-ref');
          $('.watch_content').hide();
          $("[content-ref='" + currentTab + "']").show();
        });


        // NOTES
        var currentNote = null;
        $('.watch__playlist__notes__item__note').click(function () {
          currentNote = $(this).closest('li').attr('note-ref');
          $('[note-ref="' + currentNote +'"] .watch__playlist__notes__item__note__static').hide();
          $('[note-ref="' + currentNote +'"] .watch__playlist__notes__item__note__textarea').show();
          $('[note-ref="' + currentNote +'"] .watch__playlist__notes__item__note__textarea textarea').focus();
        });

        $('.save').click(function () {
          closeNote();
          currentNote = null;
          return false
        });

        $('.discard').click(function () {
          if(confirm("Are you sure you want to discard your note?")){
            closeNote();
            currentNote = null;
          }
          return false;
        });

        function closeNote() {
          $('[note-ref="' + currentNote +'"] .watch__playlist__notes__item__note__static').show();
          $('[note-ref="' + currentNote +'"] .watch__playlist__notes__item__note__textarea').hide();
        }



      });
    </script>
