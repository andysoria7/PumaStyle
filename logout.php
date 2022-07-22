<?php 
session_start();

echo session_destroy();

header('location:visitante-index.php');

?>