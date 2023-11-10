<?php
    include_once './api/routers/connect.php';
    function route($method, $urlList, $requestData){
        if($method = 'POST'){
            $db = connect();
            if(!is_null($requestData->body)){
                $login = $requestData->body->login;
                $password = $requestData->body->password;
                $userid = $db -> query("SELECT id FROM User WHERE login = '$login' AND password = '$password'")->fetch_assoc();
                if(is_null($userid)){
                    http_response_code(400);
                    echo json_encode(['message'=>'Bad request', 'code'=>400]);
                    exit;
                }
                http_response_code(200);
                echo 'Вы вошли';
            }
            else{
                http_response_code(400);
                echo json_encode(['message'=>'Bad request', 'code'=>400]);
                exit;
            }
        }
    }
?>