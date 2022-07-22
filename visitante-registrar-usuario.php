<?php
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
    
    // Valido la contraseña
    if($usu_password==''){
         $mensaje='Error no envio password '; 
         header('location:visitante-registrar-usuario.php?resultado='.$mensaje);
         die();
    }

    // Valido el nombre

     if($usu_nombre==''){
         $mensaje='Error,  no ingreso el nombre '; 
         header('location:visitante-registrar-usuario.php?resultado='.$mensaje);
         die();
    }

    // Valido el apellido

     if($usu_apellido==''){
         $mensaje='Error, no el apellido '; 
         header('location:visitante-registrar-usuario.php?resultado='.$mensaje);
         die();
    }

    // Valido el documento

     if($usu_documento==''){
         $mensaje='Error, no ingreso el documento '; 
         header('location:visitante-registrar-usuario.php?resultado='.$mensaje);
         die();
    }

    // Valido email

    if($usu_email==''){
         $mensaje='Error, no ingreso el  email '; 
         header('location:visitante-registrar-usuario.php?resultado='.$mensaje);
         die();
    }

    // valido provincia

      if($usu_provincia==''){
         $mensaje='Error, no selecciono la provincia '; 
         header('location:visitante-registrar-usuario.php?resultado='.$mensaje);
         die();
    }


      $sql='insert into usuarios(usu_nombre, usu_apellido, usu_documento, usu_email, 
    usu_password, usu_sexo, usu_provincia) values 
    ("'.$usu_nombre.'", "'.$usu_apellido.'", "'.$usu_documento.'", "'.$usu_email.'", 
     "'.md5($usu_password).'", "'.$usu_sexo.'", '.$usu_provincia.') ';
 
     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='Cuenta creada correctamente';
     }else{
        $mensaje='Error agregando Registro ';
     }
     header('location:visitante-index.php?resultado='.$mensaje);

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

  <title>Registro</title>

</head>

<body>

<?php 
  include('inc/nav_menu.inc.php');
  ?>
  <nav>
      <a href="visitante-index.php">Inicio ></a>
      <a href="iniciar-sesion.php">Iniciar Sesion ></a>
      <a>Registro</a>
        </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">

        <h2>
          Registro
        </h2>

        <form name="formu" method="post" action="visitante-registrar-usuario.php">
    
        <table>
            <tr>
                <td>
                    <label for="nombres">Nombres(*)</label>
                </td>
                <td>   
                    <input type="text" name="nombres" id="nombres" placeholder="Ingrese Nombres">
                </td>
            </tr>
            <tr>
                <td>
                     <label for="apellidos">Apellidos(*)</label></td>
                 <td>   
                     <input type=text name="apellidos" id="apellidos" placeholder="Ingrese Apellidos">
                 </td>
            </tr>
            <tr>
                <td>
                    <label for="du">Documento(*)</label>
                </td>
                <td>
                    <input type="number" required name="du" id="hijos" placeholder="Ingrese el DNI" min="0">
                    <!--requid hace un campo obligatorio-->
                </td>
            </tr>
            <tr>
                <td>
                     <label for="email">Email(*)</label>
                </td>
                 <td>   
                     <input type=email name="email" id="email" placeholder="Ingrese el Email">
                 </td>
                 
            </tr>
            <tr>
              <td>
                  <label for="clave">Contraseña(*)</label>
              </td>
              <td>
                  <input type="password" name="clave" id=clave placeholder="Ingrese la Contraseña">
              </td>
            <tr>
                <td>
                     <label for="sexo">Sexo</label>
                </td>
                 <td>   <!--Si pongo mismo name solo puedo seleccionar una casilla-->
                     <input type=radio name="sexo" id="sexo" value="f">Femenino
                     <input type=radio name="sexo" id="sexo" value="m">Masculino
                     <input type=radio name="sexo" id="sexo" value="o" checked>Otro <!--checked elije una opcion por defecto y sirve para checkbox y radiobutton-->
                 </td>
            </tr>    
            <tr>
                <td>
                    <label for="provincia">Provincia(*)</label>
                </td>
                <td>
                    <select name="provincia" id="provincia">
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
                <input type="button" class="btn btn-outline-danger my-2 my-sm-0" value="Volver"></a>
            </td>
                      
            <td>
        <input type="submit" name="agregar" value="Registrarme" class="btn btn-outline-success my-2 my-sm-0"></td>
            </tr>
           
        </table>
        
          </form>

        <p>(*)Datos oblgatorios</p>

      </div>

    </div>

    <footer class="footer">
      <address>Todos los derechos reservados a allnike</address>
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