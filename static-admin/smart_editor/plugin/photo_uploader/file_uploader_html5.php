<?php
 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
	$file = new stdClass;
	$file->name = str_replace("\0", "", rawurldecode($headers['file_name']));
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");
	
	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		$year = date('Y');
		$month = date('m');
		
		$uploadDir = $_SERVER['DOCUMENT_ROOT'].'/uploads/editorFile/'.$year.'/'.$month.'/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}

		if( preg_match("/[\xE0-\xFF][\x80-\xFF][\x80-\xFF]/", $file->name) ){
			mt_srand();
			$file->name = md5(uniqid(mt_rand())).$filename_ext;
		}
		
		$newPath = $uploadDir.$file->name;
		
		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$file->name;
			$sFileInfo .= "&sFileURL=/uploads/editorFile/".$year.'/'.$month.'/'.$file->name;
		}
		
		echo $sFileInfo;
	}
?>