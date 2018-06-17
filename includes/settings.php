<div id="sociallinks" class="wrap postbox">
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
<?php
if ( isset( $_GET['settings-updated'] ) ) {
add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
}
settings_errors( 'wporg_messages' );
?>
<div class="wrap">

<div class="options-general-php">
  
  <img class="plugin-display-image" src="<?php echo plugins_url( '/images/mpm-post-meta.png', dirname(__FILE__) ); ?>" alt="Medico Post Meta" title="Medico Post Meta">
  <h2>Medico Post Meta</h2>
  <hr/>

  
  <div class="option-left">
  <form class="posttypemedico postbox" method="post" action="options.php">
    
    <?php settings_fields( 'mpm-settings-group' ); ?>
    <?php $mpm_options = get_option( 'mpm_options' );
    //print_r($mpm_options);
    //exit;
    ?>
    <table class="form-table">

      <tr valign="top">
        <th scope="row"><img class="plugin-display-image" src="<?php echo plugins_url( '/images/posts-display.png', dirname(__FILE__) ); ?>" alt="Display Date" title="Display Date"><label>Post Settings</label></th>
        <td></td>
      </tr>
      
      <tr valign="top">
        <th scope="row">No of Post to Display</th>
        <td><input type="text" name="mpm_options[icna_name]" value="<?php echo esc_attr( $mpm_options['icna_name'] ); ?>" /></td>
      </tr>
      <tr valign="top">
        <th scope="row">Post Order<br><small>Default: DESC</small></th>
        <td>

          <select name="mpm_options[icna_order]">

            <option value="" <?php echo selected( $mpm_options['icna_order'] , ''); ?> >-Select-</option>

            <option value="desc" <?php echo selected( $mpm_options['icna_order'] , 'desc'); ?> >DESC</option>

            <option value="asc" <?php echo selected( $mpm_options['icna_order'] , 'asc'); ?> >ASC</option>

          </select>
        </td>
      </tr>
      </table>

      <hr>

      <table class="form-table">
      <tr valign="top">
        <th scope="row"><img class="plugin-display-image" src="<?php echo plugins_url( '/images/mpm-date.png', dirname(__FILE__) ); ?>" alt="Display Date" title="Display Date"><label>Date Settings</label></th>
        <td></td>
      </tr>
      <tr valign="top">
        <th scope="row">Show Date</th>
        <td>
        <div class="switch-field">
          <div class="switch-title"></div>
          <input type="radio" id="switch_left" name="mpm_options[show_date]" value="1" <?php checked( $mpm_options['show_date'], 1 ); ?>/>
          <label for="switch_left">Yes</label>
          <input type="radio" id="switch_right" name="mpm_options[show_date]" value="" <?php checked( $mpm_options['show_date'], '' ); ?> />
          <label for="switch_right">No</label>
        </div>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">Date Format</th>
        <td>
          <fieldset>
            <label>
              <input type="radio" name="mpm_options[mpm_date_format]" value="F j, Y" <?php echo (esc_attr( $mpm_options['mpm_date_format'] ) == 'F j, Y')? 'checked' : ''; ?>> 
              <span class="date-time-text format-i18n"><?php echo date('F j, Y'); ?></span><code>F j, Y</code>
            </label>
            <br />
            <label>  
              <input type="radio" name="mpm_options[mpm_date_format]" value="Y-m-d" <?php echo (esc_attr( $mpm_options['mpm_date_format'] ) == 'Y-m-d')? 'checked' : ''; ?>> 
              <span class="date-time-text format-i18n"><?php echo date('Y-m-d'); ?></span><code>Y-m-d</code>
            </label>
            <br />
            <label>
              <input type="radio" name="mpm_options[mpm_date_format]" value="m/d/Y" <?php echo (esc_attr( $mpm_options['mpm_date_format'] ) == 'm/d/Y')? 'checked' : ''; ?>  > 
              <span class="date-time-text format-i18n"><?php echo date('m/d/Y'); ?></span><code>m/d/Y</code>
            </label>
            <br />
            <label>
              <input type="radio" name="mpm_options[mpm_date_format]" value="d/m/Y" <?php echo (esc_attr( $mpm_options['mpm_date_format'] ) == 'd/m/Y')? 'checked' : ''; ?>> 
              <span class="date-time-text format-i18n"><?php echo date('d/m/Y'); ?></span><code>d/m/Y</code>
            </label>
          </fieldset>
        </td>
      </tr>
    </table>

    <hr>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><img class="plugin-display-image" src="<?php echo plugins_url( '/images/mpm-author.png', dirname(__FILE__) ); ?>" alt="Display Author" title="Display Author"><label>Author Settings</label></th>
        <td></td>
      </tr>
      <tr valign="top">
        <th scope="row">Show Author</th>
        <td>
        <div class="switch-field">
          <div class="switch-title"></div>
          <input type="radio" id="switch_author_left" name="mpm_options[show_author]" value="1" <?php checked( $mpm_options['show_date'], 1 ); ?>/>
          <label for="switch_author_left">Yes</label>
          <input type="radio" id="switch_author_right" name="mpm_options[show_author]" value="" <?php checked( $mpm_options['show_date'], '' ); ?> />
          <label for="switch_author_right">No</label>
        </div>       
        </td>
      </tr>
    </table>

    <hr>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><img class="plugin-display-image" src="<?php echo plugins_url( '/images/mpm-view.png', dirname(__FILE__) ); ?>" alt="Display View" title="Display View"><label>View Settings</label></th>
        <td></td>
      </tr>
      <tr valign="top">
        <th scope="row">Show Views</th>
        <td>
        <div class="switch-field">
          <div class="switch-title"></div>
          <input type="radio" id="switch_views_left" name="mpm_options[show_post_count_view]" value="1" <?php checked( $mpm_options['show_date'], 1 ); ?>/>
          <label for="switch_views_left">Yes</label>
          <input type="radio" id="switch_views_right" name="mpm_options[show_post_count_view]" value="" <?php checked( $mpm_options['show_date'], '' ); ?> />
          <label for="switch_views_right">No</label>
        </div>        
        </td>
      </tr>
    </table>

    <hr>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><img class="plugin-display-image" src="<?php echo plugins_url( '/images/mpm-rss.png', dirname(__FILE__) ); ?>" alt="Display RSS" title="Display RSS"><label>RSS Settings</label></th>
        <td></td>
      </tr>
      <tr valign="top">
        <th scope="row">Display RSS Feed Link</th>
        <td>
        <div class="switch-field">
          <div class="switch-title"></div>
          <input type="radio" id="switch_rss_left" name="mpm_options[show_rss_feed_link]" value="1" <?php checked( $mpm_options['show_date'], 1 ); ?>/>
          <label for="switch_rss_left">Yes</label>
          <input type="radio" id="switch_rss_right" name="mpm_options[show_rss_feed_link]" value="" <?php checked( $mpm_options['show_date'], '' ); ?> />
          <label for="switch_rss_right">No</label>
        </div>        
        </td>
      </tr>
    </table>

    <hr>

    <p class="submit"><input type="submit" class="button-primary" value="Save Changes" /></p>
  
  </form> 
  </div>




  <div class="option-right">
  
  <div class="adv1">
    <img src="<?php echo plugins_url( '/images/maintainn.png', dirname(__FILE__) ); ?>" >
  </div>

  </div>










</div>



</div>