<?php
    function connect(){
        $db = mysqli_connect('127.0.0.1', 'root','','OSA');;
        if(!$db){
            echo StatusCode('InternalServerError',500);
            http_response_code(500);
            exit;
        }
        return $db;
    }
?>