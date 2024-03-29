        <?php if ( yus_is_three_column_page() ) get_sidebar( 'right' ); ?>
      
      </div><!-- #group -->
    </div><!-- #main_content -->

    <?php do_action( 'bp_after_container' ) ?>
    <?php do_action( 'bp_before_footer' ) ?>

    <div id="footer-area">
      <div class="padder">
      
        <?php if ( is_active_sidebar( 'first-footer-widget-area' ) || is_active_sidebar( 'second-footer-widget-area' ) || is_active_sidebar( 'third-footer-widget-area' ) || is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
          <div id="footer-widgets">
            <?php get_sidebar( 'footer' ) ?>
          </div>
        <?php endif; ?>
      
        <!-- Footer -->
        <?php yus_inc("footer.inc") ?>
        <!-- end of Footer -->

        <div id="site-generator" role="contentinfo">
          <?php do_action( 'bp_dtheme_credits' ) ?>
          <p><?php printf( __( 'Proudly powered by <a href="%1$s">WordPress</a> and <a href="%2$s">BuddyPress</a>.', 'buddypress' ), 'http://wordpress.org', 'http://buddypress.org' ) ?></p>
        </div>

        <?php do_action( 'bp_footer' ) ?>
        
      </div>
      
    </div><!-- #footer -->

    <?php do_action( 'bp_after_footer' ) ?>

    <?php wp_footer(); ?>
    
  </div><!-- #page -->

</body>

</html>