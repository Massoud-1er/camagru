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
    $pages = ceil($total / $limit);

    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    $query = $pdo->prepare('
SELECT
    *
FROM
    table
ORDER BY
    name
LIMIT
    :limit
OFFSET
    :offset');
    $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);
    try {
        $query->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // Do we have any results?
    if ($query->rowCount() > 0) {
        // Define how we want to fetch the results
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($query);

        // Display the results
        foreach ($iterator as $row) {
            echo '<p>', $row['name'], '</p>';
        }
    } else {
        echo '<p>No results could be displayed.</p>';
    }
}

?>