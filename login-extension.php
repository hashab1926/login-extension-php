<?php
require_once "config.php";

$request = $_POST;
$checkLogin = $conn->query("SELECT * FROM tbl_user WHERE email='$request[email]'");
if($checkLogin->num_rows > 0 ){
    $dataUser = $checkLogin->fetch_object();
    $userId = $dataUser->id;
    $token = randomStr();

    // update all status by user_id
    $conn->query("UPDATE user_token SET status='EXP' WHERE user_id='$userId'");
    
    // insert table_token
    $conn->query("INSERT INTO user_token (id, user_id, token, status) VALUES(NULL,'$userId','$token','LOGIN')");

    $result = [
        "message" => "Success.",
        "status"  => 200,
        "data"    => [
            "email" => $dataUser->email,
            "token" => $token,
        ]
    ];
    echo json_encode($result);
}

function randomStr($length = 20)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}