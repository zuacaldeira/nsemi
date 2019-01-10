<?php
header('Cache-Control: max-age=84600');

function getPDO() {
    /*
    $cleardb_url = getEnv("CLEARDB_DATABASE_URL");
    $parts = getDatabaseUrlParts($cleardb_url);
    $host = $parts['host'];
    $dbname = $parts['dbname'];
    $username = $parts['username'];
    $password = $parts['password'];
    */
    $host = 'localhost';
    $dbname = 'nsemidb';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=".$host."; dbname=".$dbname.'; charset=utf8', $username, $password);
    return $pdo;
}
function getDatabaseUrlParts($url) {
    $p = explode("@", $url);
    
    $user_pass = explode("//", $p[0])[1];
    $username = explode(":", $user_pass)[0];
    $password = explode(":", $user_pass)[1];
    
    $host_dbname = explode("/", $p[1]);
    $host = $host_dbname[0];
    $dbname = explode("?", $host_dbname[1])[0];
    
    return ['host' => $host, 
            'dbname' => $dbname, 
            'username' => $username, 
            'password' => $password];
}

function getRequestParameter($param) {
    if(isset($_REQUEST[$param])) {
        return $_REQUEST[$param];
    }
    else {
        return null;
    }
}

