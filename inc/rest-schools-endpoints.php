<?php
//Local REST for schools endpoints and actions

class SN_REST_SCHOOLS extends WP_REST_Controller {

    function __construct() {
        add_action( 'rest_api_init',  array($this, 'register_routes') );
    }

  /**
   * Register the routes for the objects of the controller.
   */
  public function register_routes() {
    $version = '1';
    $namespace = 'simplenursing/v' . $version;
    $base = 'school-action';
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
              return array('status' => true, 'msg' => 'Test.');
              break;
          case 'get_school_students':
              return $this->get_school_students($params);
              break;
          case 'get_school_instructors':
              return $this->get_school_instructors($params);
              break;
          case 'get_students_from_group':
              return $this->get_students_from_group($params);
              break;
          case 'get_instructors_from_group':
              return $this->get_instructors_from_group($params);
              break;
          case 'create_school_group':
              return $this->create_school_group($params);
              break;
          case 'delete_school_group':
              return $this->delete_school_group($params);
              break;
          case 'rename_school_group':
              return $this->rename_school_group($params);
              break;
          case 'create_instructors_group':
              return $this->create_instructors_group($params);
              break;
          case 'delete_instructors_group':
              return $this->delete_instructors_group($params);
              break;
          case 'rename_instructors_group':
              return $this->rename_instructors_group($params);
              break;
          case 'add_students_to_group':
              return $this->add_students_to_group($params);
              break;
          case 'remove_students_from_group':
              return $this->remove_students_from_group($params);
              break;
          case 'add_instructors_to_group':
              return $this->add_instructors_to_group($params);
              break;
          case 'remove_instructors_from_group':
              return $this->remove_instructors_from_group($params);
              break;
          case 'get_school_student_groups':
              return $this->get_school_student_groups($params);
              break;
          case 'get_school_instructor_groups':
              return $this->get_school_instructor_groups($params);
              break;
          case 'get_schools':
              return $this->get_schools($params);
              break;
          case 'create_school':
              return $this->create_school($params);
              break;
          case 'update_school':
              return $this->update_school($params);
              break;
          case 'page_school_student_groups':
              return $this->page_school_student_groups($params);
              break;
          case 'get_school_popular_groups':
              return $this->get_school_popular_groups($params);
              break;
          case 'get_video_library_slug_tree':
              return $this->get_video_library_slug_tree($params);
              break;
          case 'get_study_guides_library_slug_tree':
              return $this->get_study_guides_library_slug_tree($params);
              break;
          case 'get_quiz_banks_slug_tree':
              return $this->get_quiz_banks_slug_tree($params);
              break;
          case 'get_nclex_slug_tree':
              return $this->get_nclex_slug_tree($params);
              break;
          case 'get_school_group_permissions':
              return $this->get_school_group_permissions($params);
              break;
          case 'get_instructor_group_permissions':
              return $this->get_instructor_group_permissions($params);
              break;
          case 'get_manager_permissions':
              return $this->get_manager_permissions($params);
              break;
          case 'get_school_permissions':
              return $this->get_school_permissions($params);
              break;
          case 'get_school_quiz_banks_permissions':
              return $this->get_school_quiz_banks_permissions($params);
              break;
          case 'get_school_study_guides_group_permissions':
              return $this->get_school_study_guides_group_permissions($params);
              break;
          case 'get_instructor_study_guides_group_permissions':
              return $this->get_instructor_study_guides_group_permissions($params);
              break;
          case 'get_school_study_guides_permissions':
              return $this->get_school_study_guides_permissions($params);
              break;
          case 'get_school_quiz_banks_group_permissions':
              return $this->get_school_quiz_banks_group_permissions($params);
              break;
          case 'get_instructor_quiz_banks_group_permissions':
              return $this->get_instructor_quiz_banks_group_permissions($params);
              break;
          case 'get_school_nclex_group_permissions':
              return $this->get_school_nclex_group_permissions($params);
              break;
          case 'update_school_group_permissions':
              return $this->update_school_group_permissions($params);
              break;
          case 'update_instructors_group_permissions':
              return $this->update_instructors_group_permissions($params);
              break;
          case 'update_instructors_group_nclex_permissions':
              return $this->update_instructors_group_nclex_permissions($params);
              break;
          case 'update_students_group_nclex_permissions':
              return $this->update_students_group_nclex_permissions($params);
              break;
          case 'update_school_permissions':
              return $this->update_school_permissions($params);
              break;
          case 'update_school_quiz_banks_permissions':
              return $this->update_school_quiz_banks_permissions($params);
              break;
          case 'update_school_group_instructor_restrictions':
              return $this->update_school_group_instructor_restrictions($params);
              break;
          case 'update_school_quiz_banks_group_instructor_restrictions':
              return $this->update_school_quiz_banks_group_instructor_restrictions($params);
              break;
          case 'update_school_study_guides_group_instructor_restrictions':
              return $this->update_school_study_guides_group_instructor_restrictions($params);
              break;
          case 'update_school_study_guides_group_permissions':
              return $this->update_school_study_guides_group_permissions($params);
              break;
          case 'update_instructor_study_guides_group_permissions':
              return $this->update_instructor_study_guides_group_permissions($params);
              break;
          case 'update_school_study_guides_permissions':
              return $this->update_school_study_guides_permissions($params);
              break;
          case 'update_school_quiz_banks_group_permissions':
              return $this->update_school_quiz_banks_group_permissions($params);
              break;
          case 'update_instructor_quiz_banks_group_permissions':
              return $this->update_instructor_quiz_banks_group_permissions($params);
              break;
          case 'update_school_nclex_group_permissions':
              return $this->update_school_nclex_group_permissions($params);
              break;
          case 'school_report_quizzes_taken':
              return $this->school_report_quizzes_taken($params);
              break;
          case 'school_report_nclex_taken':
              return $this->school_report_nclex_taken($params);
              break;
          case 'school_report_videos_watched':
              return $this->school_report_videos_watched($params);
              break;
          case 'school_report_study_guides_downloaded':
              return $this->school_report_study_guides_downloaded($params);
              break;
          case 'get_student_quiz_banks_performance':
              return $this->get_student_quiz_banks_performance($params);
              break;
          case 'get_student_nclex_performance':
              return $this->get_student_nclex_performance($params);
              break;
          case 'get_student_study_guides_downloaded':
              return $this->get_student_study_guides_downloaded($params);
              break;
          case 'get_student_videos_watched':
              return $this->get_student_videos_watched($params);
              break;
          case 'get_student_videos_watched_count':
              return $this->get_student_videos_watched_count($params);
              break;
          case 'get_student_guides_downloaded_count':
              return $this->get_student_guides_downloaded_count($params);
              break;
          case 'activate_students':
              return $this->activate_students($params);
              break;
          case 'deactivate_students':
              return $this->deactivate_students($params);
              break;
          case 'activate_instructors':
              return $this->activate_instructors($params);
              break;
          case 'deactivate_instructors':
              return $this->deactivate_instructors($params);
              break;
          case 'get_full_video_library':
              return $this->get_full_video_library($params);
              break;
          case 'create_video_assignment':
              return $this->create_video_assignment($params);
              break;
          case 'get_manager_assignments':
              return $this->get_manager_assignments($params);
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

    /*
     * Get all schools
     */
    private function get_schools($params) {
        $schools = new SN_Schools();

        return array(
            'status' => true,
            'schools' => $schools->get_all_schools()
        );
    }

    /*
     * Create a new school
     */
    private function create_school($params) {
        $schools = new SN_Schools();
        return array(
            'status' => true,
            'school_id' => $schools->create_new_school($params['name'],$params['premium'],$params['nclex'],$params['students_limit'])
        );
    }

    /*
     * Update school by id
     */
    private function update_school($params) {
        $schools = new SN_Schools();
        return array(
            'status' => true,
            'updated' => $schools->update_school($params['school_id'],$params['name'],$params['premium'],$params['nclex'],$params['students_limit'])
        );
    }

} // Class
