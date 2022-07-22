<?php

function Conectarse()
{
	if (!($linki=mysqli_connect('localhost','root','123456','pumastyle')))
	{
		echo 'Error conectando a la db<br>';
		 echo '	Error: '.mysqli_error();
		 	exit();
	}
	return $linki;
}

$link=Conectarse();
?>