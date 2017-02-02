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
        
        <script type="text/javascript" src="js/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="js/uploadify/jquery.uploadify.js"></script>
        <script type="text/javascript" src="js/archivos/archivos.js"></script>
        <title>Archivos</title>
    </head>
    <header>
    <?php
        require("menu_usuario_comun.php");
    ?>
    </header>
    <body class="nav-md">
            <div class="col-xs-2 col-md-12 tableContainer" id="tabla"> 
            <?php
            $sql="select a.nombre as nombre, a.tipo as tipo, a.anio as anio, a.periodo as periodo, a.id as id, a.creacion as creacion from archivos as a inner join archivos_usuarios as au on a.id=au.archivo inner join usuarios as u on au.usuario=u.id  and u.usuario='".$_SESSION['usuario']."'";
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