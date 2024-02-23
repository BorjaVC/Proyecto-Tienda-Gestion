<?php 
$dbHost ="localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "tienda";

$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if ($db -> connect_error) {
    die("No hay conexión con la base de datos" . $db -> connect_error);
}
?>