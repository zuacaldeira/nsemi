<?php
set_time_limit(0);

ob_start("ob_gzhandler");
require_once('./utils.php');
require_once('./resize_utils.php');


header('Content-type:application/json;charset=utf-8');


$name = getRequestParameter('name');
$data = getRequestParameter('data');
$format = getRequestParameter('format');

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
    
    $new_data = convert_image($name, $data, $format);
    echo json_encode([$new_data]);
}



ob_end_flush();



?>
