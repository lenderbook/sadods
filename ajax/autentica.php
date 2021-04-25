<?php
header ('Content-type: text/html; charset=iso-8859-1');
require_once '../database-class.php';

if (isset($_POST['login'])) {$login = $_POST['login'];}
if (isset($_POST['senha'])) {$senha = $_POST['senha'];}
if (isset($_POST['lembralogin'])) {$lembralogin = $_POST['lembralogin'];}

$dia=date("d");
$mes=date("m");
$ano=date("Y");
$hora=date("H:i:s");
$data= $dia ."/" . $mes ."/" . $ano;


// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)

if (isset($login) =="") 
{
echo 0;
exit;
}

if (isset($senha) =="") 
{
echo 0;
exit;
}


$login = $conex->mysqli->real_escape_string($login);
$senha = $conex->mysqli->real_escape_string($senha);


$sql = "select id_usuario, nome, email, nivel,  ultimo_acesso  from ods_usuarios where (usuario = '". $login ."') AND (senha = '". sha1($senha) ."') AND (status = 1) LIMIT 1";
$query = mysqli_query($conex->mysqli,$sql);

if (mysqli_num_rows($query) != 1) {

echo 0;
exit;
} else {



$resultado = $query->fetch_assoc();


if (!isset($_SESSION)) {session_start();}

$_SESSION['id_usuario'] = $resultado['id_usuario'];
$_SESSION['nivel'] = $resultado['nivel'];
$_SESSION['nome_user'] = $resultado['nome'];
$_SESSION['email_user'] = $resultado['email'];
$_SESSION['ultimo_acesso_user'] = $resultado['ultimo_acesso'];


$datahora = $data ." as ".$hora;
$sql2="update ods_usuarios set ultimo_acesso='".$datahora."' where id_usuario='".$_SESSION['id_usuario']."' ";
$query = mysqli_query($conex->mysqli,$sql2);


if($lembralogin =="sim") {
setcookie('login', $login, (time() + (30 * 24 * 3600)),"/");
setcookie('password', $senha, (time() + (30 * 24 * 3600)),"/");}
else{setcookie('login','',0,"/");
setcookie('password','',0,"/");}

echo 1;
}


$conex->mysqli->close();

?>
