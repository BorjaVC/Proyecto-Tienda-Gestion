<?php
//Inicializar sesión
session_start();
include('..\inc\header.php');
include('..\inc\container.php');

if(!isset($_GET['vista']) || $_GET['vista']==""){
    $_GET['vista']="login";
}

if(is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="login" && $_GET['vista']!="404"){
    
    include('..\inc\menu.php');

    include "vistas/".$_GET['vista'].".php";

    include "../gestion/inc/script.php";

    include '..\inc\footer.php';

}else{
        include "tenda.php";
    
}
?>


