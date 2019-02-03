<?php 

include('config/connection.php');
try {
$query = $pdo->prepare("SELECT
COUNT(*)
FROM
photos");
$query->execute();
$total = $query->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($total) {
    $limit = 5;
    $pages = ceil($total[0]['COUNT(*)'] / $limit);
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

    $offset = ($page - 1)  * $limit;

    $start = $offset + 1;

    $end = min(($offset + $limit), $total);

    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    $query = $pdo->prepare('
SELECT
    *
FROM
    `photos`
ORDER BY
    date
LIMIT
    :limit
OFFSET
    :offset');
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    try {
        $query->execute();
        $check = $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    if ($query->rowCount() > 0) {
        foreach ($check as $k => $val) {
            print_r(base64_encode($val['photo']));
            print_r($check);
            echo '<p><img src="data:image/jpeg;base64,'.base64_encode($val['photo']).'" class="img_gal" /></p>';
            include('comments/write_comment.html');
            // include('comments/get_likes.php');
            // echo get_likes($val['id']);
        //     echo '<form class="login-form" action="comments/com_and_like.php" method="POST">
        //     '.get_likes($val['id']).'<input id ="like" type="image" src="../pics/like.png" alt="submit" value="like"></a>
        // </form>';
        }
    } else {
        echo '<p>No results could be displayed.</p>';
    }
}

?>