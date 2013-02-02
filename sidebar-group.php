<?php
	/* The group widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if ( ! is_active_sidebar( 'group-widget-area' ) )
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div id="group-widgets" role="complementary">

  <?php if ( is_active_sidebar( 'group-widget-area' ) ) : ?>
  	<div id="group-widget-area" class="widget-area">
  		<ul class="xoxo">
  			<?php dynamic_sidebar( 'group-widget-area' ); ?>
  		</ul>
  	</div><!-- #group-widget-area .widget-area -->
  <?php endif; ?>

</div><!-- #group-widgets -->
