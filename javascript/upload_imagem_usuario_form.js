
function salva(e) 
{
e.preventDefault();
document.getElementById('progress1').classList.remove('hidden');




var files = document.getElementById('file1').files;
var formData = new FormData();


// Loop through each of the selected files.
for (var i = 0; i < files.length; i++) {
  var file = files[i];
formData.append('file1', file, file.name);
}

var xhr = new XMLHttpRequest();


xhr.upload.addEventListener('progress', function(e){progress_bar('progressbar1', ((e.loaded / e.total) *100), 1); } );

//xhr.upload.addEventListener('load', function(e){alert('tranferencia ok'); } );
//xhr.upload.addEventListener('error', function(e){alert('falha na transferencia'); } );
//xhr.upload.addEventListener('abort', function(e){alert('transferencia cancelada'); } );


xhr.onload = function () 
{

if (xhr.status === 200) 
{
document.getElementById('page-response').innerHTML='';
//document.getElementById('ResponseCDiv').innerHTML = xhr.responseText; 
eval(xhr.responseText);
} 
};



xhr.open('POST', 'ajax/upload_imagem_usuario_cmd.php', true);
xhr.send(formData);

}



