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
if ($_SESSION['nivel'] < 2)
{
    echo "msgdlg('information','','','','Falha de permissão','<b>Seu nível de acesso não permite esta operação!</b>');";
    exit;
}

if (isset($_POST['cmd'])) {
    $cmd =$_POST['cmd'];
}
if ($cmd =="gravar"){
    gravar();
}
if ($cmd =="excluir"){
    excluir();
}


function gravar()
{
global $conex;
if (isset($_POST['id_acao'])) {$id_acao = $_POST['id_acao'];}
if (isset($_POST['nome'])) {$nome = $_POST['nome'];}
if (isset($_POST['data'])) {$data = $_POST['data'];}
if (isset($_POST['data_final'])) {$data_final = $_POST['data_final'];}
if (isset($_POST['status'])) {$status = $_POST['status'];}
if (isset($_POST['detalhes'])) {$detalhes = $_POST['detalhes'];}

$id_acao = $conex->mysqli->real_escape_string($id_acao);
$nome = $conex->mysqli->real_escape_string($nome);
$data = $conex->mysqli->real_escape_string($data);
$data_final = $conex->mysqli->real_escape_string($data_final);
$status = $conex->mysqli->real_escape_string($status);
$detalhes = $conex->mysqli->real_escape_string($detalhes);

if ($nome == ""){
        echo "msgdlg('error','nome','','','Campo obrigatório','Ops, você ainda não informou o Nome!');";
        exit;
        }

if ($data == ""){
        echo "msgdlg('error','data','','','Campo obrigatório','Ops, você ainda não informou a data de registro da ação!');";
        exit;
        }



        if ($data_final == ""){
            echo "msgdlg('error','data_final','','','Campo obrigatório','Ops, você ainda não informou a data limite de propagação da ação!');";
  exit;
 }

if ($status == ""){
        echo "msgdlg('error','status','','','Campo obrigatório','Ops, você ainda não informou o Status desta ação!');";
        exit;
        }




if ($_POST['id_acao'] ==""){

        $sql="Insert into ods_acoes (nome, data, data_final, status, detalhes, classificacao) values ('".$nome."', '".$data."', '".$data_final."', '".$status."', '".$detalhes."','3')";   
        mysqli_query($conex->mysqli,$sql);

        $sql2="select max(id_acao) as id_acao from ods_acoes";
        $result = mysqli_query($conex->mysqli,$sql2); 
        $dados = $result->fetch_assoc();
        $id_acao = $dados['id_acao'];
        
        $sql_str = $conex->mysqli->real_escape_string($sql);
         grava_log('Nova ação cadastrada', $sql_str, $id_acao, '' ); 



        echo "msgdlg('success','','','','Sucesso','Registro gravado!');";
        echo "document.getElementById('id_acao').value='".$id_acao."';";
    } else {

        $sql="Update ods_acoes set  nome = '".$nome."', data = '".$data."', data_final = '".$data_final."',  status = '".$status."', detalhes = '".$detalhes."' where id_acao='".$id_acao."'";
       if(mysqli_query($conex->mysqli,$sql)){
        

        $sql_str = $conex->mysqli->real_escape_string($sql);
        grava_log('Alteração no registro da ação', $sql_str, $id_acao, '0' ); 
        
        echo "msgdlg('success','','','','Sucesso','Ok! Os dados foram alterados!');";
       }
       else{
        echo "msgdlg('error','','','','Falha','".mysqli_error($conex->mysqli)."');"; 
       }
    }   

}     
        
        function excluir()
{
    global $conex;
    if($_SESSION['nivel'] < 3 ){
        echo "msgdlg('error','','','','Permissão negada','O seu nível de acesso não permite executar este procedimento.');";
        exit;
    } else {
    if (isset($_POST['id_acao'])) {
        $id_acao = $_POST['id_acao'];
    }   
        $sql="delete from ods_acoes where id_acao ='".$id_acao."'";
        mysqli_query($conex->mysqli,$sql);
        
        $sql_str = $conex->mysqli->real_escape_string($sql);
        grava_log('Exclusão de ação', $sql_str, $id_acao,'0' ); 

        echo "location.href='acoes_form.php';";
    }

}

function grava_log($desc, $script, $id_acao, $id_indicador){
    global $conex;
   $data = date('Y-m-d H:i:s');
   $id_usuario = $_SESSION['id_usuario'];
   if($id_indicador==''){$id_indicador='0';}
   $sql="Insert into ods_logs (id_usuario, data, descricao, script, id_acao, id_indicador) values ('".$id_usuario."', '".$data."', '".$desc."', '".$script."','".$id_acao."', '".$id_indicador."')";   
    mysqli_query($conex->mysqli,$sql);
    
   }



?>