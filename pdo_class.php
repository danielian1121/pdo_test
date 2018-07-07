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

$query = $pdo->bindQuery("SELECT * FROM test WHERE username LIKE :username LIMIT :limit",[
    ':username' => "%{$username}%",
    ':limit' => 10
]);
foreach($query as $row){
    echo $row['username'].'<br>';
}

