<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"acoes_por_status_periodo.xls\"" );


if (!isset($_SESSION)) { session_start();};

if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}


require_once 'database-class.php';


$nivel = $_SESSION['nivel'];

if(isset($_GET['data_inicial'])) { $data_inicial = $_GET['data_inicial']; } else { $data_inicial = ""; }
if(isset($_GET['data_final'])) { $data_final = $_GET['data_final']; } else { $data_final = ""; }
if(isset($_GET['status'])) { $status = $_GET['status']; } else { $status = ""; }

$data_inicial_f = date('d/m/Y', strtotime($data_inicial));
$data_final_f = date('d/m/Y ', strtotime($data_final));

$data_final_t = $data_final ." 23:59:59";

if($status=='*'){$status_f="%";}else{$status_f = $status;}


$sql_select ="SELECT * from ods_acoes where ('".$data_inicial."' between data and data_final or '".$data_final_t."' between data and data_final)  and (status like '".$status_f."')";
$sql_query = mysqli_query($conex->mysqli,$sql_select);



?>



<p>Home / Relat�rios / A��es e status por per�odo</p>

<p>Rela��o de a��es e status no per�odo selecionado</p>

<p>Per�odo: <b><?php echo $data_inicial_f?></b> a <b><?php echo $data_final_f?></b></p>

<p>Status: <?php switch($status) {
    case "0": $status_txt = "CANCELADA";break; 
    case "1": $status_txt = "EM ANDAMENTO";  break;  
    case "2": $status_txt = "CONCLU�DA";  break;  
    case "3": $status_txt = "PAUSADA";  break;  
    case "*": $status_txt = "TODAS";     break;}
echo $status_txt?></p>

<table >  
	<thead>
<tr>
<th>id_acao</th>
<th>In�cio / Final</th>
<th>Nome</th>
<th>Situa��o</th>
<th>Classifica��o</th>

</tr>
</thead>


<?php while ($dados = $sql_query->fetch_assoc()){?>
	

<tr>
<td ><?=  $dados['id_acao']?></td>
<td ><?= date('d/m/Y', strtotime($dados['data']))?> / <?= date('d/m/Y', strtotime($dados['data_final']))?></td>
<td ><?=$dados['nome']?></td>
<td >
<?php 
switch($dados['status']) {
    case"0": $status_txt = "CANCELADA";break; 
    case"1": $status_txt = "EM ANDAMENTO";  break;  
    case"2": $status_txt = "CONCLU�DA";  break;  
    case"3": $status_txt = "PAUSADA";  break;  }

echo $status_txt?>

</td>
<td >
<?php switch($dados['classificacao']) {
    case"1": echo "A��O SUSTENT�VEL";  break;  
    case"2": echo "A��O EM ATEN��O";  break;  
    case"3": echo "A��O N�O SUSTENT�VEL";  break;  }?>

</td>


</tr>	

	
<?php }?>	

</table>






