<?php
if (!isset($_SESSION)) { session_start();};


if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}
$page_session = 'index';
$submenu_item="";
require_once 'database-class.php';
require_once 'head.php';


$meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");
$semana = array('0' => 'domingo', '1' => 'segunda-feira', '2' => 'terca-feira','3' => 'quarta-feira','4' => 'quinta-feira', '5' => 'sexta-feira','6' => 'sábado'   );

$app = $_SESSION['app_name'];


$sql_acoes="select count(id_acao) as total from ods_acoes";
$result_acoes = mysqli_query($conex->mysqli,$sql_acoes);
$dados_acoes = $result_acoes->fetch_assoc();
$total_acoes = $dados_acoes['total'];

$sql_acoes_andamento="select count(id_acao) as total from ods_acoes where status ='1'";
$result_acoes_andamento = mysqli_query($conex->mysqli,$sql_acoes_andamento);
$dados_acoes_andamento = $result_acoes_andamento->fetch_assoc();
$total_acoes_andamento = $dados_acoes_andamento['total'];

$hoje = date('Y-m-d');

$sql_acoes_vencidas="SELECT count(id_acao) as total FROM ods_acoes where data_final <= '".$hoje."' and status ='1';";
$result_acoes_vencidas = mysqli_query($conex->mysqli,$sql_acoes_vencidas);
$dados_acoes_vencidas = $result_acoes_vencidas->fetch_assoc();
$total_acoes_vencidas = $dados_acoes_vencidas['total'];

$sql_acoes_sustentaveis="select count(id_acao) as total from ods_acoes where classificacao ='1'";
$result_acoes_sustentaveis = mysqli_query($conex->mysqli,$sql_acoes_sustentaveis);
$dados_acoes_sustentaveis = $result_acoes_sustentaveis->fetch_assoc();
$total_acoes_sustentaveis = $dados_acoes_sustentaveis['total'];

$sql_acoes_em_atencao="select count(id_acao) as total from ods_acoes where classificacao ='2'";
$result_acoes_em_atencao = mysqli_query($conex->mysqli,$sql_acoes_em_atencao);
$dados_acoes_em_atencao = $result_acoes_em_atencao->fetch_assoc();
$total_acoes_em_atencao = $dados_acoes_em_atencao['total'];

$sql_acoes_nao_sustentaveis="select count(id_acao) as total from ods_acoes where classificacao ='3'";
$result_acoes_nao_sustentaveis = mysqli_query($conex->mysqli,$sql_acoes_nao_sustentaveis);
$dados_acoes_nao_sustentaveis = $result_acoes_nao_sustentaveis->fetch_assoc();
$total_acoes_nao_sustentaveis = $dados_acoes_nao_sustentaveis['total'];



?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$app?> </title>
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
<script language="javascript" src="javascript/index.js"></script>
<link rel="shortcut icon" href="favicon.ico" >




</head>

<body>
<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div">

<div class="page-path"><i class="fa fa-home" aria-hidden="true"></i> Home </div>

<div class="page-content">
	


<p><h4><i>Ola, <?=$nome_user?>!</i></h4></p>
<p>Hoje, <?php echo $semana[date('w')].", " . date('d')." de " .$meses[date('n')]. " de " . date('Y');?>




<fieldset>

<div class="div-shortcut">

<div class="icon-shortcut">
<div class="icon-highlights"> <i class="fa fa-cogs fa-2x"></i></div>
<p> Nº total de ações cadastradas (<?=$total_acoes?>)</p>
<p><a href="acoes_rel.php">Listar todas ações</a></p>
</div>

<div class="icon-shortcut">
<div class="icon-highlights"><i class="fa fa-cog fa-2x"></i></div>
<p> Ações em andamento (<?=$total_acoes_andamento?>) </p>
<p><a href="acoes_rel.php?status=1">Listar ações</a></p>
</div>



</div>
</fieldset>



<fieldset><legend>Quadro resumo</legend>

<p>(<?=$total_acoes_vencidas?>) Ações com data de propagação vencidas - <a href="acoes_rel_vencidas.php"> Listar ações</a></p>

<p>

<div class="classificacao">
<div class="classif_1 round-classif"></div>
 (<?=$total_acoes_sustentaveis?>) Ações sustentáveis - <a href="acoes_rel.php?status=*&classificacao=1"> Listar ações</a></div>


 <div class="classificacao">
<div class="classif_2 round-classif"></div>
(<?=$total_acoes_em_atencao?>) Ações em atenção - <a href="acoes_rel.php?status=*&classificacao=2"> Listar ações</a></div>

<div class="classificacao">
<div class="classif_3 round-classif"></div>
(<?=$total_acoes_nao_sustentaveis?>) Ações não sustentáveis - <a href="acoes_rel.php?status=*&classificacao=3"> Listar ações</a></div>



</fieldset>





<fieldset>
<legend>ODS - ONU</legend>

<img src="images/educacao_qualidade.png">

<img src="images/parcerias.png">
<img src="images/trabalho_decente.png">


</fieldset>




</div>
</div>
</div>

</body>
</html>