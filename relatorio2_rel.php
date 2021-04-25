<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

if (!isset($_SESSION)) { session_start();};

if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}




$page_session = 'relatorios';
$submenu_item="";
require_once 'database-class.php';
require_once 'head.php';

$nivel = $_SESSION['nivel'];

if(isset($_GET['data_inicial'])) { $data_inicial = $_GET['data_inicial']; } else { $data_inicial = ""; }
if(isset($_GET['data_final'])) { $data_final = $_GET['data_final']; } else { $data_final = ""; }

$data_inicial_f = date('d/m/Y', strtotime($data_inicial));
$data_final_f = date('d/m/Y ', strtotime($data_final));

$data_final_t = $data_final ." 23:59:59";


$pagina =explode("/", $_SERVER['PHP_SELF']);
$pagina = end( $pagina);

if(isset($_GET['p'])) {$p = $_GET['p'];} //pagina atual
if(isset($p)) { $p = $p; } else { $p = 1; }
$qnt = 100;
$inicio = ($p*$qnt) - $qnt;


$sql_select ="SELECT * from ods_acoes where '".$data_inicial."' between data and data_final or '".$data_final_t."' between data and data_final LIMIT $inicio, $qnt ";
$sql_query = mysqli_query($conex->mysqli,$sql_select);
$sql_select_all = "SELECT * from ods_acoes where '".$data_inicial."' between data and data_final or '".$data_final_t."' between data and data_final"; 

$sql_query_all = mysqli_query($conex->mysqli,$sql_select_all);
$total_registros = mysqli_num_rows($sql_query_all); 
$pags = ceil($total_registros/$qnt); 
$max_links = 5; 



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
<script language="JavaScript" src="javascript/main.js"></script>
<script language="javascript" src="javascript/fwmx.js"></script>
<script type="text/javaScript" src="javascript/relatorio2.js?<?php echo microtime();?>"></script>

<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-list" aria-hidden="true"></i> Relatórios / Ações por período </div>


<div class="page-content">


<p class="path-title">Home / Relatórios / Ações por período</p>

<p>Relação de ações e seus indicadores no período selecionado</p>

<p>Período: <b><?php echo $data_inicial_f?></b> a <b><?php echo $data_final_f?></b></p>


<table class="table-default">  
	<thead>
<tr>
<th>id_acao</th>
<th>Início / Final</th>
<th>Nome</th>
<th>Situação</th>
<th>Classificação</th>
<th></th>
</tr>
</thead>


<?php while ($dados = $sql_query->fetch_assoc()){?>
	

<tr>
<td class="calign"><?=  $dados['id_acao']?></td>
<td class="calign"><?= date('d/m/Y', strtotime($dados['data']))?> / <?= date('d/m/Y', strtotime($dados['data_final']))?></td>
<td class="lalign"><?=$dados['nome']?></td>
<td class="lalign">
<?php 
switch($dados['status']) {
    case"0": $status_txt = "CANCELADA";break; 
    case"1": $status_txt = "EM ANDAMENTO";  break;  
    case"2": $status_txt = "CONCLUÍDA";  break;  
    case"3": $status_txt = "PAUSADA";  break;  }

echo $status_txt?>

</td>
<td class="lalign">
<?php switch($dados['classificacao']) {
    case"1": echo "AÇÃO SUSTENTÁVEL";  break;  
    case"2": echo "AÇÃO EM ATENÇÃO";  break;  
    case"3": echo "AÇÃO NÃO SUSTENTÁVEL";  break;  }?>

</td>
<td class="lalign"><div class="classif_<?=$dados['classificacao']?> round-classif"></div></td>

</tr>	

<tr>
<td colspan="6"><p><b>INDICADORES</b></p>

<?php
$sql_indicadores="select * from ods_indicadores where id_acao ='".$dados['id_acao']."' order by nome_indicador";
$result_indicadores = mysqli_query($conex->mysqli,$sql_indicadores);
while ($dados_indicadores = $result_indicadores->fetch_assoc()){
?>

<p><b> - <?=$dados_indicadores['nome_indicador']?></b></p>
<p>Valor de referência: <?=$dados_indicadores['valor_referencia']?><?php if($dados_indicadores['unidade_contagem']=='PERCENTUAL'){echo "%";}?></p>
<p>Meta comparativa: <?=$dados_indicadores['meta_comparativa']?></p>
<p>Resultado: <?=$dados_indicadores['resultado']?> <?php if($dados_indicadores['unidade_contagem']=='PERCENTUAL'){echo "%";}?></p>


<?php }?>

</td>

</tr>
	
<?php }?>	

</table>










<div class="page-paging">
<?php
echo "<a href=".$pagina."?p=1&data_inicial=".$data_inicial."&data_final=".$data_final."><i class='fa fa-chevron-left'></i></a> ";
for($i = $p-$max_links; $i <= $p-1; $i++) { 
if($i <=0) {} else { echo "<a href='".$pagina."?p=".$i."&data_inicial=".$data_inicial."&data_final=".$data_final."' >".$i."</a> "; } } 
echo $p." "; 
for($i = $p+1; $i <= $p+$max_links; $i++) {  if($i > $pags) { }  else { echo "<a href='".$pagina."?p=".$i."&data_inicial=".$data_inicial."&data_final=".$data_final."'>".$i."</a> "; } } 
echo "<a href='".$pagina."?p=".$pags."&data_inicial=".$data_inicial."&data_final=".$data_final."' ><i class='fa fa-chevron-right'></i></a> ";
?>

</div>











<div class="page-buttons">
    

<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >

<input type="button" class="button-success" value="  Gerar arquivo Excel  " onClick="excel('<?php echo $data_inicial?>','<?php echo $data_final?>')" >




</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

