<?php
session_start();

$email= $_POST['email'];
$clave= $_POST['clave'];

include('conexion/conecta.inc.php');
$sql='select * from usuarios where usu_email="'.$email.'"';
$result=mysqli_query($link,$sql);
if(mysqli_num_rows($result)>0){
	
	//si existe usuario. validar contraseña
	$fila=mysqli_fetch_array($result);

	if($fila['usu_aprobado']==0){
		header('location:error-usuario-no-aprobado.php?error= Usuario sin aprobar');
		die();
	}

	if($fila['usu_password']==md5($clave)){
		//pass correcta
		$_SESSION['email']=$fila['usu_email'];
		$_SESSION['password']=$fila['usu_password'];  
		$_SESSION['apellido']=$fila['usu_apellido'];
		$_SESSION['nombre']=$fila['usu_nombre'];
		$_SESSION['usu_id']=$fila['usu_id'];
		//ver que tipo de usuario es
		if($fila['usu_tipo_usuario']==1){
			$_SESSION['usu_tipo']='1';
			header('location:bienvenido-admin.php?ok=Bienvenido');
		}else{
			$_SESSION['usu_tipo']='2';
			header('location:bienvenido-cliente.php?ok=Bienvenido');
			
		}

		
	}else{
		header('location:error-contraseña-incorrecta.php?error=Contraseña incorrecta');
		
	}

}else{
	header('location:error-usuario-incorrecto.php?error=Usuario Incorrecto');
}
?>