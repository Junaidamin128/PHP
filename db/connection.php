<?php


$conn = mysqli_connect("localhost", "root", "", "db1");
if(mysqli_connect_errno()){
    echo "Mysql connection failed";
    exit;
}