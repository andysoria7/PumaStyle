<?php
session_start();

if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
if($_SESSION['usu_tipo']!=1){
      header('location:visitante-index.php?error=error de nivel de acceso');
}

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
    $usu_tipo_usuario= $_POST['usu_tipo_usuario'];
    $usu_aprobado= $_POST['usu_aprobado'];

    $mensaje='';
    $error=0;
    
   
    // Valido el nombre

     if($usu_nombre==''){
        $mensaje.='Error no ingreso el nombre <br>'; 
         $error=1;
    }

    // Valido el apellido

     if($usu_apellido==''){
        $mensaje.='Error no ingreso  el apellido <br>'; 
        $error=1;
    }

    // Valido el documento

     if($usu_documento==''){
        $mensaje.='Error no ingreso  el documento <br>'; 
        $error=1;
    }

    // Valido email

    if($usu_email==''){
        $mensaje.='Error no ingreso  el email <br>'; 
        $error=1;
    }

     // Valido la contraseña
     if($usu_password==''){
        $mensaje.='Error no ingreso la contraseña <br>'; 
        $error=1;
    }

    // valido provincia

      if($usu_provincia==''){
        $mensaje.='Error no ingreso la provincia <br>'; 
        $error=1;
    }

     // Valido el tipo de cuenta

     if($usu_tipo_usuario<1){
        $mensaje.='Error no ingreso el tipo de cuenta <br>'; 
         $error=1;
    }

     // Valido el estado de cuenta

     if($usu_aprobado<1){
        $mensaje.='Error no ingreso el estado de cuenta <br>'; 
         $error=1;
    }


    //pregunto si hubo error
    if($error==1){
        header('location:admin-agregar-usuarios.php?resultado='.$mensaje);
           die();
    }


      $sql='insert into usuarios(usu_nombre, usu_apellido, usu_documento, usu_email, 
    usu_password, usu_sexo, usu_provincia, usu_tipo_usuario, usu_aprobado) values 
    ("'.$usu_nombre.'", "'.$usu_apellido.'", "'.$usu_documento.'", "'.$usu_email.'", 
     "'.md5($usu_password).'", "'.$usu_sexo.'", '.$usu_provincia.', '.$usu_tipo_usuario.', '.$usu_aprobado.') ';
 
     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='Registro agregado correctamente';
     }else{
        $mensaje='Error agregando Registro ';
     }
     header('location:admin-usuarios.php?resultado='.$mensaje);

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

  <title>Agregar usuarios</title>

</head>

<body>

  <?php 
  include('inc/nav_menu.inc.php');
  ?>

  <nav>
      <a href="admin-index.php">Inicio ></a>
      <a href="admin-usuarios.php">Formulario de usuarios</a>
      <a>Agregar Usuarios</a>
        </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">

        <h2>
          Agregar usuarios
        </h2>

        <?php
        if(isset($_GET['resultado'])){
            $resultado=$_GET['resultado'];
            echo '<span class="text-danger">'.$resultado.'</span>';
        }
        ?>
    <form name="formu" method="post" action="admin-agregar-usuarios.php" class="form" >
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
                    <input type="number" required name="usu_documento" id="usu_documento" min="0" placeholder="Ingrese el DNI">
                    <!--requid hace un campo obligatorio-->
                </td>
            </tr>
            <tr>
                <td>
                     <label for="usu_email">Email(*)</label>
                </td>
                 <td>   
                     <input type=email name="usu_email" id="usu_email" placeholder="Ingrese el Email">
                 </td>
                 
            </tr>
            <tr>
              <td>
                  <label for="usu_password">Contraseña(*)</label>
              </td>
              <td>
                  <input type="password" name="usu_password" id="usu_password" placeholder="Ingrese Contraseña">
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
                        <label for="usu_tipo_usuario">Tipo de cuenta(*)</label>
                    </td>
                    <td>
                        <select name="usu_tipo_usuario" id="cuenta">
                            <option value="no eligio" selected>-- Elija el Tipo de Cuenta --</option> <!--Por programacion debo validar que elija tipo de cuenta-->
                            <option value="1">Admin</option>
                            <option value="2">Cliente</option>
                            
                        </select>
                    </td>
                    
                </tr>

                 <tr>
                    <td>
                        <label for="usu_aprobado">Estado de cuenta(*)</label>
                    </td>
                    <td>
                        <select name="usu_aprobado" id="usu_aprobado">
                            <option value="no eligio" selected>-- Elija el estado de cuenta --</option> <!--Por programacion debo validar que elija estado de cuenta-->
                            <option value="1">Aprobado</option>
                            <option value="0">desaprobado</option>
                            
                        </select>
                    </td>
                    
                </tr>


                <tr>

                    <td>
                        <a href="admin-usuarios.php">
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