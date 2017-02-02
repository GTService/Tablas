//////////////generales//////////////////
$( document ).ready(function() 
{
    switch(sessionStorage.ActiveTab){
        case "0": $('#navUsuarios').addClass('active')
        break;
        case "1": $('#navArchivos').addClass('active')
        break;
        case "2": $('#navConf').addClass('active')
        break;
    }
   $('#navUsuarios').attr('onClick','sessionStorage.ActiveTab = 0');
   $('#navArchivos').attr('onClick','sessionStorage.ActiveTab = 1');
   $('#navConf').attr('onClick','sessionStorage.ActiveTab = 2');
    $('.table').dataTable();
});  
function cerrar_sesion()
{
    $.ajax({
        url:"ajax/cerrar_sesion.php",
        type:"POST",
        success:function(respuesta)
        {
            var mensaje=JSON.parse(respuesta);
            pnotify_creador("Adios",mensaje.body, mensaje.header);
        }
    });
    window.location.replace("login.php");
    
}
function limpiar_form(form)
{
    $('#'+form)[0].reset();
}
function abrir_modal(modal)
{
    $('#'+modal).modal({
      backdrop: 'static',
      keyboard: false
    });
}
function descargar(documento,usuario)
{
    document.location.href="ajax/archivos/descargar_documento.php?file_name="+documento+"&usuario="+usuario;
}
function pnotify_creador( title, text, type )
{
    new PNotify({
        title: title,
        text: text,
        type: type
    });
}
