<?php

function put_img_to_gal()
{
    include('del_photo.php');
    include('config/connection.php');
    
    $query = $pdo->prepare("SELECT * FROM photos ORDER BY date DESC");
    try {
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $key=>$value)  
        {
            echo '  
                <tr>  
                    <td>  
                        <img src="data:image/jpeg;base64,'.base64_encode($value['photo']).'" class="img_gal" />' ?>
                        <?php include('comments/write_comment.html'); ?>
                        <?php include('comments/like.html'); ?>
                        <?php
        echo  '</td>
                    </tr>
            ';
        }
    } catch (PDOexception $e) {
        echo $e->getMessage();
    }
    if ((isset($_POST["email"]) && isset($_POST["action"]) &&
    ($_POST["action"]=="update"))){
        delete();
    }
}
put_img_to_gal();
?>