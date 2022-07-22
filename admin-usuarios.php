<?php
session_start();

if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
if($_SESSION['usu_tipo']!=1){
      header('location:visitante-index.php?error=error de nivel de acceso');
}

include('conexion/conecta.inc.php');

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

  <title>Inicio</title>

</head>

<body>

  <?php 
  include('inc/nav_menu.inc.php');
  ?>

    <nav>
      <a href="admin-index.php">Inicio ></a>
      <a>Formulario de usuarios</a>
        </nav>
  <section id="hero">
    <div class="container">
      <div class="content-left">
        <h2>
          Formulario De Usuarios
        </h2>

        <?php
        if(isset($_GET['resultado'])){
            $resultado=$_GET['resultado'];
            echo '<span class="text-warning">'.$resultado.'</span>';
        }
        ?>

        <br>
        
        <div class="topnav">
          <table width="50%"><tr><td>
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
        </td>
        <td>
          <button class="btn btn-success">Buscar</button></a>
        </td>

        <td> <a href="admin-agregar-usuarios.php">
          <button class="btn btn-success"><i class="fa fa-save">Agregar</i></button></a>
        </a>

        </td>

      </tr>
          </table>
            
            
          </div>

          <br>

        <table class="table table-dark ">
            <thead>
              <tr>
                
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">Documento</th>
                <th scope="col">Email </th>
                <th scope="col">Sexo</th>
                <th scope="col">Provincia</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
                
              </tr>
            </thead>
            <tbody>

              <?php
            
           $sql='select * from usuarios inner join provincias 
            on prov_id=usu_provincia order by usu_id';
           $resultado=mysqli_query($link,$sql);

            while($fila=mysqli_fetch_array($resultado)){

              echo '
                <tr>
                  
                  <td>'.$fila['usu_apellido'].'</td>
                  <td>'.$fila['usu_nombre'].'</td>
                  <td>'.$fila['usu_documento'].'</td>
                  <td>'.$fila['usu_email'].'</td>
                  <td>'.$fila['usu_sexo'].'</td>
                  <td>('.$fila['usu_provincia'].') '.$fila['prov_nombre'].'</td>
                  <td>';
                  if($fila['usu_tipo_usuario']==1){
                    echo  'Admin';
                  }else{
                    echo 'Client';
                  }
                  
                  echo '</td>
                <td>';
                  if($fila['usu_aprobado']==0){
                    echo '<a href="aprobar_usuario.php?id='.$fila['usu_id'].'"><span class="text-danger">Desap<img src="img/megosta.png" width="22"></span></a>';
                  }else{
                    echo 'Apro';
                  }
                  echo '</td>
                  <td><a href="admin-editar-usuarios.php?usu_id='.$fila['usu_id'].'">
                     <button class="btn btn-success"><i class="fa fa-save">Editar</i></button></a></a></td>
                  <td><a href="admin-borrar-usuarios.php?usu_id='.$fila['usu_id'].'">
                  <button class="btn btn-danger"><i class="fa fa-save">Borrar</i></button></a></td></a></td>
                '  
                ;
            }
              ?>
              
        
            </tbody>
            
          </table>

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