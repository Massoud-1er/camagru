<?php

include('../config/connection.php');
$id = $_GET['id'];
  $query = $pdo->prepare("SELECT `photo` FROM `photos` WHERE id=?");
  $query->execute([$id]);
  $row = $query->fetchAll();
  $pdo = null;

  header("Content-type: image/jpeg");
  echo $row['photo'];
?>