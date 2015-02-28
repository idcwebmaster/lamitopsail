<?php 
/*****************************/
/* Flickr Widget */
/*****************************/
class Custom_Flickr_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'flickr',
			'Flickr Widget',
			array('description' => __('Displays a Flickr Block', 'framework'))
		);	
	}
	
	
	public function form($instance) {
		$defaults = array(
			'title' => __('Photos On Flickr', 'framework'),
			'flickr_id' => __('Enter Flickr ID', 'framework'),
			'flickr_limit' => __('Images Limit', 'framework'),
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		?>
		
		<!-- The Title-->
		<p>
			<label for="<?php  echo $this->get_field_id('title') ?>"><?php _e('Title', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<!-- Enter Flickr ID-->
		<p>
			<label for="<?php  echo $this->get_field_id('flickr_id') ?>"><?php _e('Enter Flickr ID', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('flickr_id') ?>" name="<?php echo $this->get_field_name('flickr_id') ?>" class="widefat" value="<?php echo esc_attr($instance['flickr_id']); ?>" />
		</p>
		<!-- Images Limit-->
		<p>
			<label for="<?php  echo $this->get_field_id('flickr_limit') ?>"><?php _e('Images Limit', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('flickr_limit') ?>" name="<?php echo $this->get_field_name('flickr_limit') ?>" class="widefat" value="<?php echo esc_attr($instance['flickr_limit']); ?>" />
		</p>
	
		<?php
	
	}
	
	
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
			//Title
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
			$instance['flickr_limit'] = strip_tags($new_instance['flickr_limit']);
	
			return $instance;
			
	}
	
	
	
	public function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget-title', $instance['title']);
		
		if(isset($instance['flickr_id'])) { $flickr_id = $instance['flickr_id'];}
		if(isset($instance['flickr_limit'])) { $flickr_limit = $instance['flickr_limit']; }

		
		
		echo $before_widget;
		
		if($title) {
			echo $before_title . $title . $after_title;
				}	
	?>
			<div id="flickr" class="clearfix"></div>
							<script>
								jQuery(document).ready(function($){
								/*=======================Flickr Function===============================*/	
								$(function(){       
								var id='<?php echo $flickr_id ?>';
								var limit ='<?php echo $flickr_limit ?>';
								$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + id + "&lang=en-us&format=json&jsoncallback=?", 
								function(data){$.each(data.items, 
								function(i,item){           
									if(i < limit){
									$("<img/>").attr("src", item.media.m.replace('_m', '_s')).appendTo("#flickr").wrap("<a href='" + item.media.m.replace('_m', '_z') + "' name='"+ item.link + "' title='" +  item.title +"'></a>");
									}
								}); 
								}); 
								});
								});
							</script>
			
		<?php
		
		echo $after_widget;

	}
	
	

}
add_action('widgets_init', 'register_flickr_widget');
function register_flickr_widget() {
    register_widget('Custom_Flickr_Widget');
};