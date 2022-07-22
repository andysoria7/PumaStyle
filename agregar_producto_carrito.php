<?php
session_start();

//validamos el inicio de sesion
if(!isset($_SESSION['email'])){
    header('location:visitante-index.php?error=no_einicio_sesion');
  }
  //+++++++++++++++++++++++++++++++++++++++++++++++++++

$produ_id= $_POST['produ_id'];
$cantidad= $_POST['cantidad'];
$produ_precio= $_POST['produ_precio'];

if($_SESSION['carrito'][$produ_id]!=''){
    header('location:ver_carrito.php?error=existente');
    die();
}else{
    $_SESSION['carrito'][$produ_id]=$produ_id.':'.$cantidad.':'.$produ_precio;
}		
header('location:ver_carrito.php');
		
?>