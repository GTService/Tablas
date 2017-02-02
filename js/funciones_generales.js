//////////////generales//////////////////
$( document ).ready(function() 
{
    $('.table').dataTable();
    $('#DataTables_Table_0_filter:first-child').addClass( "pull-right" );

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
function activeTabChoose(id){
    
    switch(id){
        case 0: $('#navUsuarios').addClass('active')
        break;
        case 1: $('#navArchivos').addClass('active')
        break;
        case 2: $('#navConf').addClass('active')
        break;
    }
}
