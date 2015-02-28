frameworkShortcodeAtts={
	attributes:[
			{
				label:"Slideshow",
				id:"slideshow",
				help:"Enter Slideshow name"
			},
			{
				label:"Dimension",
				id:"type",
				help:"Enter slideshow dimension X,Y"
			},
			{
				label:"Controls",
				id:"controls",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable controls."
			},
			{
				label:"Pager",
				id:"pager",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable pager."
			},
			{
				label:"Auto change",
				id:"autochange",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable autochange."
			},
			{
				label:"Pause on hover",
				id:"pauseonhover",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable pause on hover."
			},
			{
				label:"Fullwidth",
				id:"fullwidth",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable fullwidth mode."
			},
			{
				label:"Responsive",
				id:"responsive",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'true', 
				defaultText: 'true',
				help:"Enable or disable responsive mode."
			},
			{
				label:"Increase",
				id:"increase",
				controlType:"select-control", 
				selectValues:['true', 'false'],
				defaultValue: 'false', 
				defaultText: 'false',
				help:"Enable or disable increase mode."
			}
	],
	defaultContent:"",
	shortcode:"slider",
	shortcodeType: "text-replace"
};