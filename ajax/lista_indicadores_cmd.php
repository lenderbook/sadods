<?php 
header ('Content-type: text/html; charset=iso-8859-1');
include '../database-class.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['nivel'])) 
{
    session_destroy(); 
    header('Location: encerrada.php');
    exit;
}

if (isset($_POST['id_acao'])) {$id_acao = $_POST['id_acao'];}
$id_acao = $conex->mysqli->real_escape_string($id_acao);


$sql="select classificacao from ods_acoes where id_acao = '".$id_acao."'";
$result = mysqli_query($conex->mysqli,$sql);
$dados = $result->fetch_assoc();
$classificacao = $dados['classificacao'];

switch($classificacao) {
    case"1": $classificacao_txt = "AÇÃO SUSTENTÁVEL";  break;  
    case"2": $classificacao_txt = "AÇÃO EM ATENÇÃO";  break;  
    case"3": $classificacao_txt = "AÇÃO NÃO SUSTENTÁVEL";  break;  
}




$sql_indicadores = "SELECT * FROM ods_indicadores where id_acao ='".$id_acao."'"; 
$sql_query_indicadores = mysqli_query($conex->mysqli,$sql_indicadores);
$total_indicadores = mysqli_num_rows($sql_query_indicadores); 
?>


<div class="classificacao">
<div class="classif_<?=$classificacao?> round-classif"></div>
<div> <b><?=$classificacao_txt?></b></div>
</div>


<?php
$sql_indicadores = "SELECT * FROM ods_indicadores where id_acao ='".$id_acao."'"; 
$sql_query_indicadores = mysqli_query($conex->mysqli,$sql_indicadores);
$total_indicadores = mysqli_num_rows($sql_query_indicadores); 
?>
<p>Esta ação possui (<?=$total_indicadores?>) indicador(es) de sustentabilidade</p>
<table class="table-default">  
	<thead>
<tr>
<th>Indicador</th>
<th>Meta comparativa</th>
<th>Unidade</th>
<th>Valor referência</th>
<th>Resultado</th>
<th>Sustentável</th>
<th></th>
<th></th>
</tr>
</thead>


<?php 


while ($dados_indicadores = $sql_query_indicadores->fetch_assoc()){?>
	

<tr  onMouseOver="trmouseover(this);" onMouseOut="trmouseout(this)" >
<td class="lalign"><?= $dados_indicadores['nome_indicador']?></td>
<td class="calign"><?= $dados_indicadores['meta_comparativa']?></td> 
<td class="calign"><?= $dados_indicadores['unidade_contagem']?></td> 
<td class="calign"><?= $dados_indicadores['valor_referencia']?></td> 
<td class="calign"><?= $dados_indicadores['resultado']?></td> 
<td class="calign"><?php if ($dados_indicadores['status']=='1'){?><i class="fa fa-check sustentavel"></i><?php }else{?> <i class="fa fa-times nao-sustentavel"></i> <?php } ?>  </td> 
<td class="calign"> <i class="fa fa-edit hand"  onclick="indicador_editar('<?= $dados_indicadores['id_indicador']?>')"></i></td>
<td class="calign"> <i class="fa fa-trash hand"  onclick="indicador_excluir('<?= $dados_indicadores['id_indicador']?>')"></i></td>
</tr>	
	
	
<?php }?>	

</table>