<?php

$sql='select * from categorias where borrado=0  order by cate_descripcion asc';
$resultado=mysqli_query($link,$sql);



echo '
<section class="products-list">
				';
while($fila=mysqli_fetch_array($resultado)){

	echo '<div class="product-item" category="'.$fila['cate_descripcion'].'">
	<a href="articulos.php?cate='.$fila['cate_id'].'"><img src="'.$fila['cate_imagen'].'" alt="" >
					'.$fila['cate_descripcion'].'</a>
				</div>';
}
							
echo '</section>';
		
?>