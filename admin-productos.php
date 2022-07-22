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

  <title>Formulario de productos</title>

</head>

<body>

<?php  
  include('inc/nav_menu.inc.php');
  ?>

    <nav>
      <a href="admin-index.php">Inicio ></a>
      <a>Formulario de productos</a>
        </nav>
  <section id="hero">
    <div class="container">
      <div class="content-left">
        <h2>
          Formulario de productos
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

        <td> <a href="admin-agregar-productos.php">
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
                
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Stock</th>
                <th scope="col">Categoria</th>
                <th scope="col">Imagen</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
                
              </tr>
            </thead>
            <tbody>

                 <?php
            
           $sql='select * from productos 
            inner join categorias on cate_id=produ_cate_id order by produ_id';
           $resultado=mysqli_query($link,$sql);

            while($fila=mysqli_fetch_array($resultado)){

              echo '
                <tr>
                  
                  <td>'.$fila['produ_codigo'].'</td>
                  <td>'.$fila['produ_nombre'].'</td>
                  <td>'.$fila['produ_precio'].'</td>
                  <td>'.$fila['produ_descripcion'].'</td>
                  <td>'.$fila['produ_stock'].'</td>
                  <td>'.$fila['produ_cate_id'].' ('.$fila['cate_descripcion'].')</td>
                  <td><img src="'.$fila['produ_imagen'].'" width="55"></td>
                  <td><a href="admin-editar-productos.php?produ_id='.$fila['produ_id'].'">
                  <button class="btn btn-success"><i class="fa fa-save">Editar</i></button></a>
                  </a></td>
                  <td><a href="admin-borrar-productos.php?produ_id='.$fila['produ_id'].'">
                  <button class="btn btn-danger"><i class="fa fa-save">Borrar</i></button></a></td>';
                  
            }

              ?>
              

            </tbody>

            
          </table>

          
      </div>

    </div>

    <footer style = "text-align: center; background: black;">
                <address>Todos los derechos reservados para PumaStyle</address>
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