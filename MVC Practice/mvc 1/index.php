<?php

require "./Core/App.php";

define("BASE_PATH", getcwd());

$url = $_GET['url'];
$app = new App();
$app->handleRequest($url);