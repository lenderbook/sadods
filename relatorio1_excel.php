<?php

header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"logs.xls\"" );


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

$data_inicial_f = date('d/m/Y', strtotime($data_inicial));
$data_final_f = date('d/m/Y ', strtotime($data_final));

$data_final .=" 23:59:59";


$sql_select ="SELECT *  from ods_logs where data between '".$data_inicial."' and '".$data_final."'  ";
$sql_query = mysqli_query($conex->mysqli,$sql_select);



?>



<p>Home / Relatórios / Logs</p>

<p>Relatório histórico de inserções ou alterações de registros de ações ou indicadores por período</p>


<p>Período: <b><?php echo $data_inicial_f?></b> a <b><?php echo $data_final_f?></b></p>


<table>  
	<thead>
<tr>
<th>id_log</th>
<th>Data</th>
<th>Descrição</th>
<th>Detalhes</th>
</tr>
</thead>


<?php while ($dados = $sql_query->fetch_assoc()){?>
	

<tr>
<td ><?=  $dados['id_log']?></td>
<td ><?= date('d/m/Y H:i:s', strtotime($dados['data']))?></td>
<td ><?=$dados['descricao']?></td>
<td ><p><?=$dados['script']?><br>id_acao: <?=$dados['id_acao']?><br>id_indicador: <?=$dados['id_indicador']?><br>
<?php
$sql_usuario="select nome from ods_usuarios where id_usuario = '".$dados['id_usuario']."'";
$result_usuario = mysqli_query($conex->mysqli,$sql_usuario);
$dados_usuario = $result_usuario->fetch_assoc();
echo "usuário: ". $dados_usuario['nome'];
?>

</p></td>


</tr>	
	
<?php }?>	

</table>











