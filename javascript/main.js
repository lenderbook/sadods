

function Close() {
        modal_loading('Aguarde, encerrando...');
        xmlhttp.open("POST", "ajax/sair.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=iso-8859-1");
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4) {         
        eval(xmlhttp.responseText);
}
};
xmlhttp.send(null);
}

function reload()
{
location.href='index.php';
}


function user_detail()
{
if (document.getElementById("notify-div").style.display=='block')
{document.getElementById("notify-div").style.display='none';}
else
{document.getElementById("notify-div").style.display='block'; }
}






function menu_mobile(){
	
	
	if (document.getElementById("left-menu-div").style.display == 'block')
{   



var y=250;								 
var menuintervalo2 = setInterval(function()
		
{
	document.getElementById("menu-vertical-div").style.display='none';
	
	if (y == 0) {clearInterval(menuintervalo2); document.getElementById("left-menu-div").style.display='none'; }
	else
	{
y= y-10;
document.getElementById("left-menu-div").style.width = y+"px";



	}
}

,10);


}

else

{

document.getElementById("left-menu-div").style.display='block';


var x=1;								 
var menuintervalo = setInterval(function()
	
{
	if (x > 250) {clearInterval(menuintervalo);document.getElementById("menu-vertical-div").style.display='block';}
	else
	{
x = x+10;

document.getElementById("left-menu-div").style.width = x+"px";


	}
	
	
}


,10);


}

	
	
}









function show_hide_menu()
{
	

if (document.getElementById("menu-vertical-div").style.display == 'none')
{   


var x=1;								 
var menuintervalo = setInterval(function()
	
{
	if (x > 250) {clearInterval(menuintervalo);document.getElementById("menu-vertical-div").style.display='block';}
	else
	{
x = x+10;

document.getElementById("left-menu-div").style.width = x+"px";


	}
	
	
}


,10);



}
else

{

document.getElementById("menu-vertical-div").style.display='none';

var y=250;								 
var menuintervalo2 = setInterval(function()
	
{
	if (y == 40) {clearInterval(menuintervalo2); }
	else
	{
y= y-10;
document.getElementById("left-menu-div").style.width = y+"px";



	}
}

,10);





}

}


function submenu(id){
	var menu = document.getElementById('submenu'+id);
	var sub = document.getElementById('sub'+id);
	if(menu.style.display=='block'){
menu.style.display='none';
sub.className='fa fa-chevron-right';

	}
	else
	{
		menu.style.display='block';
		sub.className='fa fa-chevron-down';
	}
	
	
	
}




