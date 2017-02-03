$( document ).ready(function() 
{
    $('.icheckRadio').iCheck({
        checkboxClass: 'icheckbox_flat',
        radioClass: 'iradio_flat-blue'
    });
}); 

function agregar_usuario()
{
    $.ajax({
        url:"ajax/usuarios/agregar_usuario.php",
        type:"POST",
        data:$("#nuevo_usuario").serialize(),
        success:function(respuesta)
        {
            var mensaje=JSON.parse(respuesta);
            pnotify_creador("usuario creado",mensaje.body, mensaje.header);
            $("#tabla").html(mensaje.content);
            if(mensaje.header=="success")
            {
                $("#radioadmin").parent().removeClass("active").attr('checked',false);
                $("#radiocliente").parent().addClass("active").attr('checked',true);
                limpiar_form('nuevo_usuario');
                $('#modal_nuevo_usuario').modal('toggle');
            }
            $('.table').DataTable();
        }
    });
}

function eliminar_usuario(id)
{
    $.ajax({
        url:"ajax/usuarios/eliminar_usuario.php",
        type:"POST",
        data:{"id" : id},
        success:function(respuesta)
        {
            var mensaje=JSON.parse(respuesta);
            pnotify_creador("Alerta",mensaje.body, mensaje.header);
            $("#tabla").html(mensaje.content);
            $('.table').DataTable();
        }
    });
}