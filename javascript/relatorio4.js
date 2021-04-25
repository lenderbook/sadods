function gera_relatorio() {
      
data_inicial=document.getElementById("data_inicial").value;
data_final=document.getElementById("data_final").value;
id_acao = document.getElementById('id_acao').value;
location.href="relatorio4_rel.php?data_inicial="+data_inicial+"&data_final="+data_final+"&id_acao="+id_acao;

}



function excel(data_inicial, data_final, id_acao) {
    
    location.href="relatorio4_excel.php?data_inicial="+data_inicial+"&data_final="+data_final+"&id_acao="+id_acao;
    
    }
    
    