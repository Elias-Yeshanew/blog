<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'blog';

$conn = new MySQLi($host, $user, $pass, $db_name);

// if($con-> connect_error){
//     die('Database Connection error: ' . $con->connect_error);
// } else{
//     echo "db connection is seccussfull;";
// }