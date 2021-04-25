<?php
header ('Content-type: text/html; charset=iso-8859-1');
include '../database-class.php';
include 'compress_img_cmd.php';

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: encerrada.php');
exit;
}

if (!isset($_FILES['file1'])) 
{print "document.getElementById('progress1').classList.add('hidden');";
	print "msgdlg('error','arquivo1','','','Falha na operação','Você não selecionou um arquivo.<br>Escolha uma imagem para o seu perfil.')";exit;}

$uploaddir = IMG_USER;

$uploadfile = $uploaddir . $_FILES['file1']['name'];
$nomearquivo ="user-". $_SESSION['id_usuario']. "_". $_FILES['file1']['name'];;

$tamanho = $_FILES['file1']['size'];
if ($tamanho > 4000000)//4 mega
{
print "document.getElementById('progress1').classList.add('hidden');";	
print "msgdlg('error','','','','Falha','O arquivo é muito grande!');";
exit;
}


if (move_uploaded_file($_FILES['file1']['tmp_name'], $uploaddir . $nomearquivo)) {

$_SESSION['imagem_perfil'] = $nomearquivo;	
$sql2="update usuarios set imagem='".$nomearquivo."' where id_usuario='".$_SESSION['id_usuario']."' ";
$query = mysqli_query($conex->mysqli,$sql2);

//compressão e ajuste de imagens
$file = $uploaddir . $nomearquivo;
compress($file, $file, '75', '2048');    

print "window.document.userimg.src='users/".$nomearquivo."'; ";
print "document.getElementById(\"page-response\").className='warning-success';";
print "document.getElementById(\"page-response\").innerHTML='Ok, imagem alterada.';";
print "document.getElementById('progress1').classList.add('hidden');";


} 
else 
{
    print_r($_FILES);
}




?>
