PNotify.prototype.options.styling = "fontawesome";
//Creador de notificaciones pnotify
function pnotify_creador( title, text, type ){

    new PNotify({
        title: title,
        text: text,
        type: type
    });
}

