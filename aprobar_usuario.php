<?php
session_start();
//validamos el inicio de sesion
  if(!isset($_SESSION['email'])){
    header('location:visitante-index.php?error=no_einicio_sesion');
  }
  if($_SESSION['usu_tipo']!=1){
        header('location:visitante-index.php?error=error de nivel de acceso');
  }

$id= $_GET['id'];

include('conexion/conecta.inc.php');
$sql='update usuarios set usu_aprobado=1 where usu_id="'.$id.'"';
$result=mysqli_query($link,$sql);

			
header('location:admin-usuarios.php?ok=usuario_aprobado');
		
?>