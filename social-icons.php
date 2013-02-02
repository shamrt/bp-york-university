<?php
$options = get_option('yus_theme_options');
$icon_dir = 'http://www.yorku.ca/yorkweb/images/sm-icons/';
?>

<div id="social-media-icons">

  <?php
  foreach ( yus_get_var('social_media_options') as $icon ) {
  
    if ( $options[ $icon['id'] . '_uid'] ) { 
      if ( !empty( $icon['id2'] ) ) {
        $icon_file = $icon_dir . $icon['id2'] . '.png';
      } else {
        $icon_file = $icon_dir . $icon['id'] . '.png';
      }
      ?>
  
      <a href="<?php echo $options[ $icon['id'] . '_uid' ] ?>" class="<?php echo $icon['id'] . '-icon' ?>"  title="<?php echo $icon['name'] ?>">
        <img src="<?php echo $icon_file ?>" width="32" height="32" alt="<?php echo $icon['name'] ?>">
      </a>
    
    <?php
    }
  } ?>

</div><!-- end of #social-media-icons -->