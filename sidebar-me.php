<div id="sidebar-me">

  <?php if ( is_user_logged_in() ) : ?>

    <?php do_action( 'bp_before_sidebar_me' ) ?>
      <a href="<?php echo bp_loggedin_user_domain() ?>">
      <?php bp_loggedin_user_avatar( 'type=thumb&width=50&height=50' ) ?>
    </a>

    <h4><?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></h4>
    <a class="button logout" href="<?php echo wp_logout_url( bp_get_root_domain() ) ?>">
      <?php _e( 'Log Out', 'buddypress' ) ?>
    </a>

    <?php do_action( 'bp_sidebar_me' ) ?>

    <?php do_action( 'bp_after_sidebar_me' ) ?>

    <?php if ( bp_is_active( 'messages' ) ) : ?>
      <?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
    <?php endif; ?>

  <?php else : ?>

    <h3 class="loginheader"><?php _e( 'Member Login', 'buddypress' ) ?></h3>

    <?php do_action( 'bp_before_sidebar_login_form' ) ?>

    <?php if ( bp_get_signup_allowed() ) : ?>
  
      <p id="login-text">

        <?php printf( __( 'Please <a href="%s" title="Create an account">create an account</a> to get started.',
        'buddypress' ), site_url( bp_get_signup_slug() . '/' ) ) ?>

      </p>

    <?php endif; ?>

    <form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php',
        'login_post' ) ?>" method="post"> 
      
      <label>
        <?php _e( 'Username', 'buddypress' ) ?><br />
        <input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login) ) echo
            esc_attr(stripslashes($user_login)); ?>" tabindex="97" />
      </label>

      <label><?php _e( 'Password', 'buddypress' ) ?><br />
      <input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>

      <p class="forgetmenot">
        <label>
          <input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" />
          <?php _e( 'Remember Me', 'buddypress' ) ?>
        </label>
      </p>

      <?php do_action( 'bp_sidebar_login_form' ) ?>
      <input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" />
      <input type="hidden" name="testcookie" value="1" />
    </form>

    <?php do_action( 'bp_after_sidebar_login_form' ) ?>

  <?php endif; ?>

</div>