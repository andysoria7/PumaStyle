<?php
session_start();
include('conexion/conecta.inc.php');

if(isset($_SESSION['email'])){
 $usuario=1;
}else{
  $usuario=0;
}

if($_SESSION['usu_tipo']==1){
  $administrador=1;
}else{
  $administrador=0;
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

  <title>Tienda</title>

</head>

<body>
<?php 
  include('inc/nav_menu.inc.php');
  ?>

      <?php

      $cate=$_GET['cate'];

      $sql='select * from categorias where cate_id='.$cate;
      $resultado=mysqli_query($link,$sql);
      $fila_cate=mysqli_fetch_array($resultado);

      ?>
        <nav>
      <a href="visitante-index.php">Inicio ></a>
          <a href="tienda.php">Tienda</a> > <?php  echo  $fila_cate['cate_descripcion'];  ?>
        </nav>

      <div class="wrap">
        <h1>Tienda -  <?php  echo  $fila_cate['cate_descripcion'];  ?></h1>
        <div class="store-wrapper">
			<?php
      //menu izquierdo
      include('inc/menu_izquierda_solo_todo.inc.php');
      //include('inc/menu_centro_tienda.inc.php');

      echo '
      <section class="">';

      // Aqui hacemos la seleccion logica de los productos.//
     
      $sql='select * from productos where borrado = 0 and produ_cate_id='.$cate.' order by produ_nombre asc';
      $resultado=mysqli_query($link,$sql);
      $vueltas=0;
      $elemento=0;
      while($fila=mysqli_fetch_array($resultado)){
        if($vueltas==0){
          echo '<div class="row mb-2">';
          $vueltas=1;
        }
        echo '
        <div class="col-md-3">
                        <div class="card" style="width: 16rem; margin-right: 150px; margin-left: 100px; margin-bottom: 30px;">
                            <img src="'.$fila['produ_imagen'].'" class="card-img-top" style="width: 200px; height: 200px;" alt="error">
                            <div class="card-body">
                                <h5 class="card-title">'.$fila['produ_nombre'].'</h5>
                                <h6 class="card-title"> $ '.$fila['produ_precio'].'</h6>
                                <p class="card-text">Cod.: '.$fila['produ_codigo'].'</p>
                                <p class="text-info">Stock.: '.$fila['produ_stock'].' </p>';
                                if($usuario==1 and $_SESSION['usu_tipo']==2){
                                  echo '<form name="comprar" method="post" action="agregar_producto_carrito.php"> 
                                  <input type="number" value="1" name="cantidad" min="1" max="'.$fila['produ_stock'].'"  required="required">
                                  <input type="hidden" name="produ_id" value="'.$fila['produ_id'].'">
                                  <input type="hidden" name="produ_stock" value="'.$fila['produ_stock'].'">
                                  <input type="hidden" name="produ_precio" value="'.$fila['produ_precio'].'">
                                  
                                  <input type="submit" class="glyphicon glyphicon-shopping-cart" name="agregar" value="Agregar">
                                  <img src="img/carrito.png" class="logo-carrito" alt="logo">
                                  </form>';
                                }
                                if($administrador==1){
                                      echo '<a href="admin-editar-productos.php?produ_id='.$fila['produ_id'].'">
                                      <button class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-save">Editar</i></button></a>
                                      </a>';
                                }
                                echo'</p>
                            </div>
                        </div>
                    </div>';
                $elemento++;
                if($elemento==3){
                  echo '</div>';
                  $vueltas=0;
                  $elemento=0;
                }

              
              }

        echo '</section>';

              ?>

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