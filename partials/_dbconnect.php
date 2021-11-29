<?php 
//Script to connect to the database\
$server = "localhost";
$username = "root";
$password = "";
$database = "forum";
$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    die("Error". mysqli_connect_error($conn));
}

 ?>