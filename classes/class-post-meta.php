<?php
/**
 * consists of all post meta 
 */
 namespace medicoCustomPostMeta;
 include('class-count-post-view.php');
 use medicoCustomPostMeta\MedicoPostViewMeta as Mpvm;
 class MedicoPostMeta extends Mpvm
 {
	public $show_date;
	public $mpm_date_format;
	public $show_author;
	public $show_post_count_view;
	public $show_rss_feed_link;
	public $no_of_post_to_display;
	public $post_order;

	public $dir;
 	
 	public function __construct( $mpm_options = NULL )
 	{ 		
 		$this->dir = plugin_dir_url( dirname(__FILE__) ); 		
 		if(isset($mpm_options) && !empty($mpm_options)){
 			$this->show_date      		= $mpm_options['mpm_options']['show_date'] ;
			$this->mpm_date_format      = $mpm_options['mpm_options']['mpm_date_format'] ;
			$this->show_author          = $mpm_options['mpm_options']['show_author'] ;
			$this->show_post_count_view = $mpm_options['mpm_options']['show_post_count_view'] ;
			$this->show_rss_feed_link   = $mpm_options['mpm_options']['show_rss_feed_link'] ;
			$this->no_of_post_to_display= $mpm_options['mpm_options']['icna_name'] ;
			$this->post_order   		= $mpm_options['mpm_options']['icna_order'] ;
 		}else{
 			$mpm_options = get_option( 'mpm_options' );
 			$this->show_date      		= $mpm_options['show_date'] ;
			$this->mpm_date_format      = $mpm_options['mpm_date_format'] ;
			$this->show_author          = $mpm_options['show_author'] ;
			$this->show_post_count_view = $mpm_options['show_post_count_view'] ;
			$this->show_rss_feed_link   = $mpm_options['show_rss_feed_link'] ;
			$this->no_of_post_to_display= $mpm_options['icna_name'] ;
			$this->post_order   		= $mpm_options['icna_order'] ;
 		}
 		register_activation_hook( __FILE__, array($this, 'medico_post_meta_activate') );

 		add_action( 'admin_menu', array($this, 'medico_post_meta_create_menu' ) );

 		add_action( 'wp_enqueue_scripts', array($this,'mpm_front_style' ));

 		parent::__construct();
 	} 	

	private function medico_post_meta_activate()
	{
		global $wp_version;
		// Compare version
		if ( version_compare( $wp_version, '4', '<' ) )
		{
			wp_die( 'This plugin requires WordPress version 4.0 or higher.' );
		}
		//wp_enqueue_script( 'rest-uploader' );
	}

	// Creating Menu and submenu
	public function medico_post_meta_create_menu() {
		//create new top-level menu
		add_menu_page( 'Medico Post Meta', 'Medico Post Meta','manage_options', 'mpm-api', 'custom_medico_post_meta_setting', $this->dir . 'images/mpm-post-meta16x16.png' ); 

		//create two sub-menus: settings and support
		add_submenu_page( 'mpm-api', 'Medico Post Meta Help Page','Help', 'manage_options', 'medico_post_meta_help','medico_post_meta_help_page' );

		//call register settings function
		add_action( 'admin_init', array($this, 'medico_post_meta_register_settings' ) );
	}

	public function medico_post_meta_register_settings() {
    //register our settings
	  register_setting( 'mpm-settings-group', 'mpm_options', array($this, 'medico_post_meta_sanitize_options' ));
	}

	public function medico_post_meta_sanitize_options() {
	  $input['show_date'] 				= sanitize_text_field( $this->show_date );
	  $input['mpm_date_format'] 		= sanitize_text_field( $this->mpm_date_format );
	  $input['show_author'] 			= sanitize_text_field( $this->show_author );
	  $input['show_post_count_view'] 	= sanitize_text_field( $this->show_post_count_view );
	  $input['show_rss_feed_link']		= sanitize_text_field( $this->show_rss_feed_link );
	  $input['icna_name']				= sanitize_text_field( $this->no_of_post_to_display );
	  $input['icna_order']				= sanitize_text_field( $this->post_order );
	  return $input;
	}

	public function mpm_front_style(){
		wp_enqueue_style( 'mpmfront', $this->dir .'css/mpmfront.css', false );
	}
 } 