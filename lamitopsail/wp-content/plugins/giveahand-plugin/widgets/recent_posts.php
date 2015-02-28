<?php 
/*****************************/
/* widget recent posts */
/*****************************/
class Custom_Posts_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'recent_posts',
			'Recent Posts',
			array('description' => __('Custom Recent Posts', 'framework'))
		);	
	}
	
	
	public function form($instance) {
		$defaults = array(
			'title' => __('Popular Posts', 'framework'),
			'posts_type' => __('', 'framework'),
			'cat_inc' => __('', 'framework'),
			'cat_exc' => __('', 'framework'),
			'posts_limit' => __('', 'framework')	
		);
		
		$instance = wp_parse_args((array) $instance, $defaults);
		
		?>
		
		<!-- The Title-->
		<p>
			<label for="<?php  echo $this->get_field_id('title') ?>"><?php _e('Title', 'aframework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<!-- The  Posts Type-->
		<p>
			<label for="<?php  echo $this->get_field_id('posts_type') ?>"><?php _e('Custom Posts Type', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('posts_type') ?>" name="<?php echo $this->get_field_name('posts_type') ?>" class="widefat" value="<?php echo esc_attr($instance['posts_type']); ?>" />
		</p>
		<!-- The Category include-->
		<p>
			<label for="<?php  echo $this->get_field_id('cat_inc') ?>"><?php _e('Category include - use ID', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('cat_inc') ?>" name="<?php echo $this->get_field_name('cat_inc') ?>" class="widefat" value="<?php echo esc_attr($instance['cat_inc']); ?>" />
		</p>
		<!-- The Category exclude-->
		<p>
			<label for="<?php  echo $this->get_field_id('cat_exc') ?>"><?php _e('Category exclude- use -ID', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('cat_exc') ?>" name="<?php echo $this->get_field_name('cat_exc') ?>" class="widefat" value="<?php echo esc_attr($instance['cat_exc']); ?>" />
		</p>
		<!-- The Posts limit-->
		<p>
			<label for="<?php  echo $this->get_field_id('posts_limit') ?>"><?php _e('Posts limit', 'framework'); ?></label>
			<input type="" id="<?php echo $this->get_field_id('posts_limit') ?>" name="<?php echo $this->get_field_name('posts_limit') ?>" class="widefat" value="<?php echo esc_attr($instance['posts_limit']); ?>" />
		</p>		

		
		<?php
	
	}
	
	
	
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
			//Title
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['posts_type'] = strip_tags($new_instance['posts_type']);
			$instance['cat_inc'] = strip_tags($new_instance['cat_inc']);
			$instance['cat_exc'] = strip_tags($new_instance['cat_exc']);
			$instance['posts_limit'] = strip_tags($new_instance['posts_limit']);
			
			
			return $instance;
			
	}
	
	
	
	public function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget-title', $instance['title']);
		
		if(isset($instance['posts_type'])) { $posts_type = $instance['posts_type']; }
		if(isset($instance['cat_inc'])) { $cat_inc = $instance['cat_inc'];}
		if(isset($instance['cat_exc'])) { $cat_exc = $instance['cat_exc'];}
		if(isset($instance['posts_limit'])) { $posts_limit = $instance['posts_limit'];}
		
		
		echo $before_widget;
		
		if($title) {
			echo $before_title . $title . $after_title;
				}	
				
			?>

			<ul class="recent-posts clearfix">
			<?php
			
			$the_query = new WP_Query('showposts='. $posts_limit .'&orderby=post_date&order=desc&ignore_sticky_posts=1');	
			while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<li class="recent_posts">
					<?php if (has_post_thumbnail()) : ?>
						<figure class="posts-preview-image">
							<a href="<?php  the_permalink(); ?>"><?php the_post_thumbnail(array(67,67), array ('class' => 'alignleft')); ?></a>
						</figure>
					<?php endif; ?>
						<h5><a href="<?php the_permalink() ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
						<p>
						<?php 
							global $my_string_limit_words;
							$excerpt = get_the_excerpt();
							echo my_string_limit_words($excerpt,7);	
						?>
						<a href="<?php the_permalink() ?>">...</a></p>
					</li>				
					
			<?php endwhile; ?>
			<?php wp_reset_query(); 
			
		
		echo $after_widget;

	}
	
	

}
add_action('widgets_init', 'register_posts_widget');
function register_posts_widget() {
    register_widget('Custom_Posts_Widget');
};