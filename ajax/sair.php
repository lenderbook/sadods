<?php
header ('Content-type: text/html; charset=iso-8859-1');

include '../database-class.php';

if (!isset($_SESSION)) { session_start();};


if (isset($_SESSION['id_usuario'])) 
{
$id_usuario = $_SESSION['id_usuario'];
$sql="update usuarios set on_line='OFF' where id_usuario='".$id_usuario."' ";
mysqli_query($conex->mysqli,$sql);

}

session_destroy();
?>
setTimeout('reload();', 2000);




