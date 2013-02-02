<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );
add_action( 'admin_bar_menu', 'theme_options_nav' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
  register_setting( 'yus_options', 'yus_theme_options', 'theme_options_validate' );
}


/**
 * Redirect users to Theme Options after activation
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
  wp_redirect( 'themes.php?page=theme_options' );


/**
 * Load up the menu page
 */
function theme_options_add_page() {
  add_theme_page(
    __( 'Theme Options', 'yus' ), 
    __( 'Theme Options', 'yus' ), 
    'edit_theme_options', 'theme_options', 'theme_options_do_page' 
  );
}

function theme_options_nav() {
 global $wp_admin_bar;
 $wp_admin_bar->add_menu( array(
 'parent' => 'appearance',
 'id' => 'theme-options',
 'title' => 'Theme Options',
 'href' => admin_url('themes.php?page=theme_options')
 ) );
}


/**
 * Enable template-wide variables cache
 */
$yus_cache = array();

function yus_get_var($key)
{
    global $yus_cache;
    return (isset($yus_cache[$key])) ? $yus_cache[$key] : '';
}


/**
 * Create arrays for social media network options
 */
$social_media_options = array(
   array( 'name' => 'RSS Feed', 'id' => 'rss' ),
   array( 'name' => 'Facebook', 'id' => 'facebook' ),
   array( 'name' => 'Google Plus', 'id' => 'google_plus', 'id2' => 'google' ),
   array( 'name' => 'Instagram', 'id' => 'instagram' ),
   array( 'name' => 'LinkedIn', 'id' => 'linkedin' ),
   array( 'name' => 'Pinterest', 'id' => 'pinterest' ),
   array( 'name' => 'StumbleUpon', 'id' => 'stumbleupon' ),
   array( 'name' => 'Twitter', 'id' => 'twitter' ),
   array( 'name' => 'Vimeo', 'id' => 'vimeo' ),
   array( 'name' => 'YouTube', 'id' => 'youtube' )
 );
 
$yus_cache['social_media_options'] = $social_media_options;


/**
 * Create the options page
 */
function theme_options_do_page() {
  global $options;

  if ( ! isset( $_REQUEST['settings-updated'] ) )
    $_REQUEST['settings-updated'] = false;

  ?>
  <div class="wrap">
    <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'yus' ) . "</h2>"; ?>
    
    <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
      <div class="updated fade"><p><strong><?php _e( 'Options saved', 'yus' ); ?></strong></p></div>
    <?php endif; ?>

    <form method="post" action="options.php">
      <?php settings_fields( 'yus_options' ); ?>
      <?php $options = get_option( 'yus_theme_options' ); ?>

      <table class="form-table">
    
      <h3 class="rwd-toggle"><?php _e('Graphical Banner', 'yus'); ?></h3>
      
      <table class="form-table">

        <?php
        /**
         * Graphical Banner
         */
        ?>
        <tr valign="top">
          <th scope="row"><?php _e('Site title (faculty/department name)', 'yus'); ?></th>

          <td>
              <input id="yus_theme_options[site_title]" class="regular-text" type="text" 
                  name="yus_theme_options[site_title]" value="<?php if (!empty($options['site_title'])) 
                  esc_attr_e($options['site_title']); ?>" />
              <label class="description" for="yus_theme_options[site_title]">
                <?php _e('Enter your site title', 'yus'); ?>
              </label>
          </td>

        <?php
        /**
         * Graphical Banner Image URL
         */
        ?>
        <tr valign="top">
          <th scope="row"><?php _e('Graphical banner image URL (optional)', 'yus'); ?></th>
          <td>
              <input id="yus_theme_options[banner_image_url]" class="regular-text" type="text" 
                  name="yus_theme_options[banner_image_url]" 
                  value="<?php if (!empty($options['banner_image_url'])) esc_attr_e($options['banner_image_url']); ?>" />
              <label class="description" for="yus_theme_options[banner_image_url]">
                <?php _e('Note: Must be 235px x 180px, as per university guidelines.', 'yus'); ?>
              </label>
          </td>
        </tr>

        <?php
        /**
         * Use tall graphical banner?
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Use tall graphical banner', 'yus' ); ?></th>
          <td>
            <input id="yus_theme_options[tall_banner]" name="yus_theme_options[tall_banner]" 
                type="checkbox" value="1" <?php checked( '1', $options['tall_banner'] ); ?> />
            <label class="description" for="yus_theme_options[tall_banner]">
              <?php _e( 'Check this box to make the graphical banner tall (height of 180px, instead of 70px; with or without a banner image).', 'yus' ); ?>
            </label>
          </td>
        </tr>
        
      </table><!-- end of .form-table -->
        
      <h3 class="rwd-toggle"><?php _e('General Options', 'yus'); ?></h3>
      
      <table class="form-table">

        <?php
        /**
         * Use custom.css? 
         */
        ?>
        <tr valign="top"><th scope="row"><?php _e( 'Custom Stylesheet', 'yus' ); ?></th>
          <td>
            <input id="yus_theme_options[customcss]" name="yus_theme_options[customcss]" 
                type="checkbox" value="1" <?php checked( '1', $options['customcss'] ); ?> />
            <label class="description" for="yus_theme_options[customcss]">
              <?php _e( 'Check this box to use a custom stylesheet. Create <code>custom.css</code> in the main theme directory.', 'yus' ); ?>
            </label>
          </td>
        </tr>
        
      </table><!-- end of .form-table -->
      
      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'yus'); ?>" />
      </p>

      <h3 class="rwd-toggle"><?php _e('Social Icons', 'yus'); ?></h3>
      
      <table class="form-table">
                
        <?php
        /**
         * Social Media
         */
         
        foreach ( yus_get_var('social_media_options') as $sno ) {
          $uid = (string) $sno['id'] . '_uid';
        ?>
        
          <tr valign="top">
            <th scope="row"><?php _e($sno['name'], 'yus'); ?></th>
            <td>
                <input id="yus_theme_options[<?php echo $uid ?>]" class="regular-text" type="text" 
                    name="yus_theme_options[<?php echo $uid ?>]" 
                    value="<?php if (!empty($options[$uid])) 
                    esc_attr_e($options[$uid]); ?>" />
                <label class="description" for="yus_theme_options[<?php echo $uid ?>]">
                  <?php _e('Enter your ' . $sno['name'] . ' URL', 'yus'); ?>
                </label>
            </td>
          </tr>
        
        <?php
        } ?>
          
      </table><!-- end of .form-table -->  
        
      <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Options', 'yus'); ?>" />
      </p>
   
      <h3>Tips</h3>
      
      <p><strong>&#42;YORK UNIVERSITY WEB GUIDELINES:</strong> If you would like to learn about York University's guidelines for websites, please review the <a href="http://www.yorku.ca/yorkweb/standards/web/index.html">web standards page</a>. Also see the <a href="http://www.yorku.ca/yorkweb/standards/web/production-guide/set-up.html">website production guide set-up page</a>.</p>
      <p><strong>&#42;USE THE NEW ADMIN BAR:</strong> By default, BuddyPress is using the "BuddyBar". If you'd prefer to use the new admin bar, add <code>define('BP_USE_WP_ADMIN_BAR', true);</code> to your <code>wp-config.php</code> file just above where it says "That's all, stop editing! Happy blogging."</p>
      <p><strong>&#42;USE WIDGETS:</strong> This theme uses the same sidebar and footer widgets available to the BuddyPress default theme. <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">Use them!</a> If you want to show different widgets on different pages, use the <a href="http://wordpress.org/extend/plugins/widget-logic/">Widget Logic Plugin</a> (<a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=search&type=term&s=widget+logic&plugin-search-input=Search+Plugins">link to install</a>) along with some <a href="http://codex.wordpress.org/Conditional_Tags">WordPress conditional tags</a> or <a href="http://codex.buddypress.org/developer-docs/conditional-template-tags/">BuddyPress conditional tags</a>.</p>
 
    </form>
  </div>
  
  <?php
}


/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input )
{
  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['tall_banner'] ) )
    $input['tall_banner'] = null;
  $input['tall_banner'] = ( $input['tall_banner'] == 1 ? 1 : 0 );

  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['customcss'] ) )
    $input['customcss'] = null;
  $input['customcss'] = ( $input['customcss'] == 1 ? 1 : 0 );

  // Our checkbox value is either 0 or 1
  if ( ! isset( $input['customphp'] ) )
    $input['customphp'] = null;
  $input['customphp'] = ( $input['customphp'] == 1 ? 1 : 0 );
  
  $input['site_title'] = wp_kses_stripslashes($input['site_title']);
  $input['banner_image_url'] = esc_url_raw($input['banner_image_url']);
  
  $input['home_content_area'] = wp_kses_stripslashes($input['home_content_area']);
  
  $input['twitter_uid'] = esc_url_raw($input['twitter_uid']);
  $input['facebook_uid'] = esc_url_raw($input['facebook_uid']);
  $input['linkedin_uid'] = esc_url_raw($input['linkedin_uid']);
  $input['youtube_uid'] = esc_url_raw($input['youtube_uid']);
  $input['stumbleupon_uid'] = esc_url_raw($input['stumbleupon_uid']);
  $input['rss_uid'] = esc_url_raw($input['rss_uid']);
  $input['google_plus_uid'] = esc_url_raw($input['google_plus_uid']);
  $input['instagram_uid'] = esc_url_raw($input['instagram_uid']);
  $input['pinterest_uid'] = esc_url_raw($input['pinterest_uid']);
  
  return $input;
}