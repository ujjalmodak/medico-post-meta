<?php
/**
 * consists of all post meta related to view count 
 */
 
 class My_MPM_Custom_Rest_Server extends WP_REST_Controller {

  //The namespace and version for the REST SERVER
  var $my_namespace = 'mostviewed/v';
  var $my_version   = '2';
  var $no_of_post_per_page = '';
  var $post_response_order ='';

  public function __construct($param, $param2='DESC'){
    $this->no_of_post_per_page = $param;    
    $this->post_response_order = $param2;    
  }

  public function register_routes() {
    $namespace = $this->my_namespace . $this->my_version;
    $base      = 'latest-post/';
    $view_count = 'view-count/';
    $all_posts  = 'delete-post/';
    $custom_post_type = 'custom-post/';

    register_rest_route( $namespace, '/' . $base, array(
        array(
          'methods'         => WP_REST_Server::READABLE,
          'callback'        => array( $this, 'get_latest_post' ),         
        ),
      )  
    );


    register_rest_route( $namespace, '/' . $view_count, array(
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'wpb_get_post_views_count' ),
      )
      
    )  );

    register_rest_route( $namespace, '/' . $custom_post_type, array(
      array(
        'methods'         => WP_REST_Server::READABLE,
        'callback'        => array( $this, 'wpb_get_custom_post_views' ),
      )
      
    )  
  );    
  }  

// Register our REST Server
public function hook_rest_server(){
  add_action( 'rest_api_init', array( $this, 'register_routes' ) );

}

public function get_latest_post_permission(){
  if ( ! current_user_can( 'read' ) ) {
    return new WP_Error( 'rest_forbidden', esc_html__( 'You do not have permissions to view this data.', 'my-text-domain' ), array( 'status' => 401 ) );
  }      
  return true;
}

public function get_latest_post( WP_REST_Request $request ){
  //Let Us use the helper methods to get the parameters
  $category = $request->get_param( 'category' );

  $args = array(
    'category_name'         => $category,
    'posts_per_page'        => $this->no_of_post_per_page,
    'ignore_sticky_posts'   => 1,
    'meta_query'            => array(array('key' => 'post_views_count',)),    
    'orderby'               => 'meta_value_num', 
    'order'                 => $this->post_response_order,
    'offset'                => 0
  );  
  $post = new WP_Query( $args );
  wp_reset_postdata(); 
  if( empty( $post ) ){
    return null;
  }
  return json_encode($post->posts);
}

public function wpb_get_custom_post_views(WP_REST_Request $request){

  //Let Us use the helper methods to get the parameters
  $custom_post_type_name = $request->get_param( 'post_type' );

  $args = array(
    'post_type'             => $custom_post_type_name,
    'posts_per_page'        => $this->no_of_post_per_page,
    'ignore_sticky_posts'   => 1,
    'meta_query'            => array(array('key' => 'post_views_count',)),    
    'orderby'               => 'meta_value_num', 
    'order'                 => $this->post_response_order,
    'offset'                => 0,
    'post_status'           => 'publish'
  );
  $post = new WP_Query( $args );
  if( empty( $post ) ){
    return null;
  }
  return json_encode($post->posts);
}


// Get Post Count. call back function
public function wpb_get_post_views_count(WP_REST_Request $request){
  $id = $request->get_param( 'id' );
  $ret = array();  
  $count_key = 'post_views_count';
  $count = get_post_meta($id, $count_key, true);
  if($count==''){
    delete_post_meta($id, $count_key);
    add_post_meta($id, $count_key, '0');
    $ret = array('views' => '0');
  }
  $ret = array('views' => $count);
  $ret = json_encode($ret);  
  
  return $ret;  
}

}