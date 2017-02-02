var archivo=""; 
$( document ).ready(function() 
{
        $("#file_upload").uploadify({
        'uploader'       : 'js/uploadify/uploadify.swf',
        'script'         : 'js/uploadify/uploadify.php',
        'cancelImg'      : 'js/uploadify/cancel.png',
        'folder'         : 'archivos',
        'auto'           : false,
        'method'         : 'POST',
            'btnClass':'col-md-4',
        'onSelect'       : function(event, ID, fileObj, data, remove, clearFast)
        {
            archivo=fileObj;
        },
        'onCancel' : function(event, ID, fileObj, data, remove, clearFast)
         {
            archivo="";
         },
        'onComplete' : function(event, queueID, fileObj, response, data) 
        {
            archivo="";
        }
    });
});

function subir_archivo()
{
    if(archivo!="")
    {
        var f=$("#subir_archivo").serialize()+"&nombre="+archivo.name;
        $.ajax({
            type:"post",
            url:"ajax/archivos/agregar_archivo_a_bd.php",
            data:f,
            success:function(respuesta)
            {
                var mensaje=JSON.parse(respuesta);
                if(mensaje.header=="error")
                {
                    pnotify_creador("Vuelve a intentar",mensaje.body, mensaje.header);
                    $('#file_upload').uploadifyClearQueue($(this).attr('id'));
                }
                else if(mensaje.header=="success")
                {
                    $('#file_upload').uploadifyUpload();
                    pnotify_creador("archivo almacenado",mensaje.body, mensaje.header);
                    $("#tabla").html(mensaje.content);
                    $('#file_upload').uploadifyClearQueue($(this).attr('id'));
                    $("#modal_nuevo_archivo").modal('toggle');
                    $('.table').DataTable();
                }
            }
        });
    }
    else
    {
        $.notify("debe elegir un archivo a subir","error");
    }
    
}
function cancelar_archivo()
{
    $("#modal_nuevo_archivo").modal('toggle');
}
function eliminar_archivo(tabla,id)
{
    $.ajax({
        url:"ajax/archivos/eliminar_archivo.php",
        type:"POST",
        data:{"tabla" : tabla,"id" : id},
        success:function(respuesta)
        {
            var mensaje=JSON.parse(respuesta);
            pnotify_creador("archivo eliminado",mensaje.body, mensaje.header);
            $("#tabla").html(mensaje.content);
            $('.table').DataTable();
        }
    });
}