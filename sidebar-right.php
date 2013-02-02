<?php do_action( 'bp_before_sidebar' ) ?>

<div id="right-col" class="sidebar" role="complementary">
  <div class="padder">

  <?php do_action( 'bp_inside_before_sidebar' ) ?>
  
  <?php
  $url_path = $_SERVER["REQUEST_URI"];
  
  if ( ! preg_match("/\/login/i", $url_path) ) {
      get_template_part ( 'sidebar-me' ); 
  } ?>
  
  <?php get_template_part ( 'social-icons' ); ?>

  <div id="search-bar" role="search">
    <div class="padder">
    
      <h3 class="searchbar-title"><?php _e( 'Search', 'buddypress' ); ?></h3>

      <form action="<?php echo bp_search_form_action() ?>" method="post" id="search-form">
        <label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
        <input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? 
            esc_attr( $_REQUEST['s'] ) : ''; ?>" />

        <?php echo bp_search_form_type_select() ?>

        <input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />

        <?php wp_nonce_field( 'bp_search_form' ) ?>

      </form><!-- #search-form -->

      <?php do_action( 'bp_search_login_bar' ) ?>

    </div><!-- .padder -->
  </div><!-- #search-bar -->

  <?php /* Show forum tags on the forums directory */
  if ( bp_is_active( 'forums' ) && bp_is_forums_component() && bp_is_directory() ) : ?>
    <div id="forum-directory-tags" class="widget tags">
      <h3 class="widgettitle"><?php _e( 'Forum Topic Tags', 'buddypress' ) ?></h3>
      <div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
    </div>
  <?php endif; ?>

  <?php dynamic_sidebar( 'sidebar-1' ) ?>

  <?php do_action( 'bp_inside_after_sidebar' ) ?>

  </div><!-- .padder -->
</div><!-- #sidebar-right -->

<?php do_action( 'bp_after_sidebar' ) ?>