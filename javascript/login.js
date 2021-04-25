function autentica() {
                  
        xmlhttp.open("POST", "ajax/autentica.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) {
          retorno=xmlhttp.responseText;
           if(retorno==1)
          {

modal_loading('Usuário autenticado. Acessando sistema..');
		  setTimeout('redirecionamento()',1300);
		  
                    }
          else
          {
           modal_loading_off();
		   
		  
		  
           document.getElementById("response-div").classList.add('warning-error');
           document.getElementById("response-div").innerHTML='Login ou senha inválidos!';
		   //document.getElementById("response-div").innerHTML=retorno;
           
          

          } 
         
            }
           };
 campos ="login="+escape(document.getElementById("login").value);
 campos =campos+"&senha="+escape(document.getElementById("senha").value);
if (document.getElementById("Lembrar").checked==true)
{
 campos =campos+"&lembralogin="+escape("sim");
} else { 
 campos =campos+"&lembralogin="+escape("nao");
}

   xmlhttp.send(campos);
}


function logar()
{

document.getElementById("bgalldiv").style.display='block';
modal_loading('Autenticando usuario...');
setTimeout('autentica()',1000);
}



function redirecionamento()
{
location.href="index.php";
}

function RecuperaSenha() {
	
	panel('painel1',280,450);
    document.getElementById("response-div").innerHTML='<div class="loader-middle"></div>';
        xmlhttp.open("POST", "ajax/recupera_senha.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) {         
          document.getElementById("response-div").innerHTML='';
        document.getElementById("painel1").innerHTML=xmlhttp.responseText;
                   
}
};

xmlhttp.send(null);
	

}


function Recupera() {
         
         document.getElementById("retorno-div").className='';
         document.getElementById("retorno-div").innerHTML='<div class="loader-middle"></div>';         
        xmlhttp.open("POST", "ajax/recupera_senha_cmd.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) {
          retorno=xmlhttp.responseText;
  		   //document.getElementById("painel1").innerHTML=retorno;
           eval(retorno);         

            }
           };
 campos ="email="+escape(document.getElementById("email").value);
  xmlhttp.send(campos);
}





