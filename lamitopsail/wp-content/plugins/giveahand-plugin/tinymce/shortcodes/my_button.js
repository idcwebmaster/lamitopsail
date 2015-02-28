frameworkShortcodeAtts={
	attributes:[
			{
				label:"Button Text",
				id:"text",
				help:"Enter the text for button."
			},
			{
				label:"Button Link",
				id:"link",
				help:"Enter the link for button. (e.g. http://demolink.org)"
			},
			{
				label:"Button style",
				id:"style",
				controlType:"select-control", 
				selectValues:['normal','big', 'little', 'small'],
				defaultValue: 'normal', 
				defaultText: 'normal',
				help:"Select button style"
			},
			{
				label:"Button Color",
				id:"color",
				help:"Enter the color for button. (e.g. #ffffff)"
			},
			{
				label:"Donate",
				id:"donate",
				controlType:"select-control", 
				selectValues:['enable','disable'],
				defaultValue: 'disable', 
				defaultText: 'disable',
				help:"Enable donation function"
			},
			
	],
	defaultContent:"",
	shortcode:"button"
};
