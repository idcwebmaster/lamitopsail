	 
	 

		
		
	<form role="search" id="search-form" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">

		<input class="form" type="text" name="s" id="s" value="Search" onblur="if(this.value=='')this.value='Search'" onfocus="if(this.value=='Search')this.value=''" />
		<input class="submit-button" type="submit" value="" />
		<input type="hidden" name="post_type" value="product" />

	</form>