<?php 

function returnRes($data , $status){

    header('Content-Type: application/json');
    http_response_code($status);
    echo(json_encode($data));

}

?>