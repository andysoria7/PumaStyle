<?php

include('conecta.inc.php');

$sql='select * from productos order by produ_nombre asc';
$resultado=mysqli_query($link,$sql);

while($fila=mysqli_fetch_array($resultado)){

	echo $fila['produ_id'].' - <strong>'.$fila['produ_nombre'].'</strong> - '.$fila['produ_precio'].'<br>' ;
}

?>
