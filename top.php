
<div class="content top">

<div class="top-item1"><img src="contents/<?php echo $_SESSION['logomarca_small']?>"></div>


<div class="top-item2" > 
	
<div id="notify-div" class="animated fadeIn">
	
	<?php echo $email_user?> <br>
Seu último acesso foi em <?php echo $ultimo_acesso_user?><br>
<br><br>
	<input type="button" value=" Fechar " onClick="user_detail()" class="button-default"> 
	<input type="button" value=" Sair " onClick="Close()" class="button-main"></div>
	
 <img src="contents/user.png" width="50px" height="50px" class="userimg" name="userimg" id="userimg"> <?php echo $nome_user ?> &nbsp; <span class="fa fa-chevron-down hand"  onClick="user_detail()"></span>
	
	</div>



<div class="top-item3" > <a href="javascript:;" onClick="menu_mobile()"><i class="fa fa-bars"></i></a></div>


</div>
