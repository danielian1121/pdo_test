<?php
require_once('myPDO.php');

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!($username && $password)){
        echo "Input Error";
    }
}

$pdo = new myPDO;
$post = [
    'username' => "$username",
    'password' => "$password"
];

echo $pdo->insert('test',$post);

