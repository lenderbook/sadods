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

$page_session = 'relatorios';
$submenu_item="";
require_once 'database-class.php';
require_once 'head.php';


$data_inicial = date('Y-m-d');
$data_final = $data_inicial;



?>


<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Relatórios </title>
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
<script type="text/javaScript" src="javascript/relatorio4.js?<?php echo microtime();?>"></script>

<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-list" aria-hidden="true"></i> Relatórios / Indicadores por período </div>


<div class="page-content">


<p class="path-title">Home / Relatórios / Indicadores por período</p>


<p>Relação lançamentos de resultados por ação e período de lançamento</p>
<fieldset>
<legend>Dados para a consulta</legend>


<div class="form-item-vertical">
<label for="data" >Data inicial</label>
<input type="date" name="data_inicial" id="data_inicial" size="20" maxlength="10" class="input-default indented" value="<?php echo $data_inicial?>" >
</div> 

<div class="form-item-vertical">
<label for="data" >Data final</label>
<input type="date" name="data_final" id="data_final" size="20" maxlength="10" class="input-default indented" value="<?php echo $data_final?>" >
</div> 


<div class="form-item-vertical">
<label for="id_acao" >Ação</label>
<select name="id_acao" id="id_acao" class="select-default" >
<?php

$sql="select id_acao, nome from ods_acoes order by nome";
$result = mysqli_query($conex->mysqli,$sql);
while($dados = $result->fetch_assoc()){
?>
<option value="<?= $dados['id_acao']?>"><?= $dados['nome']?></option>
<?php }?>

</select>
</form></div>


    

</fieldset>








<div class="page-paging">

</div>







<div class="page-buttons">
<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >

<input type="button" class="button-success" value=" Executar consulta " onClick="gera_relatorio()" >
</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

