<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('woocommerce-sidebar')) : ?>

	<div class="widget">
		<h4><?php bloginfo('title'); ?></h4>
		<p><?php bloginfo('description'); ?></p>
	</div> <!-- end sidebar-widget -->
	
<?php endif; ?>