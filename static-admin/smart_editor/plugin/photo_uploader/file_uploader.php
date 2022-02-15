<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if($bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if( preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $name) ){
		mt_srand();
		$name = md5(uniqid(mt_rand())).$filename_ext;
	}

	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$year = date('Y');
		$month = date('m');
		$document_root = dirname(__FILE__);

		$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/uploads/editorFile/'.$year.'/'.$month.'/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777, true);
		}
		
		$newPath = $uploadDir.$name;
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		$url .= "&sFileURL=/uploads/editorFile/".$year.'/'.$month.'/'.urlencode(urlencode($name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>