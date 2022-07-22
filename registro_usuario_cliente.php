<?php
session_start();


include('conexion/conecta.inc.php');

//guardar alta usuario ++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['agregar'])){
    $usu_nombre= $_POST['usu_nombre'];
    $usu_apellido= $_POST['usu_apellido'];
    $usu_documento= $_POST['usu_documento'];
    $usu_email= $_POST['usu_email'];
    $usu_password= $_POST['usu_password'];
    $usu_sexo= $_POST['usu_sexo'];
    $usu_provincia= $_POST['usu_provincia'];
  
    
    
    $mensaje='';
    $error=0;
    // Valido el nombre

     if($usu_nombre==''){
         $mensaje.='Error,  no ingreso el nombre <br>'; 
         $error=1;
        
    }

    // Valido el apellido

     if($usu_apellido==''){
         $mensaje.='Error, no  el apellido <br>'; 
         $error=1;
    }

    // Valido el documento

     if($usu_documento==''){
         $mensaje.='Error, no ingreso el documento <br>'; 
         $error=1;
    }

    // Valido email

    if($usu_email==''){
         $mensaje.='Error, no ingreso el  email <br>'; 
         $error=1;
    }
    // Valido la contraseña
    if($usu_password==''){
        $mensaje.='Error no envio password <br>'; 
        $error=1;
    }
    // valido provincia

      if($usu_provincia<1){
         $mensaje.='Error, no selecciono la provincia <br>'; 
         $error=1;
         
    }
    //pregunto si hubo error
    if($error==1){
        header('location:registro_usuario_cliente.php?resultado='.$mensaje);
         die();
    }

      $sql='insert into usuarios(usu_nombre, usu_apellido, usu_documento, usu_email, 
    usu_password, usu_sexo, usu_provincia, usu_tipo_usuario, usu_aprobado) values 
    ("'.$usu_nombre.'", "'.$usu_apellido.'", "'.$usu_documento.'", "'.$usu_email.'", 
     "'.md5($usu_password).'", "'.$usu_sexo.'", '.$usu_provincia.', 2, 0) ';
 
     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='Se ha registrado correctamente. Bienvenido '.$usu_nombre.'. Inicia Sesión.';
     }else{
        $mensaje='Error agregando Registro ';
     }
     header('location:iniciar-sesion.php?resultado='.$mensaje);

}


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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

  <title>Registrar usuario</title>

</head>

<body>

  <?php 
  include('inc/nav_menu.inc.php');
  ?>

  <nav>
      <a href="visitante-index.php">Inicio ></a>
      <a href="iniciar-sesion.php">Inicio Sesion></a>
      <a>Registrar Usuario</a>
        </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">

        <h2>
          Registrarse
        </h2>
        <?php
        if(isset($_GET['resultado'])){
            $resultado=$_GET['resultado'];
            echo '<span class="text-danger">'.$resultado.'</span>';
        }
        ?>
    <form name="formu" method="post" action="registro_usuario_cliente.php" class="form" >
        <table>
            <tr>
                <td>
                    <label for="nombres">Nombres(*)</label>
                </td>
                <td>   
                    <input type="text" name="usu_nombre" id="usu_nombre" placeholder="Ingrese Nombres">
                </td>
            </tr>
            <tr>
                <td>
                     <label for="apellidos">Apellido(*)</label></td>
                 <td>   
                     <input type=text name="usu_apellido" id="usu_apellido" placeholder="Ingrese Apellidos">
                 </td>
            </tr>
            <tr>
                <td>
                    <label for="du">Documento(*)</label>
                </td>
                <td>
                    <input type="number" required name="usu_documento" id="usu_documento" min="0" placeholder = "Ingrese su DNI">
                    <!--requid hace un campo obligatorio-->
                </td>
            </tr>
            <tr>
                <td>
                     <label for="usu_email">Email(*)</label>
                </td>
                 <td>   
                     <input type=email name="usu_email" id="usu_email" placeholder ="Ingrese Email">
                 </td>
                 
            </tr>
            <tr>
              <td>
                  <label for="usu_password">Contraseña(*)</label>
              </td>
              <td>
                  <input type="password" name="usu_password" id="usu_password" placeholder="Ingrese un password">
              </td>
            <tr>
                <td>
                     <label for="usu_sexo">Sexo(*)</label>
                </td>
                 <td>   <!--Si pongo mismo name solo puedo seleccionar una casilla-->
                     <table border="0"><tr><td><input type=radio name="usu_sexo" id="sexo" value="f">Femenino</td>
                     <td><input type=radio name="usu_sexo" id="sexo" value="m">Masculino</td>
                     <td><input type=radio name="usu_sexo" id="sexo" value="o" checked>Otro </td>
                    </tr></table>
                 </td>
            </tr>    
            <tr>
                <td>
                    <label for="usu_provincia">Provincia(*)</label>
                </td>
                <td>
                    <select name="usu_provincia" id="provincia">
                        <option value="no eligio" selected>-- Elija una provincia --</option> <!--Por programacion debo validar que elija provincia-->
                        <?php
                        $sql2='select * from provincias order by prov_nombre';
                        $resu=mysqli_query($link, $sql2);
                        while($fila_prov=mysqli_fetch_array($resu)){
                            echo '<option value="'.$fila_prov['prov_id'].'">'.$fila_prov['prov_nombre'].'</option>';
                        }

                        ?>
                    </select>
                </td>
                
            </tr>

                <tr>

                    <td>
                        <a href="iniciar-sesion.php">
                        <input type="button" class="btn btn-danger" value="Cancelar"></a>
                        </td>
              
                        <td>
                     <input type="submit" name="agregar" value="Agregar" class="btn btn-success"></td>

                    </tr>

           
        </table>
        </form>
        
        <br>

        <p>(*)Datos oblgatorios</p>
        

      </div>

    </div>

    <footer class="footer">
      <address>Todos los derechos reservados a PumaStyle</address>
  </footer>

  </section>

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