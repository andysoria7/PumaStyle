<?php
session_start();
include('conexion/conecta.inc.php');
//validamos el inicio de sesion
if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++
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
        Compra
        </nav>

      <div class="wrap">
        <h1>Carrito </h1>
        <h3>Gracias por su compra!</h3>
        <div class="store-wrapper">
            
			<?php 
          //recibir datos del metodo de pago
          $metodos_pago=$_POST['metodos_pago'];
          $domicilio=$_POST['domicilio'];
          $numeracion=$_POST['numeracion'];
          $localidad=$_POST['localidad'];
          $cp=$_POST['cp'];
          $telefono=$_POST['telefono'];
          $provincia=$_POST['provincia'];

          //buscamos el total de la compra
          foreach ($_SESSION['carrito'] as $valor){
           
            $partes=explode(':', $valor);
            $total_item=$partes[1] * $partes[2];
            $total_compra=$total_compra + $total_item;
           
          }
          //--------------------------------------------------------
          //guardamos los datos de la cabecera de la compra
         $sql='insert into cabecera(cabe_fecha, cabe_total, cabe_usu_id, cabe_metodos_pago, domicilio, 
          numeracion, localidad, provincia, cp, telefono) 
             values("'.date('Y-m-d').'", '.$total_compra.', '.$_SESSION['usu_id'].', "'.$metodos_pago.'", 
             "'.$domicilio.'", "'.$numeracion.'", "'.$localidad.'", "'.$provincia.'", "'.$cp.'", "'.$telefono.'")';


            $result=mysqli_query($link, $sql);
            //buscamos el ultimo id insertado en la cabecera
            $sql='select cabe_id from cabecera order by cabe_id desc limit 0,1';
            $result=mysqli_query($link, $sql);
            $row=mysqli_fetch_row($result);
            $ultimo_id=$row[0];
          //----------------------------------------------------------
         
            foreach ($_SESSION['carrito'] as $valor){
           
                $partes=explode(':', $valor);
                
                $sql='update productos set produ_stock=(produ_stock - '.$partes[1].') where produ_id='.$partes[0];
                $result=mysqli_query($link, $sql);
                //guardamos el detalle de la compra
                 $sql='insert into detalle(deta_cabe_id, deta_fecha, deta_produ_id, deta_produ_precio, deta_cantidad) 
                values('.$ultimo_id.', "'.date('Y-m-d').'", '.$partes[0].', '.$partes[2].', '.$partes[1].')';
                $result=mysqli_query($link, $sql);
                
            }
            echo '<a href="tienda.php">Volver</a>';

           unset($_SESSION['carrito']);
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