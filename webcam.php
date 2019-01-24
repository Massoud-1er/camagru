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
        <!-- <canvas id="canvas" width="300" height="300"></canvas> -->
    </div>
    <div id="right-rec"></div>
    <button id="pic" onclick="test()">prendre photo</button>
    <script src="webcam.js"></script>
</body>
</html>