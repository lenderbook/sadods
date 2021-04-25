

var Foco;
var Func;

function msgdlg(tipo, foco, func, retorno, titulo, texto)
{
if (document.getElementById("bgdlgboxdiv").style.display =='block')
{
document.getElementById("bgdlgboxdiv").style.display ='none';
document.getElementById("dlgboxdiv").style.display ='none';
document.getElementById("dlgboxtxtdiv").innerHTML='';
if (Foco !== ''){document.getElementById(Foco).focus();}

if (Func !== ''){ if(retorno == 1 ){	Func();	}	}

}
else
{
Foco = foco;
Func = func;

document.getElementById("bgdlgboxdiv").style.display ='block';
document.getElementById("dlgboxtitlediv").innerHTML=titulo;
document.getElementById("dlgboxtxtdiv").innerHTML=texto;
document.getElementById("dlgboxdiv").style.display ='block';

if (tipo == 'confirm')
{document.getElementById("dlgboxbtndiv").innerHTML="<input type='button' class='button-default' value='  Cancelar  ' onClick=msgdlg('','','','','','')>  <input type='button' class='button-confirm' value=' Confirma ' onClick=msgdlg('confirm','','','1','','')> ";}
else
{document.getElementById("dlgboxbtndiv").innerHTML="<input type='button' class='button-"+tipo+"' value='    OK    ' onClick=msgdlg('','','','','','','')> ";}

}
}

function modal_loading(text)
{
document.getElementById("modal-loading").classList.remove('fadeOut');	
document.getElementById("bgalldiv").style.display='block';
document.getElementById("modal-loading").style.display ='block';
document.getElementById("modal-loading").classList.add('animated');
document.getElementById("modal-loading").classList.add('fadeInDown');
document.getElementById("modal-loading").innerHTML='<p><div class="loader-middle margin-auto"></div></p><p>'+text+'</p>'; 
}

function modal_loading_off()
{

document.getElementById("bgalldiv").style.display='none';
document.getElementById("modal-loading").style.display='none';

}







function progress_bar_running(id,label, time){
	var i = 1;
	var progressbar_interval;
	
	progressbar_interval =  setInterval(function () {
		                
      i++;                     
      if (i < 101) { progress_bar(id,i,label);} else {clearInterval(progressbar_interval);}                        
   }, time);

}





function progress_bar(id, percentual, label){
percentual = parseInt(percentual);
document.getElementById(id).style.width = percentual+'%' ;

if (label=='1'){
document.getElementById(id).innerHTML=percentual +'%';
}


	
}





function panel(id, he, wi)
{

if(document.getElementById(id).style.display =='block')
{
document.getElementById("bgalldiv").style.display='none';
document.getElementById(id).style.display ='none';

}
else
{
var width = document.body.offsetWidth;
var height = document.body.offsetHeight;

if (width < wi){wi = eval(width - 30); he = eval(height - 30); document.getElementById(id).style.marginTop = '-'+eval(he / 2)+ 'px'; }
else
{
	document.getElementById(id).style.marginTop = '-'+eval(he / 2)+ 'px';
	document.getElementById(id).style.minHeight = he +'px';
}	
	
document.getElementById("bgalldiv").style.display='block';

document.getElementById(id).style.width = wi + 'px';
document.getElementById(id).style.marginLeft = '-'+eval(wi / 2) +'px';
document.getElementById(id).style.marginTop = '-'+eval(he / 2)+ 'px';
document.getElementById(id).style.display ='block';
}
}


function trmouseover(linha)
{linha.className='table-default-tr-mouseover';}
function trmouseout(linha)
{linha.className='table-default-tr-mouse-out';}



function leftmenulighton(linha)
{linha.className='highlightmenuon';}
function leftmenulightoff(linha)
{linha.className='highlightmenuoff';}




function showtab(tab_title, tab){
      
var d = document.getElementById('tab-title').getElementsByTagName('div');
 
    for(var i = 0; i<d.length;i++){ 
            
            document.getElementById(d[i].getAttribute("data-fwmx")).classList.remove('tab_on');
            document.getElementById(d[i].getAttribute("data-fwmx")).classList.add('tab_off');
            
                    }
    
    var d = document.getElementById('tab-content').getElementsByTagName('div');
        for(var i = 0; i<d.length;i++){ 
            
            if (d[i].getAttribute('data-fwmx')){
            document.getElementById(d[i].getAttribute("data-fwmx")).classList.add('hidden');
        }
        }  

document.getElementById(tab).classList.remove('hidden');
document.getElementById(tab_title.id).classList.add('tab_on');

	
	
}

function showtab2(tab_title, tab){
      
var d = document.getElementById('tab-title-tributacao').getElementsByTagName('div');
 
    for(var i = 0; i<d.length;i++){ 
            
            document.getElementById(d[i].getAttribute("data-fwmx")).classList.remove('tab_on');
            document.getElementById(d[i].getAttribute("data-fwmx")).classList.add('tab_off');
            
                    }
    
    var d = document.getElementById('tab-content2').getElementsByTagName('div');
        for(var i = 0; i<d.length;i++){ 
            
            if (d[i].getAttribute('data-fwmx')){
            document.getElementById(d[i].getAttribute("data-fwmx")).classList.add('hidden');
        }
        }  

document.getElementById(tab).classList.remove('hidden');
document.getElementById(tab_title.id).classList.add('tab_on');

	
	}