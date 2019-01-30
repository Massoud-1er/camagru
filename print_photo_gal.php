<?php
function put_img_to_gal()
{
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
                        <img src="data:image/jpeg;base64,'.base64_encode($value['photo']).'" class="img_gal" />  
                    </td>  
                </tr>  
            ';
        }
    } catch (PDOexception $e) {
        echo $e->getMessage();
    }
}
put_img_to_gal();
?> 