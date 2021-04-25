<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'database-class.php';

if (!empty($_COOKIE['login'])){ $login = $_COOKIE['login'];} else {$login="";}
if (!empty($_COOKIE['password'])){ $password =$_COOKIE['password'];} else {$password="";}


$sql="select * from ods_config ";
$result = mysqli_query($conex->mysqli,$sql);
$dados = $result->fetch_assoc();

$app_name= $dados['app_name'];
$web_site = $dados['web_site'];
$versao = $dados['versao'];
$logomarca = $dados['logomarca'];
$logomarca_small=$dados['logomarca_small'];


if (!isset($_SESSION)) { session_start();}
$_SESSION['app_name'] = $app_name;
$_SESSION['web_site'] = $web_site;
$_SESSION['versao'] = $versao;
$_SESSION['logomarca'] = $logomarca;
$_SESSION['logomarca_small'] =$logomarca_small;




?>


<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $app_name?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel=stylesheet href="css/login.css" type="text/css">
<link rel=stylesheet href="css/fwmx.css" type="text/css">
<link rel=stylesheet href="css/grids.css" type="text/css">
<link rel=stylesheet href="css/animate.css" type="text/css">
<script language="JavaScript" src="javascript/ajax.js"></script>
<script language="JavaScript" src="javascript/login.js"></script>
<script language="javascript" src="javascript/fwmx.js"></script>

</head>

<body>
<?php include 'fwmx.html'?>


<div class="flex-container" id="login-div" >

<div class="flex-item" >

<div class="logo-div"><img src="contents/<?php echo $logomarca?>" class="logo-img"></div>

<div class="form" >

<p class="title-one">Entrar</p>

<div class="form-item-vertical">
<input type="text" name="login" id="login" class="input-default input-autosize indented" value="<?php echo $login;?>"  placeholder="Nome / E-mail" >
</div>

<div class="form-item-vertical">
<input type="password" name="senha" id="senha" class="input-default input-autosize indented" value="<?php echo $password;?>"  placeholder="Senha">
</div>

<div class="form-item-vertical">
<input type="button" name="Entrar" value="  Entrar  " onClick="logar()" class="button-main">
</div>

<div class="form-item-vertical">
<input type="checkbox" name="Lembrar" id="Lembrar" <?php if  (!$login=="") { ?>checked<?php } ?> value="ON">Lembrar-me   | <a href="javascript:;" onClick="RecuperaSenha()"> Esqueceu sua senha?</a>
</div>	

</div>

<div id="response-div" class="animated fadeIn"></div>




</div>


<div class="row spacing-tblr text "><?php echo $app_name?> - <?php echo $versao?><br/> <?php echo $web_site?> </div>

</div>





<div id="painel1" class="panel-default" ></div>

</body>
</html>