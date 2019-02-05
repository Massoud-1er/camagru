<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    $uploadOk = 0;
}
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
if ($uploadOk != 0) {
    $files = $_FILES["fileToUpload"];
    $type = $files['type'];
	$size = $files['size'];
	$imgPath = $files['tmp_name'];
    $img = base64_encode(file_get_contents($imgPath));
}
?>