<?php
//Local REST endpoints and actions

class SN_REST extends WP_REST_Controller {

    function __construct() {
        add_action( 'rest_api_init',  array($this, 'register_routes') );
    }

  /**
   * Register the routes for the objects of the controller.
   */
  public function register_routes() {
    $version = '1';
    $namespace = 'simplenursing/v' . $version;
    $base = 'action';
    register_rest_route( $namespace, '/' . $base, array(
      array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => array( $this, 'action_get' ),
        // 'permission_callback' => array( $this, 'action_get_check' ),
        'args'                => array(
        ),
    ),
      array(
        'methods'             => WP_REST_Server::EDITABLE,
        'callback'            => array( $this, 'action_update' ),
        // 'permission_callback' => array( $this, 'action_update_check' ),
        'args'                => $this->get_endpoint_args_for_item_schema( false ),
      )
    )
    );

  }

  /**
   * Get current_action on request
   *
   * @param mixed $action action to perform.
   * @param mixed $items json decoded WP_REST_Request.
   * @return mixed response for endpoint
   */
  private function do_action($action, $params) {

      switch ($action) {
          case 'test':
              return $this->test();
              break;
          case 'create_is_user':
              return $this->create_is_user($params);
              break;
          case 'create_buddy_user':
              return $this->create_buddy_user($params);
              break;
          case 'contact_exists_in_infusionsoft':
              return $this->contact_exists_in_infusionsoft($params);
              break;
          case 'update_password':
              return $this->update_password($params);
              break;
          case 'upload_review_data':
              return $this->upload_review_data($params);
              break;
          case 'send_form_institutions':
              return $this->send_form_institutions($params);
              break;
          default:
              return array('status' => false, 'msg' => 'Unknown action.');
              break;
          }
  }

  /**
   * Action to get data from endpoint
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|WP_REST_Response
   */
  public function action_get( $request ) {
    $items = $request->get_json_params();
    $data = array();

    $current_action = $this->current_action($items);

    // Exist action
    $current_action = $this->current_action($items);
    if ($current_action) $data = $this->do_action($current_action, $items);
       else $data=array("status"=> false, "msg"=> "No action defined.");

       return new WP_REST_Response( $data, 200 );

  }

  /**
   * Check if a given request has access to get items
   *
   * @param WP_REST_Request $request Full data about the request.
   * @return WP_Error|bool
   */
  public function action_get_check( $request ) {
    return true;
    //return current_user_can( 'edit_something' );
  }

  /**
  * Do Action
  *
  * @param WP_REST_Request $request Full data about the request.
  * @return WP_Error|WP_REST_Response
  */
 public function action_update( $request ) {
     $items = $request->get_json_params();
     // $item = $this->prepare_item_for_database( $request );

     // Exist action
     $current_action = $this->current_action($items);
     if ($current_action) $data = $this->do_action($current_action, $items);
        else $data=array("status"=> false, "msg"=> "No action defined.");

   return new WP_REST_Response( $data, 200 );

   //return new WP_Error( 'cant-update', __( 'Can\'t update strategy manager', 'text-domain' ), array( 'status' => 500 ) );
 }

/*
 * Check permissions (only allow admin to update strategy manager)
*/
 public function action_update_check( $request ) {
   return true;
 }

  /**
   * Prepare the item for create or update operation
   *
   * @param WP_REST_Request $request Request object
   * @return WP_Error|object $prepared_item
   */
  protected function prepare_item_for_database( $request ) {
    return array($request);
  }

  /**
   * Prepare the item for the REST response
   *
   * @param mixed $item WordPress representation of the item.
   * @param WP_REST_Request $request Request object.
   * @return mixed
   */
  public function prepare_item_for_response( $item, $request ) {
    return array($item);
  }

  /**
   * Get current_action on request
   *
   * @param mixed $items json decoded WP_REST_Request.
   * @return mixed false  if no "action" exists on body, action_name if it exists
   */
  private function current_action($items) {
      if ($items) {
          foreach( $items as $key => $value ) {
              if ($key=="action") return $value;
          }
      }
      return false;
  }

    /* Test function */
    private function test() {
        $is = new SN_INFUSIONSOFT();
        $is_test = $is->test();
         return array('status' => true, 'msg' => $is_test);
    }

    // Update the user password
    public function update_password($params) {
        // validate inputs
        if (!array_key_exists("password", $params)) {
            return array('status' => false, 'msg' => 'Password missing');
        } else if (!array_key_exists("email_address", $params)) {
                return array('status' => false, 'msg' => 'Email missing');
            } else {
            $is = new SN_INFUSIONSOFT();

            // sanitize
            $email_address=sanitize_text_field($params['email_address']);
            $is_password = $params['password'];
            $is_users = $is->get_contact_by_email($email_address);
            // If contact found
            if (count($is_users->contacts)>0) {
                $is_user_data = $is_users->contacts[0];

                $fields=array(
                    "custom_fields" => array(
                        array(
                        "content"=>$is_password,
                        "id"=> 106
                    )));
                $result = $is->update_contact($is_user_data->id, $fields);
                return array('status' => true, 'msg' => $result);
            } else {
                return array('status' => false, 'msg' => 'No contact found');
            }
        }
    }

    // Get IS user
    function contact_exists_in_infusionsoft($params) {
        // validate inputs
        if (!array_key_exists("email_address", $params)) {

            return array('status' => false, 'msg' => 'Email Address missing');

        } else {
            $email_address = sanitize_text_field($params['email_address']);

            $is = new SN_INFUSIONSOFT();
            $is_user_contacts = $is->get_contact_by_email($email_address);

            // user already exists, send password
            if ($is_user_contacts->count>0) {
                $user = $is_user_contacts->contacts[0];
                return array('status' => true);
            } else {
                return array('status' => false);
            }
		}
	}

    // Add some extra validations for the buddy campaign.
    // Call the create_is_user
    private function create_buddy_user($params) {
        // validate inputs
            if (!array_key_exists("email_address", $params)) {
                return array('status' => false, 'msg' => 'Email Address missing');
            }

            $email_address = sanitize_text_field($params['email_address']);
            $is_user = new SN_INFUSIONSOFT_USER();

            // Find existing contacts in IS
            $data = $is_user->load_contact_by_email($email_address);

            // if user already exists
            if ($is_user->contact_loaded) {
                // Check user already is a premium member by IS_MEMBERSHIP
                // $is_user = $is_user_contacts->contacts[0];
                // $is_user_id = $is_user->id;
                $has_tag_id = $is_user->has_tag_id(IS_MEMBERSHIP);

                if ($has_tag_id) {
                    return array(
                        'status' => false,
                        'msg' => 'You already have a Premium Account',
                        'user' => $is_user
                     );
                }

            }
            // If everything is OK, create the user
            $user_created = $this->create_is_user($params);

            // If something went wrong on creating the user
            if ($user_created['status']==FALSE) {
                return array(
                    'status' => false,
                    'msg'=>$user_created['msg']
                );
            }

            // If there is ref_id, store value
            if (array_key_exists("ref_id", $params)) {
                $is_user_created = new SN_INFUSIONSOFT_USER();
                // Load the new user
                $data = $is_user_created->load_contact_by_email($email_address);
                // update ref_id
                $is_user_created->update_contact_custom_field(IS_CAMPAIGN_REFERRAL_ID,$params['ref_id']);
            }

            return $user_created;
    }

    // Create InfusionSoft user
    private function create_is_user($params) {
        // validate inputs
            if (!array_key_exists("email_address", $params)) {
                return array('status' => false, 'msg' => 'Email Address missing');
            } elseif (!array_key_exists("password", $params)) {
                return array('status' => false, 'msg' => 'Password missing');
                } elseif (!array_key_exists("first_name", $params)) {
                    return array('status' => false, 'msg' => 'First Name missing');
                } elseif (!array_key_exists("last_name", $params)) {
                        return array('status' => false, 'msg' => 'Last Name missing');
                        } else {

                            // Validate the origin URL, to just accept connections from the site
                            $origin = $_SERVER['HTTP_ORIGIN'];
                            if ($origin!='https://simplenursing.com') {
                                return array('status' => false, 'msg' => 'ERROR 404');
                            }

                            $email_address = sanitize_text_field($params['email_address']);
                            $is = new SN_INFUSIONSOFT();

                            $is_user_contacts = $is->get_contact_by_email($email_address);

                            // Build payload
                            // Call this to get custom fields ID https://developer.infusionsoft.com/docs/rest/#!/Contact/retrieveContactModelUsingGET
                            $fields =  array(
                                "email_addresses" => array(
                                    array(
                                    "field"=>"EMAIL1",
                                    "email"=>$email_address
                                    )
                                ),
                                "given_name"=> $params['first_name'],
                                "family_name"=> $params['last_name'],
                                "opt_in_reason"=> "Free Trial",
                                // Custom Fields
                                "custom_fields" => array(
                                    array(
                                        "content"=> $params['country'],
                                        "id"=> 108
                                    ),
                                        array(
                                            "content"=> $params['password'],
                                            "id"=> 106
                                        ),
                                     array(
                                         "content"=> $params['utm_source'],
                                         "id"=> 92
                                     ),
                                     array(
                                         "content"=> $params['utm_medium'],
                                         "id"=> 94
                                     ),
                                     array(
                                         "content"=> $params['utm_campaign'],
                                         "id"=> 96
                                     ),
                                     array(
                                         "content"=> $params['utm_term'],
                                         "id"=> 98
                                     ),
                                     array(
                                         "content"=> $params['utm_content'],
                                         "id"=> 100
                                     ),
                                     //TEAS Which Nursing Program
                                     array(
                                         "content"=> $params['question_applying_nursing'],
                                         "id"=> 118
                                     ),
                                     //TEAS When Expecting Graduate
                                     array(
                                         "content"=> $params['question_graduation_expected'],
                                         "id"=> 120
                                     ),
                                     //TEAS Which Entrance Exam
                                     array(
                                         "content"=> $params['question_which_exam'],
                                         "id"=> 122
                                     ),
                                     //TEAS How Did You Hear
                                     array(
                                         "content"=> $params['question_how_you_ear'],
                                         "id"=> 124
                                     ),
                                     // membership_plan
                                     array(
                                         "content"=> $params['membership_plan'],
                                         "id"=> 164
                                     ),
                                 )
                             );

// $to = 'luis@simplenursing.com';
// $subject = 'IS';
// $body = "Contact Details:<br /> " . implode("<br />", $params);
// $body .= "<br />Origin: " .$origin;
// $headers[] = 'Content-Type: text/html';
// $headers[] = 'charset=UTF-8';
// $headers[] = 'From: Simple Nursing <help@simplenursing.com>';
//
// $email_sent = wp_mail( $to, $subject, $body, $headers );

                            // if user already exists, update contact
                            if ($is_user_contacts->count>0) {
                                    $is_user_data=$is_user_contacts->contacts[0];
                                    $is_user_created = $is->update_contact($is_user_data->id, $fields);
                                    $contact_status='update';
                            } else {
                                $is_user_created = $is->create_contact($fields);
                                $contact_status='create';
                            }

                             // If user created, start IS sequence with goals
                             if ($is_user_created->id) {

                                 // Check if there is an active membership already
                                 $is_user = new SN_INFUSIONSOFT_USER();
                                 $is_user->load_contact_by_id($is_user_created->id);
                                 $has_active_membership = $is_user->has_tag_id(IS_MEMBERSHIP);
                                 if ($has_active_membership) {
                                     return array(
                                         'status' => false,
                                         'msg' => 'There is already an active membership for this email.'
                                     );
                                 }

                                 $goal_name='';
                                 switch ($params['membership_type']) {
                                    case 'nursing':
                                        $goal_name='createContactNursing';
                                        $active_membership_tag = IS_ACTIVE_MEMBERSHIP_FREE_TRIAL;
                                        break;
                                    case 'premium_free_with_subscription':
                                        $goal_name='createPremiumFreeTrialSubscription';
                                        $active_membership_tag = IS_ACTIVE_PREMIUM_FREE_TRIAL_WITH_SUBSCRIPTION;
                                        break;
                                    case 'teas_free_trial':
                                        $goal_name='createContactTEASFreeTrial';
                                        break;
                                    case 'teas':
                                        $goal_name='createContactTEAS';
                                        break;
                                    case 'nclex':
                                        $goal_name='createContactNCLEX';
                                        $active_membership_tag = IS_ACTIVE_MEMBERSHIP_FREE_TRIAL_NCLEX;
                                        break;
                                    case 'nclex_pn':
                                        $goal_name='createContactNCLEXPN';
                                        $active_membership_tag = IS_ACTIVE_MEMBERSHIP_FREE_TRIAL_NCLEX_PN;
                                        break;
                                    case 'campaign_buddy':
                                        $goal_name='createContactCampaignBuddy';
                                        break;
                                };

                                  $goal_result = $is->create_api_goal($is_user_created->id, $goal_name);


                                  if ($goal_result[0]->success == false) {
                                      return array(
                                          'status' => false,
                                          'msg'=>'Error creating contact, please contact support and send this error code: NO_GOAL_APPLIED',
                                          'goal_result'=>$goal_result[0]
                                      );
                                  } else {
                                      // If user added to sequence, add FREE TRIAL tag because InfusionSoft doesn't apply the tags immediately
                                      // Campaign_buddy add full access
                                      if ($params['membership_type']=='campaign_buddy') {

                                          $tag_result = $is->apply_user_tag($is_user_created->id, IS_MEMBERSHIP);
                                          $tag_result = $is->apply_user_tag($is_user_created->id, IS_CAMPAIGN_STUDY_WITH_A_BUDDY);
                                          return array('status' => true,"contact_status"=>$contact_status, "tag_result"=>$tag_result, "user_created"=>$is_user_created);

                                      } elseif ($params['membership_type']=='teas') {

                                                $tag_result = $is->apply_user_tag($is_user_created->id, IS_TEAS);
                                                return array('status' => true,"contact_status"=>$contact_status, "tag_result"=>$tag_result, "user_created"=>$is_user_created);

                                            } elseif ($params['membership_type']=='teas_free_trial') {

                                                      $tag_result = $is->apply_user_tag($is_user_created->id, IS_TEAS_FREE_TRIAL);
                                                      return array('status' => true,"contact_status"=>$contact_status, "tag_result"=>$tag_result, "user_created"=>$is_user_created);

                                                  } elseif($params['membership_type']=='premium_free_with_subscription') {

                                                        // New Premium Free Trial with subscription (apply access tag because IS takes a few minutes)
                                                        $tag_result = $is->apply_user_tag($is_user_created->id, IS_PREMIUM_FREE_TRIAL_WITH_SUBSCRIPTION);
                                                        // apply the active membership free trial tag, because the welcome questions need this information to show the correct questions
                                                        //$tag_result = $is->apply_user_tag($is_user_created->id, $active_membership_tag);
                                                        return array('status' => true,"contact_status"=>$contact_status, "tag_result"=>$tag_result, "user_created"=>$is_user_created);

                                                    } else {

                                                        // Regular FREE TRIALS
                                                        $tag_result = $is->apply_user_tag($is_user_created->id, IS_FREE_TRIAL);
                                                        // apply the active membership free trial tag, because the welcome questions need this information to show the correct questions
                                                        $tag_result = $is->apply_user_tag($is_user_created->id, $active_membership_tag);
                                                        return array('status' => true,"contact_status"=>$contact_status, "tag_result"=>$tag_result, "user_created"=>$is_user_created);

                                                    }
                                  }

                             } else {
                                 return array('status' => false, 'msg'=>'Error creating contact, please contact support and send this error code: NO_CONTACT_CREATED');
                             }

                        }
    }


    // Add some extra validations for the buddy campaign.
    // Call the upload_review_data
    private function upload_review_data($params) {
        // validate inputs
            if (!array_key_exists("email_address", $params)) {
                return array('status' => false, 'msg' => 'Email Address missing');
            }
            if (!array_key_exists("first_name", $params)) {
                return array('status' => false, 'msg' => 'First name missing');
            }
            if (!array_key_exists("last_name", $params)) {
                return array('status' => false, 'msg' => 'Last name missing');
            }
            if (!array_key_exists("street_address", $params)) {
                return array('status' => false, 'msg' => 'Street Address missing');
            }
            if (!array_key_exists("city", $params)) {
                return array('status' => false, 'msg' => 'City missing');
            }
            if (!array_key_exists("state", $params)) {
                return array('status' => false, 'msg' => 'State missing');
            }
            if (!array_key_exists("zip", $params)) {
                return array('status' => false, 'msg' => 'Zipcode missing');
            }
            if (!array_key_exists("file_trust_pilot", $params)) {
                return array('status' => false, 'msg' => 'Trustpilot screenshot missing');
            }
            if (!array_key_exists("file_app_store", $params)) {
                return array('status' => false, 'msg' => 'Appstore screenshot missing');
            }

            $author_name = $params["first_name"] . ' ' . $params["last_name"];
            $email_address = $params["email_address"];
            $street_address = $params["street_address"];
            $suite = $params["suite"];
            $city = $params["city"];
            $state = $params["state"];
            $zip = $params["zip"];

            // Create 2 media attachments
            $title_trust_pilot = $params["first_name"] . '_' . $params["last_name"]. '_trustpilot' ;
            $title_trust_pilot = preg_replace( '/[^a-z0-9]+/', '-', strtolower( $title_trust_pilot ) );
            $base64_img = $params["file_trust_pilot"];
            $attachment_id = save_image( $base64_img, $title_trust_pilot );
            $file_trust_pilot_url = wp_get_attachment_url( $attachment_id );

            $title_app_store = $params["first_name"] . '_' . $params["last_name"]. '_appstore' ;
            $title_app_store = preg_replace( '/[^a-z0-9]+/', '-', strtolower( $title_app_store ) );
            $base64_img = $params["file_app_store"];
            $attachment_id = save_image( $base64_img, $title_app_store );
            $file_app_store_url = wp_get_attachment_url( $attachment_id );

            $to = "help@simplenursing.com, tech@simplenursing.com";
// $to = " tech@simplenursing.com";
            $subject = "New Review Submission!";
            $body = "NAME: $author_name<br />";
            $body .= "EMAIL: $email_address<br />";
            $body .= "STREET ADDRESS: $street_address<br />";
            $body .= "APP/SUITE: $suite<br />";
            $body .= "CITY: $city<br />";
            $body .= "ZIP CODE: $zip<br />";
            $body .= "STATE: $state<br />";
            $body .= "<a href='$file_trust_pilot_url'>TrustPilot Screenshot</a><br />";
            $body .= "<a href='$file_app_store_url'>AppStore Screenshot</a><br />";
            // Send Email
            $email_sent = sn_send_email($to, $subject, $body);

            $body_log="$author_name|$email_address|$street_address|$suite|$city|$zip|$file_trust_pilot_url|$file_app_store_url";
            // Log in File with |
            sn_log_file($author_name, $body_log);

            $return = array(
                    "email_sent"=>$email_sent
            );

            return array(
                'status' => true,
                'return' => $return
            );

    }

    // Send form to Johnny for institution contats
    private function send_form_institutions($params) {

        $answers = $params["answers"];
        // validate inputs
            if (!array_key_exists("first_name", $answers)) {
                return array('status' => false, 'msg' => 'First Name missing');
            }
            if (!array_key_exists("last_name", $answers)) {
                return array('status' => false, 'msg' => 'Last name missing');
            }
            if (!array_key_exists("email", $answers)) {
                return array('status' => false, 'msg' => 'Email missing');
            }
            if (!array_key_exists("institution", $answers)) {
                return array('status' => false, 'msg' => 'Institution missing');
            }
            if (!array_key_exists("job_title", $answers)) {
                return array('status' => false, 'msg' => 'Job Title missing');
            }

            $to = 'john@simplenursing.com';
            $subject = 'New Institution Contact Form';
            $body = "Contact Details:<br /> " . implode("<br />", $answers);
            $headers[] = 'Content-Type: text/html';
            $headers[] = 'charset=UTF-8';
            $headers[] = 'From: Simple Nursing <help@simplenursing.com>';

            $email_sent = wp_mail( $to, $subject, $body, $headers );

            if ($email_sent) {
                return array(
                    'status' => true,
                    'answers' => $answers
                );
            } else {
                return array(
                    'status' => false,
                    'msg' => "Email not sent, please contact us to help@simplenursing.com"
                );
            }

    }

} // Class
