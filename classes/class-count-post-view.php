<?php
/**
 * consists of all post meta related to view count 
 */
 namespace medicoCustomPostMeta;
 class MedicoPostViewMeta
 {
	public $dir;
 	
 	public function __construct( $mpm_options = NULL )
 	{
 		$this->dir = plugin_dir_url( dirname(__FILE__) );

		//add_filter('manage_posts_columns', array($this,'posts_column_views'));
		add_action('manage_posts_custom_column', array($this, 'posts_custom_column_views'),5,2); 
 	}

 	// function to display number of posts.
	public function getPostViews($postID){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
		  delete_post_meta($postID, $count_key);
		  add_post_meta($postID, $count_key, '0');
		  return "0 View";
		}
		return $count.' Views';
	} 

	/*public function posts_column_views($defaults){
	    $defaults['post_views'] = __('Views');
	    return $defaults;
	}*/
	
	public function posts_custom_column_views($column_name, $id){
	 if($column_name === 'post_views'){
	        echo $this->getPostViews(get_the_ID());
	    }
	}
 }