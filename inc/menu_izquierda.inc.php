<?php

$sql='select * from categorias where borrado=0 order by cate_descripcion asc';
$resultado=mysqli_query($link,$sql);



echo '
<div class="category_list">
				<a href="#" class="category_item" category="all">Todo</a>';
while($fila=mysqli_fetch_array($resultado)){

	echo '<a href="tienda.php#" class="category_item" category="'.$fila['cate_descripcion'].'">'.$fila['cate_descripcion'].'</a>';
}
				
				
echo'</div>';
			


?>