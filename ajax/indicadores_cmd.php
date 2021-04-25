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
    
    echo "document.getElementById('painel-resultado').className='warning-error';";
    echo "document.getElementById('painel-resultado').innerHTML='Falha de permissão';";
    
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
if (isset($_POST['id_indicador'])) {$id_indicador = $_POST['id_indicador'];}
if (isset($_POST['nome_indicador'])) {$nome_indicador = $_POST['nome_indicador'];}
if (isset($_POST['descricao'])) {$descricao = $_POST['descricao'];}
if (isset($_POST['meta_comparativa'])) {$meta_comparativa = $_POST['meta_comparativa'];}
if (isset($_POST['unidade_contagem'])) {$unidade_contagem = $_POST['unidade_contagem'];}
if (isset($_POST['valor_referencia'])) {$valor_referencia = $_POST['valor_referencia'];}
if (isset($_POST['resultado'])) {$resultado = $_POST['resultado'];}

$id_acao = $conex->mysqli->real_escape_string($id_acao);
$id_indicador = $conex->mysqli->real_escape_string($id_indicador);
$nome_indicador = $conex->mysqli->real_escape_string($nome_indicador);
$descricao = $conex->mysqli->real_escape_string($descricao);
$meta_comparativa = $conex->mysqli->real_escape_string($meta_comparativa);
$unidade_contagem = $conex->mysqli->real_escape_string($unidade_contagem);
$valor_referencia = $conex->mysqli->real_escape_string($valor_referencia);
$resultado = $conex->mysqli->real_escape_string($resultado);

$data = date('Y-m-d H:i:s');


if ($nome_indicador == ""){
        echo "document.getElementById('painel-resultado').className='warning-error';";
        echo "document.getElementById('painel-resultado').innerHTML='Ops, você ainda não informou um nome para o indicador!';";
        exit;
        }

if ($meta_comparativa == ""){
        
        echo "document.getElementById('painel-resultado').className='warning-error';";
        echo "document.getElementById('painel-resultado').innerHTML='Selecione uma meta comparativa';";
        exit;
        }

if ($unidade_contagem == ""){
    echo "document.getElementById('painel-resultado').className='warning-error';";
    echo "document.getElementById('painel-resultado').innerHTML='Selecione a unidade de contagem';";
            exit;
        }

if ($valor_referencia == ""){
    echo "document.getElementById('painel-resultado').className='warning-error';";
    echo "document.getElementById('painel-resultado').innerHTML='Informe o valor de referência';";
            exit;
        }

if ($resultado == ""){ $resultado ='0';}
  



if ($_POST['id_indicador'] ==""){

        $sql="Insert into ods_indicadores (id_acao, nome_indicador, descricao, meta_comparativa, unidade_contagem, valor_referencia, resultado, data_registro) values  ('".$id_acao."', '".$nome_indicador."', '".$descricao."', '".$meta_comparativa."', '".$unidade_contagem."','".$valor_referencia."', '".$resultado."','".$data."')";   
                
        if(mysqli_query($conex->mysqli,$sql)){

         
        $sql2="select max(id_indicador) as id_indicador from ods_indicadores where id_acao ='".$id_acao."'";
        $result = mysqli_query($conex->mysqli,$sql2); 
        $dados = $result->fetch_assoc();
        $id_indicador = $dados['id_indicador'];

//Gravar historico de resultados            
$sql_historico="insert into ods_indicadores_historico (id_acao, id_indicador, data, resultado) values('".$id_acao."', '".$id_indicador."', '".$data."', '".$resultado."')";
mysqli_query($conex->mysqli,$sql_historico); 


//gravar log
        $sql_str = $conex->mysqli->real_escape_string($sql);
        grava_log('Novo indicador cadastrado', $sql_str, $id_acao, $id_indicador ); 

        classificar($id_acao);

        
        
        echo "document.getElementById('painel-resultado').className='warning-success';";
        echo "document.getElementById('painel-resultado').innerHTML='Novo indicador adicionado com sucesso!';";
        echo "document.getElementById('id_indicador').value='".$id_indicador."';";
        }
        else{
            echo "document.getElementById('painel-resultado').className='warning-error';";
            echo "document.getElementById('painel-resultado').innerHTML='Erro: '".mysqli_error($conex->mysqli)."'';";             
        }
    } 
    
    
    
    else {

        $sql="Update ods_indicadores set  nome_indicador = '".$nome_indicador."', descricao = '".$descricao."', meta_comparativa = '".$meta_comparativa."',  unidade_contagem = '".$unidade_contagem."', valor_referencia = '".$valor_referencia."', resultado ='".$resultado."', data_resultado ='".$data."' where id_indicador='".$id_indicador."'";
       if(mysqli_query($conex->mysqli,$sql)){
        classificar($id_acao); 

        //gravar log
        $sql_str = $conex->mysqli->real_escape_string($sql);
        grava_log('Registro de indicador alterado', $sql_str, $id_acao, $id_indicador ); 

        //Gravar historico de resultados            
$sql_historico="insert into ods_indicadores_historico (id_acao, id_indicador, data, resultado) values('".$id_acao."', '".$id_indicador."', '".$data."', '".$resultado."')";
mysqli_query($conex->mysqli,$sql_historico); 


        echo "document.getElementById('painel-resultado').className='warning-success';";
        echo "document.getElementById('painel-resultado').innerHTML='Indicador alterado com sucesso!';";
        
       }
       else{
        echo "document.getElementById('painel-resultado').className='warning-error';";
        echo "document.getElementById('painel-resultado').innerHTML='Erro: '".mysqli_error($conex->mysqli)."'';"; 
       }
    }   

}     
        
        function excluir()
{
    global $conex;
    if($_SESSION['nivel'] < 3 ){
        
        echo "document.getElementById('painel-resultado').className='warning-error';";
        echo "document.getElementById('painel-resultado').innerHTML='Falha de permissão';";
        
        exit;
    } else {
    if (isset($_POST['id_indicador'])) { $id_indicador = $_POST['id_indicador'];    }   
    if (isset($_POST['id_acao'])) { $id_acao = $_POST['id_acao'];    }   

       
        $sql="delete from ods_indicadores where id_indicador ='".$id_indicador."'";
        mysqli_query($conex->mysqli,$sql);

        
        $sql_str = $conex->mysqli->real_escape_string($sql);
        grava_log('Exclusão de indicador', $sql_str, $id_acao, $id_indicador ); 


        classificar($id_acao);
        echo "atualiza();";
    }

}




function classificar($id_acao)
{
global $conex;

//Listar indicadores

$sql="select * from ods_indicadores where id_acao ='".$id_acao."'";
$result = mysqli_query($conex->mysqli,$sql); 

$nao_sustentavel =0; //contador de indicadores não sustentáveis

while($dados = $result->fetch_assoc()){

$id_indicador = $dados['id_indicador'];
$meta_comparativa = $dados['meta_comparativa'];
$valor_referencia = $dados['valor_referencia'];
$resultado = $dados['resultado'];
$status ='0';

if($meta_comparativa=='='){if($resultado == $valor_referencia){$status ='1';}}
if($meta_comparativa=='>'){if($resultado > $valor_referencia){$status ='1';}}
if($meta_comparativa=='<'){if($resultado < $valor_referencia){$status ='1';}}
if($meta_comparativa=='=>'){if($resultado >= $valor_referencia){$status ='1';}}
if($meta_comparativa=='=<'){if($resultado <= $valor_referencia){$status ='1';}}

$sql_update_indicador="update ods_indicadores set status ='".$status."' where id_indicador ='".$id_indicador."'";
mysqli_query($conex->mysqli,$sql_update_indicador); 


if($status=='0'){$nao_sustentavel = $nao_sustentavel+1;}

}


//classificar ação - se todos indicadores forem sustentaveis ação será 1 (sustentavel), se  houve um item não sustentavel açao será 2 amarela, 
//se houver mais de 01 indicador não sustentável ação será 3 não sustentavel


//Todos os indicadores são sustentávei logo ação é sustentável também classificacao 1
if($nao_sustentavel==0){ $classificacao ='1';}
if($nao_sustentavel==1){ $classificacao ='2';}
if($nao_sustentavel >1){ $classificacao ='3';}

$sql_update_acao="update ods_acoes set classificacao ='".$classificacao."' where id_acao ='".$id_acao."'";
mysqli_query($conex->mysqli,$sql_update_acao); 


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