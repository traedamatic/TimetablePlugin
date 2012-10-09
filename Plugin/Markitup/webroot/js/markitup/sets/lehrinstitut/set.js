// -------------------------------------------------------------------
// markItUp!
// -------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// -------------------------------------------------------------------
// MarkDown tags example
// http://en.wikipedia.org/wiki/Markdown
// http://daringfireball.net/projects/markdown/
// -------------------------------------------------------------------
// Feel free to add more tags
// -------------------------------------------------------------------
mySettings = {	
	previewParserPath:	'',	
	//onShiftEnter:		{keepDefault:false, openWith:'\n\n'},
	onShiftEnter:    {keepDefault:false, replaceWith:'<br />\n'},
   onCtrlEnter:     {keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},   
	markupSet: [
		//{name:'First Level Heading', key:'1', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '=') } },
		//{name:'Second Level Heading', key:'2', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '-') } },
		{name:'Heading 1', key:'1', openWith:'# ', placeHolder:'Your title here...' },		
		{name:'Heading 2', key:'2', openWith:'## ', placeHolder:'Your title here...' },
		{name:'Heading 3', key:'3', openWith:'### ', placeHolder:'Your title here...' },
		{name:'Heading 4', key:'4', openWith:'#### ', placeHolder:'Your title here...' },
		{name:'Heading 5', key:'5', openWith:'##### ', placeHolder:'Your title here...' },
		{name:'Heading 6', key:'6', openWith:'###### ', placeHolder:'Your title here...' },
		{separator:'---------------' },		
		{name:'Bold', key:'B', openWith:'**', closeWith:'**'},
		{name:'Italic', key:'I', openWith:'_', closeWith:'_'},
		{name:'Underline', key:'U', openWith:'<u>', closeWith:'</u>'},
		{name:'Space', key:'S', replaceWith:'&nbsp;'},	
		{separator:'---------------' },
		{name:'Horizontal Line', className : 'hrline',  key:'U', replaceWith:'***'},
		{name:'Bulleted List', openWith:'- ' },
		{name:'Numeric List', openWith:function(markItUp) {
			return markItUp.line+'. ';
		}},
		{separator:'---------------' },
		{name:'Picture', key:'P', beforeInsert: function(e) {				
			
			var _button = $(e.textarea).offset();				
			$('#markup-files').css({'left' : _button.left - 200 , 'top' : _button.top - 200 }).show();
				
			}},
		{name:'Link', key:'L', beforeInsert : function(e) {
				
				var _button = $(e.textarea).offset();			
				$('#markup-links').css({'left' : _button.left - 200 , 'top' : _button.top - 200 }).show();
			
			}
		}			
	]
}

// mIu nameSpace to avoid conflict.
miu = {
	markdownTitle: function(markItUp, char) {
		heading = '';
		n = $.trim(markItUp.selection||markItUp.placeHolder).length;
		for(i = 0; i < n; i++) {
			heading += char;
		}
		return '\n'+heading;
	}
}