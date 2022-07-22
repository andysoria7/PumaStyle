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

  <title>Mis Compras</title>
  <script language=“JavaScript”>
  function ver_detalle(id) {
    var x=document.getElementById("detalle"+id);
    x.style.display = "block";

  }
</script>
</head>

<body>
<?php 
  include('inc/nav_menu.inc.php');
  ?>
      <nav>
      <a href="visitante-index.php">Inicio ></a>
        Mis Compras
        </nav>

      <div class="wrap">
        <h1>Mis Compras </h1>
        
        <div class="store-wrapper">
            
			<?php 
        
        
            $sql='select * from cabecera order by cabe_fecha desc ';
            $result=mysqli_query($link, $sql);
            while($row=mysqli_fetch_array($result)){
                echo '
                
                    <table class="table table-dark ">
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Forma P</th>
                            <th>Provincia</th>
                            <th>Telefono</th>
                            <th></th>
                        </tr>

                
                
                ';
                    echo '<tr>
                    <td>'.$row['cabe_fecha'].'</td>
                    <td>'.$row['cabe_total'].'</td>
                    <td>'.$row['cabe_metodos_pago'].'</td>
                    <td>'.$row['provincia'].'</td>
                    <td>'.$row['telefono'].'</td>
                    
                    </tr>
                </table>
                <div name="detalle'.$row['cabe_id'].'" style="display:block">
                    ';
                        $sq='select * from detalle left join
                        productos on produ_id=deta_produ_id
                         where deta_cabe_id='.$row['cabe_id'];
                        $res=mysqli_query($link, $sq);
                        echo '<table class="table table-bordered">';
                        while($fila=mysqli_fetch_array($res))
                        {
                            echo '<tr>
                            <td>('.$fila['produ_codigo'].') '.$fila['produ_nombre'].'</td>
                            <td>'.$fila['deta_produ_precio'].'</td>
                            <td>'.$fila['deta_cantidad'].'</td>

                            </tr>';
                        }
                        echo '</table>';
                echo '</div>
                ';
            }
            
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