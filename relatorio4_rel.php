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
if(isset($_GET['id_acao'])) { $id_acao = $_GET['id_acao']; } else { $id_acao = ""; }

$data_inicial_f = date('d/m/Y', strtotime($data_inicial));
$data_final_f = date('d/m/Y ', strtotime($data_final));

$data_final_t = $data_final ." 23:59:59";



$pagina =explode("/", $_SERVER['PHP_SELF']);
$pagina = end( $pagina);

if(isset($_GET['p'])) {$p = $_GET['p'];} //pagina atual
if(isset($p)) { $p = $p; } else { $p = 1; }
$qnt = 100;
$inicio = ($p*$qnt) - $qnt;


$sql_select ="SELECT * from  ods_indicadores_historico where data between '".$data_inicial."' and '".$data_final_t."' and id_acao ='".$id_acao."' order by data  LIMIT $inicio, $qnt";

$sql_query = mysqli_query($conex->mysqli,$sql_select);
$sql_select_all = "SELECT * from ods_indicadores_historico where data between '".$data_inicial."' and '".$data_final_t."' and id_acao ='".$id_acao."' "; 

$sql_query_all = mysqli_query($conex->mysqli,$sql_select_all);
$total_registros = mysqli_num_rows($sql_query_all); 
$pags = ceil($total_registros/$qnt); 
$max_links = 5; 


$sql_acao="select * from ods_acoes where id_acao = '".$id_acao."'";
$result_acao = mysqli_query($conex->mysqli,$sql_acao);
$dados_acao = $result_acao->fetch_assoc();
$acao = $dados_acao['nome'];
$status = $dados_acao['status'];
$classificacao = $dados_acao['classificacao'];

switch($classificacao) {
    case"1": $classificacao_txt = "AÇÃO SUSTENTÁVEL";  break;  
    case"2": $classificacao_txt = "AÇÃO EM ATENÇÃO";  break;  
    case"3": $classificacao_txt = "AÇÃO NÃO SUSTENTÁVEL";  break;  }


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

<p>Período: <b><?php echo $data_inicial_f?></b> a <b><?php echo $data_final_f?></b></p>

<p>Ação: <b><?=$acao?></b></p>

<p>Status: <?php switch($status) {
    case "0": $status_txt = "CANCELADA";break; 
    case "1": $status_txt = "EM ANDAMENTO";  break;  
    case "2": $status_txt = "CONCLUÍDA";  break;  
    case "3": $status_txt = "PAUSADA";  break;  
    case "*": $status_txt = "TODAS";     break;}
echo $status_txt?></p>

<div class="classificacao">
<div class="classif_<?=$classificacao?> round-classif"></div>
<div> <b><?=$classificacao_txt?></b></div>
</div>


<table class="table-default">  
	<thead>
<tr>
<th>Data</th>
<th>Indicador</th>
<th>Resultado</th>
</tr>
</thead>


<?php while ($dados = $sql_query->fetch_assoc()){?>
	

<tr>
<td class="calign"><?=date('d/m/Y H:i:s', strtotime($dados['data']))?></td>
<td class="lalign"><?php

$sql_indicadores="select nome_indicador from ods_indicadores where id_indicador = '".$dados['id_indicador']."'";
$result_indicadores = mysqli_query($conex->mysqli,$sql_indicadores);
$dados_indicadores = $result_indicadores->fetch_assoc();
echo $dados_indicadores['nome_indicador']?></td>

<td class="calign"><?=$dados['resultado']?></td>

</tr>	



	
<?php }?>	

</table>










<div class="page-paging">
<?php
echo "<a href=".$pagina."?p=1&data_inicial=".$data_inicial."&data_final=".$data_final."&id_acao=".$id_acao."><i class='fa fa-chevron-left'></i></a> ";
for($i = $p-$max_links; $i <= $p-1; $i++) { 
if($i <=0) {} else { echo "<a href='".$pagina."?p=".$i."&data_inicial=".$data_inicial."&data_final=".$data_final."&id_acao=".$id_acao."' >".$i."</a> "; } } 
echo $p." "; 
for($i = $p+1; $i <= $p+$max_links; $i++) {  if($i > $pags) { }  else { echo "<a href='".$pagina."?p=".$i."&data_inicial=".$data_inicial."&data_final=".$data_final."&id_acao=".$id_acao."'>".$i."</a> "; } } 
echo "<a href='".$pagina."?p=".$pags."&data_inicial=".$data_inicial."&data_final=".$data_final."&id_acao=".$id_acao."' ><i class='fa fa-chevron-right'></i></a> ";
?>

</div>











<div class="page-buttons">
    

<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >

<input type="button" class="button-success" value="  Gerar arquivo Excel  " onClick="excel('<?php echo $data_inicial?>','<?php echo $data_final?>','<?=$id_acao?>')" >




</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

