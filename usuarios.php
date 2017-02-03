<?php
//ini_set("session.cookie_lifetime",20);
//ini_set("session.gc_maxlifetime",20);
session_start();
if(isset($_SESSION['usuario']))
{
    if($_SESSION['permiso']==1)
    {
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
         <?php    require_once("includes/plugins.php");?>
         <link rel="stylesheet" href="css/blue.css">
        <script type="text/javascript" src="js/icheck.js"></script>
        <script type="text/javascript" src="js/funciones_generales.js"></script>
        <script type="text/javascript" src="js/usuarios/usuarios.js"></script>
    </head>
    <header>
    <?php
        require("menu_admin.php");
    ?>
    </header>
    <body class="nav-md" onload="activeTabChoose(0)">
        <div class="row-fluid">
            <button type="button" class="col-md-2 pull-left btn btn-info btnPanel" onclick="abrir_modal('modal_nuevo_usuario')" >
                <i class="fa fa-plus" aria-hidden="true"></i>Agregar Usuario
            </button>
        </div>
        <div class="row-fluid">
            <div class="col-md-12" id="tabla"> 
                <?php
                include("ajax/usuarios/mostrar_usuarios.php");
                ?>
            </div>
        </div>
    </body>
</html>
<?php
    }
    else
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}
else
{
    session_unset();
    session_destroy();
    header("Location: login.php");
}
?>
<!-- nuevo usuario -->
<div class="modal fade" id="modal_nuevo_usuario" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos del usuario</h4>
        </div>
        <div class="modal-body">
          <form id="nuevo_usuario" class="form-horizontal col-md-12" onsubmit="agregar_usuario('nuevo_usuario');return false" autocomplete="off">  
            <div class="form-group">
                    <!--Nombre-->
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-id-card fa-fw" aria-hidden="true"></i></span>
                      <input type="text" name="nombre" class="form-control has-feedback-left validar" required placeholder="Nombre" title="Nombre">
                    </div>
            </div>
              <div class="form-group">
                   
                    <!--Usuario-->
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                      <input type="text" name="usuario" class="form-control has-feedback-left validar" required placeholder="Usuario" title="Usuario">
                    </div>
                </div><input style="display:none" type="text" name="fakeusernameremembered"/>
<input style="display:none" type="password" name="fakepasswordremembered"/>
              <div class="form-group">
                   
                    <!--Ciudad-->
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-map fa-fw"></i></span>
                     <input name="ciudad" type="text" class="form-control has-feedback-left validar" required placeholder="Ciudad" title="ciudad">
                    </div>
                </div>
                 <div class="form-group">
                   
                    <!--Contraseña-->
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                      <input type="password" name="password" class="form-control has-feedback-left validar" required placeholder="Contrase&ntilde;a" title="Contrase&ntilde;a">
                    </div>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                        <div>
                            <div class="btn-group" data-toggle="buttons">
                                <label >
                                    <input type="radio" class="icheckRadio" id="radioadmin" name="tipo" value="1">Administrador
                                </label>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <label>
                                    <input type="radio" class="icheckRadio"  id="radiocliente" name="tipo" checked="true" value="0">Cliente
                                </label>
                            </div>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>

    </div>
</div>
