<?php
session_start();
include('conexion/conecta.inc.php');
//validamos el inicio de sesion
if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++

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

if(isset($_GET['id_borrar'])){
  $id_borrar=$_GET['id_borrar'];
  $_SESSION['carrito'][$id_borrar]="";
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

  <title>Carrito</title>

</head>

<body>
<?php 
  include('inc/nav_menu.inc.php');
  ?>
        <nav>
      <a href="visitante-index.php">Inicio ></a>
      <a href="tienda.php">Tienda ></a>
        Carrito
        </nav>

      <div class="wrap">
        <h1>Carrito </h1>
        <div class="store-wrapper">
            <table class="table table-dark ">
                <tr>
                <td>Articulo</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Total</td>
                <td></td>
            </tr>
			<?php 
            foreach ($_SESSION['carrito'] as $valor){
           
                $partes=explode(':', $valor);
                
                $sql='select * from productos where produ_id='.$partes[0];
                $result=mysqli_query($link, $sql);
                
                $fila=mysqli_fetch_array($result);
                if($fila['produ_id']!=0){
                  echo '<tr><td><img src="'.$fila['produ_imagen'].'" width="80">
                   '.$fila['produ_nombre'].'</td>
                  <td> '.$fila['produ_precio'].'</td>
                  <td> '.$partes[1].'</td>';
                      $total=$fila['produ_precio'] * $partes[1];
                  echo '<td> '.$total.'</td>
                  <td> <a href="ver_carrito.php?id_borrar='.$partes[0].'">X</a></td>
                  </tr>';
                  $tg=$tg + $total;
                }
            }
            echo '<tr><td colspan="5" align="right"><strong> TOTAL $'.$tg.'</strong></td></tr>
            <tr><td colspan="5" align="right">
            <a href="metodo_pago.php">
            <button class="btn btn-outline-success my-2 my-sm-0"><i class="fa fa-save">Pagar</i></button>
            </a>
            </td></tr>';
           
            ?>

            
            
            </table>



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