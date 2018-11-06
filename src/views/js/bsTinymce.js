var tinymce_config = {
	path_absolute : "/",
	selector: 'textarea.tinymce',
	menubar: true,
	statusbar: true,
	relative_urls: false,
	theme : "modern",
	schema: 'html5',
	image_advtab: true ,
	setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
    },
	plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern",
		"responsivefilemanager imagetools codesample"
	],
	external_plugins: { 
		//"filemanager" : base_url + '/tinymce/plugins/responsivefilemanager/plugin.min.js',
		"responsivefilemanager" : base_url + '/vendor/tinymce/plugins/responsivefilemanager/plugin.min.js',
	},
	toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	toolbar2: "advlist autolink lists charmap print preview hr anchor pagebreak | searchreplace wordcount visualblocks visualchars  fullscreen |" + 
			 " template paste textcolor colorpicker textpattern responsivefilemanager imagetools code codesample",
 	external_filemanager_path:"/filemanager/",
   	filemanager_title:"Responsive Filemanager" ,
	relative_urls: false,
	templates: base_url+"/vendor/tinymce/templates.php",
	codesample_languages: [
        {text: 'HTML/XML', 		value: 'language-markup'},
        {text: 'JavaScript', 	value: 'language-javascript'},
        {text: 'CSS', 			value: 'language-css'},
        {text: 'PHP', 			value: 'language-php'},
        {text: 'Ruby', 			value: 'language-ruby'},
        {text: 'Python',		value: 'language-python'},
        {text: 'Java', 			value: 'language-java'},
        {text: 'C', 			value: 'language-c'},
        {text: 'C#', 			value: 'language-csharp'},
        {text: 'C++', 			value: 'language-cpp'}
    ],
	/*
	file_browser_callback : function(field_name, url, type, win) {
		var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
		var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

		var cmsURL = tinymce_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
		//var cmsURL = base_url + '/laravel-filemanager?field_name=' + field_name;
		if (type == 'image') {
			cmsURL = cmsURL + "&type=Images";
		} else {
			cmsURL = cmsURL + "&type=Files";
		}

		tinyMCE.activeEditor.windowManager.open({
			file : cmsURL,
			title : 'Filemanager',
			width : x * 0.8,
			height : y * 0.8,
			resizable : "yes",
			close_previous : "no"
		});
	},
	//*/
	/*
	style_formats : [
            {title : 'Bold text', inline : 'b'},
            {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
            {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
            {title : 'Example 1', inline : 'span', classes : 'example1'},
            {title : 'Example 2', inline : 'span', classes : 'example2'},
            {title : 'Table styles'},
            {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ],
	*/
	/*
    formats : {
            alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
            aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
            alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
            alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
            bold : {inline : 'span', 'classes' : 'bold'},
            italic : {inline : 'span', 'classes' : 'italic'},
            underline : {inline : 'span', 'classes' : 'underline', exact : true},
            strikethrough : {inline : 'del'},
            customformat : {inline : 'span', styles : {color : '#00ff00', fontSize : '20px'}, attributes : {title : 'My custom format'}}
    },
    */
};


if (typeof TinyMCE == 'undefined') {
 	$.getScript(base_url+'/bc/tinymce/tinymce.min.js', function() {
	$.getScript(base_url+'/bc/tinymce/jquery.tinymce.min.js', function() {
		window.tinymce.dom.Event.domLoaded = true;
		tinymce.baseURL=base_url+'/bc/tinymce';
		tinymce.suffix = '.min';
		tinymce.init(tinymce_config);
	});
	});
};