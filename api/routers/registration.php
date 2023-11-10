<?php
    include_once './api/routers/connect.php';
    function route($method, $urlList, $requestData){
        if($method == 'POST'){
            $db = connect();
            if(!is_null($requestData->body)){
                $login = $requestData->body->login;
                $password = $requestData->body->password;
                $paste = $db -> query("INSERT INTO User(login, password) values ('$login', '$password')");
                if(!$paste){
                    http_response_code(400);
                    echo json_encode(['message'=>'Bad request', 'code'=>400]);
                    exit;
                }
                http_response_code(200);
                echo 'Вы зарегистрированы';
            }
            else{
                http_response_code(400);
                echo json_encode(['message'=>'Bad request', 'code'=>400]);
                exit;
            }
        }
    }
?>