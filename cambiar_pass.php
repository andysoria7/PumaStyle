<?php
session_start();
include('conexion/conecta.inc.php');

//validamos el inicio de sesion
if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++



if(isset($_POST['enviar'])){
  $nueva=$_POST['nueva'];
  $actual=$_POST['actual'];
  $confirma=$_POST['confirma'];
  
  //validar las contraseñas
  if($nueva!=$confirma){
      $mensaje='La clave es distinta a su confirmación';
      $error=1;
  }
  if($actual==''){
    $mensaje='La clave actual no debe ser una cadena vacia';
    $error=1;
    }

  //buscamos el usuario
    $sql='select * from usuarios where usu_email="'.$_SESSION['email'].'"';
    $result=mysqli_query($link, $sql);
    $fila=mysqli_fetch_array($result);
    if(md5($actual)!=$fila['usu_password']){
        $mensaje='La clave actual ingresada es incorrecta';
        $error=1;
    }

    if($error!=1){
        $sql='update usuarios set usu_password="'.md5($nueva).'" where usu_email="'.$_SESSION['email'].'"';
        $result=mysqli_query($link, $sql);
        if($result){
            $mensaje='La clave fue cambiada con éxito';
            $error=0; 
        }else{
            $mensaje='error cambiando clave';
            $error=1;
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="estilos.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600&display=swap" rel="stylesheet">

  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

  <script src="js/jquery-3.2.1.js"></script>

	<script src="js/script.js"></script>

  <title>Cambiar Password</title>

</head>

<body>
<?php 
  include('inc/nav_menu.inc.php');
  ?>
    <nav>
      <a href="visitante-index.php">Inicio ></a>
        Cambiar Password <?php  echo $mensaje; ?>
        </nav>

      <div class="wrap">
        <h1>Cambiar password </h1>
        <div class="store-wrapper">
          <form name="ca" action="cambiar_pass.php" method="post" class="form">
            <div >Ingrese password actual(*) <input type="password" name="actual" class="input-text" placeholder="Actual"></div><br>
            <div >Ingrese la nueva password(*) <input type="password" name="nueva" class="input-text" placeholder="Nueva"></div><br>
            <div >Confirme la nueva password(*) <input type="password" name="confirma" class="input-text"  placeholder="Confirmación"></div><br>
            <div ><input type="submit" name="enviar" class="btn btn-success"  value="Cambiar"></div>
            
        </form>
           
		</div>
    
	</div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>