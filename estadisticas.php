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

  <title>Estadisitcas</title>

</head>

<body>

<?php  
  include('inc/nav_menu.inc.php');
  ?>

    <nav>
      <a href="admin-index.php">Inicio ></a>
      <a>Estadisticas</a>
        </nav>
  <section id="hero">
    <div class="container">
      <div class="content-left">
        <h2>
        Estadisticas
        </h2>

        <br>
        
        <div class="topnav">
          
            
          </div>

          <br>
       <h3> Productos ordenados por cantidad vendida</h3>
        <table class="table table-dark ">
            <thead>
              <tr>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cant. Vendida</th>
 
              </tr>
            </thead>
            <tbody>

                 <?php
            
           $sql='SELECT produ_codigo, produ_nombre, sum(`deta_cantidad`) as total FROM `detalle` 
           inner join productos on produ_id=deta_produ_id group by deta_produ_id order by total desc';
           $resultado=mysqli_query($link,$sql);

            while($fila=mysqli_fetch_array($resultado)){

              echo '
                <tr>
                  
                  <td>'.$fila['produ_codigo'].'</td>
                  <td>'.$fila['produ_nombre'].'</td>
                  <td>'.$fila['total'].'</td>
                  </tr>';
                  
            }

              ?>
              

            </tbody>

            
          </table>
          <br>
       <h3> Categorias ordenadas por cantidad vendida</h3>
        <table class="table table-dark ">
            <thead>
              <tr>
                <th scope="col">Categoría</th>
                 <th scope="col">Cant. Vendida</th>
 
              </tr>
            </thead>
            <tbody>

                 <?php
            
           $sql='SELECT cate_descripcion, sum(`deta_cantidad`) as total FROM detalle inner join productos on produ_id=deta_produ_id 
           inner join categorias on cate_id=produ_cate_id group by cate_id order by total desc';
           $resultado=mysqli_query($link,$sql);

            while($fila=mysqli_fetch_array($resultado)){

              echo '
                <tr>
                  
                  <td>'.$fila['cate_descripcion'].'</td>
                  <td>'.$fila['total'].'</td>
                  </tr>';
                  
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