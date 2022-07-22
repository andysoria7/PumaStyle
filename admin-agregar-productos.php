<?php
session_start();

if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
if($_SESSION['usu_tipo']!=1){
      header('location:visitante-index.php?error=error de nivel de acceso');
}

include('conexion/conecta.inc.php');

//guardar alta producto ++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['agregar'])){
    $produ_codigo= $_POST['produ_codigo'];
    $produ_nombre= $_POST['produ_nombre'];
    $produ_precio= $_POST['produ_precio'];
    $produ_descripcion= $_POST['produ_descripcion'];
    $produ_stock= $_POST['produ_stock'];
    $produ_cate_id= $_POST['produ_cate_id'];

    $mensaje='';
    $error=0;
   
    // Valido el codigo
    if($produ_codigo==''){
         $mensaje.='Error no ingreso  el codigo <br>'; 
         $error=1;
         
    }

    // Valido el nombre

     if($produ_nombre==''){
         $mensaje.='Error,  no ingreso el nombre <br>'; 
         $error=1;
    }

    // Valido el precio

     if($produ_precio==''){
         $mensaje.='Error, no ingreso el precio <br>'; 
         $error=1;
    }

    // Valido la descripcion

     if($produ_descripcion==''){
         $mensaje.='Error, no ingreso la descripcion <br>'; 
         $error=1;
    }

    // Valido el stock

    if($produ_stock==''){
         $mensaje.='Error, no ingreso la cantidad de stock <br>'; 
         $error=1;
    }

    // valido la categoria

      if($produ_cate_id<1){
         $mensaje.='Error, no selecciono la categoria ';
         $error=1; 
         
    }

    // valido la imagen


   /*   if($produ_imagen==''){
         $mensaje='Error, no ingreso una imagen '; 
         header('location:admin-agregar-productos.php?resultado='.$mensaje);
         die();
    }*/

    //pregunto si hubo error
    if($error==1){
      header('location:admin-agregar-productos.php?resultado='.$mensaje);
         die();
  }

       $sql='insert into productos(produ_codigo, produ_nombre, produ_precio, produ_descripcion, 
    produ_stock, produ_cate_id, produ_imagen) values 
    ("'.$produ_codigo.'", "'.$produ_nombre.'", "'.$produ_precio.'", "'.$produ_descripcion.'", 
     "'.$produ_stock.'", "'.$produ_cate_id.'", "")';
 
     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='Producto agregado correctamente';
        $sql='select produ_id from productos order by produ_id desc limit 0,1';
        $res=mysqli_query($link, $sql);
        $fi=mysqli_fetch_array($res);
        $ultimo_id=$fi['produ_id'];
        
        include('subir_imagen_en_alta.php');
     }else{
        $mensaje='Error agregando Producto ';
     }
     header('location:admin-productos.php?resultado='.$mensaje.'&m_error='.$m_error);

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

  <title>Agregar productos</title>

</head>

<body>

 <?php  
  include('inc/nav_menu.inc.php');
  ?>

  <nav>
    <a href="admin-index.php">Inicio ></a>
    <a href="admin-productos.php">Formulario de productos ></a>
    <a>Agregar Productos</a>
      </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">
        <h2>
          Agregar productos
        </h2>
        <br>

        <?php
        if(isset($_GET['resultado'])){
            $resultado=$_GET['resultado'];
            echo '<span class="text-danger">'.$resultado.'</span>';
        }
        ?>
        <form name="formu" method="post" action="admin-agregar-productos.php"  enctype="multipart/form-data" class="form">
        <table>
        
        <tr>
                <td>
                    <label for="imagen">Ingrese la imagen(*)</label>
                </td>
                <td>   
                <input type="file" class="form-control" name="fotoch" id="fotoch">  
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nombres">Ingrese el nombre del producto(*)</label>
                </td>
                <td>   
                    <input type="text" name="produ_nombre" id="nombre" placeholder="">
                </td>
            </tr>

              <tr>
                <td>
                    <label for="du">Ingrese el codigo del producto(*)</label>
                </td>
                <td>
                    <input type="text" name="produ_codigo" id="codigo">
                    <!--requid hace un campo obligatorio-->
                </td>

           
            <tr>
                <td>
                    <label for="du">Ingrese el precio del producto(*)</label>
                </td>
                <td>
                    <input type="number"  name="produ_precio" id="precio" min="0">
                    <!--requid hace un campo obligatorio-->
                </td>

                
              </tr>

              
              <tr>
                  <td>
                      <label for="du">Ingrese la cantidad de stock(*)</label>
                  </td>
                  <td>
                      <input type="number" name="produ_stock" id="hijos" min="0">
                      <!--requid hace un campo obligatorio-->
                  </td>
              </tr>

                <tr>
                    <td>
                         <label for="asunto">Ingrese la descripcion del producto(*)</label>
                    </td>
                     <td>   
                         <textarea name="produ_descripcion" id="asunto" cols="30" rows="3" required="required"></textarea>
                     </td>
                </tr>

                <tr>
                  <td>
                         <label for="asunto">Categoría(*)</label>
                    </td>
                     <td>
                    <select name="produ_cate_id" id="produ_cate_id">
                        <option value="no eligio" selected>-- Elija una categoria --</option> <!--Por programacion debo validar que elija provincia-->
                        <?php
                        $sql2='select * from categorias where borrado=0 order by cate_descripcion';
                        $resu=mysqli_query($link, $sql2);
                        while($fila_cate=mysqli_fetch_array($resu)){
                            echo '<option value="'.$fila_cate['cate_id'].'">'.$fila_cate['cate_descripcion'].'</option>';
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
                     <input type="submit" name="agregar" value="Agregar" class="btn btn-success"></td>
              
                    </tr>

                    </table>
                    </form>

                    <br>
                    <br>

                    <p>(*)Datos oblgatorios</p>

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