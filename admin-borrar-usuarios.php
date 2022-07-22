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
if(isset($_POST['borrar'])){
    $usu_id= $_POST['usu_id'];
    
    
    $sql="delete from usuarios where usu_id=".$usu_id;
    
     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='Registro borrado correctamente';
     }else{
        $mensaje='Error borrando Registro ';
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

  <title>Borrar usuarios</title>

</head>

<body>

  <?php 
  include('inc/nav_menu.inc.php');
  ?>
  
  <nav>
      <a href="admin-index.php">Inicio ></a>
      <a href="admin-usuarios.php">Formulario de usuarios</a>
      <a>Borrar Usuarios</a>
        </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">

        <h2>
          Borrar usuarios
        </h2>
        
        <?php 
        $usu_id= $_GET['usu_id'];
        $sql='select * from usuarios where usu_id='.$usu_id;
        $result=mysqli_query($link, $sql);
        $fila=mysqli_fetch_array($result);
        ?>

    <form name="formu" method="post" action="admin-borrar-usuarios.php">
        <br> ¿Esta seguro de borrar el usuario seleccionado?<br>
         <input type="hidden" name="usu_id" value="<?php echo $fila['usu_id']; ?>" >
        <table>
            <tr>
                <td>
                    <label for="nombres">Nombres(*)</label>
                </td>
                <td>   
                <input type=text name="usu_nombre" value="<?php echo $fila['usu_nombre']; ?>" id="usu_nombre" placeholder="">
                </td>
            </tr>
            <tr>
                <td>
                     <label for="apellidos">Apellido(*)</label></td>
                 <td>   
                     <input type=text name="usu_apellido" value="<?php echo $fila['usu_apellido']; ?>" id="usu_apellido" placeholder="Ingrese Apellidos">
                 </td>
            </tr>
            <tr>
                <td>
                    <label for="du">Documento(*)</label>
                </td>
                <td>
                    <input type="number" required name="usu_documento" value="<?php echo $fila['usu_documento']; ?>" id="usu_documento" min="0">
                    <!--requid hace un campo obligatorio-->
                </td>
            </tr>
            <tr>
                <td>
                     <label for="usu_email">Email(*)</label>
                </td>
                 <td>   
                     <input type=email name="usu_email" value="<?php echo $fila['usu_email']; ?>" id="usu_email">
                 </td>
                 
            </tr>
            <tr>
              <td>
                  <label for="usu_password">Contraseña(*)</label>
              </td>
              <td>
                  <input type="password" name="usu_password" id="usu_password">
              </td>
            </tr>
            <tr>
                <td>
                     <label for="usu_sexo">Sexo</label>
                </td>
                 <td>

                    <?php
                    switch ($fila['usu_sexo']) {
                        case 'm':
                            echo '<input type=radio name="usu_sexo" id="sexo" value="f">Femenino
                     <input type=radio name="usu_sexo" id="sexo" value="m" checked>Masculino
                     <input type=radio name="usu_sexo" id="sexo" value="o" >Otro';
                            break;
                        
                        case 'f':
                            echo '<input type=radio name="usu_sexo" id="sexo" value="f" checked>Femenino
                     <input type=radio name="usu_sexo" id="sexo" value="m">Masculino
                     <input type=radio name="usu_sexo" id="sexo" value="o" >Otro';
                            break;
                        case 'o':
                            echo '<input type=radio name="usu_sexo" id="sexo" value="f" >Femenino
                     <input type=radio name="usu_sexo" id="sexo" value="m">Masculino
                     <input type=radio name="usu_sexo" id="sexo" value="o" checked>Otro';
                            break;
                        }
                    ?>
                     
                 </td>
            </tr>    
            <tr>
                <td>
                    <label for="usu_provincia">Provincia(*)</label>
                </td>
                <td>
                    <select name="usu_provincia" id="provincia">
                            
                    <option value="no eligio" selected>-- Elija una provincia --</option>
                       <?php

                        $sql2='select * from provincias order by prov_nombre';
                        $resu=mysqli_query($link, $sql2);
                        while($fila_prov=mysqli_fetch_array($resu)){
                            if($fila_prov['prov_id']==$fila['usu_provincia']){
                            echo '<option value="'.$fila_prov['prov_id'].'" selected="selected">'.$fila_prov['prov_nombre'].'</option>';
                            }else{
                                echo '<option value="'.$fila_prov['prov_id'].'">'.$fila_prov['prov_nombre'].'</option>';
                            }
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
                            <?PHP 
                            if ($fila['usu_tipo_usuario']==1){
                                echo '<option value="1"  selected="selected" >Admin</option>
                                    <option value="2">Cliente</option>';
                            }else{
                                echo '<option value="1" >Admin</option>
                                    <option value="2"  selected="selected" >Cliente</option>';
                            }
                            ?>
                            
                            
                        </select>
                    </td>
                    
                </tr>

                 <tr>
                    <td>
                        <label for="usu_aprobado">Estado de cuenta(*)</label>
                    </td>
                    <td>
                        <select name="usu_aprobado" id="usu_aprobado">
                            <?php 
                            if ($fila['usu_aprobado']==1){
                                echo '<option value="1"  selected="selected" >Aprobado</option>
                                    <option value="0">desaprobado</option>';
                            }else{
                                echo '<option value="1" >Aprobado</option>
                                    <option value="0"  selected="selected" >Desaprobado</option>';
                            }
                            ?>
                           
                        </select>
                    </td>
                    
                </tr>
                <tr>
              
                    <td>
                        <a href="admin-usuarios.php">
                        <input type="button" class="btn btn-danger" value="Cancelar"></a>
                    </td>

                    <td>
                     <input type="submit" class="btn btn-success" value="Borrar" name="borrar"></td>
                    </tr>
            
                    </tr>

        </table>
        </form>        
        

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