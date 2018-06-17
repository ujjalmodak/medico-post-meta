<?php
/*
* Plugin Name: Medico Post Meta
* Plugin URI: http://medicodesk.com/
* Description: Displays post date, author, view count and RSS feed link.
* License: GPLv2
* Author: MedicoDesk
* Version: 1.1.0
* Author URI: http://medicodesk.com/
*/

/* Copyright 2017 MedicoDesk (email : ujjal.m@medicodesk.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/
include( 'classes/class-post-meta.php' );
include( 'classes/class-my-custom-mpm-rest-namespace.php' );
$post_arr = array();
if(isset($_POST) && !empty($_POST)){
  $post_arr = $_POST;
}
$obj_mpm = new medicoCustomPostMeta\MedicoPostMeta($post_arr);

$icna_options = get_option( 'mpm_options' );
$displaynoofpost = $mpm_options['icna_name'];
$icna_order = $mpm_options['icna_order'];

$api_obj_mpm = new My_MPM_Custom_Rest_Server($displaynoofpost, $icna_order);
$api_obj_mpm->hook_rest_server();

add_action( 'wp', 'medicoCustomSetPostViews' );

// function to count views.
function medicoCustomSetPostViews($postID='') {
    global $post;
    $postID     = $post->ID;
    $count_key  = 'post_views_count';

    $post_type_arr = array('post','page');
    $args = array('public'=>true, '_builtin'=>false);
    $output   = 'names'; 
    $operator = 'and';
    $post_types = get_post_types( $args, $output, $operator );
    if(!empty($post_types)){
    foreach ( $post_types  as $post_type ) { array_push($post_type_arr, $post_type ); } }
    if( is_singular( $post_type_arr ) ) {
      $count      = get_post_meta($postID, $count_key, true);
        if($count==''){
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
        }else{
          $count++;
          update_post_meta($postID, $count_key, $count);
        } 
    }   
}

function displayMedicoCustomPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function custom_medico_post_meta_setting() {
  require('includes/settings.php');
}

function medico_post_meta_help_page(){
  require('includes/help.php');
}

add_action('admin_print_styles', "medico_post_meta_add_my_css_and_my_js_files");

function medico_post_meta_add_my_css_and_my_js_files(){
	//wp_register_style( 'mpmpostmeta', plugins_url('/css/mpmpostmeta.css', __FILE__), true, '1.0.0' );        
  wp_enqueue_style( 'mpmpostmeta', plugin_dir_url( __FILE__ ) .'/css/mpmpostmeta.css' );
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'medico_post_meta_plugin_action_links' );

function medico_post_meta_plugin_action_links( $links ) {
 $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=mpm-api') ) .'">Settings</a>';
 $links[] = '<a href="http://getion.in/" target="_blank">ION</a>';
 return $links;
}

add_shortcode( 'viewpostmeta', 'viewPostMeta' );

function viewPostMeta(){
  templatePostMeta();  
}

function templatePostMeta(){
    $mpm_options = get_option( 'mpm_options' );      
?>

<div class="medico-custom-post-meta-info"> 

  <?php if(!empty($mpm_options['show_date']) && $mpm_options['show_date'] == 1 ) { ?> 
    <span class="mcp-pub-date"><i class="fa fa-calendar"></i> <?php echo the_time($mpm_options['mpm_date_format']); ?></span>
  <?php } ?>
  
  <?php if(!empty($mpm_options['show_author']) && $mpm_options['show_author'] == 1 ) { ?> 
    <span class="mcp-pub-author"><i class="fa fa-user"></i> Posted by: <?php echo ucwords(get_the_author()); ?></span>
  <?php } ?>
  
  <?php if(!empty($mpm_options['show_post_count_view']) && $mpm_options['show_post_count_view'] == 1 ) { ?>
  <span class="mcp-post-admin"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo displayMedicoCustomPostViews(get_the_id()); ?></span>
  <?php } ?>
  
  <?php if(!empty($mpm_options['show_rss_feed_link']) && $mpm_options['show_rss_feed_link'] == 1 ) { ?>
  <span class="mcp-rss">
    <i class="fa fa-rss" aria-hidden="true" style="color:#f26522;"></i>
    <span><a href="<?php echo get_the_permalink(); ?>feed/?withoutcomments=1" target="_blank">RSS</a></span>
  </span>
  <?php } ?>

</div>
<?php
}

add_shortcode( 'viewposttag', 'viewPostTag' );
function viewPostTag(){  
  $before = 'Tag List: ';
  $sep    = ' | '; 
  $after  = '';

  echo '<p class="view-post-tags"><i class="fas fa-tags"></i> ';
    the_tags($before, $sep, $after);
  echo '</p>';
}

// give user email support in user response
add_action( 'rest_api_init', function () {
register_rest_field( 'user', 'user_email',
    array(
        'get_callback'    => function ( $user ) {
            return $user['email'];
        },
        'update_callback' => null,
        'schema'          => null,
    )
);

});

// added on 23-3-2018
add_filter( 'wp_kses_allowed_html', 'prefix_add_source_tag', 10, 2 );
function prefix_add_source_tag( $tags, $context ) {
    if ( 'post' === $context ) {
        $tags['iframe'] = array(
            'src'    => true,
            'srcdoc' => true,
            'width'  => true,
            'height' => true,
        );
    }
    return $tags;
}

/* Function called when single page called (for API purpose)-------------------------------------*/ 
add_action( 'wp', 'get_single_post_info' );

function get_single_post_info()
{
    $postid     = '';
    $siteurl     = '';
    $apikey     = '';
    $views         = '';
    $count_key     = 'post_views_count';
    global $post;


    if ( is_singular() ) {

        $postid     = $post->ID;
        $site_url     = esc_url( site_url() );
        //$site_url     = 'http://appdemo.iondemo.in';
        $views         = get_post_meta($postid, $count_key, true);
        $views = $views+1;


        $ret = callApi($site_url, $method='GET', $postid, $views);


          
    } 
}

function callApi($siteurl='', $method='GET', $post_id='', $views=''){

    $url = 'http://dashboard.getion.in/index.php/request?action=views&module=ionplanner&resource=planner&wp_id='.$post_id.'&website='.$siteurl.'&views='.$views; 

    


    // API url
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $method,
    //CURLOPT_POSTFIELDS => json_encode($post_fields),
    
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return "Error #: " . $err;
      } else {            
        return $response;            
      }

}