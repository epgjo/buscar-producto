<?php
$conn = new mysqli("localhost", "root", "", "comercio");
if($conn->connect_error){
  die('Error de conexion '. $conn->connect_error );
}

?>
