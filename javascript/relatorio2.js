function gera_relatorio() {
      
data_inicial=document.getElementById("data_inicial").value;
data_final=document.getElementById("data_final").value;
location.href="relatorio2_rel.php?data_inicial="+data_inicial+"&data_final="+data_final;

}



function excel(data_inicial, data_final) {
    
    location.href="relatorio2_excel.php?data_inicial="+data_inicial+"&data_final="+data_final;
    
    }
    
    