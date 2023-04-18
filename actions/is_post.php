<?php
/*
 * Script to parse InfusionSoft post calls to CRM
 * https://github.com/klaviyo/klaviyo-api-php
*/
// load WP
require('../wp-load.php');
use KlaviyoAPI\KlaviyoAPI;

$_POST['action'] = "add_to_ns_free_trial";
sn_init_post();

function sn_init_post() {

    if(!isset($_POST['action'])){
        echo 'no action';
        return;
    } elseif ($_POST['action']=='add_to_ns_free_trial') {
        add_to_ns_free_trial();
    }
}

/*
 *
*/
function add_to_ns_free_trial() {
    // if (!isset($_POST['contact_email'])) return;
    // $contact_email = $_POST['contact_email'];

    // variables that will come from $_POST
    $contact_email = "liam@simplenursing.com";
    $contact_first_name = "Liam";
    $contact_last_name = "SN";
    $contact_phone = "+17143358184"; //Liam
    $list_id ="XE5KQ5"; // list ID

    sn_log_file($contact_email, "testing");
    // $result = add_tag_to_klaviyo_contact($contact_email, $tag_name);

    $klaviyo = new KlaviyoAPI(
        KLAVIYO_API,
        $num_retries = 3,
        $wait_seconds = 3);
    // $response = $klaviyo->Metrics->getMetrics();



    // 1. LOOK FOR EXISTING EMAIL
    $fields_profile="";
    $filter="any(email,[\"$contact_email\"])";
    $page_cursor ="";
    $sort ="";
    $page_size = 1;
    try {

       $result = $klaviyo->Profiles->getProfiles($fields_profile=$fields_profile, $filter=$filter, $page_cursor=$page_cursor, $sort=$sort, $page_size=$page_size);
       // echo "<pre>";
       // var_dump($profile_id);
       if (!empty($result["data"])) {
           $profile_id = ($result["data"][0]["id"]);
           $found_contact=true;
           echo "FOUND ID: ".$profile_id;
         } else  {
          $found_contact=false;
         }
    } catch (Exception $e) {
            $found_contact=false;
            echo "NOT FOUND ID (Error): ".$e->getCode();
      if ($e->getCode() == 404) {

      }
    }

    // 2. Create if doesn't exist
    if (!$found_contact) {
        $properties = array(
            "data" => array(
                'type' => 'profile',
                'attributes' => array(
                    'email' => $contact_email,
                    'first_name' => $contact_first_name,
                    'last_name' => $contact_last_name,
                    "phone_number"=> $contact_phone
                )
            )
        );

        try {
           $result = $klaviyo->Profiles->createProfile($properties);
           $profile_id = ($result["data"]["id"]);
           echo "CREATED ID: $profile_id";
           var_dump($result);
        } catch (Exception $e) {
            var_dump($e->getCode());
            var_dump($e->getMessage());
         //
         // // duplicated
         //  if ($e->getCode() == 409) {
         //    echo "ITs Duplicated!";
         //  }
        }
    }

    // 3. Add to list
    $related_resource ="profiles";
    $body =  array(
        "data" => array(
            'type' => 'profile',
            'id' => $profile_id // Profile ID
        ));
    try {
        $result = $klaviyo->Lists->createListRelationships($list_id, $related_resource, $body);
        echo "<br>Contact Added to LIST<br><br>";
    } catch (Exception $e) {
      if ($e->getCode() == 404) {
        echo "No Profile (ERROR): " .$e->getCode();
      }
    }

    // die();



$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://a.klaviyo.com/api/profile-subscription-bulk-create-jobs/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"data\":{\"type\":\"profile-subscription-bulk-create-job\",\"attributes\":{\"list_id\":\"$list_id\",\"custom_source\":\"Marketing Event\",\"subscriptions\":[{\"channels\":{\"email\":[\"MARKETING\"],\"sms\":[\"MARKETING\"]},\"email\":\"$contact_email\",\"phone_number\":\"$contact_phone\",\"profile_id\":\"$profile_id\"}]}}}",
  CURLOPT_HTTPHEADER => [
    "Authorization: Klaviyo-API-Key pk_0ddbf9022d7129e7fb4c0734ea0a285f05",
    "accept: application/json",
    "content-type: application/json",
    "revision: 2023-02-22"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

}
