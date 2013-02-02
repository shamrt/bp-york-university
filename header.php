<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />
  
  <link href='<?php echo get_stylesheet_directory_uri() . '/images/favicon.png' ?>' rel='shortcut icon' />
  
  <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

  <?php do_action( 'bp_head' ) ?>

  <?php
    if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
      wp_enqueue_script( 'comment-reply' );

    wp_head();
  ?>
  
</head>

<?php
$body_classes = array(
  yus_is_wiki_page() ? 'wiki' : ''
); ?>

<body <?php body_class( $body_classes ) ?> id="bp-default">

  <?php do_action( 'bp_before_header' ) ?>

  <div id="header">
  
    <!-- York Header -->
    <?php yus_inc("internalheadercss.inc") ?>
    <!-- end of York Header -->

    <?php do_action( 'bp_header' ) ?>

  </div>

    <?php do_action( 'bp_after_header' ) ?>
    <?php do_action( 'bp_before_container' ) ?>

  <div id="page">
  
    <?php
    $options = get_option('yus_theme_options');
    
    $banner_class = '';
    if ( $options['tall_banner'] || $options['banner_image_url'] )
      $banner_class = 'class="tall"';
    ?>
    
    <div id="graphical-banner" role="banner" <?php echo $banner_class ?>>
      <?php      
      if ( !empty( $options['banner_image_url'] ) ) {
        echo '<img src="' . $options['banner_image_url'] . '" alt="Graphical banner image" height="180" width="235" />';
      } ?>
    
      <h1 id="site-title">
        <?php 
          if ( !empty( $options['site_title'] ) ) {
            echo $options['site_title'];
          } else {
            bloginfo( 'name' );
          }
        ?>
      </h1>
    </div><!-- #graphical-banner -->

    <div id="main_content">
      
      <?php get_sidebar( 'left' ) ?>
        
      <div id="group">

        <?php
        // Feature area widgets
          if ( is_active_sidebar( 'group-widget-area' ) ) :
            get_sidebar( 'group' );
          endif;
        ?>