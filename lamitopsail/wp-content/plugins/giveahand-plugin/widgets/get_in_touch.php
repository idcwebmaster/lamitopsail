<?php 
/*****************************/
/* widget get_in_touch */
/*****************************/
class Custom_Touch_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'get_in_touch',
			'Get In Touch Widget',
			array('description' => __('Displays a get in touch block', 'framework'))
		);	
	}
	
	
	public function form($instance) {
		$defaults = array(
			'title' => __('Get In Touch', 'framework'),
			'text_area' => __('Some text', 'framework'),
			'address_area' => __('Some adress', 'framework'),
			'phone_area' => __('Some phone', 'framework'),
			'phone_two' => __('Some phone #2', 'framework'),
			'email_area' => __('Some email', 'framework'),
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		?>
		
		<!-- The Title-->
		<p>
			<label for="<?php  echo $this->get_field_id('title') ?>"><?php _e('Title', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<!-- The Text-->
		<p>
			<label for="<?php  echo $this->get_field_id('text_area') ?>"><?php _e('Text', 'framework'); ?></label>
			<textarea type="" id="<?php echo $this->get_field_id('text_area') ?>" name="<?php echo $this->get_field_name('text_area') ?>" class="widefat" value="<?php echo esc_attr($instance['text_area']); ?>" /><?php echo esc_attr($instance['text_area']); ?></textarea>
		</p>
		<!-- The Adress-->
		<p>
			<label for="<?php  echo $this->get_field_id('address_area') ?>"><?php _e('Address', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('address_area') ?>" name="<?php echo $this->get_field_name('address_area') ?>" class="widefat" value="<?php echo esc_attr($instance['address_area']); ?>" />
		</p>
		<!-- The Phone-->
		<p>
			<label for="<?php  echo $this->get_field_id('phone_area') ?>"><?php _e('Phone', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('phone_area') ?>" name="<?php echo $this->get_field_name('phone_area') ?>" class="widefat" value="<?php echo esc_attr($instance['phone_area']); ?>" />
		</p>
		
		<p>
			<label for="<?php  echo $this->get_field_id('phone_two') ?>"><?php _e('Phone #2', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('phone_two') ?>" name="<?php echo $this->get_field_name('phone_two') ?>" class="widefat" value="<?php echo esc_attr($instance['phone_two']); ?>" />
		</p>
		<!-- The E-mail-->
		<p>
			<label for="<?php  echo $this->get_field_id('email_area') ?>"><?php _e('E-mail', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('email_area') ?>" name="<?php echo $this->get_field_name('email_area') ?>" class="widefat" value="<?php echo esc_attr($instance['email_area']); ?>" />
		</p>		

		
		<?php
	
	}
	
	
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
			//Title
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['text_area'] = strip_tags($new_instance['text_area']);
			$instance['address_area'] = strip_tags($new_instance['address_area']);
			$instance['phone_area'] = strip_tags($new_instance['phone_area']);
			$instance['phone_two'] = strip_tags($new_instance['phone_two']);
			$instance['email_area'] = strip_tags($new_instance['email_area']);
			
			
			return $instance;
			
	}
	
	
	
	public function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget-title', $instance['title']);
		
		if(isset($instance['text_area'])) { $text_area = $instance['text_area'];}
		if(isset($instance['address_area'])) { $address_area = $instance['address_area']; }
		if(isset($instance['phone_area'])) { $phone_area = $instance['phone_area'];}
		if(isset($instance['phone_two'])) { $phone_two = $instance['phone_two'];}
		if(isset($instance['email_area'])) { $email_area = $instance['email_area'];}
		
		
		echo $before_widget;
		
		if($title) {
			echo $before_title . $title . $after_title;
				}	
	?>
			<p><?php echo $text_area ?></p>					
			<p class="widget-adress"><?php echo $address_area ?></p>
			<p class="widget-phone"><?php echo $phone_area ?><br><?php echo $phone_two ?></p>
			<p class="widget-email"><a href="mailto:"><?php echo $email_area ?></a></p>
			
		<?php
		
		echo $after_widget;

	}
	
	

}
add_action('widgets_init', 'register_touch_widget');
function register_touch_widget() {
    register_widget('Custom_Touch_Widget');
};