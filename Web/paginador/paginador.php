<?php
function paginate($query, $limit, $order_by, $db){
    $s = $db->prepare($query);
    $s->execute();
    $total_results = $s->rowCount();
    $total_pages = ceil($total_results/$limit);
    
    if (!isset($_GET['page'])) {
        $page = 1;
    } else{
        $page = $_GET['page'];
    }
    
    $starting_limit = ($page-1)*$limit;
    $show = "$query ORDER BY $order_by LIMIT $limit OFFSET $starting_limit";
    
    $result = $db->prepare($show);
    $result->execute();
    $datos = $result -> fetchAll();
    return array($datos, $total_pages);
}

function get_links($total_pages){
    for ($page=1; $page <= $total_pages ; $page++):
        echo "<a href='?page=$page, class='links'>  $page  </a>";
    endfor;
}

?>