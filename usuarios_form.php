<?php
if (!isset($_SESSION)) { session_start();};



if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}

$page_session = 'usuarios';
$submenu_item="1";
require_once 'database-class.php';
require_once 'head.php';


if (isset($_GET['id_usuario']))
{
$id_usuario = $_GET['id_usuario'];
$sql="select * from ods_usuarios where id_usuario = '".$id_usuario."'";
$result = mysqli_query($conex->mysqli,$sql);
$dados = $result->fetch_assoc();


$id_usuario = $dados['id_usuario'];
$nome = $dados['nome'];
$email = $dados['email'];
$usuario = $dados['usuario'];
$senha = "";
$nivel = $dados['nivel'];
$status = $dados['status'];
switch($status) {case"0": $status_txt = "INATIVO";break; case"1": $status_txt = "ATIVO";  break;  }



}
else
{
$id_usuario = "";
$nome = "";
$email = "";
$usuario = "";
$senha = "";
$nivel = "";
$status = "";
$status_txt ="";
}

?>




<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Usuários </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel=stylesheet href="css/fwmx.css" type="text/css">
<link rel=stylesheet href="css/grids.css" type="text/css">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
<script language="JavaScript" src="javascript/ajax.js"></script>
<script language="JavaScript" src="javascript/main.js?<?php echo microtime()?>"></script>
<script language="javascript" src="javascript/fwmx.js"></script>
<script type="text/javaScript" src="javascript/usuarios_form.js?<?php echo microtime()?>"></script>
<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-pencil" aria-hidden="true"></i> Cadastro de usuários </div>


<div class="page-content">


<p class="path-title">Home /  Cadastro de usuários</p>




<fieldset>
<legend>Dados iniciais</legend>



<div class="form-item-vertical">
<label for="id_usuario" >Código</label>
<input type="text" name="id_usuario" disabled id="id_usuario" size="10" class="calign input-default " value="<?php echo $id_usuario?>">
</div>

<div class="form-item-vertical">
<label for="Nome" >Nome</label>
<input type="text" name="nome" id="nome" size="40"  class="input-default indented" value="<?php echo $nome?>">
</div>

<div class="form-item-vertical">
<label for="Email" >E-mail</label>
<input type="text" name="email" id="email" size="40"    class="input-default indented" value="<?php echo $email?>">

</div>

<div class="form-item-vertical">
<label for="Usuario" >Usuario</label>
<input type="text" name="usuario" id="usuario" size="40"  class="input-default indented" value="<?php echo $usuario?>">
</div>


<div class="form-item-vertical">
<label for="Senha" >Senha</label>
<input type="password" name="senha" id="senha" size="20"  class="input-default calign" value="<?php echo $senha?>"> <?php if($id_usuario !=''){echo 'Deixar em branco para não alterar a senha';}?>
</div> 

<div class="form-item-vertical">
<label for="Nivel" >Nível</label>

<select name="nivel" id="nivel"  class="select-default">
<option selected value="<?php echo $nivel?>"><?php echo $nivel?></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>

</div>


<div class="form-item-vertical">
<label for="Status">Status</label>
<select name="status" id="status" class="select-default">
<option selected value="<?php echo $status?>"><?php echo $status_txt?></option>
<option value="0">INATIVO</option>
<option value="1">ATIVO</option>
</select></div>







</fieldset>

<div class="page-buttons">
<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >
<input type="button" class="button-default" value="  Relação geral  " onClick="javascript:location.href='usuarios_rel.php'" >
<input type="button" class="button-default" value=" Excluir " onClick="msgdlg('confirm','', excluir ,'','Confirmação','Confirma excluir este registro do banco de dados?')" >
<input type="button" class="button-default" value=" Novo " onClick="javascript:location.href='usuarios_form.php'"  >
<input type="button" class="button-main" value="   Salvar  "  onclick="salva()" accesskey="s" title="Salva [alt+s]">


</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

