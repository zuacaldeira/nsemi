<?php
set_time_limit(0);

ob_start("ob_gzhandler");
require_once('./utils.php');
require_once('./resize_utils.php');


header('Content-type:application/json;charset=utf-8');


$name = getRequestParameter('name');
$width = json_decode(getRequestParameter('width'));
$height = json_decode(getRequestParameter('height'));
$data = getRequestParameter('data');
$from_db = json_decode(getRequestParameter('from_db'));

if($data == null && !$from_db) {
    report_error('Invalid or empty data url');
}

else {
    if($data == null && $from_db) {
        $name = str_replace('sm_thumb', 'xl_thumb', $name);
        $name = str_replace('md_thumb', 'xl_thumb', $name);
        $name = str_replace('lg_thumb', 'xl_thumb', $name);
        $data = getImageFromDB($name)->data;
    }
    
    $new_data = crop_multiple($name, $data, $width, $height);
    echo json_encode($new_data);
}



ob_end_flush();



?>
