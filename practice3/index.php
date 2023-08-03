<?php
$size  = rand(0,10);
$a = [];
for ($i=0;$i<=$size;$i++){
    $number = rand(0,100);
    array_push($a,$number);
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Practice</h1>
    <ul>
        <?php 
        foreach($a as $arr){
            ?>
            <li style="list-style: none; border-bottom: 2px solid; text-align:center; width:50px;">
                <?=$arr?>
            </li>
            <?php
        };
        ?>
    </ul>
</body>
</html>
