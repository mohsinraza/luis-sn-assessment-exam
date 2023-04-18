<?php 

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://a.klaviyo.com/api/profile-subscription-bulk-create-jobs/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"data\":{\"type\":\"profile-subscription-bulk-create-job\",\"attributes\":{\"list_id\":\"XE5KQ5\",\"custom_source\":\"Marketing Event\",\"subscriptions\":[{\"channels\":{\"email\":[\"MARKETING\"],\"sms\":[\"MARKETING\"]},\"email\":\"mohsinraza.work@yahoo.com\",\"phone_number\":\"+13478845669\",\"profile_id\":\"01GY63J1S87X00CC65VSMRF2XP\"}]}}}",
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

?>
