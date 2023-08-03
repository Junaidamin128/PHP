<?php

require "./vendor/autoload.php";

define("BASE_PATH", getcwd());

$url = $_GET['url'];
$app = new \Core\App();
$app->handleRequest($url);