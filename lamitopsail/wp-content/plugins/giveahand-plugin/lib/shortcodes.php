<?php
// Grid Columns
function grid_column($atts, $content=null, $shortcodename="")
{	$return = '';

	
	//remove wrong nested <p>
	$content = remove_invalid_tags($content, array('p'));

	// add divs to the content
	$return .= '<div class="'.$shortcodename.'">';
	$return .= do_shortcode($content);
	$return .= '</div>';

	return $return;
}
add_shortcode('fullwidth', 'grid_column');
add_shortcode('one_half', 'grid_column');
add_shortcode('one_third', 'grid_column');
add_shortcode('one_fourth', 'grid_column');
add_shortcode('two_third', 'grid_column');
add_shortcode('three_fourth', 'grid_column');

//Section
function section($atts, $content=null, $shortcodename="")
{			extract(shortcode_atts(array(
				'styles' => '',
				'parallax' => 'off'
				
		), $atts));

	$return = '';


	// add section to the content
	$return .= '<section style="'.$styles.'"';
		if ($parallax=='on') {
	$return .= 'class="parallax" id="parallax-section-'.rand(1, 100).'"';	
		};
	$return .= '><div class="container">';
	$return .= do_shortcode($content);
	$return .= '</div></section>';

	return $return;
}
add_shortcode('section', 'section');	

//Row
function row($atts, $content=null, $shortcodename="")
{	$return = '';


	// add divs to the content
	$return .= '<div class="row">';
	$return .= do_shortcode($content);
	$return .= '</div>';

	return $return;
}
add_shortcode('row', 'row');	
	
//Recent Posts
function shortcode_recent_posts($atts, $content = null) {
		
		extract(shortcode_atts(array(
				'title' => '',
				'type' => 'post',											 
				'category' => '',
				'custom_category' => '',
				'numb' => '',
				'meta' => 'true',
				'thumb' => 'true',
				'more_text_single' => '',
				'excerpt_count' => '10',
				'more_link' => '',
				'more_text' => '',
				'exclude' => '',
				'view' => 'wide'
				
		), $atts));
		$output = '';
		
			if ($title != '') {	
		$output .= '<h3 style="display:block; padding-bottom:14px; border-bottom:1px solid #182028; margin-bottom:27px;">'.$title.'</h3>';	
			}
			
		$output .= '<div class="';
		if ($view == "wide") {
			$output .= 'articles wide';
		} else {
			$output .= 'row articles recent-posts-slider';
		}
		$output .= '">';

		global $post;
		global $my_string_limit_words;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$latest = get_posts('post_type='.$type.'&category_name='.$category.'&'.$type.'_category='.$custom_category.'&orderby=post_date&order=desc&numberposts='.$numb.'&exclude='.$exclude.'&paged='.$paged);		
		foreach($latest as $post) {
				setup_postdata($post);
				$excerpt = get_the_excerpt();
				$post_meta_data = get_post_custom($post->ID); 	
				$news_link = isset($post_meta_data[$type.'_link'][0]) ? $post_meta_data[$type.'_link'][0]:'';
				$output .= '<article class="span4 news-element">';			
					if ($thumb == 'true') {
						if ( has_post_thumbnail($post->ID) ){
									$output .= '<figure class="article-preview-image">';
									$output .= '<a href="';
									if( $news_link != '' ){ 
									
									$output .= $news_link;
									
									} else {
									
									$output .= get_permalink($post->ID);
									
									}
									$output .='" title="'.get_the_title($post->ID).'">';
									if ($view == "wide") {
										$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
										$img_url = aq_resize($img_url,680);
										$output .= '<img src="'.$img_url.'" alt=""/>';
									} else {
										$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
										$img_url = aq_resize($img_url,273,253,true);
										$output .= '<img src="'.$img_url.'" alt=""/>';
									}
									$output .= '</a>';
									$output .= '</figure>';	
						}
					}					
				$output .= '<div class="article-main">
					<header>';		
									$title = get_the_title($post->ID);
									$subtitle = isset($post_meta_data[$type.'_subtitle'][0]) ? $post_meta_data[$type.'_subtitle'][0]:'';
													
				$output .= '<h3><a href="';	
									if( $news_link != '' ){ 
									
									$output .= $news_link;
									
									} else {
									
									$output .= get_permalink($post->ID);
									
									}
				$output .='">'.$title.'</a></h3>
						<h6>'.$subtitle.'</h6>				
					</header>			
					<hr>';
				$output .= '<p>'.my_string_limit_words($excerpt,$excerpt_count).'</p>';			
				$output .= '</div>';									
				if($meta == 'true'){
					$output .= '<div class="article-meta">';
					$output .= '<a href="';	
									if( $news_link != '' ){ 
									
									$output .= $news_link;
									
									} else {
									
									$output .= get_permalink($post->ID);
									
									}
					$output .='" class="meta">'.get_the_time('M, j').'</a>';
					$output .= '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'" class="userPost">'.get_the_author_link().'</a>';
					
						if(get_comments_number($post->ID) >= 1):
							$output .= '<a href="'.get_permalink($post->ID).'" class="comments">'.get_comments_number($post->ID).'</a>';
						endif;
							$output .= '<a href="';	
									if( $news_link != '' ){ 
									
									$output .= $news_link;
									
									} else {
									
									$output .= get_permalink($post->ID);
									
									}
					$output .='" class="read-more"><span></span></a>';
						
					$output .= '</div>';		
				}
				$output .= '</article><!-- article (end) -->';
		}
		$output .= '</div><!-- .articles (end) -->';
		
		return $output;
		
}

add_shortcode('recent_posts', 'shortcode_recent_posts');


//Portfolio
function shortcode_portfolio($atts, $content = null) {
		
		extract(shortcode_atts(array(
				'type' => 'portfolio',	
				'custom_category' => '',
				'num' => ' ',
				'meta' => 'true',
				'thumb' => 'true',
				'more_text_single' => '',
				'excerpt_count' => '',
				'more_link' => '',
				'more_text' => '',
				'exclude' => '' 
				
		), $atts));

		$output = '<div class="gallery-container"><div class="gallery-page"><div class="filterable-grid clearfix">';

		global $post;

		$portfolio = get_posts('post_type='.$type.'&'.$type.'_category='.$custom_category.'&orderby=post_date&order=desc&numberposts='.$num.'&exclude='.$exclude);	

		
		foreach($portfolio as $post) {
				setup_postdata($post);
				$post_meta_data = get_post_custom($post->ID); 	
				$custom_link = isset($post_meta_data['custom_link'][0]) ? $post_meta_data['custom_link'][0]:'';
				$lightbox = isset($post_meta_data['lightbox'][0]) ? $post_meta_data['lightbox'][0]:'';
				$big_image = isset($post_meta_data['big_image'][0]) ? $post_meta_data['big_image'][0]:'';
				$select = isset($post_meta_data['select'][0]) ? $post_meta_data['select'][0]:'';
				$large_image = wp_get_attachment_image_src($big_image, 'fullsize');
		
		$output .= '<div>';

				
				
			if ( has_post_thumbnail($post->ID) ){
					$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
					$img_url = aq_resize($img_url,270,247,true);
					
									
				if ( $select == 'four') {  
					$output .= '<a rel="prettyPhoto[Gallery]" href="'.$lightbox.'"><span></span><strong></strong><i class="video"></i>';
					$output .= '<img src="'.$img_url.'" alt=""/>';
					$output .= '</a>';
				} else if ( $select == 'three') { 
					$output .= '<a rel="prettyPhoto[Gallery]" href="'.$large_image[0].'"><span></span><strong></strong><i class="image"></i>';	
					$output .= '<img src="'.$img_url.'" alt=""/>'; 
					$output .= '</a>';	
				} else if ( $select == 'two') { 
					$output .= '<a href="'.$custom_link.'"><span></span><strong></strong><i class="link"></i>';
					$output .= '<img src="'.$img_url.'" alt=""/>';
					$output .= '</a>';
				} else {
					$output .= '<a class="folio_link" href="'.get_permalink($post->ID).'"><span></span><strong></strong><i class="link"></i>';
					$output .= '<img src="'.$img_url.'" alt=""/>';
					$output .= '</a>';
				}
			}														
				$output .= '<span class="ver_decor"></span><span class="hor_decor"></span></div>';				
		}
		$output .= '</div></div></div><!-- gallery_container (end) -->';	
		return $output;		
}

add_shortcode('portfolio', 'shortcode_portfolio');	

//Categories Portfolio
function shortcode_portfolio_cat($atts, $content = null) {
		
		extract(shortcode_atts(array(
				'type' => 'portfolio',	
				'custom_category' => 'portfolio',
				'num' => ' ',
				'meta' => 'true',
				'thumb' => 'true',
				'more_text_single' => '',
				'excerpt_count' => '',
				'more_link' => '',
				'more_text' => '',
				'exclude' => '' 
				
		), $atts));

	
		global $post;

		$selportfolio = get_posts('post_type='.$type.'&'.$type.'_category='.$custom_category.'&orderby=post_date&order=desc&numberposts='.$num.'&exclude='.$exclude);	
		
$output = '<ul class="filter clearfix">
					<li class="active"><a href="javascript:void(0)" class="all">All</a></li>';
					
						// Get the taxonomy
						$terms =''; $count=''; $term_list=''; $args=''; $term='';
						$custom_category; $cat=$custom_category;  
	
$catId = get_term_by("name", $cat, $type."_category");  
$taxonomyName = $type."_category";  
$termchildren = get_term_children( $catId->term_id, $taxonomyName );  
$count = count($terms); 						
						// set a count value to 0
						$i=0;						
						// test if the count has any categories
						if ($count > 0) {							
							// break each of the categories into individual elements								
								// increase the count by 1
						foreach ($termchildren as $child) 	
						{
							$i++;
							$term = get_term_by( 'id', $child, $taxonomyName );  
							$slug = strtolower($term->name);
							$term_list .= '<li><a href="javascript:void(0)" class="'. $slug .'">' . $term->name . '</a></li>';
							// if count is equal to i then output blank
								if ($count != $i)
								{
									$term_list .= '';
								}
								else 
								{
									$term_list .= '';
								}						
						}  
							// print out each of the categories in our new format
							$output .= $term_list;
						}			
$output .= '</ul>';


$output .= '<div class="gallery-container"><div class="gallery-page"><div class="filterable-grid clearfix">';			

		foreach($selportfolio as $post) {
				setup_postdata($post);
$terms = get_the_terms( get_the_ID(), 'portfolio_category' ); 
$output .= '<div data-id="id-'.$count.'" data-type="';
foreach ($terms as $term) { $output .= strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; }
$output .='">';
				$post_meta_data = get_post_custom($post->ID); 	
				$custom_link = isset($post_meta_data['custom_link'][0]) ? $post_meta_data['custom_link'][0]:'';
				$lightbox = isset($post_meta_data['lightbox'][0]) ? $post_meta_data['lightbox'][0]:'';
				$big_image = isset($post_meta_data['big_image'][0]) ? $post_meta_data['big_image'][0]:'';
				$select = isset($post_meta_data['select'][0]) ? $post_meta_data['select'][0]:'';
				$large_image = wp_get_attachment_image_src($big_image, 'fullsize');
				
			if ( has_post_thumbnail($post->ID) ){
					$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
					$img_url = aq_resize($img_url,270,247,true);
					
									
				if ( $select == 'four') {  
					$output .= '<a rel="prettyPhoto[Gallery]" href="'.$lightbox.'"><span></span><strong></strong><i class="video"></i>';
					$output .= '<img src="'.$img_url.'" alt=""/>';
					$output .= '</a>';
				} else if ( $select == 'three') { 
					$output .= '<a rel="prettyPhoto[Gallery]" href="'.$large_image[0].'"><span></span><strong></strong><i class="image"></i>';	
					$output .= '<img src="'.$img_url.'" alt=""/>'; 
					$output .= '</a>';	
				} else if ( $select == 'two') { 
					$output .= '<a href="'.$custom_link.'"><span></span><strong></strong><i class="link"></i>';
					$output .= '<img src="'.$img_url.'" alt=""/>';
					$output .= '</a>';
				} else {
					$output .= '<a class="folio_link" href="'.get_permalink($post->ID).'"><span></span><strong></strong><i class="link"></i>';
					$output .= '<img src="'.$img_url.'" alt=""/>';
					$output .= '</a>';
				}
			}	


$output .='<span class="ver_decor"></span><span class="hor_decor"></span></div>';

$count++;	
	};
	

$output .= '</div></div></div>';	
		return $output;		
}

add_shortcode('portfolio_cat', 'shortcode_portfolio_cat');	

//Icons Block
function icon_section( $atts, $content=null ) {
    extract(shortcode_atts(array(
			'title' => '',
			'desc' => '',
			'image' => '#',
			'link' => '#',
			'link_text' => 'Details'
    ), $atts));
  
  	$output = '<div class="features-box">';
					if ($image != '') {
										
						$image = aq_resize($image,162,163,true);
				$output .= '<div class="icons"><div class="icons-wrap">
							
							<img src="'.$image.'" alt=""/>
							
						</div></div>';
					}	
	$output .= '<h3>'.$title.'</h3>
						
						<p>'.$desc.'</p>';
						
			if ($link != '' or $link_text != '') {	
			
				$output .= '<a href="'.$link.'" class="button">'.$link_text.'</a>';
				
			}		
			
	$output .= '</div>';
				
	return $output;
		 		 
}
add_shortcode( 'icon', 'icon_section' );	

// Staff

function shortcode_staff( $atts, $content=null ) {
    extract(shortcode_atts(array(
			'name' => '',
			'desc' => '',
			'photo' => '#',
			'link' => '#',
			'link_text' => 'Follow',
			'facebook' => '#',
			'twitter' => '#',
			'google_plus' => '#'
    ), $atts));
  
  	$output = '<div class="page-content clearfix">
					<div class="team-box">';
					
		if ($photo != '') {
			$photo = aq_resize($photo,151,154,true);		
			$output .= '<div class="circle-wrap">
							
							<img src="'.$photo.'" alt=""/>
							
						</div>';
			}
						
			$output .= '<h4>'.$name.'</h4>
						
						<span>'.$desc.'</span>';
						
			if ($link != '' or $link_text != '') {
						
				$output .= '<a href="'.$link.'" class="button little">'.$link_text.'</a>';
						
			}
					
			$output .= '</div>
			
					<div class="social-block">
						<ul class="team-social">';
						if ($facebook != '') {
							$output .= '<li><a href="'.$facebook.'" class="icon-1"></a></li>';
						}
						if ($twitter != '') {
							$output .= '<li><a href="'.$twitter.'" class="icon-2"></a></li>';
						}
						if ($google_plus != '') {
							$output .= '<li><a href="'.$google_plus.'" class="icon-3"></a></li>';
						}

						$output .= '</ul>
					</div>
					
				</div>';
				
			return $output;
		 
		 
}
add_shortcode('staff', 'shortcode_staff');


// Activity

function shortcode_activity( $atts, $content=null ) {
    extract(shortcode_atts(array(
				'title' => '',
				'type' => 'activity',	
				'custom_category' => '',
				'num' => '',
				'excerpt_count' => '24',
				'link' => '',
				'link_text' => 'Follow',
				'exclude' => '',
				'view' => 'wide'
    ), $atts));
		$output = '';
		
			if ($title != '') {	
		$output .= '<h3 style="display:block; padding-bottom:14px; border-bottom:1px solid #182028; margin-bottom:27px;">'.$title.'</h3>';	
			}
		$output .= '<div class="';
		if ($view == "wide") {
			$output .= 'row activity';
		} else {
			$output .= 'row element-events';
		}
		$output .= '">';

		global $post;
		global $my_string_limit_words;

		$activity = get_posts('post_type='.$type.'&'.$type.'_category='.$custom_category.'&orderby=post_date&order=desc&numberposts='.$num.'&exclude='.$exclude);		
		foreach($activity as $post) {
				setup_postdata($post);
				$excerpt = get_the_excerpt();
				$post_meta_data = get_post_custom($post->ID); 	
				$activity_link = isset($post_meta_data['activity_link'][0]) ? $post_meta_data['activity_link'][0]:'';
				$output .= '<div class="element">
						
								<div class="span3">';
									
									$output .= '<a href="';
									if( $activity_link != '' ){ 
									
									$output .= $activity_link;
									
									} else {
									
									$output .= get_permalink($post->ID);
									
									}
									$output .= '" class="preview">';	
										if ( has_post_thumbnail($post->ID) ){
										$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
										$img_url = aq_resize($img_url,271,159,true);
										$output .= '<img src="'.$img_url.'" alt=""/>';
										}	
									$output .= '<div class="descr">';
									$title = get_the_title($post->ID);
									$subtitle = isset($post_meta_data[$type.'_subtitle'][0]) ? $post_meta_data[$type.'_subtitle'][0]:'';
										$output .= '<h6>'.$title.'<br><span>'.$subtitle.'</span></h6>';
								
									
									$output .= '</div>
							
									</a>';
								
								if ($view == 'wide') {
								$output .= '<div class="details">';
										if ( has_post_thumbnail($post->ID) ){
											$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );	
											$img_url = aq_resize($img_url,574, 305,true);
											$output .= '<img src="'.$img_url.'" alt=""/>';
										}	
										$output .= '<div class="block-details">';
										$output .= '<h3>'.$title.'</h3>';
										$output .= '<p>'.my_string_limit_words($excerpt,$excerpt_count).'</p>';		
										$output .= '<a href="';
									if( $activity_link != '' ){ 
									
									$output .= $activity_link;
									
									} else {
									
									$output .= get_permalink($post->ID);
									
									}
									$output .= '" class="button little">'.$link_text.'</a>';
										$output .= '</div>					
									</div>';
								} else {}
							
								$output .= '</div>
						
						</div>';							

		}
		$output .= '</div><!-- .activity (end) -->';
return $output;
		 		 
}
add_shortcode('activity', 'shortcode_activity');
	

// Social

function shortcode_social( $atts, $content=null ) {
    extract(shortcode_atts(array(
			'skype' => '',
			'facebook' => '',
			'twitter' => '',
			'google_plus' => ''
    ), $atts));
  
  	$output = '<div class="big-social-icons">';
			if ($facebook !="" ) {
				$output .= '<a class="facebook-icon" href="'.$facebook.'"></a>';
			}
			if ($twitter !="" ) {			
				$output .= '<a class="twitter-icon" href="'.$twitter.'"></a>';
			}
			if ($google_plus !="" ) {
				$output .= '<a class="google-icon" href="'.$google_plus.'"></a>';
			}
			if ($skype !="" ) {				
				$output .= '<a class="skype-icon" href="'.$skype.'"></a>';
			}	
	$output .= '</div>';
				
	return $output;
				 
}
add_shortcode('social', 'shortcode_social');	


// Progress Bar #1

function shortcode_bar( $atts, $content=null ) {
    extract(shortcode_atts(array(
			'title_one' => 'Education',
			'percent_one' => '30',
			'title_two' => 'Medicine',
			'percent_two' => '10',
			'title_three' => 'Water',
			'percent_three' => '60'
    ), $atts));
  
  	$output = '<div class="skills">
					
					<div class="progressBar">
							
						<div class="skill green" data-position="'.$percent_one.'"><span></span><i>'.$title_one.'</i><strong></strong></div>
						
						<div class="skill red" data-position="'.$percent_two.'"><span></span><i>'.$title_two.'</i><strong></strong></div>
						
						<div class="skill blue" data-position="'.$percent_three.'"><span></span><i>'.$title_three.'</i><strong></strong></div>
							
					</div>
							
				</div>';
				
	return $output;
				 
}
add_shortcode('bar', 'shortcode_bar');	

// Progress Bar #2

function progressbar_anim( $atts, $content=null ) {
	$tabContent = do_shortcode($content);
  return '<div class="animated-skills"><div class="animated-progressBar">'.$tabContent.'</div></div>';
}
function skill_section( $atts, $content=null ) {
  $atts = shortcode_atts( array(
    'percent' => '50',
	'color' => '#54957A'
  ), $atts );

	return "<div class=\"skill_bar\"><div data-position=\"{$atts['percent']}\" class=\"skill_active\" style=\"background-color:{$atts['color']}\">
				<span style=\"background-color:{$atts['color']}\"></span>
				<i style=\"border-top: 6px solid {$atts['color']}\"></i>
			</div>
		</div>";
		
}
add_shortcode( 'skills', 'progressbar_anim' );
add_shortcode( 'skill', 'skill_section' );


// Pricing

function shortcode_pricing( $atts, $content=null ) {
    extract(shortcode_atts(array(
			'title' => '',
			'price' => '',
			'per' => 'month',
			'link' => '#',
			'link_text' => 'Follow',
			'text_one' => '',
			'text_two' => '',
			'text_three' => '',
			'text_four' => '',
			'text_five' => '',
			'text_six' => '',
			'style' => ''
    ), $atts));
		$output = '<div class="pricing-table '.$style.'">					
						<header>						
							<div class="pricing-title">								
								<h3>'.$title.'</h3>								
							</div>							
							<div class="price-section">							
								<h2>'.$price.'';
	if($per !=""){
		$output .= '/<span>'.$per.'</span>';
	}
		$output .= '</h2>							
							</div>						
						</header>						
						<article>';	
						if($text_one != ""){	
							$output .= '<p>'.$text_one.'</p>';
							};
						if($text_two != ""){	
							$output .= '<p>'.$text_two.'</p>';
							};
						if($text_three != ""){	
							$output .= '<p>'.$text_three.'</p>';
							};
						if($text_four != ""){	
							$output .= '<p>'.$text_four.'</p>';
							};
						if($text_five != ""){	
							$output .= '<p>'.$text_five.'</p>';
							};
						if($text_six != ""){	
							$output .= '<p>'.$text_six.'</p>';	
							};
	$output .= '</article>						
						<footer>						
							<a href="'.$link.'" class="button little">'.$link_text.'</a>						
						</footer>										
					</div>';
				
	return $output;
		 		 
}
add_shortcode('pricing', 'shortcode_pricing');

// Recent Comments

function shortcode_recent_comments($atts, $content = null) {

    extract(shortcode_atts(array(
        'num' => '5'
    ), $atts));

    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
    comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
    comment_type,comment_author_url,
    SUBSTRING(comment_content,1,50) AS com_excerpt
    FROM $wpdb->comments
    LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
    $wpdb->posts.ID)
    WHERE comment_approved = '1' AND comment_type = '' AND
    post_password = ''
    ORDER BY comment_date_gmt DESC LIMIT ".$num;

    $comments = $wpdb->get_results($sql);

    $output = '<ul class="recent-comments">';

    foreach ($comments as $comment) {

        $output .= '<li>';
            $output .= '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">';
                 $output .= strip_tags($comment->comment_author).' : '.strip_tags($comment->com_excerpt).'...';
            $output .= '</a>';
        $output .= '</li>';

    }

    $output .= '</ul>';

    return $output;

}

add_shortcode('recent_comments', 'shortcode_recent_comments');
	
	
	
	
	
//Popular Posts

function shortcode_popular_posts($atts, $content = null) {

		extract(shortcode_atts(array(
				'num' => '5'
		), $atts));

		$popular = get_posts('orderby=comment_count&numberposts='.$num);

		$output = '<div class="widget"><ul>';

		foreach($popular as $post){
				
				setup_postdata($post);

				$output .= '<li>';
						$output .= '<a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'">';
								$output .= get_the_title($post->ID);
						$output .= '</a>';
				$output .= '</li>';

		}

		$output .= '</ul></div>';

		return $output;

}

add_shortcode('popular_posts', 'shortcode_popular_posts');



//Recent Testimonials

function shortcode_recenttesti($atts, $content = null) {

		extract(shortcode_atts(array(
				'num' => '5',
				'thumb' => 'true',
				'excerpt_count' => '30'
		), $atts));

		$testi = get_posts('post_type=testi&orderby=post_date&numberposts='.$num);

		$output = '<div class="testimonials">';
		
		global $post;
		global $my_string_limit_words;

		foreach($testi as $post){
				setup_postdata($post);
				$excerpt = get_the_excerpt($post->ID);
				$custom = get_post_custom($post->ID);
				$testiname = $custom["testimonial-name"][0];
				$testiurl = $custom["testimonial-url"][0];

				$output .= '<div class="testi_item">';
						if ($thumb == 'true') {
							if ( has_post_thumbnail($post->ID) ){
									$output .= get_the_post_thumbnail($post->ID, 'small-post-thumbnail', array( "class" => "thumb" ));
							}
						}
						$output .= '<blockquote>';
							$output .= '<a href="'.get_permalink($post->ID).'">';
								$output .= my_string_limit_words($excerpt,$excerpt_count);
							$output .= '</a>';
						$output .= '</blockquote>';
						
						$output .= '<div class="name-testi">';
							$output .= '<span class="user">';
								$output .= $testiname;
							$output .= '</span>, ';
							
							$output .= '<a href="'.$testiurl.'">';
								$output .= $testiurl;
							$output .= '</a>';
							
						$output .= '</div>';
						
				$output .= '</div>';

		}

		$output .= '</div>';

		return $output;

}

add_shortcode('recenttesti', 'shortcode_recenttesti');
	
	
	
	
//Tag Cloud

function shortcode_tags($atts, $content = null) {

		$output = '<div class="tagcloud clearfix">';

		$tags = wp_tag_cloud('smallest=8&largest=8&format=array');
		
		if(isset($tags)) 
		foreach($tags as $tag){
				$output .= $tag.' ';
		}

		$output .= '</div><!-- .tags-cloud (end) -->';

		return $output;

}

add_shortcode('tags', 'shortcode_tags');




// Audio Player

function shortcode_audio($atts, $content = null) {
		
    extract(shortcode_atts(array(
        'file' => '',
				'desc' => ''
    ), $atts));
    
    $template_url = get_template_directory_uri();
    $id = mt_rand();
    $mp3 = strpos($file, ".mp3");

    $output  = '<div class="audio-wrapper"><audio src="';

    if($mp3 !== false){
        
        $output .= $file;

    } else {

        _e("The URL you entered is not a .mp3 file.", "my_framework");

    }

    $output  .= '"preload="auto"></audio>';
		$output  .= '<div class="audio-desc">';
			$output  .= $desc;
		$output  .= '</div></div>';

    return $output;

}

add_shortcode('audio', 'shortcode_audio');




// Video Player

function shortcode_video($atts, $content = null) {

    extract(shortcode_atts(array(
        'file' => '',
        'image' => '',
        'width' => '560',
        'height' => '349',
        'color' => 'black'
    ), $atts));

    $template_url = get_template_directory_uri();

    $video_url = $file;

    //Check for video format
    $vimeo = strpos($video_url, "vimeo");
    $youtube = strpos($video_url, "youtu");
    $flv = strpos($video_url, ".flv");

    $output = '<div class="video-wrap" style="max-width:'.$width.'px; width:100%;">';

    //Display video
    if($vimeo !== false){

        //Get ID from video url
        $video_id = str_replace( 'http://vimeo.com/', '', $video_url );
        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

        //Display Vimeo video
        $output .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="100%!important" height="'.$height.'" frameborder="0"></iframe>';

    } elseif($youtube !== false){
	
        //Get ID from video url
        $video_id = str_replace( 'http://youtu.be/', '', $video_url );
        $video_id = str_replace( 'http://www.youtu.be/', '', $video_id );
        $video_id = str_replace( '&feature=channel', '', $video_id );
        $video_id = str_replace( '&feature=channel', '', $video_id );

        $output .= '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="100%!important" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=opaque" frameborder="0"></iframe>';

    } elseif($flv !== false){

        $output .= mytheme_video($video_url, $image, $width, $height, $color);

    } else {

        _e("You entered a video URL that isn't compatible with this shortcode.", "my_framework");

    }

    $output .= '</div><!-- .video-wrap (end) -->';

    return $output;

}

add_shortcode('video', 'shortcode_video');


/**
 * Notification Boxes
 */

function shortcode_notice($atts, $content = null) {

	extract(shortcode_atts(
        array(
            'type' => 'notice',
            'text' => 'Text Here'
    ), $atts));
    
    $output =  '<div class="alert alert-'.$type.'"><span>'.$text.'</span><i>&times;</i></div>';

    return $output;

}

add_shortcode('notice', 'shortcode_notice');

// List Style
function lists($atts, $content=null)
{	
	extract(shortcode_atts(
        array(
            'style' => ''
    ), $atts));
preg_match_all ('|<ul>(.*)</ul>|isU', $content, $content2, PREG_SET_ORDER);
	$output = '';
	$output .= '<ul class="lists '.$style.'">';
	$output .= do_shortcode($content2['0']['1']);
	$output .= '</ul>';

	return $output;
}
add_shortcode('lists', 'lists');

/**
 * Accordion
 *
 */

function accordian_open_tag( $atts, $content=null ) {
	$tabContent = do_shortcode($content);
  return '<div id="accordion">'.$tabContent.'</div>';
}
function accordian_section( $atts, $content=null ) {
  $atts = shortcode_atts( array(
    'title' => 'default title'
  ), $atts );

  return "<div class=\"toggle\"><header><span>{$atts['title']}</span></header>" . 
         "<section>{$content}</section></div>";
}
add_shortcode( 'accordions', 'accordian_open_tag' );
add_shortcode( 'accordion', 'accordian_section' );

/**
 *
 * HTML Shortcodes
 *
 */

// Frames

function frame_shortcode($atts, $content = null) {

    $output = '<div class="fullwidth">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame', 'frame_shortcode');

function frame_left_shortcode($atts, $content = null) {

    $output = '<div class="sidebar_column">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame_left', 'frame_left_shortcode');

function frame_right_shortcode($atts, $content = null) {

    $output = '<div class="main_column">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame_right', 'frame_right_shortcode');


// Button

function button_shortcode($atts, $content = null) {

	extract(shortcode_atts(
        array(
            'link' => 'http://www.google.com',
            'text' => 'Button',
			'style' => '',
			'color' => '',
			'donate' => 'disable'
    ), $atts));
    
    $output =  '<a href="';
					if ($donate == 'enable' ) {
				
					$output .=  '#';
					
				} else {
	
					$output .= $link;
					
				}
	
	 $output .=  '" title="'.$text.'" class="button '.$style.' ';
	
				if ($donate == 'enable' ) {
				
					$output .=  'donate';
					
				}
	
		$output .=  '" style="background-color:'.$color.'">';
		$output .= $text;
		$output .= '</a><!-- .button (end) -->';

    return $output;

}

add_shortcode('button', 'button_shortcode');


// Dropcaps

function dropcap_shortcode($atts, $content = null) {

    $output = '<span class="dropcap">';
    $output .= do_shortcode($content);
    $output .= '</span><!-- .dropcap (end) -->';

    return $output;

}

add_shortcode('dropcap', 'dropcap_shortcode');

// Vertical Rule

function vr_shortcode($atts, $content = null) {

    $output = '<div class="vr"><!-- --></div>';

    return $output;

}

add_shortcode('vr', 'vr_shortcode');

// Horizontal Rule

function hr_shortcode($atts, $content = null) {

    $output = '<div class="hr"><!-- --></div>';

    return $output;

}

add_shortcode('hr', 'hr_shortcode');


// Spacer

function spacer_shortcode($atts, $content = null) {

    $output = '<div class="spacer"><!-- --></div>';

    return $output;

}

add_shortcode('spacer', 'spacer_shortcode');

// Map

function map_shortcode($atts, $content = null) {

	extract(shortcode_atts(
        array(
            'src' => '',
						'width' => '',
						'height' => ''
    ), $atts));
    
    $output =  '<div class="google-map" style="width:100%;">';
			$output .= '<iframe src="'.$src.'&output=embed" frameborder="0" width="100%" height="'.$height.'" marginwidth="0" marginheight="0" scrolling="no">';
			$output .= '</iframe>';
		$output .= '</div>';

    return $output;

}

add_shortcode('map', 'map_shortcode');

//Mail To

function cwc_mail_shortcode( $atts , $content=null ) {
	$encodedmail = '';
    for ($i = 0; $i < strlen($content); $i++) $encodedmail .= "&#" . ord($content[$i]) . ';';
    return '<a href="mailto:'.$encodedmail.'" class="mailto">'.$encodedmail.'</a>';
}
add_shortcode('mailto', 'cwc_mail_shortcode');

// Blockquote

function blockquote_shortcode($atts, $content = null) {
	extract(shortcode_atts(
        array(
            'quote' => '',
            'author' => '',
    ), $atts));

    $output = "<blockquote>
				<p>".$quote."</p><cite>".$author."</cite>
				<span></span>";
    $output .= '</blockquote><!-- blockquote (end) -->';

    return $output;

}

add_shortcode('blockquote', 'blockquote_shortcode');


// Clear
function shortcode_clear() {
	return '<div class="clear"></div>';
}

add_shortcode('clear', 'shortcode_clear');

/**
 * Tabs Horizontal
 */

function tabs_shortcode($atts, $content = null) {

    $output = '<div class="tabs_horizontal">';
    $output .= '<ul class="clearfix">';

    //Build tab menu
    $numTabs = count($atts);

    for($i = 1; $i <= $numTabs; $i++){
        $output .= '<li><a href="#tab'.$i.'">'.$atts['tab'.$i].'</a></li>';
    }

    $output .= '</ul><!-- .tab-menu (end) -->';

    //Build content of tabs
    $tabContent = do_shortcode($content);
    $find = array();
    $replace = array();
    foreach($atts as $key => $value){
        $find[] = '['.$key.']';
        $find[] = '[/'.$key.']';
        $replace[] = '<div id="'.$key.'">';
        $replace[] = '</div><!-- .tab (end) -->';
    }

    $tabContent = str_replace($find, $replace, $tabContent);

    $output .= $tabContent;

    $output .= '</div><!-- .tabs (end) -->';

    return $output;

}

add_shortcode('tabs', 'tabs_shortcode');

/**
 * Tabs Vertical
 */

function tabsvert_shortcode($atts, $content = null) {

    $output = '<div class="tabs_vertical clearfix">';
    $output .= '<ul>';

    //Build tab menu
    $numTabs = count($atts);

    for($i = 1; $i <= $numTabs; $i++){
        $output .= '<li><a href="#tab'.$i.'"><span></span>'.$atts['tab'.$i].'</a></li>';
    }

    $output .= '</ul><!-- .tab-menu (end) -->';

    //Build content of tabs
    $tabContent = do_shortcode($content);
    $find = array();
    $replace = array();
    foreach($atts as $key => $value){
        $find[] = '['.$key.']';
        $find[] = '[/'.$key.']';
        $replace[] = '<div id="'.$key.'">';
        $replace[] = '</div><!-- .tab (end) -->';
    }

    $tabContent = str_replace($find, $replace, $tabContent);

    $output .= $tabContent;

    $output .= '</div><!-- .tabs (end) -->';

    return $output;

}

add_shortcode('tabsv', 'tabsvert_shortcode');

/**
 * Slider
 *
 */

function carousel_open_tag( $atts, $content=null ) {
	$tabContent = do_shortcode($content);
  return '<div class="slider-carousel"><ul class="carousel">'.$tabContent.'</ul></div>';
}
function slide_section( $atts, $content=null ) {
  $atts = shortcode_atts( array(
    'title' => 'default title'
  ), $atts );

  return "<li><span></span>{$content}</li>";
}
add_shortcode( 'carousel', 'carousel_open_tag' );
add_shortcode( 'slide', 'slide_section' );

/**
 * Toggle
 *
 */

function toggle_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'title' => 'This is your title'
    ), $atts));

    $output = '<div class="toggle">';
    $output .= '<a href="#" class="trigger"><span>+</span>'.$title.'</a>';
    $output .= '<div class="container">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .box (end) -->';
    $output .= '</div><!-- .toggle (end) -->';

    return $output;

}

add_shortcode('toggle', 'toggle_shortcode');

/**
 * Process Divider
 */

function process_divider_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
		
    ), $atts));

    $output = '<div class="process-divider"></div>';

    return $output;

}

add_shortcode('divider', 'process_divider_shortcode');

// Process

function shortcode_process( $atts, $content=null ) {
    extract(shortcode_atts(array(
			'title' => '',
			'desc' => '',
			'image' => '#'
    ), $atts));
  
  	$output = '<div class="process-part clearfix">';
					
		if ($image != '') {
					
			$output .= '<div class="">
							
							<img src="'.$image.'" alt=""/>
							
						</div>';
			}
						
			$output .= '<h5>'.$title.'</h5>';
			
			$output .= '<p>'.$desc.'</p>';
					
			$output .= '</div>';
				
			return $output;
		 
		 
}
add_shortcode('process', 'shortcode_process');

add_action( 'after_setup_theme', 'my_setup' );
?>