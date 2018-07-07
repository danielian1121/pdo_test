<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('myPDO.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="pdo_class.php" id="test" method="post">
        <input type="text" name="username"></input><br>
        <input type="password" name="password"></input><br>
        <input type="submit" name="submit" value="update"></input>
    </form>
    <select name="id" form="test">
        <?php
            $pdo = new myPDO;
            $query = $pdo->getID();
            foreach($query as $row){
                echo "<option value=\"".$row['id']."\">".$row['id']."</option>";
            }
        ?>
    </select>
    
    
</body>
</html>