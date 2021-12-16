<?php
define('SN_ASSETS_VERSION', '211210.9');
define('SN_ASSETS_URL', get_stylesheet_directory_uri());

require_once 'inc/class-sn-school.php';
require_once 'inc/class-sn-schools.php';
require_once 'inc/shortcodes.php';
require_once 'inc/rest-schools-endpoints.php';

// set wpApiSettings to send authentication to rest api
add_action('wp_footer', 'sn_set_api_settings', 5);

// initialize rest
$sn_rest_schools = new SN_REST_SCHOOLS();

// set wpApiSettings to send authentication to rest api
function sn_set_api_settings() {
   wp_localize_script( 'simplenursing', 'wpApiSettings', array(
      'root' => esc_url_raw( rest_url() ),
      'nonce' => wp_create_nonce( 'wp_rest' )
   ) );
}
