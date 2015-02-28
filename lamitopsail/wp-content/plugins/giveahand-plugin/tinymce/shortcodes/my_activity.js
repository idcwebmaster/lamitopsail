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
				label:"Which category to pull from?",
				id:"custom_category",
				help:"Enter the slug of the category you'd like to pull posts from. Leave blank if you'd like to pull from all categories."
			},
			{
				label:"The number of words in the excerpt",
				id:"excerpt_count",
				help:"How many characters are displayed in the excerpt?"
			},
			{
				label:"Button text",
				id:"link_text",
				help:"Enter button text"
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
	shortcode:"activity",
	shortcodeType: "text-replace"
};