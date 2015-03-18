<?php

/*
 * As used in http://www.w3schools.com/php/php_file_upload.asp
 * 
 * */

$target_dir = "uploads/";
$file_name = md5(time()) . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_name;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$error_message;

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check == false) {
        $error_message = " File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $error_message .= " Sorry, file already exists.";
    $uploadOk = 0;
}

 // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $error_message .= "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $error_message .= " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error_message .= " Sorry, your file was not uploaded.";
	header('Location: ../index.php?page=pictures&error=' . urlencode($error_message));
	die;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	
		// Save URL 'basename($_FILES["fileToUpload"]["name"])' to the database 'picture' table with owner set to email from session array
		
		include_once('Qry.php');
		session_start();
		$myPictures = Qry::qId('INSERT INTO pictures (picture, owner_id) VALUES ("'.$file_name.'",'.$_SESSION["login"]['id'].')');
		
		header('Location: ../index.php?page=pictures&saved=ok');
		die;
    } else {
        $error_message .= " Sorry, there was an error uploading your file.";
		header('Location: ../index.php?page=upload&error=' . urlencode($error_message));
		die;
    }
}
