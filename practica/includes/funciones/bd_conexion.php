<?php
$host_name = 'localhost';
$database = 'adminsistemas';
$user_name = 'root';
$password = '';

$conn = new mysqli($host_name, $user_name, $password, $database);
if($conn->connect_error) {
  echo $error -> $conn->connect_error;
}
?>
