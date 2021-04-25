<?php
if (!isset($_SESSION)) { session_start();};



if (!isset($_SESSION['nivel'])) 
{
session_destroy(); 
header('Location: login.php');
exit;
}

$page_session = 'acoes';
$submenu_item="";
require_once 'database-class.php';
require_once 'head.php';


if (isset($_GET['id_acao']))
{
$id_acao = $_GET['id_acao'];
$sql="select * from ods_acoes where id_acao = '".$id_acao."'";
$result = mysqli_query($conex->mysqli,$sql);
$dados = $result->fetch_assoc();

$id_acao = $dados['id_acao'];
$nome = $dados['nome'];
$data = date('Y-m-d', strtotime($dados['data']));
$data_final = date('Y-m-d', strtotime($dados['data_final']));
$status = $dados['status'];
switch($status) {
    case"0": $status_txt = "CANCELADA";break; 
    case"1": $status_txt = "EM ANDAMENTO";  break;  
    case"2": $status_txt = "CONCLUÍDA";  break;  
    case"3": $status_txt = "PAUSADA";  break;  }

$detalhes = $dados['detalhes'];
$classificacao = $dados['classificacao'];

switch($classificacao) {
    case"1": $classificacao_txt = "AÇÃO SUSTENTÁVEL";  break;  
    case"2": $classificacao_txt = "AÇÃO EM ATENÇÃO";  break;  
    case"3": $classificacao_txt = "AÇÃO NÃO SUSTENTÁVEL";  break;  }




}
else
{
$id_acao = "";
$nome = "";
$data = "";
$data_final = "";
$status = "1";
$status_txt ="EM ANDAMENTO";
$detalhes="";
$classificacao ='';
$classificacao_txt='';
}

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
<script type="text/javaScript" defer src="javascript/acoes_form.js?<?php echo microtime()?>"></script>
<link rel="shortcut icon" href="favicon.ico" >

</head>
<body>

<?php include 'fwmx.html' ?>
<?php include 'top.php' ?>


<div class="flex-container">

<?php include 'leftmenu.php' ?>

<div class="main-div"> 

<div class="page-path"> <i class="fa fa-pencil" aria-hidden="true"></i> Cadastro de ações </div>


<div class="page-content">


<p class="path-title">Home /  Cadastro de ações</p>




<fieldset>
<legend>Dados iniciais</legend>



<div class="form-item-vertical">
<label for="id_usuario" >Código</label>
<input type="text" name="id_acao" disabled id="id_acao" size="10" class="calign input-default " value="<?php echo $id_acao?>">
</div>

<div class="form-item-vertical">
<label for="Nome" >Nome da ação</label>
<input type="text" name="nome" id="nome" size="40"  class="input-default indented" value="<?= $nome?>">
</div>

<div class="form-item-vertical">
<label for="data" >Data</label>
<input type="date" name="data" id="data" size="20"   class="input-default indented" value="<?= $data?>">
</div>

<div class="form-item-vertical">
<label for="data_final" >Data final</label>
<input type="date" name="data_final" id="data_final" size="20"   class="input-default indented" value="<?= $data_final?>">
</div>

<div class="form-item-vertical">
<label for="Status">Status</label>
<select name="status" id="status" class="select-default">
<option selected value="<?php echo $status?>"><?php echo $status_txt?></option>
<option value="0">CANCELADA</option>
<option value="1">EM ANDAMENTO</option>
<option value="2">CONCLUÍDA</option>
<option value="3">PAUSADA</option>
</select></div>




</fieldset>

<fieldset>
<legend>Outras informações sobre a ação</legend>

<div class="form-item-vertical">

<textarea name="detalhes" id="detalhes" rows="5" cols="90"   class="textarea-default "><?php echo $detalhes?></textarea>
</div>


</fieldset>


<div class="page-buttons">
<input type="button" class="button-default" value=" Voltar " onClick="javascript:history.go(-1)" >
<input type="button" class="button-default" value="  Relação geral  " onClick="javascript:location.href='acoes_rel.php'" >
<input type="button" class="button-default" value=" Excluir " onClick="msgdlg('confirm','', excluir ,'','Confirmação','Confirma excluir este registro do banco de dados?')" >
<input type="button" class="button-default" value=" Novo " onClick="javascript:location.href='acoes_form.php'"  >
<input type="button" class="button-main" value="   Salvar  "  onclick="salva()" accesskey="s" title="Salva [alt+s]">
</div>


<div id="page-response" class="warning-blank"></div>

<fieldset>
<legend>Indicadores sustentáveis</legend>



<div id="table-indicadores">


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
</div>

<p><input id="btn-adiciona-indicador" type="button" class="button-success" value="  + Adicionar indicador  " ></p>

</fieldset>







</div>

</div>
</div>







<div id="painel-indicador" class="panel-default animated fadeInDown">
<div class="spacing-tblr" >
<fieldset><legend>Indicador de sustentabilidade</legend>

<p>Adicione ou edita os indicadores da ação</p>

<input type="hidden" value="" id="id_indicador">

<div class="form-item-vertical">
<label for="nome_indicador" >Nome do indicador</label>
<input type="text" name="nome_indicador" id="nome_indicador" size="60" maxlength="150"  class="input-default indented" value="">
</div>

<div class="form-item-vertical">
<label for="descricao" >Descrição</label>
<input type="text" name="descricao" id="descricao" size="60" class="input-default indented" value="" maxlength="250">
</div>

<div class="form-item-vertical">
<label for="Nome" >Meta comparativa</label>
<select name="meta_comparativa" id="meta_comparativa"  class="select-default">
<option value="=">=</option> 
<option value=">">></option>
<option value="<"><</option>
<option value="=>">=></option>
<option value="=<">=<</option>
</select>
</div>


<div class="form-item-vertical">
<label for="Nome" >Unidade</label>
<select name="unidade_contagem" id="unidade_contagem"  class="select-default ">
<option value="PERCENTUAL">PERCENTUAL</option> 
<option value="CONTAGEM">CONTAGEM</option>
</select>
</div>

<div class="form-item-vertical">
<label for="valor_referencia" >Valor referência</label>
<input type="text" name="valor_referencia" id="valor_referencia" size="10"  class="input-default calign" value="">
</div>


<div class="form-item-vertical">
<label for="Nome" >Resultado</label>
<input type="text" name="resultado" id="resultado" size="10"  class="input-default calign" value="">
</div>


</fieldset>

<div id ="painel-resultado" class="warning-blank"></div>
<div class="ralign" ><input type="button" class="button-default" value=" Novo indicador " id="btn-novo" > <input type="button" class="button-success" value=" Salvar " id="btn-salvar" > <input type="button" id="btn-fechar" class="button-default" value=" Fechar " >    </div>

</div>
</div>




</body>
</html>

