let id_indicador_temp ='';

function salva() {
    document.getElementById("page-response").innerHTML='<div class="loader-middle"></div>';
    xmlhttp.open("POST", "ajax/acoes_cmd.php",true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
    xmlhttp.onreadystatechange = function() {
      if(xmlhttp.readyState == 4) { 
      document.getElementById("page-response").innerHTML='';
   // document.getElementById("page-response").innerHTML=xmlhttp.responseText;
               eval(xmlhttp.responseText);
}
};
campos ="cmd="+escape('gravar');
campos = campos+"&id_acao="+escape(document.getElementById("id_acao").value);
campos = campos+"&nome="+escape(document.getElementById("nome").value);
campos = campos+"&data="+escape(document.getElementById("data").value);
campos = campos+"&data_final="+escape(document.getElementById("data_final").value);
campos = campos+"&status="+escape(document.getElementById("status").value);
campos = campos+"&detalhes="+escape(document.getElementById("detalhes").value);
xmlhttp.send(campos);
}

function excluir()
{
id_acao = document.getElementById("id_acao").value;
if (id_acao =="") {msgdlg('error','','','','Falha de exclusão','Não foi possível excluir.<br>É necessário um registro aberto ou salvo.');}
else
{
document.getElementById("page-response").innerHTML='<div class="loader-middle"></div>';
        xmlhttp.open("POST", "ajax/acoes_cmd.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) {
          document.getElementById("page-response").innerHTML='';
        //document.getElementById("page-response").innerHTML=xmlhttp.responseText;
                   eval(xmlhttp.responseText);
}
};
 campos ="cmd="+escape('excluir');
 campos =campos+"&id_acao="+escape(id_acao);
       xmlhttp.send(campos);
}
}


  
function pesquisar(){
    
  pesquisa = document.getElementById("pesquisa").value;
  
  if(pesquisa !=''){
      location.href='acoes_rel_pesquisa.php?pesquisa='+pesquisa;
  }
  else
  {
      document.getElementById("pesquisa").focus();
  }
  
}



document.getElementById("btn-adiciona-indicador").addEventListener("click", indicador_form);
document.getElementById("btn-salvar").addEventListener("click", indicador_salvar);
document.getElementById("btn-fechar").addEventListener("click", indicador_fechar);
document.getElementById("btn-novo").addEventListener("click", limpa);


function indicador_form(){
id_acao = document.getElementById('id_acao').value;

if(id_acao==''){
  msgdlg('error','', '','','Informação','É necessário salvar uma ação ou abrir uma ação gravada para adicionar um indicador.') ; 

}else{
panel('painel-indicador',540,750);
limpa();
}
}


function indicador_salvar(){

  document.getElementById("painel-resultado").innerHTML='<div class="loader-middle"></div>';
  xmlhttp.open("POST", "ajax/indicadores_cmd.php",true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) { 
    document.getElementById("painel-resultado").innerHTML='';
 // document.getElementById("page-response").innerHTML=xmlhttp.responseText;
             eval(xmlhttp.responseText);
}
};
campos ="cmd="+escape('gravar');
campos = campos+"&id_acao="+escape(document.getElementById("id_acao").value);
campos = campos+"&id_indicador="+escape(document.getElementById("id_indicador").value);
campos = campos+"&nome_indicador="+escape(document.getElementById("nome_indicador").value);
campos = campos+"&descricao="+escape(document.getElementById("descricao").value);
campos = campos+"&meta_comparativa="+escape(document.getElementById("meta_comparativa").value);
campos = campos+"&unidade_contagem="+escape(document.getElementById("unidade_contagem").value);
campos = campos+"&valor_referencia="+escape(document.getElementById("valor_referencia").value);
campos = campos+"&resultado="+escape(document.getElementById("resultado").value);
xmlhttp.send(campos);  
  
}



function indicador_fechar(){
  panel('painel-indicador');
  limpa();
  atualiza();
}




function atualiza(){

  document.getElementById("table-indicadores").innerHTML='<div class="loader-middle"></div>';
  xmlhttp.open("POST", "ajax/lista_indicadores_cmd.php",true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) { 
    //document.getElementById("painel-resultado").innerHTML='';
  document.getElementById("table-indicadores").innerHTML=xmlhttp.responseText;
             //eval(xmlhttp.responseText);
}
};
campos = "id_acao="+escape(document.getElementById("id_acao").value);
xmlhttp.send(campos);  

}


function limpa(){
  document.getElementById('id_indicador').value='';
  document.getElementById('nome_indicador').value='';
  document.getElementById('descricao').value='';
  document.getElementById('meta_comparativa').value='';
  document.getElementById('unidade_contagem').value='';
  document.getElementById('valor_referencia').value='';
  document.getElementById('resultado').value='';
  document.getElementById('painel-resultado').className='';
  document.getElementById('painel-resultado').innerHTML='';
}


function indicador_editar(id){

  panel('painel-indicador',540,750);

  

  document.getElementById("page-response").innerHTML='<div class="loader-middle"></div>';
  xmlhttp.open("POST", "ajax/editar_indicadores_cmd.php",true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) { 
   document.getElementById("page-response").innerHTML='';
  //document.getElementById("page-response").innerHTML=xmlhttp.responseText;
             eval(xmlhttp.responseText);
}
};
campos = "id_indicador="+escape(id);
xmlhttp.send(campos);  


}


function indicador_excluir(id){

  id_indicador_temp = id;
  msgdlg('confirm','', remove_indicador ,'','Confirmação','Confirma excluir este indicador de sustentabilidade?') ; 

}

function remove_indicador(){

  document.getElementById("page-response").innerHTML='<div class="loader-middle"></div>';
  xmlhttp.open("POST", "ajax/indicadores_cmd.php",true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState == 4) { 
   document.getElementById("page-response").innerHTML='';
  eval(xmlhttp.responseText);
}
};
campos = "cmd="+escape('excluir');
campos = campos+"&id_indicador="+escape(id_indicador_temp);
campos = campos+"&id_acao="+escape(document.getElementById('id_acao').value);
xmlhttp.send(campos);


}
