<?php
session_start();

if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
if($_SESSION['usu_tipo']!=1){
      header('location:visitante-index.php?error=error de nivel de acceso');
}

include('conexion/conecta.inc.php');



//Borrar producto ++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['borrar'])){
    $produ_id= $_POST['produ_id'];

    // Aqui hacemos el borrado logico del producto //

    $sql='update productos set borrado=1 where produ_id='.$produ_id;

     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='Producto borrado correctamente';
     }else{
        $mensaje='Error borrando Producto ';
     }
     header('location:admin-productos.php?resultado='.$mensaje);

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

  <title>Borrar productos</title>

</head>

<body>

 <?php 
  include('inc/nav_menu.inc.php');
  ?>
  
  <nav>
    <a href="admin-index.php">Inicio ></a>
    <a href="admin-productos.php">Formulario de productos ></a>
    <a>Borrar Productos</a>
      </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">
        <h2>
          Borrar productos
        </h2>

    <?php 
        $produ_id= $_GET['produ_id'];
        $sql='select * from productos where produ_id='.$produ_id;
        $result=mysqli_query($link, $sql);
        $fila=mysqli_fetch_array($result);
        ?>
        <img src="<?php echo $fila['produ_imagen']; ?>" width="250">
        
        <form name="formu" method="post" action="admin-borrar-productos.php">
        <br> ¿Esta seguro de borrar el  seleccionado?<br>
            <input type="hidden" name="produ_id" value="<?php echo $fila['produ_id']; ?>" >
        <table>
               
            <tr>
                <td>
                    <label for="nombres">Ingrese el nombre del producto(*)</label>
                </td>
                <td>   
                    <input type="text" name="produ_nombre" value="<?php echo $fila['produ_nombre']; ?>" id="nombre" placeholder="">
                </td>
            </tr>

              <tr>
                <td>
                    <label for="du">Ingrese el codigo del producto(*)</label>
                </td>
                <td>
                    <input type="text" required name="produ_codigo" value="<?php echo $fila['produ_codigo']; ?>" id="codigo">
                    <!--requid hace un campo obligatorio-->
                </td>

           
            <tr>
                <td>
                    <label for="du">Ingrese el precio del producto(*)</label>
                </td>
                <td>
                    <input type="number" required name="produ_precio" value="<?php echo $fila['produ_precio']; ?>" id="precio" min="0">
                    <!--requid hace un campo obligatorio-->
                </td>

                
              </tr>

              
              <tr>
                  <td>
                      <label for="du">Ingrese la cantidad de stock(*)</label>
                  </td>
                  <td>
                      <input type="number" required name="produ_stock" value="<?php echo $fila['produ_stock']; ?>" id="hijos" min="0">
                      <!--requid hace un campo obligatorio-->
                  </td>
              </tr>

                <tr>
                    <td>
                         <label for="asunto">Ingrese la descripcion del producto(*)</label>
                    </td>
                     <td>   
                         <textarea name="produ_descripcion" id="asunto" cols="30" rows="3"><?php echo $fila['produ_descripcion']; ?></textarea>
                     </td>
                </tr>

                <tr>
                   <td>
                         <label for="asunto">Categoría</label>
                    </td>
                     <td>
                    <select name="produ_cate_id" id="produ_cate_id">
                        <option value="no eligio" selected>-- Elija una categoria --</option> <!--Por programacion debo validar que elija provincia-->
                        <?php
                        $sql2='select * from categorias order by cate_descripcion';
                        $resu=mysqli_query($link, $sql2);
                        while($fila_cate=mysqli_fetch_array($resu)){
                            if ( $fila_cate['cate_id']==$fila['produ_cate_id']){
                            echo '<option value="'.$fila_cate['cate_id'].'" selected="selected">'.$fila_cate['cate_descripcion'].'</option>';
                            }else{
                                echo '<option value="'.$fila_cate['cate_id'].'" >'.$fila_cate['cate_descripcion'].'</option>';
                            }
                        }

                        ?>
                    </select>
                </td>
                </tr>

                <tr>
              
                    <td>
                        <a href="admin-productos.php">
                        <input type="button" class="btn btn-danger" value="Cancelar"></a>
                    </td>

                    <td>
                     <input type="submit" class="btn btn-success" value="Borrar" name="borrar"></td>
                    </tr>

                    </table>
                    </form>

      </div>

    </div>

     <footer style = "text-align: center; background: black;">
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