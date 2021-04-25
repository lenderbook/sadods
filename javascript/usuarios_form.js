function salva() {
        document.getElementById("page-response").innerHTML='<div class="loader-middle"></div>';
        xmlhttp.open("POST", "ajax/usuarios_cmd.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) { 
          document.getElementById("page-response").innerHTML='';
       // document.getElementById("page-response").innerHTML=xmlhttp.responseText;
                   eval(xmlhttp.responseText);
}
};
 campos ="cmd="+escape('gravar');
 campos =campos+"&id_usuario="+escape(document.getElementById("id_usuario").value);
 campos =campos+"&nome="+escape(document.getElementById("nome").value);
 campos =campos+"&email="+escape(document.getElementById("email").value);
 campos =campos+"&usuario="+escape(document.getElementById("usuario").value);
 campos =campos+"&senha="+escape(document.getElementById("senha").value);
 campos =campos+"&nivel="+escape(document.getElementById("nivel").value);
  campos =campos+"&status="+escape(document.getElementById("status").value);
xmlhttp.send(campos);
}


function excluir()
{
id_usuario=document.getElementById("id_usuario").value;
if (id_usuario =="") {msgdlg('error','','','','Falha de exclusão','<b><i>Não foi possível excluir.<br>É necessário um registro aberto ou salvo.</i></b>');}
else
{

        document.getElementById("page-response").innerHTML='<div class="loader-middle"></div>';

        xmlhttp.open("POST", "ajax/usuarios_cmd.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) {
          document.getElementById("page-response").innerHTML='';
        //document.getElementById("page-response").innerHTML=xmlhttp.responseText;
                   eval(xmlhttp.responseText);
}
};
 campos ="cmd="+escape('excluir');
 campos =campos+"&id_usuario="+escape(id_usuario);
       xmlhttp.send(campos);
}
}



