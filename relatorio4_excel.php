<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"indicadores_por_periodo.xls\"" );

if (!isset($_SESSION)) { session_start();};

if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}


require_once 'database-class.php';



if(isset($_GET['data_inicial'])) { $data_inicial = $_GET['data_inicial']; } else { $data_inicial = ""; }
if(isset($_GET['data_final'])) { $data_final = $_GET['data_final']; } else { $data_final = ""; }
if(isset($_GET['id_acao'])) { $id_acao = $_GET['id_acao']; } else { $id_acao = ""; }

$data_inicial_f = date('d/m/Y', strtotime($data_inicial));
$data_final_f = date('d/m/Y ', strtotime($data_final));

$data_final_t = $data_final ." 23:59:59";

$sql_select ="SELECT * from  ods_indicadores_historico where data between '".$data_inicial."' and '".$data_final_t."' and id_acao ='".$id_acao."' order by data  ";
$sql_query = mysqli_query($conex->mysqli,$sql_select);


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



<p > Relatórios / Indicadores por período</p>

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

<p> <b><?=$classificacao_txt?></b></p>

<table >  
	<thead>
<tr>
<th>Data</th>
<th>Indicador</th>
<th>Resultado</th>
</tr>
</thead>


<?php while ($dados = $sql_query->fetch_assoc()){?>
	

<tr>
<td ><?=date('d/m/Y H:i:s', strtotime($dados['data']))?></td>
<td ><?php

$sql_indicadores="select nome_indicador from ods_indicadores where id_indicador = '".$dados['id_indicador']."'";
$result_indicadores = mysqli_query($conex->mysqli,$sql_indicadores);
$dados_indicadores = $result_indicadores->fetch_assoc();
echo $dados_indicadores['nome_indicador']?></td>

<td ><?=$dados['resultado']?></td>

</tr>	



	
<?php }?>	

</table>








