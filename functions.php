<?php

// Theme version (note: remember to bump this when changes are made to bust cache)
$yus_version = "2012-09-06";

// If BuddyPress is not activated, switch back to the default WP theme
if ( !defined( 'BP_VERSION' ) )
  switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
  
// Set up theme. Taken mostly from bp-default theme. 
function bp_dtheme_setup() {
  global $bp;

  // Load the AJAX functions for the theme
  require( TEMPLATEPATH . '/_inc/ajax.php' );

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'buddypress' ),
  ) );
  
  if ( !is_admin() ) {
    // Register buttons for the relevant component templates
    // Friends button
    if ( bp_is_active( 'friends' ) )
      add_action( 'bp_member_header_actions',    'bp_add_friend_button' );

    // Activity button
    if ( bp_is_active( 'activity' ) )
      add_action( 'bp_member_header_actions',    'bp_send_public_message_button' );

    // Messages button
    if ( bp_is_active( 'messages' ) )
      add_action( 'bp_member_header_actions',    'bp_send_private_message_button' );

    // Group buttons
    if ( bp_is_active( 'groups' ) ) {
      add_action( 'bp_group_header_actions',     'bp_group_join_button' );
      add_action( 'bp_group_header_actions',     'bp_group_new_topic_button' );
      add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
    }

    // Blog button
    if ( bp_is_active( 'blogs' ) )
      add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
  }
}
add_action( 'after_setup_theme', 'bp_dtheme_setup' );

// Remove default options from the admin bar
remove_action( 'bp_adminbar_menus', 'bp_adminbar_random_menu', 100 );


// Load up York University Social theme options
require_once( get_stylesheet_directory() . '/theme-options.php' );


// Add main CSS
function yus_theme_enqueue_styles() {
    global $yus_version;
    
    // bp-default theme styles
    wp_enqueue_style( 'bp-default-main', get_template_directory_uri() . '/_inc/css/default.css', array(), $yus_version );

    // TODO: add YorkU print styles CSS import to SASS files
    // Add generalized York University default print styles
    // wp_enqueue_style('yu-print-styles', 'http://www.yorku.ca/yorkweb/css/print.css', array(), $yus_version, 'print');
}
add_action( 'wp_enqueue_scripts', 'yus_theme_enqueue_styles' );


// Add inline JavaScript code (specifically for overriding Event Manager jQuery UI styles)
function yus_main_js()
{
    // Add inline JavaScript, for dynamic JSON variables
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var YUS = { 'ui_css': '<?php echo get_stylesheet_directory_uri() ?>/css/blitzer/jquery-ui-1.8.23.css' };
        /* ]]> */
    </script>
    <?php
}
add_action( 'wp_footer', 'yus_main_js' );


// Add theme JavaScript file(s)
function yus_enqueue_scripts() {
    global $yus_version;
    
	wp_enqueue_script(
		'yus-main-js',
		get_stylesheet_directory_uri() . '/js/main.js',
		array('jquery'),
		$yus_version,
		True
	);
}
add_action('wp_enqueue_scripts', 'yus_enqueue_scripts');


// Add viewport settings for mobile access. From Less Framework (http://lessframework.com/)
function yus_add_responsive() {
  ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <?php 
}
add_action ( 'bp_head', 'yus_add_responsive' );


// Show friendly message upon theme activation
function bp_dtheme_show_notice() {
  global $pagenow;

  // Bail if York University Social theme was not just activated
  if ( empty( $_GET['activated'] ) || ( 'themes.php' != $pagenow ) || !is_admin() )
    return;
  ?>

  <div id="message" class="updated fade">
    <p><?php printf( __( 'Theme activated! This theme contains <a href="%s">a
    few options</a> as well as <a href="%s">sidebar and feature (above the right-side column) widgets</a>.', 'buddypress' ),
    admin_url( 'themes.php?page=theme_options' ), admin_url( 'widgets.php' ) )
    ?></p>
  </div>

  <style type="text/css">#message2, #message0 { display: none; }</style>

  <?php
}
add_action( 'admin_notices', 'bp_dtheme_show_notice' );


// Add site credits by filtering exising text in footer.php from bp-default.
add_filter('gettext', 'yus_sitecredits', 20, 3);
/**
 * Edit the default credits to add attribution links.
 */
function yus_sitecredits( $translated_text, $untranslated_text, $domain ) {
    $custom_field_text = 'Proudly powered by <a href="%1$s">WordPress</a> and <a href="%2$s">BuddyPress</a>.';
    $launch_year = 2012;
    $current_year = date("Y");
    
    // Add launch year to copyright text if not current year
    if ( $current_year == $launch_year ) {
      $years = $current_year;
    } else {
      $years = "$launch_year&ndash;$current_year";
    }

    $yus_credits_text = "Site and content &copy; $years York University,<br />";
    
    $credits = array(
        'built'     => 'http://wordpress.org',
        'on'        => 'http://buddypress.org',
        'the'       => 'http://php.net',
        'shoulders' => 'http://mysql.com',
        'of'        => 'http://jquery.com',
        'others'    => 'http://compass-style.org'
    );
    
    foreach ($credits as $key => $value) {
        $yus_credits_text .= " <a href='$value' target='_blank'>$key</a>";
    }
    
    $yus_credits_text .= ".";
    
    if ( $untranslated_text === $custom_field_text) {
        return $yus_credits_text;
    }

    return $translated_text;
}


if ( !function_exists( 'yus_widgets_init' ) ) :
  add_action( 'widgets_init', 'yus_widgets_init' );
  /**
   * Register widgetised areas, including one sidebar and four widget-ready columns in the footer.
   *
   * @since 0.6
   */
  function yus_widgets_init() {
    // Register the group widget area above <#centre-col/> and <#right-col/>.
    // Area 6, located in the group area. Empty by default.
    register_sidebar( array(
      'name' => __( 'Group Widget Area', 'yus' ),
      'id' => 'group-widget-area',
      'description' => __( 'The group widget area', 'yus' ),
      'before_widget' => '<li id="%1$s" class="widget %2$s">',
      'after_widget' => '</li>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ) );
    // Register the content widget area within <#centre-col/>.
    // Area 7, located in the content area. Empty by default.
    register_sidebar( array(
      'name' => __( 'Content Widget Area', 'yus' ),
      'id' => 'content-widget-area',
      'description' => __( 'The content widget area', 'yus' ),
      'before_widget' => '<li id="%1$s" class="widget %2$s">',
      'after_widget' => '</li>',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>',
    ) );
  }
endif;


/*
 * Allow shortcodes to render within a text widget.
 */
add_filter('widget_text', 'do_shortcode');


/*
 * Change the id of <div#content /> so that the end product adheres to York
 * University web guidelines. This allows us to avoid having to change only that
 * ID in every template file, thus keeping the child theme light and agile.
 */
function yus_change_bp_dtheme_content_id( $buffer )
{
  if ( strpos( $_SERVER["REQUEST_URI"], 'wp-admin' ) === false ) {
    $search = '#id="content"#';
    $replace = 'id="centre-col"';
    
    $buffer = preg_replace( $search, $replace, $buffer ) ;
    
    return $buffer;
  }
}
 
 
function yus_ob_start() { ob_start("yus_change_bp_dtheme_content_id"); }
 
function yus_ob_end() { ob_end_flush(); }
 
add_action('wp_head', 'yus_ob_start');
add_action('wp_footer', 'yus_ob_end');

/**
 * Include York University global files.
 *
 * Reference local YU files if host domain is local dev; otherwise, reference official York University files
 */
function yus_inc($file_name)
{
  if (preg_match("/yorku\.ca/i", get_site_url())) {
    include "http://www.yorku.ca/yorkweb/includes/$file_name";
  } else {
    get_template_part( $file_name );
  }
}


/**
 * Check whether current page is a wiki page
 */
function yus_is_wiki_page()
{
  if (get_post_type() == 'incsub_wiki') {
     return true;
   } else { 
     return false;
   }
}


/**
 * Check whether current page should have a three column view
 */
function yus_is_three_column_page()
{
  return ( bp_is_blog_page() || bp_is_group() )
      && ! ( bp_is_group_forum() || yus_is_wiki_page() || is_bbpress() );
}

?>
