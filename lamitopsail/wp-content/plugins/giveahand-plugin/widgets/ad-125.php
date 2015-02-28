<?php 
/*****************************/
/* widget get_in_touch */
/*****************************/
class Custom_Ad_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'ad-block',
			'Ad block 125',
			array('description' => __('Displays an Ad block', 'framework'))
		);	
	}
	
	
	public function form($instance) {
		$defaults = array(
			'title' => __('A', 'framework'),
			'image1' => '',
			'link1' => '',
			'image2' => '',
			'link2' => '',
			'image3' => '',
			'link3' => '',
			'image4' => '',
			'link4' => ''
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		?>
		
		<!-- The Title-->
		<p>
			<label for="<?php  echo $this->get_field_id('title') ?>"><?php _e('Title', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('image1') ?>"><?php _e('Image #1', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('image1') ?>" name="<?php echo $this->get_field_name('image1') ?>" class="widefat" value="<?php echo esc_attr($instance['image1']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('link1') ?>"><?php _e('Link #1', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('link1') ?>" name="<?php echo $this->get_field_name('link1') ?>" class="widefat" value="<?php echo esc_attr($instance['link1']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('image2') ?>"><?php _e('Image #2', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('image2') ?>" name="<?php echo $this->get_field_name('image2') ?>" class="widefat" value="<?php echo esc_attr($instance['image2']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('link2') ?>"><?php _e('Link #2', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('link2') ?>" name="<?php echo $this->get_field_name('link2') ?>" class="widefat" value="<?php echo esc_attr($instance['link2']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('image3') ?>"><?php _e('Image #3', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('image3') ?>" name="<?php echo $this->get_field_name('image3') ?>" class="widefat" value="<?php echo esc_attr($instance['image3']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('link3') ?>"><?php _e('Link #3', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('link3') ?>" name="<?php echo $this->get_field_name('link3') ?>" class="widefat" value="<?php echo esc_attr($instance['link3']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('image4') ?>"><?php _e('Image #4', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('image4') ?>" name="<?php echo $this->get_field_name('image4') ?>" class="widefat" value="<?php echo esc_attr($instance['image4']); ?>" />
		</p>
		<p>
			<label for="<?php  echo $this->get_field_id('link4') ?>"><?php _e('Link #4', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('link4') ?>" name="<?php echo $this->get_field_name('link4') ?>" class="widefat" value="<?php echo esc_attr($instance['link4']); ?>" />
		</p>		
		<?php
	
	}
	
	
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
			//Title
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['image1'] = strip_tags($new_instance['image1']);
			$instance['link1'] = strip_tags($new_instance['link1']);
			$instance['image2'] = strip_tags($new_instance['image2']);
			$instance['link2'] = strip_tags($new_instance['link2']);
			$instance['image3'] = strip_tags($new_instance['image3']);
			$instance['link3'] = strip_tags($new_instance['link3']);
			$instance['image4'] = strip_tags($new_instance['image4']);
			$instance['link4'] = strip_tags($new_instance['link4']);
			
			return $instance;
			
	}
	
	
	
	public function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget-title', $instance['title']);
		if(isset($instance['image1'])) { $image1 = $instance['image1'];}
		if(isset($instance['link1'])) { $link1 = $instance['link1'];}
		if(isset($instance['image2'])) { $image2 = $instance['image2'];}
		if(isset($instance['link2'])) { $link2 = $instance['link2'];}
		if(isset($instance['image3'])) { $image3 = $instance['image3'];}
		if(isset($instance['link3'])) { $link3 = $instance['link3'];}
		if(isset($instance['image4'])) { $image4 = $instance['image4'];}
		if(isset($instance['link4'])) { $link4 = $instance['link4'];}
		
		echo $before_widget;
		
		if($title) {
			echo $before_title . $title . $after_title;
				}	
				
		?>
		
		<div class="advs">
			<ul class="ad-125 clearfix">		
					<li>
						<figure class="ad-block">
							<a href="<?php echo $link1; ?>"><img src="<?php echo $image1; ?>" alt="Ad 125" /></a>
						</figure>
					</li>	
					<li>
						<figure class="ad-block">
							<a href="<?php echo $link2; ?>"><img src="<?php echo $image2; ?>" alt="Ad 125" /></a>
						</figure>
					</li>
					<li>
						<figure class="ad-block">
							<a href="<?php echo $link3; ?>"><img src="<?php echo $image3; ?>" alt="Ad 125" /></a>
						</figure>
					</li>
					<li>
						<figure class="ad-block">
							<a href="<?php echo $link4; ?>"><img src="<?php echo $image4; ?>" alt="Ad 125" /></a>
						</figure>
					</li>					
			</ul>
		</div>

		<?php
		
		echo $after_widget;

	}
	
	

}


add_action('widgets_init', 'register_ad_widget');
function register_ad_widget() {
    register_widget('Custom_Ad_Widget');
}