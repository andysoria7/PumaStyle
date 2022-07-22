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
        Pago
        </nav>

      <div class="wrap">
        <h1>Pago </h1>
        <div class="store-wrapper">
            
            
            <form action="comprar.php" method="post" name="formu" class="form">
            <table>
              
                    <tr>
                            <td>
                                 <label for="domicilio">Domicilio(*)</label></td>
                             <td>   
                                 <input type=text required name="domicilio" id="domicilio" placeholder= "Ingrese el domicilio">
                             </td>
                        </tr>

                        <tr>
                                <td>
                                    <label for="du">Numeracion de Domicilio(*)</label>
                                </td>
                                <td>
                                    <input type="number" required name="numeracion" id="numeracion" min="0" placeholder ="Ingrese el domicilio">
                                    <!--requid hace un campo obligatorio-->
                                </td>
                            </tr>

                        <tr>
                                <td>
                                     <label for="provincia">Provincia(*)</label></td>
                                 <td>   
                                     <input type=text  required name="provincia" id="Provincia" placeholder="Ingrese la provincia">
                                 </td>
                            </tr>

                            <tr>
                                    <td>
                                         <label for="localidad">Localidad(*)</label></td>
                                     <td>   
                                         <input type=text required name="localidad" id="localidad" placeholder="Ingrese la localidad">
                                     </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label for="du">Codigo Postal(*)</label>
                                    </td>
                                    <td>
                                        <input type="number" required name="cp" id="cp" min="0" placeholder ="Ingrese el codigo postal">
                                        <!--requid hace un campo obligatorio-->
                                    </td>
                                </tr>

                                <tr>
                                        <td>
                                            <label for="du">Celular o Fijo(*)</label>
                                        </td>
                                        <td>
                                            <input type="number" required name="telefono" id="telefono" min="0" placeholder ="Ingrese el celular o fijo">
                                            <!--requid hace un campo obligatorio-->
                                        </td>
                                    </tr>

                <tr>

                <td>
                    <label for="metodos_pago">Metodos de pago(*)</label>
                </td>
                <td>
                    <select name="metodos_pago" id="metodos_pago">
                        <option value="no eligio" selected>-- Elija un metodo de pago --</option> <!--Por programacion debo validar que elija metodo de pago-->
                        <option value="RAPIPAGO">Rapipago</option>
                        <option value="PAGOFACIL">PagoFacil</option>
                       
                    </select>
                </td>
                
            </tr>

            </table>
            <input type="submit" name="enviar" value="Confirmar" class="btn btn-success">
            <td>
                        <a href="ver_carrito.php">
                        <input type="button" class="btn btn-danger" value="Volver"></a>
                        </td>

                     <td>
            
        </form>

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