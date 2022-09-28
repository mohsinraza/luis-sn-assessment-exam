<?php
//Local REST endpoints and actions
// DEVELOPER: Mohsin

class SN_REST_DEV_2 extends WP_REST_Controller {

    function __construct() {
        add_action( 'rest_api_init',  array($this, 'register_routes') );
    }

  /**
   * Register the routes for the objects of the controller.
   */
  public function register_routes() {
    $version = '1';
    $namespace = 'simplenursing/v' . $version;
    $base = 'action_dev1';
    register_rest_route( $namespace, '/' . $base, array(
      array(
        'methods'             => WP_REST_Server::READABLE,
        'callback'            => array( $this, 'action_get' ),
        'permission_callback' => array( $this, 'action_get_check' ),
        'args'                => array(
        ),
    ),
      array(
        'methods'             => WP_REST_Server::EDITABLE,
        'callback'            => array( $this, 'action_update' ),
        'permission_callback' => array( $this, 'action_update_check' ),
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
  public function do_action($action, $params) {

      switch ($action) {
          case 'test':
              return $this->test();
              break;
          case 'get_onboarding_page':
              return $this->get_onboarding_page($params);
              break;
          default:
              return array('status' => false, 'msg' => 'Unknown action.', 'error_code'=> 'no-action');
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
       else $data=array("status"=> false, "msg"=> "No action defined.", "error_code"=> "no-action");

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
        else $data=array("status"=> false, "msg"=> "No action defined.", "error_code"=> "no-action");

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

  /**
  * get onboarding page settings
  **/
  function get_onboarding_page($params) {
        global $sn_current_user;

        if (!is_user_logged_in())
            return array('status' => false, 'msg' => 'User not logged in');

        // $result['user_allow_access_to_free_trial']=$sn_current_user->get_user_allow_access_to_free_trial();
        $result['user_login_count'] = $sn_current_user->get_login_count();
        $result['status'] = true;

        return $result;
    }

} // Class
