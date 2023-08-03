<?php


session_start();

$color = "#aa00bb";

if (isset($_POST['submit'])) {
    $color = $_POST['color'];
    $_SESSION['color'] = $color;
}

if (isset($_SESSION['color'])) {
    $color = $_SESSION['color'];
}

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
    <h1 style="color:<?= $color; ?>">Hello world</h1>
    <form method="POST">
        <label for="color">Color
            <input type="color" name="color" id="color" value="<?= $color; ?>">
            <input type="submit" value="Submit" name="submit" id="submit">
        </label>
    </form>
</body>

</html>