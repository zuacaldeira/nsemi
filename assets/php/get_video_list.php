<?php

ob_start("ob_gzhandler");
require_once('./utils.php');
require_once('./resize_utils.php');


$result = [];
$result = getVideoList();



header('Content-type:application/json;charset=utf-8');
echo json_encode($result);









function getVideoList() {
    $pdo = getPDO();
    $query = "SELECT * FROM vguide";
    $erg = $pdo->query($query);
    return $erg->fetchAll(PDO::FETCH_OBJ);
}


ob_end_flush();

?>