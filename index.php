<?php
    header('Content-type: application/json');

    function getData($method)
    {
        $data = new stdClass();
        if ($method != 'GET'){
            $data->body = json_decode(file_get_contents('php://input'));
        }
        $data->parametrs = [];
        $dataGET = $_GET;
        foreach ($dataGET as $key => $value) {
            if($key !='q'){
                $data->parametrs[$key] = $value;
            }
        }
        return $data;
    }
    function getMetod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    $url = isset($_GET['q']) ? $_GET['q'] : '';
    $url = rtrim($url, '/');
    $urlList = explode('/', $url);
    
    if($urlList[0] != 'api'){
        $errmessage = array('code' => 404, 'message' =>'Not Found');
        echo json_encode($errmessage);
        http_response_code(404);
        exit; 
    }
    $urlList = array_slice($urlList, 1);
    $router = $urlList[0];
    $requestData = getData(getMetod());
    $method = getMetod();
    if(file_exists(realpath(dirname(__FILE__)).'/api/routers/'.$router.'.php')){
        include_once 'api/routers/'.$router.'.php';
        route($method, $urlList, $requestData);
    }
    else{
        $errmessage = array('code' => 404, 'message' =>'file not found');
        http_response_code(404);
        echo json_encode($errmessage);
    }
?>