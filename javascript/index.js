function saldo() {
    document.getElementById("saldo").innerHTML='consultando...';
    xmlhttp.open("POST", "ajax/saldo_cmd.php",true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
    xmlhttp.onreadystatechange = function() {
      if(xmlhttp.readyState == 4) { 
      //document.getElementById("page-response").innerHTML='';
    document.getElementById("saldo").innerHTML=xmlhttp.responseText;
     // eval(xmlhttp.responseText);
}
};
xmlhttp.send(null);
}

