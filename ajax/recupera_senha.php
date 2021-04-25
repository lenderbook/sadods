<?php
header ('Content-type: text/html; charset=iso-8859-1');

?>



<div id="RecuperaSenhaDiv">
<p class="title-one">Recuperar senha</p>
<p>Informe seu endereço de e-mail cadastrado.</p>
<input type="text" name="email" id="email" class="input-default input-autosize indented" value=""  placeholder="Digite seu E-mail">
<p class="ralign"><input type="button" name="Cancelar" value="Cancelar" onClick="panel('painel1')" class="button-default"> <input type="button" name="Continuar" value="Continuar" onClick="Recupera()" class="button-main"></p>


<div id="retorno-div"></div>
</div>






