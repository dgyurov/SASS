<?php

$target_dir = "../resources/uploads/";
$file_name = md5(time()) . str_replace(" ", "_", basename($_FILES["fileToUpload"]["name"]));
$target_file = $target_dir . $file_name;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$error_message;

move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

include_once('Qry.php');
session_start();
$myPictures = Qry::qId('INSERT INTO pictures (picture, owner_id) VALUES ("'.$file_name.'",'.$_SESSION["login"]['id'].')');

header('Location: ../index.php?page=pictures&resource=' . urlencode('The picture has been successfully uploaded.'));
