<?php

require_once 'inc/rest-endpoints.php';
require_once 'inc/class-infusionsoft.php';
// require_once 'inc/class-wp-user-extended.php';
require_once 'inc/class-infusionsoft-user.php';
require_once 'inc/shortcodes/shortcodes.php';

$sn_rest_route = new SN_REST();

// define('SN_ASSETS_VERSION', rand());
define('SN_ASSETS_VERSION', '20220321.3');
// how many articles on the seo related articles list
define('SN_RELATED_ARTICLES_LIST_MAX', 4);

// InfusionSoft Tags
define('IS_MONTHLY', 269); //monthly membership
define('USER_CANCELED_MONTHLY_MEMBERSHIP', 2728);
define('IS_MEMBERSHIP', 225);
define('IS_TEAS', 2890); // Freemium
define('IS_TEAS_FREE_TRIAL', 2952);
define('IS_HESI', 2251);
define('IS_FREE_TRIAL', 241);
define('IS_PREMIUM_FREE_TRIAL_WITH_SUBSCRIPTION', 2994);
define('IS_FREE_TRIAL_NCLEX', 2271);
define('IS_NCLEX', 2241);
define('IS_QUIZ_BANK', 2281);
define('IS_STUDY_GUIDES', 2355);
define('IS_LECTURE', 2359);
define('IS_LIFETIME', 2618);
// expired tags
define('IS_EXPIRED_FREE_TRIAL', 2676);
define('IS_EXPIRED_MEMBERSHIP', 2680);
//campaigns
define('IS_CAMPAIGN_BUDDY_PHONE', 127);
define('IS_CAMPAIGN_REFERRAL_ID', 125);

// from Membership Active Plans
define('IS_CAMPAIGN_STUDY_WITH_A_BUDDY', 2886);
define('IS_ACTIVE_MEMBERSHIP_FREE_TRIAL', 2818);
define('IS_ACTIVE_MEMBERSHIP_FREE_TRIAL_NCLEX', 2820);
define('IS_ACTIVE_MEMBERSHIP_FREE_TRIAL_NCLEX_PN', 3044);
	//new free trial with subscriptions
define('IS_ACTIVE_PREMIUM_FREE_TRIAL_WITH_SUBSCRIPTION', 2992);

// all selected related articles, to prevent duplicating related articles in seo posts
$seo_selected_related_articles=[];
// selected related articles to list section
$seo_selected_list_articles=[];
// Array with pages ID that need bootstrap enqueued
// global $sn_bootstrap_pages;
// $sn_bootstrap_pages=[
// 	3143, ///nclex/
// 	8252, ///nclex-b/
// 	8656, ///nclex-version-b/
// 	8658, ///nclex-version-a/
// 	8490 ///pricing/
// ];

// TEMPORARY hide payment
// add_action('woocommerce_review_order_before_submit', 'sn_hide_payment_methods', 9 );

// Add US as default country
add_filter( 'default_checkout_billing_country', 'sn_woo_billing_country_us' );
// Clean the cart before adding a new product
add_filter('woocommerce_add_to_cart_validation', 'sn_only_one_in_cart', 99, 2 );
add_filter('add_to_cart_redirect', 'sn_redirect_add_to_cart');
// add_filter('woocommerce_checkout_get_value','__return_empty_string', 1, 1);
/* Populate Cart Checkout fields */
add_filter( 'woocommerce_checkout_get_value' , 'sn_checkout_populate', 20, 2 );
// Add password field to checkout
add_filter( 'woocommerce_checkout_fields' , 'sn_woo_add_password_to_checkout' );
// Store utm parameters in cookies for free trial
add_action('init', 'sn_store_cookies');
// Redirect a user to a specific country site (canada, etc) if detected in IP
add_action ('wp_loaded', 'sn_redirect_to_ip_country');


// Store cart parameters in cookie from users that come from members site
add_action('init', 'sn_cart_cookies');
// add privacy policy checkbox
add_action('woocommerce_review_order_before_submit', 'sn_add_checkout_privacy_policy', 9 );

// Show notice if customer does not select the privacy policy
add_action( 'woocommerce_checkout_process', 'sn_not_approved_privacy' );
add_action('woocommerce_review_order_before_payment', 'klarna_slice_checkout_message');
// Save sn_password custom field in order meta
add_action( 'woocommerce_checkout_create_order', 'sn_woo_save_password', 10, 2);
// Add button to send to member site
add_action( 'woocommerce_thankyou', 'sn_woo_add_contact', 1);
add_action('after_setup_theme', 'avada_lang_setup' );
add_action('wp_enqueue_scripts', 'theme_enqueue_styles' );
add_action('wp_enqueue_scripts', 'theme_dequeue_styles' , 100);
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts');


// set wpApiSettings to send authentication to rest api
add_action( 'wp_footer', 'sn_set_api_settings', 5);

//Add Featured image URL to REST API posts
add_action('rest_api_init', 'sn_rest_add_featured_image');

function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' , array('wp-bootstrap-starter-style', 'wp-bootstrap-starter-bootstrap-css', 'wp-bootstrap-starter-fontawesome-cdn'));
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), SN_ASSETS_VERSION );
	wp_enqueue_style( 'sn-simplenursing', get_stylesheet_directory_uri() . '/simplenursing.css', array('child-style'), SN_ASSETS_VERSION );
	wp_enqueue_style( 'sn-general-style', get_stylesheet_directory_uri() . '/css/general.css', array('child-style'), SN_ASSETS_VERSION );
	wp_enqueue_style( 'sn-seopages-style', get_stylesheet_directory_uri() . '/css/seo_pages.css', array('child-style'), SN_ASSETS_VERSION );
	wp_enqueue_style('sn-owl-carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.min.css', array( ) );
	wp_enqueue_style('sn-owl-carousel-theme', get_stylesheet_directory_uri() . '/css/owl.theme.default.min.css', array( ) );

}

function theme_dequeue_styles(){
	wp_dequeue_style('wp-bootstrap-starter-simplex');
}

function theme_enqueue_scripts() {
    wp_enqueue_script('sn-owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], SN_ASSETS_VERSION, true);
	wp_enqueue_script('sn-helpers', get_stylesheet_directory_uri() . '/js/helpers.js', ['jquery'], SN_ASSETS_VERSION, true);
	wp_enqueue_script('simplenursing-script', get_stylesheet_directory_uri() . '/js/simplenursing.js', array( 'jquery' ), SN_ASSETS_VERSION,true );
}

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}

// Enqueue styles and scripts.
function lity_enqueue() {
	global $post;

	if ( 2795 === $post->ID ) {
		wp_enqueue_style( 'lity-style', get_stylesheet_directory_uri() . '/css/lity.min.css', array(), null, 'all' );
		wp_enqueue_script( 'lity-script', get_stylesheet_directory_uri() . '/js/lity.min.js', array( 'jquery' ), null, true );
	}
}


function sn_only_one_in_cart( $passed, $added_product_id ) {

// empty cart first: new item will replace previous
wc_empty_cart();

return $passed;
}




function sn_redirect_add_to_cart() {
    global $woocommerce;
    $cw_redirect_url_checkout = $woocommerce->cart->get_checkout_url();

    return $cw_redirect_url_checkout;
}

/*
 * Store cart parameters in cookie from users that come from members site
*/
function sn_cart_cookies(){
	$path = '/';
	$host = parse_url(get_option('siteurl'), PHP_URL_HOST);
	$expiry = strtotime('+1 hour');
	$billing_email = $billing_first_name = $billing_last_name = $billing_phone ='';
	$billing_address_1 = $billing_address_2 = $billing_postcode = $billing_state = $billing_city = $billing_country = '';

	// billing email is required in all cookies
	if (isset($_GET['billing_email']) && !empty($_GET['billing_email'])) {
	 	$billing_email = $_GET['billing_email'];

		if (isset($_GET['billing_first_name'])) $billing_first_name = $_GET['billing_first_name'];
		if (isset($_GET['billing_last_name'])) $billing_last_name = $_GET['billing_last_name'];
		if (isset($_GET['billing_phone'])) $billing_phone = $_GET['billing_phone'];
		if (isset($_GET['billing_address_1'])) $billing_address_1 = $_GET['billing_address_1'];
		if (isset($_GET['billing_address_2'])) $billing_address_2 = $_GET['billing_address_2'];
		if (isset($_GET['billing_postcode'])) $billing_postcode = $_GET['billing_postcode'];
		if (isset($_GET['billing_state'])) $billing_state = $_GET['billing_state'];
		if (isset($_GET['billing_city'])) $billing_city = $_GET['billing_city'];
		if (isset($_GET['billing_country'])) $billing_country = $_GET['billing_country'];

		$json_object=array(
			'billing_email'=>$billing_email,
			'billing_first_name'=>$billing_first_name,
			'billing_last_name'=>$billing_last_name,
			'billing_phone'=>$billing_phone,
			'billing_address_1'=>$billing_address_1,
			'billing_address_2'=>$billing_address_2,
			'billing_postcode'=>$billing_postcode,
			'billing_state'=>$billing_state,
			'billing_city'=>$billing_city,
			'billing_country'=>$billing_country,
		);
		$json = json_encode($json_object);

		setcookie('sn_cart', $json, $expiry, $path, $host);
	}

}


/* Populate Cart Checkout fields */
function sn_checkout_populate( $value, $input ) {

	if(isset($_COOKIE['sn_cart'])) {

		$cleaned_cookie = stripslashes($_COOKIE['sn_cart']);
		$sn_cart = json_decode($cleaned_cookie);

		if (isset($sn_cart->billing_email) && $input == 'billing_email') $value = $sn_cart->billing_email;
		if (isset($sn_cart->billing_first_name) && $input == 'billing_first_name') $value = $sn_cart->billing_first_name;
		if (isset($sn_cart->billing_last_name) && $input == 'billing_last_name') $value = $sn_cart->billing_last_name;
		if (isset($sn_cart->billing_phone) && $input == 'billing_phone') $value = $sn_cart->billing_phone;
		if (isset($sn_cart->billing_address_1) && $input == 'billing_address_1') $value = $sn_cart->billing_address_1;
		if (isset($sn_cart->billing_address_2) && $input == 'billing_address_2') $value = $sn_cart->billing_address_2;
		if (isset($sn_cart->billing_postcode) && $input == 'billing_postcode') $value = $sn_cart->billing_postcode;
		if (isset($sn_cart->billing_state) && $input == 'billing_state') $value = $sn_cart->billing_state;
		if (isset($sn_cart->billing_city) && $input == 'billing_city') $value = $sn_cart->billing_city;
		// if (isset($sn_cart->billing_country) && $input == 'billing_country') $value = $sn_cart->billing_country;
	}



    return $value;
}

function sn_add_checkout_privacy_policy() {

  global $woocommerce;
    $items = $woocommerce->cart->get_cart();
        foreach($items as $item => $values) {
            $_product =  wc_get_product( $values['data']->get_id());
           // echo "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>';
            $price = '$'.get_post_meta($values['product_id'] , '_price', true);
			$product_id = $values['product_id'];
        }

	// If monthly membership, different message
	if ($product_id==4640) {
		woocommerce_form_field( 'privacy_policy', array(
			'type'          => 'checkbox',
			'class'         => array('form-row privacy'),
			'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
			'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
			'required'      => true,
			'label'         => 'By placing this order, I authorize Simple Nursing to charge my card <b>'.$price.'</b> now, as well as <b>'.$price.'</b> on this day each month while my membership is active. I understand that I can cancel my membership at any time in the Settings tab of the membership area. As long as I cancel before my renewal date, my card will not be charged. I also understand that SimpleNursing does not authorize refunds for the monthly subscription membership level and that all sales are final. Lastly, I agree not to share my account with anyone. I understand that if I violate this agreement, my membership will be terminated and I will not receive a refund.',
		));
	} else {
		woocommerce_form_field( 'privacy_policy', array(
			'type'          => 'checkbox',
			'class'         => array('form-row privacy'),
			'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
			'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
			'required'      => true,
			'label'         => 'By placing this order, I authorize SimpleNursing to charge my card <b>'.$price.'</b>, minus any applicable promotional discounts. I understand that refunds are only issued on annual or NCLEX<sup>®</sup> memberships, only if I contact SimpleNursing within 48 hours of purchase, and incur a 10% processing fee with a minimum of $10 and a maximum of $25. Lastly, I agree not to share my account with anyone. I understand that if I violate this agreement, my membership will be terminated and I will not receive a refund.',
		));
	}
}




function sn_not_approved_privacy() {
    if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
        wc_add_notice( __( 'Please acknowledge the Privacy Policy before the place order button.' ), 'error' );
    }
}



/**
 * If there is a recurring product in cart, don't show klarna message
**/
function klarna_slice_checkout_message(){

	// Set $cat_in_cart to false
	$cat_in_cart = false;

	// Loop through all products in the Cart
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

	    // If Cart has category "recurring", set $cat_in_cart to true
	    if ( has_term( 'recurring', 'product_cat', $cart_item['product_id'] ) ) {
	        $cat_in_cart = true;
	        break;
	    }
		// If Cart has category "free", set $cat_in_cart to true
		if ( has_term( 'free', 'product_cat', $cart_item['product_id'] ) ) {
			$cat_in_cart = true;
			break;
		}
	}

	// If there is a recurring product in cart, don't show klarna message
	if ( $cat_in_cart ) return;

    ?>
   <div class="klarna_checkout_message">
	<h1 class="payment_arrangment">Are you interested in a payment arrangement?</h1>
	<p class="slice_msg">
		You can now use Klarna to split this total into 4 equal payments! Your first payment is due when you sign up and then every two weeks until the balance is paid. We don't charge you any interest! If you'd like to take advantage of this payment arrangement, please take the following action:
		<ol>
			<li>Click the "payment arrangement" box</li>
			<li>Scroll down and click the Charge authorization box</li>
			<li>Pick place order</li>
		</ol>
		(Don't click the credit card box or enter your credit card details yet)
	</p>
  </div>
<?php
}

/************************************/



function sn_enqueue_bootstrap() {

	wp_enqueue_style( 'sn-normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css', array('parent-style-css'  ) );
	wp_enqueue_style( 'sn-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array( 'parent-style-css' ) );

	wp_enqueue_script( 'sn-bootstrap-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ));
	wp_enqueue_script( 'sn-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ));

	wp_dequeue_style('avada-stylesheet');
}


function sn_enqueue_custom_css() {
	wp_enqueue_style( 'sn-general-style', get_stylesheet_directory_uri() . '/css/general.css', array(  ), SN_ASSETS_VERSION );
	wp_enqueue_style( 'sn-seopages-style', get_stylesheet_directory_uri() . '/css/seo_pages.css', array(  ), SN_ASSETS_VERSION );
}

/* Select a single related article */
function sn_seo_related_article() {
	$related_article_slug=sn_get_random_article();
	$sn_related_page = get_page_by_path($related_article_slug);
	include get_stylesheet_directory() . '/templates/partials/seo-related-article.php';
}

/* Create related articles list */
function sn_seo_article_list() {
	global $seo_selected_list_articles;

	$seo_selected_list_articles = sn_get_random_article_list();
	include get_stylesheet_directory() . '/templates/partials/seo-related-list.php';
}

/*
 * Get random article from list, except $current_article
*/
function sn_get_random_article_list() {
	$article_list=[];

	$seo_related_articles=sn_get_seo_articles();

	global $post;
	$post_slug = $post->post_name;
	// Remove current article
	$cleaned_articles = array_diff($seo_related_articles, array($post_slug));
	// select SN_RELATED_ARTICLES_LIST_MAX random articles
	$selected_articles = array_rand ( $cleaned_articles, SN_RELATED_ARTICLES_LIST_MAX);

	foreach($selected_articles as $single_article) {
		$article_list[] = $cleaned_articles[$single_article];
	}

	return $article_list;
}

/*
 * Get random article from list, except $current_article
*/
function sn_get_random_article() {
	global $seo_selected_related_articles;

	$seo_related_articles=sn_get_seo_articles();

	// Remove current article
	global $post;
	$post_slug = $post->post_name;
	$cleaned_articles = array_diff($seo_related_articles, array($post_slug));
	// Remove previously selected articles
	$cleaned_articles = array_diff($cleaned_articles, $seo_selected_related_articles);
	// select new random
	$selected_article = array_rand ( $cleaned_articles);
	// add random article to selected articles
	$seo_selected_related_articles[] = $seo_related_articles[$selected_article];

	return $seo_related_articles[$selected_article];
}

/* All SEO articles for related lists */
function sn_get_seo_articles() {
	$args = array(
	    'post_type' => 'page',
		'orderby' => 'rand',
		'order' => 'ASC',
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'page_category',
	            'field'    => 'slug',
	            'terms'    => 'nclex-review',
	        ),
	    ),
	);
	$query = get_posts( $args );
	$seo_related_articles=[];
	foreach ($query as $page) {
		$seo_related_articles[] = $page->post_name;
	}
	return $seo_related_articles;
}

/**
 * Add Featured image URL to REST API posts
 */
function sn_rest_add_featured_image()
{
  // Featured Image URL
  register_rest_field(
    'post',
    'featured_image_src',
    array(
      'get_callback'    => 'sn_rest_program_featured_image',
      'update_callback' => null,
      'schema'          => null,
    )
  );
}

/**
 * Callback add featured image field
 */
function sn_rest_program_featured_image($object, $field_name, $request)
{
  if ($object['featured_media']) {
    $img = wp_get_attachment_image_src($object['featured_media'], 'large');
    return $img[0];
  }
  return '';
}


function sn_woo_billing_country_us() {
  return 'US';
}

// set wpApiSettings to send authentication to rest api
function sn_set_api_settings() {
   wp_localize_script( 'simplenursing-script', 'wpApiSettings', array(
      'root' => esc_url_raw( rest_url() ),
      'nonce' => wp_create_nonce( 'wp_rest' )
   ) );
}





function sn_woo_add_password_to_checkout( $fields ) {
  $fields['billing']['sn_password']['required'] = true;
  $fields['billing']['sn_password']['placeholder'] = 'Create your SimpleNursing Membership Password';
  $fields['billing']['sn_password']['label'] = 'Account Password';
  $fields['billing']['sn_password']['type'] = 'password';

  $fields['billing']['billing_email']['placeholder'] = 'What is your email address? (this will also be your SimpleNursing Membership username)';

  return $fields;
}


/*
 * sn_password is a custom field on the checkout, and it needs to be saven in the order meta
*/
function sn_woo_save_password( $order, $data ) {

    $custom_fields = array(
        'sn_password',
    );

    foreach ( $custom_fields as $field_name ) {
        if ( isset( $data[ $field_name ] ) ) {
            $meta_key = '_' . $field_name;
            $field_value = $data[ $field_name ]; // WC will handle sanitation
            $order->update_meta_data( $meta_key, $field_value );
        }
    }

};


/*
	If it's a new user, update the password in InfusionSoft contact
   	InfusedWoo creates the contact if new.
	Adds SimpleNursing tag to give immediate access to user
*/
function sn_woo_add_contact( $order_id ){

	$order = new WC_Order( $order_id );

	// get password
	$is_password = $order->get_meta('_sn_password');
	$email_address = $order->get_billing_email();

	// find user in IS
	$is = new SN_INFUSIONSOFT();
	$is_users = $is->get_contact_by_email($email_address);

	// If contact found
	if (count($is_users->contacts)>0) {
		$is_user_data = $is_users->contacts[0];

		// if password is not the default value for existing users, update password field
		if ($is_password!=='000000000') {
			// update the password to InfusionSoft custom field
			$fields=array(
				"custom_fields" => array(
					array(
					"content"=>$is_password,
					"id"=> 106
				)));
			$result = $is->update_contact($is_user_data->id, $fields);
		}

		// give immediate access
		$tag_result = $is->apply_user_tag($is_user_data->id, IS_MEMBERSHIP);
	}

	?>
	<div v-if="secondsToFinish>0">
		<div class="d-flex justify-content-center">
			<div class="spinner-border" role="status" style="width: 3rem; height: 3rem;">
	  	    <span class="sr-only">Loading...</span>
	  	  </div>
		</div>

	  	<div class="text-center">
			We are preparing your account, please wait:
			{{secondsToFinish}}
		</div>
	</div>

   <p v-if="secondsToFinish==0" class="order-again text-center">
	    Your account is ready, you can access it immediately.
		<a class="btn btn-cta d-block w-100 mt-2" href="https://members.simplenursing.com">
			MEMBERS SITE
		</a>
   </p>
<?php
}

/* Temporary: show or hide payment methods for testing BrainTree */
function sn_hide_payment_methods() {

  global $woocommerce;
  $is_nclex=false;
    $items = $woocommerce->cart->get_cart();
        foreach($items as $item => $values) {
            $_product =  wc_get_product( $values['data']->get_id());
           // echo "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>';
            $price = '$'.get_post_meta($values['product_id'] , '_price', true);
			$product_id = $values['product_id'];
			$terms = get_the_terms( $product_id, 'product_cat' );

			if (count($terms)>0) {
				if ($terms[0]->name == 'NCLEX') {
					$is_nclex = true;
				}
			}


        }
		if ($is_nclex):
		?>
			<style>

				.wc_payment_method.payment_method_infusionsoft {
					display: none;
				}

				.wc_payment_method.payment_method_braintree_cc {
					display: block;
				}

			</style>
		<?php
		endif;
}

/* Store UTM parameters in cookies for free trial */
function sn_store_cookies() {
	$path = '/';
	$host = parse_url(get_option('siteurl'), PHP_URL_HOST);
	$expiry = strtotime('+1 month');
	$utm_source = $utm_medium = $utm_campaign = $utm_term = $utm_content = '';

	// billing email is required in all cookies
	if (isset($_GET['utm_source']) && !empty($_GET['utm_source'])) {
	 	$utm_source = $_GET['utm_source'];

		if (isset($_GET['utm_medium'])) $utm_medium = $_GET['utm_medium'];
		if (isset($_GET['utm_campaign'])) $utm_campaign = $_GET['utm_campaign'];
		if (isset($_GET['utm_term'])) $utm_term = $_GET['utm_term'];
		if (isset($_GET['utm_content'])) $utm_content = $_GET['utm_content'];

		$json_object=array(
			'utm_source'=>$utm_source,
			'utm_medium'=>$utm_medium,
			'utm_campaign'=>$utm_campaign,
			'utm_term'=>$utm_term,
			'utm_content'=>$utm_content
		);
		$json = json_encode($json_object);

		setcookie('sn_utm', $json, $expiry, $path, $host);
	}
}

/**
 * Redirect a user to a country site if detected in IP
**/
function sn_redirect_to_ip_country() {

    if (!function_exists( 'geoip_detect2_get_info_from_current_ip' )) return;

    if (is_admin()) return;

    $ip_record = geoip_detect2_get_info_from_current_ip();
    // get visitor country isoCode
    $iso_code = $ip_record->country->isoCode;

    // If visitor is in same country as domain, return
    if ($iso_code == 'US') return;

    // get country domain to redirect
    $redirect_domain = sn_get_domain_from_isocode($iso_code);

    // if found a domain to redirect
    if ($redirect_domain!==FALSE) {
        //retrieve the url without the domain
        $req_uri = $_SERVER['REQUEST_URI'];
        $path = substr($req_uri,0,strrpos($req_uri,'/'));

		//
		// if ( get_post_type( get_the_ID() ) == 'post' ) {
		//     $path.='blog/';
		// }

        // redirect to the url on the new site
        $url = "https://$redirect_domain$path";
        wp_redirect( $url );
        exit;
    }
}

/* return a domain if isoCode is found or false */
function sn_get_domain_from_isocode($iso_code) {
    switch ($iso_code) {
        case 'US':
            return 'simplenursing.com';
            break;
		case 'CA':
            return 'simplenursing.ca';
            break;
        case 'IN':
            return 'simplenursing.co.in';
            break;
        case 'PH':
            return 'simplenursing.ph';
            break;
		// case 'PT':
        //     return 'simplenursing.ca';
        //     break;
        default:
            return false;
            break;
    }
}


function sn_offer_query_string( $name ) {
	get_template_part( 'template-parts/modals/modal-coupon-discount25');
    ?>
        <script>
            jQuery( document ).ready(function() {
				const urlParams = new URLSearchParams(window.location.search);
				const myParam = urlParams.get('offer');

				if (myParam=='discount25') {
					jQuery('#discount25').modal();
				}
            });
        </script>
    <?php
}
add_action( 'get_footer', 'sn_offer_query_string' );


/**
 * Save the image on the server.
 */
function save_image( $base64_img, $title ) {

	// Upload dir.
	$upload_dir  = wp_upload_dir();
	$upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

	// detect filetype
	$valid_filetype=false;
	if (str_contains($base64_img, 'image/jpeg')) {
		$file_type = 'image/jpeg';
		$file_extension = 'jpg';
		$valid_filetype=true;
	}

	if (str_contains($base64_img, 'image/png')) {
		$file_type = 'image/png';
		$file_extension = 'png';
		$valid_filetype=true;
	}

	// If none of the valid filetypes, error
	if (!$valid_filetype) return false;

	$img             = str_replace( 'data:'.$file_type.';base64,', '', $base64_img );
	$img             = str_replace( ' ', '+', $img );
	$decoded         = base64_decode( $img );
	$filename        = $title . '.' . $file_extension;
	// $file_type       = 'image/jpeg';
	$hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

	// Save the image in the uploads directory.
	$upload_file = file_put_contents( $upload_path . $hashed_filename, $decoded );

	$attachment = array(
		'post_mime_type' => $file_type,
		'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $hashed_filename ) ),
		'post_content'   => '',
		'post_status'    => 'inherit',
		'guid'           => $upload_dir['url'] . '/' . basename( $hashed_filename )
	);

	return wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $hashed_filename );
}



/**
 * Send an email
*/
function sn_send_email($to, $subject, $body) {
    $headers[] = 'Content-Type: text/html';
    $headers[] = 'charset=UTF-8';
    $headers[] = 'From: SimpleNursing <help@simplenursing.com>';

    return wp_mail( $to, $subject, $body, $headers );
};


/**
 * Send to log file
 * @param $title {string} A descriptive title from the log
 * @param $message {string} message to log
*/
function sn_log_file($title, $message) {
	$log_file = 'sn-logs.txt';
	$api_log = fopen(get_stylesheet_directory() . "/logs/" . $log_file, "a+");

	$message = "[" . date("Y-m-d H:i:s",time()) . " $title] $message \n";

	fwrite($api_log, $message);
	fclose($api_log);
}

function sn_back_to_school_campaign_active() {

	$today = date("Y-m-d H:i:s");
	// Times need to be set in UTC
	$start_campaign	= "2022-02-02 12:00:00"; //7:00am EST
	$end_campaign 	= "2022-02-07 07:59:59"; //3:00 am EST

	if ($today > $start_campaign && $today < $end_campaign)
	    return true;
	else
	    return false;

}

function sn_black_friday_campaign_active() {

	// $today = date("Y-m-d H:i:s");
	// Black Friday
	// $start_campaign	= "2021-11-24 06:00:00"; //1:00am EST
	// $end_campaign 	= "2021-11-29 08:00:00"; //3:00am EST
	// Cyber Monday
	// $start_campaign	= "2021-11-29 08:00:01"; //3:01am EST
	// $end_campaign 	= "2021-11-30 08:00:00"; //3:00am EST

	// if ($today > $start_campaign && $today < $end_campaign)
	//     return true;
	// else
	    return false;

}




function sn_remove_all_unused_scripts() {
	$deregistered_scripts=array(
		'hoverintent-js',
		'admin-bar',
		'elementor-animations'
	);
	foreach ($deregistered_scripts as $key => $script) {
		wp_dequeue_script( $script );
		wp_deregister_script( $script );
	}
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
	if (!is_admin()) {
		wp_deregister_script('wp-embed');
		wp_deregister_script('imagesloaded');
		wp_deregister_script('core-js');
	}
}




// First create a custom post type name 'Members'
function diwp_members_custom_post_type(){

    // Set labels for the custom post type

    $labels = array(
                     'name' => 'Members',
                     'singular_name' => 'Member',
                     'add_new'    => 'Add Member Plan',
                     'add_new_item' => 'Enter Member Details',
                     'all_items' => 'All Members',
                     'featured_image' => 'Add Poster Image',
                     'set_featured_image' => 'Set Poster Image',
                     'remove_featured_image' => 'Remove Poster Image'
                   );


    // Set Options for this custom post type;

    $args = array(
                    'public' => true,
                    'label'       => 'Members Plan',
                    'labels'      => $labels,
                    'description' => 'Members is a collection of Member Plan and their info',
                    'menu_icon'      => 'dashicons-video-alt2',
                    'supports'   => array( 'title', 'editor', 'thumbnail'),
                    'capability_type' => 'page',

                 );

    register_post_type('member_plan', $args);

}

add_action( 'init', 'diwp_members_custom_post_type' );


/**
 * Validate form with reCaptcha
 * Return true or false
 */
function recaptcha_validate($token) {
	if (!isset($token)) {
	   return false;
	}
	$siteverify = 'https://www.google.com/recaptcha/api/siteverify';
	$secret = '6LcAOAofAAAAAMMAcpHcp5uBcdhxSOH6l8HyPO1n';
	$response = file_get_contents($siteverify . '?secret=' . $secret . '&response=' . $token);
	$response = json_decode($response, true);
	return $response['success'];
}