<?php



$color = "#aa00bb";

if (isset($_POST['submit'])) {
    $color = $_POST['color'];
    setcookie("color", $color, time() + 60 * 60 * 24);
}

if (isset($_COOKIE['color'])) {
    $color = $_COOKIE['color'];
}

setcookie("uid", 10, time() + 60 * 60 * 24);

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