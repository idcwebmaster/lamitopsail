<?php 
header("Content-Type:text/javascript");

//Setup URL to WordPress
$absolute_path = __FILE__;
$path_to_wp = explode( 'wp-content', $absolute_path );
$wp_url = $path_to_wp[0];

//Access WordPress
require_once( $wp_url.'/wp-load.php' );

//URL to TinyMCE plugin folder
$plugin_url = $plugin_url = plugins_url().'/giveahand-plugin/tinymce/';
?>
(function(){
	
	var icon_url = '<?php echo $plugin_url; ?>' + 'images/icon_shortcodes.png';

	tinymce.create(
		"tinymce.plugins.MyThemeShortcodes",
		{
			init: function(d,e) {
					
					d.addCommand( "myThemeOpenDialog",function(a,c){
						
						// Grab the selected text from the content editor.
						selectedText = '';
					
						if ( d.selection.getContent().length > 0 ) {
					
							selectedText = d.selection.getContent();
							
						} // End IF Statement
						
						myThemeSelectedShortcodeType = c.identifier;
						myThemeSelectedShortcodeTitle = c.title;
						
						jQuery.get(e+"/dialog.php",function(b){
							
							jQuery('#shortcode-options').addClass( 'shortcode-' + myThemeSelectedShortcodeType );
							
							// Skip the popup on certain shortcodes.
							
							switch ( myThemeSelectedShortcodeType ) {
								
					
								
				// tags
								
								case 'tags':
								
								var a = '[tags]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// dropcap
								
								case 'dropcap':
								
								var a = '[dropcap]'+selectedText+'[/dropcap]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// frame
								
								case 'frame':
								
								var a = '[frame]'+selectedText+'[/frame]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// frame_left
								
								case 'frameleft':
								
								var a = '[frame_left]'+selectedText+'[/frame_left]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// frame_right
								
								case 'frameright':
								
								var a = '[frame_right]'+selectedText+'[/frame_right]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// frame
								
								case 'hr':
								
								var a = '[hr]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// frame
								
								case 'vr':
								
								var a = '[vr]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // spacer
								
								case 'spacer':
								
								var a = '[spacer]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// 1/1
								
								case 'fullwidth':
								
								var a = '[fullwidth]'+selectedText+'[/fullwidth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// 1/2
								
								case 'one_half':
								
								var a = '[one_half]'+selectedText+'[/one_half]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// 1/3
								
								case 'one_third':
								
								var a = '[one_third]'+selectedText+'[/one_third]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // 1/4
								
								case 'one_fourth':
								
								var a = '[one_fourth]'+selectedText+'[/one_fourth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // 2/3
								
								case 'two_third':
								
								var a = '[two_third]'+selectedText+'[/two_third]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // 3/4
								
								case 'three_fourth':
								
								var a = '[three_fourth]'+selectedText+'[/three_fourth]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
                
                // clear
								
								case 'clear':
								
								var a = '[clear]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				 // section
								
								case 'section':
								
								var a = '[section styles="" parallax="off"]'+selectedText+'[/section]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				 // row
								
								case 'row':
								
								var a = '[row]'+selectedText+'[/row]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// tabs
								
								case 'tabs':
								
								var a = '[tabs tab1="TAB1" tab2="TAB2" tab3="TAB3"] [tab1] Tab 1 content... [/tab1] [tab2] Tab 2 content... [/tab2] [tab3] Tab 3 content... [/tab3] [/tabs]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;
								
				// tabs-vertical
								
								case 'tabsv':
								
								var a = '[tabsv tab1="TAB1" tab2="TAB2" tab3="TAB3"] [tab1] Tab 1 content... [/tab1] [tab2] Tab 2 content... [/tab2] [tab3] Tab 3 content... [/tab3] [/tabsv]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;
                
                // toggle
								
								case 'toggle':
								
								var a = '[toggle title="Your title goes here"]Your content goes here.[/toggle] ';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				 // mailto
								
								case 'mailto':
								
								var a = '[mailto]'+selectedText+'[/mailto] ';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// lists
								
								case 'lists':
								
								var a = '[lists style="style-1"]'+selectedText+'[/lists] ';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;
								
				// accordion
								
								case 'accordion':
								
								var a = '[accordions][accordion title="Section 1"]Content 1[/accordion][accordion title="Section 2"]Content 2[/accordion][accordion title="Section 3"]Content 3[/accordion][/accordions]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;
						
				// skills
								
								case 'skills':
								
								var a = '[skills][skill percent="50" color="#54957A"][skill percent="50" color="#54957A"][skill percent="50" color="#54957A"][/skills]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;	
				// slider
								
								case 'carousel':
								
								var a = '[carousel][slide]slide 1 Content[/slide][slide]slide 2 Content[/slide][slide]slide 3 Content[/slide][/carousel]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
                
								break;	

                // Process Divider 
								
								case 'divider':
								
								var a = '[divider]';
								
								tinyMCE.activeEditor.execCommand("mceInsertContent", false, a);
								
								break;								
															
								default:
								
								jQuery("#dialog").remove();
								jQuery("body").append(b);
								jQuery("#dialog").hide();
								var f=jQuery(window).width();
								b=jQuery(window).height();
								f=720<f?720:f;
								f-=80;
								b-=114;
							
							tb_show("Insert "+ myThemeSelectedShortcodeTitle +" Shortcode", "#TB_inline?width="+f+"&height="+b+"&inlineId=dialog");jQuery("#shortcode-options h3:first").text(""+c.title+" Shortcode Settings");
							
								break;
							
							} // End SWITCH Statement
						
						}
												 
					)
					 
					} 
				);

				},
					
				createControl:function(d,e){
				
						if(d=="shortcodes_button"){
						
							d=e.createMenuButton("shortcodes_button",{
								title:"Insert Shortcode",
								image:icon_url,
								icons:false
								});
								
								var a=this;d.onRenderMenu.add(function(c,b){
								
					c=b.addMenu({title:"Layout"});
										a.addWithDialog(c,"Section","section");										
										a.addWithDialog(c,"Row","row");	
										a.addWithDialog(c,"1/1","fullwidth");
										a.addWithDialog(c,"1/2","one_half");
										a.addWithDialog(c,"1/3","one_third");
										a.addWithDialog(c,"1/4","one_fourth");
										a.addWithDialog(c,"2/3","two_third");
										a.addWithDialog(c,"3/4","three_fourth");
										a.addWithDialog(c,"Clear","clear");		
					
                	c=b.addMenu({title:"Content"});
										a.addWithDialog(c,"Recent News","recentposts");
										a.addWithDialog(c,"Portfolio","portfolio");
										a.addWithDialog(c,"Portfolio Categories","portfolio_cat");
										a.addWithDialog(c,"Our Staff","staff");
										a.addWithDialog(c,"Icon Block","icon");
										a.addWithDialog(c,"Activity","activity");
										a.addWithDialog(c,"Pricing Table","pricing");
										a.addWithDialog(c,"Popular Posts","popularposts");
										a.addWithDialog(c,"Recent Comments","recentcomments");
										a.addWithDialog(c,"Tags","tags");
										a.addWithDialog(c,"Process divider","divider");
										a.addWithDialog(c,"Process Part","process");

                  
                  c=b.addMenu({title:"HTML"});
										a.addWithDialog(c,"Button","button");
										a.addWithDialog(c,"Lists","lists");
										a.addWithDialog(c,"Accordion","accordion");
										a.addWithDialog(c,"Tabs","tabs");
										a.addWithDialog(c,"Tabs V","tabsv");
										a.addWithDialog(c,"Drop Cap","dropcap");
										a.addWithDialog(c,"Blockquote","blockquote");
										a.addWithDialog(c,"Horizontal Rule","hr");
                    
					b.addSeparator();
					a.addWithDialog(b,"Slider","slider");
					a.addWithDialog(b,"Carousel","carousel");
					a.addWithDialog(b,"Progress Bar","bar");
					a.addWithDialog(b,"Skills","skills");
					a.addWithDialog(b,"Note Box","notice");
					a.addWithDialog(b,"Social","social");	
					a.addWithDialog(b,"Video","video");					
					a.addWithDialog(b,"Google Map","map");
					a.addWithDialog(b,"Mail to","mailto");
									
									

							});
							
							return d
						
						} // End IF Statement
						
						return null
					},
		
				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand("mceInsertContent",false,a)}})},
				
				addWithDialog:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand("myThemeOpenDialog",false,{title:e,identifier:a})}})},
		
				getInfo:function(){ return{longname:"Shortcode Generator",author:"VisualShortcodes.com",authorurl:"http://visualshortcodes.com",infourl:"http://visualshortcodes.com/shortcode-ninja",version:"1.0"} }
			}
		);
		
		tinymce.PluginManager.add("MyThemeShortcodes",tinymce.plugins.MyThemeShortcodes)
	}
)();
