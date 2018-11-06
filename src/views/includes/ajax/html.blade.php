<textarea name="content" class="tinymce" style="width:100%">{{ $row['content'] }}</textarea>

<script>
base_url="{{ asset('/') }}";
$(function () {
		tinymce.init({
		    selector:   "textarea.tinymce",
		    width:      '100%',
		    height:     '100%',
		    plugins:     ["anchor link"],
		    statusbar:  true,
			menubar:    true,
			setup: function(editor) {
                    editor.on('change', function() {
                        tinymce.triggerSave();
                    });
            },
		    toolbar: "link anchor | alignleft aligncenter alignright alignjustify"
		});
});//end doc ready

// Prevent bootstrap dialog from blocking focusin
$(document).on('focusin', function(e) {
	if ($(e.target).closest(".mce-window").length) {
		e.stopImmediatePropagation();
	}
});

</script>
