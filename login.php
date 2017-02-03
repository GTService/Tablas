<?php
//ini_set("session.cookie_lifetime",20);
//ini_set("session.gc_maxlifetime",20);
session_start();
if((isset($_SESSION["usuario"]))&&($_SESSION["usuario"]!=""))
{
    header("Location: index.php");
}
else
{
    session_unset(); 
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GT-Inicio de sesion</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    
    
    
    <?php    require_once("includes/plugins.php");?>
    <script type="text/javascript" src="js/login.js"></script>
  </head>

  <body>
    <div class="container">
        <div id="spacing">
        
        </div>
        <div class="row">
          <div class="" style="width: 450px; margin-left: auto; margin-right: auto">
            <div class="panel panel-default" id="mainPanel">
                <div class="panel-heading">
                  <h3 class="panel-title"><img src="images/gt-service-04.png" alt="Logo GT" class="img-responsive"></h3>
                </div>
                <form onsubmit="validar_usuario();return false" id="login">
                <h3 class="text-center">Iniciar Sesión <span class="fa fa-sign-in"></span></h3>
                <hr>
                  <div class="panel-body">
                    <div class="form-group">
                      <div class="input-group">
                        <input id="usuario" name="usuario" class="form-control validar" placeholder="Usuario">
                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                      </div>
                      <br>
                      <div class="input-group">
                        <input id="password" name="password" type="password" class="form-control validar on_enter" placeholder="Contraseña">
                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                      <button type="button" name="log-me-in" tabindex="5" class="btn btn-success btn-block" onclick="validar_usuario();">Entrar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>