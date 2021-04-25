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
    if (isset($_POST['id_usuario'])) {$id_usuario = $_POST['id_usuario'];}
    if (isset($_POST['nome'])) {$nome = $_POST['nome'];}
    if (isset($_POST['email'])) {$email = $_POST['email'];}
    if (isset($_POST['usuario'])) {$usuario = $_POST['usuario'];}
    if (isset($_POST['senha'])) {$senha = $_POST['senha'];}
    if (isset($_POST['nivel'])) {$nivel = $_POST['nivel'];}
        if (isset($_POST['status'])) {$status = $_POST['status'];}

        $id_usuario = $conex->mysqli->real_escape_string($id_usuario);
        $nome = $conex->mysqli->real_escape_string($nome);
        $email = $conex->mysqli->real_escape_string($email);
        $usuario = $conex->mysqli->real_escape_string($usuario);
        $senha = $conex->mysqli->real_escape_string($senha);
        $nivel = $conex->mysqli->real_escape_string($nivel);
        $status = $conex->mysqli->real_escape_string($status);



    if ($nome == ""){
        echo "msgdlg('error','nome','','','Campo obrigatório','Ops, você ainda não informou o Nome!');";
        exit;
    }
   
 if ($email == ""){
        echo "msgdlg('error','email','','','Campo obrigatório','>Ops, você ainda não informou o E-mail!');";
        exit;
    }
    if ($usuario == ""){
        echo "msgdlg('error','usuario','','','Campo obrigatório','Ops, você ainda não informou o Usuario!');";
        exit;
    }
    
    if ($nivel == ""){
        echo "msgdlg('error','nivel','','','Campo obrigatório','Ops, você ainda não informou o Nível!');";
        exit;
    }
   
    if ($status == ""){
        echo "msgdlg('error','status','','','Campo obrigatório','Ops, você ainda não informou o Status!');";
        exit;
    }
    if ($_POST['id_usuario'] ==""){

        if ($senha == ""){
            echo "msgdlg('error','senha','','','Campo obrigatório','Ops, você ainda não informou o Senha!');";
            exit;
        }

        $sql="Insert into ods_usuarios ( nome, email, usuario, senha, nivel, status) values ( '".$nome."', '".$email."', '".$usuario."', SHA1('".$senha."'), '".$nivel."', '".$status."')";
        mysqli_query($conex->mysqli,$sql);

        $sql="select max(id_usuario) as id_usuario from ods_usuarios";
        $result = mysqli_query($conex->mysqli,$sql); 
        $dados = $result->fetch_assoc();
        $id_usuario = $dados['id_usuario'];
        
      

        echo "msgdlg('success','','','','Sucesso','Registro gravado!');";
        echo "document.getElementById('id_usuario').value='".$id_usuario."';";
    } else {
        
        if($senha==''){
        $sql="Update ods_usuarios set  nome= '".$nome."', email= '".$email."', usuario= '".$usuario."', nivel= '".$nivel."',  status= '".$status."' where id_usuario='".$id_usuario."'";
        }
        else{
        $sql="Update ods_usuarios set  nome= '".$nome."', email= '".$email."', usuario= '".$usuario."', senha= SHA1('".$senha."'), nivel= '".$nivel."',  status= '".$status."' where id_usuario='".$id_usuario."'";
        }
        mysqli_query($conex->mysqli,$sql); 
        echo "msgdlg('success','','','','Sucesso','Ok! Os dados foram alterados!');";
    }   

}


function excluir()
{
    global $conex;
    if($_SESSION['nivel'] < 3 ){
        echo "msgdlg('error','','','','Permissão negada','O seu nível de acesso não permite executar este procedimento.');";
        exit;
    } else {
    if (isset($_POST['id_usuario'])) { $id_usuario = $_POST['id_usuario']; }   

    $id_usuario = $conex->mysqli->real_escape_string($id_usuario);

        $sql="delete from ods_usuarios where id_usuario ='".$id_usuario."'";
        mysqli_query($conex->mysqli,$sql);  
        echo "location.href='usuarios_form.php';";
    }

}
?>

