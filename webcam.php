<?php
session_start();
?>
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
    <?php include('top_bar.php');?>
</div>
    <br/>
    <!-- <canvas id="CANVAS" name="CANVAS" width="500" height="375">Your browser does not support Canvas.</canvas>
    <div id="container"  name='cont' class="container-fluid no-padding ">
        <video autoplay="true" id="videoElement" name='vid'>
        </video>
    </div> -->
    <a id="download" download="face.jpg"></form>
    <button onclick="myFunction() downlowd();" align="center" style="margin: 20px 250px auto " class="btn btn-primary dropdown-toggle" type="button" >capture</button></a>
    <form action="" method="post" enctype="multipart/form-data">
    Selectionner une image depuis votre ordinateur:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit" id="insert">
</form>
<canvas id="canvas"></canvas>
<br/>
<script src="webcam.js"></script>
<div id="right-rec"></div>
    <div>
        <form action="" method="post">
        <button name="filter1" value="filt">
            <img src="test_photo_montage/filter1.png" class="filter">
        </button>
        <button name="filter2" value="filt">
            <img src="test_photo_montage/filter2.png" class="filter">
        </button>
        <button name="filter3" value="filt">
            <img src="test_photo_montage/filter3.png" class="filter">
        </button>
        <button name="filter4" value="filt">
            <img src="test_photo_montage/filter4.png" class="filter">
        </button>
        <button name="smiley" value="filt">
            <img src="test_photo_montage/smiley.png" class="filter">
        </button>
        </form>
    </div>
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
    if(isset($_POST["submit"]))
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
         $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/photo.png")) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    echo "<div><img src=\"/uploads/photo.png\"></div>";
    }
}

function choose_filter()
{
    include_once('photo/add_montage.php');
    include('test_photo_montage/montage.php');
    if (isset($_POST["filter1"]))
        edit("test_photo_montage/filter1.png");
    if (isset($_POST["filter2"]))
        edit("test_photo_montage/filter2.png");
    if (isset($_POST["filter3"]))
        edit("test_photo_montage/filter3.png");
    if (isset($_POST["filter4"]))
        edit("test_photo_montage/filter4.png");
    if (isset($_POST["smiley"]))
        edit("test_photo_montage/smiley.png");
    if (isset($_POST["save"]))
        save_img();
}
upload();
choose_filter();
?>