<?php
if (!isset($_SESSION)) { session_start();};


if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}

if($_SESSION['nivel'] < 3){ //Somente nivel 3 (administrador) pode ver esta página

header('Location: index.php');
exit;    
    
}

$page_session = 'pesquisa';
$submenu_item="";
require_once 'database-class.php';
require_once 'head.php';


$data_inicial = date('Y-m-d');
$data_final = $data_inicial;



?>


<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ações </title>
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
<script type="text/javaScript" src="javascript/acoes.js?<?php echo microtime();?>"></script>

<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-pencil" aria-hidden="true"></i> Cadastro de ações </div>


<div class="page-content">


<p class="path-title">Home /  Cadastro de ações</p>



<fieldset>
<legend>Dados para a consulta</legend>



<div class="form-item-vertical">
<label for="pesquisa" >Pesquisar por</label>
<input type="text" name="pesquisa" id="pesquisa" size="20" class="input-default calign" value="" >
</div> 






    

</fieldset>








<div class="page-paging">

</div>







<div class="page-buttons">
<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >

<input type="button" class="button-success" value=" Executar consulta " onClick="pesquisa()" >
</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

