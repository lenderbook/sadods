function gera_relatorio() {
      
data_inicial=document.getElementById("data_inicial").value;
data_final=document.getElementById("data_final").value;
status = document.getElementById('status').value;
location.href="relatorio3_rel.php?data_inicial="+data_inicial+"&data_final="+data_final+"&status="+status;

}



function excel(data_inicial, data_final, status) {
    
    location.href="relatorio3_excel.php?data_inicial="+data_inicial+"&data_final="+data_final+"&status="+status;
    
    }
    
    