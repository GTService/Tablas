function validar_usuario()
{
    $.ajax({
        url:"validar_usuario.php",
        type:"POST",
        data:$("#login").serialize(),
        success:function(respuesta){
            var mensaje = JSON.parse(respuesta);
            if(mensaje.header=="success")
            {
                //$.notify(mensaje.body, mensaje.header);
                setTimeout(window.location.replace(mensaje.contenido),2000);
                pnotify_creador('Bienvenido',mensaje.body,mensaje.header);
            }
            else if(mensaje.header=="error")
            {
                //$.notify(mensaje.body, mensaje.header);
                pnotify_creador("vuelve a intentar", mensaje.body, mensaje.header);
            }
            else
            {
                //$.notify("Respuesta inesperada del servidor", "warn");
                pnotify_creador("Error inesperado", "Respuesta inesperada del servidor", 'error');
            }
        }
    }
    );
}