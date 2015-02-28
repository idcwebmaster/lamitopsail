frameworkShortcodeAtts={
	attributes:[
			{
				label:"Title",
				id:"title",
				help:"Enter block title"
			},
			{
				label:"How many posts to show?",
				id:"numb",
				help:"This is how many recent posts will be displayed."
			},
			{
				label:"Type of posts",
				id:"type",
				help:"This is the type of posts. Use post slug, e.g. \"custom\""
			},
				{
				label:"Which category to pull from? (for Blog posts)",
				id:"category",
				help:"Enter the slug of the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"Which category to pull from? (for Custom posts)",
				id:"custom_category",
				help:"Enter the slug of the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"Meta",
				id:"meta",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable meta information."
			},
			{
				label:"Do you want to show the featured image?",
				id:"thumb",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable featured image."
			},
			{
				label:"The number of words in the excerpt",
				id:"excerpt_count",
				help:"How many characters are displayed in the excerpt?"
			},
			{
				label:"Type",
				id:"view",
				controlType:"select-control", 
				selectValues:['slider', 'wide'],
				defaultValue: 'wide', 
				defaultText: 'Wide',
				help:"Select type of output slider or wide"
			}
	],
	defaultContent:"",
	shortcode:"recent_posts",
	shortcodeType: "text-replace"
};