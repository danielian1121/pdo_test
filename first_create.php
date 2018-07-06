<?php

$dsn = 'mysql:host=localhost;dbname=test';
//創建一個物件來連線
$pdo = new PDO($dsn,'sukamo','toloveru1121');
//設定編碼
$pdo->query("SET NAMES 'utf8'");
$sql = "SELECT * FROM test ORDER BY id ASC LIMIT 10";
$query = $pdo->query($sql);
$query->setFetchMode(PDO::FETCH_ASSOC);

foreach($query as $row){
    echo $row['username'] . '<br>';
}

?>