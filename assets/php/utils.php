<?php
header('Cache-Control: max-age=84600');

function getRequestParameter($param) {
    if(isset($_REQUEST[$param])) {
        return $_REQUEST[$param];
    }
    else {
        return null;
    }
}

