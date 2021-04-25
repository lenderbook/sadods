<?php
if (!isset($_SESSION)) { session_start();};



if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}

if($_SESSION['nivel'] < 3){ //Somente nivel 3 (administrador) pode ver esta p�gina

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
<title>Relat�rios </title>
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

<div class="page-path"> <i class="fa fa-list" aria-hidden="true"></i> Relat�rios </div>


<div class="page-content">


<p class="path-title">Home / Relat�rios</p>



<table class="table-default">  
	<thead>
<tr>

<th>Relat�rio</th>
<th>Descri��o</th>
</tr>
</thead>

<tr >

<td class="lalign"><a href="relatorio1.php">Logs</a> </td> 
<td class="lalign">Relat�rio hist�rico de inser��es ou altera��es de registros de a��es ou indicadores por per�odo</td> 
</tr>

<tr>
<td class="lalign"><a href="relatorio2.php">A��es por per�odo</a> </td> 
<td class="lalign">Rela��o de a��es e seus indicadores no per�odo selecionado</td> 
</tr>

<tr>
<td class="lalign"><a href="relatorio3.php">A��es e status por per�odo</a> </td> 
<td class="lalign">Rela��o de a��es e status no per�odo selecionado</td> 
</tr>

<tr>
<td class="lalign"><a href="relatorio4.php">Indicadores por per�odo</a> </td> 
<td class="lalign">Rela��o lan�amentos de resultados por a��o e per�odo de lan�amento</td> 
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

