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

$page_session = 'acoes';
$submenu_item="";
require_once 'database-class.php';
require_once 'head.php';


if(isset($_GET['status'])) { $status = $_GET['status']; } else { $status = "*"; }
if(isset($_GET['classificacao'])) { $classificacao = $_GET['classificacao']; } else { $classificacao = "*"; }

switch($status) {
    case "0": $status_txt = "CANCELADA";break; 
    case "1": $status_txt = "EM ANDAMENTO";  break;  
    case "2": $status_txt = "CONCLUÍDA";  break;  
    case "3": $status_txt = "PAUSADA";  break;  
    case "*": $status_txt = "TODAS";     break;}

    switch($classificacao) {
        case"1": $classificacao_txt = "AÇÃO SUSTENTÁVEL";  break;  
        case"2": $classificacao_txt = "AÇÃO EM ATENÇÃO";  break;  
        case"3": $classificacao_txt = "AÇÃO NÃO SUSTENTÁVEL";  break;
        case"*": $classificacao_txt = "TODAS";  break;  }
    

if($classificacao=='*'){$classificacao_f="%";}else{$classificacao_f = $classificacao; }


$pagina =explode("/", $_SERVER['PHP_SELF']);
$pagina = end( $pagina);
if(isset($_GET['sort'])) { $sort = $_GET['sort']; } else { $sort = "id_acao"; }
if(isset($_GET['p'])) {$p = $_GET['p'];} //pagina atual
if(isset($p)) { $p = $p; } else { $p = 1; }
$qnt = 15;
$inicio = ($p*$qnt) - $qnt;



if($status=='*'){
$sql_select = "SELECT *  FROM ods_acoes where classificacao like '".$classificacao_f."' order by ".$sort." LIMIT $inicio, $qnt"; 
$sql_select_all = "SELECT * FROM ods_acoes where classificacao like '".$classificacao_f."'"; 
}
else
{
    $sql_select = "SELECT *  FROM ods_acoes where status ='".$status."' and  classificacao like '".$classificacao_f."' order by ".$sort." LIMIT $inicio, $qnt"; 
    $sql_select_all = "SELECT * FROM ods_acoes where status ='".$status."' and classificacao like '".$classificacao_f."'";     

}

$sql_query = mysqli_query($conex->mysqli,$sql_select);


$sql_query_all = mysqli_query($conex->mysqli,$sql_select_all);
$total_registros = mysqli_num_rows($sql_query_all); 
$pags = ceil($total_registros/$qnt); 
$max_links = 5; 

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

<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-list" aria-hidden="true"></i> Cadastro de ações </div>


<div class="page-content">


<p class="path-title">Home / Cadastro de ações</p>

<p>Filtrar ações por status e classificação</p>

<div class="form-item-vertical">
<form method="GET">
<select name="status" id="status" class="select-default" >
<option selected value="<?php echo $status?>"><?php echo $status_txt?></option>
<option value="0">CANCELADA</option>
<option value="1">EM ANDAMENTO</option>
<option value="2">CONCLUÍDA</option>
<option value="3">PAUSADA</option>
<option value="*">TODAS</option>
</select>


<select name="classificacao" id="classificacao" class="select-default" onchange="submit()">
<option selected value="<?php echo $classificacao?>"><?php echo $classificacao_txt?></option>
<option value="1">AÇÃO SUSTENTÁVEL</option>
<option value="2">AÇÃO EM ATENÇÃO</option>
<option value="3">AÇÃO NÃO SUSTENTÁVEL</option>
<option value="*">TODAS</option>
</select>

</form></div>







<table class="table-default">  
	<thead>
<tr>

<th>Código</th>
<th>Nome</th>
<th>Data</th>
<th>Status</th>
<th></th>
<th>Classificação</th>
<th></th>
</tr>
</thead>


<?php while ($dados = $sql_query->fetch_assoc()){?>
	

<tr  onMouseOver="trmouseover(this);" onMouseOut="trmouseout(this)" >
<td class="calign"><?php echo $dados['id_acao']?></td>
<td class="lalign"><?php echo $dados['nome']?></td> 
<td class="calign"><?php echo date('d/m/Y', strtotime($dados['data']))?></td> 
<td class="lalign"><?php 

switch($dados['status']) {
    case"0": $status_txt = "CANCELADA";break; 
    case"1": $status_txt = "EM ANDAMENTO";  break;  
    case"2": $status_txt = "CONCLUÍDA";  break;  
    case"3": $status_txt = "PAUSADA";  break;  }

echo $status_txt?></td> 


<td class="calign"><div class="classif_<?=$dados['classificacao']?> round-classif"></div></td>
<td> 

 <?php switch($dados['classificacao']) {
    case"1": echo "AÇÃO SUSTENTÁVEL";  break;  
    case"2": echo "AÇÃO EM ATENÇÃO";  break;  
    case"3": echo "AÇÃO NÃO SUSTENTÁVEL";  break;  }?>

</td>

<td class="calign"> <i class="fa fa-edit hand"  onclick="javascript:location.href='acoes_form.php?id_acao=<?php echo $dados['id_acao']?>'"></i></td>
</tr>	
	
	
<?php }?>	

</table>







<div class="page-paging">
<?php
echo "<a href=".$pagina."?p=1&sort=".$sort."&status=".$status."> <i class='fa fa-chevron-left'></i></a> ";
for($i = $p-$max_links; $i <= $p-1; $i++) { 
if($i <=0) {} else { echo "<a href='".$pagina."?p=".$i."&sort=".$sort."&status=".$status."' >".$i."</a> "; } } 
echo $p." "; 
for($i = $p+1; $i <= $p+$max_links; $i++) {  if($i > $pags) { }  else { echo "<a href='".$pagina."?p=".$i."&sort=".$sort."&status=".$status."'>".$i."</a> "; } } 
echo "<a href='".$pagina."?p=".$pags."&sort=".$sort."&status=".$status."' ><i class='fa fa-chevron-right'></i></a> ";
?>

</div>







<div class="page-buttons">
<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >
<input type="button" class="button-default" value="  Relação geral  " onClick="javascript:location.href='acoes_rel.php'" >
<input type="button" class="button-default" value=" Novo " onClick="javascript:location.href='acoes_form.php'"  >



</div>



<div id="page-response"></div>



</div>

</div>
</div>



</body>
</html>

