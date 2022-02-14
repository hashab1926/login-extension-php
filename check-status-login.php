<?php 
require_once "config.php";
$request = $_GET;
try{
    $token = isset($request['token']) ? $request['token'] : null;
    if(!$token) return;
    
    $checkLogin = $conn->query("SELECT * FROM user_token WHERE token='$token' AND status='LOGIN'");
    $result = [
        "status_code" => 200,
        "message"     => "ok",
        "data"        => $checkLogin->fetch_assoc()
    ];
    
}catch(Exception $error){
    $result = [
        "status_code" => 400,
        "message"     => $error->getMessage()
    ];
}finally{
    echo json_encode($result);
}
