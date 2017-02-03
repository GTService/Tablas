        
function runScript(e) { 
    var keyCode = e.keyCode || e.which; 

    if (keyCode == 13) {
        e.preventDefault();
        validar_usuario()

       
    } 
};

function validar_usuario()
{
    $.ajax({
        url:"validar_usuario.php",
        type:"post",
        data:$("#login").serialize(),
        success:function(respuesta)
        {
            var mensaje = JSON.parse(respuesta);
            if(mensaje.header=="success")
            {
                pnotify_creador('Bienvenido',mensaje.body,mensaje.header);
                window.location.replace(mensaje.contenido);
            }
            else if(mensaje.header=="error")
            {
                pnotify_creador("vuelve a intentar", mensaje.body, mensaje.header);
            }
            else
            {
                pnotify_creador("Error inesperado", "Respuesta inesperada del servidor", 'error');
            }
        }
    }
    );
}