=== Plugin Name ===
Contributors: MedicoDesk, Ujjal Modak
Donate link: 
Tags: comments, spam
Requires at least: 4.0.1
Tested up to: 4.8
Requires PHP: 5.2.4
Stable tag: 4.8
License: GPLv2 or later
License URI: 
 
Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.
 
== Description ==
 
This plugin will display post meta(Date, Author, Views and RSS feed link) in your theme. It is also supported by Tags 
 
== Installation ==
 
1. Upload upress-custom-namespace-api folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
 
== Frequently Asked Questions ==
 
= How it works? =	
    
    # To display post meta use template function
	## if(function_exists('viewPostMeta')){ viewPostMeta(); }

	# To display post meta as shortcode
	## echo do_shortcode('[viewpostmeta]');

	# To display post tag use template function
	## if(function_exists('viewPostTag')){ viewPostTag(); }

	# To display post tag as shortcode
	## echo do_shortcode('[viewposttag]');

	# How to get top viewed 10(say) latest post?
	## Example: http://localhost/demowp/wp-json/mostviewed/v2/latest-post

	# How to get top viewed 10 latest post from a category say nurse?
	## Example: http://localhost/demowp/wp-json/mostviewed/v2/latest-post?category=nurses

	# How to get no of view of a post?
	## Example: http://localhost/demowp/wp-json/mostviewed/v2/view-count?id=26

	# How to get all posts from a custom post type?
	## Example: http://localhost/demowp/wp-json/mostviewed/v2/custom-post?post_type=international_patient

	# To get no of view of a post
	## Example: http://localhost/demowp/wp-json/mostviewed/v2/view-count?id=26

	# To get all users with email
	## Example: http://localhost/demowp/wp-json/wp/v2/users
	 
== Screenshots ==
  
== Changelog ==
 
= 1.0 =
 
== Upgrade Notice ==
 
== A brief Markdown Example ==