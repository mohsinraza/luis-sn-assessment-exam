<?php
wp_enqueue_style( 'custom-share-css',get_stylesheet_directory_uri() . '/css/custom-share.css', [],  SN_ASSETS_VERSION);
wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js', [],  '1.0.0');
wp_enqueue_script( 'custom-share-js', get_stylesheet_directory_uri() . '/js/custom-share.js', [],  SN_ASSETS_VERSION);
?>

<!-- Button trigger modal -->
  <button type="button" class="btn btn-primary popupshare" data-bs-toggle="modal" data-bs-target="#share-popup" style="display:none;">
    share-popup
  </button>
   <!-- Modal -->
  <div class="modal fade" id="share-popup" tabindex="-1" aria-labelledby="share-popup" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered text-center">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
        <div class="modal-body col-12 col-lg-10 m-auto py-5">
          <h1 class="mb-0">Share this class with </br> your friends</h1>
          <div class="share-icon">
            <a href="#" onclick="facebook_share()"><i class="fab fa-facebook-square"></i></a>
            <a href="#" onclick="linkden_share()"><i class="fab fa-linkedin"></i></a>
            <a href="#" onclick="twitter_share()"><i class="fab fa-twitter"></i></a>
            <a href="mailto:?subject=Free Trial (NCLEX-RN) &#8211; SimpleNursing Members&body=Check it out using this link: https://simplenursing.com/free-trial"><i class="fas fa-envelope"></i></a>
          </div>
          <div class="copy-input">
            <button class="copy-button"><span id="copyText" onclick="copyfunction()" title="Copy link to clipboard">Copy</span></button>
            <input type="text" id="copy_link" data-testid="copy-input" value="https://simplenursing.com/free-trial">
          </div>
        </div>
      </div>
    </div>
  </div>
