	<!-- FOOTER -->
	<footer>
	<?php global $smof_data; ?>
	<?php
		if ( is_active_sidebar('footer') ) { ?>
		
		<div class="footer-widget-area">
	
			<div class="container">
		
				<div class="row">
			
					<?php get_sidebar('footer'); ?>
				
				</div> <!-- end row -->
			
			</div> <!-- end container -->
		
		</div> <!-- end footer-widget-area -->	
		
	<?php } ?>
	
		<div class="copyright-container clearfix">
			
			<div class="container">
				<!-- Begin custom footer-->
<div class="footer-lami">
	<div class="footer-contact colfoot">
		<h4>CONTACT US</h4>
		<p>Los Angeles Maritime Institute<br>
		Berth 73, Suite 2<br>
		San Pedro, CA 90731<br>
		Tel: 310.833.6055</p>
		<span>
		<p>General Inquiries:<br> 
		<a href="mailto:info@lamitopsail.org">info@lamitopsail.org</a>
		</p></span>	
	</div>
	<div class="footer-partners colfoot">
		<h4>PARTNERS</h4>
		<a href="/sponsors-partnerships/"><img src="/wp-content/uploads/2014/08/la-port-logo.jpg" alt="la port authority"></a>
	</div>
	<div class="footer-atsea colfoot">
		<h4>AT SEA WITH TOPSAIL</h4>
		<ul>
			<li><a href="/gallery"><img src="/wp-content/uploads/2014/08/gallery-thumb-01.jpg" alt="photo 1"></a></li>
			<li><a href="/gallery"><img src="/wp-content/uploads/2014/08/gallery-thumb-03.jpg" alt="photo 3"></a></li>
			<li><a href="/gallery"><img src="/wp-content/uploads/2014/08/gallery-thumb-02.jpg" alt="photo 2"></a></li>
			<li><a href="/gallery"><img src="/wp-content/uploads/2014/10/gallery-thumb-03x.jpg" alt="photo 4"></a></li>
		</ul>
		<!--p class="visitphoto"><a href="/gallery">visit our <b>photo gallery <b></a></p-->
	</div>
	<div class="footer-mail colfoot>
<div style="text-align:center;"> <a href="http://greatnonprofits.org/reviews/los-angeles-maritime-institute"><img src="/wp-content/uploads/2014/11/GreatNonprofits.jpg" title="2014 Top-rated nonprofits and charities" alt="2014 Top-rated nonprofits and charities" /></a>&nbsp;<a href="http://www.guidestar.org/organizations/33-0515416/los-angeles-maritime-institute.aspx" target="_blank"><img src="/wp-content/uploads/2014/11/GX-Silver-Participant-sm.png" height="75"></a></br></br>
<a href="http://smile.amazon.com/ch/33-0515416"><img src="http://www.lamitopsail.org/wp-content/uploads/2014/12/AmazonSmile.jpg"></a></div>

	</div>
	<!--div class="footer-mail colfoot">
		<h4>JOIN OUR MAILING LIST</h4>

		<form name="input" action="MAILTO:info@lamitopsail.org" method="post" enctype="text/plain">
			<input type="text" name="FirstName" value="YOUR NAME"><br>
			<input type="text" name="LastName" value="EMAIL ADDRESS"><br>
			<input type="submit" value="Submit">
		</form>
	</div-->
</div>
<!-- End custom footer-->
				<?php if (isset($smof_data['footer_menu']) && $smof_data['footer_menu'] == 'show' ) { ?>
				
					<div class="menu-short-container">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'footer-menu',
						));
					?>
					</div>
					
				<?php } ?>

				<p><a class="bloginfoclass" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
				<?php 
				
				if (isset($smof_data['copy_text'])) { echo $smof_data['copy_text']; };
				
				if (isset($smof_data['privacy_link']) && $smof_data['privacy_link'] != '' ) { ?>
				
					<span>&nbsp;|&nbsp;</span><a href="<?php echo $smof_data['privacy_link']; ?>"><span>Privacy Policy</span></a></p>
				
				<?php } ?>
			</div> <!-- end container -->
			
		</div> <!-- end copyright-container -->
		
	</footer>
	
	<!-- Show Google Analytics -->
	<?php if(isset($smof_data['google_analytics']) && $smof_data['google_analytics'] != '') { ?>
		<script type="text/javascript">
			<?php echo stripslashes($smof_data['google_analytics']); ?>
		</script>
	<?php } ?>

	<?php wp_footer(); ?>
</body>
</html>