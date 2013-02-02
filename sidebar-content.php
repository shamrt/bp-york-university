<?php
	/* The content widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'content-widget-area'  ) )
		return;
	// If we get this far, we have widgets. Let do this.
?>

<?php if ( is_active_sidebar( 'content-widget-area' ) ) : ?>
	<div id="content-widget-area" class="widget-area">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'content-widget-area' ); ?>
		</ul>
	</div><!-- #content-widget-area .widget-area -->
<?php endif; ?>