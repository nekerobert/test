<?php
// $upload_path = PROJECT_PATH."/uploads";
$upload_path = UPLOAD_PATH;

// Define allowed filetypes to check against during validations
$allowed_mime_types = ['image/png','image/jpg', 'image/jpeg'];
$allowed_extensions = ['png','jpg', 'jpeg'];

$check_is_image = true;
$check_for_php = true;
$max_file_size = 500000; //Max File Size is 500kb

// Provides plain-text error messages for file upload errors.
function file_upload_error($error_integer) {
	$upload_errors = array(
		// http://php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	return $upload_errors[$error_integer];
}

// Sanitizes a file name to ensure it is harmless
function sanitize_file_name($filename) {
	$filename = preg_replace("/([^A-Za-z0-9_\-\.]|[\.]{2})/", "", $filename);
	$file_url_name = uniqid('food_', true);

	$result = ["name"=> $filename,"file_url_name"=>$file_url_name];
	return $result;
}

// Returns the file permissions in octal format.
function file_permissions($file) {
	$numeric_perms = fileperms($file);
	$octal_perms = sprintf('%o', $numeric_perms);
	return substr($octal_perms, -4);
}

// Returns the file extension of a file
function file_extension($file) {
	return pathinfo($file, PATHINFO_EXTENSION);
}

function file_contains_php($file) {
	// $contents = file_get_contents($file);
	$contents = fread(fopen($file["tmp_name"], 'r'), $file["size"]);
	$position = strpos($contents, '<?php');
	return $position !== false;
}

// Resize Image to meet standard expected size

function resizeImage($resourceType,$image_width,$image_height,$resize_width=null,$resize_height= null) {
    $resizeWidth =  $resize_width === null ? 100 : $resize_width;
    $resizeHeight = $resize_height === null ? 100 : $resize_height;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function validate_files($data = []){
	global $max_file_size, $allowed_mime_types, $allowed_extensions, $check_is_image, $check_for_php;
	$errors = [];
	if($data["error"] > 0) {
		// Display errors caught by PHP
		$errors[] =  "Error: " . file_upload_error($data["error"]);
	} 
	
	if(!is_uploaded_file($data["tmp_name"])) {
		$errors[] =  "Error: Does not reference a recently uploaded file.<br />";	
	} 
	
	if(!in_array($data["file_type"], $allowed_mime_types)) {
		$errors[] = "Not an allowed mime type.";

	} 
	
	if(!in_array($data["file_extension"], $allowed_extensions)) {
		$errors[] = "Not an allowed file extension.";
	
	} 
	
	if($check_is_image && (getimagesize($data["tmp_name"]) === false)) {
		$errors[] = "Not a valid image file.";
	} 
	
	if($check_for_php && file_contains_php(["tmp_name"=>$data["tmp_name"],"size"=>$data["file_size"]])) {
		// A valid image can still contain embedded PHP.
		$errors[] = "File contains PHP code.";

	} 
	
	if(file_exists($data["file_path"] )) {
		$errors[] = "A file with that name already exists in target location";
		
	} 
	
	if ($data["file_size"] > $max_file_size) {
		$errors[] = "File size must not exceed 500KB";
	} 

	return $errors;

}

function upload_file($file, $multiple=false, $extra="") {
	global $upload_path;
	$errors = []; $processFile = [];
	if(!$multiple){
		if(empty($file["name"]) && empty($file["type"]) && empty($file["tmp_name"])) {
			$errors[] = "File was not uploaded ";
			$errors["mode"] = false; //differentiate the error array from success array
			return $errors;
		}
			
		$result = sanitize_file_name($file['name']);
		$processFile["file_extension"] = file_extension($file["name"]);
		$processFile["file_type"] = $file['type'];
		$processFile["tmp_name"] = $file['tmp_name'];
		$processFile["error"] = $file['error'];
		$processFile["file_size"] = $file['size'];
		$processFile["file_path"] = $upload_path . '/' . $result["file_url_name"].".".$processFile["file_extension"];
		$processFile["file"] = 	$file;
			
			// Validate the file
		$errors = validate_files($processFile);
		
		if(!empty($errors)){
			$errors["mode"] = false; //differentiate the error array from success array
			return $errors;
		}
				// Upload the file
		if(!move_uploaded_file($processFile["tmp_name"], $processFile["file_path"])) {
			$errors[] = "Error occured While uploading File";
			$errors["mode"] = false; //differentiate the error array from success array
			return $errors;
		}

		$response["name"] = $result["name"];
		$response["path"] = $result["file_url_name"].".".$processFile["file_extension"];
		$response["type"] = $processFile["file_type"];
		$response["mode"] = true;
		return $response;

	}else{
		
		// This works if title is a string
		$title = $extra; $data = [];
		
		if(is_array($extra)){
			// Extract title from extra array
			$title = $extra["title"];
			unset($extra["title"]); //title wil not exist in the json string that will be generated
		}
		
		
		// Handling Uploading of multiple files
		$resultArray = [];
		
		$fileNames = array_filter($file["name"]);
		/**
		 * No File was Uploaded
		 */
		if(empty($fileNames)){
			$errors[] = "File(s) not uploaded ";
			$errors["mode"] = false; //differentiate the error array from success array
			return $errors;
		}
		/**
		 * Files submitted, therefore began processing, validating and uploading of files 
		 */
		foreach ($fileNames as $key => $value) {
			$result = sanitize_file_name($file["name"][$key]);
			$processFile["file_extension"] = file_extension($file["name"][$key]);
			$processFile["file_type"]  = $file['type'][$key];
			$processFile["tmp_name"] = $file['tmp_name'][$key];
			$processFile["error"] = $file['error'][$key];
			$processFile["file_size"] = $file['size'][$key];
			$processFile["file_path"] = $upload_path . '/' . $result["file_url_name"].".".$processFile["file_extension"];
			// $processFile["file"] = 	$file;
			// $result = sanitize_file_name($file['name']);
			/**
			 * Check and validate files
			 */
			$errors = validate_files($processFile);

			/**
			 * Errors occured during file validation therefore stop futher processing and returned the current error information to the user
			 */
			if(!empty($errors)){
					// Errors occured while uploading
				$errors["mode"] = false; //differentiate the error array from success array
				return $errors;
			}
			
			/**
			 * Errors did'nt occur during validation. Proceed to uploading of file
			 * If errors occured during uploading of files, stop processing of other files and return the error information to the user
			 */
			if(!move_uploaded_file($processFile["tmp_name"], $processFile["file_path"])) {
				$errors[] = "Error occured While uploading File";
				$errors["mode"] = false; //differentiate the error array from success array
				return $errors;
			}
			
			/**
			 * Uploading Of current file was succesful. Therefore arrange the file and move it into the result array
			 * This response array will subsequently be persisted in the database
			 * This is a customized section of this code just for this project.
			 */
			// $response["name"] = $result["name"];
			$path = $result["file_url_name"].".".$processFile["file_extension"];
			// $response["type"] = $processFile["file_type"];
			if(is_array($extra)){
				foreach ($extra as $key => $value) {
					$data[$key] = $value;
				}
			}
			$data["path"] = $path;
			$response["content"] = array_to_json($data); //Convert to JSON str
			$response["title"] = $title;
			$resultArray[] = $response;
		}
		
		/**
		 * Uploading of all files was succesful. Therefore return the multi-dimensional array containing all arrays of uploaded files;
		 * Specify additional element of key mode which will be use to differentiate the error(s)-containing array from the success containing array.
		 */

		$resultArray["mode"] = true;
		
		return $resultArray;
	}
	
	

}



?>
