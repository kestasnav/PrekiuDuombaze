<?php 

$dsn="mysql:host=localhost;dbname=todolist;charset=utf8mb4";

$pdo=new PDO($dsn, 'root','');

$servername = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'todolist';
$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
  die("Connection failed");
}