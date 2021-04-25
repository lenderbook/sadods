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

<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-list" aria-hidden="true"></i> Relatórios </div>


<div class="page-content">


<p class="path-title">Home / Relatórios</p>



<table class="table-default">  
	<thead>
<tr>

<th>Relatório</th>
<th>Descrição</th>
</tr>
</thead>

<tr >

<td class="lalign"><a href="relatorio1.php">Logs</a> </td> 
<td class="lalign">Relatório histórico de inserções ou alterações de registros de ações ou indicadores por período</td> 
</tr>

<tr>
<td class="lalign"><a href="relatorio2.php">Ações por período</a> </td> 
<td class="lalign">Relação de ações e seus indicadores no período selecionado</td> 
</tr>

<tr>
<td class="lalign"><a href="relatorio3.php">Ações e status por período</a> </td> 
<td class="lalign">Relação de ações e status no período selecionado</td> 
</tr>

<tr>
<td class="lalign"><a href="relatorio4.php">Indicadores por período</a> </td> 
<td class="lalign">Relação lançamentos de resultados por ação e período de lançamento</td> 
</tr>	

	

</table>







<div class="page-paging">

</div>







<div class="page-buttons">
<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >
</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

