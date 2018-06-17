<div id="sociallinks" class="wrap">
  <div class="adv-left">
    <img class="plugin-display-image" src="<?php echo plugins_url( '/images/ionimg.png', dirname(__FILE__) ); ?>" alt="ION" title="ION">
  </div>
  <div class="adv-right">
    <h3>Your Own Web-presence & Web-engagement Dashboard. Our KEY FEATURES:</h3>
    <ol>
      <li>Publish feeds to all social platforms in one touch!</li>
      <li>Respond Quickly to Patient Queries and Convert Into Visits! </li>
      <li>Engage Your New Age Patient Network Easily! </li>
      <li>Measure Your Web-Activities Smartly! </li>
    </ol>
  </div>
</div>
<div class="clear"></div>
<div class="wrap">
  <img class="plugin-display-image" src="<?php echo plugins_url( '/images/mpm-help.png', dirname(__FILE__) ); ?>" alt="Medico Post Meta Help" title="Medico Post Meta Help">
  <h2>Medico Post Meta Help</h2>
  <hr/>
  <ul>
    <li><p></p></li>    
    <li></li>
    <li><h4>1. To display post meta use template function</h4></li>
    <li><code>if(function_exists('viewPostMeta')){ viewPostMeta(); }</code></li>
    <li></li>
    <li><h4>2. To display post meta as shortcode</h4></li>
    <li><code> echo do_shortcode('[viewpostmeta]'); </code></li>
    <li></li>
    <li><h4>3. To display post tag use template function</h4></li>
    <li><code>if(function_exists('viewPostTag')){ viewPostTag(); }</code></li>
    <li></li>
    <li><h4>4. To display post tag as shortcode</h4></li>
    <li><code>echo do_shortcode('[viewposttag]'); </code></li>
    <li></li>
    <li><h4>5. How to get top viewed 10(say) latest post?</h4></li>
    <li><code>Example: <?php echo site_url(); ?>/wp-json/mostviewed/v2/latest-post</code></li>
    <li></li>


    <li><h4>6. How to get top viewed 10 latest post from a category say nurse?</h4></li>
    <li><code>Example: <?php echo site_url(); ?>/wp-json/mostviewed/v2/latest-post?category=nurses</code></li>
    <li></li>
    <li><h4>7. How to get no of view of a post?</h4></li>
    <li><code>Example: <?php echo site_url(); ?>/wp-json/mostviewed/v2/view-count?id=26</code></li>
    <li></li>
    <li><h4>8. How to get all posts from a custom post type?</h4></li>
    <li><code>Example: <?php echo site_url(); ?>/wp-json/mostviewed/v2/custom-post?post_type=international_patient</code></li>
    <li></li>
    <li><h4>9. To get no of view of a post</h4></li>
    <li><code>Example: <?php echo site_url(); ?>/wp-json/mostviewed/v2/view-count?id=26</code></li>

    <li></li>
    <li><h4>10. To get all users with email</h4></li>
    <li><code>Example: <?php echo site_url(); ?>/wp-json/wp/v2/users</code></li>

  </ul>
</div>