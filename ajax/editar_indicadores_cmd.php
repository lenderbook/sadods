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

if (isset($_POST['id_indicador'])) {$id_indicador = $_POST['id_indicador'];}
$id_indicador = $conex->mysqli->real_escape_string($id_indicador);

$sql_indicador = "SELECT * FROM ods_indicadores where id_indicador ='".$id_indicador."'"; 
$sql_query_indicador = mysqli_query($conex->mysqli,$sql_indicador);
$dados_indicador = $sql_query_indicador->fetch_assoc();
$nome_indicador = $dados_indicador['nome_indicador'];
$descricao = $dados_indicador['descricao'];
$meta_comparativa = $dados_indicador['meta_comparativa'];
$unidade_contagem = $dados_indicador['unidade_contagem'];
$valor_referencia = $dados_indicador['valor_referencia'];
$resultado = $dados_indicador['resultado'];

echo "document.getElementById('id_indicador').value='$id_indicador';";
echo "document.getElementById('nome_indicador').value='$nome_indicador';";
echo "document.getElementById('descricao').value='$descricao';";
echo "document.getElementById('meta_comparativa').value='$meta_comparativa';";
echo "document.getElementById('unidade_contagem').value='$unidade_contagem';";
echo "document.getElementById('valor_referencia').value='$valor_referencia';";
echo "document.getElementById('resultado').value='$resultado';";

?>

