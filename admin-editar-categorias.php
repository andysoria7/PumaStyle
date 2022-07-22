<?php
session_start();

if(!isset($_SESSION['email'])){
  header('location:visitante-index.php?error=no_einicio_sesion');
}
if($_SESSION['usu_tipo']!=1){
      header('location:visitante-index.php?error=error de nivel de acceso');
}

include('conexion/conecta.inc.php');

if(isset($_POST['enviarfotoch'])){
  include 'subir_imagen_categoria.php';
}

//guardar



if(isset($_POST['editar'])){
      $cate_id= $_POST['cate_id']; 
      $cate_descripcion= $_POST['cate_descripcion']; 

      // Valido el nombre de la categoria
    if($cate_descripcion==''){
      $mensaje='Error, no ingreso el nombre de la categoria '; 
      header('location:admin-editar-categorias.php?cate_id='.$cate_id.'&resultado='.$mensaje);
      die();
    }

    $sql='update categorias set 
    cate_descripcion="'.$cate_descripcion.'" where cate_id='.$cate_id;

    $result=mysqli_query($link, $sql);
    if($result){
      $mensaje='Categoría modificado correctamente';
    }else{
      $mensaje='Error modificando categoría ';
    }
    header('location:admin-categorias.php?resultado='.$mensaje);
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

  <title>editar Categorias</title>

</head>

<body>

 <?php  
  include('inc/nav_menu.inc.php');
  ?>

  <nav>
    <a href="admin-index.php">Inicio ></a>
    <a href="admin-categorias.php">Formulario de categorias ></a>
    <a>Editar Categorias</a>
      </nav>

  <section id="hero">
    <div class="container">
      <div class="content-center">
        <h2>
          Editar categorias
        </h2>

        <?php
        if(isset($_GET['resultado'])){
            $resultado=$_GET['resultado'];
            echo '<span class="text-warning">'.$resultado.'</span>';
        }
        ?>
        <br>
        <?php 
        $cate_id= $_GET['cate_id'];
        $sql='select * from categorias where cate_id='.$cate_id;
        $result=mysqli_query($link, $sql);
        $fila=mysqli_fetch_array($result);
        ?>
        <img src="<?php echo $fila['cate_imagen']; ?>" width="200">
        <form class="form-horizontal" name="formu2" method="post" action="admin-editar-categorias.php" id="formulario" enctype="multipart/form-data">
              <input type="file" class="form-control" name="fotoch" id="fotoch"><BR />
              <input type="submit" class="btn btn-primary btn-block" value="subir imagen" name="enviarfotoch">
                  <input type="hidden" id="cate_id" name="cate_id" value="<?php echo $cate_id; ?>">
        </form>
        <form name="formu" method="post" class="form" action="admin-editar-categorias.php"  enctype="multipart/form-data">
        <input type="hidden" id="cate_id" name="cate_id" value="<?php echo $cate_id; ?>">
        <table>
        
       
            <tr>
                <td>
                    <label for="nombres">Ingrese el nombre de la categoría(*)</label>
                </td>
                <td>   
                    <input type="text" name="cate_descripcion" id="nombre" placeholder="" 
                    value="<?php echo $fila['cate_descripcion']; ?>" >
                </td>
            </tr>

                <tr>

                     <td>
                        <a href="admin-categorias.php">
                        <input type="button" class="btn btn-danger" value="Cancelar"></a>
                        </td>

                     <td>
                     <input type="submit" name="editar" value="Editar" class="btn btn-success"></td>
              
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