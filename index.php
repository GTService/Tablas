<?php
session_start();
if(!(isset($_SESSION['usuario'])))
{   
    session_unset();
    session_destroy();
    header("Location: login.php");
}
$menu="";
    require_once($_SERVER['DOCUMENT_ROOT']."/archivos_timbrado/includes/database.php");
    $consulta=$db->query("select * from usuarios where tipo='1' and usuario='".$_SESSION['usuario']."'");
    if($db->num_rows($consulta)==1)
    {
        $_SESSION['permiso'] = 1;
        $menu="menu_admin.php";
    }
    else if($db->num_rows($consulta)==0)
    {
        $_SESSION['permiso'] = 0;
        $menu="menu_usuario_comun.php";
    }
    else
    {   
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php    require_once("includes/plugins.php");?>
        <script type="text/javascript" src="js/uploadify/jquery.uploadify.js"></script>
    </head>
    <header>
    <?php
        require($menu);
    ?>
    </header>
    <body class="nav-md">
        
    </body>
</html>
