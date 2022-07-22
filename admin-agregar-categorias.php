<?php
session_start();

if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
if($_SESSION['usu_tipo']!=1){
      header('location:visitante-index.php?error=error de nivel de acceso');
}

include('conexion/conecta.inc.php');

//guardar alta categoria ++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['agregar'])){
    $cate_descripcion= $_POST['cate_descripcion'];
 
    
    
   
    // Valido el nombre de la categoria
    if($cate_descripcion==''){
         $mensaje='Error, no ingreso el nombre de la categoria '; 
         header('location:admin-agregar-categorias.php?resultado='.$mensaje);
         die();
    }

       $sql='insert into categorias(cate_descripcion) values 
    ("'.$cate_descripcion.'")';
 
     $result=mysqli_query($link, $sql);
     if($result){
        $mensaje='categoría agregada correctamente';
        $sql='select cate_id from categorias order by cate_id desc limit 0,1';
        $res=mysqli_query($link, $sql);
        $fi=mysqli_fetch_array($res);
        $ultimo_id=$fi['cate_id'];
        
        include('subir_imagen_en_alta_categorias.php');
     }else{
        $mensaje='Error agregando categoria ';
     }
     header('location:admin-categorias.php?resultado='.$mensaje.'&m_error='.$m_error);

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

  <title>Agregar Categorias</title>

</head>

<body>

 <?php  
  include('inc/nav_menu.inc.php');
  ?>

  <nav>
    <a href="admin-index.php">Inicio ></a>
    <a href="admin-categorias.php">Formulario de categorias ></a>
    <a>Agregar Categorias</a>
      </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">
        <h2>
          Agregar categorias
        </h2>
        <?php
        if(isset($_GET['resultado'])){
            $resultado=$_GET['resultado'];
            echo '<span class="text-warning">'.$resultado.'</span>';
        }
        ?>
        <form name="formu" method="post" class="form" action="admin-agregar-categorias.php"  enctype="multipart/form-data">
        <table>
        
        <tr>
                <td>
                    <label for="imGEN">Ingrese imagen(*)</label>
                </td>
                <td>   
                <input type="file" class="form-control" name="fotoch" id="fotoch">  
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nombres">Ingrese el nombre de la categoría(*)</label>
                </td>
                <td>   
                    <input type="text" name="cate_descripcion" id="nombre" placeholder="">
                </td>
            </tr>

                <tr>

                     <td>
                        <a href="admin-categorias.php">
                        <input type="button" class="btn btn-danger" value="Cancelar"></a>
                        </td>

                     <td>
                     <input type="submit" name="agregar" value="Agregar" class="btn btn-success"></td>
              
                    </tr>

                    </table>
                    </form>

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