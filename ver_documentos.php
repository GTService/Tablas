<?php
//ini_set("session.cookie_lifetime",20);
//ini_set("session.gc_maxlifetime",20);
session_start();
if(isset($_SESSION['usuario']))
{
    if($_SESSION['permiso']==0)
    {
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
         <?php    require_once("includes/plugins.php");?>
        <script type="text/javascript" src="js/funciones_generales.js"></script>
        <script type="text/javascript" src="js/usuarios/usuarios.js"></script>
    </head>
    <header>
    <?php
        require("menu_usuario_comun.php");
    ?>
    </header>
    <body class="nav-md"  class="nav-md" onload="activeTabChoose(0)">
        <div class="col-xs-2 col-md-12" id="tabla"> 
            <?php
            include("ajax/archivos/mostrar_archivos_usuario_comun.php");
            ?>
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