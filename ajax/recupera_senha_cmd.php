<?php
header ('Content-type: text/html; charset=iso-8859-1');
include '../database-class.php';
include 'gera_senha.php';



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';



if (isset($_POST['email'])) {$email = addslashes($_POST['email']);}

if ($email=="")
{
echo 'document.getElementById("email").focus();';
echo 'document.getElementById("retorno-div").classList.add("warning-information");';
echo 'document.getElementById("retorno-div").innerHTML="Digite um endereço de e-mail.";';

exit;
}


$sql="select id_usuario, email, nome from ods_usuarios where email = '".$email."'";
$result = mysqli_query($conex->mysqli,$sql);
$total_registros = mysqli_num_rows($result); 

if($total_registros > 0 )
{

$dados = $result->fetch_assoc();
$id_usuario = $dados['id_usuario'];
$nome = $dados['nome'];
$senha= geraSenha(6, false, true, false);

$sql="update ods_usuarios set  senha =SHA1('".$senha."') where id_usuario ='".$id_usuario."'";
mysqli_query($conex->mysqli,$sql);


$texto ="<p>Olá ".$nome.".</p><p>Foi gerada uma nova senha de acesso. Você poderá alterá-la na tela de usuários do sistema.</p><p>Senha:<b> ".$senha."</b></p><p>Atenciosamente.; <br>SADODS </p>";
$texto_rodape="SADODS - lenderbook.com/corporate";
$destinatario =$email;
$destinatario_nome =htmlentities($nome);
$assunto = "Recuperação de senha";


$MensagemHTML="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"padding: 20px 0 30px 0;\">";
$MensagemHTML .= "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse; border: 1px solid #D4D0D0;\">";
$MensagemHTML .= "<tr>  <td align=\"center\"  bgcolor=\"#4798DA\" style=\"padding: 40px 0 30px 0;\">  <img src=\"".URL."/contents/logomarca.jpg\" />  </td> </tr>";
$MensagemHTML .= " <tr>  <td bgcolor=\"#ffffff\" style=\"padding: 40px 30px 40px 30px; color: #666666; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; \" >";
$MensagemHTML .= $texto;
$MensagemHTML .=" </td></tr>";
$MensagemHTML .="<tr> <td bgcolor=\"#5C5C5F\" style=\"padding: 30px 30px 30px 30px; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px; text-align: center; color:#FFFFFF\">";
$MensagemHTML .= $texto_rodape;
$MensagemHTML .="</td></tr></table> </td></tr></table>";


$mail = new PHPMailer(true); 

try {
    //Server settings
$mail->SMTPDebug = 0;   //2 para ver logs e 0 desliga 
$mail->IsSMTP(); 
$mail->Host = SMTP_HOST;
$mail->SMTPAuth = true;                              
$mail->Username = SMTP_USERNAME;
$mail->Password = SMTP_PSW;  
$mail->Port = SMTP_PORT;                                   
$mail->SMTPSecure = SMTP_SECURE; 
$mail->From = SMTP_FROM; 
$mail->FromName = SMTP_FROMNAME;

$mail->AddReplyTo(SMTP_REPLAY, SMTP_FROMNAME);
$mail->AddAddress($destinatario, $destinatario_nome);
$mail->IsHTML(true); 
$mail->CharSet = 'iso-8859-1'; 
$mail->Encoding="base64";
$mail->Subject  = $assunto;
$mail->Body = $MensagemHTML;
$enviado = $mail->Send();
$mail->ClearAllRecipients();
$mail->ClearAttachments();

echo 'document.getElementById("retorno-div").classList.add("warning-success");';	
echo 'document.getElementById("retorno-div").innerHTML="Nova senha gerada e enviada ao endereço de e-mail cadastrado.";';
echo "setTimeout(function(){ panel('painel1','',''); }, 3000);";
 
} catch (Exception $e) {

    echo 'document.getElementById("retorno-div").classList.add("warning-error");';
    echo 'document.getElementById("retorno-div").innerHTML="Erro: '.$mail->ErrorInfo.';";';
      

}





}
else
{
	
echo 'document.getElementById("retorno-div").classList.add("warning-error");';
echo 'document.getElementById("retorno-div").innerHTML="Endereço de e-mail não localizado.";';

exit;
}






?>