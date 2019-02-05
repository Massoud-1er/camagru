<?php
session_start();

print_r($_SESSION);

if(!isset($_SESSION['login'])){
    header("Location: login.html");
 }

function del_old_edit()
{
    include_once('photo/add_montage.php');
    if (file_exists("uploads/".find_id().".png"))
        unlink("uploads/".find_id().".png");
 }


function getimg()
{
    if (isset($_POST['data_img']) && isset($_POST['getimg']) && $_POST['getimg'] == "getimg"){
        del_old_edit();
        $_SESSION['photo'] == 1;
        $img = $_POST['data_img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents("uploads/photo.png", $data);
        echo "<div><img id=\"cam_pic\" src=\"/uploads/photo.png\"></div>";
        
print_r($_POST);

    }
}

function upload()
{
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
     $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"]))
    {
        del_old_edit();
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
         $uploadOk = 0;
    }
    if ($_FILES["fileToUpload"]["size"] > 2500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    }  else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/photo.png")) {
                    echo "";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
         }
    echo "<div><img id=\"up_img\" src=\"/uploads/photo.png\"></div>";
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

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
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
    <div id="full_body">
    <div id="body-webcam">
    <div id="container">
        <video autoplay="true" id="videoElement"></video>
    </div>
    <?php getimg(); ?>
    <?php choose_filter(); ?>
    <?php upload(); ?>
    <form id ="post_cam" method="post" action=""> 
            <input id="getimg" name="getimg" value="getimg" type="submit" onclick="myFunction()">
            <input id="data_img" type="hidden" name="data_img" value="">
    </form>
    <br><br><br>
    <canvas id="CANVAS" name="canvas" width="500" height="375"></canvas>
    <p>Selectionner une image depuis votre ordinateur: </p>
    <form method="post" action="" enctype="multipart/form-data"> 
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit" id="insert">
    </form>
    <canvas id="canvas"></canvas>
    <div id ="filter">
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
</div> 
    <div id="right-col">
        <?php include('get_mini.php');?>
</div>

</div>
<?php include('footer.php'); ?>
<br/>
    <script src="webcam.js"></script>
</body>
</html>

