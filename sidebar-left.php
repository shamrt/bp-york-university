<?php do_action( 'bp_before_sidebar' ) ?>

<div id="left-nav" class="sidebar" role="complementary">
  <div class="padder">

    <?php do_action( 'bp_inside_before_sidebar' ) ?>  
  
    <?php // We don't want the BP navigation on the front page
    // if ( !is_front_page() ) { ?>

    <div id="navigation" role="navigation">
      <h5 class="navtitle"><a href="<?php echo home_url(); ?>" title="<?php _e( 'Home page', 'buddypress' ); ?>"></a></h5>

      <?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'sidebar-nav', 'theme_location' => 'primary', 'fallback_cb' => 'bp_dtheme_main_nav' ) ); ?>

    </div>
    
    <?php do_action( 'bp_inside_after_sidebar' ) ?>

  </div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ) ?>
