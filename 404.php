<?php get_header() ?>

    <div id="content">
        <div class="padder">
            <?php do_action( 'bp_before_404' ); ?>
            <div id="post-0" class="post page-404 error404 not-found" role="main">
                <h2 class="posttitle"><?php _e( "Page not found", 'buddypress' ); ?></h2>

                <p><?php _e( "We're sorry, but we can't find the page that you're looking for.", 'buddypress' ); ?></p>
                
                <p><?php _e( "Try one of the following options:", 'buddypress' ); ?></p>
                <ul>
                    <li><a href="<?php echo home_url(); ?>"><?php _e( "Return to the home page", 'buddypress' ); ?></a></li>
                    <li><a href="javascript:history.go(-1)"><?php _e( "Go back to the previous page", 'buddypress' ); ?></a></li>
                    <li><?php _e( "Use the search form to find what you are looking for.", 'buddypress' ); ?></li>
                </ul>
                
                <p>
                    <strong><?php _e( "Please note:", 'buddypress' ); ?></strong>
                    <?php _e( "You may have been redirected here because some pages are restricted to logged-in users only. If you are a registered user,", 'buddypress' ); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e( "login to see this content", 'buddypress' ); ?></a>.
                </p>

                <?php do_action( 'bp_404' ); ?>
            </div>

            <?php do_action( 'bp_after_404' ) ?>
        </div><!-- .padder -->
    </div><!-- #content -->

  <?php get_sidebar() ?>

<?php get_footer() ?>