<?php
require_once('myPDO.php');

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    if(!($username && $password)){
        echo "Input Error";
    }
}

$pdo = new myPDO;
$post = [
    'username' => "$username",
    'password' => "$password",
];

$pdo->update('test',$post,$id);

