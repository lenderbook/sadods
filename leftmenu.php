


<div id="left-menu-div" class="left-menu">

<div id="icon-menu-div"> <a href="javascript:;" onClick="show_hide_menu()"> <i class="fa fa-bars"></i> </a></div>

<div id="menu-vertical-div" class="animated fadeIn">
<ul>

	
<a href="index.php"><li onMouseOver="leftmenulighton(this);" <?php if ($page_session =='index'){?>class="highlightmenuon"<?php } else{?> onMouseOut="leftmenulightoff(this)"<?php }?> ><i class="fa fa-home fa-fw"></i>   Home</li> </a>


<a href="acoes_rel.php"><li onMouseOver="leftmenulighton(this);" <?php if ($page_session =='acoes'){?>class="highlightmenuon"<?php } else{?> onMouseOut="leftmenulightoff(this)"<?php }?>>Cadastro de ações</li> </a>

<a href="acoes_pesquisa.php"><li onMouseOver="leftmenulighton(this);" <?php if ($page_session =='pesquisa'){?>class="highlightmenuon"<?php } else{?> onMouseOut="leftmenulightoff(this)"<?php }?>>Pesquisa </li> </a>

<a href="relatorios_rel.php"><li onMouseOver="leftmenulighton(this);" <?php if ($page_session =='relatorios'){?>class="highlightmenuon"<?php } else{?> onMouseOut="leftmenulightoff(this)"<?php }?>>Relatórios</li> </a>


<a href="javascript:;" onclick="submenu('1')"><li onMouseOver="leftmenulighton(this);" <?php if ($page_session =='submenu'){?>class="highlightmenuon"<?php } else{?> onMouseOut="leftmenulightoff(this)"<?php }?>> <span class="<?php if($submenu_item=='2'){?>fa fa-chevron-down<?php }else {?>  fa fa-chevron-right<?php }?>" id="sub2"></span> Configurações  </li>  </a>

<ul <?php if($submenu_item=='1'){?> <?php }else {?>  class="submenu" <?php }?> id="submenu1">
<a href="usuarios_rel.php"><li onMouseOver="leftmenulighton(this);" <?php if ($page_session =='usuarios'){?>class="highlightmenuon"<?php } else{?> onMouseOut="leftmenulightoff(this)"<?php }?>>- Operadores</li> </a>

</ul>


<a href="javascript:;" onClick="Close()"><li onMouseOver="leftmenulighton(this);" onMouseOut="leftmenulightoff(this)"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Sair</li></a>


</ul>
</div>
</div>

