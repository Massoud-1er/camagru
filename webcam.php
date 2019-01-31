<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta content="stuff, to, help, search, engines, not" name="keywords">
    <meta content="What this page is about." name="description">
    <meta content="Display Webcam Stream" name="title">
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="style.css">
<style>
</style>
</head>
  
<body>
<div id="top_bar">
    <?php include ('top_bar.php');?>
</div>
    <br/>
    <div id="container">
        <video autoplay="true" id="videoElement"></video>
    </div>
    <div id="right-rec"></div>

    <button id="pic" onclick="test()">prendre photo</button>
    <form action="" method="post" enctype="multipart/form-data">
        Selectionner une image depuis votre ordinateur:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit" id="insert">
    </form>
    <canvas id="canvas"></canvas>
    <script src="webcam.js"></script>
</body>
</html>


<?php
function upload()
{
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        //echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        $files = $_FILES["fileToUpload"];
        $type = $files['type'];
        $size = $files['size'];
        $imgPath = $files['tmp_name'];
        $img = base64_encode(file_get_contents($imgPath));

    //    echo "<div><img src='data:image/$type;base64,$img'></div>";
        include('test_photo_montage/montage.php');
    }
}

upload();
?>