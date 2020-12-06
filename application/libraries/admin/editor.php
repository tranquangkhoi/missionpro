<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Editor{
	
	function view_text($id="",$max_height="550",$min_height="200",$width="360",$height="350"){		
		$str = "<script>
					tinymce.init({
						selector: \"textarea$id\",
						fontsize_formats: \"8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 26pt 36pt\",
						plugins: [
								\"advlist autolink lists link image charmap print preview anchor\",
								\"searchreplace visualblocks code fullscreen\",
								\"insertdatetime media table contextmenu paste\"
						],
						toolbar1: \"fullscreen | undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent\",
						toolbar2: \"fontselect | fontsizeselect | link image | removeformat | preview\",
						image_advtab: true,
						autosave_ask_before_unload: false,
						max_height: $max_height,
						min_height: $min_height,
						height : $height,
						width: $width
						
					});
				</script>";
		return $str;
	}
	
	function view_file($id="",$max_height="550",$min_height="200",$width="360",$height="350"){		
		$path = base_url();
		$str = "<script>
					tinymce.init({
						selector: \"textarea$id\",
						fontsize_formats: \"8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 26pt 36pt\",
						plugins: [
								\"advlist autolink lists link image charmap print preview anchor\",
								\"searchreplace visualblocks code fullscreen\",
								\"insertdatetime media table contextmenu paste textcolor responsivefilemanager\"
						],
						toolbar1: \"fullscreen | undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent\",
						toolbar2: \"forecolor backcolor | fontselect | fontsizeselect | link image | removeformat | preview\",
						image_advtab: true,
						autosave_ask_before_unload: false,
						max_height: $max_height,
						min_height: $min_height,
						height : $height,
						width: $width,
						external_filemanager_path:\"/tinyeditor/filemanager/\",
   						filemanager_title:\"Responsive Filemanager\" ,
   						external_plugins: { \"filemanager\" : \"../filemanager/plugin.min.js\"}
						
					});
				</script>";
		return $str;
	}
}
?>