<?php
function connection(){
  $user="carlos";
  $password="123";
  $host="localhost";
  $db="ArduinoDemo";

  $conection= mysqli_connect($host,$user,$password,$db) or die("error de conexion");

  return $conection;
}
?>
